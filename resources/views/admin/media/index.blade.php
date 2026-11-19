<x-admin-layout title="Media Library">
    <x-slot:breadcrumbs>
        <span>/</span>
        <span class="text-stone-800 font-medium">Media Library</span>
    </x-slot:breadcrumbs>

    <div class="space-y-6">
        <div class="bg-white rounded-xl border border-stone-200 p-6">
            <h1 class="font-serif text-2xl text-[#29483C] font-semibold mb-4">Upload Image</h1>
            <form method="POST" action="{{ route('admin.media.store') }}" enctype="multipart/form-data" class="flex flex-col sm:flex-row sm:items-end gap-4">
                @csrf
                <div>
                    <label class="block text-xs font-medium text-stone-600 mb-1">Folder</label>
                    <select name="folder" class="rounded-lg border-stone-300 text-sm">
                        <option value="media">General Media</option>
                        <option value="programmes">Programmes</option>
                        <option value="gallery">Gallery</option>
                    </select>
                </div>
                <div class="flex-1">
                    <label class="block text-xs font-medium text-stone-600 mb-1">Image File (max 4MB)</label>
                    <input type="file" name="file" accept="image/jpeg,image/png,image/webp" required class="text-sm">
                    @error('file') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <button type="submit" class="px-5 py-2.5 rounded-lg bg-[#29483C] text-white text-sm font-medium">Upload</button>
            </form>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse ($files as $file)
                <div class="bg-white rounded-xl border border-stone-200 overflow-hidden flex flex-col justify-between">
                    <img src="{{ $file['url'] }}" alt="{{ $file['path'] }}" class="w-full aspect-[4/3] object-cover">
                    <div class="p-4 space-y-2 text-xs">
                        <p class="font-medium text-stone-800 truncate" title="{{ $file['path'] }}">{{ $file['path'] }}</p>
                        <p class="text-stone-500">{{ $file['size_kb'] }} KB &bull; {{ $file['last_modified'] }}</p>
                        <div class="pt-2 flex items-center justify-between border-t border-stone-100">
                            <button type="button" onclick="navigator.clipboard.writeText('{{ $file['url'] }}')" class="text-[#29483C] hover:underline">
                                Copy URL
                            </button>
                            <form method="POST" action="{{ route('admin.media.destroy', $file['path']) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-700 hover:underline">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-sm text-stone-500 bg-white rounded-xl border border-stone-200 p-8 text-center">
                    No uploaded images in storage yet.
                </p>
            @endforelse
        </div>
    </div>
</x-admin-layout>
