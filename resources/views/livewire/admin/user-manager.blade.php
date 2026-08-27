<div class="p-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white font-heading">User &amp; Client Management</h1>
            <p class="text-slate-600 dark:text-slate-400 text-sm">Add and manage client accounts, accountants, and system administrators</p>
        </div>
        <div class="flex items-center gap-3 flex-wrap">
            <button wire:click="openModal('client')" class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#005DFF] hover:bg-blue-700 text-white font-bold rounded-xl text-sm shadow-md transition transform hover:-translate-y-0.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                <span>+ Add New Client</span>
            </button>
            <button wire:click="openModal('accountant')" class="inline-flex items-center gap-2 px-3.5 py-2.5 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 font-semibold rounded-xl text-sm border border-slate-200 dark:border-slate-700 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>+ Add Other Role</span>
            </button>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-emerald-900 dark:text-emerald-200 rounded-2xl text-sm shadow-sm flex items-start justify-between gap-3">
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 rounded-xl bg-emerald-600 text-white flex items-center justify-center font-bold flex-shrink-0 mt-0.5">✓</div>
                <div>
                    <h4 class="font-bold text-emerald-950 dark:text-emerald-100 text-sm">Success!</h4>
                    <p class="text-xs text-emerald-800 dark:text-emerald-300 mt-0.5">{{ session('message') }}</p>
                </div>
            </div>
            @if($lastCreatedCredentials)
                <div class="hidden sm:flex items-center gap-2 bg-white dark:bg-slate-900 px-3 py-1.5 rounded-xl border border-emerald-300 dark:border-emerald-700 text-xs font-mono">
                    <span class="text-slate-500">Email:</span> <strong>{{ $lastCreatedCredentials['email'] }}</strong>
                    <span class="text-slate-500 ml-2">Pass:</span> <strong>{{ $lastCreatedCredentials['password'] }}</strong>
                </div>
            @endif
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-6 p-4 bg-rose-50 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-800 text-rose-900 dark:text-rose-200 rounded-2xl text-sm shadow-sm flex items-start justify-between gap-3">
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 rounded-xl bg-rose-600 text-white flex items-center justify-center font-bold flex-shrink-0 mt-0.5">!</div>
                <div>
                    <h4 class="font-bold text-rose-950 dark:text-rose-100 text-sm">Notice</h4>
                    <p class="text-xs text-rose-800 dark:text-rose-300 mt-0.5">{{ session('error') }}</p>
                </div>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-rose-600 hover:text-rose-800 text-lg leading-none">&times;</button>
        </div>
    @endif

    <!-- Filters & Search -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl p-4 mb-6 shadow-sm border border-slate-200 dark:border-slate-700/50 space-y-4">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="flex-1 w-full">
                <div class="relative">
                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search users or clients by name, email, or phone..." class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-[#005DFF] outline-none">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </div>
            <div class="flex items-center gap-2 w-full md:w-auto overflow-x-auto pb-1 md:pb-0">
                @foreach([
                    'all' => 'All Roles',
                    'client' => 'Clients Only',
                    'accountant' => 'Accountants',
                    'admin' => 'Admins',
                ] as $key => $label)
                    <button type="button"
                            wire:click="$set('roleFilter', '{{ $key }}')"
                            class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition whitespace-nowrap {{ $roleFilter === $key ? 'bg-[#005DFF] text-white shadow-sm' : 'bg-slate-100 dark:bg-slate-900 text-slate-600 dark:text-slate-300 hover:bg-slate-200' }}">
                        {{ $label }}
                    </button>
                @endforeach
            </div>
        </div>

        {{-- Partner / Consultant Segregation Filter --}}
        <div class="flex items-center gap-2 pt-3 border-t border-slate-100 dark:border-slate-700/60 overflow-x-auto text-xs">
            <span class="font-bold text-slate-500 dark:text-slate-400 flex items-center gap-1.5 flex-shrink-0">
                <span>👤</span> Consultant View:
            </span>
            <button type="button" wire:click="$set('consultantFilter', 'all')"
                    class="px-3 py-1 rounded-lg font-bold transition {{ $consultantFilter === 'all' ? 'bg-slate-900 text-white dark:bg-white dark:text-slate-900 shadow-sm' : 'bg-slate-100 dark:bg-slate-900 text-slate-600 dark:text-slate-400 hover:bg-slate-200' }}">
                All Accounts
            </button>
            <button type="button" wire:click="$set('consultantFilter', 'olubukunola')"
                    class="px-3 py-1 rounded-lg font-bold transition flex items-center gap-1.5 {{ $consultantFilter === 'olubukunola' ? 'bg-blue-600 text-white shadow-sm' : 'bg-blue-50 dark:bg-blue-950/40 text-blue-700 dark:text-blue-300 hover:bg-blue-100' }}">
                <span>👩‍💼</span> Olubukunola's Managed Clients
            </button>
            <button type="button" wire:click="$set('consultantFilter', 'adeshola')"
                    class="px-3 py-1 rounded-lg font-bold transition flex items-center gap-1.5 {{ $consultantFilter === 'adeshola' ? 'bg-blue-600 text-white shadow-sm' : 'bg-blue-50 dark:bg-blue-950/40 text-blue-700 dark:text-blue-300 hover:bg-blue-100' }}">
                <span>👨‍💼</span> Adeshola's Managed Clients
            </button>
        </div>
    </div>

    <!-- Users Table -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-200 dark:border-slate-700 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider bg-slate-50/80 dark:bg-slate-900/50">
                        <th class="px-6 py-4">Account / Client</th>
                        <th class="px-6 py-4">Role</th>
                        <th class="px-6 py-4">Dedicated Consultant</th>
                        <th class="px-6 py-4">Company / Tax ID</th>
                        <th class="px-6 py-4">Status &amp; Verification</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700 text-sm text-slate-700 dark:text-slate-300">
                    @forelse ($users as $user)
                        <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-700/30 transition">
                            <td class="px-6 py-4 flex items-center gap-3">
                                <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-10 h-10 rounded-full object-cover border border-slate-200 dark:border-slate-700 flex-shrink-0">
                                <div>
                                    <div class="font-bold text-slate-900 dark:text-white flex items-center gap-1.5">
                                        <span>{{ $user->name }}</span>
                                        @if($user->isClient())
                                            <span class="text-[10px] font-mono px-1.5 py-0.5 rounded bg-blue-50 dark:bg-blue-950/60 text-[#005DFF] border border-blue-200 dark:border-blue-900/40">
                                                {{ $user->clientProfile?->client_number ?? 'Client' }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="text-xs text-slate-500 dark:text-slate-400">{{ $user->email }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @php $roleName = $user->getRoleNames()->first() ?? 'client'; @endphp
                                <span class="inline-flex px-3 py-1 text-xs font-bold rounded-full 
                                    {{ $roleName === 'admin' || $roleName === 'super-admin' ? 'bg-purple-100 text-purple-800 dark:bg-purple-950/40 dark:text-purple-300' : '' }}
                                    {{ $roleName === 'subadmin' ? 'bg-indigo-100 text-indigo-800 dark:bg-indigo-950/40 dark:text-indigo-300' : '' }}
                                    {{ $roleName === 'accountant' ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950/40 dark:text-emerald-300' : '' }}
                                    {{ $roleName === 'client' ? 'bg-blue-100 text-blue-800 dark:bg-blue-950/40 dark:text-blue-300' : '' }}">
                                    {{ ucfirst($roleName) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-xs">
                                @if($user->assignedAdmin)
                                    <div class="flex items-center gap-2">
                                        <img src="{{ $user->assignedAdmin->avatar_url }}" alt="{{ $user->assignedAdmin->name }}" class="w-6 h-6 rounded-full object-cover border border-blue-300">
                                        <div>
                                            <div class="font-bold text-slate-900 dark:text-white">{{ $user->assignedAdmin->name }}</div>
                                            <div class="text-[10px] text-blue-600 dark:text-blue-400">Dedicated Partner</div>
                                        </div>
                                    </div>
                                @elseif($user->isClient())
                                    <span class="text-slate-400 text-xs italic">Unassigned (General)</span>
                                @else
                                    <span class="text-slate-400">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-xs">
                                @if($user->company_name || $user->clientProfile?->company_name)
                                    <div class="font-semibold text-slate-800 dark:text-slate-200">{{ $user->company_name ?? $user->clientProfile?->company_name }}</div>
                                @endif
                                @if($user->tax_identification_number || $user->clientProfile?->tax_number)
                                    <div class="text-slate-500 font-mono">Tax ID: {{ $user->tax_identification_number ?? $user->clientProfile?->tax_number }}</div>
                                @endif
                                @if(!($user->company_name || $user->clientProfile?->company_name) && !($user->tax_identification_number || $user->clientProfile?->tax_number))
                                    <span class="text-slate-400">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col gap-1 items-start">
                                    <button wire:click="toggleStatus({{ $user->id }})" class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold transition {{ $user->is_active ? 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-400 hover:bg-emerald-100' : 'bg-rose-50 text-rose-700 dark:bg-rose-950/40 dark:text-rose-400 hover:bg-rose-100' }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $user->is_active ? 'bg-emerald-600' : 'bg-rose-600' }}"></span>
                                        {{ $user->is_active ? 'Active' : 'Inactive' }}
                                    </button>
                                    @if($user->email_verified_at)
                                        <span class="text-[10px] text-slate-500 flex items-center gap-1">
                                            <svg class="w-3 h-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                            Verified Login
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <button wire:click="edit({{ $user->id }})" class="px-3 py-1 bg-slate-100 dark:bg-slate-700 hover:bg-[#005DFF] hover:text-white text-slate-700 dark:text-slate-200 rounded-lg font-bold text-xs transition">
                                    Edit
                                </button>
                                @if($user->id !== auth()->id())
                                    <button wire:click="confirmDelete({{ $user->id }})" class="px-2.5 py-1 hover:bg-rose-50 dark:hover:bg-rose-950/40 text-rose-600 dark:text-rose-400 rounded-lg font-semibold text-xs transition">
                                        Delete
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">
                                <div class="w-12 h-12 rounded-2xl bg-blue-50 dark:bg-slate-700 flex items-center justify-center mx-auto text-2xl mb-3">👥</div>
                                <p class="text-base font-bold text-slate-900 dark:text-white mb-1">No accounts found</p>
                                <p class="text-xs max-w-sm mx-auto mb-4">No accounts match the selected consultant or role filter.</p>
                                <button wire:click="openModal('client')" class="px-4 py-2 bg-[#005DFF] text-white text-xs font-bold rounded-xl shadow">
                                    + Add New Client
                                </button>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($users->hasPages())
            <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-700">
                {{ $users->links() }}
            </div>
        @endif
    </div>

    <!-- User / Client Add & Edit Modal -->
    @if ($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm overflow-y-auto">
            <div class="bg-white dark:bg-slate-800 rounded-3xl max-w-xl w-full p-6 sm:p-8 shadow-2xl border border-slate-200 dark:border-slate-700 my-8">
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100 dark:border-slate-700">
                    <div>
                        <div class="inline-block text-[11px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-blue-50 dark:bg-blue-950/60 text-[#005DFF] border border-blue-200 dark:border-blue-900/40 mb-1">
                            {{ $role === 'client' ? 'Client Account Setup' : 'Staff / User Account' }}
                        </div>
                        <h3 class="text-xl font-extrabold text-slate-900 dark:text-white font-heading m-0">
                            {{ $editId ? 'Edit Account Details' : ($role === 'client' ? 'Add New Client' : 'Add New User') }}
                        </h3>
                    </div>
                    <button wire:click="$set('showModal', false)" class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-700 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 flex items-center justify-center transition cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <form wire:submit.prevent="save" class="space-y-4">
                    {{-- Role Selector & Assigned Consultant --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Account Role</label>
                            <select wire:model.live="role" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm font-semibold focus:ring-2 focus:ring-[#005DFF] outline-none">
                                <option value="client">Client (Tax &amp; Accounting Client Portal)</option>
                                <option value="accountant">Accountant / Professional Staff</option>
                                <option value="subadmin">Sub-Admin (Support Staff)</option>
                                <option value="admin">System Administrator</option>
                            </select>
                            @error('role') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Assigned Consultant / Partner</label>
                            <select wire:model="assigned_admin_id" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm font-semibold focus:ring-2 focus:ring-[#005DFF] outline-none">
                                @foreach($consultants as $c)
                                    <option value="{{ $c->id }}">
                                        {{ $c->name }} ({{ $c->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('assigned_admin_id') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    {{-- First & Last Name --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">First Name *</label>
                            <input type="text" wire:model="first_name" placeholder="John" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-[#005DFF] outline-none">
                            @error('first_name') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Last Name *</label>
                            <input type="text" wire:model="last_name" placeholder="Doe" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-[#005DFF] outline-none">
                            @error('last_name') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    {{-- Email & Phone --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Email Address * (Login ID)</label>
                            <input type="email" wire:model="email" placeholder="client@example.com" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-[#005DFF] outline-none">
                            @error('email') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Phone Number</label>
                            <input type="text" wire:model="phone" placeholder="+1 (438) 000-0000" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-[#005DFF] outline-none">
                            @error('phone') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    {{-- Client-Specific Fields --}}
                    @if($role === 'client')
                        <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-900/60 border border-slate-200 dark:border-slate-700 space-y-3">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-[#005DFF] flex items-center gap-1.5">
                                <span>🏢</span> Client Business &amp; Tax Information (Optional)
                            </h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-[11px] font-semibold text-slate-600 dark:text-slate-400 mb-1">Company / Business Name</label>
                                    <input type="text" wire:model="company_name" placeholder="Acme Consulting Inc." class="w-full px-3 py-2 rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-xs outline-none">
                                </div>
                                <div>
                                    <label class="block text-[11px] font-semibold text-slate-600 dark:text-slate-400 mb-1">Tax ID / Business Number</label>
                                    <input type="text" wire:model="tax_number" placeholder="123456789 RT0001" class="w-full px-3 py-2 rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-xs outline-none">
                                </div>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                <div class="sm:col-span-2">
                                    <label class="block text-[11px] font-semibold text-slate-600 dark:text-slate-400 mb-1">Street Address</label>
                                    <input type="text" wire:model="address" placeholder="123 Boulevard Saint-Joseph" class="w-full px-3 py-2 rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-xs outline-none">
                                </div>
                                <div>
                                    <label class="block text-[11px] font-semibold text-slate-600 dark:text-slate-400 mb-1">City / Province</label>
                                    <input type="text" wire:model="city" placeholder="Gatineau, QC" class="w-full px-3 py-2 rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-xs outline-none">
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Password Setup & Generator --}}
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300">
                                {{ $editId ? 'Reset Password (Optional)' : 'Login Password *' }}
                            </label>
                            <button type="button" wire:click="generatePassword" class="text-xs text-[#005DFF] hover:underline font-bold inline-flex items-center gap-1 cursor-pointer">
                                <span>⚡ Generate Secure Password</span>
                            </button>
                        </div>
                        <input type="text" wire:model="password" placeholder="{{ $editId ? 'Leave blank to keep existing password' : 'Enter or generate password...' }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm font-mono focus:ring-2 focus:ring-[#005DFF] outline-none">
                        @error('password') <span class="text-xs text-rose-500 block mt-1">{{ $message }}</span> @enderror
                        <p class="text-[11px] text-slate-500 mt-1">The client will log in at <code>/login</code> with their email and this password.</p>
                    </div>

                    {{-- Profile Photo --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Profile Photo (Optional)</label>
                        <input type="file" wire:model="avatar" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-blue-50 file:text-[#005DFF] hover:file:bg-blue-100 cursor-pointer">
                        @error('avatar') <span class="text-xs text-rose-500 block">{{ $message }}</span> @enderror
                    </div>

                    {{-- Actions --}}
                    <div class="flex justify-end gap-3 pt-5 border-t border-slate-100 dark:border-slate-700 mt-6">
                        <button type="button" wire:click="$set('showModal', false)" class="px-5 py-2.5 border border-slate-300 dark:border-slate-600 rounded-xl text-slate-700 dark:text-slate-300 text-xs font-bold hover:bg-slate-50 dark:hover:bg-slate-700 transition cursor-pointer">
                            Cancel
                        </button>
                        <button type="submit" class="px-6 py-2.5 bg-[#005DFF] hover:bg-blue-700 text-white font-bold rounded-xl text-xs shadow-md transition transform hover:-translate-y-0.5 cursor-pointer">
                            {{ $editId ? 'Update Account' : 'Create Account & Enable Login' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Custom Popout Delete Confirmation Modal -->
    @if ($showDeleteModal)
        @php
            $targetUser = $confirmingDeleteId ? \App\Models\User::find($confirmingDeleteId) : null;
        @endphp
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm animate-fade-in">
            <div class="bg-white dark:bg-slate-800 rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-200 dark:border-slate-700 text-center">
                <div class="w-12 h-12 rounded-full bg-rose-100 dark:bg-rose-500/20 text-rose-600 dark:text-rose-400 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-1">
                    Delete {{ $targetUser ? ucfirst($targetUser->getRoleNames()->first() ?? $targetUser->role ?? 'User') : 'User' }} Account?
                </h3>
                @if($targetUser)
                    <div class="my-3 p-3 bg-slate-50 dark:bg-slate-900/80 rounded-xl border border-slate-200 dark:border-slate-700 text-xs text-left flex items-center gap-3">
                        <img src="{{ $targetUser->avatar_url }}" alt="{{ $targetUser->name }}" class="w-9 h-9 rounded-full object-cover border border-slate-200">
                        <div class="overflow-hidden">
                            <div class="font-bold text-slate-900 dark:text-white truncate">{{ $targetUser->name }}</div>
                            <div class="text-slate-500 font-mono text-[11px] truncate">{{ $targetUser->email }}</div>
                        </div>
                        <span class="ml-auto px-2 py-0.5 rounded text-[10px] font-bold uppercase {{ in_array($targetUser->role, ['admin', 'superadmin', 'subadmin']) ? 'bg-purple-100 text-purple-800' : 'bg-slate-200 text-slate-700' }}">
                            {{ $targetUser->getRoleNames()->first() ?? $targetUser->role ?? 'User' }}
                        </span>
                    </div>
                @endif
                <p class="text-xs text-slate-500 dark:text-slate-400 mb-6">
                    Are you sure you want to permanently delete this account? This action cannot be undone and will remove all access immediately.
                </p>
                <div class="flex items-center justify-center gap-3">
                    <button wire:click="cancelDelete" class="px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-xl text-slate-700 dark:text-slate-300 text-xs font-semibold hover:bg-slate-50 dark:hover:bg-slate-700 transition cursor-pointer">Cancel</button>
                    <button wire:click="deleteConfirmed" class="px-5 py-2 bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold rounded-xl shadow-md shadow-rose-600/20 transition cursor-pointer">Yes, Permanently Delete</button>
                </div>
            </div>
        </div>
    @endif
</div>

