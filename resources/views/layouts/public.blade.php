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
                            ['route' => 'services', 'label' => 'Services'],
                            ['route' => 'about',    'label' => 'About Us'],
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

                    <a href="{{ route('book-appointment') }}"
                       class="inline-flex items-center justify-center px-4 py-2 text-sm font-semibold rounded-lg transition-all"
                       style="color: #0052ff; background: #eff6ff; border: 1.5px solid #bfdbfe;">
                        Book Consultation
                    </a>

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
                <a href="{{ route('book-appointment') }}" class="w-full text-center py-2.5 text-sm font-semibold rounded-lg" style="color: #0052ff; border: 1.5px solid #0052ff;">Book Consultation</a>
                <a href="{{ route('register') }}" class="w-full text-center py-2.5 text-sm font-semibold rounded-lg" style="background: #0052ff; color: #ffffff;">Get Started</a>
            </div>
        </div>
    </header>

    <!-- Main Content Area with Page Motion Animation -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-[#010818] text-slate-300 pt-16 pb-12 border-t border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <!-- Col 1: Brand Info -->
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <x-application-logo class="h-12 w-auto object-contain bg-white/90 p-1.5 rounded-xl shadow-md" />
                    </div>
                    <p class="text-sm text-slate-400 leading-relaxed">
                        Yonbus Tax & Accounting Services Inc. is a trusted partner committed to delivering reliable, efficient and compliant tax and accounting solutions to individuals, businesses and organizations across Canada.
                    </p>
                    <div class="pt-2 flex flex-col space-y-1 text-slate-400">
                        <span class="text-xs bg-slate-800 px-3 py-1.5 rounded-full border border-slate-700 text-slate-300 inline-block w-fit">YOUR PARTNER IN FINANCIAL CLARITY AND GROWTH</span>
                    </div>
                </div>

                <!-- Col 2: Services -->
                <div>
                    <h4 class="font-heading font-bold text-white text-base mb-4 tracking-wide">Our Services</h4>
                    <ul class="space-y-2.5 text-sm text-slate-400">
                        <li><a href="{{ route('services') }}" class="hover:text-white transition">Tax Planning & Preparation</a></li>
                        <li><a href="{{ route('services') }}" class="hover:text-white transition">Accounting & Bookkeeping</a></li>
                        <li><a href="{{ route('services') }}" class="hover:text-white transition">Payroll Services</a></li>
                        <li><a href="{{ route('services') }}" class="hover:text-white transition">Business Advisory</a></li>
                        <li><a href="{{ route('services') }}" class="hover:text-white transition">Compliance Services</a></li>
                    </ul>
                </div>

                <!-- Col 3: Quick Links -->
                <div>
                    <h4 class="font-heading font-bold text-white text-base mb-4 tracking-wide">Quick Links</h4>
                    <ul class="space-y-2.5 text-sm text-slate-400">
                        <li><a href="{{ route('about') }}" class="hover:text-white transition">About Our Firm</a></li>
                        <li><a href="{{ route('blog') }}" class="hover:text-white transition">Tax Tips & News</a></li>
                        <li><a href="{{ route('book-appointment') }}" class="hover:text-white transition">Book Consultation</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-white transition">Client Portal Login</a></li>
                        <li><a href="{{ route('privacy') }}" class="hover:text-white transition">Privacy Policy</a></li>
                    </ul>
                </div>

                <!-- Col 4: Official Contact Info -->
                <div class="space-y-3">
                    <h4 class="font-heading font-bold text-white text-base mb-4 tracking-wide">Get In Touch</h4>
                    <p class="text-sm text-slate-400 flex items-start">
                        <svg class="w-5 h-5 text-[#005DFF] mr-2 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        147 Rue duChatelet Gatineau Quebec J8M 2A3
                    </p>
                    <div class="text-sm text-slate-400 space-y-1 pl-7">
                        <div>📞 +1 (647) 723-0990</div>
                        <div>📞 +1 (437) 423-9911</div>
                        <div>📞 (438) 978-1349 / (438) 686-3599</div>
                    </div>
                    <div class="text-sm text-slate-400 space-y-1 pl-7 pt-2">
                        <div>✉️ <a href="mailto:info@yonbustax.com" class="hover:text-white underline">info@yonbustax.com</a></div>
                        <div>✉️ <a href="mailto:yonbustaxservices@gmail.com" class="hover:text-white underline">yonbustaxservices@gmail.com</a></div>
                        <div>🌐 <a href="https://www.yonbustax.com" target="_blank" class="hover:text-white underline">www.yonbustax.com</a></div>
                    </div>
                </div>
            </div>

            <div class="border-t border-slate-800 pt-8 flex flex-col md:flex-row items-center justify-between text-xs text-slate-500">
                <p>&copy; {{ date('Y') }} YONBUS Tax & Accounting Services Inc. All rights reserved. Serving individuals and businesses across Canada.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="{{ route('privacy') }}" class="hover:text-slate-300">Privacy Policy</a>
                    <a href="{{ route('terms') }}" class="hover:text-slate-300">Terms of Service</a>
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
</body>
</html>
