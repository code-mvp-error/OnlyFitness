<x-admin-layout>
    @section('title', 'Bookings')

    <div x-data="{
        view: 'list', addOpen: false, rescheduleId: null, rescheduleDate: '', rescheduleTime: '', deleteId: null
    }">
        @if(session('success'))
            <div class="bg-green-500/10 border border-green-500/30 text-green-400 rounded-xl p-4 mb-6 text-sm">{{ session('success') }}</div>
        @endif

        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-2">
                <button @click="view = 'list'"
                        :class="view === 'list' ? 'bg-brand-yellow text-brand-black' : 'bg-brand-gray text-gray-400'"
                        class="px-4 py-2 rounded-lg text-sm font-medium transition">List</button>
                <button @click="view = 'calendar'"
                        :class="view === 'calendar' ? 'bg-brand-yellow text-brand-black' : 'bg-brand-gray text-gray-400'"
                        class="px-4 py-2 rounded-lg text-sm font-medium transition">Calendar</button>
            </div>
            <button @click="addOpen = true" class="bg-brand-yellow text-brand-black px-4 py-2.5 rounded-lg font-bold text-sm hover:bg-brand-gold transition whitespace-nowrap">+ New Booking</button>
        </div>

        {{-- List View --}}
        <div x-show="view === 'list'" x-transition:enter="transition ease-out duration-200">
            <div class="bg-brand-gray rounded-xl border border-white/5 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-gray-500 text-xs uppercase tracking-wider border-b border-white/10">
                                <th class="px-6 py-4 text-left font-semibold">Date</th>
                                <th class="px-6 py-4 text-left font-semibold">Time</th>
                                <th class="px-6 py-4 text-left font-semibold hidden md:table-cell">Member</th>
                                <th class="px-6 py-4 text-left font-semibold">Trainer</th>
                                <th class="px-6 py-4 text-left font-semibold hidden lg:table-cell">Program</th>
                                <th class="px-6 py-4 text-left font-semibold">Status</th>
                                <th class="px-6 py-4 text-right font-semibold">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookings as $booking)
                                <tr class="border-b border-white/5 hover:bg-white/5 transition">
                                    <td class="px-6 py-4 text-white">{{ $booking->date }}</td>
                                    <td class="px-6 py-4 text-gray-400">{{ \Carbon\Carbon::parse($booking->time)->format('g:i A') }}</td>
                                    <td class="px-6 py-4 text-gray-400 hidden md:table-cell">{{ $booking->user->name ?? 'Guest' }}</td>
                                    <td class="px-6 py-4 text-gray-400">{{ $booking->trainer->name ?? '—' }}</td>
                                    <td class="px-6 py-4 text-gray-400 hidden lg:table-cell">{{ $booking->program->name ?? '—' }}</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-block px-3 py-1 rounded-full text-xs font-bold
                                            {{ $booking->status === 'confirmed' ? 'bg-green-500/10 text-green-400' : '' }}
                                            {{ $booking->status === 'pending' ? 'bg-brand-yellow/10 text-brand-yellow' : '' }}
                                            {{ $booking->status === 'cancelled' ? 'bg-red-500/10 text-red-400' : '' }}">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-1">
                                            @if($booking->status !== 'confirmed')
                                                <form method="POST" action="{{ route('admin.bookings.confirm', $booking->id) }}" class="inline">
                                                    @csrf @method('PUT')
                                                    <button class="px-3 py-1.5 bg-green-500/10 text-green-400 rounded-lg text-xs font-semibold hover:bg-green-500/20 transition">Confirm</button>
                                                </form>
                                            @endif
                                            @if($booking->status !== 'cancelled')
                                                <form method="POST" action="{{ route('admin.bookings.cancel', $booking->id) }}" class="inline" onsubmit="return confirm('Cancel this booking?')">
                                                    @csrf @method('PUT')
                                                    <button class="px-3 py-1.5 bg-red-500/10 text-red-400 rounded-lg text-xs font-semibold hover:bg-red-500/20 transition">Cancel</button>
                                                </form>
                                            @endif
                                            <button @click="rescheduleId = {{ $booking->id }}; rescheduleDate = '{{ $booking->date }}'; rescheduleTime = '{{ \Carbon\Carbon::parse($booking->time)->format('H:i') }}'"
                                                    class="px-3 py-1.5 bg-brand-yellow/10 text-brand-yellow rounded-lg text-xs font-semibold hover:bg-brand-yellow/20 transition">Reschedule</button>
                                            <button @click="deleteId = {{ $booking->id }}" class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center text-red-400 hover:bg-red-500/20 transition ml-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="7" class="px-6 py-12 text-center text-gray-500">No bookings yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Calendar View --}}
        <div x-show="view === 'calendar'" x-transition:enter="transition ease-out duration-200" x-cloak>
            <div class="bg-brand-gray rounded-xl border border-white/5 p-6">
                <div class="grid grid-cols-7 gap-2">
                    @foreach(['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] as $dayName)
                        <div class="text-center text-gray-500 text-xs uppercase tracking-wider font-semibold py-2">{{ $dayName }}</div>
                    @endforeach
                    @php $firstDow = now()->startOfMonth()->dayOfWeek; if($firstDow === 0) $firstDow = 7; @endphp
                    @for($i = 1; $i < $firstDow; $i++)
                        <div></div>
                    @endfor
                    @foreach($calendarDays as $day)
                        @php $count = ($bookingsByDate->get($day['date'], collect()))->count(); @endphp
                        <div class="aspect-square bg-brand-black/50 rounded-lg p-2 hover:bg-white/5 transition relative group cursor-pointer">
                            <span class="text-gray-400 text-sm">{{ $day['day'] }}</span>
                            @if($count > 0)
                                <div class="flex gap-1 mt-1">
                                    @for($i = 0; $i < min($count, 4); $i++)
                                        <span class="w-2 h-2 rounded-full bg-brand-yellow"></span>
                                    @endfor
                                </div>
                                <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 bg-brand-yellow text-brand-black text-xs font-bold px-3 py-1.5 rounded-lg opacity-0 group-hover:opacity-100 transition whitespace-nowrap pointer-events-none shadow-lg z-10">
                                    {{ $count }} booking{{ $count > 1 ? 's' : '' }}
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Add Booking Modal --}}
        <div x-show="addOpen" x-cloak @keydown.escape.window="addOpen = false" class="fixed inset-0 z-[100] flex items-center justify-center p-4">
            <div x-show="addOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="addOpen = false" class="absolute inset-0 bg-black/80 backdrop-blur-sm"></div>
            <div x-show="addOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95 translate-y-4" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100 translate-y-0" x-transition:leave-end="opacity-0 scale-95 translate-y-4" class="relative w-full max-w-lg bg-brand-gray rounded-2xl border border-white/10 shadow-2xl z-10 p-8">
                <button @click="addOpen = false" class="absolute top-4 right-4 text-gray-400 hover:text-white transition"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                <h3 class="font-heading font-bold text-white text-lg mb-6">New Booking</h3>
                <form method="POST" action="{{ route('admin.bookings.store') }}" class="space-y-4">
                    @csrf
                    <div><label class="text-gray-300 text-sm font-medium mb-2 block">Member</label>
                        <select name="user_id" required class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition">
                            <option value="">Select member</option>
                            @foreach(\App\Models\User::where('is_admin', false)->get() as $u)
                                <option value="{{ $u->id }}">{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div><label class="text-gray-300 text-sm font-medium mb-2 block">Program</label>
                        <select name="program_id" required class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition">
                            @foreach(\App\Models\Program::all() as $p)
                                <option value="{{ $p->id }}">{{ $p->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div><label class="text-gray-300 text-sm font-medium mb-2 block">Trainer (optional)</label>
                        <select name="trainer_id" class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition">
                            <option value="">No trainer</option>
                            @foreach(\App\Models\Trainer::all() as $t)
                                <option value="{{ $t->id }}">{{ $t->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div><label class="text-gray-300 text-sm font-medium mb-2 block">Date</label><input type="date" name="date" value="{{ now()->addDay()->format('Y-m-d') }}" required class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition"></div>
                    <div><label class="text-gray-300 text-sm font-medium mb-2 block">Time</label><input type="time" name="time" value="10:00" required class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition"></div>
                    <button type="submit" class="w-full bg-brand-yellow text-brand-black rounded-xl py-3 font-bold hover:bg-brand-gold transition">Create Booking</button>
                </form>
            </div>
        </div>

        {{-- Reschedule Modal --}}
        <div x-show="rescheduleId" x-cloak @keydown.escape.window="rescheduleId = null" class="fixed inset-0 z-[100] flex items-center justify-center p-4">
            <div x-show="rescheduleId" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="rescheduleId = null" class="absolute inset-0 bg-black/80 backdrop-blur-sm"></div>
            <div x-show="rescheduleId" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95 translate-y-4" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100 translate-y-0" x-transition:leave-end="opacity-0 scale-95 translate-y-4" class="relative w-full max-w-md bg-brand-gray rounded-2xl border border-white/10 shadow-2xl z-10 p-8">
                <button @click="rescheduleId = null" class="absolute top-4 right-4 text-gray-400 hover:text-white transition"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                <h3 class="font-heading font-bold text-white text-lg mb-6">Reschedule Booking</h3>
                <form method="POST" x-bind:action="`{{ url('admin/bookings') }}/${rescheduleId}/reschedule`" class="space-y-4">
                    @csrf @method('PUT')
                    <div><label class="text-gray-300 text-sm font-medium mb-2 block">New Date</label><input type="date" name="date" x-model="rescheduleDate" required class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition"></div>
                    <div><label class="text-gray-300 text-sm font-medium mb-2 block">New Time</label><input type="time" name="time" x-model="rescheduleTime" required class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition"></div>
                    <button type="submit" class="w-full bg-brand-yellow text-brand-black rounded-xl py-3 font-bold hover:bg-brand-gold transition">Update Schedule</button>
                </form>
            </div>
        </div>

        {{-- Delete Confirmation --}}
        <div x-show="deleteId" x-cloak @keydown.escape.window="deleteId = null" class="fixed inset-0 z-[100] flex items-center justify-center p-4">
            <div x-show="deleteId" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="deleteId = null" class="absolute inset-0 bg-black/80 backdrop-blur-sm"></div>
            <div x-show="deleteId" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="relative bg-brand-gray rounded-2xl p-6 border border-white/10 max-w-sm w-full z-10 text-center">
                <p class="text-white font-bold text-lg mb-2">Delete Booking?</p>
                <p class="text-gray-400 text-sm mb-6">This action cannot be undone.</p>
                <div class="flex gap-3 justify-center">
                    <button @click="deleteId = null" class="px-6 py-2.5 rounded-xl border border-white/10 text-gray-400 hover:text-white transition font-medium">Cancel</button>
                    <form method="POST" x-bind:action="`{{ url('admin/bookings') }}/${deleteId}`">
                        @csrf @method('DELETE')
                        <button type="submit" class="px-6 py-2.5 rounded-xl bg-red-500 text-white font-medium hover:bg-red-600 transition">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
