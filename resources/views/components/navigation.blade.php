<nav x-data="{ open: false, scrolled: false }"
     x-init="scrolled = window.scrollY > 50; window.addEventListener('scroll', () => scrolled = window.scrollY > 50)"
     class="fixed w-full z-50 transition-all duration-300"
     :class="(scrolled || @json(request()->routeIs('dashboard*') || request()->routeIs('admin*') || request()->routeIs('profile*') || request()->routeIs('login') || request()->routeIs('register'))) ? 'bg-black/95 backdrop-blur-xl shadow-lg' : 'bg-transparent'">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-2 group">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Only Fitness" class="h-10 w-auto">
                    <span class="font-heading font-semibold text-xl tracking-wider text-white">ONLY FITNESS</span>
                </a>
            </div>

            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="font-heading text-sm uppercase tracking-widest transition hover:text-brand-yellow relative after:absolute after:bottom-0 after:left-0 after:h-0.5 after:bg-brand-yellow after:transition-all {{ request()->routeIs('home') ? 'text-brand-yellow after:w-full' : 'text-white hover:after:w-full' }}">Home</a>
                <a href="{{ route('programs') }}" class="font-heading text-sm uppercase tracking-widest transition hover:text-brand-yellow relative after:absolute after:bottom-0 after:left-0 after:h-0.5 after:bg-brand-yellow after:transition-all {{ request()->routeIs('programs') ? 'text-brand-yellow after:w-full' : 'text-white hover:after:w-full' }}">Programs</a>
                <a href="{{ route('trainers') }}" class="font-heading text-sm uppercase tracking-widest transition hover:text-brand-yellow relative after:absolute after:bottom-0 after:left-0 after:h-0.5 after:bg-brand-yellow after:transition-all {{ request()->routeIs('trainers') ? 'text-brand-yellow after:w-full' : 'text-white hover:after:w-full' }}">Trainers</a>
                <a href="{{ route('pricing') }}" class="font-heading text-sm uppercase tracking-widest transition hover:text-brand-yellow relative after:absolute after:bottom-0 after:left-0 after:h-0.5 after:bg-brand-yellow after:transition-all {{ request()->routeIs('pricing') ? 'text-brand-yellow after:w-full' : 'text-white hover:after:w-full' }}">Pricing</a>
                <a href="{{ route('contact') }}" class="font-heading text-sm uppercase tracking-widest transition hover:text-brand-yellow relative after:absolute after:bottom-0 after:left-0 after:h-0.5 after:bg-brand-yellow after:transition-all {{ request()->routeIs('contact') ? 'text-brand-yellow after:w-full' : 'text-white hover:after:w-full' }}">Contact</a>
                @auth
                    <div x-data="{ dropdown: false }" class="relative">
                        <button @click="dropdown = !dropdown" @click.outside="dropdown = false" class="flex items-center space-x-2 font-heading text-sm uppercase tracking-widest px-4 py-2 bg-brand-yellow text-brand-black rounded-full font-semibold hover:bg-yellow-400 hover:scale-105 transition">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4" :class="{'rotate-180': dropdown}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="dropdown" x-transition class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg py-2 z-50" style="display: none;">
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-brand-black">Dashboard</a>
                            @if(Auth::user()->is_admin)
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Admin Panel</a>
                            @endif
                            <a href="{{ route('member.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                            <hr class="my-1 border-gray-200">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>

            <div class="md:hidden flex items-center">
                <button @click="open = ! open" class="p-2 text-white hover:text-brand-yellow transition" :class="{'text-brand-yellow': open}">
                    <svg x-show="!open" class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="open" class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-4" class="md:hidden bg-black/95 backdrop-blur-xl border-t border-gray-800" style="display: none;">
        <div class="px-4 py-4 space-y-3">
            <a href="{{ route('home') }}" class="block font-heading text-sm uppercase tracking-widest transition py-2 {{ request()->routeIs('home') ? 'text-brand-yellow' : 'text-white hover:text-brand-yellow' }}">Home</a>
            <a href="{{ route('programs') }}" class="block font-heading text-sm uppercase tracking-widest transition py-2 {{ request()->routeIs('programs') ? 'text-brand-yellow' : 'text-white hover:text-brand-yellow' }}">Programs</a>
            <a href="{{ route('trainers') }}" class="block font-heading text-sm uppercase tracking-widest transition py-2 {{ request()->routeIs('trainers') ? 'text-brand-yellow' : 'text-white hover:text-brand-yellow' }}">Trainers</a>
            <a href="{{ route('pricing') }}" class="block font-heading text-sm uppercase tracking-widest transition py-2 {{ request()->routeIs('pricing') ? 'text-brand-yellow' : 'text-white hover:text-brand-yellow' }}">Pricing</a>
            <a href="{{ route('contact') }}" class="block font-heading text-sm uppercase tracking-widest transition py-2 {{ request()->routeIs('contact') ? 'text-brand-yellow' : 'text-white hover:text-brand-yellow' }}">Contact</a>
            <hr class="border-gray-800">
            @auth
                <a href="{{ route('dashboard') }}" class="block font-heading text-sm uppercase tracking-widest text-brand-yellow transition py-2">Dashboard</a>
                @if(Auth::user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}" class="block font-heading text-sm uppercase tracking-widest text-brand-yellow transition py-2">Admin Panel</a>
                @endif
                <a href="{{ route('member.profile') }}" class="block font-heading text-sm uppercase tracking-widest text-gray-400 hover:text-white transition py-2">Profile</a>
                <a href="{{ route('logout') }}" class="block font-heading text-sm uppercase tracking-widest text-gray-400 hover:text-white transition py-2"
                   onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">Logout</a>
                <form id="logout-form-mobile" method="POST" action="{{ route('logout') }}" class="hidden">@csrf</form>
            @endauth
        </div>
    </div>
</nav>
