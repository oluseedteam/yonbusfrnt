<x-public-layout>
    <x-slot name="title">About Us | YONBUS Tax & Accounting Services Inc.</x-slot>

    {{-- ── HERO ─────────────────────────────────────────── --}}
    <section class="relative py-20 sm:py-24 text-center overflow-hidden" style="background: linear-gradient(135deg, #0f172a 0%, #031B4E 50%, #005DFF 100%);" data-aos="fade-down">
        <div style="position:absolute;inset:0;background:url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.04\'%3E%3Ccircle cx=\'30\' cy=\'30\' r=\'2\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-4">
            <span class="text-xs font-bold uppercase tracking-widest text-blue-200 bg-white/10 px-4 py-1.5 rounded-full border border-white/20 backdrop-blur-md inline-block">
                About Our Firm
            </span>
            <h1 class="text-3xl sm:text-5xl font-extrabold text-white font-heading tracking-tight">
                YONBUS Tax &amp; Accounting Services Inc.
            </h1>
            <p class="text-blue-100/90 text-base sm:text-lg max-w-2xl mx-auto font-normal leading-relaxed">
                Your Partner in Financial Clarity and Growth — trusted by 5,000+ Canadian individuals and businesses.
            </p>
        </div>
    </section>

    {{-- ── WHO WE ARE + VALUES ──────────────────────────── --}}
    <section style="background:#FFFFFF; padding: 5rem 0; border-top: 4px solid #005DFF;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-start">

                {{-- Left: Who We Are --}}
                <div style="display:flex;flex-direction:column;gap:1.5rem;">
                    <div>
                        <span style="display:inline-block;background:#F1F5F9;border:1.5px solid #CBD5E1;color:#005DFF;font-size:11px;font-weight:800;text-transform:uppercase;letter-spacing:0.08em;padding:5px 16px;border-radius:999px;margin-bottom:1rem;">
                            About Us
                        </span>
                        <h2 class="font-heading font-extrabold" style="color:#031B4E;font-size:clamp(1.8rem,4vw,2.5rem);line-height:1.2;margin-bottom:1rem;">
                            Who We Are
                        </h2>
                        <div style="display:flex;flex-direction:column;gap:1rem;">
                            <p style="color:#374151;font-size:1rem;line-height:1.8;">
                                <strong style="color:#031B4E;">Yonbus Tax &amp; Accounting Services Inc.</strong> is a trusted partner committed to delivering reliable, efficient and compliant tax and accounting solutions to individuals, businesses and organizations across Canada.
                            </p>
                            <p style="color:#374151;font-size:1rem;line-height:1.8;">
                                We combine professional expertise with modern technology to help you keep accurate records, meet your tax obligations and make informed financial decisions.
                            </p>
                        </div>
                    </div>

                    {{-- Mission Quote --}}
                    <div style="background:linear-gradient(135deg,#F1F5F9,#CBD5E1);border:2px solid #CBD5E1;border-left:4px solid #005DFF;border-radius:16px;padding:24px 28px;position:relative;">
                        <div style="font-size:2.5rem;color:#005DFF;font-family:Georgia,serif;line-height:0.8;margin-bottom:8px;opacity:0.6;">"</div>
                        <p style="font-size:1rem;font-style:italic;line-height:1.7;color:#031B4E;font-weight:500;">
                            Our goal is simple: To take the stress out of tax and accounting, so you can focus on what matters most — growing your business.
                        </p>
                    </div>

                    {{-- Quick Stats --}}
                    <div class="grid grid-cols-3 gap-4">
                        @foreach([
                            ['num'=>'5,000+','label'=>'Clients Served'],
                            ['num'=>'10+','label'=>'Years Experience'],
                            ['num'=>'98%','label'=>'Compliance Rate'],
                        ] as $s)
                        <div style="background:#F5F9FF;border:1px solid #E2E8F0;border-radius:16px;padding:18px 12px;text-align:center;">
                            <div class="font-heading font-extrabold" style="font-size:1.6rem;color:#031B4E;line-height:1;">{{ $s['num'] }}</div>
                            <div style="font-size:0.75rem;color:#005DFF;font-weight:700;margin-top:4px;text-transform:uppercase;letter-spacing:0.04em;">{{ $s['label'] }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Right: Our Values --}}
                <div style="display:flex;flex-direction:column;gap:1rem;">
                    <div>
                        <span style="display:inline-block;background:#F1F5F9;border:1.5px solid #CBD5E1;color:#005DFF;font-size:11px;font-weight:800;text-transform:uppercase;letter-spacing:0.08em;padding:5px 16px;border-radius:999px;margin-bottom:1rem;">
                            Our Values
                        </span>
                        <h3 class="font-heading font-bold" style="color:#031B4E;font-size:1.5rem;margin-bottom:1.25rem;">
                            What We Stand For
                        </h3>
                    </div>

                    @php
                        $values = [
                            ['icon'=>'🛡️','title'=>'Integrity','desc'=>'We uphold the highest standards of honesty and transparency in every client interaction.'],
                            ['icon'=>'👔','title'=>'Professionalism','desc'=>'We deliver quality service with deep expertise, diligence, and precision at every step.'],
                            ['icon'=>'📈','title'=>'Excellence','desc'=>'We are committed to accuracy, efficiency, and continuous improvement in all we do.'],
                            ['icon'=>'🤝','title'=>'Client Focus','desc'=>"We build lasting relationships by putting our clients' financial success first, always."],
                        ];
                    @endphp

                    @foreach($values as $v)
                    <div style="background:#ffffff;border:2px solid #CBD5E1;border-radius:16px;padding:20px;display:flex;align-items:flex-start;gap:16px;transition:all 0.25s;"
                         onmouseenter="this.style.borderColor='#005DFF';this.style.boxShadow='0 6px 24px rgba(37,99,235,0.14)';this.style.transform='translateX(4px)';"
                         onmouseleave="this.style.borderColor='#CBD5E1';this.style.boxShadow='none';this.style.transform='translateX(0)';">
                        <div style="width:48px;height:48px;border-radius:14px;background:#F1F5F9;border:2px solid #CBD5E1;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0;">
                            {{ $v['icon'] }}
                        </div>
                        <div>
                            <h4 class="font-heading font-bold" style="color:#031B4E;font-size:1rem;margin-bottom:5px;">{{ $v['title'] }}</h4>
                            <p style="color:#374151;font-size:0.87rem;line-height:1.6;">{{ $v['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
    </section>

    {{-- ── WHAT MAKES US DIFFERENT ─────────────────────── --}}
    <section class="overflow-hidden" data-aos="fade-up">
        {{-- Section Header Banner with Rich Gradient --}}
        <div style="background: linear-gradient(135deg, #031B4E 0%, #063B8F 50%, #005DFF 100%); color: white; padding: 4.5rem 1.5rem; text-align: center;">
            <div class="max-w-4xl mx-auto" style="display: flex; flex-direction: column; gap: 1rem; align-items: center;">
                <span style="font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; color: #93C5FD; background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); padding: 6px 18px; border-radius: 999px; display: inline-block;">
                    Why Choose Us
                </span>
                <h2 class="font-heading font-extrabold" style="font-size: clamp(2rem, 4vw, 3rem); color: #FFFFFF; line-height: 1.2;">
                    What Makes YONBUS Different
                </h2>
                <p style="color: rgba(219,234,254,0.9); font-size: 1.1rem; max-width: 560px; line-height: 1.7;">
                    We go beyond numbers — we deliver peace of mind, compliance confidence, and business growth.
                </p>
            </div>
        </div>

        {{-- Grid Container --}}
        <div style="background: #F8FBFF; padding: 3.5rem 0; border-bottom: 1px solid #E2E8F0;">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach([
                        ['icon'=>'📋','title'=>'Full-Service Accounting','desc'=>'From bookkeeping to auditing, tax filing to payroll — all your financial needs under one roof.'],
                        ['icon'=>'⚡','title'=>'Fast Turnaround','desc'=>'We respect your time. Our team delivers accurate work on schedule, every single time.'],
                        ['icon'=>'🔒','title'=>'Secure &amp; Confidential','desc'=>'Your financial data is handled with bank-level care. Complete confidentiality guaranteed.'],
                        ['icon'=>'🇨🇦','title'=>'Canada-Wide Service','desc'=>'We serve clients in Quebec, Ontario, and provinces across Canada with equal dedication.'],
                        ['icon'=>'💡','title'=>'Strategic Advice','desc'=>'Beyond compliance — we proactively identify opportunities to save you money and grow.'],
                        ['icon'=>'📱','title'=>'Modern Client Portal','desc'=>'Manage your documents, reports, and communication anytime through our secure portal.'],
                    ] as $f)
                    <div style="background:#FFFFFF;border:1.5px solid #E2E8F0;border-radius:20px;padding:28px 22px;box-shadow:0 4px 16px rgba(3,27,78,0.05);transition:all 0.3s;text-align:center;"
                         onmouseenter="this.style.borderColor='#005DFF';this.style.transform='translateY(-4px)';this.style.boxShadow='0 14px 32px rgba(0,93,255,0.12)';"
                         onmouseleave="this.style.borderColor='#E2E8F0';this.style.transform='translateY(0)';this.style.boxShadow='0 4px 16px rgba(3,27,78,0.05)';">
                        <div style="width:52px;height:52px;background:linear-gradient(135deg,#063B8F,#005DFF);border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;margin:0 auto 14px;box-shadow:0 4px 14px rgba(0,93,255,0.25);">{{ $f['icon'] }}</div>
                        <h4 class="font-heading font-bold" style="color:#031B4E;font-size:1.05rem;margin-bottom:8px;">{{ $f['title'] }}</h4>
                        <p style="color:#475569;font-size:0.88rem;line-height:1.65;">{{ $f['desc'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ── SOCIAL MEDIA ─────────────────────────────────── --}}
    <section class="overflow-hidden">
        <div style="background: linear-gradient(135deg, #031B4E 0%, #063B8F 50%, #005DFF 100%); color: white; padding: 4rem 1.5rem; text-align: center;">
            <div class="max-w-4xl mx-auto" style="display: flex; flex-direction: column; gap: 1rem; align-items: center;">
                <span style="font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; color: #93C5FD; background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); padding: 6px 18px; border-radius: 999px; display: inline-block;">
                    Connect With Us
                </span>
                <h2 class="font-heading font-extrabold" style="font-size: clamp(1.8rem, 4vw, 2.8rem); color: #FFFFFF; line-height: 1.2;">
                    Follow YONBUS on Social Media
                </h2>
                <p style="color: rgba(219,234,254,0.9); font-size: 1rem; max-width: 500px; line-height: 1.7;">
                    Stay updated with tax tips, financial news, and company announcements.
                </p>
            </div>
        </div>

        <div style="background: #FFFFFF; padding: 2.5rem 0; border-bottom: 1px solid #E2E8F0;">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div style="display:flex;justify-content:center;align-items:center;gap:12px;flex-wrap:wrap;">
                    <a href="https://facebook.com/yonbustax" target="_blank" rel="noopener"
                       style="display:flex;align-items:center;gap:9px;padding:12px 20px;background:#F1F5F9;border:2px solid #CBD5E1;border-radius:14px;text-decoration:none;color:#031B4E;font-size:0.88rem;font-weight:700;transition:all 0.2s;"
                       onmouseenter="this.style.background='#1877F2';this.style.borderColor='#1877F2';this.style.color='#ffffff';"
                       onmouseleave="this.style.background='#F1F5F9';this.style.borderColor='#CBD5E1';this.style.color='#031B4E';">
                        <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073C24 5.405 18.627 0 12 0S0 5.405 0 12.073C0 18.1 4.388 23.094 10.125 24v-8.437H7.078v-3.49h3.047V9.41c0-3.025 1.792-4.697 4.533-4.697 1.312 0 2.686.235 2.686.235v2.97h-1.513c-1.491 0-1.956.93-1.956 1.874v2.25h3.328l-.532 3.49h-2.796V24C19.612 23.094 24 18.1 24 12.073z"/></svg>
                        Facebook
                    </a>

                    <a href="https://instagram.com/yonbustax" target="_blank" rel="noopener"
                       style="display:flex;align-items:center;gap:9px;padding:12px 20px;background:#F1F5F9;border:2px solid #CBD5E1;border-radius:14px;text-decoration:none;color:#031B4E;font-size:0.88rem;font-weight:700;transition:all 0.2s;"
                       onmouseenter="this.style.background='linear-gradient(45deg,#f09433,#e6683c,#dc2743,#cc2366,#bc1888)';this.style.borderColor='#cc2366';this.style.color='#ffffff';"
                       onmouseleave="this.style.background='#F1F5F9';this.style.borderColor='#CBD5E1';this.style.color='#031B4E';">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><defs><radialGradient id="ig2" cx="30%" cy="107%" r="150%"><stop offset="0%" stop-color="#fdf497"/><stop offset="45%" stop-color="#fd5949"/><stop offset="60%" stop-color="#d6249f"/><stop offset="90%" stop-color="#285AEB"/></radialGradient></defs><rect width="24" height="24" rx="5.5" fill="url(#ig2)"/><circle cx="12" cy="12" r="4.5" stroke="#fff" stroke-width="1.8"/><circle cx="17.5" cy="6.5" r="1.2" fill="#fff"/></svg>
                        Instagram
                    </a>

                    <a href="https://tiktok.com/@yonbustax" target="_blank" rel="noopener"
                       style="display:flex;align-items:center;gap:9px;padding:12px 20px;background:#F1F5F9;border:2px solid #CBD5E1;border-radius:14px;text-decoration:none;color:#031B4E;font-size:0.88rem;font-weight:700;transition:all 0.2s;"
                       onmouseenter="this.style.background='#000000';this.style.borderColor='#000000';this.style.color='#ffffff';"
                       onmouseleave="this.style.background='#F1F5F9';this.style.borderColor='#CBD5E1';this.style.color='#031B4E';">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.5 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 0 0-.79-.05 6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 6.33-6.34V8.69a8.18 8.18 0 0 0 4.78 1.52V6.75a4.85 4.85 0 0 1-1.01-.06z"/></svg>
                        TikTok
                    </a>

                    <a href="https://x.com/yonbustax" target="_blank" rel="noopener"
                       style="display:flex;align-items:center;gap:9px;padding:12px 20px;background:#F1F5F9;border:2px solid #CBD5E1;border-radius:14px;text-decoration:none;color:#031B4E;font-size:0.88rem;font-weight:700;transition:all 0.2s;"
                       onmouseenter="this.style.background='#000000';this.style.borderColor='#000000';this.style.color='#ffffff';"
                       onmouseleave="this.style.background='#F1F5F9';this.style.borderColor='#CBD5E1';this.style.color='#031B4E';">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.746l7.73-8.835L1.254 2.25H8.08l4.258 5.63L18.244 2.25zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        X (Twitter)
                    </a>

                    <a href="https://linkedin.com/company/yonbustax" target="_blank" rel="noopener"
                       style="display:flex;align-items:center;gap:9px;padding:12px 20px;background:#F1F5F9;border:2px solid #CBD5E1;border-radius:14px;text-decoration:none;color:#031B4E;font-size:0.88rem;font-weight:700;transition:all 0.2s;"
                       onmouseenter="this.style.background='#0A66C2';this.style.borderColor='#0A66C2';this.style.color='#ffffff';"
                       onmouseleave="this.style.background='#F1F5F9';this.style.borderColor='#CBD5E1';this.style.color='#031B4E';">
                        <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        LinkedIn
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ── CTA BANNER ───────────────────────────────────── --}}
    <section class="relative overflow-hidden py-16 sm:py-20 text-center" style="background: linear-gradient(135deg, #031B4E 0%, #063B8F 50%, #005DFF 100%);">
        <div style="position:absolute;top:-80px;left:50%;transform:translateX(-50%);width:500px;height:280px;background:radial-gradient(ellipse,rgba(255,255,255,0.12) 0%,transparent 70%);pointer-events:none;"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-4">
            <span class="text-xs font-bold uppercase tracking-widest text-blue-200 bg-white/10 px-4 py-1.5 rounded-full border border-white/20 backdrop-blur-md inline-block">
                Get Started Today
            </span>
            <h2 class="text-3xl sm:text-5xl font-extrabold text-white font-heading tracking-tight">
                Ready to Partner with YONBUS?
            </h2>
            <p class="text-blue-100/90 text-base sm:text-lg max-w-2xl mx-auto font-normal leading-relaxed">
                Book a consultation today or contact our office to discuss how we can support your financial goals.
            </p>
            <div style="display:flex;gap:14px;justify-content:center;flex-wrap:wrap;padding-top:1rem;">
                <a href="{{ route('register') }}"
                   style="background:#ffffff;color:#031B4E;font-weight:700;font-size:0.95rem;padding:14px 30px;border-radius:12px;text-decoration:none;box-shadow:0 8px 24px rgba(0,0,0,0.2);transition:all 0.2s;display:inline-flex;align-items:center;gap:8px;"
                   onmouseenter="this.style.boxShadow='0 12px 32px rgba(0,0,0,0.3)';this.style.transform='translateY(-2px)';"
                   onmouseleave="this.style.boxShadow='0 8px 24px rgba(0,0,0,0.2)';this.style.transform='translateY(0)';">
                    Get Started Free
                    <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
                <a href="{{ route('book-appointment') }}"
                   style="background:rgba(255,255,255,0.12);backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);border:1.5px solid rgba(255,255,255,0.35);color:#ffffff;font-weight:600;font-size:0.95rem;padding:14px 26px;border-radius:12px;text-decoration:none;transition:all 0.2s;display:inline-flex;align-items:center;gap:8px;"
                   onmouseenter="this.style.background='rgba(255,255,255,0.22)';"
                   onmouseleave="this.style.background='rgba(255,255,255,0.12)';">
                    Book Consultation
                </a>
            </div>
        </div>
    </section>

</x-public-layout>
