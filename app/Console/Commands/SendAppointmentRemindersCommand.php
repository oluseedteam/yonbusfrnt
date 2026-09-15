<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

class SendAppointmentRemindersCommand extends Command
{
    protected $signature = 'appointments:send-reminders {--force : Force send even if already sent today}';
    protected $description = 'Send automated appointment reminders (dashboard notification and email) for upcoming consultations.';

    public function handle(): int
    {
        $this->info('Checking for upcoming appointments to remind...');

        $today = now()->toDateString();
        $tomorrow = now()->addDay()->toDateString();
        $force = (bool) $this->option('force');

        // Find confirmed and pending appointments for today or tomorrow
        $query = \App\Models\Appointment::with(['client', 'service', 'accountant'])
            ->where(function ($q) use ($today, $tomorrow) {
                $q->whereDate('date', $today)
                  ->orWhereDate('date', $tomorrow);
            })
            ->whereIn('status', ['confirmed', 'pending']);

        if (!$force) {
            $query->where(function ($q) {
                $q->whereNull('reminder_sent_at')
                  ->orWhere('reminder_sent_at', '<', now()->subHours(18));
            });
        }

        $appointments = $query->get();

        if ($appointments->isEmpty()) {
            $this->info('No appointments need reminders at this time.');
            return Command::SUCCESS;
        }

        $this->info("Found {$appointments->count()} appointment(s) needing reminders.");
        $successCount = 0;
        $failCount = 0;

        foreach ($appointments as $appt) {
            try {
                $client = $appt->client;
                if ($client) {
                    $client->notify(new \App\Notifications\AppointmentReminderNotification($appt));
                    $this->line("  ✓ Reminded client: {$client->name} ({$client->email}) for appointment #{$appt->appointment_number}");
                }

                // Also notify assigned accountant if assigned and not developer
                if ($appt->accountant && !$appt->accountant->isDeveloper()) {
                    $appt->accountant->notify(new \App\Notifications\AppointmentReminderNotification($appt));
                    $this->line("  ✓ Reminded advisor: {$appt->accountant->name} ({$appt->accountant->email}) for appointment #{$appt->appointment_number}");
                }

                $appt->update(['reminder_sent_at' => now()]);
                $successCount++;
            } catch (\Throwable $e) {
                $failCount++;
                $this->error("  ✗ Failed reminder for appointment #{$appt->appointment_number}: " . $e->getMessage());
                \Illuminate\Support\Facades\Log::error("Appointment reminder failed for #{$appt->appointment_number}: " . $e->getMessage());
            }
        }

        $this->info("Completed: {$successCount} sent successfully, {$failCount} failed.");
        return Command::SUCCESS;
    }
}
