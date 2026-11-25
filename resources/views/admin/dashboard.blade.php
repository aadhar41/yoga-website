<x-admin-layout title="Dashboard">
    <x-slot:breadcrumbs>
        <span>/</span>
        <span class="text-stone-800 font-medium">Dashboard</span>
    </x-slot:breadcrumbs>

    <div class="space-y-8">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#82977B]">Admin Studio</p>
            <h1 class="mt-1 font-serif text-3xl font-semibold text-[#29483C]">
                Welcome back, {{ auth()->user()->name }}
            </h1>
            <p class="mt-1 text-sm text-stone-600">
                Manage instructor profile, yoga programmes, class schedules, testimonials, gallery, and wellness articles.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @if (Route::has('admin.profile.edit'))
                <a href="{{ route('admin.profile.edit') }}"
                   class="bg-white rounded-2xl border border-stone-200/80 p-6 hover:border-[#82977B] transition shadow-2xs">
                    <h2 class="font-serif text-lg font-semibold text-[#29483C]">Instructor Profile</h2>
                    <p class="mt-1 text-sm text-stone-600">Update bio, qualifications, experience, and portrait.</p>
                </a>
            @endif

            @if (Route::has('admin.programmes.index'))
                <a href="{{ route('admin.programmes.index') }}"
                   class="bg-white rounded-2xl border border-stone-200/80 p-6 hover:border-[#82977B] transition shadow-2xs">
                    <h2 class="font-serif text-lg font-semibold text-[#29483C]">Programmes</h2>
                    <p class="mt-1 text-sm text-stone-600">Create, edit, order, and publish yoga and wellness tracks.</p>
                </a>
            @endif

            @if (Route::has('admin.schedules.index'))
                <a href="{{ route('admin.schedules.index') }}"
                   class="bg-white rounded-2xl border border-stone-200/80 p-6 hover:border-[#82977B] transition shadow-2xs">
                    <h2 class="font-serif text-lg font-semibold text-[#29483C]">Classes &amp; Venues</h2>
                    <p class="mt-1 text-sm text-stone-600">Manage batch timings, online/studio modes, and venues.</p>
                </a>
            @endif

            @if (Route::has('admin.testimonials.index'))
                <a href="{{ route('admin.testimonials.index') }}"
                   class="bg-white rounded-2xl border border-stone-200/80 p-6 hover:border-[#82977B] transition shadow-2xs">
                    <h2 class="font-serif text-lg font-semibold text-[#29483C]">Testimonials</h2>
                    <p class="mt-1 text-sm text-stone-600">Approve student reflections and feature highlights.</p>
                </a>
            @endif

            @if (Route::has('admin.gallery.index'))
                <a href="{{ route('admin.gallery.index') }}"
                   class="bg-white rounded-2xl border border-stone-200/80 p-6 hover:border-[#82977B] transition shadow-2xs">
                    <h2 class="font-serif text-lg font-semibold text-[#29483C]">Gallery</h2>
                    <p class="mt-1 text-sm text-stone-600">Upload and curate studio and practice photography.</p>
                </a>
            @endif

            @if (Route::has('admin.blog.index'))
                <a href="{{ route('admin.blog.index') }}"
                   class="bg-white rounded-2xl border border-stone-200/80 p-6 hover:border-[#82977B] transition shadow-2xs">
                    <h2 class="font-serif text-lg font-semibold text-[#29483C]">Wellness Blog</h2>
                    <p class="mt-1 text-sm text-stone-600">Draft and publish articles on yoga and mindful living.</p>
                </a>
            @endif
        </div>
    </div>
</x-admin-layout>
