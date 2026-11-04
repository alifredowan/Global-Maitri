@extends('layouts.app')

@section('title', 'My Proposals - Global Maitri')

@section('content')
<div class="py-10 bg-slate-50 dark:bg-slate-950 min-h-screen" x-data="{ tab: 'received' }">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-xs flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-1.5 text-[10px] font-extrabold uppercase tracking-widest text-primary-700 dark:text-primary-300 mb-1">
                    <span>💌</span>
                    <span>Proposals & Introductions</span>
                </div>
                <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white font-heading">Matrimonial Proposals</h1>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Review expressions of interest sent and received with loving-kindness (FR-4.1).</p>
            </div>
            <!-- Tab Buttons -->
            <div class="flex items-center bg-slate-100 dark:bg-slate-800 p-1 rounded-2xl">
                <button @click="tab = 'received'" :class="tab === 'received' ? 'bg-white dark:bg-slate-700 shadow-xs text-primary-900 dark:text-primary-200 font-bold' : 'text-slate-600 dark:text-slate-400 font-medium'" class="px-4 py-2 rounded-xl text-xs transition cursor-pointer">
                    Received ({{ $received->count() }})
                </button>
                <button @click="tab = 'sent'" :class="tab === 'sent' ? 'bg-white dark:bg-slate-700 shadow-xs text-primary-900 dark:text-primary-200 font-bold' : 'text-slate-600 dark:text-slate-400 font-medium'" class="px-4 py-2 rounded-xl text-xs transition cursor-pointer">
                    Sent ({{ $sent->count() }})
                </button>
            </div>
        </div>

        @if(session('success'))
            <div class="p-4 rounded-2xl bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-200 text-xs font-semibold flex items-center gap-2">
                <span>✓</span> {{ session('success') }}
            </div>
        @endif

        <!-- Received Tab -->
        <div x-show="tab === 'received'" class="space-y-4">
            @forelse($received as $interest)
                <div class="bg-white dark:bg-slate-900 p-5 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-xs flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <a href="{{ route('discovery.show', $interest->sender_id) }}" class="w-14 h-14 rounded-2xl overflow-hidden bg-slate-800 shrink-0 hover:ring-2 hover:ring-primary-500 transition block group cursor-pointer" title="View Candidate Profile">
                            @if($interest->sender->profile?->primaryPhoto)
                                <img src="{{ $interest->sender->profile->primaryPhoto->displayUrl() }}" alt="{{ $interest->sender->name }}" class="w-full h-full object-cover photo-blur group-hover:scale-105 transition" loading="lazy" decoding="async">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-rose-950 to-slate-900 text-amber-200 font-bold text-xl group-hover:bg-rose-900 transition">
                                    {{ substr($interest->sender->name, 0, 1) }}
                                </div>
                            @endif
                        </a>
                        <div>
                            <div class="flex items-center gap-1.5 flex-wrap">
                                <a href="{{ route('discovery.show', $interest->sender_id) }}" class="font-bold text-sm text-slate-900 dark:text-white hover:text-primary-700 dark:hover:text-primary-400 hover:underline">
                                    {{ $interest->sender->name }}
                                </a>
                                @if($interest->sender->isPro())
                                    <span class="bg-amber-500 text-slate-950 text-[9px] font-black px-1.5 py-0.5 rounded-full flex items-center gap-0.5 shadow-2xs" title="Sender has a Single Marriage Pass">
                                        🌟 PRIORITY PROPOSAL
                                    </span>
                                @endif
                                @if($interest->sender->is_verified)
                                    <span class="bg-blue-600 text-white text-[9px] font-bold px-1.5 py-0.2 rounded-full">✓ Verified</span>
                                @endif
                                <a href="{{ route('discovery.show', $interest->sender_id) }}" class="text-[11px] font-semibold text-primary-700 dark:text-primary-400 hover:underline ml-1">
                                    View Profile ↗
                                </a>
                            </div>
                            <p class="text-xs text-slate-500 dark:text-slate-400">
                                {{ $interest->sender->age }} yrs • {{ $interest->sender->profile?->city ?? 'Location not specified' }}, {{ $interest->sender->profile?->country ?? '' }} •
                                <span class="text-primary-700 dark:text-primary-400 font-medium">{{ $interest->sender->profile?->tradition_label ?? 'Practicing' }}</span>
                            </p>
                            @if($interest->message_note)
                                <p class="text-xs text-slate-600 dark:text-slate-300 bg-slate-50 dark:bg-slate-800/60 p-2.5 rounded-xl mt-2 italic leading-relaxed">
                                    &ldquo;{{ $interest->message_note }}&rdquo;
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center gap-2 w-full sm:w-auto justify-end flex-wrap">
                        <a href="{{ route('discovery.show', $interest->sender_id) }}" class="px-3.5 py-2 rounded-xl bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 border border-slate-300 dark:border-slate-700 text-xs font-bold transition flex items-center gap-1.5 shadow-2xs cursor-pointer">
                            <span>👤</span> View Profile
                        </a>
                        @if($interest->status === 'pending')
                            <form action="{{ route('interests.respond', $interest->id) }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="action" value="accept">
                                <button type="submit" class="px-4 py-2 rounded-xl bg-primary-700 hover:bg-primary-800 text-white text-xs font-bold shadow-xs transition cursor-pointer">
                                    Accept Proposal
                                </button>
                            </form>
                            <form action="{{ route('interests.respond', $interest->id) }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="action" value="decline">
                                <button type="submit" class="px-3 py-2 rounded-xl border border-slate-300 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 text-xs font-semibold transition cursor-pointer">
                                    Decline
                                </button>
                            </form>
                        @elseif($interest->status === 'accepted')
                            <div class="text-right">
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-300">
                                    Accepted
                                </span>
                                <a href="{{ $interest->conversation ? route('chat.show', $interest->conversation->id) : route('chat.user', $interest->sender_id) }}" class="block text-xs text-primary-700 dark:text-primary-400 font-bold hover:underline mt-1">
                                    Open Chat &rarr;
                                </a>
                            </div>
                        @elseif($interest->status === 'closed_married')
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-purple-100 dark:bg-purple-950/70 text-purple-800 dark:text-purple-300 border border-purple-200 dark:border-purple-800/60">
                                🪷 Concluded (Mangala Vivaha)
                            </span>
                        @else
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 capitalize">
                                {{ $interest->status }}
                            </span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="bg-white dark:bg-slate-900 p-12 rounded-3xl border border-slate-200 dark:border-slate-800 text-center">
                    <p class="text-sm font-semibold text-slate-600 dark:text-slate-300">No proposal requests received yet.</p>
                    <p class="text-xs text-slate-400 dark:text-slate-500 mt-1">Complete your Dhamma profile to increase discovery visibility!</p>
                </div>
            @endforelse
        </div>

        <!-- Sent Tab -->
        <div x-show="tab === 'sent'" x-cloak class="space-y-4">
            @forelse($sent as $interest)
                <div class="bg-white dark:bg-slate-900 p-5 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-xs flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <a href="{{ route('discovery.show', $interest->recipient_id) }}" class="w-14 h-14 rounded-2xl overflow-hidden bg-slate-800 shrink-0 hover:ring-2 hover:ring-primary-500 transition block group cursor-pointer" title="View Candidate Profile">
                            @if($interest->recipient->profile?->primaryPhoto)
                                <img src="{{ $interest->recipient->profile->primaryPhoto->displayUrl() }}" alt="{{ $interest->recipient->name }}" class="w-full h-full object-cover photo-blur group-hover:scale-105 transition" loading="lazy" decoding="async">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-rose-950 to-slate-900 text-amber-200 font-bold text-xl group-hover:bg-rose-900 transition">
                                    {{ substr($interest->recipient->name, 0, 1) }}
                                </div>
                            @endif
                        </a>
                        <div>
                            <div class="flex items-center gap-1.5 flex-wrap">
                                <a href="{{ route('discovery.show', $interest->recipient_id) }}" class="font-bold text-sm text-slate-900 dark:text-white hover:text-primary-700 dark:hover:text-primary-400 hover:underline">
                                    {{ $interest->recipient->name }}
                                </a>
                                <a href="{{ route('discovery.show', $interest->recipient_id) }}" class="text-[11px] font-semibold text-primary-700 dark:text-primary-400 hover:underline ml-1">
                                    View Profile ↗
                                </a>
                            </div>
                            <p class="text-xs text-slate-500 dark:text-slate-400">
                                {{ $interest->recipient->age }} yrs • {{ $interest->recipient->profile?->city ?? 'Location not specified' }}, {{ $interest->recipient->profile?->country ?? '' }}
                            </p>
                            <span class="text-[11px] text-slate-400 dark:text-slate-500 block mt-1">Sent on {{ $interest->created_at->format('d/m/Y') }}</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 flex-wrap">
                        <a href="{{ route('discovery.show', $interest->recipient_id) }}" class="px-3.5 py-1.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 text-xs font-semibold transition flex items-center gap-1 shadow-2xs cursor-pointer">
                            <span>👤</span> View Profile
                        </a>
                        @if($interest->status === 'accepted')
                            @if($interest->wali_approval_status === 'pending')
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-purple-100 dark:bg-purple-950/80 text-purple-800 dark:text-purple-300">
                                    🛡️ Awaiting Family Rep Approval
                                </span>
                            @else
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-300">
                                    ✓ Accepted & Unlocked
                                </span>
                                <a href="{{ $interest->conversation ? route('chat.show', $interest->conversation->id) : route('chat.user', $interest->recipient_id) }}" class="px-3 py-1.5 rounded-xl bg-primary-700 hover:bg-primary-800 text-white text-xs font-bold transition">
                                    Open Chat
                                </a>
                            @endif
                        @elseif($interest->status === 'pending')
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 dark:bg-amber-950/80 text-amber-800 dark:text-amber-300">
                                ⏳ Pending Recipient Response
                            </span>
                        @elseif($interest->status === 'closed_married')
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-purple-100 dark:bg-purple-950/70 text-purple-800 dark:text-purple-300 border border-purple-200 dark:border-purple-800/60">
                                🪷 Concluded (Mangala Vivaha)
                            </span>
                        @else
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 capitalize">
                                {{ $interest->status }}
                            </span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="bg-white dark:bg-slate-900 p-12 rounded-3xl border border-slate-200 dark:border-slate-800 text-center">
                    <p class="text-sm font-semibold text-slate-600 dark:text-slate-300">You haven't sent any proposal requests yet.</p>
                    <a href="{{ route('discovery.index') }}" class="inline-block mt-3 px-4 py-2 rounded-xl bg-primary-700 text-white text-xs font-bold">
                        Browse Candidates
                    </a>
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection
