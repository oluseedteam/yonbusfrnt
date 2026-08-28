<?php

namespace App\Livewire\Client;

use App\Models\Document;
use App\Models\User;
use App\Models\ActivityLog;
use App\Notifications\DocumentUploadedNotification;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class DocumentManager extends Component
{
    use WithPagination, WithFileUploads;

    public $file;
    public $type = 't4_t5';
    public $assigned_admin_id = '';
    public $notes = '';
    public $search = '';

    public $previewDocId = null;

    protected function rules()
    {
        return [
            'file'              => 'required|file|max:20480|mimes:pdf,png,jpg,jpeg,webp,gif,heic,heif,docx,doc,xlsx,xls,csv,txt', // 20MB
            'type'              => 'required|string',
            'assigned_admin_id' => 'nullable|exists:users,id',
            'notes'             => 'nullable|string|max:500',
        ];
    }

    protected $messages = [
        'file.required' => 'Please select a document or image file to upload.',
        'file.file'     => 'The uploaded item must be a valid file.',
        'file.max'      => 'The file size must not exceed 20MB.',
        'file.mimes'    => 'Supported formats: PDF, PNG, JPG, JPEG, WEBP, DOCX, XLSX, CSV, TXT.',
        'assigned_admin_id.exists' => 'The selected advisor does not exist.',
    ];

    public function removeSelectedFile()
    {
        $this->reset('file');
    }

    public function previewDocument($id)
    {
        $this->previewDocId = $id;
    }

    public function closePreview()
    {
        $this->previewDocId = null;
    }

    public function mount()
    {
        if (auth()->check() && auth()->user()->assigned_admin_id) {
            $this->assigned_admin_id = (string) auth()->user()->assigned_admin_id;
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $clientId = auth()->id();

        // Documents sent to client by Admin/Accountants
        $adminDocuments = Document::where('client_id', $clientId)
            ->where('uploaded_by', '!=', $clientId)
            ->with(['uploader', 'assignedAdmin'])
            ->latest()
            ->get();

        // All client's documents (including uploaded by self)
        $documents = Document::where('client_id', $clientId)
            ->with(['uploader', 'assignedAdmin'])
            ->when($this->search, function ($q) {
                $q->where(function ($sq) {
                    $sq->where('original_name', 'like', "%{$this->search}%")
                       ->orWhere('notes', 'like', "%{$this->search}%")
                       ->orWhere('type', 'like', "%{$this->search}%");
                });
            })
            ->latest()
            ->paginate(10);

        // Active document being previewed
        $previewDocument = $this->previewDocId ? Document::where('client_id', $clientId)->find($this->previewDocId) : null;

        // List of all active Advisors / Admins for client to select
        $advisors = User::whereIn('role', ['admin', 'superadmin', 'subadmin', 'accountant'])
            ->orWhereHas('roles', fn($q) => $q->whereIn('name', ['admin', 'superadmin', 'subadmin', 'super-admin', 'accountant']))
            ->get();

        return view('livewire.client.document-manager', compact('documents', 'adminDocuments', 'advisors', 'previewDocument'))
            ->layout('layouts.client');
    }

    public function upload()
    {
        if (empty($this->assigned_admin_id)) {
            $this->assigned_admin_id = null;
        }

        $this->validate();

        $originalName = $this->file->getClientOriginalName();
        $extension    = $this->file->getClientOriginalExtension();
        $storedName   = $this->file->storeAs('documents/' . auth()->id(), \Str::uuid() . '.' . $extension, 'public');

        $assignedId = !empty($this->assigned_admin_id) ? (int)$this->assigned_admin_id : auth()->user()->assigned_admin_id;

        $doc = Document::create([
            'client_id'         => auth()->id(),
            'uploaded_by'       => auth()->id(),
            'assigned_admin_id' => $assignedId ?: null,
            'type'              => $this->type,
            'notes'             => $this->notes,
            'original_name'     => $originalName,
            'stored_name'       => $storedName,
            'file_type'         => $this->file->getMimeType(),
            'file_size'         => $this->file->getSize(),
            'version'           => 1,
        ]);

        // If client selected an assigned admin, also update client profile if not set
        if ($assignedId && !auth()->user()->assigned_admin_id) {
            auth()->user()->update(['assigned_admin_id' => $assignedId]);
        }

        // Notify assigned admin if present
        if ($assignedId) {
            $assignedAdmin = User::find($assignedId);
            if ($assignedAdmin) {
                try {
                    $assignedAdmin->notify(new DocumentUploadedNotification($doc));
                } catch (\Throwable $e) {
                    // Ignore mail exceptions on local environments
                }
            }
        }

        $assignedName = $doc->assignedAdmin ? "to {$doc->assignedAdmin->name}" : "to Central YONBUS Practice";
        ActivityLog::log('document.uploaded', "Uploaded document: {$doc->original_name} {$assignedName}", $doc);

        $this->reset(['file', 'notes']);
        $this->resetPage();

        session()->flash('message', "✅ Document \"{$doc->original_name}\" uploaded successfully and delivered {$assignedName}!");

        // Dispatch in-page toast notification (picked up by Alpine in blade)
        $this->dispatch('notify', [
            'message' => "✅ Document \"{$doc->original_name}\" uploaded successfully and delivered {$assignedName}!",
            'type'    => 'success',
        ]);
    }

    public function delete($id)
    {
        $doc = Document::where('id', $id)->where('client_id', auth()->id())->firstOrFail();
        if (Storage::disk('public')->exists($doc->stored_name)) {
            Storage::disk('public')->delete($doc->stored_name);
        }
        ActivityLog::log('document.deleted', "Deleted document: {$doc->original_name}", $doc);
        $doc->delete();
        if ($this->previewDocId == $id) {
            $this->previewDocId = null;
        }
        session()->flash('message', 'Document deleted.');
    }
}
