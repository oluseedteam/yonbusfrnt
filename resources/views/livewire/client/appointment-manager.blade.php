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
        <div class="mb-6 p-4 rounded-xl bg-emerald-50 text-emerald-800 dark:bg-emerald-950/40 dark:text-emerald-200 border border-emerald-200 dark:border-emerald-800 text-xs font-semibold shadow-sm">
            {{ session('message') }}
        </div>
    @endif

    <!-- Filter Bar -->
    <div class="card-box p-4 mb-6 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span class="text-xs font-semibold text-gray-500 uppercase font-heading">Filter:</span>
            @foreach(['all' => 'All', 'pending' => 'Pending', 'confirmed' => 'Confirmed', 'completed' => 'Completed', 'cancelled' => 'Cancelled'] as $key => $label)
                <button wire:click="$set('filter', '{{ $key }}')" 
                        class="px-3 py-1.5 rounded-xl text-xs font-medium transition-all {{ $filter === $key ? 'bg-[#005DFF] text-white shadow-sm' : 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 hover:bg-gray-200' }}">
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
                                    <button wire:click="edit({{ $appt->id }})" class="text-[#005DFF] hover:underline font-semibold">Reschedule</button>
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
        <div class="fixed inset-0 z-50 bg-gray-900/60 backdrop-blur-sm flex items-center justify-center p-4 overflow-y-auto">
            <div class="bg-white dark:bg-gray-900 rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-gray-100 dark:border-gray-800 my-8">
                <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100 dark:border-slate-800">
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-[#005DFF] bg-blue-50 dark:bg-blue-950/60 px-2.5 py-0.5 rounded-full border border-blue-200 dark:border-blue-900/40">
                            Schedule Meeting
                        </span>
                        <h3 class="text-lg font-extrabold text-gray-900 dark:text-white font-heading mt-1">
                            {{ $editId ? 'Reschedule Consultation' : 'Book Consultation Appointment' }}
                        </h3>
                    </div>
                    <button wire:click="$set('showModal', false)" class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-400 hover:text-slate-600 flex items-center justify-center cursor-pointer">
                        ✕
                    </button>
                </div>

                @if($errorMessage)
                    <div class="mb-4 p-3.5 bg-rose-500/10 border border-rose-500/20 text-rose-600 dark:text-rose-400 rounded-xl text-xs font-semibold">
                        {{ $errorMessage }}
                    </div>
                @endif

                <form wire:submit.prevent="save" class="space-y-4">
                    {{-- Service Selection --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 mb-1">Select Practice Service *</label>
                        <select wire:model="service_id" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2.5 px-3 text-xs focus:ring-[#005DFF] outline-none">
                            <option value="">-- Select a Service --</option>
                            @foreach($services as $s)
                                <option value="{{ $s->id }}">{{ $s->name }} ({{ $s->duration ?? 45 }} mins)</option>
                            @endforeach
                        </select>
                        @error('service_id') <span class="text-rose-500 text-[11px] block mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- Consultant & Date Selection --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 mb-1">Dedicated Consultant</label>
                            <select wire:model.live="accountant_id" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2.5 px-3 text-xs focus:ring-[#005DFF] outline-none">
                                <option value="">Any Available Practice Partner</option>
                                @foreach($consultants as $c)
                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 mb-1">Appointment Date *</label>
                            <input type="date" wire:model.live="date" min="{{ date('Y-m-d') }}" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2.5 px-3 text-xs focus:ring-[#005DFF] outline-none font-semibold">
                            @error('date') <span class="text-rose-500 text-[11px] block mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    {{-- Time Slot Selection with Availability/Booked Status --}}
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label class="block text-xs font-bold text-gray-700 dark:text-gray-300">
                                Available Time Slots *
                            </label>
                            <div class="flex items-center gap-2 text-[10px] font-semibold">
                                <span class="text-emerald-600 flex items-center gap-1"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Available</span>
                                <span class="text-slate-400 flex items-center gap-1"><span class="w-1.5 h-1.5 rounded-full bg-rose-400"></span> Booked</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 sm:grid-cols-4 gap-2 max-h-48 overflow-y-auto p-1">
                            @forelse($timeSlots as $slot)
                                @if($slot['is_available'])
                                    <button type="button"
                                            wire:click="selectTimeSlot('{{ $slot['time'] }}', true)"
                                            class="p-2 rounded-xl border text-center transition flex flex-col items-center justify-center {{ $time === $slot['time'] || $time === $slot['time_short'] ? 'bg-[#005DFF] text-white border-[#005DFF] shadow-sm font-bold' : 'bg-slate-50 dark:bg-slate-800/80 border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 hover:border-[#005DFF]' }}">
                                        <span class="text-xs font-bold">{{ $slot['formatted'] }}</span>
                                    </button>
                                @else
                                    <div class="p-2 rounded-xl border border-dashed border-slate-200 dark:border-slate-700 bg-slate-100/60 dark:bg-slate-800/40 text-slate-400 dark:text-slate-500 text-center cursor-not-allowed opacity-50 flex flex-col items-center justify-center">
                                        <span class="text-xs font-medium line-through">{{ $slot['formatted'] }}</span>
                                        <span class="text-[9px] text-rose-500 font-bold">Booked</span>
                                    </div>
                                @endif
                            @empty
                                <div class="col-span-full py-4 text-center text-slate-400 text-xs">
                                    No slots available on this date.
                                </div>
                            @endforelse
                        </div>
                        @error('time') <span class="text-rose-500 text-[11px] block mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 mb-1">Notes / Agenda Topics</label>
                        <textarea wire:model="notes" rows="2" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs focus:ring-[#005DFF] outline-none" placeholder="Provide any preliminary details or tax documents you plan to discuss..."></textarea>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-3 border-t border-gray-100 dark:border-gray-800">
                        <button type="button" wire:click="$set('showModal', false)" class="btn-secondary text-xs">Cancel</button>
                        <button type="submit" class="btn-primary text-xs">Confirm Consultation</button>
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
