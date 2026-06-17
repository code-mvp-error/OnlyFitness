<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Only Fitness') }}</title>

        <x-seo noindex />

        <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpg') }}">
        <link rel="apple-touch-icon" href="{{ asset('images/logo.jpg') }}">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Oswald:wght@400;500;600;700&family=Dancing+Script:wght@400;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-body text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-brand-black">
            <div class="mb-6">
                <a href="/" class="flex flex-col items-center space-y-2">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Only Fitness" class="h-16 w-auto">
                    <span class="font-heading font-semibold text-xl tracking-wider text-white">ONLY FITNESS</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-2 px-8 py-8 bg-brand-gray rounded-2xl border border-white/10 shadow-xl">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
