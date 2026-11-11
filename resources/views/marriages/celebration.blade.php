@extends('layouts.app')

@section('title', 'Mangala Vivaha Celebration — Global Maitri')

@section('content')
<div class="py-12 bg-[var(--bg-canvas)] min-h-screen transition-colors">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        @if(session('success'))
            <div class="p-4 rounded-[4px] bg-[var(--bg-card)] border border-[var(--color-success)] text-[var(--color-success)] text-xs font-medium flex items-center gap-2 shadow-xs">
                <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="p-4 rounded-[4px] bg-[var(--bg-card)] border border-[var(--color-danger)] text-[var(--color-danger)] text-xs font-medium flex items-center gap-2 shadow-xs">
                <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @if(session('info'))
            <div class="p-4 rounded-[4px] bg-[var(--bg-card)] border border-[var(--border-default)] text-[var(--text-secondary)] text-xs font-medium flex items-center gap-2 shadow-xs">
                <svg class="w-4 h-4 text-[var(--accent-primary)] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('info') }}</span>
            </div>
        @endif

        <!-- Sacred Mangala Vivaha Celebration Card -->
        <div class="card-monograph p-8 sm:p-12 text-center space-y-8 relative overflow-hidden bg-gradient-to-b from-[var(--bg-card)] to-[var(--bg-subtle)]">
            
            @if($marriage->isConfirmed())
                <!-- Quiet Celebration: Soft Lotus Bloom Animation -->
                <div class="flex justify-center pt-2">
                    <div class="relative w-20 h-20 flex items-center justify-center">
                        <div class="absolute inset-0 rounded-full bg-[var(--lotus-pink)]/15 animate-ping opacity-25" style="animation-duration: 3s;"></div>
                        <div class="relative w-16 h-16 rounded-full bg-[var(--bg-card)] border border-[var(--lotus-pink)]/40 flex items-center justify-center shadow-xs text-[var(--lotus-pink)] transition-transform duration-700 ease-out hover:scale-105">
                            <svg class="w-9 h-9" viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <!-- Central lotus petal -->
                                <path d="M32 10 C32 10, 24 24, 24 38 C24 46, 28 52, 32 54 C36 52, 40 46, 40 38 C40 24, 32 10, 32 10 Z" fill="currentColor" fill-opacity="0.12" />
                                <!-- Left inner petal -->
                                <path d="M32 20 C24 24, 15 32, 16 42 C17 48, 23 52, 30 53" />
                                <!-- Right inner petal -->
                                <path d="M32 20 C40 24, 49 32, 48 42 C47 48, 41 52, 34 53" />
                                <!-- Left outer petal -->
                                <path d="M25 32 C16 35, 8 44, 10 50 C12 54, 20 54, 27 52" />
                                <!-- Right outer petal -->
                                <path d="M39 32 C48 35, 56 44, 54 50 C52 54, 44 54, 37 52" />
                                <!-- Gentle base pool -->
                                <path d="M18 54 C26 56, 38 56, 46 54" stroke-dasharray="1 2" />
                            </svg>
                        </div>
                    </div>
                </div>
            @else
                <div class="flex justify-center pt-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-serif text-[var(--saffron-gold)] bg-[var(--saffron-gold)]/10 border border-[var(--saffron-gold)]/25">
                        <span class="w-1.5 h-1.5 rounded-full bg-[var(--saffron-gold)]"></span>
                        Awaiting Mutual Confirmation
                    </span>
                </div>
            @endif

            <!-- Pali Sutta Blessing -->
            <div class="space-y-2.5 max-w-2xl mx-auto">
                <p class="font-serif italic text-lg sm:text-xl text-[var(--saffron-gold)] tracking-wide leading-relaxed">
                    Asevanā ca bālānaṁ, paṇḍitānañca sevanā, pūjā ca pūjanīyānaṁ — etaṁ maṅgalamuttamaṁ.
                </p>
                <p class="text-xs sm:text-sm text-[var(--text-secondary)] italic leading-relaxed">
                    &ldquo;Not consorting with the foolish, associating with the wise, honoring those worthy of honor — this is the greatest blessing.&rdquo;
                    <span class="text-[var(--text-muted)] block text-[11px] mt-0.5 font-sans not-italic">(Mangala Sutta: Kp 5)</span>
                </p>
            </div>

            <div class="w-16 h-px bg-[var(--border-default)] mx-auto"></div>

            <!-- Main Heading -->
            <div class="space-y-2">
                <h1 class="text-2xl sm:text-3xl font-serif font-bold text-[var(--text-primary)] tracking-tight">
                    @if($marriage->isConfirmed())
                        Sadhu Sadhu Sadhu! Mangala Vivaha Mubarak!
                    @else
                        Mangala Vivaha in Mutual Confirmation
                    @endif
                </h1>
                <p class="text-xs sm:text-sm text-[var(--text-secondary)] max-w-xl mx-auto leading-relaxed">
                    @if($marriage->isConfirmed())
                        May your lifelong partnership be enriched with mutual loving-kindness (Metta), patience, mindful understanding, and enduring peace.
                    @else
                        An auspicious wedding milestone proposal has been initiated and awaits mutual confirmation between both individuals.
                    @endif
                </p>
            </div>

            <!-- Couple Card Visual -->
            <div class="p-6 sm:p-8 max-w-xl mx-auto rounded-[4px] bg-[var(--bg-canvas)] border border-[var(--border-default)] flex items-center justify-around gap-4">
                <!-- Groom -->
                <div class="text-center space-y-2">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 mx-auto rounded-[3px] bg-[var(--bg-card)] border border-[var(--border-default)] overflow-hidden shadow-xs flex items-center justify-center font-serif text-xl sm:text-2xl font-semibold text-[var(--text-primary)]">
                        @if($marriage->groom->profile?->primaryPhoto)
                            <img src="{{ $marriage->groom->profile->primaryPhoto->displayUrl() }}" alt="{{ $marriage->groom->name }}" class="w-full h-full object-cover">
                        @else
                            {{ substr($marriage->groom->name, 0, 1) }}
                        @endif
                    </div>
                    <div>
                        <span class="text-[10px] uppercase font-mono tracking-wider text-[var(--saffron-gold)] block">Groom</span>
                        <strong class="text-xs sm:text-sm font-serif font-semibold block truncate max-w-[120px] text-[var(--text-primary)]">{{ $marriage->groom->name }}</strong>
                    </div>
                </div>

                <!-- Center Union Icon -->
                <div class="flex flex-col items-center gap-1.5 px-3">
                    <div class="w-10 h-10 rounded-full bg-[var(--bg-card)] border border-[var(--border-default)] flex items-center justify-center text-[var(--lotus-pink)] shadow-xs">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                    <span class="text-[10px] font-mono tracking-widest uppercase text-[var(--text-muted)]">Vivaha</span>
                </div>

                <!-- Bride -->
                <div class="text-center space-y-2">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 mx-auto rounded-[3px] bg-[var(--bg-card)] border border-[var(--border-default)] overflow-hidden shadow-xs flex items-center justify-center font-serif text-xl sm:text-2xl font-semibold text-[var(--text-primary)]">
                        @if($marriage->bride->profile?->primaryPhoto)
                            <img src="{{ $marriage->bride->profile->primaryPhoto->displayUrl() }}" alt="{{ $marriage->bride->name }}" class="w-full h-full object-cover">
                        @else
                            {{ substr($marriage->bride->name, 0, 1) }}
                        @endif
                    </div>
                    <div>
                        <span class="text-[10px] uppercase font-mono tracking-wider text-[var(--saffron-gold)] block">Bride</span>
                        <strong class="text-xs sm:text-sm font-serif font-semibold block truncate max-w-[120px] text-[var(--text-primary)]">{{ $marriage->bride->name }}</strong>
                    </div>
                </div>
            </div>

            <!-- Digital Certificate CTA (if confirmed) -->
            @if($marriage->isConfirmed())
                <div class="pt-2">
                    <a href="{{ route('marriages.certificate', $marriage->id) }}" target="_blank" class="btn-primary inline-flex items-center gap-2 text-xs py-2.5 px-6 font-medium">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span>View &amp; Print Mangala Vivaha Digital Certificate &rarr;</span>
                    </a>
                </div>
            @endif

            <!-- Pending Confirmation Prompt (if applicable) -->
            @if($marriage->isPending())
                <div class="max-w-lg mx-auto bg-[var(--bg-canvas)] border border-[var(--saffron-gold)]/40 rounded-[4px] p-6 text-center space-y-3">
                    @if($user->id !== $marriage->initiated_by_user_id)
                        <div class="flex items-center justify-center gap-2 text-xs font-serif font-semibold text-[var(--saffron-gold)]">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            <span>{{ $marriage->initiator->name }} has declared that you both have solemnized your Mangala Vivaha!</span>
                        </div>
                        <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                            Confirming will finalize your marriage milestone, update your status to Married, and close past inquiries with gentle blessings.
                        </p>
                        <div class="flex items-center justify-center gap-3 pt-2">
                            <form action="{{ route('marriages.confirm', $marriage->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-primary text-xs py-2 px-5 cursor-pointer">
                                    &check; Yes, Confirm Mangala Vivaha!
                                </button>
                            </form>
                            <form action="{{ route('marriages.decline', $marriage->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-secondary text-xs py-2 px-4 cursor-pointer">
                                    Decline
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="flex items-center justify-center gap-2 text-xs font-serif font-semibold text-[var(--saffron-gold)]">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Waiting for {{ $spouse ? $spouse->name : 'spouse' }} to confirm your Mangala Vivaha declaration.</span>
                        </div>
                        <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                            A notification has been shared with your spouse. Once confirmed, all account transitions and privacy shields will take effect immediately.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Post-Vivaha Protections & Status Changes Summary -->
        <div class="card-monograph p-6 sm:p-8 space-y-6">
            <div class="border-b border-[var(--border-default)] pb-4">
                <span class="text-[11px] font-mono uppercase tracking-wider text-[var(--text-muted)]">Respectful Closure</span>
                <h2 class="text-lg font-serif font-bold text-[var(--text-primary)] mt-0.5">
                    Shielded Account Safeguards &amp; Mangala Vivaha Protections
                </h2>
                <p class="text-xs text-[var(--text-secondary)] mt-1">
                    How Global Maitri honors your privacy and concludes your matrimonial journey with peace.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                <div class="p-4 rounded-[4px] bg-[var(--bg-canvas)] border border-[var(--border-default)] flex items-start gap-3">
                    <svg class="w-5 h-5 text-[var(--color-success)] shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v4a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    <div>
                        <strong class="text-[var(--text-primary)] font-serif font-semibold block text-sm">Removed from Discovery</strong>
                        <p class="text-[var(--text-secondary)] mt-0.5 leading-relaxed">Both profiles are immediately shielded and delisted from search, recommendations, and candidate discovery.</p>
                    </div>
                </div>

                <div class="p-4 rounded-[4px] bg-[var(--bg-canvas)] border border-[var(--border-default)] flex items-start gap-3">
                    <svg class="w-5 h-5 text-[var(--saffron-gold)] shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                    </svg>
                    <div>
                        <strong class="text-[var(--text-primary)] font-serif font-semibold block text-sm">Past Inquiries Concluded with Metta</strong>
                        <p class="text-[var(--text-secondary)] mt-0.5 leading-relaxed">All pending and active inquiries with suitors have been closed with a polite message of Metta and kind well-wishes.</p>
                    </div>
                </div>

                <div class="p-4 rounded-[4px] bg-[var(--bg-canvas)] border border-[var(--border-default)] flex items-start gap-3">
                    <svg class="w-5 h-5 text-[var(--text-muted)] shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    <div>
                        <strong class="text-[var(--text-primary)] font-serif font-semibold block text-sm">Chat Channels Archived</strong>
                        <p class="text-[var(--text-secondary)] mt-0.5 leading-relaxed">Conversations with other candidates are closed to read-only; your conversation with your spouse remains open.</p>
                    </div>
                </div>

                <div class="p-4 rounded-[4px] bg-[var(--bg-canvas)] border border-[var(--border-default)] flex items-start gap-3">
                    <svg class="w-5 h-5 text-[var(--lotus-pink)] shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                    <div>
                        <strong class="text-[var(--text-primary)] font-serif font-semibold block text-sm">Single Marriage Pass Completed</strong>
                        <p class="text-[var(--text-secondary)] mt-0.5 leading-relaxed">Your Single Marriage Pass has successfully reached completion with your solemnized marriage.</p>
                    </div>
                </div>
            </div>
        </div>

        @if($marriage->isConfirmed())
            <!-- Maitri Success Story Submission Form -->
            <div class="card-monograph p-6 sm:p-8 space-y-6">
                <div class="border-b border-[var(--border-default)] pb-4">
                    <span class="text-[11px] font-mono uppercase tracking-wider text-[var(--saffron-gold)]">Community Inspiration</span>
                    <h2 class="text-lg font-serif font-bold text-[var(--text-primary)] mt-0.5">
                        Share Your Maitri Success Story
                    </h2>
                    <p class="text-xs text-[var(--text-secondary)] mt-1">
                        Encourage fellow Buddhist seekers by sharing your experience, how your Dhamma practices aligned, and words of encouragement.
                    </p>
                </div>

                <form action="{{ route('marriages.story', $marriage->id) }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-primary)] uppercase tracking-wider mb-1.5">
                            Story Title
                        </label>
                        <input type="text" name="story_title" value="{{ old('story_title', $marriage->story_title ?? 'How We Found Dhamma Harmony Through Global Maitri') }}" required
                               class="input-field text-xs">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-primary)] uppercase tracking-wider mb-1.5">
                            Your Story &amp; Words of Encouragement
                        </label>
                        <textarea name="story_body" rows="4" required placeholder="Share how your meditation practice, values, and family consultation aligned..."
                                  class="input-field text-xs">{{ old('story_body', $marriage->story_body) }}</textarea>
                    </div>

                    <div class="flex items-center justify-between flex-wrap gap-4 pt-2">
                        <label class="flex items-center gap-2 text-xs font-medium text-[var(--text-primary)] cursor-pointer">
                            <input type="checkbox" name="story_is_public" value="1" {{ old('story_is_public', $marriage->story_is_public ?? true) ? 'checked' : '' }}
                                   class="rounded-[2px] text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                            <span>Allow publishing anonymously on Global Maitri Success Stories</span>
                        </label>

                        <button type="submit" class="btn-primary text-xs px-6 py-2.5 font-medium cursor-pointer">
                            Save Story
                        </button>
                    </div>
                </form>
            </div>
        @endif

    </div>
</div>
@endsection
