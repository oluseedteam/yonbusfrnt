<?php

namespace App\Livewire\Admin;

use App\Models\Invoice;
use App\Models\User;
use App\Services\AuditService;
use Livewire\Component;
use Livewire\WithPagination;

class InvoiceManager extends Component
{
    use WithPagination;

    public $search = '';
    public $filter = 'all';
    public $showModal = false;
    public $editId = null;

    public $client_id = '';
    public $subtotal = 0;
    public $tax_amount = 0;
    public $discount_amount = 0;
    public $due_date = '';
    public $notes = '';

    protected $rules = [
        'client_id'       => 'required|exists:users,id',
        'subtotal'        => 'required|numeric|min:0',
        'tax_amount'      => 'required|numeric|min:0',
        'discount_amount' => 'required|numeric|min:0',
        'due_date'        => 'required|date',
    ];

    public function mount()
    {
        $this->due_date = now()->addDays(30)->format('Y-m-d');
    }

    public function render()
    {
        $query = Invoice::with(['client', 'accountant']);
        if ($this->filter !== 'all') {
            $query->where('status', $this->filter);
        }
        if ($this->search) {
            $query->where('invoice_number', 'like', "%{$this->search}%")
                ->orWhereHas('client', fn($q) => $q->where('first_name', 'like', "%{$this->search}%")->orWhere('last_name', 'like', "%{$this->search}%"));
        }
        $invoices = $query->orderByDesc('created_at')->paginate(15);
        $clients  = User::whereIn('role', ['client', 'user'])
            ->orWhereHas('roles', fn($q) => $q->whereIn('name', ['client', 'user']))
            ->get();
        if ($clients->isEmpty()) {
            $clients = User::whereNotIn('role', ['admin', 'superadmin'])->get();
        }

        return view('livewire.admin.invoice-manager', compact('invoices', 'clients'))->layout('layouts.admin');
    }

    public function openModal()
    {
        $this->reset(['editId', 'client_id', 'subtotal', 'tax_amount', 'discount_amount', 'notes']);
        $this->due_date  = now()->addDays(30)->format('Y-m-d');
        $this->showModal = true;
    }

    public function createInvoice()
    {
        $this->validate();

        $totalAmount = max(0, ($this->subtotal + $this->tax_amount) - $this->discount_amount);
        $invoiceNumber = 'INV-' . date('Ym') . '-' . str_pad(Invoice::count() + 1, 4, '0', STR_PAD_LEFT);

        $inv = Invoice::create([
            'invoice_number'  => $invoiceNumber,
            'client_id'       => $this->client_id,
            'accountant_id'   => auth()->id(),
            'amount'          => $totalAmount,
            'tax'             => $this->tax_amount,
            'subtotal'        => $this->subtotal,
            'tax_amount'      => $this->tax_amount,
            'discount_amount' => $this->discount_amount,
            'total_amount'    => $totalAmount,
            'due_date'        => $this->due_date,
            'issued_date'     => now()->toDateString(),
            'status'          => 'pending',
            'notes'           => $this->notes,
        ]);

        AuditService::log('invoice.created', "Created invoice #{$inv->invoice_number} for client ID {$this->client_id}", 'Invoice', $inv->id);

        $this->showModal = false;
        session()->flash('message', "Invoice #{$inv->invoice_number} created successfully.");
    }

    public function markAsPaid($id)
    {
        $inv = Invoice::findOrFail($id);
        $inv->update(['status' => 'paid', 'paid_at' => now()]);
        AuditService::log('invoice.paid', "Marked invoice #{$inv->invoice_number} as paid", 'Invoice', $inv->id);
        session()->flash('message', "Invoice #{$inv->invoice_number} marked as paid.");
    }

    public function cancelInvoice($id)
    {
        $inv = Invoice::findOrFail($id);
        $inv->update(['status' => 'cancelled']);
        AuditService::log('invoice.cancelled', "Cancelled invoice #{$inv->invoice_number}", 'Invoice', $inv->id);
        session()->flash('message', "Invoice #{$inv->invoice_number} cancelled.");
    }
}
