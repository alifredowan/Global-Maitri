<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class WelcomeVerificationNotification extends Notification
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('Welcome to Global Maitri - Verify Your Email Address')
            ->greeting("Namaste and Greetings, {$notifiable->name}!")
            ->line('Sadhu and welcome to **Global Maitri**, the mindful Buddhist matrimonial platform designed for sincere seekers and their families.')
            ->line('Please confirm your email address to verify your account and begin your auspicious journey toward Mangala Vivaha.')
            ->action('Verify Email & Activate Profile', $verificationUrl)
            ->line('This verification link will remain valid for 48 hours.')
            ->line('At Global Maitri, we honor Lotus Modesty privacy, Family Representative guidance, and casteless equality to support you every step of the way.')
            ->salutation('Warm regards, The Global Maitri Team');
    }

    /**
     * Get the verification URL for the given notifiable.
     */
    protected function verificationUrl(object $notifiable): string
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 2880)),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }
}
