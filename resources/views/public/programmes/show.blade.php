<x-public-layout :title="$programme->title . ' — ' . config('app.name')">
    <x-slot:meta>
        <meta name="description" content="{{ $programme->short_description ?? Str::limit(strip_tags((string) $programme->overview), 155) }}">
        <link rel="canonical" href="{{ route('programmes.show', $programme) }}">
    </x-slot:meta>

    <section class="py-16 sm:py-24 border-b border-stone-200/70">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="flex items-center gap-3 text-xs font-semibold uppercase tracking-wider text-[#82977B]">
                <a href="{{ route('programmes.index') }}" class="hover:underline">&larr; All Programmes</a>
                @if ($programme->category)
                    <span>&bull;</span>
                    <span>{{ $programme->category->name }}</span>
                @endif
            </div>

            <h1 class="font-serif text-4xl sm:text-5xl font-semibold text-[#29483C] leading-tight">
                {{ $programme->title }}
            </h1>

            @if ($programme->short_description)
                <p class="text-lg text-stone-600 leading-relaxed">
                    {{ $programme->short_description }}
                </p>
            @endif

            <div class="flex flex-wrap items-center gap-6 pt-4 text-sm text-stone-700">
                @if ($programme->level)
                    <div class="bg-white rounded-lg border border-stone-200 px-4 py-2">
                        <span class="block text-xs uppercase tracking-wider text-stone-500">Level</span>
                        <span class="font-medium text-[#29483C]">{{ $programme->level }}</span>
                    </div>
                @endif
                @if ($programme->duration_text)
                    <div class="bg-white rounded-lg border border-stone-200 px-4 py-2">
                        <span class="block text-xs uppercase tracking-wider text-stone-500">Duration</span>
                        <span class="font-medium text-[#29483C]">{{ $programme->duration_text }}</span>
                    </div>
                @endif
                @if ($programme->format)
                    <div class="bg-white rounded-lg border border-stone-200 px-4 py-2">
                        <span class="block text-xs uppercase tracking-wider text-stone-500">Format</span>
                        <span class="font-medium text-[#29483C]">{{ $programme->format?->value }}</span>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="py-16 sm:py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            @if ($programme->overview)
                <div class="prose prose-stone max-w-none text-stone-700 leading-relaxed space-y-4">
                    <h2 class="font-serif text-2xl font-semibold text-[#29483C]">Programme Overview</h2>
                    {!! nl2br(e($programme->overview)) !!}
                </div>
            @endif

            <div class="rounded-3xl bg-[#82977B]/15 border border-[#82977B]/40 p-8 sm:p-10 flex flex-col sm:flex-row items-center justify-between gap-6">
                <div>
                    <h2 class="font-serif text-2xl font-semibold text-[#29483C]">Interested in joining this track?</h2>
                    <p class="mt-1 text-sm text-stone-600">Contact us to check upcoming batch availability or private scheduling.</p>
                </div>
                <a href="{{ route('contact') }}"
                   class="px-7 py-3.5 rounded-full bg-[#29483C] text-[#FAF8F2] text-sm font-medium hover:bg-[#1f372e] transition shrink-0">
                    Enquire Now
                </a>
            </div>

            <x-public.disclaimer />
        </div>
    </section>
</x-public-layout>
