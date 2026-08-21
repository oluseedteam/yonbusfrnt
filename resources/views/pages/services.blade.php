<x-public-layout>
    <x-slot name="title">Services | YONBUS Tax & Accounting Services Inc.</x-slot>

    @php
        $servicesList = [
            [
                'id' => 'tax-preparation-planning',
                'name' => 'Tax Preparation & Planning Services',
                'tag' => 'Personal & Corporate Tax',
                'icon' => '🧾',
                'color' => '#0052FF',
                'badge_bg' => '#eff6ff',
                'badge_border' => '#bfdbfe',
                'description' => 'We provide comprehensive Canadian tax preparation and proactive tax planning services for individuals, families, self-employed professionals, investors, and corporations. Our approach focuses on accurate filings, identifying eligible deductions and credits, and helping clients make informed tax decisions throughout the year.',
                'features' => [
                    [
                        'title' => 'Personal Tax Returns',
                        'desc' => 'Preparation and electronic filing of Canadian T1 personal income tax returns and Quebec TP-1 returns, with a thorough review of available deductions, credits, and benefits.'
                    ],
                    [
                        'title' => 'Corporate Tax Returns',
                        'desc' => 'Preparation and filing of corporate T2 income tax returns and Quebec CO-17 return, including the preparation of supporting financial information and year-end tax adjustments.'
                    ],
                    [
                        'title' => 'Rental & Investment Tax',
                        'desc' => 'Reporting of rental property income and expenses, investment income, capital gains, and other related transactions, with careful consideration of applicable tax rules.'
                    ],
                    [
                        'title' => 'Tax Planning & Minimization',
                        'desc' => 'Year-round tax planning designed to identify legitimate opportunities to manage tax liabilities, maximize available deductions and credits, and improve overall tax efficiency.'
                    ],
                    [
                        'title' => 'Tax Compliance & Advisory',
                        'desc' => 'Professional guidance on Canadian tax obligations, tax-related transactions, filing requirements, and strategies to help individuals and businesses remain compliant while making informed financial decisions.'
                    ]
                ]
            ],
            [
                'id' => 'accounting-bookkeeping',
                'name' => 'Accounting & Bookkeeping Services',
                'tag' => 'Ledgers & Financial Clarity',
                'icon' => '🧮',
                'color' => '#0D9488',
                'badge_bg' => '#f0fdfa',
                'badge_border' => '#99f6e4',
                'description' => 'We provide accurate and efficient accounting and bookkeeping services to keep your financial records organized, up to date, and ready for informed business decisions.',
                'features' => [
                    [
                        'title' => 'Full-Cycle Bookkeeping',
                        'desc' => 'Recording transactions, maintaining ledgers, and preparing accounts for year-end reporting.'
                    ],
                    [
                        'title' => 'Accounts Receivable & Payable',
                        'desc' => 'Managing customer invoices, supplier bills, payments, collections, and outstanding balances.'
                    ],
                    [
                        'title' => 'Bank & Account Reconciliations',
                        'desc' => 'Monthly reconciliation of bank, credit card, and loan accounts to ensure accuracy.'
                    ],
                    [
                        'title' => 'Cloud Accounting',
                        'desc' => 'Bookkeeping and financial record management using platforms such as QuickBooks Online, Xero, and Sage.'
                    ],
                    [
                        'title' => 'Financial Statements & Compilation',
                        'desc' => 'Preparation of financial statements and compilation engagements.'
                    ]
                ]
            ],
            [
                'id' => 'payroll-services',
                'name' => 'Payroll Services',
                'tag' => 'Employee & Remittances',
                'icon' => '📊',
                'color' => '#6366F1',
                'badge_bg' => '#eef2ff',
                'badge_border' => '#c7d2fe',
                'description' => 'We provide reliable, end-to-end payroll services to help businesses manage employee compensation, statutory deductions, and year-end reporting accurately and efficiently.',
                'features' => [
                    [
                        'title' => 'Payroll Processing & Direct Deposit',
                        'desc' => 'Timely payroll calculations and direct deposit processing for employees across Canada.'
                    ],
                    [
                        'title' => 'Payroll Deductions & Remittances',
                        'desc' => 'Accurate calculation of required payroll deductions and employer contributions, including CPP/QPP, EI, QPIP, and applicable provincial requirements.'
                    ],
                    [
                        'title' => 'Record of Employment (ROE)',
                        'desc' => 'Preparation and electronic submission of ROEs when an employee experiences an interruption of earnings.'
                    ],
                    [
                        'title' => 'Year-End Payroll Reporting',
                        'desc' => 'Preparation and electronic filing of T4, T4A, and Relevé 1 slips and summaries.'
                    ],
                    [
                        'title' => 'Payroll Compliance Support',
                        'desc' => 'Assistance with payroll records, remittances, year-end requirements, and payroll-related inquiries.'
                    ]
                ]
            ],
            [
                'id' => 'business-consulting-advisory',
                'name' => 'Business Consulting & Advisory',
                'tag' => 'Strategy & Growth',
                'icon' => '💼',
                'color' => '#EA580C',
                'badge_bg' => '#fff7ed',
                'badge_border' => '#fed7aa',
                'description' => 'We provide practical financial and business advisory services to help entrepreneurs and business owners understand their numbers, plan for growth, and make informed financial decisions.',
                'features' => [
                    [
                        'title' => 'Financial Planning & Forecasting',
                        'desc' => 'Preparation of budgets, financial forecasts, and scenario analysis to support short- and long-term business planning.'
                    ],
                    [
                        'title' => 'Cash Flow & Profitability Analysis',
                        'desc' => 'Analysis of cash flow, revenue, expenses, margins, and financial performance to help improve business profitability and liquidity.'
                    ],
                    [
                        'title' => 'Business Performance Advisory',
                        'desc' => 'Financial analysis and KPI reporting to help business owners monitor performance and identify opportunities for growth.'
                    ],
                    [
                        'title' => 'Financing & Loan Support',
                        'desc' => 'Preparation of financial information, projections, and financing packages to support applications to Canadian banks and business lenders.'
                    ],
                    [
                        'title' => 'Business Valuation & Strategic Advisory',
                        'desc' => 'Financial analysis and business valuation support for growth planning, ownership changes, acquisitions, and other major business decisions.'
                    ]
                ]
            ],
            [
                'id' => 'compliance-services',
                'name' => 'Compliance Services',
                'tag' => 'Tax, Payroll & Corporate',
                'icon' => '⚖️',
                'color' => '#DC2626',
                'badge_bg' => '#fef2f2',
                'badge_border' => '#fecaca',
                'description' => 'We help individuals and businesses meet their ongoing tax, payroll, and corporate compliance requirements accurately and on time, helping reduce the risk of missed filings, penalties, and compliance issues.',
                'features' => [
                    [
                        'title' => 'Sales Tax Compliance',
                        'desc' => 'Preparation, reconciliation, and filing of GST/HST and QST returns.'
                    ],
                    [
                        'title' => 'Corporate Compliance Filings',
                        'desc' => 'Assistance with required corporate annual returns and other ongoing corporate filing obligations.'
                    ],
                    [
                        'title' => 'Payroll Compliance',
                        'desc' => 'Support with payroll remittances, year-end payroll reporting, and required employee information slips.'
                    ],
                    [
                        'title' => 'Tax Review & Audit Support',
                        'desc' => 'Assistance with tax reviews, audits, documentation requests, and related compliance matters.'
                    ],
                    [
                        'title' => 'Tax Objections & Appeals',
                        'desc' => 'Preparation and submission of formal objections and appeals relating to tax assessments.'
                    ],
                    [
                        'title' => 'Penalty & Interest Relief',
                        'desc' => 'Assistance with eligible applications for relief from tax penalties and interest.'
                    ]
                ]
            ],
            [
                'id' => 'business-registration',
                'name' => 'Business Registration',
                'tag' => 'Setup & Accounts',
                'icon' => '🏢',
                'color' => '#0284C7',
                'badge_bg' => '#f0f9ff',
                'badge_border' => '#bae6fd',
                'description' => 'We help entrepreneurs and business owners establish their businesses properly and set up the registrations and accounts needed to operate in Canada.',
                'features' => [
                    [
                        'title' => 'Federal & Provincial Incorporation',
                        'desc' => 'Assistance with incorporating a business federally or provincially based on your business needs.'
                    ],
                    [
                        'title' => 'Business Name Registration',
                        'desc' => 'Support with business name searches, name selection, and registration requirements.'
                    ],
                    [
                        'title' => 'Business Number (BN) Registration',
                        'desc' => 'Assistance with obtaining a Business Number and setting up applicable program accounts.'
                    ],
                    [
                        'title' => 'GST/HST & QST Registration',
                        'desc' => 'Registration for applicable sales tax accounts and guidance on sales tax requirements.'
                    ],
                    [
                        'title' => 'Payroll Account Registration',
                        'desc' => 'Setup of payroll program accounts and guidance on employer payroll obligations.'
                    ]
                ]
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
             SERVICES GRID (Boxes with Read More)
             ============================================================ --}}
        <section class="py-16 sm:py-20 md:py-24 bg-slate-50 dark:bg-slate-900 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

                <div class="text-center max-w-3xl mx-auto mb-14 sm:mb-16">
                    <span style="font-size: 11px; font-weight: 800; color: #0052ff; text-transform: uppercase; letter-spacing: 0.08em; background: #eff6ff; padding: 5px 16px; border-radius: 999px; border: 1px solid #bfdbfe; display: inline-block;">
                        Core Practice Areas
                    </span>
                    <h2 class="font-heading font-extrabold text-2xl sm:text-3xl md:text-4xl text-slate-900 dark:text-white mt-3 mb-4">
                        Tailored Financial Solutions for Your Success
                    </h2>
                    <p class="text-slate-600 dark:text-slate-300 text-sm sm:text-base leading-relaxed">
                        Explore our specialized services below. Click <strong>Read More</strong> on any box to see the complete breakdown and detailed features.
                    </p>
                </div>

                {{-- 6 Service Boxes Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($servicesList as $service)
                    <div id="{{ $service['id'] }}"
                         class="bg-white dark:bg-slate-800 rounded-3xl p-7 sm:p-8 border border-slate-200/90 dark:border-slate-700 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between group hover:-translate-y-1.5"
                         style="border-top: 4px solid {{ $service['color'] }};">
                        
                        <div>
                            {{-- Top Icon + Badge Row --}}
                            <div class="flex items-center justify-between gap-3 mb-5">
                                <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-2xl shadow-sm border border-slate-100 dark:border-slate-700 group-hover:scale-110 transition-transform"
                                     style="background: {{ $service['badge_bg'] }}; border-color: {{ $service['badge_border'] }};">
                                    {{ $service['icon'] }}
                                </div>
                                <span class="text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider"
                                      style="background: {{ $service['badge_bg'] }}; color: {{ $service['color'] }}; border: 1px solid {{ $service['badge_border'] }};">
                                    {{ $service['tag'] }}
                                </span>
                            </div>

                            {{-- Service Title --}}
                            <h3 class="font-heading font-bold text-xl text-slate-900 dark:text-white mb-3 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                {{ $service['name'] }}
                            </h3>

                            {{-- Short Description --}}
                            <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed mb-6 line-clamp-3">
                                {{ $service['description'] }}
                            </p>

                            {{-- Key Features Preview --}}
                            <div class="space-y-2.5 mb-6 pt-4 border-t border-slate-100 dark:border-slate-700">
                                @foreach(array_slice($service['features'], 0, 3) as $feat)
                                <div class="flex items-start gap-2 text-xs sm:text-sm text-slate-700 dark:text-slate-300">
                                    <svg class="w-4 h-4 text-blue-600 dark:text-blue-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span class="font-semibold">{{ $feat['title'] }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Action Button: Read More --}}
                        <div class="pt-5 border-t border-slate-100 dark:border-slate-700 mt-2">
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
                     class="relative w-full max-w-3xl bg-white dark:bg-slate-800 rounded-3xl shadow-2xl border border-slate-200 dark:border-slate-700 overflow-hidden z-10 my-auto">
                    
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
                    </div>

                    {{-- Modal Scrollable Body --}}
                    <div class="p-6 sm:p-8 max-h-[60vh] overflow-y-auto space-y-6 text-slate-700 dark:text-slate-200 text-sm sm:text-base leading-relaxed">
                        
                        {{-- Overview --}}
                        <div>
                            <h4 class="font-heading font-bold text-slate-900 dark:text-white text-base mb-2 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                                Overview
                            </h4>
                            <p class="text-slate-600 dark:text-slate-300 leading-relaxed text-sm sm:text-base"
                               x-text="activeService ? activeService.description : ''"></p>
                        </div>

                        {{-- Detailed Features / Sub-services --}}
                        <div class="bg-slate-50 dark:bg-slate-900/70 rounded-2xl p-5 sm:p-6 border border-slate-200 dark:border-slate-700 space-y-4">
                            <h4 class="font-heading font-bold text-slate-900 dark:text-white text-base mb-3 flex items-center gap-2">
                                <span>📋</span> Included Services &amp; Coverage
                            </h4>
                            
                            <div class="space-y-3.5">
                                <template x-if="activeService && activeService.features">
                                    <template x-for="(item, idx) in activeService.features" :key="idx">
                                        <div class="p-3.5 rounded-xl bg-white dark:bg-slate-800 border border-slate-200/80 dark:border-slate-700 flex items-start gap-3">
                                            <div class="w-6 h-6 rounded-full bg-blue-100 dark:bg-blue-900/40 text-[#0052ff] dark:text-blue-400 flex items-center justify-center flex-shrink-0 text-xs font-bold mt-0.5">
                                                •
                                            </div>
                                            <div>
                                                <div class="font-bold text-slate-900 dark:text-white text-sm" x-text="item.title"></div>
                                                <div class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 mt-1 leading-relaxed" x-text="item.desc"></div>
                                            </div>
                                        </div>
                                    </template>
                                </template>
                            </div>
                        </div>

                    </div>

                    {{-- Modal Footer CTA Bar --}}
                    <div class="p-5 sm:p-6 bg-slate-50 dark:bg-slate-900 border-t border-slate-200 dark:border-slate-700 flex flex-col sm:flex-row items-center justify-between gap-3">
                        <span class="text-xs text-slate-500 dark:text-slate-400 text-center sm:text-left">
                            📍 Certified Professional Bookkeeper (CPB Canada) • Serving Canada Nationwide
                        </span>

                        <div class="flex items-center gap-3 w-full sm:w-auto">
                            <button @click="closeModal()"
                                    type="button"
                                    class="w-full sm:w-auto px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-200 font-semibold text-xs hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors cursor-pointer">
                                Close
                            </button>
                            <a href="{{ route('book-appointment') }}"
                               class="w-full sm:w-auto text-center px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs shadow-md transition-all">
                                Book Consultation
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

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
