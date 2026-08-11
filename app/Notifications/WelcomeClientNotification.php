<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeClientNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @param  string  $verificationCode  The OTP/code sent to the client
     */
    public function __construct(public string $verificationCode) {}

    /**
     * Get the notification's delivery channels.
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
        $firstName = $notifiable->first_name ?? 'Valued Client';

        return (new MailMessage)
            ->subject('Welcome to YONBUS — Verify Your Account')
            ->greeting("Hello {$firstName},")
            ->line('Thank you for registering with **YONBUS Tax & Accounting Services**.')
            ->line('To complete your registration, please use the verification code below:')
            ->line('')
            ->line('---')
            ->line('## Your Verification Code')
            ->line("**{$this->verificationCode}**")
            ->line('---')
            ->line('')
            ->line('This code is valid for **10 minutes**. If you did not create an account, please ignore this email.')
            ->action('Log In to Your Dashboard', url('/login'))
            ->line('We look forward to serving you.')
            ->salutation('Warm regards, **The YONBUS Team**');
    }
}
