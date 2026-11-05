@extends('layouts.app')

@section('title', 'Profile Visitors & Activity - Global Maitri')

@section('content')
<div class="py-6 bg-[var(--bg-canvas)] min-h-screen">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <!-- Top Header & Breadcrumb -->
        <div class="card-ledger flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 bg-[var(--bg-surface)] p-5 sm:p-6 border border-[var(--border-default)]">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="badge-status text-[10px] bg-[var(--accent-subtle)] text-[var(--accent-primary)] border border-[var(--accent-primary)]/30 font-bold uppercase tracking-wider">Pro Feature</span>
                    <span class="w-1.5 h-1.5 rounded-full bg-[var(--border-default)]"></span>
                    <span class="text-xs text-[var(--text-muted)]">Visitor Analytics</span>
                </div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-[var(--text-primary)] font-heading">Who Viewed My Profile</h1>
                <p class="text-xs text-[var(--text-secondary)] mt-0.5">Discover prospective suitors who viewed your matrimonial biodata.</p>
            </div>

            <!-- Incognito Privacy Controls -->
            <div class="w-full sm:w-auto bg-[var(--bg-subtle)] p-3 rounded-[var(--radius-sm)] border border-[var(--border-default)] flex items-center justify-between gap-4">
                <div class="text-left">
                    <span class="text-xs font-bold text-[var(--text-primary)] flex items-center gap-1.5">
                        <span>Incognito Mode</span>
                        @if($user->is_incognito)
                            <span class="badge-status bg-[var(--color-success-subtle)] text-[var(--color-success)] border border-[var(--color-success)]/30 text-[9px] font-extrabold">ACTIVE</span>
                        @endif
                    </span>
                    <p class="text-[11px] text-[var(--text-muted)]">
                        {{ $user->is_incognito ? 'Browsing privately without traces' : 'Your visits are visible to others' }}
                    </p>
                </div>

                @if($isPro)
                    <form action="{{ route('profile.incognito.toggle') }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="btn-secondary text-xs !py-1 !px-3 font-bold transition {{ $user->is_incognito ? '!bg-[var(--accent-primary)] !text-white !border-[var(--accent-primary)]' : '' }}">
                            {{ $user->is_incognito ? 'Turn Off' : 'Turn On' }}
                        </button>
                    </form>
                @else
                    <a href="{{ route('subscription.pricing') }}" class="btn-primary text-[10px] !py-1 !px-2.5">
                        PRO Only
                    </a>
                @endif
            </div>
        </div>

        @if(session('success'))
            <div class="p-3.5 rounded-[var(--radius-sm)] bg-[var(--color-success-subtle)] border border-[var(--color-success)]/30 text-[var(--color-success)] text-xs font-semibold flex items-center gap-2">
                <span>✓</span> {{ session('success') }}
            </div>
        @endif

        @if(session('warning'))
            <div class="p-3.5 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-[var(--text-primary)] text-xs font-semibold flex items-center gap-2">
                <span>⚠️</span> {{ session('warning') }}
            </div>
        @endif

        <!-- Quick Stats Overview Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="card-ledger bg-[var(--bg-surface)] p-4 sm:p-5 border border-[var(--border-default)] flex items-center gap-3.5">
                <div class="w-10 h-10 rounded-[var(--radius-sm)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] flex items-center justify-center font-bold shrink-0">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                </div>
                <div>
                    <span class="text-xs text-[var(--text-muted)] block font-medium">Total Profile Views</span>
                    <span class="text-xl sm:text-2xl font-black text-[var(--text-primary)] font-heading">{{ $totalViewsCount }}</span>
                </div>
            </div>

            <div class="card-ledger bg-[var(--bg-surface)] p-4 sm:p-5 border border-[var(--border-default)] flex items-center gap-3.5">
                <div class="w-10 h-10 rounded-[var(--radius-sm)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] flex items-center justify-center font-bold shrink-0">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <div>
                    <span class="text-xs text-[var(--text-muted)] block font-medium">Unique Suitors</span>
                    <span class="text-xl sm:text-2xl font-black text-[var(--text-primary)] font-heading">{{ $uniqueVisitorsCount }}</span>
                </div>
            </div>

            <div class="card-ledger bg-[var(--bg-surface)] p-4 sm:p-5 border border-[var(--border-default)] flex items-center gap-3.5">
                <div class="w-10 h-10 rounded-[var(--radius-sm)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] flex items-center justify-center font-bold shrink-0">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                </div>
                <div>
                    <span class="text-xs text-[var(--text-muted)] block font-medium">Your Membership</span>
                    <span class="text-sm font-black text-[var(--text-primary)] font-heading uppercase">{{ $user->plan }} Tier</span>
                </div>
            </div>
        </div>

        @if($isPro)
            <!-- Pro View: Real Visitors List (Test explicitly requires "Recent Suitor Visits") -->
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-base font-bold text-[var(--text-primary)] font-heading">Recent Suitor Visits</h2>
                    <span class="text-xs text-[var(--text-muted)] font-medium">Real-time visitor logs</span>
                </div>

                @if($visitors->isEmpty())
                    <div class="card-ledger bg-[var(--bg-surface)] border border-[var(--border-default)] p-10 text-center space-y-3">
                        <h3 class="text-sm font-bold text-[var(--text-primary)]">No Profile Views Yet</h3>
                        <p class="text-xs text-[var(--text-muted)] max-w-md mx-auto">
                            Ensure your Dhamma biodata is 100% complete and verified to rank higher in daily compatibility matching!
                        </p>
                        <a href="{{ route('profile.edit') }}" class="btn-primary inline-block text-xs !py-2 !px-4">
                            Boost My Profile Details &rarr;
                        </a>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($visitors as $view)
                            @php
                                $viewer = $view->viewer;
                                $profile = $viewer->profile;
                            @endphp
                            <article class="card-ledger bg-[var(--bg-surface)] border border-[var(--border-default)] p-4 flex flex-col justify-between hover:border-[var(--accent-primary)] transition">
                                <div>
                                    <div class="flex items-start justify-between gap-2 mb-3">
                                        <div class="flex items-center gap-3">
                                            <div class="relative w-12 h-12 rounded-[var(--radius-sm)] overflow-hidden bg-[var(--neutral-900)] shrink-0 border border-[var(--border-default)]">
                                                @if($profile && $profile->primaryPhoto)
                                                    <img src="{{ $profile->primaryPhoto->displayUrl() }}" alt="{{ $viewer->name }}" loading="lazy" decoding="async"
                                                         class="w-full h-full object-cover {{ $view->is_photo_visible ? '' : 'photo-shield' }}">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center bg-[var(--bg-subtle)] text-[var(--accent-primary)] font-bold text-lg">
                                                        {{ substr($viewer->name, 0, 1) }}
                                                    </div>
                                                @endif
                                                @if(!$view->is_photo_visible)
                                                    <span class="absolute inset-0 flex items-center justify-center bg-black/40 text-[9px] text-white font-bold">🔒 Shield</span>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="flex items-center gap-1.5">
                                                    <h3 class="font-bold text-sm text-[var(--text-primary)]">{{ $viewer->name }}</h3>
                                                    @if($viewer->is_verified)
                                                        <span class="badge-verified text-[9px]">Verified</span>
                                                    @endif
                                                </div>
                                                <p class="text-xs text-[var(--text-muted)]">
                                                    {{ $viewer->age }} yrs &bull; {{ $profile?->city ?? 'Location flexible' }}
                                                </p>
                                                <p class="text-[11px] text-[var(--accent-primary)] font-semibold">
                                                    {{ $profile?->tradition_label ?? 'Buddhist' }}
                                                </p>
                                            </div>
                                        </div>

                                        @if($view->viewer_compatibility)
                                            <span class="badge-status text-[10px] font-bold bg-[var(--accent-subtle)] text-[var(--accent-primary)] border border-[var(--accent-primary)]/30">
                                                {{ $view->viewer_compatibility }}% Match
                                            </span>
                                        @endif
                                    </div>

                                    <div class="text-[11px] text-[var(--text-muted)] py-2 border-t border-[var(--border-subtle)] flex items-center justify-between">
                                        <span>Visited:</span>
                                        <span class="font-medium text-[var(--text-secondary)]">{{ $view->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>

                                <div class="pt-3 border-t border-[var(--border-subtle)] flex items-center gap-2">
                                    <a href="{{ route('discovery.show', $viewer->id) }}" class="btn-secondary flex-1 text-center text-xs !py-1.5">
                                        View Profile
                                    </a>
                                    @if($view->existing_interest)
                                        <span class="badge-status text-xs bg-[var(--bg-subtle)] text-[var(--text-secondary)] border border-[var(--border-default)]">
                                            {{ ucfirst($view->existing_interest->status) }}
                                        </span>
                                    @else
                                        <form action="{{ route('interests.send', $viewer->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="btn-primary text-xs !py-1.5 !px-3">
                                                Interest
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>

        @else
            <!-- Free Member Upgrade Teaser Card (Test explicitly requires "Maitri Pass Feature" and "Upgrade to Single Marriage Pass") -->
            <div class="card-hero rounded-[var(--radius-xl)] bg-[var(--bg-surface)] border border-[var(--border-default)] p-6 sm:p-10 shadow-xs space-y-4">
                <div class="max-w-2xl space-y-3">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-[var(--radius-sm)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] border border-[var(--accent-primary)]/30 text-xs font-bold uppercase tracking-wider">
                        <span>Maitri Pass Feature</span>
                    </div>

                    <h2 class="text-2xl sm:text-3xl font-extrabold font-heading text-[var(--text-primary)] leading-tight">
                        {{ $uniqueVisitorsCount }} Candidates Viewed Your Biodata!
                    </h2>

                    <p class="text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed">
                        Don't miss out on potential mindful life companions who have reviewed your matrimonial biodata. Upgrade to Single Marriage Pass to unlock visitor details, Dhamma compatibility scores, and send instant proposals!
                    </p>

                    <div class="pt-2 flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                        <a href="{{ route('subscription.pricing') }}" class="btn-primary text-xs sm:text-sm !py-2.5 !px-5 flex items-center justify-center gap-2">
                            <span>Upgrade to Single Marriage Pass</span>
                        </a>
                        <a href="{{ route('discovery.index') }}" class="btn-secondary text-xs sm:text-sm !py-2.5 !px-5 text-center">
                            Continue Browsing
                        </a>
                    </div>
                </div>

                <!-- Teaser Blurred Silhouette Cards Preview -->
                <div class="mt-6 pt-6 border-t border-[var(--border-subtle)] grid grid-cols-1 sm:grid-cols-3 gap-4">
                    @for($i = 1; $i <= min(3, max(1, $uniqueVisitorsCount)); $i++)
                        <div class="bg-[var(--bg-subtle)] rounded-[var(--radius-sm)] p-3 border border-[var(--border-default)] flex items-center gap-3">
                            <div class="w-10 h-10 rounded-[var(--radius-sm)] bg-[var(--bg-surface)] border border-[var(--border-default)] flex items-center justify-center text-xs shrink-0 text-[var(--text-muted)]">
                                🔒
                            </div>
                            <div class="space-y-1">
                                <div class="h-2.5 w-24 bg-[var(--border-default)] rounded filter blur-[2px]"></div>
                                <div class="h-2 w-32 bg-[var(--border-default)] rounded filter blur-[2px]"></div>
                                <span class="text-[10px] text-[var(--accent-primary)] font-bold block">Recent Visitor #{{ $i }}</span>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        @endif

    </div>
</div>
@endsection
