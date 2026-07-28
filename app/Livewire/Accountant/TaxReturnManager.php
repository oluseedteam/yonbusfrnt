<?php

namespace App\Livewire\Accountant;

use App\Models\TaxReturn;
use App\Models\User;
use Livewire\Component;

class TaxReturnManager extends Component
{
    public $search = '';
    public $statusFilter = 'all';

    public function render()
    {
        $query = TaxReturn::with(['client', 'accountant'])
            ->where('accountant_id', auth()->id());

        if ($this->statusFilter !== 'all') $query->where('status', $this->statusFilter);
        if ($this->search) {
            $query->whereHas('client', fn($q) => $q->where('name', 'like', "%{$this->search}%"));
        }

        $taxReturns = $query->latest()->paginate(10);
        $statuses = TaxReturn::STATUSES;

        return view('livewire.accountant.tax-return-manager', compact('taxReturns', 'statuses'))
            ->layout('layouts.accountant');
    }

    public function updateStatus($id, $status)
    {
        $tr = TaxReturn::findOrFail($id);
        $updates = ['status' => $status];
        $field = match ($status) {
            'reviewed'   => 'reviewed_at',
            'processing' => 'processed_at',
            'approved'   => 'approved_at',
            'completed'  => 'completed_at',
            default      => null,
        };
        if ($field) $updates[$field] = now();
        $tr->update($updates);
        session()->flash('message', 'Tax return status updated.');
    }
}
