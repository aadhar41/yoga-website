<x-admin-layout title="Audit Log">
    <x-slot:breadcrumbs>
        <span>/</span>
        <span class="text-stone-800 font-medium">Audit Log</span>
    </x-slot:breadcrumbs>

    <div class="space-y-6">
        <div>
            <h1 class="font-serif text-2xl text-[#29483C] font-semibold">Audit Trail</h1>
            <p class="text-sm text-stone-600">Chronological record of admin content changes and enquiry status updates.</p>
        </div>

        <form method="GET"
              action="{{ route('admin.audit-logs.index') }}"
              class="bg-white rounded-xl border border-stone-200 p-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
            <div>
                <label class="block text-xs font-medium text-stone-500 mb-1">Action</label>
                <select name="action" class="w-full rounded-lg border-stone-300 text-sm">
                    <option value="">All Actions</option>
                    @foreach ($actions as $availableAction)
                        <option value="{{ $availableAction }}" @selected($action === $availableAction)>
                            {{ ucfirst($availableAction) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-medium text-stone-500 mb-1">Actor</label>
                <select name="user_id" class="w-full rounded-lg border-stone-300 text-sm">
                    <option value="">All Users / Public</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @selected($userId === $user->id)>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-medium text-stone-500 mb-1">Search Description</label>
                <input type="text"
                       name="q"
                       value="{{ $search }}"
                       placeholder="e.g. Programme, Enquiry..."
                       class="w-full rounded-lg border-stone-300 text-sm">
            </div>

            <div class="flex items-end gap-2">
                <button type="submit" class="px-4 py-2 rounded-lg bg-[#29483C] text-white text-sm font-medium">
                    Apply Filters
                </button>
                <a href="{{ route('admin.audit-logs.index') }}" class="px-3 py-2 text-sm text-stone-600 hover:underline">
                    Reset
                </a>
            </div>
        </form>

        <div class="bg-white rounded-xl border border-stone-200 overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-stone-50 border-b border-stone-200 text-stone-600">
                    <tr>
                        <th class="px-4 py-3">Timestamp</th>
                        <th class="px-4 py-3">Event</th>
                        <th class="px-4 py-3">Description</th>
                        <th class="px-4 py-3">Actor</th>
                        <th class="px-4 py-3">Changes</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-200">
                    @forelse ($logs as $log)
                        @php
                            $badgeClasses = match ($log->action) {
                                'created' => 'bg-emerald-100 text-emerald-800',
                                'updated' => 'bg-sky-100 text-sky-800',
                                'deleted' => 'bg-red-100 text-red-800',
                                default => 'bg-stone-100 text-stone-700',
                            };
                        @endphp
                        <tr>
                            <td class="px-4 py-3 text-xs text-stone-500 whitespace-nowrap">
                                {{ $log->created_at?->format('d M Y, h:i A') }}
                            </td>
                            <td class="px-4 py-3">
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium capitalize {{ $badgeClasses }}">
                                    {{ $log->action }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="font-medium text-stone-900">{{ $log->summary }}</div>
                                <div class="text-xs text-stone-500">{{ class_basename($log->auditable_type) }} #{{ $log->auditable_id }}</div>
                            </td>
                            <td class="px-4 py-3 text-xs text-stone-700">
                                {{ $log->user?->name ?? 'Public / System' }}
                            </td>
                            <td class="px-4 py-3 text-xs text-stone-600 max-w-xs">
                                @if (!empty($log->metadata['new']))
                                    <span class="font-medium text-stone-700">Updated:</span>
                                    {{ implode(', ', array_keys($log->metadata['new'])) }}
                                @elseif (!empty($log->metadata['attributes']))
                                    <span class="text-stone-500">Snapshot recorded</span>
                                @else
                                    <span>—</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-stone-500">No audit records yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div>{{ $logs->links() }}</div>
    </div>
</x-admin-layout>
