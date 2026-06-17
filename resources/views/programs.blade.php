<x-app-layout title="Programmes Fitness à Tétouan | Musculation, HIIT, Yoga">
    @php
        $programData = [
            'Strength Training' => [
                'icon' => 'M11 4.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-3ZM9 8.5a1.5 1.5 0 0 1 1.5-1.5h1A1.5 1.5 0 0 1 13 8.5V9h2.5A1.5 1.5 0 0 1 17 10.5v5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 5 15.5v-5A1.5 1.5 0 0 1 6.5 9H9v-.5Z',
                'minutes' => '60 min',
                'intensity' => 4,
                'features' => ['Free weights & machines', 'Progressive overload', 'Form correction', 'Muscle building focus'],
            ],
            'HIIT' => [
                'icon' => 'M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z',
                'minutes' => '45 min',
                'intensity' => 5,
                'features' => ['Treadmill & bike zones', 'Group classes', 'Heart rate monitoring', 'Fat burning focus'],
            ],
            'Personal Training' => [
                'icon' => 'M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z',
                'minutes' => '60 min',
                'intensity' => 3,
                'features' => ['Custom workout plans', 'Nutrition guidance', 'Weekly progress', 'One-on-one coaching'],
            ],
            'Yoga & Flexibility' => [
                'icon' => 'M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25',
                'minutes' => '60 min',
                'intensity' => 2,
                'features' => ['Stretching routines', 'Breathing techniques', 'Stress relief', 'Mobility improvement'],
            ],
            'Nutrition Coaching' => [
                'icon' => 'M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z',
                'minutes' => '45 min',
                'intensity' => 1,
                'features' => ['Meal planning', 'Macro tracking', 'Supplement advice', 'Body composition analysis'],
            ],
            'Group Classes' => [
                'icon' => 'M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z',
                'minutes' => '60 min',
                'intensity' => 4,
                'features' => ['Motivating atmosphere', 'Variety of classes', 'Certified instructors', 'Community support'],
            ],
        ];

        $schedule = [
            ['time' => '06:00', 'Monday' => 'Strength Training', 'Tuesday' => 'HIIT', 'Wednesday' => 'Yoga & Flexibility', 'Thursday' => 'Strength Training', 'Friday' => 'HIIT', 'Saturday' => 'Group Classes', 'Sunday' => ''],
            ['time' => '08:00', 'Monday' => 'HIIT', 'Tuesday' => 'Strength Training', 'Wednesday' => 'Group Classes', 'Thursday' => 'Personal Training', 'Friday' => 'Yoga & Flexibility', 'Saturday' => 'Strength Training', 'Sunday' => ''],
            ['time' => '10:00', 'Monday' => 'Yoga & Flexibility', 'Tuesday' => 'Group Classes', 'Wednesday' => 'Personal Training', 'Thursday' => 'HIIT', 'Friday' => 'Nutrition Coaching', 'Saturday' => 'HIIT', 'Sunday' => 'Yoga & Flexibility'],
            ['time' => '12:00', 'Monday' => 'Nutrition Coaching', 'Tuesday' => 'Yoga & Flexibility', 'Wednesday' => 'HIIT', 'Thursday' => 'Nutrition Coaching', 'Friday' => 'Group Classes', 'Saturday' => 'Personal Training', 'Sunday' => ''],
            ['time' => '16:00', 'Monday' => 'Personal Training', 'Tuesday' => 'Nutrition Coaching', 'Wednesday' => 'Strength Training', 'Thursday' => 'Group Classes', 'Friday' => 'Personal Training', 'Saturday' => 'Yoga & Flexibility', 'Sunday' => ''],
            ['time' => '18:00', 'Monday' => 'Group Classes', 'Tuesday' => 'Personal Training', 'Wednesday' => 'HIIT', 'Thursday' => 'Yoga & Flexibility', 'Friday' => 'Strength Training', 'Saturday' => 'Group Classes', 'Sunday' => ''],
            ['time' => '20:00', 'Monday' => 'HIIT', 'Tuesday' => 'Group Classes', 'Wednesday' => 'Strength Training', 'Thursday' => 'HIIT', 'Friday' => 'Group Classes', 'Saturday' => '', 'Sunday' => ''],
        ];

        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    @endphp

    {{-- ===================== PAGE HEADER ===================== --}}
    <section class="bg-brand-black pt-32 pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="font-heading text-4xl md:text-5xl font-bold text-white uppercase">Our Programs</h1>
            <div class="w-24 h-1 bg-brand-yellow mx-auto mt-4 rounded-full"></div>
            <p class="text-gray-400 mt-6 max-w-2xl mx-auto">Tailored training programs designed for every fitness level and goal.</p>
        </div>
    </section>

    {{-- ===================== PROGRAMS GRID ===================== --}}
    <section class="py-24 bg-brand-dark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($programs as $program)
                    @php $pd = $programData[$program->name] ?? []; @endphp
                    <div x-reveal
                         class="group bg-[#111111] border border-white/5 rounded-2xl p-8 transition-all duration-300 hover:-translate-y-2 hover:border-brand-yellow/50 hover:shadow-[0_0_40px_rgba(229,193,0,0.1)]">
                        {{-- Icon --}}
                        <div class="w-14 h-14 rounded-xl bg-brand-yellow/10 flex items-center justify-center">
                            <svg class="w-8 h-8 text-brand-yellow" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $pd['icon'] ?? '' }}"/>
                            </svg>
                        </div>

                        {{-- Title --}}
                        <h3 class="font-heading text-2xl font-bold text-white uppercase mt-6">{{ $program->name }}</h3>

                        {{-- Description --}}
                        <p class="text-gray-400 mt-3 leading-relaxed text-sm">{{ $program->description }}</p>

                        {{-- Duration badge --}}
                        <div class="inline-flex items-center px-3 py-1 rounded-full bg-brand-yellow/10 text-brand-yellow text-sm mt-4">
                            {{ $pd['minutes'] ?? $program->duration }}
                        </div>

                        {{-- Intensity dots --}}
                        <div class="flex gap-1 mt-3">
                            @for($i = 1; $i <= 5; $i++)
                                <div class="w-2.5 h-2.5 rounded-full {{ $i <= ($pd['intensity'] ?? 3) ? 'bg-brand-yellow' : 'bg-gray-700' }}"></div>
                            @endfor
                        </div>

                        {{-- Features --}}
                        <ul class="mt-6 space-y-2">
                            @foreach($pd['features'] ?? [] as $feature)
                                <li class="flex items-center gap-2 text-gray-300 text-sm">
                                    <span class="text-brand-yellow font-bold shrink-0">✓</span>
                                    {{ $feature }}
                                </li>
                            @endforeach
                        </ul>

                        {{-- Book Now --}}
                        <button @click="openBooking({{ $program->id }}, '{{ $program->name }}')"
                                class="mt-8 w-full py-3 border border-brand-yellow text-brand-yellow rounded-lg font-heading font-semibold text-sm uppercase tracking-wider hover:bg-brand-yellow hover:text-brand-black transition-all hover:scale-[1.02]">
                            Book Now
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===================== SCHEDULE ===================== --}}
    <section class="py-24 bg-brand-black">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div x-reveal class="text-center mb-16">
                <h2 class="font-heading text-4xl md:text-5xl font-bold text-white uppercase inline-block relative pb-4">
                    Weekly Schedule
                    <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-16 h-1 bg-brand-yellow rounded-full"></span>
                </h2>
            </div>

            <div x-reveal class="overflow-x-auto rounded-2xl border border-white/5">
                <table class="w-full min-w-[700px] text-sm">
                    <thead>
                        <tr class="bg-brand-yellow">
                            <th class="text-left px-4 py-4 font-heading font-bold text-brand-black uppercase tracking-wider whitespace-nowrap">Time</th>
                            @foreach($days as $day)
                                <th class="px-4 py-4 font-heading font-bold text-brand-black uppercase tracking-wider text-center whitespace-nowrap">{{ substr($day, 0, 3) }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($schedule as $row)
                            <tr class="{{ $loop->even ? 'bg-white/5' : '' }} hover:bg-white/10 transition">
                                <td class="px-4 py-4 font-heading font-semibold text-white whitespace-nowrap">{{ $row['time'] }}</td>
                                @foreach($days as $day)
                                    @php
                                        $cell = $row[$day] ?? '';
                                        $trainerName = '';
                                        if ($cell) {
                                            $matching = $trainers->where('specialty', 'LIKE', '%' . str_replace(['&', ' '], '%', $cell) . '%')->first();
                                            $trainerName = $matching ? $matching->name : '';
                                        }
                                    @endphp
                                    <td class="px-4 py-4 text-center whitespace-nowrap relative group/cell">
                                        @if($cell)
                                            <span class="text-brand-yellow text-xs font-heading font-semibold uppercase tracking-wider cursor-default">{{ $cell }}</span>
                                            @if($trainerName)
                                                <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 px-3 py-1.5 bg-brand-yellow text-brand-black text-xs font-semibold rounded-lg opacity-0 group-hover/cell:opacity-100 transition pointer-events-none whitespace-nowrap z-10 shadow-lg">
                                                    {{ $trainerName }}
                                                </div>
                                            @endif
                                        @else
                                            <span class="text-gray-600 text-xs">—</span>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    {{-- ===================== CTA BANNER ===================== --}}
    <section class="py-16 bg-gradient-to-r from-brand-yellow to-brand-gold">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="font-heading text-3xl font-bold text-brand-black uppercase">Not Sure Which Program?</h2>
            <p class="text-brand-black/70 mt-4 text-lg">Book a free consultation with our fitness experts.</p>
            <a href="{{ route('contact') }}"
               class="inline-block mt-8 px-8 py-4 bg-brand-black text-white font-heading font-bold text-sm uppercase tracking-widest rounded-full hover:scale-105 transition-all">
                Book Free Consultation
            </a>
        </div>
    </section>

    {{-- ===================== BOOKING MODAL ===================== --}}
    <div x-data="bookingModal()"
         x-show="open"
         x-cloak
         @keydown.escape.window="open = false"
         class="fixed inset-0 z-[100] flex items-center justify-center p-4"
         style="display: none;">
        {{-- Backdrop --}}
        <div x-show="open"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="open = false"
             class="absolute inset-0 bg-black/80 backdrop-blur-sm"></div>

        {{-- Modal --}}
        <div x-show="open"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-4"
             class="relative w-full max-w-lg bg-brand-dark border border-white/10 rounded-2xl p-8 shadow-2xl overflow-y-auto max-h-[90vh]">
            {{-- Close --}}
            <button @click="open = false" class="absolute top-4 right-4 text-gray-400 hover:text-white transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            {{-- Success --}}
            <template x-if="success">
                <div class="text-center py-8">
                    <div class="w-16 h-16 bg-green-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <h3 class="font-heading text-xl font-bold text-white uppercase mb-2">Booking Confirmed!</h3>
                    <p class="text-gray-400 text-sm" x-text="successMessage"></p>
                </div>
            </template>

            <template x-if="!success">
                <div>
                    <h3 class="font-heading text-2xl font-bold text-white uppercase mb-1">Book a Session</h3>
                    <p class="text-gray-400 text-sm mb-6">
                        <span x-text="selectedProgram"></span>
                    </p>

                    <form @submit.prevent="submitBooking()" class="space-y-5">
                        <input type="hidden" name="program_id" x-model="form.program_id">

                        <div>
                            <label class="block text-sm font-heading font-semibold uppercase tracking-wider text-gray-300 mb-1.5">Date</label>
                            <input type="date" x-model="form.date" required
                                   min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                   class="w-full px-4 py-3 bg-brand-black border border-white/10 rounded-xl text-white placeholder-gray-500 focus:ring-2 focus:ring-brand-yellow focus:border-brand-yellow outline-none transition text-sm">
                            <p x-show="errors.date" x-text="errors.date" class="text-red-400 text-xs mt-1"></p>
                        </div>

                        <div>
                            <label class="block text-sm font-heading font-semibold uppercase tracking-wider text-gray-300 mb-1.5">Time</label>
                            <select x-model="form.time" required
                                    class="w-full px-4 py-3 bg-brand-black border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-brand-yellow focus:border-brand-yellow outline-none transition text-sm">
                                <option value="">Select a time</option>
                                <option value="06:00">06:00 AM</option>
                                <option value="08:00">08:00 AM</option>
                                <option value="10:00">10:00 AM</option>
                                <option value="12:00">12:00 PM</option>
                                <option value="14:00">02:00 PM</option>
                                <option value="16:00">04:00 PM</option>
                                <option value="18:00">06:00 PM</option>
                                <option value="20:00">08:00 PM</option>
                            </select>
                            <p x-show="errors.time" x-text="errors.time" class="text-red-400 text-xs mt-1"></p>
                        </div>

                        <div>
                            <label class="block text-sm font-heading font-semibold uppercase tracking-wider text-gray-300 mb-1.5">Trainer</label>
                            <select x-model="form.trainer_id" required
                                    class="w-full px-4 py-3 bg-brand-black border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-brand-yellow focus:border-brand-yellow outline-none transition text-sm">
                                <option value="">Select a trainer</option>
                                @foreach($trainers as $trainer)
                                    <option value="{{ $trainer->id }}">{{ $trainer->name }} — {{ $trainer->specialty }}</option>
                                @endforeach
                            </select>
                            <p x-show="errors.trainer_id" x-text="errors.trainer_id" class="text-red-400 text-xs mt-1"></p>
                        </div>

                        <div>
                            <label class="block text-sm font-heading font-semibold uppercase tracking-wider text-gray-300 mb-1.5">Your Name</label>
                            <input type="text" x-model="form.name" required placeholder="John Doe"
                                   class="w-full px-4 py-3 bg-brand-black border border-white/10 rounded-xl text-white placeholder-gray-500 focus:ring-2 focus:ring-brand-yellow focus:border-brand-yellow outline-none transition text-sm">
                            <p x-show="errors.name" x-text="errors.name" class="text-red-400 text-xs mt-1"></p>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-heading font-semibold uppercase tracking-wider text-gray-300 mb-1.5">Email</label>
                                <input type="email" x-model="form.email" required placeholder="john@example.com"
                                       class="w-full px-4 py-3 bg-brand-black border border-white/10 rounded-xl text-white placeholder-gray-500 focus:ring-2 focus:ring-brand-yellow focus:border-brand-yellow outline-none transition text-sm">
                                <p x-show="errors.email" x-text="errors.email" class="text-red-400 text-xs mt-1"></p>
                            </div>
                            <div>
                                <label class="block text-sm font-heading font-semibold uppercase tracking-wider text-gray-300 mb-1.5">Phone</label>
                                <input type="text" x-model="form.phone" placeholder="555-0100"
                                       class="w-full px-4 py-3 bg-brand-black border border-white/10 rounded-xl text-white placeholder-gray-500 focus:ring-2 focus:ring-brand-yellow focus:border-brand-yellow outline-none transition text-sm">
                            </div>
                        </div>

                        <button type="submit" :disabled="loading"
                                class="w-full py-3.5 bg-brand-yellow text-brand-black font-heading font-bold text-sm uppercase tracking-widest rounded-xl hover:bg-yellow-400 transition-all hover:scale-[1.02] disabled:opacity-50 disabled:cursor-not-allowed"
                                x-text="loading ? 'Booking...' : 'Confirm Booking'">
                        </button>
                    </form>
                </div>
            </template>
        </div>
    </div>

    <script>
        function bookingModal() {
            return {
                open: false,
                success: false,
                successMessage: '',
                loading: false,
                selectedProgram: '',
                form: {
                    program_id: '',
                    trainer_id: '',
                    date: '',
                    time: '',
                    name: '',
                    email: '',
                    phone: '',
                },
                errors: {},
                openBooking(programId, programName) {
                    this.open = true;
                    this.success = false;
                    this.loading = false;
                    this.selectedProgram = programName;
                    this.form.program_id = programId;
                    this.errors = {};
                },
                submitBooking() {
                    this.loading = true;
                    this.errors = {};

                    fetch('{{ route("programs.book") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify(this.form),
                    })
                    .then(r => r.json().then(data => ({ status: r.status, data })))
                    .then(({ status, data }) => {
                        if (status === 200 && data.success) {
                            this.success = true;
                            this.successMessage = data.message || 'Your session has been booked successfully!';
                        } else if (status === 422) {
                            this.errors = data.errors || {};
                        } else {
                            alert(data.message || 'Something went wrong. Please try again.');
                        }
                    })
                    .catch(() => alert('Network error. Please try again.'))
                    .finally(() => this.loading = false);
                }
            };
        }
    </script>

    <style>
        [x-cloak] { display: none !important; }
        .overflow-x-auto::-webkit-scrollbar { height: 6px; }
        .overflow-x-auto::-webkit-scrollbar-track { background: transparent; }
        .overflow-x-auto::-webkit-scrollbar-thumb { background: #333; border-radius: 3px; }
        .overflow-x-auto::-webkit-scrollbar-thumb:hover { background: #555; }
    </style>
</x-app-layout>
