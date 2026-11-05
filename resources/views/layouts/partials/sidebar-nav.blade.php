@php
    $user = Auth::user();
    $isSuperAdmin = $user->isSuperAdmin();
    $isAdminOrStaff = $user->isAdmin() || $user->isModerator();
    $pendingInterests = $user->isSeeker() ? $user->receivedInterests()->where('status', 'pending')->count() : 0;
    $pendingVerifications = $isAdminOrStaff ? \App\Models\VerificationRequest::where('status', 'pending')->count() : 0;
    $pendingReports = $isAdminOrStaff ? \App\Models\Report::where('status', 'pending')->count() : 0;
    $unreadMessages = $user->unreadMessagesCount();
    $pendingMarriage = $user->pendingMarriage();
@endphp

<div class="space-y-6">

    {{-- ========================================================= --}}
    {{-- 1. SUPER ADMIN & STAFF CONSOLE                            --}}
    {{-- ========================================================= --}}
    @if($isAdminOrStaff)
        <div>
            <div class="px-3 mb-2 text-[10px] font-bold uppercase tracking-wider text-[var(--accent-primary)] dark:text-[#f0c550] flex items-center justify-between">
                <span>Admin Control</span>
                <span class="text-[9px] px-1.5 py-0.5 rounded-[var(--radius-xs)] bg-[var(--accent-subtle)] text-[var(--accent-text)] dark:bg-[#2b2310] dark:text-[#f0c550] font-bold uppercase">
                    {{ $isSuperAdmin ? 'Super Admin' : 'Staff' }}
                </span>
            </div>
            <div class="space-y-0.5">
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-[var(--radius-sm)] text-xs transition {{ request()->routeIs('admin.dashboard') ? 'bg-[#26241c] text-[#f0c550] border-l-2 border-[var(--accent-primary)] font-semibold' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white font-medium' }}">
                    <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="9"/><rect x="14" y="3" width="7" height="5"/><rect x="14" y="12" width="7" height="9"/><rect x="3" y="16" width="7" height="5"/></svg>
                    <span class="flex-1">Dashboard Overview</span>
                </a>

                @if($isSuperAdmin || $user->hasPermission('manage_verifications'))
                    <a href="{{ route('admin.verifications') }}"
                       class="flex items-center justify-between px-3 py-2 rounded-[var(--radius-sm)] text-xs transition {{ request()->routeIs('admin.verifications') ? 'bg-[#26241c] text-[#f0c550] border-l-2 border-[var(--accent-primary)] font-semibold' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white font-medium' }}">
                        <div class="flex items-center gap-3">
                            <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="16" rx="2"/><circle cx="9" cy="10" r="2"/><line x1="15" y1="8" x2="17" y2="8"/><line x1="15" y1="12" x2="17" y2="12"/><line x1="7" y1="16" x2="17" y2="16"/></svg>
                            <span>ID Verification Queue</span>
                        </div>
                        @if($pendingVerifications > 0)
                            <span class="px-1.5 py-0.2 rounded-[var(--radius-xs)] text-[10px] font-bold bg-[var(--color-danger)] text-white">
                                {{ $pendingVerifications }}
                            </span>
                        @endif
                    </a>
                @endif

                @if($isSuperAdmin || $user->hasPermission('manage_reports'))
                    <a href="{{ route('admin.reports') }}"
                       class="flex items-center justify-between px-3 py-2 rounded-[var(--radius-sm)] text-xs transition {{ request()->routeIs('admin.reports') ? 'bg-[#26241c] text-[#f0c550] border-l-2 border-[var(--accent-primary)] font-semibold' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white font-medium' }}">
                        <div class="flex items-center gap-3">
                            <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                            <span>Abuse & Safety Reports</span>
                        </div>
                        @if($pendingReports > 0)
                            <span class="px-1.5 py-0.2 rounded-[var(--radius-xs)] text-[10px] font-bold bg-[var(--color-warning)] text-white">
                                {{ $pendingReports }}
                            </span>
                        @endif
                    </a>
                @endif
            </div>
        </div>

        <!-- PLANS & PROMO ENGINE -->
        @if($isSuperAdmin || $user->hasPermission('manage_settings'))
            <div>
                <div class="px-3 mb-2 text-[10px] font-bold uppercase tracking-wider text-slate-400">
                    Plans & Discounts
                </div>
                <div class="space-y-0.5">
                    <a href="{{ route('admin.packages.index') }}"
                       class="flex items-center gap-3 px-3 py-2 rounded-[var(--radius-sm)] text-xs transition {{ request()->routeIs('admin.packages.*') ? 'bg-[#26241c] text-[#f0c550] border-l-2 border-[var(--accent-primary)] font-semibold' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white font-medium' }}">
                        <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 3h12l4 6-10 12L2 9Z"/><path d="M11 3 8 9l4 12 4-12-3-6"/><path d="M2 9h20"/></svg>
                        <span class="flex-1">Dynamic Packages</span>
                    </a>

                    <a href="{{ route('admin.promo-codes.index') }}"
                       class="flex items-center gap-3 px-3 py-2 rounded-[var(--radius-sm)] text-xs transition {{ request()->routeIs('admin.promo-codes.*') ? 'bg-[#26241c] text-[#f0c550] border-l-2 border-[var(--accent-primary)] font-semibold' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white font-medium' }}">
                        <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/><path d="M13 5v2"/><path d="M13 17v2"/><path d="M13 11v2"/></svg>
                        <span class="flex-1">Promo Codes</span>
                    </a>

                    <a href="{{ route('admin.payment-settings') }}"
                       class="flex items-center gap-3 px-3 py-2 rounded-[var(--radius-sm)] text-xs transition {{ request()->routeIs('admin.payment-settings*') ? 'bg-[#26241c] text-[#f0c550] border-l-2 border-[var(--accent-primary)] font-semibold' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white font-medium' }}">
                        <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
                        <span class="flex-1">Payment Gateways</span>
                    </a>
                </div>
            </div>
        @endif

        <!-- GOVERNANCE & AUDIT -->
        <div>
            <div class="px-3 mb-2 text-[10px] font-bold uppercase tracking-wider text-slate-400">
                Governance
            </div>
            <div class="space-y-0.5">
                @if($isSuperAdmin)
                    <a href="{{ route('admin.staff') }}"
                       class="flex items-center gap-3 px-3 py-2 rounded-[var(--radius-sm)] text-xs transition {{ request()->routeIs('admin.staff') ? 'bg-[#26241c] text-[#f0c550] border-l-2 border-[var(--accent-primary)] font-semibold' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white font-medium' }}">
                        <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        <span class="flex-1">Staff & Permissions</span>
                    </a>
                @endif

                @if($isSuperAdmin || $user->hasPermission('view_audit_logs'))
                    <a href="{{ route('admin.audit-logs') }}"
                       class="flex items-center gap-3 px-3 py-2 rounded-[var(--radius-sm)] text-xs transition {{ request()->routeIs('admin.audit-logs') ? 'bg-[#26241c] text-[#f0c550] border-l-2 border-[var(--accent-primary)] font-semibold' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white font-medium' }}">
                        <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                        <span class="flex-1">Audit Logs</span>
                    </a>
                @endif

                @if($isSuperAdmin || $user->hasPermission('manage_settings'))
                    <a href="{{ route('admin.settings') }}"
                       class="flex items-center gap-3 px-3 py-2 rounded-[var(--radius-sm)] text-xs transition {{ request()->routeIs('admin.settings') ? 'bg-[#26241c] text-[#f0c550] border-l-2 border-[var(--accent-primary)] font-semibold' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white font-medium' }}">
                        <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>
                        <span class="flex-1">Platform Policies</span>
                    </a>
                @endif
            </div>
        </div>
    @endif

    {{-- ========================================================= --}}
    {{-- 2. MATCHMAKING & DISCOVERY                                --}}
    {{-- ========================================================= --}}
    @if($isSuperAdmin || (!$isAdminOrStaff && $user->isSeeker()))
        <div>
            <div class="px-3 mb-2 text-[10px] font-bold uppercase tracking-wider text-slate-400">
                Matchmaking
            </div>
            <div class="space-y-0.5">
                @if(!$isAdminOrStaff)
                    <a href="{{ route('dashboard') }}"
                       class="flex items-center gap-3 px-3 py-2 rounded-[var(--radius-sm)] text-xs transition {{ request()->routeIs('dashboard') ? 'bg-[#26241c] text-[#f0c550] border-l-2 border-[var(--accent-primary)] font-semibold' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white font-medium' }}">
                        <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                        <span class="flex-1">My Dashboard</span>
                    </a>
                @endif

                <a href="{{ route('discovery.index') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-[var(--radius-sm)] text-xs transition {{ request()->routeIs('discovery.*') ? 'bg-[#26241c] text-[#f0c550] border-l-2 border-[var(--accent-primary)] font-semibold' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white font-medium' }}">
                    <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                    <span class="flex-1">Find Matches</span>
                </a>

                <a href="{{ route('interests.index') }}"
                   class="flex items-center justify-between px-3 py-2 rounded-[var(--radius-sm)] text-xs transition {{ request()->routeIs('interests.*') ? 'bg-[#26241c] text-[#f0c550] border-l-2 border-[var(--accent-primary)] font-semibold' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white font-medium' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                        <span>Proposals & Interests</span>
                    </div>
                    @if($pendingInterests > 0)
                        <span class="px-1.5 py-0.2 rounded-[var(--radius-xs)] text-[10px] font-bold bg-[var(--accent-primary)] text-white">
                            {{ $pendingInterests }}
                        </span>
                    @endif
                </a>

                <a href="{{ route('chat.index') }}"
                   class="flex items-center justify-between gap-3 px-3 py-2 rounded-[var(--radius-sm)] text-xs transition {{ request()->routeIs('chat.*') ? 'bg-[#26241c] text-[#f0c550] border-l-2 border-[var(--accent-primary)] font-semibold' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white font-medium' }}">
                    <span class="flex items-center gap-3">
                        <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                        <span>Messages</span>
                    </span>
                    <span class="sidebar-unread-messages-badge rounded-[var(--radius-xs)] bg-[var(--accent-primary)] px-1.5 py-0.2 text-[10px] font-bold text-white {{ $unreadMessages > 0 ? '' : 'hidden' }}">
                        {{ $unreadMessages > 99 ? '99+' : $unreadMessages }}
                    </span>
                </a>

                <a href="{{ route('bookmarks.index') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-[var(--radius-sm)] text-xs transition {{ request()->routeIs('bookmarks.*') ? 'bg-[#26241c] text-[#f0c550] border-l-2 border-[var(--accent-primary)] font-semibold' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white font-medium' }}">
                    <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z"/></svg>
                    <span class="flex-1">Shortlist & Notes</span>
                </a>
            </div>
        </div>
    @endif

    {{-- ========================================================= --}}
    {{-- 3. MY BIODATA & PREFERENCES                               --}}
    {{-- ========================================================= --}}
    @if(!$isAdminOrStaff && $user->isSeeker())
        <div>
            <div class="px-3 mb-2 text-[10px] font-bold uppercase tracking-wider text-slate-400">
                My Biodata
            </div>
            <div class="space-y-0.5">
                <a href="{{ route('profile.show') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-[var(--radius-sm)] text-xs transition {{ request()->routeIs('profile.show') ? 'bg-[#26241c] text-[#f0c550] border-l-2 border-[var(--accent-primary)] font-semibold' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white font-medium' }}">
                    <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    <span class="flex-1">View Biodata & Photos</span>
                </a>

                <a href="{{ route('profile.edit') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-[var(--radius-sm)] text-xs transition {{ request()->routeIs('profile.edit') ? 'bg-[#26241c] text-[#f0c550] border-l-2 border-[var(--accent-primary)] font-semibold' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white font-medium' }}">
                    <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    <span class="flex-1">Edit Dhamma & Practice</span>
                </a>

                <a href="{{ route('profile.biodata') }}"
                   target="_blank"
                   class="flex items-center justify-between px-3 py-2 rounded-[var(--radius-sm)] text-xs font-medium text-slate-300 hover:bg-slate-800/60 hover:text-white transition">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                        <span>Printable Biodata</span>
                    </div>
                    <span class="text-[9px] font-bold text-slate-400 uppercase">PDF</span>
                </a>

                <a href="{{ route('family.link') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-[var(--radius-sm)] text-xs transition {{ request()->routeIs('family.link') || request()->routeIs('wali.link') ? 'bg-[#26241c] text-[#f0c550] border-l-2 border-[var(--accent-primary)] font-semibold' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white font-medium' }}">
                    <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    <span class="flex-1">Link Family Representative</span>
                </a>
            </div>
        </div>
    @endif

    {{-- ========================================================= --}}
    {{-- 4. FAMILY REPRESENTATIVE CONSOLE                          --}}
    {{-- ========================================================= --}}
    @if($isSuperAdmin || (!$isAdminOrStaff && ($user->isFamilyRep() || $user->waliLinksAsWali()->exists())))
        <div>
            <div class="px-3 mb-2 text-[10px] font-bold uppercase tracking-wider text-[var(--accent-primary)] dark:text-[#f0c550] flex items-center justify-between">
                <span>Family Console</span>
                <span class="text-[9px] font-bold px-1.5 py-0.5 rounded-[var(--radius-xs)] bg-[var(--accent-subtle)] text-[var(--accent-text)] dark:bg-[#2b2310] dark:text-[#f0c550]">FREE</span>
            </div>
            <div class="space-y-0.5">
                <a href="{{ route('family.dashboard') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-[var(--radius-sm)] text-xs transition {{ request()->routeIs('family.dashboard') || request()->routeIs('wali.dashboard') ? 'bg-[#26241c] text-[#f0c550] border-l-2 border-[var(--accent-primary)] font-semibold' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white font-medium' }}">
                    <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1" ry="1"/></svg>
                    <span class="flex-1">Family Dashboard</span>
                </a>

                <a href="{{ route('family.link') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-[var(--radius-sm)] text-xs transition {{ request()->routeIs('family.link') || request()->routeIs('wali.link') ? 'bg-[#26241c] text-[#f0c550] border-l-2 border-[var(--accent-primary)] font-semibold' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white font-medium' }}">
                    <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                    <span class="flex-1">Link Candidate Ward</span>
                </a>
            </div>
        </div>
    @endif

    {{-- ========================================================= --}}
    {{-- 5. PLANS & PRO MEMBERSHIP                                 --}}
    {{-- ========================================================= --}}
    @if(($isSuperAdmin || (!$isAdminOrStaff && $user->isSeeker())) && ! $user->isFamilyRep())
        <div>
            <div class="px-3 mb-2 text-[10px] font-bold uppercase tracking-wider text-slate-400">
                Single Marriage Pass
            </div>
            <div class="space-y-0.5">
                @if(!$isAdminOrStaff && $user->isSeeker())
                    <a href="{{ route('profile.visitors') }}"
                       class="flex items-center justify-between px-3 py-2 rounded-[var(--radius-sm)] text-xs transition {{ request()->routeIs('profile.visitors') ? 'bg-[#26241c] text-[#f0c550] border-l-2 border-[var(--accent-primary)] font-semibold' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white font-medium' }}">
                        <div class="flex items-center gap-3">
                            <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                            <span>Who Viewed You</span>
                        </div>
                        <span class="text-[9px] font-bold uppercase px-1.5 py-0.2 rounded-[var(--radius-xs)] bg-[var(--accent-subtle)] text-[var(--accent-text)] dark:bg-[#2b2310] dark:text-[#f0c550]">PRO</span>
                    </a>
                @endif

                <a href="{{ route('subscription.pricing') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-[var(--radius-sm)] text-xs transition {{ request()->routeIs('subscription.pricing') ? 'bg-[#26241c] text-[#f0c550] border-l-2 border-[var(--accent-primary)] font-semibold' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white font-medium' }}">
                    <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 3h12l4 6-10 12L2 9Z"/><path d="M11 3 8 9l4 12 4-12-3-6"/></svg>
                    <span class="flex-1">Plans & Pricing</span>
                </a>

                @if($user->isMarried() || $pendingMarriage)
                    <a href="{{ route('marriages.celebration') }}"
                       class="flex items-center justify-between px-3 py-2 rounded-[var(--radius-sm)] text-xs font-semibold transition {{ request()->routeIs('marriages.*') ? 'bg-[#26241c] text-[#f0c550] border-l-2 border-[var(--accent-primary)] font-semibold' : 'text-slate-300 hover:bg-slate-800/60' }}">
                        <div class="flex items-center gap-3">
                            <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                            <span>Mangala Vivaha</span>
                        </div>
                        <span class="text-[9px] font-bold uppercase px-1.5 py-0.2 rounded-[var(--radius-xs)] {{ $pendingMarriage ? 'bg-[var(--color-warning)] text-white' : 'bg-[var(--color-success)] text-white' }}">
                            {{ $pendingMarriage ? 'Pending' : 'Blessed' }}
                        </span>
                    </a>
                @endif
            </div>
        </div>
    @endif

    {{-- ========================================================= --}}
    {{-- 6. GENERAL ACCOUNT SETTINGS                               --}}
    {{-- ========================================================= --}}
    <div>
        <div class="px-3 mb-2 text-[10px] font-bold uppercase tracking-wider text-slate-400">
            Account & System
        </div>
        <div class="space-y-0.5">
            <a href="{{ route('settings.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-[var(--radius-sm)] text-xs transition {{ request()->routeIs('settings.*') ? 'bg-[#26241c] text-[#f0c550] border-l-2 border-[var(--accent-primary)] font-semibold' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white font-medium' }}">
                <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                <span class="flex-1">Account Settings</span>
            </a>

            @if(!$isAdminOrStaff && $user->isSeeker())
                <a href="{{ route('blocked-users.index') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-[var(--radius-sm)] text-xs transition {{ request()->routeIs('blocked-users.*') ? 'bg-[#26241c] text-[#f0c550] border-l-2 border-[var(--accent-primary)] font-semibold' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white font-medium' }}">
                    <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/></svg>
                    <span class="flex-1">Blocked Profiles</span>
                </a>
            @endif

            <a href="{{ route('landing') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-[var(--radius-sm)] text-xs font-medium text-slate-400 hover:bg-slate-800/60 hover:text-white transition">
                <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" x2="22" y1="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                <span class="flex-1">Public Home</span>
            </a>
        </div>
    </div>

</div>
