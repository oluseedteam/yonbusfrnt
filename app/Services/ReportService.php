<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\Invoice;
use App\Models\User;
use App\Models\Service;
use Illuminate\Support\Carbon;

class ReportService
{
    /**
     * Appointment Report — real DB queries, no mock data.
     */
    public function appointmentReport(array $filters = []): array
    {
        $query = Appointment::with(['client', 'accountant', 'service'])
            ->when(!empty($filters['date_from']), fn($q) => $q->where('date', '>=', $filters['date_from']))
            ->when(!empty($filters['date_to']),   fn($q) => $q->where('date', '<=', $filters['date_to']))
            ->when(!empty($filters['status']),    fn($q) => $q->where('status', $filters['status']))
            ->when(!empty($filters['accountant_id']), fn($q) => $q->where('accountant_id', $filters['accountant_id']))
            ->when(!empty($filters['service_id']),    fn($q) => $q->where('service_id', $filters['service_id']));

        $records = $query->orderBy('date', 'desc')->get();

        return [
            'records'   => $records,
            'total'     => $records->count(),
            'pending'   => $records->where('status', 'pending')->count(),
            'confirmed' => $records->where('status', 'confirmed')->count(),
            'completed' => $records->where('status', 'completed')->count(),
            'cancelled' => $records->where('status', 'cancelled')->count(),
        ];
    }

    /**
     * Revenue Report — from invoices table.
     */
    public function revenueReport(array $filters = []): array
    {
        $query = Invoice::with(['client', 'service'])
            ->when(!empty($filters['date_from']), fn($q) => $q->where('created_at', '>=', $filters['date_from']))
            ->when(!empty($filters['date_to']),   fn($q) => $q->where('created_at', '<=', $filters['date_to'] . ' 23:59:59'))
            ->when(!empty($filters['service_id']),fn($q) => $q->where('service_id', $filters['service_id']));

        $records = $query->orderBy('created_at', 'desc')->get();

        $byMonth = $records->groupBy(fn($inv) => $inv->created_at->format('Y-m'))
            ->map(fn($group) => [
                'month'   => $group->first()->created_at->format('M Y'),
                'total'   => $group->sum('total_amount'),
                'paid'    => $group->where('status', 'paid')->sum('total_amount'),
                'pending' => $group->where('status', 'pending')->sum('total_amount'),
                'count'   => $group->count(),
            ]);

        return [
            'records'             => $records,
            'total_revenue'       => $records->where('status', 'paid')->sum('total_amount'),
            'total_outstanding'   => $records->where('status', 'pending')->sum('total_amount'),
            'invoice_count'       => $records->count(),
            'monthly_breakdown'   => $byMonth->values(),
        ];
    }

    /**
     * Service Popularity Report.
     */
    public function serviceReport(array $filters = []): array
    {
        $query = Appointment::selectRaw('service_id, count(*) as total, 
                sum(case when status="completed" then 1 else 0 end) as completed,
                sum(case when status="cancelled" then 1 else 0 end) as cancelled')
            ->with('service')
            ->groupBy('service_id')
            ->when(!empty($filters['date_from']), fn($q) => $q->where('date', '>=', $filters['date_from']))
            ->when(!empty($filters['date_to']),   fn($q) => $q->where('date', '<=', $filters['date_to']));

        return [
            'records' => $query->orderBy('total', 'desc')->get(),
        ];
    }

    /**
     * Staff Performance Report.
     */
    public function staffPerformanceReport(array $filters = []): array
    {
        $accountants = User::role('accountant')
            ->with(['accountantAppointments' => function ($q) use ($filters) {
                $q->when(!empty($filters['date_from']), fn($q) => $q->where('date', '>=', $filters['date_from']))
                  ->when(!empty($filters['date_to']),   fn($q) => $q->where('date', '<=', $filters['date_to']));
            }])
            ->when(!empty($filters['accountant_id']), fn($q) => $q->where('id', $filters['accountant_id']))
            ->get()
            ->map(function ($accountant) {
                $apps = $accountant->accountantAppointments;
                return [
                    'accountant'  => $accountant,
                    'total'       => $apps->count(),
                    'completed'   => $apps->where('status', 'completed')->count(),
                    'cancelled'   => $apps->where('status', 'cancelled')->count(),
                    'pending'     => $apps->where('status', 'pending')->count(),
                    'completion_rate' => $apps->count() > 0
                        ? round($apps->where('status', 'completed')->count() / $apps->count() * 100, 1)
                        : 0,
                ];
            });

        return ['records' => $accountants];
    }

    /**
     * Client Activity Report.
     */
    public function clientActivityReport(array $filters = []): array
    {
        $query = User::role('client')
            ->with(['appointments' => fn($q) => $q
                ->when(!empty($filters['date_from']), fn($q) => $q->where('date', '>=', $filters['date_from']))
                ->when(!empty($filters['date_to']),   fn($q) => $q->where('date', '<=', $filters['date_to']))
            ])
            ->when(!empty($filters['search']), fn($q) => $q
                ->where('first_name', 'like', '%' . $filters['search'] . '%')
                ->orWhere('last_name',  'like', '%' . $filters['search'] . '%')
                ->orWhere('email',      'like', '%' . $filters['search'] . '%')
            );

        $records = $query->get()->map(function ($client) {
            $apps = $client->appointments;
            return [
                'client'      => $client,
                'total_appointments' => $apps->count(),
                'completed'   => $apps->where('status', 'completed')->count(),
                'last_active' => $apps->sortByDesc('date')->first()?->date,
            ];
        });

        return ['records' => $records];
    }

    /**
     * Dashboard Summary — strictly live data.
     */
    public function dashboardSummary(): array
    {
        return [
            'total_clients'        => User::role('client')->count(),
            'total_accountants'    => User::role('accountant')->count(),
            'total_appointments'   => Appointment::count(),
            'upcoming_appointments'=> Appointment::where('status', 'confirmed')
                                        ->where('date', '>=', now()->toDateString())
                                        ->count(),
            'completed_appointments' => Appointment::where('status', 'completed')->count(),
            'total_revenue'        => Invoice::where('status', 'paid')->sum('total_amount') ?? 0,
            'active_services'      => Service::where('is_active', true)->count(),
            'pending_appointments' => Appointment::where('status', 'pending')->count(),
        ];
    }

    /**
     * Monthly revenue chart data for Chart.js (last 6 months).
     */
    public function monthlyRevenueChart(): array
    {
        $months = collect(range(5, 0))->map(fn($i) => now()->subMonths($i)->format('Y-m'))->values();

        $data = $months->map(function ($month) {
            $revenue = Invoice::where('status', 'paid')
                ->where(\DB::raw("DATE_FORMAT(created_at, '%Y-%m')"), $month)
                ->sum('total_amount');

            return [
                'month'   => Carbon::parse($month . '-01')->format('M Y'),
                'revenue' => round($revenue, 2),
            ];
        });

        return [
            'labels' => $data->pluck('month')->toArray(),
            'data'   => $data->pluck('revenue')->toArray(),
        ];
    }
}
