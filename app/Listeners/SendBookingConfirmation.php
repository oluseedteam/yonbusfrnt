<?php

namespace App\Listeners;

use App\Events\AppointmentBooked;
use App\Models\User;
use App\Notifications\AppointmentBookedNotification;
use App\Services\AuditService;
use Illuminate\Support\Facades\Log;

class SendBookingConfirmation
{
    public function handle(AppointmentBooked $event): void
    {
        $appointment = $event->appointment->load(['client', 'accountant']);

        // Notify the client
        if ($appointment->client) {
            try {
                $appointment->client->notify(new AppointmentBookedNotification($appointment));
            } catch (\Throwable $e) {
                Log::warning("Failed to notify client {$appointment->client->email} of booking: " . $e->getMessage());
            }
        }

        // Notify the assigned accountant, or fallback to all active admins if none assigned
        $staffToNotify = collect();
        if ($appointment->accountant) {
            $staffToNotify->push($appointment->accountant);
        } else {
            $admins = User::whereIn('role', ['admin', 'superadmin'])->where('is_active', true)->get();
            $staffToNotify = $staffToNotify->merge($admins);
        }

        foreach ($staffToNotify->unique('id') as $staff) {
            try {
                $staff->notify(new AppointmentBookedNotification($appointment));
            } catch (\Throwable $e) {
                Log::warning("Failed to notify staff {$staff->email} of booking: " . $e->getMessage());
            }
        }

        AuditService::log(
            'appointment.booked',
            "Appointment #{$appointment->appointment_number} booked",
            'Appointment',
            $appointment->id
        );
    }
}
