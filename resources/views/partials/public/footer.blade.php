<footer class="bg-[#29483C] text-[#FAF8F2] mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <div>
                <h2 class="font-serif text-xl font-semibold text-white">
                    {{ config('app.name') }}
                </h2>
                <p class="mt-3 text-sm text-stone-300 leading-relaxed max-w-sm">
                    Authentic Hatha, Vinyasa, Pranayama, and restorative meditation sessions guided by certified teachers in a calm, grounded sanctuary.
                </p>
            </div>

            <div>
                <h3 class="text-xs font-semibold uppercase tracking-wider text-[#C5A66D]">Explore</h3>
                <ul class="mt-4 space-y-2.5 text-sm text-stone-300">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition">Home</a></li>
                    <li><a href="{{ url('/about') }}" class="hover:text-white transition">About Us</a></li>
                    <li><a href="{{ url('/programmes') }}" class="hover:text-white transition">Programmes</a></li>
                    <li><a href="{{ url('/schedule') }}" class="hover:text-white transition">Class Schedule</a></li>
                    <li><a href="{{ url('/contact') }}" class="hover:text-white transition">Contact & Enquiries</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-xs font-semibold uppercase tracking-wider text-[#C5A66D]">Studio Hours</h3>
                <ul class="mt-4 space-y-2 text-sm text-stone-300">
                    <li>Mon – Sat: 6:00 AM – 8:00 PM</li>
                    <li>Sunday: Morning Meditation & Workshops</li>
                    <li class="pt-2 text-stone-400">Jaipur, Rajasthan, India</li>
                </ul>
            </div>
        </div>

        <div class="mt-12 pt-8 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-stone-400">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <p>Mindful movement, breath, and stillness.</p>
        </div>
    </div>
</footer>