<x-public-layout :title="'Gallery — ' . config('app.name')">
    <x-slot:meta>
        <meta name="description" content="Visual moments from our yoga sessions, breathwork practice, and peaceful studio atmosphere.">
        <link rel="canonical" href="{{ route('gallery') }}">
    </x-slot:meta>

    <section class="py-16 sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div class="max-w-2xl">
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#82977B]">Visual Sanctuary</p>
                <h1 class="mt-3 font-serif text-4xl sm:text-5xl font-semibold text-[#29483C]">Gallery</h1>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($items as $item)
                    <figure class="bg-white rounded-2xl border border-stone-200/80 overflow-hidden shadow-2xs">
                        <img src="{{ Storage::url($item->image_path) }}" alt="{{ $item->title }}" class="w-full aspect-[4/3] object-cover">
                        <figcaption class="p-4">
                            <span class="text-xs font-semibold uppercase tracking-wider text-[#82977B]">{{ $item->category }}</span>
                            <h2 class="mt-1 font-serif text-lg font-semibold text-[#29483C]">{{ $item->title }}</h2>
                            @if ($item->caption)
                                <p class="mt-1 text-xs text-stone-600">{{ $item->caption }}</p>
                            @endif
                        </figcaption>
                    </figure>
                @empty
                    <p class="col-span-full text-sm text-stone-500">Gallery photographs will appear here once published.</p>
                @endforelse
            </div>
        </div>
    </section>
</x-public-layout>