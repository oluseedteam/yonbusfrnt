<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Document;
use App\Models\TaxReturn;
use App\Models\Invoice;
use App\Models\Message;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = auth()->user();
        $today = now()->toDateString();

        $stats = [
            'tax_returns'           => TaxReturn::where('client_id', $user->id)->count(),
            'tax_completed'         => TaxReturn::where('client_id', $user->id)->where('status', 'completed')->count(),
            'appointments'          => Appointment::where('client_id', $user->id)->count(),
            'appointments_upcoming' => Appointment::where('client_id', $user->id)->whereIn('status', ['pending', 'confirmed'])->where('date', '>=', $today)->count(),
            'documents'             => Document::where('client_id', $user->id)->count(),
            'invoices'              => Invoice::where('client_id', $user->id)->count(),
            'invoices_pending'      => Invoice::where('client_id', $user->id)->where('status', 'pending')->count(),
        ];

        $upcomingAppointment = Appointment::where('client_id', $user->id)
            ->whereIn('status', ['confirmed', 'pending'])
            ->where('date', '>=', $today)
            ->with(['service', 'accountant'])
            ->orderBy('date')
            ->first();

        $recentActivity = ActivityLog::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $recentInvoices  = Invoice::where('client_id', $user->id)->latest()->take(3)->get();
        $recentDocuments = Document::where('client_id', $user->id)->latest()->take(5)->get();
        $adminDocuments  = Document::where('client_id', $user->id)->where('uploaded_by', '!=', $user->id)->with('uploader')->latest()->take(5)->get();

        $user = auth()->user()->load(['assignedAdmin.accountantProfile', 'clientProfile']);
        $consultant = $user->assignedAdmin ?? \App\Models\User::where('email', 'olubukunola@yonbustax.ca')->first();

        return view('client.dashboard', compact(
            'user', 'consultant', 'stats', 'upcomingAppointment',
            'recentActivity', 'recentInvoices', 'recentDocuments', 'adminDocuments'
        ));
    }
}
