<div>
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 dark:text-white font-heading">Appointment Manager</h1>
            <p class="text-xs text-gray-500 mt-1">Book and manage your tax & accounting consultations with YONBUS experts.</p>
        </div>
        <button wire:click="openModal" class="btn-primary flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            <span>Book New Appointment</span>
        </button>
    </div>

    @if(session()->has('message'))
        <div class="mb-6 p-4 rounded-xl bg-emerald-50 text-emerald-700 dark:bg-emerald-950/50 dark:text-emerald-300 text-xs font-semibold">
            {{ session('message') }}
        </div>
    @endif

    <!-- Filter Bar -->
    <div class="card-box p-4 mb-6 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span class="text-xs font-semibold text-gray-500 uppercase font-heading">Filter:</span>
            @foreach(['all' => 'All', 'pending' => 'Pending', 'confirmed' => 'Confirmed', 'completed' => 'Completed', 'cancelled' => 'Cancelled'] as $key => $label)
                <button wire:click="$set('filter', '{{ $key }}')" 
                        class="px-3 py-1.5 rounded-xl text-xs font-medium transition-all {{ $filter === $key ? 'bg-[#2563EB] text-white shadow-sm' : 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 hover:bg-gray-200' }}">
                    {{ $label }}
                </button>
            @endforeach
        </div>
    </div>

    <!-- Appointments Table/Grid -->
    <div class="card-box">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-gray-50 dark:bg-gray-800 text-gray-500 uppercase font-semibold">
                    <tr>
                        <th class="p-3.5">Service</th>
                        <th class="p-3.5">Advisor / Staff</th>
                        <th class="p-3.5">Date & Time</th>
                        <th class="p-3.5">Status</th>
                        <th class="p-3.5">Live Room</th>
                        <th class="p-3.5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse($appointments as $appt)
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/40">
                            <td class="p-3.5 font-bold text-gray-900 dark:text-white font-heading">
                                {{ $appt->service?->name ?? 'Consultation' }}
                            </td>
                            <td class="p-3.5 text-gray-700 dark:text-gray-300">
                                {{ $appt->accountant?->name ?? 'YONBUS Admin Team' }}
                            </td>
                            <td class="p-3.5 font-medium text-gray-800 dark:text-gray-200">
                                {{ $appt->date?->format('M j, Y') }} at {{ date('g:i A', strtotime($appt->time)) }}
                            </td>
                            <td class="p-3.5">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-semibold uppercase tracking-wider 
                                    {{ $appt->status === 'confirmed' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300' : '' }}
                                    {{ $appt->status === 'pending' ? 'bg-amber-100 text-amber-700 dark:bg-amber-950 dark:text-amber-300' : '' }}
                                    {{ $appt->status === 'completed' ? 'bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400' : '' }}
                                    {{ $appt->status === 'cancelled' ? 'bg-red-100 text-red-700 dark:bg-red-950 dark:text-red-300' : '' }}">
                                    {{ $appt->status }}
                                </span>
                            </td>
                            <!-- Live Room Access -->
                            <td class="p-3.5">
                                @if(in_array($appt->status, ['confirmed', 'pending']))
                                    <button wire:click="startConsultation({{ $appt->id }})" 
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 shadow-sm transition-all">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                        <span>Join Room (Video & Chat)</span>
                                    </button>
                                @else
                                    <span class="text-gray-400 text-[11px]">—</span>
                                @endif
                            </td>
                            <td class="p-3.5 text-right space-x-2">
                                @if(in_array($appt->status, ['pending', 'confirmed']))
                                    <button wire:click="edit({{ $appt->id }})" class="text-[#2563EB] hover:underline font-semibold">Reschedule</button>
                                    <button wire:click="cancel({{ $appt->id }})" wire:confirm="Are you sure you want to cancel this appointment?" class="text-red-500 hover:underline font-semibold">Cancel</button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-8 text-gray-500">No appointments found. Click "Book New Appointment" to schedule your consultation!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $appointments->links() }}</div>
    </div>

    <!-- Booking Modal -->
    @if($showModal)
        <div class="fixed inset-0 z-50 bg-gray-900/60 backdrop-blur-sm flex items-center justify-center p-4">
            <div class="bg-white dark:bg-gray-900 rounded-2xl max-w-md w-full p-6 shadow-2xl border border-gray-100 dark:border-gray-800">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white font-heading mb-4">
                    {{ $editId ? 'Reschedule Appointment' : 'Book Consultation Appointment' }}
                </h3>

                <form wire:submit.prevent="save" class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Select Service</label>
                        <select wire:model="service_id" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs focus:ring-[#2563EB]">
                            <option value="">-- Select a Service --</option>
                            @foreach($services as $s)
                                <option value="{{ $s->id }}">{{ $s->name }} (${{ number_format($s->price, 2) }})</option>
                            @endforeach
                        </select>
                        @error('service_id') <span class="text-red-500 text-[11px]">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Date</label>
                            <input type="date" wire:model="date" min="{{ date('Y-m-d') }}" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs focus:ring-[#2563EB]">
                            @error('date') <span class="text-red-500 text-[11px]">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Time</label>
                            <input type="time" wire:model="time" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs focus:ring-[#2563EB]">
                            @error('time') <span class="text-red-500 text-[11px]">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Notes / Consultation Topics</label>
                        <textarea wire:model="notes" rows="3" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs focus:ring-[#2563EB]" placeholder="Describe what you would like to discuss with the YONBUS team..."></textarea>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-3 border-t border-gray-100 dark:border-gray-800">
                        <button type="button" wire:click="$set('showModal', false)" class="btn-secondary text-xs">Cancel</button>
                        <button type="submit" class="btn-primary text-xs">Confirm Booking</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- LiveKit / WebRTC Video Call & Consultation Room Modal -->
    @if($showVideoCallModal)
        @include('livewire.client.video-call-modal')
    @endif
</div>
