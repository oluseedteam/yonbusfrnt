<?php

namespace App\Notifications;

use App\Models\ServiceRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ServiceRequestUpdatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public ServiceRequest $serviceRequest) {}

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
            ->subject('Service Request Updated')
            ->greeting('Hello ' . $notifiable->first_name . ',')
            ->line('Your service request has been updated.')
            ->line('**Subject:** ' . $this->serviceRequest->subject)
            ->line('**Status:** ' . ucfirst($this->serviceRequest->status))
            ->action('View Request', url('/client/appointments'));
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title'   => 'Service Request Updated',
            'message' => 'Your service request "' . $this->serviceRequest->subject . '" status changed to ' . $this->serviceRequest->status . '.',
            'type'    => 'service_request_updated',
            'url'     => '/client/appointments',
            'service_request_id' => $this->serviceRequest->id,
        ];
    }
}
