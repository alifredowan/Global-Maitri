<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\WaliLink;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WaliConnectionRequestNotification extends Notification
{
    use Queueable;

    public function __construct(
        public WaliLink $waliLink,
        public User $seeker
    ) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return $notifiable->allowsNotification('wali_notifications')
            && $notifiable->allowsNotification('email_notifications')
            ? ['mail']
            : [];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $waliName = $this->waliLink->wali_name ?: 'Respected Family Representative';
        $relationship = ucfirst(str_replace('_', ' ', $this->waliLink->relationship_type));
        $wardGender = $this->seeker->gender === 'female' ? 'candidate (daughter/sister)' : 'candidate (son/brother)';

        $actionUrl = route('wali.invite.show', $this->waliLink->invite_token);

        return (new MailMessage)
            ->subject("Family Representative Connection Request from {$this->seeker->name} - Global Maitri")
            ->greeting("Namaste, {$waliName}!")
            ->line("Your {$wardGender}, **{$this->seeker->name}**, has designated you as their **Family Representative ({$relationship})** on Global Maitri.")
            ->line('As their Family Representative, you can:')
            ->line('• Review candidate proposals with their knowledge.')
            ->line('• Provide elder wisdom and guidance on Dhamma compatibility.')
            ->line('• Support them throughout their mindful journey toward Mangala Vivaha.')
            ->action('Review & Accept Connection', $actionUrl)
            ->line('If this request was made by mistake, you may decline the request via the link above.')
            ->salutation('Warm regards, The Global Maitri Team');
    }
}
