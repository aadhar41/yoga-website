@php
    $pageTitle = config('app.name') . ' — Authentic Yoga & Holistic Wellness';
    $pageDescription = 'Traditional Hatha, Vinyasa, Pranayama, and restorative meditation sessions guided with mindful precision.';
    $canonicalUrl = rtrim((string) config('app.url'), '/') . '/';
    $structuredData = json_encode(
        [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => config('app.name'),
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
        <meta property="og:site_name" content="{{ config('app.name') }}">
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

    {{-- 1. HERO --}}
    <section class="relative overflow-hidden py-20 sm:py-28 border-b border-stone-200/70">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-7">
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#82977B]">
                    Traditional Practice &bull; Holistic Wellness
                </p>
                <h1 class="mt-4 font-serif text-4xl sm:text-5xl lg:text-6xl font-semibold tracking-tight text-[#29483C] leading-[1.12]">
                    Grounded movement, conscious breath, and lasting stillness.
                </h1>
                <p class="mt-6 text-base sm:text-lg text-stone-600 leading-relaxed max-w-2xl">
                    Personalized Hatha, Vinyasa, Pranayama, and restorative meditation programmes rooted in classical yogic lineage for daily balance and resilience.
                </p>
                <div class="mt-8 flex flex-wrap items-center gap-4">
                    <a href="{{ route('programmes.index') }}"
                       class="px-7 py-3.5 rounded-full bg-[#29483C] text-[#FAF8F2] text-sm font-medium hover:bg-[#1f372e] transition shadow-xs">
                        Explore Programmes
                    </a>
                    <a href="{{ route('contact') }}"
                       class="px-7 py-3.5 rounded-full border border-[#29483C] text-[#29483C] text-sm font-medium hover:bg-[#82977B]/15 transition">
                        Enquire Now
                    </a>
                </div>
            </div>

            <div class="lg:col-span-5">
                <div class="aspect-[4/5] rounded-2xl bg-[#29483C]/10 border border-[#82977B]/30 p-8 flex flex-col justify-between">
                    <span class="inline-block w-fit px-3 py-1 rounded-full bg-[#FAF8F2] text-xs font-medium text-[#29483C]">
                        Morning &amp; Evening Batches
                    </span>
                    <div>
                        <p class="font-serif italic text-2xl text-[#29483C] leading-snug">
                            “Yoga is the settling of the mind into silence.”
                        </p>
                        <p class="mt-3 text-xs uppercase tracking-wider text-stone-600">
                            Patanjali Yoga Sutras 1.2
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 2. SERVICES --}}
    <section class="py-16 sm:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl">
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#82977B]">Our Offerings</p>
                <h2 class="mt-2 font-serif text-3xl sm:text-4xl font-semibold text-[#29483C]">
                    Holistic Services for Body &amp; Mind
                </h2>
            </div>

            <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($categories as $category)
                    <div class="bg-white rounded-2xl border border-stone-200/80 p-6 shadow-2xs">
                        <h3 class="font-serif text-xl font-semibold text-[#29483C]">{{ $category->name }}</h3>
                        <p class="mt-2 text-sm text-stone-600 leading-relaxed">
                            {{ $category->description ?? 'Structured guidance tailored to individual capacity, alignment, and breath awareness.' }}
                        </p>
                    </div>
                @empty
                    @foreach ([
                        ['title' => 'Classical Hatha & Alignment', 'desc' => 'Foundational postures held with steady breath to build joint stability, spinal health, and endurance.'],
                        ['title' => 'Pranayama & Breathwork', 'desc' => 'Systematic breath regulation practices to calm the nervous system and sharpen mental clarity.'],
                        ['title' => 'Restorative & Yoga Nidra', 'desc' => 'Deeply restful guided sessions for stress recovery, better sleep, and emotional equilibrium.'],
                    ] as $service)
                        <div class="bg-white rounded-2xl border border-stone-200/80 p-6 shadow-2xs">
                            <h3 class="font-serif text-xl font-semibold text-[#29483C]">{{ $service['title'] }}</h3>
                            <p class="mt-2 text-sm text-stone-600 leading-relaxed">{{ $service['desc'] }}</p>
                        </div>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

    {{-- 3. FEATURED PROGRAMMES --}}
    <section class="py-16 sm:py-20 bg-white border-y border-stone-200/70">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#82977B]">Curated Pathways</p>
                    <h2 class="mt-2 font-serif text-3xl sm:text-4xl font-semibold text-[#29483C]">
                        Featured Programmes
                    </h2>
                </div>
                <a href="{{ route('programmes.index') }}" class="text-sm font-medium text-[#29483C] hover:underline">
                    View all programmes &rarr;
                </a>
            </div>

            <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse ($featuredProgrammes as $programme)
                    <article class="rounded-2xl bg-[#FAF8F2] border border-stone-200/80 p-6 flex flex-col justify-between">
                        <div>
                            @if ($programme->category)
                                <span class="text-xs font-semibold uppercase tracking-wider text-[#82977B]">
                                    {{ $programme->category->name }}
                                </span>
                            @endif
                            <h3 class="mt-2 font-serif text-xl font-semibold text-[#29483C]">
                                <a href="{{ route('programmes.show', $programme) }}" class="hover:underline">
                                    {{ $programme->title }}
                                </a>
                            </h3>
                            <p class="mt-3 text-sm text-stone-600 leading-relaxed line-clamp-3">
                                {{ $programme->short_description ?? $programme->overview }}
                            </p>
                        </div>
                        <div class="mt-6 pt-4 border-t border-stone-200/80 flex items-center justify-between text-xs text-stone-500">
                            <span>{{ $programme->level ?? 'All Levels' }}</span>
                            <a href="{{ route('programmes.show', $programme) }}" class="font-medium text-[#29483C] hover:underline">
                                Details &rarr;
                            </a>
                        </div>
                    </article>
                @empty
                    <p class="col-span-3 text-sm text-stone-500">
                        New seasonal programmes are being published shortly. <a href="{{ route('contact') }}" class="text-[#29483C] underline">Enquire for upcoming batch dates.</a>
                    </p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- 4. QUALIFICATIONS --}}
    <section class="py-16 sm:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            <div class="lg:col-span-7">
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#82977B]">Lineage &amp; Credentials</p>
                <h2 class="mt-2 font-serif text-3xl sm:text-4xl font-semibold text-[#29483C]">
                    {{ $instructor ? trim($instructor->title.' '.$instructor->user->name) : 'Guided by Certified Yogic Instruction' }}
                </h2>
                <p class="mt-4 text-sm sm:text-base text-stone-600 leading-relaxed">
                    {{ $instructor?->short_bio ?? 'Grounded in classical Indian yoga traditions, anatomical safety, and therapeutic breathwork to support practitioners across every life stage.' }}
                </p>

                @if (!empty($instructor?->qualifications))
                    <ul class="mt-6 space-y-2 text-sm text-stone-700">
                        @foreach ((array) $instructor->qualifications as $cert)
                            <li class="flex items-center gap-2.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#C5A66D]"></span>
                                <span>{{ is_array($cert) ? ($cert['title'] ?? implode(' — ', $cert)) : $cert }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif

                <div class="mt-8">
                    <a href="{{ route('about') }}" class="text-sm font-medium text-[#29483C] hover:underline">
                        Read full biography &amp; qualifications &rarr;
                    </a>
                </div>
            </div>

            <div class="lg:col-span-5 bg-white rounded-2xl border border-stone-200 p-8">
                <dl class="grid grid-cols-2 gap-6">
                    <div>
                        <dt class="text-xs uppercase tracking-wider text-stone-500">Experience</dt>
                        <dd class="mt-1 font-serif text-3xl font-semibold text-[#29483C]">
                            {{ $instructor?->years_of_experience ? $instructor->years_of_experience . '+ Yrs' : 'Dedicated' }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs uppercase tracking-wider text-stone-500">Focus</dt>
                        <dd class="mt-1 font-serif text-xl font-semibold text-[#29483C]">Hatha &amp; Therapy</dd>
                    </div>
                </dl>
            </div>
        </div>
    </section>

    {{-- 5. BENEFITS --}}
    <section class="py-16 sm:py-20 bg-[#29483C] text-[#FAF8F2]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#C5A66D]">Why Practice Here</p>
            <h2 class="mt-2 font-serif text-3xl sm:text-4xl font-semibold text-white">
                Tangible Benefits of Consistent Practice
            </h2>

            <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ([
                    ['title' => 'Functional Mobility', 'text' => 'Release chronic stiffness in the spine, hips, and shoulders through progressive asana work.'],
                    ['title' => 'Nervous System Calm', 'text' => 'Down-regulate daily stress and improve sleep quality via structured pranayama.'],
                    ['title' => 'Small-Group Attention', 'text' => 'Individual posture adjustments and safe props tailored to your body’s current capacity.'],
                    ['title' => 'Sustainable Routine', 'text' => 'Practical home-practice takeaways you can integrate into busy mornings or evenings.'],
                ] as $benefit)
                    <div class="rounded-2xl bg-white/5 border border-white/10 p-6">
                        <h3 class="font-serif text-lg font-semibold text-white">{{ $benefit['title'] }}</h3>
                        <p class="mt-2 text-sm text-stone-300 leading-relaxed">{{ $benefit['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- 6. TESTIMONIALS --}}
    <section class="py-16 sm:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#82977B]">Student Reflections</p>
            <h2 class="mt-2 font-serif text-3xl sm:text-4xl font-semibold text-[#29483C]">
                Experiences from Practitioners
            </h2>

            <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse ($testimonials as $testimonial)
                    <blockquote class="bg-white rounded-2xl border border-stone-200/80 p-6 flex flex-col justify-between">
                        <p class="text-sm text-stone-700 leading-relaxed">“{{ $testimonial->content }}”</p>
                        <footer class="mt-4 pt-4 border-t border-stone-100 text-xs font-semibold text-[#29483C]">
                            {{ $testimonial->author_name }}
                        </footer>
                    </blockquote>
                @empty
                    <p class="col-span-3 text-sm text-stone-500">
                        Verified practitioner reflections will appear here once published.
                    </p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- 7. ARTICLES --}}
    <section class="py-16 sm:py-20 bg-white border-t border-stone-200/70">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#82977B]">Journal &amp; Notes</p>
            <h2 class="mt-2 font-serif text-3xl sm:text-4xl font-semibold text-[#29483C]">
                Latest Reflections &amp; Practice Guides
            </h2>

            <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse ($latestPosts as $post)
                    <article class="rounded-2xl bg-[#FAF8F2] border border-stone-200/80 p-6">
                        <p class="text-xs text-stone-500">{{ $post->published_at?->format('d M Y') }}</p>
                        <h3 class="mt-2 font-serif text-lg font-semibold text-[#29483C]">{{ $post->title }}</h3>
                        <p class="mt-2 text-sm text-stone-600 line-clamp-3">{{ $post->excerpt }}</p>
                    </article>
                @empty
                    <p class="col-span-3 text-sm text-stone-500">
                        Practice articles and seasonal wellness notes are coming soon.
                    </p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- 8. CONTACT STRIP & WELLNESS DISCLAIMER --}}
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <div class="rounded-3xl bg-[#82977B]/20 border border-[#82977B]/40 p-8 sm:p-12 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                <div>
                    <h2 class="font-serif text-2xl sm:text-3xl font-semibold text-[#29483C]">
                        Ready to begin or have a question about a programme?
                    </h2>
                    <p class="mt-2 text-sm sm:text-base text-stone-700">
                        Reach out to discuss batch timings, beginner guidance, or private wellness consultations.
                    </p>
                </div>
                <div class="flex flex-wrap gap-3 shrink-0">
                    <a href="{{ route('schedule') }}"
                       class="px-6 py-3 rounded-full border border-[#29483C] text-[#29483C] text-sm font-medium hover:bg-white/60 transition">
                        Class Schedule
                    </a>
                    <a href="{{ route('contact') }}"
                       class="px-6 py-3 rounded-full bg-[#29483C] text-[#FAF8F2] text-sm font-medium hover:bg-[#1f372e] transition">
                        Enquire Now
                    </a>
                </div>
            </div>

            <x-public.disclaimer />
        </div>
    </section>
</x-public-layout>
