<x-app-layout title="Abonnements & Tarifs | Salle de Sport Tétouan">
    @php
        $planDisplay = [
            'Basic' => [
                'yearly' => 2990,
                'description' => 'Perfect for beginners starting their fitness journey.',
                'features' => [
                    'included' => [
                        'Gym access (6AM - 10PM)',
                        'Locker room access',
                        'Basic equipment',
                        'Free WiFi',
                    ],
                    'excluded' => [
                        'Group classes',
                        'Personal training',
                        'Nutrition plan',
                        '24/7 access',
                    ],
                ],
            ],
            'Pro' => [
                'yearly' => 5990,
                'description' => 'Our most popular choice for serious fitness enthusiasts.',
                'features' => [
                    'included' => [
                        '24/7 Gym access',
                        'All group classes',
                        'Premium equipment',
                        '2 PT sessions/month',
                        'Locker + sauna',
                        'Guest passes (2/mo)',
                    ],
                    'excluded' => [
                        'Nutrition plan',
                        'Unlimited PT',
                    ],
                ],
            ],
            'Elite' => [
                'yearly' => 9990,
                'description' => 'The ultimate fitness experience with unlimited everything.',
                'features' => [
                    'included' => [
                        'Everything in Pro',
                        'Unlimited PT sessions',
                        'Custom nutrition plan',
                        'Recovery spa access',
                        'Guest passes (4/mo)',
                        'Priority booking',
                        'Body composition analysis',
                    ],
                    'excluded' => [],
                ],
            ],
        ];

        $compareData = [
            ['feature' => 'Gym Access', 'Basic' => '6AM-10PM', 'Pro' => '24/7', 'Elite' => '24/7'],
            ['feature' => 'Group Classes', 'Basic' => '—', 'Pro' => '✓', 'Elite' => '✓'],
            ['feature' => 'Personal Training', 'Basic' => '—', 'Pro' => '2/mo', 'Elite' => 'Unlimited'],
            ['feature' => 'Premium Equipment', 'Basic' => '—', 'Pro' => '✓', 'Elite' => '✓'],
            ['feature' => 'Nutrition Plan', 'Basic' => '—', 'Pro' => '—', 'Elite' => '✓'],
            ['feature' => 'Recovery Spa', 'Basic' => '—', 'Pro' => '—', 'Elite' => '✓'],
            ['feature' => 'Guest Passes', 'Basic' => '—', 'Pro' => '2/mo', 'Elite' => '4/mo'],
            ['feature' => 'Locker Room', 'Basic' => '✓', 'Pro' => '✓ + Sauna', 'Elite' => '✓ + Sauna'],
            ['feature' => 'Free WiFi', 'Basic' => '✓', 'Pro' => '✓', 'Elite' => '✓'],
            ['feature' => 'Body Analysis', 'Basic' => '—', 'Pro' => '—', 'Elite' => '✓'],
        ];

        $faqs = [
            ['q' => 'Can I switch plans later?', 'a' => 'Yes, you can upgrade or downgrade your plan at any time. Changes take effect on your next billing cycle.'],
            ['q' => 'Is there a cancellation fee?', 'a' => 'No, all our memberships are month-to-month with no long-term contracts. Cancel anytime.'],
            ['q' => 'Do you offer student or military discounts?', 'a' => 'Yes! We offer 15% off for students and active military with valid ID.'],
            ['q' => 'Can I freeze my membership?', 'a' => 'Yes, you can freeze your membership for up to 3 months per year for travel or medical reasons.'],
            ['q' => 'What\'s included in the free trial?', 'a' => '7 days of full Pro access including all classes, equipment, and 1 personal training session.'],
        ];
    @endphp

    {{-- ===================== PAGE HEADER ===================== --}}
    <section class="bg-brand-black pt-32 pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="font-heading text-4xl md:text-5xl font-bold text-white uppercase">Choose Your Plan</h1>
            <div class="w-24 h-1 bg-brand-yellow mx-auto mt-4 rounded-full"></div>
            <p class="text-gray-400 mt-6 max-w-2xl mx-auto">Flexible memberships designed to fit your lifestyle and budget.</p>
        </div>
    </section>

    {{-- ===================== BILLING TOGGLE + PRICING CARDS ===================== --}}
    <div x-data="{ yearly: false }">

        {{-- Billing Toggle --}}
        <section class="bg-brand-black pb-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-center gap-4">
                    <span class="text-gray-400 font-medium" :class="!yearly && 'text-white'">Monthly</span>
                    <button @click="yearly = ! yearly"
                            class="w-16 h-8 rounded-full bg-brand-gray relative cursor-pointer focus:outline-none focus:ring-2 focus:ring-brand-yellow focus:ring-offset-2 focus:ring-offset-brand-black"
                            role="switch"
                            :aria-checked="yearly">
                        <span class="absolute top-1 w-6 h-6 rounded-full bg-brand-yellow transition-all duration-300"
                              :class="yearly ? 'translate-x-9' : 'translate-x-1'"></span>
                    </button>
                    <span class="text-gray-400 font-medium" :class="yearly && 'text-white'">Yearly</span>
                    <span class="bg-brand-yellow/20 text-brand-yellow text-xs px-3 py-1 rounded-full font-semibold ml-2">Save 17%</span>
                </div>
            </div>
        </section>

        {{-- Pricing Cards --}}
        <section class="bg-brand-dark py-24">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($plans as $plan)
                        @php $pd = $planDisplay[$plan->name] ?? []; @endphp

                        <div class="relative {{ $plan->is_popular ? 'md:-translate-y-4' : '' }} group">
                            {{-- Most Popular Badge --}}
                            @if($plan->is_popular)
                                <div class="absolute -top-4 left-1/2 -translate-x-1/2 z-10 bg-brand-yellow text-brand-black px-4 py-1 rounded-full text-sm font-bold whitespace-nowrap">Most Popular</div>
                            @endif

                            {{-- Card --}}
                            <div class="h-full rounded-2xl p-8 flex flex-col transition-all duration-300 group-hover:-translate-y-1 group-hover:shadow-xl
                                        {{ $plan->is_popular ? 'border-2 border-brand-yellow bg-brand-gray' : 'border border-white/10 bg-[#111111]' }}">
                                {{-- Plan Name --}}
                                <h3 class="font-heading text-xl font-bold uppercase tracking-wider {{ $plan->is_popular ? 'text-brand-yellow' : 'text-gray-300' }}">{{ $plan->name }}</h3>

                                {{-- Price --}}
                                <div class="mt-6 relative">
                                    {{-- Monthly Price --}}
                                    <div x-show="! yearly"
                                         x-transition:enter="transition ease-out duration-200"
                                         x-transition:enter-start="opacity-0 scale-90"
                                         x-transition:enter-end="opacity-100 scale-100"
                                         x-transition:leave="transition ease-in duration-150"
                                         x-transition:leave-start="opacity-100 scale-100"
                                         x-transition:leave-end="opacity-0 scale-90">
                                        <span class="text-5xl font-bold text-white tabular-nums">MAD {{ number_format($plan->price_monthly, 0) }}</span>
                                        <span class="text-gray-500 text-lg">/mo</span>
                                    </div>
                                    {{-- Yearly Price --}}
                                    <div x-show="yearly"
                                         x-transition:enter="transition ease-out duration-200"
                                         x-transition:enter-start="opacity-0 scale-90"
                                         x-transition:enter-end="opacity-100 scale-100"
                                         x-transition:leave="transition ease-in duration-150"
                                         x-transition:leave-start="opacity-100 scale-100"
                                         x-transition:leave-end="opacity-0 scale-90">
                                        <span class="text-5xl font-bold text-white tabular-nums">MAD {{ $pd['yearly'] ?? ($plan->price_monthly * 12) }}</span>
                                        <span class="text-gray-500 text-lg">/yr</span>
                                    </div>
                                </div>

                                {{-- Description --}}
                                <p class="text-gray-500 mt-2">{{ $pd['description'] ?? '' }}</p>

                                {{-- Divider --}}
                                <hr class="border-white/10 my-6">

                                {{-- Included Features --}}
                                <ul class="space-y-4 flex-1">
                                    @foreach($pd['features']['included'] ?? [] as $feature)
                                        <li class="flex items-center gap-3 text-gray-300">
                                            <svg class="w-5 h-5 text-brand-yellow shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                            <span class="text-sm">{{ $feature }}</span>
                                        </li>
                                    @endforeach
                                    {{-- Excluded Features --}}
                                    @foreach($pd['features']['excluded'] ?? [] as $feature)
                                        <li class="flex items-center gap-3 text-gray-600">
                                            <svg class="w-5 h-5 text-gray-700 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                            <span class="text-sm">{{ $feature }}</span>
                                        </li>
                                    @endforeach
                                </ul>

                                {{-- Button --}}
                                <a href="{{ route('contact', ['plan' => $plan->name]) }}"
                                   class="mt-8 w-full block text-center py-3 rounded-lg font-heading font-semibold text-sm uppercase tracking-wider transition-all
                                          {{ $plan->is_popular
                                              ? 'bg-brand-yellow text-brand-black hover:bg-brand-gold font-bold'
                                              : 'border border-white/20 text-white hover:border-brand-yellow hover:text-brand-yellow' }}">
                                    Get Started
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>

    {{-- ===================== COMPARE TABLE ===================== --}}
    <section class="bg-brand-black py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="font-heading text-4xl md:text-5xl font-bold text-white uppercase inline-block relative pb-4">
                Compare All Features
                <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-16 h-1 bg-brand-yellow rounded-full"></span>
            </h2>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 overflow-x-auto snap-x">
            <table class="w-full min-w-[600px] bg-brand-gray rounded-2xl overflow-hidden border border-white/5">
                <thead>
                    <tr class="bg-brand-yellow sticky top-0 z-10">
                        <th class="px-6 py-4 text-left font-heading font-bold text-brand-black uppercase text-sm tracking-wider">Feature</th>
                        <th class="px-6 py-4 text-center font-heading font-bold text-brand-black uppercase text-sm tracking-wider">Basic</th>
                        <th class="px-6 py-4 text-center font-heading font-bold text-brand-black uppercase text-sm tracking-wider">Pro</th>
                        <th class="px-6 py-4 text-center font-heading font-bold text-brand-black uppercase text-sm tracking-wider">Elite</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($compareData as $i => $row)
                        <tr class="{{ $i % 2 === 0 ? 'bg-white/5' : '' }} transition hover:bg-white/10">
                            <td class="px-6 py-4 text-white font-medium text-sm">{{ $row['feature'] }}</td>
                            @foreach(['Basic', 'Pro', 'Elite'] as $planName)
                                <td class="px-6 py-4 text-center text-sm">
                                    @if($row[$planName] === '✓')
                                        <span class="text-brand-yellow font-bold">✓</span>
                                    @elseif($row[$planName] === '—')
                                        <span class="text-gray-700">—</span>
                                    @else
                                        <span class="text-gray-400">{{ $row[$planName] }}</span>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    {{-- ===================== FAQ ===================== --}}
    <section class="bg-brand-dark py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="font-heading text-4xl md:text-5xl font-bold text-white uppercase inline-block relative pb-4">
                Frequently Asked Questions
                <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-16 h-1 bg-brand-yellow rounded-full"></span>
            </h2>
        </div>

        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 space-y-4"
             x-data="{ openItem: null }">
            @foreach($faqs as $i => $faq)
                <div class="bg-brand-gray rounded-xl overflow-hidden border border-white/5">
                    <button @click="openItem = openItem === {{ $i }} ? null : {{ $i }}"
                            class="w-full flex justify-between items-center p-6 text-left text-white font-medium hover:bg-white/5 transition text-sm md:text-base">
                        <span>{{ $faq['q'] }}</span>
                        <svg class="w-6 h-6 text-brand-yellow shrink-0 ml-4 transition-transform duration-300"
                             :class="openItem === {{ $i }} ? 'rotate-45' : ''"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </button>
                    <div x-show="openItem === {{ $i }}"
                         x-collapse.duration.300ms
                         x-cloak>
                        <div class="px-6 pb-6 text-gray-400 leading-relaxed text-sm">
                            {{ $faq['a'] }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ===================== MONEY-BACK GUARANTEE ===================== --}}
    <section class="bg-brand-black py-16">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-brand-gray rounded-2xl p-8 border border-brand-yellow/20 text-center">
                <svg class="w-12 h-12 text-brand-yellow mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                <h3 class="font-heading text-2xl font-bold text-white mt-4 uppercase">30-Day Money-Back Guarantee</h3>
                <p class="text-gray-400 mt-2">Not satisfied? Get a full refund within your first 30 days, no questions asked.</p>
            </div>
        </div>
    </section>

    {{-- ===================== FINAL CTA ===================== --}}
    <section class="bg-gradient-to-r from-brand-yellow to-brand-gold py-16">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="font-heading text-3xl font-bold text-brand-black uppercase">Ready to Start?</h2>
            <a href="{{ route('contact') }}" class="inline-block mt-4 px-8 py-4 bg-brand-black text-white rounded-full font-heading font-bold text-sm uppercase tracking-wider hover:scale-105 transition-all">Claim Free Trial</a>
        </div>
    </section>

    <style>
        [x-cloak] { display: none !important; }
        .overflow-x-auto::-webkit-scrollbar { height: 6px; }
        .overflow-x-auto::-webkit-scrollbar-track { background: transparent; }
        .overflow-x-auto::-webkit-scrollbar-thumb { background: #333; border-radius: 3px; }
        .overflow-x-auto::-webkit-scrollbar-thumb:hover { background: #555; }
    </style>
</x-app-layout>
