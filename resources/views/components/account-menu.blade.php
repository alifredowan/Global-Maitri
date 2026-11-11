@php
    $user = Auth::user();
    $isVerified = $user ? (bool) $user->is_verified : false;
    $isPro = $user ? $user->isPro() : false;
    $isGuardian = $user ? ($user->isWali() || $user->isFamilyRep()) : false;
    $isAdmin = $user ? ($user->isAdmin() || $user->isSuperAdmin() || $user->isModerator()) : false;
@endphp

<div class="relative inline-flex"
     x-data="{
         menuOpen: false,
         focusedIndex: -1,
         get menuItems() {
             return Array.from(this.$refs.menuContainer ? this.$refs.menuContainer.querySelectorAll('[role=menuitem]') : []);
         },
         focusNext() {
             const items = this.menuItems;
             if (!items.length) return;
             this.focusedIndex = (this.focusedIndex + 1) % items.length;
             items[this.focusedIndex]?.focus();
         },
         focusPrev() {
             const items = this.menuItems;
             if (!items.length) return;
             this.focusedIndex = (this.focusedIndex - 1 + items.length) % items.length;
             items[this.focusedIndex]?.focus();
         },
         focusFirst() {
             const items = this.menuItems;
             if (!items.length) return;
             this.focusedIndex = 0;
             items[0]?.focus();
         },
         focusLast() {
             const items = this.menuItems;
             if (!items.length) return;
             this.focusedIndex = items.length - 1;
             items[items.length - 1]?.focus();
         },
         closeMenu() {
             this.menuOpen = false;
             this.focusedIndex = -1;
             this.$refs.avatarButton?.focus();
         }
     }"
     @click.outside="menuOpen = false"
     @keydown.escape.window="if (menuOpen) closeMenu()"
     @popstate.window="menuOpen = false">

    <!-- Avatar Button with Chevron (44x44px hit area) -->
    <button type="button"
            x-ref="avatarButton"
            @click="menuOpen = !menuOpen; if (menuOpen) { $nextTick(() => focusFirst()); }"
            @keydown.arrow-down.prevent="if (!menuOpen) { menuOpen = true; $nextTick(() => focusFirst()); } else { focusNext(); }"
            @keydown.arrow-up.prevent="if (!menuOpen) { menuOpen = true; $nextTick(() => focusLast()); } else { focusPrev(); }"
            title="Account"
            aria-label="Account menu"
            aria-haspopup="menu"
            :aria-expanded="menuOpen"
            class="group h-11 px-2 flex items-center gap-1.5 rounded-full hover:bg-[var(--bg-subtle)] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[var(--accent-primary)] focus-visible:ring-offset-2 transition-colors cursor-pointer"
            :class="menuOpen ? 'bg-[var(--bg-subtle)]' : ''">
        <div class="w-8 h-8 rounded-full bg-[var(--accent-primary)] text-white text-xs font-bold flex items-center justify-center shrink-0 shadow-2xs">
            {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
        </div>
        <svg class="w-4 h-4 text-[var(--text-muted)] group-hover:text-[var(--text-primary)] transition-transform duration-150"
             :class="menuOpen ? 'rotate-180 text-[var(--text-primary)]' : ''"
             fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
        </svg>
    </button>

    <!-- Account Menu Dropdown (270px wide, 8px radius, subtle shadow) -->
    <div x-show="menuOpen"
         x-cloak
         x-ref="menuContainer"
         x-transition:enter="transition ease-out duration-150"
         x-transition:enter-start="opacity-0 scale-95 translate-y-1"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         x-transition:leave="transition ease-in duration-100"
         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
         x-transition:leave-end="opacity-0 scale-95 translate-y-1"
         role="menu"
         aria-orientation="vertical"
         aria-label="Account options"
         @keydown.arrow-down.prevent="focusNext()"
         @keydown.arrow-up.prevent="focusPrev()"
         @keydown.home.prevent="focusFirst()"
         @keydown.end.prevent="focusLast()"
         @keydown.tab="menuOpen = false"
         class="absolute right-0 top-full mt-2 w-[270px] bg-[var(--bg-surface)] border border-[var(--border-default)] rounded-lg shadow-lg py-1.5 z-50 text-left">

        <!-- Header Row (Avatar, Display Name, Plan Badge Free/Pro, Verified Badge) -->
        <div class="px-3.5 py-3 border-b border-[var(--border-subtle)] bg-[var(--bg-canvas)]/50">
            <div class="flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-full bg-[var(--accent-primary)] text-white text-sm font-bold flex items-center justify-center shrink-0">
                    {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                </div>
                <div class="min-w-0 flex-1">
                    <div class="flex items-center gap-1.5 truncate">
                        <span class="text-xs font-bold text-[var(--text-primary)] truncate">{{ $user->name }}</span>
                        @if($isVerified)
                            <span class="inline-flex items-center text-[var(--color-primary)] shrink-0" title="Verified Member">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </span>
                        @endif
                    </div>
                    <div class="flex items-center gap-1.5 mt-0.5">
                        <span class="px-1.5 py-0.5 rounded text-[10px] font-semibold uppercase tracking-wider {{ $isPro ? 'bg-[var(--color-accent)] text-[var(--color-ink-dark)] font-bold border border-[var(--color-accent)]' : 'bg-[var(--bg-subtle)] text-[var(--text-secondary)] border border-[var(--border-default)]' }}">
                            {{ $isPro ? 'Pro' : 'Free' }}
                        </span>
                        @if($isVerified)
                            <span class="text-[10px] font-medium text-[var(--color-primary)]">Verified</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Menu Items in Exact Order -->
        <div class="py-1">
            <!-- 1. My Profile -->
            <a href="{{ route('profile.show') }}"
               role="menuitem"
               tabindex="-1"
               @click="menuOpen = false"
               class="flex items-center gap-2.5 px-3.5 py-2 text-xs font-medium text-[var(--text-primary)] hover:bg-[var(--bg-subtle)] hover:text-[var(--accent-primary)] focus:bg-[var(--bg-subtle)] focus:outline-none transition">
                <svg class="w-4 h-4 text-[var(--text-secondary)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                </svg>
                <span>My profile</span>
            </a>

            <!-- 2. Family Dashboard (For Guardians & Family Representatives) -->
            @if($isGuardian || $user->isSuperAdmin())
                <a href="{{ route('wali.dashboard') }}"
                   role="menuitem"
                   tabindex="-1"
                   @click="menuOpen = false"
                   class="flex items-center gap-2.5 px-3.5 py-2 text-xs font-medium text-[var(--text-primary)] hover:bg-[var(--bg-subtle)] hover:text-[var(--accent-primary)] focus:bg-[var(--bg-subtle)] focus:outline-none transition">
                    <svg class="w-4 h-4 text-[var(--text-secondary)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>
                    </svg>
                    <span>Family dashboard</span>
                </a>
            @endif

            <!-- 3. Settings -->
            <a href="{{ route('settings.index') }}"
               role="menuitem"
               tabindex="-1"
               @click="menuOpen = false"
               class="flex items-center gap-2.5 px-3.5 py-2 text-xs font-medium text-[var(--text-primary)] hover:bg-[var(--bg-subtle)] hover:text-[var(--accent-primary)] focus:bg-[var(--bg-subtle)] focus:outline-none transition">
                <svg class="w-4 h-4 text-[var(--text-secondary)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span>Settings</span>
            </a>

            <!-- 4. Privacy & Cookies -->
            <a href="{{ route('privacy') }}#cookies"
               role="menuitem"
               tabindex="-1"
               @click="menuOpen = false"
               class="flex items-center gap-2.5 px-3.5 py-2 text-xs font-medium text-[var(--text-primary)] hover:bg-[var(--bg-subtle)] hover:text-[var(--accent-primary)] focus:bg-[var(--bg-subtle)] focus:outline-none transition">
                <svg class="w-4 h-4 text-[var(--text-secondary)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
                </svg>
                <span>Privacy &amp; cookies</span>
            </a>

            <!-- 5. Membership -->
            <a href="{{ route('subscription.pricing') }}"
               role="menuitem"
               tabindex="-1"
               @click="menuOpen = false"
               class="flex items-center gap-2.5 px-3.5 py-2 text-xs font-medium text-[var(--text-primary)] hover:bg-[var(--bg-subtle)] hover:text-[var(--accent-primary)] focus:bg-[var(--bg-subtle)] focus:outline-none transition">
                <svg class="w-4 h-4 text-[var(--text-secondary)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/>
                </svg>
                <span>Membership</span>
            </a>

            <!-- 6. Admin (For Admins) -->
            @if($isAdmin)
                <a href="{{ route('admin.dashboard') }}"
                   role="menuitem"
                   tabindex="-1"
                   @click="menuOpen = false"
                   class="flex items-center gap-2.5 px-3.5 py-2 text-xs font-medium text-[var(--text-primary)] hover:bg-[var(--bg-subtle)] hover:text-[var(--accent-primary)] focus:bg-[var(--bg-subtle)] focus:outline-none transition">
                    <svg class="w-4 h-4 text-[var(--text-secondary)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z"/>
                    </svg>
                    <span>Admin</span>
                </a>
            @endif

            <!-- 7. Help -->
            <a href="{{ route('contact') }}"
               role="menuitem"
               tabindex="-1"
               @click="menuOpen = false"
               class="flex items-center gap-2.5 px-3.5 py-2 text-xs font-medium text-[var(--text-primary)] hover:bg-[var(--bg-subtle)] hover:text-[var(--accent-primary)] focus:bg-[var(--bg-subtle)] focus:outline-none transition">
                <svg class="w-4 h-4 text-[var(--text-secondary)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z"/>
                </svg>
                <span>Help</span>
            </a>
        </div>

        <!-- 8. Divider -->
        <div class="my-1 border-t border-[var(--border-subtle)]"></div>

        <!-- 9. Log Out (Neutral color, not red, with icon) -->
        <div class="p-1">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                        role="menuitem"
                        tabindex="-1"
                        class="w-full flex items-center gap-2.5 px-3 py-2 text-xs font-medium text-[var(--text-secondary)] hover:text-[var(--text-primary)] hover:bg-[var(--bg-subtle)] focus:bg-[var(--bg-subtle)] focus:text-[var(--text-primary)] rounded-[var(--radius-sm)] transition cursor-pointer">
                    <svg class="w-4 h-4 text-[var(--text-secondary)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/>
                    </svg>
                    <span>Log out</span>
                </button>
            </form>
        </div>
    </div>
</div>

