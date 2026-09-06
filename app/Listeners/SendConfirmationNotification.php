<?php

namespace App\Listeners;

use App\Events\AppointmentConfirmed;
use App\Models\User;
use App\Notifications\AppointmentConfirmedNotification;
use App\Services\AuditService;
use Illuminate\Support\Facades\Log;

class SendConfirmationNotification
{
    public function handle(AppointmentConfirmed $event): void
    {
        $appointment = $event->appointment->load(['client', 'accountant']);

        // Notify client
        if ($appointment->client) {
            try {
                $appointment->client->notify(new AppointmentConfirmedNotification($appointment));
            } catch (\Throwable $e) {
                Log::warning("Failed to notify client {$appointment->client->email} of appointment confirmation: " . $e->getMessage());
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
                $staff->notify(new AppointmentConfirmedNotification($appointment));
            } catch (\Throwable $e) {
                Log::warning("Failed to notify staff {$staff->email} of appointment confirmation: " . $e->getMessage());
            }
        }

        AuditService::log('appointment.confirmed', "Appointment #{$appointment->appointment_number} confirmed", 'Appointment', $appointment->id);
    }
}
