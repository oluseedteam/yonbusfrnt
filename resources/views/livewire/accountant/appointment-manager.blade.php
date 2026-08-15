<div>
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 dark:text-white font-heading">Consultation Appointments</h1>
            <p class="text-xs text-gray-500 mt-1">Manage scheduled meetings with your assigned clients.</p>
        </div>
        <input type="text" wire:model.live="search" placeholder="Search by client name..." class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-4 text-xs w-full sm:w-64">
    </div>

    <div class="card-box">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-gray-50 dark:bg-gray-800 text-gray-500 uppercase font-semibold">
                    <tr>
                        <th class="p-3.5">Client</th>
                        <th class="p-3.5">Service Requested</th>
                        <th class="p-3.5">Date & Time</th>
                        <th class="p-3.5">Status</th>
                        <th class="p-3.5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse($appointments as $appt)
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/40">
                            <td class="p-3.5 flex items-center gap-3">
                                <img src="{{ $appt->client?->avatar_url }}" class="w-8 h-8 rounded-lg object-cover">
                                <div>
                                    <p class="font-bold text-gray-900 dark:text-white font-heading">{{ $appt->client?->name }}</p>
                                    <p class="text-[11px] text-gray-400">{{ $appt->client?->phone ?? $appt->client?->email }}</p>
                                </div>
                            </td>
                            <td class="p-3.5 font-bold text-gray-800 dark:text-gray-200 font-heading">{{ $appt->service?->name }}</td>
                            <td class="p-3.5 font-medium text-gray-700 dark:text-gray-300">{{ $appt->date->format('M j, Y') }} at {{ date('g:i A', strtotime($appt->time)) }}</td>
                            <td class="p-3.5">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-semibold uppercase tracking-wider {{ $appt->status_color }}">
                                    {{ $appt->status }}
                                </span>
                            </td>
                            <td class="p-3.5 text-right space-x-2">
                                @if($appt->status === 'pending')
                                    <button wire:click="updateStatus({{ $appt->id }}, 'confirmed')" class="text-emerald-600 font-semibold hover:underline">Confirm</button>
                                @endif
                                @if(in_array($appt->status, ['pending', 'confirmed']))
                                    <button wire:click="updateStatus({{ $appt->id }}, 'completed')" class="text-[#2563EB] font-semibold hover:underline">Mark Done</button>
                                    <button wire:click="updateStatus({{ $appt->id }}, 'cancelled')" class="text-red-500 font-semibold hover:underline">Cancel</button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center py-8 text-gray-500">No appointments found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $appointments->links() }}</div>
    </div>
</div>
