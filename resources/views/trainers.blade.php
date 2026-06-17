<x-app-layout title="Nos Coachs Sportifs à Tétouan | Entraîneurs Certifiés">
    @php
        $trainerDisplay = [
            'Marcus Johnson' => [
                'display_name' => 'Marcus Steel',
                'photo' => 'https://images.unsplash.com/photo-1567013127542-490d757e51fc?w=400',
                'filter' => 'Strength',
                'modal_bio' => 'Former competitive powerlifter with 10+ years coaching experience. Marcus specializes in compound movements, progressive overload, and helping clients break through plateaus with proven strength protocols. His training philosophy is built on consistency, proper form, and measurable progress.',
            ],
            'Sarah Chen' => [
                'display_name' => 'Sarah Blaze',
                'photo' => 'https://images.unsplash.com/photo-1594381898411-846e7d193883?w=400',
                'filter' => 'Cardio',
                'modal_bio' => 'HIIT specialist and marathon runner with a passion for high-energy training. Sarah helps clients push past their limits with science-backed interval protocols designed for maximum fat loss and cardiovascular improvement. Her sessions are intense, fun, and results-driven.',
            ],
            'David Rivera' => [
                'display_name' => 'David Iron',
                'photo' => 'https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?w=400',
                'filter' => 'Strength',
                'modal_bio' => 'Bodybuilding pro with multiple competition wins and over 8 years of coaching experience. David specializes in muscle hypertrophy, competition preparation, and advanced training techniques for serious athletes looking to transform their physique.',
            ],
            'Emily Torres' => [
                'display_name' => 'Elena Power',
                'photo' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?w=400',
                'filter' => 'Nutrition',
                'modal_bio' => 'Certified nutritionist and yoga instructor with a holistic approach to wellness. Elena combines mindful movement with science-backed meal planning to help clients achieve sustainable, long-lasting results. Her programs focus on the mind-body connection and nutritional optimization.',
            ],
        ];

        $timeSlots = ['6AM', '8AM', '10AM', '12PM', '2PM', '4PM', '6PM', '8PM'];
        $weekdayAvail = [true, true, true, true, true, true, true, true];
        $weekendAvail = [false, true, true, true, true, true, false, false];

        $trainersData = $trainers->map(function ($t) use ($trainerDisplay) {
            $td = $trainerDisplay[$t->name] ?? [
                'display_name' => $t->name,
                'photo' => '',
                'filter' => 'Strength',
                'modal_bio' => $t->bio,
            ];
            return [
                'id' => $t->id,
                'name' => $td['display_name'] ?? $t->name,
                'specialty' => $t->specialty,
                'filter_category' => $td['filter'] ?? 'Strength',
                'photo' => $td['photo'] ?? '',
                'modal_bio' => $td['modal_bio'] ?? $t->bio,
                'certifications' => $t->certifications ?? [],
                'instagram' => $t->social_links['instagram'] ?? '#',
            ];
        })->values();
    @endphp

    {{-- ===================== PAGE HEADER ===================== --}}
    <section class="bg-brand-black pt-32 pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="font-heading text-4xl md:text-5xl font-bold text-white uppercase">Elite Trainers</h1>
            <div class="w-24 h-1 bg-brand-yellow mx-auto mt-4 rounded-full"></div>
            <p class="text-gray-400 mt-6 max-w-2xl mx-auto">Learn from the best. Our certified trainers bring years of experience and passion to every session.</p>
        </div>
    </section>

    {{-- ===================== ALPINE SCOPE ===================== --}}
    <script>window.trainerData = @json($trainersData);</script>
    <div x-data="trainerPage()" x-init="trainers = window.trainerData">

        {{-- ===================== FILTER TABS ===================== --}}
        <section class="bg-brand-black pb-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-wrap items-center justify-center gap-3">
                    <template x-for="tab in ['ALL', 'STRENGTH', 'CARDIO', 'NUTRITION', 'YOGA']" :key="tab">
                        <button @click="activeFilter = tab"
                                :class="activeFilter === tab
                                    ? 'bg-brand-yellow text-brand-black font-bold rounded-full px-6 py-2'
                                    : 'bg-brand-gray text-gray-400 hover:text-white rounded-full px-6 py-2 border border-white/10'"
                                class="text-sm uppercase tracking-wider transition-all duration-200 font-heading">
                            <span x-text="tab"></span>
                        </button>
                    </template>
                </div>
            </div>
        </section>

        {{-- ===================== TRAINERS GRID ===================== --}}
        <section class="bg-brand-dark py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($trainers as $index => $trainer)
                        @php $td = $trainerDisplay[$trainer->name] ?? []; @endphp
                        <div @click="openModal({{ $index }})"
                             x-show="activeFilter === 'ALL' || activeFilter === '{{ $td['filter'] ?? 'Strength' }}'"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="group relative overflow-hidden rounded-2xl bg-brand-black cursor-pointer">
                            {{-- Image --}}
                            <div class="overflow-hidden">
                                <img src="{{ $td['photo'] ?? '' }}"
                                     srcset="{{ ($td['photo'] ?? '') ? str_replace('?w=400', '?w=400 400w, ', $td['photo']) . str_replace('?w=400', '?w=800 800w', $td['photo']) : '' }}"
                                     sizes="(max-width: 768px) 100vw, (max-width: 1024px) 50vw, 25vw"
                                     alt="{{ $td['display_name'] ?? $trainer->name }}"
                                     class="h-96 w-full object-cover transition-transform duration-500 group-hover:scale-110"
                                     loading="lazy">
                            </div>
                            {{-- Hover darken --}}
                            <div class="absolute inset-0 bg-brand-black/0 group-hover:bg-brand-black/40 transition-all duration-300"></div>
                            {{-- Gradient overlay --}}
                            <div class="absolute bottom-0 left-0 right-0 h-1/2 bg-gradient-to-t from-brand-black via-brand-black/80 to-transparent pointer-events-none"></div>
                            {{-- Content overlay --}}
                            <div class="absolute bottom-0 left-0 right-0 p-6 z-10 pointer-events-none">
                                <h3 class="text-xl font-heading font-bold text-white">{{ $td['display_name'] ?? $trainer->name }}</h3>
                                <span class="inline-block mt-2 px-3 py-1 bg-brand-yellow/20 text-brand-yellow text-sm rounded-full border border-brand-yellow/30">{{ $td['filter'] ?? $trainer->specialty }}</span>
                                <p class="text-gray-400 text-sm mt-2 line-clamp-2">{{ $trainer->bio }}</p>
                                <div class="mt-3 flex gap-3 pointer-events-auto">
                                    @if(isset($trainer->social_links['instagram']))
                                        <a href="{{ $trainer->social_links['instagram'] }}" target="_blank" @click.stop
                                           class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-brand-yellow hover:text-brand-black transition">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                                        </a>
                                    @endif
                                    <a href="mailto:contact@onlyfit.club" @click.stop
                                       class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-brand-yellow hover:text-brand-black transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    </a>
                                </div>
                            </div>
                            {{-- View Profile button on hover --}}
                            <div class="absolute inset-0 flex items-center justify-center z-20 opacity-0 group-hover:opacity-100 transition-all duration-300 translate-y-4 group-hover:translate-y-0 pointer-events-none">
                                <span class="bg-brand-yellow text-brand-black px-6 py-3 rounded-full font-bold text-sm uppercase tracking-wider shadow-lg">View Profile</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- ===================== JOIN TEAM CTA ===================== --}}
        <section class="bg-brand-black py-24">
            <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="font-heading text-3xl font-bold text-white uppercase">Want to Join Our Team?</h2>
                <p class="text-gray-400 mt-4">We&#39;re always looking for passionate trainers. Send us your resume.</p>
                <a href="{{ route('contact') }}" class="inline-block mt-8 px-8 py-3 border border-brand-yellow text-brand-yellow rounded-full font-heading font-semibold text-sm uppercase tracking-wider hover:bg-brand-yellow hover:text-brand-black transition-all">Apply Now</a>
            </div>
        </section>

        {{-- ===================== TRAINER MODAL ===================== --}}
        <div x-show="open"
             x-cloak
             @keydown.escape.window="closeModal()"
             class="fixed inset-0 z-[100] flex items-start justify-center p-4 pt-16 overflow-y-auto"
             style="display: none;">
            {{-- Backdrop --}}
            <div x-show="open"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="closeModal()"
                 class="fixed inset-0 bg-black/90 backdrop-blur-sm"></div>

            {{-- Modal content --}}
            <div x-show="open"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-8"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 scale-95 translate-y-8"
                 @click.away="closeModal()"
                 class="relative w-full max-w-4xl bg-brand-gray rounded-3xl overflow-hidden border border-white/10 shadow-2xl z-10">
                {{-- Close button --}}
                <button @click="closeModal()" class="absolute top-4 right-4 z-30 w-10 h-10 rounded-full bg-white/10 text-white hover:bg-brand-yellow hover:text-brand-black transition flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

                <div class="grid md:grid-cols-2 min-h-[500px]">
                    {{-- Left: Image --}}
                    <div class="h-80 md:h-full overflow-hidden">
                        <img :src="selectedTrainer ? selectedTrainer.photo.replace('w=400', 'w=800') : ''"
                             :alt="selectedTrainer ? selectedTrainer.name : ''"
                             class="w-full h-full object-cover">
                    </div>

                    {{-- Right: Content --}}
                    <div class="p-8 md:p-12 relative">
                        <template x-if="selectedTrainer">
                            <div>
                                <h3 class="text-3xl font-heading font-bold text-white uppercase" x-text="selectedTrainer.name"></h3>
                                <span class="inline-block mt-3 px-4 py-1 bg-brand-yellow text-brand-black rounded-full text-sm font-bold" x-text="selectedTrainer.specialty"></span>
                                <p class="text-gray-300 mt-4 leading-relaxed" x-text="selectedTrainer.modal_bio"></p>

                                {{-- Certifications --}}
                                <div class="mt-6" x-show="selectedTrainer.certifications && selectedTrainer.certifications.length">
                                    <h4 class="text-brand-yellow text-sm uppercase tracking-wider font-heading font-semibold">Certifications</h4>
                                    <ul class="mt-3 space-y-2">
                                        <template x-for="cert in selectedTrainer.certifications" :key="cert">
                                            <li class="flex items-center gap-2 text-gray-300 text-sm">
                                                <span class="text-brand-yellow font-bold shrink-0">✓</span>
                                                <span x-text="cert"></span>
                                            </li>
                                        </template>
                                    </ul>
                                </div>

                                {{-- Availability --}}
                                <div class="mt-6">
                                    <h4 class="text-brand-yellow text-sm uppercase tracking-wider font-heading font-semibold">Availability</h4>
                                    <div class="mt-3 space-y-3">
                                        <div class="bg-brand-yellow/10 border border-brand-yellow/30 rounded-xl p-4">
                                            <p class="text-xs text-gray-400 uppercase tracking-wider">Mon - Fri</p>
                                            <div class="flex flex-wrap gap-1.5 mt-2">
                                                @foreach($timeSlots as $si => $slot)
                                                    <div class="px-2.5 py-1 rounded-md text-xs font-semibold {{ $weekdayAvail[$si] ? 'bg-brand-yellow/20 text-brand-yellow' : 'bg-white/5 text-gray-600' }}">
                                                        {{ $slot }}
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="bg-brand-yellow/10 border border-brand-yellow/30 rounded-xl p-4">
                                            <p class="text-xs text-gray-400 uppercase tracking-wider">Sat - Sun</p>
                                            <div class="flex flex-wrap gap-1.5 mt-2">
                                                @foreach($timeSlots as $si => $slot)
                                                    <div class="px-2.5 py-1 rounded-md text-xs font-semibold {{ $weekendAvail[$si] ? 'bg-brand-yellow/20 text-brand-yellow' : 'bg-white/5 text-gray-600' }}">
                                                        {{ $slot }}
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <a href="{{ route('programs') }}" class="mt-8 w-full block text-center bg-brand-yellow text-brand-black py-4 rounded-xl font-heading font-bold text-sm uppercase tracking-widest hover:bg-brand-gold transition-all hover:scale-[1.02]">Book Session</a>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function trainerPage() {
            return {
                activeFilter: 'ALL',
                trainers: [],
                selectedTrainer: null,
                open: false,
                openModal(index) {
                    this.selectedTrainer = this.trainers[index];
                    this.open = true;
                    document.body.style.overflow = 'hidden';
                },
                closeModal() {
                    this.open = false;
                    document.body.style.overflow = '';
                },
            };
        }
    </script>

    <style>
        [x-cloak] { display: none !important; }
        .overflow-y-auto::-webkit-scrollbar { width: 6px; }
        .overflow-y-auto::-webkit-scrollbar-track { background: transparent; }
        .overflow-y-auto::-webkit-scrollbar-thumb { background: #333; border-radius: 3px; }
        .overflow-y-auto::-webkit-scrollbar-thumb:hover { background: #555; }
    </style>
</x-app-layout>
