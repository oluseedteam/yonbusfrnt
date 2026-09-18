<?php

namespace Tests\Feature;

use App\Events\AppointmentBooked;
use App\Jobs\SendAppointmentReminderJob;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use App\Notifications\AppointmentReminderNotification;
use Database\Seeders\AdminAccountsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class AppointmentReminderDashboardAndEmailTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected User $client;
    protected Service $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(AdminAccountsSeeder::class);
        $this->admin = User::where('email', 'olubukunola@yonbustax.ca')->firstOrFail();

        $this->client = User::factory()->create([
            'first_name'        => 'Test',
            'last_name'         => 'Client',
            'email'             => 'client@example.com',
            'role'              => 'client',
            'assigned_admin_id' => $this->admin->id,
            'is_active'         => true,
            'email_verified_at' => now(),
        ]);
        $this->client->assignRole('client');

        $this->service = Service::create([
            'name'        => 'Corporate Tax Consultation',
            'description' => 'Comprehensive tax advisory',
            'price'       => 200.00,
            'duration'    => 45,
            'is_active'   => true,
        ]);
    }

    public function test_reminder_notification_targets_both_database_and_mail(): void
    {
        $appt = Appointment::create([
            'client_id'     => $this->client->id,
            'accountant_id' => $this->admin->id,
            'service_id'    => $this->service->id,
            'date'          => now()->addDay()->toDateString(),
            'time'          => '14:00:00',
            'status'        => 'confirmed',
        ]);

        $notification = new AppointmentReminderNotification($appt);
        $channels = $notification->via($this->client);

        $this->assertContains('database', $channels, 'Reminder must target database (dashboard notification)');
        $this->assertContains('mail', $channels, 'Reminder must target mail (email notification)');
    }

    public function test_reminder_creates_database_notification_for_client_dashboard(): void
    {
        $appt = Appointment::create([
            'client_id'     => $this->client->id,
            'accountant_id' => $this->admin->id,
            'service_id'    => $this->service->id,
            'date'          => now()->addDay()->toDateString(),
            'time'          => '14:00:00',
            'status'        => 'confirmed',
        ]);

        $this->client->notify(new AppointmentReminderNotification($appt));

        $this->assertDatabaseHas('notifications', [
            'notifiable_type' => User::class,
            'notifiable_id'   => $this->client->id,
            'type'            => AppointmentReminderNotification::class,
        ]);

        $savedNotif = $this->client->notifications()->first();
        $this->assertNotNull($savedNotif);
        $this->assertEquals('Appointment Reminder', $savedNotif->data['title']);
        $this->assertEquals('/client/appointments', $savedNotif->data['url']);
        $this->assertEquals($appt->id, $savedNotif->data['appointment_id']);
        $this->assertStringContainsString($appt->appointment_number, $savedNotif->data['message']);
        $this->assertStringContainsString($this->service->name, $savedNotif->data['message']);
    }

    public function test_reminder_email_content_and_custom_message(): void
    {
        $appt = Appointment::create([
            'client_id'     => $this->client->id,
            'accountant_id' => $this->admin->id,
            'service_id'    => $this->service->id,
            'date'          => now()->addDay()->toDateString(),
            'time'          => '14:00:00',
            'status'        => 'confirmed',
        ]);

        $customNote = 'Please have your CRA Notice of Assessment ready.';
        $notification = new AppointmentReminderNotification($appt, $customNote);
        $mail = $notification->toMail($this->client);

        $this->assertStringContainsString('Appointment Reminder', $mail->subject);
        $this->assertStringContainsString($appt->appointment_number, $mail->subject);

        $rendered = $mail->render();
        $this->assertStringContainsString($appt->appointment_number, (string) $rendered);
        $this->assertStringContainsString($this->service->name, (string) $rendered);
        $this->assertStringContainsString($this->admin->name, (string) $rendered);
        $this->assertStringContainsString($customNote, (string) $rendered);
        $this->assertStringContainsString(url('/client/appointments'), (string) $rendered);
    }

    public function test_booking_appointment_dispatches_1h30m_reminder_job(): void
    {
        Queue::fake();

        $appt = Appointment::create([
            'client_id'     => $this->client->id,
            'accountant_id' => $this->admin->id,
            'service_id'    => $this->service->id,
            'date'          => now(config('app.timezone'))->addDays(2)->toDateString(),
            'time'          => '14:00:00',
            'status'        => 'pending',
        ]);

        event(new AppointmentBooked($appt));

        Queue::assertPushed(SendAppointmentReminderJob::class, function ($job) use ($appt) {
            return $job->appointmentId === $appt->id;
        });
    }

    public function test_reminder_job_sends_notification_to_client_and_advisor(): void
    {
        Notification::fake();

        $appt = Appointment::create([
            'client_id'     => $this->client->id,
            'accountant_id' => $this->admin->id,
            'service_id'    => $this->service->id,
            'date'          => now(config('app.timezone'))->toDateString(),
            'time'          => now(config('app.timezone'))->addMinutes(90)->format('H:i:s'),
            'status'        => 'confirmed',
        ]);

        (new SendAppointmentReminderJob($appt->id))->handle();

        Notification::assertSentTo($this->client, AppointmentReminderNotification::class, function ($n) use ($appt) {
            return $n->appointment->id === $appt->id;
        });

        Notification::assertSentTo($this->admin, AppointmentReminderNotification::class, function ($n) use ($appt) {
            return $n->appointment->id === $appt->id;
        });

        $appt->refresh();
        $this->assertNotNull($appt->reminder_sent_at);
    }

    public function test_automated_command_finds_and_reminds_upcoming_appointments_in_1h30m_window(): void
    {
        Notification::fake();

        // Appointment scheduled within 90 minutes (e.g. 75 minutes from now)
        $apptSoon = Appointment::create([
            'client_id'     => $this->client->id,
            'accountant_id' => $this->admin->id,
            'service_id'    => $this->service->id,
            'date'          => now(config('app.timezone'))->toDateString(),
            'time'          => now(config('app.timezone'))->addMinutes(75)->format('H:i:s'),
            'status'        => 'confirmed',
        ]);

        // Appointment scheduled for tomorrow (more than 90 minutes away, should NOT be reminded yet)
        $apptTomorrow = Appointment::create([
            'client_id'     => $this->client->id,
            'accountant_id' => $this->admin->id,
            'service_id'    => $this->service->id,
            'date'          => now(config('app.timezone'))->addDay()->toDateString(),
            'time'          => '10:00:00',
            'status'        => 'confirmed',
        ]);

        // Appointment scheduled for next week (should NOT be reminded yet)
        $apptNextWeek = Appointment::create([
            'client_id'     => $this->client->id,
            'accountant_id' => $this->admin->id,
            'service_id'    => $this->service->id,
            'date'          => now(config('app.timezone'))->addDays(7)->toDateString(),
            'time'          => '10:00:00',
            'status'        => 'confirmed',
        ]);

        $this->artisan('appointments:send-reminders')
            ->expectsOutputToContain('Found 1 appointment(s) needing reminders')
            ->assertSuccessful();

        Notification::assertSentTo($this->client, AppointmentReminderNotification::class, function ($n) use ($apptSoon) {
            return $n->appointment->id === $apptSoon->id;
        });

        Notification::assertNotSentTo($this->client, AppointmentReminderNotification::class, function ($n) use ($apptTomorrow) {
            return $n->appointment->id === $apptTomorrow->id;
        });

        Notification::assertNotSentTo($this->client, AppointmentReminderNotification::class, function ($n) use ($apptNextWeek) {
            return $n->appointment->id === $apptNextWeek->id;
        });

        $apptSoon->refresh();
        $this->assertNotNull($apptSoon->reminder_sent_at);
    }

    public function test_automated_command_skips_already_reminded_appointments(): void
    {
        Notification::fake();

        $appt = Appointment::create([
            'client_id'        => $this->client->id,
            'accountant_id'    => $this->admin->id,
            'service_id'       => $this->service->id,
            'date'             => now(config('app.timezone'))->toDateString(),
            'time'             => now(config('app.timezone'))->addMinutes(75)->format('H:i:s'),
            'status'           => 'confirmed',
            'reminder_sent_at' => now()->subHours(2),
        ]);

        $this->artisan('appointments:send-reminders')
            ->expectsOutputToContain('No appointments need reminders at this time.')
            ->assertSuccessful();

        Notification::assertNothingSent();

        // With --force, it should send even if reminded recently
        $this->artisan('appointments:send-reminders --force')
            ->expectsOutputToContain('Found 1 appointment(s) needing reminders')
            ->assertSuccessful();

        Notification::assertSentTo($this->client, AppointmentReminderNotification::class);
    }

    public function test_admin_appointment_manager_send_reminder(): void
    {
        Notification::fake();

        $appt = Appointment::create([
            'client_id'     => $this->client->id,
            'accountant_id' => $this->admin->id,
            'service_id'    => $this->service->id,
            'date'          => now()->addDays(2)->toDateString(),
            'time'          => '11:00:00',
            'status'        => 'confirmed',
        ]);

        $component = new \App\Livewire\Admin\AppointmentManager();
        $component->reminderId = $appt->id;
        $component->reminderCustomMessage = 'Please bring passport.';
        $component->sendReminder();

        Notification::assertSentTo($this->client, AppointmentReminderNotification::class, function ($n) use ($appt) {
            return $n->appointment->id === $appt->id && $n->customMessage === 'Please bring passport.';
        });

        $appt->refresh();
        $this->assertNotNull($appt->reminder_sent_at);
    }

    public function test_accountant_appointment_manager_send_reminder(): void
    {
        Notification::fake();

        $this->actingAs($this->admin);

        $appt = Appointment::create([
            'client_id'     => $this->client->id,
            'accountant_id' => $this->admin->id,
            'service_id'    => $this->service->id,
            'date'          => now()->addDays(2)->toDateString(),
            'time'          => '11:00:00',
            'status'        => 'confirmed',
        ]);

        $component = new \App\Livewire\Accountant\AppointmentManager();
        $component->sendReminder($appt->id);

        Notification::assertSentTo($this->client, AppointmentReminderNotification::class, function ($n) use ($appt) {
            return $n->appointment->id === $appt->id;
        });

        $appt->refresh();
        $this->assertNotNull($appt->reminder_sent_at);
    }
}
