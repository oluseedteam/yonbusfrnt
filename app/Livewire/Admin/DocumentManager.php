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
        'file'             => 'required|file|max:20480',
        'type'             => 'required|string',
        'notes'            => 'nullable|string|max:300',
    ];

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
                  ->orWhereHas('client', fn($cq) => $cq->where('assigned_admin_id', $myId));
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

        return view('livewire.admin.document-manager', compact('documents', 'clients', 'consultants', 'stats'))
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

        AuditService::log('document.admin_uploaded', "Admin uploaded file {$doc->original_name} to client {$clientName}", $doc);
        
        $this->showUploadModal = false;
        $this->reset(['target_client_id', 'file', 'type', 'notes']);
        session()->flash('message', "Document uploaded and delivered to {$clientName}'s client portal successfully!");
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
