<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

class SendAppointmentRemindersCommand extends Command
{
    protected $signature = 'appointments:send-reminders {--force : Force send even if already sent} {--window=90 : Window in minutes before appointment time} {--all : Process all appointments today/tomorrow regardless of 90m window}';
    protected $description = 'Send automated appointment reminders (dashboard notification and email) when it is 1hr 30min to appointment time.';

    public function handle(): int
    {
        $this->info('Checking for upcoming appointments to remind (1h 30m window)...');

        $now = now(config('app.timezone'));
        $today = $now->toDateString();
        $tomorrow = $now->copy()->addDay()->toDateString();
        $force = (bool) $this->option('force');
        $all = (bool) $this->option('all');
        $windowMinutes = (int) ($this->option('window') ?? 90);

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

        $candidates = $query->get();

        // Filter to appointments within the 1hr 30min window unless --all is specified
        $appointments = $all ? $candidates : $candidates->filter(function ($appt) use ($now, $windowMinutes) {
            $scheduledAt = $appt->scheduledAt();
            return $scheduledAt->greaterThan($now->copy()->subMinutes(15))
                && $scheduledAt->lessThanOrEqualTo($now->copy()->addMinutes($windowMinutes));
        });

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
