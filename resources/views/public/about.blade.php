@php
    $instructorName = $instructor
        ? trim($instructor->title.' '.$instructor->user->name)
        : 'Yogacharya Deepashree Gaur';
    $pageTitle = 'About ' . $instructorName . ' — ' . config('app.name');
    $pageDescription = $instructor?->short_bio
        ?? 'Learn about our classical yogic lineage, teaching philosophy, certifications, and holistic wellness approach.';
@endphp

<x-public-layout :title="$pageTitle">
    <x-slot:meta>
        <meta name="description" content="{{ $pageDescription }}">
        <link rel="canonical" href="{{ route('about') }}">

        <meta property="og:type" content="profile">
        <meta property="og:site_name" content="{{ config('app.name') }}">
        <meta property="og:title" content="{{ $pageTitle }}">
        <meta property="og:description" content="{{ $pageDescription }}">
        <meta property="og:url" content="{{ route('about') }}">
    </x-slot:meta>

    {{-- Hero Header --}}
    <section class="py-16 sm:py-24 border-b border-stone-200/70">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-7">
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#82977B]">
                    About the Practice
                </p>
                <h1 class="mt-3 font-serif text-4xl sm:text-5xl font-semibold text-[#29483C] leading-[1.15]">
                    {{ $instructorName }}
                </h1>
                @if ($instructor?->tagline)
                    <p class="mt-3 font-serif italic text-xl text-stone-600">
                        {{ $instructor->tagline }}
                    </p>
                @endif
                <p class="mt-6 text-base sm:text-lg text-stone-600 leading-relaxed">
                    {{ $instructor?->short_bio ?? 'Rooted in classical Indian yogic discipline, our practice bridges traditional asana, pranayama, and restorative stillness for modern daily life.' }}
                </p>
            </div>

            <div class="lg:col-span-5">
                <div class="rounded-2xl bg-white border border-stone-200/80 p-8 shadow-2xs space-y-6">
                    @if ($instructor?->headshot_path)
                        <img src="{{ Storage::url($instructor->headshot_path) }}"
                             alt="{{ $instructorName }}"
                             class="w-full aspect-[4/3] object-cover rounded-xl">
                    @else
                        <div class="w-full aspect-[4/3] rounded-xl bg-[#29483C]/10 border border-[#82977B]/30 flex items-center justify-center p-6 text-center">
                            <p class="font-serif italic text-xl text-[#29483C]">
                                “Steadiness and ease in every posture, clarity in every breath.”
                            </p>
                        </div>
                    @endif

                    <dl class="grid grid-cols-2 gap-4 pt-2 border-t border-stone-100">
                        <div>
                            <dt class="text-xs uppercase tracking-wider text-stone-500">Experience</dt>
                            <dd class="mt-1 font-serif text-2xl font-semibold text-[#29483C]">
                                {{ $instructor?->years_of_experience ? $instructor->years_of_experience . '+ Years' : 'Dedicated' }}
                            </dd>
                        </div>
                        <div>
                            <dt class="text-xs uppercase tracking-wider text-stone-500">Tradition</dt>
                            <dd class="mt-1 font-serif text-xl font-semibold text-[#29483C]">
                                Hatha &amp; Therapy
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </section>

    {{-- Biography & Lineage --}}
    <section class="py-16 sm:py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div class="space-y-4 text-stone-700 leading-relaxed">
                <h2 class="font-serif text-2xl sm:text-3xl font-semibold text-[#29483C]">
                    Teaching Philosophy &amp; Lineage
                </h2>
                @if ($instructor?->full_bio)
                    <div class="space-y-4 text-base leading-relaxed">
                        {!! nl2br(e($instructor->full_bio)) !!}
                    </div>
                @else
                    <p>
                        Every session emphasizes conscious breath awareness, structural alignment, and non-competitive self-study. Classes are intentionally paced so beginners build safe foundations while experienced practitioners deepen subtle internal focus.
                    </p>
                    <p>
                        By integrating classical asana, pranayama, and guided relaxation, each programme supports physical mobility, nervous-system resilience, and emotional steadiness.
                    </p>
                @endif
            </div>

            {{-- Certifications & Qualifications --}}
            <div class="bg-white rounded-2xl border border-stone-200 p-6 sm:p-8 shadow-2xs">
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#82977B]">Credentials</p>
                <h2 class="mt-2 font-serif text-2xl font-semibold text-[#29483C]">
                    Qualifications &amp; Training
                </h2>

                @if (!empty($instructor?->qualifications))
                    <ul class="mt-6 space-y-3.5 text-sm sm:text-base text-stone-700">
                        @foreach ((array) $instructor->qualifications as $cert)
                            <li class="flex items-start gap-3">
                                <span class="mt-2 w-2 h-2 rounded-full bg-[#C5A66D] shrink-0"></span>
                                <span>{{ is_array($cert) ? ($cert['title'] ?? implode(' — ', $cert)) : $cert }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <ul class="mt-6 space-y-3.5 text-sm sm:text-base text-stone-700">
                        <li class="flex items-start gap-3">
                            <span class="mt-2 w-2 h-2 rounded-full bg-[#C5A66D] shrink-0"></span>
                            <span>Classical Hatha Yoga &amp; Pranayama Teacher Training</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="mt-2 w-2 h-2 rounded-full bg-[#C5A66D] shrink-0"></span>
                            <span>Therapeutic Yoga &amp; Restorative Alignment Certification</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="mt-2 w-2 h-2 rounded-full bg-[#C5A66D] shrink-0"></span>
                            <span>Meditation &amp; Yogic Philosophy Studies</span>
                        </li>
                    </ul>
                @endif
            </div>

            {{-- Call to Action --}}
            <div class="rounded-2xl bg-[#82977B]/15 border border-[#82977B]/40 p-8 flex flex-col sm:flex-row sm:items-center justify-between gap-6">
                <div>
                    <h2 class="font-serif text-2xl font-semibold text-[#29483C]">Begin Your Practice</h2>
                    <p class="mt-1 text-sm text-stone-600">
                        Explore structured group batches or request a personalised wellness consultation.
                    </p>
                </div>
                <div class="flex flex-wrap gap-3 shrink-0">
                    <a href="{{ route('programmes.index') }}"
                       class="px-6 py-3 rounded-full bg-[#29483C] text-[#FAF8F2] text-sm font-medium hover:bg-[#1f372e] transition">
                        Explore Programmes
                    </a>
                    <a href="{{ route('contact') }}"
                       class="px-6 py-3 rounded-full border border-[#29483C] text-[#29483C] text-sm font-medium hover:bg-white/70 transition">
                        Enquire Now
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
