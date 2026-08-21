<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Appointment;
use App\Models\TaxReturn;
use App\Models\Invoice;
use App\Models\ActivityLog;
use App\Models\CommunicationLog;
use App\Models\Document;
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
            'total_clients'         => User::roleSafe('client')->count(),
            'total_accountants'     => User::roleSafe('accountant')->count(),
            'total_revenue'         => Invoice::where('status', 'paid')->selectRaw('COALESCE(SUM(total_amount), SUM(amount), 0) as aggregate')->value('aggregate') ?? 0,
            'pending_returns'       => TaxReturn::whereNotIn('status', ['completed'])->count(),
            'active_appointments'   => Appointment::whereIn('status', ['confirmed', 'pending'])->count(),
            'pending_invoices'      => Invoice::where('status', 'pending')->count(),
            'total_contacts'        => CommunicationLog::where('channel', 'contact_form')->count(),
            'total_careers'         => CommunicationLog::where('channel', 'career_application')->count(),
            'unread_inquiries'      => CommunicationLog::where('is_read', false)->count(),
            'total_documents'       => Document::count(),
            'client_documents'      => Document::whereColumn('uploaded_by', 'client_id')->count(),
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

        $recentUsers             = User::with('roles')->latest()->take(5)->get();
        $recentAppointments      = Appointment::with(['client', 'accountant', 'service'])->latest()->take(5)->get();
        $recentLogs              = ActivityLog::with('user')->latest()->take(10)->get();
        $recentContactInquiries  = CommunicationLog::where('channel', 'contact_form')->latest()->take(5)->get();
        $recentCareerApps        = CommunicationLog::where('channel', 'career_application')->latest()->take(5)->get();
        $recentDocuments         = Document::with(['client.assignedAdmin', 'uploader', 'assignedAdmin'])->latest()->take(6)->get();

        return view('admin.dashboard', compact(
            'stats', 'revenueChart', 'serviceChart', 'recentUsers', 'recentAppointments', 'recentLogs',
            'recentContactInquiries', 'recentCareerApps', 'recentDocuments'
        ));
    }
}
