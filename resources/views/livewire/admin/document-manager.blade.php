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
        <div class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-200 text-xs font-semibold rounded-2xl flex items-center justify-between shadow-sm">
            <div class="flex items-center">
                <svg class="w-4 h-4 mr-2 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                <span>{{ session('message') }}</span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-800 text-lg leading-none">&times;</button>
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
            {{-- Search Bar with Instant Debounced Typing --}}
            <div class="flex-1 w-full">
                <div class="relative">
                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search files by original name, client name, note, or assigned advisor..." class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-xs focus:ring-2 focus:ring-[#005DFF] outline-none">
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
                            class="px-3 py-1 rounded-lg font-bold transition cursor-pointer {{ $uploaderFilter === 'all' ? 'bg-[#005DFF] text-white shadow-sm' : 'text-slate-600 dark:text-slate-400' }}">
                        All Sources
                    </button>
                    <button type="button" wire:click="$set('uploaderFilter', 'client_uploads')"
                            class="px-3 py-1 rounded-lg font-bold transition cursor-pointer {{ $uploaderFilter === 'client_uploads' ? 'bg-emerald-600 text-white shadow-sm' : 'text-slate-600 dark:text-slate-400' }}">
                        Client Uploads
                    </button>
                    <button type="button" wire:click="$set('uploaderFilter', 'admin_uploads')"
                            class="px-3 py-1 rounded-lg font-bold transition cursor-pointer {{ $uploaderFilter === 'admin_uploads' ? 'bg-purple-600 text-white shadow-sm' : 'text-slate-600 dark:text-slate-400' }}">
                        Admin Deliveries
                    </button>
                </div>
            </div>
        </div>

        {{-- Consultant Segregation Filter --}}
        <div class="flex items-center gap-2 pt-3 border-t border-slate-100 dark:border-slate-700/60 overflow-x-auto text-xs">
            <span class="font-bold text-slate-500 dark:text-slate-400 flex items-center gap-1.5 flex-shrink-0">
                <span>🛡️</span> Admin / Advisor Scope:
            </span>
            <button type="button" wire:click="$set('consultantFilter', 'all')"
                    class="px-3 py-1.5 rounded-lg font-bold transition cursor-pointer {{ $consultantFilter === 'all' ? 'bg-slate-900 text-white dark:bg-white dark:text-slate-900 shadow-sm' : 'bg-slate-100 dark:bg-slate-900 text-slate-600 dark:text-slate-400 hover:bg-slate-200' }}">
                All Documents
            </button>
            <button type="button" wire:click="$set('consultantFilter', 'my_documents')"
                    class="px-3 py-1.5 rounded-lg font-bold transition cursor-pointer flex items-center gap-1.5 {{ $consultantFilter === 'my_documents' ? 'bg-emerald-600 text-white shadow-sm' : 'bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-300 hover:bg-emerald-100' }}">
                <span>⭐</span> Submitted to Me
            </button>
            <button type="button" wire:click="$set('consultantFilter', 'olubukunola')"
                    class="px-3 py-1.5 rounded-lg font-bold transition cursor-pointer flex items-center gap-1.5 {{ $consultantFilter === 'olubukunola' ? 'bg-[#005DFF] text-white shadow-sm' : 'bg-blue-50 dark:bg-blue-950/40 text-blue-700 dark:text-blue-300 hover:bg-blue-100' }}">
                <span>👩‍💼</span> Olubukunola's Documents
            </button>
            <button type="button" wire:click="$set('consultantFilter', 'adeshola')"
                    class="px-3 py-1.5 rounded-lg font-bold transition cursor-pointer flex items-center gap-1.5 {{ $consultantFilter === 'adeshola' ? 'bg-[#005DFF] text-white shadow-sm' : 'bg-blue-50 dark:bg-blue-950/40 text-blue-700 dark:text-blue-300 hover:bg-blue-100' }}">
                <span>👨‍💼</span> Adeshola's Documents
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
                        <th class="px-6 py-4">Client</th>
                        <th class="px-6 py-4">Delivered / Assigned To</th>
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
                            {{-- Document Details --}}
                            <td class="px-6 py-4 flex items-center gap-3">
                                @if($doc->is_image && $doc->file_url)
                                    <img src="{{ $doc->file_url }}" alt="{{ $doc->original_name }}" wire:click="previewDocument({{ $doc->id }})" class="w-10 h-10 rounded-xl object-cover border border-blue-200 dark:border-blue-900/60 shadow-sm flex-shrink-0 cursor-pointer hover:scale-105 transition">
                                @else
                                    <div wire:click="previewDocument({{ $doc->id }})" class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-950/60 text-[#005DFF] flex items-center justify-center font-bold text-[10px] flex-shrink-0 border border-blue-200 dark:border-blue-900/40 cursor-pointer hover:scale-105 transition">
                                        {{ $ext ?: 'DOC' }}
                                    </div>
                                @endif
                                <div>
                                    <button type="button" wire:click="previewDocument({{ $doc->id }})" class="font-bold text-slate-900 dark:text-white text-xs hover:text-[#005DFF] text-left transition flex items-center gap-1.5">
                                        <span>{{ $doc->original_name }}</span>
                                    </button>
                                    @if($doc->notes)
                                        <div class="text-[11px] text-slate-500 italic mt-0.5">{{ $doc->notes }}</div>
                                    @endif
                                    <div class="text-[10px] text-slate-400 font-mono mt-0.5">{{ str_replace('_', ' ', $doc->type ?? $doc->file_type) }}</div>
                                </div>
                            </td>

                            {{-- Associated Client --}}
                            <td class="px-6 py-4">
                                @if($doc->client)
                                    <div class="font-bold text-slate-900 dark:text-white">{{ $doc->client->name }}</div>
                                    <div class="text-[11px] text-slate-500">{{ $doc->client->email }}</div>
                                @else
                                    <span class="text-slate-400 italic">Unknown Client</span>
                                @endif
                            </td>

                            {{-- Delivered / Assigned To --}}
                            <td class="px-6 py-4">
                                @if($doc->assignedAdmin)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-blue-50 text-[#005DFF] dark:bg-blue-950/60 dark:text-blue-300 border border-blue-200 dark:border-blue-900/40">
                                        <span>👤</span> {{ $doc->assignedAdmin->name }}
                                    </span>
                                @elseif($doc->client && $doc->client->assignedAdmin)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300">
                                        <span>👤</span> {{ $doc->client->assignedAdmin->name }}
                                    </span>
                                @else
                                    <span class="text-slate-400 text-xs">All Admins</span>
                                @endif
                            </td>

                            {{-- Uploaded By --}}
                            <td class="px-6 py-4">
                                @if($isClientUpload)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-900/40">
                                        <span>📥</span> Client
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-purple-100 text-purple-800 dark:bg-purple-950/60 dark:text-purple-300 border border-purple-200 dark:border-purple-900/40">
                                        <span>🛡️</span> {{ $doc->uploader?->name ?? 'Admin Staff' }}
                                    </span>
                                @endif
                            </td>

                            {{-- Size & Format --}}
                            <td class="px-6 py-4 font-mono text-slate-500">
                                {{ $doc->file_size_human }}
                            </td>

                            {{-- Date --}}
                            <td class="px-6 py-4 text-slate-500">
                                {{ $doc->created_at->format('M j, Y • g:i A') }}
                            </td>

                            {{-- Actions --}}
                            <td class="px-6 py-4 text-right space-x-2 whitespace-nowrap">
                                <a href="{{ route('documents.view', $doc) }}" target="_blank" rel="noopener noreferrer" class="px-3 py-1.5 bg-blue-50 hover:bg-blue-100 dark:bg-blue-950/60 dark:hover:bg-blue-900 text-[#005DFF] dark:text-blue-300 font-bold text-xs rounded-xl transition inline-flex items-center gap-1 cursor-pointer">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    <span>View</span>
                                </a>
                                <a href="{{ route('documents.download', $doc) }}" class="px-3 py-1.5 bg-[#005DFF] hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-sm transition inline-flex items-center gap-1 cursor-pointer">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    <span>Download</span>
                                </a>
                                <button wire:click="delete({{ $doc->id }})" wire:confirm="Are you sure you want to delete this document?" class="px-2.5 py-1.5 text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-950/40 font-semibold text-xs rounded-xl transition cursor-pointer">
                                    🗑️ Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">
                                <div class="w-12 h-12 rounded-2xl bg-blue-50 dark:bg-slate-700 flex items-center justify-center mx-auto text-2xl mb-3">📁</div>
                                <p class="text-base font-bold text-slate-900 dark:text-white mb-1">No documents found in vault</p>
                                <p class="text-xs max-w-sm mx-auto mb-4">When clients upload tax forms or documents in their client portal, they will appear here immediately.</p>
                                <button wire:click="openUploadModal" class="px-4 py-2 bg-[#005DFF] text-white text-xs font-bold rounded-xl shadow cursor-pointer">
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

    <!-- Admin Document Quick Preview Modal -->
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
                        <p class="text-[11px] text-slate-400">
                            Client: {{ $previewDocument->client?->name ?? 'N/A' }} ({{ $previewDocument->client?->email }})
                        </p>
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

                {{-- Details & Actions --}}
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pt-3 border-t border-slate-100 dark:border-slate-700">
                    <div class="text-xs text-slate-500">
                        <span>Uploaded {{ $previewDocument->created_at->format('M j, Y • g:i A') }}</span>
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

                    {{-- File Input & Image Preview --}}
                    <div class="border-2 border-dashed border-slate-200 dark:border-slate-700 rounded-2xl p-6 text-center hover:border-[#005DFF] transition relative bg-slate-50/50 dark:bg-slate-900/30 group">
                        <input type="file" wire:model="file" accept=".pdf,.png,.jpg,.jpeg,.webp,.gif,.heic,.heif,.docx,.doc,.xlsx,.xls,.csv,.txt,image/*,application/pdf" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="w-10 h-10 mx-auto rounded-xl bg-blue-50 dark:bg-blue-950/50 text-[#005DFF] flex items-center justify-center mb-2 font-bold text-base group-hover:scale-110 transition-transform">
                            📁
                        </div>
                        <p class="text-xs font-bold text-slate-800 dark:text-slate-200">
                            Click or drag document or photo to upload
                        </p>
                        <p class="text-[10px] text-slate-400 mt-1">PDF, PNG, JPG, JPEG, WEBP, DOCX, XLSX (max 20MB)</p>

                        {{-- Livewire Upload Loading Progress --}}
                        <div wire:loading wire:target="file" class="mt-3 text-xs text-[#005DFF] font-semibold flex items-center justify-center gap-2 animate-pulse">
                            <svg class="animate-spin h-4 w-4 text-[#005DFF]" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                            </svg>
                            <span>Processing file... please wait</span>
                        </div>

                        {{-- Selected File & Image Preview --}}
                        @if($file)
                            <div wire:loading.remove wire:target="file" class="mt-4 p-3 bg-white dark:bg-slate-800 rounded-xl border border-blue-200 dark:border-blue-800/80 shadow-sm inline-flex items-center gap-3 text-left relative z-20 max-w-full">
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
                                    <p class="font-bold text-xs text-slate-900 dark:text-white truncate max-w-xs">{{ $file->getClientOriginalName() }}</p>
                                    <p class="text-[10px] text-slate-500 font-mono">{{ round($file->getSize() / 1024, 1) }} KB &bull; Ready to upload</p>
                                </div>

                                <button type="button" wire:click.prevent="removeSelectedFile" class="ml-2 text-rose-500 hover:text-rose-700 text-xs font-bold px-2 py-1 rounded-lg hover:bg-rose-50 dark:hover:bg-rose-950/40 transition cursor-pointer">
                                    Remove
                                </button>
                            </div>
                        @endif
                    </div>
                    @error('file') <span class="text-xs text-rose-500 block font-medium">{{ $message }}</span> @enderror

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
                        <button type="button" wire:click="$set('showUploadModal', false)" class="px-4 py-2 rounded-xl border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 font-bold text-xs hover:bg-slate-100 cursor-pointer">
                            Cancel
                        </button>
                        <button type="submit" class="px-5 py-2.5 rounded-xl bg-[#005DFF] hover:bg-blue-700 text-white font-bold text-xs shadow-lg transition flex items-center gap-1.5 cursor-pointer" wire:loading.attr="disabled">
                            <svg wire:loading.remove wire:target="uploadDocument" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            <span wire:loading.remove wire:target="uploadDocument">Upload &amp; Send to Client</span>
                            <span wire:loading wire:target="uploadDocument">Uploading &amp; Sending...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
