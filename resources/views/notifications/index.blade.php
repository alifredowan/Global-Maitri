@extends('layouts.app')

@section('title', 'Notifications - Global Maitri')

@section('content')
<div class="py-8 bg-[var(--bg-canvas)] min-h-screen transition-colors">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
            <div>
                <h1 class="text-2xl font-bold font-heading text-[var(--text-primary)] flex items-center gap-2">
                    <svg class="w-6 h-6 text-[var(--accent-primary)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    Notifications
                </h1>
                <p class="text-xs text-[var(--text-secondary)] mt-1">
                    Stay updated with real-time proposal requests, family representative updates, and mindful chat messages.
                </p>
            </div>

            @if(Auth::user()->unreadNotifications->count() > 0)
                <form action="{{ route('notifications.read-all') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-secondary text-xs px-4 py-2 font-bold cursor-pointer">
                        &check; Mark All as Read
                    </button>
                </form>
            @endif
        </div>

        <!-- Notification List -->
        <div class="space-y-3">
            @forelse($notifications as $n)
                @php
                    $data = $n->data;
                    $isUnread = is_null($n->read_at);
                    $type = $data['type'] ?? 'general';
                    $candidateUserId = $data['candidate_id'] ?? $data['sender_id'] ?? $data['recipient_id'] ?? null;
                    $candidateProfileUrl = $candidateUserId ? route('discovery.show', $candidateUserId) : null;
                    $actionUrl = !empty($data['action_url']) ? $data['action_url'] : $candidateProfileUrl;
                    if ($type === 'interest_received' && $candidateProfileUrl) {
                        $actionUrl = $candidateProfileUrl;
                    }
                    $currentInterest = !empty($data['interest_id']) && isset($interests[$data['interest_id']]) ? $interests[$data['interest_id']] : null;
                    $interestStatus = $currentInterest ? $currentInterest->status : null;
                @endphp

                <div class="p-4 sm:p-5 rounded-[4px] border transition {{ $isUnread ? 'bg-[var(--bg-surface)] border-[var(--accent-primary)] ring-1 ring-[var(--accent-primary)]/20 shadow-xs' : 'bg-[var(--bg-surface)]/80 border-[var(--border-default)]' }}">
                    <div class="flex items-start justify-between gap-3">
                        <div class="flex items-start gap-3.5 flex-1 min-w-0">
                            @if($candidateProfileUrl)
                                <a href="{{ $candidateProfileUrl }}" class="w-10 h-10 rounded-[4px] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] flex items-center justify-center shrink-0 border border-[var(--accent-primary)]/20 transition cursor-pointer" title="View Candidate Profile">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </a>
                            @else
                                <div class="w-10 h-10 rounded-[4px] bg-[var(--bg-subtle)] text-[var(--accent-primary)] flex items-center justify-center shrink-0 border border-[var(--border-default)]">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                    </svg>
                                </div>
                            @endif
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <h3 class="text-sm font-bold text-[var(--text-primary)]">
                                        {{ $data['title'] ?? 'Notification' }}
                                    </h3>
                                    @if($isUnread)
                                        <span class="inline-block w-2 h-2 rounded-full bg-[var(--accent-primary)]"></span>
                                    @endif
                                </div>
                                <p class="text-xs text-[var(--text-secondary)] mt-1 leading-relaxed">
                                    @if($type === 'interest_received' && !empty($data['sender_name']) && $candidateProfileUrl)
                                        <a href="{{ $candidateProfileUrl }}" class="font-bold text-[var(--accent-primary)] hover:underline">
                                            {{ $data['sender_name'] }}
                                        </a>
                                        has sent you an expression of interest!
                                    @else
                                        {{ $data['message'] ?? '' }}
                                    @endif
                                </p>

                                @if(!empty($data['note']))
                                    <div class="mt-2 text-xs bg-[var(--bg-subtle)] p-2.5 rounded-[4px] border border-[var(--border-default)] text-[var(--text-primary)] italic">
                                        &ldquo;{{ $data['note'] }}&rdquo;
                                    </div>
                                @endif

                                <!-- Action Buttons -->
                                <div class="flex items-center gap-2.5 mt-3 flex-wrap">
                                    @if($candidateProfileUrl)
                                        <a href="{{ $candidateProfileUrl }}" class="btn-secondary text-xs px-3.5 py-1.5 flex items-center gap-1.5 cursor-pointer">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                            View Profile &amp; Biodata
                                        </a>
                                    @endif

                                    @if($type === 'interest_received' && !empty($data['interest_id']))
                                        @if($interestStatus === 'accepted')
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-[4px] bg-[var(--bg-subtle)] text-[var(--color-success)] text-xs font-bold border border-[var(--color-success)]">
                                                <span>✓</span> Interest Accepted
                                            </span>
                                            @if($currentInterest && $currentInterest->conversation)
                                                <a href="{{ route('chat.show', $currentInterest->conversation->id) }}" class="text-xs font-bold text-[var(--accent-primary)] hover:underline inline-flex items-center gap-1">
                                                    <span>Open Messages &rarr;</span>
                                                </a>
                                            @endif
                                        @elseif($interestStatus === 'declined')
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-[4px] bg-[var(--bg-subtle)] text-[var(--text-muted)] text-xs font-semibold capitalize border border-[var(--border-default)]">
                                                <span>✕</span> Declined
                                            </span>
                                        @else
                                            <!-- Direct Accept & Decline Buttons -->
                                            <form action="{{ route('interests.respond', $data['interest_id']) }}" method="POST" class="inline">
                                                @csrf
                                                <input type="hidden" name="action" value="accept">
                                                <button type="submit" class="btn-primary text-xs px-3.5 py-1.5 font-bold cursor-pointer">
                                                    &check; Accept Interest
                                                </button>
                                            </form>

                                            <form action="{{ route('interests.respond', $data['interest_id']) }}" method="POST" class="inline">
                                                @csrf
                                                <input type="hidden" name="action" value="decline">
                                                <button type="submit" class="btn-secondary text-xs px-3.5 py-1.5 font-bold cursor-pointer text-[var(--color-danger)]">
                                                    ✕ Decline
                                                </button>
                                            </form>
                                        @endif
                                    @endif

                                    @if(!empty($actionUrl) && $actionUrl !== $candidateProfileUrl)
                                        <a href="{{ $actionUrl }}" class="text-xs font-bold text-[var(--accent-primary)] hover:underline">
                                            View Details &rarr;
                                        </a>
                                    @endif

                                    @if($isUnread)
                                        <form action="{{ route('notifications.read', $n->id) }}" method="POST" class="inline ml-auto">
                                            @csrf
                                            <button type="submit" class="text-[11px] text-[var(--text-muted)] hover:text-[var(--text-primary)] cursor-pointer">
                                                Mark as read
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <span class="text-[11px] text-[var(--text-muted)] whitespace-nowrap shrink-0">
                            {{ $n->created_at->diffForHumans() }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="py-16 text-center card-ledger p-8">
                    <div class="w-14 h-14 mx-auto rounded-[4px] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] flex items-center justify-center mb-3">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-[var(--text-primary)] mb-1">No notifications yet</h3>
                    <p class="text-xs text-[var(--text-secondary)] max-w-sm mx-auto">
                        When candidate seekers express interest, guardians approve requests, or new messages arrive, you will receive real-time notifications here.
                    </p>
                </div>
            @endforelse
        </div>

        @if($notifications->hasPages())
            <div class="mt-6">
                {{ $notifications->links() }}
            </div>
        @endif

    </div>
</div>
@endsection
