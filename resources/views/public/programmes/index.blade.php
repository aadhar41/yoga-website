<x-public-layout :title="'Programmes — ' . config('app.name')">
    <x-slot:meta>
        <meta name="description" content="Explore Hatha, Vinyasa, Pranayama, and restorative yoga programmes.">
        <link rel="canonical" href="{{ route('programmes.index') }}">
    </x-slot:meta>

    <section class="py-16 sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            <div class="max-w-2xl">
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#82977B]">All Offerings</p>
                <h1 class="mt-3 font-serif text-4xl sm:text-5xl font-semibold text-[#29483C]">
                    Yoga &amp; Wellness Programmes
                </h1>
            </div>

            <x-public.disclaimer />
        </div>
    </section>
</x-public-layout>
