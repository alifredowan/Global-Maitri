<!-- Minimal Unified Buddhist Platform Footer -->
<footer class="bg-[var(--bg-surface)] text-[var(--text-secondary)] text-sm border-t border-[var(--border-default)] transition-colors">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-6">
            <!-- Brand Logo & Copyright -->
            <div class="flex flex-col sm:flex-row items-center gap-3 sm:gap-4 text-center sm:text-left">
                <a href="{{ route('landing') }}" class="flex items-center gap-2.5 group">
                    <div class="w-8 h-8 rounded-[4px] bg-[var(--accent-primary)] flex items-center justify-center text-white shadow-xs group-hover:bg-[var(--accent-hover)] transition">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="9"/>
                            <circle cx="12" cy="12" r="3"/>
                            <path d="M12 3v6m0 6v6M3 12h6m6 0h6M5.636 5.636l4.243 4.243m4.242 4.242l4.243 4.243M5.636 18.364l4.243-4.243m4.242-4.242l4.243-4.243"/>
                        </svg>
                    </div>
                    <span class="font-heading font-extrabold text-lg text-[var(--text-primary)] tracking-tight">Global<span class="text-[var(--accent-primary)]">Maitri</span></span>
                </a>
                <span class="hidden sm:inline text-[var(--border-default)]">|</span>
                <p class="text-xs text-[var(--text-muted)]">
                    &copy; {{ date('Y') }} Global Maitri. Kindness first. Companionship for life.
                </p>
            </div>

            <!-- Policy & Essential Links -->
            <div class="flex items-center gap-4 sm:gap-6 text-xs text-[var(--text-secondary)] font-medium">
                <a href="{{ route('how-it-works') }}" class="hover:text-[var(--accent-primary)] transition">How It Works</a>
                <span class="text-[var(--border-default)]">•</span>
                <a href="{{ route('privacy') }}" class="hover:text-[var(--accent-primary)] transition">Privacy Policy</a>
                <span class="text-[var(--border-default)]">•</span>
                <a href="{{ route('terms') }}" class="hover:text-[var(--accent-primary)] transition">Terms of Service</a>
                <span class="text-[var(--border-default)]">•</span>
                <a href="{{ route('about') }}" class="hover:text-[var(--accent-primary)] transition">About Us</a>
                <span class="text-[var(--border-default)]">•</span>
                <a href="{{ route('contact') }}" class="hover:text-[var(--accent-primary)] transition">Contact &amp; Safety</a>
            </div>
        </div>
    </div>
</footer>
