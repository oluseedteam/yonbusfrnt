<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold font-heading text-slate-900">Blog Management System</h1>
            <p class="text-slate-500 text-sm">Create, edit, and publish financial guides, tax tips, and news articles.</p>
        </div>
        <div class="flex space-x-3">
            <button wire:click="$set('showCategoryModal', true)" class="px-4 py-2 bg-slate-100 text-slate-700 hover:bg-slate-200 font-bold text-sm rounded-xl transition">
                + New Category
            </button>
            <button wire:click="openCreateModal" class="px-5 py-2.5 bg-[#005DFF] hover:bg-[#002B8A] text-white font-bold text-sm rounded-xl shadow-md transition">
                + Create Blog Article
            </button>
        </div>
    </div>

    @if(session()->has('message'))
        <div class="p-4 bg-emerald-100 border border-emerald-300 text-emerald-800 rounded-xl text-sm font-semibold">
            {{ session('message') }}
        </div>
    @endif

    <!-- Search Bar -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search blog title..." class="w-full sm:w-80 rounded-xl border-slate-300 text-sm focus:ring-[#005DFF]">
        <div class="text-xs text-slate-500">Total Categories: {{ count($categories) }}</div>
    </div>

    <!-- Blog Table -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <table class="w-full text-left text-sm border-collapse">
            <thead class="bg-slate-50 text-slate-500 font-bold text-xs uppercase border-b border-slate-200">
                <tr>
                    <th class="py-3.5 px-4">Title & Category</th>
                    <th class="py-3.5 px-4">Author</th>
                    <th class="py-3.5 px-4">Featured</th>
                    <th class="py-3.5 px-4">Status</th>
                    <th class="py-3.5 px-4">Date</th>
                    <th class="py-3.5 px-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($blogs as $b)
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="py-4 px-4 font-semibold text-slate-900">
                            <div>{{ $b->title }}</div>
                            <span class="text-[11px] font-bold text-[#005DFF] bg-blue-50 px-2 py-0.5 rounded">{{ $b->category->name }}</span>
                        </td>
                        <td class="py-4 px-4 text-slate-600">{{ $b->author->name ?? 'Admin' }}</td>
                        <td class="py-4 px-4">
                            @if($b->is_featured)
                                <span class="px-2 py-0.5 bg-amber-100 text-amber-800 font-bold text-[11px] rounded">Featured</span>
                            @else
                                <span class="text-slate-400 text-xs">Standard</span>
                            @endif
                        </td>
                        <td class="py-4 px-4">
                            @if($b->is_published)
                                <span class="px-2 py-0.5 bg-emerald-100 text-emerald-800 font-bold text-[11px] rounded">Published</span>
                            @else
                                <span class="px-2 py-0.5 bg-slate-100 text-slate-600 font-bold text-[11px] rounded">Draft</span>
                            @endif
                        </td>
                        <td class="py-4 px-4 text-xs text-slate-500">{{ $b->created_at->format('M d, Y') }}</td>
                        <td class="py-4 px-4 text-right space-x-2">
                            <button wire:click="editBlog({{ $b->id }})" class="text-[#005DFF] hover:underline font-semibold text-xs">Edit</button>
                            <button wire:click="confirmDeleteBlog({{ $b->id }})" class="text-red-600 hover:underline font-semibold text-xs">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-slate-500">No blog posts found. Click "+ Create Blog Article" to write one.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4 border-t border-slate-100">
            {{ $blogs->links() }}
        </div>
    </div>

    <!-- Blog Create/Edit Modal -->
    @if($showModal)
        <div class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4 overflow-y-auto">
            <div class="bg-white rounded-3xl p-8 max-w-2xl w-full shadow-2xl space-y-4 my-8">
                <h3 class="text-xl font-bold font-heading text-slate-900">{{ $editingBlogId ? 'Edit Article' : 'Create New Article' }}</h3>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Title *</label>
                        <input type="text" wire:model.live="title" class="w-full rounded-xl border-slate-300 text-sm focus:ring-[#005DFF]">
                        @error('title') <span class="text-xs text-rose-500 font-semibold mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Category *</label>
                        <select wire:model="blog_category_id" class="w-full rounded-xl border-slate-300 text-sm focus:ring-[#005DFF]">
                            @foreach($categories as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                        @error('blog_category_id') <span class="text-xs text-rose-500 font-semibold mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Featured Image URL</label>
                    <input type="text" wire:model="featured_image" placeholder="https://images.unsplash.com/..." class="w-full rounded-xl border-slate-300 text-sm focus:ring-[#005DFF]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Excerpt</label>
                    <textarea wire:model="excerpt" rows="2" class="w-full rounded-xl border-slate-300 text-sm focus:ring-[#005DFF]"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Full Content *</label>
                    <textarea wire:model="content" rows="6" class="w-full rounded-xl border-slate-300 text-sm focus:ring-[#005DFF]"></textarea>
                    @error('content') <span class="text-xs text-rose-500 font-semibold mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="flex items-center space-x-6 pt-2">
                    <label class="flex items-center space-x-2 text-sm text-slate-700">
                        <input type="checkbox" wire:model="is_featured" class="rounded text-[#005DFF]">
                        <span>Feature on Homepage</span>
                    </label>
                    <label class="flex items-center space-x-2 text-sm text-slate-700">
                        <input type="checkbox" wire:model="is_published" class="rounded text-[#005DFF]">
                        <span>Publish Immediately</span>
                    </label>
                </div>

                <div class="pt-4 flex justify-end space-x-3">
                    <button wire:click="$set('showModal', false)" class="px-5 py-2.5 rounded-xl border border-slate-300 text-slate-700 font-bold text-sm hover:bg-slate-50">Cancel</button>
                    <button wire:click="saveBlog" class="px-6 py-2.5 rounded-xl bg-[#005DFF] text-white font-bold text-sm hover:bg-[#002B8A]">Save Article</button>
                </div>
            </div>
        </div>
    @endif

    <!-- Category Modal -->
    @if($showCategoryModal)
        <div class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4">
            <div class="bg-white rounded-3xl p-8 max-w-md w-full shadow-2xl space-y-4">
                <h3 class="text-xl font-bold font-heading text-slate-900">Add Blog Category</h3>
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Category Name *</label>
                    <input type="text" wire:model="newCategoryName" class="w-full rounded-xl border-slate-300 text-sm focus:ring-[#005DFF]">
                    @error('newCategoryName') <span class="text-xs text-rose-500 font-semibold mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Description</label>
                    <textarea wire:model="newCategoryDescription" rows="3" class="w-full rounded-xl border-slate-300 text-sm focus:ring-[#005DFF]"></textarea>
                </div>
                <div class="pt-4 flex justify-end space-x-3">
                    <button wire:click="$set('showCategoryModal', false)" class="px-5 py-2.5 rounded-xl border border-slate-300 text-slate-700 font-bold text-sm">Cancel</button>
                    <button wire:click="saveCategory" class="px-6 py-2.5 rounded-xl bg-[#005DFF] text-white font-bold text-sm">Add Category</button>
                </div>
            </div>
        </div>
    @endif

    <!-- Custom Popout Delete Confirmation Modal -->
    @if ($showDeleteModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm animate-fade-in">
            <div class="bg-white rounded-3xl p-6 max-w-md w-full shadow-2xl border border-slate-100 text-center space-y-4">
                <div class="w-12 h-12 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center mx-auto">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 font-heading">Delete Blog Article?</h3>
                <p class="text-xs text-slate-500">Are you sure you want to delete this article? This action will remove it from the public blog and homepage.</p>
                <div class="flex items-center justify-center gap-3 pt-2">
                    <button wire:click="cancelDeleteBlog" class="px-5 py-2.5 rounded-xl border border-slate-300 text-slate-700 font-bold text-xs hover:bg-slate-50">Cancel</button>
                    <button wire:click="deleteBlogConfirmed" class="px-5 py-2.5 bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs rounded-xl shadow-md transition">Yes, Delete Article</button>
                </div>
            </div>
        </div>
    @endif
</div>
