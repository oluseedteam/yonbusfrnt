<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign In – YONBUS Tax & Accounting Services</title>
    <meta name="description" content="Sign in to your YONBUS account to manage your taxes, bookkeeping, and accounting.">
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
            color: #1e293b;
        }

        .auth-wrapper {
            width: 100%;
            max-width: 1100px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
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

        /* ── LEFT PANEL (Glassmorphism) ── */
        .left-panel {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 28px;
            padding: 44px;
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
            max-width: 280px;
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
            margin-bottom: 24px;
            padding-bottom: 20px;
            border-bottom: 1px solid #E2EAF4;
        }
        .card-logo-img {
            width: 100%;
            max-width: 290px;
            height: auto;
            object-fit: contain;
            display: inline-block;
        }

        /* Illustration Card */
        .illustration-card {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.16);
            border-radius: 20px;
            padding: 24px;
            margin-bottom: 32px;
        }
        .illus-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 18px; }
        .illus-title { font-size: 13px; font-weight: 700; color: #fff; }
        .illus-badge { background: rgba(0, 163, 255, 0.25); border: 1px solid rgba(0, 163, 255, 0.4); color: #7dd3fc; font-size: 11px; font-weight: 600; padding: 4px 10px; border-radius: 20px; }
        
        .illus-stats { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 18px; }
        .illus-stat { background: rgba(255, 255, 255, 0.06); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 12px; padding: 14px; }
        .illus-stat-label { font-size: 11px; color: rgba(255, 255, 255, 0.6); margin-bottom: 4px; }
        .illus-stat-value { font-size: 20px; font-weight: 800; color: #fff; }
        .illus-stat-change { font-size: 11px; color: #38bdf8; font-weight: 600; margin-top: 2px; }
        .illus-stat-change.warn { color: #f87171; }

        .illus-chart { background: rgba(255, 255, 255, 0.05); border-radius: 12px; padding: 14px; }
        .illus-chart-label { font-size: 11px; color: rgba(255, 255, 255, 0.55); margin-bottom: 8px; }
        .chart-bars { display: flex; align-items: flex-end; gap: 6px; height: 44px; }
        .bar { flex: 1; border-radius: 4px 4px 0 0; background: rgba(255, 255, 255, 0.2); }
        .bar.active { background: linear-gradient(180deg, #00A3FF, #005DFF); }

        .panel-headline { font-size: 28px; font-weight: 800; color: #fff; line-height: 1.3; margin-bottom: 12px; letter-spacing: -0.4px; }
        .panel-sub { font-size: 14px; color: rgba(255, 255, 255, 0.75); line-height: 1.6; margin-bottom: 24px; }
        
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
        .trust-item span { font-size: 14px; color: rgba(255, 255, 255, 0.9); font-weight: 500; }

        /* ── RIGHT PANEL (Auth Card) ── */
        .auth-card {
            width: 100%;
            background: #ffffff;
            border-radius: 28px;
            padding: 44px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.35);
            border: 1px solid rgba(255, 255, 255, 0.8);
            animation: cardEntrance 0.65s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .card-eyebrow { font-size: 12px; font-weight: 700; color: #005DFF; text-transform: uppercase; letter-spacing: 1.2px; margin-bottom: 6px; }
        .card-title { font-size: 26px; font-weight: 800; color: #0B1F4B; margin-bottom: 6px; letter-spacing: -0.4px; }
        .card-sub { font-size: 14px; color: #64748B; margin-bottom: 24px; }

        .status-alert { background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 12px; padding: 12px 16px; font-size: 13px; color: #166534; margin-bottom: 20px; }

        .form-group { margin-bottom: 18px; }
        .form-label { display: block; font-size: 13px; font-weight: 600; color: #1E293B; margin-bottom: 6px; }
        .form-input {
            width: 100%;
            padding: 13px 16px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            color: #0B1F4B;
            background: #F8FAFC;
            border: 1.5px solid #D1DCF0;
            border-radius: 12px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-input::placeholder { color: #94A3B8; }
        .form-input:focus { border-color: #005DFF; box-shadow: 0 0 0 4px rgba(0, 93, 255, 0.1); background: #fff; }
        .form-input.is-error { border-color: #ef4444; }
        .form-error { font-size: 12px; color: #ef4444; margin-top: 5px; }

        .pw-wrap { position: relative; }
        .pw-toggle {
            position: absolute; right: 14px; top: 50%; transform: translateY(-50%);
            background: none; border: none; cursor: pointer; color: #94A3B8;
            display: flex; align-items: center; padding: 4px;
        }
        .pw-toggle:hover { color: #005DFF; }

        .form-row { display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; flex-wrap: wrap; gap: 8px; }
        .checkbox-label { display: flex; align-items: center; gap: 8px; cursor: pointer; }
        .checkbox-label input[type="checkbox"] {
            width: 18px; height: 18px;
            border: 1.5px solid #CBD5E1;
            border-radius: 5px;
            cursor: pointer;
            accent-color: #005DFF;
        }
        .checkbox-label span { font-size: 13px; color: #475569; font-weight: 500; }
        .link-forgot { font-size: 13px; font-weight: 600; color: #005DFF; text-decoration: none; }
        .link-forgot:hover { color: #002B8A; text-decoration: underline; }

        .btn-submit {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #002B8A 0%, #005DFF 100%);
            color: #fff;
            font-size: 15px;
            font-weight: 700;
            font-family: 'Inter', sans-serif;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 4px 16px rgba(0, 93, 255, 0.35);
            margin-bottom: 20px;
        }
        .btn-submit:hover { opacity: 0.94; transform: translateY(-1px); box-shadow: 0 6px 22px rgba(0, 93, 255, 0.45); }

        .divider { display: flex; align-items: center; gap: 12px; margin-bottom: 20px; }
        .divider-line { flex: 1; height: 1px; background: #E2EAF4; }
        .divider-text { font-size: 12px; color: #94A3B8; font-weight: 500; white-space: nowrap; }

        .social-buttons { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 24px; }
        .btn-social {
            display: flex; align-items: center; justify-content: center; gap: 8px;
            padding: 12px;
            background: #fff;
            border: 1.5px solid #D1DCF0;
            border-radius: 12px;
            font-size: 13px; font-weight: 600; font-family: 'Inter', sans-serif;
            color: #334155;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-social:hover { background: #F8FAFC; border-color: #005DFF; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05); }

        .auth-footer { text-align: center; font-size: 14px; color: #64748B; }
        .auth-footer a { color: #005DFF; font-weight: 700; text-decoration: none; }
        .auth-footer a:hover { text-decoration: underline; }

        /* ── RESPONSIVE ── */
        @media (max-width: 992px) {
            .auth-wrapper { grid-template-columns: 1fr; max-width: 520px; }
            .left-panel { display: none; }
            .auth-card { padding: 36px 28px; }
        }
        @media (max-width: 480px) {
            body { padding: 16px 12px; }
            .auth-card { padding: 28px 20px; border-radius: 20px; }
            .card-title { font-size: 22px; }
            .social-buttons { grid-template-columns: 1fr; }
            .card-logo-img { max-width: 220px; }
        }
    </style>
</head>
<body>

<div class="auth-wrapper">
    <!-- LEFT PANEL (Glassmorphism over Image BG) -->
    <div class="left-panel">
        <div class="panel-logo-wrap">
            <a href="{{ route('home') }}" style="display:inline-block;">
                <img src="/images/yonbus-logo.jpg" alt="YONBUS Tax & Accounting Services Inc." class="official-logo-img" style="cursor:pointer;">
            </a>
        </div>

        <div class="illustration-card">
            <div class="illus-header">
                <span class="illus-title">📊 Financial Overview</span>
                <span class="illus-badge">Live System</span>
            </div>
            <div class="illus-stats">
                <div class="illus-stat">
                    <div class="illus-stat-label">Total Revenue</div>
                    <div class="illus-stat-value">$125K</div>
                    <div class="illus-stat-change">▲ 12.5% MoM</div>
                </div>
                <div class="illus-stat">
                    <div class="illus-stat-label">Tax Due</div>
                    <div class="illus-stat-value">$4,200</div>
                    <div class="illus-stat-change warn">Due in 30d</div>
                </div>
            </div>
            <div class="illus-chart">
                <div class="illus-chart-label">Monthly Growth</div>
                <div class="chart-bars">
                    <div class="bar" style="height:35%"></div>
                    <div class="bar" style="height:50%"></div>
                    <div class="bar" style="height:40%"></div>
                    <div class="bar" style="height:70%"></div>
                    <div class="bar" style="height:60%"></div>
                    <div class="bar" style="height:85%"></div>
                    <div class="bar active" style="height:100%"></div>
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

    <!-- RIGHT PANEL (Login Form Card) -->
    <div class="auth-card">
        <!-- Official Wide YONBUS Logo Image in Card -->
        <div class="card-brand-logo-wrap">
            <a href="{{ route('home') }}" style="display:inline-block;">
                <img src="/images/yonbus-logo.jpg" alt="YONBUS Tax & Accounting Services Inc." class="card-logo-img" style="cursor:pointer;">
            </a>
        </div>

        <div class="card-eyebrow">Welcome Back</div>
        <h1 class="card-title">Sign in to your account</h1>
        <p class="card-sub">Enter your credentials to access your dashboard.</p>

        @if (session('status'))
            <div class="status-alert">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label class="form-label" for="email">Email Address</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="form-input {{ $errors->has('email') ? 'is-error' : '' }}"
                    placeholder="you@company.com"
                    required
                    autofocus
                    autocomplete="username"
                >
                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <div class="pw-wrap">
                    <input
                        id="password"
                        type="password"
                        name="password"
                        class="form-input {{ $errors->has('password') ? 'is-error' : '' }}"
                        placeholder="Enter your password"
                        required
                        autocomplete="current-password"
                    >
                    <button type="button" class="pw-toggle" onclick="togglePw('password',this)" title="Show / hide password">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    </button>
                </div>
                @error('password')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-row">
                <label class="checkbox-label">
                    <input type="checkbox" name="remember" id="remember_me">
                    <span>Remember me</span>
                </label>
                @if (Route::has('password.request'))
                    <a class="link-forgot" href="{{ route('password.request') }}">Forgot password?</a>
                @endif
            </div>

            <button type="submit" class="btn-submit">
                Sign In →
            </button>
        </form>

        <div class="divider">
            <div class="divider-line"></div>
            <span class="divider-text">or continue with</span>
            <div class="divider-line"></div>
        </div>

        <div class="social-buttons" style="grid-template-columns: 1fr;">
            <button class="btn-social" type="button" style="width: 100%; justify-content: center;">
                <svg width="18" height="18" viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
                Continue with Google
            </button>
        </div>

        <div class="auth-footer">
            Don't have an account? <a href="{{ route('register') }}">Create Account</a>
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
</script>
</body>
</html>
