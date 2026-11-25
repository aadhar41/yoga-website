@php
    $pageTitle = 'Class Schedule & Venues — ' . config('app.name');
    $pageDescription = 'Explore morning and evening yoga batches, online sessions, and studio timings.';
@endphp

<x-public-layout :title="$pageTitle">
    <x-slot:meta>
        <meta name="description" content="{{ $pageDescription }}">
        <link rel="canonical" href="{{ route('schedule') }}">
    </x-slot:meta>

    <section class="py-16 sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div class="max-w-2xl">
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#82977B]">Practice Timings</p>
                <h1 class="mt-3 font-serif text-4xl sm:text-5xl font-semibold text-[#29483C]">
                    Class Schedule &amp; Venues
                </h1>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($schedules ?? collect() as $schedule)
                    <div class="bg-white rounded-2xl border border-stone-200/80 p-6 shadow-2xs flex flex-col justify-between space-y-4">
                        <div>
                            <div class="flex items-center justify-between gap-2 text-xs">
                                <span class="font-semibold uppercase tracking-wider text-[#82977B]">
                                    {{ $schedule->days_of_week }}
                                </span>
                                <span class="px-2.5 py-0.5 rounded-full bg-[#FAF8F2] border border-stone-200 capitalize text-stone-700">
                                    {{ $schedule->mode }}
                                </span>
                            </div>

                            <h2 class="mt-2 font-serif text-xl font-semibold text-[#29483C]">
                                {{ $schedule->title }}
                            </h2>

                            @if ($schedule->programme)
                                <p class="mt-1 text-xs text-stone-500">
                                    Programme: {{ $schedule->programme->title }}
                                </p>
                            @endif

                            <p class="mt-3 text-sm font-medium text-stone-800">
                                {{ $schedule->start_time }}{{ $schedule->end_time ? ' – ' . $schedule->end_time : '' }}
                            </p>

                            @if ($schedule->venue_name || $schedule->venue_address)
                                <p class="mt-2 text-xs text-stone-600">
                                    {{ $schedule->venue_name }}{{ ($schedule->venue_name && $schedule->venue_address) ? ' — ' : '' }}{{ $schedule->venue_address }}
                                </p>
                            @endif
                        </div>

                        <div class="pt-3 border-t border-stone-100">
                            <a href="{{ route('contact') }}" class="text-sm font-medium text-[#29483C] hover:underline">
                                Enquire for this batch &rarr;
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white rounded-2xl border border-stone-200/80 p-8 text-center text-sm text-stone-600">
                        Active class schedules will appear here once published.
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</x-public-layout>
