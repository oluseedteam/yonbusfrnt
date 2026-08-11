<x-public-layout>
    <x-slot name="title">Our Leadership Team | YONBUS Tax & Accounting Services Inc.</x-slot>

    {{-- Hero Banner Section --}}
    <section class="relative py-20 overflow-hidden" style="background: linear-gradient(135deg, #020c24 0%, #0a1a4a 50%, #0052ff 100%);">
        <div class="absolute inset-0 bg-grid-white/[0.05] bg-[size:32px_32px]"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <span class="inline-block px-4 py-1.5 rounded-full text-xs font-extrabold uppercase tracking-widest text-blue-200 bg-blue-500/20 border border-blue-400/30 backdrop-blur-md mb-4" data-aos="fade-down">
                Leadership & Partners
            </span>
            <h1 class="text-3xl sm:text-5xl font-extrabold text-white font-heading tracking-tight mb-4" data-aos="fade-up" data-aos-delay="100">
                Meet Our Expert Accounting Team
            </h1>
            <p class="max-w-2xl mx-auto text-base sm:text-lg text-blue-100/90 font-medium leading-relaxed" data-aos="fade-up" data-aos-delay="200">
                Certified Professional Bookkeepers and seasoned tax specialists dedicated to maximizing your growth, ensuring strict compliance, and delivering financial clarity across Canada.
            </p>
        </div>
    </section>

    {{-- Team Members Section --}}
    <section class="py-20 bg-slate-50 dark:bg-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">

            {{-- 1. Olubukunola Eniola (Founder & Partner) --}}
            <div class="bg-white dark:bg-slate-800 rounded-3xl p-8 sm:p-12 shadow-xl border border-slate-200/80 dark:border-slate-700/80 transition-all hover:shadow-2xl" data-aos="fade-up">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                    {{-- Image Container --}}
                    <div class="lg:col-span-5 flex justify-center">
                        <div class="relative group">
                            <div class="absolute -inset-2 bg-gradient-to-r from-[#0052ff] to-blue-400 rounded-3xl blur-md opacity-25 group-hover:opacity-40 transition duration-500"></div>
                            <img src="{{ asset('images/team/olubukunola-eniola.jpg') }}" 
                                 alt="Olubukunola Eniola - Founder & Partner" 
                                 class="relative w-full max-w-sm rounded-2xl object-cover aspect-[4/5] shadow-lg border-2 border-white dark:border-slate-700">
                            <div class="absolute bottom-4 left-4 right-4 bg-slate-900/80 backdrop-blur-md p-3.5 rounded-xl text-white border border-white/10">
                                <p class="text-xs font-bold font-heading">Founder & Partner</p>
                                <p class="text-[11px] text-blue-300">YONBUS Tax & Accounting Services Inc.</p>
                            </div>
                        </div>
                    </div>

                    {{-- Content Container --}}
                    <div class="lg:col-span-7 space-y-6">
                        <div>
                            <div class="inline-flex items-center gap-2 px-3 py-1 bg-blue-50 dark:bg-blue-950/60 text-[#0052ff] dark:text-blue-400 text-xs font-bold rounded-lg mb-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                                Certified Professional Bookkeeper (CPB)
                            </div>
                            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white font-heading">
                                Olubukunola Eniola
                            </h2>
                            <p class="text-sm font-semibold text-[#0052ff] dark:text-blue-400 mt-1">
                                Founder & Partner
                            </p>
                        </div>

                        <div class="prose dark:prose-invert text-slate-600 dark:text-slate-300 text-sm sm:text-base leading-relaxed space-y-4">
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

                        <div class="pt-4 border-t border-slate-100 dark:border-slate-700 flex flex-wrap gap-2">
                            <span class="px-3 py-1 bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200 text-xs font-semibold rounded-lg">🎓 B.Sc Banking & Finance</span>
                            <span class="px-3 py-1 bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200 text-xs font-semibold rounded-lg">🏛️ Mohawk College Alumni</span>
                            <span class="px-3 py-1 bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200 text-xs font-semibold rounded-lg">💼 Tax & Payroll Specialist</span>
                            <span class="px-3 py-1 bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200 text-xs font-semibold rounded-lg">🇨🇦 Quebec & Nationwide Practice</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. Adeshola Eniola (Co-founder & Partner) --}}
            <div class="bg-white dark:bg-slate-800 rounded-3xl p-8 sm:p-12 shadow-xl border border-slate-200/80 dark:border-slate-700/80 transition-all hover:shadow-2xl" data-aos="fade-up" data-aos-delay="100">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                    {{-- Content Container (Order on desktop) --}}
                    <div class="lg:col-span-7 space-y-6 lg:order-1 order-2">
                        <div>
                            <div class="inline-flex items-center gap-2 px-3 py-1 bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 text-xs font-bold rounded-lg mb-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                                10+ Years Professional Auditing Experience
                            </div>
                            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white font-heading">
                                Adeshola Eniola
                            </h2>
                            <p class="text-sm font-semibold text-[#0052ff] dark:text-blue-400 mt-1">
                                Co-founder & Partner
                            </p>
                        </div>

                        <div class="prose dark:prose-invert text-slate-600 dark:text-slate-300 text-sm sm:text-base leading-relaxed space-y-4">
                            <p>
                                <strong>Adeshola Eniola</strong> is a Co-founder and Partner at Yonbus Tax & Accounting Services Inc., bringing over 10 years of professional auditing experience to the firm.
                            </p>
                            <p>
                                He is a Certified Professional Bookkeeper (CPB), with Bachelor’s degree in Accounting and a Diploma in Accounting from Mohawk College, Ontario. He is also a trained tax professional serving clients in Quebec and other provinces.
                            </p>
                            <p>
                                With his strong background in auditing, accounting, and financial reporting, Adeshola specializes in helping individuals and businesses navigate complex accounting and bookkeeping issues. He is committed to providing accurate, practical, and reliable solutions that help clients maintain organized financial records and make informed business decisions.
                            </p>
                        </div>

                        <div class="pt-4 border-t border-slate-100 dark:border-slate-700 flex flex-wrap gap-2">
                            <span class="px-3 py-1 bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200 text-xs font-semibold rounded-lg">🎓 B.Sc Accounting</span>
                            <span class="px-3 py-1 bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200 text-xs font-semibold rounded-lg">🏛️ Mohawk College Alumni</span>
                            <span class="px-3 py-1 bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200 text-xs font-semibold rounded-lg">📊 Senior Auditing Specialist</span>
                            <span class="px-3 py-1 bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200 text-xs font-semibold rounded-lg">🔍 Financial Reporting Expert</span>
                        </div>
                    </div>

                    {{-- Image Container --}}
                    <div class="lg:col-span-5 flex justify-center lg:order-2 order-1">
                        <div class="relative group">
                            <div class="absolute -inset-2 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-3xl blur-md opacity-25 group-hover:opacity-40 transition duration-500"></div>
                            <img src="{{ asset('images/team/adeshola-eniola.jpg') }}" 
                                 alt="Adeshola Eniola - Co-founder & Partner" 
                                 class="relative w-full max-w-sm rounded-2xl object-cover aspect-[4/5] shadow-lg border-2 border-white dark:border-slate-700">
                            <div class="absolute bottom-4 left-4 right-4 bg-slate-900/80 backdrop-blur-md p-3.5 rounded-xl text-white border border-white/10">
                                <p class="text-xs font-bold font-heading">Co-founder & Partner</p>
                                <p class="text-[11px] text-blue-300">YONBUS Tax & Accounting Services Inc.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- Value Proposition Banner --}}
    <section class="py-16 bg-white dark:bg-slate-800 border-t border-slate-200/60 dark:border-slate-700/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-8">
            <h3 class="text-2xl font-bold font-heading text-slate-900 dark:text-white">Why Clients Trust Our Firm</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="p-6 bg-slate-50 dark:bg-slate-900 rounded-2xl space-y-2 border border-slate-100 dark:border-slate-800">
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-950 text-[#0052ff] rounded-xl flex items-center justify-center mx-auto text-xl">🛡️</div>
                    <h4 class="font-bold text-sm text-slate-900 dark:text-white font-heading">100% Tax Compliance</h4>
                    <p class="text-xs text-slate-500 leading-relaxed">Rigorous adherence to CRA & Revenu Québec regulations.</p>
                </div>

                <div class="p-6 bg-slate-50 dark:bg-slate-900 rounded-2xl space-y-2 border border-slate-100 dark:border-slate-800">
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-950 text-[#0052ff] rounded-xl flex items-center justify-center mx-auto text-xl">🎯</div>
                    <div class="font-bold text-sm text-slate-900 dark:text-white font-heading">Audit Expertise</div>
                    <p class="text-xs text-slate-500 leading-relaxed">Backed by over a decade of professional auditing experience.</p>
                </div>

                <div class="p-6 bg-slate-50 dark:bg-slate-900 rounded-2xl space-y-2 border border-slate-100 dark:border-slate-800">
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-950 text-[#0052ff] rounded-xl flex items-center justify-center mx-auto text-xl">🇨🇦</div>
                    <div class="font-bold text-sm text-slate-900 dark:text-white font-heading">Cross-Province Practice</div>
                    <p class="text-xs text-slate-500 leading-relaxed">Certified and experienced serving Quebec, Ontario & all provinces.</p>
                </div>

                <div class="p-6 bg-slate-50 dark:bg-slate-900 rounded-2xl space-y-2 border border-slate-100 dark:border-slate-800">
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-950 text-[#0052ff] rounded-xl flex items-center justify-center mx-auto text-xl">🤝</div>
                    <div class="font-bold text-sm text-slate-900 dark:text-white font-heading">Personalized Advisory</div>
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
