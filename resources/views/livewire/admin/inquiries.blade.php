<div>
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <div class="inline-block text-[11px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-blue-50 dark:bg-blue-950/60 text-[#005DFF] border border-blue-200 dark:border-blue-900/40 mb-1">
                Admin Inbound Hub
            </div>
            <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white font-heading">
                Career Applications &amp; Contact Inquiries
            </h1>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                Review all online inquiries from the contact form and job applications submitted through the careers portal.
            </p>
        </div>
        <div class="flex items-center gap-3">
            <a href="mailto:careers@yonbustax.ca" class="px-4 py-2 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 text-xs font-bold rounded-xl transition">
                ✉️ careers@yonbustax.ca
            </a>
            <a href="mailto:info@yonbustax.ca" class="px-4 py-2 bg-[#005DFF] hover:bg-blue-700 text-white text-xs font-bold rounded-xl shadow transition">
                ✉️ info@yonbustax.ca
            </a>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-200 text-xs font-semibold rounded-2xl flex items-center shadow-sm">
            <svg class="w-4 h-4 mr-2 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
            {{ session('message') }}
        </div>
    @endif

    <!-- Metrics Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="p-4 rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700/60 shadow-sm flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-blue-50 dark:bg-blue-950/60 text-[#005DFF] flex items-center justify-center font-bold text-lg">
                📬
            </div>
            <div>
                <div class="text-xl font-extrabold text-slate-900 dark:text-white">{{ $counts['total'] }}</div>
                <div class="text-xs text-slate-500 dark:text-slate-400 font-medium">Total Inbounds</div>
            </div>
        </div>

        <div class="p-4 rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700/60 shadow-sm flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-purple-50 dark:bg-purple-950/60 text-purple-600 flex items-center justify-center font-bold text-lg">
                💼
            </div>
            <div>
                <div class="text-xl font-extrabold text-slate-900 dark:text-white">{{ $counts['careers'] }}</div>
                <div class="text-xs text-slate-500 dark:text-slate-400 font-medium">Career Applications</div>
            </div>
        </div>

        <div class="p-4 rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700/60 shadow-sm flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 flex items-center justify-center font-bold text-lg">
                💬
            </div>
            <div>
                <div class="text-xl font-extrabold text-slate-900 dark:text-white">{{ $counts['contacts'] }}</div>
                <div class="text-xs text-slate-500 dark:text-slate-400 font-medium">Contact Inquiries</div>
            </div>
        </div>

        <div class="p-4 rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700/60 shadow-sm flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-amber-50 dark:bg-amber-950/60 text-amber-600 flex items-center justify-center font-bold text-lg">
                🔔
            </div>
            <div>
                <div class="text-xl font-extrabold text-slate-900 dark:text-white">{{ $counts['unread'] }}</div>
                <div class="text-xs text-slate-500 dark:text-slate-400 font-medium">Unread / Pending Review</div>
            </div>
        </div>
    </div>

    <!-- Filters & Search -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl p-4 mb-6 shadow-sm border border-slate-200 dark:border-slate-700/50 flex flex-col md:flex-row items-center justify-between gap-4">
        <div class="flex-1 w-full">
            <div class="relative">
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search by name, email, phone, position, or message..." class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-xs focus:ring-2 focus:ring-[#005DFF] outline-none">
                <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
        </div>

        <div class="flex items-center gap-2 w-full md:w-auto overflow-x-auto pb-1 md:pb-0 text-xs">
            <button type="button" wire:click="$set('channelFilter', 'all')"
                    class="px-3.5 py-1.5 rounded-xl font-bold transition whitespace-nowrap {{ $channelFilter === 'all' ? 'bg-[#005DFF] text-white shadow-sm' : 'bg-slate-100 dark:bg-slate-900 text-slate-600 dark:text-slate-300 hover:bg-slate-200' }}">
                All ({{ $counts['total'] }})
            </button>
            <button type="button" wire:click="$set('channelFilter', 'career_application')"
                    class="px-3.5 py-1.5 rounded-xl font-bold transition whitespace-nowrap flex items-center gap-1.5 {{ $channelFilter === 'career_application' ? 'bg-purple-600 text-white shadow-sm' : 'bg-purple-50 dark:bg-purple-950/40 text-purple-700 dark:text-purple-300 hover:bg-purple-100' }}">
                <span>💼</span> Career Applications ({{ $counts['careers'] }})
            </button>
            <button type="button" wire:click="$set('channelFilter', 'contact_form')"
                    class="px-3.5 py-1.5 rounded-xl font-bold transition whitespace-nowrap flex items-center gap-1.5 {{ $channelFilter === 'contact_form' ? 'bg-emerald-600 text-white shadow-sm' : 'bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-300 hover:bg-emerald-100' }}">
                <span>💬</span> Contact Inquiries ({{ $counts['contacts'] }})
            </button>
        </div>
    </div>

    <!-- Inquiries Table -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="border-b border-slate-200 dark:border-slate-700 text-[11px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider bg-slate-50/80 dark:bg-slate-900/50">
                        <th class="px-6 py-4">Applicant / Sender</th>
                        <th class="px-6 py-4">Channel / Type</th>
                        <th class="px-6 py-4">Subject / Position</th>
                        <th class="px-6 py-4">Message Snippet</th>
                        <th class="px-6 py-4">Status &amp; Date</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700 text-slate-700 dark:text-slate-300">
                    @forelse ($inquiries as $item)
                        @php
                            $isCareer = $item->channel === 'career_application';
                            $hasResume = preg_match('/\[Resume:\s*([^\]]+)\]/', $item->message, $matches);
                            $resumePath = $hasResume ? trim($matches[1]) : null;
                            $cleanMessage = preg_replace('/\[Resume:\s*[^\]]+\]/', '', $item->message);
                        @endphp
                        <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-700/30 transition {{ !$item->is_read ? 'bg-blue-50/20 dark:bg-blue-950/20 font-medium' : '' }}">
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-900 dark:text-white flex items-center gap-1.5">
                                    <span>{{ $item->name ?? 'Online Visitor' }}</span>
                                    @if(!$item->is_read)
                                        <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                                    @endif
                                </div>
                                <div class="text-[11px] text-slate-500 dark:text-slate-400">{{ $item->email }}</div>
                                @if($item->phone)
                                    <div class="text-[10px] text-slate-400 font-mono">{{ $item->phone }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($isCareer)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-purple-100 text-purple-800 dark:bg-purple-950/60 dark:text-purple-300 border border-purple-200 dark:border-purple-900/40">
                                        💼 Career Application
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-900/40">
                                        💬 Contact Message
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-semibold text-slate-900 dark:text-slate-100 max-w-xs">
                                {{ $item->subject ?: ($isCareer ? 'Job Application' : 'General Inquiry') }}
                            </td>
                            <td class="px-6 py-4 text-slate-500 dark:text-slate-400 max-w-sm">
                                <p class="line-clamp-2 text-[11px]">{{ $cleanMessage }}</p>
                                @if($resumePath)
                                    <span class="inline-flex items-center gap-1 mt-1 text-[10px] text-blue-600 font-bold">
                                        📎 Resume Attached
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <button type="button" wire:click="toggleRead({{ $item->id }})" class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold transition {{ $item->is_read ? 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400' : 'bg-blue-100 text-blue-800 dark:bg-blue-950/60 dark:text-blue-300' }}">
                                    {{ $item->is_read ? '✓ Reviewed' : '● New / Unread' }}
                                </button>
                                <div class="text-[10px] text-slate-400 mt-1">
                                    {{ $item->created_at->format('M j, Y • g:i A') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right space-x-2 whitespace-nowrap">
                                <button wire:click="viewDetails({{ $item->id }})" class="px-3 py-1 bg-slate-100 dark:bg-slate-700 hover:bg-[#005DFF] hover:text-white text-slate-700 dark:text-slate-200 rounded-lg font-bold text-xs transition cursor-pointer">
                                    View Full Details
                                </button>
                                @if($item->email)
                                    <a href="mailto:{{ $item->email }}?subject=Re: {{ urlencode($item->subject ?? 'YONBUS Tax & Accounting Inquiry') }}" class="px-2.5 py-1 bg-blue-50 dark:bg-blue-950/40 text-[#005DFF] hover:bg-blue-100 rounded-lg font-bold text-xs transition inline-block">
                                        Reply
                                    </a>
                                @endif
                                <button wire:click="delete({{ $item->id }})" wire:confirm="Delete this submission?" class="px-2 py-1 text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-950/40 rounded-lg text-xs transition">
                                    🗑️
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">
                                <div class="w-12 h-12 rounded-2xl bg-blue-50 dark:bg-slate-700 flex items-center justify-center mx-auto text-2xl mb-3">📬</div>
                                <p class="text-base font-bold text-slate-900 dark:text-white mb-1">No inquiries or applications recorded yet</p>
                                <p class="text-xs max-w-sm mx-auto">When visitors submit messages via the contact form or apply on the careers page, their submissions will appear here for both Olubukunola and Adeshola.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($inquiries->hasPages())
            <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-700">
                {{ $inquiries->links() }}
            </div>
        @endif
    </div>

    <!-- Detail View Modal -->
    @if ($showDetailModal && $selectedInquiry)
        @php
            $isCareerModal = $selectedInquiry->channel === 'career_application';
            $hasResumeModal = preg_match('/\[Resume:\s*([^\]]+)\]/', $selectedInquiry->message, $m);
            $resumePathModal = $hasResumeModal ? trim($m[1]) : null;
            $cleanMessageModal = preg_replace('/\[Resume:\s*[^\]]+\]/', '', $selectedInquiry->message);
        @endphp
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm overflow-y-auto">
            <div class="bg-white dark:bg-slate-800 rounded-3xl max-w-2xl w-full p-6 sm:p-8 shadow-2xl border border-slate-200 dark:border-slate-700 my-8">
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100 dark:border-slate-700">
                    <div>
                        <div class="inline-block text-[10px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full {{ $isCareerModal ? 'bg-purple-100 text-purple-800 dark:bg-purple-950/60 dark:text-purple-300' : 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-300' }} mb-1">
                            {{ $isCareerModal ? '💼 Career / Job Application' : '💬 Contact Inquiry' }}
                        </div>
                        <h3 class="text-xl font-extrabold text-slate-900 dark:text-white font-heading m-0">
                            {{ $selectedInquiry->subject ?: ($isCareerModal ? 'Job Application' : 'Contact Message') }}
                        </h3>
                    </div>
                    <button wire:click="$set('showDetailModal', false)" class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-700 text-slate-400 hover:text-slate-600 flex items-center justify-center cursor-pointer">
                        ✕
                    </button>
                </div>

                <div class="space-y-6">
                    <!-- Sender Details Card -->
                    <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-900/60 border border-slate-200 dark:border-slate-700 grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                        <div>
                            <span class="text-slate-400 font-semibold block text-[10px] uppercase">Applicant / Sender Name</span>
                            <span class="font-bold text-slate-900 dark:text-white text-sm">{{ $selectedInquiry->name ?? '—' }}</span>
                        </div>
                        <div>
                            <span class="text-slate-400 font-semibold block text-[10px] uppercase">Email Address</span>
                            <a href="mailto:{{ $selectedInquiry->email }}" class="font-bold text-[#005DFF] hover:underline">{{ $selectedInquiry->email }}</a>
                        </div>
                        <div>
                            <span class="text-slate-400 font-semibold block text-[10px] uppercase">Phone Number</span>
                            <span class="font-semibold text-slate-800 dark:text-slate-200">{{ $selectedInquiry->phone ?? 'Not provided' }}</span>
                        </div>
                        <div>
                            <span class="text-slate-400 font-semibold block text-[10px] uppercase">Date &amp; Time Received</span>
                            <span class="font-semibold text-slate-800 dark:text-slate-200">{{ $selectedInquiry->created_at->format('F j, Y • g:i A') }}</span>
                        </div>
                    </div>

                    <!-- Message Body / Cover Letter -->
                    <div>
                        <h4 class="text-xs font-bold uppercase tracking-wider text-slate-600 dark:text-slate-400 mb-2 font-heading">
                            {{ $isCareerModal ? 'Cover Letter / Candidate Statement' : 'Inquiry Message Body' }}
                        </h4>
                        <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-900/40 border border-slate-200 dark:border-slate-700 text-slate-800 dark:text-slate-200 text-xs leading-relaxed whitespace-pre-line">
                            {{ $cleanMessageModal }}
                        </div>
                    </div>

                    <!-- Resume Attachment Box -->
                    @if($resumePathModal)
                        <div class="p-4 rounded-2xl bg-blue-50/60 dark:bg-blue-950/40 border border-blue-200 dark:border-blue-900/60 flex items-center justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center font-bold text-lg shrink-0">
                                    📄
                                </div>
                                <div>
                                    <div class="font-bold text-xs text-slate-900 dark:text-white">Applicant Resume Document</div>
                                    <div class="text-[11px] text-slate-500 font-mono">{{ basename($resumePathModal) }}</div>
                                </div>
                            </div>
                            <a href="{{ asset('storage/' . $resumePathModal) }}" target="_blank" download class="px-4 py-2 rounded-xl bg-[#005DFF] hover:bg-blue-700 text-white font-bold text-xs shadow transition inline-flex items-center gap-1.5 shrink-0">
                                <span>📥</span> Download Resume
                            </a>
                        </div>
                    @endif

                    <!-- Modal Actions -->
                    <div class="flex items-center justify-between pt-4 border-t border-slate-100 dark:border-slate-700">
                        <button type="button" wire:click="delete({{ $selectedInquiry->id }})" wire:confirm="Delete this submission?" class="text-rose-600 hover:underline font-semibold text-xs">
                            Delete Submission
                        </button>
                        <div class="flex items-center gap-3">
                            <button type="button" wire:click="$set('showDetailModal', false)" class="px-4 py-2 rounded-xl border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 font-bold text-xs hover:bg-slate-100">
                                Close
                            </button>
                            @if($selectedInquiry->email)
                                <a href="mailto:{{ $selectedInquiry->email }}?subject=Re: {{ urlencode($selectedInquiry->subject ?? 'YONBUS Application / Inquiry') }}" class="px-5 py-2 rounded-xl bg-[#005DFF] hover:bg-blue-700 text-white font-bold text-xs shadow transition flex items-center gap-1.5">
                                    <span>✉️</span> Reply to Candidate / Sender
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
