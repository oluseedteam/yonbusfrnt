<?php

namespace App\Notifications;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentCancelledNotification extends Notification
{
    use Queueable;

    public function __construct(public Appointment $appointment) {}

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
        $this->appointment->loadMissing(['client', 'service']);
        $clientName  = $this->appointment->client->name ?? 'Client';
        $serviceName = $this->appointment->service->name ?? 'Consultation';
        $dateStr     = $this->appointment->date ? (is_string($this->appointment->date) ? $this->appointment->date : $this->appointment->date->format('Y-m-d')) : 'TBD';
        $timeStr     = $this->appointment->time ? date('g:i A', strtotime($this->appointment->time)) : 'TBD';

        $isStaff = in_array($notifiable->role ?? '', ['admin', 'superadmin', 'subadmin', 'accountant'])
            || ($notifiable->id !== $this->appointment->client_id);

        if ($isStaff) {
            $manageUrl = ($notifiable->role ?? '') === 'accountant'
                ? url('/accountant/appointments')
                : url('/admin/appointments');

            return (new MailMessage)
                ->subject("Appointment Cancelled — #{$this->appointment->appointment_number} ({$clientName})")
                ->greeting('Hello ' . ($notifiable->name ?? 'Advisor') . ',')
                ->error()
                ->line("The consultation appointment with **{$clientName}** has been cancelled.")
                ->line('**Reference:** ' . $this->appointment->appointment_number)
                ->line('**Client:** ' . $clientName)
                ->line('**Service:** ' . $serviceName)
                ->line('**Original Date:** ' . $dateStr)
                ->line('**Original Time:** ' . $timeStr)
                ->when($this->appointment->notes, function ($mail) {
                    return $mail->line('**Reason/Notes:** ' . $this->appointment->notes);
                })
                ->action('View Appointments', $manageUrl);
        }

        return (new MailMessage)
            ->subject('Appointment Cancelled — #' . $this->appointment->appointment_number)
            ->greeting('Hello ' . ($notifiable->first_name ?? $notifiable->name ?? 'Valued Client') . ',')
            ->error()
            ->line('Your consultation appointment #' . $this->appointment->appointment_number . ' has been cancelled.')
            ->line('**Service:** ' . $serviceName)
            ->line('**Date:** ' . $dateStr)
            ->when($this->appointment->notes, function ($mail) {
                return $mail->line('**Notes:** ' . $this->appointment->notes);
            })
            ->line('Please visit your portal or contact us to reschedule at your convenience.')
            ->action('Book New Appointment', url('/book-appointment'));
    }

    public function toDatabase(object $notifiable): array
    {
        $this->appointment->loadMissing(['client', 'service']);
        $clientName = $this->appointment->client->name ?? 'Client';

        $isStaff = in_array($notifiable->role ?? '', ['admin', 'superadmin', 'subadmin', 'accountant'])
            || ($notifiable->id !== $this->appointment->client_id);

        if ($isStaff) {
            $manageUrl = ($notifiable->role ?? '') === 'accountant'
                ? '/accountant/appointments'
                : '/admin/appointments';

            return [
                'title'          => 'Appointment Cancelled',
                'message'        => "Appointment #{$this->appointment->appointment_number} with {$clientName} was cancelled.",
                'type'           => 'appointment_cancelled',
                'url'            => $manageUrl,
                'appointment_id' => $this->appointment->id,
            ];
        }

        return [
            'title'          => 'Appointment Cancelled',
            'message'        => 'Your appointment #' . $this->appointment->appointment_number . ' has been cancelled.',
            'type'           => 'appointment_cancelled',
            'url'            => '/client/appointments',
            'appointment_id' => $this->appointment->id,
        ];
    }
}
