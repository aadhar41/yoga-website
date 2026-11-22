<x-public-layout :title="'Testimonials — ' . config('app.name')">
    <x-slot:meta>
        <meta name="description" content="Reflections and experiences shared by yoga and wellness practitioners.">
        <link rel="canonical" href="{{ route('testimonials') }}">
    </x-slot:meta>

    <section class="py-16 sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div class="max-w-2xl">
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#82977B]">Student Reflections</p>
                <h1 class="mt-3 font-serif text-4xl sm:text-5xl font-semibold text-[#29483C]">Testimonials</h1>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse ($testimonials as $testimonial)
                    <blockquote class="bg-white rounded-2xl border border-stone-200/80 p-6 flex flex-col justify-between shadow-2xs">
                        <p class="text-sm text-stone-700 leading-relaxed">“{{ $testimonial->content }}”</p>
                        <footer class="mt-4 pt-4 border-t border-stone-100 text-xs font-semibold text-[#29483C]">
                            {{ $testimonial->author_name }}
                            @if ($testimonial->author_role)
                                <span class="block font-normal text-stone-500">{{ $testimonial->author_role }}</span>
                            @endif
                        </footer>
                    </blockquote>
                @empty
                    <p class="col-span-full text-sm text-stone-500">Approved testimonials will be displayed here.</p>
                @endforelse
            </div>
        </div>
    </section>
</x-public-layout>