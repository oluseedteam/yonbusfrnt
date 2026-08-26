<x-public-layout>
    <x-slot name="title">{{ $service['name'] }} | YONBUS Tax & Accounting Services Inc.</x-slot>

    <div class="relative">

        {{-- ============================================================
             HEADER BANNER
             ============================================================ --}}
        <section class="relative overflow-hidden py-16 sm:py-20 md:py-24" style="background: linear-gradient(135deg, #001A57 0%, #0036A8 50%, #0052FF 100%); color: #ffffff;">
            <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full opacity-20 pointer-events-none blur-3xl" style="background: radial-gradient(circle, #60A5FA 0%, transparent 70%);"></div>
            <div class="absolute -bottom-24 -right-24 w-96 h-96 rounded-full opacity-20 pointer-events-none blur-3xl" style="background: radial-gradient(circle, #38BDF8 0%, transparent 70%);"></div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-10" data-aos="fade-down" data-aos-duration="600">
                {{-- Breadcrumb & Back Link --}}
                <div class="flex flex-wrap items-center gap-2 text-xs text-blue-200 mb-6">
                    <a href="{{ route('home') }}" class="hover:text-white transition-colors text-decoration-none text-blue-200">Home</a>
                    <span>/</span>
                    <a href="{{ route('services') }}" class="hover:text-white transition-colors text-decoration-none text-blue-200">Services</a>
                    <span>/</span>
                    <span class="text-white font-semibold">{{ $service['name'] }}</span>
                </div>

                <div class="max-w-3xl space-y-4">
                    <div class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider text-blue-100 border border-blue-400/40 backdrop-blur-md shadow-sm" style="background: rgba(3, 27, 78, 0.45);">
                        <span class="text-lg leading-none">{{ $service['icon'] }}</span>
                        <span>Practice Area &bull; Canada Certified</span>
                    </div>

                    <h1 class="font-heading font-extrabold text-3xl sm:text-4xl md:text-5xl tracking-tight leading-tight m-0 text-white">
                        {{ $service['name'] }}
                    </h1>

                    <p class="text-sm sm:text-base md:text-lg text-blue-100/90 leading-relaxed font-normal">
                        {{ $service['description'] }}
                    </p>

                    <div class="pt-2 flex flex-wrap items-center gap-3">
                        <a href="{{ route('book-appointment') }}"
                           class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-white text-[#002B8A] font-bold text-sm shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all text-decoration-none">
                            <span>Book Consultation</span>
                            <svg class="w-4 h-4 text-[#002B8A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                        <a href="{{ route('contact') }}"
                           class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-white/15 hover:bg-white/25 border border-white/30 text-white font-bold text-sm transition-all text-decoration-none">
                            <span>Contact Our Practice Office</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- ============================================================
             MAIN CONTENT LAYOUT (2 Columns: Details + Sticky Sidebar)
             ============================================================ --}}
        <section class="py-12 sm:py-16 bg-slate-50 relative" style="background: #f8fafc;">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
                    
                    {{-- ── LEFT / MAIN CONTENT (8 Cols) ──────────────── --}}
                    <div class="lg:col-span-8 space-y-10">

                        {{-- Section 1: Overview --}}
                        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-4" data-aos="fade-up">
                            <div class="flex items-center gap-2.5 text-xs font-bold uppercase tracking-wider text-blue-600 bg-blue-50 px-3.5 py-1.5 rounded-full w-fit border border-blue-100">
                                <span>🔍</span> Overview
                            </div>
                            <h2 class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900 leading-tight">
                                {{ $service['name'] }}
                            </h2>
                            <p class="text-slate-700 text-sm sm:text-base leading-relaxed">
                                {{ $service['description'] }}
                            </p>
                        </div>

                        {{-- Section 2: Detailed Included Services & Coverage --}}
                        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-6" data-aos="fade-up">
                            <div class="flex items-center justify-between flex-wrap gap-2">
                                <div class="flex items-center gap-2.5 text-xs font-bold uppercase tracking-wider text-blue-600 bg-blue-50 px-3.5 py-1.5 rounded-full w-fit border border-blue-100">
                                    <span>📋</span> Services Included
                                </div>
                                <span class="text-xs text-slate-500 font-medium">
                                    {{ count($service['features'] ?? []) }} Services Included
                                </span>
                            </div>

                            <h3 class="font-heading font-extrabold text-xl sm:text-2xl text-slate-900">
                                Key Offerings &amp; Coverage
                            </h3>

                            <div class="space-y-4">
                                @foreach($service['features'] ?? [] as $index => $feature)
                                <div class="p-5 sm:p-6 rounded-2xl bg-slate-50/80 border border-slate-200/90 transition-all hover:bg-white hover:border-blue-300 hover:shadow-md group">
                                    <div class="flex items-start gap-4">
                                        <div class="w-8 h-8 rounded-xl bg-blue-600 text-white flex items-center justify-center font-bold text-xs flex-shrink-0 shadow-sm group-hover:scale-105 transition-transform">
                                            {{ $index + 1 }}
                                        </div>
                                        <div class="space-y-2 flex-1">
                                            <h4 class="font-heading font-bold text-base sm:text-lg text-slate-900 m-0">
                                                {{ $feature['title'] }}
                                            </h4>
                                            <p class="text-slate-600 text-xs sm:text-sm leading-relaxed m-0">
                                                {{ $feature['desc'] }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                    </div>

                    {{-- ── RIGHT / STICKY SIDEBAR (4 Cols) ─────────────── --}}
                    <div class="lg:col-span-4 space-y-6 lg:sticky lg:top-24">

                        {{-- Card 1: Consultation Booking Action Box --}}
                        <div class="rounded-3xl p-6 sm:p-7 text-white relative overflow-hidden shadow-xl"
                             style="background: linear-gradient(135deg, #001A57 0%, #0036A8 60%, #0052FF 100%);">
                            
                            <div class="absolute -top-12 -right-12 w-40 h-40 rounded-full opacity-30 blur-2xl pointer-events-none" style="background: radial-gradient(circle, #60A5FA 0%, transparent 70%);"></div>

                            <div class="relative z-10 space-y-4">
                                <span class="text-[10px] font-extrabold uppercase tracking-widest text-blue-200 bg-white/15 px-3 py-1 rounded-full border border-white/20 inline-block">
                                    Direct Practice Engagement
                                </span>

                                <h3 class="font-heading font-extrabold text-xl sm:text-2xl text-white m-0 leading-tight">
                                    Need Expert Assistance with {{ $service['short_name'] ?? $service['name'] }}?
                                </h3>

                                <p class="text-blue-100 text-xs sm:text-sm leading-relaxed m-0">
                                    Schedule a one-on-one session with our certified advisors. We serve clients nationwide across Canada.
                                </p>

                                <div class="pt-2 space-y-2.5">
                                    <a href="{{ route('book-appointment') }}"
                                       class="w-full inline-flex items-center justify-center gap-2 py-3 px-4 rounded-xl bg-white text-[#002B8A] font-bold text-xs sm:text-sm shadow-md hover:bg-blue-50 transition-all text-decoration-none text-center">
                                        <span>Book Consultation Now</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                        </svg>
                                    </a>

                                    <a href="tel:+14389781349"
                                       class="w-full inline-flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl bg-white/15 hover:bg-white/25 border border-white/20 text-white font-semibold text-xs transition-all text-decoration-none text-center">
                                        <svg class="w-3.5 h-3.5 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498A1 1 0 0121 15.72V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                        <span>+1 (438) 978-1349</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Card 2: Practice Areas Navigation --}}
                        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-sm space-y-4">
                            <h4 class="font-heading font-bold text-slate-900 text-sm uppercase tracking-wider text-slate-400 flex items-center justify-between">
                                <span>All Practice Areas</span>
                                <span class="text-xs text-blue-600 font-bold">6 Services</span>
                            </h4>

                            <div class="space-y-1.5">
                                @foreach($allServices as $navService)
                                    @php
                                        $isActive = ($navService['id'] === $service['id']);
                                    @endphp
                                    <a href="{{ route('services.show', $navService['id']) }}"
                                       class="flex items-center justify-between p-3 rounded-xl text-xs sm:text-sm font-semibold transition-all text-decoration-none {{ $isActive ? 'bg-[#0052ff] text-white shadow-sm' : 'text-slate-700 hover:bg-slate-100' }}">
                                        <div class="flex items-center gap-2.5 truncate">
                                            <span>{{ $navService['icon'] }}</span>
                                            <span class="truncate">{{ $navService['name'] }}</span>
                                        </div>
                                        <svg class="w-3.5 h-3.5 flex-shrink-0 {{ $isActive ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        {{-- Card 3: Trust & Certification Card --}}
                        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-sm space-y-4">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center text-xl flex-shrink-0">
                                    🍁
                                </div>
                                <div>
                                    <div class="font-heading font-bold text-slate-900 text-sm">Certified Practice</div>
                                    <div class="text-xs text-slate-500">CPB Canada Certified Member</div>
                                </div>
                            </div>

                            <div class="space-y-2.5 pt-2 border-t border-slate-100 text-xs text-slate-600">
                                <div class="flex items-center gap-2">
                                    <span class="text-emerald-500 font-bold">✓</span>
                                    <span>Authorized CRA &amp; Revenu Québec EFILE</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-emerald-500 font-bold">✓</span>
                                    <span>256-Bit Encrypted Client Portal</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-emerald-500 font-bold">✓</span>
                                    <span>Bilingual Service (English &amp; French)</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-emerald-500 font-bold">✓</span>
                                    <span>Nationwide Virtual Consultations</span>
                                </div>
                            </div>

                            <div class="pt-3 border-t border-slate-100 text-[11px] text-slate-500 flex items-center justify-between">
                                <span>Office: Gatineau, QC</span>
                                <a href="mailto:info@yonbustax.ca" class="text-blue-600 hover:underline font-semibold text-decoration-none">
                                    info@yonbustax.ca
                                </a>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </section>

        {{-- ============================================================
             BOTTOM CALL TO ACTION BANNER
             ============================================================ --}}
        <section class="relative overflow-hidden py-16 text-center text-white"
                 style="background: linear-gradient(135deg, #002B8A 0%, #0045d8 50%, #0052FF 100%);">
            <div class="absolute -top-20 left-1/2 -translate-x-1/2 w-96 h-96 rounded-full opacity-20 pointer-events-none blur-3xl" style="background: radial-gradient(circle, #ffffff 0%, transparent 70%);"></div>
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-4">
                <span class="text-xs font-bold uppercase tracking-wider text-blue-100 bg-white/15 px-3.5 py-1 rounded-full border border-white/25 inline-block">
                    Personalized Financial Advisory
                </span>
                <h2 class="font-heading font-extrabold text-2xl sm:text-3xl md:text-4xl text-white m-0">
                    Ready to Get Started with {{ $service['short_name'] ?? $service['name'] }}?
                </h2>
                <p class="text-blue-100 text-sm sm:text-base max-w-xl mx-auto leading-relaxed">
                    Let our certified professionals simplify your Canadian tax and accounting obligations with precision, speed, and proactive strategy.
                </p>
                <div class="pt-2 flex items-center justify-center gap-3 flex-wrap">
                    <a href="{{ route('book-appointment') }}"
                       class="bg-white text-[#002B8A] font-bold text-sm py-3 px-6 rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all text-decoration-none">
                        Book a Consultation
                    </a>
                    <a href="{{ route('contact') }}"
                       class="bg-white/15 hover:bg-white/25 border border-white/30 text-white font-bold text-sm py-3 px-6 rounded-xl transition-all text-decoration-none">
                        Contact Practice Office
                    </a>
                </div>
            </div>
        </section>

    </div>
</x-public-layout>
