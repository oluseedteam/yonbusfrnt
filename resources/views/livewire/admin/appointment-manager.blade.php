<div class="p-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Appointment Management</h1>
            <p class="text-slate-600 dark:text-slate-400 text-sm">Monitor, confirm, complete, and launch live video consultations with clients across the platform</p>
        </div>
        <div class="flex gap-3">
            <select wire:model.live="statusFilter" class="px-4 py-2 rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                <option value="all">All Statuses</option>
                <option value="pending">Pending</option>
                <option value="confirmed">Confirmed</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
            </select>
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
                        <th class="px-6 py-4">Ref #</th>
                        <th class="px-6 py-4">Client</th>
                        <th class="px-6 py-4">Service</th>
                        <th class="px-6 py-4">Date & Time</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Live Consultation Room</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700 text-sm text-slate-700 dark:text-slate-300">
                    @forelse($appointments as $appt)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition">
                            <td class="px-6 py-4 font-mono text-xs font-bold text-blue-600 dark:text-blue-400">
                                {{ $appt->appointment_number ?? 'APT-' . str_pad($appt->id, 5, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">{{ $appt->client?->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">{{ $appt->service?->name ?? 'Consultation' }}</td>
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-400 text-xs">
                                {{ $appt->date?->format('M d, Y') }} at {{ date('g:i A', strtotime($appt->time)) }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-2.5 py-1 text-xs font-semibold rounded-full 
                                    {{ $appt->status === 'pending' ? 'bg-amber-500/10 text-amber-600 dark:text-amber-400' : '' }}
                                    {{ $appt->status === 'confirmed' ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400' : '' }}
                                    {{ $appt->status === 'completed' ? 'bg-slate-500/10 text-slate-600 dark:text-slate-400' : '' }}
                                    {{ $appt->status === 'cancelled' ? 'bg-rose-500/10 text-rose-600 dark:text-rose-400' : '' }}">
                                    {{ ucfirst($appt->status) }}
                                </span>
                            </td>
                            <!-- Live Room Launcher -->
                            <td class="px-6 py-4">
                                @if(in_array($appt->status, ['confirmed', 'pending']))
                                    <button wire:click="startConsultation({{ $appt->id }})" 
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 shadow-sm transition-all">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                        <span>Launch Live Call & Chat</span>
                                    </button>
                                @else
                                    <span class="text-slate-400 text-xs">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                @if($appt->status === 'pending')
                                    <button wire:click="confirm({{ $appt->id }})" class="text-emerald-600 dark:text-emerald-400 hover:underline font-medium text-xs">Confirm</button>
                                @endif
                                @if(in_array($appt->status, ['pending', 'confirmed']))
                                    <button wire:click="complete({{ $appt->id }})" class="text-blue-600 dark:text-blue-400 hover:underline font-medium text-xs">Complete</button>
                                    <button wire:click="cancel({{ $appt->id }})" class="text-rose-600 dark:text-rose-400 hover:underline font-medium text-xs">Cancel</button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">
                                <svg class="w-12 h-12 mx-auto text-slate-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <p class="text-base font-semibold text-slate-900 dark:text-white mb-1">No appointments recorded</p>
                                <p class="text-xs">Appointments will appear here when booked by clients.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($appointments->hasPages())
            <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-700">
                {{ $appointments->links() }}
            </div>
        @endif
    </div>

    <!-- LiveKit / WebRTC Video Call Modal -->
    @if($showVideoCallModal)
        @include('livewire.client.video-call-modal')
    @endif
</div>
