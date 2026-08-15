<x-public-layout>
    <x-slot name="title">Services | YONBUS Tax & Accounting Services Inc.</x-slot>

    {{-- ── HERO ─────────────────────────────────────────── --}}
    <section class="relative py-20 sm:py-24 text-center overflow-hidden" style="background: linear-gradient(135deg, #0f172a 0%, #1E3A8A 50%, #2563EB 100%);" data-aos="fade-down">
        <div style="position:absolute;inset:0;background:url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.04\'%3E%3Ccircle cx=\'30\' cy=\'30\' r=\'2\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 space-y-4">
            <span class="text-xs font-bold uppercase tracking-widest text-blue-200 bg-white/10 px-4 py-1.5 rounded-full border border-white/20 backdrop-blur-md inline-block">
                Our Practice Areas
            </span>
            <h1 class="text-3xl sm:text-5xl font-extrabold text-white font-heading tracking-tight">
                Our Services &amp; Solutions
            </h1>
            <p class="text-blue-100/90 text-base sm:text-lg max-w-2xl mx-auto font-normal leading-relaxed">
                Comprehensive Tax, Bookkeeping, Payroll &amp; Advisory Solutions Tailored for Canadian Businesses.
            </p>
        </div>
    </section>

    {{-- ── SERVICES LIST SECTION ────────────────────────── --}}
    <section class="overflow-hidden" data-aos="fade-up">
        {{-- Section Header Banner with Rich Gradient --}}
        <div class="bg-gradient-to-r from-slate-900 via-[#1E3A8A] to-[#2563EB] text-white py-16 sm:py-20 text-center px-4 sm:px-6 lg:px-8 relative">
            <div class="max-w-4xl mx-auto space-y-4">
                <span class="text-xs font-bold uppercase tracking-widest text-blue-200 bg-white/10 px-4 py-1.5 rounded-full border border-white/20 backdrop-blur-md inline-block">
                    What We Do
                </span>
                <h2 class="text-3xl sm:text-5xl font-extrabold text-white font-heading tracking-tight">
                    Tailored Financial Solutions for Your Success
                </h2>
                <p class="text-blue-100/90 text-base sm:text-lg max-w-2xl mx-auto font-normal leading-relaxed">
                    We combine professional expertise with modern tools to take the complexity out of tax and accounting.
                </p>
            </div>
        </div>

        {{-- Cards Grid Container --}}
        <div class="bg-white py-14 sm:py-16 border-b border-blue-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @php
                    $serviceIcons = ['🧾','🧮','📊','📋','📁','💼','📑','🏦','🧑‍💼','📈'];
                    $idx = 0;
                @endphp

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($services->where('is_active', true) as $service)
                    @php $icon = $serviceIcons[$idx % count($serviceIcons)]; $idx++; @endphp
                    <div style="background:#ffffff;border:2px solid #DBEAFE;border-radius:20px;padding:32px 28px;display:flex;flex-direction:column;justify-content:space-between;box-shadow:0 6px 24px rgba(37,99,235,0.08);transition:all 0.3s ease;"
                         onmouseenter="this.style.borderColor='#2563EB';this.style.boxShadow='0 16px 40px rgba(37,99,235,0.16)';this.style.transform='translateY(-4px)';"
                         onmouseleave="this.style.borderColor='#DBEAFE';this.style.boxShadow='0 6px 24px rgba(37,99,235,0.08)';this.style.transform='translateY(0)';">
                        <div>
                            <div style="width:54px;height:54px;border-radius:14px;background:#EFF6FF;border:2px solid #BFDBFE;display:flex;align-items:center;justify-content:center;font-size:1.5rem;margin-bottom:20px;">
                                {{ $icon }}
                            </div>
                            <h3 class="font-heading font-bold" style="color:#1E3A8A;font-size:1.15rem;margin-bottom:12px;text-transform:uppercase;letter-spacing:0.02em;">{{ $service->name }}</h3>
                            <p style="color:#475569;font-size:0.9rem;line-height:1.65;margin-bottom:16px;">{{ $service->description }}</p>
                        </div>

                        <div style="margin-top:20px;padding-top:16px;border-top:1.5px solid #EFF6FF;">
                            <a href="{{ route('book-appointment') }}?service={{ $service->id }}"
                               style="display:block;width:100%;text-align:center;background:#2563EB;color:#ffffff;font-weight:700;font-size:0.88rem;padding:12px 20px;border-radius:12px;text-decoration:none;box-shadow:0 4px 14px rgba(37,99,235,0.3);transition:all 0.2s;"
                               onmouseenter="this.style.background='#1D4ED8';this.style.boxShadow='0 8px 24px rgba(37,99,235,0.45)';this.style.transform='translateY(-1px)';"
                               onmouseleave="this.style.background='#2563EB';this.style.boxShadow='0 4px 14px rgba(37,99,235,0.3)';this.style.transform='translateY(0)';">
                                Book Consultation &rarr;
                            </a>
                        </div>
                    </div>
                    @empty
                        <div class="col-span-3 text-center py-16 rounded-2xl border-2 border-[#DBEAFE]" style="background:#EFF6FF;color:#475569;">
                            <div style="font-size:3rem;margin-bottom:1rem;">📋</div>
                            <p style="font-size:1rem;font-weight:600;color:#1E3A8A;">Services are being configured. Please check back soon.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    {{-- ── BOTTOM CTA BANNER ────────────────────────────── --}}
    <section class="relative overflow-hidden py-16 sm:py-20 text-center" style="background:linear-gradient(135deg, #0f172a 0%, #1E3A8A 50%, #2563EB 100%);">
        <div style="position:absolute;top:-80px;left:50%;transform:translateX(-50%);width:500px;height:280px;background:radial-gradient(ellipse,rgba(255,255,255,0.15) 0%,transparent 70%);pointer-events:none;"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-4">
            <span class="text-xs font-bold uppercase tracking-widest text-blue-200 bg-white/10 px-4 py-1.5 rounded-full border border-white/20 backdrop-blur-md inline-block">
                Tailored For You
            </span>
            <h2 class="text-3xl sm:text-5xl font-extrabold text-white font-heading tracking-tight">
                Need Custom Tax or Advisory Services?
            </h2>
            <p class="text-blue-100/90 text-base sm:text-lg max-w-2xl mx-auto font-normal leading-relaxed">
                Get in touch with our Gatineau accounting team for a personalized quote tailored to your business structure.
            </p>
            <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;padding-top:1rem;">
                <a href="{{ route('contact') }}" style="background:#ffffff;color:#1D4ED8;font-weight:700;font-size:0.95rem;padding:14px 30px;border-radius:12px;text-decoration:none;box-shadow:0 8px 24px rgba(0,0,0,0.15);transition:all 0.2s;"
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
