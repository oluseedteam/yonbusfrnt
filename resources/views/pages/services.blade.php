<x-public-layout>
    <x-slot name="title">Services | YONBUS Tax & Accounting Services Inc.</x-slot>

    @php
        $footerServices = [
            [
                'id' => 'tax-preparation-planning',
                'name' => 'Tax Preparation & Planning',
                'tag' => 'Personal & Corporate Tax',
                'icon' => '🧾',
                'color' => '#0052FF',
                'badge_bg' => '#eff6ff',
                'badge_border' => '#bfdbfe',
                'short_desc' => 'Strategic tax minimization, Canadian T1 personal filings, Quebec TP1 returns, corporate T2 filings, and year-round proactive tax planning.',
                'highlights' => [
                    'Personal T1 & Quebec TP1 e-filings with maximum deduction discovery',
                    'Corporate T2 & Quebec CO-17 filings with capital cost allowance (CCA) planning',
                    'Rental properties (Form T776), investments, and capital gains calculations',
                    'Foreign property reporting (Form T1135) & cross-border tax compliance',
                ],
                'full_description' => 'Our Canadian tax specialists provide thorough, proactive tax preparation and strategic planning for individuals, families, real estate investors, and incorporated enterprises. We navigate complex federal and Quebec tax statutes to protect your wealth, minimize liabilities, and ensure total compliance with the Canada Revenue Agency (CRA) and Revenu Québec.',
                'whats_included' => [
                    'Personal T1 & TP-1 Quebec electronic tax filing with instant CRA confirmation',
                    'Corporate T2 & CO-17 returns, financial statements, and tax credit maximization',
                    'Rental income & expense accounting (T776 schedules, CCA depreciation strategies)',
                    'Foreign property and offshore asset compliance reporting (Form T1135)',
                    'Medical expense, childcare, caregiver, and disability tax credit (DTC) optimization',
                    'Tuition transfer, RRSP/TFSA/FHSA deduction strategies, and marginal bracket planning',
                    'Year-end tax forecasting, salary vs. dividend optimization for shareholders',
                    'Prior-year tax adjustments (T1-ADJ), unfiled returns, and voluntary disclosures',
                ],
                'deliverables' => 'Notice of Assessment verification, certified digital copy of filed returns, tax deduction summary, and next-year tax projection.',
                'who_for' => 'Individuals, self-employed contractors, real estate owners, corporate directors, and growing business owners.',
            ],
            [
                'id' => 'accounting-bookkeeping',
                'name' => 'Accounting & Bookkeeping',
                'tag' => 'Ledgers & Financial Clarity',
                'icon' => '🧮',
                'color' => '#0D9488',
                'badge_bg' => '#f0fdfa',
                'badge_border' => '#99f6e4',
                'short_desc' => 'Accurate full-cycle bookkeeping, monthly bank reconciliations, Notice to Reader compilation reports, and real-time financial reporting.',
                'highlights' => [
                    'Cloud-based ledger management (QuickBooks Online, Xero, Sage)',
                    'Monthly bank, credit card, and loan reconciliations',
                    'Compilation Engagements & Notice to Reader financial statements (CSRS 4200)',
                    'Certified Professional Bookkeeper (CPB Canada) oversight',
                ],
                'full_description' => 'Gain complete visibility and control over your financial health. As certified members of CPB Canada, we maintain flawless books, provide crystal-clear management statements, and structure your general ledgers to ensure smooth tax filings and audit-ready accounting records throughout the fiscal year.',
                'whats_included' => [
                    'Full-cycle cloud bookkeeping with automated bank feed integrations',
                    'Monthly, quarterly, and annual transaction classification and receipt matching',
                    'Accounts Payable (AP) and Accounts Receivable (AR) management and tracking',
                    'Monthly Balance Sheet, Profit & Loss (P&L), and Cash Flow statement generation',
                    'Notice to Reader / Compilation Engagement reports under Canadian CSRS 4200 standards',
                    'Fixed asset schedules, amortization calculations, and inventory adjustments',
                    'Year-end closing journal entries and seamless handoff to corporate tax preparers',
                    'Dedicated CPB Canada Certified Bookkeeper assigned to your account',
                ],
                'deliverables' => 'Monthly financial reporting package, reconciled balance sheets, P&L statements, and year-end trial balance packages.',
                'who_for' => 'Small-to-medium businesses, professional corporations, retail shops, tech startups, and non-profits.',
            ],
            [
                'id' => 'payroll-services',
                'name' => 'Payroll Services',
                'tag' => 'Employee & Remittances',
                'icon' => '📊',
                'color' => '#6366F1',
                'badge_bg' => '#eef2ff',
                'badge_border' => '#c7d2fe',
                'short_desc' => 'End-to-end payroll automation, direct deposit processing, statutory source deductions (CPP/QPP, EI), ROE filings, and annual T4/RL-1 slips.',
                'highlights' => [
                    'Automated Direct Deposit payouts to all Canadian financial institutions',
                    'Accurate calculation of statutory CRA & Revenu Québec withholdings',
                    'Electronic Record of Employment (ROE) submissions to Service Canada',
                    'Annual preparation & E-filing of T4, T4A, and Relevé 1 summaries',
                ],
                'full_description' => 'Managing payroll in Canada requires strict adherence to federal and provincial labor laws, source deduction schedules, and remittance deadlines. YONBUS streamlines your entire payroll cycle, ensuring employees are paid accurately on time while eliminating the risk of costly CRA and Revenu Québec remittance penalties.',
                'whats_included' => [
                    'Automated bi-weekly, semi-monthly, or monthly direct deposit disbursements',
                    'Calculation of federal & Quebec source deductions (CPP/QPP, EI, federal & provincial tax)',
                    'Monthly CRA and Revenu Québec source remittance filings and schedule management',
                    'Electronic Record of Employment (ROE) issuance upon employee separation',
                    'Year-end T4, T4A, and Quebec Relevé 1 tax slip generation and E-filing',
                    'Worker compensation reporting (WSIB in Ontario, CNESST in Quebec)',
                    'Secure employee online portal for pay stubs and tax slip downloads',
                    'Vacation pay tracking, statutory holiday pay, and overtime compliance',
                ],
                'deliverables' => 'Payroll summary register, direct deposit transmission logs, remittance confirmation receipts, and annual T4/RL-1 summaries.',
                'who_for' => 'Canadian employers with salaried, hourly, commission-based staff, or corporate directors drawing wages.',
            ],
            [
                'id' => 'business-consulting-advisory',
                'name' => 'Business Consulting & Advisory',
                'tag' => 'Strategy & Growth',
                'icon' => '💼',
                'color' => '#EA580C',
                'badge_bg' => '#fff7ed',
                'badge_border' => '#fed7aa',
                'short_desc' => 'Actionable financial forecasting, cash flow optimization, KPI benchmarking, business valuation, and fractional CFO-level growth guidance.',
                'highlights' => [
                    'Fractional CFO leadership and executive strategic advisory',
                    '3-to-5-year budget forecasting and financial scenario modeling',
                    'Cash flow optimization, margin analysis, and cost control audits',
                    'Financing and loan package preparation for Canadian banks & BDC',
                ],
                'full_description' => 'Transform raw numbers into strategic growth engines. Our advisory team helps business leaders optimize operational margins, evaluate capital investments, prepare robust loan packages, and navigate expansion opportunities with confidence and financial rigor.',
                'whats_included' => [
                    'Fractional CFO advisory sessions tailored to executive leadership',
                    'Dynamic 3-year revenue and expense forecasting and cash runway modeling',
                    'Key Performance Indicator (KPI) dashboards and industry benchmarking',
                    'Working capital optimization, inventory turnover, and debt management',
                    'Business plan financial section preparation for BDC and commercial lenders',
                    'Shareholder dividend vs. salary optimization models for tax efficiency',
                    'Merger, acquisition, and business valuation financial due diligence',
                    'Succession planning, buy-sell agreements, and corporate reorganization guidance',
                ],
                'deliverables' => 'Financial forecast models, executive KPI summary dashboards, advisory action roadmaps, and financing submission packages.',
                'who_for' => 'Entrepreneurs, growing companies, incorporated professionals, and businesses preparing for scale or investment.',
            ],
            [
                'id' => 'compliance-services',
                'name' => 'Compliance Services',
                'tag' => 'Sales Tax & Audit Defense',
                'icon' => '⚖️',
                'color' => '#DC2626',
                'badge_bg' => '#fef2f2',
                'badge_border' => '#fecaca',
                'short_desc' => 'Sales tax filings (GST/HST & QST), corporate annual returns, Tax audit representation, CRA/RQ inquiry defense, and formal appeals.',
                'highlights' => [
                    'GST/HST and Quebec Sales Tax (QST) calculation, reconciliation, and filing',
                    'Representation during CRA & Revenu Québec audits, inquiries, and reviews',
                    'Drafting formal Notices of Objection and tax dispute negotiations',
                    'Taxpayer relief applications for interest and penalty waivers',
                ],
                'full_description' => 'Stay fully compliant with Canadian tax regulations and protect your enterprise against audits. We handle complex multi-jurisdictional sales tax reconciliations and represent your interests before the Canada Revenue Agency and Revenu Québec to resolve disputes and mitigate penalties.',
                'whats_included' => [
                    'GST/HST and Quebec QST return preparation, Input Tax Credit (ITC/ITR) maximization',
                    'Expert representation during CRA reviews, audit inquiries, and pre-assessment verifications',
                    'Drafting formal Notices of Objection and evidence dossiers for tax appeals',
                    'Applications under the CRA Voluntary Disclosures Program (VDP) for unfiled periods',
                    'Taxpayer Relief requests for cancellation of statutory interest and late-filing penalties',
                    'Federal (Corporations Canada) and provincial corporate annual compliance maintenance',
                    'Subcontractor T5018 reporting and contractor compliance verification',
                    'Strict adherence to Canadian privacy standards (PIPEDA & Quebec Law 25)',
                ],
                'deliverables' => 'Filed sales tax receipts, audit representation correspondence logs, objection filings, and annual compliance status certificates.',
                'who_for' => 'Businesses with high transaction volumes, multi-provincial sales, overdue filings, or active CRA/RQ audit inquiries.',
            ],
            [
                'id' => 'business-registration',
                'name' => 'Business Registration',
                'tag' => 'Incorporation & Structuring',
                'icon' => '🏢',
                'color' => '#0284C7',
                'badge_bg' => '#f0f9ff',
                'badge_border' => '#bae6fd',
                'short_desc' => 'Federal and provincial incorporation, Quebec NEQ registration, Business Number (BN) setup, GST/HST/QST registration, and Minute Books.',
                'highlights' => [
                    'Federal (Corporations Canada) & Provincial corporate registration',
                    'Nuans name search and legal name reservation approvals',
                    'Quebec Enterprise Number (NEQ) and Enterprise Registry filings',
                    'CRA Business Number (BN) and sales tax / payroll program account activations',
                ],
                'full_description' => 'Launch your new venture on solid legal and financial ground. We manage the entire Canadian corporate formation process from name searches and share class structuring to CRA business number allocation and corporate minute book organization.',
                'whats_included' => [
                    'Federal incorporation with Corporations Canada or provincial incorporation (QC, ON, BC, AB)',
                    'Nuans comprehensive corporate name search report and clearance',
                    'Quebec Enterprise Number (NEQ) registration with the Registraire des entreprises',
                    'Canada Revenue Agency Business Number (BN) setup and authorization',
                    'Activation of CRA/RQ program accounts: Corporate Tax (RC), GST/HST (RT), Payroll (RP), QST (TQ)',
                    'Corporate share structure design (common, voting, non-voting, preferred classes)',
                    'Preparation of initial corporate bylaws, director registries, and shareholder ledgers',
                    'Digital Corporate Minute Book creation and organizational resolutions',
                ],
                'deliverables' => 'Certificate of Incorporation, Articles of Incorporation, NEQ registration document, CRA Business Number confirmation, and Minute Book binder.',
                'who_for' => 'New business founders, sole proprietors incorporating, freelancers, and foreign corporations establishing a Canadian branch.',
            ],
        ];
    @endphp

    {{-- Main Container with Alpine.js Modal State --}}
    <div x-data="{
        activeService: null,
        openModal(service) {
            this.activeService = service;
            document.body.style.overflow = 'hidden';
        },
        closeModal() {
            this.activeService = null;
            document.body.style.overflow = 'auto';
        }
    }"
    @keydown.escape.window="closeModal()"
    class="relative">

        {{-- ============================================================
             HEADER BANNER (Deep Blue to Blue Gradient)
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
                <h1 class="font-heading font-extrabold text-3xl sm:text-4xl md:text-5xl tracking-tight leading-tight m-0" style="color: #ffffff !important;">
                    Professional Accounting &amp; Tax Services
                </h1>
                <p class="max-w-2xl mx-auto text-sm sm:text-base md:text-lg text-blue-100/90 leading-relaxed font-normal">
                    Comprehensive, certified financial solutions tailored for individuals, entrepreneurs, and corporations across Canada.
                </p>
            </div>
        </section>

        {{-- ============================================================
             SERVICES GRID (6 Core Services with Read More action)
             ============================================================ --}}
        <section class="py-16 sm:py-20 md:py-24 bg-slate-50 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

                <div class="text-center max-w-3xl mx-auto mb-14 sm:mb-16">
                    <span style="font-size: 11px; font-weight: 800; color: #0052ff; text-transform: uppercase; letter-spacing: 0.08em; background: #eff6ff; padding: 5px 16px; border-radius: 999px; border: 1px solid #bfdbfe; display: inline-block;">
                        Core Practice Areas
                    </span>
                    <h2 class="font-heading font-extrabold text-2xl sm:text-3xl md:text-4xl text-slate-900 mt-3 mb-4">
                        Tailored Financial Solutions for Your Success
                    </h2>
                    <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                        Explore our 6 specialized practice areas below. Click <strong>Read More</strong> on any service to view full scopes, deliverables, and included compliance features.
                    </p>
                </div>

                {{-- 6 Service Cards Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($footerServices as $service)
                    <div id="{{ $service['id'] }}"
                         class="bg-white rounded-3xl p-7 sm:p-8 border border-slate-200/90 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between group hover:-translate-y-1.5"
                         style="border-top: 4px solid {{ $service['color'] }};">
                        
                        <div>
                            {{-- Top Icon + Badge Row --}}
                            <div class="flex items-center justify-between gap-3 mb-5">
                                <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-2xl shadow-sm border border-slate-100 group-hover:scale-110 transition-transform"
                                     style="background: {{ $service['badge_bg'] }}; border-color: {{ $service['badge_border'] }};">
                                    {{ $service['icon'] }}
                                </div>
                                <span class="text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider"
                                      style="background: {{ $service['badge_bg'] }}; color: {{ $service['color'] }}; border: 1px solid {{ $service['badge_border'] }};">
                                    {{ $service['tag'] }}
                                </span>
                            </div>

                            {{-- Service Title --}}
                            <h3 class="font-heading font-bold text-xl text-slate-900 mb-3 group-hover:text-blue-600 transition-colors">
                                {{ $service['name'] }}
                            </h3>

                            {{-- Short Description --}}
                            <p class="text-slate-600 text-sm leading-relaxed mb-6">
                                {{ $service['short_desc'] }}
                            </p>

                            {{-- Key Highlights Checklist --}}
                            <div class="space-y-2.5 mb-6 pt-4 border-t border-slate-100">
                                @foreach($service['highlights'] as $highlight)
                                <div class="flex items-start gap-2 text-xs sm:text-sm text-slate-700">
                                    <svg class="w-4 h-4 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span>{{ $highlight }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Action Button: Read More (Opens Full In-Depth Modal) --}}
                        <div class="pt-5 border-t border-slate-100 mt-2">
                            <button @click="openModal({{ json_encode($service) }})"
                                    type="button"
                                    class="w-full inline-flex items-center justify-center gap-2 py-3 px-5 rounded-xl font-bold text-sm text-white transition-all shadow-md group-hover:shadow-lg transform active:scale-95 cursor-pointer"
                                    style="background: linear-gradient(135deg, #002B8A 0%, #0052FF 100%);">
                                <span>Read More About This Service</span>
                                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </button>
                        </div>

                    </div>
                    @endforeach
                </div>

            </div>
        </section>

        {{-- ============================================================
             INTERACTIVE SERVICE DETAILS MODAL (Read More Popup)
             ============================================================ --}}
        <div x-show="activeService !== null"
             x-cloak
             class="fixed inset-0 z-50 overflow-y-auto"
             style="display: none;">
            
            {{-- Dark Blur Backdrop --}}
            <div x-show="activeService !== null"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="closeModal()"
                 class="fixed inset-0 bg-slate-950/70 backdrop-blur-sm"></div>

            {{-- Modal Content Box --}}
            <div class="min-h-screen px-4 py-8 sm:py-12 flex items-center justify-center">
                <div x-show="activeService !== null"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:scale-95"
                     @click.away="closeModal()"
                     class="relative w-full max-w-3xl bg-white rounded-3xl shadow-2xl border border-slate-200 overflow-hidden z-10 my-auto">
                    
                    {{-- Modal Header Banner --}}
                    <div class="p-6 sm:p-8 text-white relative overflow-hidden"
                         style="background: linear-gradient(135deg, #001A57 0%, #0036A8 50%, #0052FF 100%);">
                        
                        {{-- Close Button --}}
                        <button @click="closeModal()"
                                type="button"
                                class="absolute top-5 right-5 w-10 h-10 rounded-full bg-white/15 hover:bg-white/25 border border-white/20 flex items-center justify-center text-white transition-all cursor-pointer">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>

                        <div class="flex items-center gap-3 mb-2">
                            <span class="text-3xl" x-text="activeService ? activeService.icon : ''"></span>
                            <span class="text-xs font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-white/20 border border-white/30 text-white"
                                  x-text="activeService ? activeService.tag : ''"></span>
                        </div>

                        <h2 class="font-heading font-extrabold text-2xl sm:text-3xl text-white m-0 tracking-tight"
                            x-text="activeService ? activeService.name : ''"></h2>
                        <p class="text-blue-100 text-xs sm:text-sm mt-2 max-w-xl leading-relaxed font-normal"
                           x-text="activeService ? activeService.short_desc : ''"></p>
                    </div>

                    {{-- Modal Scrollable Body --}}
                    <div class="p-6 sm:p-8 max-h-[60vh] overflow-y-auto space-y-6 text-slate-700 text-sm leading-relaxed">
                        
                        {{-- Comprehensive Overview --}}
                        <div>
                            <h4 class="font-heading font-bold text-slate-900 text-base mb-2 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                                Comprehensive Overview
                            </h4>
                            <p class="text-slate-600 leading-relaxed text-sm sm:text-base"
                               x-text="activeService ? activeService.full_description : ''"></p>
                        </div>

                        {{-- What's Included / Detailed Scope --}}
                        <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200">
                            <h4 class="font-heading font-bold text-slate-900 text-base mb-3 flex items-center gap-2">
                                <span>📋</span> Full Scope &amp; What's Included
                            </h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                                <template x-if="activeService">
                                    <template x-for="(item, idx) in activeService.whats_included" :key="idx">
                                        <div class="flex items-start gap-2 text-xs sm:text-sm text-slate-700">
                                            <svg class="w-4 h-4 text-emerald-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            <span x-text="item"></span>
                                        </div>
                                    </template>
                                </template>
                            </div>
                        </div>

                        {{-- Deliverables & Target Audience in 2 Columns --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="p-4 rounded-2xl bg-blue-50/60 border border-blue-100">
                                <span class="font-bold text-blue-950 text-xs uppercase tracking-wider block mb-1">
                                    📦 Client Deliverables
                                </span>
                                <p class="text-xs sm:text-sm text-blue-900 m-0"
                                   x-text="activeService ? activeService.deliverables : ''"></p>
                            </div>

                            <div class="p-4 rounded-2xl bg-emerald-50/60 border border-emerald-100">
                                <span class="font-bold text-emerald-950 text-xs uppercase tracking-wider block mb-1">
                                    🎯 Ideal For
                                </span>
                                <p class="text-xs sm:text-sm text-emerald-900 m-0"
                                   x-text="activeService ? activeService.who_for : ''"></p>
                            </div>
                        </div>

                    </div>

                    {{-- Modal Footer CTA Bar --}}
                    <div class="p-5 sm:p-6 bg-slate-50 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-3">
                        <span class="text-xs text-slate-500 text-center sm:text-left">
                            📍 Certified Professional Bookkeeper (CPB Canada) • Gatineau, QC
                        </span>

                        <div class="flex items-center gap-3 w-full sm:w-auto">
                            <button @click="closeModal()"
                                    type="button"
                                    class="w-full sm:w-auto px-4 py-2.5 rounded-xl border border-slate-300 text-slate-700 font-semibold text-xs hover:bg-slate-100 transition-colors cursor-pointer">
                                Close
                            </button>
                            <a href="{{ route('contact') }}"
                               class="w-full sm:w-auto text-center px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs shadow-md transition-all">
                                Inquire About This Service
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- ============================================================
             BOTTOM BANNER (Deep Blue to Blue Gradient)
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
                    <a href="{{ route('register') }}"
                       class="bg-white/15 hover:bg-white/25 border border-white/30 text-white font-bold text-sm py-3 px-6 rounded-xl transition-all text-decoration-none">
                        Create Client Account
                    </a>
                </div>
            </div>
        </section>

    </div>
</x-public-layout>

