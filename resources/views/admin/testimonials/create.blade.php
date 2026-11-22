<x-admin-layout title="Testimonial Form">
    <x-slot:breadcrumbs>
        <span>/</span>
        <a href="{{ route('admin.testimonials.index') }}" class="hover:text-[#29483C]">Testimonials</a>
        <span>/</span>
        <span class="text-stone-800 font-medium">{{ isset($testimonial) ? 'Edit' : 'Create' }}</span>
    </x-slot:breadcrumbs>

    <div class="max-w-2xl bg-white rounded-xl border border-stone-200 p-6 sm:p-8">
        <h1 class="font-serif text-2xl text-[#29483C] font-semibold mb-6">
            {{ isset($testimonial) ? 'Edit Testimonial' : 'Add Testimonial' }}
        </h1>

        <form method="POST"
              action="{{ isset($testimonial) ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}"
              class="space-y-5">
            @csrf
            @if (isset($testimonial))
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Author Name</label>
                    <input type="text" name="author_name" value="{{ old('author_name', $testimonial->author_name ?? '') }}" required class="w-full rounded-lg border-stone-300 text-sm">
                    @error('author_name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Role / Batch (Optional)</label>
                    <input type="text" name="author_role" value="{{ old('author_role', $testimonial->author_role ?? '') }}" class="w-full rounded-lg border-stone-300 text-sm">
                    @error('author_role') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Reflection / Testimonial</label>
                <textarea name="content" rows="4" required class="w-full rounded-lg border-stone-300 text-sm">{{ old('content', $testimonial->content ?? '') }}</textarea>
                @error('content') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Rating (1–5, Optional)</label>
                    <input type="number" name="rating" min="1" max="5" value="{{ old('rating', $testimonial->rating ?? 5) }}" class="w-full rounded-lg border-stone-300 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Sort Order</label>
                    <input type="number" name="sort_order" min="0" value="{{ old('sort_order', $testimonial->sort_order ?? 0) }}" class="w-full rounded-lg border-stone-300 text-sm">
                </div>
            </div>

            <div class="flex flex-wrap gap-6 text-sm">
                <label class="inline-flex items-center gap-2">
                    <input type="checkbox" name="is_approved" value="1" @checked(old('is_approved', $testimonial->is_approved ?? false)) class="rounded border-stone-300 text-[#29483C]">
                    <span>Approve &amp; show publicly</span>
                </label>
                <label class="inline-flex items-center gap-2">
                    <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $testimonial->is_featured ?? false)) class="rounded border-stone-300 text-[#29483C]">
                    <span>Feature on homepage</span>
                </label>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="px-5 py-2.5 rounded-lg bg-[#29483C] text-white text-sm font-medium">
                    {{ isset($testimonial) ? 'Update Testimonial' : 'Save Testimonial' }}
                </button>
                <a href="{{ route('admin.testimonials.index') }}" class="text-sm text-stone-600 hover:underline">Cancel</a>
            </div>
        </form>
    </div>
</x-admin-layout>