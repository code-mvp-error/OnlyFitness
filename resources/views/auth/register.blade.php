@php
    $goals = [
        'select' => 'Select your goal',
        'lose_weight' => 'Lose Weight',
        'build_muscle' => 'Build Muscle',
        'improve_endurance' => 'Improve Endurance',
        'general_fitness' => 'General Fitness',
    ];
    $plans = \App\Models\Plan::all();
@endphp

<x-guest-layout>
    <h1 class="text-white font-heading text-3xl text-center mb-2 font-bold uppercase tracking-wide">Join Only Fitness</h1>
    <p class="text-gray-400 text-center text-sm mb-8">Start your transformation today</p>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="text-gray-300 text-sm font-medium mb-2 block">Name</label>
            <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                   class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition"
                   placeholder="Your full name">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <label for="email" class="text-gray-300 text-sm font-medium mb-2 block">Email</label>
            <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
                   class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition"
                   placeholder="your@email.com">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <label for="phone" class="text-gray-300 text-sm font-medium mb-2 block">Phone</label>
            <input id="phone" type="tel" name="phone" :value="old('phone')" required
                   class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition"
                   placeholder="+212 678-492917">
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <div>
            <label for="goal" class="text-gray-300 text-sm font-medium mb-2 block">Fitness Goal</label>
            <select id="goal" name="goal" required
                    class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition">
                @foreach($goals as $value => $label)
                    <option value="{{ $value }}" {{ old('goal') == $value ? 'selected' : '' }} {{ $loop->first ? 'disabled' : '' }}
                            class="bg-brand-black text-white">{{ $label }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('goal')" class="mt-2" />
        </div>

        <div>
            <label for="plan_id" class="text-gray-300 text-sm font-medium mb-2 block">Preferred Plan</label>
            <select id="plan_id" name="plan_id" required
                    class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition">
                <option value="" disabled {{ old('plan_id') === null ? 'selected' : '' }}>Select plan</option>
                @foreach($plans as $plan)
                    <option value="{{ $plan->id }}" {{ old('plan_id') == $plan->id ? 'selected' : '' }}
                            class="bg-brand-black text-white">{{ $plan->name }} (MAD {{ number_format($plan->price_monthly, 0) }}/mo)</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('plan_id')" class="mt-2" />
        </div>

        <div>
            <label for="password" class="text-gray-300 text-sm font-medium mb-2 block">Password</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                   class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition"
                   placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="password_confirmation" class="text-gray-300 text-sm font-medium mb-2 block">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                   class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition"
                   placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <button type="submit" class="w-full bg-brand-yellow text-brand-black rounded-xl py-3 font-bold hover:bg-brand-gold transition tracking-wide">
            CREATE ACCOUNT
        </button>

        <p class="text-center text-sm text-gray-400">
            Already a member?
            <a href="{{ route('login') }}" class="text-brand-yellow hover:underline">Sign in</a>
        </p>
    </form>
</x-guest-layout>
