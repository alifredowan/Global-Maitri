@extends('layouts.app')

@section('title', 'Family Representative Console - Global Maitri')

@section('content')
<div class="py-10 bg-slate-50 dark:bg-slate-950 min-h-screen">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <!-- Top Atmospheric Banner -->
        <div class="bg-gradient-to-r from-rose-950 via-slate-900 to-amber-950 rounded-3xl p-6 sm:p-8 text-white shadow-md border border-amber-900/40 relative overflow-hidden">
            <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
            <div class="relative flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <div class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full bg-rose-500/20 text-rose-300 text-xs font-semibold uppercase tracking-wider mb-2">
                        <span>🛡️</span>
                        <span>Family Representative Console</span>
                    </div>
                    <h1 class="font-heading font-extrabold text-2xl sm:text-3xl text-white">
                        Family Oversight & Matrimonial Guidance Center
                    </h1>
                    <p class="text-xs text-rose-100/80 mt-1 max-w-2xl leading-relaxed">
                        Mindful matrimonial facilitation empowering trusted parents, elders, and advisors to review suitor proposals, offer moral counsel, and foster harmonious lifelong companionship.
                    </p>
                </div>
                <span class="px-3.5 py-1.5 rounded-full text-xs font-bold bg-white/10 backdrop-blur-md text-amber-200 border border-white/15 self-start md:self-center shrink-0">
                    ✓ Representative Oversight Active
                </span>
            </div>
        </div>

        @if(session('success'))
            <div class="p-4 rounded-2xl bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-200 text-xs font-semibold flex items-center gap-2">
                <span>✓</span> {{ session('success') }}
            </div>
        @endif

        @if(session('info'))
            <div class="p-4 rounded-2xl bg-blue-50 dark:bg-blue-950/60 border border-blue-200 dark:border-blue-800 text-blue-800 dark:text-blue-200 text-xs font-semibold flex items-center gap-2">
                <span>ℹ️</span> {{ session('info') }}
            </div>
        @endif

        <!-- Pending Interest Approvals (FR-4.3) -->
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <h2 class="text-base font-bold text-slate-900 dark:text-white font-heading flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-amber-500 animate-pulse"></span>
                    Pending Proposal Approvals Requiring Your Review
                </h2>
                <span class="text-xs text-slate-500 dark:text-slate-400">{{ $pendingInterests->count() }} awaiting review</span>
            </div>

            @forelse($pendingInterests as $pi)
                <div class="bg-white dark:bg-slate-900 rounded-3xl border-2 border-purple-100 dark:border-purple-900/60 p-6 shadow-xs flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-2xl bg-slate-800 overflow-hidden shrink-0 border border-slate-200 dark:border-slate-700">
                            @if($pi->sender->profile?->primaryPhoto)
                                <img src="{{ $pi->sender->profile->primaryPhoto->displayUrl() }}" alt="{{ $pi->sender->name }}" class="w-full h-full object-cover" loading="lazy" decoding="async">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-rose-950 to-slate-900 text-amber-200 font-bold text-2xl">
                                    {{ substr($pi->sender->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <span class="text-[10px] font-bold text-purple-700 dark:text-purple-400 uppercase tracking-wider block">Proposal for: {{ $pi->recipient->name }}</span>
                            <h3 class="font-bold text-base text-slate-900 dark:text-white">{{ $pi->sender->name }}</h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400">
                                {{ $pi->sender->age }} yrs • {{ $pi->sender->profile?->city }}, {{ $pi->sender->profile?->country }} •
                                <span class="font-semibold text-primary-800 dark:text-primary-300">{{ $pi->sender->profile?->tradition_label }}</span>
                            </p>
                            @if($pi->message_note)
                                <p class="text-xs text-slate-600 dark:text-slate-300 bg-slate-50 dark:bg-slate-800/60 p-2.5 rounded-xl border border-slate-100 dark:border-slate-800 mt-2 italic">
                                    &ldquo;{{ $pi->message_note }}&rdquo;
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center gap-3 w-full md:w-auto justify-end">
                        <a href="{{ route('discovery.show', $pi->sender_id) }}" target="_blank" class="px-4 py-2 rounded-xl border border-slate-300 dark:border-slate-700 text-xs font-semibold text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition">
                            Inspect Profile
                        </a>
                        <form action="{{ route('wali.interests.approve', $pi->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-4 py-2 rounded-xl bg-primary-700 hover:bg-primary-800 text-white text-xs font-bold shadow-xs transition cursor-pointer">
                                ✓ Approve Proposal
                            </button>
                        </form>
                        <form action="{{ route('wali.interests.reject', $pi->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-3 py-2 rounded-xl bg-rose-50 dark:bg-rose-950/40 hover:bg-rose-100 dark:hover:bg-rose-900/60 text-rose-700 dark:text-rose-300 border border-rose-200 dark:border-rose-900/40 text-xs font-bold transition cursor-pointer">
                                Decline
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 p-8 text-center text-xs text-slate-500 dark:text-slate-400">
                    No pending proposal requests awaiting your approval right now.
                </div>
            @endforelse
        </div>

        <!-- My Linked Candidates (Seekers) -->
        <div class="space-y-4">
            <h2 class="text-base font-bold text-slate-900 dark:text-white font-heading">My Linked Candidates</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($wards as $wardLink)
                    <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 p-5 shadow-xs flex items-center justify-between">
                        <div class="flex items-center gap-3.5">
                            <div class="w-12 h-12 rounded-2xl bg-rose-100 dark:bg-rose-950/70 text-primary-800 dark:text-primary-300 font-bold flex items-center justify-center text-base border border-rose-200 dark:border-rose-800/60">
                                {{ substr($wardLink->seeker->name, 0, 1) }}
                            </div>
                            <div>
                                <h3 class="font-bold text-sm text-slate-900 dark:text-white">{{ $wardLink->seeker->name }}</h3>
                                <p class="text-[11px] text-slate-500 dark:text-slate-400">
                                    {{ $wardLink->seeker->age }} yrs • {{ ucfirst(str_replace('_', ' ', $wardLink->relationship_type)) }} • {{ str_replace('_', ' ', $wardLink->permission_level) }}
                                </p>
                            </div>
                        </div>
                        <a href="{{ route('discovery.show', $wardLink->seeker_id) }}" class="px-3 py-1.5 rounded-xl border border-slate-200 dark:border-slate-700 text-xs font-semibold text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition">
                            View Profile &rarr;
                        </a>
                    </div>
                @empty
                    <div class="col-span-full bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 p-8 text-center text-xs text-slate-500 dark:text-slate-400">
                        No candidates are currently linked to your representative account.
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</div>
@endsection
