@extends('layouts.app')

@section('title', 'Mangala Vivaha Celebration - Global Maitri')

@section('content')
<div class="py-12 bg-[var(--bg-canvas)] min-h-screen transition-colors">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        @if(session('success'))
            <div class="p-4 rounded-[4px] bg-[var(--bg-subtle)] border border-[var(--color-success)] text-[var(--color-success)] text-xs font-semibold flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="p-4 rounded-[4px] bg-[var(--bg-subtle)] border border-[var(--color-danger)] text-[var(--color-danger)] text-xs font-semibold flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @if(session('info'))
            <div class="p-4 rounded-[4px] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-[var(--text-secondary)] text-xs font-semibold flex items-center gap-2">
                <svg class="w-4 h-4 text-[var(--accent-primary)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('info') }}</span>
            </div>
        @endif

        <!-- Mangala Vivaha Celebration Card -->
        <div class="relative overflow-hidden bg-[#141412] rounded-[4px] p-8 sm:p-12 text-[#f4f2ee] shadow-xl border border-[#2d2b27] text-center space-y-6">
            <!-- Pali Sutta Blessing -->
            <div class="space-y-3 max-w-2xl mx-auto">
                <span class="px-3.5 py-1 rounded-[4px] text-[11px] font-bold uppercase tracking-wider bg-[var(--accent-primary)]/20 text-[#e0b84c] border border-[var(--accent-primary)]/30 inline-flex items-center gap-1.5">
                    <x-application-logo class="w-3.5 h-3.5 text-[#e0b84c]" />
                    Sacred Mangala Vivaha Milestone
                </span>

                <div class="font-serif text-lg sm:text-xl text-[#e0b84c] tracking-wider pt-2 leading-relaxed">
                    Asevanā ca bālānaṁ, paṇḍitānañca sevanā, pūjā ca pūjanīyānaṁ — etaṁ maṅgalamuttamaṁ.
                </div>

                <p class="text-xs sm:text-sm text-[#d6d2c8] italic">
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
                <p class="text-xs sm:text-sm text-[#d6d2c8] mt-2 max-w-xl mx-auto">
                    @if($marriage->isConfirmed())
                        May your lifelong partnership be enriched with mutual loving-kindness (Metta), patience, mindful understanding, and peace.
                    @else
                        An auspicious wedding milestone proposal has been initiated and awaits mutual confirmation.
                    @endif
                </p>
            </div>

            <!-- Couple Card Visual -->
            <div class="bg-[#1e1d19] rounded-[4px] p-6 max-w-xl mx-auto border border-[#3d3a33] flex items-center justify-around gap-4">
                <div class="text-center space-y-2">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 mx-auto rounded-[4px] bg-[#22211c] border-2 border-[var(--accent-primary)] overflow-hidden shadow-xs flex items-center justify-center text-2xl font-bold text-[#e0b84c]">
                        @if($marriage->groom->profile?->primaryPhoto)
                            <img src="{{ $marriage->groom->profile->primaryPhoto->displayUrl() }}" alt="{{ $marriage->groom->name }}" class="w-full h-full object-cover">
                        @else
                            {{ substr($marriage->groom->name, 0, 1) }}
                        @endif
                    </div>
                    <div>
                        <span class="text-[10px] uppercase font-bold text-[#e0b84c] block">Groom</span>
                        <strong class="text-sm font-heading block truncate max-w-[120px] text-white">{{ $marriage->groom->name }}</strong>
                    </div>
                </div>

                <div class="flex flex-col items-center">
                    <x-application-logo variant="badge" badge-class="w-12 h-12" />
                    <span class="text-[10px] font-bold uppercase text-[#e0b84c] tracking-wider mt-1.5">Vivaha</span>
                </div>

                <div class="text-center space-y-2">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 mx-auto rounded-[4px] bg-[#22211c] border-2 border-[var(--accent-primary)] overflow-hidden shadow-xs flex items-center justify-center text-2xl font-bold text-[#e0b84c]">
                        @if($marriage->bride->profile?->primaryPhoto)
                            <img src="{{ $marriage->bride->profile->primaryPhoto->displayUrl() }}" alt="{{ $marriage->bride->name }}" class="w-full h-full object-cover">
                        @else
                            {{ substr($marriage->bride->name, 0, 1) }}
                        @endif
                    </div>
                    <div>
                        <span class="text-[10px] uppercase font-bold text-[#e0b84c] block">Bride</span>
                        <strong class="text-sm font-heading block truncate max-w-[120px] text-white">{{ $marriage->bride->name }}</strong>
                    </div>
                </div>
            </div>

            <!-- Digital Certificate CTA (if confirmed) -->
            @if($marriage->isConfirmed())
                <div class="pt-2">
                    <a href="{{ route('marriages.certificate', $marriage->id) }}" target="_blank" class="btn-primary inline-flex items-center gap-2 text-xs py-3 px-6">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span>View &amp; Print Mangala Vivaha Digital Certificate &rarr;</span>
                    </a>
                </div>
            @endif

            <!-- Pending Confirmation Prompt (if applicable) -->
            @if($marriage->isPending())
                <div class="max-w-lg mx-auto bg-[#1e1d19] border border-[var(--accent-primary)]/40 rounded-[4px] p-5 text-center space-y-3">
                    @if($user->id !== $marriage->initiated_by_user_id)
                        <span class="text-xs font-bold text-[#e0b84c] block flex items-center justify-center gap-1.5">
                            <svg class="w-4 h-4 text-[#e0b84c]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            {{ $marriage->initiator->name }} has declared that you both have solemnized your Mangala Vivaha!
                        </span>
                        <p class="text-xs text-[#d6d2c8]">
                            Confirming will finalize your marriage milestone, update your status to Married, and close past inquiries with blessings.
                        </p>
                        <div class="flex items-center justify-center gap-3 pt-1">
                            <form action="{{ route('marriages.confirm', $marriage->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-primary text-xs py-2.5 px-6 cursor-pointer">
                                    &check; Yes, Confirm Mangala Vivaha!
                                </button>
                            </form>
                            <form action="{{ route('marriages.decline', $marriage->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-secondary text-xs py-2.5 px-4 cursor-pointer text-[#d6d2c8]">
                                    Decline
                                </button>
                            </form>
                        </div>
                    @else
                        <span class="text-xs font-bold text-[#e0b84c] block flex items-center justify-center gap-1.5">
                            <svg class="w-4 h-4 text-[#e0b84c]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Waiting for {{ $spouse ? $spouse->name : 'spouse' }} to confirm your Mangala Vivaha declaration.
                        </span>
                        <p class="text-[11px] text-[#a8a49c]">
                            A notification has been dispatched to your spouse. Once confirmed, all account transitions will take effect immediately.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Post-Vivaha Protections & Status Changes Summary -->
        <div class="card-ledger p-6 sm:p-8 space-y-6">
            <div class="border-b border-[var(--border-default)] pb-4">
                <h2 class="text-lg font-bold text-[var(--text-primary)] font-heading">
                    Shielded Account Safeguards &amp; Mangala Vivaha Protections
                </h2>
                <p class="text-xs text-[var(--text-secondary)] mt-1">
                    How Global Maitri protects your privacy and concludes your matrimonial journey with tranquility.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                <div class="p-4 rounded-[4px] bg-[var(--bg-subtle)] border border-[var(--border-default)] flex items-start gap-3">
                    <svg class="w-5 h-5 text-[var(--accent-primary)] shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v4a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    <div>
                        <strong class="text-[var(--text-primary)] block font-bold">Removed from Discovery</strong>
                        <p class="text-[var(--text-secondary)] mt-0.5">Both profiles are immediately shielded and delisted from search, recommendations, and candidate discovery.</p>
                    </div>
                </div>

                <div class="p-4 rounded-[4px] bg-[var(--bg-subtle)] border border-[var(--border-default)] flex items-start gap-3">
                    <svg class="w-5 h-5 text-[var(--accent-primary)] shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                    </svg>
                    <div>
                        <strong class="text-[var(--text-primary)] block font-bold">Past Inquiries Concluded with Metta</strong>
                        <p class="text-[var(--text-secondary)] mt-0.5">All pending and active inquiries with third suitors have been closed with a polite message of Metta and well-wishes.</p>
                    </div>
                </div>

                <div class="p-4 rounded-[4px] bg-[var(--bg-subtle)] border border-[var(--border-default)] flex items-start gap-3">
                    <svg class="w-5 h-5 text-[var(--accent-primary)] shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    <div>
                        <strong class="text-[var(--text-primary)] block font-bold">Chat Channels Archived</strong>
                        <p class="text-[var(--text-secondary)] mt-0.5">Conversations with other candidates are locked to read-only; your conversation with your spouse remains accessible.</p>
                    </div>
                </div>

                <div class="p-4 rounded-[4px] bg-[var(--bg-subtle)] border border-[var(--border-default)] flex items-start gap-3">
                    <svg class="w-5 h-5 text-[var(--accent-primary)] shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                    <div>
                        <strong class="text-[var(--text-primary)] block font-bold">Single Marriage Pass Completed</strong>
                        <p class="text-[var(--text-secondary)] mt-0.5">Your Single Marriage Pass has successfully reached completion with your solemnized marriage.</p>
                    </div>
                </div>
            </div>
        </div>

        @if($marriage->isConfirmed())
            <!-- Maitri Success Story Submission Form -->
            <div class="card-ledger p-6 sm:p-8 space-y-6">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-[var(--accent-primary)]">Community Inspiration</span>
                    <h2 class="text-lg font-bold text-[var(--text-primary)] font-heading mt-0.5">
                        Share Your Maitri Success Story
                    </h2>
                    <p class="text-xs text-[var(--text-secondary)] mt-1">
                        Inspire fellow Buddhist seekers by sharing your experience, how your Dhamma practices aligned, and words of encouragement.
                    </p>
                </div>

                <form action="{{ route('marriages.story', $marriage->id) }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider mb-1.5">
                            Story Title
                        </label>
                        <input type="text" name="story_title" value="{{ old('story_title', $marriage->story_title ?? 'How We Found Dhamma Harmony Through Global Maitri') }}" required
                               class="input-field text-xs">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider mb-1.5">
                            Your Story &amp; Words of Encouragement
                        </label>
                        <textarea name="story_body" rows="4" required placeholder="Share how your meditation practice, values, and family consultation aligned..."
                                  class="input-field text-xs">{{ old('story_body', $marriage->story_body) }}</textarea>
                    </div>

                    <div class="flex items-center justify-between flex-wrap gap-4 pt-2">
                        <label class="flex items-center gap-2 text-xs font-semibold text-[var(--text-primary)] cursor-pointer">
                            <input type="checkbox" name="story_is_public" value="1" {{ old('story_is_public', $marriage->story_is_public ?? true) ? 'checked' : '' }}
                                   class="rounded-[2px] text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                            <span>Allow publishing anonymously on Global Maitri Success Stories</span>
                        </label>

                        <button type="submit" class="btn-primary text-xs px-6 py-2.5 font-bold cursor-pointer">
                            Save Story
                        </button>
                    </div>
                </form>
            </div>
        @endif

    </div>
</div>
@endsection
