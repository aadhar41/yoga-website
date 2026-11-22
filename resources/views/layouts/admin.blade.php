<a href="{{ route('admin.testimonials.index') }}"
   class="flex items-center px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.testimonials.*') ? 'bg-[#82977B] text-white font-medium' : 'text-stone-200 hover:bg-white/10' }}">
    Testimonials
</a>
<a href="{{ route('admin.gallery.index') }}"
   class="flex items-center px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.gallery.*') ? 'bg-[#82977B] text-white font-medium' : 'text-stone-200 hover:bg-white/10' }}">
    Gallery
</a>