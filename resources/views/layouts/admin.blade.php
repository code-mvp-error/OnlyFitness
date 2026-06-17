<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Only Fitness') }} | Admin — @yield('title', 'Dashboard')</title>

    <x-seo noindex />

    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpg') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.jpg') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Oswald:wght@400;500;600;700&family=Dancing+Script:wght@400;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-body bg-brand-dark antialiased"
      x-data="{ sidebarOpen: false }"
      @keydown.escape.window="sidebarOpen = false">

    {{-- Mobile sidebar toggle --}}
    <button @click="sidebarOpen = true"
            class="fixed top-4 left-4 z-50 w-10 h-10 bg-brand-yellow rounded-lg flex items-center justify-center text-brand-black lg:hidden">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
    </button>

    {{-- Mobile overlay --}}
    <div x-show="sidebarOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="sidebarOpen = false"
         class="fixed inset-0 bg-black/80 z-40 lg:hidden"
         style="display: none;"></div>

    {{-- Sidebar --}}
    <aside class="fixed left-0 top-0 h-screen w-64 bg-brand-black border-r border-white/10 z-50
                  transition-transform duration-300
                  -translate-x-full lg:translate-x-0"
           :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
        {{-- Logo --}}
        <div class="py-6 px-6 flex items-center gap-3">
            <img src="{{ asset('images/logo.jpg') }}" alt="Only Fitness" class="h-10 w-auto">
            <div>
                <span class="text-white font-heading font-bold">Only Fitness</span>
                <span class="block text-brand-yellow text-xs font-heading uppercase tracking-widest">Admin</span>
            </div>
        </div>

        {{-- Navigation --}}
        @php
            $adminNavs = [
                ['name' => 'Dashboard', 'route' => 'admin.dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                ['name' => 'Members', 'route' => 'admin.members', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
                ['name' => 'Bookings', 'route' => 'admin.bookings', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                ['name' => 'Trainers', 'route' => 'admin.trainers', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'],
                ['name' => 'Contacts', 'route' => 'admin.contacts', 'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
            ];
        @endphp

        <nav class="px-4 space-y-1">
            @foreach($adminNavs as $nav)
                <a href="{{ route($nav['route']) }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors
                          {{ request()->routeIs($nav['route']) ? 'bg-brand-yellow/10 text-brand-yellow' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $nav['icon'] }}"/>
                    </svg>
                    {{ $nav['name'] }}
                    @if($nav['name'] === 'Contacts' && isset($unreadCount) && $unreadCount > 0)
                        <span class="ml-auto bg-brand-yellow text-brand-black text-xs font-bold px-2 py-0.5 rounded-full">{{ $unreadCount }}</span>
                    @endif
                </a>
            @endforeach
        </nav>

        {{-- Logout --}}
        <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-white/10">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-3 w-full px-4 py-3 rounded-xl text-sm font-medium text-gray-400 hover:text-white hover:bg-white/5 transition-colors">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Content --}}
    <div class="lg:pl-64">
        {{-- Top bar --}}
        <header class="bg-brand-black bg-opacity-50 border-b border-white/10 h-16 flex items-center justify-between px-6 lg:px-8">
            <h1 class="font-heading text-lg font-bold text-white uppercase tracking-wide">@yield('title', 'Dashboard')</h1>
            <div class="flex items-center gap-4">
                <a href="{{ route('home') }}" class="text-gray-400 hover:text-brand-yellow text-sm transition">View Site</a>
                <form method="POST" action="{{ route('logout') }}" class="hidden sm:block">
                    @csrf
                    <button type="submit" class="text-gray-400 hover:text-red-400 text-sm transition">Logout</button>
                </form>
            </div>
        </header>

        {{-- Page Content --}}
        <main class="min-h-[calc(100vh-4rem)]">
            {{ $slot }}
        </main>
    </div>

</body>
</html>
