<div>
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 dark:text-white font-heading">Client Document Vault</h1>
            <p class="text-xs text-gray-500 mt-1">Review uploaded client tax records and supporting attachments.</p>
        </div>
        <div class="flex items-center gap-3">
            <select wire:model.live="clientFilter" class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2 px-3 text-xs">
                <option value="">All Clients</option>
                @foreach($clients as $c)
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="card-box">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-gray-50 dark:bg-gray-800 text-gray-500 uppercase font-semibold">
                    <tr>
                        <th class="p-3.5">Document Name</th>
                        <th class="p-3.5">Client Owner</th>
                        <th class="p-3.5">Category</th>
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
                                <span class="font-bold text-gray-900 dark:text-white font-heading">{{ $doc->original_name }}</span>
                            </td>
                            <td class="p-3.5 font-medium text-gray-800 dark:text-gray-200">{{ $doc->user?->name }}</td>
                            <td class="p-3.5 uppercase font-semibold text-[10px] text-gray-500">{{ str_replace('_', ' ', $doc->type) }}</td>
                            <td class="p-3.5 font-mono text-gray-500">{{ $doc->formatted_size }}</td>
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
</div>
