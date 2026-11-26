<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

@if (! request()->routeIs('home'))
    <meta name="robots" content="noindex, nofollow" />
@endif

<title>
    {{ filled($title ?? null) ? $title.' - '.config('app.name', 'Laravel') : config('app.name', 'Laravel') }}
</title>

<link rel="icon" href="{{ asset('assests/favicon.ico') }}" sizes="any">
<link rel="icon" href="{{ asset('assests/icon-master.svg') }}" type="image/svg+xml">
<link rel="icon" href="{{ asset('assests/favicon-32x32.png') }}" type="image/png" sizes="32x32">
<link rel="apple-touch-icon" href="{{ asset('assests/apple-touch-icon.png') }}">
<link rel="manifest" href="{{ asset('assests/site.webmanifest') }}">
<meta name="theme-color" content="#294D40">

@fonts

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance
