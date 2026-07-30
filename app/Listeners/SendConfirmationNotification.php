<?php

namespace App\Listeners;

use App\Events\AppointmentConfirmed;
use App\Notifications\AppointmentConfirmedNotification;
use App\Services\AuditService;

class SendConfirmationNotification
{
    public function handle(AppointmentConfirmed $event): void
    {
        $appointment = $event->appointment->load('client');

        if ($appointment->client) {
            $appointment->client->notify(new AppointmentConfirmedNotification($appointment));
        }

        AuditService::log('appointment.confirmed', "Appointment #{$appointment->appointment_number} confirmed", 'Appointment', $appointment->id);
    }
}
