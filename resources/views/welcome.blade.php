<x-public-layout>
    <x-slot name="title">YONBUS Tax & Accounting Services Inc. — Your Partner in Financial Clarity & Growth</x-slot>

    {{-- ============================================================
         HERO SECTION (FULLY RESPONSIVE)
         ============================================================ --}}
    <section class="relative overflow-hidden min-h-[85vh] md:min-h-[90vh] flex items-center bg-[#031B4E]">
        {{-- Background Image with Reliable High-Contrast Directional Fade --}}
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/accounting-hero-bg.jpg') }}?v={{ file_exists(public_path('images/accounting-hero-bg.jpg')) ? filemtime(public_path('images/accounting-hero-bg.jpg')) : time() }}"
                 alt="YONBUS Corporate Office"
                 class="w-full h-full object-cover object-center">

            {{-- Strong Dark Backdrop: dark on left for text contrast, fading smoothly on right to showcase office and skyline --}}
            <div class="absolute inset-0" style="background: linear-gradient(90deg, rgba(3, 19, 48, 0.94) 0%, rgba(3, 19, 48, 0.86) 36%, rgba(3, 19, 48, 0.55) 58%, rgba(3, 19, 48, 0.15) 80%, transparent 100%);"></div>
        </div>

        <div class="relative w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20 md:py-28 z-10">
            <div class="max-w-2xl flex flex-col gap-5 sm:gap-6 md:gap-7" data-aos="fade-right" data-aos-duration="800">

                {{-- Badge --}}
                <div style="width: fit-content; display: inline-flex; align-items: center; gap: 7px; background: rgba(0, 93, 255, 0.85); border: 1.5px solid rgba(255, 255, 255, 0.4); color: #FFFFFF; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.08em; padding: 6px 16px; border-radius: 999px; box-shadow: 0 4px 14px rgba(0, 93, 255, 0.4);">
                    <svg style="width: 14px; height: 14px; color: #FFFFFF; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    <span>TRUSTED BY 5,000+ CANADIAN BUSINESSES</span>
                </div>

                {{-- Main Headline (High Visibility Pure White & Electric Blue with Subtle Text Shadow) --}}
                <h1 class="font-heading font-extrabold tracking-tight text-white text-3xl sm:text-4xl md:text-5xl lg:text-[4.2rem] leading-[1.15] md:leading-[1.12] m-0" style="text-shadow: 0 2px 14px rgba(0, 0, 0, 0.45);">
                    YONBUS Tax &amp;<br>
                    Accounting <span style="color: #4AA1FF; text-shadow: 0 2px 16px rgba(74, 161, 255, 0.35);">Services</span><br>
                    <span style="color: #4AA1FF; text-shadow: 0 2px 16px rgba(74, 161, 255, 0.35);">Inc.</span>
                </h1>

                {{-- Subheadline --}}
                <p class="text-white sm:text-slate-100 text-sm sm:text-base md:text-lg leading-relaxed max-w-xl font-normal m-0" style="text-shadow: 0 1px 8px rgba(0, 0, 0, 0.5);">
                    A trusted partner delivering reliable, efficient, and compliant tax and accounting solutions to individuals, businesses, and organizations across Canada.
                </p>

                {{-- Mission Quote --}}
                <div style="display: flex; align-items: flex-start; gap: 12px; background: rgba(3, 27, 78, 0.70); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border-left: 4px solid #005DFF; border-radius: 0 12px 12px 0; padding: 14px 18px; max-width: 500px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);">
                    <p style="color: #FFFFFF; font-size: 0.95rem; font-style: italic; line-height: 1.6; margin: 0; text-shadow: 0 1px 4px rgba(0, 0, 0, 0.3);">
                        "Your Partner in Financial Clarity and Growth"
                    </p>
                </div>

                {{-- CTA Buttons (Stack on mobile, row on tablet/desktop) --}}
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4 w-full sm:w-auto pt-1">
                    <a href="{{ route('register') }}"
                       class="btn-primary w-full sm:w-auto text-center justify-center text-sm sm:text-base py-3.5 px-6 sm:px-8 font-bold shadow-lg transition-all hover:scale-[1.02]">
                        Get Started Free
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>

                    <a href="{{ route('book-appointment') }}"
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 font-bold text-sm sm:text-base py-3.5 px-5 sm:px-6 rounded-xl transition-all hover:scale-[1.02]"
                       style="background: rgba(3, 27, 78, 0.65); border: 1.5px solid rgba(255, 255, 255, 0.5); color: #FFFFFF; backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Book Consultation
                    </a>
                </div>

                {{-- Social Proof --}}
                <div class="flex items-center gap-3 sm:gap-4 flex-wrap pt-1">
                    <div class="flex items-center">
                        <img src="{{ asset('images/avatars/avatar-1.jpg') }}" alt="Client" class="w-9 h-9 sm:w-10 sm:h-10 rounded-full border-2 border-white object-cover shadow-md">
                        <img src="{{ asset('images/avatars/avatar-2.jpg') }}" alt="Client" class="w-9 h-9 sm:w-10 sm:h-10 rounded-full border-2 border-white object-cover -ml-2.5 shadow-md">
                        <img src="{{ asset('images/avatars/avatar-3.jpg') }}" alt="Client" class="w-9 h-9 sm:w-10 sm:h-10 rounded-full border-2 border-white object-cover -ml-2.5 shadow-md">
                        <img src="{{ asset('images/avatars/avatar-4.jpg') }}" alt="Client" class="w-9 h-9 sm:w-10 sm:h-10 rounded-full border-2 border-white object-cover -ml-2.5 shadow-md">
                    </div>
                    <div>
                        <div class="flex gap-0.5 mb-0.5">
                            @for($i = 0; $i < 5; $i++)
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                        <p class="text-slate-300 text-xs sm:text-sm font-medium m-0">4.9/5 from 500+ reviews</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ============================================================
         STATS BAR (RESPONSIVE)
         ============================================================ --}}
    <section class="relative overflow-hidden bg-white py-10 sm:py-14 border-t-[3px] border-t-[#005DFF] border-b border-slate-200" data-aos="fade-up" data-aos-duration="600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4 md:gap-6">
                @foreach([
                    ['num'=>'5,000+','label'=>'Satisfied Clients','icon'=>'👥'],
                    ['num'=>'10+','label'=>'Years of Expertise','icon'=>'🏆'],
                    ['num'=>'98%','label'=>'Compliance Rate','icon'=>'✅'],
                    ['num'=>'4.9★','label'=>'Client Rating','icon'=>'⭐'],
                ] as $s)
                <div class="bg-[#F5F9FF] border border-slate-200 hover:border-[#005DFF] rounded-2xl p-4 sm:p-5 md:p-6 text-center shadow-sm hover:shadow-md transition-all">
                    <div class="text-xl sm:text-2xl mb-1 sm:mb-2">{{ $s['icon'] }}</div>
                    <div class="font-heading font-extrabold text-xl sm:text-2xl md:text-3xl text-[#031B4E]">{{ $s['num'] }}</div>
                    <div class="text-xs sm:text-sm text-[#005DFF] mt-1 font-semibold">{{ $s['label'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============================================================
         SECTION PREVIEW CARDS (WHAT WE OFFER)
         ============================================================ --}}
    <section class="overflow-hidden" data-aos="fade-up" data-aos-duration="700">
        {{-- Section Header Banner --}}
        <div class="bg-gradient-to-r from-[#031B4E] via-[#063B8F] to-[#005DFF] text-white py-12 sm:py-16 px-4 sm:px-6 text-center">
            <div class="max-w-4xl mx-auto flex flex-col gap-3 sm:gap-4 items-center">
                <span class="text-[10px] sm:text-xs font-extrabold uppercase tracking-widest text-blue-200 bg-white/10 border border-white/20 px-3.5 sm:px-4 py-1.5 rounded-full inline-block">
                    What We Offer
                </span>
                <h2 class="font-heading font-extrabold text-2xl sm:text-3xl md:text-4xl lg:text-5xl text-white leading-tight">
                    Everything Your Business Needs
                </h2>
                <p class="text-blue-100/90 text-sm sm:text-base md:text-lg max-w-xl leading-relaxed">
                    From tax filing to business advisory, YONBUS has you fully covered.
                </p>
            </div>
        </div>

        {{-- Cards Grid Container --}}
        <div class="bg-white py-12 sm:py-16 border-b border-slate-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                    {{-- About Card --}}
                    <a href="{{ route('about') }}" class="group bg-white border-2 border-slate-200 hover:border-[#005DFF] rounded-2xl p-6 sm:p-8 flex flex-col gap-4 text-decoration-none shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all">
                        <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-xl bg-slate-100 border border-slate-300 flex items-center justify-center text-2xl">🏢</div>
                        <div class="flex flex-col gap-2 flex-1">
                            <span class="inline-block bg-slate-100 text-[#005DFF] text-[10px] font-extrabold uppercase tracking-wider px-3 py-1 rounded-full w-fit border border-slate-200">About Us</span>
                            <h3 class="font-heading font-bold text-[#031B4E] text-lg sm:text-xl leading-snug">Who We Are &amp; Our Values</h3>
                            <p class="text-slate-600 text-xs sm:text-sm leading-relaxed flex-1">Learn about YONBUS, our mission, core values (Integrity, Professionalism, Excellence, Client Focus), and our commitment to Canadian clients.</p>
                        </div>
                        <div class="inline-flex items-center gap-1.5 text-[#005DFF] text-sm font-bold mt-auto group-hover:translate-x-1 transition-transform">
                            Learn More <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </div>
                    </a>

                    {{-- Services Card --}}
                    <a href="{{ route('services') }}" class="group bg-white border-2 border-slate-200 hover:border-[#005DFF] rounded-2xl p-6 sm:p-8 flex flex-col gap-4 text-decoration-none shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all">
                        <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-xl bg-slate-100 border border-slate-300 flex items-center justify-center text-2xl">📋</div>
                        <div class="flex flex-col gap-2 flex-1">
                            <span class="inline-block bg-slate-100 text-[#005DFF] text-[10px] font-extrabold uppercase tracking-wider px-3 py-1 rounded-full w-fit border border-slate-200">Our Services</span>
                            <h3 class="font-heading font-bold text-[#031B4E] text-lg sm:text-xl leading-snug">5 Specialized Practice Areas</h3>
                            <p class="text-slate-600 text-xs sm:text-sm leading-relaxed flex-1">Tax Services, Accounting &amp; Bookkeeping, Payroll, Business Advisory, and Compliance — tailored for Canadian businesses.</p>
                        </div>
                        <div class="inline-flex items-center gap-1.5 text-[#005DFF] text-sm font-bold mt-auto group-hover:translate-x-1 transition-transform">
                            View Services <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </div>
                    </a>

                    {{-- Contact Card --}}
                    <a href="{{ route('contact') }}" class="group bg-white border-2 border-slate-200 hover:border-[#005DFF] rounded-2xl p-6 sm:p-8 flex flex-col gap-4 text-decoration-none shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all md:col-span-2 lg:col-span-1">
                        <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-xl bg-slate-100 border border-slate-300 flex items-center justify-center text-2xl">📞</div>
                        <div class="flex flex-col gap-2 flex-1">
                            <span class="inline-block bg-slate-100 text-[#005DFF] text-[10px] font-extrabold uppercase tracking-wider px-3 py-1 rounded-full w-fit border border-slate-200">Get In Touch</span>
                            <h3 class="font-heading font-bold text-[#031B4E] text-lg sm:text-xl leading-snug">Contact Our Team</h3>
                            <p class="text-slate-600 text-xs sm:text-sm leading-relaxed flex-1">Reach our Gatineau office, send a direct message, or book a free consultation — we're here to help.</p>
                        </div>
                        <div class="inline-flex items-center gap-1.5 text-[#005DFF] text-sm font-bold mt-auto group-hover:translate-x-1 transition-transform">
                            Contact Us <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================
         FEATURED BLOG SECTION (INSIGHTS & GUIDES)
         ============================================================ --}}
    <section class="overflow-hidden" data-aos="fade-up" data-aos-duration="700">
        {{-- Section Header Banner --}}
        <div class="bg-gradient-to-r from-[#031B4E] via-[#063B8F] to-[#005DFF] text-white py-12 sm:py-16 px-4 sm:px-6 text-center">
            <div class="max-w-4xl mx-auto flex flex-col gap-3 sm:gap-4 items-center">
                <span class="text-[10px] sm:text-xs font-extrabold uppercase tracking-widest text-blue-200 bg-white/10 border border-white/20 px-3.5 sm:px-4 py-1.5 rounded-full inline-block">
                    Tax &amp; Financial Insights
                </span>
                <h2 class="font-heading font-extrabold text-2xl sm:text-3xl md:text-4xl lg:text-5xl text-white leading-tight">
                    Canadian Tax Tips, Guides &amp; Accounting News
                </h2>
                <p class="text-blue-100/90 text-sm sm:text-base md:text-lg max-w-xl leading-relaxed">
                    Expert articles written by certified CPBs to help your business minimize tax liability.
                </p>
            </div>
        </div>

        {{-- Blog Grid Container --}}
        <div class="bg-[#F8FBFF] py-12 sm:py-16 border-b border-slate-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-end mb-6">
                    <a href="{{ route('blog') }}" class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-bold text-[#005DFF] hover:text-[#031B4E] transition-colors">
                        View All Articles <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                    @if(isset($featuredBlogs) && count($featuredBlogs) > 0)
                        @foreach($featuredBlogs as $blog)
                        <article class="bg-white border-2 border-slate-200 hover:border-[#005DFF] rounded-2xl overflow-hidden flex flex-col shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all">
                            @if($blog->featured_image)
                            <div class="h-44 sm:h-48 overflow-hidden">
                                <img src="{{ $blog->featured_image }}" alt="{{ $blog->title }}" class="w-full h-full object-cover">
                            </div>
                            @endif
                            <div class="p-5 sm:p-6 flex-1 flex flex-col gap-2.5">
                                <div class="text-[11px] text-slate-500 font-semibold">{{ $blog->published_at ? $blog->published_at->format('M d, Y') : 'Recently' }}</div>
                                <h3 class="font-heading font-bold text-[#031B4E] text-base sm:text-lg leading-snug">{{ $blog->title }}</h3>
                                <p class="text-slate-600 text-xs sm:text-sm leading-relaxed flex-1">{{ Str::limit($blog->excerpt, 120) }}</p>
                                <a href="{{ route('blog.show', $blog->slug) }}" class="inline-flex items-center gap-1.5 text-[#005DFF] text-xs sm:text-sm font-bold mt-2">
                                    Read Guide <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </div>
                        </article>
                        @endforeach
                    @else
                        @foreach([
                            ['tag'=>'Tax Filing','date'=>'Aug 01, 2026','title'=>'Top 10 Corporate Tax Deductions for Small Businesses in Canada','excerpt'=>'Discover essential capital cost allowances and deductible business expenses to minimize your tax liability.'],
                            ['tag'=>'Bookkeeping','date'=>'Jul 28, 2026','title'=>'How to Prepare for a CRA Audit with Zero Stress','excerpt'=>'A step-by-step audit preparation roadmap to keep your financial records organized and fully compliant.'],
                            ['tag'=>'Payroll','date'=>'Jul 20, 2026','title'=>'Complete Payroll Automation Guide for Growing Enterprises','excerpt'=>'Streamline monthly employee remittances, T4 slips, and direct deposits with automated payroll systems.'],
                        ] as $post)
                        <article class="bg-white border-2 border-slate-200 hover:border-[#005DFF] rounded-2xl overflow-hidden flex flex-col shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all">
                            <div class="p-5 sm:p-6 flex-1 flex flex-col gap-2.5">
                                <span class="inline-block bg-slate-100 text-[#005DFF] text-[10px] font-extrabold uppercase tracking-wider px-3 py-1 rounded-full w-fit border border-slate-200">{{ $post['tag'] }}</span>
                                <div class="text-[11px] text-slate-500 font-semibold">{{ $post['date'] }}</div>
                                <h3 class="font-heading font-bold text-[#031B4E] text-base sm:text-lg leading-snug">{{ $post['title'] }}</h3>
                                <p class="text-slate-600 text-xs sm:text-sm leading-relaxed flex-1">{{ $post['excerpt'] }}</p>
                                <a href="{{ route('blog') }}" class="inline-flex items-center gap-1.5 text-[#005DFF] text-xs sm:text-sm font-bold mt-2">
                                    Read Guide <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </div>
                        </article>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================
         CTA BANNER (RESPONSIVE)
         ============================================================ --}}
    <section class="relative overflow-hidden py-14 sm:py-20 text-center bg-gradient-to-r from-[#031B4E] via-[#063B8F] to-[#005DFF]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-4 sm:space-y-5">
            <span class="text-[10px] sm:text-xs font-bold uppercase tracking-widest text-blue-200 bg-white/10 px-3.5 sm:px-4 py-1.5 rounded-full border border-white/20 backdrop-blur-md inline-block">
                Get Started Today
            </span>
            <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold text-white font-heading tracking-tight leading-tight">
                Ready to Simplify Your Taxes &amp; Accounting?
            </h2>
            <p class="text-blue-100/90 text-sm sm:text-base md:text-lg max-w-2xl mx-auto font-normal leading-relaxed">
                Join thousands of satisfied Canadian businesses who trust YONBUS for all their financial needs.
            </p>
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-center gap-3 sm:gap-4 pt-4 w-full sm:w-auto max-w-md sm:max-w-none mx-auto">
                <a href="{{ route('register') }}"
                   class="inline-flex items-center justify-center gap-2 bg-white text-[#031B4E] font-bold text-sm sm:text-base py-3.5 px-6 sm:px-8 rounded-xl shadow-lg hover:shadow-2xl hover:-translate-y-0.5 transition-all">
                    Get Started Free
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
                <a href="{{ route('book-appointment') }}"
                   class="inline-flex items-center justify-center gap-2 bg-white/15 hover:bg-white/25 border border-white/35 text-white font-semibold text-sm sm:text-base py-3.5 px-5 sm:px-6 rounded-xl backdrop-blur-md transition-all hover:-translate-y-0.5">
                    Book Consultation
                </a>
            </div>
        </div>
    </section>

</x-public-layout>
