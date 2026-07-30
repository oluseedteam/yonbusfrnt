<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\BlogCategory;
use App\Models\Setting;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * STRICTLY PRODUCTION INITIALIZATION: No mock data, no fake users, no demo records.
     */
    public function run(): void
    {
        // 1. Run Spatie Permission Setup
        $this->command->call('permission:setup');

        // 2. Primary System Administrator Account (user: admin@admin.com / pass: admin)
        $admin = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'first_name'         => 'System',
                'last_name'          => 'Administrator',
                'password'           => Hash::make('admin'),
                'phone'              => '+1 (800) 555-YONBUS',
                'email_verified_at'  => now(),
                'is_active'          => true,
                'notification_email' => true,
                'notification_database' => true,
            ]
        );

        $admin->assignRole('admin');

        // 3. System Blog Categories
        $categories = [
            'Tax Tips',
            'Accounting',
            'Payroll',
            'Financial Planning',
            'Business Registration',
        ];

        foreach ($categories as $cat) {
            BlogCategory::firstOrCreate(
                ['name' => $cat],
                ['slug' => \Str::slug($cat)]
            );
        }

        // 4. Default Application Settings
        $settings = [
            ['key' => 'company_name',    'value' => 'YONBUS Tax & Accounting Services Inc.', 'group' => 'general'],
            ['key' => 'company_email',   'value' => 'info@yonbus.com',                       'group' => 'general'],
            ['key' => 'company_phone',   'value' => '+1 (800) 555-YONBUS',                  'group' => 'general'],
            ['key' => 'company_address', 'value' => '100 Financial Plaza, Suite 800, Toronto, ON M5H 2N2', 'group' => 'general'],
            ['key' => 'tax_rate',        'value' => '13.00',                                 'group' => 'financial'],
            ['key' => 'currency',        'value' => 'CAD',                                   'group' => 'financial'],
            ['key' => 'appointment_duration_default', 'value' => '45',                       'group' => 'appointments'],
        ];

        foreach ($settings as $setting) {
            Setting::firstOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value'], 'group' => $setting['group']]
            );
        }
    }
}
