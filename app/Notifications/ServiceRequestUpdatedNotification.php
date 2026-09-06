<?php

namespace App\Notifications;

use App\Models\ServiceRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ServiceRequestUpdatedNotification extends Notification
{
    use Queueable;

    public function __construct(public ServiceRequest $serviceRequest) {}

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
        $this->serviceRequest->loadMissing(['client', 'service']);
        $serviceTitle = $this->serviceRequest->service->name ?? 'Tax & Accounting Consultation';
        $clientName   = $this->serviceRequest->client->name ?? 'Client';
        $status       = ucfirst($this->serviceRequest->status);

        $isStaff = in_array($notifiable->role ?? '', ['admin', 'superadmin', 'subadmin', 'accountant'])
            || ($notifiable->id !== $this->serviceRequest->client_id);

        if ($isStaff) {
            return (new MailMessage)
                ->subject("Service Request Updated — {$serviceTitle} ({$clientName})")
                ->greeting('Hello ' . ($notifiable->name ?? 'Advisor') . ',')
                ->line("The service request from **{$clientName}** has been updated.")
                ->line('**Service:** ' . $serviceTitle)
                ->line('**New Status:** ' . $status)
                ->when($this->serviceRequest->notes, function ($mail) {
                    return $mail->line('**Notes:** ' . $this->serviceRequest->notes);
                })
                ->action('Manage Requests in Admin Portal', url('/admin/dashboard'));
        }

        return (new MailMessage)
            ->subject("Service Request Updated — {$serviceTitle}")
            ->greeting('Hello ' . ($notifiable->first_name ?? $notifiable->name ?? 'Valued Client') . ',')
            ->line('Your service request status has been updated by our advisory team.')
            ->line('**Service:** ' . $serviceTitle)
            ->line('**Current Status:** ' . $status)
            ->when($this->serviceRequest->notes, function ($mail) {
                return $mail->line('**Notes:** ' . $this->serviceRequest->notes);
            })
            ->action('View Service Requests', url('/client/dashboard'))
            ->line('Thank you for choosing YONBUS Tax & Accounting Services.');
    }

    public function toDatabase(object $notifiable): array
    {
        $this->serviceRequest->loadMissing(['client', 'service']);
        $serviceTitle = $this->serviceRequest->service->name ?? 'Service Request';
        $clientName   = $this->serviceRequest->client->name ?? 'Client';

        $isStaff = in_array($notifiable->role ?? '', ['admin', 'superadmin', 'subadmin', 'accountant'])
            || ($notifiable->id !== $this->serviceRequest->client_id);

        if ($isStaff) {
            return [
                'title'              => 'Service Request Updated',
                'message'            => "Request for {$serviceTitle} by {$clientName} changed to {$this->serviceRequest->status}.",
                'type'               => 'service_request_updated',
                'url'                => '/admin/dashboard',
                'service_request_id' => $this->serviceRequest->id,
            ];
        }

        return [
            'title'              => 'Service Request Updated',
            'message'            => "Your request for \"{$serviceTitle}\" status changed to {$this->serviceRequest->status}.",
            'type'               => 'service_request_updated',
            'url'                => '/client/dashboard',
            'service_request_id' => $this->serviceRequest->id,
        ];
    }
}
