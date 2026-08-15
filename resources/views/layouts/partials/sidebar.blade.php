@props(['role' => 'client'])

<aside class="w-64 bg-white dark:bg-gray-900 border-r border-gray-100 dark:border-gray-800 flex flex-col justify-between h-screen sticky top-0 z-30 transition-all duration-300">
    <div>
        <!-- Logo -->
        <div class="h-28 flex items-center px-6 border-b border-gray-100 dark:border-gray-800/60">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                <x-application-logo class="h-16 w-auto object-contain drop-shadow-md" />
            </a>
        </div>

        <!-- Navigation Links -->
        <nav class="p-4 space-y-1 overflow-y-auto max-h-[calc(100vh-220px)]">
            @if($role === 'client')
                <x-nav-item route="client.dashboard" icon="squares" label="Dashboard" />
                <x-nav-item route="client.appointments" icon="calendar" label="Appointments" />
                <x-nav-item route="client.documents" icon="folder" label="Documents" />
                <x-nav-item route="client.tax-returns" icon="document-tax" label="Tax Returns" />
                <x-nav-item route="client.invoices" icon="credit-card" label="Invoices" />
                <x-nav-item route="client.messages" icon="chat" label="Messages" />
                <x-nav-item route="client.reports" icon="chart" label="Reports" />
                <x-nav-item route="client.profile" icon="user" label="Profile" />
                <x-nav-item route="client.settings" icon="cog" label="Settings" />
            @elseif($role === 'accountant')
                <x-nav-item route="accountant.dashboard" icon="squares" label="Dashboard" />
                <x-nav-item route="accountant.clients" icon="users" label="Client Directory" />
                <x-nav-item route="accountant.appointments" icon="calendar" label="Appointments" />
                <x-nav-item route="accountant.documents" icon="folder" label="Documents" />
                <x-nav-item route="accountant.tax-returns" icon="document-tax" label="Tax Returns" />
                <x-nav-item route="accountant.invoices" icon="credit-card" label="Invoices" />
                <x-nav-item route="accountant.messages" icon="chat" label="Messages" />
                <x-nav-item route="accountant.reports" icon="chart" label="Reports" />
            @elseif($role === 'admin' || $role === 'superadmin')
                <x-nav-item route="admin.dashboard" icon="squares" label="Dashboard" />
                <x-nav-item route="admin.users" icon="users" label="User Management" />
                <x-nav-item route="admin.services" icon="briefcase" label="Services" />
                <x-nav-item route="admin.appointments" icon="calendar" label="Appointments" />
                <x-nav-item route="admin.invoices" icon="credit-card" label="Invoices" />
                <x-nav-item route="admin.messages" icon="chat" label="Messages" />
                <x-nav-item route="admin.blogs" icon="document-text" label="Blog System" />
                <x-nav-item route="admin.reports" icon="chart" label="Reporting System" />
                <x-nav-item route="admin.activity-logs" icon="shield" label="Activity Logs" />
                <x-nav-item route="admin.settings" icon="cog" label="System Settings" />
            @endif
        </nav>
    </div>

    <!-- Bottom Widget & Support -->
    <div class="p-4 border-t border-gray-100 dark:border-gray-800/60 space-y-3">
        <div class="p-3.5 rounded-xl bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-blue-950/40 dark:to-indigo-950/40 border border-blue-100 dark:border-blue-900/50">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-8 h-8 rounded-lg bg-[#2563EB] text-white flex items-center justify-center font-bold text-xs">
                    Y
                </div>
                <div>
                    <h5 class="text-xs font-semibold text-gray-900 dark:text-white font-heading">YONBUS Support</h5>
                    <p class="text-[11px] text-gray-500 dark:text-gray-400">Online 24/7</p>
                </div>
            </div>
            <a href="mailto:support@yonbustax.ca" class="text-xs font-medium text-[#2563EB] hover:underline flex items-center gap-1 mt-1">
                Contact Support &rarr;
            </a>
        </div>
    </div>
</aside>
