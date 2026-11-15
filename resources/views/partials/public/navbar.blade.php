<header x-data="{ mobileMenuOpen: false }"
        @keydown.escape.window="mobileMenuOpen = false"
        class="sticky top-0 z-40 bg-[#FAF8F2]/95 backdrop-blur-md border-b border-stone-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <!-- Brand -->
            <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                <span class="w-9 h-9 rounded-full bg-[#29483C] text-[#FAF8F2] flex items-center justify-center font-serif text-lg font-semibold">
                    Y
                </span>
                <span class="font-serif text-xl sm:text-2xl font-semibold tracking-tight text-[#29483C]">
                    {{ config('app.name') }}
                </span>
            </a>

            <!-- Desktop Navigation -->
            <nav aria-label="Primary" class="hidden md:flex items-center gap-7 text-sm font-medium">
                <a href="{{ route('home') }}"
                   class="transition {{ request()->routeIs('home') ? 'text-[#29483C] font-semibold underline decoration-[#C5A66D] decoration-2 underline-offset-8' : 'text-stone-600 hover:text-[#29483C]' }}">
                    Home
                </a>
                <a href="{{ url('/about') }}"
                   class="transition {{ request()->is('about*') ? 'text-[#29483C] font-semibold underline decoration-[#C5A66D] decoration-2 underline-offset-8' : 'text-stone-600 hover:text-[#29483C]' }}">
                    About
                </a>
                <a href="{{ url('/programmes') }}"
                   class="transition {{ request()->is('programmes*') ? 'text-[#29483C] font-semibold underline decoration-[#C5A66D] decoration-2 underline-offset-8' : 'text-stone-600 hover:text-[#29483C]' }}">
                    Programmes
                </a>
                <a href="{{ url('/schedule') }}"
                   class="transition {{ request()->is('schedule*') ? 'text-[#29483C] font-semibold underline decoration-[#C5A66D] decoration-2 underline-offset-8' : 'text-stone-600 hover:text-[#29483C]' }}">
                    Schedule
                </a>
                <a href="{{ url('/contact') }}"
                   class="transition {{ request()->is('contact*') ? 'text-[#29483C] font-semibold underline decoration-[#C5A66D] decoration-2 underline-offset-8' : 'text-stone-600 hover:text-[#29483C]' }}">
                    Contact
                </a>
            </nav>

            <!-- Desktop CTA -->
            <div class="hidden md:flex items-center gap-4">
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="text-sm font-medium text-stone-600 hover:text-[#29483C]">
                        Dashboard
                    </a>
                @endauth
                <a href="{{ url('/contact') }}"
                   class="inline-flex items-center px-5 py-2.5 rounded-full bg-[#29483C] text-[#FAF8F2] text-sm font-medium hover:bg-[#1f372e] transition shadow-xs">
                    Book a Class
                </a>
            </div>

            <!-- Mobile Hamburger Button -->
            <button type="button"
                    @click="mobileMenuOpen = !mobileMenuOpen"
                    :aria-expanded="mobileMenuOpen.toString()"
                    aria-controls="mobile-navigation"
                    class="md:hidden inline-flex items-center justify-center p-2.5 rounded-lg text-[#29483C] hover:bg-[#82977B]/15 focus:outline-none focus:ring-2 focus:ring-[#29483C]">
                <span class="sr-only">Toggle main menu</span>
                <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="mobileMenuOpen" style="display: none;" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Drawer -->
    <div id="mobile-navigation"
         x-show="mobileMenuOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         @click.away="mobileMenuOpen = false"
         style="display: none;"
         class="md:hidden bg-[#FAF8F2] border-b border-stone-200 px-4 pt-3 pb-6 shadow-lg">
        <nav aria-label="Mobile" class="flex flex-col space-y-2 text-base font-medium">
            <a href="{{ route('home') }}" @click="mobileMenuOpen = false"
               class="px-3 py-2.5 rounded-lg {{ request()->routeIs('home') ? 'bg-[#82977B]/20 text-[#29483C] font-semibold' : 'text-stone-700 hover:bg-stone-200/50' }}">
                Home
            </a>
            <a href="{{ url('/about') }}" @click="mobileMenuOpen = false"
               class="px-3 py-2.5 rounded-lg {{ request()->is('about*') ? 'bg-[#82977B]/20 text-[#29483C] font-semibold' : 'text-stone-700 hover:bg-stone-200/50' }}">
                About
            </a>
            <a href="{{ url('/programmes') }}" @click="mobileMenuOpen = false"
               class="px-3 py-2.5 rounded-lg {{ request()->is('programmes*') ? 'bg-[#82977B]/20 text-[#29483C] font-semibold' : 'text-stone-700 hover:bg-stone-200/50' }}">
                Programmes
            </a>
            <a href="{{ url('/schedule') }}" @click="mobileMenuOpen = false"
               class="px-3 py-2.5 rounded-lg {{ request()->is('schedule*') ? 'bg-[#82977B]/20 text-[#29483C] font-semibold' : 'text-stone-700 hover:bg-stone-200/50' }}">
                Schedule
            </a>
            <a href="{{ url('/contact') }}" @click="mobileMenuOpen = false"
               class="px-3 py-2.5 rounded-lg {{ request()->is('contact*') ? 'bg-[#82977B]/20 text-[#29483C] font-semibold' : 'text-stone-700 hover:bg-stone-200/50' }}">
                Contact
            </a>

            <div class="pt-3 border-t border-stone-200 flex flex-col gap-2">
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 text-sm text-stone-600 hover:text-[#29483C]">
                        Admin Dashboard →
                    </a>
                @endauth
                <a href="{{ url('/contact') }}" @click="mobileMenuOpen = false"
                   class="w-full text-center px-5 py-3 rounded-full bg-[#29483C] text-[#FAF8F2] text-sm font-medium hover:bg-[#1f372e]">
                    Book a Class
                </a>
            </div>
        </nav>
    </div>
</header>