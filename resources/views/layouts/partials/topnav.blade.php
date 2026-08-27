<header class="h-20 bg-white dark:bg-gray-900 border-b border-gray-100 dark:border-gray-800 sticky top-0 z-20 flex items-center justify-between px-6 transition-colors">
    <!-- Search Bar -->
    <div class="flex items-center gap-4 flex-1 max-w-lg">
        <!-- Mobile Sidebar Toggle -->
        <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 rounded-xl text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>

        <div class="relative w-full">
            <input type="text" placeholder="Search anything (documents, appointments, tax returns...)" 
                   class="w-full bg-[#f8fafc] dark:bg-gray-800/60 border border-gray-200 dark:border-gray-700/60 rounded-2xl py-2.5 pl-10 pr-4 text-xs focus:outline-none focus:ring-2 focus:ring-[#005DFF] focus:border-transparent text-gray-800 dark:text-gray-200 placeholder-gray-400">
            <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
    </div>

    <!-- Right Controls -->
    <div class="flex items-center gap-3">
        <!-- Language Switcher (EN / FR) -->
        <x-language-switcher />

        <!-- Dark Mode Toggle -->
        <button @click="darkMode = !darkMode" class="w-10 h-10 rounded-2xl border border-gray-200 dark:border-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
            <template x-if="!darkMode">
                <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
            </template>
            <template x-if="darkMode">
                <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </template>
        </button>

        <!-- Notification Bell Dropdown -->
        <div x-data="{ open: false }" class="relative">
            @php
                $unreadCount = auth()->user()->unreadNotifications->count();
                $notifications = auth()->user()->notifications->take(5);
            @endphp
            <button @click="open = !open" class="w-10 h-10 rounded-2xl border border-gray-200 dark:border-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 relative transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                @if($unreadCount > 0)
                    <span class="absolute top-2.5 right-2.5 w-2.5 h-2.5 rounded-full bg-[#005DFF] ring-2 ring-white dark:ring-gray-900"></span>
                @endif
            </button>

            <!-- Dropdown -->
            <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-3 w-80 bg-white dark:bg-gray-900 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-800 p-4 z-50">
                <div class="flex items-center justify-between border-b border-gray-100 dark:border-gray-800 pb-3 mb-3">
                    <h4 class="font-semibold text-sm font-heading text-slate-900 dark:text-white">Notifications</h4>
                    <span class="text-xs bg-blue-50 dark:bg-blue-950 text-[#005DFF] px-2 py-0.5 rounded-full font-medium">
                        {{ $unreadCount > 0 ? "{$unreadCount} New" : 'All caught up' }}
                    </span>
                </div>
                <div class="space-y-3 text-xs">
                    @forelse($notifications as $notif)
                        <div class="p-2.5 rounded-xl bg-blue-50/50 dark:bg-blue-950/20 border border-blue-100 dark:border-blue-900/40 flex items-start gap-2.5">
                            <div class="w-7 h-7 rounded-lg bg-[#005DFF] text-white flex items-center justify-center flex-shrink-0">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-800 dark:text-gray-200">{{ $notif->data['title'] ?? 'Notification' }}</p>
                                <p class="text-gray-500 text-[11px]">{{ $notif->data['message'] ?? 'You have a new update.' }}</p>
                                <span class="text-[10px] text-gray-400 mt-1 block">{{ $notif->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="p-2.5 rounded-xl bg-blue-50/50 dark:bg-blue-950/20 border border-blue-100 dark:border-blue-900/40 flex items-start gap-2.5">
                            <div class="w-7 h-7 rounded-lg bg-[#005DFF] text-white flex items-center justify-center flex-shrink-0">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800 dark:text-gray-200">Account Active</p>
                                <p class="text-gray-500 text-[11px]">Your account is verified and ready for tax filing.</p>
                                <span class="text-[10px] text-gray-400 mt-1 block">Recently</span>
                            </div>
                        </div>
                        <div class="p-2.5 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-800/60 transition-colors flex items-start gap-2.5">
                            <div class="w-7 h-7 rounded-lg bg-emerald-500 text-white flex items-center justify-center flex-shrink-0">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800 dark:text-gray-200">System Ready</p>
                                <p class="text-gray-500 text-[11px]">Real-time tax consultations available.</p>
                                <span class="text-[10px] text-gray-400 mt-1 block">Live</span>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- User Profile Dropdown -->
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open" class="flex items-center gap-3 p-1.5 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors text-left">
                @php
                    $words = explode(' ', auth()->user()->name);
                    $initials = count($words) >= 2 
                        ? strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1))
                        : strtoupper(substr(auth()->user()->name, 0, 2));
                @endphp
                @if(auth()->user()->avatar)
                    <img src="{{ auth()->user()->avatar_url }}" alt="{{ auth()->user()->name }}" class="w-9 h-9 rounded-full object-cover shadow-sm ring-1 ring-slate-200 dark:ring-slate-700 flex-shrink-0">
                @else
                    <div class="w-9 h-9 rounded-full bg-[#005DFF] text-white font-bold text-xs flex items-center justify-center flex-shrink-0 shadow-sm">
                        {{ $initials ?: 'SA' }}
                    </div>
                @endif
                <div class="hidden sm:block text-left">
                    <span class="text-xs font-bold text-slate-900 dark:text-white font-heading block leading-tight">{{ auth()->user()->name }}</span>
                    <span class="text-[10px] text-slate-500 capitalize block leading-tight">{{ auth()->user()->role === 'admin' ? 'Admin' : (auth()->user()->role === 'superadmin' ? 'Super Admin' : auth()->user()->role) }}</span>
                </div>
                <svg class="w-3.5 h-3.5 text-slate-400 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>

            <!-- Dropdown Menu -->
            <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-3 w-56 bg-white dark:bg-gray-900 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-800 p-2 z-50">
                <div class="px-3 py-2 border-b border-gray-100 dark:border-gray-800">
                    <p class="text-xs font-semibold text-gray-900 dark:text-white font-heading">{{ auth()->user()->name }}</p>
                    <p class="text-[11px] text-gray-500 truncate">{{ auth()->user()->email }}</p>
                </div>

                <div class="py-1">
                    @if(auth()->user()->isClient())
                        <a href="{{ route('client.profile') }}" class="flex items-center gap-2 px-3 py-2 text-xs font-medium text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            My Profile
                        </a>
                        <a href="{{ route('client.settings') }}" class="flex items-center gap-2 px-3 py-2 text-xs font-medium text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path></svg>
                            Settings
                        </a>
                    @elseif(auth()->user()->isAdmin())
                        <a href="{{ route('admin.profile') }}" class="flex items-center gap-2 px-3 py-2 text-xs font-medium text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            Admin Profile
                        </a>
                        <a href="{{ route('admin.settings') }}" class="flex items-center gap-2 px-3 py-2 text-xs font-medium text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path></svg>
                            Settings
                        </a>
                    @endif
                </div>

                <div class="pt-1 border-t border-gray-100 dark:border-gray-800">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-2 px-3 py-2 text-xs font-medium text-red-600 dark:text-red-400 rounded-xl hover:bg-red-50 dark:hover:bg-red-950/40 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            Sign Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
