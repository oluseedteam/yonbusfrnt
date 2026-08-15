<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeClientNotification extends Notification
{
    /**
     * @param  string|null  $verificationCode  6-digit OTP (null for social login users)
     */
    public function __construct(public ?string $verificationCode = null) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $firstName = $notifiable->first_name ?? 'Valued Client';

        return (new MailMessage)
            ->subject('Welcome to YONBUS — Your Account is Ready')
            ->greeting("Hello {$firstName},")
            ->line('Thank you for registering with **YONBUS Tax & Accounting Services**.')
            ->when($this->verificationCode, function ($mail) {
                return $mail
                    ->line('Use the code below to verify your account:')
                    ->line('')
                    ->line('### Your Verification Code')
                    ->line("**{$this->verificationCode}**")
                    ->line('')
                    ->line('This code expires in **10 minutes**. Do not share it with anyone.');
            })
            ->line('If you did not register, please ignore this email.')
            ->action('Log In to Dashboard', url('/login'))
            ->salutation('The YONBUS Team');
    }
}
