<div>
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 dark:text-white font-heading">Tax Return Management</h1>
            <p class="text-xs text-gray-500 mt-1">Review client tax submissions and progress filings through workflow stages.</p>
        </div>
    </div>

    <div class="card-box">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-gray-50 dark:bg-gray-800 text-gray-500 uppercase font-semibold">
                    <tr>
                        <th class="p-3.5">Filing Title</th>
                        <th class="p-3.5">Client</th>
                        <th class="p-3.5">Year</th>
                        <th class="p-3.5">Current Status</th>
                        <th class="p-3.5 text-right">Update Workflow Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse($taxReturns as $tr)
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/40">
                            <td class="p-3.5 font-bold text-gray-900 dark:text-white font-heading">{{ $tr->title }}</td>
                            <td class="p-3.5 flex items-center gap-2">
                                <img src="{{ $tr->client?->avatar_url }}" class="w-7 h-7 rounded-lg object-cover">
                                <span class="font-medium text-gray-800 dark:text-gray-200">{{ $tr->client?->name }}</span>
                            </td>
                            <td class="p-3.5 font-bold text-[#005DFF]">{{ $tr->year }}</td>
                            <td class="p-3.5">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-semibold uppercase tracking-wider {{ $tr->status_color }}">
                                    {{ str_replace('_', ' ', $tr->status) }}
                                </span>
                            </td>
                            <td class="p-3.5 text-right">
                                <select wire:change="updateStatus({{ $tr->id }}, $event.target.value)" class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-1 px-2 text-xs">
                                    @foreach($statuses as $stKey => $stLabel)
                                        <option value="{{ $stKey }}" {{ $tr->status === $stKey ? 'selected' : '' }}>{{ $stLabel }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center py-8 text-gray-500">No tax returns assigned.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $taxReturns->links() }}</div>
    </div>
</div>
