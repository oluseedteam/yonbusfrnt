<?php

namespace App\Notifications;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentBookedNotification extends Notification
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
        $clientEmail = $this->appointment->client->email ?? 'N/A';
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
                ->subject("New Appointment Booked — #{$this->appointment->appointment_number} ({$clientName})")
                ->greeting('Hello ' . ($notifiable->name ?? 'Team') . ',')
                ->line("A new consultation appointment has been booked by **{$clientName}**.")
                ->line('**Reference:** ' . $this->appointment->appointment_number)
                ->line('**Client:** ' . $clientName . " ({$clientEmail})")
                ->line('**Service:** ' . $serviceName)
                ->line('**Scheduled Date:** ' . $dateStr)
                ->line('**Scheduled Time:** ' . $timeStr)
                ->action('Manage Appointment in Portal', $manageUrl)
                ->line('Please review the booking in your staff dashboard.');
        }

        return (new MailMessage)
            ->subject('Appointment Booked — #' . $this->appointment->appointment_number)
            ->greeting('Hello ' . ($notifiable->first_name ?? $notifiable->name ?? 'Valued Client') . ',')
            ->line('Your consultation appointment has been booked successfully.')
            ->line('**Reference:** ' . $this->appointment->appointment_number)
            ->line('**Service:** ' . $serviceName)
            ->line('**Scheduled Date:** ' . $dateStr)
            ->line('**Scheduled Time:** ' . $timeStr)
            ->when($this->appointment->accountant, function ($mail) {
                return $mail->line('**Assigned Advisor:** ' . ($this->appointment->accountant->name ?? 'YONBUS Specialist'));
            })
            ->action('View Appointment', url('/client/appointments'))
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
                'title'          => 'New Appointment Booked',
                'message'        => "New appointment #{$this->appointment->appointment_number} booked by {$clientName} for {$dateStr} at {$timeStr}.",
                'type'           => 'appointment_booked',
                'url'            => $manageUrl,
                'appointment_id' => $this->appointment->id,
            ];
        }

        return [
            'title'          => 'Appointment Booked',
            'message'        => "Your appointment #{$this->appointment->appointment_number} has been booked for {$dateStr} at {$timeStr}.",
            'type'           => 'appointment_booked',
            'url'            => '/client/appointments',
            'appointment_id' => $this->appointment->id,
        ];
    }
}
