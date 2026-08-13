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
                                    <div style="color: #bfdbfe; font-size: 0.88rem; line-height: 1.5;">Gatineau, Quebec, Canada</div>
                                </div>
                            </div>

                            <div style="display: flex; align-items: flex-start; gap: 14px;">
                                <div style="width: 42px; height: 42px; border-radius: 12px; background: rgba(255,255,255,0.15); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0;">📞</div>
                                <div>
                                    <div style="font-weight: 700; color: #ffffff; font-size: 0.95rem; margin-bottom: 2px;">Phone Lines</div>
                                    <div style="color: #bfdbfe; font-size: 0.88rem; line-height: 1.5;">+1 (438) 978-1349 / +1 (438) 686-3599</div>
                                </div>
                            </div>

                            <div style="display: flex; align-items: flex-start; gap: 14px;">
                                <div style="width: 42px; height: 42px; border-radius: 12px; background: rgba(255,255,255,0.15); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0;">✉️</div>
                                <div>
                                    <div style="font-weight: 700; color: #ffffff; font-size: 0.95rem; margin-bottom: 2px;">Email Addresses</div>
                                    <a href="mailto:info@yonbustax.ca" style="color: #93c5fd; font-size: 0.88rem; display: block; text-decoration: none;">info@yonbustax.ca</a>
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

                        {{-- Social Media Links --}}
                        <div style="border-top: 1px solid rgba(255,255,255,0.2); padding-top: 20px;">
                            <div style="font-weight: 700; color: #ffffff; font-size: 0.95rem; margin-bottom: 14px;">Follow Us</div>
                            <div style="display: flex; flex-wrap: wrap; gap: 10px;">

                                <a href="https://facebook.com/yonbustax" target="_blank" rel="noopener"
                                   title="Facebook"
                                   style="display: flex; align-items: center; gap: 8px; padding: 9px 14px; background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.2); border-radius: 10px; text-decoration: none; color: #ffffff; font-size: 0.82rem; font-weight: 600;"
                                   onmouseenter="this.style.background='rgba(255,255,255,0.22)';"
                                   onmouseleave="this.style.background='rgba(255,255,255,0.12)';">
                                    <svg width="16" height="16" fill="#ffffff" viewBox="0 0 24 24"><path d="M24 12.073C24 5.405 18.627 0 12 0S0 5.405 0 12.073C0 18.1 4.388 23.094 10.125 24v-8.437H7.078v-3.49h3.047V9.41c0-3.025 1.792-4.697 4.533-4.697 1.312 0 2.686.235 2.686.235v2.97h-1.513c-1.491 0-1.956.93-1.956 1.874v2.25h3.328l-.532 3.49h-2.796V24C19.612 23.094 24 18.1 24 12.073z"/></svg>
                                    Facebook
                                </a>

                                <a href="https://instagram.com/yonbustax" target="_blank" rel="noopener"
                                   title="Instagram"
                                   style="display: flex; align-items: center; gap: 8px; padding: 9px 14px; background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.2); border-radius: 10px; text-decoration: none; color: #ffffff; font-size: 0.82rem; font-weight: 600;"
                                   onmouseenter="this.style.background='rgba(255,255,255,0.22)';"
                                   onmouseleave="this.style.background='rgba(255,255,255,0.12)';">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><rect width="24" height="24" rx="5.5" fill="white" fill-opacity="0.9"/><circle cx="12" cy="12" r="4.5" stroke="#d6249f" stroke-width="1.8"/><circle cx="17.5" cy="6.5" r="1.2" fill="#d6249f"/></svg>
                                    Instagram
                                </a>

                                <a href="https://tiktok.com/@yonbustax" target="_blank" rel="noopener"
                                   title="TikTok"
                                   style="display: flex; align-items: center; gap: 8px; padding: 9px 14px; background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.2); border-radius: 10px; text-decoration: none; color: #ffffff; font-size: 0.82rem; font-weight: 600;"
                                   onmouseenter="this.style.background='rgba(255,255,255,0.22)';"
                                   onmouseleave="this.style.background='rgba(255,255,255,0.12)';">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="white"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.5 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 0 0-.79-.05 6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.33-6.34V8.69a8.18 8.18 0 0 0 4.78 1.52V6.75a4.85 4.85 0 0 1-1.01-.06z"/></svg>
                                    TikTok
                                </a>

                                <a href="https://x.com/yonbustax" target="_blank" rel="noopener"
                                   title="X (Twitter)"
                                   style="display: flex; align-items: center; gap: 8px; padding: 9px 14px; background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.2); border-radius: 10px; text-decoration: none; color: #ffffff; font-size: 0.82rem; font-weight: 600;"
                                   onmouseenter="this.style.background='rgba(255,255,255,0.22)';"
                                   onmouseleave="this.style.background='rgba(255,255,255,0.12)';">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="white"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.746l7.73-8.835L1.254 2.25H8.08l4.258 5.63L18.244 2.25zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                    X (Twitter)
                                </a>

                                <a href="https://linkedin.com/company/yonbustax" target="_blank" rel="noopener"
                                   title="LinkedIn"
                                   style="display: flex; align-items: center; gap: 8px; padding: 9px 14px; background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.2); border-radius: 10px; text-decoration: none; color: #ffffff; font-size: 0.82rem; font-weight: 600;"
                                   onmouseenter="this.style.background='rgba(255,255,255,0.22)';"
                                   onmouseleave="this.style.background='rgba(255,255,255,0.12)';">
                                    <svg width="16" height="16" fill="white" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                    LinkedIn
                                </a>

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
