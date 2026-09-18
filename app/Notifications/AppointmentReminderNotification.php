<?php

namespace App\Notifications;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentReminderNotification extends Notification
{
    use Queueable;

    public function __construct(public Appointment $appointment, public ?string $customMessage = null) {}

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

        $clientName    = $this->appointment->client?->name ?? 'Valued Client';
        $serviceName   = $this->appointment->service?->name ?? 'Accounting & Tax Consultation';
        $dateFormatted = $this->appointment->date ? $this->appointment->date->format('l, F j, Y') : 'Scheduled Date';
        $timeFormatted = $this->appointment->time ? date('g:i A', strtotime($this->appointment->time)) . ' EST' : 'Scheduled Time';
        $advisorName   = $this->appointment->accountant?->name ?? 'YONBUS Practice Advisor';

        $isStaff = in_array($notifiable->role ?? '', ['admin', 'superadmin', 'subadmin', 'accountant'])
            || ($notifiable->id !== $this->appointment->client_id);

        if ($isStaff) {
            $manageUrl = ($notifiable->role ?? '') === 'accountant'
                ? url('/accountant/appointments')
                : url('/admin/appointments');

            $mail = (new MailMessage)
                ->subject("Upcoming Appointment Reminder: {$serviceName} (#{$this->appointment->appointment_number})")
                ->greeting('Hello ' . ($notifiable->name ?? 'Advisor') . ',')
                ->line("This is a reminder for your upcoming consultation with **{$clientName}**.")
                ->line('**Reference Number:** ' . $this->appointment->appointment_number)
                ->line('**Client:** ' . $clientName)
                ->line('**Service:** ' . $serviceName)
                ->line('**Scheduled Date:** ' . $dateFormatted)
                ->line('**Scheduled Time:** ' . $timeFormatted);

            if ($this->appointment->notes) {
                $mail->line('**Client Notes:** ' . $this->appointment->notes);
            }

            return $mail
                ->action('View Appointment in Portal', $manageUrl)
                ->salutation('YONBUS Tax & Accounting Services Inc.');
        }

        // Client Email
        $mail = (new MailMessage)
            ->subject("Appointment Reminder: {$serviceName} (#{$this->appointment->appointment_number})")
            ->greeting('Hello ' . ($notifiable->first_name ?? $notifiable->name ?? 'Valued Client') . ',')
            ->line('This is a friendly reminder that your upcoming consultation with **YONBUS Tax & Accounting Services Inc.** is scheduled in approximately **1 hour and 30 minutes**.')
            ->line('**Reference Number:** ' . $this->appointment->appointment_number)
            ->line('**Service:** ' . $serviceName)
            ->line('**Scheduled Date:** ' . $dateFormatted)
            ->line('**Scheduled Time:** ' . $timeFormatted)
            ->line('**Assigned Advisor:** ' . $advisorName);

        if ($this->customMessage) {
            $mail->line('**Special Note from Advisor:** ' . $this->customMessage);
        }

        return $mail
            ->action('Access Client Portal & Appointment Details', url('/client/appointments'))
            ->line('If you need to reschedule or prepare your tax/accounting slips prior to the session, please log into your client dashboard.')
            ->salutation("Warm regards,  \nYONBUS Tax & Accounting Services Inc.");
    }

    public function toDatabase(object $notifiable): array
    {
        $this->appointment->loadMissing(['client', 'service', 'accountant']);

        $clientName    = $this->appointment->client?->name ?? 'Client';
        $serviceName   = $this->appointment->service?->name ?? 'Consultation';
        $dateFormatted = $this->appointment->date ? $this->appointment->date->format('M j, Y') : 'Upcoming';
        $timeFormatted = $this->appointment->time ? date('g:i A', strtotime($this->appointment->time)) . ' EST' : '';

        $isStaff = in_array($notifiable->role ?? '', ['admin', 'superadmin', 'subadmin', 'accountant'])
            || ($notifiable->id !== $this->appointment->client_id);

        if ($isStaff) {
            $manageUrl = ($notifiable->role ?? '') === 'accountant'
                ? '/accountant/appointments'
                : '/admin/appointments';

            return [
                'title'          => 'Appointment Reminder',
                'message'        => "Reminder: Consultation with {$clientName} for {$serviceName} (#{$this->appointment->appointment_number}) is in 1 hour 30 minutes ({$dateFormatted} at {$timeFormatted}).",
                'type'           => 'appointment_reminder',
                'url'            => $manageUrl,
                'appointment_id' => $this->appointment->id,
            ];
        }

        return [
            'title'          => 'Appointment Reminder',
            'message'        => "Reminder: Your {$serviceName} appointment (#{$this->appointment->appointment_number}) is in 1 hour 30 minutes ({$dateFormatted} at {$timeFormatted}).",
            'type'           => 'appointment_reminder',
            'url'            => '/client/appointments',
            'appointment_id' => $this->appointment->id,
        ];
    }
}
