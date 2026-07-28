<?php

namespace App\Livewire\Admin;

use App\Models\Invoice;
use Livewire\Component;

class InvoiceManager extends Component
{
    public $search = '';
    public $filter = 'all';

    public function render()
    {
        $query = Invoice::with(['client', 'accountant']);
        if ($this->filter !== 'all') $query->where('status', $this->filter);
        if ($this->search) {
            $query->where('invoice_number', 'like', "%{$this->search}%")
                ->orWhereHas('client', fn($q) => $q->where('name', 'like', "%{$this->search}%"));
        }
        $invoices = $query->orderByDesc('issued_date')->paginate(15);
        return view('livewire.admin.invoice-manager', compact('invoices'))->layout('layouts.admin');
    }
}
