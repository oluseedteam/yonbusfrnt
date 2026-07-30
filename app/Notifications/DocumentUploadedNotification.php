<?php

namespace App\Notifications;

use App\Models\Document;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DocumentUploadedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Document $document) {}

    public function via(object $notifiable): array
    {
        $channels = [];
        if ($notifiable->notification_database) $channels[] = 'database';
        if ($notifiable->notification_email)    $channels[] = 'mail';
        return $channels ?: ['database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Document Uploaded — ' . $this->document->original_name)
            ->greeting('Hello ' . $notifiable->first_name . ',')
            ->line('A new document has been uploaded to your account.')
            ->line('**File:** ' . $this->document->original_name)
            ->action('View Documents', url('/client/documents'));
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title'   => 'Document Uploaded',
            'message' => 'Document "' . $this->document->original_name . '" has been uploaded.',
            'type'    => 'document_uploaded',
            'url'     => '/client/documents',
            'document_id' => $this->document->id,
        ];
    }
}
