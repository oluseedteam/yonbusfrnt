<?php

namespace App\Livewire\Client;

use App\Models\Report;
use App\Models\Invoice;
use Livewire\Component;

class Reports extends Component
{
    public $period = 'monthly';

    public function render()
    {
        $user = auth()->user();

        // Build monthly revenue data from invoices (last 6 months)
        $revenueData = [];
        $labels = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $labels[] = $month->format('M Y');
            $revenueData[] = Invoice::where('client_id', $user->id)
                ->where('status', 'paid')
                ->whereYear('issued_date', $month->year)
                ->whereMonth('issued_date', $month->month)
                ->sum('amount');
        }

        // Invoice status breakdown
        $paid    = Invoice::where('client_id', $user->id)->where('status', 'paid')->count();
        $pending = Invoice::where('client_id', $user->id)->where('status', 'pending')->count();
        $overdue = Invoice::where('client_id', $user->id)->where('status', 'overdue')->count();

        $reports = Report::where('client_id', $user->id)->latest()->take(5)->get();

        return view('livewire.client.reports', compact(
            'labels', 'revenueData', 'paid', 'pending', 'overdue', 'reports'
        ))->layout('layouts.client');
    }
}
