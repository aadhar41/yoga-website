<x-admin-layout title="Enquiry Inbox">
    <x-slot:breadcrumbs>
        <span>/</span>
        <span class="text-stone-800 font-medium">Enquiry Inbox</span>
    </x-slot:breadcrumbs>

    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="font-serif text-2xl text-[#29483C] font-semibold">Enquiry Inbox</h1>
                <p class="text-sm text-stone-600">Review incoming session enquiries, filter by workflow stage, and update status.</p>
            </div>
        </div>

        {{-- Status Filter Tabs & Search --}}
        <div class="bg-white rounded-xl border border-stone-200 p-4 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div class="flex flex-wrap gap-2 text-xs font-medium">
                @php
                    $tabs = [
                        '' => 'All (' . $counts['all'] . ')',
                        'new' => 'New (' . $counts['new'] . ')',
                        'contacted' => 'Contacted (' . $counts['contacted'] . ')',
                        'resolved' => 'Resolved (' . $counts['resolved'] . ')',
                        'archived' => 'Archived (' . $counts['archived'] . ')',
                    ];
                @endphp
                @foreach ($tabs as $key => $label)
                    <a href="{{ route('admin.enquiries.index', array_filter(['status' => $key, 'q' => $search])) }}"
                       class="px-3.5 py-1.5 rounded-full border transition {{ $status === $key ? 'bg-[#29483C] text-white border-[#29483C]' : 'bg-[#FAF8F2] text-stone-700 border-stone-200 hover:border-[#82977B]' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>

            <form method="GET" action="{{ route('admin.enquiries.index') }}" class="flex items-center gap-2">
                @if ($status !== '')
                    <input type="hidden" name="status" value="{{ $status }}">
                @endif
                <input type="text"
                       name="q"
                       value="{{ $search }}"
                       placeholder="Search name, email, phone..."
                       class="rounded-lg border-stone-300 text-sm w-full sm:w-64">
                <button type="submit" class="px-4 py-2 rounded-lg bg-[#29483C] text-white text-sm font-medium">
                    Filter
                </button>
            </form>
        </div>

        {{-- Enquiries Table --}}
        <div class="bg-white rounded-xl border border-stone-200 overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-stone-50 border-b border-stone-200 text-stone-600">
                    <tr>
                        <th class="px-4 py-3">Enquirer</th>
                        <th class="px-4 py-3">Programme &amp; Mode</th>
                        <th class="px-4 py-3">Preferred Slot</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Received</th>
                        <th class="px-4 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-200">
                    @forelse ($enquiries as $enquiry)
                        @php
                            $badgeClasses = match ($enquiry->status) {
                                'new' => 'bg-amber-100 text-amber-800',
                                'contacted' => 'bg-sky-100 text-sky-800',
                                'resolved' => 'bg-emerald-100 text-emerald-800',
                                'archived' => 'bg-stone-100 text-stone-700',
                                default => 'bg-stone-100 text-stone-700',
                            };
                        @endphp
                        <tr>
                            <td class="px-4 py-3">
                                <div class="font-medium text-stone-900">{{ $enquiry->name }}</div>
                                <div class="text-xs text-stone-500">{{ $enquiry->email }} &bull; {{ $enquiry->phone }}</div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="text-stone-800">{{ $enquiry->programme?->title ?? 'General Wellness' }}</div>
                                <div class="text-xs text-stone-500 capitalize">{{ $enquiry->preference }}</div>
                            </td>
                            <td class="px-4 py-3 text-xs text-stone-600">
                                {{ $enquiry->preferred_date?->format('d M Y') ?? 'Flexible' }}
                                {{ $enquiry->preferred_time ? ' (' . $enquiry->preferred_time . ')' : '' }}
                            </td>
                            <td class="px-4 py-3">
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium capitalize {{ $badgeClasses }}">
                                    {{ $enquiry->status }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-xs text-stone-500">
                                {{ $enquiry->created_at->format('d M Y, h:i A') }}
                            </td>
                            <td class="px-4 py-3 text-right space-x-3 whitespace-nowrap">
                                <a href="{{ route('admin.enquiries.show', $enquiry) }}" class="text-[#29483C] font-medium hover:underline">
                                    View
                                </a>
                                <form method="POST" action="{{ route('admin.enquiries.destroy', $enquiry) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-700 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-stone-500">
                                No enquiries match the current filter.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div>{{ $enquiries->links() }}</div>
    </div>
</x-admin-layout>
