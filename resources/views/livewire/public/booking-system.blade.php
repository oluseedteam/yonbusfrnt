<div class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl border border-slate-200 dark:border-slate-700 p-8 sm:p-12">
    <!-- Progress Indicator -->
    <div class="mb-10">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm {{ $step >= 1 ? 'bg-[#005DFF] text-white' : 'bg-slate-100 dark:bg-slate-700 text-slate-400' }}">1</div>
                <span class="text-xs sm:text-sm font-semibold {{ $step >= 1 ? 'text-slate-900 dark:text-white' : 'text-slate-400' }}">Select Service</span>
            </div>
            <div class="w-12 sm:w-24 h-0.5 bg-slate-200 dark:bg-slate-700"></div>
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm {{ $step >= 2 ? 'bg-[#005DFF] text-white' : 'bg-slate-100 dark:bg-slate-700 text-slate-400' }}">2</div>
                <span class="text-xs sm:text-sm font-semibold {{ $step >= 2 ? 'text-slate-900 dark:text-white' : 'text-slate-400' }}">Date & Time</span>
            </div>
            <div class="w-12 sm:w-24 h-0.5 bg-slate-200 dark:bg-slate-700"></div>
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm {{ $step >= 3 ? 'bg-[#005DFF] text-white' : 'bg-slate-100 dark:bg-slate-700 text-slate-400' }}">3</div>
                <span class="text-xs sm:text-sm font-semibold {{ $step >= 3 ? 'text-slate-900 dark:text-white' : 'text-slate-400' }}">Your Details</span>
            </div>
        </div>
    </div>

    @if ($errorMessage)
        <div class="mb-6 p-4 bg-rose-500/10 border border-rose-500/20 text-rose-600 dark:text-rose-400 rounded-xl text-sm font-medium">
            {{ $errorMessage }}
        </div>
    @endif

    <!-- Step 1: Select Service -->
    @if($step === 1)
        <div class="space-y-6">
            <h2 class="text-2xl font-bold font-heading text-slate-900 dark:text-white">Step 1: Choose Your Service</h2>
            <p class="text-slate-600 dark:text-slate-400 text-sm">Select from our specialized tax, accounting, and advisory services.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @forelse($services as $s)
                    <label class="relative flex p-4 rounded-2xl border cursor-pointer transition-all {{ $service_id == $s->id ? 'border-[#005DFF] bg-blue-50/60 dark:bg-blue-900/20 ring-2 ring-[#005DFF]/25 shadow-md shadow-blue-500/5' : 'border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900/40 hover:border-slate-300 dark:hover:border-slate-600' }}">
                        <input type="radio" wire:model.live="service_id" value="{{ $s->id }}" class="sr-only">
                        <div class="flex items-start space-x-4 w-full">
                            <div class="w-11 h-11 rounded-xl flex items-center justify-center font-bold text-xl shrink-0 transition-colors {{ $service_id == $s->id ? 'bg-[#005DFF] text-white shadow-sm' : 'bg-blue-50 dark:bg-blue-950/60 border border-blue-100 dark:border-blue-900/40 text-[#005DFF]' }}">
                                {{ $s->icon ?? '✓' }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between gap-2">
                                    <div class="font-bold text-slate-900 dark:text-white text-base font-heading">{{ $s->name }}</div>
                                    @if($service_id == $s->id)
                                        <span class="w-5 h-5 rounded-full bg-[#005DFF] text-white flex items-center justify-center text-xs font-bold shrink-0">✓</span>
                                    @endif
                                </div>
                                <div class="text-xs text-slate-500 dark:text-slate-400 mt-1 line-clamp-2 leading-relaxed">{{ $s->description }}</div>
                            </div>
                        </div>
                    </label>
                @empty
                    <div class="col-span-2 py-8 text-center text-slate-500 dark:text-slate-400">
                        No active services found in database.
                    </div>
                @endforelse
            </div>
            @error('service_id') <span class="text-xs text-rose-500 font-semibold block">{{ $message }}</span> @enderror

            <div class="pt-6 flex justify-end">
                <button type="button" wire:click="nextStep" class="px-8 py-3.5 rounded-xl bg-[#005DFF] hover:bg-[#002B8A] text-white font-bold text-sm shadow-lg transition">
                    Continue to Date & Time →
                </button>
            </div>
        </div>

    <!-- Step 2: Date & Time & Preferred Accountant -->
    @elseif($step === 2)
        <div class="space-y-6">
            <h2 class="text-2xl font-bold font-heading text-slate-900 dark:text-white">Step 2: Select Date & Time Slot</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 dark:text-slate-300 mb-2">Preferred Accountant (Optional)</label>
                    <select wire:model.live="accountant_id" class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white focus:border-[#005DFF] focus:ring-[#005DFF] text-sm">
                        <option value="">Any Available CPB Accountant</option>
                        @foreach($accountants as $acc)
                            <option value="{{ $acc->id }}">{{ $acc->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 dark:text-slate-300 mb-2">Appointment Date</label>
                    <input type="date" wire:model.live="appointment_date" min="{{ date('Y-m-d') }}" class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white focus:border-[#005DFF] focus:ring-[#005DFF] text-sm">
                    @error('appointment_date') <span class="text-xs text-rose-500 font-semibold">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between mb-3">
                    <label class="block text-xs font-bold uppercase text-slate-700 dark:text-slate-300">
                        Select Consultation Time Slot
                    </label>
                    <div class="flex items-center gap-3 text-xs">
                        <span class="flex items-center gap-1 text-emerald-600 font-semibold">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Available
                        </span>
                        <span class="flex items-center gap-1 text-slate-400 font-semibold">
                            <span class="w-2 h-2 rounded-full bg-rose-400"></span> Booked / Unavailable
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                    @forelse($timeSlots as $slot)
                        @if($slot['is_available'])
                            <button type="button"
                                    wire:click="selectTimeSlot('{{ $slot['time'] }}', true)"
                                    class="py-3 px-3.5 rounded-2xl border text-center transition flex flex-col items-center justify-center gap-1 {{ $appointment_time === $slot['time'] ? 'bg-[#005DFF] text-white border-[#005DFF] shadow-lg shadow-blue-500/20 ring-2 ring-[#005DFF]/30' : 'bg-white dark:bg-slate-900 border-slate-200 dark:border-slate-700 text-slate-800 dark:text-slate-200 hover:border-[#005DFF] hover:shadow-sm' }}">
                                <span class="text-sm font-bold">{{ $slot['formatted'] }}</span>
                                <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full {{ $appointment_time === $slot['time'] ? 'bg-white/20 text-white' : 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950/50 dark:text-emerald-300' }}">
                                    Available
                                </span>
                            </button>
                        @else
                            <div class="py-3 px-3.5 rounded-2xl border border-dashed border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/40 text-slate-400 dark:text-slate-500 flex flex-col items-center justify-center gap-1 cursor-not-allowed opacity-60">
                                <span class="text-sm font-semibold line-through">{{ $slot['formatted'] }}</span>
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-rose-50 text-rose-600 dark:bg-rose-950/40 dark:text-rose-400">
                                    🔒 Booked
                                </span>
                            </div>
                        @endif
                    @empty
                        <div class="col-span-full py-6 text-center text-slate-400 text-xs">
                            No consultation slots available on this date. Please select another business day.
                        </div>
                    @endforelse
                </div>
                @error('appointment_time') <span class="text-xs text-rose-500 font-semibold mt-2 block">{{ $message }}</span> @enderror
            </div>

            <div class="pt-6 flex justify-between">
                <button type="button" wire:click="previousStep" class="px-6 py-3 rounded-xl border border-slate-300 dark:border-slate-700 text-slate-700 dark:text-slate-300 font-bold text-sm hover:bg-slate-50 transition">
                    ← Back
                </button>
                <button type="button" wire:click="nextStep" class="px-8 py-3.5 rounded-xl bg-[#005DFF] hover:bg-[#002B8A] text-white font-bold text-sm shadow-lg transition">
                    Continue to Your Details →
                </button>
            </div>
        </div>

    <!-- Step 3: Client Details -->
    @elseif($step === 3)
        <form wire:submit.prevent="submitBooking" class="space-y-6">
            <h2 class="text-2xl font-bold font-heading text-slate-900 dark:text-white">Step 3: Enter Your Contact Details</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 dark:text-slate-300 mb-1">First Name *</label>
                    <input type="text" wire:model="first_name" class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-[#005DFF]" placeholder="John">
                    @error('first_name') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 dark:text-slate-300 mb-1">Last Name *</label>
                    <input type="text" wire:model="last_name" class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-[#005DFF]" placeholder="Doe">
                    @error('last_name') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 dark:text-slate-300 mb-1">Email Address *</label>
                    <input type="email" wire:model="client_email" class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-[#005DFF]" placeholder="john@example.com">
                    @error('client_email') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 dark:text-slate-300 mb-1">Phone Number *</label>
                    <input type="text" wire:model="client_phone" class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-[#005DFF]" placeholder="+1 (555) 000-0000">
                    @error('client_phone') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 dark:text-slate-300 mb-1">Company Name (Optional)</label>
                <input type="text" wire:model="company_name" class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-[#005DFF]" placeholder="Doe Enterprises">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 dark:text-slate-300 mb-1">Notes / Special Instructions</label>
                <textarea wire:model="notes" rows="3" class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-[#005DFF]" placeholder="Please mention any specific tax slips or financial questions you have..."></textarea>
            </div>

            <div class="pt-6 flex justify-between">
                <button type="button" wire:click="previousStep" class="px-6 py-3 rounded-xl border border-slate-300 dark:border-slate-700 text-slate-700 dark:text-slate-300 font-bold text-sm hover:bg-slate-50 transition">
                    ← Back
                </button>
                <button type="submit" class="px-10 py-4 rounded-xl bg-gradient-to-r from-[#005DFF] to-[#00A3FF] hover:from-[#002B8A] hover:to-[#005DFF] text-white font-bold text-base shadow-xl transition transform hover:-translate-y-0.5">
                    Confirm Appointment Booking ✓
                </button>
            </div>
        </form>

    <!-- Step 4: Booking Confirmation -->
    @elseif($step === 4 && $bookingSuccess)
        <div class="text-center py-8 space-y-6">
            <div class="w-20 h-20 bg-[#005DFF] text-white rounded-full flex items-center justify-center mx-auto text-3xl font-extrabold shadow-lg">
                ✓
            </div>
            <h2 class="text-3xl font-extrabold font-heading text-slate-900 dark:text-white">Appointment Booked Successfully!</h2>
            <p class="text-slate-600 dark:text-slate-400 max-w-lg mx-auto text-base">
                Your consultation request has been received and confirmed. Reference Number: <span class="font-mono font-bold text-blue-600">{{ $confirmedAppointment->appointment_number }}</span>
            </p>

            <div class="bg-slate-50 dark:bg-slate-900 rounded-2xl p-6 max-w-md mx-auto border border-slate-200 dark:border-slate-700 text-left space-y-3">
                <div class="flex justify-between text-xs text-slate-500">
                    <span>Booking Status</span>
                    <span class="font-bold text-amber-600 bg-amber-50 dark:bg-amber-900/20 px-2 py-0.5 rounded uppercase">Pending Confirmation</span>
                </div>
                <div class="text-sm font-bold text-slate-900 dark:text-white">Service: {{ $confirmedAppointment->service->name ?? 'Tax Service' }}</div>
                <div class="text-xs text-slate-600 dark:text-slate-400">Date: {{ $confirmedAppointment->date?->format('M d, Y') }} at {{ date('h:i A', strtotime($confirmedAppointment->time)) }}</div>
                <div class="text-xs text-slate-600 dark:text-slate-400">Assigned Accountant: {{ $confirmedAppointment->accountant->name ?? 'YONBUS Specialist' }}</div>
            </div>

            <div class="pt-4 flex justify-center space-x-4">
                <a href="{{ route('login') }}" class="px-6 py-3 rounded-xl bg-[#005DFF] text-white font-bold text-sm shadow-md hover:bg-[#002B8A] transition">
                    Login to Client Portal
                </a>
                <a href="{{ route('home') }}" class="px-6 py-3 rounded-xl border border-slate-300 dark:border-slate-700 text-slate-700 dark:text-slate-300 font-bold text-sm hover:bg-slate-50 transition">
                    Return to Homepage
                </a>
            </div>
        </div>
    @endif
</div>
