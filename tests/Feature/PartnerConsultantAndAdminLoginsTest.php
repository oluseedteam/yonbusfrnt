<?php

namespace Tests\Feature;

use App\Livewire\Admin\ActivityLogs;
use App\Livewire\Admin\Profile as AdminProfile;
use App\Livewire\Admin\UserManager;
use App\Models\ActivityLog;
use App\Models\Client;
use App\Models\User;
use Database\Seeders\AdminAccountsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class PartnerConsultantAndAdminLoginsTest extends TestCase
{
    use RefreshDatabase;

    protected User $olubukunola;
    protected User $adeshola;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(AdminAccountsSeeder::class);

        $this->olubukunola = User::where('email', 'olubukunola@yonbustax.ca')->firstOrFail();
        $this->adeshola = User::where('email', 'adeshola.eniola@yonbustax.ca')->firstOrFail();
    }

    public function test_both_partner_admin_accounts_exist_and_can_authenticate(): void
    {
        // 1. Verify Admin CANNOT log in through client login form (/login)
        $clientLoginFail = $this->post('/login', [
            'email' => 'olubukunola@yonbustax.ca',
            'password' => 'Password123!',
        ]);
        $this->assertGuest();
        $clientLoginFail->assertSessionHasErrors(['email']);

        // 2. Olubukunola admin login test via /admin/login
        $responseO = $this->post(route('admin.login.store'), [
            'email' => 'olubukunola@yonbustax.ca',
            'password' => 'Password123!',
        ]);
        $this->assertAuthenticatedAs($this->olubukunola);
        $responseO->assertRedirect(route('admin.dashboard', absolute: false));

        Auth::logout();

        // 3. Adeshola admin login test via /admin/login
        $responseA = $this->post(route('admin.login.store'), [
            'email' => 'adeshola.eniola@yonbustax.ca',
            'password' => 'Password123!',
        ]);
        $this->assertAuthenticatedAs($this->adeshola);
        $responseA->assertRedirect(route('admin.dashboard', absolute: false));
    }

    public function test_client_registration_with_olubukunola_as_consultant(): void
    {
        $response = $this->post('/register', [
            'first_name' => 'Marie',
            'last_name' => 'Dubois',
            'email' => 'marie.dubois@example.ca',
            'assigned_consultant' => 'olubukunola',
            'password' => 'SecurePassword123!',
            'password_confirmation' => 'SecurePassword123!',
            'terms' => 'on',
        ]);

        $this->assertAuthenticated();
        $client = User::where('email', 'marie.dubois@example.ca')->first();
        $this->assertNotNull($client);
        $this->assertEquals($this->olubukunola->id, $client->assigned_admin_id);

        $clientProfile = Client::where('user_id', $client->id)->first();
        $this->assertNotNull($clientProfile);
        $this->assertEquals($this->olubukunola->id, $clientProfile->assigned_admin_id);

        // Verify dashboard displays Olubukunola as dedicated consultant
        $dash = $this->get(route('client.dashboard'));
        $dash->assertStatus(200);
        $dash->assertSee('Olubukunola Eniola');
        $dash->assertSee('Your Dedicated Consultant');
    }

    public function test_client_registration_with_adeshola_as_consultant(): void
    {
        $response = $this->post('/register', [
            'first_name' => 'Jean',
            'last_name' => 'Belanger',
            'email' => 'jean.belanger@example.ca',
            'assigned_consultant' => 'adeshola',
            'password' => 'SecurePassword123!',
            'password_confirmation' => 'SecurePassword123!',
            'terms' => 'on',
        ]);

        $this->assertAuthenticated();
        $client = User::where('email', 'jean.belanger@example.ca')->first();
        $this->assertNotNull($client);
        $this->assertEquals($this->adeshola->id, $client->assigned_admin_id);

        $clientProfile = Client::where('user_id', $client->id)->first();
        $this->assertNotNull($clientProfile);
        $this->assertEquals($this->adeshola->id, $clientProfile->assigned_admin_id);

        // Verify dashboard displays Adeshola as dedicated consultant
        $dash = $this->get(route('client.dashboard'));
        $dash->assertStatus(200);
        $dash->assertSee('Adeshola Eniola');
        $dash->assertSee('Your Dedicated Consultant');
    }

    public function test_consultant_client_segregation_in_user_manager(): void
    {
        // Create client 1 for Olubukunola
        $clientO = User::factory()->create([
            'first_name' => 'ClientOf',
            'last_name' => 'Olubukunola',
            'email' => 'client.o@example.ca',
            'role' => 'client',
            'assigned_admin_id' => $this->olubukunola->id,
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
        $clientO->assignRole('client');

        // Create client 2 for Adeshola
        $clientA = User::factory()->create([
            'first_name' => 'ClientOf',
            'last_name' => 'Adeshola',
            'email' => 'client.a@example.ca',
            'role' => 'client',
            'assigned_admin_id' => $this->adeshola->id,
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
        $clientA->assignRole('client');

        // When Olubukunola views User Manager with 'my' filter
        Livewire::actingAs($this->olubukunola)
            ->test(UserManager::class)
            ->set('consultantFilter', 'my')
            ->assertSee('client.o@example.ca')
            ->assertDontSee('client.a@example.ca');

        // When Adeshola views User Manager with 'my' filter
        Livewire::actingAs($this->adeshola)
            ->test(UserManager::class)
            ->set('consultantFilter', 'my')
            ->assertSee('client.a@example.ca')
            ->assertDontSee('client.o@example.ca');

        // When viewing all clients
        Livewire::actingAs($this->olubukunola)
            ->test(UserManager::class)
            ->set('consultantFilter', 'all')
            ->assertSee('client.o@example.ca')
            ->assertSee('client.a@example.ca');
    }

    public function test_admins_can_edit_their_username_email_and_password(): void
    {
        // 1. Olubukunola edits her profile
        Livewire::actingAs($this->olubukunola)
            ->test(AdminProfile::class)
            ->set('first_name', 'Olubukunola Updated')
            ->set('last_name', 'Eniola Partner')
            ->set('phone', '+1 (438) 999-0001')
            ->call('saveProfile')
            ->assertHasNoErrors();

        $this->olubukunola->refresh();
        $this->assertEquals('Olubukunola Updated', $this->olubukunola->first_name);

        // 2. Olubukunola updates her password
        Livewire::actingAs($this->olubukunola)
            ->test(AdminProfile::class)
            ->set('current_password', 'Password123!')
            ->set('new_password', 'NewAdminPass999!')
            ->set('new_password_confirmation', 'NewAdminPass999!')
            ->call('updatePassword')
            ->assertHasNoErrors();

        $this->olubukunola->refresh();
        $this->assertTrue(Hash::check('NewAdminPass999!', $this->olubukunola->password));

        // 3. Adeshola updates his profile and password
        Livewire::actingAs($this->adeshola)
            ->test(AdminProfile::class)
            ->set('first_name', 'Adeshola CPB')
            ->set('current_password', 'Password123!')
            ->set('new_password', 'AdesholaSecret888!')
            ->set('new_password_confirmation', 'AdesholaSecret888!')
            ->call('updatePassword')
            ->assertHasNoErrors();

        $this->adeshola->refresh();
        $this->assertTrue(Hash::check('AdesholaSecret888!', $this->adeshola->password));
    }

    public function test_activity_logs_can_be_filtered_by_admin(): void
    {
        ActivityLog::create([
            'user_id' => $this->olubukunola->id,
            'action' => 'admin.profile_updated',
            'description' => 'Olubukunola updated corporate tax settings',
            'ip_address' => '127.0.0.1',
            'created_at' => now(),
        ]);

        ActivityLog::create([
            'user_id' => $this->adeshola->id,
            'action' => 'admin.audit_review',
            'description' => 'Adeshola reviewed CRA task audit defense file',
            'ip_address' => '127.0.0.1',
            'created_at' => now(),
        ]);

        // Test filtering by Olubukunola
        Livewire::actingAs($this->olubukunola)
            ->test(ActivityLogs::class)
            ->set('adminFilter', (string) $this->olubukunola->id)
            ->assertSee('Olubukunola updated corporate tax settings')
            ->assertDontSee('Adeshola reviewed CRA task audit defense file');

        // Test filtering by Adeshola
        Livewire::actingAs($this->adeshola)
            ->test(ActivityLogs::class)
            ->set('adminFilter', (string) $this->adeshola->id)
            ->assertSee('Adeshola reviewed CRA task audit defense file')
            ->assertDontSee('Olubukunola updated corporate tax settings');
    }
}
