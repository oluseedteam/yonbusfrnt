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
<body class="bg-slate-50 text-slate-800 antialiased flex flex-col min-h-screen">

    <!-- Top Header Navigation -->
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-slate-200 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-28 sm:h-32">
                <!-- Brand Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group py-2">
                    <x-application-logo class="h-20 sm:h-24 w-auto object-contain drop-shadow-2xl group-hover:scale-105 transition-all duration-300" />
                </a>

                <!-- Navigation Links (Desktop) -->
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-sm font-medium {{ request()->routeIs('home') ? 'text-[#005DFF] font-semibold' : 'text-slate-600 hover:text-[#005DFF]' }} transition-colors">Home</a>
                    <a href="{{ route('about') }}" class="text-sm font-medium {{ request()->routeIs('about') ? 'text-[#005DFF] font-semibold' : 'text-slate-600 hover:text-[#005DFF]' }} transition-colors">About Us</a>
                    <a href="{{ route('services') }}" class="text-sm font-medium {{ request()->routeIs('services') ? 'text-[#005DFF] font-semibold' : 'text-slate-600 hover:text-[#005DFF]' }} transition-colors">Services</a>
                    <a href="{{ route('blog') }}" class="text-sm font-medium {{ request()->routeIs('blog*') ? 'text-[#005DFF] font-semibold' : 'text-slate-600 hover:text-[#005DFF]' }} transition-colors">Blog</a>
                    <a href="{{ route('contact') }}" class="text-sm font-medium {{ request()->routeIs('contact') ? 'text-[#005DFF] font-semibold' : 'text-slate-600 hover:text-[#005DFF]' }} transition-colors">Contact Us</a>
                </nav>

                <!-- Header Actions -->
                <div class="hidden md:flex items-center space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-slate-700 hover:text-[#005DFF] transition">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            Portal Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-slate-700 hover:text-[#005DFF] transition px-3 py-2">Client Login</a>
                        <a href="{{ route('register') }}" class="text-sm font-medium text-[#005DFF] hover:text-[#002B8A] transition px-3 py-2">Register</a>
                    @endauth

                    <a href="{{ route('book-appointment') }}" class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-[#005DFF] to-[#00A3FF] hover:from-[#002B8A] hover:to-[#005DFF] shadow-lg shadow-blue-500/25 transition-all transform hover:-translate-y-0.5">
                        Book Appointment
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex items-center md:hidden" x-data="{ open: false }">
                    <button @click="open = !open" class="p-2 rounded-lg text-slate-600 hover:text-slate-900 hover:bg-slate-100 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Area with Page Motion Animation -->
    <main class="flex-grow animate-page-entry">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-300 pt-16 pb-12 border-t border-slate-800 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <!-- Col 1: Brand Info -->
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <x-application-logo class="h-12 w-auto object-contain bg-white/90 p-1.5 rounded-xl shadow-md" />
                    </div>
                    <p class="text-sm text-slate-400 leading-relaxed">
                        YONBUS Tax & Accounting Services Inc. delivers high-precision corporate tax, bookkeeping, payroll, and business advisory services designed for modern enterprises and individuals.
                    </p>
                    <div class="pt-2 flex space-x-4 text-slate-400">
                        <span class="text-xs bg-slate-800 px-3 py-1.5 rounded-full border border-slate-700 text-slate-300">CRA Registered Practitioner</span>
                    </div>
                </div>

                <!-- Col 2: Services -->
                <div>
                    <h4 class="font-heading font-bold text-white text-base mb-4 tracking-wide">Our Services</h4>
                    <ul class="space-y-2.5 text-sm text-slate-400">
                        <li><a href="{{ route('services') }}" class="hover:text-white transition">Personal Tax Filing</a></li>
                        <li><a href="{{ route('services') }}" class="hover:text-white transition">Corporate Tax Filing</a></li>
                        <li><a href="{{ route('services') }}" class="hover:text-white transition">Bookkeeping Consultation</a></li>
                        <li><a href="{{ route('services') }}" class="hover:text-white transition">Payroll Services</a></li>
                        <li><a href="{{ route('services') }}" class="hover:text-white transition">Business Registration</a></li>
                        <li><a href="{{ route('services') }}" class="hover:text-white transition">CRA & Audit Consultation</a></li>
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
                        <li><a href="{{ route('terms') }}" class="hover:text-white transition">Terms & Conditions</a></li>
                    </ul>
                </div>

                <!-- Col 4: Contact Info -->
                <div class="space-y-3">
                    <h4 class="font-heading font-bold text-white text-base mb-4 tracking-wide">Contact Us</h4>
                    <p class="text-sm text-slate-400 flex items-start">
                        <svg class="w-5 h-5 text-[#005DFF] mr-2 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        100 Financial Plaza, Suite 800, Toronto, ON M5H 2N2
                    </p>
                    <p class="text-sm text-slate-400 flex items-center">
                        <svg class="w-5 h-5 text-[#005DFF] mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h32a2 2 0 012 2v2a2 2 0 01-2 2H5a2 2 0 01-2-2V5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18v10a2 2 0 01-2 2H5a2 2 0 01-2-2V10z"></path></svg>
                        info@yonbus.com
                    </p>
                    <p class="text-sm text-slate-400 flex items-center">
                        <svg class="w-5 h-5 text-[#005DFF] mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        +1 (800) 555-YONBUS
                    </p>
                </div>
            </div>

            <div class="border-t border-slate-800 pt-8 flex flex-col md:flex-row items-center justify-between text-xs text-slate-500">
                <p>&copy; {{ date('Y') }} YONBUS Tax & Accounting Services Inc. All rights reserved.</p>
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
