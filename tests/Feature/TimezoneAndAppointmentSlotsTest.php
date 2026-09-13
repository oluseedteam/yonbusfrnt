<?php

namespace Tests\Feature;

use App\Livewire\Client\AppointmentManager as ClientAppointmentManager;
use App\Livewire\Public\BookingSystem;
use App\Models\User;
use App\Services\AppointmentService;
use Database\Seeders\AdminAccountsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class TimezoneAndAppointmentSlotsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(AdminAccountsSeeder::class);
    }

    public function test_application_timezone_is_configured_to_eastern_time(): void
    {
        $timezone = config('app.timezone');
        $this->assertContains($timezone, ['America/Toronto', 'America/New_York', 'EST', 'EST5EDT']);
        
        $carbonTz = now()->timezone->getName();
        $this->assertContains($carbonTz, ['America/Toronto', 'America/New_York', 'EST', 'EST5EDT']);
    }

    public function test_appointment_slots_include_est_timezone_metadata(): void
    {
        $service = app(AppointmentService::class);
        $nextMonday = now()->next(\Carbon\Carbon::MONDAY)->format('Y-m-d');
        
        $slots = $service->getAvailableSlots(null, $nextMonday, 45);

        $this->assertNotEmpty($slots);
        foreach ($slots as $slot) {
            $this->assertEquals('EST', $slot['timezone']);
            $this->assertStringEndsWith('EST', $slot['formatted_tz']);
        }
    }

    public function test_client_appointment_manager_displays_est_badge_and_slots(): void
    {
        $client = User::factory()->create([
            'email'             => 'client.est@example.ca',
            'role'              => 'client',
            'is_active'         => true,
            'email_verified_at' => now(),
        ]);
        $client->assignRole('client');

        $nextMonday = now()->next(\Carbon\Carbon::MONDAY)->format('Y-m-d');

        Livewire::actingAs($client)
            ->test(ClientAppointmentManager::class)
            ->call('openModal')
            ->set('date', $nextMonday)
            ->assertSee('Available Time Slots')
            ->assertSee('EST');
    }

    public function test_public_booking_system_displays_est_badge(): void
    {
        $nextMonday = now()->next(\Carbon\Carbon::MONDAY)->format('Y-m-d');

        Livewire::test(BookingSystem::class)
            ->set('step', 2)
            ->set('appointment_date', $nextMonday)
            ->assertSee('Select Consultation Time Slot')
            ->assertSee('EST');
    }
}
