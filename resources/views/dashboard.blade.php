<x-member-layout>
    <x-slot:title>Dashboard</x-slot:title>

    {{-- Welcome --}}
    <h2 class="text-white text-2xl font-bold mb-6">Welcome back, {{ $user->name }}!</h2>

    {{-- Membership card --}}
    <div class="bg-gradient-to-r from-brand-yellow to-brand-gold rounded-2xl p-8 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-48 h-48 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-32 h-32 bg-black/5 rounded-full translate-y-1/2 -translate-x-1/2"></div>
        <div class="relative z-10">
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                <div>
                    <p class="text-black/60 text-sm font-medium uppercase tracking-wider">Membership</p>
                    <h3 class="text-brand-black font-heading text-3xl font-bold uppercase">
                        {{ $user->plan?->name ?? 'FREE' }} MEMBER
                    </h3>
                </div>
                <div class="text-right">
                    <p class="text-black/60 text-sm">Valid until</p>
                    <p class="text-brand-black font-bold">{{ $memberSince->addYear()->format('M Y') }}</p>
                </div>
            </div>
            <div class="mt-6">
                <div class="flex items-center justify-between text-sm mb-2">
                    <span class="text-black/70 font-medium">{{ $currentStreak }} day streak</span>
                    <span class="text-black/70 font-medium">{{ min($currentStreak, 30) }}/30</span>
                </div>
                <div class="w-full bg-black/20 rounded-full h-4 overflow-hidden">
                    <div class="h-full bg-brand-black/50 rounded-full transition-all duration-500"
                         style="width: {{ min(($currentStreak / 30) * 100, 100) }}%"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats row --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8">
        <div class="bg-brand-gray rounded-xl p-6 border border-white/5">
            <svg class="w-8 h-8 text-brand-yellow mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5.636 18.364a9 9 0 010-12.728m12.728 0a9 9 0 010 12.728m-9.9-2.829a5 5 0 010-7.07m7.072 0a5 5 0 010 7.07M13 12a1 1 0 11-2 0 1 1 0 012 0z"/>
            </svg>
            <p class="text-2xl font-bold text-white">{{ $stats['workouts'] }}</p>
            <p class="text-gray-400 text-sm">Workouts<br><span class="text-xs text-gray-500">This month</span></p>
        </div>
        <div class="bg-brand-gray rounded-xl p-6 border border-white/5">
            <svg class="w-8 h-8 text-brand-yellow mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            <p class="text-2xl font-bold text-white">{{ $stats['sessions'] }}</p>
            <p class="text-gray-400 text-sm">Sessions<br><span class="text-xs text-gray-500">With trainers</span></p>
        </div>
        <div class="bg-brand-gray rounded-xl p-6 border border-white/5">
            <svg class="w-8 h-8 text-brand-yellow mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
            </svg>
            <p class="text-2xl font-bold text-white">{{ $stats['weight'] }} @if(is_numeric($stats['weight']))<span class="text-sm text-gray-400"> lbs</span>@endif</p>
            <p class="text-gray-400 text-sm">Weight<br><span class="text-xs text-gray-500">Current</span></p>
        </div>
        <div class="bg-brand-gray rounded-xl p-6 border border-white/5">
            <svg class="w-8 h-8 text-brand-yellow mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-2xl font-bold text-white">{{ $stats['goal'] }}%</p>
            <p class="text-gray-400 text-sm">Progress<br><span class="text-xs text-gray-500">Goal</span></p>
        </div>
    </div>

    {{-- Upcoming bookings --}}
    <div class="mt-8">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-heading text-lg font-bold text-white uppercase tracking-wide">Upcoming Sessions</h3>
            <a href="{{ route('member.bookings') }}" class="text-brand-yellow text-sm hover:underline">View all</a>
        </div>
        @forelse($upcomingBookings as $booking)
            <div class="bg-brand-gray rounded-xl p-6 border border-white/5 mb-4 flex items-start gap-4">
                <div class="bg-brand-yellow text-brand-black rounded-lg px-4 py-2 text-center min-w-[80px] shrink-0">
                    <p class="text-2xl font-bold leading-tight">{{ \Carbon\Carbon::parse($booking->date)->format('d') }}</p>
                    <p class="text-xs font-bold uppercase">{{ \Carbon\Carbon::parse($booking->date)->format('M') }}</p>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-white font-bold">{{ $booking->program?->name ?? 'General Session' }}</p>
                    <p class="text-gray-400 text-sm">{{ \Carbon\Carbon::parse($booking->time)->format('g:i A') }} — {{ \Carbon\Carbon::parse($booking->time)->addHour()->format('g:i A') }}</p>
                    <p class="text-brand-yellow text-sm">with {{ $booking->trainer?->name ?? 'TBD' }}</p>
                </div>
                <form method="POST" action="{{ route('programs.book') }}" onsubmit="return confirm('Cancel this booking?')">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                    <button type="submit" class="text-red-400 text-sm hover:underline shrink-0">Cancel</button>
                </form>
            </div>
        @empty
            <div class="bg-brand-gray rounded-xl p-8 border border-white/5 text-center">
                <p class="text-gray-400">No upcoming sessions</p>
                <a href="{{ route('programs') }}" class="text-brand-yellow text-sm hover:underline mt-2 inline-block">Book a class</a>
            </div>
        @endforelse
    </div>

    {{-- Quick actions --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8">
        <a href="{{ route('programs') }}" class="bg-brand-gray rounded-xl p-6 text-center hover:bg-white/5 border border-white/5 transition group">
            <svg class="w-8 h-8 text-brand-yellow mx-auto mb-2 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <p class="text-white text-sm mt-2 font-medium">Book Class</p>
        </a>
        <a href="{{ route('trainers') }}" class="bg-brand-gray rounded-xl p-6 text-center hover:bg-white/5 border border-white/5 transition group">
            <svg class="w-8 h-8 text-brand-yellow mx-auto mb-2 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            <p class="text-white text-sm mt-2 font-medium">Find Trainer</p>
        </a>
        <a href="{{ route('member.progress') }}" class="bg-brand-gray rounded-xl p-6 text-center hover:bg-white/5 border border-white/5 transition group">
            <svg class="w-8 h-8 text-brand-yellow mx-auto mb-2 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
            </svg>
            <p class="text-white text-sm mt-2 font-medium">Track Weight</p>
        </a>
        <a href="{{ route('programs') }}" class="bg-brand-gray rounded-xl p-6 text-center hover:bg-white/5 border border-white/5 transition group">
            <svg class="w-8 h-8 text-brand-yellow mx-auto mb-2 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-white text-sm mt-2 font-medium">View Schedule</p>
        </a>
    </div>
</x-member-layout>
