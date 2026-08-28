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

        // 3. Verified Client Reviews
        $this->call(GoogleReviewsSeeder::class);

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

        // 4. Default System Services (6 Official Core Practice Areas)
        $services = [
            [
                'name'        => 'Tax Preparation & Planning Services',
                'description' => 'We provide comprehensive Canadian tax preparation and proactive tax planning services for individuals, families, self-employed professionals, investors, and corporations. Our approach focuses on accurate filings, identifying eligible deductions and credits, and helping clients make informed tax decisions throughout the year.',
                'price'       => 150.00,
                'duration'    => 60,
                'icon'        => '🧾',
                'is_active'   => true,
            ],
            [
                'name'        => 'Accounting & Bookkeeping Services',
                'description' => 'We provide accurate and efficient accounting and bookkeeping services to keep your financial records organized, up to date, and ready for informed business decisions.',
                'price'       => 250.00,
                'duration'    => 60,
                'icon'        => '🧮',
                'is_active'   => true,
            ],
            [
                'name'        => 'Payroll Services',
                'description' => 'We provide reliable, end-to-end payroll services to help businesses manage employee compensation, statutory deductions, and year-end reporting accurately and efficiently.',
                'price'       => 180.00,
                'duration'    => 45,
                'icon'        => '📊',
                'is_active'   => true,
            ],
            [
                'name'        => 'Business Consulting & Advisory',
                'description' => 'We provide practical financial and business advisory services to help entrepreneurs and business owners understand their numbers, plan for growth, and make informed financial decisions.',
                'price'       => 300.00,
                'duration'    => 60,
                'icon'        => '💼',
                'is_active'   => true,
            ],
            [
                'name'        => 'Compliance Services',
                'description' => 'We help individuals and businesses meet their ongoing tax, payroll, and corporate compliance requirements accurately and on time, helping reduce the risk of missed filings, penalties, and compliance issues.',
                'price'       => 350.00,
                'duration'    => 60,
                'icon'        => '⚖️',
                'is_active'   => true,
            ],
            [
                'name'        => 'Business Registration',
                'description' => 'We help entrepreneurs and business owners establish their businesses properly and set up the registrations and accounts needed to operate in Canada.',
                'price'       => 400.00,
                'duration'    => 60,
                'icon'        => '🏢',
                'is_active'   => true,
            ],
        ];

        \App\Models\Service::whereNotIn('name', array_column($services, 'name'))->delete();

        foreach ($services as $srv) {
            \App\Models\Service::updateOrCreate(
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
