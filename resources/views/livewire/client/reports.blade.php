<div>
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 dark:text-white font-heading">Financial Reports</h1>
            <p class="text-xs text-gray-500 mt-1">Overview of payments, tax summaries, and expense analytics.</p>
        </div>
    </div>

    <!-- Chart Card -->
    <div class="card-box mb-8">
        <h3 class="text-base font-bold text-gray-900 dark:text-white font-heading mb-4">Paid Invoices Trend (Last 6 Months)</h3>
        <div class="h-64 relative">
            <canvas id="revenueChart"></canvas>
        </div>
    </div>

    <!-- Breakdown Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="card-box">
            <span class="text-xs text-gray-500 font-semibold uppercase">Paid Invoices</span>
            <p class="text-2xl font-extrabold text-[#005DFF] font-heading mt-1">{{ $paid }}</p>
        </div>
        <div class="card-box">
            <span class="text-xs text-gray-500 font-semibold uppercase">Pending Invoices</span>
            <p class="text-2xl font-extrabold text-amber-600 font-heading mt-1">{{ $pending }}</p>
        </div>
        <div class="card-box">
            <span class="text-xs text-gray-500 font-semibold uppercase">Overdue Invoices</span>
            <p class="text-2xl font-extrabold text-red-600 font-heading mt-1">{{ $overdue }}</p>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:navigated', initChart);
        document.addEventListener('DOMContentLoaded', initChart);

        function initChart() {
            const ctx = document.getElementById('revenueChart');
            if (!ctx) return;
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($labels),
                    datasets: [{
                        label: 'Amount Paid ($)',
                        data: @json($revenueData),
                        backgroundColor: '#005DFF',
                        borderRadius: 8,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } },
                        x: { grid: { display: false } }
                    }
                }
            });
        }
    </script>
</div>
