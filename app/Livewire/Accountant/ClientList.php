<?php

namespace App\Livewire\Accountant;

use App\Models\User;
use Livewire\Component;

class ClientList extends Component
{
    public $search = '';

    public function render()
    {
        $clients = User::where('role', 'client')
            ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%")
                ->orWhere('email', 'like', "%{$this->search}%"))
            ->withCount(['appointments', 'documents', 'taxReturns', 'invoices'])
            ->paginate(10);

        return view('livewire.accountant.client-list', compact('clients'))
            ->layout('layouts.accountant');
    }
}
