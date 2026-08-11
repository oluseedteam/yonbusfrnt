<div>
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 dark:text-white font-heading">Services & Pricing</h1>
            <p class="text-xs text-gray-500 mt-1">Configure tax preparation, accounting, and consulting offerings.</p>
        </div>
        <button wire:click="$set('showModal', true)" class="btn-primary">+ Add New Service</button>
    </div>

    <div class="card-box">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-gray-50 dark:bg-gray-800 text-gray-500 uppercase font-semibold">
                    <tr>
                        <th class="p-3.5">Service Name</th>
                        <th class="p-3.5">Description</th>
                        <th class="p-3.5">Duration</th>
                        <th class="p-3.5">Price</th>
                        <th class="p-3.5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse($services as $s)
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/40">
                            <td class="p-3.5 font-bold text-gray-900 dark:text-white font-heading">{{ $s->name }}</td>
                            <td class="p-3.5 text-gray-500 max-w-sm truncate">{{ $s->description }}</td>
                            <td class="p-3.5 text-gray-600 dark:text-gray-400">{{ $s->duration }} mins</td>
                            <td class="p-3.5 font-extrabold text-[#005DFF] font-heading">${{ number_format($s->price, 2) }}</td>
                            <td class="p-3.5 text-right space-x-2">
                                <button wire:click="edit({{ $s->id }})" class="text-[#005DFF] font-semibold hover:underline">Edit</button>
                                <button wire:click="confirmDelete({{ $s->id }})" class="text-red-500 font-semibold hover:underline">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center py-8 text-gray-500">No services configured.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $services->links() }}</div>
    </div>

    <!-- Modal -->
    @if($showModal)
        <div class="fixed inset-0 z-50 bg-gray-900/60 backdrop-blur-sm flex items-center justify-center p-4">
            <div class="bg-white dark:bg-gray-900 rounded-2xl max-w-md w-full p-6 shadow-2xl border border-gray-100 dark:border-gray-800">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white font-heading mb-4">{{ $editId ? 'Edit Service' : 'Add New Service' }}</h3>
                <form wire:submit.prevent="save" class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Service Name</label>
                        <input type="text" wire:model="name" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs">
                        @error('name') <span class="text-red-500 text-[11px]">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Description</label>
                        <textarea wire:model="description" rows="3" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs"></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Duration (minutes)</label>
                            <input type="number" wire:model="duration" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Price ($)</label>
                            <input type="number" step="0.01" wire:model="price" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs">
                        </div>
                    </div>
                    <div class="flex items-center justify-end gap-3 pt-3 border-t border-gray-100 dark:border-gray-800">
                        <button type="button" wire:click="$set('showModal', false)" class="btn-secondary text-xs">Cancel</button>
                        <button type="submit" class="btn-primary text-xs">Save Service</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Custom Popout Delete Confirmation Modal -->
    @if ($showDeleteModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm animate-fade-in">
            <div class="bg-white dark:bg-gray-900 rounded-2xl max-w-md w-full p-6 shadow-2xl border border-gray-100 dark:border-gray-800 text-center">
                <div class="w-12 h-12 rounded-full bg-red-100 dark:bg-red-500/20 text-red-600 dark:text-red-400 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white font-heading mb-2">Delete Service?</h3>
                <p class="text-xs text-gray-500 mb-6">Are you sure you want to delete this service? It will no longer be available for appointment booking.</p>
                <div class="flex items-center justify-center gap-3">
                    <button wire:click="cancelDelete" class="btn-secondary text-xs">Cancel</button>
                    <button wire:click="deleteConfirmed" class="px-5 py-2 bg-red-600 hover:bg-red-700 text-white text-xs font-bold rounded-xl shadow-md transition">Yes, Delete Service</button>
                </div>
            </div>
        </div>
    @endif
</div>
