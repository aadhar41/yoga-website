<x-admin-layout title="Testimonials">
    <x-slot:breadcrumbs>
        <span>/</span>
        <span class="text-stone-800 font-medium">Testimonials</span>
    </x-slot:breadcrumbs>

    <div class="flex items-center justify-between gap-4 mb-6">
        <h1 class="font-serif text-2xl text-[#29483C] font-semibold">Testimonials</h1>
        <a href="{{ route('admin.testimonials.create') }}"
           class="px-4 py-2 rounded-lg bg-[#29483C] text-white text-sm font-medium hover:bg-[#1f372e]">
            + New Testimonial
        </a>
    </div>

    <div class="bg-white rounded-xl border border-stone-200 overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="bg-stone-50 border-b border-stone-200 text-stone-600">
                <tr>
                    <th class="px-4 py-3">Author</th>
                    <th class="px-4 py-3">Reflection</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Order</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-stone-200">
                @forelse ($testimonials as $testimonial)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="font-medium text-stone-900">{{ $testimonial->author_name }}</div>
                            @if ($testimonial->author_role)
                                <div class="text-xs text-stone-500">{{ $testimonial->author_role }}</div>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-stone-700 max-w-md">
                            <p class="line-clamp-2">{{ $testimonial->content }}</p>
                        </td>
                        <td class="px-4 py-3 space-x-1">
                            <span class="px-2 py-0.5 rounded-full text-xs {{ $testimonial->is_approved ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                {{ $testimonial->is_approved ? 'Approved' : 'Pending' }}
                            </span>
                            @if ($testimonial->is_featured)
                                <span class="px-2 py-0.5 rounded-full text-xs bg-[#C5A66D]/25 text-[#29483C]">Featured</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-stone-600">{{ $testimonial->sort_order }}</td>
                        <td class="px-4 py-3 text-right space-x-3">
                            <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="text-[#29483C] hover:underline">Edit</a>
                            <form method="POST" action="{{ route('admin.testimonials.destroy', $testimonial) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-700 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-stone-500">No testimonials found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $testimonials->links() }}</div>
</x-admin-layout>