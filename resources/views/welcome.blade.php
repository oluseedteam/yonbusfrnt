<x-public-layout>
    <x-slot name="title">YONBUS Tax & Accounting Services Inc. — Your Partner in Financial Clarity & Growth</x-slot>

    {{-- ============================================================
         HERO — Exact match to screenshot with modern office background
         ============================================================ --}}
    <section class="relative overflow-hidden" style="min-height: 90vh; display: flex; align-items: center; background: #020B24;">
        {{-- Background Image with daylight office view & left dark navy gradient overlay --}}
        <div class="absolute inset-0" style="z-index: 0;">
            <img src="{{ asset('images/accounting-hero-bg.jpg') }}?v={{ file_exists(public_path('images/accounting-hero-bg.jpg')) ? filemtime(public_path('images/accounting-hero-bg.jpg')) : time() }}"
                 alt="YONBUS Corporate Office"
                 style="width: 100%; height: 100%; object-fit: cover; object-position: center; opacity: 0.95;">
            <div class="absolute inset-0" style="background: linear-gradient(95deg, rgba(2,11,36,0.96) 0%, rgba(2,11,36,0.88) 36%, rgba(2,11,36,0.45) 68%, rgba(2,11,36,0.20) 100%);"></div>
        </div>

        <div class="relative w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-28" style="z-index: 1;">
            <div class="max-w-2xl" style="display: flex; flex-direction: column; gap: 1.75rem;" data-aos="fade-right" data-aos-duration="800">

                {{-- Badge --}}
                <div class="inline-flex items-center gap-2" style="background: rgba(14, 45, 110, 0.55); border: 1.5px solid rgba(59, 130, 246, 0.45); color: #93c5fd; padding: 7px 18px; border-radius: 999px; font-size: 11.5px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.07em; width: fit-content; backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); box-shadow: 0 4px 14px rgba(0,0,0,0.15);">
                    <svg style="width: 16px; height: 16px; color: #60a5fa; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    <span>TRUSTED BY 5,000+ CANADIAN BUSINESSES</span>
                </div>

                {{-- Main Headline --}}
                <h1 class="font-heading font-extrabold text-white" style="font-size: clamp(2.8rem, 5.6vw, 4.4rem); line-height: 1.12; letter-spacing: -0.025em; margin: 0;">
                    YONBUS Tax &amp;<br>
                    Accounting <span style="color: #4da6ff;">Services</span><br>
                    <span style="color: #4da6ff;">Inc.</span>
                </h1>

                {{-- Subheadline --}}
                <p style="color: rgba(226, 232, 240, 0.92); font-size: clamp(1.05rem, 1.35vw, 1.2rem); line-height: 1.7; max-width: 540px; font-weight: 400; margin: 0;">
                    A trusted partner delivering reliable, efficient, and compliant tax and accounting solutions to individuals, businesses, and organizations across Canada.
                </p>

            </div>
        </div>
    </section>

    {{-- ============================================================
         STATS BAR
         ============================================================ --}}
    {{-- Stats Bar --}}
    <section style="position: relative; overflow: hidden; background: #ffffff; padding: 3.5rem 0; border-top: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0;" data-aos="fade-up" data-aos-duration="600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="position:relative;z-index:1;">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach([
                    ['num'=>'5,000+','label'=>'Satisfied Clients','icon'=>'👥'],
                    ['num'=>'10+','label'=>'Years of Expertise','icon'=>'🏆'],
                    ['num'=>'98%','label'=>'CRA Compliance Rate','icon'=>'✅'],
                    ['num'=>'4.9★','label'=>'Client Rating','icon'=>'⭐'],
                ] as $s)
                <div class="hover-scale" style="background:#f8faff;border:1.5px solid #e0e7ff;border-radius:16px;padding:22px 16px;text-align:center;box-shadow:0 2px 12px rgba(0,82,255,0.04);">
                    <div style="font-size:1.4rem;margin-bottom:6px;">{{ $s['icon'] }}</div>
                    <div class="font-heading font-extrabold" style="font-size:1.8rem;color:#0a1a4a;">{{ $s['num'] }}</div>
                    <div style="font-size:0.8rem;color:#64748b;margin-top:4px;font-weight:600;">{{ $s['label'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============================================================
         SECTION PREVIEW CARDS — link to individual pages
         ============================================================ --}}
    {{-- Section Preview Cards --}}
    <section style="position:relative;overflow:hidden;background:#f8faff;padding:5rem 0;" data-aos="fade-up" data-aos-duration="700">
        <div style="position:absolute;top:-80px;right:-60px;width:350px;height:350px;background:radial-gradient(circle,rgba(0,82,255,0.06) 0%,transparent 70%);border-radius:50%;pointer-events:none;"></div>
        <div style="position:absolute;bottom:-60px;left:-40px;width:280px;height:280px;background:radial-gradient(circle,rgba(0,82,255,0.04) 0%,transparent 70%);border-radius:50%;pointer-events:none;"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="position:relative;z-index:1;">
            <div class="text-center" style="margin-bottom: 3.5rem;">
                <span style="font-size:11px;font-weight:800;color:#0052ff;text-transform:uppercase;letter-spacing:0.08em;background:#eff6ff;padding:4px 14px;border-radius:999px;border:1px solid #dbeafe;display:inline-block;">What We Offer</span>
                <h2 class="font-heading font-extrabold" style="font-size:clamp(1.8rem,4vw,2.5rem);color:#0a1a4a;margin-top:10px;">Everything Your Business Needs</h2>
                <p style="color:#475569;font-size:1rem;margin-top:10px;max-width:560px;margin-left:auto;margin-right:auto;line-height:1.65;">From tax filing to business advisory, YONBUS has you fully covered.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- About Card --}}
                <a href="{{ route('about') }}" class="hover-lift" style="background:#ffffff;border:1.5px solid #e0e7ff;border-radius:20px;padding:32px 28px;display:flex;flex-direction:column;gap:16px;text-decoration:none;box-shadow:0 4px 20px rgba(0,82,255,0.05);transition:all 0.25s;"
                   onmouseenter="this.style.borderColor='#0052ff';this.style.boxShadow='0 12px 40px rgba(0,82,255,0.12)';"
                   onmouseleave="this.style.borderColor='#e0e7ff';this.style.boxShadow='0 4px 20px rgba(0,82,255,0.05)';">
                    <div style="width:52px;height:52px;border-radius:14px;background:#eff6ff;border:1px solid #dbeafe;display:flex;align-items:center;justify-content:center;font-size:1.5rem;">🏢</div>
                    <div>
                        <div style="font-size:11px;font-weight:800;color:#0052ff;text-transform:uppercase;letter-spacing:0.06em;margin-bottom:6px;">About Us</div>
                        <h3 class="font-heading font-bold" style="color:#0a1a4a;font-size:1.15rem;margin-bottom:8px;">Who We Are &amp; Our Values</h3>
                        <p style="color:#475569;font-size:0.87rem;line-height:1.65;">Learn about YONBUS, our mission, core values (Integrity, Professionalism, Excellence, Client Focus), and our commitment to Canadian clients.</p>
                    </div>
                    <div style="display:inline-flex;align-items:center;gap:6px;color:#0052ff;font-size:0.85rem;font-weight:700;margin-top:auto;">
                        Learn More <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </div>
                </a>

                {{-- Services Card (highlighted) --}}
                <a href="{{ route('services') }}" class="hover-lift" style="background:linear-gradient(135deg, #002B8A 0%, #0045d8 50%, #0052FF 100%);border-radius:20px;padding:32px 28px;display:flex;flex-direction:column;gap:16px;text-decoration:none;box-shadow:0 12px 36px rgba(0,82,255,0.25);transition:all 0.25s;"
                   onmouseenter="this.style.boxShadow='0 16px 48px rgba(0,82,255,0.4)';"
                   onmouseleave="this.style.boxShadow='0 12px 36px rgba(0,82,255,0.25)';">
                    <div style="width:52px;height:52px;border-radius:14px;background:rgba(255,255,255,0.2);display:flex;align-items:center;justify-content:center;font-size:1.5rem;">📋</div>
                    <div>
                        <div style="font-size:11px;font-weight:800;color:#dbeafe;text-transform:uppercase;letter-spacing:0.06em;margin-bottom:6px;">Our Services</div>
                        <h3 class="font-heading font-bold" style="color:#ffffff;font-size:1.15rem;margin-bottom:8px;">5 Specialized Practice Areas</h3>
                        <p style="color:#dbeafe;font-size:0.87rem;line-height:1.65;">Tax Services, Accounting &amp; Bookkeeping, Payroll, Business Advisory, and Compliance — tailored for Canadian businesses.</p>
                    </div>
                    <div style="display:inline-flex;align-items:center;gap:6px;color:#ffffff;font-size:0.85rem;font-weight:700;margin-top:auto;">
                        View Services <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </div>
                </a>

                {{-- Contact Card --}}
                <a href="{{ route('contact') }}" class="hover-lift" style="background:#ffffff;border:1.5px solid #e0e7ff;border-radius:20px;padding:32px 28px;display:flex;flex-direction:column;gap:16px;text-decoration:none;box-shadow:0 4px 20px rgba(0,82,255,0.05);transition:all 0.25s;"
                   onmouseenter="this.style.borderColor='#0052ff';this.style.boxShadow='0 12px 40px rgba(0,82,255,0.12)';"
                   onmouseleave="this.style.borderColor='#e0e7ff';this.style.boxShadow='0 4px 20px rgba(0,82,255,0.05)';">
                    <div style="width:52px;height:52px;border-radius:14px;background:#eff6ff;border:1px solid #dbeafe;display:flex;align-items:center;justify-content:center;font-size:1.5rem;">📞</div>
                    <div>
                        <div style="font-size:11px;font-weight:800;color:#0052ff;text-transform:uppercase;letter-spacing:0.06em;margin-bottom:6px;">Get In Touch</div>
                        <h3 class="font-heading font-bold" style="color:#0a1a4a;font-size:1.15rem;margin-bottom:8px;">Contact Our Team</h3>
                        <p style="color:#475569;font-size:0.87rem;line-height:1.65;">Reach our Gatineau office, send a direct message, or book a free consultation — we're here to help.</p>
                    </div>
                    <div style="display:inline-flex;align-items:center;gap:6px;color:#0052ff;font-size:0.85rem;font-weight:700;margin-top:auto;">
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
    <section style="background: #ffffff; padding: 5rem 0;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div style="display:flex;flex-wrap:wrap;align-items:flex-end;justify-content:space-between;gap:1rem;margin-bottom:2.5rem;">
                <div>
                    <span style="font-size:11px;font-weight:800;color:#0052ff;text-transform:uppercase;letter-spacing:0.08em;background:#eff6ff;padding:4px 14px;border-radius:999px;border:1px solid #dbeafe;display:inline-block;">Insights &amp; Guides</span>
                    <h2 class="font-heading font-extrabold" style="font-size:clamp(1.6rem,3vw,2.2rem);color:#0a1a4a;margin-top:8px;">Tax Tips &amp; Blog Posts</h2>
                </div>
                <a href="{{ route('blog') }}" style="display:inline-flex;align-items:center;gap:6px;color:#0052ff;font-size:0.87rem;font-weight:700;text-decoration:none;">
                    View All Articles <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @if(isset($featuredBlogs) && count($featuredBlogs) > 0)
                    @foreach($featuredBlogs as $blog)
                    <article style="background:#ffffff;border:1.5px solid #e0e7ff;border-radius:16px;overflow:hidden;display:flex;flex-direction:column;box-shadow:0 4px 20px rgba(0,82,255,0.05);transition:all 0.25s;"
                             onmouseenter="this.style.borderColor='#0052ff';this.style.boxShadow='0 8px 30px rgba(0,82,255,0.12)';this.style.transform='translateY(-3px)';"
                             onmouseleave="this.style.borderColor='#e0e7ff';this.style.boxShadow='0 4px 20px rgba(0,82,255,0.05)';this.style.transform='translateY(0)';">
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
    {{-- CTA Banner (Royal Blue) --}}
    <section style="position:relative;overflow:hidden;background:linear-gradient(135deg,#002B8A 0%,#0045d8 50%,#0052FF 100%);padding:5rem 0;">
        <div style="position:absolute;top:-80px;left:50%;transform:translateX(-50%);width:500px;height:300px;background:radial-gradient(ellipse,rgba(255,255,255,0.15) 0%,transparent 70%);pointer-events:none;"></div>
        <div style="position:absolute;bottom:-60px;left:-60px;width:280px;height:280px;background:radial-gradient(circle,rgba(255,255,255,0.1) 0%,transparent 70%);border-radius:50%;pointer-events:none;"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center" style="position:relative;z-index:1;">
            <span style="font-size:11px;font-weight:800;color:#dbeafe;text-transform:uppercase;letter-spacing:0.08em;background:rgba(255,255,255,0.15);border:1px solid rgba(255,255,255,0.25);padding:5px 14px;border-radius:999px;display:inline-block;margin-bottom:1.25rem;">Get Started Today</span>
            <h2 class="font-heading font-extrabold" style="color:#ffffff;font-size:clamp(1.7rem,4vw,2.5rem);margin-bottom:14px;">
                Ready to Simplify Your Taxes &amp; Accounting?
            </h2>
            <p style="color:#dbeafe;font-size:1rem;margin-bottom:32px;max-width:520px;margin-left:auto;margin-right:auto;line-height:1.7;">
                Join thousands of satisfied Canadian businesses who trust YONBUS for all their financial needs.
            </p>
            <div style="display:flex;flex-wrap:wrap;gap:1rem;justify-content:center;">
                <a href="{{ route('register') }}"
                   style="display:inline-flex;align-items:center;gap:8px;background:#ffffff;color:#0052ff;font-weight:700;font-size:0.95rem;padding:14px 30px;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,0.15);text-decoration:none;transition:all 0.2s;"
                   onmouseenter="this.style.boxShadow='0 12px 32px rgba(0,0,0,0.25)';this.style.transform='translateY(-2px)';"
                   onmouseleave="this.style.boxShadow='0 8px 24px rgba(0,0,0,0.15)';this.style.transform='translateY(0)';">
                    Get Started Free
                    <svg style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
                <a href="{{ route('book-appointment') }}"
                   style="display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,0.12);backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);border:1.5px solid rgba(255,255,255,0.3);color:#ffffff;font-weight:600;font-size:0.95rem;padding:14px 26px;border-radius:12px;text-decoration:none;transition:all 0.2s;"
                   onmouseenter="this.style.background='rgba(255,255,255,0.22)';"
                   onmouseleave="this.style.background='rgba(255,255,255,0.12)';">
                    Book Consultation
                </a>
            </div>
        </div>
    </section>

</x-public-layout>
