<div
    x-data="{
        toast: { show: false, message: '', type: 'success' },
        showToast(event) {
            this.toast.message = event.detail[0]?.message ?? event.detail?.message ?? '';
            this.toast.type    = event.detail[0]?.type    ?? event.detail?.type    ?? 'success';
            this.toast.show    = true;
            clearTimeout(this._toastTimer);
            this._toastTimer   = setTimeout(() => { this.toast.show = false; }, 4500);
        }
    }"
    x-on:notify.window="showToast($event)"
>
    {{-- ── Toast Notification ─────────────────────────────────────── --}}
    <div
        x-show="toast.show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-[-16px]"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-[-16px]"
        class="fixed top-5 right-5 z-[9999] max-w-sm w-full"
        style="display:none"
    >
        <div class="flex items-start gap-3 p-4 rounded-2xl shadow-2xl bg-emerald-600 text-white text-sm font-semibold border border-emerald-500">
            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
            <span x-text="toast.message" class="flex-1 leading-snug"></span>
            <button @click="toast.show = false" class="text-emerald-100 hover:text-white ml-1 flex-shrink-0">&times;</button>
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

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 dark:text-white font-heading">Document Vault</h1>
            <p class="text-xs text-gray-500 mt-1">Upload your tax records directly to your assigned advisor, and view/download official files shared by YONBUS.</p>
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
                            <th class="p-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-blue-100 dark:divide-blue-900/40">
                        @foreach($adminDocuments as $doc)
                            <tr class="hover:bg-blue-100/40 dark:hover:bg-blue-900/20">
                                <td class="p-3 flex items-center gap-3">
                                    @if($doc->is_image && $doc->file_url)
                                        <img src="{{ $doc->file_url }}" alt="{{ $doc->original_name }}" wire:click="previewDocument({{ $doc->id }})" class="w-8 h-8 rounded-lg object-cover border border-blue-200 cursor-pointer hover:scale-105 transition flex-shrink-0">
                                    @else
                                        <div wire:click="previewDocument({{ $doc->id }})" class="w-8 h-8 rounded-lg bg-[#005DFF] text-white flex items-center justify-center font-bold text-[10px] cursor-pointer flex-shrink-0">
                                            {{ strtoupper(pathinfo($doc->original_name, PATHINFO_EXTENSION)) }}
                                        </div>
                                    @endif
                                    <div>
                                        <button type="button" wire:click="previewDocument({{ $doc->id }})" class="font-bold text-gray-900 dark:text-white font-heading hover:text-[#005DFF] text-left transition">
                                            {{ $doc->original_name }}
                                        </button>
                                        @if($doc->notes)
                                            <p class="text-[10px] text-gray-500 italic mt-0.5">{{ $doc->notes }}</p>
                                        @endif
                                    </div>
                                </td>
                                <td class="p-3 font-medium text-blue-700 dark:text-blue-300">
                                    {{ $doc->uploader?->name ?? 'YONBUS Admin' }}
                                </td>
                                <td class="p-3 font-mono text-gray-500">{{ $doc->file_size_human }}</td>
                                <td class="p-3 text-gray-500">{{ $doc->created_at->format('M j, Y') }}</td>
                                <td class="p-3 text-right space-x-2 whitespace-nowrap">
                                    <a href="{{ route('documents.view', $doc) }}" target="_blank" rel="noopener noreferrer"
                                       class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-xl text-xs font-bold text-blue-700 dark:text-blue-200 bg-blue-100 dark:bg-blue-900/60 hover:bg-blue-200 transition">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        <span>View</span>
                                    </a>
                                    <a href="{{ route('documents.download', $doc) }}" 
                                       class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl text-xs font-bold text-white bg-[#005DFF] hover:bg-blue-700 shadow-sm transition">
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

        {{-- Validation Errors Summary --}}
        @if ($errors->any())
            <div class="mb-4 p-3 bg-rose-50 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-800 text-rose-700 dark:text-rose-300 text-xs rounded-xl font-medium">
                <ul class="list-disc pl-4 space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form wire:submit.prevent="upload" class="space-y-4">
            {{-- File Drop Zone using standard label and hidden file input --}}
            <div>
                <input type="file"
                       id="client_doc_upload_input"
                       wire:model="file"
                       accept=".pdf,.png,.jpg,.jpeg,.webp,.gif,.heic,.heif,.docx,.doc,.xlsx,.xls,.csv,.txt,image/*,application/pdf"
                       class="sr-only">

                <label for="client_doc_upload_input" class="border-2 border-dashed border-gray-200 dark:border-gray-700/80 rounded-2xl p-6 text-center hover:border-[#005DFF] transition-colors cursor-pointer bg-gray-50/50 dark:bg-gray-800/20 group block">
                    <div class="w-12 h-12 mx-auto rounded-2xl bg-blue-50 dark:bg-blue-950/50 text-[#005DFF] flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                    </div>

                    <p class="text-xs font-semibold text-gray-800 dark:text-gray-200 font-heading">
                        Click to browse or drag and drop files &amp; photos here
                    </p>
                    <p class="text-[11px] text-gray-400 mt-1">PDF, PNG, JPG, JPEG, WEBP, DOCX, XLSX (max 20MB)</p>

                    <div class="mt-3">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-blue-100 dark:bg-blue-900/60 text-[#005DFF] dark:text-blue-300 text-xs font-bold shadow-sm">
                            📁 Choose File
                        </span>
                    </div>

                    {{-- Uploading indicator --}}
                    <div wire:loading wire:target="file" class="mt-3 text-xs text-[#005DFF] font-semibold flex items-center justify-center gap-2 animate-pulse">
                        <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                        <span>Uploading file to browser… please wait</span>
                    </div>
                </label>

                {{-- Selected File Preview --}}
                @if($file)
                    <div class="mt-3 p-3 bg-white dark:bg-gray-800 rounded-xl border border-blue-200 dark:border-blue-800/80 shadow-sm flex items-center justify-between gap-3 text-left">
                        <div class="flex items-center gap-3 overflow-hidden">
                            @php
                                $isImg = false;
                                try { $isImg = str_starts_with($file->getMimeType(), 'image/'); } catch (\Throwable $e) {}
                            @endphp
                            @if($isImg)
                                <img src="{{ $file->temporaryUrl() }}" alt="Preview" class="w-12 h-12 object-cover rounded-lg border border-blue-200 flex-shrink-0 shadow-sm">
                            @else
                                <div class="w-12 h-12 rounded-lg bg-blue-50 dark:bg-blue-950 text-[#005DFF] flex items-center justify-center font-bold text-xs flex-shrink-0 border border-blue-100 dark:border-blue-900">
                                    {{ strtoupper($file->getClientOriginalExtension() ?: 'FILE') }}
                                </div>
                            @endif
                            <div class="overflow-hidden">
                                <p class="font-bold text-xs text-gray-900 dark:text-white truncate max-w-xs font-heading">{{ $file->getClientOriginalName() }}</p>
                                <p class="text-[10px] text-emerald-600 dark:text-emerald-400 font-semibold font-mono">{{ round($file->getSize() / 1024, 1) }} KB &bull; Ready to submit</p>
                            </div>
                        </div>
                        <button type="button" wire:click="removeSelectedFile" class="text-rose-500 hover:text-rose-700 text-xs font-bold px-3 py-1.5 rounded-lg hover:bg-rose-50 dark:hover:bg-rose-950/40 transition cursor-pointer flex-shrink-0">
                            Remove
                        </button>
                    </div>
                @endif
                @error('file') <span class="text-red-500 text-[11px] block font-medium mt-1.5">{{ $message }}</span> @enderror
            </div>

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
                    @error('type') <span class="text-red-500 text-[11px] block font-medium mt-1">{{ $message }}</span> @enderror
                </div>

                {{-- Select Advisor --}}
                <div>
                    <label class="block text-xs font-bold uppercase text-gray-700 dark:text-gray-300 mb-1">Submit To Advisor / Admin</label>
                    <select wire:model="assigned_admin_id" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs focus:ring-2 focus:ring-blue-500 outline-none font-medium">
                        <option value="">-- General YONBUS Admin Pool --</option>
                        @foreach($advisors as $advisor)
                            <option value="{{ $advisor->id }}">{{ $advisor->name }} ({{ ucfirst($advisor->role) }})</option>
                        @endforeach
                    </select>
                    <p class="text-[10px] text-gray-400 mt-1">Directly delivers to this advisor's dashboard</p>
                    @error('assigned_admin_id') <span class="text-red-500 text-[11px] block font-medium mt-1">{{ $message }}</span> @enderror
                </div>

                {{-- Notes --}}
                <div>
                    <label class="block text-xs font-bold uppercase text-gray-700 dark:text-gray-300 mb-1">Notes / Description (Optional)</label>
                    <input type="text" wire:model="notes" placeholder="e.g. 2025 medical &amp; tuition expenses" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs focus:ring-2 focus:ring-blue-500 outline-none">
                    @error('notes') <span class="text-red-500 text-[11px] block font-medium mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- Submit Button --}}
            <div class="flex justify-end pt-2">
                <button type="submit"
                        class="btn-primary text-xs flex items-center gap-1.5 cursor-pointer shadow-md shadow-blue-500/20"
                        wire:loading.attr="disabled"
                        wire:target="upload">
                    <svg wire:loading.remove wire:target="upload" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                    <span wire:loading.remove wire:target="upload">Upload &amp; Submit Document</span>
                    <svg wire:loading wire:target="upload" class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg>
                    <span wire:loading wire:target="upload">Uploading &amp; Submitting…</span>
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
                                    <img src="{{ $doc->file_url }}" alt="{{ $doc->original_name }}" wire:click="previewDocument({{ $doc->id }})" class="w-9 h-9 object-cover rounded-lg border border-blue-200 dark:border-blue-900 shadow-sm flex-shrink-0 cursor-pointer hover:scale-105 transition">
                                @else
                                    <div wire:click="previewDocument({{ $doc->id }})" class="w-9 h-9 rounded-lg bg-blue-50 dark:bg-blue-950 text-[#005DFF] flex items-center justify-center font-bold text-[10px] flex-shrink-0 border border-blue-100 dark:border-blue-900 cursor-pointer hover:scale-105 transition">
                                        {{ strtoupper($doc->file_extension ?: 'DOC') }}
                                    </div>
                                @endif
                                <div>
                                    <button type="button" wire:click="previewDocument({{ $doc->id }})" class="font-bold text-gray-900 dark:text-white font-heading hover:text-[#005DFF] text-left transition">
                                        {{ $doc->original_name }}
                                    </button>
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
                            <td class="p-3.5 text-right space-x-2 whitespace-nowrap">
                                <a href="{{ route('documents.view', $doc) }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-bold text-blue-600 dark:text-blue-300 hover:bg-blue-50 dark:hover:bg-blue-950/40 transition">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    <span>View</span>
                                </a>
                                <a href="{{ route('documents.download', $doc) }}" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-bold text-white bg-[#005DFF] hover:bg-blue-700 transition shadow-sm">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    <span>Download</span>
                                </a>
                                <button wire:click="delete({{ $doc->id }})" wire:confirm="Are you sure you want to delete this document?" class="text-rose-600 hover:underline font-medium cursor-pointer text-xs ml-1">
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

    <!-- In-Page Document Preview Modal -->
    @if($previewDocument)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/70 backdrop-blur-sm overflow-y-auto" wire:keydown.escape="closePreview">
            <div class="bg-white dark:bg-slate-800 rounded-3xl max-w-2xl w-full p-6 shadow-2xl border border-slate-200 dark:border-slate-700 my-8 max-h-[90vh] flex flex-col">
                <div class="flex items-center justify-between pb-4 mb-4 border-b border-slate-100 dark:border-slate-700">
                    <div class="overflow-hidden">
                        <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full bg-blue-50 dark:bg-blue-950/60 text-[#005DFF]">
                            {{ strtoupper($previewDocument->file_extension ?: 'FILE') }} &bull; {{ str_replace('_', ' ', $previewDocument->type ?? 'Document') }}
                        </span>
                        <h3 class="text-base font-extrabold text-slate-900 dark:text-white font-heading truncate mt-1">
                            {{ $previewDocument->original_name }}
                        </h3>
                    </div>
                    <button wire:click="closePreview" class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-700 text-slate-400 hover:text-slate-600 flex items-center justify-center cursor-pointer text-sm font-bold">
                        ✕
                    </button>
                </div>

                {{-- Preview Canvas --}}
                <div class="flex-1 overflow-y-auto rounded-2xl bg-slate-50 dark:bg-slate-900/60 border border-slate-100 dark:border-slate-800 p-4 flex items-center justify-center min-h-[300px] mb-4">
                    @if($previewDocument->is_image && $previewDocument->file_url)
                        <img src="{{ $previewDocument->file_url }}" alt="{{ $previewDocument->original_name }}" class="max-h-[55vh] max-w-full object-contain rounded-xl shadow-sm">
                    @elseif($previewDocument->is_pdf && $previewDocument->file_url)
                        <iframe src="{{ $previewDocument->view_url }}" class="w-full h-[55vh] rounded-xl border border-slate-200 dark:border-slate-700"></iframe>
                    @else
                        <div class="text-center p-8">
                            <div class="w-16 h-16 rounded-2xl bg-blue-50 dark:bg-blue-950 text-[#005DFF] flex items-center justify-center font-bold text-xl mx-auto mb-3">
                                {{ strtoupper($previewDocument->file_extension ?: 'DOC') }}
                            </div>
                            <p class="font-bold text-slate-900 dark:text-white text-sm">{{ $previewDocument->original_name }}</p>
                            <p class="text-xs text-slate-400 mt-1 font-mono">{{ $previewDocument->file_size_human }}</p>
                            <p class="text-xs text-slate-500 mt-2">Direct in-browser preview is available in a new tab or via download.</p>
                        </div>
                    @endif
                </div>

                {{-- Document Details & Action Buttons --}}
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pt-3 border-t border-slate-100 dark:border-slate-700">
                    <div class="text-xs text-slate-500">
                        <span>Uploaded {{ $previewDocument->created_at->format('M j, Y g:i A') }}</span>
                        @if($previewDocument->notes)
                            <p class="text-[11px] text-slate-600 dark:text-slate-400 italic mt-0.5">{{ $previewDocument->notes }}</p>
                        @endif
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('documents.view', $previewDocument) }}" target="_blank" rel="noopener noreferrer" class="px-4 py-2 rounded-xl bg-blue-50 dark:bg-blue-950/60 text-[#005DFF] font-bold text-xs hover:bg-blue-100 transition inline-flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            <span>Open in Tab</span>
                        </a>
                        <a href="{{ route('documents.download', $previewDocument) }}" class="px-4 py-2 rounded-xl bg-[#005DFF] hover:bg-blue-700 text-white font-bold text-xs shadow-md transition inline-flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            <span>Download File</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

