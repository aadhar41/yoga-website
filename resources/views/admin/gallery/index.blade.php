<x-admin-layout title="Gallery">
    <x-slot:breadcrumbs>
        <span>/</span>
        <span class="text-stone-800 font-medium">Gallery</span>
    </x-slot:breadcrumbs>

    <div class="flex items-center justify-between gap-4 mb-6">
        <h1 class="font-serif text-2xl text-[#29483C] font-semibold">Studio &amp; Practice Gallery</h1>
        <a href="{{ route('admin.gallery.create') }}"
           class="px-4 py-2 rounded-lg bg-[#29483C] text-white text-sm font-medium hover:bg-[#1f372e]">
            + Add Photo
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse ($items as $item)
            <div class="bg-white rounded-xl border border-stone-200 overflow-hidden flex flex-col justify-between">
                <img src="{{ Storage::url($item->image_path) }}" alt="{{ $item->title }}" class="w-full aspect-[4/3] object-cover">
                <div class="p-4 space-y-2 text-xs">
                    <div class="flex items-center justify-between gap-2">
                        <span class="font-semibold uppercase tracking-wider text-[#82977B]">{{ $item->category }}</span>
                        <span class="px-2 py-0.5 rounded-full {{ $item->is_published ? 'bg-emerald-100 text-emerald-800' : 'bg-stone-100 text-stone-600' }}">
                            {{ $item->is_published ? 'Published' : 'Hidden' }}
                        </span>
                    </div>
                    <p class="font-medium text-sm text-stone-900">{{ $item->title }}</p>
                    @if ($item->caption)
                        <p class="text-stone-500 line-clamp-2">{{ $item->caption }}</p>
                    @endif
                    <div class="pt-2 flex items-center justify-between border-t border-stone-100">
                        <a href="{{ route('admin.gallery.edit', $item) }}" class="text-[#29483C] hover:underline">Edit</a>
                        <form method="POST" action="{{ route('admin.gallery.destroy', $item) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-700 hover:underline">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="col-span-full text-sm text-stone-500 bg-white rounded-xl border border-stone-200 p-8 text-center">
                No gallery items uploaded yet.
            </p>
        @endforelse
    </div>

    <div class="mt-6">{{ $items->links() }}</div>
</x-admin-layout>