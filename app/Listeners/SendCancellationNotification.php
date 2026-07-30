<?php

namespace App\Listeners;

use App\Events\AppointmentCancelled;
use App\Notifications\AppointmentCancelledNotification;
use App\Services\AuditService;

class SendCancellationNotification
{
    public function handle(AppointmentCancelled $event): void
    {
        $appointment = $event->appointment->load('client');

        if ($appointment->client) {
            $appointment->client->notify(new AppointmentCancelledNotification($appointment));
        }

        AuditService::log('appointment.cancelled', "Appointment #{$appointment->appointment_number} cancelled", 'Appointment', $appointment->id);
    }
}
