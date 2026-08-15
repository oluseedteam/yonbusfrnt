<x-public-layout>
    <x-slot name="title">Contact Us | YONBUS Tax & Accounting Services Inc.</x-slot>

    {{-- Header Banner --}}
    <section style="background: linear-gradient(135deg, #020B24 0%, #002B8A 60%, #0052FF 100%); padding: 4.5rem 0; text-align: center; color: #ffffff;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span style="font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; color: #93c5fd; background: rgba(255,255,255,0.12); padding: 6px 16px; border-radius: 999px; border: 1px solid rgba(255,255,255,0.2);">
                Get In Touch
            </span>
            <h1 class="font-heading font-extrabold" style="font-size: clamp(2.2rem, 5vw, 3.4rem); margin-top: 1rem; color: #ffffff;">
                We're Here to Help Your Business Succeed
            </h1>
            <p style="color: #bfdbfe; font-size: 1.1rem; max-width: 600px; margin: 0.5rem auto 0; font-weight: 400;">
                Reach out to our Gatineau office or submit your inquiry online. Serving individuals and businesses across Canada.
            </p>
        </div>
    </section>

    <section style="background: #f8faff; padding: 5rem 0;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div style="margin-bottom: 2rem; padding: 16px; background: #dcfce7; border: 1px solid #86efac; color: #166534; border-radius: 16px; text-align: center; font-weight: 700;">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                {{-- LEFT: Official Contact Details --}}
                <div class="lg:col-span-5 space-y-6">
                    <div style="background: #002B8A; border-radius: 24px; padding: 32px; color: #ffffff; display: flex; flex-direction: column; gap: 24px;">
                        <h2 class="font-heading font-bold" style="font-size: 1.5rem; color: #ffffff;">GET IN TOUCH</h2>

                        <div style="display: flex; flex-direction: column; gap: 20px;">
                            <div style="display: flex; align-items: flex-start; gap: 14px;">
                                <div style="width: 42px; height: 42px; border-radius: 12px; background: rgba(255,255,255,0.15); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0;">📍</div>
                                <div>
                                    <div style="font-weight: 700; color: #ffffff; font-size: 0.95rem; margin-bottom: 2px;">Office Address</div>
                                    <div style="color: #bfdbfe; font-size: 0.88rem; line-height: 1.5;">147 Rue duChatelet<br>Gatineau, Quebec J8M 2A3</div>
                                </div>
                            </div>

                            <div style="display: flex; align-items: flex-start; gap: 14px;">
                                <div style="width: 42px; height: 42px; border-radius: 12px; background: rgba(255,255,255,0.15); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0;">📞</div>
                                <div>
                                    <div style="font-weight: 700; color: #ffffff; font-size: 0.95rem; margin-bottom: 2px;">Phone Lines</div>
                                    <div style="color: #bfdbfe; font-size: 0.88rem; line-height: 1.5;">+1 (647) 723-0990</div>
                                    <div style="color: #bfdbfe; font-size: 0.88rem; line-height: 1.5;">+1 (437) 423-9911</div>
                                    <div style="color: #bfdbfe; font-size: 0.88rem; line-height: 1.5;">(438) 978-1349 / (438) 686-3599</div>
                                </div>
                            </div>

                            <div style="display: flex; align-items: flex-start; gap: 14px;">
                                <div style="width: 42px; height: 42px; border-radius: 12px; background: rgba(255,255,255,0.15); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0;">✉️</div>
                                <div>
                                    <div style="font-weight: 700; color: #ffffff; font-size: 0.95rem; margin-bottom: 2px;">Email Addresses</div>
                                    <a href="mailto:info@yonbustax.com" style="color: #93c5fd; font-size: 0.88rem; display: block; text-decoration: none;">info@yonbustax.com</a>
                                    <a href="mailto:yonbustaxservices@gmail.com" style="color: #93c5fd; font-size: 0.88rem; display: block; text-decoration: none;">yonbustaxservices@gmail.com</a>
                                </div>
                            </div>

                            <div style="display: flex; align-items: flex-start; gap: 14px;">
                                <div style="width: 42px; height: 42px; border-radius: 12px; background: rgba(255,255,255,0.15); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0;">🌐</div>
                                <div>
                                    <div style="font-weight: 700; color: #ffffff; font-size: 0.95rem; margin-bottom: 2px;">Website</div>
                                    <a href="https://www.yonbustax.com" target="_blank" style="color: #93c5fd; font-size: 0.88rem; text-decoration: none;">www.yonbustax.com</a>
                                </div>
                            </div>
                        </div>

                        <div style="border-top: 1px solid rgba(255,255,255,0.2); padding-top: 16px; font-size: 0.82rem; color: #bfdbfe;">
                            🇨🇦 Serving individuals and businesses across Canada
                        </div>
                    </div>

                    {{-- Office Hours --}}
                    <div style="background: #ffffff; border: 1.5px solid #e0e7ff; border-radius: 20px; padding: 24px;">
                        <h3 class="font-heading font-bold" style="color: #0a1a4a; font-size: 1.1rem; margin-bottom: 12px;">Office Hours</h3>
                        <div style="display: flex; flex-direction: column; gap: 8px; font-size: 0.88rem; color: #4b5563;">
                            <div style="display: flex; justify-content: space-between;">
                                <span>Monday – Friday</span>
                                <span style="font-weight: 700; color: #0a1a4a;">9:00 AM – 5:00 PM</span>
                            </div>
                            <div style="display: flex; justify-content: space-between;">
                                <span>Saturday</span>
                                <span style="font-weight: 700; color: #0a1a4a;">By Appointment</span>
                            </div>
                            <div style="display: flex; justify-content: space-between;">
                                <span>Sunday</span>
                                <span style="color: #9ca3af;">Closed</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- RIGHT: Direct Message Form --}}
                <div class="lg:col-span-7" style="background: #ffffff; border: 1.5px solid #e0e7ff; border-radius: 24px; padding: 32px 36px; box-shadow: 0 4px 20px rgba(0,82,255,0.04);">
                    <h2 class="font-heading font-bold" style="color: #0a1a4a; font-size: 1.5rem; margin-bottom: 24px;">Send Us a Direct Message</h2>
                    <form action="{{ route('contact.submit') }}" method="POST" style="display: flex; flex-direction: column; gap: 18px;">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label style="display: block; font-size: 11px; font-weight: 800; text-transform: uppercase; color: #374151; margin-bottom: 6px;">Your Name *</label>
                                <input type="text" name="name" required style="width: 100%; padding: 12px 14px; border-radius: 12px; border: 1.5px solid #cbd5e1; font-size: 0.9rem; color: #1e293b;" placeholder="John Doe">
                            </div>
                            <div>
                                <label style="display: block; font-size: 11px; font-weight: 800; text-transform: uppercase; color: #374151; margin-bottom: 6px;">Email Address *</label>
                                <input type="email" name="email" required style="width: 100%; padding: 12px 14px; border-radius: 12px; border: 1.5px solid #cbd5e1; font-size: 0.9rem; color: #1e293b;" placeholder="john@example.com">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label style="display: block; font-size: 11px; font-weight: 800; text-transform: uppercase; color: #374151; margin-bottom: 6px;">Phone Number</label>
                                <input type="text" name="phone" style="width: 100%; padding: 12px 14px; border-radius: 12px; border: 1.5px solid #cbd5e1; font-size: 0.9rem; color: #1e293b;" placeholder="+1 (555) 000-0000">
                            </div>
                            <div>
                                <label style="display: block; font-size: 11px; font-weight: 800; text-transform: uppercase; color: #374151; margin-bottom: 6px;">Subject *</label>
                                <input type="text" name="subject" required style="width: 100%; padding: 12px 14px; border-radius: 12px; border: 1.5px solid #cbd5e1; font-size: 0.9rem; color: #1e293b;" placeholder="Tax Filing Inquiry">
                            </div>
                        </div>

                        <div>
                            <label style="display: block; font-size: 11px; font-weight: 800; text-transform: uppercase; color: #374151; margin-bottom: 6px;">Service Interested In</label>
                            <select name="service" style="width: 100%; padding: 12px 14px; border-radius: 12px; border: 1.5px solid #cbd5e1; font-size: 0.9rem; color: #374151;">
                                <option value="">Select a service...</option>
                                <option>Tax Services</option>
                                <option>Accounting & Bookkeeping</option>
                                <option>Payroll Services</option>
                                <option>Business Advisory</option>
                                <option>Compliance Services</option>
                                <option>Other</option>
                            </select>
                        </div>

                        <div>
                            <label style="display: block; font-size: 11px; font-weight: 800; text-transform: uppercase; color: #374151; margin-bottom: 6px;">Message *</label>
                            <textarea name="message" rows="5" required style="width: 100%; padding: 12px 14px; border-radius: 12px; border: 1.5px solid #cbd5e1; font-size: 0.9rem; color: #1e293b;" placeholder="How can our accounting team assist you?"></textarea>
                        </div>

                        <button type="submit" style="width: 100%; padding: 14px; background: #0052ff; color: #ffffff; font-weight: 700; font-size: 0.95rem; border-radius: 12px; border: none; cursor: pointer; box-shadow: 0 4px 14px rgba(0,82,255,0.3);">
                            Submit Inquiry
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
