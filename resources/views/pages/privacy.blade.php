<x-public-layout>
    <x-slot name="title">Privacy Policy | YONBUS Tax & Accounting Services Inc.</x-slot>

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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                <span>PIPEDA &amp; Quebec Law 25 Compliant</span>
            </div>

            <h1 class="font-heading font-extrabold text-3xl sm:text-4xl md:text-5xl tracking-tight leading-tight m-0" style="color: #ffffff !important;">
                Privacy Policy &amp; Data Protection
            </h1>

            <p class="max-w-2xl mx-auto text-sm sm:text-base md:text-lg text-blue-100/90 leading-relaxed font-normal">
                How YONBUS Tax &amp; Accounting Services Inc. collects, safeguards, utilizes, and manages your personal and corporate financial records.
            </p>

            <div class="pt-2 flex items-center justify-center gap-4 text-xs sm:text-sm text-blue-200/80 font-medium">
                <span>Effective Date: <strong>January 1, 2026</strong></span>
                <span>•</span>
                <span>Last Updated: <strong>August 2026</strong></span>
            </div>
        </div>
    </section>

    {{-- ============================================================
         CORE PRIVACY HIGHLIGHTS (4 Pillars)
         ============================================================ --}}
    <section class="relative -mt-8 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 z-20" data-aos="fade-up" data-aos-duration="600" data-aos-delay="100">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            
            <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-md flex items-start gap-3.5">
                <div class="w-10 h-10 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center text-blue-600 flex-shrink-0 text-lg">
                    🔒
                </div>
                <div>
                    <h3 class="font-heading font-bold text-slate-900 text-sm m-0">Bank-Grade 256-Bit AES</h3>
                    <p class="text-slate-600 text-xs mt-1 leading-snug">All financial documents &amp; portals encrypted at rest and in transit.</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-md flex items-start gap-3.5">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600 flex-shrink-0 text-lg">
                    🛡️
                </div>
                <div>
                    <h3 class="font-heading font-bold text-slate-900 text-sm m-0">Zero Data Monetization</h3>
                    <p class="text-slate-600 text-xs mt-1 leading-snug">We never sell, rent, or trade your personal or tax information.</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-md flex items-start gap-3.5">
                <div class="w-10 h-10 rounded-xl bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-600 flex-shrink-0 text-lg">
                    ⚖️
                </div>
                <div>
                    <h3 class="font-heading font-bold text-slate-900 text-sm m-0">Statutory Compliance</h3>
                    <p class="text-slate-600 text-xs mt-1 leading-snug">Full alignment with CRA, Revenu Québec &amp; CPB Canada standards.</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-md flex items-start gap-3.5">
                <div class="w-10 h-10 rounded-xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 flex-shrink-0 text-lg">
                    👤
                </div>
                <div>
                    <h3 class="font-heading font-bold text-slate-900 text-sm m-0">Full Client Control</h3>
                    <p class="text-slate-600 text-xs mt-1 leading-snug">Access, review, or request export of your personal information anytime.</p>
                </div>
            </div>

        </div>
    </section>

    {{-- ============================================================
         POLICY BODY CONTENT WITH SIDEBAR NAVIGATION
         ============================================================ --}}
    <section class="py-14 sm:py-18 md:py-20 bg-slate-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">

                {{-- Left Sticky Table of Contents --}}
                <div class="lg:col-span-4 sticky top-24 space-y-6">
                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-4">
                        <h4 class="font-heading font-bold text-slate-900 text-sm uppercase tracking-wider border-b border-slate-100 pb-3 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                            Policy Navigation
                        </h4>
                        <nav class="space-y-1 text-xs sm:text-sm font-medium">
                            @foreach([
                                '1' => 'Introduction & Scope',
                                '2' => 'Information We Collect',
                                '3' => 'How We Use Your Data',
                                '4' => 'Consent & Authorization',
                                '5' => 'Disclosure & Sharing',
                                '6' => 'Security & Encryption',
                                '7' => 'Retention & Destruction',
                                '8' => 'Your Privacy Rights',
                                '9' => 'Cookies & Digital Analytics',
                                '10' => 'Privacy Officer & Inquiries',
                            ] as $num => $title)
                            <a href="#section-{{ $num }}" class="block px-3 py-2 rounded-lg text-slate-600 hover:text-blue-600 hover:bg-blue-50 transition-colors">
                                <span class="text-slate-400 font-bold mr-1.5">{{ $num }}.</span> {{ $title }}
                            </a>
                            @endforeach
                        </nav>
                    </div>

                    {{-- Quick Contact Card --}}
                    <div class="rounded-2xl p-6 text-white border border-blue-400/20 shadow-md space-y-3" style="background: linear-gradient(135deg, #0A1E4A 0%, #0036A8 100%);">
                        <h4 class="font-heading font-bold text-white text-base m-0 flex items-center gap-2">
                            <span>📞</span> Need Privacy Assistance?
                        </h4>
                        <p class="text-blue-100 text-xs leading-relaxed">
                            Questions regarding our data handling or wish to exercise your rights under Law 25 or PIPEDA? Contact our Privacy Officer directly.
                        </p>
                        <a href="mailto:privacy@yonbustax.ca" class="inline-flex items-center gap-2 text-xs font-bold text-white bg-blue-600 hover:bg-blue-500 px-4 py-2.5 rounded-xl transition-all shadow-sm">
                            <span>Email Privacy Officer</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </div>

                {{-- Right Detailed Content --}}
                <div class="lg:col-span-8 bg-white rounded-3xl p-6 sm:p-10 border border-slate-200/90 shadow-sm space-y-10 text-slate-700 leading-relaxed text-sm sm:text-base">

                    {{-- Section 1 --}}
                    <div id="section-1" class="space-y-4 pt-2">
                        <div class="flex items-center gap-2 text-blue-600 font-bold text-xs uppercase tracking-wider">
                            <span>Section 01</span>
                            <span>•</span>
                            <span>Governance</span>
                        </div>
                        <h2 class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900 m-0">1. Introduction &amp; Scope</h2>
                        <p>
                            <strong>YONBUS Tax &amp; Accounting Services Inc.</strong> ("YONBUS", "we", "us", or "our") is a federally incorporated accounting and tax consultancy operating from Gatineau, Quebec, Canada. We provide personal tax preparation, corporate tax filings, bookkeeping, payroll, advisory, and audit support across Canada.
                        </p>
                        <p>
                            We are committed to maintaining the highest standards of confidentiality, transparency, and integrity. This Privacy Policy governs our collection, storage, use, disclosure, and safeguarding of personal and corporate financial information in compliance with:
                        </p>
                        <ul class="list-disc pl-5 space-y-2 text-slate-600">
                            <li><strong>PIPEDA:</strong> The federal <em>Personal Information Protection and Electronic Documents Act</em> (S.C. 2000, c. 5).</li>
                            <li><strong>Quebec Law 25:</strong> <em>An Act to modernize legislative provisions as regards the protection of personal information</em> (R.S.Q., c. P-39.1).</li>
                            <li><strong>Income Tax Act (Canada) &amp; Taxation Act (Quebec):</strong> Confidentiality provisions governing taxpayer records.</li>
                            <li><strong>CPB Canada Code of Ethics:</strong> Professional standards enforced by the Certified Professional Bookkeepers of Canada.</li>
                        </ul>
                    </div>

                    <hr class="border-slate-100 my-8">

                    {{-- Section 2 --}}
                    <div id="section-2" class="space-y-4">
                        <div class="flex items-center gap-2 text-blue-600 font-bold text-xs uppercase tracking-wider">
                            <span>Section 02</span>
                            <span>•</span>
                            <span>Collection</span>
                        </div>
                        <h2 class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900 m-0">2. Personal &amp; Financial Information We Collect</h2>
                        <p>
                            To deliver tax, accounting, and payroll services, we collect information that is strictly necessary for statutory compliance and accurate reporting:
                        </p>

                        <div class="space-y-4 pt-2">
                            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80">
                                <h4 class="font-bold text-slate-900 text-sm mb-1 flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-blue-500"></span> Personal Identifiers
                                </h4>
                                <p class="text-xs sm:text-sm text-slate-600">
                                    Legal full name, residential and mailing address, date of birth, Social Insurance Number (SIN), marital status, residency status, dependent details, email address, and telephone numbers.
                                </p>
                            </div>

                            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80">
                                <h4 class="font-bold text-slate-900 text-sm mb-1 flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-blue-500"></span> Corporate &amp; Business Information
                                </h4>
                                <p class="text-xs sm:text-sm text-slate-600">
                                    Corporate legal name, Business Number (BN), Quebec Enterprise Number (NEQ), CRA/Revenu Québec program accounts (GST/HST, QST, payroll remittances, corporate income tax), director information, shareholdings, and articles of incorporation.
                                </p>
                            </div>

                            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80">
                                <h4 class="font-bold text-slate-900 text-sm mb-1 flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-blue-500"></span> Tax &amp; Financial Documentation
                                </h4>
                                <p class="text-xs sm:text-sm text-slate-600">
                                    T-slips (T4, T5, T3, T5007, T2202), Relevé slips (RL-1, RL-3, RL-24), prior Notices of Assessment (NOA), financial statements, balance sheets, general ledgers, receipts, mileage logs, bank statements, and investment summaries.
                                </p>
                            </div>

                            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80">
                                <h4 class="font-bold text-slate-900 text-sm mb-1 flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-blue-500"></span> Client Portal &amp; Technical Metadata
                                </h4>
                                <p class="text-xs sm:text-sm text-slate-600">
                                    Login credentials (encrypted password hashes), multi-factor authentication data, IP addresses, browser types, session timestamps, and portal activity logs.
                                </p>
                            </div>
                        </div>
                    </div>

                    <hr class="border-slate-100 my-8">

                    {{-- Section 3 --}}
                    <div id="section-3" class="space-y-4">
                        <div class="flex items-center gap-2 text-blue-600 font-bold text-xs uppercase tracking-wider">
                            <span>Section 03</span>
                            <span>•</span>
                            <span>Purpose</span>
                        </div>
                        <h2 class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900 m-0">3. How We Use Your Data</h2>
                        <p>We use the collected information solely for legitimate professional purposes, including:</p>
                        <ul class="list-disc pl-5 space-y-2 text-slate-600">
                            <li><strong>Tax Filing:</strong> Preparing, calculating, and electronically transmitting T1 personal returns, T2 corporate returns, TP1 Quebec returns, and CO-17 filings via CRA EFILE/Netfile and Revenu Québec ClicSéqur.</li>
                            <li><strong>Accounting &amp; Bookkeeping:</strong> Reconciling ledgers, generating financial statements, and processing monthly/quarterly filings.</li>
                            <li><strong>Payroll Administration:</strong> Calculating deductions (CPP/QPP, EI, tax withholdings), producing T4/RL-1 summaries, and managing records of employment (ROE).</li>
                            <li><strong>Representation &amp; Dispute Defense:</strong> Representing clients during CRA or Revenu Québec reviews, audit inquiries, formal objections, and notice adjustments.</li>
                            <li><strong>Client Portal Services:</strong> Providing secure client portal access, file management, document verification, video consultations, and electronic invoice processing.</li>
                        </ul>
                    </div>

                    <hr class="border-slate-100 my-8">

                    {{-- Section 4 --}}
                    <div id="section-4" class="space-y-4">
                        <div class="flex items-center gap-2 text-blue-600 font-bold text-xs uppercase tracking-wider">
                            <span>Section 04</span>
                            <span>•</span>
                            <span>Consent</span>
                        </div>
                        <h2 class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900 m-0">4. Consent &amp; Representation Authorization</h2>
                        <p>
                            We collect, use, and disclose personal information only with your knowledgeable and informed consent, except where required or permitted by law.
                        </p>
                        <div class="p-4 rounded-xl bg-blue-50 border border-blue-200 text-blue-900 text-xs sm:text-sm leading-relaxed space-y-2">
                            <p class="font-bold flex items-center gap-2">
                                <span>📄</span> CRA &amp; Revenu Québec Representative Authorizations
                            </p>
                            <p>
                                When you engage us to represent you before tax authorities, you execute a formal authorization (such as CRA Form <strong>AUT-01 / Level 1/2 Representative Authorization</strong> or Revenu Québec Form <strong>MR-69</strong>). You retain the right to revoke this representative authority at any time.
                            </p>
                        </div>
                    </div>

                    <hr class="border-slate-100 my-8">

                    {{-- Section 5 --}}
                    <div id="section-5" class="space-y-4">
                        <div class="flex items-center gap-2 text-blue-600 font-bold text-xs uppercase tracking-wider">
                            <span>Section 05</span>
                            <span>•</span>
                            <span>Disclosure</span>
                        </div>
                        <h2 class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900 m-0">5. Disclosure &amp; Information Sharing</h2>
                        <p>
                            <strong>YONBUS does NOT sell, rent, lease, or monetize your information.</strong> We disclose data strictly under the following controlled circumstances:
                        </p>
                        <ul class="list-disc pl-5 space-y-2 text-slate-600">
                            <li><strong>Government &amp; Tax Authorities:</strong> The Canada Revenue Agency (CRA), Revenu Québec, and relevant municipal/provincial revenue bodies to effectuate statutory filings and compliance.</li>
                            <li><strong>Secure Service Providers:</strong> Trusted cloud infrastructure and data processing partners (e.g., CRA-certified tax software providers, Canadian data centers, payment gateways) operating under strict non-disclosure and SOC-2 data processing agreements.</li>
                            <li><strong>Legal &amp; Regulatory Mandates:</strong> Where compelled by subpoena, court order, or lawful warrant under Canadian federal or provincial jurisdiction.</li>
                        </ul>
                    </div>

                    <hr class="border-slate-100 my-8">

                    {{-- Section 6 --}}
                    <div id="section-6" class="space-y-4">
                        <div class="flex items-center gap-2 text-blue-600 font-bold text-xs uppercase tracking-wider">
                            <span>Section 06</span>
                            <span>•</span>
                            <span>Security</span>
                        </div>
                        <h2 class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900 m-0">6. Security Standards &amp; Safeguards</h2>
                        <p>
                            We employ comprehensive physical, administrative, and technological security measures to protect your sensitive financial records from unauthorized access, loss, alteration, or disclosure:
                        </p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                            <div class="p-3.5 bg-slate-50 rounded-xl border border-slate-200">
                                <span class="font-bold text-slate-900 text-xs block mb-1">🔐 256-Bit AES Encryption</span>
                                <span class="text-xs text-slate-600">All database records and file uploads encrypted at rest using military-grade AES-256.</span>
                            </div>
                            <div class="p-3.5 bg-slate-50 rounded-xl border border-slate-200">
                                <span class="font-bold text-slate-900 text-xs block mb-1">🌐 TLS 1.3 Transport Security</span>
                                <span class="text-xs text-slate-600">All data in transit protected by modern SSL/TLS 1.3 end-to-end cryptographic protocols.</span>
                            </div>
                            <div class="p-3.5 bg-slate-50 rounded-xl border border-slate-200">
                                <span class="font-bold text-slate-900 text-xs block mb-1">🔑 Role-Based Access Controls</span>
                                <span class="text-xs text-slate-600">Staff access is strictly restricted on a least-privilege, need-to-know basis.</span>
                            </div>
                            <div class="p-3.5 bg-slate-50 rounded-xl border border-slate-200">
                                <span class="font-bold text-slate-900 text-xs block mb-1">🚨 Breach Notification Protocol</span>
                                <span class="text-xs text-slate-600">Immediate protocol to notify affected individuals and the CAI / OPC in event of confidentiality incidents.</span>
                            </div>
                        </div>
                    </div>

                    <hr class="border-slate-100 my-8">

                    {{-- Section 7 --}}
                    <div id="section-7" class="space-y-4">
                        <div class="flex items-center gap-2 text-blue-600 font-bold text-xs uppercase tracking-wider">
                            <span>Section 07</span>
                            <span>•</span>
                            <span>Retention</span>
                        </div>
                        <h2 class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900 m-0">7. Data Retention &amp; Destruction</h2>
                        <p>
                            Under section 230(4) of the federal <em>Income Tax Act</em> and provincial taxation statutes, Canadian taxpayers and accountants are legally mandated to retain books of account, tax returns, and supporting receipts for a <strong>minimum period of six (6) years</strong> from the end of the last tax year to which they relate.
                        </p>
                        <p>
                            Upon expiration of statutory retention requirements, digital files are permanently erased using secure cryptographic erasure methods, and physical documents are shredded using certified industrial document destruction.
                        </p>
                    </div>

                    <hr class="border-slate-100 my-8">

                    {{-- Section 8 --}}
                    <div id="section-8" class="space-y-4">
                        <div class="flex items-center gap-2 text-blue-600 font-bold text-xs uppercase tracking-wider">
                            <span>Section 08</span>
                            <span>•</span>
                            <span>Client Rights</span>
                        </div>
                        <h2 class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900 m-0">8. Your Privacy Rights</h2>
                        <p>Subject to statutory exceptions under Canadian law and Quebec Law 25, you hold the right to:</p>
                        <ul class="list-disc pl-5 space-y-2 text-slate-600">
                            <li><strong>Access:</strong> Request confirmation and access to personal records held by our firm.</li>
                            <li><strong>Rectification:</strong> Request the correction of inaccurate, incomplete, or ambiguous personal data.</li>
                            <li><strong>Data Portability:</strong> Request an export of your digital records in a structured, commonly used format.</li>
                            <li><strong>De-indexation &amp; Deletion:</strong> Request deletion of data that is no longer required for statutory tax compliance.</li>
                            <li><strong>Withdrawal of Consent:</strong> Withdraw consent for non-statutory communications (such as marketing newsletters or educational updates).</li>
                        </ul>
                    </div>

                    <hr class="border-slate-100 my-8">

                    {{-- Section 9 --}}
                    <div id="section-9" class="space-y-4">
                        <div class="flex items-center gap-2 text-blue-600 font-bold text-xs uppercase tracking-wider">
                            <span>Section 09</span>
                            <span>•</span>
                            <span>Cookies</span>
                        </div>
                        <h2 class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900 m-0">9. Cookies &amp; Digital Analytics</h2>
                        <p>
                            Our web application utilizes essential cookies to maintain secure authenticated user sessions, prevent cross-site request forgery (CSRF), and save theme preferences. We do not employ intrusive tracking mechanisms. You may configure your web browser to reject cookies, though some interactive portal features may function with reduced capability.
                        </p>
                    </div>

                    <hr class="border-slate-100 my-8">

                    {{-- Section 10 --}}
                    <div id="section-10" class="space-y-4">
                        <div class="flex items-center gap-2 text-blue-600 font-bold text-xs uppercase tracking-wider">
                            <span>Section 10</span>
                            <span>•</span>
                            <span>Contact</span>
                        </div>
                        <h2 class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900 m-0">10. Privacy Officer &amp; Inquiries</h2>
                        <p>
                            In compliance with Quebec Law 25 and PIPEDA requirements, YONBUS Tax &amp; Accounting Services Inc. has appointed a designated Privacy &amp; Data Governance Officer responsible for overseeing our privacy compliance program.
                        </p>

                        <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 space-y-3">
                            <h4 class="font-heading font-bold text-slate-900 text-base m-0">Designated Privacy Officer</h4>
                            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed m-0">
                                <strong>YONBUS Tax &amp; Accounting Services Inc.</strong><br>
                                Attention: Privacy &amp; Compliance Department<br>
                                📍 147 Rue du Châtelet, Gatineau, Quebec J8M 2A3, Canada<br>
                                📧 Email: <a href="mailto:privacy@yonbustax.ca" class="text-blue-600 font-semibold underline">privacy@yonbustax.ca</a> / <a href="mailto:info@yonbustax.ca" class="text-blue-600 font-semibold underline">info@yonbustax.ca</a><br>
                                📞 Telephone: <a href="tel:+14389781349" class="text-blue-600 font-semibold">+1 (438) 978-1349</a> / <a href="tel:+14386863599" class="text-blue-600 font-semibold">+1 (438) 686-3599</a>
                            </p>
                            <div class="pt-2 text-xs text-slate-500 border-t border-slate-200">
                                If you are unsatisfied with our response, you have the right to contact the <em>Office of the Privacy Commissioner of Canada (OPC)</em> or the <em>Commission d'accès à l'information du Québec (CAI)</em>.
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
</x-public-layout>
