@extends('layouts.app')

@section('title', 'Conversations — Global Maitri')

@section('content')
<div class="py-6 sm:py-8 bg-[var(--bg-canvas)] min-h-[calc(100vh-160px)]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <div class="rounded-[var(--radius-lg)] bg-[var(--bg-surface)] p-5 sm:p-7 border border-[var(--border-default)] flex items-center justify-between shadow-xs">
            <div class="space-y-1">
                <p class="text-xs font-semibold uppercase tracking-wider text-[var(--accent-primary)]">Messages</p>
                <h1 class="font-heading text-2xl font-bold text-[var(--text-primary)]">Conversations</h1>
                <p class="text-xs sm:text-sm text-[var(--text-secondary)]">Private messages with accepted proposals.</p>
            </div>
            <span class="text-xs font-medium px-3 py-1 rounded-[var(--radius-xs)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] border border-[var(--border-default)]">
                Protected space
            </span>
        </div>

        <div class="card-monograph divide-y divide-[var(--border-subtle)] overflow-hidden">
            @forelse($conversations as $conversation)
                @php
                    $isChaperoneUser = $conversation->participants->where('id', Auth::id())->first()?->pivot?->role === 'wali_chaperone';
                    $other = $conversation->getOtherParticipant(Auth::user());
                    $hasWali = $conversation->participants->contains(fn($p) => $p->pivot->role === 'wali_chaperone');
                    $seekers = $conversation->participants->where('pivot.role', 'seeker');
                @endphp
                <a href="{{ route('chat.show', $conversation->id) }}" class="p-4 sm:p-5 flex items-center justify-between gap-4 hover:bg-[var(--bg-subtle)] transition block">
                    <div class="flex items-center gap-3.5 min-w-0">
                        <div class="w-12 h-12 rounded-[var(--radius-xs)] bg-[var(--bg-subtle)] overflow-hidden shrink-0 border border-[var(--border-default)]">
                            @if($other?->profile?->primaryPhoto)
                                <img src="{{ $other->profile->primaryPhoto->displayUrl() }}" alt="{{ $other->name }}" class="w-full h-full object-cover {{ ($other->profile->isPhotoVisibleTo(Auth::user())) ? '' : 'photo-shield' }}" loading="lazy">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-[var(--bg-subtle)] text-[var(--accent-primary)] font-bold text-sm">
                                    {{ substr($other?->name ?? 'User', 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <div class="min-w-0">
                            <div class="flex items-center gap-2">
                                @if($isChaperoneUser)
                                    <h3 class="font-heading font-bold text-sm text-[var(--text-primary)] truncate">{{ $seekers->pluck('name')->join(' & ') }}</h3>
                                    <span class="text-[10px] font-semibold text-[var(--accent-primary)]">
                                        &bull; Family observer
                                    </span>
                                @else
                                    <h3 class="font-heading font-bold text-sm text-[var(--text-primary)] truncate">{{ $other?->name ?? 'Candidate' }}</h3>
                                    @if($hasWali)
                                        <span class="text-[10px] font-semibold text-[var(--accent-primary)]">
                                            &bull; Family guided
                                        </span>
                                    @endif
                                @endif
                            </div>
                            <p class="text-xs text-[var(--text-secondary)] truncate mt-0.5">
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
                <div class="p-12 text-center text-[var(--text-muted)] text-xs space-y-2">
                    <p class="font-semibold text-sm text-[var(--text-primary)]">No conversations yet.</p>
                    <p class="max-w-md mx-auto">Conversations begin once both parties accept an interest proposal.</p>
                    <div class="pt-2">
                        <a href="{{ route('discovery.index') }}" class="btn-primary text-xs !py-2 !px-4">
                            Browse candidates &rarr;
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection
