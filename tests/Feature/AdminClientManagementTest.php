<?php

namespace Tests\Feature;

use App\Livewire\Admin\UserManager;
use App\Models\Client;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AdminClientManagementTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'client', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'accountant', 'guard_name' => 'web']);

        $this->admin = User::factory()->create([
            'role' => 'admin',
            'email' => 'admin@yonbus.ca',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
        $this->admin->assignRole('admin');
    }

    public function test_admin_can_access_user_and_client_management_page(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.users'));
        $response->assertStatus(200);
        $response->assertSee('User &amp; Client Management', false);
        $response->assertSee('+ Add New Client');
    }

    public function test_admin_can_add_client_via_livewire_component(): void
    {
        Livewire::actingAs($this->admin)
            ->test(UserManager::class)
            ->call('openModal', 'client')
            ->assertSet('role', 'client')
            ->set('first_name', 'Amelie')
            ->set('last_name', 'Tremblay')
            ->set('email', 'amelie.tremblay@example.ca')
            ->set('phone', '+1 (514) 555-0199')
            ->set('company_name', 'Tremblay Consultations Inc.')
            ->set('tax_number', '987654321 RT0001')
            ->set('address', '450 Rue Sainte-Catherine')
            ->set('city', 'Montreal, QC')
            ->set('password', 'SecretPass2026!')
            ->call('save')
            ->assertHasNoErrors()
            ->assertSet('showModal', false);

        // Verify user in database
        $clientUser = User::where('email', 'amelie.tremblay@example.ca')->first();
        $this->assertNotNull($clientUser);
        $this->assertEquals('Amelie', $clientUser->first_name);
        $this->assertEquals('Tremblay', $clientUser->last_name);
        $this->assertEquals('client', $clientUser->role);
        $this->assertTrue($clientUser->is_active);
        $this->assertNotNull($clientUser->email_verified_at);
        $this->assertTrue(Hash::check('SecretPass2026!', $clientUser->password));

        // Verify client profile was created
        $clientProfile = Client::where('user_id', $clientUser->id)->first();
        $this->assertNotNull($clientProfile);
        $this->assertEquals('Tremblay Consultations Inc.', $clientProfile->company_name);
        $this->assertStringStartsWith('CL-', $clientProfile->client_number);
    }

    public function test_newly_created_client_can_log_in_and_reach_client_portal(): void
    {
        // 1. Admin creates client
        Livewire::actingAs($this->admin)
            ->test(UserManager::class)
            ->call('openModal', 'client')
            ->set('first_name', 'Lucas')
            ->set('last_name', 'Roy')
            ->set('email', 'lucas.roy@example.ca')
            ->set('password', 'ClientPass123!')
            ->call('save');

        // Logout admin
        Auth::logout();

        // 2. Client logs in via standard login form
        $loginResponse = $this->post('/login', [
            'email' => 'lucas.roy@example.ca',
            'password' => 'ClientPass123!',
        ]);

        $this->assertAuthenticated();
        $loginResponse->assertRedirect(route('dashboard', absolute: false));

        // 3. Client follows dashboard redirect to client portal
        $dashboardResponse = $this->get('/dashboard');
        $dashboardResponse->assertRedirect(route('client.dashboard'));

        // 4. Client accesses client dashboard
        $clientPortalResponse = $this->get(route('client.dashboard'));
        $clientPortalResponse->assertStatus(200);
    }

    public function test_admin_can_reset_client_password_and_client_logs_in_with_new_password(): void
    {
        // Create initial client
        Livewire::actingAs($this->admin)
            ->test(UserManager::class)
            ->call('openModal', 'client')
            ->set('first_name', 'Sophie')
            ->set('last_name', 'Gagnon')
            ->set('email', 'sophie.gagnon@example.ca')
            ->set('password', 'OldPass123!')
            ->call('save');

        $clientUser = User::where('email', 'sophie.gagnon@example.ca')->first();

        // Admin edits client and changes password
        Livewire::actingAs($this->admin)
            ->test(UserManager::class)
            ->call('edit', $clientUser->id)
            ->set('password', 'BrandNewSecurePass999!')
            ->call('save')
            ->assertHasNoErrors();

        Auth::logout();

        // Old password should fail
        $this->post('/login', [
            'email' => 'sophie.gagnon@example.ca',
            'password' => 'OldPass123!',
        ]);
        $this->assertGuest();

        // New password should succeed
        $response = $this->post('/login', [
            'email' => 'sophie.gagnon@example.ca',
            'password' => 'BrandNewSecurePass999!',
        ]);
        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }
}
