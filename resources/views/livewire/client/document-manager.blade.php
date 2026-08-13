<div>
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 dark:text-white font-heading">Document Vault</h1>
            <p class="text-xs text-gray-500 mt-1">Upload your tax records and download documents sent to you by the YONBUS team.</p>
        </div>
    </div>

    <!-- Documents Received from Admin / YONBUS Team -->
    @if(isset($adminDocuments) && count($adminDocuments) > 0)
        <div class="card-box mb-8 border-2 border-blue-500/30 bg-blue-50/30 dark:bg-blue-950/20">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-xl bg-[#005DFF] text-white flex items-center justify-center font-bold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-gray-900 dark:text-white font-heading">Documents Sent to You by Admin</h3>
                        <p class="text-[11px] text-gray-500">Official tax documents, reports, and files shared with you by YONBUS staff.</p>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-blue-100/60 dark:bg-blue-900/40 text-blue-900 dark:text-blue-100 uppercase font-semibold">
                        <tr>
                            <th class="p-3">Document Name</th>
                            <th class="p-3">Sent By</th>
                            <th class="p-3">Size</th>
                            <th class="p-3">Date Sent</th>
                            <th class="p-3 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-blue-100 dark:divide-blue-900/40">
                        @foreach($adminDocuments as $doc)
                            <tr class="hover:bg-blue-100/40 dark:hover:bg-blue-900/20">
                                <td class="p-3 flex items-center gap-3">
                                    <div class="w-7 h-7 rounded-lg bg-[#005DFF] text-white flex items-center justify-center font-bold text-[10px]">
                                        {{ strtoupper(pathinfo($doc->original_name, PATHINFO_EXTENSION)) }}
                                    </div>
                                    <span class="font-bold text-gray-900 dark:text-white font-heading">{{ $doc->original_name }}</span>
                                </td>
                                <td class="p-3 font-medium text-blue-700 dark:text-blue-300">
                                    {{ $doc->uploader?->name ?? 'YONBUS Admin' }}
                                </td>
                                <td class="p-3 font-mono text-gray-500">{{ $doc->file_size_human }}</td>
                                <td class="p-3 text-gray-500">{{ $doc->created_at->format('M j, Y') }}</td>
                                <td class="p-3 text-right">
                                    <a href="{{ route('documents.download', $doc) }}" 
                                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold text-white bg-[#005DFF] hover:bg-blue-700 shadow-sm transition-all">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                        <span>Download File</span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <!-- Upload Card & Drag-Drop UI -->
    <div class="card-box mb-8">
        <h3 class="text-sm font-bold text-gray-900 dark:text-white font-heading mb-4">Upload New Document</h3>
        <form wire:submit.prevent="upload" class="space-y-4">
            <div class="border-2 border-dashed border-gray-200 dark:border-gray-700/80 rounded-2xl p-6 text-center hover:border-[#005DFF] transition-colors relative bg-gray-50/50 dark:bg-gray-800/20">
                <input type="file" wire:model="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                <div class="w-12 h-12 mx-auto rounded-2xl bg-blue-50 dark:bg-blue-950/50 text-[#005DFF] flex items-center justify-center mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                </div>
                <p class="text-xs font-semibold text-gray-800 dark:text-gray-200 font-heading">
                    Click to upload or drag and drop file here
                </p>
                <p class="text-[11px] text-gray-400 mt-1">PDF, PNG, JPG, DOCX, XLSX (max 20MB)</p>
                @if($file)
                    <div class="mt-3 inline-flex items-center gap-2 px-3 py-1 bg-blue-50 dark:bg-blue-950 text-[#005DFF] text-xs font-medium rounded-lg">
                        <span>Selected: {{ $file->getClientOriginalName() }}</span>
                    </div>
                @endif
            </div>
            @error('file') <span class="text-red-500 text-[11px] block">{{ $message }}</span> @enderror

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Document Category</label>
                    <select wire:model="type" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs">
                        <option value="w2">W-2 Form</option>
                        <option value="1099">1099 Tax Form</option>
                        <option value="receipt">Business Receipt / Expense</option>
                        <option value="bank_statement">Bank Statement</option>
                        <option value="tax_return">Prior Tax Return</option>
                        <option value="other">Other Supporting Document</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Notes (Optional)</label>
                    <input type="text" wire:model="notes" placeholder="e.g. Q1 Expenses Receipt" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs">
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="btn-primary text-xs" wire:loading.attr="disabled">
                    <span wire:loading.remove>Upload Document</span>
                    <span wire:loading>Uploading...</span>
                </button>
            </div>
        </form>
    </div>

    <!-- Documents List -->
    <div class="card-box">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-bold text-gray-900 dark:text-white font-heading">Your Uploaded Files</h3>
            <input type="text" wire:model.live="search" placeholder="Search files..." class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-1.5 px-3 text-xs w-48">
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-gray-50 dark:bg-gray-800 text-gray-500 uppercase font-semibold">
                    <tr>
                        <th class="p-3.5">Name</th>
                        <th class="p-3.5">Type</th>
                        <th class="p-3.5">Size</th>
                        <th class="p-3.5">Uploaded</th>
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
                                <div>
                                    <p class="font-bold text-gray-900 dark:text-white font-heading">{{ $doc->original_name }}</p>
                                    @if($doc->uploaded_by != auth()->id())
                                        <span class="text-[10px] bg-blue-100 text-blue-700 font-semibold px-2 py-0.5 rounded-full">Sent by Admin</span>
                                    @endif
                                </div>
                            </td>
                            <td class="p-3.5 uppercase font-semibold text-[10px] text-gray-500">{{ str_replace('_', ' ', $doc->file_type ?? 'document') }}</td>
                            <td class="p-3.5 text-gray-500 font-mono">{{ $doc->file_size_human }}</td>
                            <td class="p-3.5 text-gray-500">{{ $doc->created_at->format('M j, Y') }}</td>
                            <td class="p-3.5 text-right space-x-3">
                                <a href="{{ route('documents.download', $doc) }}" class="text-[#005DFF] hover:underline font-semibold">Download</a>
                                @if($doc->uploaded_by == auth()->id())
                                    <button wire:click="delete({{ $doc->id }})" wire:confirm="Delete file?" class="text-red-500 hover:underline font-semibold">Delete</button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center py-8 text-gray-500">No documents found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $documents->links() }}</div>
    </div>
</div>
