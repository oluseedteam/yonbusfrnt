<x-admin-layout>
    <!-- Welcome Header -->
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 dark:text-white font-heading">
                Admin System Overview ⚡
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                YONBUS Tax & Accounting Services Inc. platform administration and audit control.
            </p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.users') }}" class="btn-primary text-xs">+ Add New User</a>
        </div>
    </div>

    <!-- 4 Core Metric Widgets -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="card-box">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase font-heading">Total Platform Users</span>
                <div class="w-10 h-10 rounded-xl bg-blue-50 dark:bg-blue-950/50 text-[#005DFF] flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
            </div>
            <div class="text-3xl font-extrabold text-gray-900 dark:text-white font-heading mt-2">{{ $stats['total_users'] }}</div>
            <p class="text-xs text-gray-500 mt-1">{{ $stats['total_clients'] }} Clients, {{ $stats['total_accountants'] }} Accountants</p>
        </div>

        <div class="card-box">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase font-heading">Total Revenue Collected</span>
                <div class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <div class="text-3xl font-extrabold text-gray-900 dark:text-white font-heading mt-2">${{ number_format($stats['total_revenue'], 2) }}</div>
            <p class="text-xs text-emerald-600 font-medium mt-1">Paid invoice total</p>
        </div>

        <div class="card-box">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase font-heading">Active Appointments</span>
                <div class="w-10 h-10 rounded-xl bg-purple-50 dark:bg-purple-950/50 text-purple-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
            </div>
            <div class="text-3xl font-extrabold text-gray-900 dark:text-white font-heading mt-2">{{ $stats['active_appointments'] }}</div>
            <p class="text-xs text-purple-600 font-medium mt-1">Upcoming/confirmed</p>
        </div>

        <div class="card-box">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase font-heading">Pending Tax Returns</span>
                <div class="w-10 h-10 rounded-xl bg-amber-50 dark:bg-amber-950/50 text-amber-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
            </div>
            <div class="text-3xl font-extrabold text-gray-900 dark:text-white font-heading mt-2">{{ $stats['pending_returns'] }}</div>
            <p class="text-xs text-amber-600 font-medium mt-1">In progress returns</p>
        </div>
    </div>

    <!-- System Activity Log Table -->
    <div class="card-box mb-8">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-bold text-base text-gray-900 dark:text-white font-heading">Recent Audit Logs</h3>
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
</x-admin-layout>
