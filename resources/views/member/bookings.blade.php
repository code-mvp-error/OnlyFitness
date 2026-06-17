<x-member-layout>
    <x-slot:title>My Bookings</x-slot:title>

    <div x-data="{
        viewMode: 'list',
        selectedDay: null,
        bookedDates: {{ $bookingsByDate->keys()->map(fn($d) => \Carbon\Carbon::parse($d)->format('Y-m-d'))->toJson() }},
        get hasBookings() {
            return this.selectedDay && this.bookedDates.includes(this.selectedDay);
        },
        get dayBookings() {
            if (!this.selectedDay) return [];
            return Object.entries({{ $bookings->groupBy(fn($b) => \Carbon\Carbon::parse($b->date)->format('Y-m-d'))->map(fn($items, $date) => [$date => $items->map(fn($b) => ['id' => $b->id, 'program' => $b->program?->name ?? 'General', 'trainer' => $b->trainer?->name ?? 'TBD', 'time' => \Carbon\Carbon::parse($b->time)->format('g:i A'), 'status' => $b->status])])->values()->toJson() }})
                .find(([date]) => date === this.selectedDay)?.[1] || [];
        }
    }">
        {{-- View toggle --}}
        <div class="flex items-center gap-2 mb-6 bg-brand-gray rounded-lg p-1 w-fit border border-white/5">
            <button @click="viewMode = 'list'"
                    :class="viewMode === 'list' ? 'bg-brand-yellow text-brand-black' : 'text-gray-400 hover:text-white'"
                    class="px-4 py-2 rounded-md text-sm font-medium transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                </svg>
                List
            </button>
            <button @click="viewMode = 'calendar'"
                    :class="viewMode === 'calendar' ? 'bg-brand-yellow text-brand-black' : 'text-gray-400 hover:text-white'"
                    class="px-4 py-2 rounded-md text-sm font-medium transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Calendar
            </button>
        </div>

        {{-- List view --}}
        <div x-show="viewMode === 'list'">
            @forelse($bookings as $booking)
                @php $date = \Carbon\Carbon::parse($booking->date); @endphp
                <div class="bg-brand-gray rounded-xl p-6 border border-white/5 mb-4 flex items-start gap-4">
                    <div class="bg-brand-yellow text-brand-black rounded-lg px-4 py-2 text-center min-w-[80px] shrink-0">
                        <p class="text-2xl font-bold leading-tight">{{ $date->format('d') }}</p>
                        <p class="text-xs font-bold uppercase">{{ $date->format('M') }}</p>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-white font-bold">{{ $booking->program?->name ?? 'General Session' }}</p>
                        <p class="text-gray-400 text-sm">{{ \Carbon\Carbon::parse($booking->time)->format('g:i A') }} — {{ \Carbon\Carbon::parse($booking->time)->addHour()->format('g:i A') }}</p>
                        <p class="text-brand-yellow text-sm">with {{ $booking->trainer?->name ?? 'TBD' }}</p>
                    </div>
                    <div class="text-right shrink-0">
                        @php
                            $statusColors = ['confirmed' => 'text-green-400', 'completed' => 'text-gray-400', 'cancelled' => 'text-red-400'];
                        @endphp
                        <span class="text-sm font-medium capitalize {{ $statusColors[$booking->status] ?? 'text-gray-400' }}">{{ $booking->status }}</span>
                        @if($booking->status === 'completed')
                            <a href="{{ route('programs') }}" class="block text-brand-yellow text-xs hover:underline mt-1">Book Again</a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="bg-brand-gray rounded-xl p-8 border border-white/5 text-center">
                    <p class="text-gray-400">No bookings yet</p>
                    <a href="{{ route('programs') }}" class="text-brand-yellow text-sm hover:underline mt-2 inline-block">Book your first class</a>
                </div>
            @endforelse
        </div>

        {{-- Calendar view --}}
        <div x-show="viewMode === 'calendar'" x-cloak>
            {{-- Month header --}}
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-white font-heading text-lg font-bold uppercase">{{ now()->format('F Y') }}</h3>
                <span class="text-gray-400 text-sm">{{ now()->daysInMonth }} days</span>
            </div>

            {{-- Day headers --}}
            <div class="grid grid-cols-7 gap-2 mb-2">
                @foreach(['Sun','Mon','Tue','Wed','Thu','Fri','Sat'] as $day)
                    <div class="text-center text-gray-500 text-xs font-medium uppercase py-2">{{ $day }}</div>
                @endforeach
            </div>

            {{-- Calendar grid --}}
            <div class="grid grid-cols-7 gap-2">
                {{-- Empty cells for offset --}}
                @if($calendarDays[0]['dayOfWeek'] > 0)
                    @for($i = 0; $i < $calendarDays[0]['dayOfWeek']; $i++)
                        <div></div>
                    @endfor
                @endif

                @foreach($calendarDays as $day)
                    @php
                        $isToday = $day['date'] === now()->format('Y-m-d');
                        $isPast = $day['date'] < now()->format('Y-m-d');
                    @endphp
                    <button @click="selectedDay = '{{ $day['date'] }}'"
                            :class="{
                                'bg-brand-yellow/20 text-brand-yellow font-bold': selectedDay === '{{ $day['date'] }}',
                                'border-brand-yellow/50': selectedDay === '{{ $day['date'] }}'
                            }"
                            class="relative p-3 rounded-lg text-center text-sm transition cursor-pointer
                                   {{ $day['hasBooking'] ? 'bg-brand-yellow/10 text-brand-yellow font-bold' : 'text-gray-400' }}
                                   {{ $isToday ? 'ring-2 ring-brand-yellow/50' : '' }}
                                   {{ $isPast ? 'opacity-40' : 'hover:bg-white/5' }}
                                   border border-transparent">
                        <span>{{ $day['day'] }}</span>
                        @if($day['hasBooking'])
                            <span class="absolute bottom-1 left-1/2 -translate-x-1/2 w-1 h-1 bg-brand-yellow rounded-full"></span>
                        @endif
                    </button>
                @endforeach
            </div>

            {{-- Selected day bookings --}}
            <div x-show="selectedDay" x-cloak class="mt-6">
                <h4 class="text-white font-medium mb-3" x-text="'Bookings for ' + selectedDay"></h4>
                <template x-if="selectedDay && bookedDates.includes(selectedDay)">
                    <div>
                        <template x-for="booking in dayBookings" :key="booking.id">
                            <div class="bg-brand-gray rounded-xl p-4 border border-white/5 mb-3 flex items-start gap-4">
                                <div class="flex-1">
                                    <p class="text-white font-bold" x-text="booking.program"></p>
                                    <p class="text-gray-400 text-sm" x-text="booking.time"></p>
                                    <p class="text-brand-yellow text-sm" x-text="'with ' + booking.trainer"></p>
                                </div>
                                <span class="text-sm font-medium capitalize"
                                      :class="{'text-green-400': booking.status === 'confirmed', 'text-gray-400': booking.status === 'completed', 'text-red-400': booking.status === 'cancelled'}"
                                      x-text="booking.status"></span>
                            </div>
                        </template>
                    </div>
                </template>
                <template x-if="selectedDay && !bookedDates.includes(selectedDay)">
                    <div class="bg-brand-gray rounded-xl p-6 border border-white/5 text-center">
                        <p class="text-gray-400">No bookings on this day</p>
                    </div>
                </template>
            </div>
        </div>
    </div>
</x-member-layout>
