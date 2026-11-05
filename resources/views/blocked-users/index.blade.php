@extends('layouts.app')

@section('title', 'Blocked Profiles - Global Maitri')

@section('content')
<div class="min-h-screen bg-[var(--bg-canvas)] py-8 transition-colors">
    <div class="mx-auto max-w-4xl space-y-6 px-4 sm:px-6 lg:px-8">
        <section class="card-ledger p-6 sm:p-8">
            <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-[var(--accent-primary)]">Your safety controls</p>
            <h1 class="mt-2 font-heading text-3xl font-extrabold text-[var(--text-primary)]">Blocked profiles</h1>
            <p class="mt-2 max-w-2xl text-sm leading-relaxed text-[var(--text-secondary)]">Profiles you block are removed from your discovery results and cannot be opened from your account. You can reverse the decision whenever you are ready.</p>
        </section>

        @if(session('success'))
            <div class="rounded-[4px] border border-[var(--color-success)] bg-[var(--bg-subtle)] p-4 text-xs font-semibold text-[var(--color-success)] flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <section class="card-ledger p-6">
            <div class="flex items-center justify-between gap-4">
                <h2 class="font-heading text-lg font-extrabold text-[var(--text-primary)]">Your list</h2>
                <span class="rounded-[4px] bg-[var(--bg-subtle)] border border-[var(--border-default)] px-3 py-1 text-[11px] font-bold text-[var(--text-secondary)]">{{ $blockedUsers->count() }} {{ $blockedUsers->count() === 1 ? 'profile' : 'profiles' }}</span>
            </div>
            <div class="mt-5 divide-y divide-[var(--border-subtle)]">
                @forelse($blockedUsers as $blockedUser)
                    <div class="flex items-center justify-between gap-4 py-4 first:pt-0 last:pb-0">
                        <div class="flex min-w-0 items-center gap-3">
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center overflow-hidden rounded-[4px] bg-[#141412] font-bold text-[#e0b84c] border border-[var(--border-default)]">
                                @if($blockedUser->profile?->primaryPhoto)
                                    <img src="{{ $blockedUser->profile->primaryPhoto->displayUrl() }}" alt="{{ $blockedUser->name }}" class="photo-shield h-full w-full object-cover" loading="lazy" decoding="async">
                                @else
                                    {{ substr($blockedUser->name, 0, 1) }}
                                @endif
                            </div>
                            <div class="min-w-0">
                                <p class="truncate text-sm font-bold text-[var(--text-primary)]">{{ $blockedUser->name }}</p>
                                <p class="text-[11px] text-[var(--text-muted)]">Blocked {{ $blockedUser->pivot->created_at?->diffForHumans() ?? 'recently' }}</p>
                            </div>
                        </div>
                        <form action="{{ route('blocked-users.destroy', $blockedUser->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-secondary text-xs px-3 py-1.5 cursor-pointer">Unblock</button>
                        </form>
                    </div>
                @empty
                    <div class="py-10 text-center">
                        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-[4px] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-[var(--accent-primary)]">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <p class="mt-3 text-sm font-bold text-[var(--text-primary)]">No blocked profiles</p>
                        <p class="mt-1 text-xs text-[var(--text-muted)]">Your safety list is currently clear.</p>
                    </div>
                @endforelse
            </div>
        </section>
    </div>
</div>
@endsection
