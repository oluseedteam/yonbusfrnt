<?php

namespace App\Notifications;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentCancelledNotification extends Notification implements ShouldQueue
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
            ->subject('Appointment Cancelled — ' . $this->appointment->appointment_number)
            ->greeting('Hello ' . $notifiable->first_name . ',')
            ->error()
            ->line('Your appointment #' . $this->appointment->appointment_number . ' has been cancelled.')
            ->line('Please contact us to reschedule at your convenience.')
            ->action('Book New Appointment', url('/book-appointment'));
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title'   => 'Appointment Cancelled',
            'message' => 'Your appointment #' . $this->appointment->appointment_number . ' has been cancelled.',
            'type'    => 'appointment_cancelled',
            'url'     => '/client/appointments',
            'appointment_id' => $this->appointment->id,
        ];
    }
}
