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
    <section class="py-16 sm:py-24" style="background:#f8faff;">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12 sm:space-y-16">

            {{-- 1. Olubukunola Eniola (Founder & Partner) --}}
            <div class="bg-white rounded-3xl p-6 sm:p-10 lg:p-12 shadow-xl border border-slate-200 transition-all hover:shadow-2xl">
                <div class="flex flex-col lg:flex-row gap-8 lg:gap-12 items-center lg:items-start">
                    {{-- Image Container --}}
                    <div class="w-full sm:w-80 lg:w-96 flex-shrink-0">
                        <div class="relative overflow-hidden rounded-2xl shadow-lg border border-slate-200 bg-slate-100">
                            <img src="{{ asset('images/team/olubukunola-eniola.jpg') }}" 
                                 alt="Olubukunola Eniola - Founder & Partner" 
                                 class="w-full h-auto object-cover aspect-[4/5] block">
                        </div>
                    </div>

                    {{-- Content Container --}}
                    <div class="flex-1 space-y-5 text-left w-full">
                        <div>
                            <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-blue-50 dark:bg-blue-950/60 text-[#0052ff] dark:text-blue-400 text-xs font-bold rounded-lg mb-3">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                                <span>Certified Professional Bookkeeper (CPB)</span>
                            </div>
                            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white font-heading">
                                Olubukunola Eniola
                            </h2>
                            <p class="text-sm font-semibold text-[#0052ff] dark:text-blue-400 mt-1">
                                Founder & Partner • YONBUS Tax & Accounting Services Inc.
                            </p>
                        </div>

                        <div class="text-slate-600 text-sm sm:text-base leading-relaxed space-y-3.5">
                            <p>
                                <strong>Olubukunola Eniola</strong> is the Founder and Partner at Yonbus Tax & Accounting Services Inc., providing professional tax, accounting, bookkeeping, payroll, and advisory services to individuals and businesses across Canada.
                            </p>
                            <p>
                                She is a Certified Professional Bookkeeper (CPB) with a Bachelor’s degree in Banking and Finance and a Diploma in Accounting from Mohawk College, Ontario. She is also a trained tax professional serving clients in Quebec and other provinces.
                            </p>
                            <p>
                                Olubukunola is committed to providing accurate, timely, and personalized financial services, helping clients stay compliant and make informed financial decisions.
                            </p>
                        </div>

                        <div class="pt-4 border-t border-slate-100 flex flex-wrap gap-2">
                            <span class="px-3 py-1.5 bg-blue-50 text-blue-700 text-xs font-semibold rounded-lg">🎓 B.Sc Banking & Finance</span>
                            <span class="px-3 py-1.5 bg-blue-50 text-blue-700 text-xs font-semibold rounded-lg">🏛️ Mohawk College Alumni</span>
                            <span class="px-3 py-1.5 bg-blue-50 text-blue-700 text-xs font-semibold rounded-lg">💼 Tax & Payroll Specialist</span>
                            <span class="px-3 py-1.5 bg-blue-50 text-blue-700 text-xs font-semibold rounded-lg">🇨🇦 Quebec & Nationwide Practice</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. Adeshola Eniola (Co-founder & Partner) --}}
            <div class="bg-white rounded-3xl p-6 sm:p-10 lg:p-12 shadow-xl border border-slate-200 transition-all hover:shadow-2xl">
                <div class="flex flex-col lg:flex-row gap-8 lg:gap-12 items-center lg:items-start">
                    {{-- Image Container --}}
                    <div class="w-full sm:w-80 lg:w-96 flex-shrink-0">
                        <div class="relative overflow-hidden rounded-2xl shadow-lg border border-slate-200 bg-slate-100">
                            <img src="{{ asset('images/team/adeshola-eniola.jpg') }}" 
                                 alt="Adeshola Eniola - Co-founder & Partner" 
                                 class="w-full h-auto object-cover aspect-[4/5] block">
                        </div>
                    </div>

                    {{-- Content Container --}}
                    <div class="flex-1 space-y-5 text-left w-full">
                        <div>
                            <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 text-xs font-bold rounded-lg mb-3">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                                <span>Certified Professional Bookkeeper (CPB)</span>
                            </div>
                            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white font-heading">
                                Adeshola Eniola
                            </h2>
                            <p class="text-sm font-semibold text-[#0052ff] dark:text-blue-400 mt-1">
                                Co-founder & Partner • YONBUS Tax & Accounting Services Inc.
                            </p>
                        </div>

                        <div class="text-slate-600 text-sm sm:text-base leading-relaxed space-y-3.5">
                            <p>
                                <strong>Adeshola Eniola</strong> is a Co-founder and Partner at Yonbus Tax & Accounting Services Inc., bringing over 10 years of professional auditing experience to the firm.
                            </p>
                            <p>
                                He is a Certified Professional Bookkeeper (CPB), with a Bachelor’s degree in Accounting and a Diploma in Accounting from Mohawk College, Ontario. He is also a trained tax professional serving clients in Quebec and other provinces.
                            </p>
                            <p>
                                With his strong background in auditing, accounting, and financial reporting, Adeshola specializes in helping individuals and businesses navigate complex accounting and bookkeeping issues. He is committed to providing accurate, practical, and reliable solutions that help clients maintain organized financial records and make informed business decisions.
                            </p>
                        </div>

                        <div class="pt-4 border-t border-slate-100 flex flex-wrap gap-2">
                            <span class="px-3 py-1.5 bg-blue-50 text-blue-700 text-xs font-semibold rounded-lg">🎓 B.Sc Accounting</span>
                            <span class="px-3 py-1.5 bg-blue-50 text-blue-700 text-xs font-semibold rounded-lg">🏛️ Mohawk College Alumni</span>
                            <span class="px-3 py-1.5 bg-blue-50 text-blue-700 text-xs font-semibold rounded-lg">📊 Senior Auditing Specialist</span>
                            <span class="px-3 py-1.5 bg-blue-50 text-blue-700 text-xs font-semibold rounded-lg">🔍 Financial Reporting Expert</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- Value Proposition Banner --}}
    <section class="py-16 border-t border-slate-200" style="background:#ffffff;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-8">
            <h3 class="text-2xl font-bold font-heading" style="color:#0a1a4a;">Why Clients Trust Our Firm</h3>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="p-6 rounded-2xl space-y-2 border border-blue-100" style="background:#f0f6ff;">
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-950 text-[#0052ff] rounded-xl flex items-center justify-center mx-auto text-xl">🛡️</div>
                    <h4 class="font-bold text-sm font-heading" style="color:#0a1a4a;">100% Tax Compliance</h4>
                    <p class="text-xs text-slate-500 leading-relaxed">Rigorous adherence to CRA & Revenu Québec regulations.</p>
                </div>

                <div class="p-6 rounded-2xl space-y-2 border border-blue-100" style="background:#f0f6ff;">
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-950 text-[#0052ff] rounded-xl flex items-center justify-center mx-auto text-xl">🎯</div>
                    <div class="font-bold text-sm font-heading" style="color:#0a1a4a;">Audit Expertise</div>
                    <p class="text-xs text-slate-500 leading-relaxed">Backed by over a decade of professional auditing experience.</p>
                </div>

                <div class="p-6 rounded-2xl space-y-2 border border-blue-100" style="background:#f0f6ff;">
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-950 text-[#0052ff] rounded-xl flex items-center justify-center mx-auto text-xl">🇨🇦</div>
                    <div class="font-bold text-sm font-heading" style="color:#0a1a4a;">Cross-Province Practice</div>
                    <p class="text-xs text-slate-500 leading-relaxed">Certified and experienced serving Quebec, Ontario & all provinces.</p>
                </div>

                <div class="p-6 rounded-2xl space-y-2 border border-blue-100" style="background:#f0f6ff;">
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-950 text-[#0052ff] rounded-xl flex items-center justify-center mx-auto text-xl">🤝</div>
                    <div class="font-bold text-sm font-heading" style="color:#0a1a4a;">Personalized Advisory</div>
                    <p class="text-xs text-slate-500 leading-relaxed">Tailored financial solutions for individuals and corporate entities.</p>
                </div>
            </div>

            <div class="pt-6">
                <a href="{{ route('book-appointment') }}" class="inline-flex items-center gap-2 px-8 py-3.5 bg-[#0052ff] hover:bg-blue-600 text-white font-bold text-sm rounded-xl shadow-lg shadow-blue-500/25 transition-all transform hover:-translate-y-0.5">
                    <span>Schedule Consultation With Our Partners</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>
    </section>
</x-public-layout>
