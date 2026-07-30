<?php

namespace App\Livewire\Admin;

use App\Models\Blog;
use App\Models\BlogCategory;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class BlogManager extends Component
{
    use WithPagination;

    public $showModal = false;
    public $editingBlogId = null;

    // Blog Form Fields
    public $blog_category_id = '';
    public $title = '';
    public $slug = '';
    public $excerpt = '';
    public $content = '';
    public $featured_image = '';
    public $meta_title = '';
    public $meta_description = '';
    public $is_featured = false;
    public $is_published = true;

    // Category Modal Fields
    public $showCategoryModal = false;
    public $newCategoryName = '';
    public $newCategoryDescription = '';

    public $search = '';

    protected $rules = [
        'blog_category_id' => 'required|exists:blog_categories,id',
        'title'            => 'required|string|max:255',
        'content'          => 'required|string',
    ];

    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    public function openCreateModal()
    {
        $this->reset(['editingBlogId', 'title', 'slug', 'excerpt', 'content', 'featured_image', 'meta_title', 'meta_description', 'is_featured', 'is_published']);
        $firstCat = BlogCategory::first();
        if ($firstCat) {
            $this->blog_category_id = $firstCat->id;
        }
        $this->showModal = true;
    }

    public function editBlog($id)
    {
        $blog = Blog::findOrFail($id);
        $this->editingBlogId = $blog->id;
        $this->blog_category_id = $blog->blog_category_id;
        $this->title = $blog->title;
        $this->slug = $blog->slug;
        $this->excerpt = $blog->excerpt;
        $this->content = $blog->content;
        $this->featured_image = $blog->featured_image;
        $this->meta_title = $blog->meta_title;
        $this->meta_description = $blog->meta_description;
        $this->is_featured = $blog->is_featured;
        $this->is_published = $blog->is_published;
        $this->showModal = true;
    }

    public function saveBlog()
    {
        $this->validate();

        $data = [
            'blog_category_id' => $this->blog_category_id,
            'author_id'        => auth()->id() ?? 1,
            'title'            => $this->title,
            'slug'             => $this->slug ?: Str::slug($this->title),
            'excerpt'          => $this->excerpt,
            'content'          => $this->content,
            'featured_image'   => $this->featured_image,
            'meta_title'       => $this->meta_title,
            'meta_description' => $this->meta_description,
            'is_featured'      => $this->is_featured,
            'is_published'     => $this->is_published,
            'published_at'     => $this->is_published ? now() : null,
        ];

        if ($this->editingBlogId) {
            Blog::findOrFail($this->editingBlogId)->update($data);
            session()->flash('message', 'Blog post updated successfully.');
        } else {
            Blog::create($data);
            session()->flash('message', 'New blog post published successfully.');
        }

        $this->showModal = false;
    }

    public function deleteBlog($id)
    {
        Blog::findOrFail($id)->delete();
        session()->flash('message', 'Blog post deleted successfully.');
    }

    public function saveCategory()
    {
        $this->validate([
            'newCategoryName' => 'required|string|max:255|unique:blog_categories,name',
        ]);

        BlogCategory::create([
            'name'        => $this->newCategoryName,
            'slug'        => Str::slug($this->newCategoryName),
            'description' => $this->newCategoryDescription,
        ]);

        $this->reset(['newCategoryName', 'newCategoryDescription']);
        $this->showCategoryModal = false;
        session()->flash('message', 'New blog category added.');
    }

    public function render()
    {
        $categories = BlogCategory::all();
        $blogs = Blog::with('category', 'author')
            ->where('title', 'like', "%{$this->search}%")
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.blog-manager', compact('blogs', 'categories'))->layout('layouts.admin');
    }
}
