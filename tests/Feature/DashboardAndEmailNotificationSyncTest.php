<?php

namespace Tests\Feature;

use App\Events\AppointmentBooked;
use App\Events\AppointmentCancelled;
use App\Events\AppointmentConfirmed;
use App\Models\Appointment;
use App\Models\Document;
use App\Models\Invoice;
use App\Models\Message;
use App\Models\Service;
use App\Models\User;
use App\Notifications\AppointmentBookedNotification;
use App\Notifications\AppointmentCancelledNotification;
use App\Notifications\AppointmentConfirmedNotification;
use App\Notifications\AppointmentReminderNotification;
use App\Notifications\ContactInquiryReceivedNotification;
use App\Notifications\DocumentDeliveredToClientNotification;
use App\Notifications\DocumentUploadedNotification;
use App\Notifications\InvoiceCreatedNotification;
use App\Notifications\NewMessageNotification;
use App\Notifications\ServiceRequestUpdatedNotification;
use App\Notifications\TaxReturnStatusNotification;
use App\Notifications\WelcomeClientNotification;
use Database\Seeders\AdminAccountsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class DashboardAndEmailNotificationSyncTest extends TestCase
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
            'first_name'        => 'Amara',
            'last_name'         => 'Okafor',
            'email'             => 'amara.okafor@example.com',
            'role'              => 'client',
            'assigned_admin_id' => $this->admin->id,
            'is_active'         => true,
            'email_verified_at' => now(),
        ]);
        $this->client->assignRole('client');

        $this->service = Service::create([
            'name'        => 'Personal Tax Return',
            'description' => 'Comprehensive filing',
            'price'       => 150.00,
            'duration'    => 45,
            'is_active'   => true,
        ]);
    }

    public function test_all_notifications_target_both_database_and_mail_channels(): void
    {
        $appt = Appointment::create([
            'client_id'     => $this->client->id,
            'accountant_id' => $this->admin->id,
            'service_id'    => $this->service->id,
            'date'          => now()->addDays(2)->format('Y-m-d'),
            'time'          => '10:00:00',
            'status'        => 'pending',
        ]);

        $doc = Document::create([
            'client_id'         => $this->client->id,
            'uploaded_by'       => $this->client->id,
            'assigned_admin_id' => $this->admin->id,
            'type'              => 't4_t5',
            'original_name'     => 't4_slip.pdf',
            'stored_name'       => 'documents/t4_slip.pdf',
            'file_type'         => 'application/pdf',
            'file_size'         => 1024,
            'version'           => 1,
        ]);

        $inv = Invoice::create([
            'invoice_number' => 'INV-2026-0001',
            'client_id'      => $this->client->id,
            'accountant_id'  => $this->admin->id,
            'amount'         => 150.00,
            'tax'            => 19.50,
            'total_amount'   => 169.50,
            'issued_date'    => now()->toDateString(),
            'due_date'       => now()->addDays(30)->toDateString(),
            'status'         => 'pending',
        ]);

        $msg = Message::create([
            'sender_id'   => $this->client->id,
            'receiver_id' => $this->admin->id,
            'body'        => 'Hello YONBUS team',
        ]);

        $notifications = [
            new AppointmentBookedNotification($appt),
            new AppointmentConfirmedNotification($appt),
            new AppointmentCancelledNotification($appt),
            new AppointmentReminderNotification($appt),
            new DocumentUploadedNotification($doc),
            new DocumentDeliveredToClientNotification($doc),
            new WelcomeClientNotification(),
            new NewMessageNotification($msg),
            new InvoiceCreatedNotification($inv),
        ];

        foreach ($notifications as $notification) {
            $channels = $notification->via($this->client);
            $this->assertContains('database', $channels, get_class($notification) . ' must include database channel');
            $this->assertContains('mail', $channels, get_class($notification) . ' must include mail channel');

            $channelsAdmin = $notification->via($this->admin);
            $this->assertContains('database', $channelsAdmin, get_class($notification) . ' must include database channel for admin');
            $this->assertContains('mail', $channelsAdmin, get_class($notification) . ' must include mail channel for admin');
        }
    }

    public function test_booking_appointment_notifies_both_client_and_admin(): void
    {
        Notification::fake();

        $appt = Appointment::create([
            'client_id'     => $this->client->id,
            'accountant_id' => $this->admin->id,
            'service_id'    => $this->service->id,
            'date'          => now()->addDays(3)->format('Y-m-d'),
            'time'          => '11:00:00',
            'status'        => 'pending',
        ]);

        event(new AppointmentBooked($appt));

        Notification::assertSentTo($this->client, AppointmentBookedNotification::class);
        Notification::assertSentTo($this->admin, AppointmentBookedNotification::class);
    }

    public function test_confirming_appointment_notifies_both_client_and_admin(): void
    {
        Notification::fake();

        $appt = Appointment::create([
            'client_id'     => $this->client->id,
            'accountant_id' => $this->admin->id,
            'service_id'    => $this->service->id,
            'date'          => now()->addDays(3)->format('Y-m-d'),
            'time'          => '11:00:00',
            'status'        => 'confirmed',
        ]);

        event(new AppointmentConfirmed($appt));

        Notification::assertSentTo($this->client, AppointmentConfirmedNotification::class);
        Notification::assertSentTo($this->admin, AppointmentConfirmedNotification::class);
    }

    public function test_cancelling_appointment_notifies_both_client_and_admin(): void
    {
        Notification::fake();

        $appt = Appointment::create([
            'client_id'     => $this->client->id,
            'accountant_id' => $this->admin->id,
            'service_id'    => $this->service->id,
            'date'          => now()->addDays(3)->format('Y-m-d'),
            'time'          => '11:00:00',
            'status'        => 'cancelled',
        ]);

        event(new AppointmentCancelled($appt));

        Notification::assertSentTo($this->client, AppointmentCancelledNotification::class);
        Notification::assertSentTo($this->admin, AppointmentCancelledNotification::class);
    }

    public function test_document_delivery_notifies_client_in_database_and_mail(): void
    {
        Notification::fake();

        $doc = Document::create([
            'client_id'         => $this->client->id,
            'uploaded_by'       => $this->admin->id,
            'assigned_admin_id' => $this->admin->id,
            'type'              => 'notice_of_assessment',
            'original_name'     => 'NOA_2025.pdf',
            'stored_name'       => 'documents/NOA_2025.pdf',
            'file_type'         => 'application/pdf',
            'file_size'         => 2048,
            'version'           => 1,
        ]);

        $this->client->notify(new DocumentDeliveredToClientNotification($doc));

        Notification::assertSentTo($this->client, DocumentDeliveredToClientNotification::class, function ($notification) {
            $channels = $notification->via($this->client);
            return in_array('database', $channels) && in_array('mail', $channels);
        });
    }

    public function test_user_preferences_synchronize_columns(): void
    {
        $this->client->update(['email_notifications' => false]);
        $this->client->refresh();
        $this->assertFalse((bool) $this->client->email_notifications);
        $this->assertFalse((bool) $this->client->notification_email);

        $this->client->update(['notification_email' => true]);
        $this->client->refresh();
        $this->assertTrue((bool) $this->client->notification_email);
        $this->assertTrue((bool) $this->client->email_notifications);
    }
}
