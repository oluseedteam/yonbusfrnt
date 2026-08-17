<div>
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 dark:text-white font-heading">System Activity &amp; Audit Logs</h1>
            <p class="text-xs text-gray-500 mt-1">Full audit trail of user actions, logins, status updates, client assignments, and administrative changes.</p>
        </div>
        <div class="flex items-center gap-3 flex-wrap">
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search logs or user..." class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-4 text-xs w-48 focus:ring-2 focus:ring-[#005DFF] outline-none">
            <select wire:model.live="adminFilter" class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs focus:ring-2 focus:ring-[#005DFF] outline-none font-semibold">
                <option value="">All Admins &amp; Users</option>
                @foreach($adminUsers as $admin)
                    <option value="{{ $admin->id }}">{{ $admin->name }} ({{ ucfirst($admin->role) }})</option>
                @endforeach
            </select>
            <select wire:model.live="filterAction" class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs focus:ring-2 focus:ring-[#005DFF] outline-none">
                <option value="">All Event Actions</option>
                @foreach($actionTypes as $action)
                    <option value="{{ $action }}">{{ $action }}</option>
                @endforeach
            </select>
            <button wire:click="clearOldLogs" wire:confirm="Clear all log entries older than 90 days?" class="px-4 py-2 bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold rounded-xl shadow transition cursor-pointer">
                🗑️ Clear Old Logs (90d+)
            </button>
        </div>
    </div>

    <!-- Quick Admin Audit Pill Tabs -->
    <div class="flex items-center gap-2 mb-6 overflow-x-auto pb-1 text-xs">
        <span class="font-bold text-slate-500 dark:text-slate-400 flex items-center gap-1.5 flex-shrink-0">
            <span>🛡️</span> Partner Audit Trail:
        </span>
        <button type="button" wire:click="$set('adminFilter', '')"
                class="px-3.5 py-1.5 rounded-xl font-bold transition {{ empty($adminFilter) ? 'bg-slate-900 text-white dark:bg-white dark:text-slate-900 shadow-sm' : 'bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-slate-200' }}">
            All Staff &amp; System Events
        </button>
        @foreach($adminUsers->whereIn('email', ['olubukunola@yonbustax.ca', 'adeshola.eniola@yonbustax.ca', 'adeshola@yonbustax.ca']) as $partner)
            <button type="button" wire:click="$set('adminFilter', '{{ $partner->id }}')"
                    class="px-3.5 py-1.5 rounded-xl font-bold transition flex items-center gap-1.5 {{ (string)$adminFilter === (string)$partner->id ? 'bg-[#005DFF] text-white shadow-sm' : 'bg-blue-50 dark:bg-blue-950/40 text-blue-700 dark:text-blue-300 hover:bg-blue-100' }}">
                <img src="{{ $partner->avatar_url }}" class="w-4 h-4 rounded-full object-cover">
                <span>{{ $partner->name }}'s Activity Logs</span>
            </button>
        @endforeach
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-200 text-xs font-semibold rounded-xl shadow-sm">
            {{ session('message') }}
        </div>
    @endif

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
