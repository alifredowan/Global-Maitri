@php
    $unreadNotifications = Auth::check() ? Auth::user()->unreadNotifications->count() : 0;
@endphp

<div class="relative inline-flex"
     x-data="{
         notifOpen: false,
         currentTab: 'all',
         unreadCount: {{ (int) $unreadNotifications }},
         notifications: [],
         loading: false,
         fetchNotifications(silent = false) {
             if (!silent) this.loading = true;
             fetch('{{ route('notifications.index') }}', {
                 headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
             })
             .then(res => res.json())
             .then(data => {
                 this.notifications = data.notifications || [];
                 this.unreadCount = data.unread_count || 0;
                 if (!silent) this.loading = false;
                 if (typeof data.unread_messages_count !== 'undefined') {
                     window.dispatchEvent(new CustomEvent('sidebar-message-badge-updated', { detail: data.unread_messages_count }));
                 }
             })
             .catch(() => { if (!silent) this.loading = false; });
         },
         markAsRead(id, url) {
             fetch('/notifications/' + id + '/read', {
                 method: 'POST',
                 headers: {
                     'X-CSRF-TOKEN': '{{ csrf_token() }}',
                     'Accept': 'application/json',
                     'X-Requested-With': 'XMLHttpRequest'
                 }
             })
             .then(res => res.json())
             .then(data => {
                 this.unreadCount = data.unread_count;
                 const n = this.notifications.find(item => item.id === id);
                 if (n) n.read_at = new Date().toISOString();
                 if (url) window.location.href = url;
             });
         },
         markAllRead() {
             fetch('{{ route('notifications.read-all') }}', {
                 method: 'POST',
                 headers: {
                     'X-CSRF-TOKEN': '{{ csrf_token() }}',
                     'Accept': 'application/json',
                     'X-Requested-With': 'XMLHttpRequest'
                 }
             })
             .then(res => res.json())
             .then(data => {
                 this.unreadCount = 0;
                 this.notifications.forEach(n => n.read_at = new Date().toISOString());
             });
         },
         get filteredList() {
             if (this.currentTab === 'all') return this.notifications;
             if (this.currentTab === 'interests') {
                 return this.notifications.filter(n => {
                     const t = (n.data?.type || '').toLowerCase();
                     return t.includes('interest') || n.data?.interest_id;
                 });
             }
             if (this.currentTab === 'messages') {
                 return this.notifications.filter(n => {
                     const t = (n.data?.type || '').toLowerCase();
                     return t.includes('message') || t.includes('chat') || n.data?.conversation_id;
                 });
             }
             if (this.currentTab === 'family') {
                 return this.notifications.filter(n => {
                     const t = (n.data?.type || '').toLowerCase();
                     const title = (n.data?.title || '').toLowerCase();
                     return t.includes('wali') || t.includes('family') || title.includes('family') || title.includes('chaperon');
                 });
             }
             return this.notifications;
         }
     }"
     x-init="fetchNotifications(); setInterval(() => fetchNotifications(true), 6000);"
     @new-notification-received.window="unreadCount = Math.max(unreadCount + 1, 1); notifications.unshift($event.detail); if(notifications.length > 25) notifications.pop();"
     @click.outside="notifOpen = false"
     @keydown.escape.window="notifOpen = false">

    <!-- Bell Trigger Button (44x44px hit area, 22px icon) -->
    <button type="button"
            @click="notifOpen = !notifOpen; if (notifOpen) { fetchNotifications(); }"
            title="Notifications"
            aria-label="Notifications"
            aria-haspopup="dialog"
            :aria-expanded="notifOpen"
            class="relative w-11 h-11 flex items-center justify-center rounded-full text-[var(--text-secondary)] hover:text-[var(--text-primary)] hover:bg-[var(--bg-subtle)] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[var(--accent-primary)] focus-visible:ring-offset-2 transition-colors cursor-pointer"
            :class="notifOpen ? 'bg-[var(--bg-subtle)] text-[var(--accent-primary)]' : ''">
        <svg class="w-[22px] h-[22px]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/>
        </svg>

        <!-- Unread badge -->
        <span x-show="unreadCount > 0"
              x-text="unreadCount > 9 ? '9+' : unreadCount"
              x-cloak
              aria-label="Unread notifications: "
              :aria-label="'Unread notifications: ' + unreadCount"
              class="absolute top-1.5 right-1.5 w-[18px] h-[18px] rounded-full bg-[var(--accent-primary)] text-white text-[10px] font-bold flex items-center justify-center ring-2 ring-[var(--bg-surface)] pointer-events-none select-none">
        </span>

        <span x-show="notifOpen" class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-4 h-0.5 rounded-full bg-[var(--accent-primary)]" aria-hidden="true"></span>
    </button>

    <!-- Notification Panel: 360px wide desktop, full-screen sheet on mobile -->
    <div x-show="notifOpen"
         x-cloak
         x-transition:enter="transition ease-out duration-150"
         x-transition:enter-start="opacity-0 scale-95 translate-y-1"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         x-transition:leave="transition ease-in duration-100"
         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
         x-transition:leave-end="opacity-0 scale-95 translate-y-1"
         role="dialog"
         aria-label="Notifications panel"
         class="fixed inset-x-0 bottom-0 z-50 sm:absolute sm:inset-x-auto sm:right-0 sm:bottom-auto sm:top-full sm:mt-2 w-full sm:w-[360px] max-h-[85vh] sm:max-h-[70vh] bg-[var(--bg-surface)] border border-[var(--border-default)] rounded-t-2xl sm:rounded-lg shadow-xl flex flex-col overflow-hidden">

        <!-- Panel Header -->
        <div class="px-4 py-3 border-b border-[var(--border-subtle)] flex items-center justify-between shrink-0">
            <div class="flex items-center gap-2">
                <h3 class="font-heading text-sm font-bold text-[var(--text-primary)]">Notifications</h3>
                <span x-show="unreadCount > 0"
                      x-text="unreadCount + ' new'"
                      class="px-2 py-0.5 text-[10px] font-semibold rounded-full bg-[var(--accent-subtle)] text-[var(--accent-primary)] border border-[var(--border-default)]">
                </span>
            </div>
            <div class="flex items-center gap-3">
                <button type="button"
                        x-show="unreadCount > 0"
                        @click="markAllRead()"
                        class="text-xs font-medium text-[var(--accent-primary)] hover:underline cursor-pointer">
                    Mark all as read
                </button>
                <button type="button"
                        @click="notifOpen = false"
                        class="sm:hidden p-1 text-[var(--text-muted)] hover:text-[var(--text-primary)]"
                        aria-label="Close notifications">
                    &times;
                </button>
            </div>
        </div>

        <!-- Filter Tabs: All / Interests / Messages / Family -->
        <div class="px-3 pt-2 border-b border-[var(--border-subtle)] flex items-center gap-1 shrink-0 bg-[var(--bg-canvas)]">
            <button type="button"
                    @click="currentTab = 'all'"
                    class="px-2.5 py-1.5 text-xs font-semibold rounded-md transition"
                    :class="currentTab === 'all' ? 'bg-[var(--bg-surface)] text-[var(--text-primary)] shadow-2xs' : 'text-[var(--text-secondary)] hover:text-[var(--text-primary)]'">
                All
            </button>
            <button type="button"
                    @click="currentTab = 'interests'"
                    class="px-2.5 py-1.5 text-xs font-semibold rounded-md transition"
                    :class="currentTab === 'interests' ? 'bg-[var(--bg-surface)] text-[var(--text-primary)] shadow-2xs' : 'text-[var(--text-secondary)] hover:text-[var(--text-primary)]'">
                Interests
            </button>
            <button type="button"
                    @click="currentTab = 'messages'"
                    class="px-2.5 py-1.5 text-xs font-semibold rounded-md transition"
                    :class="currentTab === 'messages' ? 'bg-[var(--bg-surface)] text-[var(--text-primary)] shadow-2xs' : 'text-[var(--text-secondary)] hover:text-[var(--text-primary)]'">
                Messages
            </button>
            <button type="button"
                    @click="currentTab = 'family'"
                    class="px-2.5 py-1.5 text-xs font-semibold rounded-md transition"
                    :class="currentTab === 'family' ? 'bg-[var(--bg-surface)] text-[var(--text-primary)] shadow-2xs' : 'text-[var(--text-secondary)] hover:text-[var(--text-primary)]'">
                Family
            </button>
        </div>

        <!-- Notifications List -->
        <div class="flex-1 overflow-y-auto divide-y divide-[var(--border-subtle)]">
            <div x-show="loading" class="p-6 text-center text-xs text-[var(--text-muted)]">
                Loading notifications...
            </div>

            <template x-for="item in filteredList" :key="item.id">
                <div @click="markAsRead(item.id, item.data?.action_url || item.data?.url)"
                     class="p-3.5 hover:bg-[var(--bg-subtle)] transition flex items-start gap-3 cursor-pointer group"
                     :class="{ 'bg-[var(--accent-subtle)]/30': !item.read_at }">
                    <div class="w-8 h-8 rounded-full bg-[var(--bg-subtle)] border border-[var(--border-default)] flex items-center justify-center text-sm shrink-0 text-[var(--accent-primary)]">
                        <span x-text="item.data?.icon || '🔔'"></span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between gap-2">
                            <h4 class="text-xs font-semibold text-[var(--text-primary)] truncate group-hover:text-[var(--accent-primary)] transition"
                                x-text="item.data?.title || 'Notification'">
                            </h4>
                            <div class="flex items-center gap-1.5 shrink-0">
                                <span class="text-[10px] text-[var(--text-muted)]" x-text="item.created_at"></span>
                                <span x-show="!item.read_at" class="w-1.5 h-1.5 rounded-full bg-[var(--accent-primary)] shrink-0" aria-label="Unread"></span>
                            </div>
                        </div>
                        <p class="text-xs text-[var(--text-secondary)] mt-0.5 line-clamp-2 leading-relaxed"
                           x-text="item.data?.message">
                        </p>
                    </div>
                </div>
            </template>

            <!-- Friendly Empty State -->
            <div x-show="!loading && filteredList.length === 0" class="py-12 px-4 text-center space-y-2">
                <div class="w-10 h-10 mx-auto rounded-full bg-[var(--bg-subtle)] text-[var(--accent-primary)] flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <p class="text-xs font-semibold text-[var(--text-primary)]">All quiet</p>
                <p class="text-[11px] text-[var(--text-muted)] max-w-xs mx-auto">
                    No new notifications in this category. We will let you know when someone interacts with your profile.
                </p>
            </div>
        </div>

        <!-- Footer Link -->
        <div class="px-4 py-2.5 bg-[var(--bg-canvas)] border-t border-[var(--border-subtle)] text-center shrink-0">
            <a href="{{ route('notifications.index') }}"
               @click="notifOpen = false"
               class="text-xs font-semibold text-[var(--text-secondary)] hover:text-[var(--accent-primary)] transition">
                View all notifications &rarr;
            </a>
        </div>
    </div>
</div>

