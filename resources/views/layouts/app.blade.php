<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('seo.default_title') }}</title>

    <x-seo :title="$title ?? null" />

    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpg') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.jpg') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Oswald:wght@400;500;600;700&family=Dancing+Script:wght@400;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('head')

    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "HealthClub",
        "name": "Only Fitness",
        "description": "Salle de sport premium à Tétouan avec équipement Technogym, coachs certifiés et programmes sur mesure.",
        "url": "{{ url('/') }}",
        "telephone": "+212 678-492917",
        "email": "contact@onlyfit.club",
        "address": {
            "@@type": "PostalAddress",
            "streetAddress": "Avenue Abdellah Chefchaouni, Marjane Romana",
            "addressLocality": "Tétouan",
            "addressRegion": "Tanger-Tétouan-Al Hoceïma",
            "postalCode": "93000",
            "addressCountry": "MA"
        },
        "sameAs": [
            "https://instagram.com/onlyfitness44"
        ],
        "openingHoursSpecification": [
            {
                "@@type": "OpeningHoursSpecification",
                "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
                "opens": "00:00",
                "closes": "23:59"
            }
        ],
        "image": "{{ url('images/logo.jpg') }}"
    }
    </script>

    <script>
        function global() {
            return {
                scrollY: 0,
                init() {
                    window.addEventListener('scroll', () => {
                        this.scrollY = window.scrollY;
                    });
                }
            };
        }
    </script>
</head>
<body class="font-body text-brand-black antialiased" x-data="global()">
    <x-navigation />

    @isset($header)
        <div class="bg-brand-black pt-20 pb-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </div>
    @endisset

    <main>
        {{ $slot }}
    </main>

    <x-footer />

</body>
</html>
