<?php

namespace Tests\Feature;

use App\Livewire\Admin\DocumentManager as AdminDocumentManager;
use App\Livewire\Client\DocumentManager as ClientDocumentManager;
use App\Models\Document;
use App\Models\User;
use Database\Seeders\AdminAccountsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class ClientAndAdminDocumentSyncTest extends TestCase
{
    use RefreshDatabase;

    protected User $olubukunola;
    protected User $adeshola;
    protected User $client;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(AdminAccountsSeeder::class);

        $this->olubukunola = User::where('email', 'olubukunola@yonbustax.ca')->firstOrFail();
        $this->adeshola = User::where('email', 'adeshola.eniola@yonbustax.ca')->firstOrFail();

        $this->client = User::factory()->create([
            'first_name'        => 'Jean-Luc',
            'last_name'         => 'Picard',
            'email'             => 'jeanluc.picard@example.ca',
            'role'              => 'client',
            'assigned_admin_id' => $this->olubukunola->id,
            'is_active'         => true,
            'email_verified_at' => now(),
        ]);
        $this->client->assignRole('client');
    }

    public function test_client_uploads_document_and_it_shows_on_client_and_admin_pages(): void
    {
        Storage::fake('public');

        $t4File = UploadedFile::fake()->create('2025_T4_Employment_Income.pdf', 800, 'application/pdf');

        // 1. Client uploads document via Livewire Client Document Manager
        Livewire::actingAs($this->client)
            ->test(ClientDocumentManager::class)
            ->set('file', $t4File)
            ->set('type', 't4_t5')
            ->set('notes', 'T4 from primary employer in Montreal')
            ->call('upload')
            ->assertHasNoErrors()
            ->assertSee('2025_T4_Employment_Income.pdf');

        // Verify document in database
        $this->assertDatabaseHas('documents', [
            'client_id'     => $this->client->id,
            'uploaded_by'   => $this->client->id,
            'original_name' => '2025_T4_Employment_Income.pdf',
        ]);

        $document = Document::where('original_name', '2025_T4_Employment_Income.pdf')->firstOrFail();

        // 2. Verify document displays on Client Dashboard
        $clientDash = $this->actingAs($this->client)->get(route('client.dashboard'));
        $clientDash->assertStatus(200);
        $clientDash->assertSee('2025_T4_Employment_Income.pdf');
        $clientDash->assertSee('Uploaded by You');

        // 3. Verify document displays in Admin Document Manager for Olubukunola
        Auth::logout();
        Livewire::actingAs($this->olubukunola)
            ->test(AdminDocumentManager::class)
            ->assertSee('2025_T4_Employment_Income.pdf')
            ->assertSee('Jean-Luc Picard')
            ->assertSee('Client Upload');

        // 4. Verify document displays on Admin Dashboard for Olubukunola
        $adminDashO = $this->actingAs($this->olubukunola)->get(route('admin.dashboard'));
        $adminDashO->assertStatus(200);
        $adminDashO->assertSee('2025_T4_Employment_Income.pdf');
        $adminDashO->assertSee('Jean-Luc Picard');

        // 5. Verify document displays on Admin Dashboard and Manager for Adeshola
        Auth::logout();
        Livewire::actingAs($this->adeshola)
            ->test(AdminDocumentManager::class)
            ->assertSee('2025_T4_Employment_Income.pdf')
            ->assertSee('Jean-Luc Picard');

        $adminDashA = $this->actingAs($this->adeshola)->get(route('admin.dashboard'));
        $adminDashA->assertStatus(200);
        $adminDashA->assertSee('2025_T4_Employment_Income.pdf');

        // 6. Verify Admin can securely download the document
        $downloadRes = $this->actingAs($this->olubukunola)->get(route('documents.download', $document->id));
        $downloadRes->assertStatus(200);
    }

    public function test_admin_uploads_document_to_client_and_it_shows_for_both(): void
    {
        Storage::fake('public');

        $noticeFile = UploadedFile::fake()->create('2025_CRA_Notice_of_Assessment.pdf', 1200, 'application/pdf');

        // 1. Admin uploads document to client
        Livewire::actingAs($this->olubukunola)
            ->test(AdminDocumentManager::class)
            ->call('openUploadModal', $this->client->id)
            ->set('target_client_id', (string)$this->client->id)
            ->set('file', $noticeFile)
            ->set('type', 'cra_notice')
            ->set('notes', 'Official CRA Notice for 2024 tax filing.')
            ->call('uploadDocument')
            ->assertHasNoErrors()
            ->assertSee('2025_CRA_Notice_of_Assessment.pdf');

        $doc = Document::where('original_name', '2025_CRA_Notice_of_Assessment.pdf')->firstOrFail();

        // 2. Client logs in and sees the document
        Auth::logout();
        Livewire::actingAs($this->client)
            ->test(ClientDocumentManager::class)
            ->assertSee('2025_CRA_Notice_of_Assessment.pdf')
            ->assertSee('Olubukunola Eniola');

        $clientDash = $this->actingAs($this->client)->get(route('client.dashboard'));
        $clientDash->assertStatus(200);
        $clientDash->assertSee('2025_CRA_Notice_of_Assessment.pdf');

        // 3. Client can download the delivered document
        $clientDownload = $this->actingAs($this->client)->get(route('documents.download', $doc->id));
        $clientDownload->assertStatus(200);
    }

    public function test_client_uploads_image_receipt_successfully(): void
    {
        Storage::fake('public');

        $receiptImage = UploadedFile::fake()->image('medical_expense_receipt.jpg', 600, 800);

        Livewire::actingAs($this->client)
            ->test(ClientDocumentManager::class)
            ->set('file', $receiptImage)
            ->set('type', 'receipt')
            ->set('notes', 'Pharmacy prescription receipt for 2025 medical claims')
            ->call('upload')
            ->assertHasNoErrors()
            ->assertSee('medical_expense_receipt.jpg');

        $this->assertDatabaseHas('documents', [
            'client_id'     => $this->client->id,
            'original_name' => 'medical_expense_receipt.jpg',
            'type'          => 'receipt',
        ]);

        $doc = Document::where('original_name', 'medical_expense_receipt.jpg')->firstOrFail();
        $this->assertTrue($doc->is_image);

        // Verify download of image
        $res = $this->actingAs($this->client)->get(route('documents.download', $doc->id));
        $res->assertStatus(200);
    }

    public function test_client_document_validation_and_deletion(): void
    {
        Storage::fake('public');

        // Test invalid file validation
        $invalidExe = UploadedFile::fake()->create('malicious_file.exe', 500, 'application/x-msdownload');
        Livewire::actingAs($this->client)
            ->test(ClientDocumentManager::class)
            ->set('file', $invalidExe)
            ->call('upload')
            ->assertHasErrors(['file']);

        // Upload valid file then test deletion
        $validPdf = UploadedFile::fake()->create('charity_donation.pdf', 300, 'application/pdf');
        $testComponent = Livewire::actingAs($this->client)
            ->test(ClientDocumentManager::class)
            ->set('file', $validPdf)
            ->call('upload')
            ->assertHasNoErrors();

        $doc = Document::where('original_name', 'charity_donation.pdf')->firstOrFail();

        $testComponent->call('delete', $doc->id)
            ->assertHasNoErrors();

        $this->assertSoftDeleted('documents', [
            'id' => $doc->id,
        ]);
    }

    public function test_admin_uploads_image_to_client_and_client_can_view_and_download(): void
    {
        Storage::fake('public');

        $craNoticeImg = UploadedFile::fake()->image('2025_cra_assessment_stamp.png', 800, 1000);

        Livewire::actingAs($this->olubukunola)
            ->test(AdminDocumentManager::class)
            ->call('openUploadModal', $this->client->id)
            ->set('target_client_id', (string)$this->client->id)
            ->set('file', $craNoticeImg)
            ->set('type', 'cra_notice')
            ->set('notes', 'Scanned CRA assessment stamp')
            ->call('uploadDocument')
            ->assertHasNoErrors();

        $doc = Document::where('original_name', '2025_cra_assessment_stamp.png')->firstOrFail();
        $this->assertTrue($doc->is_image);

        // Client views in document manager
        Auth::logout();
        Livewire::actingAs($this->client)
            ->test(ClientDocumentManager::class)
            ->assertSee('2025_cra_assessment_stamp.png');

        // Client downloads image
        $downloadRes = $this->actingAs($this->client)->get(route('documents.download', $doc->id));
        $downloadRes->assertStatus(200);
    }
}
