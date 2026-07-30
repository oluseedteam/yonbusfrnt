<div class="p-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Invoice Management</h1>
            <p class="text-slate-600 dark:text-slate-400 text-sm">Create, monitor, and manage client billing and payment records</p>
        </div>
        <div class="flex items-center gap-3">
            <button wire:click="openModal" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Create Invoice
            </button>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 rounded-lg text-sm">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-200 dark:border-slate-700 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider bg-slate-50 dark:bg-slate-900/50">
                        <th class="px-6 py-4">Invoice #</th>
                        <th class="px-6 py-4">Client</th>
                        <th class="px-6 py-4">Total Amount</th>
                        <th class="px-6 py-4">Due Date</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700 text-sm text-slate-700 dark:text-slate-300">
                    @forelse($invoices as $inv)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition">
                            <td class="px-6 py-4 font-mono font-bold text-blue-600 dark:text-blue-400">{{ $inv->invoice_number }}</td>
                            <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">{{ $inv->client?->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 font-extrabold text-slate-900 dark:text-white">${{ number_format($inv->total_amount, 2) }}</td>
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-400 text-xs">{{ $inv->due_date?->format('M d, Y') ?? 'N/A' }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-2.5 py-1 text-xs font-semibold rounded-full 
                                    {{ $inv->status === 'paid' ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400' : '' }}
                                    {{ $inv->status === 'pending' ? 'bg-amber-500/10 text-amber-600 dark:text-amber-400' : '' }}
                                    {{ $inv->status === 'cancelled' ? 'bg-rose-500/10 text-rose-600 dark:text-rose-400' : '' }}">
                                    {{ ucfirst($inv->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                @if($inv->status === 'pending')
                                    <button wire:click="markAsPaid({{ $inv->id }})" class="text-emerald-600 dark:text-emerald-400 hover:underline font-medium text-xs">Mark Paid</button>
                                    <button wire:click="cancelInvoice({{ $inv->id }})" class="text-rose-600 dark:text-rose-400 hover:underline font-medium text-xs">Cancel</button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">
                                <svg class="w-12 h-12 mx-auto text-slate-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 14l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <p class="text-base font-semibold text-slate-900 dark:text-white mb-1">No invoices found</p>
                                <p class="text-xs">No billing or invoice records exist yet.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($invoices->hasPages())
            <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-700">
                {{ $invoices->links() }}
            </div>
        @endif
    </div>

    <!-- Create Invoice Modal -->
    @if ($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
            <div class="bg-white dark:bg-slate-800 rounded-2xl max-w-lg w-full p-6 shadow-xl border border-slate-200 dark:border-slate-700">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Create New Invoice</h3>
                    <button wire:click="$set('showModal', false)" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <form wire:submit.prevent="createInvoice" class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Client *</label>
                        <select wire:model="client_id" class="w-full px-3 py-2 rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                            <option value="">Select Client</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->name }} ({{ $client->email }})</option>
                            @endforeach
                        </select>
                        @error('client_id') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="grid grid-cols-3 gap-3">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Subtotal ($)</label>
                            <input type="number" step="0.01" wire:model="subtotal" class="w-full px-3 py-2 rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                            @error('subtotal') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Tax ($)</label>
                            <input type="number" step="0.01" wire:model="tax_amount" class="w-full px-3 py-2 rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Discount ($)</label>
                            <input type="number" step="0.01" wire:model="discount_amount" class="w-full px-3 py-2 rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Due Date *</label>
                        <input type="date" wire:model="due_date" class="w-full px-3 py-2 rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                        @error('due_date') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Notes / Terms</label>
                        <textarea wire:model="notes" rows="2" class="w-full px-3 py-2 rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 outline-none"></textarea>
                    </div>
                    <div class="flex justify-end gap-3 pt-4 border-t border-slate-200 dark:border-slate-700">
                        <button type="button" wire:click="$set('showModal', false)" class="px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg text-slate-700 dark:text-slate-300 text-sm font-medium hover:bg-slate-50 dark:hover:bg-slate-700 transition">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition">Create Invoice</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
