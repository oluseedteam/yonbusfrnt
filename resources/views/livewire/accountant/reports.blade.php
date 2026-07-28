<div>
    <div class="mb-8">
        <h1 class="text-2xl font-extrabold text-gray-900 dark:text-white font-heading">Financial Reports & Performance</h1>
        <p class="text-xs text-gray-500 mt-1">Client billing metrics, revenue distribution, and monthly breakdown.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <div class="lg:col-span-2 card-box">
            <h3 class="text-base font-bold text-gray-900 dark:text-white font-heading mb-4">Monthly Revenue ($)</h3>
            <div class="h-64 relative">
                <canvas id="acctRevenueChart"></canvas>
            </div>
        </div>
        <div class="card-box flex flex-col justify-between">
            <div>
                <h3 class="text-base font-bold text-gray-900 dark:text-white font-heading mb-2">Practice Overview</h3>
                <div class="space-y-4 text-xs mt-4">
                    <div class="p-3 rounded-xl bg-blue-50 dark:bg-blue-950/40">
                        <span class="text-gray-500 font-semibold block">Total Managed Clients</span>
                        <span class="text-2xl font-extrabold text-[#005DFF] font-heading">{{ $clientCount }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:navigated', initAcctChart);
        document.addEventListener('DOMContentLoaded', initAcctChart);

        function initAcctChart() {
            const ctx = document.getElementById('acctRevenueChart');
            if (!ctx) return;
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($labels),
                    datasets: [{
                        label: 'Revenue ($)',
                        data: @json($revenueData),
                        borderColor: '#005DFF',
                        backgroundColor: 'rgba(0, 93, 255, 0.1)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } }
                }
            });
        }
    </script>
</div>
