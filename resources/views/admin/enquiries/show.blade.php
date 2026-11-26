<x-admin-layout title="Enquiry Details">
    <x-slot:breadcrumbs>
        <span>/</span>
        <a href="{{ route('admin.enquiries.index') }}" class="hover:text-[#29483C]">Enquiry Inbox</a>
        <span>/</span>
        <span class="text-stone-800 font-medium">#{{ $enquiry->id }}</span>
    </x-slot:breadcrumbs>

    <div class="max-w-3xl space-y-6">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h1 class="font-serif text-2xl text-[#29483C] font-semibold">Enquiry from {{ $enquiry->name }}</h1>
                <p class="text-xs text-stone-500">Submitted {{ $enquiry->created_at->format('d M Y, h:i A') }}</p>
            </div>
            <a href="{{ route('admin.enquiries.index') }}" class="text-sm text-[#29483C] hover:underline">
                &larr; Back to Inbox
            </a>
        </div>

        <div class="bg-white rounded-xl border border-stone-200 p-6 sm:p-8 space-y-6">
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                <div>
                    <dt class="text-xs uppercase tracking-wider text-stone-500">Name</dt>
                    <dd class="mt-1 font-medium text-stone-900">{{ $enquiry->name }}</dd>
                </div>
                <div>
                    <dt class="text-xs uppercase tracking-wider text-stone-500">Phone</dt>
                    <dd class="mt-1 font-medium text-stone-900">{{ $enquiry->phone }}</dd>
                </div>
                <div>
                    <dt class="text-xs uppercase tracking-wider text-stone-500">Email</dt>
                    <dd class="mt-1 font-medium text-stone-900">{{ $enquiry->email }}</dd>
                </div>
                <div>
                    <dt class="text-xs uppercase tracking-wider text-stone-500">Programme</dt>
                    <dd class="mt-1 font-medium text-stone-900">{{ $enquiry->programme?->title ?? 'General Wellness / Consultation' }}</dd>
                </div>
                <div>
                    <dt class="text-xs uppercase tracking-wider text-stone-500">Mode Preference</dt>
                    <dd class="mt-1 capitalize text-stone-800">{{ $enquiry->preference }}</dd>
                </div>
                <div>
                    <dt class="text-xs uppercase tracking-wider text-stone-500">Preferred Date &amp; Time</dt>
                    <dd class="mt-1 text-stone-800">
                        {{ $enquiry->preferred_date?->format('d M Y') ?? 'Flexible' }}
                        {{ $enquiry->preferred_time ? ' &bull; ' . $enquiry->preferred_time : '' }}
                    </dd>
                </div>
            </dl>

            <div class="border-t border-stone-100 pt-5">
                <h2 class="text-xs uppercase tracking-wider text-stone-500 mb-2">Message &amp; Practice Notes</h2>
                <p class="text-sm text-stone-700 leading-relaxed whitespace-pre-line">{{ $enquiry->message }}</p>
            </div>

            <div class="border-t border-stone-100 pt-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <form method="POST" action="{{ route('admin.enquiries.update', $enquiry) }}" class="flex items-center gap-3">
                    @csrf
                    @method('PATCH')

                    <label for="status" class="text-sm font-medium text-stone-700">Workflow Status:</label>
                    <select id="status" name="status" class="rounded-lg border-stone-300 text-sm">
                        @foreach (['new' => 'New', 'contacted' => 'Contacted', 'resolved' => 'Resolved', 'archived' => 'Archived'] as $val => $label)
                            <option value="{{ $val }}" @selected($enquiry->status === $val)>{{ $label }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="px-4 py-2 rounded-lg bg-[#29483C] text-white text-sm font-medium hover:bg-[#1f372e]">
                        Save Status
                    </button>
                </form>

                <form method="POST" action="{{ route('admin.enquiries.destroy', $enquiry) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 rounded-lg border border-red-200 text-red-700 text-sm hover:bg-red-50">
                        Delete Enquiry
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
