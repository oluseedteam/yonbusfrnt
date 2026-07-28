<div>
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 dark:text-white font-heading">Global Invoices</h1>
            <p class="text-xs text-gray-500 mt-1">Platform billing and invoice oversight.</p>
        </div>
        <input type="text" wire:model.live="search" placeholder="Search invoice # or client..." class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-4 text-xs w-full sm:w-64">
    </div>

    <div class="card-box">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-gray-50 dark:bg-gray-800 text-gray-500 uppercase font-semibold">
                    <tr>
                        <th class="p-3.5">Invoice #</th>
                        <th class="p-3.5">Client</th>
                        <th class="p-3.5">Accountant</th>
                        <th class="p-3.5">Issued Date</th>
                        <th class="p-3.5">Amount</th>
                        <th class="p-3.5">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse($invoices as $inv)
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/40">
                            <td class="p-3.5 font-bold font-mono text-gray-900 dark:text-white">{{ $inv->invoice_number }}</td>
                            <td class="p-3.5 font-medium text-gray-800 dark:text-gray-200">{{ $inv->client?->name }}</td>
                            <td class="p-3.5 text-gray-600 dark:text-gray-400">{{ $inv->accountant?->name }}</td>
                            <td class="p-3.5 text-gray-600 dark:text-gray-400">{{ $inv->issued_date->format('M j, Y') }}</td>
                            <td class="p-3.5 font-extrabold text-[#005DFF] font-heading">${{ number_format($inv->total, 2) }}</td>
                            <td class="p-3.5">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-semibold uppercase tracking-wider {{ $inv->status_color }}">
                                    {{ $inv->status }}
                                </span>
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
