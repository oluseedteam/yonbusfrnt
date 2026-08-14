<x-public-layout>
    <x-slot name="title">Services | YONBUS Tax & Accounting Services Inc.</x-slot>

    {{-- Header Banner --}}
    <section style="background: linear-gradient(135deg, #002B8A 0%, #0045d8 50%, #0052FF 100%); padding: 4.5rem 0; text-align: center; color: #ffffff;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span style="font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; color: #dbeafe; background: rgba(255,255,255,0.15); padding: 6px 16px; border-radius: 999px; border: 1px solid rgba(255,255,255,0.25); display: inline-block;">
                Our Practice Areas
            </span>
            <h1 class="font-heading font-extrabold" style="font-size: clamp(2.2rem, 5vw, 3.4rem); margin-top: 1rem; color: #ffffff;">
                Our Services
            </h1>
            <p style="color: #dbeafe; font-size: 1.1rem; max-width: 600px; margin: 0.5rem auto 0; font-weight: 400;">
                Comprehensive Tax, Bookkeeping, Payroll &amp; Advisory Solutions Across Canada
            </p>
        </div>
    </section>

    {{-- Services List Section --}}
    <section style="position:relative;overflow:hidden;background:#f8faff;padding:5rem 0;">
        <div style="position:absolute;top:-80px;left:-60px;width:340px;height:340px;background:radial-gradient(circle,rgba(0,82,255,0.08) 0%,transparent 70%);border-radius:50%;pointer-events:none;"></div>
        <div style="position:absolute;bottom:-60px;right:-40px;width:260px;height:260px;background:radial-gradient(circle,rgba(0,82,255,0.06) 0%,transparent 70%);border-radius:50%;pointer-events:none;"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="position:relative;z-index:1;">

            <div class="text-center" style="margin-bottom: 3.5rem;">
                <span style="font-size: 11px; font-weight: 800; color: #0052ff; text-transform: uppercase; letter-spacing: 0.08em; background: #eff6ff; padding: 4px 14px; border-radius: 999px; border: 1px solid #dbeafe; display: inline-block;">WHAT WE DO</span>
                <h2 class="font-heading font-extrabold" style="color: #0a1a4a; font-size: clamp(1.8rem, 4vw, 2.5rem); margin-top: 10px;">
                    Tailored Financial Solutions for Your Success
                </h2>
                <p style="color: #475569; font-size: 1rem; margin-top: 10px; max-width: 580px; margin-left: auto; margin-right: auto; line-height: 1.65;">
                    We combine professional expertise with modern tools to take the complexity out of tax and accounting.
                </p>
            </div>

            @php
                $serviceIcons = ['🧾','🧮','📊','📋','📁','💼','📑','🏦','🧑‍💼','📈'];
                $idx = 0;
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($services->where('is_active', true) as $service)
                @php $icon = $serviceIcons[$idx % count($serviceIcons)]; $idx++; @endphp
                <div style="background:#ffffff;border:1.5px solid #e0e7ff;border-radius:20px;padding:32px 28px;display:flex;flex-direction:column;justify-content:space-between;box-shadow:0 4px 20px rgba(0,82,255,0.05);transition:all 0.25s ease;"
                     onmouseenter="this.style.borderColor='#0052ff';this.style.boxShadow='0 16px 36px rgba(0,82,255,0.14)';this.style.transform='translateY(-4px)';"
                     onmouseleave="this.style.borderColor='#e0e7ff';this.style.boxShadow='0 4px 20px rgba(0,82,255,0.05)';this.style.transform='translateY(0)';">
                    <div>
                        <div style="width:52px;height:52px;border-radius:14px;background:#eff6ff;border:1px solid #dbeafe;display:flex;align-items:center;justify-content:center;font-size:1.5rem;margin-bottom:20px;">
                            {{ $icon }}
                        </div>
                        <h3 class="font-heading font-bold" style="color:#0a1a4a;font-size:1.15rem;margin-bottom:12px;text-transform:uppercase;letter-spacing:0.02em;">{{ $service->name }}</h3>
                        <p style="color:#475569;font-size:0.9rem;line-height:1.65;margin-bottom:16px;">{{ $service->description }}</p>
                    </div>

                    <div style="margin-top:20px;padding-top:16px;border-top:1px solid #f1f5f9;">
                        <a href="{{ route('book-appointment') }}?service={{ $service->id }}"
                           style="display:block;width:100%;text-align:center;background:#0052ff;color:#ffffff;font-weight:700;font-size:0.88rem;padding:12px 20px;border-radius:12px;text-decoration:none;box-shadow:0 4px 14px rgba(0,82,255,0.3);transition:all 0.2s;"
                           onmouseenter="this.style.background='#0045d8';this.style.boxShadow='0 8px 24px rgba(0,82,255,0.45)';this.style.transform='translateY(-1px)';"
                           onmouseleave="this.style.background='#0052ff';this.style.boxShadow='0 4px 14px rgba(0,82,255,0.3)';this.style.transform='translateY(0)';">
                            Book Consultation
                        </a>
                    </div>
                </div>
                @empty
                    <div class="col-span-3 text-center py-16 bg-white rounded-2xl border border-slate-200" style="color:#64748b;">
                        <div style="font-size:3rem;margin-bottom:1rem;">📋</div>
                        <p style="font-size:1rem;font-weight:500;">Services are being configured. Please check back soon.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </section>

    {{-- Bottom Banner (Glassmorphism & Royal Blue) --}}
    <section style="position:relative;overflow:hidden;background:linear-gradient(135deg,#002B8A 0%,#0045d8 50%,#0052FF 100%);padding:4.5rem 0;text-align:center;color:#ffffff;">
        <div style="position:absolute;top:-80px;left:50%;transform:translateX(-50%);width:500px;height:280px;background:radial-gradient(ellipse,rgba(255,255,255,0.15) 0%,transparent 70%);pointer-events:none;"></div>
        <div style="position:absolute;bottom:-50px;right:-50px;width:220px;height:220px;background:radial-gradient(circle,rgba(255,255,255,0.1) 0%,transparent 70%);border-radius:50%;pointer-events:none;"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8" style="position:relative;z-index:1;">
            <span style="font-size:11px;font-weight:800;color:#dbeafe;text-transform:uppercase;letter-spacing:0.08em;background:rgba(255,255,255,0.15);border:1px solid rgba(255,255,255,0.25);padding:5px 14px;border-radius:999px;display:inline-block;margin-bottom:1rem;">Tailored For You</span>
            <h2 class="font-heading font-extrabold" style="font-size:clamp(1.8rem,4vw,2.4rem);margin-bottom:12px;color:#ffffff;">Need Custom Tax or Advisory Services?</h2>
            <p style="color:#dbeafe;font-size:1rem;max-width:520px;margin:0 auto 1.75rem;line-height:1.7;">
                Get in touch with our Gatineau accounting team for a personalized quote tailored to your business structure.
            </p>
            <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;">
                <a href="{{ route('contact') }}" style="background:#ffffff;color:#0052ff;font-weight:700;font-size:0.95rem;padding:14px 30px;border-radius:12px;text-decoration:none;box-shadow:0 8px 24px rgba(0,0,0,0.15);transition:all 0.2s;"
                   onmouseenter="this.style.boxShadow='0 12px 32px rgba(0,0,0,0.25)';this.style.transform='translateY(-2px)';" onmouseleave="this.style.boxShadow='0 8px 24px rgba(0,0,0,0.15)';this.style.transform='translateY(0)';">
                    Contact Our Office
                </a>
                <a href="{{ route('book-appointment') }}" style="background:rgba(255,255,255,0.12);backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);border:1.5px solid rgba(255,255,255,0.3);color:#ffffff;font-weight:600;font-size:0.95rem;padding:14px 26px;border-radius:12px;text-decoration:none;transition:all 0.2s;"
                   onmouseenter="this.style.background='rgba(255,255,255,0.22)';" onmouseleave="this.style.background='rgba(255,255,255,0.12)';">
                    Book Consultation
                </a>
            </div>
        </div>
    </section>
</x-public-layout>
