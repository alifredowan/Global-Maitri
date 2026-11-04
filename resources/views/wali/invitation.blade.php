@extends('layouts.app')

@section('title', 'Family Representative Invitation - Global Maitri')

@section('content')
<div class="py-12 bg-slate-50 dark:bg-slate-950 min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl w-full space-y-6">

        <!-- Header Banner -->
        <div class="text-center space-y-2">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-rose-100 text-primary-800 dark:bg-rose-900/50 dark:text-rose-300 border border-rose-200 dark:border-rose-800">
                <span>🛡️</span> Buddhist Matrimonial Family Guidance
            </span>
            <p class="font-serif text-lg sm:text-xl text-amber-700 dark:text-amber-400 font-semibold">Namo Buddhaya</p>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white font-heading">
                Family Representative Connection Request
            </h1>
            <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 max-w-lg mx-auto">
                You have been invited to act as a Family Representative & Advisor on <strong class="text-slate-900 dark:text-white">Global Maitri</strong>.
            </p>
        </div>

        <!-- Main Card -->
        <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-xl overflow-hidden p-6 sm:p-8 space-y-6">

            <!-- Seeker Profile Preview -->
            <div class="flex flex-col sm:flex-row items-center gap-5 p-5 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700/60">
                <div class="relative w-20 h-20 rounded-2xl overflow-hidden bg-rose-100 dark:bg-rose-950 flex items-center justify-center text-3xl font-bold text-primary-700 dark:text-primary-400 border-2 border-primary-500/20 shadow-xs flex-shrink-0">
                    @if($link->seeker->profile?->primaryPhoto)
                        <img src="{{ $link->seeker->profile->primaryPhoto->displayUrl() }}" alt="{{ $link->seeker->name }}" class="w-full h-full object-cover" loading="lazy" decoding="async">
                    @else
                        {{ strtoupper(substr($link->seeker->name, 0, 1)) }}
                    @endif
                </div>

                <div class="text-center sm:text-left flex-1 min-w-0">
                    <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2 mb-1">
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white font-heading truncate">{{ $link->seeker->name }}</h2>
                        <span class="px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-rose-100 text-primary-800 dark:bg-rose-900/60 dark:text-rose-300">
                            {{ ucfirst($link->seeker->gender) }}
                        </span>
                        @if($link->seeker->profile?->age)
                            <span class="px-2 py-0.5 rounded-full text-[11px] font-medium bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-300">
                                {{ $link->seeker->profile->age }} yrs old
                            </span>
                        @endif
                    </div>

                    <p class="text-xs text-slate-600 dark:text-slate-400">
                        Designated Relationship:
                        <strong class="text-amber-600 dark:text-amber-400 uppercase tracking-wide font-bold">
                            {{ ucfirst(str_replace('_', ' ', $link->relationship_type)) }}
                        </strong>
                    </p>

                    @if($link->seeker->profile?->city || $link->seeker->profile?->country)
                        <p class="text-[11px] text-slate-500 dark:text-slate-500 mt-0.5 flex items-center justify-center sm:justify-start gap-1">
                            <span>📍</span> {{ $link->seeker->profile->city ? $link->seeker->profile->city . ', ' : '' }}{{ $link->seeker->profile->country ?? '' }}
                        </p>
                    @endif
                </div>
            </div>

            <!-- Permission & Role Details -->
            <div class="space-y-3">
                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Representative Privileges & Supervision Level</h3>
                <div class="p-4 rounded-2xl bg-amber-500/5 border border-amber-500/20 text-xs space-y-2">
                    <div class="flex items-start gap-2.5">
                        <span class="text-amber-600 dark:text-amber-400 text-sm mt-0.5">🔒</span>
                        <div>
                            <span class="font-bold text-slate-900 dark:text-white">Permission Level:</span>
                            <span class="text-slate-700 dark:text-slate-300 ml-1">
                                @if($link->permission_level === 'approve_required')
                                    <strong>Approval Required</strong> — Suitors cannot chat with {{ $link->seeker->name }} until you review and grant explicit approval.
                                @elseif($link->permission_level === 'full_proxy')
                                    <strong>Full Proxy</strong> — You manage incoming communications and represent {{ $link->seeker->name }} in discussions.
                                @else
                                    <strong>Observer / View Only</strong> — You are automatically added as an elder observer in conversations.
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="flex items-start gap-2.5">
                        <span class="text-amber-600 dark:text-amber-400 text-sm mt-0.5">✉️</span>
                        <div>
                            <span class="font-bold text-slate-900 dark:text-white">Representative Email:</span>
                            <span class="text-slate-700 dark:text-slate-300 ml-1">{{ $link->wali_email ?: 'Not specified' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Buddhist Family Principle Note -->
            <div class="p-4 rounded-2xl bg-rose-500/5 border border-rose-500/20 text-xs text-slate-600 dark:text-slate-400 space-y-1.5">
                <p class="font-semibold text-primary-800 dark:text-primary-300 flex items-center gap-1.5">
                    <span>🪷</span> Blessing of the Elders (Mangala Sutta)
                </p>
                <p class="italic text-slate-600 dark:text-slate-300">
                    &ldquo;Honoring those who are worthy of honor — this is the supreme blessing.&rdquo;
                </p>
                <p class="text-[11px] text-slate-500 dark:text-slate-400">
                    Global Maitri honors the role of parents and respected elders in fostering mindful, harmonious marriages.
                </p>
            </div>

            <!-- Action Status / Buttons -->
            @if($link->status === 'active')
                <div class="p-4 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-center space-y-2">
                    <span class="text-2xl">✅</span>
                    <h4 class="text-sm font-bold text-emerald-800 dark:text-emerald-200">Representative Connection Active</h4>
                    <p class="text-xs text-emerald-700 dark:text-emerald-400">
                        You are active as the verified family representative for {{ $link->seeker->name }}.
                    </p>
                    <div class="pt-2">
                        <a href="{{ route('wali.dashboard') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-primary-700 hover:bg-primary-800 text-white font-semibold text-xs transition shadow-xs">
                            Go to Representative Dashboard &rarr;
                        </a>
                    </div>
                </div>
            @elseif($link->status === 'declined')
                <div class="p-4 rounded-2xl bg-rose-50 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-800 text-center space-y-1">
                    <span class="text-2xl">❌</span>
                    <h4 class="text-sm font-bold text-rose-800 dark:text-rose-200">Connection Declined</h4>
                    <p class="text-xs text-rose-600 dark:text-rose-400">
                        This family representative connection request was declined.
                    </p>
                </div>
            @else
                <div class="space-y-3 pt-2">
                    <form action="{{ route('wali.invite.accept', $link->invite_token) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full py-3.5 px-6 rounded-2xl bg-primary-700 hover:bg-primary-800 text-white font-bold text-sm shadow-lg shadow-primary-950/20 transition-all flex items-center justify-center gap-2 cursor-pointer">
                            <span>🛡️</span> Accept & Confirm Family Connection
                        </button>
                    </form>

                    <form action="{{ route('wali.invite.decline', $link->invite_token) }}" method="POST">
                        @csrf
                        <button type="submit" onclick="return confirm('Are you sure you want to decline this connection request?');" class="w-full py-2.5 px-4 rounded-xl text-xs font-semibold text-slate-500 dark:text-slate-400 hover:text-rose-600 dark:hover:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-950/20 transition cursor-pointer text-center">
                            Decline Request
                        </button>
                    </form>
                </div>
            @endif

        </div>

        <!-- Footer Help -->
        <p class="text-center text-xs text-slate-500 dark:text-slate-400">
            Need help? Reach out to our family support team at <a href="mailto:info@globalmaitri.com" class="text-primary-700 dark:text-primary-400 hover:underline">info@globalmaitri.com</a>
        </p>

    </div>
</div>
@endsection
