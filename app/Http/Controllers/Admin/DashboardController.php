<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Appointment;
use App\Models\TaxReturn;
use App\Models\Invoice;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $stats = [
            'total_users'       => User::count(),
            'total_clients'     => User::where('role', 'client')->count(),
            'total_accountants' => User::where('role', 'accountant')->count(),
            'total_revenue'     => Invoice::where('status', 'paid')->sum('amount'),
            'pending_returns'   => TaxReturn::whereNotIn('status', ['completed'])->count(),
            'active_appointments' => Appointment::whereIn('status', ['confirmed', 'pending'])->count(),
            'pending_invoices'  => Invoice::where('status', 'pending')->count(),
        ];

        $recentUsers = User::latest()->take(5)->get();
        $recentAppointments = Appointment::with(['client', 'accountant', 'service'])->latest()->take(5)->get();
        $recentLogs = ActivityLog::with('user')->latest()->take(10)->get();

        return view('admin.dashboard', compact('stats', 'recentUsers', 'recentAppointments', 'recentLogs'));
    }
}
