@php
    $unreadMessages = Auth::check() ? Auth::user()->unreadMessagesCount() : 0;
    $isActive = request()->routeIs('chat.*');
@endphp

<div class="relative inline-flex"
     x-data="{
         messageCount: {{ (int) $unreadMessages }}
     }"
     @sidebar-message-badge-updated.window="messageCount = $event.detail"
     @new-chat-message.window="messageCount = messageCount + 1">
    <a href="{{ route('chat.index') }}"
       title="Messages"
       aria-label="Messages"
       class="relative w-11 h-11 flex items-center justify-center rounded-full text-[var(--text-secondary)] hover:text-[var(--text-primary)] hover:bg-[var(--bg-subtle)] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[var(--accent-primary)] focus-visible:ring-offset-2 transition-colors {{ $isActive ? 'text-[var(--accent-primary)] font-semibold' : '' }}">
        <svg class="w-[22px] h-[22px]" fill="{{ $isActive ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v6.01z"/>
        </svg>

        <!-- Unread badge -->
        <span x-show="messageCount > 0"
              x-text="messageCount > 9 ? '9+' : messageCount"
              x-cloak
              aria-label="Unread messages: "
              :aria-label="'Unread messages: ' + messageCount"
              class="absolute top-1.5 right-1.5 w-[18px] h-[18px] rounded-full bg-[var(--accent-primary)] text-white text-[10px] font-bold flex items-center justify-center ring-2 ring-[var(--bg-surface)] pointer-events-none select-none">
        </span>

        @if($isActive)
            <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-4 h-0.5 rounded-full bg-[var(--accent-primary)]" aria-hidden="true"></span>
        @endif
    </a>
</div>

