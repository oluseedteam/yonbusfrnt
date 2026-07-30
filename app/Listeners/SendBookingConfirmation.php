<?php

namespace App\Listeners;

use App\Events\AppointmentBooked;
use App\Notifications\AppointmentBookedNotification;
use App\Services\AuditService;

class SendBookingConfirmation
{
    public function handle(AppointmentBooked $event): void
    {
        $appointment = $event->appointment->load(['client', 'accountant']);

        // Notify the client
        if ($appointment->client) {
            $appointment->client->notify(new AppointmentBookedNotification($appointment));
        }

        // Notify the assigned accountant
        if ($appointment->accountant) {
            $appointment->accountant->notify(new AppointmentBookedNotification($appointment));
        }

        AuditService::log(
            'appointment.booked',
            "Appointment #{$appointment->appointment_number} booked",
            'Appointment',
            $appointment->id
        );
    }
}
