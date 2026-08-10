<x-public-layout>
    <x-slot name="title">YONBUS Tax & Accounting Services Inc. — Your Partner in Financial Clarity & Growth</x-slot>

    {{-- ============================================================
         HERO — Dark navy background with strong overlay on image
         ============================================================ --}}
    <section class="relative overflow-hidden" style="min-height: 88vh; display: flex; align-items: center; background: #020B24;">
        {{-- Background Image with full vibrant clarity & directional overlay --}}
        <div class="absolute inset-0" style="z-index: 0;">
            <img src="{{ asset('images/accounting-hero-bg.jpg') }}"
                 alt="YONBUS Office"
                 style="width: 100%; height: 100%; object-fit: cover; object-position: center; opacity: 0.95;">
            <div class="absolute inset-0" style="background: linear-gradient(105deg, rgba(2,11,36,0.94) 0%, rgba(2,11,36,0.80) 38%, rgba(2,11,36,0.32) 72%, rgba(2,11,36,0.55) 100%);"></div>
        </div>

        <div class="relative w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 sm:py-32" style="z-index: 1;">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">

                {{-- LEFT: Headline & CTAs --}}
                <div style="display: flex; flex-direction: column; gap: 1.5rem;" data-aos="fade-right" data-aos-duration="800">

                    {{-- Badge --}}
                    <div class="inline-flex items-center gap-2 animate-glow" style="background: rgba(0,82,255,0.28); border: 1px solid rgba(77,139,255,0.5); color: #93c5fd; backdrop-filter: blur(8px); padding: 8px 16px; border-radius: 999px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.06em; width: fit-content;">
                        <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                        Trusted by 5,000+ Canadian Businesses
                    </div>

                    {{-- Main Headline --}}
                    <h1 class="font-heading font-extrabold" style="color: #ffffff; font-size: clamp(2.2rem, 5vw, 3.6rem); line-height: 1.08; letter-spacing: -0.02em; text-shadow: 0 4px 16px rgba(0,0,0,0.6);">
                        YONBUS Tax &<br>
                        Accounting <span style="color: #60a5fa;">Services Inc.</span>
                    </h1>

                    {{-- Subheadline --}}
                    <p style="color: #e2e8f0; font-size: 1.05rem; line-height: 1.75; max-width: 520px; text-shadow: 0 2px 8px rgba(0,0,0,0.5);">
                        A trusted partner delivering reliable, efficient, and compliant tax and accounting solutions to individuals, businesses, and organizations across Canada.
                    </p>

                    {{-- Slogan box --}}
                    <div style="border-left: 4px solid #0052ff; background: rgba(2,11,36,0.65); backdrop-filter: blur(10px); border-radius: 0 12px 12px 0; padding: 14px 18px; border-top: 1px solid rgba(255,255,255,0.1); border-right: 1px solid rgba(255,255,255,0.1); border-bottom: 1px solid rgba(255,255,255,0.1);" class="hover-lift">
                        <p style="color: #bfdbfe; font-size: 0.9rem; font-style: italic;">
                            "Your Partner in Financial Clarity and Growth"
                        </p>
                    </div>

                    {{-- CTA Buttons --}}
                    <div style="display: flex; flex-wrap: wrap; gap: 1rem; padding-top: 0.25rem;">
                        <a href="{{ route('register') }}"
                           class="hover-lift hover-glow-blue"
                           style="display: inline-flex; align-items: center; gap: 8px; background: #0052ff; color: #ffffff; font-weight: 700; font-size: 0.95rem; padding: 14px 28px; border-radius: 12px; box-shadow: 0 8px 24px rgba(0,82,255,0.45); text-decoration: none;">
                            Get Started Free
                            <svg style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                        <a href="{{ route('book-appointment') }}"
                           class="hover-lift"
                           style="display: inline-flex; align-items: center; gap: 8px; background: rgba(2,11,36,0.5); backdrop-filter: blur(8px); border: 1.5px solid rgba(255,255,255,0.35); color: #ffffff; font-weight: 600; font-size: 0.95rem; padding: 14px 26px; border-radius: 12px; text-decoration: none;">
                            <svg style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Book Consultation
                        </a>
                    </div>

                    {{-- Social Proof --}}
                    <div style="display: flex; align-items: center; gap: 1rem; padding-top: 0.5rem; border-top: 1px solid rgba(255,255,255,0.15);">
                        <div style="display: flex; margin-right: 4px;">
                            @foreach(['photo-1534528741775-53994a69daeb','photo-1507003211169-0a1dd7228f2d','photo-1500648767791-00dcc994a43e','photo-1573496359142-b8d87734a5a2'] as $p)
                            <img src="https://images.unsplash.com/{{ $p }}?auto=format&fit=crop&w=80&q=80"
                                 style="width:34px;height:34px;border-radius:999px;object-fit:cover;margin-left:-8px;border:2px solid #020B24;">
                            @endforeach
                        </div>
                        <div>
                            <div style="display:flex;gap:2px;color:#fbbf24;">
                                @for($i=0;$i<5;$i++)<svg style="width:14px;height:14px;" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>@endfor
                            </div>
                            <div style="font-size:0.8rem;font-weight:600;color:#ffffff;margin-top:2px;">4.9/5 <span style="color:#cbd5e1;font-weight:400;">from 500+ reviews</span></div>
                        </div>
                    </div>
                </div>

                {{-- RIGHT: 4 KPI Cards (desktop only) with Glassmorphism --}}
                <div class="hidden lg:grid" style="grid-template-columns: 1fr 1fr; gap: 1rem;" data-aos="fade-left" data-aos-duration="800">
                    @foreach([
                        ['bg'=>'rgba(2,11,36,0.60)','bc'=>'rgba(16,185,129,0.35)','ic'=>'rgba(16,185,129,0.25)','icc'=>'#34d399','path'=>'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6','label'=>'Tax Savings','value'=>'$125,430','sub'=>'▲ 12.5% this quarter','sc'=>'#34d399'],
                        ['bg'=>'rgba(2,11,36,0.60)','bc'=>'rgba(0,82,255,0.35)','ic'=>'rgba(0,82,255,0.25)','icc'=>'#60a5fa','path'=>'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z','label'=>'CRA Tax Return','value'=>'✓ 2024 Filed','sub'=>'Successfully verified','sc'=>'#34d399'],
                        ['bg'=>'rgba(2,11,36,0.60)','bc'=>'rgba(251,191,36,0.35)','ic'=>'rgba(251,191,36,0.25)','icc'=>'#fbbf24','path'=>'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z','label'=>'Next Appointment','value'=>'Aug 12, 2026','sub'=>'10:00 AM · Confirmed','sc'=>'#cbd5e1'],
                        ['bg'=>'rgba(2,11,36,0.60)','bc'=>'rgba(0,82,255,0.4)','ic'=>'rgba(0,82,255,0.3)','icc'=>'#93c5fd','path'=>'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z','label'=>'Active Clients','value'=>'5,000+','sub'=>'Across Canada','sc'=>'#93c5fd'],
                    ] as $card)
                    <div class="hover-lift hover-glow-blue" style="background:{{ $card['bg'] }};backdrop-filter:blur(12px);-webkit-backdrop-filter:blur(12px);border:1px solid {{ $card['bc'] }};border-radius:16px;padding:20px 16px;display:flex;flex-direction:column;gap:10px;box-shadow:0 8px 32px rgba(0,0,0,0.35);">
                        <div style="width:44px;height:44px;border-radius:12px;background:{{ $card['ic'] }};display:flex;align-items:center;justify-content:center;">
                            <svg style="width:22px;height:22px;color:{{ $card['icc'] }};" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $card['path'] }}"/></svg>
                        </div>
                        <div>
                            <div style="font-size:11px;color:#cbd5e1;font-weight:500;">{{ $card['label'] }}</div>
                            <div style="font-size:1.1rem;font-weight:800;color:#ffffff;margin-top:2px;">{{ $card['value'] }}</div>
                            <div style="font-size:11px;color:{{ $card['sc'] }};margin-top:2px;">{{ $card['sub'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
    </section>

    {{-- ============================================================
         STATS BAR
         ============================================================ --}}
    {{-- Stats Bar --}}
    <section style="position: relative; overflow: hidden; background: linear-gradient(135deg, #010d24 0%, #020c22 100%); padding: 3rem 0; border-top: 1px solid rgba(255,255,255,0.07); border-bottom: 1px solid rgba(255,255,255,0.07);" data-aos="fade-up" data-aos-duration="600">
        <div style="position:absolute;top:-60px;left:-60px;width:260px;height:260px;background:radial-gradient(circle,rgba(0,82,255,0.22) 0%,transparent 70%);border-radius:50%;pointer-events:none;"></div>
        <div style="position:absolute;bottom:-60px;right:-40px;width:220px;height:220px;background:radial-gradient(circle,rgba(0,43,138,0.28) 0%,transparent 70%);border-radius:50%;pointer-events:none;"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="position:relative;z-index:1;">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach([
                    ['num'=>'5,000+','label'=>'Satisfied Clients','icon'=>'👥'],
                    ['num'=>'10+','label'=>'Years of Expertise','icon'=>'🏆'],
                    ['num'=>'98%','label'=>'CRA Compliance Rate','icon'=>'✅'],
                    ['num'=>'4.9★','label'=>'Client Rating','icon'=>'⭐'],
                ] as $s)
                <div class="hover-scale" style="background:rgba(255,255,255,0.05);backdrop-filter:blur(12px);-webkit-backdrop-filter:blur(12px);border:1px solid rgba(255,255,255,0.1);border-radius:16px;padding:20px 16px;text-align:center;">
                    <div style="font-size:1.3rem;margin-bottom:6px;">{{ $s['icon'] }}</div>
                    <div class="font-heading font-extrabold" style="font-size:1.8rem;color:#ffffff;">{{ $s['num'] }}</div>
                    <div style="font-size:0.78rem;color:rgba(148,163,184,0.85);margin-top:4px;font-weight:500;">{{ $s['label'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============================================================
         SECTION PREVIEW CARDS — link to individual pages
         ============================================================ --}}
    {{-- Section Preview Cards --}}
    <section style="position:relative;overflow:hidden;background:linear-gradient(160deg,#010d24 0%,#020c22 50%,#010818 100%);padding:5rem 0;" data-aos="fade-up" data-aos-duration="700">
        <div style="position:absolute;top:-80px;right:-60px;width:350px;height:350px;background:radial-gradient(circle,rgba(0,82,255,0.18) 0%,transparent 70%);border-radius:50%;pointer-events:none;"></div>
        <div style="position:absolute;bottom:-60px;left:-40px;width:280px;height:280px;background:radial-gradient(circle,rgba(0,43,138,0.2) 0%,transparent 70%);border-radius:50%;pointer-events:none;"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="position:relative;z-index:1;">
            <div class="text-center" style="margin-bottom: 3rem;">
                <span style="font-size:11px;font-weight:800;color:#60a5fa;text-transform:uppercase;letter-spacing:0.08em;">What We Offer</span>
                <h2 class="font-heading font-extrabold" style="font-size:clamp(1.8rem,4vw,2.5rem);color:#ffffff;margin-top:8px;">Everything Your Business Needs</h2>
                <p style="color:rgba(148,163,184,0.85);font-size:1rem;margin-top:10px;max-width:560px;margin-left:auto;margin-right:auto;">From tax filing to business advisory, YONBUS has you fully covered.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- About Card --}}
                <a href="{{ route('about') }}" class="hover-lift" style="background:rgba(255,255,255,0.06);backdrop-filter:blur(14px);-webkit-backdrop-filter:blur(14px);border:1px solid rgba(255,255,255,0.12);border-radius:20px;padding:32px 28px;display:flex;flex-direction:column;gap:16px;text-decoration:none;transition:all 0.25s;"
                   onmouseenter="this.style.background='rgba(255,255,255,0.10)';this.style.borderColor='rgba(0,82,255,0.5)';this.style.boxShadow='0 12px 40px rgba(0,82,255,0.2)';"
                   onmouseleave="this.style.background='rgba(255,255,255,0.06)';this.style.borderColor='rgba(255,255,255,0.12)';this.style.boxShadow='none';">
                    <div style="width:52px;height:52px;border-radius:14px;background:rgba(0,82,255,0.25);border:1px solid rgba(0,82,255,0.35);display:flex;align-items:center;justify-content:center;font-size:1.5rem;">🏢</div>
                    <div>
                        <div style="font-size:11px;font-weight:800;color:#60a5fa;text-transform:uppercase;letter-spacing:0.06em;margin-bottom:6px;">About Us</div>
                        <h3 class="font-heading font-bold" style="color:#ffffff;font-size:1.15rem;margin-bottom:8px;">Who We Are &amp; Our Values</h3>
                        <p style="color:rgba(148,163,184,0.85);font-size:0.87rem;line-height:1.65;">Learn about YONBUS, our mission, core values (Integrity, Professionalism, Excellence, Client Focus), and our commitment to Canadian clients.</p>
                    </div>
                    <div style="display:inline-flex;align-items:center;gap:6px;color:#60a5fa;font-size:0.85rem;font-weight:700;">
                        Learn More <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </div>
                </a>

                {{-- Services Card (highlighted) --}}
                <a href="{{ route('services') }}" class="hover-lift" style="background:rgba(0,82,255,0.25);backdrop-filter:blur(14px);-webkit-backdrop-filter:blur(14px);border:1px solid rgba(0,82,255,0.5);border-radius:20px;padding:32px 28px;display:flex;flex-direction:column;gap:16px;text-decoration:none;box-shadow:0 8px 32px rgba(0,82,255,0.25);transition:all 0.25s;"
                   onmouseenter="this.style.background='rgba(0,82,255,0.35)';this.style.boxShadow='0 16px 48px rgba(0,82,255,0.4)';"
                   onmouseleave="this.style.background='rgba(0,82,255,0.25)';this.style.boxShadow='0 8px 32px rgba(0,82,255,0.25)';">
                    <div style="width:52px;height:52px;border-radius:14px;background:rgba(255,255,255,0.2);display:flex;align-items:center;justify-content:center;font-size:1.5rem;">📋</div>
                    <div>
                        <div style="font-size:11px;font-weight:800;color:#bfdbfe;text-transform:uppercase;letter-spacing:0.06em;margin-bottom:6px;">Our Services</div>
                        <h3 class="font-heading font-bold" style="color:#ffffff;font-size:1.15rem;margin-bottom:8px;">5 Specialized Practice Areas</h3>
                        <p style="color:#bfdbfe;font-size:0.87rem;line-height:1.65;">Tax Services, Accounting &amp; Bookkeeping, Payroll, Business Advisory, and Compliance — tailored for Canadian businesses.</p>
                    </div>
                    <div style="display:inline-flex;align-items:center;gap:6px;color:#ffffff;font-size:0.85rem;font-weight:700;">
                        View Services <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </div>
                </a>

                {{-- Contact Card --}}
                <a href="{{ route('contact') }}" class="hover-lift" style="background:rgba(255,255,255,0.06);backdrop-filter:blur(14px);-webkit-backdrop-filter:blur(14px);border:1px solid rgba(255,255,255,0.12);border-radius:20px;padding:32px 28px;display:flex;flex-direction:column;gap:16px;text-decoration:none;transition:all 0.25s;"
                   onmouseenter="this.style.background='rgba(255,255,255,0.10)';this.style.borderColor='rgba(0,82,255,0.5)';this.style.boxShadow='0 12px 40px rgba(0,82,255,0.2)';"
                   onmouseleave="this.style.background='rgba(255,255,255,0.06)';this.style.borderColor='rgba(255,255,255,0.12)';this.style.boxShadow='none';">
                    <div style="width:52px;height:52px;border-radius:14px;background:rgba(0,82,255,0.25);border:1px solid rgba(0,82,255,0.35);display:flex;align-items:center;justify-content:center;font-size:1.5rem;">📞</div>
                    <div>
                        <div style="font-size:11px;font-weight:800;color:#60a5fa;text-transform:uppercase;letter-spacing:0.06em;margin-bottom:6px;">Get In Touch</div>
                        <h3 class="font-heading font-bold" style="color:#ffffff;font-size:1.15rem;margin-bottom:8px;">Contact Our Team</h3>
                        <p style="color:rgba(148,163,184,0.85);font-size:0.87rem;line-height:1.65;">Reach our Gatineau office, send a direct message, or book a free consultation — we're here to help.</p>
                    </div>
                    <div style="display:inline-flex;align-items:center;gap:6px;color:#60a5fa;font-size:0.85rem;font-weight:700;">
                        Contact Us <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </div>
                </a>
            </div>
        </div>
    </section>

    {{-- ============================================================
         FEATURED BLOG SECTION
         ============================================================ --}}
    {{-- Blog Section --}}
    <section style="background: #f8faff; padding: 5rem 0;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div style="display:flex;flex-wrap:wrap;align-items:flex-end;justify-content:space-between;gap:1rem;margin-bottom:2.5rem;">
                <div>
                    <span style="font-size:11px;font-weight:800;color:#0052ff;text-transform:uppercase;letter-spacing:0.08em;">Insights & Guides</span>
                    <h2 class="font-heading font-extrabold" style="font-size:clamp(1.6rem,3vw,2.2rem);color:#0a1a4a;margin-top:6px;">Tax Tips & Blog Posts</h2>
                </div>
                <a href="{{ route('blog') }}" style="display:inline-flex;align-items:center;gap:6px;color:#0052ff;font-size:0.87rem;font-weight:700;text-decoration:none;">
                    View All Articles <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @if(isset($featuredBlogs) && count($featuredBlogs) > 0)
                    @foreach($featuredBlogs as $blog)
                    <article style="background:#f8faff;border:1.5px solid #e0e7ff;border-radius:16px;overflow:hidden;display:flex;flex-direction:column;">
                        @if($blog->featured_image)
                        <div style="height:180px;overflow:hidden;">
                            <img src="{{ $blog->featured_image }}" alt="{{ $blog->title }}" style="width:100%;height:100%;object-fit:cover;">
                        </div>
                        @endif
                        <div style="padding:24px;flex:1;display:flex;flex-direction:column;gap:8px;">
                            <div style="font-size:11px;color:#9ca3af;font-weight:500;">{{ $blog->published_at ? $blog->published_at->format('M d, Y') : 'Recently' }}</div>
                            <h3 class="font-heading font-bold" style="color:#0a1a4a;font-size:1rem;line-height:1.45;">{{ $blog->title }}</h3>
                            <p style="color:#4b5563;font-size:0.85rem;line-height:1.6;flex:1;">{{ Str::limit($blog->excerpt, 120) }}</p>
                            <a href="{{ route('blog.show', $blog->slug) }}" style="display:inline-flex;align-items:center;gap:5px;color:#0052ff;font-size:0.8rem;font-weight:700;text-decoration:none;margin-top:8px;">
                                Read Guide <svg style="width:12px;height:12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
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
                    <article style="background:#ffffff;border:1.5px solid #e0e7ff;border-radius:16px;overflow:hidden;display:flex;flex-direction:column;box-shadow:0 4px 20px rgba(0,82,255,0.05);transition:all 0.25s;"
                             onmouseenter="this.style.borderColor='#0052ff';this.style.boxShadow='0 8px 30px rgba(0,82,255,0.12)';this.style.transform='translateY(-3px)';"
                             onmouseleave="this.style.borderColor='#e0e7ff';this.style.boxShadow='0 4px 20px rgba(0,82,255,0.05)';this.style.transform='translateY(0)';">
                        <div style="padding:24px;flex:1;display:flex;flex-direction:column;gap:8px;">
                            <span style="display:inline-block;background:#eff6ff;color:#0052ff;font-size:10px;font-weight:800;text-transform:uppercase;letter-spacing:0.05em;padding:4px 10px;border-radius:999px;width:fit-content;">{{ $post['tag'] }}</span>
                            <div style="font-size:11px;color:#9ca3af;font-weight:500;">{{ $post['date'] }}</div>
                            <h3 class="font-heading font-bold" style="color:#0a1a4a;font-size:1rem;line-height:1.45;">{{ $post['title'] }}</h3>
                            <p style="color:#4b5563;font-size:0.85rem;line-height:1.6;flex:1;">{{ $post['excerpt'] }}</p>
                            <a href="{{ route('blog') }}" style="display:inline-flex;align-items:center;gap:5px;color:#0052ff;font-size:0.8rem;font-weight:700;text-decoration:none;margin-top:8px;">
                                Read Guide <svg style="width:12px;height:12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </article>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    {{-- ============================================================
         CTA BANNER
         ============================================================ --}}
    {{-- CTA Banner (Glassmorphism) --}}
    <section style="position:relative;overflow:hidden;background:linear-gradient(135deg,#010d24 0%,#020c22 50%,#010818 100%);padding:5rem 0;">
        <div style="position:absolute;top:-80px;left:50%;transform:translateX(-50%);width:500px;height:300px;background:radial-gradient(ellipse,rgba(0,82,255,0.25) 0%,transparent 70%);pointer-events:none;"></div>
        <div style="position:absolute;bottom:-60px;left:-60px;width:280px;height:280px;background:radial-gradient(circle,rgba(0,43,138,0.22) 0%,transparent 70%);border-radius:50%;pointer-events:none;"></div>
        <div style="position:absolute;top:-40px;right:-40px;width:220px;height:220px;background:radial-gradient(circle,rgba(0,82,255,0.18) 0%,transparent 70%);border-radius:50%;pointer-events:none;"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center" style="position:relative;z-index:1;">
            <span style="font-size:11px;font-weight:800;color:#60a5fa;text-transform:uppercase;letter-spacing:0.08em;background:rgba(0,82,255,0.2);border:1px solid rgba(0,82,255,0.35);padding:5px 14px;border-radius:999px;display:inline-block;margin-bottom:1.25rem;">Get Started Today</span>
            <h2 class="font-heading font-extrabold" style="color:#ffffff;font-size:clamp(1.7rem,4vw,2.5rem);margin-bottom:14px;text-shadow:0 4px 16px rgba(0,0,0,0.5);">
                Ready to Simplify Your Taxes &amp; Accounting?
            </h2>
            <p style="color:rgba(148,163,184,0.9);font-size:1rem;margin-bottom:32px;max-width:520px;margin-left:auto;margin-right:auto;line-height:1.7;">
                Join thousands of satisfied Canadian businesses who trust YONBUS for all their financial needs.
            </p>
            <div style="display:flex;flex-wrap:wrap;gap:1rem;justify-content:center;">
                <a href="{{ route('register') }}"
                   style="display:inline-flex;align-items:center;gap:8px;background:#0052ff;color:#ffffff;font-weight:700;font-size:0.95rem;padding:14px 30px;border-radius:12px;box-shadow:0 8px 24px rgba(0,82,255,0.5);text-decoration:none;transition:all 0.2s;"
                   onmouseenter="this.style.boxShadow='0 12px 32px rgba(0,82,255,0.7)';this.style.transform='translateY(-2px)';"
                   onmouseleave="this.style.boxShadow='0 8px 24px rgba(0,82,255,0.5)';this.style.transform='translateY(0)';">
                    Get Started Free
                    <svg style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
                <a href="{{ route('book-appointment') }}"
                   style="display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,0.08);backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);border:1.5px solid rgba(255,255,255,0.25);color:#ffffff;font-weight:600;font-size:0.95rem;padding:14px 26px;border-radius:12px;text-decoration:none;transition:all 0.2s;"
                   onmouseenter="this.style.background='rgba(255,255,255,0.15)';this.style.borderColor='rgba(255,255,255,0.45)';"
                   onmouseleave="this.style.background='rgba(255,255,255,0.08)';this.style.borderColor='rgba(255,255,255,0.25)';">
                    Book Consultation
                </a>
            </div>
        </div>
    </section>

</x-public-layout>
