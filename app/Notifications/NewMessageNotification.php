<?php

namespace App\Notifications;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewMessageNotification extends Notification
{
    use Queueable;

    public function __construct(public Message $chatMessage) {}

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
        $this->chatMessage->loadMissing(['sender']);
        $senderName = $this->chatMessage->sender->name ?? 'YONBUS Specialist';

        $isStaff = in_array($notifiable->role ?? '', ['admin', 'superadmin', 'subadmin', 'accountant']);
        $chatUrl = $isStaff
            ? url(($notifiable->role ?? '') === 'accountant' ? '/accountant/messages' : '/admin/messages')
            : url('/client/messages');

        $preview = \Illuminate\Support\Str::limit($this->chatMessage->body, 120);

        return (new MailMessage)
            ->subject("New Message from {$senderName} — YONBUS Portal")
            ->greeting('Hello ' . ($notifiable->first_name ?? $notifiable->name ?? 'Valued Client') . ',')
            ->line("You have received a new message from **{$senderName}** on your YONBUS portal:")
            ->line("\"{$preview}\"")
            ->when($this->chatMessage->attachment_name, function ($mail) {
                return $mail->line("**Attachment:** {$this->chatMessage->attachment_name}");
            })
            ->action('View & Reply in Messages', $chatUrl)
            ->line('Please log in to continue the conversation.');
    }

    public function toDatabase(object $notifiable): array
    {
        $this->chatMessage->loadMissing(['sender']);
        $senderName = $this->chatMessage->sender->name ?? 'Advisor';

        $isStaff = in_array($notifiable->role ?? '', ['admin', 'superadmin', 'subadmin', 'accountant']);
        $chatUrl = $isStaff
            ? (($notifiable->role ?? '') === 'accountant' ? '/accountant/messages' : '/admin/messages')
            : '/client/messages';

        return [
            'title'      => "New message from {$senderName}",
            'message'    => \Illuminate\Support\Str::limit($this->chatMessage->body, 80),
            'type'       => 'new_message',
            'url'        => $chatUrl,
            'message_id' => $this->chatMessage->id,
        ];
    }
}
