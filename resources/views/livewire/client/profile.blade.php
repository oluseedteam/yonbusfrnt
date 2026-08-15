<div>
    <div class="mb-8">
        <h1 class="text-2xl font-extrabold text-gray-900 dark:text-white font-heading">My Profile</h1>
        <p class="text-xs text-gray-500 mt-1">Manage your personal details, business information, and profile picture.</p>
    </div>

    @if (session()->has('message'))
        <div class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-300 font-bold text-xs rounded-2xl flex items-center">
            <svg class="w-5 h-5 mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
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
                        @if ($avatar)
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
                                <button type="button" wire:click="removeAvatar" wire:confirm="Remove profile picture?" class="px-3 py-2 text-red-500 hover:bg-red-50 dark:hover:bg-red-950/40 rounded-xl text-xs font-semibold transition">
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

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Tax Identification Number (TIN / EIN / SSN)</label>
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
</div>

