<?php

namespace App\Livewire\Admin;

use App\Models\Document;
use App\Models\User;
use App\Services\AuditService;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class DocumentManager extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $clientFilter = 'all';
    public $uploaderFilter = 'all'; // all, client_uploads, admin_uploads
    public $consultantFilter = 'all';

    // Upload to client modal
    public $showUploadModal = false;
    public $target_client_id = '';
    public $file;
    public $type = 'completed_tax_return';
    public $notes = '';

    protected $rules = [
        'target_client_id' => 'required|exists:users,id',
        'file'             => 'required|file|max:20480|mimes:pdf,png,jpg,jpeg,webp,gif,heic,heif,docx,doc,xlsx,xls,csv,txt',
        'type'             => 'required|string',
        'notes'            => 'nullable|string|max:300',
    ];

    protected $messages = [
        'target_client_id.required' => 'Please select a recipient client.',
        'target_client_id.exists'   => 'The selected client does not exist.',
        'file.required'             => 'Please select a document or image to upload.',
        'file.file'                 => 'The uploaded item must be a valid file.',
        'file.max'                  => 'The file size must not exceed 20MB.',
        'file.mimes'                => 'Supported formats: PDF, PNG, JPG, JPEG, WEBP, DOCX, XLSX, CSV, TXT.',
    ];

    public function removeSelectedFile()
    {
        $this->reset('file');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingClientFilter()
    {
        $this->resetPage();
    }

    public function updatingUploaderFilter()
    {
        $this->resetPage();
    }

    public function updatingConsultantFilter()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $admin = auth()->user();
        if ($admin && (str_contains(strtolower($admin->email), 'olubukunola') || str_contains(strtolower($admin->email), 'adeshola'))) {
            $this->consultantFilter = 'all';
        }
    }

    public $previewDocId = null;

    public function previewDocument($id)
    {
        $this->previewDocId = $id;
    }

    public function closePreview()
    {
        $this->previewDocId = null;
    }

    public function render()
    {
        $query = Document::with(['client.assignedAdmin', 'uploader', 'assignedAdmin']);

        if ($this->clientFilter !== 'all' && !empty($this->clientFilter)) {
            $query->where('client_id', $this->clientFilter);
        }

        if ($this->uploaderFilter === 'client_uploads') {
            $query->whereColumn('uploaded_by', 'client_id');
        } elseif ($this->uploaderFilter === 'admin_uploads') {
            $query->whereColumn('uploaded_by', '!=', 'client_id');
        }

        if ($this->consultantFilter === 'olubukunola') {
            $partner = User::where('email', 'olubukunola@yonbustax.ca')->first();
            if ($partner) {
                $query->where(function ($q) use ($partner) {
                    $q->where('assigned_admin_id', $partner->id)
                      ->orWhereHas('client', fn($cq) => $cq->where('assigned_admin_id', $partner->id));
                });
            }
        } elseif ($this->consultantFilter === 'adeshola') {
            $partner = User::where('email', 'like', 'adeshola%')->first();
            if ($partner) {
                $query->where(function ($q) use ($partner) {
                    $q->where('assigned_admin_id', $partner->id)
                      ->orWhereHas('client', fn($cq) => $cq->where('assigned_admin_id', $partner->id));
                });
            }
        } elseif ($this->consultantFilter === 'my_documents' && auth()->check()) {
            $myId = auth()->id();
            $query->where(function ($q) use ($myId) {
                $q->where('assigned_admin_id', $myId)
                  ->orWhereHas('client', fn($cq) => $cq->where('assigned_admin_id', $myId))
                  ->orWhereNull('assigned_admin_id');
            });
        }

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('original_name', 'like', "%{$this->search}%")
                  ->orWhere('notes', 'like', "%{$this->search}%")
                  ->orWhere('type', 'like', "%{$this->search}%")
                  ->orWhereHas('client', function ($cq) {
                      $cq->where('first_name', 'like', "%{$this->search}%")
                         ->orWhere('last_name', 'like', "%{$this->search}%")
                         ->orWhere('name', 'like', "%{$this->search}%")
                         ->orWhere('email', 'like', "%{$this->search}%");
                  })
                  ->orWhereHas('assignedAdmin', function ($aq) {
                      $aq->where('name', 'like', "%{$this->search}%")
                         ->orWhere('email', 'like', "%{$this->search}%");
                  });
            });
        }

        $documents = $query->latest()->paginate(15);
        $clients = User::whereIn('role', ['client'])->orWhereHas('roles', fn($q) => $q->where('name', 'client'))->get();
        $consultants = User::whereIn('role', ['admin', 'superadmin'])->orWhere('email', 'like', '%@yonbustax.ca')->get();

        $stats = [
            'total'          => Document::count(),
            'client_uploads' => Document::whereColumn('uploaded_by', 'client_id')->count(),
            'admin_uploads'  => Document::whereColumn('uploaded_by', '!=', 'client_id')->count(),
        ];

        $previewDocument = $this->previewDocId ? Document::with(['client', 'uploader', 'assignedAdmin'])->find($this->previewDocId) : null;

        return view('livewire.admin.document-manager', compact('documents', 'clients', 'consultants', 'stats', 'previewDocument'))
            ->layout('layouts.admin');
    }


    public function openUploadModal($clientId = null)
    {
        $this->reset(['target_client_id', 'file', 'type', 'notes']);
        if ($clientId) {
            $this->target_client_id = $clientId;
        }
        $this->showUploadModal = true;
    }

    public function uploadDocument()
    {
        $this->validate();

        $originalName = $this->file->getClientOriginalName();
        $extension    = $this->file->getClientOriginalExtension();
        $storedName   = $this->file->storeAs('documents/' . $this->target_client_id, \Str::uuid() . '.' . $extension, 'public');

        $doc = Document::create([
            'client_id'         => $this->target_client_id,
            'uploaded_by'       => auth()->id(),
            'assigned_admin_id' => auth()->id(),
            'type'              => $this->type,
            'notes'             => $this->notes,
            'original_name'     => $originalName,
            'stored_name'       => $storedName,
            'file_type'         => $this->file->getMimeType(),
            'file_size'         => $this->file->getSize(),
            'version'           => 1,
        ]);

        $client = User::find($this->target_client_id);
        $clientName = $client ? $client->name : "ID {$this->target_client_id}";

        // Notify the client that a document has been delivered to their portal
        if ($client) {
            try {
                $client->notify(new \App\Notifications\DocumentDeliveredToClientNotification($doc));
            } catch (\Throwable $e) {
                // Ignore notification errors on local environments
            }
        }

        AuditService::log('document.admin_uploaded', "Admin uploaded file {$doc->original_name} to client {$clientName}", $doc);

        $this->showUploadModal = false;
        $this->reset(['target_client_id', 'file', 'type', 'notes']);

        $this->dispatch('notify', [
            'message' => "✅ Document \"{$doc->original_name}\" uploaded and delivered to {$clientName}'s client portal successfully!",
            'type'    => 'success',
        ]);
        session()->flash('message', "Document \"{$doc->original_name}\" uploaded and delivered to {$clientName}'s client portal successfully!");
    }

    public function delete($id)
    {
        $doc = Document::findOrFail($id);
        if (Storage::disk('public')->exists($doc->stored_name)) {
            Storage::disk('public')->delete($doc->stored_name);
        }
        AuditService::log('document.deleted', "Admin deleted document: {$doc->original_name}", $doc);
        $doc->delete();
        session()->flash('message', 'Document deleted successfully.');
    }
}
