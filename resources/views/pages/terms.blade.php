<x-public-layout>
    <x-slot name="title">Terms of Service | YONBUS Tax & Accounting Services Inc.</x-slot>

    {{-- ============================================================
         HERO SECTION (Deep Blue Gradient)
         ============================================================ --}}
    <section class="relative overflow-hidden py-16 sm:py-20 md:py-24" style="background: linear-gradient(135deg, #001A57 0%, #0036A8 50%, #0052FF 100%); color: #ffffff;">
        {{-- Ambient decorative glows --}}
        <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full opacity-20 pointer-events-none blur-3xl" style="background: radial-gradient(circle, #60A5FA 0%, transparent 70%);"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 rounded-full opacity-20 pointer-events-none blur-3xl" style="background: radial-gradient(circle, #38BDF8 0%, transparent 70%);"></div>

        <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4 z-10" data-aos="fade-up" data-aos-duration="600">
            {{-- Badge --}}
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider text-blue-100 border border-blue-400/40 backdrop-blur-md shadow-sm" style="background: rgba(3, 27, 78, 0.45);">
                <svg class="w-3.5 h-3.5 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span>Client Engagement &amp; Professional Standards</span>
            </div>

            <h1 class="font-heading font-extrabold text-3xl sm:text-4xl md:text-5xl tracking-tight leading-tight m-0" style="color: #ffffff !important;">
                Terms of Service &amp; Engagement
            </h1>

            <p class="max-w-2xl mx-auto text-sm sm:text-base md:text-lg text-blue-100/90 leading-relaxed font-normal">
                Terms, conditions, and professional guidelines governing accounting, tax preparation, payroll, and advisory services provided by YONBUS Tax &amp; Accounting Services Inc.
            </p>

            <div class="pt-2 flex items-center justify-center gap-4 text-xs sm:text-sm text-blue-200/80 font-medium">
                <span>Effective Date: <strong>January 1, 2026</strong></span>
                <span>•</span>
                <span>Last Updated: <strong>August 2026</strong></span>
            </div>
        </div>
    </section>

    {{-- ============================================================
         CORE HIGHLIGHTS (4 Pillars)
         ============================================================ --}}
    <section class="relative -mt-8 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 z-20" data-aos="fade-up" data-aos-duration="600" data-aos-delay="100">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            
            <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-md flex items-start gap-3.5">
                <div class="w-10 h-10 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center text-blue-600 flex-shrink-0 text-lg">
                    📋
                </div>
                <div>
                    <h3 class="font-heading font-bold text-slate-900 text-sm m-0">Transparent Engagement</h3>
                    <p class="text-slate-600 text-xs mt-1 leading-snug">Clear upfront scopes, milestone schedules, and predictable pricing.</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-md flex items-start gap-3.5">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600 flex-shrink-0 text-lg">
                    🤝
                </div>
                <div>
                    <h3 class="font-heading font-bold text-slate-900 text-sm m-0">Authorized E-Filer</h3>
                    <p class="text-slate-600 text-xs mt-1 leading-snug">Authorized representation with Canada Revenue Agency &amp; Revenu Québec.</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-md flex items-start gap-3.5">
                <div class="w-10 h-10 rounded-xl bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-600 flex-shrink-0 text-lg">
                    🔒
                </div>
                <div>
                    <h3 class="font-heading font-bold text-slate-900 text-sm m-0">Strict Confidentiality</h3>
                    <p class="text-slate-600 text-xs mt-1 leading-snug">Client documentation and financial records held in utmost confidence.</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-md flex items-start gap-3.5">
                <div class="w-10 h-10 rounded-xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 flex-shrink-0 text-lg">
                    ⚖️
                </div>
                <div>
                    <h3 class="font-heading font-bold text-slate-900 text-sm m-0">Canadian Law</h3>
                    <p class="text-slate-600 text-xs mt-1 leading-snug">Governed under the laws of Quebec and federal laws of Canada.</p>
                </div>
            </div>

        </div>
    </section>

    {{-- ============================================================
         TERMS BODY CONTENT WITH SIDEBAR NAVIGATION
         ============================================================ --}}
    <section class="py-14 sm:py-18 md:py-20 bg-slate-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">

                {{-- Left Sticky Table of Contents --}}
                <div class="lg:col-span-4 sticky top-24 space-y-6">
                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-4">
                        <h4 class="font-heading font-bold text-slate-900 text-sm uppercase tracking-wider border-b border-slate-100 pb-3 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                            Terms Navigation
                        </h4>
                        <nav class="space-y-1 text-xs sm:text-sm font-medium">
                            @foreach([
                                '1' => 'Acceptance & Engagement',
                                '2' => 'Professional Scope of Services',
                                '3' => 'Client Responsibilities & Accuracy',
                                '4' => 'Authorizations & E-Filing',
                                '5' => 'Fees, Invoicing & Payments',
                                '6' => 'Appointments & Cancellations',
                                '7' => 'Limitation of Liability',
                                '8' => 'Intellectual Property & Portal Use',
                                '9' => 'Termination of Services',
                                '10' => 'Governing Law & Disputes',
                                '11' => 'Contact & Inquiries',
                            ] as $num => $title)
                            <a href="#terms-{{ $num }}" class="block px-3 py-2 rounded-lg text-slate-600 hover:text-blue-600 hover:bg-blue-50 transition-colors">
                                <span class="text-slate-400 font-bold mr-1.5">{{ $num }}.</span> {{ $title }}
                            </a>
                            @endforeach
                        </nav>
                    </div>

                    {{-- Quick Contact Card --}}
                    <div class="rounded-2xl p-6 text-white border border-blue-400/20 shadow-md space-y-3" style="background: linear-gradient(135deg, #0A1E4A 0%, #0036A8 100%);">
                        <h4 class="font-heading font-bold text-white text-base m-0 flex items-center gap-2">
                            <span>📜</span> Questions About Terms?
                        </h4>
                        <p class="text-blue-100 text-xs leading-relaxed">
                            Need clarification on our professional service agreements or billing arrangements? Reach out to our accounting team.
                        </p>
                        <a href="mailto:info@yonbustax.ca" class="inline-flex items-center gap-2 text-xs font-bold text-white bg-blue-600 hover:bg-blue-500 px-4 py-2.5 rounded-xl transition-all shadow-sm">
                            <span>Contact Engagement Team</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </div>

                {{-- Right Detailed Content --}}
                <div class="lg:col-span-8 bg-white rounded-3xl p-6 sm:p-10 border border-slate-200/90 shadow-sm space-y-10 text-slate-700 leading-relaxed text-sm sm:text-base">

                    {{-- Section 1 --}}
                    <div id="terms-1" class="space-y-4 pt-2">
                        <div class="flex items-center gap-2 text-blue-600 font-bold text-xs uppercase tracking-wider">
                            <span>Section 01</span>
                            <span>•</span>
                            <span>Engagement</span>
                        </div>
                        <h2 class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900 m-0">1. Acceptance of Terms &amp; Engagement</h2>
                        <p>
                            Welcome to <strong>YONBUS Tax &amp; Accounting Services Inc.</strong> ("YONBUS", "the Firm", "we", "us", or "our"). These Terms of Service and Conditions of Engagement ("Terms") constitute a legally binding agreement between you ("Client", "you", or "your") and YONBUS.
                        </p>
                        <p>
                            By registering a Client Portal account, scheduling an appointment, submitting tax documents, executing an engagement letter, or retaining our services, you acknowledge that you have read, understood, and agree to be bound by these Terms and our companion <a href="{{ route('privacy') }}" class="text-blue-600 font-semibold underline">Privacy Policy</a>.
                        </p>
                    </div>

                    <hr class="border-slate-100 my-8">

                    {{-- Section 2 --}}
                    <div id="terms-2" class="space-y-4">
                        <div class="flex items-center gap-2 text-blue-600 font-bold text-xs uppercase tracking-wider">
                            <span>Section 02</span>
                            <span>•</span>
                            <span>Services</span>
                        </div>
                        <h2 class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900 m-0">2. Professional Scope of Services</h2>
                        <p>
                            YONBUS delivers accounting, compliance, and advisory services tailored to Canadian individuals, sole proprietors, partnerships, and incorporated businesses. Our scope includes:
                        </p>
                        <ul class="list-disc pl-5 space-y-2 text-slate-600">
                            <li><strong>Personal Tax Compliance:</strong> Preparation and electronic filing of Canadian T1 Personal Income Tax returns and Quebec TP1 returns, including deductions, family benefits, rental income (T776), and investment reporting.</li>
                            <li><strong>Corporate Tax Services:</strong> Compilation of corporate financial statements, preparation and EFILE submission of T2 Corporate Income Tax returns and Quebec CO-17 returns.</li>
                            <li><strong>Bookkeeping &amp; Accounting:</strong> Monthly, quarterly, and annual bookkeeping, bank reconciliations, GST/HST and QST sales tax filing, and Notice to Reader / Compilation Engagements.</li>
                            <li><strong>Payroll &amp; Remittances:</strong> Payroll processing, direct deposit arrangements, CPP/QPP and EI calculations, T4/T4A and Relevé 1 preparation, and CRA/RQ remittances.</li>
                            <li><strong>Business Advisory &amp; Registration:</strong> Federal/Provincial incorporation, GST/HST/QST program account setup, and corporate structuring.</li>
                            <li><strong>Audit &amp; Review Representation:</strong> Professional assistance and documentation support during CRA and Revenu Québec audits, inquiries, and formal notices of objection.</li>
                        </ul>
                    </div>

                    <hr class="border-slate-100 my-8">

                    {{-- Section 3 --}}
                    <div id="terms-3" class="space-y-4">
                        <div class="flex items-center gap-2 text-blue-600 font-bold text-xs uppercase tracking-wider">
                            <span>Section 03</span>
                            <span>•</span>
                            <span>Client Duties</span>
                        </div>
                        <h2 class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900 m-0">3. Client Responsibilities &amp; Accuracy of Records</h2>
                        <p>
                            Under the Canadian <em>Income Tax Act</em> and provincial statutes, taxpayers hold final legal responsibility for the accuracy and completeness of their tax filings. By engaging YONBUS, you agree to:
                        </p>
                        <div class="space-y-3 pt-2">
                            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80">
                                <h4 class="font-bold text-slate-900 text-sm mb-1 flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-blue-500"></span> Full &amp; Timely Disclosure
                                </h4>
                                <p class="text-xs sm:text-sm text-slate-600">
                                    Provide all necessary T-slips, Relevé slips, expense receipts, logbooks, foreign property declarations (T1135), and financial records in a timely manner prior to statutory filing deadlines.
                                </p>
                            </div>

                            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80">
                                <h4 class="font-bold text-slate-900 text-sm mb-1 flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-blue-500"></span> Record Retention Obligation
                                </h4>
                                <p class="text-xs sm:text-sm text-slate-600">
                                    Maintain original physical and digital receipts, invoices, and bank statements for the statutory minimum period of six (6) years to substantiate deductions in case of CRA or Revenu Québec review.
                                </p>
                            </div>

                            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80">
                                <h4 class="font-bold text-slate-900 text-sm mb-1 flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-blue-500"></span> Review &amp; Approval
                                </h4>
                                <p class="text-xs sm:text-sm text-slate-600">
                                    Carefully review drafts of prepared returns and financial statements before authorizing electronic transmission.
                                </p>
                            </div>
                        </div>
                    </div>

                    <hr class="border-slate-100 my-8">

                    {{-- Section 4 --}}
                    <div id="terms-4" class="space-y-4">
                        <div class="flex items-center gap-2 text-blue-600 font-bold text-xs uppercase tracking-wider">
                            <span>Section 04</span>
                            <span>•</span>
                            <span>Authorizations</span>
                        </div>
                        <h2 class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900 m-0">4. Authorizations &amp; Electronic Filing (EFILE)</h2>
                        <p>
                            To represent you before revenue authorities and transmit electronic filings, specific statutory authorizations are required:
                        </p>
                        <div class="p-4 rounded-xl bg-blue-50 border border-blue-200 text-blue-900 text-xs sm:text-sm leading-relaxed space-y-2">
                            <p class="font-bold flex items-center gap-2">
                                <span>✍️</span> Mandatory Electronic Signatures
                            </p>
                            <p>
                                Prior to transmitting your tax return to the Canada Revenue Agency (CRA) or Revenu Québec, you must sign and return <strong>Form T183 (Information Return for Electronic Filing of an Individual's Income Tax and Benefit Return)</strong>, <strong>Form T183CORP</strong> for corporations, or Quebec <strong>Form TP-1000.TE</strong>. Under Canadian tax law, no return will be filed without a signed authorization.
                            </p>
                        </div>
                    </div>

                    <hr class="border-slate-100 my-8">

                    {{-- Section 5 --}}
                    <div id="terms-5" class="space-y-4">
                        <div class="flex items-center gap-2 text-blue-600 font-bold text-xs uppercase tracking-wider">
                            <span>Section 05</span>
                            <span>•</span>
                            <span>Financials</span>
                        </div>
                        <h2 class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900 m-0">5. Fees, Invoicing &amp; Payment Terms</h2>
                        <p>
                            Our professional fee structure reflects the complexity, required expertise, and volume of records involved in each engagement:
                        </p>
                        <ul class="list-disc pl-5 space-y-2 text-slate-600">
                            <li><strong>Quotes &amp; Estimates:</strong> Upfront fee estimates are provided based on information initially disclosed. If subsequent records reveal substantial additional complexity (such as unorganized ledgers, multiple rental properties, or foreign property reporting), we will notify you of adjusted fees prior to final filing.</li>
                            <li><strong>Payment Terms:</strong> Invoices are payable upon receipt or before final EFILE transmission, unless agreed otherwise in a recurring retainer agreement.</li>
                            <li><strong>Payment Methods:</strong> We accept major credit cards, Interac e-Transfer, and direct bank transfers through our secure portal payment gateway.</li>
                            <li><strong>Applicable Taxes:</strong> Professional fees are subject to applicable federal and provincial sales taxes (GST/HST and QST) according to client residency.</li>
                        </ul>
                    </div>

                    <hr class="border-slate-100 my-8">

                    {{-- Section 6 --}}
                    <div id="terms-6" class="space-y-4">
                        <div class="flex items-center gap-2 text-blue-600 font-bold text-xs uppercase tracking-wider">
                            <span>Section 06</span>
                            <span>•</span>
                            <span>Scheduling</span>
                        </div>
                        <h2 class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900 m-0">6. Consultation Appointments &amp; Cancellations</h2>
                        <p>
                            We value our clients' time and maintain dedicated consultation slots with our certified professionals:
                        </p>
                        <ul class="list-disc pl-5 space-y-2 text-slate-600">
                            <li><strong>Rescheduling:</strong> You may reschedule or cancel consultation appointments via the client portal or by phone at least <strong>24 hours</strong> prior to your scheduled time without penalty.</li>
                            <li><strong>Virtual Consultations:</strong> For video/teleconference consultations, please ensure a stable internet connection and have relevant financial questions prepared in advance.</li>
                        </ul>
                    </div>

                    <hr class="border-slate-100 my-8">

                    {{-- Section 7 --}}
                    <div id="terms-7" class="space-y-4">
                        <div class="flex items-center gap-2 text-blue-600 font-bold text-xs uppercase tracking-wider">
                            <span>Section 07</span>
                            <span>•</span>
                            <span>Liability</span>
                        </div>
                        <h2 class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900 m-0">7. Limitation of Liability &amp; Disclaimers</h2>
                        <p>
                            YONBUS performs all engagements in accordance with applicable Canadian professional accounting compilation and tax preparation standards:
                        </p>
                        <ul class="list-disc pl-5 space-y-2 text-slate-600">
                            <li><strong>No Audit Opinion:</strong> Compilation engagements (Notice to Reader) do not constitute an audit or review under Canadian Auditing Standards, and we do not express an audit opinion on compiled statements.</li>
                            <li><strong>Tax Authority Assessments:</strong> The Canada Revenue Agency and Revenu Québec retain the legal right to review, audit, and reassess returns within statutory limitation periods. An assessment or reassessment by tax authorities does not infer negligence on the part of YONBUS where returns were prepared in good faith based on client-provided records.</li>
                            <li><strong>Liability Cap:</strong> To the maximum extent permitted by applicable law, our total cumulative liability arising from any claim, error, or omission relating to our engagement shall not exceed the total fees paid by the Client to YONBUS for the specific service from which the claim arose.</li>
                        </ul>
                    </div>

                    <hr class="border-slate-100 my-8">

                    {{-- Section 8 --}}
                    <div id="terms-8" class="space-y-4">
                        <div class="flex items-center gap-2 text-blue-600 font-bold text-xs uppercase tracking-wider">
                            <span>Section 08</span>
                            <span>•</span>
                            <span>Portal &amp; IP</span>
                        </div>
                        <h2 class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900 m-0">8. Intellectual Property &amp; Portal Security</h2>
                        <p>
                            All software, branding, calculators, website designs, text, and portal assets are the proprietary intellectual property of YONBUS Tax &amp; Accounting Services Inc.
                        </p>
                        <p>
                            You are responsible for maintaining the confidentiality of your Client Portal login credentials and multi-factor authentication devices. You agree to notify us immediately of any unauthorized account access.
                        </p>
                    </div>

                    <hr class="border-slate-100 my-8">

                    {{-- Section 9 --}}
                    <div id="terms-9" class="space-y-4">
                        <div class="flex items-center gap-2 text-blue-600 font-bold text-xs uppercase tracking-wider">
                            <span>Section 09</span>
                            <span>•</span>
                            <span>Termination</span>
                        </div>
                        <h2 class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900 m-0">9. Termination of Engagement</h2>
                        <p>
                            Either party may terminate a professional engagement by providing written notice. In the event of termination:
                        </p>
                        <ul class="list-disc pl-5 space-y-2 text-slate-600">
                            <li>The Client shall pay for all professional services rendered and disbursements incurred up to the date of termination.</li>
                            <li>YONBUS will return all original client-provided documents upon receipt of outstanding fees, subject to our statutory record retention obligations under the <em>Income Tax Act</em>.</li>
                        </ul>
                    </div>

                    <hr class="border-slate-100 my-8">

                    {{-- Section 10 --}}
                    <div id="terms-10" class="space-y-4">
                        <div class="flex items-center gap-2 text-blue-600 font-bold text-xs uppercase tracking-wider">
                            <span>Section 10</span>
                            <span>•</span>
                            <span>Jurisdiction</span>
                        </div>
                        <h2 class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900 m-0">10. Governing Law &amp; Dispute Resolution</h2>
                        <p>
                            These Terms and all professional engagements are governed by, and construed in accordance with, the laws of the <strong>Province of Quebec</strong> and the federal laws of <strong>Canada</strong> applicable therein.
                        </p>
                        <p>
                            Any dispute, claim, or controversy arising out of or relating to our services shall first be submitted to good-faith mediation. If unresolved, the dispute shall be submitted to the exclusive jurisdiction of the courts of the judicial district of <strong>Gatineau (Hull), Quebec</strong>.
                        </p>
                    </div>

                    <hr class="border-slate-100 my-8">

                    {{-- Section 11 --}}
                    <div id="terms-11" class="space-y-4">
                        <div class="flex items-center gap-2 text-blue-600 font-bold text-xs uppercase tracking-wider">
                            <span>Section 11</span>
                            <span>•</span>
                            <span>Contact</span>
                        </div>
                        <h2 class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900 m-0">11. Legal &amp; Professional Contact Information</h2>
                        <p>
                            If you have questions regarding these Terms or wish to discuss an engagement agreement, please contact our professional practice office:
                        </p>

                        <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 space-y-3">
                            <h4 class="font-heading font-bold text-slate-900 text-base m-0">YONBUS Tax &amp; Accounting Services Inc.</h4>
                            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed m-0">
                                📍 147 Rue du Châtelet, Gatineau, Quebec J8M 2A3, Canada<br>
                                📧 General &amp; Legal Inquiries: <a href="mailto:info@yonbustax.ca" class="text-blue-600 font-semibold underline">info@yonbustax.ca</a><br>
                                📞 Telephone: <a href="tel:+14389781349" class="text-blue-600 font-semibold">+1 (438) 978-1349</a> / <a href="tel:+14386863599" class="text-blue-600 font-semibold">+1 (438) 686-3599</a><br>
                                🌐 Certified Member: <em>Certified Professional Bookkeepers of Canada (CPB Canada)</em>
                            </p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
</x-public-layout>
