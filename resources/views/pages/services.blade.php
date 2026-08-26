<x-public-layout>
    <x-slot name="title">Services | YONBUS Tax & Accounting Services Inc.</x-slot>

    @php
        $servicesList = $servicesList ?? app(\App\Services\PracticeAreaService::class)->getAll();
    @endphp

    <div class="relative">

        {{-- ============================================================
             HEADER BANNER
             ============================================================ --}}
        <section class="relative overflow-hidden py-16 sm:py-20 md:py-24" style="background: linear-gradient(135deg, #001A57 0%, #0036A8 50%, #0052FF 100%); color: #ffffff;">
            <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full opacity-20 pointer-events-none blur-3xl" style="background: radial-gradient(circle, #60A5FA 0%, transparent 70%);"></div>
            <div class="absolute -bottom-24 -right-24 w-96 h-96 rounded-full opacity-20 pointer-events-none blur-3xl" style="background: radial-gradient(circle, #38BDF8 0%, transparent 70%);"></div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4 z-10" data-aos="fade-down" data-aos-duration="600">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider text-blue-100 border border-blue-400/40 backdrop-blur-md shadow-sm" style="background: rgba(3, 27, 78, 0.45);">
                    <svg class="w-3.5 h-3.5 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    <span>Our Practice Areas</span>
                </div>
                <h1 class="font-heading font-extrabold text-3xl sm:text-4xl md:text-5xl tracking-tight leading-tight m-0 text-white">
                    Professional Accounting &amp; Tax Services
                </h1>
                <p class="max-w-2xl mx-auto text-sm sm:text-base md:text-lg text-blue-100/90 leading-relaxed font-normal">
                    Comprehensive, certified financial solutions tailored for individuals, entrepreneurs, and corporations across Canada.
                </p>
            </div>
        </section>

        {{-- ============================================================
             SERVICES GRID (Direct navigation to dedicated detail pages)
             ============================================================ --}}
        <section class="py-14 sm:py-18 bg-slate-50 relative" style="background: #f8fafc;">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

                <div class="text-center max-w-3xl mx-auto mb-10 sm:mb-12">
                    <span style="font-size: 11px; font-weight: 800; color: #0052ff; text-transform: uppercase; letter-spacing: 0.08em; background: #eff6ff; padding: 5px 16px; border-radius: 999px; border: 1px solid #bfdbfe; display: inline-block;">
                        Core Practice Areas
                    </span>
                    <h2 class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900 mt-3 mb-3">
                        Tailored Financial Solutions for Your Success
                    </h2>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Explore our specialized services below. Click <strong>Read More</strong> on any box to view full coverage, benefits, and customized strategies.
                    </p>
                </div>

                {{-- 6 Service Boxes Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($servicesList as $service)
                    <div id="{{ $service['id'] }}"
                         style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 18px; box-shadow: 0 4px 16px rgba(0,0,0,0.05); padding: 22px; display: flex; flex-direction: column; justify-content: space-between; transition: all 0.3s ease;"
                         onmouseenter="this.style.boxShadow='0 12px 28px rgba(0,82,255,0.12)'; this.style.borderColor='#93c5fd'; this.style.transform='translateY(-3px)';"
                         onmouseleave="this.style.boxShadow='0 4px 16px rgba(0,0,0,0.05)'; this.style.borderColor='#e2e8f0'; this.style.transform='translateY(0)';">
                        
                        <div>
                            {{-- Logo / Icon Badge --}}
                            <div style="width: 44px; height: 44px; border-radius: 12px; background: #eff6ff; border: 1px solid #dbeafe; display: flex; align-items: center; justify-content: center; font-size: 22px; margin-bottom: 14px;">
                                {{ $service['icon'] }}
                            </div>

                            {{-- Service Title --}}
                            <h3 class="font-heading font-bold" style="color: #0f172a; font-size: 1.1rem; line-height: 1.35; margin-bottom: 8px;">
                                <a href="{{ route('services.show', $service['id']) }}" class="hover:text-blue-600 transition-colors" style="text-decoration: none; color: inherit;">
                                    {{ $service['name'] }}
                                </a>
                            </h3>

                            {{-- Concise Description (3 Lines Clamp) --}}
                            <p style="color: #475569; font-size: 0.84rem; line-height: 1.6; margin-bottom: 16px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                {{ $service['description'] }}
                            </p>
                        </div>

                        {{-- Action Button: Read More --}}
                        <div style="padding-top: 12px; border-top: 1px solid #f1f5f9;">
                            <a href="{{ route('services.show', $service['id']) }}"
                               style="width: 100%; display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 10px 16px; border-radius: 11px; font-weight: 700; font-size: 0.85rem; color: #ffffff !important; background: #0052ff !important; text-decoration: none; border: none; box-shadow: 0 4px 12px rgba(0,82,255,0.25); cursor: pointer; transition: all 0.2s;"
                               onmouseenter="this.style.background='#003dc2'; this.style.boxShadow='0 6px 18px rgba(0,82,255,0.38)';"
                               onmouseleave="this.style.background='#0052ff'; this.style.boxShadow='0 4px 12px rgba(0,82,255,0.25)';">
                                <span style="color: #ffffff !important; font-weight: 700;">Read More</span>
                                <svg style="width: 15px; height: 15px; stroke: #ffffff;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </a>
                        </div>

                    </div>
                    @endforeach
                </div>

            </div>
        </section>

        {{-- ============================================================
             BOTTOM BANNER
             ============================================================ --}}
        <section class="relative overflow-hidden py-16 text-center text-white"
                 style="background: linear-gradient(135deg, #002B8A 0%, #0045d8 50%, #0052FF 100%);">
            <div class="absolute -top-20 left-1/2 -translate-x-1/2 w-96 h-96 rounded-full opacity-20 pointer-events-none blur-3xl" style="background: radial-gradient(circle, #ffffff 0%, transparent 70%);"></div>
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-4">
                <span class="text-xs font-bold uppercase tracking-wider text-blue-100 bg-white/15 px-3.5 py-1 rounded-full border border-white/25 inline-block">
                    Personalized Practice Support
                </span>
                <h2 class="font-heading font-extrabold text-2xl sm:text-3xl md:text-4xl text-white m-0">
                    Need a Custom Accounting or Tax Strategy?
                </h2>
                <p class="text-blue-100 text-sm sm:text-base max-w-xl mx-auto leading-relaxed">
                    Contact our Gatineau professional practice team for a customized engagement package tailored to your exact business structure.
                </p>
                <div class="pt-2 flex items-center justify-center gap-3 flex-wrap">
                    <a href="{{ route('contact') }}"
                       class="bg-white text-[#002B8A] font-bold text-sm py-3 px-6 rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all text-decoration-none">
                        Contact Our Practice Office
                    </a>
                    <a href="{{ route('book-appointment') }}"
                       class="bg-white/15 hover:bg-white/25 border border-white/30 text-white font-bold text-sm py-3 px-6 rounded-xl transition-all text-decoration-none">
                        Book Consultation
                    </a>
                </div>
            </div>
        </section>

    </div>
</x-public-layout>
