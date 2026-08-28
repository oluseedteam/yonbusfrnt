<?php

namespace App\Livewire\Accountant;

use App\Models\Document;
use App\Models\User;
use App\Models\ActivityLog;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class DocumentManager extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $clientFilter = '';

    // Upload fields
    public $showUploadModal = false;
    public $client_id = '';
    public $file;
    public $type = 'other';
    public $notes = '';

    protected $rules = [
        'client_id' => 'required|exists:users,id',
        'file'      => 'required|file|max:20480|mimes:pdf,png,jpg,jpeg,webp,gif,heic,heif,docx,doc,xlsx,xls,csv,txt',
        'type'      => 'required|string',
        'notes'     => 'nullable|string|max:300',
    ];

    protected $messages = [
        'client_id.required' => 'Please select a recipient client.',
        'file.required'      => 'Please select a document or image file.',
        'file.max'           => 'File size must not exceed 20MB.',
        'file.mimes'         => 'Supported formats: PDF, PNG, JPG, JPEG, WEBP, DOCX, XLSX, CSV, TXT.',
    ];

    public function render()
    {
        $query = Document::with(['client', 'uploader']);
        if ($this->clientFilter) {
            $query->where('client_id', $this->clientFilter);
        }
        if ($this->search) {
            $query->where('original_name', 'like', "%{$this->search}%");
        }

        $documents = $query->latest()->paginate(10);
        $clients = User::whereHas('roles', function ($q) {
            $q->where('name', 'client');
        })->orWhere('role', 'client')->get();

        return view('livewire.accountant.document-manager', compact('documents', 'clients'))
            ->layout('layouts.accountant');
    }

    public function openUploadModal()
    {
        $this->reset(['client_id', 'file', 'type', 'notes']);
        $this->showUploadModal = true;
    }

    public function uploadDocument()
    {
        $this->validate();

        $originalName = $this->file->getClientOriginalName();
        $extension    = $this->file->getClientOriginalExtension();
        $storedName   = $this->file->storeAs('documents/' . $this->client_id, \Str::uuid() . '.' . $extension, 'public');

        $doc = Document::create([
            'client_id'         => $this->client_id,
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

        $client = User::find($this->client_id);
        if ($client) {
            try {
                $client->notify(new \App\Notifications\DocumentDeliveredToClientNotification($doc));
            } catch (\Throwable $e) {}
        }

        ActivityLog::log('document.sent_to_client', "Sent document: {$doc->original_name} to client " . ($client ? $client->name : "ID {$this->client_id}"), $doc);
        
        $this->showUploadModal = false;
        $this->reset(['client_id', 'file', 'type', 'notes']);
        session()->flash('message', 'Document uploaded and sent to client successfully!');
    }
}
