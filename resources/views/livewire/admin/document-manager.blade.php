<div>
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <div class="inline-block text-[11px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-blue-50 dark:bg-blue-950/60 text-[#005DFF] border border-blue-200 dark:border-blue-900/40 mb-1">
                Central Document Vault
            </div>
            <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white font-heading">
                Client &amp; Practice Documents
            </h1>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                Access all client tax records, financial files, CRA notices, and documents uploaded across all client portals.
            </p>
        </div>
        <button wire:click="openUploadModal" class="px-5 py-2.5 bg-[#005DFF] hover:bg-blue-700 text-white text-xs font-bold rounded-xl shadow-lg transition flex items-center gap-2 cursor-pointer">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
            <span>+ Upload Document to Client</span>
        </button>
    </div>

    @if (session()->has('message'))
        <div class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-200 text-xs font-semibold rounded-2xl flex items-center shadow-sm">
            <svg class="w-4 h-4 mr-2 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
            {{ session('message') }}
        </div>
    @endif

    <!-- Metrics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div class="p-4 rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700/60 shadow-sm flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-blue-50 dark:bg-blue-950/60 text-[#005DFF] flex items-center justify-center font-bold text-lg">
                📁
            </div>
            <div>
                <div class="text-xl font-extrabold text-slate-900 dark:text-white">{{ $stats['total'] }}</div>
                <div class="text-xs text-slate-500 dark:text-slate-400 font-medium">Total Files in Vault</div>
            </div>
        </div>

        <div class="p-4 rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700/60 shadow-sm flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 flex items-center justify-center font-bold text-lg">
                📥
            </div>
            <div>
                <div class="text-xl font-extrabold text-slate-900 dark:text-white">{{ $stats['client_uploads'] }}</div>
                <div class="text-xs text-slate-500 dark:text-slate-400 font-medium">Uploaded by Clients</div>
            </div>
        </div>

        <div class="p-4 rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700/60 shadow-sm flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-purple-50 dark:bg-purple-950/60 text-purple-600 flex items-center justify-center font-bold text-lg">
                📤
            </div>
            <div>
                <div class="text-xl font-extrabold text-slate-900 dark:text-white">{{ $stats['admin_uploads'] }}</div>
                <div class="text-xs text-slate-500 dark:text-slate-400 font-medium">Delivered by Practice Staff</div>
            </div>
        </div>
    </div>

    <!-- Filters & Search -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl p-4 mb-6 shadow-sm border border-slate-200 dark:border-slate-700/50 space-y-4">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="flex-1 w-full">
                <div class="relative">
                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search files by original name, client name, or email..." class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-xs focus:ring-2 focus:ring-[#005DFF] outline-none">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </div>

            <div class="flex items-center gap-3 w-full md:w-auto">
                <select wire:model.live="clientFilter" class="px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-xs font-semibold focus:ring-2 focus:ring-[#005DFF] outline-none">
                    <option value="all">All Clients</option>
                    @foreach($clients as $c)
                        <option value="{{ $c->id }}">{{ $c->name }} ({{ $c->email }})</option>
                    @endforeach
                </select>

                <div class="flex items-center gap-1 bg-slate-100 dark:bg-slate-900 p-1 rounded-xl text-xs">
                    <button type="button" wire:click="$set('uploaderFilter', 'all')"
                            class="px-3 py-1 rounded-lg font-bold transition {{ $uploaderFilter === 'all' ? 'bg-[#005DFF] text-white shadow-sm' : 'text-slate-600 dark:text-slate-400' }}">
                        All Sources
                    </button>
                    <button type="button" wire:click="$set('uploaderFilter', 'client_uploads')"
                            class="px-3 py-1 rounded-lg font-bold transition {{ $uploaderFilter === 'client_uploads' ? 'bg-emerald-600 text-white shadow-sm' : 'text-slate-600 dark:text-slate-400' }}">
                        Client Uploads
                    </button>
                    <button type="button" wire:click="$set('uploaderFilter', 'admin_uploads')"
                            class="px-3 py-1 rounded-lg font-bold transition {{ $uploaderFilter === 'admin_uploads' ? 'bg-purple-600 text-white shadow-sm' : 'text-slate-600 dark:text-slate-400' }}">
                        Admin Deliveries
                    </button>
                </div>
            </div>
        </div>

        {{-- Consultant Segregation Filter --}}
        <div class="flex items-center gap-2 pt-3 border-t border-slate-100 dark:border-slate-700/60 overflow-x-auto text-xs">
            <span class="font-bold text-slate-500 dark:text-slate-400 flex items-center gap-1.5 flex-shrink-0">
                <span>🛡️</span> Consultant Scope:
            </span>
            <button type="button" wire:click="$set('consultantFilter', 'all')"
                    class="px-3 py-1 rounded-lg font-bold transition {{ $consultantFilter === 'all' ? 'bg-slate-900 text-white dark:bg-white dark:text-slate-900 shadow-sm' : 'bg-slate-100 dark:bg-slate-900 text-slate-600 dark:text-slate-400 hover:bg-slate-200' }}">
                All Client Documents
            </button>
            <button type="button" wire:click="$set('consultantFilter', 'olubukunola')"
                    class="px-3 py-1 rounded-lg font-bold transition flex items-center gap-1.5 {{ $consultantFilter === 'olubukunola' ? 'bg-blue-600 text-white shadow-sm' : 'bg-blue-50 dark:bg-blue-950/40 text-blue-700 dark:text-blue-300 hover:bg-blue-100' }}">
                <span>👩‍💼</span> Olubukunola's Client Documents
            </button>
            <button type="button" wire:click="$set('consultantFilter', 'adeshola')"
                    class="px-3 py-1 rounded-lg font-bold transition flex items-center gap-1.5 {{ $consultantFilter === 'adeshola' ? 'bg-blue-600 text-white shadow-sm' : 'bg-blue-50 dark:bg-blue-950/40 text-blue-700 dark:text-blue-300 hover:bg-blue-100' }}">
                <span>👨‍💼</span> Adeshola's Client Documents
            </button>
        </div>
    </div>

    <!-- Documents Table -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="border-b border-slate-200 dark:border-slate-700 text-[11px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider bg-slate-50/80 dark:bg-slate-900/50">
                        <th class="px-6 py-4">Document Details</th>
                        <th class="px-6 py-4">Associated Client</th>
                        <th class="px-6 py-4">Uploaded By</th>
                        <th class="px-6 py-4">Size &amp; Format</th>
                        <th class="px-6 py-4">Date Uploaded</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700 text-slate-700 dark:text-slate-300">
                    @forelse ($documents as $doc)
                        @php
                            $isClientUpload = $doc->uploaded_by == $doc->client_id;
                            $ext = strtoupper(pathinfo($doc->original_name, PATHINFO_EXTENSION));
                        @endphp
                        <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-700/30 transition">
                            <td class="px-6 py-4 flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-blue-100 dark:bg-blue-950/60 text-[#005DFF] flex items-center justify-center font-bold text-[10px] flex-shrink-0 border border-blue-200 dark:border-blue-900/40">
                                    {{ $ext ?: 'DOC' }}
                                </div>
                                <div>
                                    <div class="font-bold text-slate-900 dark:text-white text-xs flex items-center gap-1.5">
                                        <span>{{ $doc->original_name }}</span>
                                    </div>
                                    <div class="text-[10px] text-slate-400 font-mono">{{ $doc->file_type ?? 'application/octet-stream' }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if($doc->client)
                                    <div class="font-bold text-slate-900 dark:text-white">{{ $doc->client->name }}</div>
                                    <div class="text-[11px] text-slate-500">{{ $doc->client->email }}</div>
                                    @if($doc->client->assignedAdmin)
                                        <div class="text-[10px] text-blue-600 font-semibold mt-0.5">
                                            Consultant: {{ $doc->client->assignedAdmin->name }}
                                        </div>
                                    @endif
                                @else
                                    <span class="text-slate-400 italic">Unknown Client</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($isClientUpload)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-900/40">
                                        <span>👤</span> Client Upload
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-purple-100 text-purple-800 dark:bg-purple-950/60 dark:text-purple-300 border border-purple-200 dark:border-purple-900/40">
                                        <span>🛡️</span> {{ $doc->uploader?->name ?? 'Admin Staff' }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-mono text-slate-500">
                                {{ $doc->file_size_human }}
                            </td>
                            <td class="px-6 py-4 text-slate-500">
                                {{ $doc->created_at->format('M j, Y • g:i A') }}
                            </td>
                            <td class="px-6 py-4 text-right space-x-2 whitespace-nowrap">
                                <a href="{{ route('documents.download', $doc) }}" class="px-3.5 py-1.5 bg-[#005DFF] hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-sm transition inline-flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    <span>Download</span>
                                </a>
                                <button wire:click="delete({{ $doc->id }})" wire:confirm="Are you sure you want to delete this document?" class="px-2.5 py-1.5 text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-950/40 font-semibold text-xs rounded-xl transition">
                                    🗑️ Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">
                                <div class="w-12 h-12 rounded-2xl bg-blue-50 dark:bg-slate-700 flex items-center justify-center mx-auto text-2xl mb-3">📁</div>
                                <p class="text-base font-bold text-slate-900 dark:text-white mb-1">No documents found in vault</p>
                                <p class="text-xs max-w-sm mx-auto mb-4">When clients upload tax forms or documents in their client portal, they will appear here immediately.</p>
                                <button wire:click="openUploadModal" class="px-4 py-2 bg-[#005DFF] text-white text-xs font-bold rounded-xl shadow">
                                    + Upload Document to Client
                                </button>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($documents->hasPages())
            <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-700">
                {{ $documents->links() }}
            </div>
        @endif
    </div>

    <!-- Admin Upload Document Modal -->
    @if ($showUploadModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm overflow-y-auto">
            <div class="bg-white dark:bg-slate-800 rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-slate-200 dark:border-slate-700 my-8">
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100 dark:border-slate-700">
                    <div>
                        <div class="inline-block text-[10px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-blue-50 dark:bg-blue-950/60 text-[#005DFF] border border-blue-200 dark:border-blue-900/40 mb-1">
                            Staff File Delivery
                        </div>
                        <h3 class="text-lg font-extrabold text-slate-900 dark:text-white font-heading m-0">
                            Deliver Document to Client Portal
                        </h3>
                    </div>
                    <button wire:click="$set('showUploadModal', false)" class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-700 text-slate-400 hover:text-slate-600 flex items-center justify-center cursor-pointer">
                        ✕
                    </button>
                </div>

                <form wire:submit.prevent="uploadDocument" class="space-y-4">
                    {{-- Target Client Selection --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Select Recipient Client *</label>
                        <select wire:model="target_client_id" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-xs font-semibold focus:ring-2 focus:ring-[#005DFF] outline-none">
                            <option value="">-- Choose Client --</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->name }} ({{ $client->email }})</option>
                            @endforeach
                        </select>
                        @error('target_client_id') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                    </div>

                    {{-- File Input --}}
                    <div class="border-2 border-dashed border-slate-200 dark:border-slate-700 rounded-2xl p-6 text-center hover:border-[#005DFF] transition relative bg-slate-50/50 dark:bg-slate-900/30">
                        <input type="file" wire:model="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        <div class="w-10 h-10 mx-auto rounded-xl bg-blue-50 dark:bg-blue-950/50 text-[#005DFF] flex items-center justify-center mb-2 font-bold text-base">
                            📁
                        </div>
                        <p class="text-xs font-bold text-slate-800 dark:text-slate-200">
                            Click or drag document to upload
                        </p>
                        <p class="text-[10px] text-slate-400 mt-1">PDF, PNG, JPG, DOCX, XLSX (max 20MB)</p>
                        @if($file)
                            <div class="mt-2 text-xs font-bold text-[#005DFF] bg-blue-50 dark:bg-blue-950/60 py-1 px-3 rounded-lg inline-block">
                                Selected: {{ $file->getClientOriginalName() }}
                            </div>
                        @endif
                    </div>
                    @error('file') <span class="text-xs text-rose-500 block">{{ $message }}</span> @enderror

                    {{-- Document Category --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Document Classification</label>
                        <select wire:model="type" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-xs outline-none">
                            <option value="completed_tax_return">Completed Tax Return (T1/T2 Notice)</option>
                            <option value="cra_notice">CRA Notice of Assessment / Review</option>
                            <option value="financial_statement">Financial Statements &amp; Balance Sheet</option>
                            <option value="invoice_receipt">Official Practice Invoice / Receipt</option>
                            <option value="other">General Tax &amp; Accounting Documentation</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Staff Notes / Instructions</label>
                        <textarea wire:model="notes" rows="2" placeholder="Optional notes for client reference..." class="w-full px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-xs outline-none"></textarea>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100 dark:border-slate-700">
                        <button type="button" wire:click="$set('showUploadModal', false)" class="px-4 py-2 rounded-xl border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 font-bold text-xs hover:bg-slate-100">
                            Cancel
                        </button>
                        <button type="submit" class="px-5 py-2.5 rounded-xl bg-[#005DFF] hover:bg-blue-700 text-white font-bold text-xs shadow-lg transition flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            <span>Upload &amp; Send to Client</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
