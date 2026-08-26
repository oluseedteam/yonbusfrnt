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
                'description' => 'We provide comprehensive Canadian tax preparation and proactive tax planning services for individuals, families, self-employed professionals, investors, and corporations. Our approach focuses on accurate filings, identifying eligible deductions and credits, and helping clients make informed tax decisions throughout the year.',
                'features' => [
                    [
                        'title' => 'Personal Tax Returns',
                        'desc' => 'Preparation and electronic filing of Canadian T1 personal income tax returns and Quebec TP-1 returns, with a thorough review of available deductions, credits, and benefits.',
                    ],
                    [
                        'title' => 'Corporate Tax Returns',
                        'desc' => 'Preparation and filing of corporate T2 income tax returns and Quebec CO-17 return, including the preparation of supporting financial information and year-end tax adjustments.',
                    ],
                    [
                        'title' => 'Rental & Investment Tax',
                        'desc' => 'Reporting of rental property income and expenses, investment income, capital gains, and other related transactions, with careful consideration of applicable tax rules.',
                    ],
                    [
                        'title' => 'Tax Planning & Minimization',
                        'desc' => 'Year-round tax planning designed to identify legitimate opportunities to manage tax liabilities, maximize available deductions and credits, and improve overall tax efficiency.',
                    ],
                    [
                        'title' => 'Tax Compliance & Advisory',
                        'desc' => 'Professional guidance on Canadian tax obligations, tax-related transactions, filing requirements, and strategies to help individuals and businesses remain compliant while making informed financial decisions.',
                    ],
                ],
            ],
            [
                'id' => 'accounting-bookkeeping',
                'name' => 'Accounting & Bookkeeping Services',
                'short_name' => 'Accounting & Bookkeeping',
                'icon' => '🧮',
                'description' => 'We provide accurate and efficient accounting and bookkeeping services to keep your financial records organized, up to date, and ready for informed business decisions.',
                'features' => [
                    [
                        'title' => 'Full-Cycle Bookkeeping',
                        'desc' => 'Recording transactions, maintaining ledgers, and preparing accounts for year-end reporting.',
                    ],
                    [
                        'title' => 'Accounts Receivable & Payable',
                        'desc' => 'Managing customer invoices, supplier bills, payments, collections, and outstanding balances.',
                    ],
                    [
                        'title' => 'Bank & Account Reconciliations',
                        'desc' => 'Monthly reconciliation of bank, credit card, and loan accounts to ensure accuracy.',
                    ],
                    [
                        'title' => 'Cloud Accounting',
                        'desc' => 'Bookkeeping and financial record management using platforms such as QuickBooks Online, Xero, and Sage.',
                    ],
                    [
                        'title' => 'Financial Statements & Compilation',
                        'desc' => 'Preparation of financial statements and compilation engagements',
                    ],
                ],
            ],
            [
                'id' => 'payroll-services',
                'name' => 'Payroll Services',
                'short_name' => 'Payroll Services',
                'icon' => '📊',
                'description' => 'We provide reliable, end-to-end payroll services to help businesses manage employee compensation, statutory deductions, and year-end reporting accurately and efficiently.',
                'features' => [
                    [
                        'title' => 'Payroll Processing & Direct Deposit',
                        'desc' => 'Timely payroll calculations and direct deposit processing for employees across Canada.',
                    ],
                    [
                        'title' => 'Payroll Deductions & Remittances',
                        'desc' => 'Accurate calculation of required payroll deductions and employer contributions, including CPP/QPP, EI, QPIP, and applicable provincial requirements.',
                    ],
                    [
                        'title' => 'Record of Employment (ROE)',
                        'desc' => 'Preparation and electronic submission of ROEs when an employee experiences an interruption of earnings.',
                    ],
                    [
                        'title' => 'Year-End Payroll Reporting',
                        'desc' => 'Preparation and electronic filing of T4, T4A, and Relevé 1 slips and summaries.',
                    ],
                    [
                        'title' => 'Payroll Compliance Support',
                        'desc' => 'Assistance with payroll records, remittances, year-end requirements, and payroll-related inquiries.',
                    ],
                ],
            ],
            [
                'id' => 'business-consulting-advisory',
                'name' => 'Business Consulting & Advisory',
                'short_name' => 'Business Consulting & Advisory',
                'icon' => '💼',
                'description' => 'We provide practical financial and business advisory services to help entrepreneurs and business owners understand their numbers, plan for growth, and make informed financial decisions.',
                'features' => [
                    [
                        'title' => 'Financial Planning & Forecasting',
                        'desc' => 'Preparation of budgets, financial forecasts, and scenario analysis to support short- and long-term business planning.',
                    ],
                    [
                        'title' => 'Cash Flow & Profitability Analysis',
                        'desc' => 'Analysis of cash flow, revenue, expenses, margins, and financial performance to help improve business profitability and liquidity.',
                    ],
                    [
                        'title' => 'Business Performance Advisory',
                        'desc' => 'Financial analysis and KPI reporting to help business owners monitor performance and identify opportunities for growth.',
                    ],
                    [
                        'title' => 'Financing & Loan Support',
                        'desc' => 'Preparation of financial information, projections, and financing packages to support applications to Canadian banks and business lenders.',
                    ],
                    [
                        'title' => 'Business Valuation & Strategic Advisory',
                        'desc' => 'Financial analysis and business valuation support for growth planning, ownership changes, acquisitions, and other major business decisions.',
                    ],
                ],
            ],
            [
                'id' => 'compliance-services',
                'name' => 'Compliance Services',
                'short_name' => 'Compliance Services',
                'icon' => '⚖️',
                'description' => 'We help individuals and businesses meet their ongoing tax, payroll, and corporate compliance requirements accurately and on time, helping reduce the risk of missed filings, penalties, and compliance issues.',
                'features' => [
                    [
                        'title' => 'Sales Tax Compliance',
                        'desc' => 'Preparation, reconciliation, and filing of GST/HST and QST returns.',
                    ],
                    [
                        'title' => 'Corporate Compliance Filings',
                        'desc' => 'Assistance with required corporate annual returns and other ongoing corporate filing obligations.',
                    ],
                    [
                        'title' => 'Payroll Compliance',
                        'desc' => 'Support with payroll remittances, year-end payroll reporting, and required employee information slips.',
                    ],
                    [
                        'title' => 'Tax Review & Audit Support',
                        'desc' => 'Assistance with tax reviews, audits, documentation requests, and related compliance matters.',
                    ],
                    [
                        'title' => 'Tax Objections & Appeals',
                        'desc' => 'Preparation and submission of formal objections and appeals relating to tax assessments.',
                    ],
                    [
                        'title' => 'Penalty & Interest Relief',
                        'desc' => 'Assistance with eligible applications for relief from tax penalties and interest.',
                    ],
                ],
            ],
            [
                'id' => 'business-registration',
                'name' => 'Business Registration',
                'short_name' => 'Business Registration',
                'icon' => '🏢',
                'description' => 'We help entrepreneurs and business owners establish their businesses properly and set up the registrations and accounts needed to operate in Canada.',
                'features' => [
                    [
                        'title' => 'Federal & Provincial Incorporation',
                        'desc' => 'Assistance with incorporating a business federally or provincially based on your business needs.',
                    ],
                    [
                        'title' => 'Business Name Registration',
                        'desc' => 'Support with business name searches, name selection, and registration requirements.',
                    ],
                    [
                        'title' => 'Business Number (BN) Registration',
                        'desc' => 'Assistance with obtaining a Business Number and setting up applicable program accounts.',
                    ],
                    [
                        'title' => 'GST/HST & QST Registration',
                        'desc' => 'Registration for applicable sales tax accounts and guidance on sales tax requirements.',
                    ],
                    [
                        'title' => 'Payroll Account Registration',
                        'desc' => 'Setup of payroll program accounts and guidance on employer payroll obligations.',
                    ],
                ],
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
