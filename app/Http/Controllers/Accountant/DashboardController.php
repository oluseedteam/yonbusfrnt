<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Appointment;
use App\Models\TaxReturn;
use App\Models\Invoice;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $accountant = auth()->user();

        $stats = [
            'clients'          => User::where('role', 'client')->count(),
            'pending_returns'  => TaxReturn::where('accountant_id', $accountant->id)->whereNotIn('status', ['completed'])->count(),
            'upcoming_meetings'=> Appointment::where('accountant_id', $accountant->id)->whereIn('status', ['confirmed', 'pending'])->where('date', '>=', now())->count(),
            'revenue'          => Invoice::where('accountant_id', $accountant->id)->where('status', 'paid')->sum('amount'),
        ];

        $upcomingAppointments = Appointment::where('accountant_id', $accountant->id)
            ->whereIn('status', ['confirmed', 'pending'])
            ->where('date', '>=', now())
            ->with(['client', 'service'])
            ->orderBy('date')
            ->take(5)
            ->get();

        $pendingTaxReturns = TaxReturn::where('accountant_id', $accountant->id)
            ->whereNotIn('status', ['completed'])
            ->with('client')
            ->latest()
            ->take(5)
            ->get();

        $recentClients = User::where('role', 'client')->latest()->take(5)->get();

        return view('accountant.dashboard', compact(
            'accountant', 'stats', 'upcomingAppointments', 'pendingTaxReturns', 'recentClients'
        ));
    }
}
