<div class="p-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">User Management</h1>
            <p class="text-slate-600 dark:text-slate-400 text-sm">Manage system administrators, accountants, subadmins, and client accounts</p>
        </div>
        <button wire:click="openModal" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add New User
        </button>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 rounded-lg text-sm">
            {{ session('message') }}
        </div>
    @endif

    <!-- Filters & Search -->
    <div class="bg-white dark:bg-slate-800 rounded-xl p-4 mb-6 shadow-sm border border-slate-200 dark:border-slate-700/50 flex flex-col md:flex-row gap-4">
        <div class="flex-1">
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search by name or email..." class="w-full px-4 py-2 rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 outline-none">
        </div>
        <div class="w-full md:w-48">
            <select wire:model.live="roleFilter" class="w-full px-4 py-2 rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                <option value="all">All Roles</option>
                <option value="admin">Admin</option>
                <option value="subadmin">Subadmin</option>
                <option value="accountant">Accountant</option>
                <option value="client">Client</option>
            </select>
        </div>
    </div>

    <!-- Users Table -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-200 dark:border-slate-700 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider bg-slate-50 dark:bg-slate-900/50">
                        <th class="px-6 py-4">User</th>
                        <th class="px-6 py-4">Role</th>
                        <th class="px-6 py-4">Phone</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Created</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700 text-sm text-slate-700 dark:text-slate-300">
                    @forelse ($users as $user)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition">
                            <td class="px-6 py-4 flex items-center gap-3">
                                <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-9 h-9 rounded-full object-cover border border-slate-200 dark:border-slate-700">
                                <div>
                                    <div class="font-medium text-slate-900 dark:text-white">{{ $user->name }}</div>
                                    <div class="text-xs text-slate-500 dark:text-slate-400">{{ $user->email }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @php $roleName = $user->getRoleNames()->first() ?? 'client'; @endphp
                                <span class="inline-flex px-2.5 py-1 text-xs font-semibold rounded-full 
                                    {{ $roleName === 'admin' || $roleName === 'super-admin' ? 'bg-purple-500/10 text-purple-600 dark:text-purple-400' : '' }}
                                    {{ $roleName === 'subadmin' ? 'bg-indigo-500/10 text-indigo-600 dark:text-indigo-400' : '' }}
                                    {{ $roleName === 'accountant' ? 'bg-blue-500/10 text-blue-600 dark:text-blue-400' : '' }}
                                    {{ $roleName === 'client' ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400' : '' }}">
                                    {{ ucfirst($roleName) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-slate-500 dark:text-slate-400">{{ $user->phone ?? '—' }}</td>
                            <td class="px-6 py-4">
                                <button wire:click="toggleStatus({{ $user->id }})" class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium transition {{ $user->is_active ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 hover:bg-emerald-500/20' : 'bg-rose-500/10 text-rose-600 dark:text-rose-400 hover:bg-rose-500/20' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $user->is_active ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                                    {{ $user->is_active ? 'Active' : 'Inactive' }}
                                </button>
                            </td>
                            <td class="px-6 py-4 text-slate-500 dark:text-slate-400 text-xs">{{ $user->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <button wire:click="edit({{ $user->id }})" class="text-blue-600 dark:text-blue-400 hover:underline font-medium text-xs">Edit</button>
                                @if($user->id !== auth()->id())
                                    <button wire:click="confirmDelete({{ $user->id }})" class="text-rose-600 dark:text-rose-400 hover:underline font-medium text-xs">Delete</button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">
                                <svg class="w-12 h-12 mx-auto text-slate-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                <p class="text-base font-semibold text-slate-900 dark:text-white mb-1">No users found</p>
                                <p class="text-xs">No records exist matching your filter criteria.</p>
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

    <!-- User Add/Edit Modal -->
    @if ($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
            <div class="bg-white dark:bg-slate-800 rounded-2xl max-w-lg w-full p-6 shadow-xl border border-slate-200 dark:border-slate-700">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">{{ $editId ? 'Edit User' : 'Add New User' }}</h3>
                    <button wire:click="$set('showModal', false)" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <form wire:submit.prevent="save" class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">First Name</label>
                            <input type="text" wire:model="first_name" class="w-full px-3 py-2 rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                            @error('first_name') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Last Name</label>
                            <input type="text" wire:model="last_name" class="w-full px-3 py-2 rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                            @error('last_name') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Email Address</label>
                        <input type="email" wire:model="email" class="w-full px-3 py-2 rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                        @error('email') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">User Role</label>
                            <select wire:model="role" class="w-full px-3 py-2 rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                                <option value="client">Client</option>
                                <option value="accountant">Accountant</option>
                                <option value="subadmin">Subadmin</option>
                                <option value="admin">Admin</option>
                            </select>
                            @error('role') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Phone Number</label>
                            <input type="text" wire:model="phone" class="w-full px-3 py-2 rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                            @error('phone') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    @if (!$editId)
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Password</label>
                            <input type="password" wire:model="password" class="w-full px-3 py-2 rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                            @error('password') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                        </div>
                    @endif
                    <div class="flex justify-end gap-3 pt-4 border-t border-slate-200 dark:border-slate-700">
                        <button type="button" wire:click="$set('showModal', false)" class="px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg text-slate-700 dark:text-slate-300 text-sm font-medium hover:bg-slate-50 dark:hover:bg-slate-700 transition">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition">Save User</button>
                    </div>
                </form>
            </div>
        </div>
    <!-- Custom Popout Delete Confirmation Modal -->
    @if ($showDeleteModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm animate-fade-in">
            <div class="bg-white dark:bg-slate-800 rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-200 dark:border-slate-700 text-center">
                <div class="w-12 h-12 rounded-full bg-rose-100 dark:bg-rose-500/20 text-rose-600 dark:text-rose-400 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Delete User Account?</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mb-6">Are you sure you want to permanently delete this user? This action cannot be undone and will remove all access.</p>
                <div class="flex items-center justify-center gap-3">
                    <button wire:click="cancelDelete" class="px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-xl text-slate-700 dark:text-slate-300 text-xs font-semibold hover:bg-slate-50 dark:hover:bg-slate-700 transition">Cancel</button>
                    <button wire:click="deleteConfirmed" class="px-5 py-2 bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold rounded-xl shadow-md shadow-rose-600/20 transition">Yes, Delete User</button>
                </div>
            </div>
        </div>
    @endif
</div>
