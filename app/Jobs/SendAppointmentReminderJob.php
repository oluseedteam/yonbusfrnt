<?php

namespace App\Jobs;

use App\Models\Appointment;
use App\Notifications\AppointmentReminderNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendAppointmentReminderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public int $appointmentId) {}

    public function handle(): void
    {
        $appointment = Appointment::with(['client', 'service', 'accountant'])->find($this->appointmentId);

        if (!$appointment) {
            return;
        }

        // Only send for active appointments (not cancelled or completed)
        if (in_array($appointment->status, ['cancelled', 'completed'])) {
            return;
        }

        // Avoid duplicate reminder if already sent
        if ($appointment->reminder_sent_at) {
            return;
        }

        $client = $appointment->client;
        if ($client) {
            try {
                $client->notify(new AppointmentReminderNotification($appointment));
                Log::info("1h30m appointment reminder sent to client {$client->email} for appointment #{$appointment->appointment_number}");
            } catch (\Throwable $e) {
                Log::error("Failed sending 1h30m reminder to client {$client->email}: " . $e->getMessage());
            }
        }

        // Also notify assigned accountant if assigned and not developer
        if ($appointment->accountant && !$appointment->accountant->isDeveloper()) {
            try {
                $appointment->accountant->notify(new AppointmentReminderNotification($appointment));
                Log::info("1h30m appointment reminder sent to advisor {$appointment->accountant->email} for appointment #{$appointment->appointment_number}");
            } catch (\Throwable $e) {
                Log::error("Failed sending 1h30m reminder to advisor {$appointment->accountant->email}: " . $e->getMessage());
            }
        }

        $appointment->update(['reminder_sent_at' => now()]);
    }
}
