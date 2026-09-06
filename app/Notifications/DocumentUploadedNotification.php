<?php

namespace App\Notifications;

use App\Models\Document;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DocumentUploadedNotification extends Notification
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
        $this->document->loadMissing(['client']);
        $clientName  = $this->document->client->name ?? 'Client';
        $clientEmail = $this->document->client->email ?? '';
        $docCategory = str_replace('_', ' ', ucfirst($this->document->type ?? 'Document'));

        $isStaff = in_array($notifiable->role ?? '', ['admin', 'superadmin', 'subadmin', 'accountant'])
            || ($notifiable->id !== $this->document->client_id);

        if ($isStaff) {
            $manageUrl = ($notifiable->role ?? '') === 'accountant'
                ? url('/accountant/documents')
                : url('/admin/documents');

            return (new MailMessage)
                ->subject("New Document Uploaded by {$clientName} — {$this->document->original_name}")
                ->greeting('Hello ' . ($notifiable->name ?? 'Advisor') . ',')
                ->line("Client **{$clientName}** has uploaded a new document to the portal.")
                ->line('**Client:** ' . $clientName . ($clientEmail ? " ({$clientEmail})" : ''))
                ->line('**File:** ' . $this->document->original_name)
                ->line('**Category:** ' . $docCategory)
                ->when($this->document->notes, function ($mail) {
                    return $mail->line('**Client Notes:** ' . $this->document->notes);
                })
                ->action('Review Document in Portal', $manageUrl)
                ->line('Please review the uploaded file in your documents dashboard.');
        }

        return (new MailMessage)
            ->subject('Document Upload Confirmation — ' . $this->document->original_name)
            ->greeting('Hello ' . ($notifiable->first_name ?? $notifiable->name ?? 'Valued Client') . ',')
            ->line('Your document has been uploaded successfully and submitted to your YONBUS team.')
            ->line('**File:** ' . $this->document->original_name)
            ->line('**Category:** ' . $docCategory)
            ->action('View My Documents', url('/client/documents'))
            ->line('Thank you for keeping your files up to date with YONBUS.');
    }

    public function toDatabase(object $notifiable): array
    {
        $this->document->loadMissing(['client']);
        $clientName = $this->document->client->name ?? 'Client';

        $isStaff = in_array($notifiable->role ?? '', ['admin', 'superadmin', 'subadmin', 'accountant'])
            || ($notifiable->id !== $this->document->client_id);

        if ($isStaff) {
            $manageUrl = ($notifiable->role ?? '') === 'accountant'
                ? '/accountant/documents'
                : '/admin/documents';

            return [
                'title'       => 'New Document Uploaded',
                'message'     => "Client {$clientName} uploaded \"{$this->document->original_name}\".",
                'type'        => 'document_uploaded',
                'url'         => $manageUrl,
                'document_id' => $this->document->id,
            ];
        }

        return [
            'title'       => 'Document Uploaded',
            'message'     => "Your document \"{$this->document->original_name}\" was uploaded successfully.",
            'type'        => 'document_uploaded',
            'url'         => '/client/documents',
            'document_id' => $this->document->id,
        ];
    }
}
