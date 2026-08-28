<div x-data="{ removeAvatarModal: false }">
    <div class="mb-8">
        <h1 class="text-2xl font-extrabold text-gray-900 dark:text-white font-heading">My Profile</h1>
        <p class="text-xs text-gray-500 mt-1">Manage your personal details, business information, and profile picture.</p>
    </div>

    @if (session()->has('message'))
        <div class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-200 font-semibold text-xs rounded-2xl flex items-center shadow-sm">
            <svg class="w-5 h-5 mr-2 text-emerald-600 dark:text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            {{ session('message') }}
        </div>
    @endif

    <div class="card-box max-w-2xl">
        <form wire:submit.prevent="save" class="space-y-6">
            <!-- Profile Avatar Section -->
            <div class="p-4 bg-gray-50 dark:bg-gray-800/50 rounded-2xl border border-gray-100 dark:border-gray-700/60">
                <label class="block text-xs font-bold uppercase text-gray-700 dark:text-gray-300 mb-3 font-heading">Profile Picture</label>
                <div class="flex items-center gap-5">
                    <div class="relative flex-shrink-0">
                        @if (!empty($avatar))
                            <img src="{{ $avatar->temporaryUrl() }}" class="w-20 h-20 rounded-2xl object-cover ring-4 ring-[#005DFF]/20 shadow-md">
                        @else
                            <img src="{{ auth()->user()->avatar_url }}" class="w-20 h-20 rounded-2xl object-cover ring-4 ring-[#005DFF]/20 shadow-md">
                        @endif
                        <div wire:loading wire:target="avatar" class="absolute inset-0 bg-slate-900/60 backdrop-blur-xs rounded-2xl flex items-center justify-center text-white text-[10px] font-bold">
                            Uploading...
                        </div>
                    </div>
                    
                    <div class="space-y-2">
                        <div class="flex items-center gap-3">
                            <label class="px-4 py-2 bg-[#005DFF] hover:bg-blue-600 text-white font-bold text-xs rounded-xl shadow-sm cursor-pointer transition inline-flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                <span>Choose Image</span>
                                <input type="file" wire:model="avatar" accept="image/*" class="hidden">
                            </label>

                            @if(auth()->user()->avatar)
                                <button type="button" @click="removeAvatarModal = true" class="px-3 py-2 text-red-500 hover:bg-red-50 dark:hover:bg-red-950/40 rounded-xl text-xs font-semibold transition cursor-pointer">
                                    Remove Picture
                                </button>
                            @endif
                        </div>
                        <p class="text-[11px] text-gray-400">JPG, PNG, or GIF up to 5MB. Will automatically update across headers and chat.</p>
                        @error('avatar') <span class="text-red-500 text-[11px] block">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Basic Info Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Full Name</label>
                    <input type="text" wire:model="name" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs">
                    @error('name') <span class="text-red-500 text-[11px]">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Email Address</label>
                    <input type="email" wire:model="email" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs">
                    @error('email') <span class="text-red-500 text-[11px]">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Phone Number</label>
                    <input type="text" wire:model="phone" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Company Name</label>
                    <input type="text" wire:model="company_name" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs">
                </div>
            </div>

            {{-- Dedicated Consultant Assignment --}}
            <div class="p-4 bg-blue-50/50 dark:bg-blue-950/20 rounded-2xl border border-blue-100 dark:border-blue-900/40">
                <label class="block text-xs font-bold uppercase text-[#005DFF] mb-2 font-heading">Your Dedicated Consultant / Practice Partner</label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach($consultants as $c)
                        <label class="p-3 rounded-xl border {{ (string)$assigned_admin_id === (string)$c->id ? 'border-[#005DFF] bg-white dark:bg-slate-800 shadow-sm' : 'border-gray-200 dark:border-gray-700 bg-white/50 dark:bg-slate-800/50' }} flex items-center gap-3 cursor-pointer transition">
                            <input type="radio" wire:model="assigned_admin_id" value="{{ $c->id }}" class="accent-[#005DFF]">
                            <img src="{{ $c->avatar_url }}" alt="{{ $c->name }}" class="w-10 h-10 rounded-full object-cover border border-blue-200">
                            <div>
                                <div class="font-bold text-xs text-slate-900 dark:text-white">{{ $c->name }}</div>
                                <div class="text-[10px] text-slate-500">{{ $c->email }}</div>
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Tax Identification Number (TIN / SIN / BN)</label>
                    <input type="text" wire:model="tax_identification_number" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs font-mono">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Address</label>
                    <input type="text" wire:model="address" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs">
                </div>
            </div>

            <div class="pt-4 border-t border-gray-100 dark:border-gray-800 flex justify-end">
                <button type="submit" class="btn-primary text-xs">Save Profile Changes</button>
            </div>
        </form>
    </div>

    <!-- Remove Photo Confirmation Popup Dialog Box -->
    <div
        x-show="removeAvatarModal"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm"
        style="display: none;"
    >
        <div
            @click.away="removeAvatarModal = false"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95 translate-y-2"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 translate-y-2"
            class="bg-white dark:bg-gray-900 rounded-3xl max-w-md w-full p-6 shadow-2xl border border-gray-100 dark:border-gray-800 text-center"
        >
            <div class="w-14 h-14 mx-auto rounded-2xl bg-rose-50 dark:bg-rose-950/60 text-rose-600 flex items-center justify-center mb-4">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            </div>

            <h3 class="text-base font-bold text-gray-900 dark:text-white font-heading">Remove Profile Photo?</h3>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2 leading-relaxed">
                Are you sure you want to remove your custom profile photo? Your avatar will revert to your name initials.
            </p>

            <div class="flex items-center justify-center gap-3 mt-6">
                <button
                    type="button"
                    @click="removeAvatarModal = false"
                    class="px-5 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 font-bold text-xs hover:bg-gray-50 dark:hover:bg-gray-800 transition cursor-pointer"
                >
                    Cancel
                </button>
                <button
                    type="button"
                    @click="$wire.removeAvatar(); removeAvatarModal = false"
                    class="px-5 py-2.5 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs shadow-lg shadow-rose-600/20 transition cursor-pointer"
                >
                    Yes, Remove
                </button>
            </div>
        </div>
    </div>
</div>

