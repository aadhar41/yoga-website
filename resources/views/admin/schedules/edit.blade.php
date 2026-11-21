<x-admin-layout title="Edit Class Schedule">
    <x-slot:breadcrumbs>
        <span>/</span>
        <a href="{{ route('admin.schedules.index') }}" class="hover:text-[#29483C]">Classes &amp; Venues</a>
        <span>/</span>
        <span class="text-stone-800 font-medium">Edit</span>
    </x-slot:breadcrumbs>

    <div class="max-w-3xl bg-white rounded-xl border border-stone-200 p-6 sm:p-8">
        <h1 class="font-serif text-2xl text-[#29483C] font-semibold mb-6">Edit Class Schedule &amp; Venue</h1>

        <form method="POST" action="{{ route('admin.schedules.update', $schedule) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Batch / Class Title</label>
                    <input type="text" name="title" value="{{ old('title', $schedule->title) }}" required class="w-full rounded-lg border-stone-300 text-sm">
                    @error('title') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Linked Programme (Optional)</label>
                    <select name="programme_id" class="w-full rounded-lg border-stone-300 text-sm">
                        <option value="">General / Unlinked</option>
                        @foreach ($programmes as $programme)
                            <option value="{{ $programme->id }}" @selected(old('programme_id', $schedule->programme_id) == $programme->id)>
                                {{ $programme->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('programme_id') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Days of Week</label>
                    <input type="text" name="days_of_week" value="{{ old('days_of_week', $schedule->days_of_week) }}" required class="w-full rounded-lg border-stone-300 text-sm">
                    @error('days_of_week') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Start Time</label>
                    <input type="text" name="start_time" value="{{ old('start_time', $schedule->start_time) }}" required class="w-full rounded-lg border-stone-300 text-sm">
                    @error('start_time') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">End Time</label>
                    <input type="text" name="end_time" value="{{ old('end_time', $schedule->end_time) }}" class="w-full rounded-lg border-stone-300 text-sm">
                    @error('end_time') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Mode</label>
                    <select name="mode" required class="w-full rounded-lg border-stone-300 text-sm">
                        @foreach (['offline' => 'Offline (Studio / Venue)', 'online' => 'Online (Live Session)', 'hybrid' => 'Hybrid'] as $val => $label)
                            <option value="{{ $val }}" @selected(old('mode', $schedule->mode) === $val)>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('mode') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Venue Name</label>
                    <input type="text" name="venue_name" value="{{ old('venue_name', $schedule->venue_name) }}" class="w-full rounded-lg border-stone-300 text-sm">
                    @error('venue_name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Venue Address / Location</label>
                    <input type="text" name="venue_address" value="{{ old('venue_address', $schedule->venue_address) }}" class="w-full rounded-lg border-stone-300 text-sm">
                    @error('venue_address') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <label class="inline-flex items-center gap-2 text-sm">
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $schedule->is_active)) class="rounded border-stone-300 text-[#29483C]">
                <span>Active on public schedule</span>
            </label>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="px-5 py-2.5 rounded-lg bg-[#29483C] text-white text-sm font-medium">Update Schedule</button>
                <a href="{{ route('admin.schedules.index') }}" class="text-sm text-stone-600 hover:underline">Cancel</a>
            </div>
        </form>
    </div>
</x-admin-layout>