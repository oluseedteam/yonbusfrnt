<div>
    <div class="mb-8">
        <h1 class="text-2xl font-extrabold text-gray-900 dark:text-white font-heading">Account Settings</h1>
        <p class="text-xs text-gray-500 mt-1">Preferences, security, and notification settings.</p>
    </div>

    <div class="card-box max-w-2xl">
        <div class="border-b border-gray-100 dark:border-gray-800 pb-4 mb-6 flex items-center gap-4 text-xs font-semibold">
            <button class="text-[#005DFF] border-b-2 border-[#005DFF] pb-2 font-heading">Security & Notifications</button>
        </div>

        <div class="space-y-6 text-xs">
            <div class="flex items-center justify-between p-3.5 rounded-xl bg-gray-50 dark:bg-gray-800/50">
                <div>
                    <h4 class="font-bold text-gray-900 dark:text-white font-heading">Email Notifications</h4>
                    <p class="text-gray-500">Receive email alerts when tax status changes or invoices are generated.</p>
                </div>
                <input type="checkbox" checked class="rounded text-[#005DFF] focus:ring-[#005DFF]">
            </div>

            <div class="flex items-center justify-between p-3.5 rounded-xl bg-gray-50 dark:bg-gray-800/50">
                <div>
                    <h4 class="font-bold text-gray-900 dark:text-white font-heading">SMS Appointment Reminders</h4>
                    <p class="text-gray-500">Receive text notifications 24 hours prior to consultations.</p>
                </div>
                <input type="checkbox" checked class="rounded text-[#005DFF] focus:ring-[#005DFF]">
            </div>

            <div class="pt-4 border-t border-gray-100 dark:border-gray-800">
                <h4 class="font-bold text-gray-900 dark:text-white font-heading mb-3">Two-Factor Authentication</h4>
                <button type="button" class="btn-secondary text-xs">Enable 2FA Protection</button>
            </div>
        </div>
    </div>
</div>
