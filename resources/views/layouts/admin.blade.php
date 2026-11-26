<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title . ' — ' : '' }}{{ config('app.name') }} Admin</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body x-data="{ sidebarOpen: false }" class="bg-[#FAF8F2] text-stone-800 font-sans antialiased">
    <div class="min-h-screen flex">
        {{-- Mobile Sidebar Backdrop --}}
        <div x-show="sidebarOpen"
             x-transition.opacity
             @click="sidebarOpen = false"
             class="fixed inset-0 z-30 bg-stone-950/50 lg:hidden"
             style="display: none;"></div>

        {{-- Sidebar --}}
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
               class="fixed inset-y-0 left-0 z-40 w-64 bg-[#29483C] text-[#FAF8F2] flex flex-col justify-between transition-transform duration-200 ease-out lg:static lg:translate-x-0 shrink-0">
            <div>
                {{-- Brand Header --}}
                <div class="h-16 px-5 flex items-center justify-between border-b border-white/10">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 min-w-0">
                        <span class="w-8 h-8 rounded-full bg-[#82977B]/30 border border-[#C5A66D]/50 flex items-center justify-center font-serif text-sm font-semibold text-[#C5A66D] shrink-0">
                            Y
                        </span>
                        <div class="truncate">
                            <div class="font-serif text-sm font-semibold text-white truncate">{{ config('app.name') }}</div>
                            <div class="text-[11px] uppercase tracking-wider text-[#C5A66D]">Admin Studio</div>
                        </div>
                    </a>

                    <button type="button"
                            @click="sidebarOpen = false"
                            class="lg:hidden p-1.5 rounded-lg text-stone-300 hover:text-white hover:bg-white/10"
                            aria-label="Close sidebar">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                {{-- Navigation Links --}}
                <nav class="p-4 space-y-1 text-sm overflow-y-auto max-h-[calc(100vh-8rem)]" aria-label="Admin Navigation">
                    <p class="px-3 pt-1 pb-1.5 text-[11px] font-semibold uppercase tracking-[0.16em] text-[#C5A66D]/80">
                        Overview
                    </p>
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.dashboard') ? 'bg-[#82977B] text-white font-medium' : 'text-stone-200 hover:bg-white/10' }}">
                        Dashboard
                    </a>

                    <p class="px-3 pt-4 pb-1.5 text-[11px] font-semibold uppercase tracking-[0.16em] text-[#C5A66D]/80">
                        Content &amp; Offerings
                    </p>
                    @if (Route::has('admin.profile.edit'))
                        <a href="{{ route('admin.profile.edit') }}"
                           class="flex items-center px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.profile.*') ? 'bg-[#82977B] text-white font-medium' : 'text-stone-200 hover:bg-white/10' }}">
                            Instructor Profile
                        </a>
                    @endif

                    @if (Route::has('admin.programmes.index'))
                        <a href="{{ route('admin.programmes.index') }}"
                           class="flex items-center px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.programmes.*') ? 'bg-[#82977B] text-white font-medium' : 'text-stone-200 hover:bg-white/10' }}">
                            Programmes
                        </a>
                    @endif

                    @if (Route::has('admin.schedules.index'))
                        <a href="{{ route('admin.schedules.index') }}"
                           class="flex items-center px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.schedules.*') ? 'bg-[#82977B] text-white font-medium' : 'text-stone-200 hover:bg-white/10' }}">
                            Classes &amp; Venues
                        </a>
                    @endif

                    @if (Route::has('admin.testimonials.index'))
                        <a href="{{ route('admin.testimonials.index') }}"
                           class="flex items-center px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.testimonials.*') ? 'bg-[#82977B] text-white font-medium' : 'text-stone-200 hover:bg-white/10' }}">
                            Testimonials
                        </a>
                    @endif

                    @if (Route::has('admin.gallery.index'))
                        <a href="{{ route('admin.gallery.index') }}"
                           class="flex items-center px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.gallery.*') ? 'bg-[#82977B] text-white font-medium' : 'text-stone-200 hover:bg-white/10' }}">
                            Gallery
                        </a>
                    @endif

                    @if (Route::has('admin.blog.index'))
                        <a href="{{ route('admin.blog.index') }}"
                           class="flex items-center px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.blog.*') ? 'bg-[#82977B] text-white font-medium' : 'text-stone-200 hover:bg-white/10' }}">
                            Wellness Blog
                        </a>
                    @endif

                    @if (Route::has('admin.media.index'))
                        <a href="{{ route('admin.media.index') }}"
                           class="flex items-center px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.media.*') ? 'bg-[#82977B] text-white font-medium' : 'text-stone-200 hover:bg-white/10' }}">
                            Media Library
                        </a>
                    @endif

                    @if (Route::has('admin.bookings.index'))
                        <p class="px-3 pt-4 pb-1.5 text-[11px] font-semibold uppercase tracking-[0.16em] text-[#C5A66D]/80">
                            Enquiries
                        </p>
                        <a href="{{ route('admin.bookings.index') }}"
                           class="flex items-center px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.bookings.*') ? 'bg-[#82977B] text-white font-medium' : 'text-stone-200 hover:bg-white/10' }}">
                            Bookings
                        </a>
                    @endif

                    @if (Route::has('admin.enquiries.index'))
                        <p class="px-3 pt-4 pb-1.5 text-[11px] font-semibold uppercase tracking-[0.16em] text-[#C5A66D]/80">
                            Enquiries
                        </p>
                        <a href="{{ route('admin.enquiries.index') }}"
                        class="flex items-center px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.enquiries.*') ? 'bg-[#82977B] text-white font-medium' : 'text-stone-200 hover:bg-white/10' }}">
                            Enquiry Inbox
                        </a>
                    @endif
                </nav>
            </div>

            {{-- Sidebar Footer --}}
            <div class="p-4 border-t border-white/10 space-y-2 text-xs">
                <a href="{{ route('home') }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="block px-3 py-2 rounded-lg text-stone-200 hover:bg-white/10 transition">
                    View Public Site &nearr;
                </a>

                @if (auth()->check())
                    <div class="px-3 py-1.5 text-stone-300 truncate">
                        {{ auth()->user()->name }}
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full text-left px-3 py-2 rounded-lg text-amber-200 hover:bg-white/10 transition">
                            Sign Out
                        </button>
                    </form>
                @endif
            </div>
        </aside>

        {{-- Main Content Column --}}
        <div class="flex-1 min-w-0 flex flex-col">
            {{-- Top Header Bar --}}
            <header class="h-16 bg-white border-b border-stone-200/80 px-4 sm:px-6 lg:px-8 flex items-center justify-between gap-4 sticky top-0 z-20">
                <div class="flex items-center gap-3 min-w-0">
                    <button type="button"
                            @click="sidebarOpen = true"
                            class="lg:hidden p-2 rounded-lg border border-stone-200 text-stone-700 hover:bg-stone-50"
                            aria-label="Open sidebar">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <div class="flex items-center gap-2 text-xs text-stone-500 truncate">
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-[#29483C]">Admin</a>
                        {{ $breadcrumbs ?? '' }}
                    </div>
                </div>

                <div class="flex items-center gap-3 text-xs text-stone-600">
                    <span class="hidden sm:inline px-2.5 py-1 rounded-full bg-[#82977B]/15 text-[#29483C] font-medium">
                        {{ now()->format('d M Y') }}
                    </span>
                </div>
            </header>

            {{-- Page Body --}}
            <main class="flex-1 p-4 sm:p-6 lg:p-8 max-w-7xl w-full mx-auto">
                @if (session('status'))
                    <div class="mb-6 rounded-xl bg-emerald-50 border border-emerald-200 px-4 py-3 text-sm text-emerald-900">
                        {{ session('status') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-900">
                        {{ session('error') }}
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
