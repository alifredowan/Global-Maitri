@php
    $unreadMessages = Auth::check() ? Auth::user()->unreadMessagesCount() : 0;
@endphp

<nav class="lg:hidden fixed bottom-0 inset-x-0 z-40 bg-[var(--bg-surface)] border-t border-[var(--border-default)] shadow-lg"
     aria-label="Mobile navigation"
     x-data="{
         mobileMsgCount: {{ (int) $unreadMessages }}
     }"
     @sidebar-message-badge-updated.window="mobileMsgCount = $event.detail"
     @new-chat-message.window="mobileMsgCount = mobileMsgCount + 1">
    <div class="grid grid-cols-5 h-14">
        <!-- 1. Discover -->
        <a href="{{ route('discovery.index') }}"
           class="flex flex-col items-center justify-center gap-0.5 text-[11px] font-medium transition {{ request()->routeIs('discovery.*') ? 'text-[var(--accent-primary)] font-bold' : 'text-[var(--text-secondary)] hover:text-[var(--text-primary)]' }}">
            <svg class="w-5 h-5" fill="{{ request()->routeIs('discovery.*') ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
            </svg>
            <span>Discover</span>
        </a>

        <!-- 2. Interests -->
        <a href="{{ route('interests.index') }}"
           class="flex flex-col items-center justify-center gap-0.5 text-[11px] font-medium transition {{ request()->routeIs('interests.*') ? 'text-[var(--accent-primary)] font-bold' : 'text-[var(--text-secondary)] hover:text-[var(--text-primary)]' }}">
            <svg class="w-5 h-5" fill="{{ request()->routeIs('interests.*') ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/>
            </svg>
            <span>Interests</span>
        </a>

        <!-- 3. Messages (with badge) -->
        <a href="{{ route('chat.index') }}"
           class="relative flex flex-col items-center justify-center gap-0.5 text-[11px] font-medium transition {{ request()->routeIs('chat.*') ? 'text-[var(--accent-primary)] font-bold' : 'text-[var(--text-secondary)] hover:text-[var(--text-primary)]' }}">
            <div class="relative">
                <svg class="w-5 h-5" fill="{{ request()->routeIs('chat.*') ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v6.01z"/>
                </svg>
                <span x-show="mobileMsgCount > 0"
                      x-text="mobileMsgCount > 9 ? '9+' : mobileMsgCount"
                      x-cloak
                      class="absolute -top-1 -right-2.5 w-4 h-4 rounded-full bg-[var(--color-blessing)] text-white text-[9px] font-bold flex items-center justify-center ring-2 ring-[var(--bg-surface)]">
                </span>
            </div>
            <span>Messages</span>
        </a>

        <!-- 4. Shortlist -->
        <a href="{{ route('bookmarks.index') }}"
           class="flex flex-col items-center justify-center gap-0.5 text-[11px] font-medium transition {{ request()->routeIs('bookmarks.*') ? 'text-[var(--accent-primary)] font-bold' : 'text-[var(--text-secondary)] hover:text-[var(--text-primary)]' }}">
            <svg class="w-5 h-5" fill="{{ request()->routeIs('bookmarks.*') ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/>
            </svg>
            <span>Shortlist</span>
        </a>

        <!-- 5. Profile -->
        <a href="{{ route('profile.show') }}"
           class="flex flex-col items-center justify-center gap-0.5 text-[11px] font-medium transition {{ request()->routeIs('profile.*') ? 'text-[var(--accent-primary)] font-bold' : 'text-[var(--text-secondary)] hover:text-[var(--text-primary)]' }}">
            <svg class="w-5 h-5" fill="{{ request()->routeIs('profile.*') ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
            </svg>
            <span>Profile</span>
        </a>
    </div>
</nav>

