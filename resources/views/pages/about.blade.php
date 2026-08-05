<x-public-layout>
    <x-slot name="title">About Us | YONBUS Tax & Accounting Services Inc.</x-slot>

    {{-- Header Banner --}}
    <section style="background: linear-gradient(135deg, #020B24 0%, #002B8A 60%, #0052FF 100%); padding: 4.5rem 0; text-align: center; color: #ffffff;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span style="font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; color: #93c5fd; background: rgba(255,255,255,0.12); padding: 6px 16px; border-radius: 999px; border: 1px solid rgba(255,255,255,0.2);">
                About Our Firm
            </span>
            <h1 class="font-heading font-extrabold" style="font-size: clamp(2.2rem, 5vw, 3.4rem); margin-top: 1rem; color: #ffffff;">
                YONBUS Tax & Accounting Services Inc.
            </h1>
            <p style="color: #bfdbfe; font-size: 1.1rem; max-width: 600px; margin: 0.5rem auto 0; font-weight: 400;">
                Your Partner in Financial Clarity and Growth
            </p>
        </div>
    </section>

    {{-- Main About Us Section --}}
    <section style="background: #ffffff; padding: 5rem 0;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">

                {{-- Left Column: Who We Are & Mission Quote --}}
                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    <span style="font-size: 11px; font-weight: 800; color: #0052ff; text-transform: uppercase; letter-spacing: 0.08em;">
                        ABOUT US
                    </span>
                    <h2 class="font-heading font-extrabold" style="color: #0a1a4a; font-size: clamp(1.8rem, 4vw, 2.5rem); line-height: 1.2;">
                        Who We Are
                    </h2>
                    <p style="color: #374151; font-size: 1rem; line-height: 1.75;">
                        <strong style="color: #0052ff;">Yonbus Tax & Accounting Services Inc.</strong> is a trusted partner committed to delivering reliable, efficient and compliant tax and accounting solutions to individuals, businesses and organizations across Canada.
                    </p>
                    <p style="color: #374151; font-size: 1rem; line-height: 1.75;">
                        We combine professional expertise with modern technology to help you keep accurate records, meet your tax obligations and make informed financial decisions.
                    </p>

                    {{-- Brochure Mission Quote Box --}}
                    <div style="background: #002B8A; border-radius: 20px; padding: 24px 28px; color: #ffffff; margin-top: 0.5rem; position: relative;">
                        <div style="font-size: 2rem; color: #60a5fa; font-family: Georgia, serif; line-height: 1; margin-bottom: 6px;">“</div>
                        <p style="font-size: 1rem; font-style: italic; line-height: 1.65; color: #f1f5f9;">
                            Our goal is simple: To take the stress out of tax and accounting, so you can focus on what matters most – growing your business.
                        </p>
                    </div>
                </div>

                {{-- Right Column: OUR VALUES --}}
                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    <span style="font-size: 11px; font-weight: 800; color: #0052ff; text-transform: uppercase; letter-spacing: 0.08em;">
                        OUR VALUES
                    </span>
                    <h3 class="font-heading font-bold" style="color: #0a1a4a; font-size: 1.5rem; margin-bottom: 0.5rem;">
                        What We Stand For
                    </h3>

                    @php
                        $values = [
                            ['icon'=>'🛡️', 'title'=>'INTEGRITY', 'desc'=>'We uphold the highest standards of honesty and transparency in every interaction.'],
                            ['icon'=>'👔', 'title'=>'PROFESSIONALISM', 'desc'=>'We deliver quality service with deep expertise, diligence, and precision.'],
                            ['icon'=>'📈', 'title'=>'EXCELLENCE', 'desc'=>'We are committed to accuracy, efficiency, and continuous improvement.'],
                            ['icon'=>'🤝', 'title'=>'CLIENT FOCUS', 'desc'=>'We build lasting relationships by putting our clients\' financial success first.'],
                        ];
                    @endphp

                    @foreach($values as $v)
                    <div style="background: #f8faff; border: 1.5px solid #e0e7ff; border-radius: 16px; padding: 20px; display: flex; align-items: flex-start; gap: 16px;">
                        <div style="width: 44px; height: 44px; border-radius: 12px; background: #eff6ff; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0;">
                            {{ $v['icon'] }}
                        </div>
                        <div>
                            <h4 class="font-heading font-bold" style="color: #0a1a4a; font-size: 1.05rem; margin-bottom: 4px;">{{ $v['title'] }}</h4>
                            <p style="color: #4b5563; font-size: 0.88rem; line-height: 1.55;">{{ $v['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
    </section>

    {{-- Bottom CTA --}}
    <section style="background: #0052ff; padding: 4rem 0; text-align: center; color: #ffffff;">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4">
            <h2 class="font-heading font-extrabold" style="font-size: clamp(1.8rem, 4vw, 2.5rem);">
                Ready to Work With Us?
            </h2>
            <p style="color: #bfdbfe; font-size: 1rem; max-width: 520px; margin: 0 auto 1.5rem;">
                Schedule a consultation today and discover how YONBUS can streamline your financial operations.
            </p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="{{ route('book-appointment') }}" style="background: #ffffff; color: #0052ff; font-weight: 700; font-size: 0.95rem; padding: 14px 28px; border-radius: 12px; text-decoration: none; box-shadow: 0 4px 14px rgba(0,0,0,0.15);">
                    Book Consultation
                </a>
                <a href="{{ route('contact') }}" style="background: rgba(255,255,255,0.15); border: 1.5px solid rgba(255,255,255,0.35); color: #ffffff; font-weight: 600; font-size: 0.95rem; padding: 14px 26px; border-radius: 12px; text-decoration: none;">
                    Contact Us
                </a>
            </div>
        </div>
    </section>
</x-public-layout>
