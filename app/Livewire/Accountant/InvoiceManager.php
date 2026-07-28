<?php

namespace App\Livewire\Accountant;

use App\Models\Invoice;
use App\Models\User;
use Livewire\Component;

class InvoiceManager extends Component
{
    public $showModal = false;
    public $client_id = '';
    public $amount = '';
    public $tax = 0;
    public $due_date = '';
    public $description = '';
    public $filter = 'all';

    protected $rules = [
        'client_id'   => 'required|exists:users,id',
        'amount'      => 'required|numeric|min:0.01',
        'tax'         => 'nullable|numeric|min:0',
        'due_date'    => 'required|date',
        'description' => 'nullable|string|max:500',
    ];

    public function render()
    {
        $query = Invoice::with('client')->where('accountant_id', auth()->id());
        if ($this->filter !== 'all') $query->where('status', $this->filter);
        $invoices = $query->orderByDesc('issued_date')->paginate(10);
        $clients = User::where('role', 'client')->get();

        return view('livewire.accountant.invoice-manager', compact('invoices', 'clients'))
            ->layout('layouts.accountant');
    }

    public function create()
    {
        $this->validate();
        Invoice::create([
            'client_id'     => $this->client_id,
            'accountant_id' => auth()->id(),
            'amount'        => $this->amount,
            'tax'           => $this->tax ?: 0,
            'status'        => 'pending',
            'issued_date'   => now()->toDateString(),
            'due_date'      => $this->due_date,
            'description'   => $this->description,
        ]);
        $this->reset(['showModal', 'client_id', 'amount', 'tax', 'due_date', 'description']);
        session()->flash('message', 'Invoice generated successfully.');
    }
}
