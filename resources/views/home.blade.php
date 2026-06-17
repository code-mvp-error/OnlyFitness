<x-app-layout title="Salle de Sport à Tétouan | Programmes Fitness & Coaching">
    {{-- ===================== HERO ===================== --}}
    <section class="relative min-h-screen flex items-center overflow-hidden bg-brand-black">
        <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?w=1920&q=80" alt="Only Fitness gym equipment and training space" class="absolute inset-0 w-full h-full object-cover opacity-40" loading="lazy">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,rgba(229,193,0,0.12)_0%,transparent_70%)]"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-brand-black/90 via-brand-black/60 to-transparent"></div>

        <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-20">
            <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-16">
                {{-- Left: Text --}}
                <div class="flex-1 text-center lg:text-left">
                    <div x-reveal>
                        <h1 class="font-heading text-7xl sm:text-8xl md:text-9xl font-bold uppercase leading-none">
                            <span class="text-brand-yellow">ONLY</span><br>
                            <span class="text-white font-script text-7xl sm:text-8xl md:text-9xl font-normal normal-case">Fitness</span>
                        </h1>
                        <p class="text-white/80 text-lg sm:text-xl uppercase tracking-[0.3em] font-heading mt-4 mb-6">Forge Your Legacy</p>
                        <p class="text-gray-400 text-base sm:text-lg max-w-xl mx-auto lg:mx-0 leading-relaxed">State-of-the-art equipment. Elite trainers. 24/7 access. Your transformation starts now.</p>
                    </div>

                    <div x-reveal class="flex flex-col sm:flex-row gap-4 mt-10 justify-center lg:justify-start">
                        <a href="#contact" class="px-8 py-4 bg-brand-yellow text-brand-black font-heading font-semibold uppercase tracking-widest text-sm rounded-full hover:scale-105 transition inline-flex items-center justify-center">Start Free Trial</a>
                        <a href="{{ route('programs') }}" class="px-8 py-4 border-2 border-white text-white font-heading font-semibold uppercase tracking-widest text-sm rounded-full hover:border-brand-yellow hover:text-brand-yellow hover:scale-105 transition inline-flex items-center justify-center">View Programs</a>
                    </div>

                    {{-- Stats --}}
                    <div x-reveal class="grid grid-cols-3 gap-8 mt-16 max-w-lg mx-auto lg:mx-0">
                        <div class="text-center lg:text-left">
                            <p class="font-heading text-3xl sm:text-4xl font-bold text-brand-yellow">2500+</p>
                            <p class="text-gray-500 text-sm uppercase tracking-widest mt-1">Members</p>
                        </div>
                        <div class="text-center lg:text-left">
                            <p class="font-heading text-3xl sm:text-4xl font-bold text-brand-yellow">50+</p>
                            <p class="text-gray-500 text-sm uppercase tracking-widest mt-1">Trainers</p>
                        </div>
                        <div class="text-center lg:text-left">
                            <p class="font-heading text-3xl sm:text-4xl font-bold text-brand-yellow">24/7</p>
                            <p class="text-gray-500 text-sm uppercase tracking-widest mt-1">Access</p>
                        </div>
                    </div>
                </div>

                {{-- Right: Silhouette --}}
                <div x-reveal class="flex-1 flex justify-center lg:justify-end">
                    <svg viewBox="0 0 400 500" class="w-64 sm:w-80 md:w-96 h-auto" fill="#E5C100" xmlns="http://www.w3.org/2000/svg">
                        <path d="M200 25C180 25 160 35 150 55c-10 20-5 45 10 60 15 15 35 15 40 0 5-15 15-75 0-90zM120 80c-20 10-30 30-20 50 10 20 35 25 50 10 15-15 10-40-5-50s-25-10-25-10zM280 80s-15 5-25 10-20 35-5 50c15 15 40 10 50-10 10-20 0-40-20-50z"/>
                        <path d="M185 140c-20 5-40 20-50 40-10 20-15 50-20 80-5 30-10 65-10 90 0 25 5 45 15 55 10 10 25 15 45 15h70c20 0 35-5 45-15 10-10 15-30 15-55 0-25-5-60-10-90-5-30-10-60-20-80-10-20-30-35-50-40-5 0-15-5-25-5s-20 5-25 5z"/>
                        <path d="M160 220c-10 5-15 15-15 25 0 10 10 15 20 15s20-5 20-15c0-10-5-20-15-25h-10zM240 220c-10 5-15 15-15 25 0 10 10 15 20 15s20-5 20-15c0-10-5-20-15-25h-10z"/>
                        <path d="M175 270c-25 0-40 10-40 25 0 10 10 15 25 15 25 0 40-10 40-25 0-10-10-15-25-15zM225 270c-15 0-25 5-25 15 0 15 15 25 40 25 15 0 25-5 25-15 0-15-15-25-40-25z"/>
                        <path d="M190 300c-15 0-25 10-25 20s10 20 25 20h20c15 0 25-10 25-20s-10-20-25-20h-20z"/>
                        <path d="M155 385c-20 5-35 15-40 30-5 10 0 25 10 30 5 3 10 5 15 5 20 0 35-15 35-30s-10-30-20-35zM245 385c-10 5-20 20-20 35s15 30 35 30c5 0 10-2 15-5 10-5 15-20 10-30-5-15-20-25-40-30z"/>
                        <path d="M190 470c-5-5-15-5-20 0s-5 15 0 20 15 5 20 0 5-15 0-20zM230 470c-5-5-15-5-20 0s-5 15 0 20 15 5 20 0 5-15 0-20z"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Scroll indicator --}}
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-gray-500">
            <span class="text-xs uppercase tracking-widest font-heading">Scroll</span>
            <div class="w-6 h-10 border-2 border-gray-600 rounded-full flex justify-center pt-2">
                <div class="w-1 h-2 bg-brand-yellow rounded-full animate-bounce"></div>
            </div>
        </div>
    </section>

    {{-- ===================== TRUST BADGES ===================== --}}
    <section class="py-12 bg-brand-black border-y border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap justify-center items-center gap-8 md:gap-16">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-brand-yellow shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/></svg>
                    <div><span class="text-white font-bold">2,500+</span> <span class="text-gray-400 text-sm">Happy Members</span></div>
                </div>
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-brand-yellow shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <div><span class="text-white font-bold">4.9/5</span> <span class="text-gray-400 text-sm">Rating</span></div>
                </div>
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-brand-yellow shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7.5 14.25v2.25m3-4.5v4.5m3-6.75v6.75m3-9v9M6 20.25h12A2.25 2.25 0 0020.25 18V6A2.25 2.25 0 0018 3.75H6A2.25 2.25 0 003.75 6v12A2.25 2.25 0 006 20.25z"/></svg>
                    <div><span class="text-white font-bold">50+</span> <span class="text-gray-400 text-sm">Expert Trainers</span></div>
                </div>
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-brand-yellow shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <div><span class="text-white font-bold">24/7</span> <span class="text-gray-400 text-sm">Access</span></div>
                </div>
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-brand-yellow shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                    <div><span class="text-white font-bold">30-Day</span> <span class="text-gray-400 text-sm">Guarantee</span></div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================== PROGRAMS ===================== --}}
    <section class="py-24 bg-brand-dark overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div x-reveal class="text-center mb-16">
                <h2 class="font-heading text-4xl md:text-5xl font-bold text-white uppercase inline-block relative pb-4">
                    Our Programs
                    <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-16 h-1 bg-brand-yellow rounded-full"></span>
                </h2>
            </div>

            @php
                $programCards = [
                    (object)[
                        'name' => 'Strength Training',
                        'icon' => 'M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z',
                        'description' => 'Build raw power and muscle with compound lifts, progressive overload, and expert form coaching.',
                        'features' => ['Progressive overload system', 'Compound lift focus', 'Form correction & assessment'],
                    ],
                    (object)[
                        'name' => 'HIIT & Cardio',
                        'icon' => 'M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z',
                        'description' => 'Torch calories and boost cardiovascular endurance with high-intensity interval training.',
                        'features' => ['Interval-based protocols', 'Calorie torching sessions', 'Endurance progression'],
                    ],
                    (object)[
                        'name' => 'Personal Training',
                        'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
                        'description' => 'One-on-one coaching tailored to your specific goals with personalized plans and accountability.',
                        'features' => ['Custom workout plans', 'Nutritional guidance', 'Progress tracking'],
                    ],
                ];
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($programCards as $i => $program)
                    <div x-reveal class="group bg-brand-black rounded-2xl border border-white/5 p-8 hover:-translate-y-2 hover:shadow-[0_0_30px_rgba(229,193,0,0.15)] transition-all duration-300">
                        <div class="w-14 h-14 bg-brand-yellow/10 rounded-xl flex items-center justify-center mb-6 group-hover:bg-brand-yellow/20 transition-colors">
                            <svg class="w-7 h-7 text-brand-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $program->icon }}"/>
                            </svg>
                        </div>
                        <h3 class="font-heading text-xl font-bold text-white uppercase mb-3">{{ $program->name }}</h3>
                        <p class="text-gray-400 text-sm leading-relaxed mb-6">{{ $program->description }}</p>
                        <ul class="space-y-2.5 mb-8">
                            @foreach($program->features as $feature)
                                <li class="flex items-start gap-3 text-sm">
                                    <svg class="w-5 h-5 text-brand-yellow shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span class="text-gray-300">{{ $feature }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <a href="{{ route('programs') }}" class="inline-flex items-center gap-2 text-brand-yellow font-heading text-sm uppercase tracking-widest font-semibold border-2 border-brand-yellow rounded-full px-6 py-2.5 hover:bg-brand-yellow hover:text-brand-black transition-all hover:scale-105 group/btn">
                            Learn More
                            <svg class="w-4 h-4 transition-transform group-hover/btn:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===================== WHY CHOOSE US ===================== --}}
    <section class="py-24 bg-brand-dark">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div x-reveal class="text-center mb-16">
                <h2 class="font-heading text-4xl md:text-5xl font-bold text-white uppercase inline-block relative pb-4">
                    Why Only Fitness?
                    <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-16 h-1 bg-brand-yellow rounded-full"></span>
                </h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div x-reveal class="bg-brand-gray rounded-2xl p-8 border border-white/5 hover:border-brand-yellow/30 transition-all text-center">
                    <div class="w-14 h-14 bg-brand-yellow/10 rounded-xl flex items-center justify-center mx-auto">
                        <svg class="w-8 h-8 text-brand-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <h3 class="text-white font-bold text-lg mt-4">State-of-the-Art Equipment</h3>
                    <p class="text-gray-400 text-sm mt-2 leading-relaxed">Latest Technogym and Hammer Strength machines, regularly maintained and upgraded.</p>
                </div>
                <div x-reveal class="bg-brand-gray rounded-2xl p-8 border border-white/5 hover:border-brand-yellow/30 transition-all text-center">
                    <div class="w-14 h-14 bg-brand-yellow/10 rounded-xl flex items-center justify-center mx-auto">
                        <svg class="w-8 h-8 text-brand-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                    </div>
                    <h3 class="text-white font-bold text-lg mt-4">Expert Trainers</h3>
                    <p class="text-gray-400 text-sm mt-2 leading-relaxed">All trainers certified with NASM, ACE, or ISSA. Average 8+ years experience.</p>
                </div>
                <div x-reveal class="bg-brand-gray rounded-2xl p-8 border border-white/5 hover:border-brand-yellow/30 transition-all text-center">
                    <div class="w-14 h-14 bg-brand-yellow/10 rounded-xl flex items-center justify-center mx-auto">
                        <svg class="w-8 h-8 text-brand-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-white font-bold text-lg mt-4">Flexible Hours</h3>
                    <p class="text-gray-400 text-sm mt-2 leading-relaxed">Open 24/7 with staffed hours 6AM-10PM. Train on your schedule, not ours.</p>
                </div>
                <div x-reveal class="bg-brand-gray rounded-2xl p-8 border border-white/5 hover:border-brand-yellow/30 transition-all text-center">
                    <div class="w-14 h-14 bg-brand-yellow/10 rounded-xl flex items-center justify-center mx-auto">
                        <svg class="w-8 h-8 text-brand-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/></svg>
                    </div>
                    <h3 class="text-white font-bold text-lg mt-4">Community Vibe</h3>
                    <p class="text-gray-400 text-sm mt-2 leading-relaxed">Join group classes, challenges, and events. Fitness is better together.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================== TRAINERS ===================== --}}
    @php
        $homeTrainerDisplay = [
            'Marcus Johnson' => [
                'display_name' => 'Marcus Steel',
                'photo' => 'https://images.unsplash.com/photo-1567013127542-490d757e51fc?w=400',
                'filter' => 'Strength',
                'modal_bio' => 'Former competitive powerlifter with 10+ years coaching experience. Marcus specializes in compound movements, progressive overload, and helping clients break through plateaus with proven strength protocols.',
            ],
            'Sarah Chen' => [
                'display_name' => 'Sarah Blaze',
                'photo' => 'https://images.unsplash.com/photo-1594381898411-846e7d193883?w=400',
                'filter' => 'Cardio',
                'modal_bio' => 'HIIT specialist and marathon runner with a passion for high-energy training. Sarah helps clients push past their limits with science-backed interval protocols designed for maximum fat loss and cardiovascular improvement.',
            ],
            'David Rivera' => [
                'display_name' => 'David Iron',
                'photo' => 'https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?w=400',
                'filter' => 'Strength',
                'modal_bio' => 'Bodybuilding pro with multiple competition wins and over 8 years of coaching experience. David specializes in muscle hypertrophy, competition preparation, and advanced training techniques for serious athletes.',
            ],
            'Emily Torres' => [
                'display_name' => 'Elena Power',
                'photo' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?w=400',
                'filter' => 'Nutrition',
                'modal_bio' => 'Certified nutritionist and yoga instructor with a holistic approach to wellness. Elena combines mindful movement with science-backed meal planning to help clients achieve sustainable, long-lasting results.',
            ],
        ];

        $homeTrainersData = collect($trainers)->map(function ($t) use ($homeTrainerDisplay) {
            $td = $homeTrainerDisplay[$t->name] ?? [];
            return [
                'id' => $t->id,
                'name' => $td['display_name'] ?? $t->name,
                'specialty' => $t->specialty,
                'photo' => $td['photo'] ?? '',
                'modal_bio' => $td['modal_bio'] ?? $t->bio,
                'certifications' => $t->certifications ?? [],
                'instagram' => $t->social_links['instagram'] ?? 'https://instagram.com/onlyfitness44',
            ];
        })->values();

        $timeSlots = ['6AM', '8AM', '10AM', '12PM', '2PM', '4PM', '6PM', '8PM'];
        $weekdayAvail = [true, true, true, true, true, true, true, true];
        $weekendAvail = [false, true, true, true, true, true, false, false];
    @endphp

    <script>window.homeTrainerData = @json($homeTrainersData);</script>
    <div x-data="trainerHomePage()" x-init="trainers = window.homeTrainerData">

    <section class="py-24 bg-brand-black overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div x-reveal class="text-center mb-16">
                <h2 class="font-heading text-4xl md:text-5xl font-bold text-white uppercase inline-block relative pb-4">
                    Elite Trainers
                    <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-16 h-1 bg-brand-yellow rounded-full"></span>
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($trainers as $index => $trainer)
                    @php $td = $homeTrainerDisplay[$trainer->name] ?? []; @endphp
                    <div x-reveal @click="openModal({{ $index }})"
                         class="group relative rounded-2xl overflow-hidden bg-brand-dark border border-white/5 cursor-pointer">
                        <div class="aspect-[3/4] overflow-hidden">
                            <img src="{{ $td['photo'] ?? 'https://images.unsplash.com/photo-1567013127542-490d757e51fc?w=400' }}"
                                 alt="{{ $td['display_name'] ?? $trainer->name }}"
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                 loading="lazy">
                            <div class="absolute inset-0 bg-brand-black/0 group-hover:bg-brand-black/40 transition-all duration-300"></div>
                            <div class="absolute bottom-0 left-0 right-0 h-1/2 bg-gradient-to-t from-brand-black via-brand-black/80 to-transparent pointer-events-none"></div>
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 p-5 z-10 pointer-events-none">
                            <h3 class="font-heading text-lg font-bold text-white uppercase">{{ $td['display_name'] ?? $trainer->name }}</h3>
                            <span class="inline-block mt-1.5 px-3 py-1 bg-brand-yellow/20 text-brand-yellow text-xs font-heading uppercase tracking-wider rounded-full border border-brand-yellow/30">{{ $td['filter'] ?? $trainer->specialty }}</span>
                            <div class="mt-3 flex gap-3 pointer-events-auto">
                                <a href="#" @click.stop
                                   class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-brand-yellow hover:text-brand-black transition">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                                </a>
                                <a href="mailto:contact@onlyfit.club" @click.stop
                                   class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-brand-yellow hover:text-brand-black transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </a>
                            </div>
                        </div>
                        <div class="absolute inset-0 flex items-center justify-center z-20 opacity-0 group-hover:opacity-100 transition-all duration-300 translate-y-4 group-hover:translate-y-0 pointer-events-none">
                            <span class="bg-brand-yellow text-brand-black px-6 py-3 rounded-full font-bold text-sm uppercase tracking-wider shadow-lg">View Profile</span>
                        </div>
                    </div>
                @endforeach
            </div>

            <div x-reveal class="text-center mt-12">
                <a href="{{ route('trainers') }}" class="inline-flex items-center gap-2 text-brand-yellow font-heading text-sm uppercase tracking-widest font-semibold border-2 border-brand-yellow rounded-full px-8 py-3 hover:bg-brand-yellow hover:text-brand-black transition-all hover:scale-105">
                    Meet All Trainers
                    <svg class="w-4 h-4 transition-transform group-hover/btn:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- ===================== TRAINER MODAL ===================== --}}
    <div x-show="open"
         x-cloak
         @keydown.escape.window="closeModal()"
         class="fixed inset-0 z-[100] flex items-start justify-center p-4 pt-16 overflow-y-auto"
         style="display: none;">
        <div x-show="open"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="closeModal()"
             class="fixed inset-0 bg-black/90 backdrop-blur-sm"></div>

        <div x-show="open"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-8"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-8"
             @click.away="closeModal()"
             class="relative w-full max-w-4xl bg-brand-gray rounded-3xl overflow-hidden border border-white/10 shadow-2xl z-10">
            <button @click="closeModal()" class="absolute top-4 right-4 z-30 w-10 h-10 rounded-full bg-white/10 text-white hover:bg-brand-yellow hover:text-brand-black transition flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <div class="grid md:grid-cols-2 min-h-[500px]">
                <div class="h-80 md:h-full overflow-hidden">
                    <img :src="selectedTrainer ? selectedTrainer.photo.replace('w=400', 'w=800') : ''"
                         :alt="selectedTrainer ? selectedTrainer.name : ''"
                         class="w-full h-full object-cover">
                </div>

                <div class="p-8 md:p-12 relative">
                    <template x-if="selectedTrainer">
                        <div>
                            <h3 class="text-3xl font-heading font-bold text-white uppercase" x-text="selectedTrainer.name"></h3>
                            <span class="inline-block mt-3 px-4 py-1 bg-brand-yellow text-brand-black rounded-full text-sm font-bold" x-text="selectedTrainer.specialty"></span>
                            <p class="text-gray-300 mt-4 leading-relaxed" x-text="selectedTrainer.modal_bio"></p>

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
        function trainerHomePage() {
            return {
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

    {{-- ===================== TESTIMONIALS ===================== --}}
    <section x-data="{
        current: 0,
        visible: 3,
        testimonials: [
            { quote: 'Only Fitness completely transformed my life. I lost 11 kg and gained confidence I never knew I had. The trainers are incredible.', name: 'Ahmed B.', result: '11 kg perdus en 12 semaines' },
            { quote: 'The personalized training plans and nutrition guidance helped me build 4 kg of muscle in just 16 weeks. Best decision I ever made.', name: 'Sara M.', result: '4 kg de muscle gagnés en 16 semaines' },
            { quote: 'I was intimidated to join a gym, but the community here welcomed me with open arms. Down 14 kg and still going!', name: 'Youssef K.', result: '14 kg perdus en 20 semaines' },
            { quote: 'The trainers here actually care about your progress. They pushed me beyond what I thought was possible. Highly recommend!', name: 'Nadia T.', result: '7 kg perdus, 1er marathon complété' },
            { quote: 'After my injury I thought I would never lift heavy again. The rehab program got me back stronger than ever.', name: 'Karim J.', result: 'Squat 2x poids du corps' },
            { quote: 'Meal planning and group classes kept me consistent. The results speak for themselves — I have never felt this good.', name: 'Leila R.', result: '12% de graisse corporelle en 6 mois' },
        ],
        next() { this.current = (this.current + 1) % Math.ceil(this.testimonials.length / this.visible); },
        prev() { this.current = (this.current - 1 + Math.ceil(this.testimonials.length / this.visible)) % Math.ceil(this.testimonials.length / this.visible); },
    }" class="py-24 bg-brand-black overflow-hidden">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div x-reveal class="text-center mb-16">
                <h2 class="font-heading text-4xl md:text-5xl font-bold text-white uppercase inline-block relative pb-4">
                    Member Success Stories
                    <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-16 h-1 bg-brand-yellow rounded-full"></span>
                </h2>
            </div>

            <div class="relative">
                <button @click="prev()" class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 z-10 w-12 h-12 rounded-full bg-brand-gray text-white hover:bg-brand-yellow hover:text-brand-black transition-all flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button @click="next()" class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 z-10 w-12 h-12 rounded-full bg-brand-gray text-white hover:bg-brand-yellow hover:text-brand-black transition-all flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>

                <div class="overflow-hidden">
                    <div class="flex transition-all duration-500 ease-out" :style="`transform: translateX(-${current * (100 / visible)}%)`">
                        <template x-for="(t, i) in testimonials" :key="i">
                            <div class="w-full md:w-1/2 lg:w-1/3 shrink-0 px-3">
                                <div class="bg-brand-gray rounded-2xl p-8 border border-white/5 h-full">
                                    <span class="text-6xl font-serif text-brand-yellow/20 leading-none block">&ldquo;</span>
                                    <p class="text-white text-lg italic leading-relaxed mt-2" x-text="t.quote"></p>
                                    <div class="mt-6 flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-full bg-brand-yellow flex items-center justify-center text-brand-black font-bold shrink-0" x-text="t.name.charAt(0)"></div>
                                        <div>
                                            <p class="text-white font-bold" x-text="t.name"></p>
                                            <p class="text-brand-yellow text-sm" x-text="t.result"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <div class="flex justify-center gap-2 mt-8">
                <template x-for="p in Math.ceil(testimonials.length / visible)" :key="p">
                    <button @click="current = p - 1" :class="(p - 1) === current ? 'bg-brand-yellow' : 'bg-gray-600'" class="w-2.5 h-2.5 rounded-full transition-all duration-300"></button>
                </template>
            </div>
        </div>
    </section>

    {{-- ===================== BEFORE/AFTER ===================== --}}
    <section class="py-24 bg-brand-dark overflow-hidden">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div x-reveal class="text-center mb-12">
                <h2 class="font-heading text-4xl md:text-5xl font-bold text-white uppercase inline-block relative pb-4">
                    Real Results
                    <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-16 h-1 bg-brand-yellow rounded-full"></span>
                </h2>
                <p class="text-gray-400 mt-4">Slide to compare before & after</p>
            </div>

            @php
                $img = 'images/transformations';
                $transformations = [
                    ['name' => 'Hicham E.', 'weeks' => '12 Semaines', 'loss' => '-12 kg', 'gain' => '+3 kg muscle', 'before' => asset("$img/hicham-before.jpg"), 'after' => asset("$img/hicham-after.jpg"), 'quote' => 'La force est un choix, pas un hasard.'],
                    ['name' => 'Imane L.', 'weeks' => '16 Semaines', 'loss' => '-8 kg', 'gain' => '+4 kg muscle', 'before' => asset("$img/imane-before.jpg"), 'after' => asset("$img/imane-after.jpg"), 'quote' => 'Elle croyait qu\'elle le pouvait, alors elle l\'a fait.'],
                    ['name' => 'Amine Z.', 'weeks' => '8 Semaines', 'loss' => '-6 kg', 'gain' => '+2 kg muscle', 'before' => asset("$img/amine-before.jpg"), 'after' => asset("$img/amine-after.jpg"), 'quote' => 'Le seul mauvais entraînement est celui qui n\'a pas eu lieu.'],
                    ['name' => 'Omar B.', 'weeks' => '20 Semaines', 'loss' => '-15 kg', 'gain' => '+5 kg muscle', 'before' => asset("$img/hicham-before.jpg"), 'after' => asset("$img/amine-after.jpg"), 'quote' => 'Les résultats parlent d\'eux-mêmes.'],
                    ['name' => 'Salma R.', 'weeks' => '10 Semaines', 'loss' => '-7 kg', 'gain' => '+2 kg muscle', 'before' => asset("$img/imane-before.jpg"), 'after' => asset("$img/imane-after.jpg"), 'quote' => 'Je n\'ai jamais été aussi forte et confiante.'],
                    ['name' => 'Youssef K.', 'weeks' => '14 Semaines', 'loss' => '-10 kg', 'gain' => '+4 kg muscle', 'before' => asset("$img/amine-before.jpg"), 'after' => asset("$img/hicham-after.jpg"), 'quote' => 'Only Fitness a changé ma vie.'],
                ];
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($transformations as $t)
                <div x-data="{ pos: 50, dragging: false, start(e) { this.dragging = true; this.slide(e); }, stop() { this.dragging = false; }, slide(e) { if (!this.dragging) return; const rect = $el.closest('.comparison-wrap').querySelector('.comparison-img').getBoundingClientRect(); const x = (e.clientX || e.touches?.[0]?.clientX) - rect.left; this.pos = Math.max(0, Math.min(100, (x / rect.width) * 100)); } }"
                     x-reveal class="bg-brand-gray rounded-2xl overflow-hidden border border-white/5 hover:shadow-lg hover:shadow-brand-yellow/10 transition-all duration-300">
                    <div class="comparison-wrap relative h-72 select-none overflow-hidden cursor-col-resize"
                         @mousedown="start($event)" @mousemove="slide($event)" @mouseup="stop()" @mouseleave="stop()"
                         @touchstart="start($event)" @touchmove="slide($event)" @touchend="stop()">
                        <img src="{{ $t['after'] }}" alt="After" class="comparison-img absolute inset-0 w-full h-full object-cover" loading="lazy" draggable="false">
                        <div class="absolute inset-0 overflow-hidden" :style="`clip-path: inset(0 ${100 - pos}% 0 0)`">
                            <img src="{{ $t['before'] }}" alt="Before" class="absolute top-0 left-0 w-full h-full object-cover" loading="lazy" draggable="false">
                        </div>
                        <div class="absolute inset-y-0" :style="`left: ${pos}%`" style="width:3px">
                            <div class="absolute inset-y-0 -left-px w-0.5 bg-white shadow-[0_0_8px_rgba(0,0,0,0.5)]"></div>
                            <div class="absolute top-1/2 -translate-x-1/2 -translate-y-1/2 w-9 h-9 rounded-full bg-white/90 shadow-lg flex items-center justify-center text-brand-black text-xs font-bold border-2 border-white">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7l-4 4 4 4M16 7l4 4-4 4"/></svg>
                            </div>
                        </div>
                        <span class="absolute top-3 left-3 bg-black/70 text-white px-2.5 py-1 rounded-full text-xs backdrop-blur-sm z-10">Before</span>
                        <span class="absolute top-3 right-3 bg-brand-yellow text-brand-black px-2.5 py-1 rounded-full text-xs font-bold z-10">After</span>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-white font-bold">{{ $t['name'] }}</p>
                            <span class="text-brand-yellow text-xs uppercase tracking-wider font-heading font-semibold">{{ $t['weeks'] }}</span>
                        </div>
                        <div class="flex gap-4">
                            <span class="flex items-center gap-1 text-green-400 text-sm"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>{{ $t['loss'] }}</span>
                            <span class="flex items-center gap-1 text-brand-yellow text-sm"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>{{ $t['gain'] }}</span>
                        </div>
                        <p class="text-gray-500 text-xs mt-3 italic">&ldquo;{{ $t['quote'] }}&rdquo;</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===================== PRICING ===================== --}}
    <section class="py-24 bg-brand-dark overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div x-reveal class="text-center mb-12">
                <h2 class="font-heading text-4xl md:text-5xl font-bold text-white uppercase inline-block relative pb-4">
                    Choose Your Plan
                    <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-16 h-1 bg-brand-yellow rounded-full"></span>
                </h2>
            </div>

            <div x-data="{ yearly: false }">
                <div class="flex justify-center mb-12">
                    <div class="flex items-center gap-4 bg-brand-black rounded-full p-1.5 border border-white/10">
                        <span class="px-5 py-2 font-heading text-sm uppercase tracking-widest rounded-full transition cursor-pointer"
                              :class="yearly ? 'text-gray-500 hover:text-white' : 'bg-brand-yellow text-brand-black font-semibold'"
                              @click="yearly = false">Monthly</span>
                        <span class="px-5 py-2 font-heading text-sm uppercase tracking-widest rounded-full transition cursor-pointer"
                              :class="yearly ? 'bg-brand-yellow text-brand-black font-semibold' : 'text-gray-500 hover:text-white'"
                              @click="yearly = true">Yearly</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
                @foreach($plans as $plan)
                    @php $isPopular = $plan->is_popular; @endphp
                    <div x-reveal class="relative rounded-2xl p-8 transition-all duration-300 hover:-translate-y-2
                        {{ $isPopular ? 'bg-brand-black border-2 border-brand-yellow shadow-[0_0_30px_rgba(229,193,0,0.1)] scale-105 md:scale-110 z-10' : 'bg-brand-black border border-white/10 hover:border-white/20' }}">
                        @if($isPopular)
                            <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 px-5 py-1.5 bg-brand-yellow text-brand-black font-heading text-xs uppercase tracking-widest font-bold rounded-full">Most Popular</div>
                        @endif

                        <h3 class="font-heading text-2xl font-bold text-white uppercase mb-2">{{ $plan->name }}</h3>

                        <div class="mt-6 mb-6">
                            <template x-if="!yearly">
                                <div>
                                    <span class="font-heading text-5xl font-bold text-white">MAD {{ number_format($plan->price_monthly, 0) }}</span>
                                    <span class="text-gray-500 text-sm ml-1">/month</span>
                                </div>
                            </template>
                            <template x-if="yearly">
                                <div>
                                    <span class="font-heading text-5xl font-bold text-white">MAD {{ number_format($plan->price_yearly, 0) }}</span>
                                    <span class="text-gray-500 text-sm ml-1">/year</span>
                                </div>
                            </template>
                            <template x-if="yearly">
                                <p class="text-green-400 text-xs mt-1 font-semibold">Save {{ 100 - round($plan->price_yearly / ($plan->price_monthly * 12) * 100) }}%</p>
                            </template>
                        </div>

                        <ul class="space-y-3 mb-8">
                            @foreach($plan->features as $feature)
                                <li class="flex items-start gap-3 text-sm">
                                    <svg class="w-5 h-5 text-brand-yellow shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span class="text-gray-300">{{ $feature }}</span>
                                </li>
                            @endforeach
                        </ul>

                        <a href="{{ route('contact') }}"
                           class="block w-full text-center py-3.5 rounded-full font-heading text-sm uppercase tracking-widest font-semibold transition-all hover:scale-105
                            {{ $isPopular ? 'bg-brand-yellow text-brand-black hover:bg-yellow-400' : 'border-2 border-white/20 text-white hover:border-brand-yellow hover:text-brand-yellow' }}">
                            Get Started
                        </a>
                    </div>
                @endforeach
            </div>
            </div>
        </div>
    </section>

    {{-- ===================== FAQ ===================== --}}
    <section x-data="{ active: null }" class="py-24 bg-brand-dark overflow-hidden">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div x-reveal class="text-center mb-16">
                <h2 class="font-heading text-4xl md:text-5xl font-bold text-white uppercase inline-block relative pb-4">
                    Frequently Asked Questions
                    <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-16 h-1 bg-brand-yellow rounded-full"></span>
                </h2>
            </div>

            @php
                $faqs = [
                    [
                        'q' => 'What are your gym hours?',
                        'a' => 'We\'re open 24 hours a day, 7 days a week. Staffed hours are from 6 AM to 10 PM daily, but members can access the facility anytime using their keycard.',
                    ],
                    [
                        'q' => 'Do you offer free trial sessions?',
                        'a' => 'Yes! We offer a free trial session for new members. Fill out the contact form on this page and we\'ll schedule your complimentary workout with one of our expert trainers.',
                    ],
                    [
                        'q' => 'What equipment do you have?',
                        'a' => 'We feature top-of-the-line Technogym and Hammer Strength equipment, including free weights up to 150 lbs, cable machines, squat racks, deadlift platforms, cardio machines, and functional training zones.',
                    ],
                    [
                        'q' => 'Can I switch between plans?',
                        'a' => 'Absolutely. You can upgrade or downgrade your plan at any time. Upgrades take effect immediately, and downgrades will apply at the start of your next billing cycle.',
                    ],
                    [
                        'q' => 'Are personal training sessions included?',
                        'a' => 'Personal training sessions are included with our Elite plan (4 sessions/month) and Premium plan (8 sessions/month). The Starter plan includes an initial assessment session.',
                    ],
                    [
                        'q' => 'Is there a cancellation fee?',
                        'a' => 'We offer a 30-day money-back guarantee on all plans. After that, you can cancel anytime with 14 days notice. No hidden fees or long-term contracts required.',
                    ],
                    [
                        'q' => 'Do you offer nutrition guidance?',
                        'a' => 'Yes! All members get access to our nutrition guides and meal planning templates. Premium and Elite members receive personalized nutrition consultations with certified nutritionists.',
                    ],
                    [
                        'q' => 'Can I bring a guest?',
                        'a' => 'Premium and Elite members can bring a guest once per month. Additional guest passes can be purchased at the front desk for MAD 50 per visit.',
                    ],
                ];
            @endphp

            <div class="space-y-3">
                @foreach($faqs as $i => $faq)
                    <div x-reveal class="bg-brand-black rounded-xl border border-white/5 overflow-hidden transition-all duration-200"
                         :class="active === {{ $i }} ? 'border-brand-yellow/40' : ''">
                        <button @click="active = active === {{ $i }} ? null : {{ $i }}"
                                class="w-full flex items-center justify-between px-6 py-5 text-left">
                            <span class="font-heading text-white font-semibold text-base pr-4">{{ $faq['q'] }}</span>
                            <svg class="w-5 h-5 text-brand-yellow shrink-0 transition-transform duration-300"
                                 :class="active === {{ $i }} ? 'rotate-45' : ''"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </button>
                        <div x-show="active === {{ $i }}"
                             x-collapse
                             x-cloak>
                            <div class="px-6 pb-5 text-gray-400 text-sm leading-relaxed">{{ $faq['a'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div x-reveal class="text-center mt-12">
                <p class="text-gray-500">Still have questions? <a href="#contact" class="text-brand-yellow hover:underline font-semibold">Reach out to us</a></p>
            </div>
        </div>
    </section>

    {{-- ===================== CONTACT CTA ===================== --}}
    <section id="contact" class="py-24 bg-brand-black relative overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,rgba(229,193,0,0.05)_0%,transparent_70%)]"></div>
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div x-reveal class="bg-brand-dark rounded-3xl border border-brand-yellow/20 p-8 sm:p-12 shadow-2xl">
                <div class="text-center mb-10">
                    <h2 class="font-heading text-3xl sm:text-4xl font-bold text-white uppercase mb-3">Start Your Transformation</h2>
                    <p class="text-gray-400">Fill out the form below and claim your free trial session.</p>
                </div>

                @if(session('success'))
                    <div class="mb-8 p-4 bg-green-500/10 border border-green-500/30 text-green-400 rounded-xl text-sm text-center" role="alert">{{ session('success') }}</div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label for="name" class="sr-only">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="Your Name"
                               class="w-full px-5 py-3.5 bg-brand-black border border-white/10 rounded-xl text-white placeholder-gray-500 focus:ring-2 focus:ring-brand-yellow focus:border-brand-yellow outline-none transition text-sm">
                        @error('name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required placeholder="Email Address"
                                   class="w-full px-5 py-3.5 bg-brand-black border border-white/10 rounded-xl text-white placeholder-gray-500 focus:ring-2 focus:ring-brand-yellow focus:border-brand-yellow outline-none transition text-sm">
                            @error('email') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="phone" class="sr-only">Phone</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}" placeholder="Phone Number"
                                   class="w-full px-5 py-3.5 bg-brand-black border border-white/10 rounded-xl text-white placeholder-gray-500 focus:ring-2 focus:ring-brand-yellow focus:border-brand-yellow outline-none transition text-sm">
                            @error('phone') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="goal" class="sr-only">Fitness Goal</label>
                        <select name="goal" id="goal" required
                                class="w-full px-5 py-3.5 bg-brand-black border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-brand-yellow focus:border-brand-yellow outline-none transition text-sm">
                            <option value="" class="text-gray-500" disabled selected>Select Your Goal</option>
                            <option value="Lose Weight" @selected(old('goal') === 'Lose Weight')>Lose Weight</option>
                            <option value="Build Muscle" @selected(old('goal') === 'Build Muscle')>Build Muscle</option>
                            <option value="Improve Endurance" @selected(old('goal') === 'Improve Endurance')>Improve Endurance</option>
                            <option value="General Fitness" @selected(old('goal') === 'General Fitness')>General Fitness</option>
                        </select>
                        @error('goal') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="message" class="sr-only">Message</label>
                        <textarea name="message" id="message" rows="3" required placeholder="Tell us about your fitness goals..."
                                  class="w-full px-5 py-3.5 bg-brand-black border border-white/10 rounded-xl text-white placeholder-gray-500 focus:ring-2 focus:ring-brand-yellow focus:border-brand-yellow outline-none transition text-sm resize-none">{{ old('message') }}</textarea>
                        @error('message') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit"
                            class="w-full py-4 bg-brand-yellow text-brand-black font-heading font-bold text-sm uppercase tracking-widest rounded-xl hover:bg-yellow-400 hover:scale-[1.02] transition-all">
                        Claim My Free Pass
                    </button>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>
