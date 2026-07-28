<div>
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 dark:text-white font-heading">System Activity & Audit Logs</h1>
            <p class="text-xs text-gray-500 mt-1">Full audit trail of user actions, logins, status updates, and administrative changes.</p>
        </div>
        <input type="text" wire:model.live="search" placeholder="Filter logs..." class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-4 text-xs w-full sm:w-64">
    </div>

    <div class="card-box">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-gray-50 dark:bg-gray-800 text-gray-500 uppercase font-semibold">
                    <tr>
                        <th class="p-3.5">User</th>
                        <th class="p-3.5">Action Event</th>
                        <th class="p-3.5">Description</th>
                        <th class="p-3.5">IP Address</th>
                        <th class="p-3.5">Timestamp</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse($logs as $log)
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/40">
                            <td class="p-3.5 font-bold text-gray-900 dark:text-white font-heading">{{ $log->user?->name ?? 'System Event' }}</td>
                            <td class="p-3.5"><span class="px-2.5 py-0.5 rounded-full bg-blue-50 text-[#005DFF] font-semibold text-[10px]">{{ $log->action }}</span></td>
                            <td class="p-3.5 text-gray-600 dark:text-gray-400 max-w-md">{!! e($log->description) !!}</td>
                            <td class="p-3.5 font-mono text-[11px] text-gray-400">{{ $log->ip_address }}</td>
                            <td class="p-3.5 text-gray-500">{{ $log->created_at->format('M j, Y H:i:s') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center py-8 text-gray-500">No activity logs recorded.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $logs->links() }}</div>
    </div>
</div>
