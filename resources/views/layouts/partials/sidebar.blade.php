@props(['role' => 'client'])

<aside style="width: 260px; background: #031B4E; display: flex; flex-direction: column; justify-content: space-between; height: 100vh; position: sticky; top: 0; z-index: 30; overflow-y: auto; transition: all 0.3s; flex-shrink: 0;">
    <div>
        <!-- Logo -->
        <div style="height: 72px; display: flex; align-items: center; padding: 0 1.5rem; border-bottom: 1px solid rgba(255,255,255,0.08);">
            <a href="{{ route('dashboard') }}" style="display: flex; align-items: center; gap: 10px; text-decoration: none;">
                <x-application-logo style="height: 42px; width: auto; object-fit: contain; background: rgba(255,255,255,0.1); padding: 6px 10px; border-radius: 10px;" />
            </a>
        </div>

        <!-- Role label -->
        <div style="padding: 1rem 1.5rem 0.5rem;">
            <span style="font-size: 10px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; color: rgba(147,197,253,0.7);">
                @if($role === 'client') Client Portal
                @elseif($role === 'accountant') Accountant Portal
                @else Admin Portal @endif
            </span>
        </div>

        <!-- Navigation Links -->
        <nav style="padding: 0.5rem 0.75rem; display: flex; flex-direction: column; gap: 2px;">
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

    <!-- Bottom: Support & User Info -->
    <div style="padding: 1rem; border-top: 1px solid rgba(255,255,255,0.08);">
        <div style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 14px; padding: 14px 16px;">
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 8px;">
                <div style="width: 32px; height: 32px; border-radius: 8px; background: linear-gradient(135deg, #063B8F 0%, #005DFF 100%); display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 12px; color: #FFFFFF; flex-shrink: 0;">Y</div>
                <div>
                    <h5 style="font-size: 12px; font-weight: 700; color: #FFFFFF; margin: 0;">YONBUS Support</h5>
                    <p style="font-size: 11px; color: rgba(147,197,253,0.8); margin: 0;">Online 24/7</p>
                </div>
            </div>
            <a href="mailto:support@yonbustax.ca" style="font-size: 12px; font-weight: 600; color: #93C5FD; text-decoration: none; display: inline-flex; align-items: center; gap: 4px;"
               onmouseenter="this.style.color='#FFFFFF'" onmouseleave="this.style.color='#93C5FD'">
                Contact Support →
            </a>
        </div>
    </div>
</aside>
