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

        // 2. Partner Admin Accounts (Olubukunola Eniola & Adeshola Eniola)
        $this->call(AdminAccountsSeeder::class);

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

        // 4. Default System Services
        $services = [
            [
                'name'        => 'Personal Income Tax Return (T1)',
                'description' => 'Comprehensive individual tax preparation, credits optimization, and electronic filing with CRA.',
                'price'       => 120.00,
                'duration'    => 45,
                'is_active'   => true,
            ],
            [
                'name'        => 'Corporate Tax Filing (T2)',
                'description' => 'Full corporate tax return preparation, financial statement review, and strategic tax minimization.',
                'price'       => 650.00,
                'duration'    => 60,
                'is_active'   => true,
            ],
            [
                'name'        => 'Monthly Bookkeeping & Reporting',
                'description' => 'Accurate bank reconciliations, expense tracking, balance sheet, and monthly profit & loss reporting.',
                'price'       => 250.00,
                'duration'    => 60,
                'is_active'   => true,
            ],
            [
                'name'        => 'Payroll Management & Remittances',
                'description' => 'Full-service payroll processing, direct deposit setup, ROEs, T4/T4A summaries, and CRA remittances.',
                'price'       => 180.00,
                'duration'    => 45,
                'is_active'   => true,
            ],
            [
                'name'        => 'Task Audit Defense & Review',
                'description' => 'Expert representation during task reviews, audit inquiries, formal appeals, and dispute negotiations.',
                'price'       => 350.00,
                'duration'    => 90,
                'is_active'   => true,
            ],
            [
                'name'        => 'Business Registration & Tax Planning',
                'description' => 'Federal & provincial incorporation, GST/HST accounts, corporate structuring, and year-end planning.',
                'price'       => 400.00,
                'duration'    => 60,
                'is_active'   => true,
            ],
        ];

        foreach ($services as $srv) {
            \App\Models\Service::firstOrCreate(
                ['name' => $srv['name']],
                $srv
            );
        }

        // 5. Default Application Settings
        $settings = [
            ['key' => 'company_name',    'value' => 'YONBUS Tax & Accounting Services Inc.', 'group' => 'general'],
            ['key' => 'company_email',   'value' => 'info@yonbustax.ca',                     'group' => 'general'],
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
