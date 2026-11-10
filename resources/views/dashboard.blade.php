@extends('layouts.app')

@section('title', 'My Matrimonial Dashboard - Global Maitri')

@section('content')
<div class="min-h-screen bg-[var(--bg-canvas)] py-6">
    <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">

        <!-- 1. Framed Hero Banner -->
        <section class="card-hero relative overflow-hidden rounded-[var(--radius-xl)] bg-[var(--bg-surface)] border border-[var(--border-default)] p-6 sm:p-8 shadow-xs">
            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="max-w-2xl space-y-2">
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-[var(--radius-sm)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] text-xs font-bold uppercase tracking-wider">
                        <x-application-logo class="w-3.5 h-3.5 text-[var(--accent-primary)] shrink-0" />
                        <span>May you be happy and well, {{ $user->name }}</span>
                    </div>
                    <h1 class="font-heading text-2xl sm:text-3xl font-extrabold text-[var(--text-primary)] tracking-tight">
                        Your path to a harmonious lifelong union, in one place.
                    </h1>
                    <p class="text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed max-w-xl">
                        A serene, dignified overview of your matrimonial readiness, family elder consultation, and Dhamma-compatible recommendations.
                    </p>
                </div>

                <!-- Readiness Pill & Primary Search CTA -->
                <div class="flex items-center gap-3 shrink-0 flex-wrap sm:flex-nowrap">
                    <div class="flex items-center gap-3 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-subtle)] px-4 py-2.5 shadow-xs">
                        <div class="flex h-10 w-10 items-center justify-center rounded-[var(--radius-sm)] bg-[var(--accent-primary)] text-sm font-extrabold text-white">
                            {{ $profile->completeness_percentage }}%
                        </div>
                        <div>
                            <p class="text-xs font-bold text-[var(--text-primary)]">Dhamma Readiness</p>
                            <p class="text-[11px] text-[var(--text-muted)]">{{ $profile->completeness_percentage >= 70 ? 'High Discovery Ready' : 'Needs More Details' }}</p>
                        </div>
                    </div>
                    <a href="{{ route('discovery.index') }}" class="btn-primary text-xs !py-3 !px-5 flex items-center gap-2 shrink-0">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                        <span>Find Matches</span>
                    </a>
                </div>
            </div>
        </section>

        <!-- 2. Clean Executive Metrics Ledger Grid -->
        <section class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('interests.index') }}" class="card-ledger p-5 bg-[var(--bg-surface)] border border-[var(--border-default)] hover:border-[var(--accent-primary)] transition flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-[var(--text-muted)] uppercase tracking-wider">Pending Proposals</span>
                    <span class="w-8 h-8 rounded-[var(--radius-sm)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] flex items-center justify-center text-xs">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
                    </span>
                </div>
                <div class="mt-4 flex items-baseline justify-between">
                    <span class="font-heading text-3xl font-extrabold text-[var(--text-primary)]">{{ $pendingInterests }}</span>
                    <span class="text-xs font-bold text-[var(--accent-primary)]">Review requests &rarr;</span>
                </div>
            </a>

            <a href="{{ route('chat.index') }}" class="card-ledger p-5 bg-[var(--bg-surface)] border border-[var(--border-default)] hover:border-[var(--accent-primary)] transition flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-[var(--text-muted)] uppercase tracking-wider">Messages</span>
                    <span class="w-8 h-8 rounded-[var(--radius-sm)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] flex items-center justify-center text-xs">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    </span>
                </div>
                <div class="mt-4 flex items-baseline justify-between">
                    <span class="font-heading text-3xl font-extrabold text-[var(--text-primary)]">{{ $unreadMessages }}</span>
                    <span class="text-xs font-bold text-[var(--accent-primary)]">{{ $conversationCount }} Active chats &rarr;</span>
                </div>
            </a>

            <a href="{{ route('notifications.index') }}" class="card-ledger p-5 bg-[var(--bg-surface)] border border-[var(--border-default)] hover:border-[var(--accent-primary)] transition flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-[var(--text-muted)] uppercase tracking-wider">Updates</span>
                    <span class="w-8 h-8 rounded-[var(--radius-sm)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] flex items-center justify-center text-xs">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                    </span>
                </div>
                <div class="mt-4 flex items-baseline justify-between">
                    <span class="font-heading text-3xl font-extrabold text-[var(--text-primary)]">{{ $unreadNotifications }}</span>
                    <span class="text-xs font-bold text-[var(--accent-primary)]">Activity &rarr;</span>
                </div>
            </a>

            <a href="{{ route('discovery.index') }}" class="card-ledger p-5 bg-[var(--bg-surface)] border border-[var(--border-default)] hover:border-[var(--accent-primary)] transition flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-[var(--text-muted)] uppercase tracking-wider">Daily Views</span>
                    <span class="w-8 h-8 rounded-[var(--radius-sm)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] flex items-center justify-center text-xs">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                    </span>
                </div>
                <div class="mt-4 flex items-baseline justify-between">
                    <span class="font-heading text-3xl font-extrabold text-[var(--text-primary)]">{{ $quotaStats['views_limit'] === 'Unlimited' ? '∞' : $quotaStats['views_remaining'] }}</span>
                    <span class="text-xs font-bold text-[var(--accent-primary)]">{{ $quotaStats['views_limit'] === 'Unlimited' ? 'Unlimited Access' : 'Views remaining' }} &rarr;</span>
                </div>
            </a>
        </section>

        <!-- 3. Featured Section: Today's Compatible Introductions -->
        <section class="card-ledger p-6 bg-[var(--bg-surface)] border border-[var(--border-default)] space-y-5">
            <div class="flex items-center justify-between">
                <div>
                    <div class="inline-flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-wider text-[var(--accent-primary)]">
                        <span>Curated Introductions</span>
                    </div>
                    <h2 class="font-heading text-lg font-extrabold text-[var(--text-primary)] mt-0.5">
                        Today’s Compatible Matches
                    </h2>
                </div>
                <a href="{{ route('discovery.index') }}" class="text-xs font-semibold text-[var(--accent-primary)] hover:underline flex items-center gap-1">
                    <span>View All Matches</span>
                    <span>&rarr;</span>
                </a>
            </div>

            @if($dailyMatches->isNotEmpty())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach($dailyMatches as $match)
                        <article class="card-ledger flex flex-col justify-between overflow-hidden group bg-[var(--bg-surface)] border border-[var(--border-default)] hover:border-[var(--accent-primary)] transition">
                            <div>
                                <div class="relative h-44 bg-[var(--neutral-900)] overflow-hidden">
                                    @if($match->primaryPhoto)
                                        <img src="{{ $match->primaryPhoto->displayUrl() }}" alt="{{ $match->user->name }}" class="w-full h-full object-cover photo-shield group-hover:scale-102 transition duration-300" loading="lazy" decoding="async">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-[var(--bg-subtle)] text-[var(--accent-primary)] font-bold text-2xl">
                                            {{ substr($match->user->name, 0, 1) }}
                                        </div>
                                    @endif
                                    <div class="absolute top-2 right-2">
                                        <span class="badge-status bg-black/70 text-white border border-white/15 text-[10px]">
                                            {{ $match->compatibility_score }}% Match
                                        </span>
                                    </div>
                                    <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-black/85 via-black/30 to-transparent p-3 text-white">
                                        <h3 class="font-heading font-bold text-xs truncate">{{ $match->user->name }}</h3>
                                        <p class="text-[11px] text-[var(--neutral-300)] mt-0.5 truncate">
                                            {{ $match->user->age }} yrs &bull; {{ $match->city ?: 'Location Flexible' }}
                                        </p>
                                    </div>
                                </div>

                                <div class="p-3 border-b border-[var(--border-subtle)]">
                                    <div class="grid grid-cols-2 gap-1.5 text-[10px]">
                                        <div>
                                            <span class="text-[9px] uppercase font-bold text-[var(--text-muted)] block">Tradition</span>
                                            <span class="font-semibold text-[var(--text-primary)] truncate block">{{ $match->tradition_label ?: 'Buddhist' }}</span>
                                        </div>
                                        <div>
                                            <span class="text-[9px] uppercase font-bold text-[var(--text-muted)] block">Family Rep</span>
                                            <span class="font-semibold text-[var(--accent-primary)] truncate block">{{ $match->family_rep_required ? 'Linked' : 'Self' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="p-3">
                                <a href="{{ route('discovery.show', $match->user_id) }}" class="btn-primary w-full text-center text-xs !py-1.5 block">
                                    <span>View Biodata &rarr;</span>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="card-ledger border border-dashed border-[var(--border-default)] p-8 text-center bg-[var(--bg-subtle)]">
                    <p class="text-xs font-semibold text-[var(--text-secondary)]">Complete your Dhamma biodata preferences to unlock daily compatibility recommendations.</p>
                    <a href="{{ route('profile.edit') }}" class="mt-2.5 inline-flex items-center gap-1 text-xs font-bold text-[var(--accent-primary)] hover:underline">
                        <span>Edit Preferences</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            @endif
        </section>

        <!-- 4. Two-Column Layout: Priority Action vs Trust & Family -->
        <section class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-start">

            <!-- Left Column: Priority Action & Recent Interests -->
            <div class="space-y-6">

                <!-- Recommended Next Action (Clean Card) -->
                <div class="card-ledger border border-[var(--border-default)] bg-[var(--bg-surface)] p-6 space-y-4">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--accent-primary)] flex items-center gap-1.5">
                                Recommended Next Priority
                            </span>
                            <h2 class="mt-1 font-heading text-base font-extrabold text-[var(--text-primary)]">
                                {{ $nextAction['title'] }}
                            </h2>
                            <p class="mt-1 text-xs leading-relaxed text-[var(--text-secondary)]">
                                {{ $nextAction['description'] }}
                            </p>
                        </div>
                        <a href="{{ route($nextAction['route']) }}" class="btn-primary shrink-0 text-xs !py-2 !px-3.5 flex items-center gap-1">
                            <span>{{ $nextAction['label'] }}</span>
                            <span>&rarr;</span>
                        </a>
                    </div>

                    <div>
                        <div class="flex items-center justify-between text-[11px] mb-1 font-semibold text-[var(--text-secondary)]">
                            <span>Profile Readiness</span>
                            <span class="font-bold text-[var(--accent-primary)]">{{ $profile->completeness_percentage }}%</span>
                        </div>
                        <div class="h-2 overflow-hidden rounded-full bg-[var(--border-default)]">
                            <div class="h-full rounded-full bg-[var(--accent-primary)] transition-all duration-500" style="width: {{ $profile->completeness_percentage }}%"></div>
                        </div>
                    </div>
                </div>

                <!-- Recent Proposal Requests -->
                <div class="card-ledger border border-[var(--border-default)] bg-[var(--bg-surface)] p-6 space-y-4">
                    <div class="flex items-center justify-between border-b border-[var(--border-subtle)] pb-2">
                        <h2 class="font-heading text-sm font-bold text-[var(--text-primary)] uppercase tracking-wider flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-[var(--accent-primary)]"></span>
                            <span>Recent Proposal Requests</span>
                        </h2>
                        <a href="{{ route('interests.index') }}" class="text-xs font-semibold text-[var(--accent-primary)] hover:underline">
                            View All &rarr;
                        </a>
                    </div>

                    <div class="space-y-2">
                        @forelse($recentInterests as $interest)
                            <a href="{{ route('discovery.show', $interest->sender_id) }}" class="flex items-center gap-3 rounded-[var(--radius-sm)] border border-[var(--border-default)] p-3 transition hover:border-[var(--accent-primary)] hover:bg-[var(--bg-subtle)]">
                                <div class="flex h-9 w-9 shrink-0 items-center justify-center overflow-hidden rounded-[var(--radius-sm)] bg-[var(--neutral-900)] text-xs font-bold text-white">
                                    {{ substr($interest->sender->name, 0, 1) }}
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="truncate text-xs font-bold text-[var(--text-primary)]">{{ $interest->sender->name }}</p>
                                    <p class="text-[11px] text-[var(--text-muted)]">Received {{ $interest->created_at->diffForHumans() }}</p>
                                </div>
                                <span class="text-xs font-semibold text-[var(--accent-primary)] shrink-0">Review &rarr;</span>
                            </a>
                        @empty
                            <p class="rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] p-4 text-center text-xs text-[var(--text-muted)]">
                                No pending proposal requests at this time.
                            </p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Right Column: Trust & Family + Setup Checklist -->
            <div class="space-y-6">

                <!-- Trust & Family Oversight Console (Test explicitly checks for "Trust & Family") -->
                <div class="card-ledger border border-[var(--border-default)] bg-[var(--bg-surface)] p-6 space-y-4">
                    <div class="flex items-center justify-between border-b border-[var(--border-subtle)] pb-2">
                        <h2 class="font-heading text-sm font-bold text-[var(--text-primary)] uppercase tracking-wider flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-[var(--accent-primary)]"></span>
                            <span>Trust &amp; Family</span>
                        </h2>
                        <span class="badge-status text-[10px] bg-[var(--accent-subtle)] text-[var(--accent-primary)] border border-[var(--accent-primary)]/30">
                            Metta Privacy
                        </span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <!-- Verification Pill -->
                        <div class="p-3.5 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-default)] space-y-1">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-muted)]">Identity KYC</span>
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-[var(--text-primary)]">
                                    {{ $user->is_verified ? 'Verified Seeker' : ($verificationRequest?->status === 'pending' ? 'Review in Progress' : 'Unverified') }}
                                </span>
                                <span class="w-2 h-2 rounded-full {{ $user->is_verified ? 'bg-[var(--color-success)]' : 'bg-[var(--color-warning)]' }}"></span>
                            </div>
                        </div>

                        <!-- Family Representative Pill -->
                        <div class="p-3.5 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-default)] space-y-1">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-muted)]">Family Representative</span>
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-[var(--text-primary)] truncate">
                                    {{ $activeWaliLink ? 'Representative Connected' : 'Not Linked' }}
                                </span>
                                <span class="w-2 h-2 rounded-full {{ $activeWaliLink ? 'bg-[var(--color-success)]' : 'bg-[var(--border-default)]' }}"></span>
                            </div>
                        </div>
                    </div>

                    <a href="{{ $activeWaliLink ? route('wali.dashboard') : route('wali.link') }}" class="btn-secondary block w-full text-center text-xs !py-2.5">
                        {{ $activeWaliLink ? 'Open Family Oversight Console →' : 'Connect Family Representative →' }}
                    </a>
                </div>

                <!-- Profile Setup Progress Checklist (Test explicitly checks for "Profile setup") -->
                <div class="card-ledger border border-[var(--border-default)] bg-[var(--bg-surface)] p-6 space-y-4">
                    <div class="flex items-start justify-between gap-4 border-b border-[var(--border-subtle)] pb-2">
                        <div>
                            <p class="text-[10px] font-bold uppercase tracking-wider text-[var(--accent-primary)]">
                                Match Readiness
                            </p>
                            <h2 class="font-heading text-sm font-bold text-[var(--text-primary)] uppercase tracking-wider">
                                Profile setup
                            </h2>
                        </div>
                        <span class="badge-status text-[10px] bg-[var(--accent-subtle)] text-[var(--accent-primary)] border border-[var(--accent-primary)]/30">
                            {{ $completedOnboardingSteps }}/{{ count($onboardingSteps) }} Completed
                        </span>
                    </div>

                    <div class="space-y-1.5">
                        @foreach($onboardingSteps as $step)
                            <a href="{{ route($step['route']) }}" class="flex items-center justify-between p-2 rounded-[var(--radius-sm)] transition hover:bg-[var(--bg-subtle)] group">
                                <div class="flex items-center gap-2.5 min-w-0">
                                    <span class="flex h-4 w-4 shrink-0 items-center justify-center rounded-full text-[9px] font-black {{ $step['complete'] ? 'bg-[var(--color-success)] text-white' : 'border border-[var(--border-default)] text-transparent' }}">
                                        ✓
                                    </span>
                                    <span class="text-xs font-semibold truncate {{ $step['complete'] ? 'text-[var(--text-muted)] line-through' : 'text-[var(--text-primary)]' }}">
                                        {{ $step['label'] }}
                                    </span>
                                </div>
                                @if(!$step['complete'])
                                    <span class="text-xs font-semibold text-[var(--accent-primary)] group-hover:translate-x-0.5 transition">&rarr;</span>
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Saved Searches Quick Workspace -->
                @if($savedSearches->isNotEmpty())
                    <div class="card-ledger border border-[var(--border-default)] bg-[var(--bg-subtle)] p-5 space-y-3">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xs font-bold uppercase tracking-wider text-[var(--text-primary)]">
                                Saved Match Filters
                            </h3>
                            <a href="{{ route('discovery.index') }}" class="text-[11px] font-semibold text-[var(--accent-primary)] hover:underline">
                                Search All &rarr;
                            </a>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            @foreach($savedSearches as $savedSearch)
                                <a href="{{ route('discovery.index', collect($savedSearch->filters ?? [])->filter(fn ($value) => filled($value))->all()) }}" class="px-2.5 py-1 rounded-[var(--radius-sm)] bg-[var(--bg-surface)] border border-[var(--border-default)] text-xs font-medium text-[var(--text-secondary)] hover:border-[var(--accent-primary)] shadow-xs transition">
                                    {{ $savedSearch->title }} &rarr;
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
        </section>

    </div>
</div>
@endsection
