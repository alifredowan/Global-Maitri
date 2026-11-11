<div class="flex items-center gap-1.5 sm:gap-2">
    <!-- 1. Messages icon (chat bubble) with unread badge (Desktop) -->
    <div class="hidden md:inline-flex">
        <x-message-button />
    </div>

    <!-- 2. Notifications icon (bell) with unread badge (Desktop & Mobile) -->
    <x-notification-bell />

    <!-- 3. Theme toggle (sun/moon), icon-only (Desktop) -->
    <div class="hidden sm:inline-flex"
         x-data="{
             isDark: document.documentElement.classList.contains('dark'),
             toggleTheme() {
                 this.isDark = !this.isDark;
                 if (this.isDark) {
                     document.documentElement.classList.add('dark');
                     localStorage.setItem('theme', 'dark');
                     localStorage.setItem('maitri_theme', 'dark');
                 } else {
                     document.documentElement.classList.remove('dark');
                     localStorage.setItem('theme', 'light');
                     localStorage.setItem('maitri_theme', 'light');
                 }
                 window.dispatchEvent(new CustomEvent('maitri-mood-changed', { detail: { mood: this.isDark ? 'dark' : 'light' } }));
             }
         }">
        <button type="button"
                @click="toggleTheme()"
                title="Theme"
                aria-label="Toggle light and dark theme"
                class="w-11 h-11 flex items-center justify-center rounded-full text-[var(--text-secondary)] hover:text-[var(--text-primary)] hover:bg-[var(--bg-subtle)] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[var(--accent-primary)] focus-visible:ring-offset-2 transition-colors cursor-pointer">
            <!-- Sun icon when dark (click to turn light) -->
            <svg x-show="isDark" x-cloak class="w-[22px] h-[22px]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"/>
            </svg>
            <!-- Moon icon when light (click to turn dark) -->
            <svg x-show="!isDark" class="w-[22px] h-[22px]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z"/>
            </svg>
        </button>
    </div>

    <!-- 4. Avatar button with chevron, which opens the account menu (Desktop & Mobile) -->
    <x-account-menu />
</div>
