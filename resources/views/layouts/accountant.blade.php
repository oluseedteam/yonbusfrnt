<x-app-layout>
    <div x-data="{ mobileMenuOpen: false }" class="flex min-h-screen">
        <!-- Desktop Sidebar -->
        <div class="hidden lg:block">
            @include('layouts.partials.sidebar', ['role' => 'accountant'])
        </div>

        <!-- Mobile Drawer Sidebar -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="-translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="-translate-x-full"
             class="fixed inset-y-0 left-0 z-50 lg:hidden shadow-2xl">
            @include('layouts.partials.sidebar', ['role' => 'accountant'])
        </div>
        <div x-show="mobileMenuOpen" @click="mobileMenuOpen = false" class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm z-40 lg:hidden"></div>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0">
            @include('layouts.partials.topnav')

            <main class="flex-1 p-6 md:p-8 max-w-7xl w-full mx-auto">
                @if (session()->has('message'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" class="mb-6 p-4 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-200 flex items-center justify-between shadow-sm">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-emerald-500 text-white flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="text-sm font-medium">{{ session('message') }}</span>
                        </div>
                        <button @click="show = false" class="text-emerald-500 hover:text-emerald-700">&times;</button>
                    </div>
                @endif

                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="border-t border-gray-100 dark:border-gray-800/60 py-6 px-8 text-center sm:text-left text-xs text-gray-500 dark:text-gray-400 flex flex-col sm:flex-row justify-between items-center gap-4">
                <p>&copy; {{ date('Y') }} YONBUS Tax & Accounting Services Inc. — Accountant Portal</p>
                <div class="flex items-center gap-4">
                    <a href="#" class="hover:text-[#005DFF]">Help Center</a>
                    <a href="#" class="hover:text-[#005DFF]">Client Guidelines</a>
                </div>
            </footer>
        </div>
    </div>
</x-app-layout>
