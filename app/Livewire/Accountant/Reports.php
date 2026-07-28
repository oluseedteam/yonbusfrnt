<?php

namespace App\Livewire\Accountant;

use App\Models\Report;
use App\Models\Invoice;
use App\Models\User;
use Livewire\Component;

class Reports extends Component
{
    public function render()
    {
        $labels = [];
        $revenueData = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $labels[] = $month->format('M Y');
            $revenueData[] = Invoice::where('accountant_id', auth()->id())
                ->where('status', 'paid')
                ->whereYear('issued_date', $month->year)
                ->whereMonth('issued_date', $month->month)
                ->sum('amount');
        }
        $clientCount = User::where('role', 'client')->count();
        return view('livewire.accountant.reports', compact('labels', 'revenueData', 'clientCount'))
            ->layout('layouts.accountant');
    }
}
