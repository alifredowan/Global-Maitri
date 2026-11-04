@extends('layouts.app')

@section('title', 'Mangala Vivaha Celebration - Global Maitri')

@section('content')
<div class="py-12 bg-slate-50 dark:bg-slate-950 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        @if(session('success'))
            <div class="p-4 rounded-2xl bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-200 text-xs font-semibold flex items-center gap-2">
                <span>✓</span> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="p-4 rounded-2xl bg-rose-50 dark:bg-rose-950/60 border border-rose-200 dark:border-rose-800 text-rose-800 dark:text-rose-200 text-xs font-semibold flex items-center gap-2">
                <span>✕</span> {{ session('error') }}
            </div>
        @endif

        @if(session('info'))
            <div class="p-4 rounded-2xl bg-blue-50 dark:bg-blue-950/60 border border-blue-200 dark:border-blue-800 text-blue-800 dark:text-blue-200 text-xs font-semibold flex items-center gap-2">
                <span>ℹ️</span> {{ session('info') }}
            </div>
        @endif

        <!-- Mangala Vivaha Celebration Card -->
        <div class="relative overflow-hidden bg-gradient-to-br from-rose-950 via-slate-900 to-amber-950 rounded-3xl p-8 sm:p-12 text-white shadow-2xl border border-amber-600/40 text-center space-y-6">
            <!-- Pali Sutta Blessing -->
            <div class="space-y-3 max-w-2xl mx-auto">
                <span class="px-3.5 py-1 rounded-full text-[11px] font-extrabold uppercase tracking-wider bg-amber-500/20 text-amber-300 border border-amber-400/30 inline-block">
                    🪷 Sacred Mangala Vivaha Milestone
                </span>

                <div class="font-serif text-lg sm:text-xl text-amber-200 tracking-wider pt-2 leading-relaxed">
                    Asevanā ca bālānaṁ, paṇḍitānañca sevanā, pūjā ca pūjanīyānaṁ — etaṁ maṅgalamuttamaṁ.
                </div>

                <p class="text-xs sm:text-sm text-slate-300 italic">
                    &ldquo;Not consorting with the foolish, associating with the wise, honoring those worthy of honor — this is the greatest blessing.&rdquo; (Mangala Sutta: Kp 5)
                </p>
            </div>

            <!-- Main Title -->
            <div>
                <h1 class="text-3xl sm:text-4xl font-extrabold font-heading text-white tracking-tight">
                    @if($marriage->isConfirmed())
                        Sadhu Sadhu Sadhu! Mangala Vivaha Mubarak!
                    @else
                        Mangala Vivaha in Mutual Confirmation
                    @endif
                </h1>
                <p class="text-xs sm:text-sm text-slate-300 mt-2 max-w-xl mx-auto">
                    @if($marriage->isConfirmed())
                        May your lifelong partnership be enriched with mutual loving-kindness (Metta), patience, mindful understanding, and peace.
                    @else
                        An auspicious wedding milestone proposal has been initiated and awaits mutual confirmation.
                    @endif
                </p>
            </div>

            <!-- Couple Card Visual -->
            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 max-w-xl mx-auto border border-white/15 flex items-center justify-around gap-4">
                <div class="text-center space-y-2">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 mx-auto rounded-2xl bg-rose-900 border-2 border-amber-400 overflow-hidden shadow-lg flex items-center justify-center text-2xl font-bold">
                        @if($marriage->groom->profile?->primaryPhoto)
                            <img src="{{ $marriage->groom->profile->primaryPhoto->displayUrl() }}" alt="{{ $marriage->groom->name }}" class="w-full h-full object-cover">
                        @else
                            {{ substr($marriage->groom->name, 0, 1) }}
                        @endif
                    </div>
                    <div>
                        <span class="text-[10px] uppercase font-bold text-amber-300 block">Groom</span>
                        <strong class="text-sm font-heading block truncate max-w-[120px]">{{ $marriage->groom->name }}</strong>
                    </div>
                </div>

                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 rounded-full bg-amber-400 text-slate-950 flex items-center justify-center text-xl shadow-md">
                        🪷
                    </div>
                    <span class="text-[10px] font-extrabold uppercase text-amber-300 tracking-wider mt-1">Vivaha</span>
                </div>

                <div class="text-center space-y-2">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 mx-auto rounded-2xl bg-rose-900 border-2 border-amber-400 overflow-hidden shadow-lg flex items-center justify-center text-2xl font-bold">
                        @if($marriage->bride->profile?->primaryPhoto)
                            <img src="{{ $marriage->bride->profile->primaryPhoto->displayUrl() }}" alt="{{ $marriage->bride->name }}" class="w-full h-full object-cover">
                        @else
                            {{ substr($marriage->bride->name, 0, 1) }}
                        @endif
                    </div>
                    <div>
                        <span class="text-[10px] uppercase font-bold text-amber-300 block">Bride</span>
                        <strong class="text-sm font-heading block truncate max-w-[120px]">{{ $marriage->bride->name }}</strong>
                    </div>
                </div>
            </div>

            <!-- Digital Certificate CTA (if confirmed) -->
            @if($marriage->isConfirmed())
                <div class="pt-2">
                    <a href="{{ route('marriages.certificate', $marriage->id) }}" target="_blank" class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl bg-amber-400 hover:bg-amber-300 text-slate-950 font-extrabold text-xs shadow-lg transition">
                        <span>📜</span> View & Print Mangala Vivaha Digital Certificate &rarr;
                    </a>
                </div>
            @endif

            <!-- Pending Confirmation Prompt (if applicable) -->
            @if($marriage->isPending())
                <div class="max-w-lg mx-auto bg-amber-500/20 border border-amber-400/40 rounded-2xl p-5 text-center space-y-3">
                    @if($user->id !== $marriage->initiated_by_user_id)
                        <span class="text-xs font-bold text-amber-300 block">
                            🔔 {{ $marriage->initiator->name }} has declared that you both have solemnized your Mangala Vivaha!
                        </span>
                        <p class="text-xs text-slate-300">
                            Confirming will finalize your marriage milestone, update your status to Married, and close past inquiries with blessings.
                        </p>
                        <div class="flex items-center justify-center gap-3 pt-1">
                            <form action="{{ route('marriages.confirm', $marriage->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-6 py-2.5 rounded-xl bg-primary-700 hover:bg-primary-600 text-white font-extrabold text-xs shadow-md transition cursor-pointer">
                                    ✓ Yes, Confirm Mangala Vivaha!
                                </button>
                            </form>
                            <form action="{{ route('marriages.decline', $marriage->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-slate-300 text-xs font-bold transition cursor-pointer">
                                    ✕ Decline
                                </button>
                            </form>
                        </div>
                    @else
                        <span class="text-xs font-bold text-amber-300 block">
                            ⏳ Waiting for {{ $spouse ? $spouse->name : 'spouse' }} to confirm your Mangala Vivaha declaration.
                        </span>
                        <p class="text-[11px] text-slate-300">
                            A notification has been dispatched to your spouse. Once confirmed, all account transitions will take effect immediately.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Post-Vivaha Protections & Status Changes Summary -->
        <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 p-6 sm:p-8 shadow-xs space-y-6">
            <div class="border-b border-slate-100 dark:border-slate-800 pb-4">
                <h2 class="text-lg font-bold text-slate-900 dark:text-white font-heading">
                    Shielded Account Safeguards & Mangala Vivaha Protections
                </h2>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                    How Global Maitri protects your privacy and concludes your matrimonial journey with tranquility.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                <div class="p-4 rounded-2xl bg-rose-50/60 dark:bg-rose-950/30 border border-rose-200/80 dark:border-rose-800/60 flex items-start gap-3">
                    <span class="text-xl">🔒</span>
                    <div>
                        <strong class="text-slate-900 dark:text-white block font-bold">Removed from Discovery</strong>
                        <p class="text-slate-600 dark:text-slate-300 mt-0.5">Both profiles are immediately shielded and delisted from search, recommendations, and candidate discovery.</p>
                    </div>
                </div>

                <div class="p-4 rounded-2xl bg-rose-50/60 dark:bg-rose-950/30 border border-rose-200/80 dark:border-rose-800/60 flex items-start gap-3">
                    <span class="text-xl">🛑</span>
                    <div>
                        <strong class="text-slate-900 dark:text-white block font-bold">Past Inquiries Concluded with Metta</strong>
                        <p class="text-slate-600 dark:text-slate-300 mt-0.5">All pending and active inquiries with third suitors have been closed with a polite message of Metta and well-wishes.</p>
                    </div>
                </div>

                <div class="p-4 rounded-2xl bg-rose-50/60 dark:bg-rose-950/30 border border-rose-200/80 dark:border-rose-800/60 flex items-start gap-3">
                    <span class="text-xl">💬</span>
                    <div>
                        <strong class="text-slate-900 dark:text-white block font-bold">Chat Channels Archived</strong>
                        <p class="text-slate-600 dark:text-slate-300 mt-0.5">Conversations with other candidates are locked to read-only; your conversation with your spouse remains accessible.</p>
                    </div>
                </div>

                <div class="p-4 rounded-2xl bg-rose-50/60 dark:bg-rose-950/30 border border-rose-200/80 dark:border-rose-800/60 flex items-start gap-3">
                    <span class="text-xl">💳</span>
                    <div>
                        <strong class="text-slate-900 dark:text-white block font-bold">Single Marriage Pass Completed</strong>
                        <p class="text-slate-600 dark:text-slate-300 mt-0.5">Your Single Marriage Pass has successfully reached completion with your solemnized marriage.</p>
                    </div>
                </div>
            </div>
        </div>

        @if($marriage->isConfirmed())
            <!-- Maitri Success Story Submission Form -->
            <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 p-6 sm:p-8 shadow-xs space-y-6">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-amber-600 dark:text-amber-400">Community Inspiration</span>
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white font-heading mt-0.5">
                        Share Your Maitri Success Story
                    </h2>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                        Inspire fellow Buddhist seekers by sharing your experience, how your Dhamma practices aligned, and words of encouragement.
                    </p>
                </div>

                <form action="{{ route('marriages.story', $marriage->id) }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">
                            Story Title
                        </label>
                        <input type="text" name="story_title" value="{{ old('story_title', $marriage->story_title ?? 'How We Found Dhamma Harmony Through Global Maitri') }}" required
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-xs outline-none focus:ring-2 focus:ring-primary-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">
                            Your Story & Words of Encouragement
                        </label>
                        <textarea name="story_body" rows="4" required placeholder="Share how your meditation practice, values, and family consultation aligned..."
                                  class="w-full p-4 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-xs outline-none focus:ring-2 focus:ring-primary-500">{{ old('story_body', $marriage->story_body) }}</textarea>
                    </div>

                    <div class="flex items-center justify-between flex-wrap gap-4 pt-2">
                        <label class="flex items-center gap-2 text-xs font-semibold text-slate-700 dark:text-slate-300 cursor-pointer">
                            <input type="checkbox" name="story_is_public" value="1" {{ old('story_is_public', $marriage->story_is_public ?? true) ? 'checked' : '' }}
                                   class="rounded text-primary-600 focus:ring-primary-500">
                            <span>Allow publishing anonymously on Global Maitri Success Stories</span>
                        </label>

                        <button type="submit" class="px-6 py-2.5 rounded-xl bg-primary-700 hover:bg-primary-800 text-white font-bold text-xs shadow-xs transition cursor-pointer">
                            Save Story
                        </button>
                    </div>
                </form>
            </div>
        @endif

    </div>
</div>
@endsection
