<div>
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 dark:text-white font-heading">Client Directory</h1>
            <p class="text-xs text-gray-500 mt-1">Manage active tax & accounting clients.</p>
        </div>
        <input type="text" wire:model.live="search" placeholder="Search clients by name or email..." class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-4 text-xs w-full sm:w-72">
    </div>

    <div class="card-box">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-gray-50 dark:bg-gray-800 text-gray-500 uppercase font-semibold">
                    <tr>
                        <th class="p-3.5">Client Name</th>
                        <th class="p-3.5">Company & TIN</th>
                        <th class="p-3.5">Phone</th>
                        <th class="p-3.5">Appointments</th>
                        <th class="p-3.5">Tax Returns</th>
                        <th class="p-3.5">Invoices</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse($clients as $c)
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/40">
                            <td class="p-3.5 flex items-center gap-3">
                                <img src="{{ $c->avatar_url }}" class="w-9 h-9 rounded-xl object-cover">
                                <div>
                                    <p class="font-bold text-gray-900 dark:text-white font-heading">{{ $c->name }}</p>
                                    <p class="text-[11px] text-gray-500">{{ $c->email }}</p>
                                </div>
                            </td>
                            <td class="p-3.5">
                                <p class="font-semibold text-gray-800 dark:text-gray-200">{{ $c->company_name ?? 'Individual' }}</p>
                                <p class="text-[11px] text-gray-400 font-mono">TIN: {{ $c->tax_identification_number ?? 'N/A' }}</p>
                            </td>
                            <td class="p-3.5 text-gray-600 dark:text-gray-400">{{ $c->phone ?? 'N/A' }}</td>
                            <td class="p-3.5 font-bold text-blue-600">{{ $c->appointments_count }}</td>
                            <td class="p-3.5 font-bold text-[#005DFF]">{{ $c->tax_returns_count }}</td>
                            <td class="p-3.5 font-bold text-amber-600">{{ $c->invoices_count }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center py-8 text-gray-500">No clients found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $clients->links() }}</div>
    </div>
</div>
