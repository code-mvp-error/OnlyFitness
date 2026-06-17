<x-app-layout title="500 - Erreur Interne | Only Fitness">
    <div class="min-h-screen flex items-center justify-center bg-brand-black px-4">
        <div class="text-center max-w-lg">
            <h1 class="font-heading text-8xl sm:text-9xl font-bold text-brand-yellow">500</h1>
            <h2 class="font-heading text-2xl sm:text-3xl font-bold text-white uppercase mt-4 mb-3">Erreur Interne</h2>
            <p class="text-gray-400 text-lg mb-8">Something went wrong on our end. We're working on it — please try again shortly.</p>
            <a href="{{ route('home') }}" class="inline-block px-8 py-4 bg-brand-yellow text-brand-black font-heading font-bold text-sm uppercase tracking-widest rounded-xl hover:bg-yellow-400 hover:scale-105 transition">Back to Home</a>
        </div>
    </div>
</x-app-layout>