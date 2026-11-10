@extends('layouts.app')

@section('title', 'Mindful Conversations - Global Maitri')

@section('content')
<div class="py-6 bg-[var(--bg-canvas)] min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <div class="card-ledger bg-[var(--bg-surface)] p-5 sm:p-6 border border-[var(--border-default)] flex items-center justify-between">
            <div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-[var(--text-primary)] font-heading">Mindful Conversations</h1>
                <p class="text-xs text-[var(--text-secondary)] mt-0.5">Private communication unlocked after mutual proposal acceptance (FR-4.2).</p>
            </div>
            <span class="badge-status bg-[var(--accent-subtle)] text-[var(--accent-primary)] border border-[var(--accent-primary)]/30 text-xs">
                Chaperoned &amp; Protected
            </span>
        </div>

        <div class="card-ledger bg-[var(--bg-surface)] border border-[var(--border-default)] overflow-hidden divide-y divide-[var(--border-subtle)]">
            @forelse($conversations as $conversation)
                @php
                    $isChaperoneUser = $conversation->participants->where('id', Auth::id())->first()?->pivot?->role === 'wali_chaperone';
                    $other = $conversation->getOtherParticipant(Auth::user());
                    $hasWali = $conversation->participants->contains(fn($p) => $p->pivot->role === 'wali_chaperone');
                    $seekers = $conversation->participants->where('pivot.role', 'seeker');
                @endphp
                <a href="{{ route('chat.show', $conversation->id) }}" class="p-4 sm:p-5 flex items-center justify-between gap-4 hover:bg-[var(--bg-subtle)] transition block">
                    <div class="flex items-center gap-3.5">
                        <div class="w-12 h-12 rounded-[var(--radius-sm)] bg-[var(--neutral-900)] overflow-hidden shrink-0 border border-[var(--border-default)]">
                            @if($other?->profile?->primaryPhoto)
                                <img src="{{ $other->profile->primaryPhoto->displayUrl() }}" alt="{{ $other->name }}" class="w-full h-full object-cover photo-shield" loading="lazy" decoding="async">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-[var(--bg-subtle)] text-[var(--accent-primary)] font-bold text-lg">
                                    {{ substr($other?->name ?? 'User', 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                @if($isChaperoneUser)
                                    <h3 class="font-bold text-sm text-[var(--text-primary)]">{{ $seekers->pluck('name')->join(' & ') }}</h3>
                                    <span class="badge-status bg-[var(--accent-subtle)] text-[var(--accent-primary)] border border-[var(--accent-primary)]/30 text-[10px]">
                                        Observing as Guardian
                                    </span>
                                @else
                                    <h3 class="font-bold text-sm text-[var(--text-primary)]">{{ $other?->name ?? 'Candidate' }}</h3>
                                    @if($hasWali)
                                        <span class="badge-status bg-[var(--accent-subtle)] text-[var(--accent-primary)] border border-[var(--accent-primary)]/30 text-[10px]">
                                            Kalyāṇa-Mitta Guided
                                        </span>
                                    @endif
                                @endif
                            </div>
                            <p class="text-xs text-[var(--text-secondary)] line-clamp-1 mt-0.5">
                                {{ $conversation->latestMessage?->body ?? 'Conversation started...' }}
                            </p>
                        </div>
                    </div>
                    <div class="text-right shrink-0">
                        <span class="text-[11px] text-[var(--text-muted)]">
                            {{ $conversation->latestMessage?->created_at?->diffForHumans() ?? $conversation->created_at->diffForHumans() }}
                        </span>
                        <span class="block text-xs font-semibold text-[var(--accent-primary)] mt-1">Open &rarr;</span>
                    </div>
                </a>
            @empty
                <div class="p-12 text-center text-[var(--text-muted)] text-xs">
                    <p class="font-semibold text-sm text-[var(--text-primary)]">No active conversations yet.</p>
                    <p class="mt-1">Messaging unlocks once an Interest request is mutually accepted by both parties.</p>
                    <a href="{{ route('discovery.index') }}" class="btn-primary inline-block mt-4 text-xs !py-2 !px-4">
                        Find Matches
                    </a>
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection
