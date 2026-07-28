<div>
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 dark:text-white font-heading">Invoice Management</h1>
            <p class="text-xs text-gray-500 mt-1">Issue client billing invoices for tax preparation, bookkeeping, and payroll services.</p>
        </div>
        <button wire:click="$set('showModal', true)" class="btn-primary">
            + Generate Client Invoice
        </button>
    </div>

    <!-- Invoices List -->
    <div class="card-box">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-gray-50 dark:bg-gray-800 text-gray-500 uppercase font-semibold">
                    <tr>
                        <th class="p-3.5">Invoice #</th>
                        <th class="p-3.5">Client</th>
                        <th class="p-3.5">Issued Date</th>
                        <th class="p-3.5">Due Date</th>
                        <th class="p-3.5">Amount</th>
                        <th class="p-3.5">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse($invoices as $inv)
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/40">
                            <td class="p-3.5 font-bold font-mono text-gray-900 dark:text-white">{{ $inv->invoice_number }}</td>
                            <td class="p-3.5 font-medium text-gray-800 dark:text-gray-200">{{ $inv->client?->name }}</td>
                            <td class="p-3.5 text-gray-600 dark:text-gray-400">{{ $inv->issued_date->format('M j, Y') }}</td>
                            <td class="p-3.5 text-gray-600 dark:text-gray-400">{{ $inv->due_date->format('M j, Y') }}</td>
                            <td class="p-3.5 font-extrabold text-gray-900 dark:text-white font-heading">${{ number_format($inv->total, 2) }}</td>
                            <td class="p-3.5">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-semibold uppercase tracking-wider {{ $inv->status_color }}">
                                    {{ $inv->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center py-8 text-gray-500">No invoices generated yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $invoices->links() }}</div>
    </div>

    <!-- Create Invoice Modal -->
    @if($showModal)
        <div class="fixed inset-0 z-50 bg-gray-900/60 backdrop-blur-sm flex items-center justify-center p-4">
            <div class="bg-white dark:bg-gray-900 rounded-2xl max-w-md w-full p-6 shadow-2xl border border-gray-100 dark:border-gray-800">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white font-heading mb-4">Generate New Client Invoice</h3>
                <form wire:submit.prevent="create" class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Client</label>
                        <select wire:model="client_id" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs">
                            <option value="">-- Select Client --</option>
                            @foreach($clients as $c)
                                <option value="{{ $c->id }}">{{ $c->name }} ({{ $c->email }})</option>
                            @endforeach
                        </select>
                        @error('client_id') <span class="text-red-500 text-[11px]">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Amount ($)</label>
                            <input type="number" step="0.01" wire:model="amount" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs">
                            @error('amount') <span class="text-red-500 text-[11px]">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Tax Amount ($)</label>
                            <input type="number" step="0.01" wire:model="tax" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Due Date</label>
                        <input type="date" wire:model="due_date" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs">
                        @error('due_date') <span class="text-red-500 text-[11px]">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Description / Line Items</label>
                        <textarea wire:model="description" rows="3" placeholder="e.g. 2023 Individual Income Tax Return Filing Fee" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs"></textarea>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-3 border-t border-gray-100 dark:border-gray-800">
                        <button type="button" wire:click="$set('showModal', false)" class="btn-secondary text-xs">Cancel</button>
                        <button type="submit" class="btn-primary text-xs">Generate & Send Invoice</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
