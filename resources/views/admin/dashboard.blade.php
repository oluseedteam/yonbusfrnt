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

    <!-- Inbound Career & Contact Inquiries Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8" data-aos="fade-up" data-aos-delay="250">
        <!-- Career Applications Card -->
        <div class="card-box flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100 dark:border-slate-800">
                    <div class="flex items-center gap-2.5">
                        <div class="w-9 h-9 rounded-xl bg-purple-100 dark:bg-purple-950/60 text-purple-600 flex items-center justify-center font-bold text-base">
                            💼
                        </div>
                        <div>
                            <h3 class="font-extrabold text-base text-slate-900 dark:text-white font-heading">
                                Career &amp; Job Applications
                            </h3>
                            <p class="text-[11px] text-slate-500">Applicant resumes &amp; candidate statements</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.inquiries') }}" class="text-xs font-bold text-[#005DFF] hover:underline">
                        View All ({{ $stats['total_careers'] }}) →
                    </a>
                </div>

                <div class="space-y-3">
                    @forelse($recentCareerApps as $career)
                        @php
                            $hasResume = preg_match('/\[Resume:\s*([^\]]+)\]/', $career->message, $matches);
                            $resumePath = $hasResume ? trim($matches[1]) : null;
                            $cleanMsg = preg_replace('/\[Resume:\s*[^\]]+\]/', '', $career->message);
                        @endphp
                        <div class="p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-100 dark:border-slate-700/60 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs">
                            <div class="flex-1">
                                <div class="flex items-center gap-2">
                                    <span class="font-bold text-slate-900 dark:text-white text-sm">{{ $career->name ?? 'Candidate' }}</span>
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-purple-100 text-purple-800 dark:bg-purple-950/60 dark:text-purple-300">
                                        {{ $career->subject ?: 'Job Application' }}
                                    </span>
                                </div>
                                <div class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5">
                                    {{ $career->email }} • {{ $career->phone ?? 'No phone' }}
                                </div>
                                <p class="text-slate-600 dark:text-slate-300 mt-1 line-clamp-1 text-[11px]">{{ $cleanMsg }}</p>
                            </div>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                @if($resumePath)
                                    <a href="{{ asset('storage/' . $resumePath) }}" target="_blank" download class="px-3 py-1.5 rounded-xl bg-purple-50 dark:bg-purple-950/40 text-purple-700 dark:text-purple-300 hover:bg-purple-100 font-bold text-[11px] transition inline-flex items-center gap-1">
                                        <span>📥</span> Resume
                                    </a>
                                @endif
                                <a href="mailto:{{ $career->email }}?subject=Regarding your application at YONBUS" class="px-3 py-1.5 rounded-xl bg-[#005DFF] hover:bg-blue-700 text-white font-bold text-[11px] shadow-sm transition">
                                    Reply
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="py-8 text-center text-slate-400 text-xs">
                            No job applications submitted yet.
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 dark:border-slate-800 text-right">
                <a href="{{ route('admin.inquiries') }}" class="text-xs font-bold text-[#005DFF] hover:underline">
                    Manage Inquiries &amp; Career Submissions &rarr;
                </a>
            </div>
        </div>

        <!-- Contact Messages Card -->
        <div class="card-box flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100 dark:border-slate-800">
                    <div class="flex items-center gap-2.5">
                        <div class="w-9 h-9 rounded-xl bg-emerald-100 dark:bg-emerald-950/60 text-emerald-600 flex items-center justify-center font-bold text-base">
                            💬
                        </div>
                        <div>
                            <h3 class="font-extrabold text-base text-slate-900 dark:text-white font-heading">
                                Contact Form Inquiries
                            </h3>
                            <p class="text-[11px] text-slate-500">Website leads &amp; client contact requests</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.inquiries') }}" class="text-xs font-bold text-[#005DFF] hover:underline">
                        View All ({{ $stats['total_contacts'] }}) →
                    </a>
                </div>

                <div class="space-y-3">
                    @forelse($recentContactInquiries as $contact)
                        <div class="p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-100 dark:border-slate-700/60 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs">
                            <div class="flex-1">
                                <div class="flex items-center gap-2">
                                    <span class="font-bold text-slate-900 dark:text-white text-sm">{{ $contact->name ?? 'Visitor' }}</span>
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-300">
                                        {{ $contact->subject ?: 'Inquiry' }}
                                    </span>
                                </div>
                                <div class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5">
                                    {{ $contact->email }} • {{ $contact->phone ?? 'No phone' }} • {{ $contact->created_at->diffForHumans() }}
                                </div>
                                <p class="text-slate-600 dark:text-slate-300 mt-1 line-clamp-1 text-[11px]">{{ $contact->message }}</p>
                            </div>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                <a href="mailto:{{ $contact->email }}?subject=Re: {{ urlencode($contact->subject ?? 'YONBUS Inquiry') }}" class="px-3 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-[11px] shadow-sm transition">
                                    ✉️ Reply
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="py-8 text-center text-slate-400 text-xs">
                            No contact inquiries submitted yet.
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 dark:border-slate-800 text-right">
                <a href="{{ route('admin.inquiries') }}" class="text-xs font-bold text-[#005DFF] hover:underline">
                    View All Contact Form Submissions &rarr;
                </a>
            </div>
        </div>
    <!-- Recent Client Document Uploads Section -->
    <div class="card-box mb-8" data-aos="fade-up" data-aos-delay="280">
        <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100 dark:border-slate-800">
            <div class="flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-xl bg-blue-100 dark:bg-blue-950/60 text-[#005DFF] flex items-center justify-center font-bold text-base">
                    📁
                </div>
                <div>
                    <h3 class="font-extrabold text-base text-slate-900 dark:text-white font-heading">
                        Recent Client Document Uploads
                    </h3>
                    <p class="text-[11px] text-slate-500">Tax slips, financial statements, and client files uploaded to vault</p>
                </div>
            </div>
            <a href="{{ route('admin.documents') }}" class="text-xs font-bold text-[#005DFF] hover:underline">
                View All Documents ({{ $stats['total_documents'] }}) →
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 dark:bg-slate-800/80 text-slate-500 uppercase font-semibold text-[11px]">
                    <tr>
                        <th class="p-3">File Name</th>
                        <th class="p-3">Client</th>
                        <th class="p-3">Delivered / Assigned To</th>
                        <th class="p-3">Uploaded By</th>
                        <th class="p-3">File Size</th>
                        <th class="p-3">Upload Time</th>
                        <th class="p-3 text-right">Download</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse($recentDocuments as $doc)
                        @php
                            $isClient = $doc->uploaded_by == $doc->client_id;
                            $ext = strtoupper(pathinfo($doc->original_name, PATHINFO_EXTENSION));
                        @endphp
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/40 transition">
                            <td class="p-3 flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-lg bg-blue-50 text-[#005DFF] font-bold text-[10px] flex items-center justify-center border border-blue-200">
                                    {{ $ext ?: 'DOC' }}
                                </div>
                                <div>
                                    <div class="font-bold text-slate-900 dark:text-white">{{ $doc->original_name }}</div>
                                    @if($doc->notes)
                                        <div class="text-[10px] text-slate-400 italic">{{ $doc->notes }}</div>
                                    @endif
                                </div>
                            </td>
                            <td class="p-3">
                                <span class="font-semibold text-slate-900 dark:text-slate-200">{{ $doc->client?->name ?? 'Unknown Client' }}</span>
                                <div class="text-[10px] text-slate-400">{{ $doc->client?->email }}</div>
                            </td>
                            <td class="p-3">
                                @if($doc->assignedAdmin)
                                    <span class="inline-flex items-center gap-1 font-semibold text-blue-600 dark:text-blue-400">
                                        <span>👤</span> {{ $doc->assignedAdmin->name }}
                                    </span>
                                @elseif($doc->client && $doc->client->assignedAdmin)
                                    <span class="inline-flex items-center gap-1 font-semibold text-slate-600 dark:text-slate-400">
                                        <span>👤</span> {{ $doc->client->assignedAdmin->name }}
                                    </span>
                                @else
                                    <span class="text-slate-400 text-xs">All Admins</span>
                                @endif
                            </td>
                            <td class="p-3">
                                @if($isClient)
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-300">
                                        Client Upload
                                    </span>
                                @else
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-purple-100 text-purple-800 dark:bg-purple-950/60 dark:text-purple-300">
                                        {{ $doc->uploader?->name ?? 'Admin Staff' }}
                                    </span>
                                @endif
                            </td>
                            <td class="p-3 font-mono text-slate-500 text-[11px]">{{ $doc->file_size_human }}</td>
                            <td class="p-3 text-slate-500 text-[11px]">{{ $doc->created_at->diffForHumans() }}</td>
                            <td class="p-3 text-right">
                                <a href="{{ route('documents.download', $doc) }}" class="px-3 py-1 bg-[#005DFF] hover:bg-blue-700 text-white font-bold text-xs rounded-lg shadow-sm transition inline-flex items-center gap-1 cursor-pointer">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    <span>Download</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-6 text-center text-slate-400 text-xs">
                                No client documents uploaded yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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
