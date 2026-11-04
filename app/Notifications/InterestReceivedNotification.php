<?php

namespace App\Notifications;

use App\Models\Interest;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InterestReceivedNotification extends Notification implements ShouldBroadcastNow
{
    use Queueable;

    public int $targetUserId;

    public function __construct(
        public Interest $interest,
        public bool $isWali = false,
        public ?User $forSeeker = null,
        public bool $isSenderWali = false,
        ?int $targetUserId = null
    ) {
        $this->targetUserId = $targetUserId ?? $this->interest->recipient_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        if (! $notifiable->allowsNotification('interest_notifications')) {
            return [];
        }

        return $notifiable->allowsNotification('email_notifications')
            ? ['database', 'broadcast', 'mail']
            : ['database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $sender = $this->interest->sender;
        $url = route('interests.index');

        if ($this->isWali) {
            $seekerName = $this->forSeeker?->name ?: 'your candidate';

            return (new MailMessage)
                ->subject("New Matrimonial Proposal for {$seekerName} - Global Maitri")
                ->greeting("Namaste, {$notifiable->name}!")
                ->line("A candidate suitor, **{$sender->name}**, has sent a matrimonial proposal to **{$seekerName}**.")
                ->line('As their designated Family Representative, you can review this proposal, inspect Dhamma compatibility, and guide the next steps.')
                ->action('Review Proposal on Representative Console', route('wali.dashboard'))
                ->line('Global Maitri ensures full Lotus Modesty and family transparency at every stage.')
                ->salutation('Warm regards, The Global Maitri Team');
        }

        return (new MailMessage)
            ->subject("New Mindful Proposal from {$sender->name} - Global Maitri")
            ->greeting("Namaste, {$notifiable->name}!")
            ->line("**{$sender->name}** has expressed serious matrimonial interest in your biodata on Global Maitri.")
            ->line('You can review their Dhamma practice, Five Precepts observance, and family background.')
            ->action('View Proposal', $url)
            ->line('Your Lotus Modesty photo shelter remains strictly protected until mutual acceptance.')
            ->salutation('Warm regards, The Global Maitri Team');
    }

    /**
     * Data stored in database.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $sender = $this->interest->sender;
        $recipient = $this->interest->recipient;

        if ($this->isSenderWali) {
            return [
                'type' => 'wali_interest_sent',
                'title' => 'Dependent Expressed Interest',
                'message' => "Your dependent {$sender->name} sent an interest request to {$recipient->name}.",
                'interest_id' => $this->interest->id,
                'sender_id' => $sender->id,
                'recipient_id' => $recipient->id,
                'action_url' => route('wali.dashboard'),
                'icon' => '🛡️',
            ];
        }

        if ($this->isWali) {
            return [
                'type' => 'wali_interest_received',
                'title' => 'New Interest for Dependent',
                'message' => "A new interest request has been sent to your dependent {$recipient->name} by {$sender->name}.",
                'interest_id' => $this->interest->id,
                'sender_id' => $sender->id,
                'recipient_id' => $recipient->id,
                'action_url' => route('wali.dashboard'),
                'icon' => '🛡️',
            ];
        }

        return [
            'type' => 'interest_received',
            'title' => 'New Interest Request Received',
            'message' => "{$sender->name} has sent you an expression of interest!",
            'note' => $this->interest->message_note,
            'interest_id' => $this->interest->id,
            'sender_id' => $sender->id,
            'sender_name' => $sender->name,
            'action_url' => route('discovery.show', $sender->id),
            'icon' => '💌',
        ];
    }

    /**
     * Real-time Broadcast payload via Laravel Reverb.
     */
    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        $data = $this->toArray($notifiable);
        $data['id'] = $this->id;
        $data['created_at'] = now()->diffForHumans();

        return new BroadcastMessage($data);
    }

    /**
     * The channels the event should broadcast on.
     *
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('App.Models.User.'.$this->targetUserId),
            new PrivateChannel('user.'.$this->targetUserId),
        ];
    }
}
