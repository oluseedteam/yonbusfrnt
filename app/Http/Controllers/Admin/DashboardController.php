<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Appointment;
use App\Models\TaxReturn;
use App\Models\Invoice;
use App\Models\ActivityLog;
use App\Services\ReportService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request, ReportService $reportService)
    {
        $stats = [
            'total_bookings'        => Appointment::count(),
            'upcoming_appointments' => Appointment::where('status', 'confirmed')->where('date', '>=', now()->toDateString())->count(),
            'completed_appointments' => Appointment::where('status', 'completed')->count(),
            'cancelled_appointments' => Appointment::where('status', 'cancelled')->count(),
            'total_users'           => User::count(),
            'total_clients'         => User::role('client')->count(),
            'total_accountants'     => User::role('accountant')->count(),
            'total_revenue'         => Invoice::where('status', 'paid')->sum('total_amount') ?? 0,
            'pending_returns'       => TaxReturn::whereNotIn('status', ['completed'])->count(),
            'active_appointments'   => Appointment::whereIn('status', ['confirmed', 'pending'])->count(),
            'pending_invoices'      => Invoice::where('status', 'pending')->count(),
        ];

        // Real Database Monthly Revenue Chart Data
        $revenueChart = $reportService->monthlyRevenueChart();

        // Real Database Service Popularity Chart Data
        $servicePopularity = $reportService->serviceReport();
        $serviceLabels = $servicePopularity['records']->pluck('service.name')->filter()->values()->toArray();
        $serviceData   = $servicePopularity['records']->pluck('total')->values()->toArray();

        $serviceChart = [
            'labels' => !empty($serviceLabels) ? $serviceLabels : ['No Services Booked Yet'],
            'data'   => !empty($serviceData)   ? $serviceData   : [0],
        ];

        $recentUsers        = User::with('roles')->latest()->take(5)->get();
        $recentAppointments = Appointment::with(['client', 'accountant', 'service'])->latest()->take(5)->get();
        $recentLogs         = ActivityLog::with('user')->latest()->take(10)->get();

        return view('admin.dashboard', compact(
            'stats', 'revenueChart', 'serviceChart', 'recentUsers', 'recentAppointments', 'recentLogs'
        ));
    }
}
