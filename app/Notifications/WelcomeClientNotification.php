<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeClientNotification extends Notification
{
    /**
     * @param  string  $verificationCode  6-digit OTP for account verification
     */
    public function __construct(public string $verificationCode) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $firstName = $notifiable->first_name ?? 'Valued Client';

        return (new MailMessage)
            ->subject('Welcome to YONBUS — Your Verification Code')
            ->greeting("Hello {$firstName},")
            ->line('Thank you for registering with **YONBUS Tax & Accounting Services**.')
            ->line('Use the code below to verify your account:')
            ->line('')
            ->line('### Your Verification Code')
            ->line("**{$this->verificationCode}**")
            ->line('')
            ->line('This code expires in **10 minutes**. Do not share it with anyone.')
            ->line('If you did not register, please ignore this email.')
            ->action('Log In to Dashboard', url('/login'))
            ->salutation('The YONBUS Team');
    }
}
