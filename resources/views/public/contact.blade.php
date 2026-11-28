@php
    $pageTitle = 'Contact & Enquiry — ' . config('app.name');
    $pageDescription = 'Send a session enquiry, ask about batch timings, or connect with Yogacharya Deepashree Gaur for personalised yoga and wellness guidance.';
@endphp

@php
    $localBusinessSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'LocalBusiness',
        'name' => config('app.name') . ' — Yogacharya Deepashree Gaur',
        'url' => route('contact'),
        'telephone' => '+91-9717846638',
        'email' => 'deepaajm01@gmail.com',
        'address' => [
            '@type' => 'PostalAddress',
            'addressLocality' => 'Jaipur',
            'addressRegion' => 'Rajasthan',
            'addressCountry' => 'IN',
        ],
    ];
@endphp

<x-public-layout :title="$pageTitle">
    <x-slot:seo>
        <x-public.seo
            title="Contact & Enquiry — {{ config('app.name') }}"
            description="Send a session enquiry, ask about batch timings, or connect with Yogacharya Deepashree Gaur."
            :schema="$localBusinessSchema"
        />
    </x-slot:seo>

    <x-slot:meta>
        <meta name="description" content="{{ $pageDescription }}">
        <link rel="canonical" href="{{ route('contact') }}">
    </x-slot:meta>

    <section class="py-16 sm:py-24 border-b border-stone-200/70">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#82977B]">Connect &amp; Enquire</p>
            <h1 class="mt-3 font-serif text-4xl sm:text-5xl font-semibold text-[#29483C]">
                Begin a Conversation
            </h1>
            <p class="mt-4 text-base sm:text-lg text-stone-600 leading-relaxed max-w-2xl">
                Share your goals, preferred timings, or questions about online and studio sessions. Every enquiry is reviewed personally before confirmation.
            </p>
        </div>
    </section>

    <section class="py-16 sm:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-12">
            {{-- Enquiry Form --}}
            <div class="lg:col-span-7 bg-white rounded-2xl border border-stone-200/80 p-6 sm:p-8 shadow-2xs">
                <h2 class="font-serif text-2xl font-semibold text-[#29483C] mb-6">
                    Session &amp; Programme Enquiry
                </h2>

                @if (session('status'))
                    <div class="mb-6 rounded-xl bg-emerald-50 border border-emerald-200 px-4 py-3 text-sm text-emerald-900">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.store') }}" class="space-y-5">
                    @csrf

                    {{-- Honeypot field (hidden from human users) --}}
                    <div class="hidden" aria-hidden="true">
                        <label for="website">Website</label>
                        <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-stone-700 mb-1">Full Name *</label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   value="{{ old('name') }}"
                                   required
                                   class="w-full rounded-xl border-stone-300 text-sm focus:border-[#29483C] focus:ring-[#29483C]">
                            @error('name')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-stone-700 mb-1">Phone Number *</label>
                            <input type="text"
                                   id="phone"
                                   name="phone"
                                   value="{{ old('phone') }}"
                                   required
                                   class="w-full rounded-xl border-stone-300 text-sm focus:border-[#29483C] focus:ring-[#29483C]">
                            @error('phone')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="email" class="block text-sm font-medium text-stone-700 mb-1">Email Address *</label>
                            <input type="email"
                                   id="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   required
                                   class="w-full rounded-xl border-stone-300 text-sm focus:border-[#29483C] focus:ring-[#29483C]">
                            @error('email')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="programme_id" class="block text-sm font-medium text-stone-700 mb-1">Programme of Interest</label>
                            <select id="programme_id"
                                    name="programme_id"
                                    class="w-full rounded-xl border-stone-300 text-sm focus:border-[#29483C] focus:ring-[#29483C]">
                                <option value="">General Wellness / Consultation</option>
                                @foreach ($programmes as $programme)
                                    <option value="{{ $programme->id }}"
                                            @selected((int) old('programme_id', $selectedProgrammeId) === $programme->id)>
                                        {{ $programme->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('programme_id')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label for="preference" class="block text-sm font-medium text-stone-700 mb-1">Session Mode *</label>
                            <select id="preference"
                                    name="preference"
                                    class="w-full rounded-xl border-stone-300 text-sm focus:border-[#29483C] focus:ring-[#29483C]">
                                @foreach (['online' => 'Online', 'offline' => 'Offline / Studio', 'either' => 'Flexible / Either'] as $val => $label)
                                    <option value="{{ $val }}" @selected(old('preference', 'online') === $val)>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('preference')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="preferred_date" class="block text-sm font-medium text-stone-700 mb-1">Preferred Start Date</label>
                            <input type="date"
                                   id="preferred_date"
                                   name="preferred_date"
                                   min="{{ now()->toDateString() }}"
                                   value="{{ old('preferred_date') }}"
                                   class="w-full rounded-xl border-stone-300 text-sm focus:border-[#29483C] focus:ring-[#29483C]">
                            @error('preferred_date')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="preferred_time" class="block text-sm font-medium text-stone-700 mb-1">Preferred Time Slot</label>
                            <input type="text"
                                   id="preferred_time"
                                   name="preferred_time"
                                   value="{{ old('preferred_time') }}"
                                   placeholder="e.g. 06:30 AM or Evening"
                                   class="w-full rounded-xl border-stone-300 text-sm focus:border-[#29483C] focus:ring-[#29483C]">
                            @error('preferred_time')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-stone-700 mb-1">Message &amp; Practice Notes *</label>
                        <textarea id="message"
                                  name="message"
                                  rows="4"
                                  required
                                  placeholder="Share your experience level, schedule preferences, or any wellness questions..."
                                  class="w-full rounded-xl border-stone-300 text-sm focus:border-[#29483C] focus:ring-[#29483C]">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                            class="w-full sm:w-auto px-7 py-3.5 rounded-full bg-[#29483C] text-[#FAF8F2] text-sm font-medium hover:bg-[#1f372e] transition">
                        Send Enquiry
                    </button>
                </form>
            </div>

            {{-- Direct Contact & Disclaimer --}}
            <div class="lg:col-span-5 space-y-6">
                <div class="bg-white rounded-2xl border border-stone-200/80 p-6 sm:p-8 shadow-2xs space-y-5">
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#82977B]">Direct Channels</p>
                    <h2 class="font-serif text-2xl font-semibold text-[#29483C]">Yogacharya Deepashree Gaur</h2>
                    <p class="text-sm text-stone-600 leading-relaxed">
                        Certified Yoga Instructor &bull; MA in Yogic Science &bull; 200-Hour TTC.
                    </p>

                    <dl class="space-y-3 text-sm border-t border-stone-100 pt-4">
                        <div>
                            <dt class="text-xs uppercase tracking-wider text-stone-500">Phone</dt>
                            <dd class="font-medium text-stone-900">9717846638</dd>
                        </div>
                        <div>
                            <dt class="text-xs uppercase tracking-wider text-stone-500">Email</dt>
                            <dd class="font-medium text-stone-900">deepaajm01@gmail.com</dd>
                        </div>
                    </dl>

                    <div class="pt-2">
                        <a href="https://wa.me/919717846638?text={{ urlencode('Namaste, I would like to enquire about yoga classes and wellness programmes.') }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="inline-flex items-center justify-center w-full px-5 py-3 rounded-full border border-[#29483C] text-[#29483C] text-sm font-medium hover:bg-[#82977B]/15 transition">
                            Enquire via WhatsApp
                        </a>
                    </div>
                </div>

                <x-public.disclaimer />
            </div>
        </div>
    </section>
</x-public-layout>
