<x-public-layout :title="$programme->title . ' — ' . config('app.name')">
    <x-slot:meta>
        <meta name="description" content="{{ $programme->short_description ?? Str::limit(strip_tags((string) $programme->overview), 155) }}">
        <link rel="canonical" href="{{ route('programmes.show', $programme) }}">
    </x-slot:meta>

    <section class="py-16 sm:py-24">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            <div>
                <a href="{{ route('programmes.index') }}" class="text-xs font-medium text-[#82977B] hover:underline">
                    &larr; All Programmes
                </a>
                <h1 class="mt-3 font-serif text-4xl font-semibold text-[#29483C]">
                    {{ $programme->title }}
                </h1>
                @if ($programme->short_description)
                    <p class="mt-4 text-base sm:text-lg text-stone-600 leading-relaxed">
                        {{ $programme->short_description }}
                    </p>
                @endif
            </div>

            @if ($programme->overview)
                <div class="text-stone-700 leading-relaxed space-y-4">
                    {!! nl2br(e($programme->overview)) !!}
                </div>
            @endif

            <x-public.disclaimer />
        </div>
    </section>
</x-public-layout>
