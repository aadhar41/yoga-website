@php
    $pageTitle = __("Let's get started") . ' - ' . config('app.name', 'Laravel');
    $pageDescription = 'Get started with Laravel and explore its ecosystem.';
    $canonicalUrl = rtrim((string) config('app.url'), '/') . '/';
    $structuredData = json_encode(
        [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => config('app.name', 'Laravel'),
            'description' => $pageDescription,
            'url' => $canonicalUrl,
        ],
        JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR,
    );
@endphp

<x-public-layout :title="$pageTitle">
    <x-slot:meta>
        <meta name="description" content="{{ $pageDescription }}">
        <link rel="canonical" href="{{ $canonicalUrl }}">

        <meta property="og:type" content="website">
        <meta property="og:site_name" content="{{ config('app.name', 'Laravel') }}">
        <meta property="og:title" content="{{ $pageTitle }}">
        <meta property="og:description" content="{{ $pageDescription }}">
        <meta property="og:url" content="{{ $canonicalUrl }}">
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="{{ $pageTitle }}">
        <meta name="twitter:description" content="{{ $pageDescription }}">

        <script type="application/ld+json">
            {!! $structuredData !!}
        </script>
    </x-slot:meta>

    <section class="py-20 sm:py-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl">
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#82977B]">
                    Traditional Practice &bull; Holistic Wellness
                </p>
                <h1 class="mt-4 font-serif text-4xl sm:text-5xl lg:text-6xl font-semibold tracking-tight text-[#29483C] leading-[1.12]">
                    Grounded movement, breath, and stillness.
                </h1>
                <p class="mt-6 text-base sm:text-lg text-stone-600 leading-relaxed">
                    Guided Hatha, Vinyasa, Pranayama, and restorative meditation programmes designed for mindful living.
                </p>
                <div class="mt-8 flex flex-wrap items-center gap-4">
                    <a href="{{ url('/programmes') }}"
                       class="px-6 py-3 rounded-full bg-[#29483C] text-[#FAF8F2] text-sm font-medium hover:bg-[#1f372e] transition">
                        Explore Programmes
                    </a>
                    <a href="{{ url('/schedule') }}"
                       class="px-6 py-3 rounded-full border border-[#29483C]/30 text-[#29483C] text-sm font-medium hover:bg-[#82977B]/10 transition">
                        View Schedule
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>