<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Account – YONBUS Tax & Accounting Services</title>
    <meta name="description" content="Create your YONBUS account and start managing your taxes, bookkeeping and accounting today.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html, body { min-height: 100vh; font-family: 'Inter', sans-serif; }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, rgba(10, 22, 50, 0.85) 0%, rgba(15, 23, 42, 0.92) 100%),
                        url('/images/auth-bg.png') center / cover no-repeat fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 20px;
            color: #031B4E;
        }

        .auth-wrapper {
            width: 100%;
            max-width: 1100px;
            display: grid;
            grid-template-columns: 44% 56%;
            gap: 36px;
            align-items: center;
            margin: auto;
        }

        @keyframes cardEntrance {
            0% {
                opacity: 0;
                transform: translateY(24px) scale(0.97);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* ── LEFT PANEL (Glassmorphism over Image BG) ── */
        .left-panel {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 28px;
            padding: 40px;
            display: flex;
            flex-direction: column;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
            animation: cardEntrance 0.55s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .panel-logo-wrap {
            margin-bottom: 28px;
        }
        .official-logo-img {
            width: 100%;
            max-width: 270px;
            height: auto;
            border-radius: 16px;
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.3);
            background: #fff;
            padding: 10px 18px;
            display: block;
        }

        /* Card Top Brand Logo */
        .card-brand-logo-wrap {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 1px solid #E2EAF4;
        }
        .card-logo-img {
            width: 100%;
            max-width: 280px;
            height: auto;
            object-fit: contain;
            display: inline-block;
        }

        .feature-cards { display: flex; flex-direction: column; gap: 12px; margin-bottom: 32px; }
        .feature-card {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.14);
            border-radius: 16px;
            padding: 16px 18px;
            display: flex;
            align-items: center;
            gap: 14px;
            transition: background 0.2s;
        }
        .feature-card:hover { background: rgba(255, 255, 255, 0.12); }
        .feature-icon {
            width: 38px; height: 38px;
            background: rgba(0, 163, 255, 0.2);
            border: 1px solid rgba(0, 163, 255, 0.3);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }
        .feature-title { font-size: 13px; font-weight: 700; color: #fff; margin-bottom: 2px; }
        .feature-desc { font-size: 12px; color: rgba(255, 255, 255, 0.65); line-height: 1.4; }

        .panel-headline { font-size: 26px; font-weight: 800; color: #fff; line-height: 1.3; margin-bottom: 10px; letter-spacing: -0.4px; }
        .panel-sub { font-size: 13px; color: rgba(255, 255, 255, 0.75); line-height: 1.6; margin-bottom: 20px; }

        .trust-list { display: flex; flex-direction: column; gap: 10px; }
        .trust-item { display: flex; align-items: center; gap: 10px; }
        .trust-check {
            width: 22px; height: 22px;
            background: rgba(0, 163, 255, 0.2);
            border: 1px solid rgba(0, 163, 255, 0.4);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 11px; color: #38bdf8; flex-shrink: 0; font-weight: 700;
        }
        .trust-item span { font-size: 13px; color: rgba(255, 255, 255, 0.9); font-weight: 500; }

        /* ── RIGHT PANEL (Auth Card) ── */
        .auth-card {
            width: 100%;
            background: #ffffff;
            border-radius: 28px;
            padding: 38px 40px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.35);
            border: 1px solid rgba(255, 255, 255, 0.8);
            animation: cardEntrance 0.65s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .card-eyebrow { font-size: 12px; font-weight: 700; color: #005DFF; text-transform: uppercase; letter-spacing: 1.2px; margin-bottom: 6px; }
        .card-title { font-size: 24px; font-weight: 800; color: #031B4E; margin-bottom: 6px; letter-spacing: -0.4px; }
        .card-sub { font-size: 13px; color: #64748B; margin-bottom: 24px; }

        .form-row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
        .form-group { margin-bottom: 16px; }
        .form-label { display: block; font-size: 13px; font-weight: 600; color: #031B4E; margin-bottom: 5px; }
        .form-input {
            width: 100%;
            padding: 12px 15px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            color: #031B4E;
            background: #FFFFFF;
            border: 1.5px solid #D1DCF0;
            border-radius: 12px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-input::placeholder { color: #64748b; }
        .form-input:focus { border-color: #005DFF; box-shadow: 0 0 0 4px rgba(0, 93, 255, 0.1); background: #fff; }
        .form-input.is-error { border-color: #ef4444; }
        .form-error { font-size: 12px; color: #ef4444; margin-top: 4px; }

        .pw-wrap { position: relative; }
        .pw-toggle {
            position: absolute; right: 13px; top: 50%; transform: translateY(-50%);
            background: none; border: none; cursor: pointer; color: #64748b;
            display: flex; align-items: center; padding: 4px;
        }
        .pw-toggle:hover { color: #005DFF; }

        .pw-strength { margin-top: 6px; }
        .pw-strength-bars { display: flex; gap: 4px; margin-bottom: 4px; }
        .pw-bar { flex: 1; height: 4px; background: #E2EAF4; border-radius: 2px; transition: background 0.3s; }
        .pw-bar.weak { background: #f87171; }
        .pw-bar.fair { background: #fb923c; }
        .pw-bar.good { background: #facc15; }
        .pw-bar.strong { background: #4ade80; }
        .pw-strength-label { font-size: 11px; color: #64748b; }

        .terms-row { display: flex; align-items: flex-start; gap: 10px; margin-bottom: 20px; margin-top: 4px; }
        .terms-row input[type="checkbox"] { width: 17px; height: 17px; margin-top: 2px; accent-color: #005DFF; flex-shrink: 0; cursor: pointer; }
        .terms-row label { font-size: 13px; color: #031B4E; line-height: 1.5; cursor: pointer; }
        .terms-row label a { color: #005DFF; font-weight: 600; text-decoration: none; }
        .terms-row label a:hover { text-decoration: underline; }

        .btn-submit {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #031B4E 0%, #005DFF 100%);
            color: #fff;
            font-size: 15px;
            font-weight: 700;
            font-family: 'Inter', sans-serif;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 4px 16px rgba(0, 93, 255, 0.35);
            margin-bottom: 18px;
        }
        .btn-submit:hover { opacity: 0.94; transform: translateY(-1px); box-shadow: 0 6px 22px rgba(0, 93, 255, 0.45); }

        .divider { display: flex; align-items: center; gap: 12px; margin-bottom: 18px; }
        .divider-line { flex: 1; height: 1px; background: #E2EAF4; }
        .divider-text { font-size: 12px; color: #64748b; font-weight: 500; white-space: nowrap; }

        .social-buttons { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 20px; }
        .btn-social {
            display: flex; align-items: center; justify-content: center; gap: 8px;
            padding: 11px;
            background: #fff;
            border: 1.5px solid #D1DCF0;
            border-radius: 12px;
            font-size: 13px; font-weight: 600; font-family: 'Inter', sans-serif;
            color: #031B4E;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-social:hover { background: #FFFFFF; border-color: #005DFF; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05); }

        .auth-footer { text-align: center; font-size: 14px; color: #64748B; }
        .auth-footer a { color: #005DFF; font-weight: 700; text-decoration: none; }
        .auth-footer a:hover { text-decoration: underline; }

        /* ── RESPONSIVE ── */
        @media (max-width: 992px) {
            .auth-wrapper { grid-template-columns: 1fr; max-width: 540px; }
            .left-panel { display: none; }
            .auth-card { padding: 32px 24px; }
        }
        @media (max-width: 540px) {
            body { padding: 16px 12px; }
            .auth-card { padding: 26px 18px; border-radius: 20px; }
            .form-row-2 { grid-template-columns: 1fr; }
            .social-buttons { grid-template-columns: 1fr; }
            .card-logo-img { max-width: 220px; }
        }
    </style>
</head>
<body>

<div class="auth-wrapper">
    <!-- LEFT PANEL -->
    <div class="left-panel">
        <div class="panel-logo-wrap">
            <a href="{{ route('home') }}" style="display:inline-block;">
                <img src="/images/yonbus-logo.jpg" alt="YONBUS Tax & Accounting Services Inc." class="official-logo-img" style="cursor:pointer;">
            </a>
        </div>

        <div class="feature-cards">
            <div class="feature-card">
                <div class="feature-icon">🧾</div>
                <div>
                    <div class="feature-title">Smart Tax Filing</div>
                    <div class="feature-desc">Automated tax preparation & e-filing with expert review.</div>
                </div>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📊</div>
                <div>
                    <div class="feature-title">Real-Time Bookkeeping</div>
                    <div class="feature-desc">Live financial tracking, reconciliation and reporting.</div>
                </div>
            </div>
            <div class="feature-card">
                <div class="feature-icon">👥</div>
                <div>
                    <div class="feature-title">Payroll Management</div>
                    <div class="feature-desc">End-to-end payroll processing with full compliance.</div>
                </div>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📅</div>
                <div>
                    <div class="feature-title">Appointment Booking</div>
                    <div class="feature-desc">Schedule consultations with certified tax professionals.</div>
                </div>
            </div>
        </div>

        <h2 class="panel-headline">Manage Your Taxes &<br>Accounting in One Place</h2>
        <p class="panel-sub">Secure bookkeeping, tax filing, invoicing, document management, and appointment booking.</p>
        
        <div class="trust-list">
            <div class="trust-item"><div class="trust-check">✓</div><span>Secure Platform — Bank-grade encryption</span></div>
            <div class="trust-item"><div class="trust-check">✓</div><span>Tax Experts — Certified professionals</span></div>
            <div class="trust-item"><div class="trust-check">✓</div><span>Cloud-Based Access — Anywhere, anytime</span></div>
        </div>
    </div>

    <!-- RIGHT PANEL (Register Form Card) -->
    <div class="auth-card">
        <!-- Official Wide YONBUS Logo Image in Card -->
        <div class="card-brand-logo-wrap">
            <a href="{{ route('home') }}" style="display:inline-block;">
                <img src="/images/yonbus-logo.jpg" alt="YONBUS Tax & Accounting Services Inc." class="card-logo-img" style="cursor:pointer;">
            </a>
        </div>

        <div class="card-eyebrow">Get Started Free</div>
        <h1 class="card-title">Create your account</h1>
        <p class="card-sub">Join 5,000+ businesses managing their finances with YONBUS.</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-row-2">
                <div class="form-group">
                    <label class="form-label" for="name">Full Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}"
                        class="form-input {{ $errors->has('name') ? 'is-error' : '' }}"
                        placeholder="John Doe" required autofocus autocomplete="name">
                    @error('name')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="company_name">Company Name</label>
                    <input id="company_name" type="text" name="company_name" value="{{ old('company_name') }}"
                        class="form-input"
                        placeholder="Acme Corp" autocomplete="organization">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="email">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                    class="form-input {{ $errors->has('email') ? 'is-error' : '' }}"
                    placeholder="you@company.com" required autocomplete="username">
                @error('email')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="phone">Phone Number</label>
                <input id="phone" type="tel" name="phone" value="{{ old('phone') }}"
                    class="form-input"
                    placeholder="+234 800 000 0000" autocomplete="tel">
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <div class="pw-wrap">
                    <input id="password" type="password" name="password"
                        class="form-input {{ $errors->has('password') ? 'is-error' : '' }}"
                        placeholder="Create a strong password" required autocomplete="new-password"
                        oninput="checkStrength(this.value)">
                    <button type="button" class="pw-toggle" onclick="togglePw('password',this)">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    </button>
                </div>
                <div class="pw-strength">
                    <div class="pw-strength-bars">
                        <div class="pw-bar" id="bar1"></div>
                        <div class="pw-bar" id="bar2"></div>
                        <div class="pw-bar" id="bar3"></div>
                        <div class="pw-bar" id="bar4"></div>
                    </div>
                    <span class="pw-strength-label" id="pwLabel">Use 8+ characters, numbers &amp; symbols</span>
                </div>
                @error('password')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="password_confirmation">Confirm Password</label>
                <div class="pw-wrap">
                    <input id="password_confirmation" type="password" name="password_confirmation"
                        class="form-input {{ $errors->has('password_confirmation') ? 'is-error' : '' }}"
                        placeholder="Re-enter your password" required autocomplete="new-password">
                    <button type="button" class="pw-toggle" onclick="togglePw('password_confirmation',this)">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    </button>
                </div>
                @error('password_confirmation')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="terms-row">
                <input type="checkbox" id="terms" name="terms" required>
                <label for="terms">I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></label>
            </div>

            <button type="submit" class="btn-submit">Create Account →</button>
        </form>

        <div class="divider">
            <div class="divider-line"></div>
            <span class="divider-text">or sign up with</span>
            <div class="divider-line"></div>
        </div>

        <div class="social-buttons" style="grid-template-columns: 1fr;">
            <button class="btn-social" type="button" style="width: 100%; justify-content: center;">
                <svg width="17" height="17" viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
                Sign up with Google
            </button>
        </div>

        <div class="auth-footer">
            Already have an account? <a href="{{ route('login') }}">Sign In</a>
        </div>
    </div>
</div>

<script>
    function togglePw(id, btn) {
        const input = document.getElementById(id);
        const isText = input.type === 'text';
        input.type = isText ? 'password' : 'text';
        btn.style.color = isText ? '' : '#005DFF';
    }

    function checkStrength(val) {
        const bars = ['bar1','bar2','bar3','bar4'];
        const label = document.getElementById('pwLabel');
        let score = 0;
        if (val.length >= 8) score++;
        if (/[A-Z]/.test(val)) score++;
        if (/[0-9]/.test(val)) score++;
        if (/[^A-Za-z0-9]/.test(val)) score++;

        const levels = ['','weak','fair','good','strong'];
        const labels = ['Use 8+ characters, numbers & symbols','Weak — add uppercase letters','Fair — add a number','Good — add a symbol','Strong password ✓'];
        bars.forEach((b, i) => {
            const el = document.getElementById(b);
            el.className = 'pw-bar';
            if (i < score) el.classList.add(levels[score]);
        });
        label.textContent = labels[score];
    }
</script>
</body>
</html>
