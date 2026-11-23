<x-admin-layout title="Wellness Blog">
    <x-slot:breadcrumbs>
        <span>/</span>
        <span class="text-stone-800 font-medium">Wellness Blog</span>
    </x-slot:breadcrumbs>

    <div class="flex items-center justify-between gap-4 mb-6">
        <h1 class="font-serif text-2xl text-[#29483C] font-semibold">Wellness Blog Posts</h1>
        <a href="{{ route('admin.blog.create') }}"
           class="px-4 py-2 rounded-lg bg-[#29483C] text-white text-sm font-medium hover:bg-[#1f372e]">
            + New Article
        </a>
    </div>

    <div class="bg-white rounded-xl border border-stone-200 overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="bg-stone-50 border-b border-stone-200 text-stone-600">
                <tr>
                    <th class="px-4 py-3">Title</th>
                    <th class="px-4 py-3">Category</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Published</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-stone-200">
                @forelse ($posts as $post)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="font-medium text-stone-900">{{ $post->title }}</div>
                            <div class="text-xs text-stone-500">/blog/{{ $post->slug }}</div>
                        </td>
                        <td class="px-4 py-3 text-stone-600">{{ $post->category?->name ?? 'General' }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-0.5 rounded-full text-xs {{ $post->is_published ? 'bg-emerald-100 text-emerald-800' : 'bg-stone-100 text-stone-700' }}">
                                {{ $post->is_published ? 'Published' : 'Draft' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-xs text-stone-500">
                            {{ $post->published_at?->format('d M Y') ?? '—' }}
                        </td>
                        <td class="px-4 py-3 text-right space-x-3">
                            <a href="{{ route('admin.blog.edit', $post) }}" class="text-[#29483C] hover:underline">Edit</a>
                            <form method="POST" action="{{ route('admin.blog.destroy', $post) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-700 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-stone-500">No articles written yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $posts->links() }}</div>
</x-admin-layout>