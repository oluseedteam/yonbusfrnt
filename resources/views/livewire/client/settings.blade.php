<div>
    <div class="mb-8">
        <h1 class="text-2xl font-extrabold text-gray-900 dark:text-white font-heading">Account Settings</h1>
        <p class="text-xs text-gray-500 mt-1">Preferences, security, and notification settings.</p>
    </div>

    @if (session()->has('message'))
        <div class="mb-6 p-4 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-200 text-xs font-semibold shadow-sm">
            {{ session('message') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Preferences Card -->
        <div class="card-box">
            <h3 class="font-bold text-sm text-gray-900 dark:text-white font-heading mb-4 border-b border-gray-100 dark:border-gray-800 pb-2">Notification Preferences</h3>
            
            <form wire:submit.prevent="updatePreferences" class="space-y-4 text-xs">
                <div class="flex items-center justify-between p-3.5 rounded-xl bg-gray-50 dark:bg-gray-800/50">
                    <div>
                        <h4 class="font-bold text-gray-900 dark:text-white font-heading">Email Notifications</h4>
                        <p class="text-gray-500">Receive alerts when tax status changes or invoices are generated.</p>
                    </div>
                    <input type="checkbox" wire:model="email_notifications" class="rounded text-[#005DFF] focus:ring-[#005DFF]">
                </div>

                <div class="flex items-center justify-between p-3.5 rounded-xl bg-gray-50 dark:bg-gray-800/50">
                    <div>
                        <h4 class="font-bold text-gray-900 dark:text-white font-heading">SMS Appointment Reminders</h4>
                        <p class="text-gray-500">Receive text notifications 24 hours prior to consultations.</p>
                    </div>
                    <input type="checkbox" wire:model="sms_reminders" class="rounded text-[#005DFF] focus:ring-[#005DFF]">
                </div>

                <div class="pt-2 flex justify-end">
                    <button type="submit" class="btn-primary text-xs">Save Preferences</button>
                </div>
            </form>
        </div>

        <!-- Change Password Card -->
        <div class="card-box">
            <h3 class="font-bold text-sm text-gray-900 dark:text-white font-heading mb-4 border-b border-gray-100 dark:border-gray-800 pb-2">Security & Password</h3>

            <form wire:submit.prevent="updatePassword" class="space-y-4 text-xs">
                <div>
                    <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">Current Password</label>
                    <input type="password" wire:model="current_password" class="w-full rounded-xl border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 py-2 px-3 focus:ring-[#005DFF]">
                    @error('current_password') <span class="text-rose-500 text-[11px] block mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">New Password</label>
                    <input type="password" wire:model="new_password" class="w-full rounded-xl border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 py-2 px-3 focus:ring-[#005DFF]">
                    @error('new_password') <span class="text-rose-500 text-[11px] block mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">Confirm New Password</label>
                    <input type="password" wire:model="new_password_confirmation" class="w-full rounded-xl border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 py-2 px-3 focus:ring-[#005DFF]">
                </div>

                <div class="pt-2 flex justify-end">
                    <button type="submit" class="btn-secondary text-xs">Update Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
