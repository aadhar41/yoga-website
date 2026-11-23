<x-admin-layout title="Edit Article">
    <x-slot:breadcrumbs>
        <span>/</span>
        <a href="{{ route('admin.blog.index') }}" class="hover:text-[#29483C]">Wellness Blog</a>
        <span>/</span>
        <span class="text-stone-800 font-medium">Edit</span>
    </x-slot:breadcrumbs>

    <div class="max-w-3xl bg-white rounded-xl border border-stone-200 p-6 sm:p-8">
        <h1 class="font-serif text-2xl text-[#29483C] font-semibold mb-6">Edit Wellness Article</h1>

        <form method="POST" action="{{ route('admin.blog.update', $post) }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Title</label>
                    <input type="text" name="title" value="{{ old('title', $post->title) }}" required class="w-full rounded-lg border-stone-300 text-sm">
                    @error('title') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Category (Optional)</label>
                    <select name="blog_category_id" class="w-full rounded-lg border-stone-300 text-sm">
                        <option value="">General Wellness</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('blog_category_id', $post->blog_category_id) == $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Excerpt (Optional Summary)</label>
                <textarea name="excerpt" rows="2" class="w-full rounded-lg border-stone-300 text-sm">{{ old('excerpt', $post->excerpt) }}</textarea>
                @error('excerpt') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Article Body</label>
                <textarea name="body" rows="8" required class="w-full rounded-lg border-stone-300 text-sm">{{ old('body', $post->body) }}</textarea>
                @error('body') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Cover Image (JPG, PNG, WebP — max 4MB)</label>
                @if ($post->cover_image_path)
                    <img src="{{ Storage::url($post->cover_image_path) }}" alt="{{ $post->title }}" class="w-36 h-24 object-cover rounded-lg mb-2 border border-stone-200">
                @endif
                <input type="file" name="cover_image" accept="image/jpeg,image/png,image/webp" class="text-sm">
                @error('cover_image') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <label class="inline-flex items-center gap-2 text-sm">
                <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $post->is_published)) class="rounded border-stone-300 text-[#29483C]">
                <span>Publish article publicly</span>
            </label>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="px-5 py-2.5 rounded-lg bg-[#29483C] text-white text-sm font-medium">Update Article</button>
                <a href="{{ route('admin.blog.index') }}" class="text-sm text-stone-600 hover:underline">Cancel</a>
            </div>
        </form>
    </div>
</x-admin-layout>