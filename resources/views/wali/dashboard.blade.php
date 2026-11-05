@extends('layouts.app')

@section('title', 'Family Representative Console - Global Maitri')

@section('content')
<div class="py-10 bg-[var(--bg-canvas)] min-h-screen transition-colors">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <!-- Top Atmospheric Banner -->
        <div class="bg-[#141412] rounded-[4px] p-6 sm:p-8 text-[#f4f2ee] shadow-sm border border-[#2d2b27] relative overflow-hidden">
            <div class="absolute inset-0 opacity-20 bg-[radial-gradient(var(--accent-primary)_1px,transparent_1px)] [background-size:20px_20px]"></div>
            <div class="relative flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <div class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-[4px] bg-[var(--accent-primary)]/20 text-[#e0b84c] text-xs font-semibold uppercase tracking-wider mb-2 border border-[var(--accent-primary)]/30">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <span>Family Representative Console</span>
                    </div>
                    <h1 class="font-heading font-extrabold text-2xl sm:text-3xl text-white">
                        Family Oversight &amp; Matrimonial Guidance Center
                    </h1>
                    <p class="text-xs text-[#d6d2c8] mt-1.5 max-w-2xl leading-relaxed">
                        Mindful matrimonial facilitation empowering trusted parents, elders, and advisors to review suitor proposals, offer moral counsel, and foster harmonious lifelong companionship.
                    </p>
                </div>
                <span class="px-3.5 py-1.5 rounded-[4px] text-xs font-bold bg-[var(--accent-primary)]/20 text-[#e0b84c] border border-[var(--accent-primary)]/40 self-start md:self-center shrink-0">
                    &check; Representative Oversight Active
                </span>
            </div>
        </div>

        @if(session('success'))
            <div class="p-4 rounded-[4px] bg-[var(--bg-subtle)] border border-[var(--color-success)] text-[var(--color-success)] text-xs font-semibold flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('info'))
            <div class="p-4 rounded-[4px] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-[var(--text-secondary)] text-xs font-semibold flex items-center gap-2">
                <svg class="w-4 h-4 text-[var(--accent-primary)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('info') }}</span>
            </div>
        @endif

        <!-- Pending Interest Approvals (FR-4.3) -->
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <h2 class="text-base font-bold text-[var(--text-primary)] font-heading flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-[var(--accent-primary)] animate-pulse"></span>
                    Pending Proposal Approvals Requiring Your Review
                </h2>
                <span class="text-xs text-[var(--text-secondary)]">{{ $pendingInterests->count() }} awaiting review</span>
            </div>

            @forelse($pendingInterests as $pi)
                <div class="card-ledger p-6 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-[4px] bg-[#141412] overflow-hidden shrink-0 border border-[var(--border-default)] relative">
                            @if($pi->sender->profile?->primaryPhoto)
                                <img src="{{ $pi->sender->profile->primaryPhoto->displayUrl() }}" alt="{{ $pi->sender->name }}" class="w-full h-full object-cover" loading="lazy" decoding="async">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-[#22211c] text-[#e0b84c] font-bold text-2xl">
                                    {{ substr($pi->sender->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <span class="text-[10px] font-bold text-[var(--accent-primary)] uppercase tracking-wider block">Proposal for: {{ $pi->recipient->name }}</span>
                            <h3 class="font-bold text-base text-[var(--text-primary)]">{{ $pi->sender->name }}</h3>
                            <p class="text-xs text-[var(--text-secondary)]">
                                {{ $pi->sender->age }} yrs • {{ $pi->sender->profile?->city }}, {{ $pi->sender->profile?->country }} •
                                <span class="font-semibold text-[var(--accent-primary)]">{{ $pi->sender->profile?->tradition_label }}</span>
                            </p>
                            @if($pi->message_note)
                                <p class="text-xs text-[var(--text-primary)] bg-[var(--bg-subtle)] p-2.5 rounded-[4px] border border-[var(--border-subtle)] mt-2 italic">
                                    &ldquo;{{ $pi->message_note }}&rdquo;
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center gap-3 w-full md:w-auto justify-end">
                        <a href="{{ route('discovery.show', $pi->sender_id) }}" target="_blank" class="btn-secondary text-xs px-4 py-2">
                            Inspect Profile
                        </a>
                        <form action="{{ route('wali.interests.approve', $pi->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-primary text-xs px-4 py-2 font-bold cursor-pointer">
                                &check; Approve Proposal
                            </button>
                        </form>
                        <form action="{{ route('wali.interests.reject', $pi->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-secondary text-xs px-3 py-2 text-[var(--color-danger)] border-[var(--border-default)] font-bold cursor-pointer">
                                Decline
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="card-ledger p-8 text-center text-xs text-[var(--text-secondary)]">
                    No pending proposal requests awaiting your approval right now.
                </div>
            @endforelse
        </div>

        <!-- My Linked Candidates (Seekers) -->
        <div class="space-y-4">
            <h2 class="text-base font-bold text-[var(--text-primary)] font-heading">My Linked Candidates</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($wards as $wardLink)
                    <div class="card-ledger p-5 flex items-center justify-between">
                        <div class="flex items-center gap-3.5">
                            <div class="w-12 h-12 rounded-[4px] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] font-bold flex items-center justify-center text-base border border-[var(--accent-primary)]/20">
                                {{ substr($wardLink->seeker->name, 0, 1) }}
                            </div>
                            <div>
                                <h3 class="font-bold text-sm text-[var(--text-primary)]">{{ $wardLink->seeker->name }}</h3>
                                <p class="text-[11px] text-[var(--text-secondary)]">
                                    {{ $wardLink->seeker->age }} yrs • {{ ucfirst(str_replace('_', ' ', $wardLink->relationship_type)) }} • {{ str_replace('_', ' ', $wardLink->permission_level) }}
                                </p>
                            </div>
                        </div>
                        <a href="{{ route('discovery.show', $wardLink->seeker_id) }}" class="btn-secondary text-xs px-3 py-1.5">
                            View Profile &rarr;
                        </a>
                    </div>
                @empty
                    <div class="col-span-full card-ledger p-8 text-center text-xs text-[var(--text-secondary)]">
                        No candidates are currently linked to your representative account.
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</div>
@endsection
