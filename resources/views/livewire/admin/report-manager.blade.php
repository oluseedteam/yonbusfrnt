<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold font-heading text-slate-900 dark:text-white">Reporting & Analytics System</h1>
            <p class="text-slate-500 text-sm">Generate and export comprehensive booking, revenue, service, staff, and client reports.</p>
        </div>
        <div class="flex flex-wrap items-center gap-3">
            <button wire:click="exportExcel" class="px-4 py-2.5 bg-[#005DFF] hover:bg-[#005DFF] text-white font-bold text-xs rounded-xl shadow-md transition flex items-center">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Export Excel
            </button>
            <button wire:click="exportCsv" class="px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md transition flex items-center">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                Export CSV
            </button>
            <button onclick="downloadReportPicture()" class="px-4 py-2.5 bg-[#063B8F] hover:bg-[#063B8F] text-white font-bold text-xs rounded-xl shadow-md transition flex items-center">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                Export Picture (PNG)
            </button>
        </div>
    </div>

    <div id="report-dashboard-container" class="space-y-6 bg-slate-50 dark:bg-slate-900/40 p-4 rounded-2xl">
    <!-- Metrics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm space-y-2">
            <div class="text-xs font-bold text-slate-500 uppercase">Total Bookings</div>
            <div class="text-3xl font-extrabold text-slate-900 dark:text-white font-heading">{{ number_format($summary['total_appointments'] ?? 0) }}</div>
            <div class="text-xs text-blue-600 font-medium">All Time System Total</div>
        </div>

        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm space-y-2">
            <div class="text-xs font-bold text-slate-500 uppercase">Total Revenue</div>
            <div class="text-3xl font-extrabold text-[#005DFF] font-heading">${{ number_format($summary['total_revenue'] ?? 0, 2) }}</div>
            <div class="text-xs text-[#005DFF] font-medium">Paid Invoices</div>
        </div>

        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm space-y-2">
            <div class="text-xs font-bold text-slate-500 uppercase">Active Clients</div>
            <div class="text-3xl font-extrabold text-slate-900 dark:text-white font-heading">{{ number_format($summary['total_clients'] ?? 0) }}</div>
            <div class="text-xs text-slate-500 font-medium">Registered Platform Users</div>
        </div>

        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm space-y-2">
            <div class="text-xs font-bold text-slate-500 uppercase">Completed Filings</div>
            <div class="text-3xl font-extrabold text-[#005DFF] font-heading">{{ number_format($summary['completed_appointments'] ?? 0) }}</div>
            <div class="text-xs text-slate-500 font-medium">Verified Tax Consultations</div>
        </div>
    </div>

    <!-- Filter Form -->
    <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm space-y-4">
        <h3 class="text-base font-bold font-heading text-slate-900 dark:text-white">Configure Report Generation</h3>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 dark:text-slate-300 mb-1">Report Module Type</label>
                <select wire:model.live="reportType" class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-[#005DFF]">
                    <option value="booking">Booking & Appointment Reports</option>
                    <option value="revenue">Revenue & Invoice Reports</option>
                    <option value="service">Service Popularity Reports</option>
                    <option value="staff">Staff Performance Reports</option>
                    <option value="client">Client Growth & Activity Reports</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 dark:text-slate-300 mb-1">Date From</label>
                <input type="date" wire:model.live="dateFrom" class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-[#005DFF]">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 dark:text-slate-300 mb-1">Date To</label>
                <input type="date" wire:model.live="dateTo" class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-[#005DFF]">
            </div>
        </div>
    </div>

    <!-- Generated Reports Log Table -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden space-y-4 p-6">
        <h3 class="text-base font-bold font-heading text-slate-900 dark:text-white">Recent Generated Reports History</h3>
        <table class="w-full text-left text-sm border-collapse">
            <thead class="bg-slate-50 dark:bg-slate-900/50 text-slate-500 font-bold text-xs uppercase border-b border-slate-200 dark:border-slate-700">
                <tr>
                    <th class="py-3 px-4">Report Title</th>
                    <th class="py-3 px-4">Type</th>
                    <th class="py-3 px-4">Generated By</th>
                    <th class="py-3 px-4">Date</th>
                    <th class="py-3 px-4 text-right">Download</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                @forelse($recentReports as $rep)
                    <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-700/50">
                        <td class="py-3 px-4 font-semibold text-slate-900 dark:text-white">{{ $rep->title }}</td>
                        <td class="py-3 px-4 text-xs"><span class="px-2 py-0.5 bg-blue-50 text-[#005DFF] font-bold rounded uppercase">{{ $rep->type }}</span></td>
                        <td class="py-3 px-4 text-xs text-slate-600 dark:text-slate-400">{{ $rep->generator->name ?? 'Admin' }}</td>
                        <td class="py-3 px-4 text-xs text-slate-500">{{ $rep->created_at->format('M d, Y H:i') }}</td>
                        <td class="py-3 px-4 text-right">
                            <button wire:click="exportCsv" class="text-[#005DFF] font-bold text-xs hover:underline">Download File</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-6 text-center text-slate-500 dark:text-slate-400">No report generation history found. Click "Export Excel" or "Export CSV" to generate one.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    </div>

    <!-- Script for Exporting Picture (HTML2Canvas) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
        function downloadReportPicture() {
            const container = document.getElementById('report-dashboard-container');
            if (!container) return;
            html2canvas(container, {
                scale: 2,
                useCORS: true,
                backgroundColor: null
            }).then(canvas => {
                const link = document.createElement('a');
                link.download = 'YONBUS_Report_Analytics_' + new Date().toISOString().slice(0,10) + '.png';
                link.href = canvas.toDataURL('image/png');
                link.click();
            });
        }
    </script>
</div>
