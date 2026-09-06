<?php

namespace App\Notifications;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentConfirmedNotification extends Notification
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
        $this->appointment->loadMissing(['client', 'service', 'accountant']);
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
                ->subject("Appointment Confirmed — #{$this->appointment->appointment_number} ({$clientName})")
                ->greeting('Hello ' . ($notifiable->name ?? 'Advisor') . ',')
                ->line("The appointment with **{$clientName}** has been confirmed.")
                ->line('**Reference:** ' . $this->appointment->appointment_number)
                ->line('**Client:** ' . $clientName)
                ->line('**Service:** ' . $serviceName)
                ->line('**Scheduled Date:** ' . $dateStr)
                ->line('**Scheduled Time:** ' . $timeStr)
                ->action('View Appointment Details', $manageUrl);
        }

        return (new MailMessage)
            ->subject('Appointment Confirmed — #' . $this->appointment->appointment_number)
            ->greeting('Hello ' . ($notifiable->first_name ?? $notifiable->name ?? 'Valued Client') . ',')
            ->line('Your consultation appointment has been confirmed by our team.')
            ->line('**Reference:** ' . $this->appointment->appointment_number)
            ->line('**Service:** ' . $serviceName)
            ->line('**Scheduled Date:** ' . $dateStr)
            ->line('**Scheduled Time:** ' . $timeStr)
            ->when($this->appointment->accountant, function ($mail) {
                return $mail->line('**Assigned Advisor:** ' . ($this->appointment->accountant->name ?? 'YONBUS Specialist'));
            })
            ->action('Access Client Portal & Video Room', url('/client/appointments'))
            ->line('Thank you for choosing YONBUS Tax & Accounting Services.');
    }

    public function toDatabase(object $notifiable): array
    {
        $this->appointment->loadMissing(['client', 'service']);
        $clientName = $this->appointment->client->name ?? 'Client';
        $dateStr    = $this->appointment->date ? (is_string($this->appointment->date) ? $this->appointment->date : $this->appointment->date->format('Y-m-d')) : 'TBD';
        $timeStr    = $this->appointment->time ? date('g:i A', strtotime($this->appointment->time)) : 'TBD';

        $isStaff = in_array($notifiable->role ?? '', ['admin', 'superadmin', 'subadmin', 'accountant'])
            || ($notifiable->id !== $this->appointment->client_id);

        if ($isStaff) {
            $manageUrl = ($notifiable->role ?? '') === 'accountant'
                ? '/accountant/appointments'
                : '/admin/appointments';

            return [
                'title'          => 'Appointment Confirmed',
                'message'        => "Appointment #{$this->appointment->appointment_number} with {$clientName} is confirmed for {$dateStr} at {$timeStr}.",
                'type'           => 'appointment_confirmed',
                'url'            => $manageUrl,
                'appointment_id' => $this->appointment->id,
            ];
        }

        return [
            'title'          => 'Appointment Confirmed',
            'message'        => "Your appointment #{$this->appointment->appointment_number} has been confirmed for {$dateStr} at {$timeStr}.",
            'type'           => 'appointment_confirmed',
            'url'            => '/client/appointments',
            'appointment_id' => $this->appointment->id,
        ];
    }
}
