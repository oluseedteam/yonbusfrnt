<?php

namespace App\Notifications;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentConfirmedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Appointment $appointment) {}

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
            ->subject('Appointment Confirmed — ' . $this->appointment->appointment_number)
            ->greeting('Hello ' . $notifiable->first_name . ',')
            ->line('Your appointment has been confirmed by our team.')
            ->line('**Reference:** ' . $this->appointment->appointment_number)
            ->line('**Date:** ' . $this->appointment->date)
            ->line('**Time:** ' . $this->appointment->time)
            ->action('View Appointment', url('/client/appointments'));
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title'   => 'Appointment Confirmed',
            'message' => 'Your appointment #' . $this->appointment->appointment_number . ' has been confirmed.',
            'type'    => 'appointment_confirmed',
            'url'     => '/client/appointments',
            'appointment_id' => $this->appointment->id,
        ];
    }
}
