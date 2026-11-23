<x-public-layout :title="'Wellness Journal — ' . config('app.name')">
    <x-slot:meta>
        <meta name="description" content="Articles, reflections, and practice notes on Hatha yoga, pranayama, and mindful living.">
        <link rel="canonical" href="{{ route('blog.index') }}">
    </x-slot:meta>

    <section class="py-16 sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div class="max-w-2xl">
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#82977B]">Journal &amp; Reflections</p>
                <h1 class="mt-3 font-serif text-4xl sm:text-5xl font-semibold text-[#29483C]">Wellness Blog</h1>
            </div>

            @if ($categories->isNotEmpty())
                <div class="flex flex-wrap gap-2 text-xs font-medium">
                    <a href="{{ route('blog.index') }}"
                       class="px-4 py-2 rounded-full border {{ $categorySlug === '' ? 'bg-[#29483C] text-white border-[#29483C]' : 'bg-white text-stone-700 border-stone-200' }}">
                        All Articles
                    </a>
                    @foreach ($categories as $category)
                        <a href="{{ route('blog.index', ['category' => $category->slug]) }}"
                           class="px-4 py-2 rounded-full border {{ $categorySlug === $category->slug ? 'bg-[#29483C] text-white border-[#29483C]' : 'bg-white text-stone-700 border-stone-200' }}">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse ($posts as $post)
                    <article class="bg-white rounded-2xl border border-stone-200/80 overflow-hidden flex flex-col justify-between shadow-2xs">
                        <div>
                            @if ($post->cover_image_path)
                                <img src="{{ Storage::url($post->cover_image_path) }}" alt="{{ $post->title }}" class="w-full aspect-[16/10] object-cover">
                            @endif
                            <div class="p-6">
                                <p class="text-xs text-stone-500">
                                    {{ $post->category?->name ?? 'Wellness' }} &bull; {{ $post->published_at?->format('d M Y') ?? $post->created_at->format('d M Y') }}
                                </p>
                                <h2 class="mt-2 font-serif text-xl font-semibold text-[#29483C]">
                                    <a href="{{ route('blog.show', $post) }}" class="hover:underline">{{ $post->title }}</a>
                                </h2>
                                <p class="mt-3 text-sm text-stone-600 leading-relaxed line-clamp-3">
                                    {{ $post->excerpt ?: Str::limit(strip_tags($post->body), 140) }}
                                </p>
                            </div>
                        </div>
                        <div class="px-6 pb-6">
                            <a href="{{ route('blog.show', $post) }}" class="text-sm font-medium text-[#29483C] hover:underline">
                                Read article &rarr;
                            </a>
                        </div>
                    </article>
                @empty
                    <p class="col-span-full text-sm text-stone-500">No published wellness articles yet.</p>
                @endforelse
            </div>

            <div>{{ $posts->links() }}</div>
            <x-public.disclaimer />
        </div>
    </section>
</x-public-layout>