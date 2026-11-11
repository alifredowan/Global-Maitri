@extends('layouts.app')

@section('title', 'Proposals & Introductions — Global Maitri')

@section('content')
<div class="py-6 sm:py-8 bg-[var(--bg-canvas)] min-h-[calc(100vh-160px)]" x-data="{ tab: '{{ request('tab', 'received') }}' }">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <!-- Top Header & Tabs -->
        <div class="rounded-[var(--radius-lg)] bg-[var(--bg-surface)] p-5 sm:p-7 border border-[var(--border-default)] flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 shadow-xs">
            <div class="space-y-1">
                <p class="text-xs font-semibold uppercase tracking-wider text-[var(--accent-primary)]">Introductions</p>
                <h1 class="font-heading text-2xl font-bold text-[var(--text-primary)]">Proposals &amp; expressions of interest</h1>
                <p class="text-xs sm:text-sm text-[var(--text-secondary)]">Review introductions sent and received with patience and respect.</p>
            </div>
            <!-- Tab Navigation -->
            <div class="flex items-center bg-[var(--bg-subtle)] p-1 rounded-[var(--radius-sm)] border border-[var(--border-default)]">
                <button type="button" @click="tab = 'received'" :class="tab === 'received' ? 'bg-[var(--accent-primary)] text-white font-semibold' : 'text-[var(--text-secondary)] hover:text-[var(--text-primary)]'" class="px-3.5 py-1.5 rounded-[var(--radius-xs)] text-xs transition cursor-pointer">
                    Received ({{ $received->count() }})
                </button>
                <button type="button" @click="tab = 'sent'" :class="tab === 'sent' ? 'bg-[var(--accent-primary)] text-white font-semibold' : 'text-[var(--text-secondary)] hover:text-[var(--text-primary)]'" class="px-3.5 py-1.5 rounded-[var(--radius-xs)] text-xs transition cursor-pointer">
                    Sent ({{ $sent->count() }})
                </button>
            </div>
        </div>

        @if(session('success'))
            <div class="p-3.5 rounded-[var(--radius-sm)] bg-[var(--bg-surface)] border border-[var(--color-success)] text-[var(--text-primary)] text-xs font-medium flex items-center gap-2.5 shadow-2xs">
                <svg class="w-4 h-4 text-[var(--color-success)] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Received Tab -->
        <div x-show="tab === 'received'" class="space-y-4">
            @forelse($received as $interest)
                <article class="card-monograph p-4 sm:p-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-4 min-w-0">
                        @php
                            $isSenderPhotoVisible = $interest->sender->profile?->isPhotoVisibleTo(Auth::user()) ?? false;
                        @endphp
                        <a href="{{ route('discovery.show', $interest->sender_id) }}" class="w-14 h-14 rounded-[var(--radius-xs)] overflow-hidden bg-[var(--bg-subtle)] shrink-0 border border-[var(--border-default)] block group relative" title="View Profile">
                            @if($interest->sender->profile?->primaryPhoto)
                                <img src="{{ $interest->sender->profile->primaryPhoto->displayUrl() }}" alt="{{ $interest->sender->name }}" class="w-full h-full object-cover {{ $isSenderPhotoVisible ? '' : 'photo-shield' }} group-hover:scale-105 transition" loading="lazy">
                                @if(! $isSenderPhotoVisible)
                                    <span class="absolute inset-0 flex items-center justify-center bg-black/45 text-[10px] text-white font-bold pointer-events-none" title="Photo Privacy Protected (FR-4.1)">🔒</span>
                                @endif
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-[var(--bg-subtle)] text-[var(--accent-primary)] font-bold text-base">
                                    {{ substr($interest->sender->name, 0, 1) }}
                                </div>
                            @endif
                        </a>
                        <div class="min-w-0">
                            <div class="flex items-center gap-2 flex-wrap">
                                <a href="{{ route('discovery.show', $interest->sender_id) }}" class="font-heading font-bold text-sm text-[var(--text-primary)] hover:text-[var(--accent-primary)] truncate">
                                    {{ $interest->sender->name }}
                                </a>
                                @if($interest->sender->isPro())
                                    <span class="text-[9px] font-semibold px-1.5 py-0.5 rounded-[var(--radius-xs)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] border border-[var(--border-default)]">
                                        Single Marriage Pass
                                    </span>
                                @endif
                                @if($interest->sender->is_verified)
                                    <span class="inline-flex items-center gap-0.5 text-[10px] text-[var(--color-primary)] font-semibold">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                        Verified
                                    </span>
                                @endif
                            </div>
                            <p class="text-xs text-[var(--text-muted)] mt-0.5">
                                {{ $interest->sender->age }} yrs &bull; {{ $interest->sender->profile?->city ?? 'Location flexible' }}, {{ $interest->sender->profile?->country ?? '' }} &bull;
                                <span class="text-[var(--accent-primary)] font-medium">{{ $interest->sender->profile?->tradition_label ?? 'Practicing' }}</span>
                            </p>
                            @if($interest->message_note)
                                <p class="text-xs text-[var(--text-secondary)] bg-[var(--bg-subtle)] p-2.5 rounded-[var(--radius-xs)] mt-2 italic border border-[var(--border-subtle)] font-serif-accent">
                                    &ldquo;{{ $interest->message_note }}&rdquo;
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center gap-2 w-full sm:w-auto justify-end flex-wrap shrink-0">
                        <a href="{{ route('discovery.show', $interest->sender_id) }}" class="btn-secondary text-xs !py-1.5 !px-3">
                            <span>Inspect profile</span>
                        </a>
                        @if($interest->status === 'pending')
                            <form action="{{ route('interests.respond', $interest->id) }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="action" value="accept">
                                <button type="submit" class="btn-primary text-xs !py-1.5 !px-3.5">
                                    Accept proposal
                                </button>
                            </form>
                            <form action="{{ route('interests.respond', $interest->id) }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="action" value="decline">
                                <button type="submit" class="btn-secondary text-xs !py-1.5 !px-3">
                                    Decline
                                </button>
                            </form>
                        @elseif($interest->status === 'accepted')
                            <a href="{{ route('chat.user', $interest->sender_id) }}" class="btn-primary text-xs !py-1.5 !px-3.5 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                                <span>Send message</span>
                            </a>
                        @else
                            <span class="text-xs text-[var(--text-muted)] capitalize px-2 py-1 rounded-[var(--radius-xs)] bg-[var(--bg-subtle)] border border-[var(--border-default)]">
                                {{ str_replace('_', ' ', $interest->status) }}
                            </span>
                        @endif
                    </div>
                </article>
            @empty
                <div class="card-monograph p-8 text-center text-xs text-[var(--text-muted)]">
                    No received proposals right now. When a candidate expresses interest, it will appear here.
                </div>
            @endforelse
        </div>

        <!-- Sent Tab -->
        <div x-show="tab === 'sent'" class="space-y-4" style="display: none;">
            @forelse($sent as $interest)
                <article class="card-monograph p-4 sm:p-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-4 min-w-0">
                        @php
                            $isRecipientPhotoVisible = $interest->recipient->profile?->isPhotoVisibleTo(Auth::user()) ?? false;
                        @endphp
                        <a href="{{ route('discovery.show', $interest->recipient_id) }}" class="w-14 h-14 rounded-[var(--radius-xs)] overflow-hidden bg-[var(--bg-subtle)] shrink-0 border border-[var(--border-default)] block group relative" title="View Profile">
                            @if($interest->recipient->profile?->primaryPhoto)
                                <img src="{{ $interest->recipient->profile->primaryPhoto->displayUrl() }}" alt="{{ $interest->recipient->name }}" class="w-full h-full object-cover {{ $isRecipientPhotoVisible ? '' : 'photo-shield' }} group-hover:scale-105 transition" loading="lazy">
                                @if(! $isRecipientPhotoVisible)
                                    <span class="absolute inset-0 flex items-center justify-center bg-black/45 text-[10px] text-white font-bold pointer-events-none" title="Photo Privacy Protected (FR-4.1)">🔒</span>
                                @endif
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-[var(--bg-subtle)] text-[var(--accent-primary)] font-bold text-base">
                                    {{ substr($interest->recipient->name, 0, 1) }}
                                </div>
                            @endif
                        </a>
                        <div class="min-w-0">
                            <div class="flex items-center gap-2 flex-wrap">
                                <a href="{{ route('discovery.show', $interest->recipient_id) }}" class="font-heading font-bold text-sm text-[var(--text-primary)] hover:text-[var(--accent-primary)] truncate">
                                    {{ $interest->recipient->name }}
                                </a>
                                @if($interest->recipient->is_verified)
                                    <span class="inline-flex items-center gap-0.5 text-[10px] text-[var(--color-primary)] font-semibold">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                        Verified
                                    </span>
                                @endif
                            </div>
                            <p class="text-xs text-[var(--text-muted)] mt-0.5">
                                {{ $interest->recipient->age }} yrs &bull; {{ $interest->recipient->profile?->city ?? 'Location flexible' }}, {{ $interest->recipient->profile?->country ?? '' }} &bull;
                                <span class="text-[var(--accent-primary)] font-medium">{{ $interest->recipient->profile?->tradition_label ?? 'Practicing' }}</span>
                            </p>
                            @if($interest->message_note)
                                <p class="text-xs text-[var(--text-secondary)] bg-[var(--bg-subtle)] p-2.5 rounded-[var(--radius-xs)] mt-2 italic border border-[var(--border-subtle)] font-serif-accent">
                                    &ldquo;{{ $interest->message_note }}&rdquo;
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center gap-2 w-full sm:w-auto justify-end flex-wrap shrink-0">
                        <a href="{{ route('discovery.show', $interest->recipient_id) }}" class="btn-secondary text-xs !py-1.5 !px-3">
                            <span>View profile</span>
                        </a>
                        @if($interest->status === 'accepted')
                            <a href="{{ route('chat.user', $interest->recipient_id) }}" class="btn-primary text-xs !py-1.5 !px-3.5 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                                <span>Send message</span>
                            </a>
                        @else
                            <span class="text-xs px-2.5 py-1 rounded-[var(--radius-xs)] bg-[var(--bg-subtle)] text-[var(--text-secondary)] border border-[var(--border-default)] capitalize">
                                {{ str_replace('_', ' ', $interest->status) }}
                            </span>
                        @endif
                    </div>
                </article>
            @empty
                <div class="card-monograph p-8 text-center text-xs text-[var(--text-muted)]">
                    You haven't sent any proposals yet. Browse candidates to find someone whose practice resonates with yours.
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection
