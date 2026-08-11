<?php

namespace App\Livewire\Admin;

use App\Services\ReportService;
use App\Models\Report;
use Livewire\Component;

class ReportManager extends Component
{
    public $reportType = 'booking'; // booking, revenue, service, staff, client
    public $dateFrom = '';
    public $dateTo = '';

    public function mount()
    {
        $this->dateFrom = now()->startOfMonth()->format('Y-m-d');
        $this->dateTo   = now()->endOfMonth()->format('Y-m-d');
    }

    protected function service(): ReportService
    {
        return app(ReportService::class);
    }

    public function exportExcel()
    {
        $fileName = 'YONBUS_' . ucfirst($this->reportType) . '_Report_' . date('Ymd_His') . '.xls';

        $headers = [
            "Content-type"        => "application/vnd.ms-excel",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        return $this->generateFileStream($fileName, $headers, "\t");
    }

    public function exportCsv()
    {
        $fileName = 'YONBUS_' . ucfirst($this->reportType) . '_Report_' . date('Ymd_His') . '.csv';

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        return $this->generateFileStream($fileName, $headers, ",");
    }

    protected function generateFileStream($fileName, $headers, $delimiter = ",")
    {
        $callback = function () use ($delimiter) {
            $file = fopen('php://output', 'w');
            $filters = ['date_from' => $this->dateFrom, 'date_to' => $this->dateTo];

            if ($this->reportType === 'booking') {
                fputcsv($file, ['Ref #', 'Client', 'Accountant', 'Service', 'Date', 'Time', 'Status'], $delimiter);
                $report = $this->service()->appointmentReport($filters);
                foreach ($report['records'] as $app) {
                    fputcsv($file, [
                        $app->appointment_number,
                        $app->client->name ?? 'N/A',
                        $app->accountant->name ?? 'N/A',
                        $app->service->name ?? 'N/A',
                        $app->date?->format('Y-m-d'),
                        $app->time,
                        $app->status
                    ], $delimiter);
                }
            } elseif ($this->reportType === 'revenue') {
                fputcsv($file, ['Invoice #', 'Client', 'Total Amount ($)', 'Status', 'Date'], $delimiter);
                $report = $this->service()->revenueReport($filters);
                foreach ($report['records'] as $inv) {
                    fputcsv($file, [
                        $inv->invoice_number,
                        $inv->client->name ?? 'N/A',
                        $inv->total_amount,
                        $inv->status,
                        $inv->created_at->format('Y-m-d')
                    ], $delimiter);
                }
            } elseif ($this->reportType === 'staff') {
                fputcsv($file, ['Accountant', 'Total Appointments', 'Completed', 'Cancelled', 'Completion Rate (%)'], $delimiter);
                $report = $this->service()->staffPerformanceReport($filters);
                foreach ($report['records'] as $rec) {
                    fputcsv($file, [
                        $rec['accountant']->name,
                        $rec['total'],
                        $rec['completed'],
                        $rec['cancelled'],
                        $rec['completion_rate']
                    ], $delimiter);
                }
            } else {
                fputcsv($file, ['Client Name', 'Email', 'Total Appointments', 'Completed', 'Last Active'], $delimiter);
                $report = $this->service()->clientActivityReport($filters);
                foreach ($report['records'] as $rec) {
                    fputcsv($file, [
                        $rec['client']->name,
                        $rec['client']->email,
                        $rec['total_appointments'],
                        $rec['completed'],
                        $rec['last_active'] ?? 'Never'
                    ], $delimiter);
                }
            }

            fclose($file);
        };

        Report::create([
            'title'        => ucfirst($this->reportType) . ' Report (' . $this->dateFrom . ' to ' . $this->dateTo . ')',
            'type'         => $this->reportType,
            'generated_by' => auth()->id() ?? 1,
            'file_path'    => $fileName,
            'status'       => 'completed',
        ]);

        return response()->stream($callback, 200, $headers);
    }

    public function render()
    {
        $summary = $this->service()->dashboardSummary();
        $recentReports = Report::with('generator')->orderBy('created_at', 'desc')->take(10)->get();

        return view('livewire.admin.report-manager', compact('summary', 'recentReports'))->layout('layouts.admin');
    }
}
