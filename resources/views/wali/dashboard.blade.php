@extends('layouts.app')

@section('title', 'Family Representative Console — Global Maitri')

@section('content')
<div class="py-8 sm:py-10 bg-[var(--bg-canvas)] min-h-[calc(100vh-160px)]">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <!-- Top Editorial Console Header -->
        <div class="rounded-[var(--radius-lg)] p-6 sm:p-8 bg-[var(--bg-surface)] border border-[var(--border-default)] shadow-xs space-y-3">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-[var(--radius-xs)] bg-[var(--accent-subtle)] border border-[var(--border-default)] text-[var(--accent-primary)] text-xs font-semibold uppercase tracking-wider">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    <span>{{ Auth::user()->isMonkAdvisor() ? 'Monk & Dhamma Advisor Console' : 'Family Representative Console' }}</span>
                </div>
                <span class="text-xs font-semibold text-[var(--color-primary)] self-start sm:self-auto">
                    &bull; Active representative
                </span>
            </div>

            <h1 class="font-heading text-2xl sm:text-3xl font-bold text-[var(--text-primary)]">
                {{ Auth::user()->isMonkAdvisor() ? 'Sangha & Elder Advisor Guidance Center' : 'Family Guidance Center' }}
            </h1>

            <p class="text-xs sm:text-sm text-[var(--text-secondary)] max-w-2xl leading-relaxed">
                {{ Auth::user()->isMonkAdvisor() 
                    ? 'Monastic and elder advisory console providing spiritual counsel, moral reflection, and harmonious Dhamma facilitation for prospective couples and their families.' 
                    : 'A respectful family space allowing parents, elders, and mentors to review candidate proposals with care, offer wisdom, and help guide a peaceful union.' }}
            </p>
        </div>

        @if(session('success'))
            <div class="p-3.5 rounded-[var(--radius-sm)] bg-[var(--bg-surface)] border border-[var(--color-success)] text-[var(--text-primary)] text-xs font-medium flex items-center gap-2.5 shadow-2xs">
                <svg class="w-4 h-4 text-[var(--color-success)] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('info'))
            <div class="p-3.5 rounded-[var(--radius-sm)] bg-[var(--bg-surface)] border border-[var(--border-default)] text-[var(--text-primary)] text-xs font-medium flex items-center gap-2.5 shadow-2xs">
                <svg class="w-4 h-4 text-[var(--accent-primary)] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>{{ session('info') }}</span>
            </div>
        @endif

        <!-- Pending Proposal Approvals -->
        <div class="space-y-4">
            <div class="flex items-center justify-between border-b border-[var(--border-subtle)] pb-2">
                <h2 class="font-heading text-base font-bold text-[var(--text-primary)] flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-[var(--accent-primary)]"></span>
                    <span>Proposals requiring family review</span>
                </h2>
                <span class="text-xs text-[var(--text-muted)]">{{ $pendingInterests->count() }} awaiting review</span>
            </div>

            @forelse($pendingInterests as $pi)
                <div class="card-monograph p-5 sm:p-6 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                    <div class="flex items-center gap-4 min-w-0">
                        <div class="w-16 h-16 rounded-[var(--radius-xs)] bg-[var(--bg-subtle)] overflow-hidden shrink-0 border border-[var(--border-default)] relative">
                            @php
                                $isSenderPhotoVisible = $pi->sender->profile?->isPhotoVisibleTo(Auth::user()) ?? false;
                            @endphp
                            @if($pi->sender->profile?->primaryPhoto)
                                <img src="{{ $pi->sender->profile->primaryPhoto->displayUrl() }}" alt="{{ $pi->sender->name }}" class="w-full h-full object-cover {{ $isSenderPhotoVisible ? '' : 'photo-shield' }}" loading="lazy">
                                @if(! $isSenderPhotoVisible)
                                    <span class="absolute inset-0 flex items-center justify-center bg-black/50 text-[9px] text-white font-bold pointer-events-none" title="Photo Privacy Protected (FR-4.1)">🔒 Protected</span>
                                @endif
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-[var(--bg-subtle)] text-[var(--accent-primary)] font-bold text-xl">
                                    {{ substr($pi->sender->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <div class="min-w-0">
                            <span class="text-[10px] font-semibold text-[var(--accent-primary)] uppercase tracking-wider block">Candidate: {{ $pi->recipient->name }}</span>
                            <h3 class="font-heading font-bold text-base text-[var(--text-primary)] truncate">{{ $pi->sender->name }}</h3>
                            <p class="text-xs text-[var(--text-muted)] mt-0.5 truncate">
                                {{ $pi->sender->age }} yrs &bull; {{ $pi->sender->profile?->city }}, {{ $pi->sender->profile?->country }} &bull;
                                <span class="font-medium text-[var(--accent-primary)]">{{ $pi->sender->profile?->tradition_label }}</span>
                            </p>
                            @if($pi->message_note)
                                <p class="text-xs text-[var(--text-secondary)] bg-[var(--bg-subtle)] p-2.5 rounded-[var(--radius-xs)] border border-[var(--border-subtle)] mt-2 italic font-serif-accent">
                                    &ldquo;{{ $pi->message_note }}&rdquo;
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center gap-2.5 w-full md:w-auto justify-end shrink-0">
                        <a href="{{ route('discovery.show', $pi->sender_id) }}" target="_blank" class="btn-secondary text-xs !py-2 !px-3.5">
                            Inspect profile
                        </a>
                        <form action="{{ route('wali.interests.approve', $pi->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-primary text-xs !py-2 !px-4">
                                Approve proposal
                            </button>
                        </form>
                        <form action="{{ route('wali.interests.reject', $pi->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-secondary text-xs !py-2 !px-3 text-[var(--color-danger)]">
                                Decline
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="card-monograph p-8 text-center text-xs text-[var(--text-muted)]">
                    No pending proposals awaiting your review right now.
                </div>
            @endforelse
        </div>

        <!-- My Linked Candidates -->
        <div class="space-y-4">
            <h2 class="font-heading text-base font-bold text-[var(--text-primary)] border-b border-[var(--border-subtle)] pb-2">
                My linked candidates
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                @forelse($wards as $wardLink)
                    <div class="card-monograph p-5 flex items-center justify-between gap-4">
                        <div class="flex items-center gap-3.5 min-w-0">
                            <div class="w-12 h-12 rounded-[var(--radius-xs)] bg-[var(--bg-subtle)] text-[var(--accent-primary)] font-bold flex items-center justify-center text-sm border border-[var(--border-default)] overflow-hidden shrink-0">
                                @if($wardLink->seeker?->profile?->primaryPhoto)
                                    <img src="{{ $wardLink->seeker->profile->primaryPhoto->displayUrl() }}" alt="{{ $wardLink->seeker->name }}" class="w-full h-full object-cover" loading="lazy">
                                @else
                                    {{ substr($wardLink->seeker?->name ?? 'C', 0, 1) }}
                                @endif
                            </div>
                            <div class="min-w-0">
                                <h3 class="font-heading font-bold text-sm text-[var(--text-primary)] truncate">{{ $wardLink->seeker?->name ?? 'Candidate' }}</h3>
                                <p class="text-xs text-[var(--text-muted)] truncate">
                                    {{ $wardLink->seeker?->age ? $wardLink->seeker->age . ' yrs &bull; ' : '' }}{{ ucfirst(str_replace('_', ' ', $wardLink->relationship_type)) }} &bull; {{ str_replace('_', ' ', $wardLink->permission_level) }}
                                </p>
                            </div>
                        </div>
                        <a href="{{ route('discovery.show', $wardLink->seeker_user_id) }}" class="btn-secondary text-xs !py-1.5 !px-3 shrink-0">
                            View profile &rarr;
                        </a>
                    </div>
                @empty
                    <div class="col-span-full card-monograph p-8 text-center text-xs text-[var(--text-muted)]">
                        No candidates are currently linked to your representative account.
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</div>
@endsection

