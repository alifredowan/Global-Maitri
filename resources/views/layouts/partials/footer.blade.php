<!-- Simple, Fresh Buddhist Matrimonial Footer (.section--dark seamless continuation) -->
<footer class="section--dark relative overflow-hidden text-sm border-t border-[var(--color-border)]/30 transition-colors"
        style="background: linear-gradient(180deg, var(--color-ink-dark) 0%, var(--color-ink-darker) 100%);">

    <!-- Thin (3px) Five-Color Buddhist Flag Sequence Divider on Footer Top Edge -->
    <div class="h-[3px] w-full grid grid-cols-5" aria-hidden="true">
        <div class="bg-[#1F4E79]" title="Blue - Loving-kindness"></div>
        <div class="bg-[#C98A1B]" title="Yellow - Wisdom"></div>
        <div class="bg-[#B3261E]" title="Red - Blessings"></div>
        <div class="bg-[#FFFFFF]" title="White - Purity"></div>
        <div class="bg-[#E07A1E]" title="Orange - Liberation"></div>
    </div>

    <!-- Faint Lotus Line Ornament in Corner (Opacity < 8%, White Strokes on Dark) -->
    <div class="absolute bottom-0 right-0 pointer-events-none opacity-[0.06] text-white translate-x-6 translate-y-6" aria-hidden="true">
        <svg class="w-48 h-48 sm:w-60 sm:h-60" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="1.2">
            <!-- Center petal -->
            <path d="M50 20 C46 36 44 48 50 68 C56 48 54 36 50 20 Z"/>
            <!-- Inner left/right petals -->
            <path d="M50 34 C36 42 32 54 44 67 C48 55 49 44 50 34 Z"/>
            <path d="M50 34 C64 42 68 54 56 67 C52 55 51 44 50 34 Z"/>
            <!-- Outer left/right petals -->
            <path d="M46 48 C28 50 22 64 36 72 C42 64 45 56 46 48 Z"/>
            <path d="M54 48 C72 50 78 64 64 72 C58 64 55 56 54 48 Z"/>
            <!-- Base lotus bowl -->
            <path d="M26 72 C36 78 64 78 74 72 C68 82 32 82 26 72 Z"/>
        </svg>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10 space-y-6">

        <!-- Main Middle Structure: Brand on Left, Navigation Links in Middle -->
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">

            <!-- Brand Logo (Light Version) & One-Line Tagline -->
            <div class="space-y-1">
                <a href="{{ route('landing') }}" class="inline-flex items-center gap-2.5 group">
                    <x-application-logo variant="badge" badge-class="w-8 h-8 group-hover:scale-105 transition" />
                    <span class="font-heading font-extrabold text-lg text-white tracking-tight">
                        Global<span class="text-[var(--color-accent)]">Maitri</span>
                    </span>
                </a>
                <p class="text-xs text-[var(--text-muted)]">
                    Kindness first. Companionship for life.
                </p>
            </div>

            <!-- Middle Navigation Links (15px, weight 500, gold hover, 44px touch targets on mobile) -->
            <nav class="flex flex-wrap items-center gap-x-6 gap-y-2 text-[15px] font-medium text-[var(--text-secondary)]" aria-label="Footer navigation">
                <a href="{{ route('about') }}" class="min-h-[44px] inline-flex items-center hover:text-[var(--color-accent)] transition">About</a>
                <a href="{{ route('how-it-works') }}" class="min-h-[44px] inline-flex items-center hover:text-[var(--color-accent)] transition">How it works</a>
                <a href="{{ route('subscription.pricing') }}" class="min-h-[44px] inline-flex items-center hover:text-[var(--color-accent)] transition">Pricing</a>
                <a href="{{ route('landing') }}#stories" class="min-h-[44px] inline-flex items-center hover:text-[var(--color-accent)] transition">Success stories</a>
                <a href="{{ route('contact') }}#help" class="min-h-[44px] inline-flex items-center hover:text-[var(--color-accent)] transition">Help</a>
                <a href="{{ route('contact') }}" class="min-h-[44px] inline-flex items-center hover:text-[var(--color-accent)] transition">Contact</a>
            </nav>

        </div>

        <!-- Divider -->
        <div class="border-t border-[var(--border-subtle)]"></div>

        <!-- Bottom Row: Copyright on Left, Legal & Cookie Settings on Right -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 text-[14px] text-[var(--text-muted)]">

            <!-- Left: Copyright -->
            <p>
                &copy; {{ date('Y') }} Global Maitri. All rights reserved.
            </p>

            <!-- Right: Privacy, Terms, Cookie Settings -->
            <div class="flex flex-wrap items-center gap-x-5 gap-y-1">
                <a href="{{ route('privacy') }}" class="hover:text-[var(--color-accent)] transition">Privacy</a>
                <a href="{{ route('terms') }}" class="hover:text-[var(--color-accent)] transition">Terms</a>
                <a href="{{ route('cookies') }}" class="hover:text-[var(--color-accent)] transition">Cookie Policy</a>

                {{-- In the logged-in app area, Cookie settings is shown under Settings > Privacy instead of the footer.
                     In public areas or for guests, it is visible to ALL visitors. --}}
                @if(!auth()->check() || request()->routeIs('landing', 'how-it-works', 'about', 'contact', 'subscription.pricing', 'privacy', 'terms', 'cookies'))
                    <button type="button"
                            @click="$dispatch('open-cookie-settings')"
                            class="hover:text-[var(--color-accent)] transition cursor-pointer font-medium text-left">
                        Cookie settings
                    </button>
                @endif
            </div>

        </div>

    </div>
</footer>
