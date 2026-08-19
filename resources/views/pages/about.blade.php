<x-public-layout>
    <x-slot name="title">About Us | YONBUS Tax & Accounting Services Inc.</x-slot>

    {{-- Header Banner (Deep Blue to Blue Gradient) --}}
    <section style="background: linear-gradient(135deg, #002B8A 0%, #0045d8 50%, #0052FF 100%); color: #ffffff; padding: 5rem 0;" data-aos="fade-down">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
            <span style="font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; color: #ffffff; background: rgba(255,255,255,0.18); padding: 5px 16px; border-radius: 999px; border: 1px solid rgba(255,255,255,0.3);">About Our Firm</span>
            <h1 class="font-heading font-extrabold" style="font-size: clamp(2.2rem, 5vw, 3.5rem); color: #ffffff;">
                YONBUS Tax &amp; Accounting Services Inc.
            </h1>
            <p style="color: #dbeafe; font-size: 1.15rem; max-width: 600px; margin: 0 auto; font-weight: 400;">
                Your Partner in Financial Clarity and Growth
            </p>
        </div>
    </section>

    {{-- Main About Us Section (Clean White) --}}
    <section style="background: #ffffff; padding: 5rem 0;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">

                {{-- Left Column: Who We Are & Mission Quote --}}
                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    <span style="font-size: 11px; font-weight: 800; color: #0052ff; text-transform: uppercase; letter-spacing: 0.08em; background: #eff6ff; padding: 5px 16px; border-radius: 999px; border: 1px solid #bfdbfe; width: fit-content;">
                        ABOUT US
                    </span>
                    <h2 class="font-heading font-extrabold" style="color: #0a1a4a; font-size: clamp(1.8rem, 4vw, 2.5rem); line-height: 1.2;">
                        Who We Are
                    </h2>
                    <p style="color: #4b5563; font-size: 1rem; line-height: 1.75;">
                        <strong style="color: #0052ff;">Yonbus Tax & Accounting Services Inc.</strong> is a trusted partner committed to delivering reliable, efficient and compliant tax and accounting solutions to individuals, businesses and organizations across Canada.
                    </p>
                    <p style="color: #4b5563; font-size: 1rem; line-height: 1.75;">
                        We combine professional expertise with modern technology to help you keep accurate records, meet your tax obligations and make informed financial decisions.
                    </p>

                    {{-- Brochure Mission Quote Box (Deep Blue to Blue Gradient) --}}
                    <div style="background: linear-gradient(135deg, #002B8A 0%, #0052FF 100%); border-radius: 20px; padding: 26px 30px; color: #ffffff; margin-top: 0.5rem; position: relative; box-shadow: 0 8px 30px rgba(0,82,255,0.25);">
                        <div style="font-size: 2.2rem; color: #93c5fd; font-family: Georgia, serif; line-height: 1; margin-bottom: 6px;">“</div>
                        <p style="font-size: 1.05rem; font-style: italic; line-height: 1.65; color: #ffffff;">
                            Our goal is simple: To take the stress out of tax and accounting, so you can focus on what matters most – growing your business.
                        </p>
                    </div>
                </div>

                {{-- Right Column: OUR VALUES --}}
                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    <span style="font-size: 11px; font-weight: 800; color: #0052ff; text-transform: uppercase; letter-spacing: 0.08em; background: #eff6ff; padding: 5px 16px; border-radius: 999px; border: 1px solid #bfdbfe; width: fit-content;">
                        OUR VALUES
                    </span>
                    <h3 class="font-heading font-bold" style="color: #0a1a4a; font-size: 1.5rem; margin-bottom: 0.5rem;">
                        What We Stand For
                    </h3>

                    @php
                        $values = [
                            ['icon'=>'🛡️', 'title'=>'INTEGRITY', 'desc'=>'We uphold the highest standards of honesty and transparency in every interaction.'],
                            ['icon'=>'👔', 'title'=>'PROFESSIONALISM', 'desc'=>'We deliver quality service with deep expertise, diligence, and precision.'],
                            ['icon'=>'📈', 'title'=>'EXCELLENCE', 'desc'=>'We are committed to accuracy, efficiency, and continuous improvement.'],
                            ['icon'=>'🤝', 'title'=>'CLIENT FOCUS', 'desc'=>'We build lasting relationships by putting our clients\' financial success first.'],
                        ];
                    @endphp

                    @foreach($values as $v)
                    <div style="background: #f8faff; border: 1.5px solid #dbeafe; border-radius: 16px; padding: 20px; display: flex; align-items: flex-start; gap: 16px; transition: all 0.2s;"
                         onmouseenter="this.style.borderColor='#0052ff'; this.style.boxShadow='0 6px 20px rgba(0,82,255,0.08)';"
                         onmouseleave="this.style.borderColor='#dbeafe'; this.style.boxShadow='none';">
                        <div style="width: 44px; height: 44px; border-radius: 12px; background: #eff6ff; border: 1px solid #bfdbfe; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0;">
                            {{ $v['icon'] }}
                        </div>
                        <div>
                            <h4 class="font-heading font-bold" style="color: #0a1a4a; font-size: 1.05rem; margin-bottom: 4px;">{{ $v['title'] }}</h4>
                            <p style="color: #4b5563; font-size: 0.88rem; line-height: 1.55;">{{ $v['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
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
    <section class="relative overflow-hidden py-12 md:py-16"
             style="background: linear-gradient(180deg, #010A1F 0%, #031435 50%, #051A45 100%); border-top: 1.5px solid rgba(74, 161, 255, 0.25); border-bottom: 1.5px solid rgba(74, 161, 255, 0.25);">

        <style>
            @keyframes marqueeReviewSlideAbout {
                0% { transform: translate3d(0, 0, 0); }
                100% { transform: translate3d(-50%, 0, 0); }
            }
            @-webkit-keyframes marqueeReviewSlideAbout {
                0% { -webkit-transform: translate3d(0, 0, 0); }
                100% { -webkit-transform: translate3d(-50%, 0, 0); }
            }
            .about-reviews-marquee-track {
                display: flex !important;
                flex-direction: row !important;
                flex-wrap: nowrap !important;
                width: max-content !important;
                gap: 20px !important;
                animation: marqueeReviewSlideAbout 32s linear infinite !important;
                -webkit-animation: marqueeReviewSlideAbout 32s linear infinite !important;
                will-change: transform;
            }
            .about-reviews-marquee-track:hover {
                animation-play-state: paused !important;
                -webkit-animation-play-state: paused !important;
            }
            .about-review-card-box {
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
            .about-review-card-box:hover {
                transform: translateY(-4px) !important;
                border-color: #3b82f6 !important;
                box-shadow: 0 16px 36px rgba(37, 99, 235, 0.35) !important;
            }
            @media (max-width: 640px) {
                .about-review-card-box {
                    width: 300px !important;
                    min-width: 300px !important;
                    max-width: 300px !important;
                    padding: 18px !important;
                }
            }
        </style>

        {{-- Ambient Glows --}}
        <div class="absolute top-0 left-1/4 w-96 h-96 rounded-full opacity-20 pointer-events-none blur-3xl" style="background: radial-gradient(circle, #0052FF 0%, transparent 70%);"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 rounded-full opacity-20 pointer-events-none blur-3xl" style="background: radial-gradient(circle, #38BDF8 0%, transparent 70%);"></div>

        {{-- Marquee Scrolling Container with Gradient Fade Edges --}}
        <div class="relative w-full overflow-hidden py-3"
             style="mask-image: linear-gradient(to right, transparent 0%, black 4%, black 96%, transparent 100%); -webkit-mask-image: linear-gradient(to right, transparent 0%, black 4%, black 96%, transparent 100%);">
            
            {{-- Infinite Moving Track --}}
            <div class="about-reviews-marquee-track">
                @php
                    $displayReviews = count($googleReviews) < 4 ? array_merge($googleReviews, $googleReviews, $googleReviews, $googleReviews) : array_merge($googleReviews, $googleReviews);
                @endphp
                @foreach($displayReviews as $review)
                <div class="about-review-card-box">
                    
                    {{-- Reviewer Top Row --}}
                    <div>
                        <div class="flex items-center gap-3 mb-3">
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

                        {{-- Review Text --}}
                        <p style="color: #F1F5F9 !important; font-size: 13.5px; line-height: 1.65; margin: 0; font-weight: 400;">
                            "{!! nl2br(e($review['text'])) !!}"
                        </p>
                    </div>

                </div>
                @endforeach
            </div>

        </div>

    </section>
    @endif

    {{-- Bottom CTA Banner (Deep Blue to Blue Gradient) --}}
    <section style="position: relative; overflow: hidden; background: linear-gradient(135deg, #002B8A 0%, #0045d8 50%, #0052FF 100%); padding: 4.5rem 0; text-align: center; color: #ffffff;">
        <div style="position: absolute; top: -80px; left: 50%; transform: translateX(-50%); width: 500px; height: 280px; background: radial-gradient(ellipse, rgba(255,255,255,0.15) 0%, transparent 70%); pointer-events: none;"></div>
        <div style="position: absolute; bottom: -50px; right: -50px; width: 220px; height: 220px; background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%); border-radius: 50%; pointer-events: none;"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8" style="position: relative; z-index: 1;">
            <h2 class="font-heading font-extrabold" style="font-size: clamp(1.8rem, 4vw, 2.4rem); margin-bottom: 12px; color: #ffffff;">Ready to Partner with YONBUS?</h2>
            <p style="color: #dbeafe; font-size: 1rem; max-width: 520px; margin: 0 auto 1.75rem; line-height: 1.7;">
                Book a consultation today or contact our office to discuss how we can support your financial goals.
            </p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="{{ route('register') }}" style="background: #ffffff; color: #002B8A; font-weight: 700; font-size: 0.95rem; padding: 14px 30px; border-radius: 12px; text-decoration: none; box-shadow: 0 8px 24px rgba(0,0,0,0.15); transition: all 0.2s;"
                   onmouseenter="this.style.boxShadow='0 12px 32px rgba(0,0,0,0.25)'; this.style.transform='translateY(-2px)';" onmouseleave="this.style.boxShadow='0 8px 24px rgba(0,0,0,0.15)'; this.style.transform='translateY(0)';">
                    Get Started Free
                </a>
                <a href="{{ route('book-appointment') }}" style="background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border: 1.5px solid rgba(255,255,255,0.35); color: #ffffff; font-weight: 600; font-size: 0.95rem; padding: 14px 26px; border-radius: 12px; text-decoration: none; transition: all 0.2s;"
                   onmouseenter="this.style.background='rgba(255,255,255,0.25)';" onmouseleave="this.style.background='rgba(255,255,255,0.15)';">
                    Book Consultation
                </a>
            </div>
        </div>
    </section>
</x-public-layout>
