<?php

namespace Tests\Feature;

use App\Livewire\Admin\Inquiries;
use App\Livewire\Client\AppointmentManager as ClientAppointmentManager;
use App\Livewire\Public\BookingSystem;
use App\Models\Appointment;
use App\Models\CommunicationLog;
use App\Models\Service;
use App\Models\User;
use App\Services\AppointmentService;
use Database\Seeders\AdminAccountsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class AdminInquiriesAndAppointmentConflictTest extends TestCase
{
    use RefreshDatabase;

    protected User $olubukunola;
    protected User $adeshola;
    protected Service $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(AdminAccountsSeeder::class);

        $this->olubukunola = User::where('email', 'olubukunola@yonbustax.ca')->firstOrFail();
        $this->adeshola = User::where('email', 'adeshola.eniola@yonbustax.ca')->firstOrFail();

        $this->service = Service::create([
            'name'        => 'Corporate Tax Filing (T2)',
            'description' => 'Corporate tax preparation and filing.',
            'price'       => 500.00,
            'duration'    => 45,
            'is_active'   => true,
        ]);
    }

    public function test_contact_submission_and_career_application_display_on_admin_dashboard_for_both_admins(): void
    {
        Storage::fake('public');

        // 1. Submit a contact message
        $contactResponse = $this->post(route('contact.submit'), [
            'name'    => 'David Tremblay',
            'email'   => 'david.tremblay@example.ca',
            'phone'   => '+1 (514) 555-1234',
            'subject' => 'Corporate Tax Planning Inquiry',
            'message' => 'Hello, I need assistance with our Quebec corporate tax returns.',
        ]);
        $contactResponse->assertSessionHas('success');

        // 2. Submit a career application with resume
        $resume = UploadedFile::fake()->create('david_resume.pdf', 500, 'application/pdf');
        $careerResponse = $this->post(route('careers.submit'), [
            'name'       => 'Sarah O’Connor',
            'email'      => 'sarah.oconnor@example.ca',
            'phone'      => '+1 (438) 777-8899',
            'position'   => 'Senior Tax Associate',
            'experience' => '5+ years experience in Canadian tax & payroll',
            'message'    => 'I am eager to bring my CPB and T1/T2 tax expertise to YONBUS.',
            'resume'     => $resume,
        ]);
        $careerResponse->assertSessionHas('success');

        // Verify database records
        $this->assertDatabaseHas('communication_logs', [
            'email'   => 'david.tremblay@example.ca',
            'channel' => 'contact_form',
        ]);
        $this->assertDatabaseHas('communication_logs', [
            'email'   => 'sarah.oconnor@example.ca',
            'channel' => 'career_application',
        ]);

        // 3. Olubukunola logs in and views admin dashboard
        $this->actingAs($this->olubukunola);
        $dashO = $this->get(route('admin.dashboard'));
        $dashO->assertStatus(200);
        $dashO->assertSee('David Tremblay');
        $dashO->assertSee('Corporate Tax Planning Inquiry');
        $dashO->assertSee('Sarah O’Connor');
        $dashO->assertSee('Senior Tax Associate');

        Auth::logout();

        // 4. Adeshola logs in and views admin dashboard
        $this->actingAs($this->adeshola);
        $dashA = $this->get(route('admin.dashboard'));
        $dashA->assertStatus(200);
        $dashA->assertSee('David Tremblay');
        $dashA->assertSee('Corporate Tax Planning Inquiry');
        $dashA->assertSee('Sarah O’Connor');
        $dashA->assertSee('Senior Tax Associate');
    }

    public function test_admin_inquiries_livewire_component_filters_and_views_details(): void
    {
        $contact = CommunicationLog::create([
            'name'    => 'Marc Gagnon',
            'email'   => 'marc.gagnon@example.ca',
            'phone'   => '+1 (438) 123-4567',
            'subject' => 'Bookkeeping inquiry',
            'message' => 'Interested in monthly bookkeeping services.',
            'channel' => 'contact_form',
            'is_read' => false,
        ]);

        $career = CommunicationLog::create([
            'name'    => 'Chloe Martin',
            'email'   => 'chloe.martin@example.ca',
            'phone'   => '+1 (514) 987-6543',
            'subject' => 'Career Application: Junior Accountant (2 years)',
            'message' => "Candidate statement for Junior Accountant position.\n\n[Resume: career-applications/chloe_resume.pdf]",
            'channel' => 'career_application',
            'is_read' => false,
        ]);

        Livewire::actingAs($this->olubukunola)
            ->test(Inquiries::class)
            ->assertSee('Marc Gagnon')
            ->assertSee('Chloe Martin')
            // Filter to careers only
            ->set('channelFilter', 'career_application')
            ->assertSee('Chloe Martin')
            ->assertDontSee('Marc Gagnon')
            // Filter to contacts only
            ->set('channelFilter', 'contact_form')
            ->assertSee('Marc Gagnon')
            ->assertDontSee('Chloe Martin')
            // Open modal for details
            ->call('viewDetails', $career->id)
            ->assertSet('showDetailModal', true)
            ->assertSee('chloe_resume.pdf');

        $this->assertTrue($career->fresh()->is_read);
    }

    public function test_appointment_booking_locks_time_slot_and_lists_availability(): void
    {
        $targetDate = now()->addDays(2)->format('Y-m-d');
        // Ensure test date is not a Sunday
        if (\Carbon\Carbon::parse($targetDate)->isSunday()) {
            $targetDate = now()->addDays(3)->format('Y-m-d');
        }

        $serviceAppt = app(AppointmentService::class);

        // 1. Initial check: 10:30 AM is available for Olubukunola
        $slotsBefore = $serviceAppt->getAvailableSlots($this->olubukunola->id, $targetDate, 45);
        $slot1030 = collect($slotsBefore)->firstWhere('time', '10:30:00');
        $this->assertNotNull($slot1030);
        $this->assertTrue($slot1030['is_available']);

        // 2. Client A books 10:30 AM
        $clientA = User::factory()->create([
            'email'             => 'client.a@example.ca',
            'role'              => 'client',
            'assigned_admin_id' => $this->olubukunola->id,
            'is_active'         => true,
            'email_verified_at' => now(),
        ]);
        $clientA->assignRole('client');

        $bookingRes = $serviceAppt->book([
            'client_id'     => $clientA->id,
            'accountant_id' => $this->olubukunola->id,
            'service_id'    => $this->service->id,
            'date'          => $targetDate,
            'time'          => '10:30:00',
            'duration'      => 45,
            'status'        => 'confirmed',
        ]);
        $this->assertTrue($bookingRes['success']);

        // 3. Check slots again: 10:30 AM must now be BOOKED / UNAVAILABLE for Olubukunola
        $slotsAfter = $serviceAppt->getAvailableSlots($this->olubukunola->id, $targetDate, 45);
        $slot1030After = collect($slotsAfter)->firstWhere('time', '10:30:00');
        $this->assertNotNull($slot1030After);
        $this->assertFalse($slot1030After['is_available']);
        $this->assertEquals('booked', $slot1030After['status']);

        // 4. Client B attempts to book 10:30 AM for Olubukunola -> REJECTED
        $clientB = User::factory()->create([
            'email'             => 'client.b@example.ca',
            'role'              => 'client',
            'assigned_admin_id' => $this->olubukunola->id,
            'is_active'         => true,
            'email_verified_at' => now(),
        ]);
        $clientB->assignRole('client');

        $doubleBooking = $serviceAppt->book([
            'client_id'     => $clientB->id,
            'accountant_id' => $this->olubukunola->id,
            'service_id'    => $this->service->id,
            'date'          => $targetDate,
            'time'          => '10:30:00',
            'duration'      => 45,
            'status'        => 'pending',
        ]);
        $this->assertFalse($doubleBooking['success']);
        $this->assertStringContainsString('already booked', $doubleBooking['message']);

        // 5. Client B books 11:15 AM -> SUCCESS
        $validBooking = $serviceAppt->book([
            'client_id'     => $clientB->id,
            'accountant_id' => $this->olubukunola->id,
            'service_id'    => $this->service->id,
            'date'          => $targetDate,
            'time'          => '11:15:00',
            'duration'      => 45,
            'status'        => 'pending',
        ]);
        $this->assertTrue($validBooking['success']);
    }

    public function test_client_portal_appointment_manager_handles_booked_slots_and_validation(): void
    {
        $targetDate = now()->addDays(2)->format('Y-m-d');
        if (\Carbon\Carbon::parse($targetDate)->isSunday()) {
            $targetDate = now()->addDays(3)->format('Y-m-d');
        }

        $client1 = User::factory()->create([
            'email'             => 'client.one@example.ca',
            'role'              => 'client',
            'assigned_admin_id' => $this->adeshola->id,
            'is_active'         => true,
            'email_verified_at' => now(),
        ]);
        $client1->assignRole('client');

        // Existing booking at 09:00 AM for Adeshola
        Appointment::create([
            'client_id'     => $client1->id,
            'accountant_id' => $this->adeshola->id,
            'service_id'    => $this->service->id,
            'date'          => $targetDate,
            'time'          => '09:00:00',
            'duration'      => 45,
            'status'        => 'confirmed',
        ]);

        $client2 = User::factory()->create([
            'email'             => 'client.two@example.ca',
            'role'              => 'client',
            'assigned_admin_id' => $this->adeshola->id,
            'is_active'         => true,
            'email_verified_at' => now(),
        ]);
        $client2->assignRole('client');

        // Client 2 opens appointment manager and tries to select the booked 09:00 AM slot
        Livewire::actingAs($client2)
            ->test(ClientAppointmentManager::class)
            ->call('openModal')
            ->set('accountant_id', (string)$this->adeshola->id)
            ->set('date', $targetDate)
            ->call('selectTimeSlot', '09:00:00', false)
            ->assertSee('already booked');

        // Client 2 selects available 13:00 slot and saves successfully
        Livewire::actingAs($client2)
            ->test(ClientAppointmentManager::class)
            ->call('openModal')
            ->set('service_id', (string)$this->service->id)
            ->set('accountant_id', (string)$this->adeshola->id)
            ->set('date', $targetDate)
            ->call('selectTimeSlot', '13:00:00', true)
            ->call('save')
            ->assertHasNoErrors();

        $this->assertNotNull(
            Appointment::where('client_id', $client2->id)
                ->where('accountant_id', $this->adeshola->id)
                ->whereDate('date', $targetDate)
                ->where('time', '13:00:00')
                ->first()
        );
    }
}
