<?php

namespace Database\Seeders;

use App\Models\Accountant;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminAccountsSeeder extends Seeder
{
    /**
     * Seed both Partner Admin Logins: Olubukunola Eniola & Adeshola Eniola
     */
    public function run(): void
    {
        // Ensure roles exist
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'superadmin', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'accountant', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'client', 'guard_name' => 'web']);

        // 1. Olubukunola Eniola (Founder & Partner)
        $olubukunola = User::updateOrCreate(
            ['email' => 'olubukunola@yonbustax.ca'],
            [
                'first_name'            => 'Olubukunola',
                'last_name'             => 'Eniola',
                'password'              => Hash::make('Password123!'),
                'role'                  => 'admin',
                'phone'                 => '+1 (438) 555-0101',
                'email_verified_at'     => now(),
                'is_active'             => true,
                'avatar'                => 'images/team/olubukunola-eniola.jpg',
                'notification_email'    => true,
                'notification_database' => true,
            ]
        );
        $olubukunola->safeAssignRole('admin');

        Accountant::updateOrCreate(
            ['user_id' => $olubukunola->id],
            [
                'title'                     => 'Founder & Partner',
                'specialization'            => 'Certified Professional Bookkeeper (CPB), Tax Preparation, Bookkeeping & Payroll',
                'bio'                       => 'Olubukunola Eniola is the Founder and Partner at Yonbus Tax & Accounting Services Inc. CPB certified with B.Sc Banking & Finance and Mohawk College Alumni.',
                'hourly_rate'               => 150.00,
                'is_accepting_appointments' => true,
            ]
        );

        // 2. Adeshola Eniola (Co-founder & Partner)
        $adeshola = User::updateOrCreate(
            ['email' => 'adeshola.eniola@yonbustax.ca'],
            [
                'first_name'            => 'Adeshola',
                'last_name'             => 'Eniola',
                'password'              => Hash::make('Password123!'),
                'role'                  => 'admin',
                'phone'                 => '+1 (438) 555-0102',
                'email_verified_at'     => now(),
                'is_active'             => true,
                'avatar'                => 'images/team/adeshola-eniola.jpg',
                'notification_email'    => true,
                'notification_database' => true,
            ]
        );
        $adeshola->safeAssignRole('admin');

        // Also create alias adeshola@yonbustax.ca if needed
        $adesholaAlias = User::updateOrCreate(
            ['email' => 'adeshola@yonbustax.ca'],
            [
                'first_name'            => 'Adeshola',
                'last_name'             => 'Eniola',
                'password'              => Hash::make('Password123!'),
                'role'                  => 'admin',
                'phone'                 => '+1 (438) 555-0102',
                'email_verified_at'     => now(),
                'is_active'             => true,
                'avatar'                => 'images/team/adeshola-eniola.jpg',
                'notification_email'    => true,
                'notification_database' => true,
            ]
        );
        $adesholaAlias->safeAssignRole('admin');

        Accountant::updateOrCreate(
            ['user_id' => $adeshola->id],
            [
                'title'                     => 'Co-founder & Partner',
                'specialization'            => 'Certified Professional Bookkeeper (CPB), Audit Defense & Corporate Tax',
                'bio'                       => 'Adeshola Eniola is a Co-founder and Partner at Yonbus Tax & Accounting Services Inc., bringing over 10 years of professional auditing experience.',
                'hourly_rate'               => 150.00,
                'is_accepting_appointments' => true,
            ]
        );
    }
}
