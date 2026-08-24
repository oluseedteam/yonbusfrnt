<x-public-layout>
    <x-slot name="title">YONBUS Tax & Accounting Services Inc. — Your Partner in Financial Clarity & Growth</x-slot>

    {{-- ============================================================
         HERO — Office background with vibrant deep blue to blue gradient overlay (No Black)
         ============================================================ --}}
    <section class="relative overflow-hidden min-h-[85vh] md:min-h-[90vh] flex items-center" style="background: #010a1f;">
        {{-- Background Image with Rich Dark Moody Tint --}}
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/welcome-hero-bg.jpg') }}?v={{ file_exists(public_path('images/welcome-hero-bg.jpg')) ? filemtime(public_path('images/welcome-hero-bg.jpg')) : time() }}"
                 alt="YONBUS Corporate Office"
                 class="w-full h-full object-cover object-center">

            {{-- Rich Dark Overlay exactly matching screenshot --}}
            <div class="absolute inset-0" style="background: linear-gradient(90deg, rgba(1, 10, 30, 0.95) 0%, rgba(2, 16, 46, 0.88) 35%, rgba(2, 22, 60, 0.68) 65%, rgba(2, 24, 66, 0.48) 100%);"></div>
        </div>

        <div class="relative w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20 md:py-28 z-10">
            <div class="max-w-2xl flex flex-col gap-5 sm:gap-6 md:gap-7" data-aos="fade-right" data-aos-duration="800">

                {{-- Badge --}}
                <div style="width: fit-content; display: inline-flex; align-items: center; gap: 7px; background: #0D3E85; border: 1.2px solid #2563EB; color: #BFDBFE; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; padding: 6px 16px; border-radius: 999px; box-shadow: 0 2px 10px rgba(13,62,133,0.35);">
                    <svg style="width: 14px; height: 14px; color: #60A5FA; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    <span>TRUSTED BY 5,000+ CANADIANS</span>
                </div>

                {{-- Main Headline --}}
                <h1 class="font-heading font-extrabold text-white text-3xl sm:text-4xl md:text-5xl lg:text-[4.2rem] leading-[1.15] md:leading-[1.12] m-0" style="letter-spacing: -0.02em; text-shadow: 0 3px 12px rgba(2, 18, 55, 0.45);">
                    YONBUS Tax &amp;<br>
                    Accounting <span style="color: #4AA1FF;">Services</span><br>
                    <span style="color: #4AA1FF;">Inc.</span>
                </h1>

                {{-- Subheadline --}}
                <p class="text-white text-sm sm:text-base md:text-lg leading-relaxed max-w-xl font-medium m-0" style="text-shadow: 0 2px 8px rgba(2, 18, 55, 0.4);">
                    A trusted partner delivering reliable, efficient, and compliant tax and accounting solutions to individuals, businesses, and organizations across Canada.
                </p>

                {{-- Mission Quote --}}
                <div style="display: flex; align-items: flex-start; gap: 12px; background: rgba(3, 27, 78, 0.65); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border-left: 3.5px solid #4AA1FF; border: 1px solid rgba(255,255,255,0.15); border-radius: 0 12px 12px 0; padding: 14px 18px; max-width: 500px;">
                    <p style="color: #E2E8F0; font-size: 0.95rem; font-style: italic; line-height: 1.6; margin: 0;">
                        "Your Partner in Financial Clarity and Growth"
                    </p>
                </div>

                {{-- CTA Buttons --}}
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4 w-full sm:w-auto pt-1">
                    <a href="{{ route('register') }}"
                       class="btn-primary w-full sm:w-auto text-center justify-center text-sm sm:text-base py-3.5 px-6 sm:px-8 font-bold shadow-lg transition-all hover:scale-[1.02]">
                        Get Started Free
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>

                    <a href="{{ route('book-appointment') }}"
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 text-white font-bold text-sm sm:text-base py-3.5 px-5 sm:px-6 rounded-xl transition-all hover:scale-[1.02]"
                       style="background: rgba(3, 27, 78, 0.55); border: 1.5px solid rgba(255, 255, 255, 0.4); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Book Consultation
                    </a>
                </div>

            </div>
        </div>
    </section>

    @php
        $googleReviews = $googleReviews ?? app(\App\Services\GoogleReviewService::class)->getReviews();
    @endphp

    @if(!empty($googleReviews) && count($googleReviews) > 0)
    {{-- ============================================================
         GOOGLE MAPS / VERIFIED CLIENT REVIEWS MARQUEE
         Dynamically fetched verified reviews - 0 mock data
         ============================================================ --}}
    <section class="relative overflow-hidden py-10 md:py-14"
             style="background: linear-gradient(180deg, #010A1F 0%, #031435 50%, #051A45 100%); border-top: 1.5px solid rgba(74, 161, 255, 0.25); border-bottom: 1.5px solid rgba(74, 161, 255, 0.25);">

        {{-- Direct Embedded Styles for Guaranteed High Contrast, Visibility & Smooth Continuous Motion --}}
        <style>
            @keyframes marqueeReviewSlide {
                0% {
                    transform: translate3d(0, 0, 0);
                }
                100% {
                    transform: translate3d(-50%, 0, 0);
                }
            }
            @-webkit-keyframes marqueeReviewSlide {
                0% {
                    -webkit-transform: translate3d(0, 0, 0);
                }
                100% {
                    -webkit-transform: translate3d(-50%, 0, 0);
                }
            }
            .google-reviews-marquee-track {
                display: flex !important;
                flex-direction: row !important;
                flex-wrap: nowrap !important;
                width: max-content !important;
                gap: 20px !important;
                animation: marqueeReviewSlide 32s linear infinite !important;
                -webkit-animation: marqueeReviewSlide 32s linear infinite !important;
                will-change: transform;
            }
            .google-reviews-marquee-track:hover {
                animation-play-state: paused !important;
                -webkit-animation-play-state: paused !important;
            }
            .google-review-card-box {
                width: 360px !important;
                min-width: 360px !important;
                max-width: 360px !important;
                flex-shrink: 0 !important;
                background: #091c44 !important;
                border: 1.5px solid #1e40af !important;
                border-radius: 18px !important;
                padding: 22px !important;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5) !important;
                display: flex !important;
                flex-direction: column !important;
                justify-content: space-between !important;
                transition: transform 0.25s ease, border-color 0.25s ease, box-shadow 0.25s ease !important;
            }
            .google-review-card-box:hover {
                transform: translateY(-4px) !important;
                border-color: #3b82f6 !important;
                box-shadow: 0 16px 36px rgba(37, 99, 235, 0.35) !important;
            }
            @media (max-width: 640px) {
                .google-review-card-box {
                    width: 300px !important;
                    min-width: 300px !important;
                    max-width: 300px !important;
                    padding: 18px !important;
                }
            }
        </style>

        {{-- Subtle Ambient Glows --}}
        <div class="absolute top-0 left-1/4 w-96 h-96 rounded-full opacity-20 pointer-events-none blur-3xl" style="background: radial-gradient(circle, #0052FF 0%, transparent 70%);"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 rounded-full opacity-20 pointer-events-none blur-3xl" style="background: radial-gradient(circle, #38BDF8 0%, transparent 70%);"></div>

        {{-- Marquee Scrolling Container with Gradient Fade Edges --}}
        <div class="relative w-full overflow-hidden py-3"
             style="mask-image: linear-gradient(to right, transparent 0%, black 4%, black 96%, transparent 100%); -webkit-mask-image: linear-gradient(to right, transparent 0%, black 4%, black 96%, transparent 100%);">
            
            {{-- Infinite Moving Track --}}
            <div class="google-reviews-marquee-track">
                @php
                    $displayReviews = count($googleReviews) < 4 ? array_merge($googleReviews, $googleReviews, $googleReviews, $googleReviews) : array_merge($googleReviews, $googleReviews);
                @endphp
                @foreach($displayReviews as $review)
                <div class="google-review-card-box">
                    
                    {{-- Reviewer Top Row & Content --}}
                    <div>
                        <div class="flex items-center gap-3 mb-3">
                            {{-- Bright Colorful Avatar Circle Badge --}}
                            @if(!empty($review['avatar']))
                                <img src="{{ $review['avatar'] }}" alt="{{ $review['name'] }}" style="width: 42px; height: 42px; border-radius: 9999px; object-fit: cover; border: 2px solid rgba(255,255,255,0.3); flex-shrink: 0; box-shadow: 0 4px 10px rgba(0,0,0,0.35);">
                            @else
                                <div style="background: linear-gradient(135deg, #2563EB 0%, #0284C7 100%); color: #FFFFFF !important; font-weight: 800; font-size: 14px; border: 2px solid rgba(255,255,255,0.3); width: 42px; height: 42px; border-radius: 9999px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 4px 10px rgba(0,0,0,0.35);">
                                    {{ $review['initials'] ?? 'CL' }}
                                </div>
                            @endif
                            <div>
                                <h4 style="color: #FFFFFF !important; font-family: 'Outfit', sans-serif; font-size: 15px; font-weight: 700; line-height: 1.25; margin: 0;">
                                    {{ $review['name'] }}
                                </h4>
                            </div>
                        </div>

                        {{-- Review Text (Crystal Clear Visible Text) --}}
                        <p style="color: #F1F5F9 !important; font-size: 13.5px; line-height: 1.65; margin: 0; font-weight: 400;">
                            "{!! nl2br(e($review['text'])) !!}"
                        </p>
                    </div>

                    {{-- Company Name at End of Box --}}
                    @if(!empty($review['company']))
                    <div style="margin-top: 14px; padding-top: 10px; border-top: 1px solid rgba(255, 255, 255, 0.12); display: flex; align-items: center; gap: 7px;">
                        <svg style="width: 14px; height: 14px; color: #60a5fa; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        <span style="color: #93c5fd !important; font-size: 12px; font-weight: 600; line-height: 1.35;">
                            {{ $review['company'] }}
                        </span>
                    </div>
                    @endif

                </div>
                @endforeach
            </div>

        </div>

    </section>
    @endif

    {{-- ============================================================
         SECTION PREVIEW CARDS — Clean White Theme with Blue Accents
         ============================================================ --}}
    <section style="position:relative;overflow:hidden;background:#f8faff;padding:5rem 0;" data-aos="fade-up" data-aos-duration="700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="position:relative;z-index:1;">
            <div class="text-center" style="margin-bottom: 3.5rem;">
                <span style="font-size:11px;font-weight:800;color:#0052ff;text-transform:uppercase;letter-spacing:0.08em;background:#eff6ff;padding:5px 16px;border-radius:999px;border:1px solid #bfdbfe;display:inline-block;">What We Offer</span>
                <h2 class="font-heading font-extrabold" style="font-size:clamp(1.8rem,4vw,2.5rem);color:#0a1a4a;margin-top:10px;">Everything Your Business Needs</h2>
                <p style="color:#4b5563;font-size:1rem;margin-top:10px;max-width:560px;margin-left:auto;margin-right:auto;line-height:1.65;">From tax filing to business advisory, YONBUS has you fully covered.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- About Card --}}
                <a href="{{ route('about') }}" class="hover-lift" style="background:#ffffff;border:1.5px solid #dbeafe;border-radius:20px;padding:32px 28px;display:flex;flex-direction:column;gap:16px;text-decoration:none;box-shadow:0 6px 24px rgba(0,82,255,0.06);transition:all 0.25s;"
                   onmouseenter="this.style.borderColor='#0052ff';this.style.boxShadow='0 12px 32px rgba(0,82,255,0.15)';this.style.transform='translateY(-4px)';"
                   onmouseleave="this.style.borderColor='#dbeafe';this.style.boxShadow='0 6px 24px rgba(0,82,255,0.06)';this.style.transform='translateY(0)';">
                    <div style="width:52px;height:52px;border-radius:14px;background:#eff6ff;border:1px solid #bfdbfe;display:flex;align-items:center;justify-content:center;font-size:1.5rem;">🏢</div>
                    <div style="display:flex;flex-direction:column;gap:8px;flex:1;">
                        <span style="display:inline-block;background:#eff6ff;color:#0052ff;font-size:10px;font-weight:800;text-transform:uppercase;letter-spacing:0.05em;padding:4px 10px;border-radius:999px;width:fit-content;border:1px solid #bfdbfe;">About Us</span>
                        <h3 class="font-heading font-bold" style="color:#0a1a4a;font-size:1.15rem;line-height:1.45;">Who We Are &amp; Our Values</h3>
                        <p style="color:#4b5563;font-size:0.88rem;line-height:1.6;flex:1;">Learn about YONBUS, our mission, core values (Integrity, Professionalism, Excellence, Client Focus), and our commitment to Canadian clients.</p>
                    </div>
                    <div style="display:inline-flex;align-items:center;gap:6px;color:#0052ff;font-size:0.85rem;font-weight:700;margin-top:auto;">
                        Learn More <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </div>
                </a>

                {{-- Services Card (Highlighted in Deep Blue to Blue Gradient) --}}
                <a href="{{ route('services') }}" class="hover-lift" style="background:linear-gradient(135deg, #002B8A 0%, #0045d8 50%, #0052FF 100%);border-radius:20px;padding:32px 28px;display:flex;flex-direction:column;gap:16px;text-decoration:none;box-shadow:0 12px 36px rgba(0,82,255,0.3);transition:all 0.25s;"
                   onmouseenter="this.style.boxShadow='0 16px 44px rgba(0,82,255,0.45)';this.style.transform='translateY(-4px)';"
                   onmouseleave="this.style.boxShadow='0 12px 36px rgba(0,82,255,0.3)';this.style.transform='translateY(0)';">
                    <div style="width:52px;height:52px;border-radius:14px;background:rgba(255,255,255,0.18);border:1px solid rgba(255,255,255,0.3);display:flex;align-items:center;justify-content:center;font-size:1.5rem;">📋</div>
                    <div style="display:flex;flex-direction:column;gap:8px;flex:1;">
                        <span style="display:inline-block;background:rgba(255,255,255,0.2);color:#ffffff;font-size:10px;font-weight:800;text-transform:uppercase;letter-spacing:0.05em;padding:4px 10px;border-radius:999px;width:fit-content;border:1px solid rgba(255,255,255,0.35);">Our Services</span>
                        <h3 class="font-heading font-bold" style="color:#ffffff;font-size:1.15rem;line-height:1.45;">6 Specialized Practice Areas</h3>
                        <p style="color:#dbeafe;font-size:0.88rem;line-height:1.6;flex:1;">Tax Preparation &amp; Planning, Accounting &amp; Bookkeeping, Payroll, Business Advisory, Compliance, and Registration.</p>
                    </div>
                    <div style="display:inline-flex;align-items:center;gap:6px;color:#ffffff;font-size:0.85rem;font-weight:700;margin-top:auto;">
                        View Services <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </div>
                </a>

                {{-- Contact Card --}}
                <a href="{{ route('contact') }}" class="hover-lift" style="background:#ffffff;border:1.5px solid #dbeafe;border-radius:20px;padding:32px 28px;display:flex;flex-direction:column;gap:16px;text-decoration:none;box-shadow:0 6px 24px rgba(0,82,255,0.06);transition:all 0.25s;"
                   onmouseenter="this.style.borderColor='#0052ff';this.style.boxShadow='0 12px 32px rgba(0,82,255,0.15)';this.style.transform='translateY(-4px)';"
                   onmouseleave="this.style.borderColor='#dbeafe';this.style.boxShadow='0 6px 24px rgba(0,82,255,0.06)';this.style.transform='translateY(0)';">
                    <div style="width:52px;height:52px;border-radius:14px;background:#eff6ff;border:1px solid #bfdbfe;display:flex;align-items:center;justify-content:center;font-size:1.5rem;">📞</div>
                    <div style="display:flex;flex-direction:column;gap:8px;flex:1;">
                        <span style="display:inline-block;background:#eff6ff;color:#0052ff;font-size:10px;font-weight:800;text-transform:uppercase;letter-spacing:0.05em;padding:4px 10px;border-radius:999px;width:fit-content;border:1px solid #bfdbfe;">Get In Touch</span>
                        <h3 class="font-heading font-bold" style="color:#0a1a4a;font-size:1.15rem;line-height:1.45;">Contact Our Team</h3>
                        <p style="color:#4b5563;font-size:0.88rem;line-height:1.6;flex:1;">Reach our Gatineau office, send a direct message, or book a free consultation — we're here to help.</p>
                    </div>
                    <div style="display:inline-flex;align-items:center;gap:6px;color:#0052ff;font-size:0.85rem;font-weight:700;margin-top:auto;">
                        Contact Us <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </div>
                </a>
            </div>
        </div>
    </section>

    {{-- ============================================================
         FEATURED BLOG SECTION (Clean White Theme)
         ============================================================ --}}
    <section style="background: #ffffff; padding: 5rem 0; border-top: 1px solid #e2e8f0;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div style="display:flex;flex-wrap:wrap;align-items:flex-end;justify-content:space-between;gap:1rem;margin-bottom:2.5rem;">
                <div>
                    <span style="font-size:11px;font-weight:800;color:#0052ff;text-transform:uppercase;letter-spacing:0.08em;background:#eff6ff;padding:5px 16px;border-radius:999px;border:1px solid #bfdbfe;display:inline-block;">Insights &amp; Guides</span>
                    <h2 class="font-heading font-extrabold" style="font-size:clamp(1.6rem,3vw,2.2rem);color:#0a1a4a;margin-top:8px;">Tax Tips &amp; Blog Posts</h2>
                </div>
                <a href="{{ route('blog') }}" style="display:inline-flex;align-items:center;gap:6px;color:#0052ff;font-size:0.87rem;font-weight:700;text-decoration:none;">
                    View All Articles <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @if(isset($featuredBlogs) && count($featuredBlogs) > 0)
                    @foreach($featuredBlogs as $blog)
                    <article style="background:#ffffff;border:1.5px solid #e0e7ff;border-radius:16px;overflow:hidden;display:flex;flex-direction:column;box-shadow:0 4px 20px rgba(0,82,255,0.06);transition:all 0.25s;"
                             onmouseenter="this.style.borderColor='#0052ff';this.style.boxShadow='0 8px 30px rgba(0,82,255,0.15)';this.style.transform='translateY(-3px)';"
                             onmouseleave="this.style.borderColor='#e0e7ff';this.style.boxShadow='0 4px 20px rgba(0,82,255,0.06)';this.style.transform='translateY(0)';">
                        @if($blog->featured_image)
                        <div style="height:180px;overflow:hidden;">
                            <img src="{{ $blog->featured_image }}" alt="{{ $blog->title }}" style="width:100%;height:100%;object-fit:cover;">
                        </div>
                        @endif
                        <div style="padding:24px;flex:1;display:flex;flex-direction:column;gap:8px;">
                            <div style="font-size:11px;color:#64748b;font-weight:500;">{{ $blog->published_at ? $blog->published_at->format('M d, Y') : 'Recently' }}</div>
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
                        ['tag'=>'Bookkeeping','date'=>'Jul 28, 2026','title'=>'How to Prepare for a Tax Audit with Zero Stress','excerpt'=>'A step-by-step audit preparation roadmap to keep your financial records organized and fully compliant.'],
                        ['tag'=>'Payroll','date'=>'Jul 20, 2026','title'=>'Complete Payroll Automation Guide for Growing Enterprises','excerpt'=>'Streamline monthly employee remittances, T4 slips, and direct deposits with automated payroll systems.'],
                    ] as $post)
                    <article style="background:#ffffff;border:1.5px solid #e0e7ff;border-radius:16px;overflow:hidden;display:flex;flex-direction:column;box-shadow:0 4px 20px rgba(0,82,255,0.06);transition:all 0.25s;"
                             onmouseenter="this.style.borderColor='#0052ff';this.style.boxShadow='0 8px 30px rgba(0,82,255,0.15)';this.style.transform='translateY(-3px)';"
                             onmouseleave="this.style.borderColor='#e0e7ff';this.style.boxShadow='0 4px 20px rgba(0,82,255,0.06)';this.style.transform='translateY(0)';">
                        <div style="padding:24px;flex:1;display:flex;flex-direction:column;gap:8px;">
                            <span style="display:inline-block;background:#eff6ff;color:#0052ff;font-size:10px;font-weight:800;text-transform:uppercase;letter-spacing:0.05em;padding:4px 10px;border-radius:999px;width:fit-content;border:1px solid #bfdbfe;">{{ $post['tag'] }}</span>
                            <div style="font-size:11px;color:#64748b;font-weight:500;">{{ $post['date'] }}</div>
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
         CTA BANNER (Deep Blue to Blue Gradient)
         ============================================================ --}}
    <section style="position:relative;overflow:hidden;background:linear-gradient(135deg,#002B8A 0%,#0045d8 50%,#0052FF 100%);padding:5rem 0;">
        <div style="position:absolute;top:-80px;left:50%;transform:translateX(-50%);width:500px;height:300px;background:radial-gradient(ellipse,rgba(255,255,255,0.15) 0%,transparent 70%);pointer-events:none;"></div>
        <div style="position:absolute;bottom:-60px;left:-60px;width:280px;height:280px;background:radial-gradient(circle,rgba(255,255,255,0.1) 0%,transparent 70%);border-radius:50%;pointer-events:none;"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center" style="position:relative;z-index:1;">
            <span style="font-size:11px;font-weight:800;color:#dbeafe;text-transform:uppercase;letter-spacing:0.08em;background:rgba(255,255,255,0.15);border:1px solid rgba(255,255,255,0.25);padding:5px 14px;border-radius:999px;display:inline-block;margin-bottom:1.25rem;">Get Started Today</span>
            <h2 class="font-heading font-extrabold" style="color:#ffffff;font-size:clamp(1.7rem,4vw,2.5rem);margin-bottom:14px;">
                Ready to Simplify Your Taxes &amp; Accounting?
            </h2>
            <p style="color:#dbeafe;font-size:1rem;margin-bottom:32px;max-width:520px;margin-left:auto;margin-right:auto;line-height:1.7;">
                Join thousands of satisfied Canadian businesses and individuals who trust YONBUS for all their financial needs.
            </p>
            <div style="display:flex;flex-wrap:wrap;gap:1rem;justify-content:center;">
                <a href="{{ route('register') }}"
                   style="display:inline-flex;align-items:center;gap:8px;background:#ffffff;color:#002B8A;font-weight:700;font-size:0.95rem;padding:14px 30px;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,0.15);text-decoration:none;transition:all 0.2s;"
                   onmouseenter="this.style.boxShadow='0 12px 32px rgba(0,0,0,0.25)';this.style.transform='translateY(-2px)';"
                   onmouseleave="this.style.boxShadow='0 8px 24px rgba(0,0,0,0.15)';this.style.transform='translateY(0)';">
                    Get Started Free
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
                <a href="{{ route('book-appointment') }}"
                   style="display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,0.15);backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);border:1.5px solid rgba(255,255,255,0.35);color:#ffffff;font-weight:600;font-size:0.95rem;padding:14px 26px;border-radius:12px;text-decoration:none;transition:all 0.2s;"
                   onmouseenter="this.style.background='rgba(255,255,255,0.25)';"
                   onmouseleave="this.style.background='rgba(255,255,255,0.15)';">
                    Book Consultation
                </a>
            </div>
        </div>
    </section>

</x-public-layout>
