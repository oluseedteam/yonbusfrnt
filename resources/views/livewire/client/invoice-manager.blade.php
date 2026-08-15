<div>
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 dark:text-white font-heading">Invoices & Billing</h1>
            <p class="text-xs text-gray-500 mt-1">Review, download PDF invoices, and make online payments securely.</p>
        </div>
    </div>

    <!-- Filter Buttons -->
    <div class="card-box p-4 mb-6 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span class="text-xs font-semibold text-gray-500 uppercase font-heading">Status:</span>
            @foreach(['all' => 'All', 'pending' => 'Pending', 'paid' => 'Paid', 'overdue' => 'Overdue'] as $key => $label)
                <button wire:click="$set('filter', '{{ $key }}')" 
                        class="px-3 py-1.5 rounded-xl text-xs font-medium transition-all {{ $filter === $key ? 'bg-[#2563EB] text-white shadow-sm' : 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300' }}">
                    {{ $label }}
                </button>
            @endforeach
        </div>
    </div>

    <!-- Invoices Table -->
    <div class="card-box">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-gray-50 dark:bg-gray-800 text-gray-500 uppercase font-semibold">
                    <tr>
                        <th class="p-3.5">Invoice #</th>
                        <th class="p-3.5">Issued Date</th>
                        <th class="p-3.5">Due Date</th>
                        <th class="p-3.5">Amount</th>
                        <th class="p-3.5">Status</th>
                        <th class="p-3.5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse($invoices as $inv)
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/40">
                            <td class="p-3.5 font-bold text-gray-900 dark:text-white font-heading font-mono">{{ $inv->invoice_number }}</td>
                            <td class="p-3.5 text-gray-600 dark:text-gray-400">{{ $inv->issued_date->format('M j, Y') }}</td>
                            <td class="p-3.5 text-gray-600 dark:text-gray-400">{{ $inv->due_date->format('M j, Y') }}</td>
                            <td class="p-3.5 font-extrabold text-gray-900 dark:text-white font-heading">${{ number_format($inv->total, 2) }}</td>
                            <td class="p-3.5">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-semibold uppercase tracking-wider {{ $inv->status_color }}">
                                    {{ $inv->status }}
                                </span>
                            </td>
                            <td class="p-3.5 text-right space-x-3">
                                @if($inv->status === 'pending' || $inv->status === 'overdue')
                                    <button wire:click="markPaid({{ $inv->id }})" wire:confirm="Simulate payment for invoice {{ $inv->invoice_number }}?" class="btn-primary inline-flex text-[11px] py-1 px-3">
                                        Pay Now
                                    </button>
                                @endif
                                <button wire:click="downloadPdf({{ $inv->id }})" class="text-[#2563EB] hover:underline font-semibold text-xs">
                                    Download PDF
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center py-8 text-gray-500">No invoices found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $invoices->links() }}</div>
    </div>
</div>
