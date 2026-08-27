<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Service;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Appointment;
use App\Models\Invoice;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ButtonAndRouteTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_pages_and_buttons_load_successfully(): void
    {
        $service = Service::create([
            'name' => 'Corporate Tax Filing',
            'description' => 'T2 Corporate Tax Returns',
            'duration' => 60,
            'price' => 450,
            'is_active' => true,
        ]);

        $category = BlogCategory::create([
            'name' => 'Tax News',
            'slug' => 'tax-news',
            'description' => 'Tax updates',
        ]);

        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@yonbustax.ca',
            'password' => bcrypt('password123'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        $blog = Blog::create([
            'blog_category_id' => $category->id,
            'author_id' => $admin->id,
            'title' => '2026 Canadian Tax Deadlines',
            'slug' => '2026-canadian-tax-deadlines',
            'excerpt' => 'Key deadlines for Canadian businesses.',
            'content' => 'Full article content here.',
            'is_published' => true,
            'published_at' => now(),
        ]);

        // Home
        $this->get(route('home'))->assertStatus(200);

        // About
        $this->get(route('about'))->assertStatus(200);

        // Services
        $this->get(route('services'))->assertStatus(200);

        // Team
        $this->get(route('team'))->assertStatus(200);

        // Blog listing & Single post
        $this->get(route('blog'))->assertStatus(200);
        $this->get(route('blog.show', $blog->slug))->assertStatus(200);

        // Book appointment
        $this->get(route('book-appointment'))->assertStatus(200);

        // Contact page
        $this->get(route('contact'))->assertStatus(200);

        // Careers page
        $this->get(route('careers'))->assertStatus(200);

        // Legal pages
        $this->get(route('privacy'))->assertStatus(200);
        $this->get(route('terms'))->assertStatus(200);

        // Auth pages
        $this->get(route('login'))->assertStatus(200);
        $this->get(route('register'))->assertStatus(200);
        $this->get(route('admin.login'))->assertStatus(200);
        // When admin already exists and guest visits admin.register, it redirects to admin.login (security feature)
        $this->get(route('admin.register'))->assertRedirect(route('admin.login'));
    }

    public function test_contact_form_button_submission_works(): void
    {
        $response = $this->post(route('contact.submit'), [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'phone' => '+1 555-0192',
            'subject' => 'Tax Consulting Inquiry',
            'service' => 'Tax Services',
            'message' => 'Hello, I need help with my corporate taxes.',
        ]);

        $response->assertSessionHas('success');
    }

    public function test_careers_form_button_submission_works(): void
    {
        $response = $this->post(route('careers.submit'), [
            'name' => 'John Candidate',
            'email' => 'john.candidate@example.com',
            'phone' => '+1 555-4321',
            'position' => 'Bookkeeper / Accountant',
            'experience' => '2-3 years',
            'message' => 'I would love to join your accounting firm.',
        ]);

        $response->assertSessionHas('success');
    }

    public function test_client_portal_routes_load_for_authenticated_client(): void
    {
        $client = User::create([
            'first_name' => 'Client',
            'last_name' => 'Test',
            'email' => 'client@example.com',
            'password' => bcrypt('password123'),
            'role' => 'client',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        $this->actingAs($client);

        $this->get(route('client.dashboard'))->assertStatus(200);
        $this->get(route('client.appointments'))->assertStatus(200);
        $this->get(route('client.documents'))->assertStatus(200);
        $this->get(route('client.tax-returns'))->assertStatus(200);
        $this->get(route('client.messages'))->assertStatus(200);
        $this->get(route('client.profile'))->assertStatus(200);
        $this->get(route('client.settings'))->assertStatus(200);
    }

    public function test_accountant_portal_routes_load_for_authenticated_accountant(): void
    {
        $accountant = User::create([
            'first_name' => 'Accountant',
            'last_name' => 'Staff',
            'email' => 'accountant@yonbustax.ca',
            'password' => bcrypt('password123'),
            'role' => 'accountant',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        $this->actingAs($accountant);

        $this->get(route('accountant.dashboard'))->assertStatus(200);
        $this->get(route('accountant.clients'))->assertStatus(200);
        $this->get(route('accountant.appointments'))->assertStatus(200);
        $this->get(route('accountant.documents'))->assertStatus(200);
        $this->get(route('accountant.tax-returns'))->assertStatus(200);
        $this->get(route('accountant.invoices'))->assertStatus(200);
        $this->get(route('accountant.messages'))->assertStatus(200);
    }

    public function test_admin_portal_routes_load_for_authenticated_admin(): void
    {
        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'Super',
            'email' => 'superadmin@yonbustax.ca',
            'password' => bcrypt('password123'),
            'role' => 'admin',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        $this->actingAs($admin);

        $this->get(route('admin.dashboard'))->assertStatus(200);
        $this->get(route('admin.users'))->assertStatus(200);
        $this->get(route('admin.services'))->assertStatus(200);
        $this->get(route('admin.appointments'))->assertStatus(200);
        $this->get(route('admin.invoices'))->assertStatus(200);
        $this->get(route('admin.messages'))->assertStatus(200);
        $this->get(route('admin.blogs'))->assertStatus(200);
        $this->get(route('admin.reports'))->assertStatus(200);
        $this->get(route('admin.activity-logs'))->assertStatus(200);
        $this->get(route('admin.profile'))->assertStatus(200);
        $this->get(route('admin.settings'))->assertStatus(200);
    }

    public function test_booking_system_livewire_button_flow(): void
    {
        $service = Service::create([
            'name' => 'Bookkeeping Monthly',
            'description' => 'Full-service monthly bookkeeping',
            'duration' => 60,
            'price' => 200,
            'is_active' => true,
        ]);

        $bookingDate = now()->next('Wednesday')->format('Y-m-d');

        \Livewire\Livewire::test(\App\Livewire\Public\BookingSystem::class)
            ->set('service_id', $service->id)
            ->call('nextStep')
            ->assertSet('step', 2)
            ->set('appointment_date', $bookingDate)
            ->set('appointment_time', '10:00')
            ->call('nextStep')
            ->assertSet('step', 3)
            ->set('first_name', 'Alice')
            ->set('last_name', 'Tester')
            ->set('client_email', 'alice.tester@example.com')
            ->set('client_phone', '+1 555-0123')
            ->call('submitBooking')
            ->assertSet('step', 4);

        $this->assertDatabaseHas('users', [
            'email' => 'alice.tester@example.com',
        ]);
        $user = User::where('email', 'alice.tester@example.com')->first();
        $this->assertDatabaseHas('appointments', [
            'service_id' => $service->id,
            'client_id' => $user->id,
        ]);
    }

    public function test_admin_user_manager_buttons(): void
    {
        $admin = User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'admin.manager@yonbustax.ca',
            'password' => bcrypt('password123'),
            'role' => 'admin',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        $this->actingAs($admin);

        \Livewire\Livewire::test(\App\Livewire\Admin\UserManager::class)
            ->call('openModal')
            ->assertSet('showModal', true)
            ->set('first_name', 'New')
            ->set('last_name', 'Accountant')
            ->set('email', 'new.accountant@yonbustax.ca')
            ->set('role', 'accountant')
            ->set('phone', '+1 555-9999')
            ->set('password', 'password123')
            ->call('save')
            ->assertSet('showModal', false)
            ->assertHasNoErrors();

        $newUser = User::where('email', 'new.accountant@yonbustax.ca')->first();
        $this->assertNotNull($newUser);

        // Test toggle status button
        \Livewire\Livewire::test(\App\Livewire\Admin\UserManager::class)
            ->call('toggleStatus', $newUser->id);

        $this->assertFalse((bool) $newUser->fresh()->is_active);

        // Test delete button
        \Livewire\Livewire::test(\App\Livewire\Admin\UserManager::class)
            ->call('confirmDelete', $newUser->id)
            ->assertSet('showDeleteModal', true)
            ->call('deleteConfirmed')
            ->assertSet('showDeleteModal', false);

        $this->assertDatabaseMissing('users', ['id' => $newUser->id]);
    }

    public function test_admin_service_manager_buttons(): void
    {
        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'Service',
            'email' => 'admin.service@yonbustax.ca',
            'password' => bcrypt('password123'),
            'role' => 'admin',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        $this->actingAs($admin);

        \Livewire\Livewire::test(\App\Livewire\Admin\ServiceManager::class)
            ->call('openModal')
            ->assertSet('showModal', true)
            ->set('name', 'Audit Assistance')
            ->set('description', 'Task audit defense and support')
            ->set('duration', 90)
            ->set('price', 650)
            ->set('is_active', true)
            ->call('save')
            ->assertSet('showModal', false);

        $service = Service::where('name', 'Audit Assistance')->first();
        $this->assertNotNull($service);

        // Test edit & update
        \Livewire\Livewire::test(\App\Livewire\Admin\ServiceManager::class)
            ->call('edit', $service->id)
            ->assertSet('showModal', true)
            ->assertSet('name', 'Audit Assistance')
            ->set('price', 700)
            ->call('save');

        $this->assertEquals(700, (float) $service->fresh()->price);

        // Test delete
        \Livewire\Livewire::test(\App\Livewire\Admin\ServiceManager::class)
            ->call('confirmDelete', $service->id)
            ->assertSet('showDeleteModal', true)
            ->call('deleteConfirmed')
            ->assertSet('showDeleteModal', false);

        $this->assertDatabaseMissing('services', ['id' => $service->id]);
    }

    public function test_admin_appointment_manager_buttons(): void
    {
        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'Appt',
            'email' => 'admin.appt@yonbustax.ca',
            'password' => bcrypt('password123'),
            'role' => 'admin',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        $client = User::create([
            'first_name' => 'Client',
            'last_name' => 'Appt',
            'email' => 'client.appt@example.com',
            'password' => bcrypt('password123'),
            'role' => 'client',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        $service = Service::create([
            'name' => 'Advisory Session',
            'duration' => 60,
            'price' => 150,
            'is_active' => true,
        ]);

        $appt = Appointment::create([
            'client_id' => $client->id,
            'service_id' => $service->id,
            'date' => now()->addDays(3)->toDateString(),
            'time' => '14:00',
            'duration' => 60,
            'status' => 'pending',
        ]);

        $this->actingAs($admin);

        // Test schedule and confirm button
        \Livewire\Livewire::test(\App\Livewire\Admin\AppointmentManager::class)
            ->call('openSchedule', $appt->id)
            ->assertSet('showScheduleModal', true)
            ->set('scheduleDate', now()->addDays(4)->toDateString())
            ->set('scheduleTime', '15:00')
            ->call('scheduleAndConfirm')
            ->assertSet('showScheduleModal', false);

        $this->assertEquals('confirmed', $appt->fresh()->status);

        // Test complete button
        \Livewire\Livewire::test(\App\Livewire\Admin\AppointmentManager::class)
            ->call('complete', $appt->id);

        $this->assertEquals('completed', $appt->fresh()->status);
    }

    public function test_admin_invoice_manager_buttons(): void
    {
        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'Inv',
            'email' => 'admin.inv@yonbustax.ca',
            'password' => bcrypt('password123'),
            'role' => 'admin',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        $client = User::create([
            'first_name' => 'Client',
            'last_name' => 'Inv',
            'email' => 'client.inv@example.com',
            'password' => bcrypt('password123'),
            'role' => 'client',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        $this->actingAs($admin);

        // Create invoice
        \Livewire\Livewire::test(\App\Livewire\Admin\InvoiceManager::class)
            ->call('openModal')
            ->assertSet('showModal', true)
            ->set('client_id', $client->id)
            ->set('subtotal', 500)
            ->set('tax_amount', 25)
            ->set('discount_amount', 0)
            ->set('due_date', now()->addDays(14)->toDateString())
            ->call('createInvoice')
            ->assertSet('showModal', false);

        $invoice = Invoice::where('client_id', $client->id)->first();
        $this->assertNotNull($invoice);
        $this->assertEquals('pending', $invoice->status);

        // Mark as paid
        \Livewire\Livewire::test(\App\Livewire\Admin\InvoiceManager::class)
            ->call('markAsPaid', $invoice->id);

        $this->assertEquals('paid', $invoice->fresh()->status);
    }

    public function test_service_detail_pages_load_successfully_for_all_practice_areas(): void
    {
        $practiceAreas = [
            'tax-preparation-planning'      => 'Tax Preparation & Planning Services',
            'accounting-bookkeeping'        => 'Accounting & Bookkeeping Services',
            'payroll-services'              => 'Payroll Services',
            'business-consulting-advisory'  => 'Business Consulting & Advisory',
            'compliance-services'           => 'Compliance Services',
            'business-registration'         => 'Business Registration',
        ];

        foreach ($practiceAreas as $slug => $expectedTitle) {
            $response = $this->get(route('services.show', $slug));
            $response->assertStatus(200);
            $response->assertSee(e($expectedTitle), false);
            $response->assertSee(route('book-appointment'), false);
            $response->assertSee('Overview', false);
            $response->assertSee('Services Included', false);
        }
    }

    public function test_service_detail_returns_404_for_invalid_slug(): void
    {
        $response = $this->get('/services/non-existent-service-slug');
        $response->assertStatus(404);
    }

    public function test_services_page_contains_redirect_links_and_no_popup_modal(): void
    {
        $response = $this->get(route('services'));
        $response->assertStatus(200);

        // Verify each practice area has a link to its dedicated detail page
        $response->assertSee(route('services.show', 'tax-preparation-planning'), false);
        $response->assertSee(route('services.show', 'accounting-bookkeeping'), false);
        $response->assertSee(route('services.show', 'payroll-services'), false);
        $response->assertSee(route('services.show', 'business-consulting-advisory'), false);
        $response->assertSee(route('services.show', 'compliance-services'), false);
        $response->assertSee(route('services.show', 'business-registration'), false);

        // Verify popup modal triggers are removed
        $response->assertDontSee('openModal', false);
        $response->assertDontSee('activeService', false);
    }
}
