<x-public-layout>
    <x-slot name="title">{{ $blog->title }} | YONBUS Blog</x-slot>

    <!-- Header -->
    <section class="bg-gradient-to-r from-slate-900 via-[#002B8A] to-[#005DFF] text-white py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4">
            <a href="{{ route('blog') }}" class="text-xs font-bold uppercase tracking-wider text-blue-200 hover:text-white inline-flex items-center">
                ← Back to All Articles
            </a>
            <span class="block text-xs font-bold uppercase tracking-widest text-blue-300 bg-white/10 px-3 py-1 rounded-full w-max border border-white/20">
                {{ $blog->category->name }}
            </span>
            <h1 class="text-3xl sm:text-5xl font-extrabold font-heading leading-tight">{{ $blog->title }}</h1>
            <div class="flex items-center space-x-4 text-xs text-blue-200">
                <span>By {{ $blog->author->name ?? 'YONBUS CPA Advisor' }}</span>
                <span>•</span>
                <span>Published {{ $blog->published_at ? $blog->published_at->format('F d, Y') : 'Recently' }}</span>
            </div>
        </div>
    </section>

    <!-- Body -->
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            @if($blog->featured_image)
                <div class="rounded-3xl overflow-hidden shadow-xl max-h-96">
                    <img src="{{ $blog->featured_image }}" alt="{{ $blog->title }}" class="w-full h-full object-cover">
                </div>
            @endif

            <div class="prose prose-slate lg:prose-lg max-w-none text-slate-700 leading-relaxed space-y-6">
                {!! nl2br(e($blog->content)) !!}
            </div>

            <!-- CTA Box -->
            <div class="bg-slate-900 text-white rounded-3xl p-8 sm:p-10 space-y-4 text-center mt-12 shadow-2xl">
                <h3 class="text-2xl font-bold font-heading">Need Personalized Tax Advice for Your Business?</h3>
                <p class="text-slate-300 text-sm max-w-lg mx-auto">Book a 1-on-1 consultation with our senior chartered accountants today.</p>
                <div>
                    <a href="{{ route('book-appointment') }}" class="inline-flex items-center justify-center px-8 py-3.5 rounded-xl bg-[#005DFF] hover:bg-[#002B8A] text-white font-bold text-sm shadow-lg transition">
                        Schedule CPA Consultation
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
