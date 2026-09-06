<?php

namespace App\Notifications;

use App\Models\CommunicationLog;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactInquiryReceivedNotification extends Notification
{
    use Queueable;

    public function __construct(public CommunicationLog $inquiry) {}

    public function via(object $notifiable): array
    {
        $channels = ['database'];
        if (!empty($notifiable->email)) {
            $channels[] = 'mail';
        }
        return $channels;
    }

    public function toMail(object $notifiable): MailMessage
    {
        $channelLabel = $this->inquiry->channel === 'career_application' ? 'Career Application' : 'Contact Form Inquiry';

        return (new MailMessage)
            ->subject("New {$channelLabel} from {$this->inquiry->name}")
            ->greeting('Hello ' . ($notifiable->name ?? 'Admin') . ',')
            ->line("A new **{$channelLabel}** has been received through the website.")
            ->line('**Sender Name:** ' . $this->inquiry->name)
            ->line('**Email:** ' . $this->inquiry->email)
            ->when($this->inquiry->phone, function ($mail) {
                return $mail->line('**Phone:** ' . $this->inquiry->phone);
            })
            ->line('**Subject:** ' . $this->inquiry->subject)
            ->line('**Message Details:**')
            ->line($this->inquiry->message)
            ->action('Review Inquiries in Admin Portal', url('/admin/inquiries'))
            ->line('Please follow up with this prospective client or applicant.');
    }

    public function toDatabase(object $notifiable): array
    {
        $channelLabel = $this->inquiry->channel === 'career_application' ? 'Career application' : 'Inquiry';

        return [
            'title'      => "New {$channelLabel} from {$this->inquiry->name}",
            'message'    => \Illuminate\Support\Str::limit($this->inquiry->subject . ': ' . $this->inquiry->message, 80),
            'type'       => 'contact_inquiry',
            'url'        => '/admin/inquiries',
            'inquiry_id' => $this->inquiry->id,
        ];
    }
}
