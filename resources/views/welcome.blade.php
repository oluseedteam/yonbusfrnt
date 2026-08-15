<x-public-layout>
    <x-slot name="title">YONBUS Tax & Accounting Services Inc. — Your Partner in Financial Clarity & Growth</x-slot>

    {{-- ============================================================
         HERO — Office background with vibrant deep blue to blue gradient overlay (No Black)
         ============================================================ --}}
    <section class="relative overflow-hidden" style="min-height: 90vh; display: flex; align-items: center; background: #002B8A;">
        {{-- Background Image with daylight office view & vibrant deepblue to blue gradient overlay --}}
        <div class="absolute inset-0" style="z-index: 0;">
            <img src="{{ asset('images/accounting-hero-bg.jpg') }}?v={{ file_exists(public_path('images/accounting-hero-bg.jpg')) ? filemtime(public_path('images/accounting-hero-bg.jpg')) : time() }}"
                 alt="YONBUS Corporate Office"
                 style="width: 100%; height: 100%; object-fit: cover; object-position: center; opacity: 1;">
            <div class="absolute inset-0" style="background: linear-gradient(105deg, rgba(0, 43, 138, 0.92) 0%, rgba(0, 69, 216, 0.78) 40%, rgba(0, 82, 255, 0.40) 72%, rgba(0, 163, 255, 0.18) 100%);"></div>
        </div>

        <div class="relative w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-28" style="z-index: 1;">
            <div class="max-w-2xl" style="display: flex; flex-direction: column; gap: 1.75rem;" data-aos="fade-right" data-aos-duration="800">

                {{-- Badge --}}
                <div class="inline-flex items-center gap-2" style="background: rgba(255, 255, 255, 0.16); border: 1.5px solid rgba(255, 255, 255, 0.35); color: #ffffff; padding: 7px 18px; border-radius: 999px; font-size: 11.5px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.07em; width: fit-content; backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); box-shadow: 0 4px 14px rgba(0,0,0,0.15);">
                    <svg style="width: 16px; height: 16px; color: #93c5fd; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    <span>TRUSTED BY 5,000+ CANADIAN BUSINESSES</span>
                </div>

                {{-- Main Headline --}}
                <h1 class="font-heading font-extrabold text-white" style="font-size: clamp(2.8rem, 5.6vw, 4.4rem); line-height: 1.12; letter-spacing: -0.025em; margin: 0;">
                    YONBUS Tax &amp;<br>
                    Accounting <span style="color: #60a5fa;">Services</span><br>
                    <span style="color: #60a5fa;">Inc.</span>
                </h1>

                {{-- Subheadline --}}
                <p style="color: #e0f2fe; font-size: clamp(1.05rem, 1.35vw, 1.2rem); line-height: 1.7; max-width: 540px; font-weight: 400; margin: 0;">
                    A trusted partner delivering reliable, efficient, and compliant tax and accounting solutions to individuals, businesses, and organizations across Canada.
                </p>

                {{-- Mission Quote --}}
                <div style="display: flex; align-items: flex-start; gap: 12px; background: rgba(0, 43, 138, 0.55); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border-left: 3px solid #60a5fa; border: 1px solid rgba(255,255,255,0.18); border-radius: 0 12px 12px 0; padding: 14px 18px; max-width: 500px;">
                    <p style="color: #dbeafe; font-size: 0.95rem; font-style: italic; line-height: 1.6; margin: 0;">
                        "Your Partner in Financial Clarity and Growth"
                    </p>
                </div>

                {{-- CTA Buttons --}}
                <div style="display: flex; flex-wrap: wrap; gap: 14px; align-items: center;">
                    <a href="{{ route('register') }}"
                       style="display: inline-flex; align-items: center; gap: 10px; background: linear-gradient(135deg, #002B8A 0%, #0052FF 100%); color: #ffffff; font-weight: 700; font-size: 1rem; padding: 15px 30px; border-radius: 12px; text-decoration: none; box-shadow: 0 8px 24px rgba(0,82,255,0.45); transition: all 0.2s;"
                       onmouseenter="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 12px 32px rgba(0,82,255,0.55)';"
                       onmouseleave="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 24px rgba(0,82,255,0.45)';">
                        Get Started Free
                        <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>

                    <a href="{{ route('book-appointment') }}"
                       style="display: inline-flex; align-items: center; gap: 10px; background: rgba(255,255,255,0.14); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border: 1.5px solid rgba(255,255,255,0.35); color: #ffffff; font-weight: 600; font-size: 1rem; padding: 15px 26px; border-radius: 12px; text-decoration: none; transition: all 0.2s;"
                       onmouseenter="this.style.background='rgba(255,255,255,0.24)'; this.style.borderColor='rgba(255,255,255,0.55)';"
                       onmouseleave="this.style.background='rgba(255,255,255,0.14)'; this.style.borderColor='rgba(255,255,255,0.35)';">
                        <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Book Consultation
                    </a>
                </div>

                {{-- Social Proof --}}
                <div style="display: flex; align-items: center; gap: 14px; flex-wrap: wrap;">
                    <div style="display: flex; align-items: center;">
                        <div style="width:36px;height:36px;border-radius:50%;border:2px solid #fff;background:#60a5fa;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:11px;box-shadow:0 2px 8px rgba(0,0,0,0.2);">JD</div>
                        <div style="width:36px;height:36px;border-radius:50%;border:2px solid #fff;background:#818cf8;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:11px;margin-left:-8px;box-shadow:0 2px 8px rgba(0,0,0,0.2);">SM</div>
                        <div style="width:36px;height:36px;border-radius:50%;border:2px solid #fff;background:#a78bfa;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:11px;margin-left:-8px;box-shadow:0 2px 8px rgba(0,0,0,0.2);">AK</div>
                        <div style="width:36px;height:36px;border-radius:50%;border:2px solid #fff;background:#38bdf8;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:11px;margin-left:-8px;box-shadow:0 2px 8px rgba(0,0,0,0.2);">LO</div>
                    </div>
                    <div>
                        <div style="display: flex; gap: 2px; margin-bottom: 2px;">
                            @for($i = 0; $i < 5; $i++)
                            <svg style="width: 14px; height: 14px; color: #fbbf24;" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                        <p style="color: #dbeafe; font-size: 0.8rem; margin: 0; font-weight: 500;">4.9/5 from 500+ reviews</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ============================================================
         STATS BAR (Deep Blue to Blue Gradient)
         ============================================================ --}}
    <section style="position: relative; overflow: hidden; background: linear-gradient(135deg, #002B8A 0%, #0045d8 50%, #0052FF 100%); padding: 3.5rem 0;" data-aos="fade-up" data-aos-duration="600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="position:relative;z-index:1;">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach([
                    ['num'=>'5,000+','label'=>'Satisfied Clients','icon'=>'👥'],
                    ['num'=>'10+','label'=>'Years of Expertise','icon'=>'🏆'],
                    ['num'=>'98%','label'=>'Compliance Rate','icon'=>'✅'],
                    ['num'=>'4.9★','label'=>'Client Rating','icon'=>'⭐'],
                ] as $s)
                <div class="hover-scale" style="background:rgba(255,255,255,0.12);border:1.5px solid rgba(255,255,255,0.22);border-radius:16px;padding:22px 16px;text-align:center;box-shadow:0 4px 20px rgba(0,0,0,0.1);backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);">
                    <div style="font-size:1.4rem;margin-bottom:6px;">{{ $s['icon'] }}</div>
                    <div class="font-heading font-extrabold" style="font-size:1.8rem;color:#ffffff;">{{ $s['num'] }}</div>
                    <div style="font-size:0.82rem;color:#dbeafe;margin-top:4px;font-weight:600;">{{ $s['label'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

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
                        <h3 class="font-heading font-bold" style="color:#ffffff;font-size:1.15rem;line-height:1.45;">5 Specialized Practice Areas</h3>
                        <p style="color:#dbeafe;font-size:0.88rem;line-height:1.6;flex:1;">Tax Services, Accounting &amp; Bookkeeping, Payroll, Business Advisory, and Compliance — tailored for Canadian businesses.</p>
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
                        ['tag'=>'Bookkeeping','date'=>'Jul 28, 2026','title'=>'How to Prepare for a CRA Audit with Zero Stress','excerpt'=>'A step-by-step audit preparation roadmap to keep your financial records organized and fully compliant.'],
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
                Join thousands of satisfied Canadian businesses who trust YONBUS for all their financial needs.
            </p>
            <div style="display:flex;flex-wrap:wrap;gap:1rem;justify-content:center;">
                <a href="{{ route('register') }}"
                   style="display:inline-flex;align-items:center;gap:8px;background:#ffffff;color:#002B8A;font-weight:700;font-size:0.95rem;padding:14px 30px;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,0.15);text-decoration:none;transition:all 0.2s;"
                   onmouseenter="this.style.boxShadow='0 12px 32px rgba(0,0,0,0.25)';this.style.transform='translateY(-2px)';"
                   onmouseleave="this.style.boxShadow='0 8px 24px rgba(0,0,0,0.15)';this.style.transform='translateY(0)';">
                    Get Started Free
                    <svg style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
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
