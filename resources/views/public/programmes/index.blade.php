<x-public-layout :title="'Programmes & Offerings — ' . config('app.name')">
    <x-slot:meta>
        <meta name="description" content="Explore our structured Hatha, Vinyasa, Pranayama, and restorative wellness programmes designed for all levels of practice.">
        <link rel="canonical" href="{{ route('programmes.index') }}">
    </x-slot:meta>

    <section class="py-16 sm:py-24 border-b border-stone-200/70">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#82977B]">Pathways to Well-being</p>
            <h1 class="mt-3 font-serif text-4xl sm:text-5xl font-semibold text-[#29483C]">
                Programmes &amp; Offerings
            </h1>
            <p class="mt-4 text-base sm:text-lg text-stone-600 leading-relaxed max-w-2xl">
                Classical yoga tracks, breathwork modules, and therapeutic stillness practices structured for steady progress, joint mobility, and inner calm.
            </p>
        </div>
    </section>

    <section class="py-16 sm:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
            @forelse ($categories as $category)
                <div class="space-y-6">
                    <div class="border-b border-stone-200/80 pb-4">
                        <h2 class="font-serif text-2xl sm:text-3xl font-semibold text-[#29483C]">
                            {{ $category->name }}
                        </h2>
                        @if ($category->description)
                            <p class="mt-1 text-sm sm:text-base text-stone-600">
                                {{ $category->description }}
                            </p>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($category->programmes as $programme)
                            <article class="bg-white rounded-2xl border border-stone-200/80 p-6 flex flex-col justify-between shadow-2xs hover:border-[#82977B] transition">
                                <div>
                                    <div class="flex items-center justify-between text-xs text-stone-500 mb-2">
                                        <span class="font-medium text-[#82977B] uppercase tracking-wider">
                                            {{ $programme->level ?? 'All Levels' }}
                                        </span>
                                        @if ($programme->duration_text)
                                            <span>{{ $programme->duration_text }}</span>
                                        @endif
                                    </div>
                                    <h3 class="font-serif text-xl font-semibold text-[#29483C]">
                                        <a href="{{ route('programmes.show', $programme) }}" class="hover:underline">
                                            {{ $programme->title }}
                                        </a>
                                    </h3>
                                    <p class="mt-3 text-sm text-stone-600 leading-relaxed line-clamp-3">
                                        {{ $programme->short_description ?? $programme->overview }}
                                    </p>
                                </div>

                                <div class="mt-6 pt-4 border-t border-stone-100 flex items-center justify-between">
                                    <span class="text-xs text-stone-500">
                                        {{ $programme->format?->value ?? 'Group & Private' }}
                                    </span>
                                    <a href="{{ route('programmes.show', $programme) }}"
                                       class="text-sm font-medium text-[#29483C] hover:underline">
                                        View Details &rarr;
                                    </a>
                                </div>
                            </article>
                        @empty
                            <div class="col-span-full py-8 text-sm text-stone-500 bg-white rounded-xl border border-dashed border-stone-200 p-6 text-center">
                                No published programmes currently available under this category. Check back soon or <a href="{{ route('contact') }}" class="text-[#29483C] underline">enquire for custom batches</a>.
                            </div>
                        @endforelse
                    </div>
                </div>
            @empty
                <div class="py-12 text-center text-stone-500">
                    No active programme categories found.
                </div>
            @endforelse

            <div class="pt-8">
                <x-public.disclaimer />
            </div>
        </div>
    </section>
</x-public-layout>
