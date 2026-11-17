<x-public-layout :title="'Areas of Expertise & Practice — ' . config('app.name')">
    <x-slot:meta>
        <meta name="description" content="Explore our core areas of expertise including Hatha, Ashtanga, Pranayama, therapeutic yoga, meditation, mindfulness, and stress management.">
        <link rel="canonical" href="{{ route('expertise') }}">
    </x-slot:meta>

    {{-- Hero --}}
    <section class="py-16 sm:py-24 border-b border-stone-200/70">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#82977B]">Core Disciplines</p>
            <h1 class="mt-3 font-serif text-4xl sm:text-5xl font-semibold text-[#29483C]">
                Areas of Expertise &amp; Practice
            </h1>
            <p class="mt-4 text-base sm:text-lg text-stone-600 leading-relaxed max-w-2xl">
                Grounded in classical traditions and anatomical safety, our teaching focuses on supportive movement, breath awareness, and mental clarity.
            </p>
        </div>
    </section>

    {{-- 9 Expertise Sections --}}
    <section class="py-16 sm:py-24">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">

            <!-- 1. Hatha Yoga -->
            <div class="bg-white rounded-2xl border border-stone-200/80 p-8 shadow-2xs">
                <span class="text-xs font-semibold uppercase tracking-wider text-[#82977B]">Discipline 01</span>
                <h2 class="mt-2 font-serif text-2xl sm:text-3xl font-semibold text-[#29483C]">Classical Hatha Yoga</h2>
                <p class="mt-4 text-stone-700 leading-relaxed">
                    Hatha practice emphasizes steady postures (asanas) held with conscious breath control. By balancing effort and ease, practitioners build joint stability, posture alignment, and deep muscular awareness without strain.
                </p>
            </div>

            <!-- 2. Ashtanga Yoga -->
            <div class="bg-white rounded-2xl border border-stone-200/80 p-8 shadow-2xs">
                <span class="text-xs font-semibold uppercase tracking-wider text-[#82977B]">Discipline 02</span>
                <h2 class="mt-2 font-serif text-2xl sm:text-3xl font-semibold text-[#29483C]">Ashtanga Foundations</h2>
                <p class="mt-4 text-stone-700 leading-relaxed">
                    A dynamic, disciplined sequence linking breath with continuous movement (vinyasa). This practice generates internal heat, builds functional core strength, and cultivates sustained mental focus.
                </p>
            </div>

            <!-- 3. Pranayama -->
            <div class="bg-white rounded-2xl border border-stone-200/80 p-8 shadow-2xs">
                <span class="text-xs font-semibold uppercase tracking-wider text-[#82977B]">Discipline 03</span>
                <h2 class="mt-2 font-serif text-2xl sm:text-3xl font-semibold text-[#29483C]">Pranayama &amp; Breathwork</h2>
                <p class="mt-4 text-stone-700 leading-relaxed">
                    Systematic regulation of the breath to influence vital energy (prana). Practices range from energizing breath cycles to soothing ratios that calm the nervous system and quiet mental chatter.
                </p>
            </div>

            <!-- 4. Flexibility and Strength -->
            <div class="bg-white rounded-2xl border border-stone-200/80 p-8 shadow-2xs">
                <span class="text-xs font-semibold uppercase tracking-wider text-[#82977B]">Discipline 04</span>
                <h2 class="mt-2 font-serif text-2xl sm:text-3xl font-semibold text-[#29483C]">Flexibility &amp; Functional Strength</h2>
                <p class="mt-4 text-stone-700 leading-relaxed">
                    Balanced conditioning that pairs active range-of-motion development with joint support. Safe, progressive loading helps maintain supple connective tissue and robust physical resilience.
                </p>
            </div>

            <!-- 5. Therapeutic Yoga -->
            <div class="bg-white rounded-2xl border border-stone-200/80 p-8 shadow-2xs">
                <span class="text-xs font-semibold uppercase tracking-wider text-[#82977B]">Discipline 05</span>
                <h2 class="mt-2 font-serif text-2xl sm:text-3xl font-semibold text-[#29483C]">Therapeutic Yoga &amp; Adaptation</h2>
                <p class="mt-4 text-stone-700 leading-relaxed">
                    Personalised posture modifications and restorative sequences designed to support mobility, alleviate everyday postural fatigue, and accommodate individual physical capacities.
                </p>
            </div>

            <!-- 6. Guided Meditation -->
            <div class="bg-white rounded-2xl border border-stone-200/80 p-8 shadow-2xs">
                <span class="text-xs font-semibold uppercase tracking-wider text-[#82977B]">Discipline 06</span>
                <h2 class="mt-2 font-serif text-2xl sm:text-3xl font-semibold text-[#29483C]">Guided Meditation</h2>
                <p class="mt-4 text-stone-700 leading-relaxed">
                    Verbal guidance designed to anchor attention in the present moment. Sessions explore breath observation, body scans, and deep relaxation to nurture mental tranquility.
                </p>
            </div>

            <!-- 7. Mindfulness -->
            <div class="bg-white rounded-2xl border border-stone-200/80 p-8 shadow-2xs">
                <span class="text-xs font-semibold uppercase tracking-wider text-[#82977B]">Discipline 07</span>
                <h2 class="mt-2 font-serif text-2xl sm:text-3xl font-semibold text-[#29483C]">Mindfulness &amp; Self-Awareness</h2>
                <p class="mt-4 text-stone-700 leading-relaxed>
                    Cultivating non-judgmental awareness of thought patterns and sensory inputs. Mindfulness practices help develop emotional equilibrium and clarity during daily transitions.
                </p>
            </div>

            <!-- 8. Stress Management -->
            <div class="bg-white rounded-2xl border border-stone-200/80 p-8 shadow-2xs">
                <span class="text-xs font-semibold uppercase tracking-wider text-[#82977B]">Discipline 08</span>
                <h2 class="mt-2 font-serif text-2xl sm:text-3xl font-semibold text-[#29483C]">Stress Management &amp; Recovery</h2>
                <p class="mt-4 text-stone-700 leading-relaxed>
                    Restorative protocols aimed at shifting the body from chronic high-alert states into rest-and-digest recovery through gentle pacing and supported resting postures.
                </p>
            </div>

            <!-- 9. Chakra Healing -->
            <div class="bg-white rounded-2xl border border-stone-200/80 p-8 shadow-2xs">
                <span class="text-xs font-semibold uppercase tracking-wider text-[#82977B]">Discipline 09</span>
                <h2 class="mt-2 font-serif text-2xl sm:text-3xl font-semibold text-[#29483C]">Chakra Balancing &amp; Energetic Focus</h2>
                <p class="mt-4 text-stone-700 leading-relaxed">
                    Exploring traditional subtle-body anatomy, focusing mental attention on key energetic centers to foster a deeper sense of internal alignment and harmonious self-awareness.
                </p>
            </div>

            <div class="pt-6">
                <x-public.disclaimer />
            </div>
        </div>
    </section>
</x-public-layout>
