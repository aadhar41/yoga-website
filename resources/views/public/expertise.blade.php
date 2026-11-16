<x-public-layout :title="'Specialised Wellness — ' . config('app.name')">
    <x-slot:meta>
        <meta name="description" content="Specialised therapeutic yoga, pranayama, and holistic wellness programmes tailored for restorative balance.">
        <link rel="canonical" href="{{ route('expertise') }}">
    </x-slot:meta>

    <section class="py-16 sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div class="max-w-3xl">
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#82977B]">
                    Therapeutic &amp; Holistic Focus
                </p>
                <h1 class="mt-3 font-serif text-4xl sm:text-5xl font-semibold text-[#29483C]">
                    Specialised Wellness
                </h1>
                <p class="mt-4 text-base sm:text-lg text-stone-600 leading-relaxed">
                    Focused programmes combining gentle posture adaptation, breath regulation, and guided relaxation for stress recovery, mobility, and sustainable vitality.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($categories as $category)
                    <div class="bg-white rounded-2xl border border-stone-200/80 p-6 shadow-2xs">
                        <h2 class="font-serif text-xl font-semibold text-[#29483C]">{{ $category->name }}</h2>
                        <p class="mt-2 text-sm text-stone-600 leading-relaxed">
                            {{ $category->description ?? 'Tailored sessions designed around safe alignment and steady breath.' }}
                        </p>
                    </div>
                @empty
                    <p class="col-span-3 text-sm text-stone-500">
                        Specialised wellness tracks are being updated. <a href="{{ route('contact') }}" class="text-[#29483C] underline">Enquire for one-on-one guidance.</a>
                    </p>
                @endforelse
            </div>

            <x-public.disclaimer />
        </div>
    </section>
</x-public-layout>
