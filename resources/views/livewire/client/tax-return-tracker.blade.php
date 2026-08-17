<div>
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-extrabold text-gray-900 dark:text-white font-heading">Tax Return Tracker</h1>
        <p class="text-xs text-gray-500 mt-1">Real-time status updates and progress workflow for your annual tax filings.</p>
    </div>

    <!-- Tax Return Cards with Timeline -->
    <div class="space-y-6">
        @forelse($taxReturns as $tr)
            @php
                $statusOrder = ['draft' => 1, 'submitted' => 2, 'reviewed' => 3, 'processing' => 4, 'approved' => 5, 'completed' => 6];
                $currentStep = $statusOrder[$tr->status] ?? 1;
            @endphp

            <div class="card-box">
                <div class="flex flex-col md:flex-row md:items-center justify-between border-b border-gray-100 dark:border-gray-800 pb-4 mb-6 gap-4">
                    <div>
                        <div class="flex items-center gap-3">
                            <h3 class="text-lg font-extrabold text-gray-900 dark:text-white font-heading">{{ $tr->title }}</h3>
                            <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-blue-50 text-[#005DFF]">{{ $tr->year }} Tax Year</span>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Assigned CPB: {{ $tr->accountant?->name ?? 'YONBUS Tax Expert' }} • Due: {{ $tr->due_date?->format('M j, Y') ?? 'April 15, 2025' }}</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider {{ $tr->status_color }}">
                            Current Status: {{ str_replace('_', ' ', $tr->status) }}
                        </span>
                    </div>
                </div>

                <!-- Workflow Timeline -->
                <div class="relative py-4">
                    <div class="grid grid-cols-2 md:grid-cols-6 gap-4 text-center">
                        @foreach(['draft' => 'Draft Created', 'submitted' => 'Documents Submitted', 'reviewed' => 'CPB Review', 'processing' => 'IRS Processing', 'approved' => 'IRS Approved', 'completed' => 'Filing Completed'] as $key => $label)
                            @php
                                $stepNum = $statusOrder[$key];
                                $isDone = $stepNum <= $currentStep;
                                $isCurrent = $stepNum === $currentStep;
                            @endphp

                            <div class="flex flex-col items-center">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-xs mb-2 transition-all {{ $isCurrent ? 'bg-[#005DFF] text-white ring-4 ring-blue-500/20 shadow-md scale-110' : ($isDone ? 'bg-emerald-500 text-white' : 'bg-gray-100 dark:bg-gray-800 text-gray-400') }}">
                                    @if($isDone && !$isCurrent)
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    @else
                                        {{ $stepNum }}
                                    @endif
                                </div>
                                <span class="text-xs font-semibold font-heading {{ $isDone ? 'text-gray-900 dark:text-white' : 'text-gray-400' }}">{{ $label }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                @if($tr->refund_amount || $tr->tax_due)
                    <div class="mt-6 pt-4 border-t border-gray-100 dark:border-gray-800 grid grid-cols-2 gap-4 max-w-xs text-xs">
                        @if($tr->refund_amount)
                            <div class="p-3 rounded-xl bg-[#005DFF] dark:bg-[#005DFF]/40 border border-[#005DFF] dark:border-[#005DFF]/50">
                                <span class="text-[#005DFF] dark:text-[#005DFF] font-semibold block text-[11px]">Estimated Refund</span>
                                <span class="text-lg font-extrabold text-[#005DFF] font-heading">${{ number_format($tr->refund_amount, 2) }}</span>
                            </div>
                        @endif
                        @if($tr->tax_due)
                            <div class="p-3 rounded-xl bg-red-50 dark:bg-red-950/40 border border-red-100 dark:border-red-900/50">
                                <span class="text-red-700 dark:text-red-300 font-semibold block text-[11px]">Tax Amount Due</span>
                                <span class="text-lg font-extrabold text-red-600 font-heading">${{ number_format($tr->tax_due, 2) }}</span>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        @empty
            <div class="card-box text-center py-12">
                <div class="w-12 h-12 mx-auto rounded-full bg-blue-50 text-[#005DFF] flex items-center justify-center mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <h3 class="font-bold text-sm text-gray-900 dark:text-white font-heading">No Tax Returns Found</h3>
                <p class="text-xs text-gray-500 mt-1">Book an appointment with our team to initiate your tax filing.</p>
                <div class="mt-4">
                    <a href="{{ route('client.appointments') }}" class="btn-primary inline-flex text-xs">Book Consultation &rarr;</a>
                </div>
            </div>
        @endforelse
    </div>
</div>
