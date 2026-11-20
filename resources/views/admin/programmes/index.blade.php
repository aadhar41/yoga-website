<x-admin-layout title="Programmes">
    <x-slot:breadcrumbs>
        <span>/</span>
        <span class="text-stone-800 font-medium">Programmes</span>
    </x-slot:breadcrumbs>

    <div class="flex items-center justify-between gap-4 mb-6">
        <h1 class="font-serif text-2xl text-[#29483C] font-semibold">Programmes</h1>
        <a href="{{ route('admin.programmes.create') }}"
           class="px-4 py-2 rounded-lg bg-[#29483C] text-white text-sm font-medium hover:bg-[#1f372e]">
            + New Programme
        </a>
    </div>

    <div class="bg-white rounded-xl border border-stone-200 overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="bg-stone-50 border-b border-stone-200 text-stone-600">
                <tr>
                    <th class="px-4 py-3">Title</th>
                    <th class="px-4 py-3">Category</th>
                    <th class="px-4 py-3">Level</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Order</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-stone-200">
                @forelse ($programmes as $programme)
                    <tr>
                        <td class="px-4 py-3 font-medium text-stone-900">{{ $programme->title }}</td>
                        <td class="px-4 py-3 text-stone-600">{{ $programme->category?->name ?? '—' }}</td>
                        <td class="px-4 py-3 text-stone-600">{{ $programme->level ?? 'All Levels' }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-0.5 rounded-full text-xs {{ $programme->is_published ? 'bg-emerald-100 text-emerald-800' : 'bg-stone-100 text-stone-700' }}">
                                {{ $programme->is_published ? 'Published' : 'Draft' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-stone-600">{{ $programme->sort_order }}</td>
                        <td class="px-4 py-3 text-right space-x-3">
                            <a href="{{ route('admin.programmes.edit', $programme) }}" class="text-[#29483C] hover:underline">Edit</a>
                            <form method="POST" action="{{ route('admin.programmes.destroy', $programme) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-700 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-stone-500">No programmes found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $programmes->links() }}</div>
</x-admin-layout>
