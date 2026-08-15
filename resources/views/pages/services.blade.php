<x-public-layout>
    <x-slot name="title">Services | YONBUS Tax & Accounting Services Inc.</x-slot>

    {{-- Header Banner --}}
    <section style="background: linear-gradient(135deg, #020B24 0%, #002B8A 60%, #0052FF 100%); padding: 4.5rem 0; text-align: center; color: #ffffff;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span style="font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; color: #93c5fd; background: rgba(255,255,255,0.12); padding: 6px 16px; border-radius: 999px; border: 1px solid rgba(255,255,255,0.2);">
                Our Practice Areas
            </span>
            <h1 class="font-heading font-extrabold" style="font-size: clamp(2.2rem, 5vw, 3.4rem); margin-top: 1rem; color: #ffffff;">
                Our Services
            </h1>
            <p style="color: #bfdbfe; font-size: 1.1rem; max-width: 600px; margin: 0.5rem auto 0; font-weight: 400;">
                Comprehensive Tax, Bookkeeping, Payroll & Advisory Solutions Across Canada
            </p>
        </div>
    </section>

    {{-- Services List Section --}}
    <section style="background: #ffffff; padding: 5rem 0;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center" style="margin-bottom: 3.5rem;">
                <span style="font-size: 11px; font-weight: 800; color: #0052ff; text-transform: uppercase; letter-spacing: 0.08em;">WHAT WE DO</span>
                <h2 class="font-heading font-extrabold" style="color: #0a1a4a; font-size: clamp(1.8rem, 4vw, 2.5rem); margin-top: 6px;">
                    Tailored Financial Solutions for Your Success
                </h2>
                <p style="color: #4b5563; font-size: 1rem; margin-top: 10px; max-width: 580px; margin-left: auto; margin-right: auto;">
                    We combine professional expertise with modern tools to take the complexity out of tax and accounting.
                </p>
            </div>

            @php
                $brochureServices = [
                    [
                        'icon' => '🧾',
                        'title' => 'TAX SERVICES',
                        'desc' => 'Tax planning, preparation and filing for individuals, businesses and corporate entities. We ensure maximum deduction optimization while maintaining 100% CRA compliance.',
                        'features' => ['Personal T1 Income Tax Filing', 'Corporate T2 Tax Returns', 'GST/HST & PST Remittances', 'CRA Representation & Audit Support']
                    ],
                    [
                        'icon' => '🧮',
                        'title' => 'ACCOUNTING & BOOKKEEPING',
                        'desc' => 'Accurate record keeping and financial reporting to keep your business on track. Receive reliable monthly financial statements to make informed operational decisions.',
                        'features' => ['Full-Cycle Bookkeeping', 'Monthly Financial Statements', 'Bank & Credit Card Reconciliation', 'Accounts Payable & Receivable']
                    ],
                    [
                        'icon' => '📊',
                        'title' => 'PAYROLL SERVICES',
                        'desc' => 'Efficient payroll processing to ensure your employees are paid accurately and on time. We handle calculations, direct deposits, pay stub generation, and CRA payroll deductions.',
                        'features' => ['Automated Direct Deposits', 'Pay Stub Generation', 'T4 & T4A Annual Slips', 'Receiver General Payroll Deductions']
                    ],
                    [
                        'icon' => '📋',
                        'title' => 'BUSINESS ADVISORY',
                        'desc' => 'Strategic financial advice and consulting to help your business grow and thrive. From cash flow forecasting to structuring, we guide you at every stage of growth.',
                        'features' => ['Financial Growth Strategy', 'Cash Flow & Budgeting', 'New Business Registration & Setup', 'Financial Performance Analysis']
                    ],
                    [
                        'icon' => '📁',
                        'title' => 'COMPLIANCE SERVICES',
                        'desc' => 'We help you stay compliant with local regulations, provincial tax requirements, and statutory obligations so your business operates without risk or penalties.',
                        'features' => ['CRA Statutory Filings', 'Provincial Corporate Compliance', 'Annual Corporate Returns', 'Audit Preparedness & Review']
                    ],
                ];
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($brochureServices as $svc)
                <div style="background: #f8faff; border: 1.5px solid #e0e7ff; border-radius: 20px; padding: 32px 28px; display: flex; flex-direction: column; justify-content: space-between; transition: all 0.25s ease;"
                     onmouseenter="this.style.borderColor='#0052ff'; this.style.boxShadow='0 10px 30px rgba(0,82,255,0.12)'; this.style.transform='translateY(-4px)';"
                     onmouseleave="this.style.borderColor='#e0e7ff'; this.style.boxShadow='none'; this.style.transform='translateY(0)';">
                    <div>
                        <div style="width: 52px; height: 52px; border-radius: 14px; background: #eff6ff; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 20px;">
                            {{ $svc['icon'] }}
                        </div>
                        <h3 class="font-heading font-bold" style="color: #0a1a4a; font-size: 1.2rem; margin-bottom: 12px;">{{ $svc['title'] }}</h3>
                        <p style="color: #4b5563; font-size: 0.9rem; line-height: 1.65; margin-bottom: 20px;">{{ $svc['desc'] }}</p>

                        <div style="border-top: 1px solid #e2e8f0; padding-top: 16px; margin-top: 16px;">
                            <div style="font-size: 11px; font-weight: 800; color: #0052ff; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 10px;">Includes:</div>
                            <ul style="display: flex; flex-direction: column; gap: 8px;">
                                @foreach($svc['features'] as $feat)
                                <li style="display: flex; align-items: center; gap: 8px; font-size: 0.85rem; color: #374151;">
                                    <span style="color: #0052ff; font-weight: bold;">✓</span> {{ $feat }}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div style="margin-top: 28px; padding-top: 16px; border-top: 1px solid #e2e8f0;">
                        <a href="{{ route('book-appointment') }}" style="display: block; width: 100%; text-align: center; background: #0052ff; color: #ffffff; font-weight: 700; font-size: 0.88rem; padding: 12px 20px; border-radius: 12px; text-decoration: none;">
                            Book Consultation
                        </a>
                    </div>
                </div>
                @endforeach

                {{-- Additional Services (if present from Database) --}}
                @if(isset($services) && count($services) > 0)
                    @foreach($services as $service)
                    <div style="background: #ffffff; border: 1.5px solid #0052ff; border-radius: 20px; padding: 32px 28px; display: flex; flex-direction: column; justify-content: space-between;">
                        <div>
                            <div style="width: 52px; height: 52px; border-radius: 14px; background: #eff6ff; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 20px;">
                                💼
                            </div>
                            <h3 class="font-heading font-bold" style="color: #0a1a4a; font-size: 1.2rem; margin-bottom: 12px;">{{ $service->name }}</h3>
                            <p style="color: #4b5563; font-size: 0.9rem; line-height: 1.65;">{{ $service->description }}</p>
                        </div>
                        <div style="margin-top: 24px; padding-top: 16px; border-top: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between;">
                            <span style="font-weight: 800; color: #0a1a4a; font-size: 1.1rem;">${{ number_format($service->price, 2) }}</span>
                            <a href="{{ route('book-appointment') }}?service={{ $service->id }}" style="background: #0052ff; color: #ffffff; font-weight: 700; font-size: 0.85rem; padding: 10px 18px; border-radius: 10px; text-decoration: none;">
                                Book Now
                            </a>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>

        </div>
    </section>

    {{-- Bottom Banner --}}
    <section style="background: #0052ff; padding: 4rem 0; text-align: center; color: #ffffff;">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4">
            <h2 class="font-heading font-extrabold" style="font-size: clamp(1.8rem, 4vw, 2.4rem);">
                Need Custom Tax or Advisory Services?
            </h2>
            <p style="color: #bfdbfe; font-size: 1rem; max-width: 520px; margin: 0 auto 1.5rem;">
                Get in touch with our Gatineau accounting team for a personalized quote tailored to your business structure.
            </p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="{{ route('contact') }}" style="background: #ffffff; color: #0052ff; font-weight: 700; font-size: 0.95rem; padding: 14px 28px; border-radius: 12px; text-decoration: none; box-shadow: 0 4px 14px rgba(0,0,0,0.15);">
                    Contact Our Office
                </a>
            </div>
        </div>
    </section>
</x-public-layout>
