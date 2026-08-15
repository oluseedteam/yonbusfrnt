<div>
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 dark:text-white font-heading">Client Document Vault</h1>
            <p class="text-xs text-gray-500 mt-1">Review uploaded client tax records and send completed documents/reports to clients.</p>
        </div>
        <div class="flex items-center gap-3">
            <select wire:model.live="clientFilter" class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs">
                <option value="">All Clients</option>
                @foreach($clients as $c)
                    <option value="{{ $c->id }}">{{ $c->name }} ({{ $c->email }})</option>
                @endforeach
            </select>
            <button wire:click="openUploadModal" class="btn-primary flex items-center gap-2 text-xs">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                <span>Send Document to Client</span>
            </button>
        </div>
    </div>

    @if(session()->has('message'))
        <div class="mb-6 p-4 rounded-xl bg-[#005DFF] text-[#005DFF] dark:bg-[#005DFF]/50 dark:text-[#005DFF] text-xs font-semibold">
            {{ session('message') }}
        </div>
    @endif

    <div class="card-box">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-gray-50 dark:bg-gray-800 text-gray-500 uppercase font-semibold">
                    <tr>
                        <th class="p-3.5">Document Name</th>
                        <th class="p-3.5">Client Owner</th>
                        <th class="p-3.5">Uploaded By</th>
                        <th class="p-3.5">Size</th>
                        <th class="p-3.5">Uploaded Date</th>
                        <th class="p-3.5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse($documents as $doc)
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/40">
                            <td class="p-3.5 flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-blue-50 text-[#005DFF] flex items-center justify-center font-bold text-[10px]">
                                    {{ strtoupper(pathinfo($doc->original_name, PATHINFO_EXTENSION)) }}
                                </div>
                                <span class="font-bold text-gray-900 dark:text-white font-heading">{{ $doc->original_name }}</span>
                            </td>
                            <td class="p-3.5 font-medium text-gray-800 dark:text-gray-200">{{ $doc->client?->name ?? 'N/A' }}</td>
                            <td class="p-3.5 text-gray-500">
                                @if($doc->uploaded_by == $doc->client_id)
                                    <span class="text-gray-600">Client</span>
                                @else
                                    <span class="text-blue-600 font-semibold">{{ $doc->uploader?->name ?? 'Admin Staff' }}</span>
                                @endif
                            </td>
                            <td class="p-3.5 font-mono text-gray-500">{{ $doc->file_size_human }}</td>
                            <td class="p-3.5 text-gray-500">{{ $doc->created_at->format('M j, Y') }}</td>
                            <td class="p-3.5 text-right">
                                <a href="{{ route('documents.download', $doc) }}" class="text-[#005DFF] font-semibold hover:underline">Download File</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center py-8 text-gray-500">No client documents found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $documents->links() }}</div>
    </div>

    <!-- Upload Document Modal -->
    @if($showUploadModal)
        <div class="fixed inset-0 z-50 bg-gray-900/60 backdrop-blur-sm flex items-center justify-center p-4">
            <div class="bg-white dark:bg-gray-900 rounded-2xl max-w-md w-full p-6 shadow-2xl border border-gray-100 dark:border-gray-800">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white font-heading mb-4">Send Document to Client</h3>

                <form wire:submit.prevent="uploadDocument" class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Select Client</label>
                        <select wire:model="client_id" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs">
                            <option value="">-- Choose Client --</option>
                            @foreach($clients as $c)
                                <option value="{{ $c->id }}">{{ $c->name }} ({{ $c->email }})</option>
                            @endforeach
                        </select>
                        @error('client_id') <span class="text-red-500 text-[11px]">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Select File</label>
                        <input type="file" wire:model="file" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs">
                        @error('file') <span class="text-red-500 text-[11px]">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Category</label>
                        <select wire:model="type" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs">
                            <option value="tax_return">Tax Return Report / Completed Return</option>
                            <option value="invoice">Invoice / Receipt</option>
                            <option value="w2">W-2 Form</option>
                            <option value="1099">1099 Tax Form</option>
                            <option value="other">Other Document</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Notes / Description (Optional)</label>
                        <input type="text" wire:model="notes" placeholder="e.g. Completed 2023 Tax File" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs">
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-3 border-t border-gray-100 dark:border-gray-800">
                        <button type="button" wire:click="$set('showUploadModal', false)" class="btn-secondary text-xs">Cancel</button>
                        <button type="submit" class="btn-primary text-xs" wire:loading.attr="disabled">
                            <span wire:loading.remove>Upload & Send</span>
                            <span wire:loading>Sending...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
