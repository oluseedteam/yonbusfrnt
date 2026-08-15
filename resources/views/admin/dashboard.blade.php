<x-admin-layout>
    <!-- Welcome Header -->
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 dark:text-white font-heading">
                Admin Control Center ⚡
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                YONBUS Tax & Accounting Services Inc. analytics dashboard and audit center.
            </p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.reports') }}" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow transition">📊 Export Reports</a>
            <a href="{{ route('admin.users') }}" class="btn-primary text-xs">+ Add User</a>
        </div>
    </div>

    <!-- 6 Detailed Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8" data-aos="fade-up" data-aos-delay="100">
        <div class="card-box">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-gray-500 uppercase font-heading">Total Bookings</span>
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-[#005DFF] flex items-center justify-center font-bold">📅</div>
            </div>
            <div class="text-3xl font-extrabold text-gray-900 dark:text-white font-heading mt-2">{{ $stats['total_bookings'] }}</div>
            <div class="text-xs text-slate-500 mt-1">Confirmed: {{ $stats['upcoming_appointments'] }} | Completed: {{ $stats['completed_appointments'] }}</div>
        </div>

        <div class="card-box">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-gray-500 uppercase font-heading">Total Revenue Collected</span>
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold">💵</div>
            </div>
            <div class="text-3xl font-extrabold text-emerald-600 font-heading mt-2">${{ number_format($stats['total_revenue'], 2) }}</div>
            <div class="text-xs text-emerald-600 font-medium mt-1">Paid Invoices Total</div>
        </div>

        <div class="card-box">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-gray-500 uppercase font-heading">Active Clients</span>
                <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center font-bold">👥</div>
            </div>
            <div class="text-3xl font-extrabold text-gray-900 dark:text-white font-heading mt-2">{{ $stats['total_clients'] }}</div>
            <div class="text-xs text-purple-600 font-medium mt-1">Staff Accountants: {{ $stats['total_accountants'] }}</div>
        </div>

        <div class="card-box">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-gray-500 uppercase font-heading">Pending Tax Returns</span>
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold">📄</div>
            </div>
            <div class="text-3xl font-extrabold text-amber-600 font-heading mt-2">{{ $stats['pending_returns'] }}</div>
            <div class="text-xs text-amber-600 font-medium mt-1">In progress filing returns</div>
        </div>
    </div>

    <!-- Quick Actions Row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8" data-aos="fade-up" data-aos-delay="150">
        <a href="{{ route('admin.services') }}" class="card-box flex items-center gap-4 hover:border-[#005DFF] border-2 border-transparent transition-all group">
            <div class="w-12 h-12 rounded-xl bg-[#005DFF] text-white flex items-center justify-center text-xl font-bold shadow-md group-hover:scale-105 transition-transform">💼</div>
            <div>
                <p class="text-xs font-bold text-gray-500 uppercase font-heading">Services & Pricing</p>
                <p class="text-sm font-extrabold text-gray-900 dark:text-white font-heading">Manage Services</p>
                <p class="text-[11px] text-[#005DFF] font-medium">Add · Edit · Delete → Live on Website</p>
            </div>
        </a>
        <a href="{{ route('admin.appointments') }}" class="card-box flex items-center gap-4 hover:border-emerald-500 border-2 border-transparent transition-all group">
            <div class="w-12 h-12 rounded-xl bg-emerald-500 text-white flex items-center justify-center text-xl font-bold shadow-md group-hover:scale-105 transition-transform">📅</div>
            <div>
                <p class="text-xs font-bold text-gray-500 uppercase font-heading">Booking Calendar</p>
                <p class="text-sm font-extrabold text-gray-900 dark:text-white font-heading">Appointments</p>
                <p class="text-[11px] text-emerald-600 font-medium">Confirm · Reschedule · Cancel</p>
            </div>
        </a>
        <a href="{{ route('admin.users') }}" class="card-box flex items-center gap-4 hover:border-purple-500 border-2 border-transparent transition-all group">
            <div class="w-12 h-12 rounded-xl bg-purple-500 text-white flex items-center justify-center text-xl font-bold shadow-md group-hover:scale-105 transition-transform">👥</div>
            <div>
                <p class="text-xs font-bold text-gray-500 uppercase font-heading">Client Database</p>
                <p class="text-sm font-extrabold text-gray-900 dark:text-white font-heading">User Management</p>
                <p class="text-[11px] text-purple-600 font-medium">Add · Edit · Assign Roles</p>
            </div>
        </a>
        <a href="{{ route('admin.invoices') }}" class="card-box flex items-center gap-4 hover:border-amber-500 border-2 border-transparent transition-all group">
            <div class="w-12 h-12 rounded-xl bg-amber-500 text-white flex items-center justify-center text-xl font-bold shadow-md group-hover:scale-105 transition-transform">💵</div>
            <div>
                <p class="text-xs font-bold text-gray-500 uppercase font-heading">Billing</p>
                <p class="text-sm font-extrabold text-gray-900 dark:text-white font-heading">Invoices</p>
                <p class="text-[11px] text-amber-600 font-medium">Issue · Track · Mark Paid</p>
            </div>
        </a>
    </div>

    <!-- Chart.js Visualizations Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-8" data-aos="fade-up" data-aos-delay="200">
        <!-- Monthly Revenue Chart -->
        <div class="lg:col-span-8 card-box">
            <h3 class="font-bold text-base text-gray-900 dark:text-white font-heading mb-4">Monthly Revenue Overview ($ CAD)</h3>
            <div class="h-64">
                <canvas id="revenueChartCanvas"></canvas>
            </div>
        </div>

        <!-- Service Popularity Chart -->
        <div class="lg:col-span-4 card-box">
            <h3 class="font-bold text-base text-gray-900 dark:text-white font-heading mb-4">Service Popularity Breakdown</h3>
            <div class="h-64">
                <canvas id="serviceChartCanvas"></canvas>
            </div>
        </div>
    </div>

    <!-- System Activity Log Table -->
    <div class="card-box mb-8" data-aos="fade-up" data-aos-delay="300">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-bold text-base text-gray-900 dark:text-white font-heading">Recent System Activity Audit</h3>
            <a href="{{ route('admin.activity-logs') }}" class="text-xs font-semibold text-[#005DFF] hover:underline">View All Logs</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-gray-50 dark:bg-gray-800 text-gray-500 uppercase font-semibold">
                    <tr>
                        <th class="p-3">User</th>
                        <th class="p-3">Action</th>
                        <th class="p-3">Description</th>
                        <th class="p-3">IP Address</th>
                        <th class="p-3">Time</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @foreach($recentLogs as $log)
                        <tr>
                            <td class="p-3 font-medium text-gray-900 dark:text-white">{{ $log->user?->name ?? 'System' }}</td>
                            <td class="p-3"><span class="px-2 py-0.5 rounded-full bg-blue-50 text-[#005DFF] font-medium text-[11px]">{{ $log->action }}</span></td>
                            <td class="p-3 text-gray-600 dark:text-gray-400">{{ $log->description }}</td>
                            <td class="p-3 text-gray-400 font-mono text-[11px]">{{ $log->ip_address }}</td>
                            <td class="p-3 text-gray-400">{{ $log->created_at->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Chart.js Script Injection -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Revenue Chart
            const revCtx = document.getElementById('revenueChartCanvas').getContext('2d');
            new Chart(revCtx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($revenueChart['labels']) !!},
                    datasets: [{
                        label: 'Revenue ($)',
                        data: {!! json_encode($revenueChart['data']) !!},
                        backgroundColor: '#005DFF',
                        borderRadius: 8,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, grid: { color: '#F1F5F9' } },
                        x: { grid: { display: false } }
                    }
                }
            });

            // Service Doughnut Chart
            const srvCtx = document.getElementById('serviceChartCanvas').getContext('2d');
            new Chart(srvCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($serviceChart['labels']) !!},
                    datasets: [{
                        data: {!! json_encode($serviceChart['data']) !!},
                        backgroundColor: ['#005DFF', '#00A3FF', '#38BDF8', '#818CF8', '#A7F3D0']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 11 } } } }
                }
            });
        });
    </script>
</x-admin-layout>
