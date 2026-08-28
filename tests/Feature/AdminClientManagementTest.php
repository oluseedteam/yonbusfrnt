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

    public function test_admin_can_create_another_admin(): void
    {
        Livewire::actingAs($this->admin)
            ->test(UserManager::class)
            ->call('openModal', 'admin')
            ->set('first_name', 'Robert')
            ->set('last_name', 'Tremblay')
            ->set('email', 'robert.tremblay@yonbus.ca')
            ->set('role', 'admin')
            ->set('password', 'AdminPass2026!')
            ->call('save')
            ->assertHasNoErrors()
            ->assertSet('showModal', false);

        $newAdmin = User::where('email', 'robert.tremblay@yonbus.ca')->first();
        $this->assertNotNull($newAdmin);
        $this->assertEquals('admin', $newAdmin->role);
        $this->assertTrue($newAdmin->isAdmin());

        // New admin can log in via Admin Portal and access admin dashboard
        Auth::logout();
        $loginRes = $this->post(route('admin.login.store'), [
            'email' => 'robert.tremblay@yonbus.ca',
            'password' => 'AdminPass2026!',
        ]);
        $this->assertAuthenticated();
        $loginRes->assertRedirect(route('admin.dashboard', absolute: false));

        $adminDash = $this->get(route('admin.dashboard'));
        $adminDash->assertStatus(200);
    }

    public function test_admin_can_delete_another_admin(): void
    {
        $targetAdmin = User::factory()->create([
            'first_name' => 'Marc',
            'last_name'  => 'Duval',
            'email'      => 'marc.duval@yonbus.ca',
            'role'       => 'admin',
            'is_active'  => true,
        ]);
        $targetAdmin->assignRole('admin');

        $this->assertDatabaseHas('users', ['id' => $targetAdmin->id]);

        // Admin initiates and confirms deletion of target admin
        Livewire::actingAs($this->admin)
            ->test(UserManager::class)
            ->call('confirmDelete', $targetAdmin->id)
            ->assertSet('showDeleteModal', true)
            ->assertSet('confirmingDeleteId', $targetAdmin->id)
            ->call('deleteConfirmed')
            ->assertSet('showDeleteModal', false)
            ->assertHasNoErrors();

        // Target admin should be deleted from database
        $this->assertDatabaseMissing('users', ['id' => $targetAdmin->id]);
    }

    public function test_admin_cannot_delete_their_own_account(): void
    {
        Livewire::actingAs($this->admin)
            ->test(UserManager::class)
            ->call('confirmDelete', $this->admin->id)
            ->assertSet('showDeleteModal', false)
            ->assertSet('confirmingDeleteId', null);

        // Account remains in database
        $this->assertDatabaseHas('users', ['id' => $this->admin->id]);
    }
}
