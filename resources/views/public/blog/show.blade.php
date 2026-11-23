<x-public-layout :title="$post->title . ' — ' . config('app.name')">
    <x-slot:meta>
        <meta name="description" content="{{ $post->excerpt ?: Str::limit(strip_tags($post->body), 155) }}">
        <link rel="canonical" href="{{ route('blog.show', $post) }}">
    </x-slot:meta>

    <article class="py-16 sm:py-24">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <div>
                <a href="{{ route('blog.index') }}" class="text-xs font-medium text-[#82977B] hover:underline">
                    &larr; Back to Wellness Blog
                </a>
                <p class="mt-4 text-xs text-stone-500">
                    {{ $post->category?->name ?? 'Wellness' }} &bull; {{ $post->published_at?->format('d M Y') ?? $post->created_at->format('d M Y') }}
                </p>
                <h1 class="mt-2 font-serif text-3xl sm:text-5xl font-semibold text-[#29483C] leading-tight">
                    {{ $post->title }}
                </h1>
            </div>

            @if ($post->cover_image_path)
                <img src="{{ Storage::url($post->cover_image_path) }}" alt="{{ $post->title }}" class="w-full rounded-2xl object-cover max-h-[420px]">
            @endif

            <div class="text-stone-700 leading-relaxed space-y-4 text-base">
                {!! nl2br(e($post->body)) !!}
            </div>

            <div class="pt-6">
                <x-public.disclaimer />
            </div>
        </div>
    </article>
</x-public-layout>