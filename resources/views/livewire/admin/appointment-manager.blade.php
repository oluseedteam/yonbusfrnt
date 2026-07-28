<div>
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 dark:text-white font-heading">Global Appointments</h1>
            <p class="text-xs text-gray-500 mt-1">Audit and monitor all platform consultations.</p>
        </div>
        <input type="text" wire:model.live="search" placeholder="Search client name..." class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-4 text-xs w-full sm:w-64">
    </div>

    <div class="card-box">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-gray-50 dark:bg-gray-800 text-gray-500 uppercase font-semibold">
                    <tr>
                        <th class="p-3.5">Client</th>
                        <th class="p-3.5">Assigned Accountant</th>
                        <th class="p-3.5">Service</th>
                        <th class="p-3.5">Date & Time</th>
                        <th class="p-3.5">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse($appointments as $appt)
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/40">
                            <td class="p-3.5 font-bold text-gray-900 dark:text-white font-heading">{{ $appt->client?->name }}</td>
                            <td class="p-3.5 text-gray-700 dark:text-gray-300">{{ $appt->accountant?->name ?? 'Unassigned' }}</td>
                            <td class="p-3.5 text-gray-700 dark:text-gray-300 font-medium">{{ $appt->service?->name }}</td>
                            <td class="p-3.5 text-gray-600 dark:text-gray-400">{{ $appt->date->format('M j, Y') }} at {{ date('g:i A', strtotime($appt->time)) }}</td>
                            <td class="p-3.5">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-semibold uppercase tracking-wider {{ $appt->status_color }}">
                                    {{ $appt->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center py-8 text-gray-500">No appointments recorded.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $appointments->links() }}</div>
    </div>
</div>
