<x-public-layout>
    <x-slot name="title">Tax Tips & Accounting Blog | YONBUS Tax & Accounting Services Inc.</x-slot>

    <!-- Header Banner -->
    <section style="background: linear-gradient(135deg, #002B8A 0%, #0045d8 50%, #0052FF 100%); color: #ffffff; padding: 5rem 0;" data-aos="fade-down">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
            <span class="text-xs font-bold uppercase tracking-widest text-blue-200 bg-white/10 px-3.5 py-1.5 rounded-full border border-white/20">Tax & Financial Insights</span>
            <h1 class="text-4xl sm:text-5xl font-extrabold font-heading">Canadian Tax Tips, Guides & Accounting News</h1>
            <p class="text-blue-100 text-lg max-w-2xl mx-auto font-light">Expert articles written by certified CPBs to help your business minimize tax liability and maintain compliance.</p>
        </div>
    </section>

    <!-- Blog Listing Section -->
    <section class="py-16 bg-slate-50" data-aos="fade-up">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <!-- Search & Filter Bar -->
            <form method="GET" action="{{ route('blog') }}" class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex flex-col md:flex-row gap-4 items-center justify-between" data-aos="fade-up" data-aos-delay="50">
                <div class="w-full md:w-1/2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search articles, tax tips, business registration..." class="w-full rounded-xl border-slate-300 focus:border-[#005DFF] focus:ring-[#005DFF] text-sm">
                </div>
                <div class="w-full md:w-1/3 flex gap-2">
                    <select name="category" class="w-full rounded-xl border-slate-300 focus:border-[#005DFF] focus:ring-[#005DFF] text-sm">
                        <option value="">All Categories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'selected' : '' }}>{{ $cat->name }} ({{ $cat->blogs_count }})</option>
                        @endforeach
                    </select>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#005DFF] text-white font-bold text-sm hover:bg-[#002B8A] transition shrink-0">Filter</button>
                </div>
            </form>

            <!-- Blog Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($blogs as $b)
                    <article class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between group" data-aos="fade-up" data-aos-delay="100">
                        <div>
                            @if($b->featured_image)
                                <div class="h-48 overflow-hidden relative">
                                    <img src="{{ $b->featured_image }}" alt="{{ $b->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    <span class="absolute top-4 left-4 bg-[#005DFF] text-white text-[11px] font-bold uppercase tracking-wider px-3 py-1 rounded-full shadow-md">
                                        {{ $b->category->name }}
                                    </span>
                                </div>
                            @endif
                            <div class="p-6 space-y-3">
                                <div class="text-xs text-slate-400 font-medium">Published {{ $b->published_at ? $b->published_at->format('M d, Y') : 'Recently' }}</div>
                                <h2 class="font-heading font-bold text-xl text-slate-900 group-hover:text-[#005DFF] transition-colors leading-snug">
                                    <a href="{{ route('blog.show', $b->slug) }}">{{ $b->title }}</a>
                                </h2>
                                <p class="text-slate-600 text-sm line-clamp-3 leading-relaxed">{{ $b->excerpt }}</p>
                            </div>
                        </div>
                        <div class="px-6 pb-6 pt-2">
                            <a href="{{ route('blog.show', $b->slug) }}" class="text-xs font-bold text-[#005DFF] group-hover:text-[#002B8A] inline-flex items-center">
                                Read Full Guide →
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-3 text-center py-12 bg-white rounded-2xl border border-slate-200">
                        <p class="text-slate-500 font-medium">No blog articles match your criteria.</p>
                        <a href="{{ route('blog') }}" class="text-[#005DFF] text-sm font-bold mt-2 inline-block">Clear Filters</a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="pt-6">
                {{ $blogs->links() }}
            </div>
        </div>
    </section>
</x-public-layout>
