@extends('layouts.app')

@section('title', 'Family Representative Invitation - Global Maitri')

@section('content')
<div class="py-12 bg-[var(--bg-canvas)] min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8 transition-colors">
    <div class="max-w-2xl w-full space-y-6">

        <!-- Header Banner -->
        <div class="text-center space-y-2">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-[4px] text-xs font-semibold bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] border border-[var(--accent-primary)]/20">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                <span>Buddhist Matrimonial Family Guidance (Kalyāṇa-Mitta)</span>
            </span>
            <p class="font-serif text-lg sm:text-xl text-[var(--accent-primary)] font-semibold">Namo Buddhaya</p>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[var(--text-primary)] font-heading">
                Family Representative &amp; Kalyāṇa-Mitta Connection Request
            </h1>
            <p class="text-xs sm:text-sm text-[var(--text-secondary)] max-w-lg mx-auto">
                You have been invited to act as a Family Representative &amp; Kalyāṇa-Mitta (Noble Spiritual Guide &amp; Family Mentor) on <strong class="text-[var(--text-primary)]">Global Maitri</strong>.
            </p>
        </div>

        <!-- Main Card -->
        <div class="card-ledger p-6 sm:p-8 space-y-6">

            <!-- Seeker Profile Preview -->
            <div class="flex flex-col sm:flex-row items-center gap-5 p-5 rounded-[4px] bg-[var(--bg-subtle)] border border-[var(--border-default)]">
                <div class="relative w-20 h-20 rounded-[4px] overflow-hidden bg-[#141412] flex items-center justify-center text-3xl font-bold text-[#e0b84c] border border-[var(--border-default)] shrink-0">
                    @if($link->seeker->profile?->primaryPhoto)
                        <img src="{{ $link->seeker->profile->primaryPhoto->displayUrl() }}" alt="{{ $link->seeker->name }}" class="w-full h-full object-cover" loading="lazy" decoding="async">
                    @else
                        {{ strtoupper(substr($link->seeker->name, 0, 1)) }}
                    @endif
                </div>

                <div class="text-center sm:text-left flex-1 min-w-0">
                    <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2 mb-1">
                        <h2 class="text-lg font-bold text-[var(--text-primary)] font-heading truncate">{{ $link->seeker->name }}</h2>
                        <span class="px-2.5 py-0.5 rounded-[4px] text-[11px] font-semibold bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] border border-[var(--accent-primary)]/20">
                            {{ ucfirst($link->seeker->gender) }}
                        </span>
                        @if($link->seeker->profile?->age)
                            <span class="px-2.5 py-0.5 rounded-[4px] text-[11px] font-medium bg-[var(--bg-canvas)] text-[var(--text-secondary)] border border-[var(--border-default)]">
                                {{ $link->seeker->profile->age }} yrs old
                            </span>
                        @endif
                    </div>

                    <p class="text-xs text-[var(--text-secondary)]">
                        Designated Relationship:
                        <strong class="text-[var(--accent-primary)] uppercase tracking-wide font-bold">
                            {{ ucfirst(str_replace('_', ' ', $link->relationship_type)) }}
                        </strong>
                    </p>

                    @if($link->seeker->profile?->city || $link->seeker->profile?->country)
                        <p class="text-[11px] text-[var(--text-muted)] mt-0.5 flex items-center justify-center sm:justify-start gap-1">
                            <svg class="w-3.5 h-3.5 text-[var(--text-muted)] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>{{ $link->seeker->profile->city ? $link->seeker->profile->city . ', ' : '' }}{{ $link->seeker->profile->country ?? '' }}</span>
                        </p>
                    @endif
                </div>
            </div>

            <!-- Permission & Role Details -->
            <div class="space-y-3">
                <h3 class="text-xs font-bold uppercase tracking-wider text-[var(--text-secondary)]">Representative Privileges &amp; Supervision Level</h3>
                <div class="p-4 rounded-[4px] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-xs space-y-2.5">
                    <div class="flex items-start gap-2.5">
                        <svg class="w-4 h-4 text-[var(--accent-primary)] shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v4a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <div>
                            <span class="font-bold text-[var(--text-primary)]">Permission Level:</span>
                            <span class="text-[var(--text-secondary)] ml-1">
                                @if($link->permission_level === 'approve_required')
                                    <strong>Approval Required</strong> — Suitors cannot chat with {{ $link->seeker->name }} until you review and grant explicit approval.
                                @elseif($link->permission_level === 'full_proxy')
                                    <strong>Full Proxy</strong> — You manage incoming communications and represent {{ $link->seeker->name }} in discussions.
                                @else
                                    <strong>Observer / View Only</strong> — You are automatically added as an elder observer in conversations.
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="flex items-start gap-2.5">
                        <svg class="w-4 h-4 text-[var(--accent-primary)] shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <div>
                            <span class="font-bold text-[var(--text-primary)]">Representative Email:</span>
                            <span class="text-[var(--text-secondary)] ml-1">{{ $link->wali_email ?: 'Not specified' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Buddhist Family Principle Note -->
            <div class="p-4 rounded-[4px] bg-[var(--accent-primary)]/5 border border-[var(--accent-primary)]/20 text-xs text-[var(--text-secondary)] space-y-1.5">
                <p class="font-semibold text-[var(--accent-primary)] flex items-center gap-1.5">
                    <x-application-logo class="w-3.5 h-3.5 text-[var(--accent-primary)] shrink-0" />
                    Blessing of the Elders (Mangala Sutta)
                </p>
                <p class="italic text-[var(--text-primary)]">
                    &ldquo;Honoring those who are worthy of honor — this is the supreme blessing.&rdquo;
                </p>
                <p class="text-[11px] text-[var(--text-muted)]">
                    Global Maitri honors the role of parents and respected elders in fostering mindful, harmonious marriages.
                </p>
            </div>

            <!-- Action Status / Buttons -->
            @if($link->status === 'active')
                <div class="p-4 rounded-[4px] bg-[var(--bg-subtle)] border border-[var(--color-success)] text-center space-y-2">
                    <svg class="w-8 h-8 text-[var(--color-success)] mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h4 class="text-sm font-bold text-[var(--color-success)]">Representative Connection Active</h4>
                    <p class="text-xs text-[var(--text-secondary)]">
                        You are active as the verified family representative for {{ $link->seeker->name }}.
                    </p>
                    <div class="pt-2">
                        <a href="{{ route('wali.dashboard') }}" class="btn-primary inline-flex items-center justify-center gap-2 text-xs py-2.5 px-5">
                            Go to Representative Dashboard &rarr;
                        </a>
                    </div>
                </div>
            @elseif($link->status === 'declined')
                <div class="p-4 rounded-[4px] bg-[var(--bg-subtle)] border border-[var(--color-danger)] text-center space-y-1">
                    <svg class="w-8 h-8 text-[var(--color-danger)] mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h4 class="text-sm font-bold text-[var(--color-danger)]">Connection Declined</h4>
                    <p class="text-xs text-[var(--text-secondary)]">
                        This family representative connection request was declined.
                    </p>
                </div>
            @else
                <div class="space-y-3 pt-2">
                    <form action="{{ route('wali.invite.accept', $link->invite_token) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-primary w-full py-3.5 px-6 text-sm font-bold flex items-center justify-center gap-2 cursor-pointer" style="min-height: 48px;">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            <span>Accept & Confirm Family Connection</span>
                        </button>
                    </form>

                    <form action="{{ route('wali.invite.decline', $link->invite_token) }}" method="POST">
                        @csrf
                        <button type="submit" onclick="return confirm('Are you sure you want to decline this connection request?');" class="btn-secondary w-full py-2.5 px-4 text-xs font-semibold text-[var(--text-secondary)] hover:text-[var(--color-danger)] cursor-pointer text-center">
                            Decline Request
                        </button>
                    </form>
                </div>
            @endif

        </div>

        <!-- Footer Help -->
        <p class="text-center text-xs text-[var(--text-muted)]">
            Need help? Reach out to our family support team at <a href="mailto:info@globalmaitri.com" class="text-[var(--accent-primary)] hover:underline">info@globalmaitri.com</a>
        </p>

    </div>
</div>
@endsection
