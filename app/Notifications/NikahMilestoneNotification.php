<?php

namespace App\Notifications;

use App\Models\Marriage;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NikahMilestoneNotification extends Notification implements ShouldBroadcastNow
{
    use Queueable;

    public function __construct(
        public Marriage $marriage,
        public string $event = 'initiated' // 'initiated', 'confirmed', 'declined'
    ) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        if (! $notifiable->allowsNotification('marriage_notifications')) {
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
        $initiator = $this->marriage->initiator;
        $url = route('marriages.celebration');

        if ($this->event === 'confirmed') {
            return (new MailMessage)
                ->subject('Mangala Vivaha! Your Auspicious Marriage Milestone is Confirmed - Global Maitri')
                ->greeting("Namaste and Mangalam, {$notifiable->name}!")
                ->line('Sadhu! Your Mangala Vivaha milestone has been officially confirmed on Global Maitri.')
                ->line('May the Triple Gem bless your union, and may your lives together be filled with Metta, harmony, and mutual respect.')
                ->action('View Celebration & Blessing Certificate', $url)
                ->line('Your Single Marriage Pass has successfully concluded. Anumodana for honoring us to be a part of your auspicious journey.')
                ->salutation('With warmest Metta, The Global Maitri Team');
        }

        return (new MailMessage)
            ->subject('Mangala Vivaha Milestone Declared - Action Required on Global Maitri')
            ->greeting("Namaste, {$notifiable->name}!")
            ->line("**{$initiator->name}** has declared that your Mangala Vivaha (marriage) has been solemnized!")
            ->line('Please review and confirm this auspicious milestone to finalize your matrimonial journey.')
            ->action('Review & Confirm Mangala Vivaha', $url)
            ->line('Upon mutual confirmation, all third-party suitors and ongoing discovery requests will be gracefully concluded.')
            ->salutation('Warm regards, The Global Maitri Team');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $initiator = $this->marriage->initiator;

        if ($this->event === 'initiated') {
            return [
                'type' => 'nikah_milestone_initiated',
                'title' => '💍 Mangala Vivaha Declared',
                'message' => "{$initiator->name} has declared that you have solemnized your Mangala Vivaha! Please review and confirm this auspicious milestone.",
                'marriage_id' => $this->marriage->id,
                'icon' => '💍',
                'url' => route('marriages.celebration'),
            ];
        }

        if ($this->event === 'confirmed') {
            return [
                'type' => 'nikah_milestone_confirmed',
                'title' => '🎉 Mangala Vivaha Confirmed!',
                'message' => 'Sadhu! Your Mangala Vivaha milestone is confirmed. May the Triple Gem bless your union with peace and harmony.',
                'marriage_id' => $this->marriage->id,
                'icon' => '🎉',
                'url' => route('marriages.celebration'),
            ];
        }

        return [
            'type' => 'nikah_milestone_declined',
            'title' => 'Mangala Vivaha Declaration Status',
            'message' => 'The Mangala Vivaha milestone confirmation request was declined.',
            'marriage_id' => $this->marriage->id,
            'icon' => 'ℹ️',
            'url' => route('chat.index'),
        ];
    }

    /**
     * Get the broadcastable representation of the notification.
     */
    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'id' => $this->id,
            'type' => 'nikah_milestone',
            'created_at' => now()->diffForHumans(),
            'read_at' => null,
            'data' => $this->toArray($notifiable),
        ]);
    }

    /**
     * Broadcast channel for the recipient.
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('App.Models.User.'.$this->marriage->groom_id),
            new PrivateChannel('App.Models.User.'.$this->marriage->bride_id),
        ];
    }
}
