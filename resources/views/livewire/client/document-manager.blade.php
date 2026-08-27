<div>
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 dark:text-white font-heading">Document Vault</h1>
            <p class="text-xs text-gray-500 mt-1">Upload your tax records directly to your assigned advisor, and view official files sent by YONBUS.</p>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-200 rounded-2xl text-sm font-semibold shadow-sm flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span>{{ session('message') }}</span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-800 text-lg leading-none">&times;</button>
        </div>
    @endif

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
                        <p class="text-[11px] text-gray-500">Official tax documents, completed returns, and files shared with you by YONBUS staff.</p>
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
                                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold text-white bg-[#005DFF] hover:bg-blue-700 shadow-sm transition-all">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                        <span>Download</span>
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
        <h3 class="text-sm font-bold text-gray-900 dark:text-white font-heading mb-4">Upload New Document or Image</h3>
        <form wire:submit.prevent="upload" class="space-y-4">
            <div class="border-2 border-dashed border-gray-200 dark:border-gray-700/80 rounded-2xl p-6 text-center hover:border-[#005DFF] transition-colors relative bg-gray-50/50 dark:bg-gray-800/20 group">
                <input type="file" wire:model="file" accept=".pdf,.png,.jpg,.jpeg,.webp,.gif,.heic,.heif,.docx,.doc,.xlsx,.xls,.csv,.txt,image/*,application/pdf" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                
                <div class="w-12 h-12 mx-auto rounded-2xl bg-blue-50 dark:bg-blue-950/50 text-[#005DFF] flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                </div>
                
                <p class="text-xs font-semibold text-gray-800 dark:text-gray-200 font-heading">
                    Click to upload or drag and drop files &amp; photos here
                </p>
                <p class="text-[11px] text-gray-400 mt-1">PDF, PNG, JPG, JPEG, WEBP, DOCX, XLSX (max 20MB)</p>
                
                {{-- Livewire Upload Loading Progress --}}
                <div wire:loading wire:target="file" class="mt-3 text-xs text-[#005DFF] font-semibold flex items-center justify-center gap-2 animate-pulse">
                    <svg class="animate-spin h-4 w-4 text-[#005DFF]" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                    <span>Uploading file... please wait</span>
                </div>

                {{-- Selected File & Image Preview --}}
                @if($file)
                    <div wire:loading.remove wire:target="file" class="mt-4 p-3 bg-white dark:bg-gray-800 rounded-xl border border-blue-200 dark:border-blue-800/80 shadow-sm inline-flex items-center gap-3 text-left relative z-20 max-w-full">
                        @php
                            $isImg = false;
                            try {
                                $isImg = str_starts_with($file->getMimeType(), 'image/');
                            } catch (\Throwable $e) {}
                        @endphp

                        @if($isImg)
                            <img src="{{ $file->temporaryUrl() }}" alt="Preview" class="w-12 h-12 object-cover rounded-lg border border-blue-200 dark:border-blue-900 flex-shrink-0 shadow-sm">
                        @else
                            <div class="w-12 h-12 rounded-lg bg-blue-50 dark:bg-blue-950/60 text-[#005DFF] flex items-center justify-center font-bold text-xs flex-shrink-0 border border-blue-100 dark:border-blue-900">
                                {{ strtoupper($file->getClientOriginalExtension() ?: 'FILE') }}
                            </div>
                        @endif

                        <div class="overflow-hidden">
                            <p class="font-bold text-xs text-gray-900 dark:text-white truncate max-w-xs font-heading">{{ $file->getClientOriginalName() }}</p>
                            <p class="text-[10px] text-gray-500 font-mono">{{ round($file->getSize() / 1024, 1) }} KB &bull; Ready to submit</p>
                        </div>

                        <button type="button" wire:click.prevent="removeSelectedFile" class="ml-2 text-rose-500 hover:text-rose-700 text-xs font-bold px-2 py-1 rounded-lg hover:bg-rose-50 dark:hover:bg-rose-950/40 transition">
                            Remove
                        </button>
                    </div>
                @endif
            </div>
            @error('file') <span class="text-red-500 text-[11px] block font-medium">{{ $message }}</span> @enderror

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                {{-- Document Category --}}
                <div>
                    <label class="block text-xs font-bold uppercase text-gray-700 dark:text-gray-300 mb-1">Document Category *</label>
                    <select wire:model="type" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs focus:ring-2 focus:ring-blue-500 outline-none">
                        <option value="t4_t5">T4 / T5 / T3 Canadian Tax Slips</option>
                        <option value="cra_notice">CRA Notice of Assessment / Reassessment</option>
                        <option value="receipt">Business Receipts &amp; Expenses (T2125)</option>
                        <option value="bank_statement">Bank &amp; Credit Card Statements</option>
                        <option value="corporate_docs">Corporate Financials (T2 / GST/HST)</option>
                        <option value="tax_return">Prior Year Tax Return</option>
                        <option value="other">Other Supporting Document</option>
                    </select>
                </div>

                {{-- Select Admin / Advisor recipient --}}
                <div>
                    <label class="block text-xs font-bold uppercase text-gray-700 dark:text-gray-300 mb-1">Submit To Advisor / Admin *</label>
                    <select wire:model="assigned_admin_id" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs focus:ring-2 focus:ring-blue-500 outline-none font-medium">
                        <option value="">-- General YONBUS Admin Pool --</option>
                        @foreach($advisors as $advisor)
                            <option value="{{ $advisor->id }}">{{ $advisor->name }} ({{ ucfirst($advisor->role) }})</option>
                        @endforeach
                    </select>
                    <p class="text-[10px] text-gray-400 mt-1">Directly delivers to this advisor's dashboard</p>
                </div>

                {{-- Notes --}}
                <div>
                    <label class="block text-xs font-bold uppercase text-gray-700 dark:text-gray-300 mb-1">Notes / Description (Optional)</label>
                    <input type="text" wire:model="notes" placeholder="e.g. 2025 medical &amp; tuition expenses, receipt photo" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
            </div>

            <div class="flex justify-end pt-2">
                <button type="submit" class="btn-primary text-xs flex items-center gap-1.5 cursor-pointer shadow-md shadow-blue-500/20" wire:loading.attr="disabled">
                    <svg wire:loading.remove wire:target="upload" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                    <span wire:loading.remove wire:target="upload">Upload &amp; Submit Document</span>
                    <span wire:loading wire:target="upload">Uploading &amp; Submitting...</span>
                </button>
            </div>
        </form>
    </div>

    <!-- Documents List -->
    <div class="card-box">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4">
            <div>
                <h3 class="text-sm font-bold text-gray-900 dark:text-white font-heading">Your Uploaded Files</h3>
                <p class="text-[11px] text-gray-500">History of all documents and images submitted to YONBUS</p>
            </div>
            
            {{-- Search Bar --}}
            <div class="relative w-full sm:w-64">
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search by file name or note..." class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 pl-8 pr-3 text-xs focus:ring-2 focus:ring-blue-500 outline-none">
                <svg class="w-3.5 h-3.5 text-gray-400 absolute left-2.5 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-gray-50 dark:bg-gray-800 text-gray-500 uppercase font-semibold">
                    <tr>
                        <th class="p-3.5">Document / Image</th>
                        <th class="p-3.5">Category</th>
                        <th class="p-3.5">Delivered To</th>
                        <th class="p-3.5">Size</th>
                        <th class="p-3.5">Uploaded</th>
                        <th class="p-3.5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse($documents as $doc)
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/40 transition-colors">
                            <td class="p-3.5 flex items-center gap-3">
                                @if($doc->is_image && $doc->file_url)
                                    <img src="{{ $doc->file_url }}" alt="{{ $doc->original_name }}" class="w-9 h-9 object-cover rounded-lg border border-blue-200 dark:border-blue-900 shadow-sm flex-shrink-0">
                                @else
                                    <div class="w-9 h-9 rounded-lg bg-blue-50 dark:bg-blue-950 text-[#005DFF] flex items-center justify-center font-bold text-[10px] flex-shrink-0 border border-blue-100 dark:border-blue-900">
                                        {{ strtoupper($doc->file_extension ?: 'DOC') }}
                                    </div>
                                @endif
                                <div>
                                    <p class="font-bold text-gray-900 dark:text-white font-heading">{{ $doc->original_name }}</p>
                                    @if($doc->notes)
                                        <p class="text-[11px] text-gray-500 italic mt-0.5">{{ $doc->notes }}</p>
                                    @endif
                                </div>
                            </td>
                            <td class="p-3.5">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 uppercase">
                                    {{ str_replace('_', ' ', $doc->type ?? $doc->file_type ?? 'Document') }}
                                </span>
                            </td>
                            <td class="p-3.5">
                                @if($doc->assignedAdmin)
                                    <span class="inline-flex items-center gap-1 font-semibold text-blue-600 dark:text-blue-400">
                                        <span>👤</span> {{ $doc->assignedAdmin->name }}
                                    </span>
                                @else
                                    <span class="text-gray-400 text-xs">YONBUS Team</span>
                                @endif
                            </td>
                            <td class="p-3.5 text-gray-500 font-mono">{{ $doc->file_size_human }}</td>
                            <td class="p-3.5 text-gray-500">{{ $doc->created_at->format('M j, Y g:i A') }}</td>
                            <td class="p-3.5 text-right space-x-3 whitespace-nowrap">
                                <a href="{{ route('documents.download', $doc) }}" class="inline-flex items-center gap-1 text-[#005DFF] hover:underline font-bold">
                                    <span>📥</span> Download
                                </a>
                                <button wire:click="delete({{ $doc->id }})" wire:confirm="Are you sure you want to delete this document?" class="text-rose-600 hover:underline font-medium cursor-pointer">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-gray-400">
                                <div class="w-12 h-12 mx-auto rounded-full bg-gray-100 dark:bg-gray-800 text-gray-400 flex items-center justify-center mb-2">
                                    📁
                                </div>
                                <p class="font-semibold text-gray-700 dark:text-gray-300">No documents or images found</p>
                                <p class="text-[11px] mt-1">Upload your tax slips, receipts, photos, or financial statements using the form above.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($documents->hasPages())
            <div class="pt-4 border-t border-gray-100 dark:border-gray-800">
                {{ $documents->links() }}
            </div>
        @endif
    </div>
</div>
