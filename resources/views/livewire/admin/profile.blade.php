<div class="p-6 max-w-5xl mx-auto" x-data="{ removeAvatarModal: false }">
    <div class="mb-8">
        <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white font-heading">Admin Profile &amp; Account</h1>
        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Manage your administrative details, profile photo, and security credentials.</p>
    </div>

    @if (session()->has('profile_message'))
        <div class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-200 font-semibold text-xs rounded-2xl flex items-center shadow-sm">
            <svg class="w-5 h-5 mr-2 text-emerald-600 dark:text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            {{ session('profile_message') }}
        </div>
    @endif

    @if (session()->has('password_message'))
        <div class="mb-6 p-4 bg-blue-50 dark:bg-blue-950/40 border border-blue-200 dark:border-blue-800 text-blue-800 dark:text-blue-200 font-semibold text-xs rounded-2xl flex items-center shadow-sm">
            <svg class="w-5 h-5 mr-2 text-blue-600 dark:text-blue-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            {{ session('password_message') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left: Profile Summary Card -->
        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 shadow-sm border border-slate-200 dark:border-slate-700/60 text-center">
                <div class="relative inline-block mb-4">
                    @if (!empty($avatar))
                        <img src="{{ $avatar->temporaryUrl() }}" class="w-28 h-28 rounded-2xl object-cover ring-4 ring-blue-500/20 shadow-md mx-auto">
                    @else
                        <img src="{{ auth()->user()->avatar_url }}" class="w-28 h-28 rounded-2xl object-cover ring-4 ring-blue-500/20 shadow-md mx-auto">
                    @endif
                    <div wire:loading wire:target="avatar" class="absolute inset-0 bg-slate-900/60 backdrop-blur-xs rounded-2xl flex items-center justify-center text-white text-xs font-bold">
                        Uploading...
                    </div>
                </div>

                <h3 class="text-base font-bold text-slate-900 dark:text-white font-heading">{{ auth()->user()->name }}</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">{{ auth()->user()->email }}</p>

                <div class="mt-3">
                    <span class="inline-flex px-3 py-1 text-xs font-bold rounded-full bg-blue-500/10 text-blue-600 dark:text-blue-400 uppercase tracking-wide">
                        {{ auth()->user()->role === 'superadmin' ? 'Super Administrator' : 'Administrator' }}
                    </span>
                </div>

                <div class="mt-6 pt-6 border-t border-slate-100 dark:border-slate-700/60 space-y-3 text-left text-xs">
                    <div class="flex justify-between items-center text-slate-600 dark:text-slate-400">
                        <span>Account Status</span>
                        <span class="font-semibold text-emerald-600 dark:text-emerald-400 flex items-center gap-1">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Active
                        </span>
                    </div>
                    <div class="flex justify-between items-center text-slate-600 dark:text-slate-400">
                        <span>Member Since</span>
                        <span class="font-medium text-slate-900 dark:text-white">{{ auth()->user()->created_at->format('M Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Forms -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Personal Info & Avatar Form -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 shadow-sm border border-slate-200 dark:border-slate-700/60">
                <h3 class="text-base font-bold text-slate-900 dark:text-white font-heading mb-4 pb-2 border-b border-slate-100 dark:border-slate-700/60">
                    Administrator Details
                </h3>

                <form wire:submit.prevent="saveProfile" class="space-y-5">
                    <!-- Avatar Upload Controls -->
                    <div class="p-4 bg-slate-50 dark:bg-slate-900/50 rounded-xl border border-slate-200 dark:border-slate-700/60">
                        <label class="block text-xs font-bold uppercase text-slate-700 dark:text-slate-300 mb-2 font-heading">Update Profile Photo</label>
                        <div class="flex flex-wrap items-center gap-3">
                            <label class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-sm cursor-pointer transition inline-flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                <span>Choose Image</span>
                                <input type="file" wire:model="avatar" accept="image/*" class="hidden">
                            </label>

                            @if(auth()->user()->avatar)
                                <button type="button" @click="removeAvatarModal = true" class="px-3 py-2 text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-950/40 rounded-xl text-xs font-semibold transition cursor-pointer">
                                    Remove Photo
                                </button>
                            @endif
                        </div>
                        <p class="text-[11px] text-slate-400 mt-2">JPG, PNG, or WebP up to 5MB. Visible in admin logs, header, and system audits.</p>
                        @error('avatar') <span class="text-rose-500 text-[11px] block mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">First Name</label>
                            <input type="text" wire:model="first_name" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl py-2 px-3 text-xs text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                            @error('first_name') <span class="text-rose-500 text-[11px]">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Last Name</label>
                            <input type="text" wire:model="last_name" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl py-2 px-3 text-xs text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                            @error('last_name') <span class="text-rose-500 text-[11px]">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Email Address</label>
                            <input type="email" wire:model="email" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl py-2 px-3 text-xs text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                            @error('email') <span class="text-rose-500 text-[11px]">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Phone Number</label>
                            <input type="text" wire:model="phone" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl py-2 px-3 text-xs text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                            @error('phone') <span class="text-rose-500 text-[11px]">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="pt-3 border-t border-slate-100 dark:border-slate-700/60 flex justify-end">
                        <button type="submit" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-sm transition">
                            Save Profile Changes
                        </button>
                    </div>
                </form>
            </div>

            <!-- Password Update Form -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 shadow-sm border border-slate-200 dark:border-slate-700/60">
                <h3 class="text-base font-bold text-slate-900 dark:text-white font-heading mb-4 pb-2 border-b border-slate-100 dark:border-slate-700/60">
                    Security &amp; Password
                </h3>

                <form wire:submit.prevent="updatePassword" class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Current Password</label>
                        <input type="password" wire:model="current_password" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl py-2 px-3 text-xs text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                        @error('current_password') <span class="text-rose-500 text-[11px]">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">New Password</label>
                            <input type="password" wire:model="new_password" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl py-2 px-3 text-xs text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                            @error('new_password') <span class="text-rose-500 text-[11px]">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Confirm New Password</label>
                            <input type="password" wire:model="new_password_confirmation" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl py-2 px-3 text-xs text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                    </div>

                    <div class="pt-3 border-t border-slate-100 dark:border-slate-700/60 flex justify-end">
                        <button type="submit" class="px-5 py-2.5 bg-slate-900 dark:bg-slate-700 hover:bg-slate-800 text-white font-bold text-xs rounded-xl shadow-sm transition cursor-pointer">
                            Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
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
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
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
            class="bg-white dark:bg-slate-800 rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-200 dark:border-slate-700 text-center"
        >
            <div class="w-14 h-14 mx-auto rounded-2xl bg-rose-50 dark:bg-rose-950/60 text-rose-600 flex items-center justify-center mb-4">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            </div>

            <h3 class="text-base font-bold text-slate-900 dark:text-white font-heading">Remove Profile Photo?</h3>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-2 leading-relaxed">
                Are you sure you want to remove your admin profile photo? Your avatar will revert to your name initials.
            </p>

            <div class="flex items-center justify-center gap-3 mt-6">
                <button
                    type="button"
                    @click="removeAvatarModal = false"
                    class="px-5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 font-bold text-xs hover:bg-slate-50 dark:hover:bg-slate-700 transition cursor-pointer"
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
