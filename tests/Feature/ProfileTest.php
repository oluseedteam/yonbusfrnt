<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_profile_page_is_displayed(): void
    {
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'client', 'guard_name' => 'web']);

        $user = User::factory()->create([
            'role' => 'client',
            'email_verified_at' => now(),
        ]);
        $user->assignRole('client');

        $response = $this
            ->actingAs($user)
            ->get(route('client.profile'));

        $response->assertOk();
    }

    public function test_admin_profile_page_is_displayed(): void
    {
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);

        $admin = User::factory()->create([
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);
        $admin->assignRole('admin');

        $response = $this
            ->actingAs($admin)
            ->get(route('admin.profile'));

        $response->assertOk();
    }
}
