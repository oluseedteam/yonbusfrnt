<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
use App\Models\Appointment;
use App\Models\Document;
use App\Models\TaxReturn;
use App\Models\Invoice;
use App\Models\Message;
use App\Models\Report;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        $admin = User::create([
            'name'     => 'Admin YONBUS',
            'email'    => 'admin@yonbus.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
            'phone'    => '+1 (555) 000-0001',
            'email_verified_at' => now(),
        ]);

        // Create Accountants
        $accountant1 = User::create([
            'name'     => 'Sarah Johnson',
            'email'    => 'sarah@yonbus.com',
            'password' => Hash::make('password'),
            'role'     => 'accountant',
            'phone'    => '+1 (555) 000-0002',
            'email_verified_at' => now(),
        ]);

        $accountant2 = User::create([
            'name'     => 'Michael Brown',
            'email'    => 'michael@yonbus.com',
            'password' => Hash::make('password'),
            'role'     => 'accountant',
            'phone'    => '+1 (555) 000-0003',
            'email_verified_at' => now(),
        ]);

        // Create Clients
        $client1 = User::create([
            'name'                   => 'John Doe',
            'email'                  => 'john@example.com',
            'password'               => Hash::make('password'),
            'role'                   => 'client',
            'phone'                  => '+1 (555) 100-0001',
            'company_name'           => 'Doe Enterprises LLC',
            'tax_identification_number' => 'TIN-123456789',
            'address'                => '123 Main Street, New York, NY 10001',
            'email_verified_at'      => now(),
        ]);

        $client2 = User::create([
            'name'                   => 'Jane Smith',
            'email'                  => 'jane@example.com',
            'password'               => Hash::make('password'),
            'role'                   => 'client',
            'phone'                  => '+1 (555) 100-0002',
            'company_name'           => 'Smith & Co.',
            'tax_identification_number' => 'TIN-987654321',
            'address'                => '456 Oak Avenue, Los Angeles, CA 90001',
            'email_verified_at'      => now(),
        ]);

        $client3 = User::create([
            'name'                   => 'Robert Wilson',
            'email'                  => 'robert@example.com',
            'password'               => Hash::make('password'),
            'role'                   => 'client',
            'phone'                  => '+1 (555) 100-0003',
            'company_name'           => 'Wilson Tech Ltd',
            'tax_identification_number' => 'TIN-456789123',
            'address'                => '789 Pine Road, Chicago, IL 60601',
            'email_verified_at'      => now(),
        ]);

        // Seed Services
        $services = [
            ['name' => 'Tax Filing', 'description' => 'Complete tax preparation and filing services for individuals and businesses.', 'duration' => 60, 'price' => 250.00, 'icon' => 'document-text'],
            ['name' => 'Bookkeeping', 'description' => 'Accurate and up-to-date bookkeeping to keep your finances in order.', 'duration' => 90, 'price' => 350.00, 'icon' => 'book-open'],
            ['name' => 'Payroll', 'description' => 'Complete payroll processing and management for your employees.', 'duration' => 45, 'price' => 200.00, 'icon' => 'users'],
            ['name' => 'Tax Consultation', 'description' => 'Expert tax consultation and planning to minimize your tax liability.', 'duration' => 60, 'price' => 150.00, 'icon' => 'chat'],
            ['name' => 'Financial Advisory', 'description' => 'Strategic financial advice to help your business grow and succeed.', 'duration' => 90, 'price' => 400.00, 'icon' => 'trending-up'],
        ];

        foreach ($services as $serviceData) {
            Service::create($serviceData);
        }

        $taxService = Service::where('name', 'Tax Consultation')->first();
        $bookService = Service::where('name', 'Bookkeeping')->first();

        // Seed Appointments
        Appointment::create([
            'client_id'     => $client1->id,
            'accountant_id' => $accountant1->id,
            'service_id'    => $taxService->id,
            'date'          => now()->addDays(5)->toDateString(),
            'time'          => '10:00:00',
            'status'        => 'confirmed',
            'notes'         => 'Please bring all financial documents for 2023.',
        ]);

        Appointment::create([
            'client_id'     => $client2->id,
            'accountant_id' => $accountant2->id,
            'service_id'    => $bookService->id,
            'date'          => now()->addDays(10)->toDateString(),
            'time'          => '14:00:00',
            'status'        => 'pending',
        ]);

        // Seed Tax Returns
        TaxReturn::create([
            'client_id'     => $client1->id,
            'accountant_id' => $accountant1->id,
            'year'          => '2023',
            'status'        => 'processing',
            'amount'        => 4200.00,
            'submitted_at'  => now()->subDays(20),
            'reviewed_at'   => now()->subDays(15),
        ]);

        TaxReturn::create([
            'client_id'     => $client1->id,
            'accountant_id' => $accountant1->id,
            'year'          => '2022',
            'status'        => 'completed',
            'amount'        => 3800.00,
            'submitted_at'  => now()->subYear()->subDays(20),
            'reviewed_at'   => now()->subYear()->subDays(15),
            'processed_at'  => now()->subYear()->subDays(10),
            'approved_at'   => now()->subYear()->subDays(5),
            'completed_at'  => now()->subYear()->subDays(2),
        ]);

        TaxReturn::create([
            'client_id'     => $client2->id,
            'accountant_id' => $accountant1->id,
            'year'          => '2023',
            'status'        => 'submitted',
            'amount'        => 2900.00,
            'submitted_at'  => now()->subDays(3),
        ]);

        // Seed Invoices
        $invoice1 = Invoice::create([
            'client_id'      => $client1->id,
            'accountant_id'  => $accountant1->id,
            'invoice_number' => 'INV-2024-0001',
            'amount'         => 750.00,
            'tax'            => 75.00,
            'status'         => 'paid',
            'due_date'       => now()->subDays(10)->toDateString(),
            'issued_date'    => now()->subDays(20)->toDateString(),
            'description'    => 'Tax Consultation - May 2024',
        ]);

        Invoice::create([
            'client_id'      => $client1->id,
            'accountant_id'  => $accountant1->id,
            'invoice_number' => 'INV-2024-0002',
            'amount'         => 1200.00,
            'tax'            => 120.00,
            'status'         => 'pending',
            'due_date'       => now()->addDays(15)->toDateString(),
            'issued_date'    => now()->subDays(5)->toDateString(),
            'description'    => 'Bookkeeping - April 2024',
        ]);

        Invoice::create([
            'client_id'      => $client2->id,
            'accountant_id'  => $accountant2->id,
            'invoice_number' => 'INV-2024-0003',
            'amount'         => 600.00,
            'tax'            => 60.00,
            'status'         => 'overdue',
            'due_date'       => now()->subDays(5)->toDateString(),
            'issued_date'    => now()->subDays(25)->toDateString(),
            'description'    => 'Tax Filing Fee',
        ]);

        // Seed Messages
        Message::create([
            'sender_id'   => $client1->id,
            'receiver_id' => $accountant1->id,
            'body'        => 'Hello Sarah, I wanted to check on the status of my 2023 tax return. Do you need any additional documents from me?',
            'read_at'     => now()->subHours(2),
        ]);

        Message::create([
            'sender_id'   => $accountant1->id,
            'receiver_id' => $client1->id,
            'body'        => 'Hi John! Your tax return is currently in the processing stage. We may need your bank statements for Q4 2023. Could you upload those to the documents section?',
        ]);

        Message::create([
            'sender_id'   => $client1->id,
            'receiver_id' => $accountant1->id,
            'body'        => 'Sure! I will upload them today. Thank you.',
        ]);

        // Seed Settings
        $defaultSettings = [
            ['key' => 'company_name', 'value' => 'YONBUS Tax & Accounting Services Inc.', 'type' => 'string', 'group' => 'general', 'label' => 'Company Name'],
            ['key' => 'company_email', 'value' => 'info@yonbus.com', 'type' => 'string', 'group' => 'general', 'label' => 'Company Email'],
            ['key' => 'company_phone', 'value' => '+1 (555) 000-0000', 'type' => 'string', 'group' => 'general', 'label' => 'Company Phone'],
            ['key' => 'company_address', 'value' => '100 Financial District, New York, NY 10005', 'type' => 'string', 'group' => 'general', 'label' => 'Company Address'],
            ['key' => 'tax_rate', 'value' => '10', 'type' => 'integer', 'group' => 'billing', 'label' => 'Default Tax Rate (%)'],
            ['key' => 'email_notifications', 'value' => '1', 'type' => 'boolean', 'group' => 'email', 'label' => 'Email Notifications'],
        ];

        foreach ($defaultSettings as $setting) {
            Setting::create($setting);
        }
    }
}
