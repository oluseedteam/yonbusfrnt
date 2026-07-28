<?php

namespace App\Livewire\Accountant;

use App\Models\Document;
use App\Models\User;
use Livewire\Component;

class DocumentManager extends Component
{
    public $search = '';
    public $clientFilter = '';

    public function render()
    {
        $query = Document::with('user');
        if ($this->clientFilter) $query->where('user_id', $this->clientFilter);
        if ($this->search) $query->where('name', 'like', "%{$this->search}%");

        $documents = $query->latest()->paginate(10);
        $clients = User::where('role', 'client')->get();

        return view('livewire.accountant.document-manager', compact('documents', 'clients'))
            ->layout('layouts.accountant');
    }
}
