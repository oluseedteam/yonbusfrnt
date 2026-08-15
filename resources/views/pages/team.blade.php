<x-public-layout>
    <x-slot name="title">Our Leadership Team | YONBUS Tax & Accounting Services Inc.</x-slot>

    {{-- Hero Banner Section --}}
    <section class="relative py-16 sm:py-24 overflow-hidden" style="background: linear-gradient(135deg, #002B8A 0%, #0045d8 50%, #0052FF 100%)">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <span class="inline-block px-4 py-1.5 rounded-full text-xs font-extrabold uppercase tracking-widest text-blue-200 bg-blue-500/20 border border-blue-400/30 backdrop-blur-md mb-4">
                Leadership & Partners
            </span>
            <h1 class="text-3xl sm:text-5xl font-extrabold text-white font-heading tracking-tight mb-4">
                Meet Our Expert Accounting Team
            </h1>
            <p class="max-w-2xl mx-auto text-base sm:text-lg text-blue-100/90 font-medium leading-relaxed">
                Certified Professional Bookkeepers and seasoned tax specialists dedicated to maximizing your growth, ensuring strict compliance, and delivering financial clarity across Canada.
            </p>
        </div>
    </section>

    {{-- Team Members Section --}}
    <section class="py-16 sm:py-24" style="background: #ffffff; border-top: 1px solid #e2e8f0;">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12 sm:space-y-16">

            {{-- 1. Olubukunola Eniola (Founder & Partner) --}}
            <div style="background: #ffffff; border: 1.5px solid #e0e7ff; border-radius: 24px; padding: clamp(1.5rem, 3vw, 2.5rem); box-shadow: 0 4px 24px rgba(0,82,255,0.06);">
                <div class="flex flex-col lg:flex-row gap-8 lg:gap-12 items-center lg:items-start">
                    {{-- Image Container --}}
                    <div class="w-full sm:w-80 lg:w-96 flex-shrink-0">
                        <div class="relative overflow-hidden rounded-2xl shadow-md border border-gray-100 bg-slate-50">
                            <img src="{{ asset('images/team/olubukunola-eniola.jpg') }}" 
                                 alt="Olubukunola Eniola - Founder & Partner" 
                                 class="w-full h-auto object-cover aspect-[4/5] block">
                        </div>
                    </div>

                    {{-- Content Container --}}
                    <div class="flex-1 space-y-5 text-left w-full">
                        <div>
                            <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-[#eff6ff] text-[#0052ff] border border-[#bfdbfe] text-xs font-bold rounded-lg mb-3">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                                <span>Certified Professional Bookkeeper (CPB)</span>
                            </div>
                            <h2 class="text-2xl sm:text-3xl font-extrabold text-[#0a1a4a] font-heading">
                                Olubukunola Eniola
                            </h2>
                            <p class="text-sm font-semibold text-[#0052ff] mt-1">
                                Founder & Partner • YONBUS Tax & Accounting Services Inc.
                            </p>
                        </div>

                        <div class="text-gray-700 text-sm sm:text-base leading-relaxed space-y-3.5">
                            <p>
                                <strong class="text-[#0a1a4a]">Olubukunola Eniola</strong> is the Founder and Partner at Yonbus Tax & Accounting Services Inc., providing professional tax, accounting, bookkeeping, payroll, and advisory services to individuals and businesses across Canada.
                            </p>
                            <p>
                                She is a Certified Professional Bookkeeper (CPB) with a Bachelor’s degree in Banking and Finance and a Diploma in Accounting from Mohawk College, Ontario. She is also a trained tax professional serving clients in Quebec and other provinces.
                            </p>
                            <p>
                                Olubukunola is committed to providing accurate, timely, and personalized financial services, helping clients stay compliant and make informed financial decisions.
                            </p>
                        </div>

                        <div class="pt-4 border-t border-gray-100 flex flex-wrap gap-2">
                            <span class="px-3 py-1.5 bg-blue-50 border border-blue-200 text-[#0052ff] text-xs font-semibold rounded-lg">🎓 B.Sc Banking & Finance</span>
                            <span class="px-3 py-1.5 bg-blue-50 border border-blue-200 text-[#0052ff] text-xs font-semibold rounded-lg">🏛️ Mohawk College Alumni</span>
                            <span class="px-3 py-1.5 bg-blue-50 border border-blue-200 text-[#0052ff] text-xs font-semibold rounded-lg">💼 Tax & Payroll Specialist</span>
                            <span class="px-3 py-1.5 bg-blue-50 border border-blue-200 text-[#0052ff] text-xs font-semibold rounded-lg">🇨🇦 Quebec & Nationwide Practice</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. Adeshola Eniola (Co-founder & Partner) --}}
            <div style="background: #ffffff; border: 1.5px solid #e0e7ff; border-radius: 24px; padding: clamp(1.5rem, 3vw, 2.5rem); box-shadow: 0 4px 24px rgba(0,82,255,0.06);">
                <div class="flex flex-col lg:flex-row gap-8 lg:gap-12 items-center lg:items-start">
                    {{-- Image Container --}}
                    <div class="w-full sm:w-80 lg:w-96 flex-shrink-0">
                        <div class="relative overflow-hidden rounded-2xl shadow-md border border-gray-100 bg-slate-50">
                            <img src="{{ asset('images/team/adeshola-eniola.jpg') }}" 
                                 alt="Adeshola Eniola - Co-founder & Partner" 
                                 class="w-full h-auto object-cover aspect-[4/5] block">
                        </div>
                    </div>

                    {{-- Content Container --}}
                    <div class="flex-1 space-y-5 text-left w-full">
                        <div>
                            <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-bold rounded-lg mb-3">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                                <span>Certified Professional Bookkeeper (CPB)</span>
                            </div>
                            <h2 class="text-2xl sm:text-3xl font-extrabold text-[#0a1a4a] font-heading">
                                Adeshola Eniola
                            </h2>
                            <p class="text-sm font-semibold text-[#0052ff] mt-1">
                                Co-founder & Partner • YONBUS Tax & Accounting Services Inc.
                            </p>
                        </div>

                        <div class="text-gray-700 text-sm sm:text-base leading-relaxed space-y-3.5">
                            <p>
                                <strong class="text-[#0a1a4a]">Adeshola Eniola</strong> is a Co-founder and Partner at Yonbus Tax & Accounting Services Inc., bringing over 10 years of professional auditing experience to the firm.
                            </p>
                            <p>
                                He is a Certified Professional Bookkeeper (CPB), with a Bachelor’s degree in Accounting and a Diploma in Accounting from Mohawk College, Ontario. He is also a trained tax professional serving clients in Quebec and other provinces.
                            </p>
                            <p>
                                With his strong background in auditing, accounting, and financial reporting, Adeshola specializes in helping individuals and businesses navigate complex accounting and bookkeeping issues. He is committed to providing accurate, practical, and reliable solutions that help clients maintain organized financial records and make informed business decisions.
                            </p>
                        </div>

                        <div class="pt-4 border-t border-gray-100 flex flex-wrap gap-2">
                            <span class="px-3 py-1.5 bg-blue-50 border border-blue-200 text-[#0052ff] text-xs font-semibold rounded-lg">🎓 B.Sc Accounting</span>
                            <span class="px-3 py-1.5 bg-blue-50 border border-blue-200 text-[#0052ff] text-xs font-semibold rounded-lg">🏛️ Mohawk College Alumni</span>
                            <span class="px-3 py-1.5 bg-blue-50 border border-blue-200 text-[#0052ff] text-xs font-semibold rounded-lg">📊 Senior Auditing Specialist</span>
                            <span class="px-3 py-1.5 bg-blue-50 border border-blue-200 text-[#0052ff] text-xs font-semibold rounded-lg">🔍 Financial Reporting Expert</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- Value Proposition Banner --}}
    <section class="py-16" style="background: #002B8A; color: #ffffff;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-8">
            <h3 class="text-2xl font-bold font-heading text-white">Why Clients Trust Our Firm</h3>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="p-6 rounded-2xl space-y-2 border border-white/10 shadow-lg" style="background: rgba(255,255,255,0.06); backdrop-filter: blur(10px);">
                    <div class="w-12 h-12 bg-white/10 border border-white/20 text-white rounded-xl flex items-center justify-center mx-auto text-xl">🛡️</div>
                    <h4 class="font-bold text-sm font-heading text-white">100% Tax Compliance</h4>
                    <p class="text-xs text-blue-100 leading-relaxed">Rigorous adherence to tax and reporting regulations.</p>
                </div>

                <div class="p-6 rounded-2xl space-y-2 border border-white/10 shadow-lg" style="background: rgba(255,255,255,0.06); backdrop-filter: blur(10px);">
                    <div class="w-12 h-12 bg-white/10 border border-white/20 text-white rounded-xl flex items-center justify-center mx-auto text-xl">🎯</div>
                    <h4 class="font-bold text-sm font-heading text-white">Audit Expertise</h4>
                    <p class="text-xs text-blue-100 leading-relaxed">Backed by over a decade of professional auditing experience.</p>
                </div>

                <div class="p-6 rounded-2xl space-y-2 border border-white/10 shadow-lg" style="background: rgba(255,255,255,0.06); backdrop-filter: blur(10px);">
                    <div class="w-12 h-12 bg-white/10 border border-white/20 text-white rounded-xl flex items-center justify-center mx-auto text-xl">🇨🇦</div>
                    <h4 class="font-bold text-sm font-heading text-white">Cross-Province Practice</h4>
                    <p class="text-xs text-blue-100 leading-relaxed">Certified and experienced serving Quebec, Ontario & all provinces.</p>
                </div>

                <div class="p-6 rounded-2xl space-y-2 border border-white/10 shadow-lg" style="background: rgba(255,255,255,0.06); backdrop-filter: blur(10px);">
                    <div class="w-12 h-12 bg-white/10 border border-white/20 text-white rounded-xl flex items-center justify-center mx-auto text-xl">🤝</div>
                    <h4 class="font-bold text-sm font-heading text-white">Personalized Advisory</h4>
                    <p class="text-xs text-blue-100 leading-relaxed">Tailored financial solutions for individuals and corporate entities.</p>
                </div>
            </div>

            <div class="pt-6">
                <a href="{{ route('book-appointment') }}" class="inline-flex items-center gap-2 px-8 py-3.5 bg-[#ffffff] text-[#0052ff] hover:bg-blue-50 font-bold text-sm rounded-xl shadow-lg transition-all transform hover:-translate-y-0.5">
                    <span>Schedule Consultation With Our Partners</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>
    </section>
</x-public-layout>
