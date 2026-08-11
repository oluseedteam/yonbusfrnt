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

    public function downloadPdf($id)
    {
        $invoice = Invoice::where('id', $id)->where('client_id', auth()->id())->firstOrFail();
        
        $issued = \Carbon\Carbon::parse($invoice->issued_date)->format('M j, Y');
        $due    = \Carbon\Carbon::parse($invoice->due_date)->format('M j, Y');

        $html = "
        <html>
        <head><title>Invoice #{$invoice->invoice_number}</title></head>
        <body style='font-family: sans-serif; padding: 40px;'>
            <h2>YONBUS Tax & Accounting Services</h2>
            <hr>
            <h3>INVOICE: {$invoice->invoice_number}</h3>
            <p><strong>Status:</strong> " . strtoupper($invoice->status) . "</p>
            <p><strong>Issued Date:</strong> {$issued}</p>
            <p><strong>Due Date:</strong> {$due}</p>
            <p><strong>Amount:</strong> $" . number_format($invoice->total, 2) . "</p>
            <hr>
            <p>Thank you for choosing YONBUS Tax & Accounting Services.</p>
        </body>
        </html>
        ";

        return response()->streamDownload(function () use ($html) {
            echo $html;
        }, "Invoice-{$invoice->invoice_number}.html");
    }
}
