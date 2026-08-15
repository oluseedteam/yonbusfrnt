<div>
    <div class="mb-8">
        <h1 class="text-2xl font-extrabold text-gray-900 dark:text-white font-heading">System Settings & Configuration</h1>
        <p class="text-xs text-gray-500 mt-1">Configure company details, branding options, tax defaults, and email notifications.</p>
    </div>

    @if (session()->has('message'))
        <div class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-200 font-semibold text-xs rounded-2xl flex items-center shadow-sm">
            <svg class="w-5 h-5 mr-2 text-emerald-600 dark:text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            {{ session('message') }}
        </div>
    @endif

    <div class="card-box max-w-3xl">
        <form wire:submit.prevent="save" class="space-y-6">
            <div>
                <h3 class="font-bold text-sm text-gray-900 dark:text-white font-heading mb-3 border-b border-gray-100 dark:border-gray-800 pb-2">General Company Profile</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Company Name</label>
                        <input type="text" wire:model="settings.company_name" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Support Email</label>
                        <input type="email" wire:model="settings.company_email" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Support Phone</label>
                        <input type="text" wire:model="settings.company_phone" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Tax Identification / Employer ID</label>
                        <input type="text" wire:model="settings.company_ein" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs font-mono">
                    </div>
                </div>
            </div>

            <div>
                <h3 class="font-bold text-sm text-gray-900 dark:text-white font-heading mb-3 border-b border-gray-100 dark:border-gray-800 pb-2">Billing & Tax Options</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Default Tax Rate (%)</label>
                        <input type="number" step="0.1" wire:model="settings.tax_rate" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Currency Code</label>
                        <input type="text" wire:model="settings.currency" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs uppercase font-mono">
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-gray-100 dark:border-gray-800 flex justify-end">
                <button type="submit" class="btn-primary text-xs">Save System Settings</button>
            </div>
        </form>
    </div>
</div>
