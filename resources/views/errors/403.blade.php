<x-app-layout title="403 - Accès Refusé | Only Fitness">
    <div class="min-h-screen flex items-center justify-center bg-brand-black px-4">
        <div class="text-center max-w-lg">
            <h1 class="font-heading text-8xl sm:text-9xl font-bold text-brand-yellow">403</h1>
            <h2 class="font-heading text-2xl sm:text-3xl font-bold text-white uppercase mt-4 mb-3">Accès Refusé</h2>
            <p class="text-gray-400 text-lg mb-8">You don't have permission to access this page. If you believe this is a mistake, contact us.</p>
            <a href="{{ route('home') }}" class="inline-block px-8 py-4 bg-brand-yellow text-brand-black font-heading font-bold text-sm uppercase tracking-widest rounded-xl hover:bg-yellow-400 hover:scale-105 transition">Back to Home</a>
        </div>
    </div>
</x-app-layout>