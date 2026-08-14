<x-public-layout>
    <x-slot name="title">Careers | YONBUS Tax & Accounting Services Inc.</x-slot>

    {{-- Header Banner --}}
    <section class="bg-gradient-to-r from-slate-900 via-[#002B8A] to-[#005DFF] text-white py-20" data-aos="fade-down">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
            <span class="text-xs font-bold uppercase tracking-widest text-blue-200 bg-white/10 px-3.5 py-1.5 rounded-full border border-white/20">Join Our Team</span>
            <h1 class="font-heading font-extrabold text-4xl sm:text-5xl">
                Build Your Career at YONBUS
            </h1>
            <p class="text-blue-100 text-lg max-w-2xl mx-auto font-light">
                We're always looking for talented, driven professionals to join our growing accounting and tax team. Apply below and let's shape Canada's financial future together.
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

                {{-- LEFT: Why Join YONBUS --}}
                <div class="lg:col-span-5 space-y-6">
                    <div style="background: #002B8A; border-radius: 24px; padding: 32px; color: #ffffff; display: flex; flex-direction: column; gap: 24px;">
                        <h2 class="font-heading font-bold" style="font-size: 1.5rem; color: #ffffff;">WHY JOIN YONBUS?</h2>

                        <div style="display: flex; flex-direction: column; gap: 20px;">
                            <div style="display: flex; align-items: flex-start; gap: 14px;">
                                <div style="width: 42px; height: 42px; border-radius: 12px; background: rgba(255,255,255,0.15); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0;">🏆</div>
                                <div>
                                    <div style="font-weight: 700; color: #ffffff; font-size: 0.95rem; margin-bottom: 2px;">Professional Growth</div>
                                    <div style="color: #bfdbfe; font-size: 0.88rem; line-height: 1.5;">Ongoing training, CPD support, and clear career advancement pathways.</div>
                                </div>
                            </div>

                            <div style="display: flex; align-items: flex-start; gap: 14px;">
                                <div style="width: 42px; height: 42px; border-radius: 12px; background: rgba(255,255,255,0.15); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0;">🤝</div>
                                <div>
                                    <div style="font-weight: 700; color: #ffffff; font-size: 0.95rem; margin-bottom: 2px;">Collaborative Culture</div>
                                    <div style="color: #bfdbfe; font-size: 0.88rem; line-height: 1.5;">A supportive, team-first environment where your voice matters.</div>
                                </div>
                            </div>

                            <div style="display: flex; align-items: flex-start; gap: 14px;">
                                <div style="width: 42px; height: 42px; border-radius: 12px; background: rgba(255,255,255,0.15); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0;">📍</div>
                                <div>
                                    <div style="font-weight: 700; color: #ffffff; font-size: 0.95rem; margin-bottom: 2px;">Location</div>
                                    <div style="color: #bfdbfe; font-size: 0.88rem; line-height: 1.5;">Based in Gatineau, Quebec — serving clients across Canada.</div>
                                </div>
                            </div>

                            <div style="display: flex; align-items: flex-start; gap: 14px;">
                                <div style="width: 42px; height: 42px; border-radius: 12px; background: rgba(255,255,255,0.15); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0;">✉️</div>
                                <div>
                                    <div style="font-weight: 700; color: #ffffff; font-size: 0.95rem; margin-bottom: 2px;">Contact HR</div>
                                    <a href="mailto:careers@yonbustax.ca" style="color: #93c5fd; font-size: 0.88rem; text-decoration: none;">careers@yonbustax.ca</a>
                                </div>
                            </div>
                        </div>

                        <div style="border-top: 1px solid rgba(255,255,255,0.2); padding-top: 16px; font-size: 0.82rem; color: #bfdbfe;">
                            🇨🇦 Equal opportunity employer — all backgrounds welcome
                        </div>
                    </div>

                    {{-- Open Positions --}}
                    <div style="background: #ffffff; border: 1.5px solid #e0e7ff; border-radius: 20px; padding: 24px;">
                        <h3 class="font-heading font-bold" style="color: #0a1a4a; font-size: 1.1rem; margin-bottom: 16px;">Current Openings</h3>
                        <div style="display: flex; flex-direction: column; gap: 10px;">
                            @foreach([
                                ['title' => 'Tax Associate', 'type' => 'Full-Time', 'badge' => '#dcfce7', 'text' => '#166534'],
                                ['title' => 'Bookkeeper / Accountant', 'type' => 'Full-Time', 'badge' => '#dcfce7', 'text' => '#166534'],
                                ['title' => 'Payroll Administrator', 'type' => 'Full-Time', 'badge' => '#dcfce7', 'text' => '#166534'],
                                ['title' => 'Administrative Assistant', 'type' => 'Part-Time', 'badge' => '#fef9c3', 'text' => '#854d0e'],
                            ] as $pos)
                            <div style="display: flex; align-items: center; justify-content: space-between; padding: 12px 14px; background: #f8faff; border: 1px solid #e0e7ff; border-radius: 12px;">
                                <div>
                                    <div style="font-weight: 700; color: #0a1a4a; font-size: 0.9rem;">{{ $pos['title'] }}</div>
                                </div>
                                <span style="font-size: 10px; font-weight: 800; background: {{ $pos['badge'] }}; color: {{ $pos['text'] }}; padding: 4px 10px; border-radius: 999px;">{{ $pos['type'] }}</span>
                            </div>
                            @endforeach
                        </div>
                        <p style="color: #6b7280; font-size: 0.8rem; margin-top: 12px;">Don't see a fit? Send a general application — we review all submissions.</p>
                    </div>
                </div>

                {{-- RIGHT: Application Form --}}
                <div class="lg:col-span-7" style="background: #ffffff; border: 1.5px solid #e0e7ff; border-radius: 24px; padding: 32px 36px; box-shadow: 0 4px 20px rgba(0,82,255,0.04);">
                    <h2 class="font-heading font-bold" style="color: #0a1a4a; font-size: 1.5rem; margin-bottom: 24px;">Submit Your Application</h2>
                    <form action="{{ route('careers.submit') }}" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 18px;">
                        @csrf

                        {{-- Name + Email --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label style="display: block; font-size: 11px; font-weight: 800; text-transform: uppercase; color: #374151; margin-bottom: 6px;">Full Name *</label>
                                <input type="text" name="name" required value="{{ old('name') }}" style="width: 100%; padding: 12px 14px; border-radius: 12px; border: 1.5px solid #cbd5e1; font-size: 0.9rem; color: #1e293b;" placeholder="Jane Smith">
                                @error('name')<p style="color:#dc2626;font-size:0.8rem;margin-top:4px;">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label style="display: block; font-size: 11px; font-weight: 800; text-transform: uppercase; color: #374151; margin-bottom: 6px;">Email Address *</label>
                                <input type="email" name="email" required value="{{ old('email') }}" style="width: 100%; padding: 12px 14px; border-radius: 12px; border: 1.5px solid #cbd5e1; font-size: 0.9rem; color: #1e293b;" placeholder="jane@example.com">
                                @error('email')<p style="color:#dc2626;font-size:0.8rem;margin-top:4px;">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        {{-- Phone + Position --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label style="display: block; font-size: 11px; font-weight: 800; text-transform: uppercase; color: #374151; margin-bottom: 6px;">Phone Number</label>
                                <input type="text" name="phone" value="{{ old('phone') }}" style="width: 100%; padding: 12px 14px; border-radius: 12px; border: 1.5px solid #cbd5e1; font-size: 0.9rem; color: #1e293b;" placeholder="+1 (438) 000-0000">
                            </div>
                            <div>
                                <label style="display: block; font-size: 11px; font-weight: 800; text-transform: uppercase; color: #374151; margin-bottom: 6px;">Position Applied For *</label>
                                <select name="position" required style="width: 100%; padding: 12px 14px; border-radius: 12px; border: 1.5px solid #cbd5e1; font-size: 0.9rem; color: #374151;">
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
                            <label style="display: block; font-size: 11px; font-weight: 800; text-transform: uppercase; color: #374151; margin-bottom: 6px;">Years of Experience *</label>
                            <select name="experience" required style="width: 100%; padding: 12px 14px; border-radius: 12px; border: 1.5px solid #cbd5e1; font-size: 0.9rem; color: #374151;">
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
                            <label style="display: block; font-size: 11px; font-weight: 800; text-transform: uppercase; color: #374151; margin-bottom: 6px;">Cover Letter / Message *</label>
                            <textarea name="message" rows="5" required style="width: 100%; padding: 12px 14px; border-radius: 12px; border: 1.5px solid #cbd5e1; font-size: 0.9rem; color: #1e293b;" placeholder="Tell us about yourself, your experience, and why you'd like to join YONBUS...">{{ old('message') }}</textarea>
                            @error('message')<p style="color:#dc2626;font-size:0.8rem;margin-top:4px;">{{ $message }}</p>@enderror
                        </div>

                        {{-- Resume Upload --}}
                        <div>
                            <label style="display: block; font-size: 11px; font-weight: 800; text-transform: uppercase; color: #374151; margin-bottom: 6px;">Attach Resume / CV <span style="color:#6b7280;font-weight:500;text-transform:none;">(PDF, DOC, DOCX — max 5MB)</span></label>
                            <input type="file" name="resume" accept=".pdf,.doc,.docx" style="width: 100%; padding: 10px 14px; border-radius: 12px; border: 1.5px solid #cbd5e1; font-size: 0.88rem; color: #374151; background: #f8faff;">
                            @error('resume')<p style="color:#dc2626;font-size:0.8rem;margin-top:4px;">{{ $message }}</p>@enderror
                        </div>

                        <button type="submit" style="width: 100%; padding: 14px; background: #0052ff; color: #ffffff; font-weight: 700; font-size: 0.95rem; border-radius: 12px; border: none; cursor: pointer; box-shadow: 0 4px 14px rgba(0,82,255,0.3); transition: all 0.2s;"
                                onmouseenter="this.style.background='#003fd6';" onmouseleave="this.style.background='#0052ff';">
                            Submit Application
                        </button>

                        <p style="color: #9ca3af; font-size: 0.8rem; text-align: center;">We review all applications and will reach out within 5 business days.</p>
                    </form>
                </div>

            </div>
        </div>
    </section>
</x-public-layout>
