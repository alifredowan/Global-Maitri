@extends('layouts.app')

@section('title', $targetUser->name . ' - Buddhist Matrimonial Profile | Global Maitri')

@section('content')
<div class="py-10 bg-slate-50 dark:bg-slate-950 min-h-screen">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <!-- Back Button & Breadcrumbs -->
        <div>
            <a href="{{ route('discovery.index') }}" class="text-xs font-semibold text-slate-500 dark:text-slate-400 hover:text-primary-700 dark:hover:text-primary-400 flex items-center gap-1">
                &larr; Back to match search
            </a>
        </div>

        <!-- Top Profile Banner Card -->
        <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200/80 dark:border-slate-800/80 shadow-sm overflow-hidden">
            <div class="h-36 sm:h-40 bg-gradient-to-r from-rose-950 via-slate-900 to-amber-950 relative">
                <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
                @if($compatibilityScore)
                    <div class="absolute top-4 right-6 bg-white/90 dark:bg-slate-900/90 backdrop-blur-md px-3.5 py-1.5 rounded-full shadow-sm flex items-center gap-2 text-xs font-bold text-primary-950 dark:text-primary-200 border border-white/20 dark:border-slate-700/50">
                        <span class="w-2 h-2 rounded-full bg-primary-500 animate-ping"></span>
                        {{ $compatibilityScore }}% Dhamma Compatibility (FR-6.4)
                    </div>
                @endif
            </div>
            <div class="px-6 pb-6 pt-0 relative">
                <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between gap-4 -mt-16 sm:-mt-20 mb-6">
                    <div class="flex items-end gap-4">
                        <div class="w-28 h-28 sm:w-32 sm:h-32 rounded-2xl overflow-hidden border-4 border-white dark:border-slate-900 bg-slate-800 shadow-xl relative shrink-0">
                            @if($profile->primaryPhoto)
                                <img src="{{ $profile->primaryPhoto->displayUrl() }}" alt="{{ $targetUser->name }}"
                                     class="w-full h-full object-cover {{ $isPhotoVisible ? '' : 'photo-blur' }}">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-rose-950 to-slate-900 text-amber-200 font-bold text-3xl">
                                    {{ substr($targetUser->name, 0, 1) }}
                                </div>
                            @endif
                            @if(!$isPhotoVisible)
                                <div class="absolute inset-0 flex items-center justify-center bg-black/40 text-[10px] text-white font-bold text-center px-1">
                                    🔒 Lotus Shield (FR-5.1)
                                </div>
                            @endif
                        </div>
                        <div>
                            <div class="flex items-center gap-2 flex-wrap">
                                <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white font-heading">{{ $targetUser->name }}</h1>
                                @if($targetUser->isPro())
                                    <span class="bg-amber-500 text-slate-950 text-[10px] font-black px-2.5 py-0.5 rounded-full flex items-center gap-1 shadow-xs" title="Single Marriage Pass Member">
                                        👑 PRO MEMBER
                                    </span>
                                @endif
                                @if($targetUser->is_verified)
                                    <span class="bg-blue-600 text-white text-[10px] font-bold px-2 py-0.5 rounded-full flex items-center gap-1" title="Government ID Verified (FR-1.4)">
                                        ✓ Verified Candidate
                                    </span>
                                @endif
                            </div>
                            <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">
                                {{ $targetUser->age }} years • {{ $profile->city }}, {{ $profile->country }} •
                                <span class="capitalize">{{ str_replace('_', ' ', $targetUser->marital_status) }}</span>
                            </p>
                            <div class="flex flex-wrap items-center gap-1.5 mt-2">
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-100 dark:bg-rose-950/80 text-rose-800 dark:text-rose-300">
                                    🪷 {{ $profile->tradition_label }}
                                </span>
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 dark:bg-amber-950/80 text-amber-800 dark:text-amber-300">
                                    🧘 {{ $profile->meditation_frequency_label }}
                                </span>
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 dark:bg-emerald-950/80 text-emerald-800 dark:text-emerald-300">
                                    🥗 {{ $profile->dietary_label }}
                                </span>
                                @if($profile->family_rep_required || ($activeWaliLink ?? null))
                                    <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-purple-100 dark:purple-950/80 text-purple-800 dark:text-purple-300 flex items-center gap-1">
                                        🛡️ Family Rep: {{ ($activeWaliLink ?? null) ? ($activeWaliLink->wali_name . ' (' . ucfirst(str_replace('_', ' ', $activeWaliLink->relationship_type)) . ')') : 'Family Consultation' }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Actions: Interest, Shortlist & Print Biodata -->
                    <div class="w-full sm:w-auto flex flex-col sm:items-end gap-2.5">
                        <div class="flex items-center gap-2 flex-wrap">
                            <form action="{{ route('blocked-users.store', $targetUser->id) }}" method="POST" onsubmit="return confirm('Block this profile? You will no longer see or contact this person.')" class="inline">
                                @csrf
                                <button type="submit" class="px-3 py-2.5 rounded-xl border border-rose-200 bg-white text-rose-600 hover:bg-rose-50 dark:border-rose-900/60 dark:bg-slate-800 dark:text-rose-300 dark:hover:bg-rose-950/40 text-xs font-bold transition flex items-center gap-1 shadow-xs cursor-pointer">
                                    <span>⛔</span> Block
                                </button>
                            </form>
                            <form action="{{ route('bookmarks.toggle', $targetUser->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="px-3 py-2.5 rounded-xl border {{ ($isBookmarked ?? false) ? 'bg-amber-100 border-amber-300 text-amber-800 dark:bg-amber-950 dark:border-amber-700 dark:text-amber-300' : 'bg-white dark:bg-slate-800 border-slate-300 dark:border-slate-700 text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700' }} text-xs font-bold transition flex items-center gap-1 cursor-pointer shadow-xs">
                                    <span>⭐</span> {{ ($isBookmarked ?? false) ? 'Shortlisted' : 'Shortlist' }}
                                </button>
                            </form>

                            <a href="{{ route('profile.biodata.show', $targetUser->id) }}" target="_blank"
                               class="px-3 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 text-xs font-bold transition flex items-center gap-1 shadow-xs" title="Printable Dhamma Biodata">
                                <span>🖨️</span> Biodata
                            </a>
                        </div>

                        <div class="w-full sm:w-auto">
                            @if($conversation || ($existingInterest && $existingInterest->status === 'accepted'))
                                <div class="flex items-center gap-2 flex-wrap justify-start sm:justify-end">
                                    <span class="px-3 py-2 rounded-xl text-xs font-bold bg-emerald-100 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-300 border border-emerald-300 dark:border-emerald-800 flex items-center gap-1.5">
                                        <span>✓</span> Proposal Accepted
                                    </span>
                                    <a href="{{ $conversation ? route('chat.show', $conversation->id) : route('chat.user', $targetUser->id) }}" class="px-5 py-2.5 rounded-xl bg-primary-700 hover:bg-primary-800 text-white font-bold text-xs shadow-md shadow-primary-950/15 transition flex items-center gap-2 cursor-pointer">
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                            <path d="M2 5a2 2 0 012-2h12a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4-4-4H4a2 2 0 01-2-2V5z"/>
                                        </svg>
                                        <span>Mindful Chat</span>
                                    </a>
                                </div>
                            @elseif($existingInterest && $existingInterest->status === 'pending')
                                @if($existingInterest->recipient_id === Auth::id())
                                    <div class="flex items-center gap-2">
                                        <form action="{{ route('interests.respond', $existingInterest->id) }}" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="action" value="accept">
                                            <button type="submit" class="px-4 py-2.5 rounded-xl bg-primary-700 hover:bg-primary-800 text-white font-bold text-xs shadow-md shadow-primary-950/15 transition flex items-center gap-1.5 cursor-pointer">
                                                <span>✓</span> Accept Proposal
                                            </button>
                                        </form>
                                        <form action="{{ route('interests.respond', $existingInterest->id) }}" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="action" value="decline">
                                            <button type="submit" class="px-3.5 py-2.5 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 font-bold text-xs transition flex items-center gap-1.5 border border-slate-300 dark:border-slate-700 cursor-pointer">
                                                <span>✕</span> Decline
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <div class="px-4 py-2.5 rounded-xl text-xs font-bold text-center bg-amber-50 dark:bg-amber-950/60 border border-amber-200 dark:border-amber-800/60 text-amber-800 dark:text-amber-300 flex items-center gap-1.5">
                                        <span>⏳</span> Proposal Sent (Pending)
                                    </div>
                                @endif
                            @elseif($existingInterest && $existingInterest->status === 'pending_wali')
                                <div class="px-4 py-2.5 rounded-xl text-xs font-bold text-center bg-purple-50 dark:bg-purple-950/60 border border-purple-200 dark:border-purple-800/60 text-purple-800 dark:text-purple-300 flex items-center gap-1.5">
                                    <span>🛡️</span> Awaiting Family Representative Approval
                                </div>
                            @elseif($existingInterest)
                                <div class="px-4 py-2.5 rounded-xl text-xs font-bold text-center bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 capitalize border border-slate-200 dark:border-slate-700">
                                    Status: {{ ucfirst(str_replace('_', ' ', $existingInterest->status)) }}
                                </div>
                            @else
                                <button type="button" onclick="document.getElementById('sendInterestModal').classList.remove('hidden')" class="w-full sm:w-auto px-6 py-3 rounded-xl bg-primary-700 hover:bg-primary-800 text-white font-bold text-xs shadow-md shadow-primary-950/15 transition flex items-center justify-center gap-2 cursor-pointer">
                                    <span>💌</span> Express Matrimonial Proposal
                                </button>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Photo Privacy Notice -->
                @if(!$isPhotoVisible)
                    <div class="bg-amber-50/80 dark:bg-amber-950/50 border border-amber-200 dark:border-amber-800 rounded-2xl p-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 text-xs">
                        <div class="flex items-center gap-2.5 text-amber-900 dark:text-amber-200">
                            <span class="text-xl">🔒</span>
                            <div>
                                <strong class="block text-amber-950 dark:text-amber-100 font-bold">Lotus Photo Privacy Active (FR-5.1)</strong>
                                <span>Photos are blurred by default until mutual proposal is accepted or explicit permission is granted.</span>
                            </div>
                        </div>
                        @if(Auth::user()->profile && ! $hasGrantedPhotoAccess)
                            <form action="{{ route('profile.photos.grant', $targetUser->id) }}" method="POST" class="shrink-0">
                                @csrf
                                <button type="submit" class="w-full sm:w-auto px-4 py-2.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white text-xs font-bold shadow-sm transition cursor-pointer">
                                    Grant them photo access
                                </button>
                            </form>
                        @elseif($hasGrantedPhotoAccess)
                            <span class="shrink-0 rounded-xl border border-emerald-300 bg-emerald-100 px-4 py-2.5 text-center text-xs font-bold text-emerald-800 dark:border-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-300">
                                ✓ Photo access granted
                            </span>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        @if(!empty($compatibilityHighlights))
            <section class="rounded-3xl border border-rose-100 bg-gradient-to-br from-rose-50 via-white to-amber-50 p-5 shadow-xs dark:border-rose-900/50 dark:from-rose-950/40 dark:via-slate-900 dark:to-amber-950/20 sm:p-6">
                <div class="flex items-start gap-3">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-primary-700 text-lg text-white shadow-md shadow-primary-950/15">✦</div>
                    <div>
                        <p class="text-[10px] font-extrabold uppercase tracking-[0.18em] text-primary-700 dark:text-primary-300">Shared Dhamma Signals</p>
                        <h2 class="mt-1 font-heading text-lg font-extrabold text-slate-900 dark:text-white">Why this may be a good fit ({{ $compatibilityScore }}% match)</h2>
                        <p class="mt-1 text-xs leading-relaxed text-slate-600 dark:text-slate-300">These alignment points are conversation starters. Take time to read their complete biodata and consult your family elders.</p>
                    </div>
                </div>
                <div class="mt-5 grid gap-3 sm:grid-cols-2">
                    @foreach($compatibilityHighlights as $highlight)
                        <div class="flex items-start gap-3 rounded-2xl border border-white/80 bg-white/75 p-3 dark:border-slate-700/80 dark:bg-slate-900/70">
                            <span class="text-lg">{{ $highlight['icon'] }}</span>
                            <div>
                                <p class="text-xs font-bold text-slate-900 dark:text-white">{{ $highlight['label'] }}</p>
                                <p class="mt-1 text-[11px] leading-relaxed text-slate-500 dark:text-slate-400">{{ $highlight['detail'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Incoming Pending Proposal Callout Banner -->
        @if($existingInterest && $existingInterest->status === 'pending' && $existingInterest->recipient_id === Auth::id())
            <div class="bg-gradient-to-r from-rose-50 via-amber-50 to-rose-50 dark:from-rose-950/60 dark:via-amber-950/40 dark:to-rose-950/60 border-2 border-primary-500/30 rounded-3xl p-5 sm:p-6 shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-5">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-primary-700 text-white flex items-center justify-center text-2xl shrink-0 shadow-md">
                        💌
                    </div>
                    <div>
                        <span class="text-[11px] font-bold uppercase tracking-wider text-primary-700 dark:text-primary-400 bg-rose-100 dark:bg-rose-900/60 px-2.5 py-0.5 rounded-full inline-block mb-1">
                            Pending Matrimonial Proposal Received
                        </span>
                        <h2 class="text-base sm:text-lg font-bold text-slate-900 dark:text-white">
                            {{ $targetUser->name }} has expressed sincere matrimonial interest in you!
                        </h2>
                        <p class="text-xs text-slate-600 dark:text-slate-300 mt-1 max-w-xl leading-relaxed">
                            Carefully review their Dhamma practice, meditation lifestyle, education, and values below. You may accept or decline this introduction request here.
                        </p>
                        @if($existingInterest->message_note)
                            <div class="mt-3 text-xs bg-white/80 dark:bg-slate-900/80 p-3 rounded-xl border border-rose-200 dark:border-rose-800/80 text-slate-700 dark:text-slate-300 italic">
                                &ldquo;{{ $existingInterest->message_note }}&rdquo;
                            </div>
                        @endif
                    </div>
                </div>

                <div class="flex items-center gap-2.5 w-full md:w-auto shrink-0 justify-end">
                    <form action="{{ route('interests.respond', $existingInterest->id) }}" method="POST" class="inline flex-1 md:flex-initial">
                        @csrf
                        <input type="hidden" name="action" value="accept">
                        <button type="submit" class="w-full md:w-auto px-5 py-3 rounded-xl bg-primary-700 hover:bg-primary-800 text-white font-bold text-xs shadow-md shadow-primary-950/20 transition flex items-center justify-center gap-1.5 cursor-pointer">
                            <span>✓</span> Accept Proposal
                        </button>
                    </form>
                    <form action="{{ route('interests.respond', $existingInterest->id) }}" method="POST" class="inline flex-1 md:flex-initial">
                        @csrf
                        <input type="hidden" name="action" value="decline">
                        <button type="submit" class="w-full md:w-auto px-4 py-3 rounded-xl bg-white dark:bg-slate-800 hover:bg-slate-100 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 font-bold text-xs transition flex items-center justify-center gap-1.5 border border-slate-300 dark:border-slate-700 cursor-pointer">
                            <span>✕</span> Decline
                        </button>
                    </form>
                </div>
            </div>
        @endif

        @if($conversation || ($existingInterest && $existingInterest->status === 'accepted'))
            <!-- Mutual Match & Messaging Active Card -->
            <div class="bg-gradient-to-r from-rose-50 via-white to-amber-50 dark:from-rose-950/50 dark:via-slate-900 dark:to-amber-950/30 border-2 border-primary-300 dark:border-primary-800 rounded-3xl p-5 shadow-xs flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div class="flex items-center gap-3.5">
                    <div class="w-12 h-12 rounded-2xl bg-primary-700 text-white flex items-center justify-center text-xl shrink-0 shadow-xs">
                        💬
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <h2 class="text-base font-bold text-slate-900 dark:text-white">Mutual Matrimonial Proposal Confirmed!</h2>
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 dark:bg-rose-950 text-rose-800 dark:text-rose-300 border border-rose-200 dark:border-rose-800">Messaging Unlocked</span>
                        </div>
                        <p class="text-xs text-slate-600 dark:text-slate-300 mt-0.5">You and {{ $targetUser->name }} have mutually accepted interest. You can converse directly in your protected mindful chat.</p>
                    </div>
                </div>
                <a href="{{ $conversation ? route('chat.show', $conversation->id) : route('chat.user', $targetUser->id) }}" class="w-full md:w-auto px-6 py-3 rounded-xl bg-primary-700 hover:bg-primary-800 text-white font-bold text-xs shadow-md shadow-primary-950/20 transition flex items-center justify-center gap-2 shrink-0 cursor-pointer">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                        <path d="M2 5a2 2 0 012-2h12a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4-4-4H4a2 2 0 01-2-2V5z"/>
                    </svg>
                    <span>Message {{ $targetUser->name }}</span> &rarr;
                </a>
            </div>
        @endif

        <!-- Main Details Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left 2 Columns: Bio, Dhamma & Career -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Bio Card -->
                <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 p-6 shadow-xs">
                    <h3 class="text-sm font-bold text-slate-900 dark:text-white uppercase tracking-wider mb-3">About Me & Matrimonial Intentions</h3>
                    <p class="text-sm text-slate-700 dark:text-slate-300 leading-relaxed whitespace-pre-line">
                        {{ $profile->bio ?? 'No biography provided yet.' }}
                    </p>
                </div>

                <!-- Buddhist Practice & Dhamma Alignment (FR-2.3, 2.4, 6.4) -->
                <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 p-6 shadow-xs">
                    <div class="flex items-center gap-2 mb-4 pb-3 border-b border-slate-100 dark:border-slate-800">
                        <span class="text-xl">🪷</span>
                        <h3 class="text-sm font-bold text-slate-900 dark:text-white uppercase tracking-wider">Buddhist Practice & Dhamma Values</h3>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                        <div class="bg-slate-50 dark:bg-slate-800/60 p-3 rounded-2xl">
                            <span class="text-slate-500 dark:text-slate-400 block mb-0.5">Buddhist Tradition:</span>
                            <span class="font-bold text-slate-900 dark:text-white">{{ $profile->tradition_label }}</span>
                        </div>
                        <div class="bg-slate-50 dark:bg-slate-800/60 p-3 rounded-2xl">
                            <span class="text-slate-500 dark:text-slate-400 block mb-0.5">Lineage / School:</span>
                            <span class="font-bold text-slate-900 dark:text-white">{{ $profile->lineage_school ?? 'General Buddhist' }}</span>
                        </div>
                        <div class="bg-slate-50 dark:bg-slate-800/60 p-3 rounded-2xl">
                            <span class="text-slate-500 dark:text-slate-400 block mb-0.5">Cultural Community (Casteless):</span>
                            <span class="font-bold text-slate-900 dark:text-white">{{ $profile->ethnic_community_label }}</span>
                        </div>
                        <div class="bg-slate-50 dark:bg-slate-800/60 p-3 rounded-2xl">
                            <span class="text-slate-500 dark:text-slate-400 block mb-0.5">Meditation Frequency:</span>
                            <span class="font-bold text-primary-800 dark:text-primary-300">{{ $profile->meditation_frequency_label }}</span>
                        </div>
                        <div class="bg-slate-50 dark:bg-slate-800/60 p-3 rounded-2xl">
                            <span class="text-slate-500 dark:text-slate-400 block mb-0.5">Five Precepts (Panca Sila):</span>
                            <span class="font-bold text-slate-900 dark:text-white">{{ $profile->panca_sila_label }}</span>
                        </div>
                        <div class="bg-slate-50 dark:bg-slate-800/60 p-3 rounded-2xl">
                            <span class="text-slate-500 dark:text-slate-400 block mb-0.5">Temple / Vihara Attendance:</span>
                            <span class="font-bold text-slate-900 dark:text-white">{{ $profile->temple_label }}</span>
                        </div>
                        <div class="bg-slate-50 dark:bg-slate-800/60 p-3 rounded-2xl">
                            <span class="text-slate-500 dark:text-slate-400 block mb-0.5">Uposatha Observance:</span>
                            <span class="font-bold text-slate-900 dark:text-white">{{ $profile->uposatha_label }}</span>
                        </div>
                        <div class="bg-slate-50 dark:bg-slate-800/60 p-3 rounded-2xl">
                            <span class="text-slate-500 dark:text-slate-400 block mb-0.5">Dhamma Study & Chanting:</span>
                            <span class="font-bold text-slate-900 dark:text-white">{{ $profile->dhamma_study_label }}</span>
                        </div>
                        <div class="bg-slate-50 dark:bg-slate-800/60 p-3 rounded-2xl">
                            <span class="text-slate-500 dark:text-slate-400 block mb-0.5">Dietary Practice:</span>
                            <span class="font-bold text-slate-900 dark:text-white">{{ $profile->dietary_label }}</span>
                        </div>
                        <div class="bg-slate-50 dark:bg-slate-800/60 p-3 rounded-2xl">
                            <span class="text-slate-500 dark:text-slate-400 block mb-0.5">5th Precept (Alcohol/Intoxicants):</span>
                            <span class="font-bold text-slate-900 dark:text-white">{{ $profile->alcohol_label }}</span>
                        </div>
                    </div>
                </div>

                <!-- Horoscope Module (if enabled and permitted) -->
                @if($profile->horoscope_required)
                    <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 p-6 shadow-xs">
                        <div class="flex items-center gap-2 mb-4 pb-3 border-b border-slate-100 dark:border-slate-800">
                            <span class="text-xl">⭐</span>
                            <h3 class="text-sm font-bold text-slate-900 dark:text-white uppercase tracking-wider">Astrological & Horoscope Matching</h3>
                        </div>
                        @if($profile->isHoroscopeVisibleTo(Auth::user()))
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-xs mb-3">
                                <div class="bg-slate-50 dark:bg-slate-800/60 p-3 rounded-2xl">
                                    <span class="text-slate-400 block text-[10px] uppercase font-bold">Birth Date</span>
                                    <span class="font-bold text-slate-900 dark:text-white">{{ $profile->birth_date?->format('d M Y') ?? 'Provided' }}</span>
                                </div>
                                <div class="bg-slate-50 dark:bg-slate-800/60 p-3 rounded-2xl">
                                    <span class="text-slate-400 block text-[10px] uppercase font-bold">Birth Time</span>
                                    <span class="font-bold text-slate-900 dark:text-white">{{ $profile->birth_time ?? 'Available' }}</span>
                                </div>
                                <div class="bg-slate-50 dark:bg-slate-800/60 p-3 rounded-2xl">
                                    <span class="text-slate-400 block text-[10px] uppercase font-bold">Birth Place</span>
                                    <span class="font-bold text-slate-900 dark:text-white">{{ $profile->birth_place ?? 'Available' }}</span>
                                </div>
                            </div>
                            @if($profile->horoscope_file_path)
                                <div class="flex items-center justify-between p-3 rounded-2xl bg-amber-50 dark:bg-amber-950/40 border border-amber-200 dark:border-amber-800 text-xs">
                                    <span class="font-bold text-amber-900 dark:text-amber-200">📜 Porondam Birth Chart Attached</span>
                                    <a href="{{ route('profile.horoscope.download', $profile->user_id) }}" class="px-3 py-1.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold transition">
                                        Download Chart
                                    </a>
                                </div>
                            @endif
                        @else
                            <div class="bg-slate-50 dark:bg-slate-800/60 p-4 rounded-2xl text-xs text-slate-600 dark:text-slate-400 flex items-center justify-between">
                                <span>🔒 Astrological details are visible once mutual proposal interest is accepted.</span>
                            </div>
                        @endif
                    </div>
                @endif

                <!-- Education & Professional Background -->
                <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 p-6 shadow-xs">
                    <div class="flex items-center gap-2 mb-4 pb-3 border-b border-slate-100 dark:border-slate-800">
                        <span class="text-xl">🎓</span>
                        <h3 class="text-sm font-bold text-slate-900 dark:text-white uppercase tracking-wider">Education & Profession</h3>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                        <div class="bg-slate-50 dark:bg-slate-800/60 p-3 rounded-2xl">
                            <span class="text-slate-500 dark:text-slate-400 block mb-0.5">Highest Education:</span>
                            <span class="font-bold text-slate-900 dark:text-white">{{ $profile->education_level ?? 'Graduate' }}</span>
                        </div>
                        <div class="bg-slate-50 dark:bg-slate-800/60 p-3 rounded-2xl">
                            <span class="text-slate-500 dark:text-slate-400 block mb-0.5">Profession / Job Title:</span>
                            <span class="font-bold text-slate-900 dark:text-white">{{ $profile->profession ?? 'Professional' }}</span>
                        </div>
                        <div class="bg-slate-50 dark:bg-slate-800/60 p-3 rounded-2xl">
                            <span class="text-slate-500 dark:text-slate-400 block mb-0.5">Mother Tongue:</span>
                            <span class="font-bold text-slate-900 dark:text-white">{{ $profile->mother_tongue ?? 'Not specified' }}</span>
                        </div>
                        <div class="bg-slate-50 dark:bg-slate-800/60 p-3 rounded-2xl">
                            <span class="text-slate-500 dark:text-slate-400 block mb-0.5">Height:</span>
                            <span class="font-bold text-slate-900 dark:text-white">{{ $profile->height_cm ? $profile->height_cm . ' cm' : 'Not specified' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Family, Preferences & Anti-Dowry Notice -->
            <div class="space-y-6">
                <!-- Family Background -->
                <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 p-6 shadow-xs">
                    <div class="flex items-center gap-2 mb-4 pb-3 border-b border-slate-100 dark:border-slate-800">
                        <span class="text-xl">🏡</span>
                        <h3 class="text-sm font-bold text-slate-900 dark:text-white uppercase tracking-wider">Family Background</h3>
                    </div>
                    <div class="space-y-3 text-xs">
                        <div class="flex justify-between border-b border-slate-100 dark:border-slate-800 pb-2">
                            <span class="text-slate-500 dark:text-slate-400">Desired Living Arrangement:</span>
                            <span class="font-bold text-slate-900 dark:text-white">{{ ucfirst(str_replace('_', ' ', $profile->preferred_living_arrangement ?? 'Flexible')) }}</span>
                        </div>
                        <div class="flex justify-between border-b border-slate-100 dark:border-slate-800 pb-2">
                            <span class="text-slate-500 dark:text-slate-400">Siblings:</span>
                            <span class="font-bold text-slate-900 dark:text-white">{{ $profile->siblings_count ?? 'Not specified' }}</span>
                        </div>
                        <div class="flex justify-between border-b border-slate-100 dark:border-slate-800 pb-2">
                            <span class="text-slate-500 dark:text-slate-400">Parents' Occupation:</span>
                            <span class="font-bold text-slate-900 dark:text-white">{{ $profile->parents_occupation ?? 'Respected background' }}</span>
                        </div>
                        @if($activeWaliLink ?? null)
                            <div class="flex justify-between border-t border-purple-100 dark:border-purple-900/60 pt-2 bg-purple-50/50 dark:bg-purple-950/30 -mx-2 px-2 rounded-lg">
                                <span class="text-purple-700 dark:text-purple-300 font-medium">Family Representative:</span>
                                <span class="font-bold text-purple-950 dark:text-purple-200">
                                    🛡️ {{ $activeWaliLink->wali_name }} ({{ ucfirst(str_replace('_', ' ', $activeWaliLink->relationship_type)) }})
                                </span>
                            </div>
                        @endif
                    </div>

                    @if($profile->views_on_raising_children_in_dhamma)
                        <div class="mt-3 pt-3 border-t border-slate-100 dark:border-slate-800">
                            <span class="text-slate-400 block text-[10px] uppercase font-bold mb-1">Views on Raising Children</span>
                            <p class="text-xs text-slate-700 dark:text-slate-300 italic leading-relaxed">
                                &ldquo;{{ $profile->views_on_raising_children_in_dhamma }}&rdquo;
                            </p>
                        </div>
                    @endif
                </div>

                <!-- Partner Preferences -->
                <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 p-6 shadow-xs">
                    <div class="flex items-center gap-2 mb-4 pb-3 border-b border-slate-100 dark:border-slate-800">
                        <span class="text-xl">🎯</span>
                        <h3 class="text-sm font-bold text-slate-900 dark:text-white uppercase tracking-wider">Looking For</h3>
                    </div>
                    @php $prefs = $profile->partner_preferences ?? []; @endphp
                    <div class="space-y-3 text-xs">
                        <div class="flex justify-between border-b border-slate-100 dark:border-slate-800 pb-2">
                            <span class="text-slate-500 dark:text-slate-400">Preferred Age:</span>
                            <span class="font-bold text-slate-900 dark:text-white">
                                {{ $prefs['age_min'] ?? 'Any' }} - {{ $prefs['age_max'] ?? 'Any' }} years
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-500 dark:text-slate-400">Preferred Location:</span>
                            <span class="font-bold text-slate-900 dark:text-white">{{ $prefs['preferred_location'] ?? 'Open' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Anti-Dowry Stance Banner (FR-7.4) -->
                <div class="bg-amber-50 dark:bg-amber-950/40 border border-amber-200 dark:border-amber-900/60 rounded-3xl p-5 text-xs text-amber-950 dark:text-amber-200 space-y-1.5">
                    <div class="flex items-center gap-2 font-bold font-heading">
                        <span>🛡️</span>
                        <span>Zero Dowry Platform Policy (FR-7.4)</span>
                    </div>
                    <p class="text-[11px] text-amber-800 dark:text-amber-300/90 leading-relaxed">
                        Global Maitri strictly prohibits dowry demands (cash, jewelry, property) in alignment with Buddhist principles of non-greed and respect. Violations will result in an immediate permanent ban.
                    </p>
                </div>

                <!-- Report User (FR-4.6) -->
                <div class="text-center pt-2">
                    <button type="button" onclick="document.getElementById('reportModal').classList.remove('hidden')" class="text-xs text-rose-600 dark:text-rose-400 hover:text-rose-800 dark:hover:text-rose-300 font-semibold cursor-pointer">
                        🚩 Report inappropriate profile or behavior (FR-4.6)
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Send Interest Modal -->
<div id="sendInterestModal" class="hidden fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl max-w-md w-full p-6 shadow-2xl">
        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2 font-heading">Express Matrimonial Proposal</h3>
        <p class="text-xs text-slate-500 dark:text-slate-400 mb-4">
            @if($profile->family_rep_required)
                Notice: This candidate has a linked Family Representative. If accepted, your proposal will be reviewed with mindful family consultation.
            @else
                Express your interest respectfully with loving-kindness (Metta). If the candidate accepts, mindful private messaging will unlock (FR-4.2).
            @endif
        </p>
        <form action="{{ route('interests.send', $targetUser->id) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Optional Introductory Note (Metta Greeting)</label>
                <textarea name="note" rows="3" class="w-full p-3 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-xs focus:ring-2 focus:ring-primary-500 outline-none" placeholder="May you be happy and well. I appreciate your commitment to Dhamma practice and values..."></textarea>
            </div>
            <div class="flex items-center justify-end gap-2">
                <button type="button" onclick="document.getElementById('sendInterestModal').classList.add('hidden')" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800">Cancel</button>
                <button type="submit" class="px-4 py-2 rounded-xl text-xs font-bold bg-primary-700 text-white hover:bg-primary-800 shadow-xs cursor-pointer">Send Proposal</button>
            </div>
        </form>
    </div>
</div>

<!-- Report User Modal (FR-4.6) -->
<div id="reportModal" class="hidden fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl max-w-md w-full p-6 shadow-2xl">
        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2 font-heading">Report Candidate</h3>
        <form action="{{ route('reports.store') }}" method="POST">
            @csrf
            <input type="hidden" name="reported_id" value="{{ $targetUser->id }}">
            <div class="mb-4">
                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Reason for Report</label>
                <select name="reason" required class="w-full p-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-xs focus:ring-2 focus:ring-primary-500 outline-none">
                    <option value="dowry_demand">Dowry demand / financial pressure (Strict Zero Tolerance)</option>
                    <option value="inappropriate_language">Inappropriate or vulgar language</option>
                    <option value="harassment">Harassment / pressure</option>
                    <option value="fake_profile">Suspicious / fake profile claims</option>
                    <option value="external_solicitation">Commercial solicitation / scam</option>
                    <option value="caste_discrimination">Caste-based discrimination / remarks</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Details for Moderation Staff (FR-7.2)</label>
                <textarea name="details" rows="3" class="w-full p-3 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-xs focus:ring-2 focus:ring-primary-500 outline-none" placeholder="Provide any context..."></textarea>
            </div>
            <div class="flex items-center justify-end gap-2">
                <button type="button" onclick="document.getElementById('reportModal').classList.add('hidden')" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800">Cancel</button>
                <button type="submit" class="px-4 py-2 rounded-xl text-xs font-bold bg-rose-600 text-white hover:bg-rose-700 cursor-pointer">Submit Report</button>
            </div>
        </form>
    </div>
</div>
@endsection
