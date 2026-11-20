<x-admin-layout title="Create Programme">
    <x-slot:breadcrumbs>
        <span>/</span>
        <a href="{{ route('admin.programmes.index') }}" class="hover:text-[#29483C]">Programmes</a>
        <span>/</span>
        <span class="text-stone-800 font-medium">Create</span>
    </x-slot:breadcrumbs>

    <div class="max-w-3xl bg-white rounded-xl border border-stone-200 p-6 sm:p-8">
        <h1 class="font-serif text-2xl text-[#29483C] font-semibold mb-6">Create Programme</h1>

        <form method="POST" action="{{ route('admin.programmes.store') }}" class="space-y-5">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Title</label>
                    <input type="text" name="title" value="{{ old('title') }}" required class="w-full rounded-lg border-stone-300 text-sm">
                    @error('title') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Category</label>
                    <select name="programme_category_id" required class="w-full rounded-lg border-stone-300 text-sm">
                        <option value="">Select category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('programme_category_id') == $category->id)>
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
                    <input type="text" name="level" value="{{ old('level') }}" placeholder="All Levels" class="w-full rounded-lg border-stone-300 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Duration</label>
                    <input type="text" name="duration_text" value="{{ old('duration_text') }}" placeholder="60 mins / session" class="w-full rounded-lg border-stone-300 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="w-full rounded-lg border-stone-300 text-sm">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Short Description</label>
                <textarea name="short_description" rows="2" class="w-full rounded-lg border-stone-300 text-sm">{{ old('short_description') }}</textarea>
                @error('short_description') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Overview</label>
                <textarea name="overview" rows="5" class="w-full rounded-lg border-stone-300 text-sm">{{ old('overview') }}</textarea>
                @error('overview') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <label class="inline-flex items-center gap-2 text-sm">
                <input type="checkbox" name="is_published" value="1" @checked(old('is_published', true)) class="rounded border-stone-300 text-[#29483C]">
                <span>Publish programme</span>
            </label>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="px-5 py-2.5 rounded-lg bg-[#29483C] text-white text-sm font-medium">Save Programme</button>
                <a href="{{ route('admin.programmes.index') }}" class="text-sm text-stone-600 hover:underline">Cancel</a>
            </div>
        </form>
    </div>
</x-admin-layout>
