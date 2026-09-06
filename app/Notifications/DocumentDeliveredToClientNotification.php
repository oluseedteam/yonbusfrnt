<?php

namespace App\Notifications;

use App\Models\Document;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DocumentDeliveredToClientNotification extends Notification
{
    use Queueable;

    public function __construct(public Document $document) {}

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
        $this->document->loadMissing(['uploader']);
        $advisorName = $this->document->uploader->name ?? 'Your Advisor';

        return (new MailMessage)
            ->subject('New Document Delivered — ' . $this->document->original_name)
            ->greeting('Hello ' . ($notifiable->first_name ?? $notifiable->name ?? 'Valued Client') . ',')
            ->line("A new document has been prepared and delivered to your YONBUS client portal by **{$advisorName}**.")
            ->line('**File:** ' . $this->document->original_name)
            ->line('**Category:** ' . str_replace('_', ' ', ucfirst($this->document->type ?? 'Document')))
            ->when($this->document->notes, function ($mail) {
                return $mail->line('**Advisor Notes:** ' . $this->document->notes);
            })
            ->action('View & Download in Portal', url('/client/documents'))
            ->line('You can log into your client portal to view, review, and download this document at any time.');
    }

    public function toDatabase(object $notifiable): array
    {
        $this->document->loadMissing(['uploader']);
        $advisorName = $this->document->uploader->name ?? 'Your Advisor';

        return [
            'title'       => 'Document Delivered to You',
            'message'     => "A new document \"{$this->document->original_name}\" has been delivered to your portal by {$advisorName}.",
            'type'        => 'document_delivered',
            'url'         => '/client/documents',
            'document_id' => $this->document->id,
        ];
    }
}
