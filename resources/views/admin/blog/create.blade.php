<x-admin-layout title="Create Article">
    <x-slot:breadcrumbs>
        <span>/</span>
        <a href="{{ route('admin.blog.index') }}" class="hover:text-[#29483C]">Wellness Blog</a>
        <span>/</span>
        <span class="text-stone-800 font-medium">Create</span>
    </x-slot:breadcrumbs>

    <div class="max-w-3xl bg-white rounded-xl border border-stone-200 p-6 sm:p-8">
        <h1 class="font-serif text-2xl text-[#29483C] font-semibold mb-6">Write Wellness Article</h1>

        <form method="POST" action="{{ route('admin.blog.store') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Title</label>
                    <input type="text" name="title" value="{{ old('title') }}" required class="w-full rounded-lg border-stone-300 text-sm">
                    @error('title') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Category (Optional)</label>
                    <select name="blog_category_id" class="w-full rounded-lg border-stone-300 text-sm">
                        <option value="">General Wellness</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('blog_category_id') == $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Excerpt (Optional Summary)</label>
                <textarea name="excerpt" rows="2" class="w-full rounded-lg border-stone-300 text-sm">{{ old('excerpt') }}</textarea>
                @error('excerpt') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Article Body</label>
                <textarea name="body" rows="8" required class="w-full rounded-lg border-stone-300 text-sm">{{ old('body') }}</textarea>
                @error('body') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Cover Image (JPG, PNG, WebP — max 4MB)</label>
                <input type="file" name="cover_image" accept="image/jpeg,image/png,image/webp" class="text-sm">
                @error('cover_image') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <label class="inline-flex items-center gap-2 text-sm">
                <input type="checkbox" name="is_published" value="1" @checked(old('is_published', false)) class="rounded border-stone-300 text-[#29483C]">
                <span>Publish article publicly</span>
            </label>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="px-5 py-2.5 rounded-lg bg-[#29483C] text-white text-sm font-medium">Save Article</button>
                <a href="{{ route('admin.blog.index') }}" class="text-sm text-stone-600 hover:underline">Cancel</a>
            </div>
        </form>
    </div>
</x-admin-layout>