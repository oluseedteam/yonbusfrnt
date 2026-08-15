<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold font-heading text-slate-900 dark:text-white">Blog Management System</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm">Create, edit, and publish financial guides, tax tips, and news articles.</p>
        </div>
        <div class="flex space-x-3">
            <button wire:click="$set('showCategoryModal', true)" class="px-4 py-2 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 font-bold text-sm rounded-xl transition">
                + New Category
            </button>
            <button wire:click="openCreateModal" class="px-5 py-2.5 bg-[#005DFF] hover:bg-[#031B4E] text-white font-bold text-sm rounded-xl shadow-md transition flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Create Blog Article
            </button>
        </div>
    </div>

    @if(session()->has('message'))
        <div class="p-4 bg-[#005DFF] dark:bg-[#005DFF]/40 border border-[#005DFF] dark:border-[#005DFF] text-[#005DFF] dark:text-[#005DFF] rounded-xl text-sm font-semibold">
            {{ session('message') }}
        </div>
    @endif

    <!-- Search Bar -->
    <div class="bg-white dark:bg-slate-800 p-4 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm flex items-center justify-between">
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search blog title..." class="w-full sm:w-80 rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-[#005DFF]">
        <div class="text-xs text-slate-500 dark:text-slate-400">Total Categories: {{ count($categories) }}</div>
    </div>

    <!-- Blog Table -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
        <table class="w-full text-left text-sm border-collapse">
            <thead class="bg-slate-50 dark:bg-slate-900/50 text-slate-500 dark:text-slate-400 font-bold text-xs uppercase border-b border-slate-200 dark:border-slate-700">
                <tr>
                    <th class="py-3.5 px-4">Title & Category</th>
                    <th class="py-3.5 px-4">Author</th>
                    <th class="py-3.5 px-4">Featured</th>
                    <th class="py-3.5 px-4">Status</th>
                    <th class="py-3.5 px-4">Date</th>
                    <th class="py-3.5 px-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                @forelse($blogs as $b)
                    <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-700/30 transition">
                        <td class="py-4 px-4 font-semibold text-slate-900 dark:text-white">
                            <div class="flex items-center gap-3">
                                @if($b->featured_image)
                                    <img src="{{ $b->featured_image }}" alt="{{ $b->title }}" class="w-10 h-10 rounded-lg object-cover border border-slate-200 dark:border-slate-700">
                                @endif
                                <div>
                                    <div class="font-medium text-slate-900 dark:text-white">{{ $b->title }}</div>
                                    <span class="text-[11px] font-bold text-[#005DFF] bg-blue-50 dark:bg-blue-950/50 px-2 py-0.5 rounded">{{ $b->category?->name ?? 'General' }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-4 text-slate-600 dark:text-slate-400">{{ $b->author->name ?? 'Admin' }}</td>
                        <td class="py-4 px-4">
                            @if($b->is_featured)
                                <span class="px-2 py-0.5 bg-amber-100 dark:bg-amber-900/40 text-amber-800 dark:text-amber-300 font-bold text-[11px] rounded">Featured</span>
                            @else
                                <span class="text-slate-400 text-xs">Standard</span>
                            @endif
                        </td>
                        <td class="py-4 px-4">
                            @if($b->is_published)
                                <span class="px-2 py-0.5 bg-[#005DFF] dark:bg-[#005DFF]/40 text-[#005DFF] dark:text-[#005DFF] font-bold text-[11px] rounded">Published</span>
                            @else
                                <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 font-bold text-[11px] rounded">Draft</span>
                            @endif
                        </td>
                        <td class="py-4 px-4 text-xs text-slate-500 dark:text-slate-400">{{ $b->created_at->format('M d, Y') }}</td>
                        <td class="py-4 px-4 text-right space-x-2">
                            <button wire:click="editBlog({{ $b->id }})" class="text-[#005DFF] hover:underline font-semibold text-xs">Edit</button>
                            <button wire:click="confirmDeleteBlog({{ $b->id }})" class="text-rose-600 hover:underline font-semibold text-xs">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-slate-500 dark:text-slate-400">No blog posts found. Click "+ Create Blog Article" to write one.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @if ($blogs->hasPages())
            <div class="p-4 border-t border-slate-100 dark:border-slate-700">
                {{ $blogs->links() }}
            </div>
        @endif
    </div>

    <!-- Blog Create/Edit Modal with Local Upload & Preview -->
    @if($showModal)
        <div class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 overflow-y-auto">
            <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 sm:p-8 max-w-2xl w-full shadow-2xl space-y-4 my-8 border border-slate-100 dark:border-slate-700">
                <div class="flex items-center justify-between pb-2 border-b border-slate-100 dark:border-slate-700">
                    <h3 class="text-xl font-bold font-heading text-slate-900 dark:text-white">{{ $editingBlogId ? 'Edit Article' : 'Create New Article' }}</h3>
                    <button wire:click="$set('showModal', false)" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 dark:text-slate-300 mb-1">Title *</label>
                        <input type="text" wire:model.live="title" class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-[#005DFF]">
                        @error('title') <span class="text-xs text-rose-500 font-semibold mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 dark:text-slate-300 mb-1">Category *</label>
                        <select wire:model="blog_category_id" class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-[#005DFF]">
                            @foreach($categories as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                        @error('blog_category_id') <span class="text-xs text-rose-500 font-semibold mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Featured Image: Local Upload & URL Option -->
                <div class="p-4 bg-slate-50 dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-700 space-y-3">
                    <label class="block text-xs font-bold uppercase text-slate-700 dark:text-slate-300">Featured Image</label>
                    
                    <div class="flex flex-col sm:flex-row items-center gap-4">
                        <div class="flex-1 w-full">
                            <label class="block text-[11px] text-slate-500 dark:text-slate-400 mb-1">Upload from Device (Local Image)</label>
                            <input type="file" wire:model="imageFile" accept="image/*" class="w-full text-xs text-slate-500 dark:text-slate-400 file:mr-3 file:py-2 file:px-3.5 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                            <div wire:loading wire:target="imageFile" class="text-[11px] text-blue-600 mt-1">Uploading image...</div>
                            @error('imageFile') <span class="text-xs text-rose-500 font-semibold mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        {{-- Image Preview --}}
                        <div class="w-20 h-20 rounded-xl overflow-hidden bg-slate-200 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 flex-shrink-0 flex items-center justify-center">
                            @if ($imageFile)
                                <img src="{{ $imageFile->temporaryUrl() }}" class="w-full h-full object-cover">
                            @elseif ($featured_image)
                                <img src="{{ $featured_image }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-[10px] text-slate-400 text-center px-1">No Image</span>
                            @endif
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] text-slate-500 dark:text-slate-400 mb-1">Or Paste Image URL (Optional)</label>
                        <input type="text" wire:model="featured_image" placeholder="https://images.unsplash.com/..." class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-xs focus:ring-[#005DFF]">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 dark:text-slate-300 mb-1">Excerpt</label>
                    <textarea wire:model="excerpt" rows="2" placeholder="Brief summary of the article..." class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-[#005DFF]"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 dark:text-slate-300 mb-1">Full Content *</label>
                    <textarea wire:model="content" rows="6" placeholder="Write your full article content here..." class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-[#005DFF]"></textarea>
                    @error('content') <span class="text-xs text-rose-500 font-semibold mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="flex items-center space-x-6 pt-2">
                    <label class="flex items-center space-x-2 text-sm text-slate-700 dark:text-slate-300 cursor-pointer">
                        <input type="checkbox" wire:model="is_featured" class="rounded text-[#005DFF]">
                        <span>Feature on Homepage</span>
                    </label>
                    <label class="flex items-center space-x-2 text-sm text-slate-700 dark:text-slate-300 cursor-pointer">
                        <input type="checkbox" wire:model="is_published" class="rounded text-[#005DFF]">
                        <span>Publish Immediately</span>
                    </label>
                </div>

                <div class="pt-4 flex justify-end space-x-3 border-t border-slate-100 dark:border-slate-700">
                    <button wire:click="$set('showModal', false)" class="px-5 py-2.5 rounded-xl border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 font-bold text-sm hover:bg-slate-50 dark:hover:bg-slate-700">Cancel</button>
                    <button wire:click="saveBlog" class="px-6 py-2.5 rounded-xl bg-[#005DFF] text-white font-bold text-sm hover:bg-[#031B4E] shadow-md transition">Save Article</button>
                </div>
            </div>
        </div>
    @endif

    <!-- Category Modal -->
    @if($showCategoryModal)
        <div class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
            <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 sm:p-8 max-w-md w-full shadow-2xl space-y-4 border border-slate-100 dark:border-slate-700">
                <h3 class="text-xl font-bold font-heading text-slate-900 dark:text-white">Add Blog Category</h3>
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 dark:text-slate-300 mb-1">Category Name *</label>
                    <input type="text" wire:model="newCategoryName" class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-[#005DFF]">
                    @error('newCategoryName') <span class="text-xs text-rose-500 font-semibold mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 dark:text-slate-300 mb-1">Description</label>
                    <textarea wire:model="newCategoryDescription" rows="3" class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-[#005DFF]"></textarea>
                </div>
                <div class="pt-4 flex justify-end space-x-3 border-t border-slate-100 dark:border-slate-700">
                    <button wire:click="$set('showCategoryModal', false)" class="px-5 py-2.5 rounded-xl border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 font-bold text-sm">Cancel</button>
                    <button wire:click="saveCategory" class="px-6 py-2.5 rounded-xl bg-[#005DFF] text-white font-bold text-sm">Add Category</button>
                </div>
            </div>
        </div>
    @endif

    <!-- Custom Popout Delete Confirmation Modal -->
    @if ($showDeleteModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm animate-fade-in">
            <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 max-w-md w-full shadow-2xl border border-slate-100 dark:border-slate-700 text-center space-y-4">
                <div class="w-12 h-12 rounded-full bg-rose-100 dark:bg-rose-900/40 text-rose-600 dark:text-rose-400 flex items-center justify-center mx-auto">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white font-heading">Delete Blog Article?</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400">Are you sure you want to delete this article? This action will remove it from the public blog and homepage.</p>
                <div class="flex items-center justify-center gap-3 pt-2">
                    <button wire:click="cancelDeleteBlog" class="px-5 py-2.5 rounded-xl border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 font-bold text-xs hover:bg-slate-50 dark:hover:bg-slate-700">Cancel</button>
                    <button wire:click="deleteBlogConfirmed" class="px-5 py-2.5 bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs rounded-xl shadow-md transition">Yes, Delete Article</button>
                </div>
            </div>
        </div>
    @endif
</div>
