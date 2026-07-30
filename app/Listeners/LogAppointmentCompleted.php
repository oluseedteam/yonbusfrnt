<?php

namespace App\Listeners;

use App\Events\AppointmentCompleted;
use App\Services\AuditService;

class LogAppointmentCompleted
{
    public function handle(AppointmentCompleted $event): void
    {
        $appointment = $event->appointment;
        AuditService::log('appointment.completed', "Appointment #{$appointment->appointment_number} completed", 'Appointment', $appointment->id);
    }
}
