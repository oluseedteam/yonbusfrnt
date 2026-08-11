<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'YONBUS' }}</title>

    <!-- Favicon / Website Title Icon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">

    <!-- Google Fonts: Inter / Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- AOS (Framer-Motion Style Scroll Animations) -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <!-- Tailwind & Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, .font-heading { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="antialiased flex flex-col min-h-screen" style="background: #ffffff; color: #1a202c;">



    <!-- Top Header Navigation -->
    <header class="sticky top-0 z-50" style="background: #ffffff; border-bottom: 1px solid #e2e8f0; box-shadow: 0 1px 6px rgba(0,0,0,0.07);" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between" style="height: 72px;">

                <!-- Brand: Logo + Name -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 py-2 group flex-shrink-0">
                    <img src="{{ asset('images/logo.png') }}" alt="YONBUS Logo" class="w-auto object-contain transition-transform group-hover:scale-105" style="height: 40px;">
                    <div class="leading-tight">
                        <div class="font-extrabold font-heading" style="color: #0a1a4a; font-size: 15px; line-height: 1.2;">YONBUS</div>
                        <div class="font-medium" style="color: #0052ff; font-size: 10px; line-height: 1.2; letter-spacing: 0.03em;">TAX & ACCOUNTING SERVICES INC.</div>
                    </div>
                </a>

                <!-- Navigation Links (Desktop) -->
                <nav class="hidden md:flex items-center" style="gap: 1.75rem;">
                    @php
                        $navLinks = [
                            ['route' => 'home',     'label' => 'Home'],
                            ['route' => 'about',    'label' => 'About Us'],
                            ['route' => 'services', 'label' => 'Services'],
                            ['route' => 'team',     'label' => 'Team'],
                            ['route' => 'blog',     'label' => 'Blog'],
                            ['route' => 'contact',  'label' => 'Contact'],
                        ];
                    @endphp
                    @foreach($navLinks as $link)
                        @if(request()->routeIs($link['route']))
                            <a href="{{ route($link['route']) }}"
                               class="text-sm font-semibold"
                               style="color: #0052ff; border-bottom: 2px solid #0052ff; padding-bottom: 3px;">
                                {{ $link['label'] }}
                            </a>
                        @else
                            <a href="{{ route($link['route']) }}"
                               class="text-sm font-medium transition-colors"
                               style="color: #374151;"
                               onmouseenter="this.style.color='#0052ff'"
                               onmouseleave="this.style.color='#374151'">
                                {{ $link['label'] }}
                            </a>
                        @endif
                    @endforeach
                </nav>

                <!-- Header CTA Actions -->
                <div class="hidden md:flex items-center" style="gap: 0.6rem;">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-sm font-medium px-3 py-2" style="color: #374151;">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium px-3 py-2" style="color: #374151;">Login</a>
                    @endauth


                    <a href="{{ route('register') }}"
                       class="inline-flex items-center justify-center px-5 py-2 text-sm font-semibold rounded-lg transition-all transform hover:-translate-y-0.5"
                       style="background: #0052ff; color: #ffffff; box-shadow: 0 4px 12px rgba(0,82,255,0.25);">
                        Get Started
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex items-center md:hidden">
                    <button @click="open = !open" class="p-2 rounded-lg" style="color: #374151;">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div x-show="open" x-cloak @click.away="open = false" class="md:hidden px-4 pt-2 pb-5 space-y-1" style="background: #ffffff; border-top: 1px solid #e2e8f0;">
            @foreach($navLinks as $link)
                @if(request()->routeIs($link['route']))
                    <a href="{{ route($link['route']) }}" class="block px-3 py-2.5 text-base font-semibold rounded-lg" style="color: #0052ff; background: #eff6ff;">{{ $link['label'] }}</a>
                @else
                    <a href="{{ route($link['route']) }}" class="block px-3 py-2.5 text-base font-medium rounded-lg" style="color: #374151;">{{ $link['label'] }}</a>
                @endif
            @endforeach

            <div class="pt-3 flex flex-col space-y-2" style="border-top: 1px solid #e2e8f0; margin-top: 0.5rem;">
                <a href="{{ route('login') }}" class="w-full text-center py-2.5 text-sm font-semibold rounded-lg" style="color: #374151; border: 1px solid #e2e8f0;">Login</a>

                <a href="{{ route('register') }}" class="w-full text-center py-2.5 text-sm font-semibold rounded-lg" style="background: #0052ff; color: #ffffff;">Get Started</a>
            </div>
        </div>
    </header>

    <!-- Main Content Area with Page Motion Animation -->
    <main class="flex-grow animate-page-entry">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer style="position: relative; overflow: hidden; background: linear-gradient(160deg, #020c24 0%, #040f2e 50%, #010818 100%); border-top: 1px solid rgba(255,255,255,0.08);">

        <!-- Glassmorphism background orbs -->
        <div style="position: absolute; top: -80px; left: -80px; width: 340px; height: 340px; background: radial-gradient(circle, rgba(0,82,255,0.18) 0%, transparent 70%); border-radius: 50%; pointer-events: none;"></div>
        <div style="position: absolute; bottom: -60px; right: -60px; width: 280px; height: 280px; background: radial-gradient(circle, rgba(0,43,138,0.22) 0%, transparent 70%); border-radius: 50%; pointer-events: none;"></div>
        <div style="position: absolute; top: 40%; left: 50%; transform: translateX(-50%); width: 500px; height: 180px; background: radial-gradient(ellipse, rgba(0,82,255,0.07) 0%, transparent 80%); pointer-events: none;"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="position: relative; z-index: 1; padding-top: 5rem; padding-bottom: 3rem;">

            <!-- Top section: Brand + Columns -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-14">

                <!-- Col 1: Brand -->
                <div class="lg:col-span-1" style="display: flex; flex-direction: column; gap: 1.25rem;">
                    <!-- Logo -->
                    <a href="{{ route('home') }}" style="display: inline-flex; align-items: center; gap: 12px; text-decoration: none;">
                        <x-application-logo style="height: 48px; width: auto; object-fit: contain; background: rgba(255,255,255,0.92); padding: 8px 12px; border-radius: 14px; box-shadow: 0 4px 20px rgba(0,82,255,0.2);" />
                    </a>

                    <p style="font-size: 0.83rem; color: rgba(148,163,184,0.9); line-height: 1.7; max-width: 260px;">
                        Your trusted partner in tax, accounting &amp; financial clarity. Serving individuals and businesses across Canada.
                    </p>

                    <!-- Tagline badge -->
                    <div>
                        <span style="font-size: 0.65rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.08em; color: #93c5fd; background: rgba(0,82,255,0.18); border: 1px solid rgba(0,82,255,0.3); padding: 5px 12px; border-radius: 999px; display: inline-block;">
                            Financial Clarity &amp; Growth
                        </span>
                    </div>

                    <!-- Social Media Icons -->
                    <div>
                        <p style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: rgba(148,163,184,0.7); margin-bottom: 10px;">Follow Us</p>
                        <div style="display: flex; gap: 10px; flex-wrap: wrap;">

                            <!-- Facebook -->
                            <a href="https://facebook.com/yonbustax" target="_blank" rel="noopener" title="Facebook on @yonbustax"
                               style="width: 38px; height: 38px; display: flex; align-items: center; justify-content: center; border-radius: 10px; background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.12); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); text-decoration: none; transition: all 0.2s; color: #ffffff;"
                               onmouseenter="this.style.background='rgba(24,119,242,0.3)'; this.style.borderColor='rgba(24,119,242,0.5)'; this.style.transform='translateY(-2px)';"
                               onmouseleave="this.style.background='rgba(255,255,255,0.07)'; this.style.borderColor='rgba(255,255,255,0.12)'; this.style.transform='translateY(0)';"
                               >
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073C24 5.405 18.627 0 12 0S0 5.405 0 12.073C0 18.1 4.388 23.094 10.125 24v-8.437H7.078v-3.49h3.047V9.41c0-3.025 1.792-4.697 4.533-4.697 1.312 0 2.686.235 2.686.235v2.97h-1.513c-1.491 0-1.956.93-1.956 1.874v2.25h3.328l-.532 3.49h-2.796V24C19.612 23.094 24 18.1 24 12.073z"/></svg>
                            </a>

                            <!-- Instagram -->
                            <a href="https://instagram.com/yonbustax" target="_blank" rel="noopener" title="Instagram @yonbustax"
                               style="width: 38px; height: 38px; display: flex; align-items: center; justify-content: center; border-radius: 10px; background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.12); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); text-decoration: none; transition: all 0.2s; color: #ffffff;"
                               onmouseenter="this.style.background='rgba(214,36,159,0.3)'; this.style.borderColor='rgba(214,36,159,0.5)'; this.style.transform='translateY(-2px)';"
                               onmouseleave="this.style.background='rgba(255,255,255,0.07)'; this.style.borderColor='rgba(255,255,255,0.12)'; this.style.transform='translateY(0)';"
                               >
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                            </a>

                            <!-- TikTok -->
                            <a href="https://tiktok.com/@yonbustax" target="_blank" rel="noopener" title="TikTok @yonbustax"
                               style="width: 38px; height: 38px; display: flex; align-items: center; justify-content: center; border-radius: 10px; background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.12); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); text-decoration: none; transition: all 0.2s; color: #ffffff;"
                               onmouseenter="this.style.background='rgba(255,255,255,0.18)'; this.style.borderColor='rgba(255,255,255,0.4)'; this.style.transform='translateY(-2px)';"
                               onmouseleave="this.style.background='rgba(255,255,255,0.07)'; this.style.borderColor='rgba(255,255,255,0.12)'; this.style.transform='translateY(0)';"
                               >
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.5 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.28 0 .54.04.79.1V9.01a6.27 6.27 0 0 0-.79-.05 6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.33-6.34V8.69a8.18 8.18 0 0 0 4.78 1.52V6.75a4.85 4.85 0 0 1-1.01-.06z"/></svg>
                            </a>

                            <!-- X / Twitter -->
                            <a href="https://x.com/yonbustax" target="_blank" rel="noopener" title="X (Twitter) @yonbustax"
                               style="width: 38px; height: 38px; display: flex; align-items: center; justify-content: center; border-radius: 10px; background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.12); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); text-decoration: none; transition: all 0.2s; color: #ffffff;"
                               onmouseenter="this.style.background='rgba(255,255,255,0.18)'; this.style.borderColor='rgba(255,255,255,0.4)'; this.style.transform='translateY(-2px)';"
                               onmouseleave="this.style.background='rgba(255,255,255,0.07)'; this.style.borderColor='rgba(255,255,255,0.12)'; this.style.transform='translateY(0)';"
                               >
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.746l7.73-8.835L1.254 2.25H8.08l4.258 5.63L18.244 2.25zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            </a>

                            <!-- LinkedIn -->
                            <a href="https://linkedin.com/company/yonbustax" target="_blank" rel="noopener" title="LinkedIn @yonbustax"
                               style="width: 38px; height: 38px; display: flex; align-items: center; justify-content: center; border-radius: 10px; background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.12); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); text-decoration: none; transition: all 0.2s; color: #ffffff;"
                               onmouseenter="this.style.background='rgba(0,119,181,0.3)'; this.style.borderColor='rgba(0,119,181,0.5)'; this.style.transform='translateY(-2px)';"
                               onmouseleave="this.style.background='rgba(255,255,255,0.07)'; this.style.borderColor='rgba(255,255,255,0.12)'; this.style.transform='translateY(0)';"
                               >
                                <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                            </a>

                        </div>
                    </div>
                </div>

                <!-- Col 2: Services -->
                <div>
                    <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; color: #ffffff; font-size: 0.9rem; margin-bottom: 1.25rem; text-transform: uppercase; letter-spacing: 0.06em; display: flex; align-items: center; gap: 8px;">
                        <span style="width: 18px; height: 2px; background: #0052ff; display: inline-block; border-radius: 2px;"></span>
                        Our Services
                    </h4>
                    <ul style="display: flex; flex-direction: column; gap: 0.75rem; list-style: none; padding: 0; margin: 0;">
                        @foreach([
                            'Tax Planning & Preparation',
                            'Accounting & Bookkeeping',
                            'Payroll Services',
                            'Business Advisory',
                            'Compliance Services',
                        ] as $svc)
                        <li>
                            <a href="{{ route('services') }}"
                               style="font-size: 0.85rem; color: rgba(148,163,184,0.85); text-decoration: none; display: flex; align-items: center; gap: 7px; transition: color 0.2s;"
                               onmouseenter="this.style.color='#ffffff';" onmouseleave="this.style.color='rgba(148,163,184,0.85)';">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="rgba(0,82,255,0.7)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                                {{ $svc }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Col 3: Quick Links -->
                <div>
                    <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; color: #ffffff; font-size: 0.9rem; margin-bottom: 1.25rem; text-transform: uppercase; letter-spacing: 0.06em; display: flex; align-items: center; gap: 8px;">
                        <span style="width: 18px; height: 2px; background: #0052ff; display: inline-block; border-radius: 2px;"></span>
                        Quick Links
                    </h4>
                    <ul style="display: flex; flex-direction: column; gap: 0.75rem; list-style: none; padding: 0; margin: 0;">
                        <li><a href="{{ route('home') }}" style="font-size: 0.85rem; color: rgba(148,163,184,0.85); text-decoration: none; display: flex; align-items: center; gap: 7px;" onmouseenter="this.style.color='#ffffff';" onmouseleave="this.style.color='rgba(148,163,184,0.85)';"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="rgba(0,82,255,0.7)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>Home</a></li>
                        <li><a href="{{ route('about') }}" style="font-size: 0.85rem; color: rgba(148,163,184,0.85); text-decoration: none; display: flex; align-items: gap: 7px;" onmouseenter="this.style.color='#ffffff';" onmouseleave="this.style.color='rgba(148,163,184,0.85)';"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="rgba(0,82,255,0.7)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>About Our Firm</a></li>
                        <li><a href="{{ route('team') }}" style="font-size: 0.85rem; color: rgba(148,163,184,0.85); text-decoration: none; display: flex; align-items: center; gap: 7px;" onmouseenter="this.style.color='#ffffff';" onmouseleave="this.style.color='rgba(148,163,184,0.85)';"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="rgba(0,82,255,0.7)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>Our Leadership Team</a></li>
                        <li><a href="{{ route('services') }}" style="font-size: 0.85rem; color: rgba(148,163,184,0.85); text-decoration: none; display: flex; align-items: center; gap: 7px;" onmouseenter="this.style.color='#ffffff';" onmouseleave="this.style.color='rgba(148,163,184,0.85)';"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="rgba(0,82,255,0.7)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>Our Services</a></li>
                        <li><a href="{{ route('blog') }}" style="font-size: 0.85rem; color: rgba(148,163,184,0.85); text-decoration: none; display: flex; align-items: center; gap: 7px;" onmouseenter="this.style.color='#ffffff';" onmouseleave="this.style.color='rgba(148,163,184,0.85)';"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="rgba(0,82,255,0.7)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>Tax Tips &amp; News</a></li>
                        <li><a href="{{ route('book-appointment') }}" style="font-size: 0.85rem; color: rgba(148,163,184,0.85); text-decoration: none; display: flex; align-items: center; gap: 7px;" onmouseenter="this.style.color='#ffffff';" onmouseleave="this.style.color='rgba(148,163,184,0.85)';"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="rgba(0,82,255,0.7)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>Book Consultation</a></li>
                        <li><a href="{{ route('contact') }}" style="font-size: 0.85rem; color: rgba(148,163,184,0.85); text-decoration: none; display: flex; align-items: center; gap: 7px;" onmouseenter="this.style.color='#ffffff';" onmouseleave="this.style.color='rgba(148,163,184,0.85)';"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="rgba(0,82,255,0.7)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>Contact Us</a></li>
                        <li><a href="{{ route('login') }}" style="font-size: 0.85rem; color: rgba(148,163,184,0.85); text-decoration: none; display: flex; align-items: center; gap: 7px;" onmouseenter="this.style.color='#ffffff';" onmouseleave="this.style.color='rgba(148,163,184,0.85)';"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="rgba(0,82,255,0.7)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>Client Portal Login</a></li>
                    </ul>
                </div>

                <!-- Col 4: Contact -->
                <div>
                    <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; color: #ffffff; font-size: 0.9rem; margin-bottom: 1.25rem; text-transform: uppercase; letter-spacing: 0.06em; display: flex; align-items: center; gap: 8px;">
                        <span style="width: 18px; height: 2px; background: #0052ff; display: inline-block; border-radius: 2px;"></span>
                        Get In Touch
                    </h4>
                    <div style="display: flex; flex-direction: column; gap: 14px;">

                        <!-- Address -->
                        <div style="display: flex; gap: 12px; align-items: flex-start;">
                            <div style="width: 32px; height: 32px; border-radius: 9px; background: rgba(0,82,255,0.2); border: 1px solid rgba(0,82,255,0.3); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <svg width="14" height="14" fill="none" stroke="#60a5fa" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div style="font-size: 0.82rem; color: rgba(148,163,184,0.9); line-height: 1.6;">147 Rue duChatelet<br>Gatineau, Quebec J8M 2A3</div>
                        </div>

                        <!-- Phone -->
                        <div style="display: flex; gap: 12px; align-items: flex-start;">
                            <div style="width: 32px; height: 32px; border-radius: 9px; background: rgba(0,82,255,0.2); border: 1px solid rgba(0,82,255,0.3); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <svg width="14" height="14" fill="none" stroke="#60a5fa" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498A1 1 0 0121 15.72V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <div style="font-size: 0.82rem; color: rgba(148,163,184,0.9); line-height: 1.8;">
                                +1 (647) 723-0990<br>+1 (437) 423-9911<br>(438) 978-1349 / (438) 686-3599
                            </div>
                        </div>

                        <!-- Email -->
                        <div style="display: flex; gap: 12px; align-items: flex-start;">
                            <div style="width: 32px; height: 32px; border-radius: 9px; background: rgba(0,82,255,0.2); border: 1px solid rgba(0,82,255,0.3); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <svg width="14" height="14" fill="none" stroke="#60a5fa" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div style="font-size: 0.82rem; line-height: 1.8;">
                                <a href="mailto:info@yonbustax.com" style="color: #93c5fd; text-decoration: none;" onmouseenter="this.style.color='#ffffff';" onmouseleave="this.style.color='#93c5fd';">info@yonbustax.com</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Glassmorphism divider -->
            <div style="height: 1px; background: linear-gradient(to right, transparent, rgba(255,255,255,0.12), transparent); margin-bottom: 1.75rem;"></div>

            <!-- Bottom bar -->
            <div style="display: flex; flex-direction: column; gap: 1rem; align-items: center; text-align: center;">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between w-full gap-4">
                    <p style="font-size: 0.75rem; color: rgba(100,116,139,0.85);">
                        &copy; {{ date('Y') }} YONBUS Tax &amp; Accounting Services Inc. All rights reserved. 🇨🇦 Serving Canada.
                    </p>
                    <div style="display: flex; align-items: center; gap: 1.5rem; flex-wrap: wrap; justify-content: center;">
                        <a href="{{ route('privacy') }}" style="font-size: 0.75rem; color: rgba(100,116,139,0.85); text-decoration: none;" onmouseenter="this.style.color='#ffffff';" onmouseleave="this.style.color='rgba(100,116,139,0.85)';">Privacy Policy</a>
                        <span style="width: 3px; height: 3px; background: rgba(100,116,139,0.5); border-radius: 50%; display: inline-block;"></span>
                        <a href="{{ route('terms') }}" style="font-size: 0.75rem; color: rgba(100,116,139,0.85); text-decoration: none;" onmouseenter="this.style.color='#ffffff';" onmouseleave="this.style.color='rgba(100,116,139,0.85)';">Terms of Service</a>
                        <span style="width: 3px; height: 3px; background: rgba(100,116,139,0.5); border-radius: 50%; display: inline-block;"></span>
                        <a href="{{ route('contact') }}" style="font-size: 0.75rem; color: rgba(100,116,139,0.85); text-decoration: none;" onmouseenter="this.style.color='#ffffff';" onmouseleave="this.style.color='rgba(100,116,139,0.85)';">Contact</a>
                    </div>
                </div>
            </div>

        </div>
    </footer>

    <!-- AOS (Framer-Motion Style Scroll Animations Script) -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 650,
                    once: true,
                    easing: 'ease-out-cubic',
                    offset: 40
                });
            }
        });
    </script>

    @livewireScripts

    <!-- WhatsApp Floating Widget -->
    <style>
        #wa-widget {
            position: fixed;
            bottom: 28px;
            right: 28px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 10px;
        }
        #wa-btn {
            width: 60px;
            height: 60px;
            background: #005DFF;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 24px rgba(0,93,255,0.45);
            text-decoration: none;
            animation: wa-bounce 2.2s infinite;
            transition: background 0.3s, transform 0.2s, box-shadow 0.3s;
            cursor: pointer;
        }
        #wa-btn:hover {
            animation: none;
            background: #25d366;
            transform: scale(1.12);
            box-shadow: 0 10px 32px rgba(37,211,102,0.6);
        }
        @keyframes wa-bounce {
            0%, 100% { transform: translateY(0); }
            30%       { transform: translateY(-10px); }
            50%       { transform: translateY(-5px); }
            70%       { transform: translateY(-10px); }
        }
        #wa-tooltip {
            background: #1a1a2e;
            color: #ffffff;
            font-size: 0.78rem;
            font-weight: 600;
            padding: 6px 13px;
            border-radius: 999px;
            white-space: nowrap;
            box-shadow: 0 4px 14px rgba(0,0,0,0.25);
            opacity: 0;
            transform: translateX(10px);
            transition: opacity 0.25s, transform 0.25s;
            pointer-events: none;
        }
        #wa-widget:hover #wa-tooltip {
            opacity: 1;
            transform: translateX(0);
        }
    </style>
    <div id="wa-widget">
        <div id="wa-tooltip">Chat with us on WhatsApp</div>
        <a id="wa-btn" href="#" target="_blank" rel="noopener" title="Chat on WhatsApp" aria-label="Contact us on WhatsApp">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="#ffffff">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
            </svg>
        </a>
    </div>
</body>
</html>
