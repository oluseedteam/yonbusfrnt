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
        $documents = Document::where('client_id', auth()->id())
            ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->latest()->paginate(10);

        return view('livewire.client.document-manager', compact('documents'))
            ->layout('layouts.client');
    }

    public function upload()
    {
        $this->validate();

        $path = $this->file->store('documents/' . auth()->id(), 'local');
        $doc = Document::create([
            'client_id'     => auth()->id(),
            'name'          => pathinfo($this->file->getClientOriginalName(), PATHINFO_FILENAME),
            'original_name' => $this->file->getClientOriginalName(),
            'type'          => $this->type,
            'path'          => $path,
            'mime_type'     => $this->file->getMimeType(),
            'size'          => $this->file->getSize(),
            'notes'         => $this->notes,
        ]);

        ActivityLog::log('document.uploaded', "Uploaded document: {$doc->original_name}", $doc);
        $this->reset(['file', 'type', 'notes']);
        session()->flash('message', 'Document uploaded successfully!');
    }

    public function delete($id)
    {
        $doc = Document::where('id', $id)->where('client_id', auth()->id())->firstOrFail();
        Storage::delete($doc->path);
        ActivityLog::log('document.deleted', "Deleted document: {$doc->original_name}", $doc);
        $doc->delete();
        session()->flash('message', 'Document deleted.');
    }
}
