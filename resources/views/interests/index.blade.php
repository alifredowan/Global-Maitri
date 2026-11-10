@extends('layouts.app')

@section('title', 'My Proposals - Global Maitri')

@section('content')
<div class="py-6 bg-[var(--bg-canvas)] min-h-screen" x-data="{ tab: 'received' }">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <div class="card-ledger bg-[var(--bg-surface)] p-5 sm:p-6 border border-[var(--border-default)] flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-wider text-[var(--accent-primary)] mb-1">
                    <x-application-logo class="w-3.5 h-3.5 text-[var(--accent-primary)] shrink-0" />
                    <span>Proposals &amp; Introductions</span>
                </div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-[var(--text-primary)] font-heading">Matrimonial Proposals</h1>
                <p class="text-xs text-[var(--text-secondary)] mt-0.5">Review expressions of interest sent and received with loving-kindness (FR-4.1).</p>
            </div>
            <!-- Tab Buttons -->
            <div class="flex items-center bg-[var(--bg-subtle)] p-1 rounded-[var(--radius-sm)] border border-[var(--border-default)]">
                <button @click="tab = 'received'" :class="tab === 'received' ? 'bg-[var(--accent-primary)] text-white font-bold' : 'text-[var(--text-secondary)] font-medium hover:text-[var(--text-primary)]'" class="px-3.5 py-1.5 rounded-[var(--radius-xs)] text-xs transition cursor-pointer">
                    Received ({{ $received->count() }})
                </button>
                <button @click="tab = 'sent'" :class="tab === 'sent' ? 'bg-[var(--accent-primary)] text-white font-bold' : 'text-[var(--text-secondary)] font-medium hover:text-[var(--text-primary)]'" class="px-3.5 py-1.5 rounded-[var(--radius-xs)] text-xs transition cursor-pointer">
                    Sent ({{ $sent->count() }})
                </button>
            </div>
        </div>

        @if(session('success'))
            <div class="p-3.5 rounded-[var(--radius-sm)] bg-[var(--color-success-subtle)] border border-[var(--color-success)]/30 text-[var(--color-success)] text-xs font-semibold flex items-center gap-2">
                <span>✓</span> {{ session('success') }}
            </div>
        @endif

        <!-- Received Tab -->
        <div x-show="tab === 'received'" class="space-y-4">
            @forelse($received as $interest)
                <div class="card-ledger bg-[var(--bg-surface)] p-4 sm:p-5 border border-[var(--border-default)] flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <a href="{{ route('discovery.show', $interest->sender_id) }}" class="w-12 h-12 rounded-[var(--radius-sm)] overflow-hidden bg-[var(--neutral-900)] shrink-0 border border-[var(--border-default)] block group cursor-pointer" title="View Candidate Profile">
                            @if($interest->sender->profile?->primaryPhoto)
                                <img src="{{ $interest->sender->profile->primaryPhoto->displayUrl() }}" alt="{{ $interest->sender->name }}" class="w-full h-full object-cover photo-shield group-hover:scale-105 transition" loading="lazy" decoding="async">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-[var(--bg-subtle)] text-[var(--accent-primary)] font-bold text-lg">
                                    {{ substr($interest->sender->name, 0, 1) }}
                                </div>
                            @endif
                        </a>
                        <div>
                            <div class="flex items-center gap-1.5 flex-wrap">
                                <a href="{{ route('discovery.show', $interest->sender_id) }}" class="font-bold text-sm text-[var(--text-primary)] hover:text-[var(--accent-primary)]">
                                    {{ $interest->sender->name }}
                                </a>
                                @if($interest->sender->isPro())
                                    <span class="text-[9px] font-extrabold uppercase px-1.5 py-0.5 rounded-[var(--radius-sm)] bg-[var(--accent-primary)] text-white" title="Sender has a Single Marriage Pass">
                                        PRIORITY
                                    </span>
                                @endif
                                @if($interest->sender->is_verified)
                                    <span class="badge-verified text-[10px]">Verified</span>
                                @endif
                                <a href="{{ route('discovery.show', $interest->sender_id) }}" class="text-[11px] font-semibold text-[var(--accent-primary)] hover:underline ml-1">
                                    View Profile ↗
                                </a>
                            </div>
                            <p class="text-xs text-[var(--text-muted)] mt-0.5">
                                {{ $interest->sender->age }} yrs &bull; {{ $interest->sender->profile?->city ?? 'Location flexible' }}, {{ $interest->sender->profile?->country ?? '' }} &bull;
                                <span class="text-[var(--accent-primary)] font-medium">{{ $interest->sender->profile?->tradition_label ?? 'Practicing' }}</span>
                            </p>
                            @if($interest->message_note)
                                <p class="text-xs text-[var(--text-secondary)] bg-[var(--bg-subtle)] p-2 rounded-[var(--radius-sm)] mt-2 italic border border-[var(--border-subtle)]">
                                    &ldquo;{{ $interest->message_note }}&rdquo;
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center gap-2 w-full sm:w-auto justify-end flex-wrap">
                        <a href="{{ route('discovery.show', $interest->sender_id) }}" class="btn-secondary text-xs !py-1.5 !px-3">
                            <span>View Profile</span>
                        </a>
                        @if($interest->status === 'pending')
                            <form action="{{ route('interests.respond', $interest->id) }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="action" value="accept">
                                <button type="submit" class="btn-primary text-xs !py-1.5 !px-3.5">
                                    Accept Proposal
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
                            <div class="text-right">
                                <span class="badge-status bg-[var(--color-success-subtle)] text-[var(--color-success)] border border-[var(--color-success)]/30 text-xs">
                                    Accepted
                                </span>
                                <a href="{{ $interest->conversation ? route('chat.show', $interest->conversation->id) : route('chat.user', $interest->sender_id) }}" class="block text-xs text-[var(--accent-primary)] font-semibold hover:underline mt-1">
                                    Open Chat &rarr;
                                </a>
                            </div>
                        @elseif($interest->status === 'closed_married')
                            <span class="badge-status text-xs bg-[var(--bg-subtle)] text-[var(--text-primary)] border border-[var(--border-default)]">
                                Concluded (Mangala Vivaha)
                            </span>
                        @else
                            <span class="badge-status text-xs bg-[var(--bg-subtle)] text-[var(--text-muted)] border border-[var(--border-default)] capitalize">
                                {{ $interest->status }}
                            </span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="card-ledger bg-[var(--bg-surface)] p-10 border border-[var(--border-default)] text-center">
                    <p class="text-xs font-semibold text-[var(--text-secondary)]">No proposal requests received yet.</p>
                    <p class="text-[11px] text-[var(--text-muted)] mt-0.5">Complete your Dhamma profile to increase discovery visibility!</p>
                </div>
            @endforelse
        </div>

        <!-- Sent Tab -->
        <div x-show="tab === 'sent'" x-cloak class="space-y-4">
            @forelse($sent as $interest)
                <div class="card-ledger bg-[var(--bg-surface)] p-4 sm:p-5 border border-[var(--border-default)] flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <a href="{{ route('discovery.show', $interest->recipient_id) }}" class="w-12 h-12 rounded-[var(--radius-sm)] overflow-hidden bg-[var(--neutral-900)] shrink-0 border border-[var(--border-default)] block group cursor-pointer" title="View Candidate Profile">
                            @if($interest->recipient->profile?->primaryPhoto)
                                <img src="{{ $interest->recipient->profile->primaryPhoto->displayUrl() }}" alt="{{ $interest->recipient->name }}" class="w-full h-full object-cover photo-shield group-hover:scale-105 transition" loading="lazy" decoding="async">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-[var(--bg-subtle)] text-[var(--accent-primary)] font-bold text-lg">
                                    {{ substr($interest->recipient->name, 0, 1) }}
                                </div>
                            @endif
                        </a>
                        <div>
                            <div class="flex items-center gap-1.5 flex-wrap">
                                <a href="{{ route('discovery.show', $interest->recipient_id) }}" class="font-bold text-sm text-[var(--text-primary)] hover:text-[var(--accent-primary)]">
                                    {{ $interest->recipient->name }}
                                </a>
                                <a href="{{ route('discovery.show', $interest->recipient_id) }}" class="text-[11px] font-semibold text-[var(--accent-primary)] hover:underline ml-1">
                                    View Profile ↗
                                </a>
                            </div>
                            <p class="text-xs text-[var(--text-muted)] mt-0.5">
                                {{ $interest->recipient->age }} yrs &bull; {{ $interest->recipient->profile?->city ?? 'Location flexible' }}, {{ $interest->recipient->profile?->country ?? '' }}
                            </p>
                            <span class="text-[10px] text-[var(--text-muted)] block mt-0.5">Sent on {{ $interest->created_at->format('d/m/Y') }}</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 flex-wrap">
                        <a href="{{ route('discovery.show', $interest->recipient_id) }}" class="btn-secondary text-xs !py-1.5 !px-3">
                            <span>View Profile</span>
                        </a>
                        @if($interest->status === 'accepted')
                            @if($interest->wali_approval_status === 'pending')
                                <span class="badge-status text-xs bg-[var(--bg-subtle)] text-[var(--text-secondary)] border border-[var(--border-default)]">
                                    Awaiting Family Rep Approval
                                </span>
                            @else
                                <span class="badge-status bg-[var(--color-success-subtle)] text-[var(--color-success)] border border-[var(--color-success)]/30 text-xs">
                                    ✓ Accepted &amp; Unlocked
                                </span>
                                <a href="{{ $interest->conversation ? route('chat.show', $interest->conversation->id) : route('chat.user', $interest->recipient_id) }}" class="btn-primary text-xs !py-1.5 !px-3">
                                    Open Chat
                                </a>
                            @endif
                        @elseif($interest->status === 'pending')
                            <span class="badge-status bg-[var(--accent-subtle)] text-[var(--accent-primary)] border border-[var(--accent-primary)]/30 text-xs">
                                Pending Recipient Response
                            </span>
                        @elseif($interest->status === 'closed_married')
                            <span class="badge-status text-xs bg-[var(--bg-subtle)] text-[var(--text-primary)] border border-[var(--border-default)]">
                                Concluded (Mangala Vivaha)
                            </span>
                        @else
                            <span class="badge-status text-xs bg-[var(--bg-subtle)] text-[var(--text-muted)] border border-[var(--border-default)] capitalize">
                                {{ $interest->status }}
                            </span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="card-ledger bg-[var(--bg-surface)] p-10 border border-[var(--border-default)] text-center">
                    <p class="text-xs font-semibold text-[var(--text-secondary)]">You haven't sent any proposal requests yet.</p>
                    <a href="{{ route('discovery.index') }}" class="btn-primary inline-block mt-3 text-xs !py-2 !px-4">
                        Browse Candidates
                    </a>
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection
