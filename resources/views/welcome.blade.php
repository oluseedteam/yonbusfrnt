<x-public-layout>
    <x-slot name="title">YONBUS Tax & Accounting Services Inc. — Your Partner in Financial Clarity & Growth</x-slot>

    {{-- ============================================================
         HERO SECTION
         ============================================================ --}}
    <section class="relative overflow-hidden" style="min-height: 90vh; display: flex; align-items: center; background: linear-gradient(135deg, #0f172a 0%, #1E3A8A 50%, #2563EB 100%);">
        {{-- Background Image --}}
        <div class="absolute inset-0" style="z-index: 0;">
            <img src="{{ asset('images/accounting-hero-bg.jpg') }}?v={{ file_exists(public_path('images/accounting-hero-bg.jpg')) ? filemtime(public_path('images/accounting-hero-bg.jpg')) : time() }}"
                 alt="YONBUS Corporate Office"
                 style="width: 100%; height: 100%; object-fit: cover; object-position: center; opacity: 1;">
            <div class="absolute inset-0" style="background: linear-gradient(95deg, rgba(15,23,42,0.92) 0%, rgba(30,58,138,0.78) 45%, rgba(37,99,235,0.45) 80%, rgba(37,99,235,0.15) 100%);"></div>
        </div>

        <div class="relative w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-28" style="z-index: 1;">
            <div class="max-w-2xl" style="display: flex; flex-direction: column; gap: 1.75rem;" data-aos="fade-right" data-aos-duration="800">

                {{-- Badge --}}
                <div class="inline-flex items-center gap-2" style="background: rgba(255,255,255,0.12); border: 1.5px solid rgba(255,255,255,0.28); color: #DBEAFE; padding: 7px 18px; border-radius: 999px; font-size: 11.5px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; width: fit-content; backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);">
                    <svg style="width: 16px; height: 16px; color: #93c5fd; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    <span>TRUSTED BY 5,000+ CANADIAN BUSINESSES</span>
                </div>

                {{-- Main Headline --}}
                <h1 class="font-heading font-extrabold text-white tracking-tight" style="font-size: clamp(2.8rem, 5.6vw, 4.4rem); line-height: 1.12; margin: 0;">
                    YONBUS Tax &amp;<br>
                    Accounting <span style="color: #93c5fd;">Services</span><br>
                    <span style="color: #BFDBFE;">Inc.</span>
                </h1>

                {{-- Subheadline --}}
                <p style="color: rgba(226, 232, 240, 0.95); font-size: clamp(1.05rem, 1.35vw, 1.2rem); line-height: 1.7; max-width: 540px; font-weight: 400; margin: 0;">
                    A trusted partner delivering reliable, efficient, and compliant tax and accounting solutions to individuals, businesses, and organizations across Canada.
                </p>

                {{-- Mission Quote --}}
                <div style="display: flex; align-items: flex-start; gap: 12px; background: rgba(255,255,255,0.08); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border-left: 3px solid #93c5fd; border-radius: 0 12px 12px 0; padding: 14px 18px; max-width: 500px;">
                    <p style="color: #DBEAFE; font-size: 0.95rem; font-style: italic; line-height: 1.6; margin: 0;">
                        "Your Partner in Financial Clarity and Growth"
                    </p>
                </div>

                {{-- CTA Buttons --}}
                <div style="display: flex; flex-wrap: wrap; gap: 14px; align-items: center;">
                    <a href="{{ route('register') }}"
                       style="display: inline-flex; align-items: center; gap: 10px; background: #ffffff; color: #1D4ED8; font-weight: 700; font-size: 1rem; padding: 15px 30px; border-radius: 12px; text-decoration: none; box-shadow: 0 8px 24px rgba(0,0,0,0.2); transition: all 0.2s;"
                       onmouseenter="this.style.background='#EFF6FF'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 12px 32px rgba(0,0,0,0.3)';"
                       onmouseleave="this.style.background='#ffffff'; this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 24px rgba(0,0,0,0.2)';">
                        Get Started Free
                        <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>

                    <a href="{{ route('book-appointment') }}"
                       style="display: inline-flex; align-items: center; gap: 10px; background: rgba(255,255,255,0.12); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border: 1.5px solid rgba(255,255,255,0.35); color: #ffffff; font-weight: 600; font-size: 1rem; padding: 15px 26px; border-radius: 12px; text-decoration: none; transition: all 0.2s;"
                       onmouseenter="this.style.background='rgba(255,255,255,0.22)'; this.style.borderColor='rgba(255,255,255,0.6)';"
                       onmouseleave="this.style.background='rgba(255,255,255,0.12)'; this.style.borderColor='rgba(255,255,255,0.35)';">
                        <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Book Consultation
                    </a>
                </div>

                {{-- Social Proof --}}
                <div style="display: flex; align-items: center; gap: 14px; flex-wrap: wrap;">
                    <div style="display: flex; align-items: center;">
                        <div style="width:36px;height:36px;border-radius:50%;border:2px solid #fff;background:#2563EB;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:11px;box-shadow:0 2px 8px rgba(0,0,0,0.3);">JD</div>
                        <div style="width:36px;height:36px;border-radius:50%;border:2px solid #fff;background:#1D4ED8;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:11px;margin-left:-8px;box-shadow:0 2px 8px rgba(0,0,0,0.3);">SM</div>
                        <div style="width:36px;height:36px;border-radius:50%;border:2px solid #fff;background:#1E40AF;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:11px;margin-left:-8px;box-shadow:0 2px 8px rgba(0,0,0,0.3);">AK</div>
                        <div style="width:36px;height:36px;border-radius:50%;border:2px solid #fff;background:#3B82F6;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:11px;margin-left:-8px;box-shadow:0 2px 8px rgba(0,0,0,0.3);">LO</div>
                    </div>
                    <div>
                        <div style="display: flex; gap: 2px; margin-bottom: 2px;">
                            @for($i = 0; $i < 5; $i++)
                            <svg style="width: 14px; height: 14px; color: #fbbf24;" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                        <p style="color: rgba(226,232,240,0.85); font-size: 0.8rem; margin: 0; font-weight: 500;">4.9/5 from 500+ reviews</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ============================================================
         STATS BAR
         ============================================================ --}}
    <section style="position: relative; overflow: hidden; background: #ffffff; padding: 3.5rem 0; border-top: 3px solid #2563EB; border-bottom: 1px solid #DBEAFE;" data-aos="fade-up" data-aos-duration="600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="position:relative;z-index:1;">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach([
                    ['num'=>'5,000+','label'=>'Satisfied Clients','icon'=>'👥'],
                    ['num'=>'10+','label'=>'Years of Expertise','icon'=>'🏆'],
                    ['num'=>'98%','label'=>'Compliance Rate','icon'=>'✅'],
                    ['num'=>'4.9★','label'=>'Client Rating','icon'=>'⭐'],
                ] as $s)
                <div class="hover-scale" style="background:#EFF6FF;border:1.5px solid #BFDBFE;border-radius:16px;padding:22px 16px;text-align:center;box-shadow:0 4px 20px rgba(37,99,235,0.08);">
                    <div style="font-size:1.4rem;margin-bottom:6px;">{{ $s['icon'] }}</div>
                    <div class="font-heading font-extrabold" style="font-size:1.8rem;color:#1E3A8A;">{{ $s['num'] }}</div>
                    <div style="font-size:0.8rem;color:#1D4ED8;margin-top:4px;font-weight:600;">{{ $s['label'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============================================================
         SECTION PREVIEW CARDS (WHAT WE OFFER)
         ============================================================ --}}
    <section class="overflow-hidden" data-aos="fade-up" data-aos-duration="700">
        {{-- Section Header Banner with Rich Gradient --}}
        <div class="bg-gradient-to-r from-slate-900 via-[#1E3A8A] to-[#2563EB] text-white py-16 sm:py-20 text-center px-4 sm:px-6 lg:px-8 relative">
            <div class="max-w-4xl mx-auto space-y-4">
                <span class="text-xs font-bold uppercase tracking-widest text-blue-200 bg-white/10 px-4 py-1.5 rounded-full border border-white/20 backdrop-blur-md inline-block">
                    What We Offer
                </span>
                <h2 class="text-3xl sm:text-5xl font-extrabold text-white font-heading tracking-tight">
                    Everything Your Business Needs
                </h2>
                <p class="text-blue-100/90 text-base sm:text-lg max-w-2xl mx-auto font-normal leading-relaxed">
                    From tax filing to business advisory, YONBUS has you fully covered.
                </p>
            </div>
        </div>

        {{-- Cards Grid Container (White surface) --}}
        <div class="bg-white py-14 sm:py-16 border-b border-blue-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    {{-- About Card --}}
                    <a href="{{ route('about') }}" class="hover-lift" style="background:#ffffff;border:2px solid #DBEAFE;border-radius:20px;padding:32px 28px;display:flex;flex-direction:column;gap:16px;text-decoration:none;box-shadow:0 6px 24px rgba(37,99,235,0.08);transition:all 0.25s;"
                       onmouseenter="this.style.borderColor='#2563EB';this.style.boxShadow='0 16px 36px rgba(37,99,235,0.18)';this.style.transform='translateY(-4px)';"
                       onmouseleave="this.style.borderColor='#DBEAFE';this.style.boxShadow='0 6px 24px rgba(37,99,235,0.08)';this.style.transform='translateY(0)';">
                        <div style="width:54px;height:54px;border-radius:14px;background:#EFF6FF;border:2px solid #BFDBFE;display:flex;align-items:center;justify-content:center;font-size:1.5rem;">🏢</div>
                        <div style="display:flex;flex-direction:column;gap:8px;flex:1;">
                            <span style="display:inline-block;background:#EFF6FF;color:#2563EB;font-size:10px;font-weight:800;text-transform:uppercase;letter-spacing:0.05em;padding:4px 12px;border-radius:999px;width:fit-content;border:1.5px solid #BFDBFE;">About Us</span>
                            <h3 class="font-heading font-bold" style="color:#1E3A8A;font-size:1.2rem;line-height:1.4;">Who We Are &amp; Our Values</h3>
                            <p style="color:#475569;font-size:0.88rem;line-height:1.65;flex:1;">Learn about YONBUS, our mission, core values (Integrity, Professionalism, Excellence, Client Focus), and our commitment to Canadian clients.</p>
                        </div>
                        <div style="display:inline-flex;align-items:center;gap:6px;color:#2563EB;font-size:0.88rem;font-weight:700;margin-top:auto;">
                            Learn More <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </div>
                    </a>

                    {{-- Services Card --}}
                    <a href="{{ route('services') }}" class="hover-lift" style="background:#ffffff;border:2px solid #DBEAFE;border-radius:20px;padding:32px 28px;display:flex;flex-direction:column;gap:16px;text-decoration:none;box-shadow:0 6px 24px rgba(37,99,235,0.08);transition:all 0.25s;"
                       onmouseenter="this.style.borderColor='#2563EB';this.style.boxShadow='0 16px 36px rgba(37,99,235,0.18)';this.style.transform='translateY(-4px)';"
                       onmouseleave="this.style.borderColor='#DBEAFE';this.style.boxShadow='0 6px 24px rgba(37,99,235,0.08)';this.style.transform='translateY(0)';">
                        <div style="width:54px;height:54px;border-radius:14px;background:#EFF6FF;border:2px solid #BFDBFE;display:flex;align-items:center;justify-content:center;font-size:1.5rem;">📋</div>
                        <div style="display:flex;flex-direction:column;gap:8px;flex:1;">
                            <span style="display:inline-block;background:#EFF6FF;color:#2563EB;font-size:10px;font-weight:800;text-transform:uppercase;letter-spacing:0.05em;padding:4px 12px;border-radius:999px;width:fit-content;border:1.5px solid #BFDBFE;">Our Services</span>
                            <h3 class="font-heading font-bold" style="color:#1E3A8A;font-size:1.2rem;line-height:1.4;">5 Specialized Practice Areas</h3>
                            <p style="color:#475569;font-size:0.88rem;line-height:1.65;flex:1;">Tax Services, Accounting &amp; Bookkeeping, Payroll, Business Advisory, and Compliance — tailored for Canadian businesses.</p>
                        </div>
                        <div style="display:inline-flex;align-items:center;gap:6px;color:#2563EB;font-size:0.88rem;font-weight:700;margin-top:auto;">
                            View Services <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </div>
                    </a>

                    {{-- Contact Card --}}
                    <a href="{{ route('contact') }}" class="hover-lift" style="background:#ffffff;border:2px solid #DBEAFE;border-radius:20px;padding:32px 28px;display:flex;flex-direction:column;gap:16px;text-decoration:none;box-shadow:0 6px 24px rgba(37,99,235,0.08);transition:all 0.25s;"
                       onmouseenter="this.style.borderColor='#2563EB';this.style.boxShadow='0 16px 36px rgba(37,99,235,0.18)';this.style.transform='translateY(-4px)';"
                       onmouseleave="this.style.borderColor='#DBEAFE';this.style.boxShadow='0 6px 24px rgba(37,99,235,0.08)';this.style.transform='translateY(0)';">
                        <div style="width:54px;height:54px;border-radius:14px;background:#EFF6FF;border:2px solid #BFDBFE;display:flex;align-items:center;justify-content:center;font-size:1.5rem;">📞</div>
                        <div style="display:flex;flex-direction:column;gap:8px;flex:1;">
                            <span style="display:inline-block;background:#EFF6FF;color:#2563EB;font-size:10px;font-weight:800;text-transform:uppercase;letter-spacing:0.05em;padding:4px 12px;border-radius:999px;width:fit-content;border:1.5px solid #BFDBFE;">Get In Touch</span>
                            <h3 class="font-heading font-bold" style="color:#1E3A8A;font-size:1.2rem;line-height:1.4;">Contact Our Team</h3>
                            <p style="color:#475569;font-size:0.88rem;line-height:1.65;flex:1;">Reach our Gatineau office, send a direct message, or book a free consultation — we're here to help.</p>
                        </div>
                        <div style="display:inline-flex;align-items:center;gap:6px;color:#2563EB;font-size:0.88rem;font-weight:700;margin-top:auto;">
                            Contact Us <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
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
        {{-- Section Header Banner with Rich Gradient matching user screenshot --}}
        <div class="bg-gradient-to-r from-slate-900 via-[#1E3A8A] to-[#2563EB] text-white py-16 sm:py-20 text-center px-4 sm:px-6 lg:px-8 relative">
            <div class="max-w-4xl mx-auto space-y-4">
                <span class="text-xs font-bold uppercase tracking-widest text-blue-200 bg-white/10 px-4 py-1.5 rounded-full border border-white/20 backdrop-blur-md inline-block">
                    Tax &amp; Financial Insights
                </span>
                <h2 class="text-3xl sm:text-5xl font-extrabold text-white font-heading tracking-tight">
                    Canadian Tax Tips, Guides &amp; Accounting News
                </h2>
                <p class="text-blue-100/90 text-base sm:text-lg max-w-2xl mx-auto font-normal leading-relaxed">
                    Expert articles written by certified CPBs to help your business minimize tax liability and maintain compliance.
                </p>
            </div>
        </div>

        {{-- Blog Grid Container (Light blue/white surface) --}}
        <div class="bg-[#F8FAFC] py-14 sm:py-16 border-b border-blue-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-end mb-6">
                    <a href="{{ route('blog') }}" class="inline-flex items-center gap-2 text-sm font-bold text-[#2563EB] hover:text-[#1E3A8A] transition-colors">
                        View All Articles <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @if(isset($featuredBlogs) && count($featuredBlogs) > 0)
                        @foreach($featuredBlogs as $blog)
                        <article style="background:#ffffff;border:2px solid #DBEAFE;border-radius:20px;overflow:hidden;display:flex;flex-direction:column;box-shadow:0 6px 24px rgba(37,99,235,0.08);transition:all 0.25s;"
                                 onmouseenter="this.style.borderColor='#2563EB';this.style.boxShadow='0 16px 36px rgba(37,99,235,0.18)';this.style.transform='translateY(-4px)';"
                                 onmouseleave="this.style.borderColor='#DBEAFE';this.style.boxShadow='0 6px 24px rgba(37,99,235,0.08)';this.style.transform='translateY(0)';">
                            @if($blog->featured_image)
                            <div style="height:190px;overflow:hidden;">
                                <img src="{{ $blog->featured_image }}" alt="{{ $blog->title }}" style="width:100%;height:100%;object-fit:cover;">
                            </div>
                            @endif
                            <div style="padding:26px;flex:1;display:flex;flex-direction:column;gap:10px;">
                                <div style="font-size:11px;color:#64748b;font-weight:600;">{{ $blog->published_at ? $blog->published_at->format('M d, Y') : 'Recently' }}</div>
                                <h3 class="font-heading font-bold" style="color:#1E3A8A;font-size:1.1rem;line-height:1.45;">{{ $blog->title }}</h3>
                                <p style="color:#475569;font-size:0.88rem;line-height:1.65;flex:1;">{{ Str::limit($blog->excerpt, 120) }}</p>
                                <a href="{{ route('blog.show', $blog->slug) }}" style="display:inline-flex;align-items:center;gap:6px;color:#2563EB;font-size:0.85rem;font-weight:700;text-decoration:none;margin-top:10px;">
                                    Read Guide <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
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
                        <article style="background:#ffffff;border:2px solid #DBEAFE;border-radius:20px;overflow:hidden;display:flex;flex-direction:column;box-shadow:0 6px 24px rgba(37,99,235,0.08);transition:all 0.25s;"
                                 onmouseenter="this.style.borderColor='#2563EB';this.style.boxShadow='0 16px 36px rgba(37,99,235,0.18)';this.style.transform='translateY(-4px)';"
                                 onmouseleave="this.style.borderColor='#DBEAFE';this.style.boxShadow='0 6px 24px rgba(37,99,235,0.08)';this.style.transform='translateY(0)';">
                            <div style="padding:26px;flex:1;display:flex;flex-direction:column;gap:10px;">
                                <span style="display:inline-block;background:#EFF6FF;color:#2563EB;font-size:10px;font-weight:800;text-transform:uppercase;letter-spacing:0.05em;padding:4px 12px;border-radius:999px;width:fit-content;border:1.5px solid #BFDBFE;">{{ $post['tag'] }}</span>
                                <div style="font-size:11px;color:#64748b;font-weight:600;">{{ $post['date'] }}</div>
                                <h3 class="font-heading font-bold" style="color:#1E3A8A;font-size:1.1rem;line-height:1.45;">{{ $post['title'] }}</h3>
                                <p style="color:#475569;font-size:0.88rem;line-height:1.65;flex:1;">{{ $post['excerpt'] }}</p>
                                <a href="{{ route('blog') }}" style="display:inline-flex;align-items:center;gap:6px;color:#2563EB;font-size:0.85rem;font-weight:700;text-decoration:none;margin-top:10px;">
                                    Read Guide <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
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
         CTA BANNER
         ============================================================ --}}
    <section class="relative overflow-hidden py-16 sm:py-20 text-center" style="background:linear-gradient(135deg, #0f172a 0%, #1E3A8A 50%, #2563EB 100%);">
        <div style="position:absolute;top:-80px;left:50%;transform:translateX(-50%);width:500px;height:300px;background:radial-gradient(ellipse,rgba(255,255,255,0.12) 0%,transparent 70%);pointer-events:none;"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-4">
            <span class="text-xs font-bold uppercase tracking-widest text-blue-200 bg-white/10 px-4 py-1.5 rounded-full border border-white/20 backdrop-blur-md inline-block">
                Get Started Today
            </span>
            <h2 class="text-3xl sm:text-5xl font-extrabold text-white font-heading tracking-tight">
                Ready to Simplify Your Taxes &amp; Accounting?
            </h2>
            <p class="text-blue-100/90 text-base sm:text-lg max-w-2xl mx-auto font-normal leading-relaxed">
                Join thousands of satisfied Canadian businesses who trust YONBUS for all their financial needs.
            </p>
            <div style="display:flex;flex-wrap:wrap;gap:1rem;justify-content:center;padding-top:1rem;">
                <a href="{{ route('register') }}"
                   style="display:inline-flex;align-items:center;gap:8px;background:#ffffff;color:#1D4ED8;font-weight:700;font-size:0.95rem;padding:14px 30px;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,0.2);text-decoration:none;transition:all 0.2s;"
                   onmouseenter="this.style.boxShadow='0 12px 32px rgba(0,0,0,0.3)';this.style.transform='translateY(-2px)';"
                   onmouseleave="this.style.boxShadow='0 8px 24px rgba(0,0,0,0.2)';this.style.transform='translateY(0)';">
                    Get Started Free
                    <svg style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
                <a href="{{ route('book-appointment') }}"
                   style="display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,0.12);backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);border:1.5px solid rgba(255,255,255,0.35);color:#ffffff;font-weight:600;font-size:0.95rem;padding:14px 26px;border-radius:12px;text-decoration:none;transition:all 0.2s;"
                   onmouseenter="this.style.background='rgba(255,255,255,0.22)';"
                   onmouseleave="this.style.background='rgba(255,255,255,0.12)';">
                    Book Consultation
                </a>
            </div>
        </div>
    </section>

</x-public-layout>
