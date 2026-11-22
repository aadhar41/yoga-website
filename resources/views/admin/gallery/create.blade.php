<x-admin-layout title="Gallery Item">
    <x-slot:breadcrumbs>
        <span>/</span>
        <a href="{{ route('admin.gallery.index') }}" class="hover:text-[#29483C]">Gallery</a>
        <span>/</span>
        <span class="text-stone-800 font-medium">{{ isset($item) ? 'Edit' : 'Create' }}</span>
    </x-slot:breadcrumbs>

    <div class="max-w-2xl bg-white rounded-xl border border-stone-200 p-6 sm:p-8">
        <h1 class="font-serif text-2xl text-[#29483C] font-semibold mb-6">
            {{ isset($item) ? 'Edit Gallery Photo' : 'Upload Gallery Photo' }}
        </h1>

        <form method="POST"
              action="{{ isset($item) ? route('admin.gallery.update', $item) : route('admin.gallery.store') }}"
              enctype="multipart/form-data"
              class="space-y-5">
            @csrf
            @if (isset($item))
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Title</label>
                    <input type="text" name="title" value="{{ old('title', $item->title ?? '') }}" required class="w-full rounded-lg border-stone-300 text-sm">
                    @error('title') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Category</label>
                    <input type="text" name="category" value="{{ old('category', $item->category ?? 'Studio') }}" required class="w-full rounded-lg border-stone-300 text-sm">
                    @error('category') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Caption (Optional)</label>
                <input type="text" name="caption" value="{{ old('caption', $item->caption ?? '') }}" class="w-full rounded-lg border-stone-300 text-sm">
                @error('caption') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Image (JPG, PNG, WebP — max 4MB)</label>
                @if (isset($item) && $item->image_path)
                    <img src="{{ Storage::url($item->image_path) }}" alt="{{ $item->title }}" class="w-36 h-28 object-cover rounded-lg mb-2 border border-stone-200">
                @endif
                <input type="file" name="image" accept="image/jpeg,image/png,image/webp" {{ isset($item) ? '' : 'required' }} class="text-sm">
                @error('image') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-center">
                <div>
                    <label class="block text-sm font-medium mb-1">Sort Order</label>
                    <input type="number" name="sort_order" min="0" value="{{ old('sort_order', $item->sort_order ?? 0) }}" class="w-full rounded-lg border-stone-300 text-sm">
                </div>
                <label class="inline-flex items-center gap-2 text-sm pt-5">
                    <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $item->is_published ?? true)) class="rounded border-stone-300 text-[#29483C]">
                    <span>Publish on gallery page</span>
                </label>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="px-5 py-2.5 rounded-lg bg-[#29483C] text-white text-sm font-medium">
                    {{ isset($item) ? 'Update Photo' : 'Save Photo' }}
                </button>
                <a href="{{ route('admin.gallery.index') }}" class="text-sm text-stone-600 hover:underline">Cancel</a>
            </div>
        </form>
    </div>
</x-admin-layout>