<?php

namespace App\Livewire\Client;

use App\Models\Document;
use App\Models\ActivityLog;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class DocumentManager extends Component
{
    use WithFileUploads;

    public $file;
    public $type = 'other';
    public $notes = '';
    public $search = '';

    protected $rules = [
        'file'  => 'required|file|max:20480', // 20MB
        'type'  => 'required|string',
        'notes' => 'nullable|string|max:300',
    ];

    public function render()
    {
        $clientId = auth()->id();

        // Documents sent to client by Admin/Accountants
        $adminDocuments = Document::where('client_id', $clientId)
            ->where('uploaded_by', '!=', $clientId)
            ->with('uploader')
            ->latest()
            ->get();

        // All client's documents (including uploaded by self)
        $documents = Document::where('client_id', $clientId)
            ->when($this->search, fn($q) => $q->where('original_name', 'like', "%{$this->search}%"))
            ->latest()
            ->paginate(10);

        return view('livewire.client.document-manager', compact('documents', 'adminDocuments'))
            ->layout('layouts.client');
    }

    public function upload()
    {
        $this->validate();

        $originalName = $this->file->getClientOriginalName();
        $extension    = $this->file->getClientOriginalExtension();
        $storedName   = $this->file->storeAs('documents/' . auth()->id(), \Str::uuid() . '.' . $extension, 'public');

        $doc = Document::create([
            'client_id'     => auth()->id(),
            'uploaded_by'   => auth()->id(),
            'original_name' => $originalName,
            'stored_name'   => $storedName,
            'file_type'     => $this->file->getMimeType(),
            'file_size'     => $this->file->getSize(),
            'version'       => 1,
        ]);

        ActivityLog::log('document.uploaded', "Uploaded document: {$doc->original_name}", $doc);
        $this->reset(['file', 'type', 'notes']);
        session()->flash('message', 'Document uploaded successfully!');
    }

    public function delete($id)
    {
        $doc = Document::where('id', $id)->where('client_id', auth()->id())->firstOrFail();
        if (Storage::disk('public')->exists($doc->stored_name)) {
            Storage::disk('public')->delete($doc->stored_name);
        }
        ActivityLog::log('document.deleted', "Deleted document: {$doc->original_name}", $doc);
        $doc->delete();
        session()->flash('message', 'Document deleted.');
    }
}
