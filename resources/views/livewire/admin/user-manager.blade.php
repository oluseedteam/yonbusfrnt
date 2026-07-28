<div>
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 dark:text-white font-heading">User Management</h1>
            <p class="text-xs text-gray-500 mt-1">Manage all platform accounts, assign roles, and control access permissions.</p>
        </div>
        <button wire:click="openModal" class="btn-primary">
            + Add New User
        </button>
    </div>

    <!-- Filters -->
    <div class="card-box p-4 mb-6 flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-2">
            <span class="text-xs font-semibold text-gray-500 uppercase font-heading">Role:</span>
            @foreach(['all' => 'All', 'client' => 'Clients', 'accountant' => 'Accountants', 'admin' => 'Admins'] as $key => $label)
                <button wire:click="$set('roleFilter', '{{ $key }}')" 
                        class="px-3 py-1.5 rounded-xl text-xs font-medium transition-all {{ $roleFilter === $key ? 'bg-[#005DFF] text-white shadow-sm' : 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300' }}">
                    {{ $label }}
                </button>
            @endforeach
        </div>
        <input type="text" wire:model.live="search" placeholder="Search by name or email..." class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-1.5 px-3 text-xs w-full sm:w-64">
    </div>

    <!-- Users Table -->
    <div class="card-box">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-gray-50 dark:bg-gray-800 text-gray-500 uppercase font-semibold">
                    <tr>
                        <th class="p-3.5">User</th>
                        <th class="p-3.5">Role</th>
                        <th class="p-3.5">Phone / Company</th>
                        <th class="p-3.5">Status</th>
                        <th class="p-3.5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse($users as $u)
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/40">
                            <td class="p-3.5 flex items-center gap-3">
                                <img src="{{ $u->avatar_url }}" class="w-9 h-9 rounded-xl object-cover">
                                <div>
                                    <p class="font-bold text-gray-900 dark:text-white font-heading">{{ $u->name }}</p>
                                    <p class="text-[11px] text-gray-500">{{ $u->email }}</p>
                                </div>
                            </td>
                            <td class="p-3.5">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider 
                                    {{ $u->role === 'admin' ? 'bg-purple-100 text-purple-700' : ($u->role === 'accountant' ? 'bg-blue-100 text-[#005DFF]' : 'bg-emerald-100 text-emerald-700') }}">
                                    {{ $u->role }}
                                </span>
                            </td>
                            <td class="p-3.5 text-gray-600 dark:text-gray-400">
                                {{ $u->phone ?? 'N/A' }} @if($u->company_name) • {{ $u->company_name }} @endif
                            </td>
                            <td class="p-3.5">
                                <button wire:click="toggleStatus({{ $u->id }})" class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $u->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $u->is_active ? 'Active' : 'Inactive' }}
                                </button>
                            </td>
                            <td class="p-3.5 text-right space-x-2">
                                <button wire:click="edit({{ $u->id }})" class="text-[#005DFF] font-semibold hover:underline">Edit</button>
                                <button wire:click="delete({{ $u->id }})" wire:confirm="Delete user account?" class="text-red-500 font-semibold hover:underline">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center py-8 text-gray-500">No users found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $users->links() }}</div>
    </div>

    <!-- Create/Edit Modal -->
    @if($showModal)
        <div class="fixed inset-0 z-50 bg-gray-900/60 backdrop-blur-sm flex items-center justify-center p-4">
            <div class="bg-white dark:bg-gray-900 rounded-2xl max-w-md w-full p-6 shadow-2xl border border-gray-100 dark:border-gray-800">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white font-heading mb-4">{{ $editId ? 'Edit User' : 'Add New Platform User' }}</h3>
                <form wire:submit.prevent="save" class="space-y-4">
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

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">User Role</label>
                            <select wire:model="role" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs">
                                <option value="client">Client</option>
                                <option value="accountant">Accountant / CPA</option>
                                <option value="admin">Administrator</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Phone</label>
                            <input type="text" wire:model="phone" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs">
                        </div>
                    </div>

                    @if(!$editId)
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Password</label>
                            <input type="password" wire:model="password" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs">
                            @error('password') <span class="text-red-500 text-[11px]">{{ $message }}</span> @enderror
                        </div>
                    @endif

                    <div class="flex items-center justify-end gap-3 pt-3 border-t border-gray-100 dark:border-gray-800">
                        <button type="button" wire:click="$set('showModal', false)" class="btn-secondary text-xs">Cancel</button>
                        <button type="submit" class="btn-primary text-xs">Save User</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
