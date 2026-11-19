<x-admin-layout title="Instructor Profile">
    <x-slot:breadcrumbs>
        <span>/</span>
        <span class="text-stone-800 font-medium">Instructor Profile</span>
    </x-slot:breadcrumbs>

    <div class="max-w-3xl bg-white rounded-xl border border-stone-200 p-6 sm:p-8">
        <h1 class="font-serif text-2xl text-[#29483C] font-semibold mb-6">Instructor Profile &amp; Credentials</h1>

        <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Honorific / Title</label>
                    <input type="text" name="title" value="{{ old('title', $profile->title) }}" class="w-full rounded-lg border-stone-300 text-sm">
                    @error('title') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Years of Experience</label>
                    <input type="number" name="years_of_experience" value="{{ old('years_of_experience', $profile->years_of_experience) }}" class="w-full rounded-lg border-stone-300 text-sm">
                    @error('years_of_experience') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Tagline</label>
                <input type="text" name="tagline" value="{{ old('tagline', $profile->tagline) }}" class="w-full rounded-lg border-stone-300 text-sm">
                @error('tagline') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Short Bio (Hero &amp; Summary)</label>
                <textarea name="short_bio" rows="3" required class="w-full rounded-lg border-stone-300 text-sm">{{ old('short_bio', $profile->short_bio) }}</textarea>
                @error('short_bio') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Full Biography</label>
                <textarea name="full_bio" rows="6" class="w-full rounded-lg border-stone-300 text-sm">{{ old('full_bio', $profile->full_bio) }}</textarea>
                @error('full_bio') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Qualifications (One per line)</label>
                <textarea name="qualifications" rows="4" class="w-full rounded-lg border-stone-300 text-sm">{{ old('qualifications', implode("\n", (array) $profile->qualifications)) }}</textarea>
                @error('qualifications') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Portrait Photo (JPG, PNG, WebP — max 2MB)</label>
                @if ($profile->headshot_path)
                    <img src="{{ Storage::url($profile->headshot_path) }}" alt="Current headshot" class="w-28 h-28 object-cover rounded-lg mb-2 border border-stone-200">
                @endif
                <input type="file" name="headshot" accept="image/jpeg,image/png,image/webp" class="text-sm">
                @error('headshot') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <label class="inline-flex items-center gap-2 text-sm">
                <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $profile->is_published)) class="rounded border-stone-300 text-[#29483C]">
                <span>Publish profile on public website</span>
            </label>

            <div class="pt-2">
                <button type="submit" class="px-5 py-2.5 rounded-lg bg-[#29483C] text-white text-sm font-medium hover:bg-[#1f372e]">
                    Save Profile
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
