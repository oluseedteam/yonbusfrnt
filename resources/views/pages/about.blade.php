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

    {{-- ============================================================
         GOOGLE MAPS REVIEWS MARQUEE
         ============================================================ --}}
    @php
        $googleReviews = [
            [
                'name' => 'Marc-André Tremblay',
                'location' => 'Gatineau, QC',
                'initials' => 'MT',
                'color' => 'from-blue-600 to-indigo-700',
                'rating' => 5,
                'time' => '3 weeks ago',
                'service' => 'Corporate Tax (T2) & Quebec Return',
                'text' => 'Exceptional tax and accounting service! Olubukunola and Adeshola handled our corporate T2 and provincial returns with extreme precision. Saved us hours of stress and maximized our tax credits. Best tax firm in Gatineau!',
            ],
            [
                'name' => 'Sarah Jenkins',
                'location' => 'Ottawa, ON',
                'initials' => 'SJ',
                'color' => 'from-emerald-600 to-teal-700',
                'rating' => 5,
                'time' => '1 month ago',
                'service' => 'Bookkeeping & Payroll Management',
                'text' => 'Yonbus has been managing my small business bookkeeping and payroll for over 2 years now. Accurate, responsive, and always on time. Having certified CPB professionals on your side makes a huge difference. Highly recommend!',
            ],
            [
                'name' => 'Emmanuel Adebayo',
                'location' => 'Montreal, QC',
                'initials' => 'EA',
                'color' => 'from-amber-600 to-orange-700',
                'rating' => 5,
                'time' => '1 month ago',
                'service' => 'Personal Tax Return (T1)',
                'text' => 'Super smooth and transparent process from consultation to final CRA filing. They explained everything clearly and got me an incredible refund. The client portal makes uploading documents effortless and secure.',
            ],
            [
                'name' => 'Sophie Lavoie',
                'location' => 'Gatineau, QC',
                'initials' => 'SL',
                'color' => 'from-purple-600 to-pink-700',
                'rating' => 5,
                'time' => '2 months ago',
                'service' => 'Déclarations d\'impôts de Société',
                'text' => 'Service impeccable et très professionnel! Pour nos déclarations d\'impôts de société et personnelles au Québec, Yonbus est d\'une compétence remarquable. Une équipe chaleureuse, bilingue et toujours disponible.',
            ],
            [
                'name' => 'David R. Thompson',
                'location' => 'Toronto, ON',
                'initials' => 'DT',
                'color' => 'from-cyan-600 to-blue-700',
                'rating' => 5,
                'time' => '2 months ago',
                'service' => 'Task Audit Support & Defense',
                'text' => 'I was audited by the CRA for a previous fiscal year and panicked. Yonbus stepped in, organized all documentation, communicated directly with the CRA, and resolved everything in our favor. True lifesavers!',
            ],
            [
                'name' => 'Fatima Al-Mansoor',
                'location' => 'Gatineau, QC',
                'initials' => 'FA',
                'color' => 'from-rose-600 to-red-700',
                'rating' => 5,
                'time' => '3 months ago',
                'service' => 'Tax Planning & Advisory',
                'text' => 'Fast, reliable, and extremely knowledgeable about cross-province tax regulations. Booked online, had a virtual consultation, and my taxes were filed in 48 hours. 5 stars all the way!',
            ],
            [
                'name' => 'Jean-Luc Bouchard',
                'location' => 'Hull, Gatineau',
                'initials' => 'JB',
                'color' => 'from-indigo-600 to-violet-700',
                'rating' => 5,
                'time' => '3 months ago',
                'service' => 'Tenue de livres & Consultation PME',
                'text' => 'Excellente expertise en comptabilité et conformité fiscale. Des professionnels certifiés qui prennent le temps de bien conseiller pour la croissance de votre entreprise. Je recommande sans hésitation.',
            ],
            [
                'name' => 'Michael Chen',
                'location' => 'Vancouver, BC',
                'initials' => 'MC',
                'color' => 'from-teal-600 to-emerald-700',
                'rating' => 5,
                'time' => '4 months ago',
                'service' => 'Remote Corporate Tax Filing',
                'text' => 'Even though I am in BC and they are based in Gatineau, their virtual consultation and secure client portal made working with them seamless. Outstanding service for my IT consulting business.',
            ],
        ];
    @endphp

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

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6 sm:mb-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4 sm:gap-6">

                {{-- Left Google Rating Header --}}
                <div class="flex items-center gap-3.5 sm:gap-4">
                    <div class="w-12 h-12 rounded-2xl p-2.5 flex items-center justify-center flex-shrink-0 shadow-lg" style="background: #ffffff;">
                        <svg class="w-7 h-7" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                        </svg>
                    </div>

                    <div>
                        <div class="flex items-center gap-2 flex-wrap">
                            <span class="font-heading font-extrabold text-white text-lg tracking-wide" style="color: #FFFFFF !important;">EXCELLENT</span>
                            <div class="flex items-center gap-0.5" style="color: #FACC15;">
                                @for($i = 0; $i < 5; $i++)
                                <svg class="w-4 h-4 text-amber-400 fill-current" viewBox="0 0 20 20" style="color: #FACC15 !important;">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                @endfor
                            </div>
                            <span style="color: #FACC15 !important; font-weight: 800; font-size: 16px;">5.0</span>
                            <span style="color: #93C5FD !important; font-weight: 600; font-size: 13px;">on Google</span>
                        </div>
                        <p style="color: #BAE6FD !important; font-size: 13px; margin: 3px 0 0 0;">
                            Verified Client Reviews for <strong style="color: #FFFFFF !important; font-weight: 700;">YONBUS TAX &amp; ACCOUNTING SERVICES INC</strong>
                        </p>
                    </div>
                </div>

                {{-- Right Direct Google Maps Link Button --}}
                <div class="flex items-center gap-3">
                    <a href="https://maps.app.goo.gl/NexvduvFo4Ajab9H9?g_st=iw"
                       target="_blank"
                       rel="noopener noreferrer"
                       style="background: #1D4ED8; border: 1.5px solid #60A5FA; color: #FFFFFF !important; padding: 10px 18px; border-radius: 12px; font-size: 13px; font-weight: 700; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; box-shadow: 0 4px 15px rgba(29, 78, 216, 0.4); transition: all 0.25s;"
                       onmouseenter="this.style.background='#2563EB';this.style.transform='scale(1.04)';"
                       onmouseleave="this.style.background='#1D4ED8';this.style.transform='scale(1)';"
                       class="hover-lift">
                        <svg style="width: 16px; height: 16px; color: #93C5FD;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span style="color: #FFFFFF !important;">View on Google Maps</span>
                        <svg style="width: 14px; height: 14px; color: #93C5FD;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                </div>

            </div>
        </div>

        {{-- Marquee Scrolling Container with Gradient Fade Edges --}}
        <div class="relative w-full overflow-hidden py-3"
             style="mask-image: linear-gradient(to right, transparent 0%, black 4%, black 96%, transparent 100%); -webkit-mask-image: linear-gradient(to right, transparent 0%, black 4%, black 96%, transparent 100%);">
            
            {{-- Infinite Moving Track --}}
            <div class="about-reviews-marquee-track">
                @foreach(array_merge($googleReviews, $googleReviews) as $review)
                <div class="about-review-card-box">
                    
                    {{-- Reviewer Top Row --}}
                    <div>
                        <div class="flex items-start justify-between gap-3 mb-3">
                            <div class="flex items-center gap-3">
                                <div style="background: linear-gradient(135deg, #2563EB 0%, #0284C7 100%); color: #FFFFFF !important; font-weight: 800; font-size: 14px; border: 2px solid rgba(255,255,255,0.3); width: 42px; height: 42px; border-radius: 9999px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 4px 10px rgba(0,0,0,0.35);">
                                    {{ $review['initials'] }}
                                </div>
                                <div>
                                    <h4 style="color: #FFFFFF !important; font-family: 'Outfit', sans-serif; font-size: 15px; font-weight: 700; line-height: 1.25; margin: 0;">
                                        {{ $review['name'] }}
                                    </h4>
                                    <p style="color: #93C5FD !important; font-size: 12px; margin: 2px 0 0 0; font-weight: 500;">
                                        {{ $review['location'] }}
                                    </p>
                                </div>
                            </div>

                            {{-- Google Verified Pill --}}
                            <div style="background: rgba(255, 255, 255, 0.12); border: 1px solid rgba(255, 255, 255, 0.25); border-radius: 999px; padding: 3px 8px; display: inline-flex; align-items: center; gap: 4px; flex-shrink: 0;">
                                <svg style="width: 12px; height: 12px;" viewBox="0 0 24 24">
                                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                                </svg>
                                <span style="color: #E0F2FE !important; font-size: 11px; font-weight: 600;">Verified</span>
                            </div>
                        </div>

                        {{-- Stars & Timestamp --}}
                        <div class="flex items-center justify-between gap-2 mb-3">
                            <div class="flex items-center gap-0.5" style="color: #FACC15;">
                                @for($i = 0; $i < $review['rating']; $i++)
                                <svg class="w-4 h-4 text-amber-400 fill-current" viewBox="0 0 20 20" style="color: #FACC15 !important;">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                @endfor
                            </div>
                            <span style="color: #94A3B8 !important; font-size: 11.5px; font-weight: 500;">
                                {{ $review['time'] }}
                            </span>
                        </div>

                        {{-- Review Text --}}
                        <p style="color: #F1F5F9 !important; font-size: 13.5px; line-height: 1.65; margin: 0 0 16px 0; font-weight: 400;">
                            "{!! nl2br(e($review['text'])) !!}"
                        </p>
                    </div>

                    {{-- Service Tag Footer --}}
                    <div class="pt-3 flex items-center justify-between" style="border-top: 1px solid rgba(255, 255, 255, 0.12);">
                        <span style="background: rgba(37, 99, 235, 0.3); color: #93C5FD !important; border: 1px solid rgba(96, 165, 250, 0.35); font-size: 11px; font-weight: 600; padding: 4px 10px; border-radius: 6px; display: inline-block;">
                            {{ $review['service'] }}
                        </span>
                        <span style="color: #60A5FA !important; font-size: 11px; font-weight: 700; display: inline-flex; align-items: center; gap: 3px;">
                            Google Review ★ 5.0
                        </span>
                    </div>

                </div>
                @endforeach
            </div>

        </div>

    </section>

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
