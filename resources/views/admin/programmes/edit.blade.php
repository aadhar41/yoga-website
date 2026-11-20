<x-admin-layout title="Edit Programme">
    <x-slot:breadcrumbs>
        <span>/</span>
        <a href="{{ route('admin.programmes.index') }}" class="hover:text-[#29483C]">Programmes</a>
        <span>/</span>
        <span class="text-stone-800 font-medium">Edit</span>
    </x-slot:breadcrumbs>

    <div class="max-w-3xl bg-white rounded-xl border border-stone-200 p-6 sm:p-8">
        <h1 class="font-serif text-2xl text-[#29483C] font-semibold mb-6">Edit Programme</h1>

        <form method="POST" action="{{ route('admin.programmes.update', $programme) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Title</label>
                    <input type="text" name="title" value="{{ old('title', $programme->title) }}" required class="w-full rounded-lg border-stone-300 text-sm">
                    @error('title') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Category</label>
                    <select name="programme_category_id" required class="w-full rounded-lg border-stone-300 text-sm">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('programme_category_id', $programme->programme_category_id) == $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('programme_category_id') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Level</label>
                    <input type="text" name="level" value="{{ old('level', $programme->level) }}" class="w-full rounded-lg border-stone-300 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Duration</label>
                    <input type="text" name="duration_text" value="{{ old('duration_text', $programme->duration_text) }}" class="w-full rounded-lg border-stone-300 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $programme->sort_order) }}" class="w-full rounded-lg border-stone-300 text-sm">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Short Description</label>
                <textarea name="short_description" rows="2" class="w-full rounded-lg border-stone-300 text-sm">{{ old('short_description', $programme->short_description) }}</textarea>
                @error('short_description') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Overview</label>
                <textarea name="overview" rows="5" class="w-full rounded-lg border-stone-300 text-sm">{{ old('overview', $programme->overview) }}</textarea>
                @error('overview') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <label class="inline-flex items-center gap-2 text-sm">
                <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $programme->is_published)) class="rounded border-stone-300 text-[#29483C]">
                <span>Publish programme</span>
            </label>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="px-5 py-2.5 rounded-lg bg-[#29483C] text-white text-sm font-medium">Update Programme</button>
                <a href="{{ route('admin.programmes.index') }}" class="text-sm text-stone-600 hover:underline">Cancel</a>
            </div>
        </form>
    </div>
</x-admin-layout>
