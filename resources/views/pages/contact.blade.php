<x-public-layout>
    <x-slot name="title">Contact Us | YONBUS Tax & Accounting Services Inc.</x-slot>

    {{-- ── HERO ─────────────────────────────────────────── --}}
    <section style="background:linear-gradient(135deg,#031B4E 0%,#031B4E 55%,#005DFF 100%);padding:4.5rem 0;text-align:center;position:relative;overflow:hidden;">
        <div style="position:absolute;inset:0;background:url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.04\'%3E%3Ccircle cx=\'30\' cy=\'30\' r=\'2\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');opacity:0.6;"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <span style="display:inline-block;background:rgba(255,255,255,0.15);border:1px solid rgba(255,255,255,0.3);color:#CBD5E1;font-size:11px;font-weight:800;text-transform:uppercase;letter-spacing:0.1em;padding:6px 20px;border-radius:999px;margin-bottom:1.25rem;">
                Get In Touch
            </span>
            <h1 class="font-heading font-extrabold text-white" style="font-size:clamp(2.2rem,5vw,3.4rem);letter-spacing:-0.02em;margin-bottom:1rem;line-height:1.15;">
                We're Here to Help<br><span style="color:#93c5fd;">Your Business Succeed</span>
            </h1>
            <p style="color:#CBD5E1;font-size:1.1rem;max-width:600px;margin:0 auto;font-weight:400;line-height:1.7;">
                Reach out to our Gatineau office or submit your inquiry online. Serving individuals and businesses across Canada.
            </p>
        </div>
    </section>

    {{-- ── MAIN CONTENT ─────────────────────────────────── --}}
    <section style="background:#ffffff;padding:5rem 0;border-top:4px solid #005DFF;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
                <div style="margin-bottom:2rem;padding:16px 20px;background:#ECFDF5;border:2px solid #6EE7B7;color:#065F46;border-radius:16px;text-align:center;font-weight:700;font-size:0.95rem;">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

                {{-- LEFT: Contact Info --}}
                <div class="lg:col-span-5 space-y-6">

                    {{-- Contact Details Card --}}
                    <div style="background:#ffffff;border:2px solid #CBD5E1;border-radius:24px;padding:32px;box-shadow:0 8px 32px rgba(37,99,235,0.08);">
                        <h2 class="font-heading font-bold" style="font-size:1.4rem;color:#031B4E;margin-bottom:1.5rem;padding-bottom:0.75rem;border-bottom:2px solid #F1F5F9;">
                            📬 Contact Details
                        </h2>

                        <div style="display:flex;flex-direction:column;gap:18px;">

                            <div style="display:flex;align-items:flex-start;gap:14px;">
                                <div style="width:44px;height:44px;border-radius:12px;background:#F1F5F9;border:2px solid #CBD5E1;display:flex;align-items:center;justify-content:center;font-size:1.2rem;flex-shrink:0;">📍</div>
                                <div>
                                    <div style="font-weight:800;color:#031B4E;font-size:0.88rem;text-transform:uppercase;letter-spacing:0.04em;margin-bottom:3px;">Office Address</div>
                                    <div style="color:#374151;font-size:0.9rem;line-height:1.5;font-weight:500;">Gatineau, Quebec, Canada</div>
                                </div>
                            </div>

                            <div style="display:flex;align-items:flex-start;gap:14px;">
                                <div style="width:44px;height:44px;border-radius:12px;background:#F1F5F9;border:2px solid #CBD5E1;display:flex;align-items:center;justify-content:center;font-size:1.2rem;flex-shrink:0;">📞</div>
                                <div>
                                    <div style="font-weight:800;color:#031B4E;font-size:0.88rem;text-transform:uppercase;letter-spacing:0.04em;margin-bottom:3px;">Phone Lines</div>
                                    <a href="tel:+14389781349" style="color:#005DFF;font-size:0.9rem;display:block;text-decoration:none;font-weight:600;">+1 (438) 978-1349</a>
                                    <a href="tel:+14386863599" style="color:#005DFF;font-size:0.9rem;display:block;text-decoration:none;font-weight:600;">+1 (438) 686-3599</a>
                                </div>
                            </div>

                            <div style="display:flex;align-items:flex-start;gap:14px;">
                                <div style="width:44px;height:44px;border-radius:12px;background:#F1F5F9;border:2px solid #CBD5E1;display:flex;align-items:center;justify-content:center;font-size:1.2rem;flex-shrink:0;">✉️</div>
                                <div>
                                    <div style="font-weight:800;color:#031B4E;font-size:0.88rem;text-transform:uppercase;letter-spacing:0.04em;margin-bottom:3px;">Email</div>
                                    <a href="mailto:info@yonbustax.ca" style="color:#005DFF;font-size:0.9rem;text-decoration:none;font-weight:600;">info@yonbustax.ca</a>
                                </div>
                            </div>

                            <div style="display:flex;align-items:flex-start;gap:14px;">
                                <div style="width:44px;height:44px;border-radius:12px;background:#F1F5F9;border:2px solid #CBD5E1;display:flex;align-items:center;justify-content:center;font-size:1.2rem;flex-shrink:0;">🌐</div>
                                <div>
                                    <div style="font-weight:800;color:#031B4E;font-size:0.88rem;text-transform:uppercase;letter-spacing:0.04em;margin-bottom:3px;">Website</div>
                                    <a href="https://www.yonbustax.ca" target="_blank" style="color:#005DFF;font-size:0.9rem;text-decoration:none;font-weight:600;">www.yonbustax.ca</a>
                                </div>
                            </div>

                        </div>

                        {{-- Social Links --}}
                        <div style="margin-top:24px;padding-top:20px;border-top:2px solid #F1F5F9;">
                            <div style="font-weight:800;color:#031B4E;font-size:0.85rem;text-transform:uppercase;letter-spacing:0.06em;margin-bottom:12px;">Follow Us</div>
                            <div style="display:flex;flex-wrap:wrap;gap:8px;">

                                <a href="https://facebook.com/yonbustax" target="_blank" rel="noopener"
                                   style="display:flex;align-items:center;gap:7px;padding:8px 14px;background:#F1F5F9;border:1.5px solid #CBD5E1;border-radius:10px;text-decoration:none;color:#031B4E;font-size:0.82rem;font-weight:700;transition:all 0.2s;"
                                   onmouseenter="this.style.background='#CBD5E1';this.style.borderColor='#005DFF';"
                                   onmouseleave="this.style.background='#F1F5F9';this.style.borderColor='#CBD5E1';">
                                    <svg width="15" height="15" fill="#005DFF" viewBox="0 0 24 24"><path d="M24 12.073C24 5.405 18.627 0 12 0S0 5.405 0 12.073C0 18.1 4.388 23.094 10.125 24v-8.437H7.078v-3.49h3.047V9.41c0-3.025 1.792-4.697 4.533-4.697 1.312 0 2.686.235 2.686.235v2.97h-1.513c-1.491 0-1.956.93-1.956 1.874v2.25h3.328l-.532 3.49h-2.796V24C19.612 23.094 24 18.1 24 12.073z"/></svg>
                                    Facebook
                                </a>

                                <a href="https://instagram.com/yonbustax" target="_blank" rel="noopener"
                                   style="display:flex;align-items:center;gap:7px;padding:8px 14px;background:#F1F5F9;border:1.5px solid #CBD5E1;border-radius:10px;text-decoration:none;color:#031B4E;font-size:0.82rem;font-weight:700;transition:all 0.2s;"
                                   onmouseenter="this.style.background='#CBD5E1';this.style.borderColor='#005DFF';"
                                   onmouseleave="this.style.background='#F1F5F9';this.style.borderColor='#CBD5E1';">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none"><rect width="24" height="24" rx="5.5" fill="#d6249f"/><circle cx="12" cy="12" r="4.5" stroke="white" stroke-width="1.8"/><circle cx="17.5" cy="6.5" r="1.2" fill="white"/></svg>
                                    Instagram
                                </a>

                                <a href="https://tiktok.com/@yonbustax" target="_blank" rel="noopener"
                                   style="display:flex;align-items:center;gap:7px;padding:8px 14px;background:#F1F5F9;border:1.5px solid #CBD5E1;border-radius:10px;text-decoration:none;color:#031B4E;font-size:0.82rem;font-weight:700;transition:all 0.2s;"
                                   onmouseenter="this.style.background='#CBD5E1';this.style.borderColor='#005DFF';"
                                   onmouseleave="this.style.background='#F1F5F9';this.style.borderColor='#CBD5E1';">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="#031B4E"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.5 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 0 0-.79-.05 6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.33-6.34V8.69a8.18 8.18 0 0 0 4.78 1.52V6.75a4.85 4.85 0 0 1-1.01-.06z"/></svg>
                                    TikTok
                                </a>

                                <a href="https://linkedin.com/company/yonbustax" target="_blank" rel="noopener"
                                   style="display:flex;align-items:center;gap:7px;padding:8px 14px;background:#F1F5F9;border:1.5px solid #CBD5E1;border-radius:10px;text-decoration:none;color:#031B4E;font-size:0.82rem;font-weight:700;transition:all 0.2s;"
                                   onmouseenter="this.style.background='#CBD5E1';this.style.borderColor='#005DFF';"
                                   onmouseleave="this.style.background='#F1F5F9';this.style.borderColor='#CBD5E1';">
                                    <svg width="15" height="15" fill="#0A66C2" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                    LinkedIn
                                </a>

                            </div>
                        </div>

                        <div style="margin-top:16px;padding-top:14px;border-top:2px solid #F1F5F9;font-size:0.85rem;color:#64748b;font-weight:500;">
                            🇨🇦 Serving individuals and businesses across Canada
                        </div>
                    </div>

                    {{-- Office Hours --}}
                    <div style="background:#F1F5F9;border:2px solid #CBD5E1;border-radius:20px;padding:24px;">
                        <h3 class="font-heading font-bold" style="color:#031B4E;font-size:1.1rem;margin-bottom:14px;display:flex;align-items:center;gap:8px;">
                            🕐 Office Hours
                        </h3>
                        <div style="display:flex;flex-direction:column;gap:10px;font-size:0.9rem;">
                            <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 14px;background:#ffffff;border-radius:10px;border:1.5px solid #CBD5E1;">
                                <span style="color:#374151;font-weight:500;">Monday – Friday</span>
                                <span style="font-weight:800;color:#031B4E;">9:00 AM – 5:00 PM</span>
                            </div>
                            <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 14px;background:#ffffff;border-radius:10px;border:1.5px solid #CBD5E1;">
                                <span style="color:#374151;font-weight:500;">Saturday</span>
                                <span style="font-weight:800;color:#005DFF;">By Appointment</span>
                            </div>
                            <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 14px;background:#ffffff;border-radius:10px;border:1.5px solid #CBD5E1;">
                                <span style="color:#374151;font-weight:500;">Sunday</span>
                                <span style="font-weight:700;color:#9CA3AF;">Closed</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- RIGHT: Contact Form --}}
                <div class="lg:col-span-7">
                    <div style="background:#ffffff;border:2px solid #CBD5E1;border-radius:24px;padding:36px;box-shadow:0 8px 40px rgba(37,99,235,0.10);">
                        <h2 class="font-heading font-bold" style="color:#031B4E;font-size:1.5rem;margin-bottom:8px;">Send Us a Direct Message</h2>
                        <p style="color:#64748b;font-size:0.9rem;margin-bottom:28px;">Fill out the form below and our team will get back to you within 24 hours.</p>

                        <form action="{{ route('contact.submit') }}" method="POST" style="display:flex;flex-direction:column;gap:18px;">
                            @csrf

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label style="display:block;font-size:11px;font-weight:800;text-transform:uppercase;color:#031B4E;letter-spacing:0.06em;margin-bottom:6px;">Your Name *</label>
                                    <input type="text" name="name" required
                                           style="width:100%;padding:12px 16px;border-radius:12px;border:2px solid #CBD5E1;font-size:0.9rem;color:#031B4E;background:#ffffff;outline:none;transition:border-color 0.2s;box-sizing:border-box;"
                                           placeholder="John Doe"
                                           onfocus="this.style.borderColor='#005DFF';"
                                           onblur="this.style.borderColor='#CBD5E1';">
                                </div>
                                <div>
                                    <label style="display:block;font-size:11px;font-weight:800;text-transform:uppercase;color:#031B4E;letter-spacing:0.06em;margin-bottom:6px;">Email Address *</label>
                                    <input type="email" name="email" required
                                           style="width:100%;padding:12px 16px;border-radius:12px;border:2px solid #CBD5E1;font-size:0.9rem;color:#031B4E;background:#ffffff;outline:none;transition:border-color 0.2s;box-sizing:border-box;"
                                           placeholder="john@example.com"
                                           onfocus="this.style.borderColor='#005DFF';"
                                           onblur="this.style.borderColor='#CBD5E1';">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label style="display:block;font-size:11px;font-weight:800;text-transform:uppercase;color:#031B4E;letter-spacing:0.06em;margin-bottom:6px;">Phone Number</label>
                                    <input type="text" name="phone"
                                           style="width:100%;padding:12px 16px;border-radius:12px;border:2px solid #CBD5E1;font-size:0.9rem;color:#031B4E;background:#ffffff;outline:none;transition:border-color 0.2s;box-sizing:border-box;"
                                           placeholder="+1 (555) 000-0000"
                                           onfocus="this.style.borderColor='#005DFF';"
                                           onblur="this.style.borderColor='#CBD5E1';">
                                </div>
                                <div>
                                    <label style="display:block;font-size:11px;font-weight:800;text-transform:uppercase;color:#031B4E;letter-spacing:0.06em;margin-bottom:6px;">Subject *</label>
                                    <input type="text" name="subject" required
                                           style="width:100%;padding:12px 16px;border-radius:12px;border:2px solid #CBD5E1;font-size:0.9rem;color:#031B4E;background:#ffffff;outline:none;transition:border-color 0.2s;box-sizing:border-box;"
                                           placeholder="Tax Filing Inquiry"
                                           onfocus="this.style.borderColor='#005DFF';"
                                           onblur="this.style.borderColor='#CBD5E1';">
                                </div>
                            </div>

                            <div>
                                <label style="display:block;font-size:11px;font-weight:800;text-transform:uppercase;color:#031B4E;letter-spacing:0.06em;margin-bottom:6px;">Service Interested In</label>
                                <select name="service"
                                        style="width:100%;padding:12px 16px;border-radius:12px;border:2px solid #CBD5E1;font-size:0.9rem;color:#031B4E;background:#ffffff;outline:none;transition:border-color 0.2s;"
                                        onfocus="this.style.borderColor='#005DFF';"
                                        onblur="this.style.borderColor='#CBD5E1';">
                                    <option value="">Select a service...</option>
                                    <option>Tax Services</option>
                                    <option>Accounting &amp; Bookkeeping</option>
                                    <option>Payroll Services</option>
                                    <option>Business Advisory</option>
                                    <option>Compliance Services</option>
                                    <option>Other</option>
                                </select>
                            </div>

                            <div>
                                <label style="display:block;font-size:11px;font-weight:800;text-transform:uppercase;color:#031B4E;letter-spacing:0.06em;margin-bottom:6px;">Message *</label>
                                <textarea name="message" rows="5" required
                                          style="width:100%;padding:12px 16px;border-radius:12px;border:2px solid #CBD5E1;font-size:0.9rem;color:#031B4E;background:#ffffff;outline:none;transition:border-color 0.2s;resize:vertical;"
                                          placeholder="How can our accounting team assist you?"
                                          onfocus="this.style.borderColor='#005DFF';"
                                          onblur="this.style.borderColor='#CBD5E1';"></textarea>
                            </div>

                            <button type="submit"
                                    style="width:100%;padding:15px;background:#005DFF;color:#ffffff;font-weight:800;font-size:1rem;border-radius:14px;border:none;cursor:pointer;box-shadow:0 8px 24px rgba(37,99,235,0.35);transition:all 0.2s;letter-spacing:0.01em;"
                                    onmouseenter="this.style.background='#031B4E';this.style.boxShadow='0 12px 32px rgba(37,99,235,0.45)';this.style.transform='translateY(-1px)';"
                                    onmouseleave="this.style.background='#005DFF';this.style.boxShadow='0 8px 24px rgba(37,99,235,0.35)';this.style.transform='translateY(0)';">
                                ✉️ Submit Inquiry
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

</x-public-layout>
