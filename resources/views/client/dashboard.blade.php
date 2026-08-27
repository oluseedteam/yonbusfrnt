<x-client-layout>
    <!-- Welcome Header with Dedicated Consultant Card -->
    <div class="mb-8 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
        <div>
            <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 dark:text-white font-heading">
                Welcome back, {{ explode(' ', $user->name)[0] }}! 👋
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Here's what's happening with your tax &amp; accounting account today.
            </p>
        </div>

        @if($consultant)
            <div class="p-4 bg-white dark:bg-slate-800 rounded-2xl border border-blue-200 dark:border-blue-900/60 shadow-sm flex items-center gap-4 flex-shrink-0">
                <img src="{{ $consultant->avatar_url }}" alt="{{ $consultant->name }}" class="w-14 h-14 rounded-2xl object-cover border-2 border-[#005DFF] shadow-sm flex-shrink-0">
                <div>
                    <div class="inline-flex items-center gap-1 text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full bg-blue-50 dark:bg-blue-950/60 text-[#005DFF]">
                        <span>🛡️</span> Your Dedicated Consultant
                    </div>
                    <h3 class="text-sm font-extrabold text-slate-900 dark:text-white font-heading mt-0.5">{{ $consultant->name }}</h3>
                    <p class="text-[11px] text-slate-500 dark:text-slate-400 font-medium">{{ $consultant->accountantProfile?->title ?? 'Practice Partner • CPB' }}</p>
                    <div class="flex items-center gap-3 mt-1.5 text-xs">
                        <a href="mailto:{{ $consultant->email }}" class="text-[#005DFF] hover:underline font-bold text-[11px] flex items-center gap-1">
                            <span>✉️</span> {{ $consultant->email }}
                        </a>
                        <a href="{{ route('client.messages') }}" class="px-2.5 py-1 rounded-lg bg-[#005DFF] hover:bg-blue-700 text-white font-bold text-[10px] transition">
                            💬 Message
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- 3 Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
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
    </div>

    <!-- Admin Shared Documents Section -->
    @if(isset($adminDocuments) && count($adminDocuments) > 0)
        <div class="card-box mb-8 border-2 border-blue-500/30 bg-blue-50/20 dark:bg-blue-950/20">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-[#005DFF] text-white flex items-center justify-center font-bold shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 01-2-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-gray-900 dark:text-white font-heading">Documents Shared by YONBUS Team</h3>
                        <p class="text-xs text-gray-500">Download your tax returns, reports, and official documents sent by your accountant.</p>
                    </div>
                </div>
                <a href="{{ route('client.documents') }}" class="text-xs font-semibold text-[#005DFF] hover:underline">View all in Vault &rarr;</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($adminDocuments as $doc)
                    <div class="p-3.5 rounded-xl bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700/80 shadow-sm flex items-center justify-between">
                        <div class="flex items-center gap-3 overflow-hidden">
                            <div class="w-9 h-9 rounded-lg bg-blue-100 dark:bg-blue-950 text-[#005DFF] flex items-center justify-center font-bold text-xs flex-shrink-0">
                                {{ strtoupper(pathinfo($doc->original_name, PATHINFO_EXTENSION)) }}
                            </div>
                            <div class="truncate">
                                <p class="text-xs font-bold text-gray-900 dark:text-white truncate font-heading">{{ $doc->original_name }}</p>
                                <span class="text-[10px] text-gray-400">By {{ $doc->uploader?->name ?? 'Admin' }} &bull; {{ $doc->created_at->format('M j, Y') }}</span>
                            </div>
                        </div>
                        <a href="{{ route('documents.download', $doc) }}" 
                           class="ml-2 px-3 py-1.5 rounded-lg text-xs font-bold text-white bg-[#005DFF] hover:bg-blue-700 shadow-sm flex-shrink-0 transition-all">
                            Download
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

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
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-gray-800 dark:text-gray-200">Tax return document reviewed by your CPA consultant.</p>
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
    <!-- Recent Client & Practice Documents Section -->
    <div class="card-box mb-8">
        <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100 dark:border-slate-800">
            <div class="flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-xl bg-blue-100 dark:bg-blue-950/60 text-[#005DFF] flex items-center justify-center font-bold text-base">
                    📁
                </div>
                <div>
                    <h3 class="font-extrabold text-base text-slate-900 dark:text-white font-heading">
                        Your Recent Documents &amp; Files
                    </h3>
                    <p class="text-[11px] text-slate-500">Tax slips, notice of assessment, receipts, and files shared with YONBUS</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('client.documents') }}" class="btn-primary text-xs py-1.5 px-3">
                    + Upload New File
                </a>
                <a href="{{ route('client.documents') }}" class="text-xs font-bold text-[#005DFF] hover:underline">
                    View Vault ({{ $stats['documents'] }}) →
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 dark:bg-slate-800/80 text-slate-500 uppercase font-semibold text-[11px]">
                    <tr>
                        <th class="p-3">Document Name</th>
                        <th class="p-3">Source / Uploader</th>
                        <th class="p-3">File Size</th>
                        <th class="p-3">Date</th>
                        <th class="p-3 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse($recentDocuments as $doc)
                        @php
                            $isSelf = $doc->uploaded_by == auth()->id();
                            $ext = strtoupper(pathinfo($doc->original_name, PATHINFO_EXTENSION));
                        @endphp
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/40 transition">
                            <td class="p-3 flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-lg bg-blue-50 text-[#005DFF] font-bold text-[10px] flex items-center justify-center border border-blue-200">
                                    {{ $ext ?: 'DOC' }}
                                </div>
                                <div>
                                    <span class="font-bold text-slate-900 dark:text-white">{{ $doc->original_name }}</span>
                                    <div class="text-[10px] text-slate-400 font-mono">{{ $doc->file_type ?? 'document' }}</div>
                                </div>
                            </td>
                            <td class="p-3">
                                @if($isSelf)
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-300">
                                        Uploaded by You
                                    </span>
                                @else
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-100 text-blue-800 dark:bg-blue-950/60 dark:text-blue-300">
                                        Sent by {{ $doc->uploader?->name ?? 'YONBUS Team' }}
                                    </span>
                                @endif
                            </td>
                            <td class="p-3 font-mono text-slate-500 text-[11px]">{{ $doc->file_size_human }}</td>
                            <td class="p-3 text-slate-500 text-[11px]">{{ $doc->created_at->format('M j, Y') }}</td>
                            <td class="p-3 text-right">
                                <a href="{{ route('documents.download', $doc) }}" class="px-3 py-1 bg-[#005DFF] hover:bg-blue-700 text-white font-bold text-xs rounded-lg shadow-sm transition inline-flex items-center gap-1">
                                    <span>📥</span> Download
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-6 text-center text-slate-400 text-xs">
                                <p class="mb-2">No documents in your vault yet.</p>
                                <a href="{{ route('client.documents') }}" class="text-[#005DFF] font-bold hover:underline">
                                    Click here to upload your tax slips, receipts, or CRA documents.
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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

            <a href="{{ route('client.tax-returns') }}" class="p-4 rounded-xl bg-amber-50/60 dark:bg-amber-950/30 border border-amber-100 dark:border-amber-900/40 flex items-center justify-between hover:bg-amber-100/60 dark:hover:bg-amber-900/40 transition-colors group">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-600 text-white flex items-center justify-center shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-xs text-gray-900 dark:text-white font-heading">Tax Return Status</h4>
                        <p class="text-[11px] text-gray-500">Track 6-stage EFILE pipeline</p>
                    </div>
                </div>
                <svg class="w-5 h-5 text-gray-400 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>
    </div>
</x-client-layout>
