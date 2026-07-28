<?php

namespace App\Livewire\Client;

use App\Models\Invoice;
use App\Models\Payment;
use Livewire\Component;

class InvoiceManager extends Component
{
    public $filter = 'all';

    public function render()
    {
        $query = Invoice::where('client_id', auth()->id())->with('accountant');
        if ($this->filter !== 'all') {
            $query->where('status', $this->filter);
        }
        $invoices = $query->orderByDesc('issued_date')->paginate(10);
        return view('livewire.client.invoice-manager', compact('invoices'))
            ->layout('layouts.client');
    }

    public function markPaid($id)
    {
        $invoice = Invoice::where('id', $id)->where('client_id', auth()->id())->firstOrFail();
        $invoice->update(['status' => 'paid']);
        Payment::create([
            'invoice_id'     => $invoice->id,
            'user_id'        => auth()->id(),
            'amount'         => $invoice->total,
            'method'         => 'online',
            'transaction_id' => 'TXN-' . strtoupper(uniqid()),
            'status'         => 'completed',
            'paid_at'        => now(),
        ]);
        session()->flash('message', 'Payment recorded successfully!');
    }
}
