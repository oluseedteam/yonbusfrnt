<?php

namespace App\Notifications;

use App\Models\Document;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DocumentDeliveredToClientNotification extends Notification implements ShouldQueue
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
            ->subject('New Document Delivered — ' . $this->document->original_name)
            ->greeting('Hello ' . ($notifiable->first_name ?? $notifiable->name) . ',')
            ->line('A new document has been delivered to your YONBUS client portal by your advisor.')
            ->line('**File:** ' . $this->document->original_name)
            ->line('**Category:** ' . str_replace('_', ' ', $this->document->type ?? 'Document'))
            ->action('View Document in Portal', url('/client/documents'))
            ->line('You can log in to your client portal to view and download this document at any time.');
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title'       => 'Document Delivered to You',
            'message'     => 'A new document "' . $this->document->original_name . '" has been delivered to your portal by your advisor.',
            'type'        => 'document_delivered',
            'url'         => '/client/documents',
            'document_id' => $this->document->id,
        ];
    }
}
