<x-client-layout>
    <!-- Welcome Header -->
    <div class="mb-8">
        <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 dark:text-white font-heading">
            Welcome back, {{ explode(' ', $user->name)[0] }}! 👋
        </h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
            Here's what's happening with your tax & accounting account today.
        </p>
    </div>

    <!-- 4 Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Tax Returns Card -->
        <div class="card-box hover:shadow-soft-hover transition-all duration-300 relative overflow-hidden group">
            <div class="flex items-start justify-between">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 dark:bg-blue-950/50 text-[#005DFF] flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider block font-heading">Tax Returns</span>
                    <span class="text-3xl font-extrabold text-gray-900 dark:text-white font-heading mt-1 block">{{ $stats['tax_returns'] }}</span>
                    <span class="text-xs font-medium text-emerald-600 dark:text-emerald-400 mt-1 block">{{ $stats['tax_completed'] }} Completed</span>
                </div>
            </div>
            <a href="{{ route('client.tax-returns') }}" class="mt-4 pt-3 border-t border-gray-100 dark:border-gray-800 text-xs font-semibold text-[#005DFF] flex items-center gap-1 group-hover:gap-2 transition-all">
                View all &rarr;
            </a>
        </div>

        <!-- Appointments Card -->
        <div class="card-box hover:shadow-soft-hover transition-all duration-300 relative overflow-hidden group">
            <div class="flex items-start justify-between">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider block font-heading">Appointments</span>
                    <span class="text-3xl font-extrabold text-gray-900 dark:text-white font-heading mt-1 block">{{ $stats['appointments'] }}</span>
                    <span class="text-xs font-medium text-blue-600 dark:text-blue-400 mt-1 block">{{ $stats['appointments_upcoming'] }} Upcoming</span>
                </div>
            </div>
            <a href="{{ route('client.appointments') }}" class="mt-4 pt-3 border-t border-gray-100 dark:border-gray-800 text-xs font-semibold text-[#005DFF] flex items-center gap-1 group-hover:gap-2 transition-all">
                View all &rarr;
            </a>
        </div>

        <!-- Documents Card -->
        <div class="card-box hover:shadow-soft-hover transition-all duration-300 relative overflow-hidden group">
            <div class="flex items-start justify-between">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-purple-50 dark:bg-purple-950/50 text-purple-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                    </div>
                    <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider block font-heading">Documents</span>
                    <span class="text-3xl font-extrabold text-gray-900 dark:text-white font-heading mt-1 block">{{ $stats['documents'] }}</span>
                    <span class="text-xs font-medium text-purple-600 dark:text-purple-400 mt-1 block">Uploaded Files</span>
                </div>
            </div>
            <a href="{{ route('client.documents') }}" class="mt-4 pt-3 border-t border-gray-100 dark:border-gray-800 text-xs font-semibold text-[#005DFF] flex items-center gap-1 group-hover:gap-2 transition-all">
                View all &rarr;
            </a>
        </div>

        <!-- Invoices Card -->
        <div class="card-box hover:shadow-soft-hover transition-all duration-300 relative overflow-hidden group">
            <div class="flex items-start justify-between">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-amber-50 dark:bg-amber-950/50 text-amber-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider block font-heading">Invoices</span>
                    <span class="text-3xl font-extrabold text-gray-900 dark:text-white font-heading mt-1 block">{{ $stats['invoices'] }}</span>
                    <span class="text-xs font-medium text-amber-600 dark:text-amber-400 mt-1 block">{{ $stats['invoices_pending'] }} Pending</span>
                </div>
            </div>
            <a href="{{ route('client.invoices') }}" class="mt-4 pt-3 border-t border-gray-100 dark:border-gray-800 text-xs font-semibold text-[#005DFF] flex items-center gap-1 group-hover:gap-2 transition-all">
                View all &rarr;
            </a>
        </div>
    </div>

    <!-- Main Grid: Recent Activity & Upcoming Meeting -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        <!-- Recent Activity (2 cols) -->
        <div class="lg:col-span-2 card-box">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-base font-bold text-gray-900 dark:text-white font-heading">Recent Activity</h3>
                <a href="{{ route('client.tax-returns') }}" class="text-xs font-semibold text-[#005DFF] hover:underline">View all</a>
            </div>

            <div class="space-y-4">
                <div class="flex items-center justify-between p-3.5 rounded-xl bg-gray-50/70 dark:bg-gray-800/40 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                    <div class="flex items-center gap-3.5">
                        <div class="w-9 h-9 rounded-xl bg-emerald-100 dark:bg-emerald-950/60 text-emerald-600 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-gray-800 dark:text-gray-200">Your tax return for 2023 has been submitted.</p>
                            <span class="text-[11px] text-gray-400">May 20, 2024</span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between p-3.5 rounded-xl bg-gray-50/70 dark:bg-gray-800/40 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                    <div class="flex items-center gap-3.5">
                        <div class="w-9 h-9 rounded-xl bg-blue-100 dark:bg-blue-950/60 text-[#005DFF] flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-gray-800 dark:text-gray-200">Document "Bank Statement - April.pdf" uploaded.</p>
                            <span class="text-[11px] text-gray-400">May 18, 2024</span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between p-3.5 rounded-xl bg-gray-50/70 dark:bg-gray-800/40 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                    <div class="flex items-center gap-3.5">
                        <div class="w-9 h-9 rounded-xl bg-amber-100 dark:bg-amber-950/60 text-amber-600 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-gray-800 dark:text-gray-200">Invoice INV-2024-001 has been paid.</p>
                            <span class="text-[11px] text-gray-400">May 15, 2024</span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between p-3.5 rounded-xl bg-gray-50/70 dark:bg-gray-800/40 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                    <div class="flex items-center gap-3.5">
                        <div class="w-9 h-9 rounded-xl bg-purple-100 dark:bg-purple-950/60 text-purple-600 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-gray-800 dark:text-gray-200">Appointment scheduled with Sarah Johnson.</p>
                            <span class="text-[11px] text-gray-400">May 10, 2024</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Upcoming Appointment Card (1 col) -->
        <div class="card-box flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-base font-bold text-gray-900 dark:text-white font-heading">Upcoming Appointment</h3>
                    <a href="{{ route('client.appointments') }}" class="text-xs font-semibold text-[#005DFF] hover:underline">View all</a>
                </div>

                @if($upcomingAppointment)
                    <div class="p-4 rounded-2xl bg-blue-50/60 dark:bg-blue-950/30 border border-blue-100 dark:border-blue-900/50 mb-4">
                        <div class="flex items-center gap-3.5 mb-4">
                            <div class="w-12 h-12 rounded-2xl bg-[#005DFF] text-white flex items-center justify-center shadow-md">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-sm text-gray-900 dark:text-white font-heading">{{ $upcomingAppointment->service?->name ?? 'Consultation' }}</h4>
                                <p class="text-xs text-gray-500">with {{ $upcomingAppointment->accountant?->name ?? 'Sarah Johnson' }}</p>
                            </div>
                        </div>

                        <div class="space-y-2 text-xs text-gray-600 dark:text-gray-300 border-t border-blue-100 dark:border-blue-900/40 pt-3">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-[#005DFF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span>{{ $upcomingAppointment->date->format('F j, Y (l)') }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-[#005DFF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span>{{ date('g:i A', strtotime($upcomingAppointment->time)) }}</span>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('client.appointments') }}" class="btn-primary w-full shadow-lg shadow-blue-500/25 py-3 text-center flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                        Join Virtual Meeting
                    </a>
                @else
                    <div class="text-center py-8">
                        <div class="w-12 h-12 mx-auto rounded-full bg-gray-100 dark:bg-gray-800 text-gray-400 flex items-center justify-center mb-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <p class="text-xs text-gray-500 mb-4">No upcoming appointments scheduled.</p>
                        <a href="{{ route('client.appointments') }}" class="btn-primary inline-flex text-xs">Book Appointment</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Quick Actions Section -->
    <div class="card-box">
        <h3 class="text-base font-bold text-gray-900 dark:text-white font-heading mb-4">Quick Actions</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('client.appointments') }}" class="p-4 rounded-xl bg-blue-50/60 dark:bg-blue-950/30 border border-blue-100 dark:border-blue-900/40 flex items-center justify-between hover:bg-blue-100/60 dark:hover:bg-blue-900/40 transition-colors group">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-[#005DFF] text-white flex items-center justify-center shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-xs text-gray-900 dark:text-white font-heading">Book Appointment</h4>
                        <p class="text-[11px] text-gray-500">Schedule with an expert</p>
                    </div>
                </div>
                <svg class="w-5 h-5 text-gray-400 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>

            <a href="{{ route('client.documents') }}" class="p-4 rounded-xl bg-emerald-50/60 dark:bg-emerald-950/30 border border-emerald-100 dark:border-emerald-900/40 flex items-center justify-between hover:bg-emerald-100/60 dark:hover:bg-emerald-900/40 transition-colors group">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-xs text-gray-900 dark:text-white font-heading">Upload Document</h4>
                        <p class="text-[11px] text-gray-500">Upload your tax files</p>
                    </div>
                </div>
                <svg class="w-5 h-5 text-gray-400 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>

            <a href="{{ route('client.invoices') }}" class="p-4 rounded-xl bg-amber-50/60 dark:bg-amber-950/30 border border-amber-100 dark:border-amber-900/40 flex items-center justify-between hover:bg-amber-100/60 dark:hover:bg-amber-900/40 transition-colors group">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-600 text-white flex items-center justify-center shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-xs text-gray-900 dark:text-white font-heading">Pay Invoice</h4>
                        <p class="text-[11px] text-gray-500">View and pay pending</p>
                    </div>
                </div>
                <svg class="w-5 h-5 text-gray-400 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>
    </div>
</x-client-layout>
