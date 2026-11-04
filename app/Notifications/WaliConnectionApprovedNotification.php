<?php

namespace App\Notifications;

use App\Models\WaliLink;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WaliConnectionApprovedNotification extends Notification
{
    use Queueable;

    public function __construct(
        public WaliLink $waliLink
    ) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        if (! $notifiable->allowsNotification('wali_notifications')) {
            return [];
        }

        return $notifiable->allowsNotification('email_notifications')
            ? ['mail', 'database']
            : ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $waliName = $this->waliLink->wali_name ?: 'Your Family Representative';
        $relationship = ucfirst(str_replace('_', ' ', $this->waliLink->relationship_type));

        return (new MailMessage)
            ->subject('Family Representative Connection Approved - Global Maitri')
            ->greeting("Namaste, {$notifiable->name}!")
            ->line("Sadhu! Your {$relationship}, **{$waliName}**, has officially approved your Family Representative connection request on Global Maitri.")
            ->line('Your account now has active family guidance:')
            ->line('• Inbound and outbound matrimonial proposals will be shared with their knowledge.')
            ->line('• Your representative can review candidate biodata and advise you in decisions.')
            ->action('View Family Representative Settings', route('wali.link'))
            ->line('May you be blessed with harmony, Metta, and an auspicious life companion.')
            ->salutation('Warm regards, The Global Maitri Team');
    }

    /**
     * Get array representation for database notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $waliName = $this->waliLink->wali_name ?: 'Your Family Representative';

        return [
            'type' => 'wali_connection_approved',
            'title' => '👨‍👩‍👧 Family Representative Active',
            'message' => "{$waliName} has approved your Family Representative connection request. Your profile now has active family guidance.",
            'wali_link_id' => $this->waliLink->id,
            'icon' => '👨‍👩‍👧',
            'action_url' => route('wali.link'),
        ];
    }
}
