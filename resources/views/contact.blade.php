<x-app-layout title="Contactez Only Fitness à Tétouan | Demandez Votre Essai Gratuit">
    @php
        $locations = [
            [
                'name' => 'Only Fitness Tétouan',
                'address' => 'Avenue Abdellah Chefchaouni, Marjane Romana, Tétouan, Morocco, 93000',
                'distance' => 'Centre-ville',
                'image' => 'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?w=600',
            ],
        ];
    @endphp

    {{-- ===================== PAGE HEADER ===================== --}}
    <section class="bg-brand-black pt-32 pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="font-heading text-4xl md:text-5xl font-bold text-white uppercase">Get In Touch</h1>
            <div class="w-24 h-1 bg-brand-yellow mx-auto mt-4 rounded-full"></div>
            <p class="text-gray-400 mt-6 max-w-2xl mx-auto">Ready to transform? Reach out and we&#39;ll get you started on your fitness journey.</p>
        </div>
    </section>

    {{-- ===================== CONTACT GRID ===================== --}}
    <section class="bg-brand-dark py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

                {{-- LEFT: Contact Form --}}
                <div class="bg-[#111111] border border-white/10 rounded-2xl p-8 md:p-12"
                     x-data="contactForm()"
                     x-init="form.plan = '{{ $selectedPlan ?? '' }}'">
                    <h2 class="font-heading text-2xl font-bold text-white mb-8">Send Us a Message</h2>

                    {{-- Success --}}
                    <div x-show="success"
                         x-transition:enter="transition ease-out duration-300"
                         class="bg-green-500/10 border border-green-500/30 text-green-400 rounded-xl p-4 mb-6">
                        <p class="text-sm font-medium">Thank you! We&#39;ll contact you within 24 hours.</p>
                    </div>

                    {{-- Errors --}}
                    <div x-show="Object.keys(errors).length > 0"
                         x-transition:enter="transition ease-out duration-300"
                         class="bg-red-500/10 border border-red-500/30 text-red-400 rounded-xl p-4 mb-6">
                        <ul class="list-disc list-inside text-sm space-y-1">
                            <template x-for="(msgs, field) in errors" :key="field">
                                <template x-for="msg in msgs" :key="msg">
                                    <li x-text="msg"></li>
                                </template>
                            </template>
                        </ul>
                    </div>

                    <form @submit.prevent="submit()" class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-heading font-semibold uppercase tracking-wider text-gray-400 mb-2">Full Name</label>
                            <input type="text" id="name" x-model="form.name" required placeholder="John Doe"
                                   class="w-full bg-brand-black border border-white/10 rounded-xl px-6 py-4 text-white placeholder-gray-500 focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition-colors">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-heading font-semibold uppercase tracking-wider text-gray-400 mb-2">Email Address</label>
                            <input type="email" id="email" x-model="form.email" required placeholder="john@example.com"
                                   class="w-full bg-brand-black border border-white/10 rounded-xl px-6 py-4 text-white placeholder-gray-500 focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition-colors">
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-heading font-semibold uppercase tracking-wider text-gray-400 mb-2">Phone Number</label>
                            <input type="tel" id="phone" x-model="form.phone" required placeholder="+212 678-492917"
                                   class="w-full bg-brand-black border border-white/10 rounded-xl px-6 py-4 text-white placeholder-gray-500 focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition-colors">
                        </div>
                        <div>
                            <label for="goal" class="block text-sm font-heading font-semibold uppercase tracking-wider text-gray-400 mb-2">Fitness Goal</label>
                            <select id="goal" x-model="form.goal" required
                                    class="w-full bg-brand-black border border-white/10 rounded-xl px-6 py-4 text-white focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition-colors">
                                <option value="" disabled selected class="text-gray-500">Select Goal</option>
                                <option value="lose_weight">Lose Weight</option>
                                <option value="build_muscle">Build Muscle</option>
                                <option value="improve_endurance">Improve Endurance</option>
                                <option value="general_fitness">General Fitness</option>
                            </select>
                        </div>
                        <div>
                            <label for="plan" class="block text-sm font-heading font-semibold uppercase tracking-wider text-gray-400 mb-2">Interested Plan</label>
                            <select id="plan" x-model="form.plan" required
                                    class="w-full bg-brand-black border border-white/10 rounded-xl px-6 py-4 text-white focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition-colors">
                                <option value="" disabled selected class="text-gray-500">Select Plan</option>
                                <option value="basic">Basic (MAD 299/mo)</option>
                                <option value="pro">Pro (MAD 599/mo)</option>
                                <option value="elite">Elite (MAD 999/mo)</option>
                            </select>
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-heading font-semibold uppercase tracking-wider text-gray-400 mb-2">Your Message</label>
                            <textarea id="message" x-model="form.message" required rows="4" placeholder="Tell us about your goals..."
                                      class="w-full bg-brand-black border border-white/10 rounded-xl px-6 py-4 text-white placeholder-gray-500 focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition-colors resize-vertical"></textarea>
                        </div>
                        <button type="submit" :disabled="loading"
                                :class="loading ? 'opacity-70 cursor-wait' : 'hover:bg-brand-gold hover:scale-[1.02]'"
                                class="w-full py-4 bg-brand-yellow text-brand-black rounded-xl font-bold text-lg transition-all">
                            <span x-text="loading ? 'Sending...' : 'Send Message'"></span>
                        </button>
                    </form>
                </div>

                {{-- RIGHT: Gym Info --}}
                <div class="bg-[#111111] border border-white/10 rounded-2xl p-8 md:p-12">
                    <h2 class="font-heading text-2xl font-bold text-white mb-8">Visit Us</h2>

                    <div class="space-y-6">
                        {{-- Address --}}
                        <div class="flex gap-4">
                            <div class="shrink-0 mt-1">
                                <svg class="w-6 h-6 text-brand-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-gray-500 text-xs uppercase tracking-wider font-heading font-semibold">Location</p>
                                <p class="text-white mt-1">Avenue Abdellah Chefchaouni, Marjane Romana, Tétouan 93000, Morocco</p>
                            </div>
                        </div>

                        {{-- Phone --}}
                        <div class="flex gap-4">
                            <div class="shrink-0 mt-1">
                                <svg class="w-6 h-6 text-brand-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <div>
                                <p class="text-gray-500 text-xs uppercase tracking-wider font-heading font-semibold">Phone</p>
                                <p class="text-white mt-1">+212 678-492917</p>
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="flex gap-4">
                            <div class="shrink-0 mt-1">
                                <svg class="w-6 h-6 text-brand-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <p class="text-gray-500 text-xs uppercase tracking-wider font-heading font-semibold">Email</p>
                                <p class="text-white mt-1">contact@onlyfit.club</p>
                            </div>
                        </div>

                        {{-- Hours --}}
                        <div class="flex gap-4">
                            <div class="shrink-0 mt-1">
                                <svg class="w-6 h-6 text-brand-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-gray-500 text-xs uppercase tracking-wider font-heading font-semibold">Hours</p>
                                <p class="text-white mt-1">Open 24/7 — Staffed 6AM - 10PM</p>
                            </div>
                        </div>
                    </div>

                    {{-- Map --}}
                    <div class="mt-8 overflow-hidden rounded-xl border border-white/10"
                         x-data="{ mapLoaded: false }"
                         x-init="
                             const observer = new IntersectionObserver((entries) => {
                                 if (entries[0].isIntersecting) { mapLoaded = true; observer.disconnect(); }
                             }, { threshold: 0.1 });
                             observer.observe($el);
                         ">
                        <template x-if="mapLoaded">
                            <iframe src="https://maps.google.com/maps?q=Avenue+Abdellah+Chefchaouni+Tétouan+Morocco&output=embed"
                                    width="100%" height="256"
                                    class="w-full h-64 grayscale hover:grayscale-0 transition-all duration-500"
                                    style="border:0;"
                                    allowfullscreen=""
                                    loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </template>
                        <div x-show="!mapLoaded" class="h-64 bg-brand-black flex items-center justify-center">
                            <p class="text-gray-600 text-sm">Loading map...</p>
                        </div>
                    </div>

                    {{-- Social Links --}}
                    <div class="mt-8 flex gap-4">
                        <a href="https://instagram.com/onlyfitness44" target="_blank" rel="noopener noreferrer"
                           class="w-12 h-12 rounded-full bg-brand-gray flex items-center justify-center text-brand-yellow hover:bg-brand-yellow hover:text-brand-black transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                        <a href="https://facebook.com" target="_blank" rel="noopener noreferrer"
                           class="w-12 h-12 rounded-full bg-brand-gray flex items-center justify-center text-brand-yellow hover:bg-brand-yellow hover:text-brand-black transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="https://youtube.com" target="_blank" rel="noopener noreferrer"
                           class="w-12 h-12 rounded-full bg-brand-gray flex items-center justify-center text-brand-yellow hover:bg-brand-yellow hover:text-brand-black transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                        <a href="https://twitter.com" target="_blank" rel="noopener noreferrer"
                           class="w-12 h-12 rounded-full bg-brand-gray flex items-center justify-center text-brand-yellow hover:bg-brand-yellow hover:text-brand-black transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================== FREE PASS CTA ===================== --}}
    <section class="bg-brand-black py-24">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-brand-gray rounded-3xl p-8 md:p-12 border border-brand-yellow/20 text-center">
                <svg class="w-16 h-16 text-brand-yellow mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                </svg>
                <h2 class="font-heading text-3xl md:text-4xl font-bold text-white mt-6">Claim Your Free 7-Day Pass</h2>
                <p class="text-gray-400 mt-2">No commitment. No excuses. Just results.</p>

                <div class="flex flex-wrap justify-center gap-4 mt-6">
                    <span class="bg-brand-yellow/10 text-brand-yellow px-4 py-2 rounded-full text-sm font-medium">Full gym access</span>
                    <span class="bg-brand-yellow/10 text-brand-yellow px-4 py-2 rounded-full text-sm font-medium">All group classes</span>
                    <span class="bg-brand-yellow/10 text-brand-yellow px-4 py-2 rounded-full text-sm font-medium">1 PT session</span>
                    <span class="bg-brand-yellow/10 text-brand-yellow px-4 py-2 rounded-full text-sm font-medium">No credit card</span>
                </div>

                <div x-data="freePassForm()" class="mt-8">
                    <template x-if="!success">
                        <form @submit.prevent="submit()" class="flex flex-col md:flex-row gap-4 max-w-xl mx-auto">
                            <input type="email" x-model="email" required placeholder="Enter your email"
                                   class="flex-1 bg-brand-black border border-white/10 rounded-full px-6 py-4 text-white placeholder-gray-500 focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition-colors">
                            <button type="submit"
                                    class="bg-brand-yellow text-brand-black px-8 py-4 rounded-full font-bold hover:bg-brand-gold transition whitespace-nowrap">
                                Get Free Pass
                            </button>
                        </form>
                    </template>
                    <template x-if="success">
                        <div class="bg-green-500/10 border border-green-500/30 text-green-400 rounded-xl p-4 text-center">
                            <p class="font-medium">Check your email for your free 7-day pass!</p>
                        </div>
                    </template>
                    <p class="text-gray-600 text-xs mt-4">By signing up, you agree to our Terms & Privacy Policy</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================== LOCATIONS ===================== --}}
    <section class="bg-brand-dark py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="font-heading text-4xl md:text-5xl font-bold text-white uppercase inline-block relative pb-4">
                Our Locations
                <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-16 h-1 bg-brand-yellow rounded-full"></span>
            </h2>
        </div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($locations as $location)
                    <div class="group rounded-2xl overflow-hidden border border-white/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                        <img src="{{ $location['image'] }}"
                             alt="{{ $location['name'] }}"
                             class="h-48 w-full object-cover transition-transform duration-500 group-hover:scale-105"
                             loading="lazy">
                        <div class="p-6 bg-brand-gray">
                            <h3 class="text-white font-heading font-bold text-lg">{{ $location['name'] }}</h3>
                            <p class="text-gray-400 text-sm mt-1">{{ $location['address'] }}</p>
                            <p class="text-brand-yellow text-sm mt-2 font-medium">{{ $location['distance'] }}</p>
                            <a href="https://maps.google.com/?q={{ urlencode($location['address']) }}" target="_blank" rel="noopener noreferrer"
                               class="inline-block mt-3 text-brand-yellow text-sm font-medium hover:underline">View Details →</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <script>
        function contactForm() {
            return {
                form: {
                    name: '',
                    email: '',
                    phone: '',
                    goal: '',
                    plan: '',
                    message: '',
                },
                loading: false,
                success: false,
                errors: {},
                submit() {
                    this.loading = true;
                    this.errors = {};
                    this.success = false;

                    fetch('{{ route("contact.store") }}', {
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
                            this.form = { name: '', email: '', phone: '', goal: '', plan: '', message: '' };
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

        function freePassForm() {
            return {
                email: '',
                success: false,
                submit() {
                    if (!this.email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.email)) return;
                    this.success = true;
                }
            };
        }
    </script>

    <style>
        .overflow-x-auto::-webkit-scrollbar { height: 6px; }
        .overflow-x-auto::-webkit-scrollbar-track { background: transparent; }
        .overflow-x-auto::-webkit-scrollbar-thumb { background: #333; border-radius: 3px; }
        .overflow-x-auto::-webkit-scrollbar-thumb:hover { background: #555; }
    </style>
</x-app-layout>
