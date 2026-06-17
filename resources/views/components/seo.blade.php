@props([
    'title' => null,
    'description' => null,
    'keywords' => null,
    'ogImage' => null,
    'ogType' => 'website',
    'canonical' => null,
    'noindex' => false,
])

<meta name="description" content="{{ $description ?? config('seo.default_description') }}">
<meta name="keywords" content="{{ $keywords ?? config('seo.default_keywords') }}">
<meta name="robots" content="{{ $noindex ? 'noindex, nofollow' : 'index, follow' }}">

<meta property="og:site_name" content="{{ config('seo.site_name') }}">
<meta property="og:title" content="{{ $title ? $title . ' | ' . config('seo.site_name') : config('seo.default_title') }}">
<meta property="og:description" content="{{ $description ?? config('seo.default_description') }}">
<meta property="og:image" content="{{ url($ogImage ?? config('seo.og_image')) }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:type" content="{{ $ogType }}">
<meta property="og:locale" content="fr_FR">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="{{ config('seo.twitter_handle') }}">
<meta name="twitter:title" content="{{ $title ? $title . ' | ' . config('seo.site_name') : config('seo.default_title') }}">
<meta name="twitter:description" content="{{ $description ?? config('seo.default_description') }}">
<meta name="twitter:image" content="{{ url($ogImage ?? config('seo.og_image')) }}">

@if($canonical)
    <link rel="canonical" href="{{ $canonical }}">
@else
    <link rel="canonical" href="{{ url()->current() }}">
@endif
