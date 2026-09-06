<?php

namespace App\Listeners;

use App\Events\AppointmentCancelled;
use App\Models\User;
use App\Notifications\AppointmentCancelledNotification;
use App\Services\AuditService;
use Illuminate\Support\Facades\Log;

class SendCancellationNotification
{
    public function handle(AppointmentCancelled $event): void
    {
        $appointment = $event->appointment->load(['client', 'accountant']);

        // Notify client
        if ($appointment->client) {
            try {
                $appointment->client->notify(new AppointmentCancelledNotification($appointment));
            } catch (\Throwable $e) {
                Log::warning("Failed to notify client {$appointment->client->email} of cancellation: " . $e->getMessage());
            }
        }

        // Notify staff (assigned accountant or admins)
        $staffToNotify = collect();
        if ($appointment->accountant) {
            $staffToNotify->push($appointment->accountant);
        } else {
            $admins = User::whereIn('role', ['admin', 'superadmin'])->where('is_active', true)->get();
            $staffToNotify = $staffToNotify->merge($admins);
        }

        foreach ($staffToNotify->unique('id') as $staff) {
            try {
                $staff->notify(new AppointmentCancelledNotification($appointment));
            } catch (\Throwable $e) {
                Log::warning("Failed to notify staff {$staff->email} of cancellation: " . $e->getMessage());
            }
        }

        AuditService::log('appointment.cancelled', "Appointment #{$appointment->appointment_number} cancelled", 'Appointment', $appointment->id);
    }
}
