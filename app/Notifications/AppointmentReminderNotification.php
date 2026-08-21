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
        $serviceName = $this->appointment->service->name ?? 'Accounting & Tax Consultation';
        $dateFormatted = $this->appointment->date ? $this->appointment->date->format('l, F j, Y') : 'Pending Schedule';
        $timeFormatted = $this->appointment->time ? date('g:i A', strtotime($this->appointment->time)) : 'Pending Schedule';
        $advisorName = $this->appointment->accountant->name ?? 'YONBUS Specialist';

        $mail = (new MailMessage)
            ->subject('Appointment Reminder: ' . $serviceName . ' (' . $this->appointment->appointment_number . ')')
            ->greeting('Hello ' . ($notifiable->name ?? 'Valued Client') . ',')
            ->line('This is a friendly reminder regarding your upcoming consultation with **YONBUS Tax & Accounting Services Inc.**')
            ->line('**Reference Number:** ' . $this->appointment->appointment_number)
            ->line('**Service:** ' . $serviceName)
            ->line('**Scheduled Date:** ' . $dateFormatted)
            ->line('**Scheduled Time:** ' . $timeFormatted)
            ->line('**Assigned Advisor:** ' . $advisorName);

        if ($this->customMessage) {
            $mail->line('**Special Note from Advisor:** ' . $this->customMessage);
        }

        return $mail
            ->action('Access Client Portal & Video Room', url('/client/appointments'))
            ->line('If you need to reschedule or prepare any tax/accounting slips prior to the meeting, please log into your client dashboard.')
            ->salutation('Warm regards,  \nYONBUS Tax & Accounting Services Inc.');
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title'          => 'Appointment Reminder',
            'message'        => 'Reminder for your upcoming appointment #' . $this->appointment->appointment_number . ($this->appointment->date ? ' on ' . $this->appointment->date->format('M d, Y') : ''),
            'type'           => 'appointment_reminder',
            'url'            => '/client/appointments',
            'appointment_id' => $this->appointment->id,
        ];
    }
}
