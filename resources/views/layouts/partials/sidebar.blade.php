@props(['role' => 'client'])

<aside class="w-64 bg-white dark:bg-gray-900 border-r border-gray-100 dark:border-gray-800 flex flex-col justify-between h-screen sticky top-0 z-30 overflow-y-auto transition-colors flex-shrink-0">
    <div>
        <!-- Logo -->
        <div class="h-24 flex items-center justify-center p-4 border-b border-gray-100 dark:border-gray-800/80">
            <a href="{{ route('dashboard') }}" class="flex items-center justify-center">
                <img src="{{ asset('images/logo.png') }}" alt="YONBUS Logo" class="h-16 w-auto object-contain transition-transform hover:scale-105">
            </a>
        </div>

        <!-- Navigation Links -->
        <nav class="p-3 flex flex-col gap-1.5">
            @if($role === 'client')
                <x-nav-item route="client.dashboard" icon="squares" label="Dashboard" />
                <x-nav-item route="client.appointments" icon="calendar" label="Appointments" />
                <x-nav-item route="client.documents" icon="folder" label="Documents" />
                <x-nav-item route="client.tax-returns" icon="document-tax" label="Tax Returns" />
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
                <x-nav-item route="admin.documents" icon="folder" label="Documents Vault" />
                <x-nav-item route="admin.inquiries" icon="inbox" label="Inquiries &amp; Careers" />
                <x-nav-item route="admin.users" icon="users" label="User &amp; Client Management" />
                <x-nav-item route="admin.services" icon="briefcase" label="Services" />
                <x-nav-item route="admin.appointments" icon="calendar" label="Appointments" />
                <x-nav-item route="admin.invoices" icon="credit-card" label="Invoices" />
                <x-nav-item route="admin.messages" icon="chat" label="Messages" />
                <x-nav-item route="admin.blogs" icon="document-text" label="Blog System" />
                <x-nav-item route="admin.reports" icon="chart" label="Reporting System" />
                <x-nav-item route="admin.activity-logs" icon="shield" label="Activity Logs" />
                <x-nav-item route="admin.profile" icon="user" label="Admin Profile" />
                <x-nav-item route="admin.settings" icon="cog" label="System Settings" />
            @endif
        </nav>
    </div>

    <!-- Bottom Widget & Support -->
    <div class="p-4 border-t border-gray-100 dark:border-gray-800/60">
        <div class="p-3.5 rounded-2xl bg-[#f0f6ff] dark:bg-blue-950/40 border border-[#dbeafe] dark:border-blue-900/50">
            <div class="flex items-center gap-3 mb-1.5">
                <div class="w-8 h-8 rounded-xl bg-[#005DFF] text-white flex items-center justify-center font-bold text-xs shadow-sm">
                    Y
                </div>
                <div>
                    <h5 class="text-xs font-bold text-slate-900 dark:text-white m-0">YONBUS Support</h5>
                    <p class="text-[11px] text-slate-500 dark:text-slate-400 m-0">Online 24/7</p>
                </div>
            </div>
            <a href="mailto:support@yonbustax.ca" class="text-xs font-semibold text-[#005DFF] hover:underline flex items-center gap-1 mt-1">
                Contact Support &rarr;
            </a>
        </div>
    </div>
</aside>
