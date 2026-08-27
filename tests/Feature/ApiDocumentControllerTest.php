<?php

namespace Tests\Feature;

use App\Models\Document;
use App\Models\User;
use Database\Seeders\AdminAccountsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ApiDocumentControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $client;
    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(AdminAccountsSeeder::class);

        $this->admin = User::where('email', 'olubukunola@yonbustax.ca')->firstOrFail();

        $this->client = User::factory()->create([
            'first_name' => 'Michael',
            'last_name'  => 'Burnham',
            'email'      => 'michael.burnham@example.ca',
            'role'       => 'client',
        ]);
        $this->client->assignRole('client');
    }

    public function test_api_upload_view_and_download_documents(): void
    {
        Storage::fake('public');

        Sanctum::actingAs($this->client);

        // 1. Client uploads document via REST API
        $pdfFile = UploadedFile::fake()->create('2025_T4_Slip.pdf', 500, 'application/pdf');

        $response = $this->postJson('/api/v1/documents', [
            'file' => $pdfFile,
        ]);

        $response->assertStatus(201)
            ->assertJsonPath('message', 'Document uploaded successfully')
            ->assertJsonStructure(['document' => ['id', 'original_name', 'view_url', 'download_url']]);

        $docId = $response->json('document.id');
        $doc = Document::findOrFail($docId);

        // 2. Client gets list of documents
        $listRes = $this->getJson('/api/v1/documents');
        $listRes->assertStatus(200)
            ->assertJsonFragment(['original_name' => '2025_T4_Slip.pdf']);

        // 3. Client views document inline via API
        $viewRes = $this->get("/api/v1/documents/{$docId}/view");
        $viewRes->assertStatus(200);
        $this->assertStringContainsString('inline', $viewRes->headers->get('content-disposition'));

        // 4. Client downloads document via API
        $downloadRes = $this->get("/api/v1/documents/{$docId}/download");
        $downloadRes->assertStatus(200);

        // 5. Admin views and downloads document
        Sanctum::actingAs($this->admin);

        $adminViewRes = $this->get("/api/v1/documents/{$docId}/view");
        $adminViewRes->assertStatus(200);

        $adminDownloadRes = $this->get("/api/v1/documents/{$docId}/download");
        $adminDownloadRes->assertStatus(200);

        // 6. Delete document
        $delRes = $this->deleteJson("/api/v1/documents/{$docId}");
        $delRes->assertStatus(200);
        $this->assertSoftDeleted('documents', ['id' => $docId]);
    }
}
