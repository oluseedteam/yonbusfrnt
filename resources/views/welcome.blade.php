<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>YONBUS – Tax & Accounting Services Inc.</title>
    <meta name="description" content="All-in-one tax, bookkeeping and accounting solution to help you save time, stay compliant and grow faster.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; color: #1a1a2e; background: #fff; overflow-x: hidden; }

        /* NAV */
        nav { position: fixed; top: 0; left: 0; right: 0; z-index: 100; background: rgba(255,255,255,0.95); backdrop-filter: blur(12px); border-bottom: 1px solid #e8ecf0; }
        .nav-inner { max-width: 1200px; margin: 0 auto; padding: 0 24px; height: 70px; display: flex; align-items: center; justify-content: space-between; }
        .logo { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .logo-icon { width: 40px; height: 40px; background: #1e3a8a; border-radius: 10px; display: flex; align-items: center; justify-content: center; }
        .logo-icon svg { width: 22px; height: 22px; fill: #fff; }
        .logo-text { font-size: 18px; font-weight: 800; color: #1e3a8a; letter-spacing: -0.3px; }
        .logo-text span { color: #3b82f6; }
        .nav-links { display: flex; align-items: center; gap: 6px; }
        .nav-links a { color: #374151; text-decoration: none; font-size: 14px; font-weight: 500; padding: 8px 14px; border-radius: 8px; transition: background 0.2s; }
        .nav-links a:hover { background: #f3f4f6; color: #1e3a8a; }
        .nav-links .has-arrow::after { content: ' ▾'; font-size: 11px; }
        .nav-actions { display: flex; align-items: center; gap: 10px; }
        .btn-ghost { background: none; border: none; color: #374151; font-size: 14px; font-weight: 500; padding: 8px 16px; border-radius: 8px; cursor: pointer; transition: background 0.2s; text-decoration: none; }
        .btn-ghost:hover { background: #f3f4f6; }
        .btn-outline { background: none; border: 2px solid #1e3a8a; color: #1e3a8a; font-size: 14px; font-weight: 600; padding: 8px 18px; border-radius: 8px; cursor: pointer; transition: all 0.2s; text-decoration: none; }
        .btn-outline:hover { background: #1e3a8a; color: #fff; }
        .btn-primary { background: #1e3a8a; color: #fff; font-size: 14px; font-weight: 600; padding: 10px 20px; border-radius: 8px; border: none; cursor: pointer; transition: background 0.2s; text-decoration: none; }
        .btn-primary:hover { background: #1e40af; }

        /* HERO */
        .hero { padding: 120px 24px 80px; max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center; }
        .hero-badge { display: inline-flex; align-items: center; gap: 8px; background: #eff6ff; color: #1d4ed8; font-size: 13px; font-weight: 500; padding: 6px 14px; border-radius: 20px; margin-bottom: 24px; border: 1px solid #bfdbfe; }
        .hero-badge svg { width: 14px; height: 14px; }
        .hero h1 { font-size: 48px; font-weight: 800; line-height: 1.15; letter-spacing: -1px; color: #0f172a; margin-bottom: 20px; }
        .hero h1 .blue { color: #2563eb; }
        .hero p { font-size: 16px; color: #64748b; line-height: 1.7; margin-bottom: 28px; max-width: 480px; }
        .hero-checks { display: flex; flex-wrap: wrap; gap: 12px 24px; margin-bottom: 36px; }
        .hero-check { display: flex; align-items: center; gap: 8px; font-size: 14px; font-weight: 500; color: #374151; }
        .hero-check .check-icon { width: 18px; height: 18px; background: #2563eb; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .hero-check .check-icon svg { width: 10px; height: 10px; fill: none; stroke: #fff; stroke-width: 2.5; }
        .hero-btns { display: flex; gap: 14px; margin-bottom: 40px; flex-wrap: wrap; }
        .btn-hero { display: inline-flex; align-items: center; gap: 8px; background: #1e3a8a; color: #fff; font-size: 15px; font-weight: 600; padding: 14px 28px; border-radius: 10px; text-decoration: none; transition: background 0.2s, transform 0.15s; }
        .btn-hero:hover { background: #1e40af; transform: translateY(-1px); }
        .btn-hero-outline { display: inline-flex; align-items: center; gap: 8px; background: #fff; color: #1e3a8a; font-size: 15px; font-weight: 600; padding: 14px 28px; border-radius: 10px; text-decoration: none; border: 2px solid #c7d2fe; transition: all 0.2s; }
        .btn-hero-outline:hover { border-color: #1e3a8a; background: #eff6ff; }
        .hero-social { display: flex; align-items: center; gap: 12px; }
        .hero-avatars { display: flex; }
        .hero-avatars img, .hero-avatars .av { width: 32px; height: 32px; border-radius: 50%; border: 2px solid #fff; margin-left: -8px; }
        .hero-avatars .av:first-child { margin-left: 0; }
        .hero-avatars .av { background: linear-gradient(135deg,#667eea,#764ba2); display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 700; color: #fff; }
        .hero-stars { color: #f59e0b; font-size: 16px; letter-spacing: 1px; }
        .hero-rating-text { font-size: 13px; color: #64748b; font-weight: 500; }

        /* DASHBOARD MOCKUP */
        .hero-visual { position: relative; }
        .dashboard-card { background: #fff; border-radius: 16px; box-shadow: 0 25px 60px rgba(30,58,138,0.15), 0 4px 20px rgba(0,0,0,0.08); overflow: hidden; border: 1px solid #e2e8f0; }
        .db-header { background: #1e3a8a; padding: 14px 20px; display: flex; align-items: center; justify-content: space-between; }
        .db-logo { display: flex; align-items: center; gap: 8px; color: #fff; font-weight: 700; font-size: 14px; }
        .db-logo-dot { width: 24px; height: 24px; background: #3b82f6; border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 10px; font-weight: 800; }
        .db-header-right { display: flex; align-items: center; gap: 10px; }
        .db-search { background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.2); border-radius: 6px; padding: 5px 12px; font-size: 12px; color: rgba(255,255,255,0.7); width: 130px; }
        .db-avatar { width: 30px; height: 30px; background: #3b82f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 700; color: #fff; }
        .db-body { display: flex; height: 340px; }
        .db-sidebar { width: 150px; background: #f8fafc; border-right: 1px solid #e2e8f0; padding: 16px 0; flex-shrink: 0; }
        .db-nav-item { display: flex; align-items: center; gap: 8px; padding: 8px 14px; font-size: 12px; color: #64748b; cursor: pointer; transition: background 0.15s; }
        .db-nav-item:hover { background: #f1f5f9; }
        .db-nav-item.active { background: #eff6ff; color: #1d4ed8; font-weight: 600; border-right: 2px solid #2563eb; }
        .db-nav-icon { width: 14px; height: 14px; background: currentColor; border-radius: 3px; opacity: 0.6; flex-shrink: 0; }
        .db-main { flex: 1; padding: 16px; overflow: hidden; }
        .db-welcome { font-size: 14px; font-weight: 700; color: #0f172a; margin-bottom: 2px; }
        .db-sub { font-size: 11px; color: #94a3b8; margin-bottom: 14px; }
        .db-stats { display: grid; grid-template-columns: repeat(4, 1fr); gap: 8px; margin-bottom: 14px; }
        .db-stat { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 10px; }
        .db-stat-label { font-size: 10px; color: #94a3b8; margin-bottom: 4px; }
        .db-stat-value { font-size: 15px; font-weight: 700; color: #0f172a; }
        .db-stat-change { font-size: 10px; color: #10b981; margin-top: 2px; }
        .db-stat-change.warn { color: #ef4444; }
        .db-chart-label { font-size: 11px; font-weight: 600; color: #374151; margin-bottom: 8px; }
        .db-chart { width: 100%; height: 70px; position: relative; background: linear-gradient(180deg,#eff6ff 0%,transparent 100%); border-radius: 6px; overflow: hidden; }
        .db-chart svg { width: 100%; height: 100%; }

        /* FLOATING CARDS */
        .float-card { position: absolute; background: #fff; border-radius: 12px; box-shadow: 0 8px 30px rgba(0,0,0,0.12); padding: 12px 16px; border: 1px solid #e2e8f0; }
        .float-card-1 { bottom: -20px; left: -30px; min-width: 180px; }
        .float-card-2 { top: 20px; right: -30px; min-width: 200px; }
        .float-label { font-size: 11px; color: #94a3b8; margin-bottom: 4px; }
        .float-value { font-size: 22px; font-weight: 800; color: #0f172a; }
        .float-change { font-size: 11px; color: #10b981; font-weight: 500; }
        .float-tag { display: inline-flex; align-items: center; gap: 5px; font-size: 12px; font-weight: 600; padding: 4px 10px; border-radius: 6px; }
        .float-tag.green { background: #d1fae5; color: #065f46; }
        .float-tag.blue { background: #dbeafe; color: #1d4ed8; }
        .float-icon { width: 32px; height: 32px; background: #eff6ff; border-radius: 8px; display: flex; align-items: center; justify-content: center; margin-bottom: 6px; }

        /* BG SHAPES */
        .hero-bg { position: absolute; top: 0; right: 0; width: 45%; height: 100%; background: linear-gradient(135deg,#eff6ff 0%,#dbeafe 100%); z-index: -1; border-radius: 0 0 0 120px; }

        /* TRUST LOGOS */
        .trust-section { background: #f8fafc; border-top: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0; padding: 36px 24px; }
        .trust-inner { max-width: 1200px; margin: 0 auto; text-align: center; }
        .trust-label { font-size: 13px; color: #94a3b8; font-weight: 500; margin-bottom: 24px; text-transform: uppercase; letter-spacing: 1px; }
        .trust-logos { display: flex; align-items: center; justify-content: center; gap: 48px; flex-wrap: wrap; }
        .trust-logo { font-size: 16px; font-weight: 700; color: #94a3b8; letter-spacing: -0.5px; transition: color 0.2s; }
        .trust-logo:hover { color: #475569; }
        .trust-logo .dot { color: #2563eb; }

        /* SERVICES */
        .services { padding: 96px 24px; max-width: 1200px; margin: 0 auto; }
        .section-tag { display: inline-block; font-size: 12px; font-weight: 700; color: #2563eb; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 12px; }
        .section-title { font-size: 36px; font-weight: 800; color: #0f172a; margin-bottom: 12px; letter-spacing: -0.5px; }
        .section-sub { font-size: 16px; color: #64748b; margin-bottom: 56px; max-width: 500px; }
        .services-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 28px; }
        @media(min-width:900px) { .services-grid { grid-template-columns: repeat(6, 1fr); } }
        .service-card { text-align: center; padding: 28px 16px; border-radius: 16px; border: 1px solid #e2e8f0; background: #fff; transition: all 0.25s; cursor: default; }
        .service-card:hover { box-shadow: 0 12px 40px rgba(30,58,138,0.1); border-color: #bfdbfe; transform: translateY(-4px); }
        .service-icon { width: 52px; height: 52px; margin: 0 auto 16px; border-radius: 14px; display: flex; align-items: center; justify-content: center; }
        .service-icon svg { width: 26px; height: 26px; }
        .service-title { font-size: 13px; font-weight: 700; color: #0f172a; margin-bottom: 8px; }
        .service-desc { font-size: 12px; color: #64748b; line-height: 1.6; }

        /* HOW IT WORKS */
        .how { background: #f8fafc; padding: 96px 24px; }
        .how-inner { max-width: 1200px; margin: 0 auto; }
        .steps-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 32px; margin-top: 56px; }
        .step-card { background: #fff; border-radius: 16px; padding: 32px; border: 1px solid #e2e8f0; position: relative; }
        .step-num { width: 40px; height: 40px; background: #1e3a8a; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 16px; font-weight: 800; color: #fff; margin-bottom: 16px; }
        .step-title { font-size: 16px; font-weight: 700; color: #0f172a; margin-bottom: 8px; }
        .step-desc { font-size: 14px; color: #64748b; line-height: 1.6; }

        /* PRICING */
        .pricing { padding: 96px 24px; max-width: 1200px; margin: 0 auto; text-align: center; }
        .pricing-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px; margin-top: 56px; max-width: 900px; margin-left: auto; margin-right: auto; }
        .price-card { background: #fff; border: 2px solid #e2e8f0; border-radius: 20px; padding: 36px; text-align: left; transition: all 0.25s; position: relative; overflow: hidden; }
        .price-card.popular { border-color: #1e3a8a; box-shadow: 0 20px 50px rgba(30,58,138,0.12); }
        .popular-badge { position: absolute; top: 20px; right: 20px; background: #1e3a8a; color: #fff; font-size: 11px; font-weight: 700; padding: 4px 12px; border-radius: 20px; }
        .price-name { font-size: 18px; font-weight: 700; color: #0f172a; margin-bottom: 6px; }
        .price-desc { font-size: 14px; color: #64748b; margin-bottom: 24px; }
        .price-amount { font-size: 40px; font-weight: 800; color: #0f172a; letter-spacing: -1px; }
        .price-amount span { font-size: 16px; color: #94a3b8; font-weight: 400; }
        .price-features { list-style: none; margin: 24px 0 32px; }
        .price-features li { display: flex; align-items: center; gap: 10px; padding: 8px 0; font-size: 14px; color: #374151; border-bottom: 1px solid #f1f5f9; }
        .price-features li:last-child { border-bottom: none; }
        .feat-check { width: 18px; height: 18px; background: #d1fae5; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 10px; color: #065f46; }
        .btn-price { width: 100%; padding: 14px; border-radius: 10px; font-size: 15px; font-weight: 600; cursor: pointer; transition: all 0.2s; border: none; }
        .btn-price-outline { background: #fff; border: 2px solid #1e3a8a; color: #1e3a8a; }
        .btn-price-outline:hover { background: #eff6ff; }
        .btn-price-fill { background: #1e3a8a; color: #fff; }
        .btn-price-fill:hover { background: #1e40af; }

        /* CTA */
        .cta { background: linear-gradient(135deg,#1e3a8a 0%,#1d4ed8 100%); padding: 96px 24px; text-align: center; }
        .cta-inner { max-width: 700px; margin: 0 auto; }
        .cta h2 { font-size: 40px; font-weight: 800; color: #fff; margin-bottom: 16px; letter-spacing: -0.5px; }
        .cta p { font-size: 17px; color: #bfdbfe; margin-bottom: 36px; }
        .cta-btns { display: flex; gap: 14px; justify-content: center; flex-wrap: wrap; }
        .btn-cta-white { background: #fff; color: #1e3a8a; font-size: 15px; font-weight: 700; padding: 14px 32px; border-radius: 10px; text-decoration: none; transition: all 0.2s; display: inline-block; }
        .btn-cta-white:hover { background: #f0f9ff; transform: translateY(-1px); }
        .btn-cta-ghost { background: rgba(255,255,255,0.1); color: #fff; font-size: 15px; font-weight: 600; padding: 14px 32px; border-radius: 10px; text-decoration: none; border: 2px solid rgba(255,255,255,0.3); transition: all 0.2s; display: inline-block; }
        .btn-cta-ghost:hover { background: rgba(255,255,255,0.2); }

        /* FOOTER */
        footer { background: #0f172a; padding: 64px 24px 32px; }
        .footer-inner { max-width: 1200px; margin: 0 auto; }
        .footer-top { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 48px; margin-bottom: 48px; }
        .footer-brand p { font-size: 14px; color: #64748b; line-height: 1.7; margin-top: 12px; max-width: 280px; }
        .footer-logo { display: flex; align-items: center; gap: 10px; }
        .footer-logo-icon { width: 36px; height: 36px; background: #1e3a8a; border-radius: 8px; display: flex; align-items: center; justify-content: center; }
        .footer-logo-text { font-size: 16px; font-weight: 800; color: #fff; }
        .footer-col h4 { font-size: 13px; font-weight: 700; color: #fff; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 16px; }
        .footer-col a { display: block; font-size: 14px; color: #64748b; text-decoration: none; margin-bottom: 10px; transition: color 0.2s; }
        .footer-col a:hover { color: #94a3b8; }
        .footer-bottom { border-top: 1px solid #1e293b; padding-top: 24px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; }
        .footer-copy { font-size: 13px; color: #475569; }
        .footer-links { display: flex; gap: 24px; }
        .footer-links a { font-size: 13px; color: #475569; text-decoration: none; }
        .footer-links a:hover { color: #94a3b8; }

        @media (max-width: 900px) {
            .hero { grid-template-columns: 1fr; padding-top: 100px; }
            .hero h1 { font-size: 36px; }
            .hero-visual { display: none; }
            .hero-bg { display: none; }
            .nav-links { display: none; }
            .services-grid { grid-template-columns: repeat(2, 1fr); }
            .footer-top { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 600px) {
            .footer-top { grid-template-columns: 1fr; }
            .trust-logos { gap: 24px; }
        }

        /* ANIMATIONS */
        .fade-in { opacity: 0; transform: translateY(20px); transition: opacity 0.6s ease, transform 0.6s ease; }
        .fade-in.visible { opacity: 1; transform: translateY(0); }
    </style>
</head>
<body>

<!-- NAV -->
<nav>
    <div class="nav-inner">
        <a href="/" class="logo">
            <div class="logo-icon">
                <svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
            </div>
            <span class="logo-text">YON<span>BUS</span></span>
        </a>
        <div class="nav-links">
            <a href="#">Home</a>
            <a href="#services" class="has-arrow">Services</a>
            <a href="#pricing">Pricing</a>
            <a href="#" class="has-arrow">Resources</a>
            <a href="#">About Us</a>
        </div>
        <div class="nav-actions">
            @if(Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn-ghost">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn-ghost">Login</a>
                    <a href="#" class="btn-outline">Book Consultation</a>
                    <a href="{{ route('register') }}" class="btn-primary">Get Started</a>
                @endauth
            @endif
        </div>
    </div>
</nav>

<!-- HERO BG SHAPE -->
<div style="position:relative; overflow:hidden;">
    <div class="hero-bg"></div>

    <div class="hero">
        <!-- LEFT -->
        <div>
            <div class="hero-badge">
                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><circle cx="7" cy="7" r="5"/><path d="M7 4v3l2 2"/></svg>
                Trusted by 5,000+ Businesses
            </div>
            <h1>Accounting Made Simple<br>For <span class="blue">Businesses</span><br>and <span class="blue">Individuals.</span></h1>
            <p>All-in-one tax, bookkeeping and accounting solution to help you save time, stay compliant and grow faster.</p>
            <div class="hero-checks">
                <div class="hero-check"><div class="check-icon"><svg viewBox="0 0 12 12"><polyline points="2,6 5,9 10,3"/></svg></div>Tax Filing</div>
                <div class="hero-check"><div class="check-icon"><svg viewBox="0 0 12 12"><polyline points="2,6 5,9 10,3"/></svg></div>Bookkeeping</div>
                <div class="hero-check"><div class="check-icon"><svg viewBox="0 0 12 12"><polyline points="2,6 5,9 10,3"/></svg></div>Payroll</div>
                <div class="hero-check"><div class="check-icon"><svg viewBox="0 0 12 12"><polyline points="2,6 5,9 10,3"/></svg></div>Financial Reports</div>
            </div>
            <div class="hero-btns">
                <a href="{{ route('register') }}" class="btn-hero">Get Started &rarr;</a>
                <a href="#" class="btn-hero-outline">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="12" height="10" rx="1"/><path d="M2 7h12"/><path d="M6 3v4M10 3v4"/></svg>
                    Book Consultation
                </a>
            </div>
            <div class="hero-social">
                <div class="hero-avatars">
                    <div class="av" style="background:linear-gradient(135deg,#667eea,#764ba2)">JD</div>
                    <div class="av" style="background:linear-gradient(135deg,#f093fb,#f5576c)">AK</div>
                    <div class="av" style="background:linear-gradient(135deg,#4facfe,#00f2fe)">SM</div>
                    <div class="av" style="background:linear-gradient(135deg,#43e97b,#38f9d7)">TR</div>
                </div>
                <div>
                    <div class="hero-stars">★★★★★</div>
                    <div class="hero-rating-text">4.9/5 from 500+ reviews</div>
                </div>
            </div>
        </div>

        <!-- RIGHT: DASHBOARD MOCKUP -->
        <div class="hero-visual">
            <div class="dashboard-card">
                <div class="db-header">
                    <div class="db-logo"><div class="db-logo-dot">Y</div> YONBUS</div>
                    <div class="db-header-right">
                        <input class="db-search" placeholder="🔍 Search..." readonly>
                        <div class="db-avatar">JD</div>
                        <span style="font-size:11px;color:rgba(255,255,255,0.8);font-weight:600">Business Owner</span>
                    </div>
                </div>
                <div class="db-body">
                    <div class="db-sidebar">
                        <div class="db-nav-item active">📊 Dashboard</div>
                        <div class="db-nav-item">📅 Appointments</div>
                        <div class="db-nav-item">📄 Documents</div>
                        <div class="db-nav-item">📋 Tax Returns</div>
                        <div class="db-nav-item">🧾 Invoices</div>
                        <div class="db-nav-item">📈 Reports</div>
                        <div class="db-nav-item">💬 Messages</div>
                        <div class="db-nav-item">⚙️ Settings</div>
                    </div>
                    <div class="db-main">
                        <div class="db-welcome">Welcome back, John 👋</div>
                        <div class="db-sub">Here's what's happening with your business today.</div>
                        <div class="db-stats">
                            <div class="db-stat">
                                <div class="db-stat-label">Revenue</div>
                                <div class="db-stat-value">$125K</div>
                                <div class="db-stat-change">+12.5%</div>
                            </div>
                            <div class="db-stat">
                                <div class="db-stat-label">Tax Due</div>
                                <div class="db-stat-value">$4,200</div>
                                <div class="db-stat-change warn">Due in 30d</div>
                            </div>
                            <div class="db-stat">
                                <div class="db-stat-label">Invoices</div>
                                <div class="db-stat-value">12</div>
                                <div class="db-stat-change warn">5 pending</div>
                            </div>
                            <div class="db-stat">
                                <div class="db-stat-label">Appt.</div>
                                <div class="db-stat-value">3</div>
                                <div class="db-stat-change">Upcoming</div>
                            </div>
                        </div>
                        <div class="db-chart-label">Revenue Overview</div>
                        <div class="db-chart">
                            <svg viewBox="0 0 300 70" preserveAspectRatio="none">
                                <defs>
                                    <linearGradient id="chartGrad" x1="0" y1="0" x2="0" y2="1">
                                        <stop offset="0%" stop-color="#2563eb" stop-opacity="0.3"/>
                                        <stop offset="100%" stop-color="#2563eb" stop-opacity="0"/>
                                    </linearGradient>
                                </defs>
                                <path d="M0,55 C40,50 60,40 90,35 C120,30 140,20 170,15 C200,10 230,8 260,5 C280,4 290,3 300,2 L300,70 L0,70 Z" fill="url(#chartGrad)"/>
                                <path d="M0,55 C40,50 60,40 90,35 C120,30 140,20 170,15 C200,10 230,8 260,5 C280,4 290,3 300,2" fill="none" stroke="#2563eb" stroke-width="2"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Floating cards -->
            <div class="float-card float-card-1">
                <div class="float-label">Revenue Report</div>
                <div class="float-value">$125,430</div>
                <div class="float-change">▲ 12.5% from last month</div>
            </div>
            <div class="float-card float-card-2">
                <div style="display:flex;align-items:center;gap:8px;margin-bottom:6px;">
                    <div style="width:24px;height:24px;background:#d1fae5;border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:12px;">✅</div>
                    <span style="font-size:12px;font-weight:700;color:#0f172a;">Tax Return Filed</span>
                </div>
                <div style="font-size:20px;font-weight:800;color:#0f172a;">2023</div>
                <div class="float-tag green" style="margin-top:4px;">✓ Successfully filed</div>
            </div>
        </div>
    </div>
</div>

<!-- TRUST LOGOS -->
<div class="trust-section">
    <div class="trust-inner">
        <div class="trust-label">Trusted by businesses of all sizes</div>
        <div class="trust-logos">
            <span class="trust-logo">≡ paystack</span>
            <span class="trust-logo">∿ flutterwave</span>
            <span class="trust-logo">◎pay</span>
            <span class="trust-logo">remita</span>
            <span class="trust-logo">d<span class="dot">·</span>local</span>
            <span class="trust-logo">Ш Wave</span>
            <span class="trust-logo">M Moniepoint</span>
        </div>
    </div>
</div>

<!-- SERVICES -->
<div id="services" class="services fade-in">
    <div style="text-align:center;">
        <span class="section-tag">OUR SERVICES</span>
        <h2 class="section-title">Comprehensive Accounting Solutions</h2>
        <p class="section-sub">From tax filing to financial reporting, we've got your business covered.</p>
    </div>
    <div class="services-grid">
        <div class="service-card">
            <div class="service-icon" style="background:#fef3c7;">
                <svg viewBox="0 0 24 24" fill="none" stroke="#d97706" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M9 9h6M9 12h6M9 15h4"/></svg>
            </div>
            <div class="service-title">Tax Services</div>
            <div class="service-desc">Tax preparation, filing and compliance for businesses and individuals.</div>
        </div>
        <div class="service-card">
            <div class="service-icon" style="background:#dbeafe;">
                <svg viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2"><path d="M2 20h20M4 20V10l8-8 8 8v10M10 20v-5h4v5"/></svg>
            </div>
            <div class="service-title">Bookkeeping</div>
            <div class="service-desc">Accurate and up-to-date bookkeeping to keep your finances in order.</div>
        </div>
        <div class="service-card">
            <div class="service-icon" style="background:#f0fdf4;">
                <svg viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="2"><circle cx="9" cy="7" r="4"/><path d="M3 21v-2a4 4 0 0 1 4-4h4"/><path d="M16 11l2 2 4-4"/></svg>
            </div>
            <div class="service-title">Payroll Management</div>
            <div class="service-desc">Complete payroll processing and management for your employees.</div>
        </div>
        <div class="service-card">
            <div class="service-icon" style="background:#fdf4ff;">
                <svg viewBox="0 0 24 24" fill="none" stroke="#9333ea" stroke-width="2"><path d="M3 3h18v18H3z"/><path d="M21 9H3M9 21V9"/></svg>
            </div>
            <div class="service-title">Financial Reporting</div>
            <div class="service-desc">Detailed financial reports and insights to help you make better decisions.</div>
        </div>
        <div class="service-card">
            <div class="service-icon" style="background:#fff1f2;">
                <svg viewBox="0 0 24 24" fill="none" stroke="#e11d48" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 3H8"/><path d="M12 3v4"/></svg>
            </div>
            <div class="service-title">Business Registration</div>
            <div class="service-desc">CAC registration, company setup and other business registration services.</div>
        </div>
        <div class="service-card">
            <div class="service-icon" style="background:#f0f9ff;">
                <svg viewBox="0 0 24 24" fill="none" stroke="#0284c7" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            </div>
            <div class="service-title">Advisory Services</div>
            <div class="service-desc">Expert financial advice to help your business grow and succeed.</div>
        </div>
    </div>
</div>

<!-- HOW IT WORKS -->
<div class="how fade-in">
    <div class="how-inner">
        <div style="text-align:center;">
            <span class="section-tag">HOW IT WORKS</span>
            <h2 class="section-title">Get Started in 3 Simple Steps</h2>
            <p class="section-sub">We've made it easy — from sign-up to your first report in minutes.</p>
        </div>
        <div class="steps-grid">
            <div class="step-card">
                <div class="step-num">1</div>
                <div class="step-title">Create Your Account</div>
                <div class="step-desc">Sign up in minutes and tell us about your business type and needs. No paperwork required.</div>
            </div>
            <div class="step-card">
                <div class="step-num">2</div>
                <div class="step-title">Connect Your Finances</div>
                <div class="step-desc">Securely link your accounts and upload documents. Our team takes it from there.</div>
            </div>
            <div class="step-card">
                <div class="step-num">3</div>
                <div class="step-title">Stay Compliant & Grow</div>
                <div class="step-desc">Get real-time reports, tax filings handled, and expert advice whenever you need it.</div>
            </div>
        </div>
    </div>
</div>

<!-- PRICING -->
<div id="pricing" class="pricing fade-in">
    <span class="section-tag">PRICING</span>
    <h2 class="section-title">Simple, Transparent Pricing</h2>
    <p class="section-sub" style="margin:0 auto 0;">Choose the plan that fits your business. No hidden fees.</p>
    <div class="pricing-grid">
        <div class="price-card">
            <div class="price-name">Starter</div>
            <div class="price-desc">Perfect for freelancers & sole traders</div>
            <div class="price-amount">₦15,000 <span>/ mo</span></div>
            <ul class="price-features">
                <li><span class="feat-check">✓</span>Tax filing (Personal)</li>
                <li><span class="feat-check">✓</span>Basic Bookkeeping</li>
                <li><span class="feat-check">✓</span>Monthly Reports</li>
                <li><span class="feat-check">✓</span>Email Support</li>
            </ul>
            <button class="btn-price btn-price-outline">Get Started</button>
        </div>
        <div class="price-card popular">
            <div class="popular-badge">Most Popular</div>
            <div class="price-name">Business</div>
            <div class="price-desc">Ideal for SMEs & growing companies</div>
            <div class="price-amount">₦45,000 <span>/ mo</span></div>
            <ul class="price-features">
                <li><span class="feat-check">✓</span>Corporate Tax Filing</li>
                <li><span class="feat-check">✓</span>Full Bookkeeping</li>
                <li><span class="feat-check">✓</span>Payroll (up to 20 staff)</li>
                <li><span class="feat-check">✓</span>CAC Registration</li>
                <li><span class="feat-check">✓</span>Priority Support</li>
            </ul>
            <button class="btn-price btn-price-fill">Get Started</button>
        </div>
        <div class="price-card">
            <div class="price-name">Enterprise</div>
            <div class="price-desc">For large organisations & groups</div>
            <div class="price-amount">Custom</div>
            <ul class="price-features">
                <li><span class="feat-check">✓</span>Everything in Business</li>
                <li><span class="feat-check">✓</span>Unlimited Payroll</li>
                <li><span class="feat-check">✓</span>Dedicated Accountant</li>
                <li><span class="feat-check">✓</span>Advisory Services</li>
                <li><span class="feat-check">✓</span>24/7 Support</li>
            </ul>
            <button class="btn-price btn-price-outline">Contact Us</button>
        </div>
    </div>
</div>

<!-- CTA -->
<div class="cta fade-in">
    <div class="cta-inner">
        <h2>Ready to Simplify Your Accounting?</h2>
        <p>Join 5,000+ businesses trusting YONBUS for their tax, bookkeeping and financial needs.</p>
        <div class="cta-btns">
            <a href="{{ route('register') }}" class="btn-cta-white">Get Started Free</a>
            <a href="#" class="btn-cta-ghost">Book a Free Consultation</a>
        </div>
    </div>
</div>

<!-- FOOTER -->
<footer>
    <div class="footer-inner">
        <div class="footer-top">
            <div class="footer-brand">
                <div class="footer-logo">
                    <div class="footer-logo-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    </div>
                    <span class="footer-logo-text">YONBUS</span>
                </div>
                <p>Tax & Accounting Services Inc. – Helping businesses and individuals stay financially compliant and grow in Nigeria and beyond.</p>
            </div>
            <div class="footer-col">
                <h4>Services</h4>
                <a href="#">Tax Services</a>
                <a href="#">Bookkeeping</a>
                <a href="#">Payroll</a>
                <a href="#">Financial Reports</a>
                <a href="#">Business Registration</a>
            </div>
            <div class="footer-col">
                <h4>Company</h4>
                <a href="#">About Us</a>
                <a href="#">Our Team</a>
                <a href="#">Careers</a>
                <a href="#">Blog</a>
                <a href="#">Contact</a>
            </div>
            <div class="footer-col">
                <h4>Legal</h4>
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
                <a href="#">Cookie Policy</a>
                <a href="#">Compliance</a>
            </div>
        </div>
        <div class="footer-bottom">
            <span class="footer-copy">© {{ date('Y') }} YONBUS Tax & Accounting Services Inc. All rights reserved.</span>
            <div class="footer-links">
                <a href="#">Privacy</a>
                <a href="#">Terms</a>
                <a href="#">Support</a>
            </div>
        </div>
    </div>
</footer>

<script>
    // Scroll fade-in animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(e => { if(e.isIntersecting) e.target.classList.add('visible'); });
    }, { threshold: 0.1 });
    document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));
</script>
</body>
</html>
