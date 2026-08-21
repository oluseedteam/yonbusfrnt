<div class="p-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Appointment &amp; Booking Management</h1>
            <p class="text-slate-600 dark:text-slate-400 text-sm">Monitor, adjust booking times, send client reminders, and launch live video consultations</p>
        </div>
        <div class="flex gap-3">
            <select wire:model.live="statusFilter" class="px-4 py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 outline-none shadow-sm">
                <option value="all">All Statuses</option>
                <option value="pending">Pending</option>
                <option value="confirmed">Confirmed</option>
                <option value="rescheduled">Rescheduled</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
            </select>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="mb-5 p-4 bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-200 rounded-xl text-sm font-semibold shadow-sm flex items-center justify-between">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span>{{ session('message') }}</span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-800 text-lg leading-none">&times;</button>
        </div>
    @endif

    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/90 dark:border-slate-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-200 dark:border-slate-700 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider bg-slate-50 dark:bg-slate-900/50">
                        <th class="px-5 py-4">Ref #</th>
                        <th class="px-5 py-4">Client</th>
                        <th class="px-5 py-4">Service</th>
                        <th class="px-5 py-4">Date &amp; Time</th>
                        <th class="px-5 py-4">Advisor</th>
                        <th class="px-5 py-4">Status</th>
                        <th class="px-5 py-4">Video Room</th>
                        <th class="px-5 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700 text-sm text-slate-700 dark:text-slate-300">
                    @forelse($appointments as $appt)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition">
                            {{-- Ref # --}}
                            <td class="px-5 py-4 font-mono text-xs font-bold text-blue-600 dark:text-blue-400 whitespace-nowrap">
                                {{ $appt->appointment_number ?? 'APT-' . str_pad($appt->id, 5, '0', STR_PAD_LEFT) }}
                            </td>

                            {{-- Client --}}
                            <td class="px-5 py-4">
                                <div class="font-bold text-slate-900 dark:text-white">{{ $appt->client?->name ?? 'Guest Client' }}</div>
                                <div class="text-xs text-slate-500 dark:text-slate-400">{{ $appt->client?->email ?? 'No email' }}</div>
                            </td>

                            {{-- Service --}}
                            <td class="px-5 py-4 text-slate-700 dark:text-slate-300">
                                <div class="font-medium">{{ $appt->service?->name ?? 'Consultation' }}</div>
                                <div class="text-xs text-slate-500">{{ $appt->duration ?? 60 }} mins</div>
                            </td>

                            {{-- Date & Time --}}
                            <td class="px-5 py-4 text-slate-700 dark:text-slate-300 whitespace-nowrap">
                                @if($appt->date)
                                    <div class="font-semibold text-slate-900 dark:text-white flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        {{ $appt->date->format('M d, Y') }}
                                    </div>
                                    <div class="text-xs text-slate-600 dark:text-slate-400 mt-0.5">
                                        {{ $appt->time ? date('g:i A', strtotime($appt->time)) : 'Time pending' }}
                                    </div>
                                @else
                                    <span class="text-amber-600 dark:text-amber-400 text-xs font-semibold bg-amber-50 dark:bg-amber-950/40 px-2 py-0.5 rounded">Pending Scheduling</span>
                                @endif
                            </td>

                            {{-- Advisor --}}
                            <td class="px-5 py-4 text-slate-600 dark:text-slate-400 text-xs">
                                {{ $appt->accountant?->name ?? 'Unassigned' }}
                            </td>

                            {{-- Status Badge --}}
                            <td class="px-5 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2.5 py-1 text-xs font-bold rounded-full 
                                    {{ $appt->status === 'pending' ? 'bg-amber-100 text-amber-800 dark:bg-amber-950 dark:text-amber-300' : '' }}
                                    {{ $appt->status === 'confirmed' ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300' : '' }}
                                    {{ $appt->status === 'completed' ? 'bg-slate-100 text-slate-700 dark:bg-slate-700 dark:text-slate-300' : '' }}
                                    {{ $appt->status === 'cancelled' ? 'bg-rose-100 text-rose-700 dark:bg-rose-950 dark:text-rose-300' : '' }}
                                    {{ $appt->status === 'rescheduled' ? 'bg-blue-100 text-blue-800 dark:bg-blue-950 dark:text-blue-300' : '' }}">
                                    {{ ucfirst($appt->status) }}
                                </span>
                            </td>

                            {{-- Video Room Launcher --}}
                            <td class="px-5 py-4 whitespace-nowrap">
                                @if(in_array($appt->status, ['confirmed', 'rescheduled', 'pending']))
                                    <button wire:click="startConsultation({{ $appt->id }})" 
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 shadow-sm transition-all">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                        <span>Video Call</span>
                                    </button>
                                @else
                                    <span class="text-slate-400 text-xs">—</span>
                                @endif
                            </td>

                            {{-- Actions --}}
                            <td class="px-5 py-4 text-right space-x-1.5 whitespace-nowrap">
                                {{-- 1. Remind Button --}}
                                @if(in_array($appt->status, ['pending', 'confirmed', 'rescheduled']))
                                    <button wire:click="openReminderModal({{ $appt->id }})" 
                                            title="Send Email & Notification Reminder to Client"
                                            class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg text-xs font-bold text-amber-700 bg-amber-50 hover:bg-amber-100 border border-amber-200 dark:bg-amber-950/50 dark:text-amber-300 dark:border-amber-800 transition">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                                        <span>Remind</span>
                                    </button>
                                @endif

                                {{-- 2. Edit Time / Details Button --}}
                                <button wire:click="openEditModal({{ $appt->id }})" 
                                        title="Edit Time & Booking Details"
                                        class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg text-xs font-bold text-blue-700 bg-blue-50 hover:bg-blue-100 border border-blue-200 dark:bg-blue-950/50 dark:text-blue-300 dark:border-blue-800 transition">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    <span>Edit Time</span>
                                </button>

                                {{-- 3. Status Action Buttons --}}
                                @if($appt->status === 'pending')
                                    <button wire:click="openSchedule({{ $appt->id }})" class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg text-xs font-bold text-white bg-[#005DFF] hover:bg-blue-700 transition shadow-xs">
                                        Schedule &amp; Confirm
                                    </button>
                                @endif

                                @if(in_array($appt->status, ['pending', 'confirmed', 'rescheduled']))
                                    <button wire:click="complete({{ $appt->id }})" class="text-emerald-600 dark:text-emerald-400 hover:underline font-semibold text-xs px-1">Done</button>
                                    <button wire:click="cancel({{ $appt->id }})" wire:confirm="Are you sure you want to cancel this booking?" class="text-rose-600 dark:text-rose-400 hover:underline font-semibold text-xs px-1">Cancel</button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">
                                <svg class="w-12 h-12 mx-auto text-slate-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <p class="text-base font-semibold text-slate-900 dark:text-white mb-1">No appointments recorded</p>
                                <p class="text-xs">Bookings made by clients will appear here.</p>
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

    {{-- ============================================================
         1. EDIT BOOKING TIME & DETAILS MODAL
         ============================================================ --}}
    @if($showEditModal)
        <div class="fixed inset-0 z-50 bg-slate-950/60 backdrop-blur-sm flex items-center justify-center p-4">
            <div class="bg-white dark:bg-slate-900 rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-slate-200 dark:border-slate-800">
                <div class="flex items-center justify-between mb-5 border-b border-slate-100 dark:border-slate-800 pb-4">
                    <div>
                        <h3 class="text-lg font-bold font-heading text-slate-900 dark:text-white">Edit Booking &amp; Time</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">{{ $editClientName }} • {{ $editServiceName }}</p>
                    </div>
                    <button wire:click="closeEditModal" class="p-1.5 rounded-lg text-slate-400 hover:text-slate-700 hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <form wire:submit.prevent="saveEditAppointment" class="space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-700 dark:text-slate-300 mb-1">Appointment Date *</label>
                            <input type="date" wire:model="editDate" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl py-2.5 px-3 text-xs sm:text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                            @error('editDate') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-700 dark:text-slate-300 mb-1">Appointment Time *</label>
                            <input type="time" wire:model="editTime" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl py-2.5 px-3 text-xs sm:text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                            @error('editTime') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-700 dark:text-slate-300 mb-1">Duration</label>
                            <select wire:model="editDuration" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl py-2.5 px-3 text-xs sm:text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                                <option value="15">15 minutes</option>
                                <option value="30">30 minutes</option>
                                <option value="45">45 minutes</option>
                                <option value="60">1 hour (60 min)</option>
                                <option value="90">1.5 hours (90 min)</option>
                                <option value="120">2 hours (120 min)</option>
                            </select>
                            @error('editDuration') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-700 dark:text-slate-300 mb-1">Booking Status</label>
                            <select wire:model="editStatus" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl py-2.5 px-3 text-xs sm:text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none font-semibold">
                                <option value="confirmed">Confirmed</option>
                                <option value="pending">Pending</option>
                                <option value="rescheduled">Rescheduled</option>
                                <option value="completed">Completed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                            @error('editStatus') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 dark:text-slate-300 mb-1">Assigned Advisor / Staff</label>
                        <select wire:model="editAccountantId" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl py-2.5 px-3 text-xs sm:text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                            <option value="">-- Unassigned / Admin Pool --</option>
                            @foreach($staff as $member)
                                <option value="{{ $member->id }}">{{ $member->name }} ({{ ucfirst($member->role) }})</option>
                            @endforeach
                        </select>
                        @error('editAccountantId') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 dark:text-slate-300 mb-1">Special Notes / Meeting Agenda</label>
                        <textarea wire:model="editNotes" rows="2" placeholder="Add preparation notes or instructions for the client..." class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl py-2 px-3 text-xs sm:text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none"></textarea>
                        @error('editNotes') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100 dark:border-slate-800">
                        <button type="button" wire:click="closeEditModal" class="px-4 py-2.5 text-xs font-bold text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-800 rounded-xl hover:bg-slate-200 dark:hover:bg-slate-700 transition cursor-pointer">Cancel</button>
                        <button type="submit" class="px-6 py-2.5 text-xs font-bold text-white bg-[#005DFF] hover:bg-[#003dc2] rounded-xl shadow-md transition flex items-center gap-1.5 cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Save Booking Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- ============================================================
         2. SEND REMINDER MODAL
         ============================================================ --}}
    @if($showReminderModal)
        <div class="fixed inset-0 z-50 bg-slate-950/60 backdrop-blur-sm flex items-center justify-center p-4">
            <div class="bg-white dark:bg-slate-900 rounded-3xl max-w-md w-full p-6 sm:p-8 shadow-2xl border border-slate-200 dark:border-slate-800">
                <div class="flex items-center justify-between mb-4 border-b border-slate-100 dark:border-slate-800 pb-3">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center font-bold">
                            🔔
                        </div>
                        <div>
                            <h3 class="text-base font-bold font-heading text-slate-900 dark:text-white">Send Appointment Reminder</h3>
                            <p class="text-xs text-slate-500">{{ $reminderClientName }} ({{ $reminderClientEmail }})</p>
                        </div>
                    </div>
                    <button wire:click="closeReminderModal" class="p-1.5 rounded-lg text-slate-400 hover:text-slate-700 hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <form wire:submit.prevent="sendReminder" class="space-y-4">
                    <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                        This will send a professional email and dashboard notification reminding the client of their upcoming booking date, time, and video consultation link.
                    </p>

                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 dark:text-slate-300 mb-1">Optional Custom Note to Client</label>
                        <textarea wire:model="reminderCustomMessage" rows="3" placeholder="e.g. Please ensure you have your T4 and tax slips ready before our session..." class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl py-2 px-3 text-xs sm:text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-amber-500 outline-none"></textarea>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-3 border-t border-slate-100 dark:border-slate-800">
                        <button type="button" wire:click="closeReminderModal" class="px-4 py-2 text-xs font-bold text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-800 rounded-xl hover:bg-slate-200 transition cursor-pointer">Cancel</button>
                        <button type="submit" class="px-5 py-2 text-xs font-bold text-white bg-amber-600 hover:bg-amber-700 rounded-xl shadow-md transition flex items-center gap-1.5 cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                            Send Reminder Now
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- ============================================================
         3. SCHEDULE & CONFIRM MODAL (For Initial Pending Bookings)
         ============================================================ --}}
    @if($showScheduleModal)
        <div class="fixed inset-0 z-50 bg-slate-950/60 backdrop-blur-sm flex items-center justify-center p-4">
            <div class="bg-white dark:bg-slate-900 rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-100 dark:border-slate-800">
                <div class="flex items-center justify-between mb-5">
                    <h3 class="text-lg font-bold font-heading text-slate-900 dark:text-white">Schedule &amp; Confirm Appointment</h3>
                    <button wire:click="closeScheduleModal" class="p-1.5 rounded-lg text-slate-400 hover:text-slate-700 hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <form wire:submit.prevent="scheduleAndConfirm" class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Confirmed Date</label>
                            <input type="date" wire:model="scheduleDate" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl py-2 px-3 text-xs focus:ring-blue-500 focus:border-blue-500 outline-none">
                            @error('scheduleDate') <span class="text-red-500 text-[11px]">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Start Time</label>
                            <input type="time" wire:model="scheduleTime" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl py-2 px-3 text-xs focus:ring-blue-500 focus:border-blue-500 outline-none">
                            @error('scheduleTime') <span class="text-red-500 text-[11px]">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Duration (minutes)</label>
                        <select wire:model="scheduleDuration" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl py-2 px-3 text-xs focus:ring-blue-500 outline-none">
                            <option value="30">30 minutes</option>
                            <option value="45">45 minutes</option>
                            <option value="60">1 hour</option>
                            <option value="90">1.5 hours</option>
                            <option value="120">2 hours</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Assign Advisor / Staff</label>
                        <select wire:model="scheduleAccountantId" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl py-2 px-3 text-xs focus:ring-blue-500 outline-none">
                            <option value="">-- Unassigned / Admin Team --</option>
                            @foreach($staff as $member)
                                <option value="{{ $member->id }}">{{ $member->name }} ({{ ucfirst($member->role) }})</option>
                            @endforeach
                        </select>
                        @error('scheduleAccountantId') <span class="text-red-500 text-[11px]">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-3 border-t border-slate-100 dark:border-slate-800">
                        <button type="button" wire:click="closeScheduleModal" class="px-4 py-2 text-xs font-semibold text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-800 rounded-xl hover:bg-slate-200 dark:hover:bg-slate-700 transition">Cancel</button>
                        <button type="submit" class="px-5 py-2 text-xs font-bold text-white bg-[#005DFF] hover:bg-blue-700 rounded-xl shadow-sm transition flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Confirm &amp; Schedule
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- ============================================================
         4. LIVEKIT / WEBRTC VIDEO CALL MODAL
         ============================================================ --}}
    @if($showVideoCallModal)
        @include('livewire.client.video-call-modal')
    @endif
</div>
