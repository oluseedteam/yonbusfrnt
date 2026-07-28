<?php

namespace App\Livewire\Client;

use App\Models\TaxReturn;
use Livewire\Component;

class TaxReturnTracker extends Component
{
    public function render()
    {
        $taxReturns = TaxReturn::where('client_id', auth()->id())
            ->with('accountant')
            ->orderByDesc('year')
            ->get();

        $statuses = TaxReturn::STATUSES;

        return view('livewire.client.tax-return-tracker', compact('taxReturns', 'statuses'))
            ->layout('layouts.client');
    }
}
