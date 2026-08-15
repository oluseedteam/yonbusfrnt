<x-accountant-layout>
    <!-- Welcome Header -->
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 dark:text-white font-heading">
                Accountant Dashboard 📊
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Welcome back, {{ $accountant->name }}. Manage your assigned clients, appointments, and tax filings.
            </p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('accountant.invoices') }}" class="btn-secondary text-xs">Generate Invoice</a>
            <a href="{{ route('accountant.tax-returns') }}" class="btn-primary text-xs">+ Process Tax Return</a>
        </div>
    </div>

    <!-- 4 Stats Widgets -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="card-box">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase font-heading">Total Clients</span>
                <div class="w-10 h-10 rounded-xl bg-blue-50 dark:bg-blue-950/50 text-[#2563EB] flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
            </div>
            <div class="text-3xl font-extrabold text-gray-900 dark:text-white font-heading mt-2">{{ $stats['clients'] }}</div>
            <p class="text-xs text-gray-500 mt-1">Active client accounts</p>
        </div>

        <div class="card-box">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase font-heading">Pending Tax Returns</span>
                <div class="w-10 h-10 rounded-xl bg-amber-50 dark:bg-amber-950/50 text-amber-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
            </div>
            <div class="text-3xl font-extrabold text-gray-900 dark:text-white font-heading mt-2">{{ $stats['pending_returns'] }}</div>
            <p class="text-xs text-amber-600 font-medium mt-1">Requires review & processing</p>
        </div>

        <div class="card-box">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase font-heading">Upcoming Meetings</span>
                <div class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
            </div>
            <div class="text-3xl font-extrabold text-gray-900 dark:text-white font-heading mt-2">{{ $stats['upcoming_meetings'] }}</div>
            <p class="text-xs text-emerald-600 font-medium mt-1">Scheduled appointments</p>
        </div>

        <div class="card-box">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase font-heading">Total Billed Revenue</span>
                <div class="w-10 h-10 rounded-xl bg-purple-50 dark:bg-purple-950/50 text-purple-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <div class="text-3xl font-extrabold text-gray-900 dark:text-white font-heading mt-2">${{ number_format($stats['revenue'], 2) }}</div>
            <p class="text-xs text-purple-600 font-medium mt-1">Paid invoices total</p>
        </div>
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Upcoming Appointments -->
        <div class="card-box">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-base text-gray-900 dark:text-white font-heading">Upcoming Client Meetings</h3>
                <a href="{{ route('accountant.appointments') }}" class="text-xs font-semibold text-[#2563EB] hover:underline">View All</a>
            </div>
            <div class="space-y-3">
                @forelse($upcomingAppointments as $appt)
                    <div class="p-3.5 rounded-xl bg-gray-50 dark:bg-gray-800/50 flex items-center justify-between border border-gray-100 dark:border-gray-700/50">
                        <div class="flex items-center gap-3">
                            <img src="{{ $appt->client?->avatar_url }}" class="w-10 h-10 rounded-xl object-cover">
                            <div>
                                <h4 class="font-bold text-xs text-gray-900 dark:text-white font-heading">{{ $appt->client?->name }}</h4>
                                <p class="text-[11px] text-gray-500">{{ $appt->service?->name }} • {{ $appt->date->format('M j, Y') }} at {{ date('g:i A', strtotime($appt->time)) }}</p>
                            </div>
                        </div>
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-semibold uppercase tracking-wider {{ $appt->status_color }}">
                            {{ $appt->status }}
                        </span>
                    </div>
                @empty
                    <p class="text-xs text-gray-500 text-center py-4">No upcoming meetings.</p>
                @endforelse
            </div>
        </div>

        <!-- Pending Tax Returns -->
        <div class="card-box">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-base text-gray-900 dark:text-white font-heading">Tax Returns Needing Action</h3>
                <a href="{{ route('accountant.tax-returns') }}" class="text-xs font-semibold text-[#2563EB] hover:underline">View All</a>
            </div>
            <div class="space-y-3">
                @forelse($pendingTaxReturns as $tr)
                    <div class="p-3.5 rounded-xl bg-gray-50 dark:bg-gray-800/50 flex items-center justify-between border border-gray-100 dark:border-gray-700/50">
                        <div>
                            <h4 class="font-bold text-xs text-gray-900 dark:text-white font-heading">{{ $tr->title }} ({{ $tr->year }})</h4>
                            <p class="text-[11px] text-gray-500">Client: {{ $tr->client?->name }}</p>
                        </div>
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-semibold uppercase tracking-wider {{ $tr->status_color }}">
                            {{ str_replace('_', ' ', $tr->status) }}
                        </span>
                    </div>
                @empty
                    <p class="text-xs text-gray-500 text-center py-4">No pending tax returns.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-accountant-layout>
