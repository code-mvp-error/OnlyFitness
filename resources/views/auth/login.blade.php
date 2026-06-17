<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <h1 class="text-white font-heading text-3xl text-center mb-2 font-bold uppercase tracking-wide">Welcome Back</h1>
    <p class="text-gray-400 text-center text-sm mb-8">Sign in to continue your journey</p>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="text-gray-300 text-sm font-medium mb-2 block">Email</label>
            <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                   class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition"
                   placeholder="your@email.com">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <label for="password" class="text-gray-300 text-sm font-medium mb-2 block">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition"
                   placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="flex items-center gap-2 cursor-pointer">
                <input id="remember_me" type="checkbox" name="remember"
                       class="w-4 h-4 rounded border-white/10 bg-brand-black text-brand-yellow focus:ring-brand-yellow/50 focus:ring-2 focus:ring-offset-0 focus:outline-none">
                <span class="text-sm text-gray-400">Remember me</span>
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-brand-yellow hover:underline">Forgot password?</a>
            @endif
        </div>

        <button type="submit" class="w-full bg-brand-yellow text-brand-black rounded-xl py-3 font-bold hover:bg-brand-gold transition tracking-wide">
            SIGN IN
        </button>

        <p class="text-center text-sm text-gray-400">
            Not a member yet?
            <a href="{{ route('register') }}" class="text-brand-yellow hover:underline">Create account</a>
        </p>
    </form>
</x-guest-layout>
