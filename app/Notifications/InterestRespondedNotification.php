<?php

namespace App\Notifications;

use App\Models\Conversation;
use App\Models\Interest;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InterestRespondedNotification extends Notification implements ShouldBroadcastNow
{
    use Queueable;

    public int $targetUserId;

    public function __construct(
        public Interest $interest,
        public string $action, // 'accepted' or 'declined'
        public bool $isWali = false,
        public ?User $forSeeker = null,
        public ?Conversation $conversation = null,
        ?int $targetUserId = null
    ) {
        $this->targetUserId = $targetUserId ?? $this->interest->sender_id;
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
        $recipient = $this->interest->recipient;
        $isAccepted = $this->action === 'accepted';
        $chatUrl = $this->conversation ? route('chat.show', $this->conversation->id) : route('interests.index');

        if ($isAccepted) {
            return (new MailMessage)
                ->subject("Sadhu! Proposal Accepted by {$recipient->name} - Global Maitri")
                ->greeting("Namaste, {$notifiable->name}!")
                ->line("Sadhu! **{$recipient->name}** has accepted your matrimonial proposal.")
                ->line('Your mindful conversation has been unlocked. Please maintain Metta, respect, and noble character in all discussions.')
                ->action('Open Mindful Chat', $chatUrl)
                ->line('May you be happy and well in your communication.')
                ->salutation('Warm regards, The Global Maitri Team');
        }

        return (new MailMessage)
            ->subject('Matrimonial Proposal Update - Global Maitri')
            ->greeting("Namaste, {$notifiable->name}!")
            ->line("The proposal sent to **{$recipient->name}** was politely declined.")
            ->line('Do not be disheartened. We believe you will find the right Dhamma companion at the auspicious time. Keep exploring with patience and Metta.')
            ->action('Discover More Matches', route('discovery.index'))
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
        $isAccepted = $this->action === 'accepted';

        if ($this->isWali) {
            return [
                'type' => $isAccepted ? 'wali_interest_accepted' : 'wali_interest_declined',
                'title' => $isAccepted ? 'Mutual Interest Confirmed' : 'Interest Request Declined',
                'message' => $isAccepted
                    ? "Mutual interest confirmed between {$recipient->name} and {$sender->name}. Chaperoned messaging unlocked."
                    : "The interest request between {$recipient->name} and {$sender->name} was declined.",
                'interest_id' => $this->interest->id,
                'action_url' => route('wali.dashboard'),
                'icon' => $isAccepted ? '🤝' : '🛡️',
            ];
        }

        if ($isAccepted) {
            return [
                'type' => 'interest_accepted',
                'title' => 'Interest Request Accepted!',
                'message' => "{$recipient->name} accepted your proposal request! You may now begin mindful conversation.",
                'interest_id' => $this->interest->id,
                'recipient_id' => $recipient->id,
                'recipient_name' => $recipient->name,
                'action_url' => $this->conversation ? route('chat.show', $this->conversation->id) : route('chat.index'),
                'icon' => '🎉',
            ];
        }

        return [
            'type' => 'interest_declined',
            'title' => 'Interest Request Declined',
            'message' => "{$recipient->name} has politely declined your interest request.",
            'interest_id' => $this->interest->id,
            'recipient_id' => $recipient->id,
            'recipient_name' => $recipient->name,
            'action_url' => route('interests.index'),
            'icon' => 'ℹ️',
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
