<x-public-layout>
    <x-slot name="title">Careers | YONBUS Tax & Accounting Services Inc.</x-slot>

    {{-- ── HERO ─────────────────────────────────────────── --}}
    <section class="relative py-20 sm:py-24 text-center overflow-hidden" style="background: linear-gradient(135deg, #0f172a 0%, #031B4E 50%, #005DFF 100%);" data-aos="fade-down">
        <div style="position:absolute;inset:0;background:url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.04\'%3E%3Ccircle cx=\'30\' cy=\'30\' r=\'2\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 space-y-4">
            <span class="text-xs font-bold uppercase tracking-widest text-blue-200 bg-white/10 px-4 py-1.5 rounded-full border border-white/20 backdrop-blur-md inline-block">
                Join Our Team
            </span>
            <h1 class="text-3xl sm:text-5xl font-extrabold text-white font-heading tracking-tight">
                Build Your Career at YONBUS
            </h1>
            <p class="text-blue-100/90 text-base sm:text-lg max-w-2xl mx-auto font-normal leading-relaxed">
                We're always looking for talented, driven professionals to join our growing accounting and tax team across Canada.
            </p>
        </div>
    </section>

    <section style="background: #ffffff; padding: 5rem 0; border-top: 4px solid #005DFF;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div style="margin-bottom: 2rem; padding: 16px 20px; background: #ECFDF5; border: 2px solid #6EE7B7; color: #065F46; border-radius: 16px; text-align: center; font-weight: 700; font-size: 0.95rem;">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

                {{-- LEFT: Why Join YONBUS --}}
                <div class="lg:col-span-5 space-y-6">
                    <div style="background:#ffffff; border: 2px solid #CBD5E1; border-radius: 24px; padding: 32px; box-shadow: 0 8px 32px rgba(37,99,235,0.08); display: flex; flex-direction: column; gap: 24px;">
                        <h2 class="font-heading font-bold" style="font-size: 1.4rem; color: #031B4E; margin-bottom: 0.5rem; padding-bottom: 0.75rem; border-bottom: 2px solid #F1F5F9;">
                            WHY JOIN YONBUS?
                        </h2>

                        <div style="display: flex; flex-direction: column; gap: 20px;">
                            <div style="display: flex; align-items: flex-start; gap: 14px;">
                                <div style="width: 44px; height: 44px; border-radius: 12px; background: #F1F5F9; border: 2px solid #CBD5E1; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0;">🏆</div>
                                <div>
                                    <div style="font-weight: 800; color: #031B4E; font-size: 0.95rem; margin-bottom: 2px;">Professional Growth</div>
                                    <div style="color: #475569; font-size: 0.88rem; line-height: 1.5;">Ongoing training, CPD support, and clear career advancement pathways.</div>
                                </div>
                            </div>

                            <div style="display: flex; align-items: flex-start; gap: 14px;">
                                <div style="width: 44px; height: 44px; border-radius: 12px; background: #F1F5F9; border: 2px solid #CBD5E1; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0;">🤝</div>
                                <div>
                                    <div style="font-weight: 800; color: #031B4E; font-size: 0.95rem; margin-bottom: 2px;">Collaborative Culture</div>
                                    <div style="color: #475569; font-size: 0.88rem; line-height: 1.5;">A supportive, team-first environment where your voice and ideas matter.</div>
                                </div>
                            </div>

                            <div style="display: flex; align-items: flex-start; gap: 14px;">
                                <div style="width: 44px; height: 44px; border-radius: 12px; background: #F1F5F9; border: 2px solid #CBD5E1; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0;">📍</div>
                                <div>
                                    <div style="font-weight: 800; color: #031B4E; font-size: 0.95rem; margin-bottom: 2px;">Office Location</div>
                                    <div style="color: #475569; font-size: 0.88rem; line-height: 1.5;">Based in Gatineau, Quebec — serving clients across Canada.</div>
                                </div>
                            </div>

                            <div style="display: flex; align-items: flex-start; gap: 14px;">
                                <div style="width: 44px; height: 44px; border-radius: 12px; background: #F1F5F9; border: 2px solid #CBD5E1; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0;">✉️</div>
                                <div>
                                    <div style="font-weight: 800; color: #031B4E; font-size: 0.95rem; margin-bottom: 2px;">Contact HR Team</div>
                                    <a href="mailto:careers@yonbustax.ca" style="color: #005DFF; font-size: 0.9rem; font-weight: 600; text-decoration: none;">careers@yonbustax.ca</a>
                                </div>
                            </div>
                        </div>

                        <div style="border-top: 2px solid #F1F5F9; padding-top: 16px; font-size: 0.85rem; color: #64748b; font-weight: 500;">
                            🇨🇦 Equal opportunity employer — all qualified backgrounds welcome
                        </div>
                    </div>

                    {{-- Open Positions --}}
                    <div style="background: #F1F5F9; border: 2px solid #CBD5E1; border-radius: 20px; padding: 24px;">
                        <h3 class="font-heading font-bold" style="color: #031B4E; font-size: 1.1rem; margin-bottom: 16px;">Current Openings</h3>
                        <div style="display: flex; flex-direction: column; gap: 10px;">
                            @foreach([
                                ['title' => 'Tax Associate', 'type' => 'Full-Time', 'badge' => '#DCFCE7', 'text' => '#166534'],
                                ['title' => 'Bookkeeper / Accountant', 'type' => 'Full-Time', 'badge' => '#DCFCE7', 'text' => '#166534'],
                                ['title' => 'Payroll Administrator', 'type' => 'Full-Time', 'badge' => '#DCFCE7', 'text' => '#166534'],
                                ['title' => 'Administrative Assistant', 'type' => 'Part-Time', 'badge' => '#FEF9C3', 'text' => '#854D0E'],
                            ] as $pos)
                            <div style="display: flex; align-items: center; justify-content: space-between; padding: 12px 14px; background: #ffffff; border: 1.5px solid #CBD5E1; border-radius: 12px;">
                                <div>
                                    <div style="font-weight: 700; color: #031B4E; font-size: 0.9rem;">{{ $pos['title'] }}</div>
                                </div>
                                <span style="font-size: 10px; font-weight: 800; background: {{ $pos['badge'] }}; color: {{ $pos['text'] }}; padding: 4px 10px; border-radius: 999px;">{{ $pos['type'] }}</span>
                            </div>
                            @endforeach
                        </div>
                        <p style="color: #64748b; font-size: 0.82rem; margin-top: 14px; line-height: 1.5;">Don't see a fit? Send a general application — we review all submissions.</p>
                    </div>
                </div>

                {{-- RIGHT: Application Form --}}
                <div class="lg:col-span-7">
                    <div style="background: #ffffff; border: 2px solid #CBD5E1; border-radius: 24px; padding: 36px; box-shadow: 0 8px 40px rgba(37,99,235,0.10);">
                        <h2 class="font-heading font-bold" style="color: #031B4E; font-size: 1.5rem; margin-bottom: 8px;">Submit Your Application</h2>
                        <p style="color: #64748b; font-size: 0.9rem; margin-bottom: 24px;">Join our growing team in Gatineau, QC. Complete the application form below.</p>
                        
                        <form action="{{ route('careers.submit') }}" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 18px;">
                            @csrf

                            {{-- Name + Email --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label style="display: block; font-size: 11px; font-weight: 800; text-transform: uppercase; color: #031B4E; letter-spacing: 0.06em; margin-bottom: 6px;">Full Name *</label>
                                    <input type="text" name="name" required value="{{ old('name') }}"
                                           style="width: 100%; padding: 12px 16px; border-radius: 12px; border: 2px solid #CBD5E1; font-size: 0.9rem; color: #031B4E; background: #ffffff; outline: none; box-sizing: border-box;"
                                           placeholder="Jane Smith"
                                           onfocus="this.style.borderColor='#005DFF';"
                                           onblur="this.style.borderColor='#CBD5E1';">
                                    @error('name')<p style="color:#dc2626;font-size:0.8rem;margin-top:4px;">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label style="display: block; font-size: 11px; font-weight: 800; text-transform: uppercase; color: #031B4E; letter-spacing: 0.06em; margin-bottom: 6px;">Email Address *</label>
                                    <input type="email" name="email" required value="{{ old('email') }}"
                                           style="width: 100%; padding: 12px 16px; border-radius: 12px; border: 2px solid #CBD5E1; font-size: 0.9rem; color: #031B4E; background: #ffffff; outline: none; box-sizing: border-box;"
                                           placeholder="jane@example.com"
                                           onfocus="this.style.borderColor='#005DFF';"
                                           onblur="this.style.borderColor='#CBD5E1';">
                                    @error('email')<p style="color:#dc2626;font-size:0.8rem;margin-top:4px;">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            {{-- Phone + Position --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label style="display: block; font-size: 11px; font-weight: 800; text-transform: uppercase; color: #031B4E; letter-spacing: 0.06em; margin-bottom: 6px;">Phone Number</label>
                                    <input type="text" name="phone" value="{{ old('phone') }}"
                                           style="width: 100%; padding: 12px 16px; border-radius: 12px; border: 2px solid #CBD5E1; font-size: 0.9rem; color: #031B4E; background: #ffffff; outline: none; box-sizing: border-box;"
                                           placeholder="+1 (438) 000-0000"
                                           onfocus="this.style.borderColor='#005DFF';"
                                           onblur="this.style.borderColor='#CBD5E1';">
                                </div>
                                <div>
                                    <label style="display: block; font-size: 11px; font-weight: 800; text-transform: uppercase; color: #031B4E; letter-spacing: 0.06em; margin-bottom: 6px;">Position Applied For *</label>
                                    <select name="position" required
                                            style="width: 100%; padding: 12px 16px; border-radius: 12px; border: 2px solid #CBD5E1; font-size: 0.9rem; color: #031B4E; background: #ffffff; outline: none;"
                                            onfocus="this.style.borderColor='#005DFF';"
                                            onblur="this.style.borderColor='#CBD5E1';">
                                        <option value="">Select a position...</option>
                                        <option value="Tax Associate" {{ old('position') == 'Tax Associate' ? 'selected' : '' }}>Tax Associate</option>
                                        <option value="Bookkeeper / Accountant" {{ old('position') == 'Bookkeeper / Accountant' ? 'selected' : '' }}>Bookkeeper / Accountant</option>
                                        <option value="Payroll Administrator" {{ old('position') == 'Payroll Administrator' ? 'selected' : '' }}>Payroll Administrator</option>
                                        <option value="Administrative Assistant" {{ old('position') == 'Administrative Assistant' ? 'selected' : '' }}>Administrative Assistant</option>
                                        <option value="General Application" {{ old('position') == 'General Application' ? 'selected' : '' }}>General Application</option>
                                    </select>
                                    @error('position')<p style="color:#dc2626;font-size:0.8rem;margin-top:4px;">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            {{-- Experience --}}
                            <div>
                                <label style="display: block; font-size: 11px; font-weight: 800; text-transform: uppercase; color: #031B4E; letter-spacing: 0.06em; margin-bottom: 6px;">Years of Experience *</label>
                                <select name="experience" required
                                        style="width: 100%; padding: 12px 16px; border-radius: 12px; border: 2px solid #CBD5E1; font-size: 0.9rem; color: #031B4E; background: #ffffff; outline: none;"
                                        onfocus="this.style.borderColor='#005DFF';"
                                        onblur="this.style.borderColor='#CBD5E1';">
                                    <option value="">Select experience level...</option>
                                    <option value="0-1 years" {{ old('experience') == '0-1 years' ? 'selected' : '' }}>0 – 1 years (Entry Level)</option>
                                    <option value="2-3 years" {{ old('experience') == '2-3 years' ? 'selected' : '' }}>2 – 3 years</option>
                                    <option value="4-6 years" {{ old('experience') == '4-6 years' ? 'selected' : '' }}>4 – 6 years</option>
                                    <option value="7+ years" {{ old('experience') == '7+ years' ? 'selected' : '' }}>7+ years (Senior)</option>
                                </select>
                                @error('experience')<p style="color:#dc2626;font-size:0.8rem;margin-top:4px;">{{ $message }}</p>@enderror
                            </div>

                            {{-- Cover Letter --}}
                            <div>
                                <label style="display: block; font-size: 11px; font-weight: 800; text-transform: uppercase; color: #031B4E; letter-spacing: 0.06em; margin-bottom: 6px;">Cover Letter / Message *</label>
                                <textarea name="message" rows="5" required
                                          style="width: 100%; padding: 12px 16px; border-radius: 12px; border: 2px solid #CBD5E1; font-size: 0.9rem; color: #031B4E; background: #ffffff; outline: none; resize: vertical;"
                                          placeholder="Tell us about yourself, your experience, and why you'd like to join YONBUS..."
                                          onfocus="this.style.borderColor='#005DFF';"
                                          onblur="this.style.borderColor='#CBD5E1';">{{ old('message') }}</textarea>
                                @error('message')<p style="color:#dc2626;font-size:0.8rem;margin-top:4px;">{{ $message }}</p>@enderror
                            </div>

                            {{-- Resume Upload --}}
                            <div>
                                <label style="display: block; font-size: 11px; font-weight: 800; text-transform: uppercase; color: #031B4E; letter-spacing: 0.06em; margin-bottom: 6px;">Attach Resume / CV <span style="color:#64748b;font-weight:500;text-transform:none;">(PDF, DOC, DOCX — max 5MB)</span></label>
                                <input type="file" name="resume" accept=".pdf,.doc,.docx"
                                       style="width: 100%; padding: 10px 14px; border-radius: 12px; border: 2px dashed #CBD5E1; font-size: 0.88rem; color: #031B4E; background: #F1F5F9; cursor: pointer;">
                                @error('resume')<p style="color:#dc2626;font-size:0.8rem;margin-top:4px;">{{ $message }}</p>@enderror
                            </div>

                            <button type="submit"
                                    style="width: 100%; padding: 15px; background: #005DFF; color: #ffffff; font-weight: 800; font-size: 1rem; border-radius: 14px; border: none; cursor: pointer; box-shadow: 0 8px 24px rgba(37,99,235,0.35); transition: all 0.2s;"
                                    onmouseenter="this.style.background='#031B4E'; this.style.boxShadow='0 12px 32px rgba(37,99,235,0.45)'; this.style.transform='translateY(-1px)';"
                                    onmouseleave="this.style.background='#005DFF'; this.style.boxShadow='0 8px 24px rgba(37,99,235,0.35)'; this.style.transform='translateY(0)';">
                                💼 Submit Application
                            </button>

                            <p style="color: #64748b; font-size: 0.8rem; text-align: center;">We review all applications and will reach out within 5 business days.</p>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
</x-public-layout>
