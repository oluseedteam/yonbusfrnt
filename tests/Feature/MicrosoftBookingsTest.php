<?php

namespace Tests\Feature;

use App\Livewire\Client\AppointmentManager;
use App\Livewire\Public\BookingSystem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class MicrosoftBookingsTest extends TestCase
{
    use RefreshDatabase;

    private const BOOKING_URL = 'https://bookings.cloud.microsoft/book/Copy@yonbustax.ca/?ismsaljsauthenabled';

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
        config(['services.microsoft_bookings.url' => self::BOOKING_URL]);
    }

    public function test_public_booking_page_uses_microsoft_instead_of_the_local_form(): void
    {
        $this->get(route('book-appointment', ['service' => 'payroll-services']))
            ->assertOk()
            ->assertSee('href="'.self::BOOKING_URL.'"', false)
            ->assertSee('Schedule online')
            ->assertDontSeeLivewire(BookingSystem::class);

        $this->assertDatabaseCount('appointments', 0);
    }

    public function test_an_old_public_booking_form_cannot_create_a_local_booking(): void
    {
        Livewire::test(BookingSystem::class)
            ->call('submitBooking')
            ->assertRedirect(self::BOOKING_URL);

        $this->assertDatabaseCount('appointments', 0);
        $this->assertDatabaseCount('users', 0);
    }

    public function test_client_booking_links_and_actions_use_microsoft(): void
    {
        $client = User::factory()->create(['role' => 'client']);

        Livewire::actingAs($client)->test(AppointmentManager::class)
            ->assertSee('href="'.self::BOOKING_URL.'"', false)
            ->assertSee('do not automatically appear')
            ->assertDontSee('wire:click="openModal"', false)
            ->call('openModal')
            ->assertRedirect(self::BOOKING_URL);

        Livewire::actingAs($client)->test(AppointmentManager::class)
            ->call('save')
            ->assertRedirect(self::BOOKING_URL);

        $this->assertDatabaseCount('appointments', 0);
    }

    public function test_clearing_the_url_restores_the_local_booking_page(): void
    {
        config(['services.microsoft_bookings.url' => null]);

        $this->get(route('book-appointment'))
            ->assertOk()
            ->assertSeeLivewire(BookingSystem::class);
    }
}
