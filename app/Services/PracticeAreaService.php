<?php

namespace App\Services;

class PracticeAreaService
{
    /**
     * Get all 6 core practice areas.
     */
    public function getAll(): array
    {
        return [
            [
                'id' => 'tax-preparation-planning',
                'name' => 'Tax Preparation & Planning Services',
                'short_name' => 'Tax Preparation & Planning',
                'icon' => '🧾',
                'tagline' => 'Strategic Canadian tax compliance, deduction maximization, and proactive planning for individuals and corporations.',
                'description' => 'We provide comprehensive Canadian tax preparation and proactive tax planning services for individuals, families, self-employed professionals, investors, and corporations. Our approach focuses on accurate filings, identifying eligible deductions and credits, and helping clients make informed tax decisions throughout the year.',
                'extended_description' => 'Navigating federal (CRA) and provincial (including Revenu Québec) tax requirements demands precision, current statutory expertise, and strategic foresight. At YONBUS, our certified accounting professionals evaluate every angle of your financial landscape—from maximizing tuition, medical, and childcare deductions on personal T1/TP-1 returns to optimizing corporate tax rates, capital cost allowances (CCA), and tax-efficient owner remuneration strategies for corporate T2/CO-17 filings.',
                'features' => [
                    [
                        'title' => 'Personal Tax Returns (T1 / TP-1)',
                        'desc' => 'Preparation and electronic filing (EFILE/NetFile) of Canadian T1 personal income tax returns and Quebec TP-1 returns, with a thorough review of deductions, credits, foreign income, and eligible family benefits.',
                        'highlights' => ['Employment & self-employment expenses', 'Tuition, moving & medical deductions', 'Foreign property reporting (Form T1135)', 'Electronic CRA and Revenu Québec submission']
                    ],
                    [
                        'title' => 'Corporate Tax Returns (T2 / CO-17)',
                        'desc' => 'Preparation and filing of Canadian corporate T2 income tax returns and Quebec CO-17 returns, including supporting financial statement compilation (GIFI), capital asset schedules, and year-end tax adjustments.',
                        'highlights' => ['Small Business Deduction (SBD) optimization', 'Capital Cost Allowance (CCA) schedules', 'Active business vs. passive investment income', 'Multi-provincial allocation filings']
                    ],
                    [
                        'title' => 'Rental & Investment Property Tax',
                        'desc' => 'Detailed reporting of rental property revenues and expenses, foreign investment income, capital gains and losses on securities and crypto, and optimal capital cost allowance considerations on real estate.',
                        'highlights' => ['Rental property schedules (Form T776)', 'Principal residence exemption claims', 'Cryptocurrency and stock portfolio calculations', 'Non-resident withholding & Section 216 filings']
                    ],
                    [
                        'title' => 'Year-Round Tax Planning & Minimization',
                        'desc' => 'Proactive tax planning designed to identify legitimate tax shelters, manage marginal tax rates, utilize RRSP/TFSA/FHSA contributions effectively, and improve multi-year tax efficiency.',
                        'highlights' => ['Salary vs. Dividend optimization for owners', 'Income splitting & TOSI compliance analysis', 'Holding company & corporate structure review', 'Estate freeze and succession tax planning']
                    ],
                    [
                        'title' => 'Tax Compliance & Advisory',
                        'desc' => 'Professional guidance on Canadian tax obligations, complex cross-border transactions, sales tax integration, and strategic advice to ensure full compliance while minimizing tax liabilities.',
                        'highlights' => ['CRA & RQ correspondence assistance', 'Voluntary disclosures & adjustments', 'GST/HST & QST integration advisory', 'Proactive risk audits']
                    ]
                ],
                'target_audience' => [
                    'Individuals & Families with complex tax scenarios',
                    'Sole proprietors, freelancers & independent contractors',
                    'Incorporated professionals & small-to-medium business owners',
                    'Real estate investors, landlords & property managers',
                    'High-net-worth investors with multi-asset portfolios'
                ],
                'why_choose_points' => [
                    ['title' => 'CPB Certified Precision', 'desc' => 'Filings prepared in accordance with the latest CRA & Revenu Québec tax legislation.'],
                    ['title' => 'Proactive Deduction Hunting', 'desc' => 'We scrutinize every allowable expense and tax credit to legally minimize what you owe.'],
                    ['title' => 'Fast Electronic EFILE', 'desc' => 'Direct CRA and Revenu Québec secure electronic transmission for expedited refunds.'],
                    ['title' => 'Year-Round Availability', 'desc' => 'We support you 365 days a year—not just during the April tax rush.']
                ],
                'faqs' => [
                    [
                        'question' => 'What documents do I need to prepare my personal tax return?',
                        'answer' => 'Typically, you will need all relevant tax slips (T4, T5, T3, T5007, etc. or Relevé slips in Quebec), receipts for deductible expenses (medical, tuition, childcare, charitable donations, home office), notices of assessment from previous years, and records of any property or investment sales.'
                    ],
                    [
                        'question' => 'What is the deadline for filing corporate T2 tax returns in Canada?',
                        'answer' => 'Corporate income tax returns (T2) must be filed within six (6) months of the end of the corporation’s fiscal year. However, any taxes owing are generally due within two (2) or three (3) months after the fiscal year-end depending on whether the company qualifies for the Canadian-Controlled Private Corporation (CCPC) rules.'
                    ],
                    [
                        'question' => 'Do you file provincial taxes for Quebec (TP-1 and CO-17)?',
                        'answer' => 'Yes! YONBUS is based in Gatineau, Quebec, and we specialize in dual-jurisdiction federal (CRA) and provincial (Revenu Québec) filings for both individuals and businesses.'
                    ]
                ]
            ],
            [
                'id' => 'accounting-bookkeeping',
                'name' => 'Accounting & Bookkeeping Services',
                'short_name' => 'Accounting & Bookkeeping',
                'icon' => '🧮',
                'tagline' => 'Accurate, real-time financial tracking and modern cloud bookkeeping to keep your business organized, compliant, and growth-ready.',
                'description' => 'We provide accurate and efficient accounting and bookkeeping services to keep your financial records organized, up to date, and ready for informed business decisions.',
                'extended_description' => 'Clean, organized books are the foundation of any resilient Canadian business. YONBUS leverages modern cloud accounting ecosystems including QuickBooks Online, Xero, and Sage to streamline transaction capture, automate bank reconciliations, maintain accurate general ledgers, and provide business owners with crystal-clear visibility into cash flow and profitability.',
                'features' => [
                    [
                        'title' => 'Full-Cycle Bookkeeping',
                        'desc' => 'Recording day-to-day transactions, maintaining accurate general ledgers, categorizing expenses, and preparing clean books for month-end and year-end review.',
                        'highlights' => ['General ledger maintenance', 'Expense classification & tagging', 'Journal entries & adjustments', 'Trial balance reconciliation']
                    ],
                    [
                        'title' => 'Accounts Receivable (AR) & Payable (AP)',
                        'desc' => 'Managing customer invoices, monitoring aging receivables, processing supplier bills, and scheduling disbursements to protect working capital.',
                        'highlights' => ['Timely customer billing & statements', 'Vendor bill tracking & payment approvals', 'Overdue balance monitoring', 'Vendor payment history & 1099/T5018 reporting']
                    ],
                    [
                        'title' => 'Bank & Credit Card Reconciliations',
                        'desc' => 'Monthly reconciliation of operating bank accounts, corporate credit cards, merchant processing gateways (Stripe, Square, PayPal), and lines of credit.',
                        'highlights' => ['Multi-account reconciliation', 'Merchant fee reconciliation (Stripe/Shopify)', 'Inter-account transfer verification', 'Error & discrepancy detection']
                    ],
                    [
                        'title' => 'Cloud Accounting Setup & Management',
                        'desc' => 'Implementation, configuration, and ongoing management of industry-leading cloud accounting software with paperless receipt storage and live feeds.',
                        'highlights' => ['QuickBooks Online (QBO) & Xero setup', 'Custom chart of accounts tailored to your sector', 'Integration with POS and e-commerce stores', 'Document management & digital receipts']
                    ],
                    [
                        'title' => 'Financial Statements & Compilations',
                        'desc' => 'Preparation of comprehensive monthly, quarterly, and annual financial statements to support bank loan compliance, investor reporting, and tax filing.',
                        'highlights' => ['Balance Sheet & Income Statement', 'Cash Flow Analysis reports', 'Notice to Reader (Compilation engagements)', 'Year-end working papers for tax preparers']
                    ]
                ],
                'target_audience' => [
                    'Small & Medium-Sized Businesses (SMBs) seeking hassle-free bookkeeping',
                    'E-commerce & retail businesses with high transaction volume',
                    'Medical, dental, legal, and engineering professional practices',
                    'Construction contractors and trades requiring job costing',
                    'Early-stage startups needing audit-ready financial records'
                ],
                'why_choose_points' => [
                    ['title' => 'Certified Professional Bookkeepers', 'desc' => 'CPB Canada members ensuring strict standards of accuracy and confidentiality.'],
                    ['title' => '100% Cloud-First & Paperless', 'desc' => 'Real-time financial access from anywhere via QBO, Xero, and Sage.'],
                    ['title' => 'Audit-Ready Books', 'desc' => 'Every transaction backed by solid documentation to keep CRA compliance effortless.'],
                    ['title' => 'Tailored Monthly Packages', 'desc' => 'Flexible retainers scaled to your transaction volume with predictable pricing.']
                ],
                'faqs' => [
                    [
                        'question' => 'How often do you update and reconcile my bookkeeping records?',
                        'answer' => 'Depending on your business volume and requirements, we offer weekly, bi-weekly, monthly, or quarterly bookkeeping and reconciliation schedules.'
                    ],
                    [
                        'question' => 'Can you help clean up messy or backlogged books from previous years?',
                        'answer' => 'Yes! We frequently handle backlog catch-up and historical cleanup projects to bring outdated records up to date and audit-ready.'
                    ],
                    [
                        'question' => 'Which accounting software do you support?',
                        'answer' => 'We work primarily with QuickBooks Online, Xero, and Sage, but we can also integrate with various inventory, payroll, and point-of-sale platforms.'
                    ]
                ]
            ],
            [
                'id' => 'payroll-services',
                'name' => 'Payroll Services',
                'short_name' => 'Payroll Services',
                'icon' => '📊',
                'tagline' => 'Flawless, automated payroll processing, statutory remittances, and year-end reporting for businesses across Canada.',
                'description' => 'We provide reliable, end-to-end payroll services to help businesses manage employee compensation, statutory deductions, and year-end reporting accurately and efficiently.',
                'extended_description' => 'Canadian payroll is heavily regulated with stringent timelines and varying federal and provincial statutory requirements. YONBUS removes the risk of costly calculation errors and late remittance penalties by handling your complete payroll cycle—from direct deposit disbursements to CRA and Revenu Québec remittances, Records of Employment (ROEs), and year-end T4 and Relevé 1 distribution.',
                'features' => [
                    [
                        'title' => 'Payroll Processing & Direct Deposit',
                        'desc' => 'Timely, automated payroll calculations for salaried and hourly workers, overtime computations, holiday pay calculations, and direct deposit into employee accounts.',
                        'highlights' => ['Weekly, bi-weekly, semi-monthly, or monthly schedules', 'Direct deposit to all Canadian financial institutions', 'Detailed digital paystubs for employees', 'Overtime, bonuses, and commission management']
                    ],
                    [
                        'title' => 'Statutory Deductions & Remittances',
                        'desc' => 'Precise calculation of employer and employee contributions for Canada Pension Plan (CPP/QPP), Employment Insurance (EI), QPIP (Quebec), and provincial taxes.',
                        'highlights' => ['CRA payroll remittance submission', 'Revenu Québec source deduction remittances', 'CNESST & WSIB/Workers Compensation reporting', 'Strict adherence to provincial remittance deadlines']
                    ],
                    [
                        'title' => 'Record of Employment (ROE) Filings',
                        'desc' => 'Immediate electronic preparation and direct submission of Records of Employment (ROEs) to Service Canada whenever an employee experiences an earnings interruption.',
                        'highlights' => ['Electronic Service Canada ROE Web filing', 'Insurable hours & earnings reconciliation', 'Layoff, medical leave, and termination compliance', 'Elimination of paper filing delays']
                    ],
                    [
                        'title' => 'Year-End Payroll Reporting (T4 & Relevé 1)',
                        'desc' => 'Complete year-end payroll reconciliation, generating and submitting T4 and T4A slips and summaries to CRA, as well as Relevé 1 slips to Revenu Québec.',
                        'highlights' => ['Annual PIER report balancing & reconciliation', 'Electronic submission of T4/T4A and RL-1 files', 'Secure digital distribution of slips to staff', 'Worker T5018 subcontractor filing if applicable']
                    ],
                    [
                        'title' => 'Payroll Compliance & Advisory',
                        'desc' => 'Expert guidance on taxable benefits, vacation pay accruals, severance packages, employment standards legislation, and employer health tax (EHT) thresholds.',
                        'highlights' => ['Taxable benefit calculations (auto, health, allowances)', 'Employer Health Tax (EHT / HSF) calculations', 'Vacation pay & statutory holiday compliance', 'Assistance during CRA/RQ payroll audits']
                    ]
                ],
                'target_audience' => [
                    'Growing businesses with 1 to 100+ full-time or part-time staff',
                    'Businesses with hourly, shift-based, or commission-based workers',
                    'Companies with multi-provincial employees (e.g. Ontario & Quebec)',
                    'Corporations seeking to transition owner-operators from dividends to salary',
                    'Employers seeking to eliminate payroll calculation stress and penalty risks'
                ],
                'why_choose_points' => [
                    ['title' => 'Zero-Penalty Guarantee', 'desc' => 'All source remittances calculated and submitted accurately before statutory due dates.'],
                    ['title' => 'Direct Deposit & Employee Portal', 'desc' => 'Employees receive automatic direct deposits and 24/7 access to digital pay stubs.'],
                    ['title' => 'Dual CRA & RQ Mastery', 'desc' => 'Flawless handling of Quebec-specific deductions (QPP, QPIP, CNESST) and CRA rules.'],
                    ['title' => 'Seamless Accounting Sync', 'desc' => 'Payroll journal entries automatically synced into your general ledger.']
                ],
                'faqs' => [
                    [
                        'question' => 'When do I have to remit payroll deductions to CRA and Revenu Québec?',
                        'answer' => 'For regular remitters, remittances must be received by the 15th day of the month following the month you paid your employees. Accelerated remitters may have multiple deadlines per month. We ensure all your remittances are scheduled on time.'
                    ],
                    [
                        'question' => 'How are Records of Employment (ROEs) issued to staff?',
                        'answer' => 'We prepare and transmit ROEs electronically directly to Service Canada via ROE Web. Once submitted, employees can access their ROE online through their My Service Canada Account immediately.'
                    ],
                    [
                        'question' => 'Can you handle both salaried managers and hourly wage earners with variable hours?',
                        'answer' => 'Yes, our payroll systems seamlessly support hourly tracking with variable overtime, commissions, reimbursements, and fixed salaried compensation.'
                    ]
                ]
            ],
            [
                'id' => 'business-consulting-advisory',
                'name' => 'Business Consulting & Advisory',
                'short_name' => 'Consulting & Advisory',
                'icon' => '💼',
                'tagline' => 'Actionable financial intelligence, cash flow forecasting, and strategic advisory to help Canadian entrepreneurs scale profitably.',
                'description' => 'We provide practical financial and business advisory services to help entrepreneurs and business owners understand their numbers, plan for growth, and make informed financial decisions.',
                'extended_description' => 'Great business decisions start with a deep understanding of financial metrics. YONBUS acts as your strategic financial partner and fractional CFO, translating complex accounting data into clear roadmaps for revenue expansion, margin enhancement, cost containment, and successful bank or BDC capital financing.',
                'features' => [
                    [
                        'title' => 'Financial Planning & Forecasting',
                        'desc' => 'Developing comprehensive annual operating budgets, multi-year revenue projections, sensitivity scenarios, and break-even financial models.',
                        'highlights' => ['Pro-forma financial statements', 'Operating & capital budget formulation', 'Scenario & sensitivity modeling', 'Break-even & margin threshold analysis']
                    ],
                    [
                        'title' => 'Cash Flow & Profitability Optimization',
                        'desc' => 'Analyzing working capital cycles, burn rates, customer gross margins, and cost drivers to ensure your business maintains strong liquidity.',
                        'highlights' => ['13-week rolling cash flow forecasts', 'Product & service line gross margin review', 'Working capital & inventory management', 'Cost reduction and vendor renegotiation insights']
                    ],
                    [
                        'title' => 'Business Performance & KPI Advisory',
                        'desc' => 'Designing executive reporting dashboards tracking essential financial KPIs, customer acquisition costs, and unit economics to drive informed decision-making.',
                        'highlights' => ['Custom monthly management KPI packages', 'Customer lifetime value vs. acquisition cost', 'Productivity & labor cost metrics', 'Quarterly strategic performance reviews']
                    ],
                    [
                        'title' => 'Financing & Loan Application Support',
                        'desc' => 'Preparing financial documentation packages, business plans, cash flow projections, and debt service coverage models for Canadian banks and BDC.',
                        'highlights' => ['BDC and chartered bank loan packages', 'CSBFP (Canada Small Business Financing) support', 'Government grant & funding applications', 'Debt restructuring & refinancing advisory']
                    ],
                    [
                        'title' => 'Business Valuation & Strategic Advisory',
                        'desc' => 'Assessing business value, structuring partner buyouts, advising on mergers, acquisitions, and preparing long-term exit and succession strategies.',
                        'highlights' => ['Informal valuation & multiple analysis', 'Partner shareholder agreement advisory', 'Mergers & acquisitions due diligence', 'Succession planning & transition roadmaps']
                    ]
                ],
                'target_audience' => [
                    'Established business owners planning expansion or capital investment',
                    'Early-stage founders seeking bank loans, lines of credit, or BDC financing',
                    'Entrepreneurs needing fractional CFO guidance without high executive overhead',
                    'Companies experiencing rapid growth or facing cash flow constraints',
                    'Owners preparing for ownership transition, sale, or succession'
                ],
                'why_choose_points' => [
                    ['title' => 'Data-Driven Insights', 'desc' => 'We don’t just report historical figures; we provide forward-looking clarity.'],
                    ['title' => 'Lender-Ready Financials', 'desc' => 'Financial packages built to satisfy the underwriting criteria of Canadian financial institutions.'],
                    ['title' => 'Practical & Actionable', 'desc' => 'Real-world strategies tailored to your industry, team size, and goals.'],
                    ['title' => 'Fractional CFO Expertise', 'desc' => 'Senior-level financial leadership at a fraction of full-time executive cost.']
                ],
                'faqs' => [
                    [
                        'question' => 'How can financial forecasting help my small business?',
                        'answer' => 'Forecasting enables you to anticipate cash crunches months in advance, schedule hiring and capital expenditures responsibly, and make strategic pricing decisions backed by data rather than guesswork.'
                    ],
                    [
                        'question' => 'What is involved in preparing a loan package for the BDC or Canadian chartered banks?',
                        'answer' => 'Lenders require multi-year historical financial statements, realistic 3-year cash flow projections, a detailed business narrative, and proof of debt service ability. We prepare the complete, lender-ready package.'
                    ],
                    [
                        'question' => 'Do you provide one-off advisory sessions or ongoing fractional CFO support?',
                        'answer' => 'We offer both targeted project-based advisory (e.g. loan packaging, valuation) as well as ongoing monthly fractional advisory packages.'
                    ]
                ]
            ],
            [
                'id' => 'compliance-services',
                'name' => 'Compliance Services',
                'short_name' => 'Compliance Services',
                'icon' => '⚖️',
                'tagline' => 'Comprehensive tax compliance, sales tax reconciliation (GST/HST/QST), and dedicated CRA/Revenu Québec audit representation.',
                'description' => 'We help individuals and businesses meet their ongoing tax, payroll, and corporate compliance requirements accurately and on time, helping reduce the risk of missed filings, penalties, and compliance issues.',
                'extended_description' => 'Staying compliant across multi-tiered Canadian regulatory frameworks can be daunting. Missing statutory deadlines or making inaccurate declarations can trigger heavy penalties and interest. YONBUS provides rigorous compliance oversight and strong representation during CRA and Revenu Québec desk reviews, audits, and objection proceedings.',
                'features' => [
                    [
                        'title' => 'Sales Tax Compliance (GST / HST & QST)',
                        'desc' => 'Reconciliation of input tax credits (ITCs) and input tax refunds (ITRs), calculating net tax liabilities, and electronic filing of GST/HST and QST returns.',
                        'highlights' => ['Monthly, quarterly, or annual filing cycles', 'ITC and ITR calculation & documentation audit', 'Place of supply rules for cross-provincial sales', 'Non-resident GST/HST simplified registry filing']
                    ],
                    [
                        'title' => 'Corporate Annual Compliance Filings',
                        'desc' => 'Preparation and electronic submission of federal Corporations Canada annual returns, provincial corporate registry updates, and corporate register maintenance.',
                        'highlights' => ['Federal Corporations Canada annual return filing', 'Provincial annual return declarations', 'Director, officer, and registered office updates', 'Beneficial ownership (ISBO) registry compliance']
                    ],
                    [
                        'title' => 'CRA & Revenu Québec Audit Defense & Support',
                        'desc' => 'Full representation and document preparation for CRA and Revenu Québec requests for information, pre-assessment reviews, and formal comprehensive audits.',
                        'highlights' => ['Direct communication with tax auditors', 'Organizing ledger and expense documentation', 'Drafting formal audit responses and submissions', 'Protection of taxpayer rights under the Taxpayer Bill of Rights']
                    ],
                    [
                        'title' => 'Tax Objections & Formal Appeals',
                        'desc' => 'Drafting and submitting formal Notices of Objection to the CRA Appeals Branch and Revenu Québec to contest unfair or incorrect tax reassessments.',
                        'highlights' => ['Notice of Objection filing within statutory deadlines', 'Legal & factual argument structuring', 'Negotiation with appeals officers', 'Penalty and interest dispute management']
                    ],
                    [
                        'title' => 'Taxpayer Penalty & Interest Relief',
                        'desc' => 'Assistance with eligible applications under the CRA Taxpayer Relief Provisions (Form RC4288) and Quebec equivalent due to extraordinary circumstances or financial hardship.',
                        'highlights' => ['Eligibility review & evidence gathering', 'Formulation of formal relief requests', 'Relief from late-filing and remittance penalties', 'Relief from compounding arrears interest']
                    ]
                ],
                'target_audience' => [
                    'Businesses with GST/HST and QST sales tax reporting obligations',
                    'Incorporated entities required to maintain corporate registry compliance',
                    'Individuals and corporations selected for CRA or Revenu Québec audits',
                    'Taxpayers who have received disputed notices of reassessment',
                    'Companies seeking to regularize overdue filings without punitive penalties'
                ],
                'why_choose_points' => [
                    ['title' => 'Direct Tax Authority Representation', 'desc' => 'We deal directly with CRA and Revenu Québec auditors on your behalf.'],
                    ['title' => 'Strict Deadline Tracking', 'desc' => 'Automated compliance calendar ensures no statutory deadline is ever missed.'],
                    ['title' => 'Substantial Penalty Reductions', 'desc' => 'Proven track record in submitting successful taxpayer relief applications.'],
                    ['title' => 'Comprehensive Peace of Mind', 'desc' => 'Rest easy knowing your business is fully aligned with Canadian tax legislation.']
                ],
                'faqs' => [
                    [
                        'question' => 'What should I do if I receive an audit or review letter from the CRA or Revenu Québec?',
                        'answer' => 'Do not ignore it. Contact us immediately. We will review the auditor’s request, gather and organize the required supporting documentation, and communicate with the tax authorities on your behalf.'
                    ],
                    [
                        'question' => 'What is the time limit for filing a Notice of Objection in Canada?',
                        'answer' => 'For individuals, an objection must be filed within 90 days of the date of the notice of reassessment or one year after the filing due date for the return (whichever is later). For corporations, it is strictly 90 days from the notice date.'
                    ],
                    [
                        'question' => 'Can the CRA waive penalties and interest that have accumulated?',
                        'answer' => 'Yes, under the CRA Taxpayer Relief Provisions, penalties and interest may be cancelled if they resulted from extraordinary circumstances (illness, natural disaster), CRA administrative errors, or severe financial hardship.'
                    ]
                ]
            ],
            [
                'id' => 'business-registration',
                'name' => 'Business Registration',
                'short_name' => 'Business Registration',
                'icon' => '🏢',
                'tagline' => 'Fast, turnkey federal and provincial incorporation, Business Number setup, and corporate account registrations in Canada.',
                'description' => 'We help entrepreneurs and business owners establish their businesses properly and set up the registrations and accounts needed to operate in Canada.',
                'extended_description' => 'Launching a new company in Canada is a pivotal milestone. Choosing the correct structure—Sole Proprietorship, Partnership, or Federal/Provincial Corporation—impacts your legal liability, tax burden, and future funding capability. YONBUS provides end-to-end incorporation, NUANS name searches, and immediate opening of all necessary CRA tax program accounts.',
                'features' => [
                    [
                        'title' => 'Federal & Provincial Incorporation',
                        'desc' => 'Turnkey incorporation under the Canada Business Corporations Act (CBCA) or provincial acts (Ontario, Quebec, etc.), including customized articles of incorporation and bylaws.',
                        'highlights' => ['Articles of Incorporation preparation', 'Federal vs. Provincial jurisdiction analysis', 'Custom share structure & voting classes', 'Issuance of Certificate of Incorporation']
                    ],
                    [
                        'title' => 'Business Name Search & NUANS Report',
                        'desc' => 'Conducting comprehensive corporate name availability searches, obtaining official NUANS pre-clearance reports, and registering trade and master business names.',
                        'highlights' => ['Federal and provincial NUANS search', 'Trademark conflict pre-screening', 'Master Business Licence registration', 'Operating name (DBA) registration']
                    ],
                    [
                        'title' => 'Business Number (BN) & Corporate Tax (RC)',
                        'desc' => 'Immediate acquisition of your 9-digit CRA Business Number and setup of the corporate income tax (RC) program account.',
                        'highlights' => ['CRA 9-digit Business Number setup', 'Corporate Income Tax (RC) account activation', 'Revenu Québec NEQ and corporate registration', 'Direct representation setup with CRA/RQ']
                    ],
                    [
                        'title' => 'GST/HST & QST Account Registration',
                        'desc' => 'Opening mandatory or voluntary sales tax program accounts with CRA (RT) and Revenu Québec (TQ), along with guidance on remittance cycles.',
                        'highlights' => ['Federal GST/HST (RT) account setup', 'Quebec QST (TQ) account setup', 'Threshold analysis & voluntary registration guidance', 'Filing frequency selection (annual, quarterly, monthly)']
                    ],
                    [
                        'title' => 'Payroll (RP) & Import/Export (RM) Accounts',
                        'desc' => 'Setting up employer payroll program accounts (RP) to hire staff, and custom Import/Export (RM) accounts for international trade.',
                        'highlights' => ['Employer Payroll (RP) program activation', 'CNESST and provincial workers comp accounts', 'Import/Export (RM) customs program setup', 'Initial corporate setup consultation']
                    ]
                ],
                'target_audience' => [
                    'New entrepreneurs starting a company in Canada',
                    'Sole proprietors looking to incorporate for liability protection and tax advantages',
                    'Foreign corporations launching a Canadian subsidiary or branch',
                    'Freelancers, consultants, and tech workers forming personal service corporations',
                    'Partners establishing structured joint corporate ventures'
                ],
                'why_choose_points' => [
                    ['title' => 'Fast 24-to-48 Hour Turnaround', 'desc' => 'Expedited electronic filing to get your business incorporated and operational quickly.'],
                    ['title' => 'Optimal Share Structuring', 'desc' => 'Multi-class share structures created to enable future tax planning and dividends.'],
                    ['title' => 'All-in-One Registration', 'desc' => 'Articles, BN, GST/HST, QST, and Payroll accounts handled in one seamless package.'],
                    ['title' => 'Ongoing Financial Partnership', 'desc' => 'Seamless transition to bookkeeping, payroll, and corporate tax management.']
                ],
                'faqs' => [
                    [
                        'question' => 'Should I incorporate federally or provincially in Canada?',
                        'answer' => 'Federal incorporation provides nationwide name protection and higher prestige, but requires annual returns and extra provincial registrations. Provincial incorporation is ideal if you operate strictly in one province (e.g. Ontario or Quebec). We analyze your business model to recommend the best option.'
                    ],
                    [
                        'question' => 'When is a business required to register for GST/HST and QST?',
                        'answer' => 'Registration is mandatory once your worldwide taxable gross revenues exceed $30,000 in a single calendar quarter or over four consecutive quarters. Voluntary registration before reaching $30,000 allows you to claim input tax credits on startup expenses.'
                    ],
                    [
                        'question' => 'What documents will I receive after incorporation?',
                        'answer' => 'You will receive your official Certificate and Articles of Incorporation, CRA Business Number (BN), Corporate Tax (RC) account details, and any requested sales tax (GST/HST/QST) and payroll account registrations.'
                    ]
                ]
            ],
        ];
    }

    /**
     * Find a practice area by its slug / ID.
     */
    public function findBySlug(string $slug): ?array
    {
        foreach ($this->getAll() as $service) {
            if ($service['id'] === $slug) {
                return $service;
            }
        }
        return null;
    }

    /**
     * Get other practice areas excluding the current one (for sidebar/navigation).
     */
    public function getOtherServices(string $currentSlug): array
    {
        return array_values(array_filter($this->getAll(), function ($service) use ($currentSlug) {
            return $service['id'] !== $currentSlug;
        }));
    }
}
