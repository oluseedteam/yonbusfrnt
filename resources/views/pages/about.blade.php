<x-public-layout>
    <x-slot name="title">About Us | YONBUS Tax & Accounting Services Inc.</x-slot>

    {{-- Header Banner --}}
    <section style="background: linear-gradient(135deg, #002B8A 0%, #0045d8 50%, #0052FF 100%); padding: 4.5rem 0; text-align: center; color: #ffffff;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span style="font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; color: #93c5fd; background: rgba(255,255,255,0.12); padding: 6px 16px; border-radius: 999px; border: 1px solid rgba(255,255,255,0.2);">
                About Our Firm
            </span>
            <h1 class="font-heading font-extrabold" style="font-size: clamp(2.2rem, 5vw, 3.4rem); margin-top: 1rem; color: #ffffff;">
                YONBUS Tax & Accounting Services Inc.
            </h1>
            <p style="color: #bfdbfe; font-size: 1.1rem; max-width: 600px; margin: 0.5rem auto 0; font-weight: 400;">
                Your Partner in Financial Clarity and Growth
            </p>
        </div>
    </section>

    {{-- Main About Us Section --}}
    <section style="background: #ffffff; padding: 5rem 0;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">

                {{-- Left Column: Who We Are & Mission Quote --}}
                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    <span style="font-size: 11px; font-weight: 800; color: #0052ff; text-transform: uppercase; letter-spacing: 0.08em;">
                        ABOUT US
                    </span>
                    <h2 class="font-heading font-extrabold" style="color: #0a1a4a; font-size: clamp(1.8rem, 4vw, 2.5rem); line-height: 1.2;">
                        Who We Are
                    </h2>
                    <p style="color: #374151; font-size: 1rem; line-height: 1.75;">
                        <strong style="color: #0052ff;">Yonbus Tax & Accounting Services Inc.</strong> is a trusted partner committed to delivering reliable, efficient and compliant tax and accounting solutions to individuals, businesses and organizations across Canada.
                    </p>
                    <p style="color: #374151; font-size: 1rem; line-height: 1.75;">
                        We combine professional expertise with modern technology to help you keep accurate records, meet your tax obligations and make informed financial decisions.
                    </p>

                    {{-- Brochure Mission Quote Box --}}
                    <div style="background: #002B8A; border-radius: 20px; padding: 24px 28px; color: #ffffff; margin-top: 0.5rem; position: relative;">
                        <div style="font-size: 2rem; color: #60a5fa; font-family: Georgia, serif; line-height: 1; margin-bottom: 6px;">“</div>
                        <p style="font-size: 1rem; font-style: italic; line-height: 1.65; color: #f1f5f9;">
                            Our goal is simple: To take the stress out of tax and accounting, so you can focus on what matters most – growing your business.
                        </p>
                    </div>
                </div>

                {{-- Right Column: OUR VALUES --}}
                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    <span style="font-size: 11px; font-weight: 800; color: #0052ff; text-transform: uppercase; letter-spacing: 0.08em;">
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
                    <div style="background: #f8faff; border: 1.5px solid #e0e7ff; border-radius: 16px; padding: 20px; display: flex; align-items: flex-start; gap: 16px;">
                        <div style="width: 44px; height: 44px; border-radius: 12px; background: #eff6ff; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0;">
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

    {{-- Social Media Section --}}
    <section style="background: #f8faff; padding: 4rem 0; border-top: 1px solid #e0e7ff;">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span style="font-size: 11px; font-weight: 800; color: #0052ff; text-transform: uppercase; letter-spacing: 0.08em;">Follow Us</span>
            <h2 class="font-heading font-extrabold" style="color: #0a1a4a; font-size: clamp(1.5rem, 3vw, 2rem); margin: 0.5rem 0 0.75rem;">Connect With YONBUS on Social Media</h2>
            <p style="color: #4b5563; font-size: 0.95rem; margin-bottom: 2rem;">Stay updated with tax tips, financial news, and company updates.</p>
            <div style="display: flex; justify-content: center; align-items: center; gap: 1rem; flex-wrap: wrap;">

                {{-- Facebook --}}
                <a href="https://facebook.com/yonbustax" target="_blank" rel="noopener"
                   style="display: flex; align-items: center; gap: 10px; padding: 12px 20px; background: #ffffff; border: 1.5px solid #e0e7ff; border-radius: 14px; text-decoration: none; color: #1e293b; font-size: 0.88rem; font-weight: 600; transition: box-shadow 0.2s;"
                   onmouseenter="this.style.boxShadow='0 4px 16px rgba(0,82,255,0.12)'; this.style.borderColor='#0052ff';"
                   onmouseleave="this.style.boxShadow='none'; this.style.borderColor='#e0e7ff';">
                    <svg width="20" height="20" fill="#1877F2" viewBox="0 0 24 24"><path d="M24 12.073C24 5.405 18.627 0 12 0S0 5.405 0 12.073C0 18.1 4.388 23.094 10.125 24v-8.437H7.078v-3.49h3.047V9.41c0-3.025 1.792-4.697 4.533-4.697 1.312 0 2.686.235 2.686.235v2.97h-1.513c-1.491 0-1.956.93-1.956 1.874v2.25h3.328l-.532 3.49h-2.796V24C19.612 23.094 24 18.1 24 12.073z"/></svg>
                    Facebook
                </a>

                {{-- Instagram --}}
                <a href="https://instagram.com/yonbustax" target="_blank" rel="noopener"
                   style="display: flex; align-items: center; gap: 10px; padding: 12px 20px; background: #ffffff; border: 1.5px solid #e0e7ff; border-radius: 14px; text-decoration: none; color: #1e293b; font-size: 0.88rem; font-weight: 600;"
                   onmouseenter="this.style.boxShadow='0 4px 16px rgba(0,82,255,0.12)'; this.style.borderColor='#e1306c';"
                   onmouseleave="this.style.boxShadow='none'; this.style.borderColor='#e0e7ff';">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><defs><radialGradient id="ig1" cx="30%" cy="107%" r="150%"><stop offset="0%" stop-color="#fdf497"/><stop offset="5%" stop-color="#fdf497"/><stop offset="45%" stop-color="#fd5949"/><stop offset="60%" stop-color="#d6249f"/><stop offset="90%" stop-color="#285AEB"/></radialGradient></defs><rect width="24" height="24" rx="5.5" fill="url(#ig1)"/><circle cx="12" cy="12" r="4.5" stroke="#fff" stroke-width="1.8"/><circle cx="17.5" cy="6.5" r="1.2" fill="#fff"/></svg>
                    Instagram
                </a>

                {{-- TikTok --}}
                <a href="https://tiktok.com/@yonbustax" target="_blank" rel="noopener"
                   style="display: flex; align-items: center; gap: 10px; padding: 12px 20px; background: #ffffff; border: 1.5px solid #e0e7ff; border-radius: 14px; text-decoration: none; color: #1e293b; font-size: 0.88rem; font-weight: 600;"
                   onmouseenter="this.style.boxShadow='0 4px 16px rgba(0,82,255,0.12)'; this.style.borderColor='#010101';"
                   onmouseleave="this.style.boxShadow='none'; this.style.borderColor='#e0e7ff';">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="#010101"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.5 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 0 0-.79-.05 6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.33-6.34V8.69a8.18 8.18 0 0 0 4.78 1.52V6.75a4.85 4.85 0 0 1-1.01-.06z"/></svg>
                    TikTok
                </a>

                {{-- X / Twitter --}}
                <a href="https://x.com/yonbustax" target="_blank" rel="noopener"
                   style="display: flex; align-items: center; gap: 10px; padding: 12px 20px; background: #ffffff; border: 1.5px solid #e0e7ff; border-radius: 14px; text-decoration: none; color: #1e293b; font-size: 0.88rem; font-weight: 600;"
                   onmouseenter="this.style.boxShadow='0 4px 16px rgba(0,82,255,0.12)'; this.style.borderColor='#000000';"
                   onmouseleave="this.style.boxShadow='none'; this.style.borderColor='#e0e7ff';">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="#000000"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.746l7.73-8.835L1.254 2.25H8.08l4.258 5.63L18.244 2.25zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    X (Twitter)
                </a>

                {{-- LinkedIn --}}
                <a href="https://linkedin.com/company/yonbustax" target="_blank" rel="noopener"
                   style="display: flex; align-items: center; gap: 10px; padding: 12px 20px; background: #ffffff; border: 1.5px solid #e0e7ff; border-radius: 14px; text-decoration: none; color: #1e293b; font-size: 0.88rem; font-weight: 600;"
                   onmouseenter="this.style.boxShadow='0 4px 16px rgba(0,82,255,0.12)'; this.style.borderColor='#0077B5';"
                   onmouseleave="this.style.boxShadow='none'; this.style.borderColor='#e0e7ff';">
                    <svg width="20" height="20" fill="#0077B5" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    LinkedIn
                </a>

            </div>
        </div>
    </section>

    {{-- Bottom CTA (Glassmorphism) --}}
    <section style="position:relative;overflow:hidden;background:linear-gradient(135deg,#002B8A 0%,#0045d8 50%,#0052FF 100%);padding:4.5rem 0;text-align:center;color:#ffffff;">
        <div style="position:absolute;top:-80px;left:50%;transform:translateX(-50%);width:500px;height:280px;background:radial-gradient(ellipse,rgba(255,255,255,0.15) 0%,transparent 70%);pointer-events:none;"></div>
        <div style="position:absolute;bottom:-50px;right:-50px;width:220px;height:220px;background:radial-gradient(circle,rgba(255,255,255,0.1) 0%,transparent 70%);border-radius:50%;pointer-events:none;"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8" style="position:relative;z-index:1;">
            <span style="font-size:11px;font-weight:800;color:#dbeafe;text-transform:uppercase;letter-spacing:0.08em;background:rgba(255,255,255,0.15);border:1px solid rgba(255,255,255,0.25);padding:5px 14px;border-radius:999px;display:inline-block;margin-bottom:1rem;">Your Next Step</span>
            <h2 class="font-heading font-extrabold" style="font-size:clamp(1.8rem,4vw,2.5rem);margin-bottom:12px;">
                Ready to Work With Us?
            </h2>
            <p style="color:#dbeafe;font-size:1rem;max-width:520px;margin:0 auto 1.75rem;line-height:1.7;">
                Schedule a consultation today and discover how YONBUS can streamline your financial operations.
            </p>
            <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;">
                <a href="{{ route('book-appointment') }}" style="background:#ffffff;color:#0052ff;font-weight:700;font-size:0.95rem;padding:14px 30px;border-radius:12px;text-decoration:none;box-shadow:0 8px 24px rgba(0,0,0,0.15);transition:all 0.2s;"
                   onmouseenter="this.style.boxShadow='0 12px 32px rgba(0,0,0,0.25)';this.style.transform='translateY(-2px)';" onmouseleave="this.style.boxShadow='0 8px 24px rgba(0,0,0,0.15)';this.style.transform='translateY(0)';">Book Consultation</a>
                <a href="{{ route('contact') }}" style="background:rgba(255,255,255,0.15);backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);border:1.5px solid rgba(255,255,255,0.35);color:#ffffff;font-weight:600;font-size:0.95rem;padding:14px 26px;border-radius:12px;text-decoration:none;transition:all 0.2s;"
                   onmouseenter="this.style.background='rgba(255,255,255,0.25)';" onmouseleave="this.style.background='rgba(255,255,255,0.15)';">Contact Us</a>
            </div>
        </div>
    </section>
</x-public-layout>
