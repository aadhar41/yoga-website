<x-admin-layout title="Classes & Venues">
    <x-slot:breadcrumbs>
        <span>/</span>
        <span class="text-stone-800 font-medium">Classes &amp; Venues</span>
    </x-slot:breadcrumbs>

    <div class="flex items-center justify-between gap-4 mb-6">
        <h1 class="font-serif text-2xl text-[#29483C] font-semibold">Classes, Schedules &amp; Venues</h1>
        <a href="{{ route('admin.schedules.create') }}"
           class="px-4 py-2 rounded-lg bg-[#29483C] text-white text-sm font-medium hover:bg-[#1f372e]">
            + New Schedule
        </a>
    </div>

    <div class="bg-white rounded-xl border border-stone-200 overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="bg-stone-50 border-b border-stone-200 text-stone-600">
                <tr>
                    <th class="px-4 py-3">Class / Batch</th>
                    <th class="px-4 py-3">Days &amp; Timing</th>
                    <th class="px-4 py-3">Mode</th>
                    <th class="px-4 py-3">Venue</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-stone-200">
                @forelse ($schedules as $schedule)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="font-medium text-stone-900">{{ $schedule->title }}</div>
                            <div class="text-xs text-stone-500">{{ $schedule->programme?->title ?? 'Open Batch' }}</div>
                        </td>
                        <td class="px-4 py-3 text-stone-700">
                            <div>{{ $schedule->days_of_week }}</div>
                            <div class="text-xs text-stone-500">
                                {{ $schedule->start_time }}{{ $schedule->end_time ? ' – ' . $schedule->end_time : '' }}
                            </div>
                        </td>
                        <td class="px-4 py-3 capitalize text-stone-600">{{ $schedule->mode }}</td>
                        <td class="px-4 py-3 text-stone-700">
                            <div>{{ $schedule->venue_name ?? ($schedule->mode === 'online' ? 'Online Session' : '—') }}</div>
                            @if ($schedule->venue_address)
                                <div class="text-xs text-stone-500">{{ $schedule->venue_address }}</div>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-0.5 rounded-full text-xs {{ $schedule->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-stone-100 text-stone-700' }}">
                                {{ $schedule->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-right space-x-3">
                            <a href="{{ route('admin.schedules.edit', $schedule) }}" class="text-[#29483C] hover:underline">Edit</a>
                            <form method="POST" action="{{ route('admin.schedules.destroy', $schedule) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-700 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-stone-500">No class schedules configured yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $schedules->links() }}</div>
</x-admin-layout>