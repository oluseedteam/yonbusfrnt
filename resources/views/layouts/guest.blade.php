<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'YONBUS Tax & Accounting Services Inc.') }}</title>

        <!-- Favicon / Website Title Logo -->
        <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
        <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-[#F8FAFC] relative">
        <div class="absolute top-4 right-4 z-20">
            <x-language-switcher />
        </div>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#F8FAFC] animate-page-entry">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-[#005DFF]" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-8 py-6 bg-white shadow-xl border border-slate-100 overflow-hidden sm:rounded-2xl">
                {{ $slot }}
            </div>
        </div>

        <!-- Google Translate Seamless Engine -->
        <x-google-translate-scripts />
    </body>
</html>
