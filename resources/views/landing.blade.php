@extends('layouts.app')

@section('title', 'Global Vivaha — Sacred Buddhist Matrimony | Kindness first. Companionship for life.')
@section('meta_description', 'A mindful, casteless Buddhist matrimonial sanctuary for serious marriage seekers and families worldwide. Verified identities, Dhamma compatibility, and mutual modesty.')
@section('canonical_url', route('landing'))
@section('robots', 'index, follow')

@section('content')
<div class="space-y-16 sm:space-y-24 pt-6 sm:pt-10 pb-16">

    <!-- ================================================================= -->
    <!-- 1. SACRED FIRST VIEWPORT: MASTHEAD & WORKING DISCOVERY CHARTER   -->
    <!-- ================================================================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="vivaha-frame relative overflow-hidden rounded-[16px] bg-[var(--color-surface)] border border-[var(--color-border)] p-6 sm:p-12 lg:p-16 vivaha-seal">
            
            {{-- Auspicious Background Watermark (Eternal Knot & Lotus) --}}
            <div class="absolute -top-16 -right-16 w-80 h-80 sm:w-96 sm:h-96 text-[var(--color-accent)] opacity-[0.04] pointer-events-none" aria-hidden="true">
                <svg viewBox="0 0 100 100" fill="currentColor">
                    <circle cx="50" cy="50" r="45" stroke="currentColor" stroke-width="2" fill="none" stroke-dasharray="2 3"/>
                    <path d="M50 15 C45 28 42 40 50 60 C58 40 55 28 50 15 Z"/>
                    <path d="M50 30 C35 38 30 50 42 62 C46 50 48 40 50 30 Z"/>
                    <path d="M50 30 C65 38 70 50 58 62 C54 50 52 40 50 30 Z"/>
                    <path d="M38 55 L50 67 L62 55 L70 63 L50 83 L30 63 Z" fill="none" stroke="currentColor" stroke-width="3"/>
                </svg>
            </div>

            <div class="max-w-3xl mx-auto text-center space-y-6">

                <!-- Auspicious Invocation -->
                <div class="inline-flex items-center gap-2.5 px-3.5 py-1 rounded-full bg-[var(--color-primary-soft)] border border-[var(--color-border)] text-xs font-semibold text-[var(--color-primary)]">
                    <span class="w-1.5 h-1.5 rounded-full bg-[var(--color-accent)]"></span>
                    <span>Namo Buddhaya • Sacred Buddhist Matrimony</span>
                </div>

                <!-- Main Purposeful Headline (Marcellus, Unhurried, Dignified) -->
                <h1 class="font-heading text-3xl sm:text-4xl lg:text-5xl font-bold text-[var(--text-primary)] leading-[1.18] tracking-tight">
                    A sacred sanctuary for lifelong Buddhist companionship.
                </h1>

                <!-- Body Narrative (65-75ch Measure) -->
                <p class="text-base sm:text-lg text-[var(--text-secondary)] leading-relaxed max-w-2xl mx-auto font-sans font-normal">
                    Dedicated to earnest seekers and families seeking an auspicious, lifelong union (<em>Mangala Vivaha</em>). Built on loving-kindness (<em>Metta &amp; Maitri</em>), Dhamma compatibility, family representative guidance, and complete mutual modesty.
                </p>

                <!-- Primary Action Cluster -->
                <div class="pt-2 flex flex-wrap items-center justify-center gap-3 sm:gap-4">
                    <a href="{{ route('register') }}"
                       class="min-h-[50px] px-8 inline-flex items-center justify-center font-serif font-bold text-base rounded-[6px] bg-[var(--color-primary)] hover:bg-[var(--color-primary-hover)] text-white shadow-xs transition duration-200 active:scale-[0.98]">
                        Begin your journey
                    </a>
                    <a href="{{ route('discovery.index') }}"
                       class="min-h-[50px] px-7 inline-flex items-center justify-center font-serif font-bold text-base rounded-[6px] bg-[var(--color-surface-alt)] hover:bg-[var(--color-border)] text-[var(--text-primary)] border border-[var(--color-border)] transition duration-200 active:scale-[0.98]">
                        Explore verified biodata
                    </a>
                </div>

                <!-- Trust Signals & Community Assurance -->
                <div class="pt-6 border-t border-[var(--color-border)] flex flex-wrap items-center justify-center gap-6 text-xs text-[var(--text-secondary)] font-medium">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[var(--color-accent)] shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                        <span>{{ $stats['verified_profiles'] }} Verified Seekers</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[var(--color-accent)] shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path stroke-linecap="round" stroke-linejoin="round" d="M22 21v-2a4 4 0 00-3-3.87"/><path stroke-linecap="round" stroke-linejoin="round" d="M16 3.13a4 4 0 010 7.75"/></svg>
                        <span>Kalyāṇa-Mitta Family Blessings</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[var(--color-accent)] shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path stroke-linecap="round" stroke-linejoin="round" d="M7 11V7a5 5 0 0110 0v4"/></svg>
                        <span>Lotus Modesty Veil</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[var(--color-accent)] shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Single Marriage Pass • No Monthly Traps</span>
                    </div>
                </div>

            </div>

            <!-- Working Search & Discovery Vessel Directly in the Viewport -->
            <div class="mt-10 sm:mt-12 pt-8 border-t border-[var(--color-border)]/80">
                <form action="{{ route('discovery.index') }}" method="GET" class="bg-[var(--color-surface-alt)] border border-[var(--color-border)] p-4 sm:p-5 rounded-[10px] shadow-xs">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 items-end">
                        
                        <!-- Buddhist Tradition -->
                        <div>
                            <label for="search-tradition" class="block text-xs font-semibold uppercase tracking-wider text-[var(--text-secondary)] mb-1.5">
                                Buddhist Tradition
                            </label>
                            <select id="search-tradition" name="tradition" class="w-full bg-[var(--color-surface)] border border-[var(--color-border)] rounded-[6px] px-3 py-2.5 text-sm text-[var(--text-primary)] focus:outline-none focus:ring-1 focus:ring-[var(--color-accent)]">
                                <option value="">All Sacred Traditions</option>
                                <option value="Theravada">Theravada Tradition</option>
                                <option value="Mahayana">Mahayana Tradition</option>
                                <option value="Vajrayana">Vajrayana Tradition</option>
                                <option value="Zen">Zen / Chan Practice</option>
                                <option value="Secular">Secular / Mindful Buddhist</option>
                            </select>
                        </div>

                        <!-- Country of Residence -->
                        <div>
                            <label for="search-country" class="block text-xs font-semibold uppercase tracking-wider text-[var(--text-secondary)] mb-1.5">
                                Region / Country
                            </label>
                            <select id="search-country" name="country" class="w-full bg-[var(--color-surface)] border border-[var(--color-border)] rounded-[6px] px-3 py-2.5 text-sm text-[var(--text-primary)] focus:outline-none focus:ring-1 focus:ring-[var(--color-accent)]">
                                <option value="">Worldwide Diaspora</option>
                                <option value="Sri Lanka">Sri Lanka</option>
                                <option value="Thailand">Thailand</option>
                                <option value="Myanmar">Myanmar</option>
                                <option value="Nepal">Nepal</option>
                                <option value="India">India</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="United States">United States</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="Australia">Australia</option>
                                <option value="Canada">Canada</option>
                            </select>
                        </div>

                        <!-- Dhamma Practice Filter -->
                        <div>
                            <label for="search-practice" class="block text-xs font-semibold uppercase tracking-wider text-[var(--text-secondary)] mb-1.5">
                                Spiritual Dedication
                            </label>
                            <select id="search-practice" name="practice_level" class="w-full bg-[var(--color-surface)] border border-[var(--color-border)] rounded-[6px] px-3 py-2.5 text-sm text-[var(--text-primary)] focus:outline-none focus:ring-1 focus:ring-[var(--color-accent)]">
                                <option value="">Any Practice Observance</option>
                                <option value="daily_meditation">Daily Meditation Practitioner</option>
                                <option value="five_precepts">Panca Sila (Five Precepts) Observer</option>
                                <option value="temple_uposatha">Uposatha &amp; Temple Active</option>
                                <option value="vegetarian">Mindful Vegetarian / Ahimsa</option>
                            </select>
                        </div>

                        <!-- Search Button -->
                        <div>
                            <button type="submit"
                                    class="w-full min-h-[44px] px-5 inline-flex items-center justify-center font-serif font-bold text-sm rounded-[6px] bg-[var(--color-primary)] hover:bg-[var(--color-primary-hover)] text-white transition duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                                Search Biodata
                            </button>
                        </div>

                    </div>
                </form>

                <!-- Representative Pathway Link -->
                <div class="mt-3 text-center">
                    <span class="text-xs text-[var(--text-secondary)]">
                        Acting as a parent, elder, or guardian?
                        <a href="{{ route('register') }}?role=wali" class="text-[var(--color-primary)] font-semibold underline hover:text-[var(--color-accent-hover)] transition">
                            Register as a Kalyāṇa-Mitta Family Mentor (100% Free)
                        </a>
                    </span>
                </div>
            </div>

        </div>
    </section>

    <!-- ================================================================= -->
    <!-- 2. FOUR SACRED PILLARS OF GLOBAL VIVAHA (EDITORIAL CHRONICLE)    -->
    <!-- ================================================================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="space-y-10">

            <div class="max-w-2xl space-y-2">
                <h2 class="font-heading text-2xl sm:text-3xl font-bold text-[var(--text-primary)]">
                    Principles of an auspicious marriage.
                </h2>
                <p class="text-sm sm:text-base text-[var(--text-secondary)] leading-relaxed">
                    Designed from first principles for lifelong companionship rather than casual amusement or commercial exploitation.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">

                <!-- Pillar 1: Dhamma-Weighted Compatibility -->
                <div class="vivaha-frame p-6 sm:p-8 rounded-[12px] space-y-3 bg-[var(--color-surface)] border border-[var(--color-border)]">
                    <div class="w-10 h-10 rounded-[8px] bg-[var(--color-primary-soft)] text-[var(--color-primary)] flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18m-9-9h18M5.636 5.636l12.728 12.728M18.364 5.636L5.636 18.364"/></svg>
                    </div>
                    <h3 class="font-heading font-bold text-lg text-[var(--text-primary)]">
                        Dhamma-Weighted Compatibility
                    </h3>
                    <p class="text-sm text-[var(--text-secondary)] leading-relaxed">
                        Match resonance is evaluated on spiritual dedication, daily meditation, adherence to the Five Precepts (<em>Panca Sila</em>), and mindful lifestyle—aligning couples on values that endure for life.
                    </p>
                </div>

                <!-- Pillar 2: Kalyāṇa-Mitta Family Support -->
                <div class="vivaha-frame p-6 sm:p-8 rounded-[12px] space-y-3 bg-[var(--color-surface)] border border-[var(--color-border)]">
                    <div class="w-10 h-10 rounded-[8px] bg-[var(--color-accent-soft)] text-[var(--color-accent-hover)] flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/></svg>
                    </div>
                    <h3 class="font-heading font-bold text-lg text-[var(--text-primary)]">
                        Kalyāṇa-Mitta Family Mentorship
                    </h3>
                    <p class="text-sm text-[var(--text-secondary)] leading-relaxed">
                        Parents, respected elders, and trusted family mentors can participate with complete honor through a dedicated, free console to review proposals, bless suitors, and counsel candidates.
                    </p>
                </div>

                <!-- Pillar 3: Lotus Privacy Shield -->
                <div class="vivaha-frame p-6 sm:p-8 rounded-[12px] space-y-3 bg-[var(--color-surface)] border border-[var(--color-border)]">
                    <div class="w-10 h-10 rounded-[8px] bg-[var(--color-lotus-soft)] text-[var(--color-primary)] flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
                    </div>
                    <h3 class="font-heading font-bold text-lg text-[var(--text-primary)]">
                        Lotus Privacy Shield
                    </h3>
                    <p class="text-sm text-[var(--text-secondary)] leading-relaxed">
                        Portraits are softly blurred server-side and contact details stay completely masked until mutual interest and explicit photo release are verified by both candidates.
                    </p>
                </div>

                <!-- Pillar 4: Single Marriage Pass -->
                <div class="vivaha-frame p-6 sm:p-8 rounded-[12px] space-y-3 bg-[var(--color-surface)] border border-[var(--color-border)]">
                    <div class="w-10 h-10 rounded-[8px] bg-[var(--color-primary-soft)] text-[var(--color-primary)] flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 14.25l6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.257c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185z"/></svg>
                    </div>
                    <h3 class="font-heading font-bold text-lg text-[var(--text-primary)]">
                        Single Marriage Pass • No Recurring Traps
                    </h3>
                    <p class="text-sm text-[var(--text-secondary)] leading-relaxed">
                        Commercial dating sites profit from keeping members single with endless monthly subscriptions. Global Vivaha charges a single, one-time pass fee that remains active until your wedding celebration.
                    </p>
                </div>

            </div>

        </div>
    </section>

    <!-- ================================================================= -->
    <!-- 3. FEATURED SEEKER BIODATA SCROLL                                 -->
    <!-- ================================================================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="space-y-8">

            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                <div class="space-y-1">
                    <h2 class="font-heading text-2xl sm:text-3xl font-bold text-[var(--text-primary)]">
                        Recent verified biodata.
                    </h2>
                    <p class="text-sm text-[var(--text-secondary)]">
                        Every profile verified with national ID and spiritual commitments.
                    </p>
                </div>
                <div>
                    <a href="{{ route('discovery.index') }}" class="font-serif font-bold text-sm text-[var(--color-primary)] hover:text-[var(--color-accent-hover)] transition inline-flex items-center gap-1.5">
                        <span>View all candidate profiles</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                    </a>
                </div>
            </div>

            <!-- Profile Cards Display -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($recentProfiles as $profile)
                    <div class="vivaha-frame rounded-[12px] bg-[var(--color-surface)] border border-[var(--color-border)] p-5 space-y-4 hover:-translate-y-1 transition duration-200">
                        
                        <!-- Top Row: Avatar & Verified Badge -->
                        <div class="flex items-center gap-3">
                            <div class="relative w-14 h-14 rounded-full bg-[var(--color-primary-soft)] border border-[var(--color-border)] flex items-center justify-center overflow-hidden shrink-0">
                                @if($profile->primaryPhoto)
                                    <img src="{{ route('photos.view', $profile->primaryPhoto) }}" alt="{{ $profile->user->name }}" class="w-full h-full object-cover photo-blur">
                                @else
                                    <span class="font-serif font-bold text-base text-[var(--color-primary)]">
                                        {{ strtoupper(substr($profile->user->name, 0, 2)) }}
                                    </span>
                                @endif
                                <div class="absolute inset-0 bg-black/15 backdrop-blur-[1px] flex items-center justify-center" title="Lotus Privacy Shield Active">
                                    <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                                </div>
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="flex items-center gap-1.5">
                                    <h3 class="font-heading font-bold text-base text-[var(--text-primary)] truncate">
                                        {{ $profile->user->name }}
                                    </h3>
                                    @if($profile->user->is_verified)
                                        <svg class="w-4 h-4 text-[var(--color-accent)] shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                    @endif
                                </div>
                                <p class="text-xs text-[var(--text-secondary)]">
                                    {{ $profile->age ? $profile->age.' yrs' : 'Adult' }} • {{ $profile->country_of_residence ?? 'Worldwide' }}
                                </p>
                            </div>
                        </div>

                        <!-- Biodata Summary -->
                        <div class="space-y-1.5 text-xs text-[var(--text-secondary)] border-t border-b border-[var(--color-border)] py-2.5">
                            <div class="flex justify-between">
                                <span class="text-[var(--text-muted)]">Tradition:</span>
                                <span class="font-semibold text-[var(--text-primary)]">{{ $profile->buddhist_tradition ?? 'Buddhist' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-[var(--text-muted)]">Profession:</span>
                                <span class="font-semibold text-[var(--text-primary)] truncate max-w-[130px]">{{ $profile->profession ?? 'Professional' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-[var(--text-muted)]">Precepts:</span>
                                <span class="font-semibold text-[var(--color-accent-hover)]">Panca Sila Observer</span>
                            </div>
                        </div>

                        <!-- Action Link -->
                        <div>
                            <a href="{{ route('profile.show', $profile->user_id) }}"
                               class="w-full min-h-[38px] px-4 inline-flex items-center justify-center font-serif font-bold text-xs rounded-[6px] bg-[var(--color-surface-alt)] hover:bg-[var(--color-primary)] hover:text-white text-[var(--color-primary)] border border-[var(--color-border)] transition duration-200">
                                View Mindful Biodata
                            </a>
                        </div>

                    </div>
                @empty
                    <div class="col-span-full vivaha-frame p-8 text-center text-sm text-[var(--text-secondary)]">
                        Biodata profiles are actively being verified. Register your profile to be blessed among the first seekers.
                    </div>
                @endforelse
            </div>

        </div>
    </section>

    <!-- ================================================================= -->
    <!-- 4. SINGLE MARRIAGE PASS CHARTER (PRICING INTEGRITY)               -->
    <!-- ================================================================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" id="pricing-charter">
        <div class="vivaha-frame rounded-[16px] bg-[var(--color-surface)] border border-[var(--color-border)] p-6 sm:p-12 space-y-10">

            <div class="text-center max-w-2xl mx-auto space-y-2">
                <h2 class="font-heading text-2xl sm:text-3xl font-bold text-[var(--text-primary)]">
                    Single Marriage Pass • One-Time Blessing
                </h2>
                <p class="text-sm sm:text-base text-[var(--text-secondary)]">
                    Conventional dating platforms profit when users stay single. Global Vivaha aligns solely with your union: pay once, remain fully blessed until marriage.
                </p>
            </div>

            <!-- Pricing Tier Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Tier 1: Free Seeker Introduction -->
                <div class="rounded-[12px] bg-[var(--color-surface-alt)] border border-[var(--color-border)] p-6 space-y-5 flex flex-col justify-between">
                    <div class="space-y-3">
                        <h3 class="font-heading font-bold text-lg text-[var(--text-primary)]">Free Seeker</h3>
                        <p class="text-xs text-[var(--text-secondary)]">Complete biodata setup, verified badge, and receiving matrimonial proposals.</p>
                        <div class="text-2xl font-bold font-serif text-[var(--text-primary)]">$0 <span class="text-xs font-normal text-[var(--text-muted)] font-sans">Forever</span></div>
                        <ul class="text-xs text-[var(--text-secondary)] space-y-2 pt-2">
                            <li class="flex items-center gap-2">✓ Verified seeker badge</li>
                            <li class="flex items-center gap-2">✓ Lotus photo privacy veil</li>
                            <li class="flex items-center gap-2">✓ Receive proposal requests</li>
                            <li class="flex items-center gap-2">✓ 1 proposal dispatch per week</li>
                        </ul>
                    </div>
                    <div>
                        <a href="{{ route('register') }}" class="w-full min-h-[42px] inline-flex items-center justify-center font-serif font-bold text-xs rounded-[6px] bg-[var(--color-surface)] text-[var(--text-primary)] border border-[var(--color-border)] hover:bg-[var(--color-border)] transition">
                            Create Free Profile
                        </a>
                    </div>
                </div>

                <!-- Tier 2: Single Marriage Pass (Featured) -->
                <div class="rounded-[12px] bg-[var(--color-surface)] border-2 border-[var(--color-accent)] p-6 space-y-5 flex flex-col justify-between shadow-md relative">
                    <div class="absolute -top-3 left-1/2 -translate-x-1/2 px-3 py-0.5 rounded-full bg-[var(--color-accent)] text-white text-[10px] font-bold uppercase tracking-wider">
                        Most Auspicious Choice
                    </div>
                    <div class="space-y-3">
                        <h3 class="font-heading font-bold text-lg text-[var(--color-primary)]">Single Marriage Pass</h3>
                        <p class="text-xs text-[var(--text-secondary)]">Full matrimonial privileges until your confirmed wedding milestone blessing.</p>
                        <div class="text-2xl font-bold font-serif text-[var(--color-primary)]">$29 <span class="text-xs font-normal text-[var(--text-muted)] font-sans">One-Time Fee Only</span></div>
                        <ul class="text-xs text-[var(--text-secondary)] space-y-2 pt-2">
                            <li class="flex items-center gap-2">✓ Unlimited proposal dispatches</li>
                            <li class="flex items-center gap-2">✓ Priority Dhamma compatibility rank</li>
                            <li class="flex items-center gap-2">✓ Direct real-time conversation access</li>
                            <li class="flex items-center gap-2">✓ Valid until confirmed Vivaha</li>
                            <li class="flex items-center gap-2">✓ <strong>No auto-billing or recurring fees</strong></li>
                        </ul>
                    </div>
                    <div>
                        <a href="{{ route('subscription.pricing') }}" class="w-full min-h-[42px] inline-flex items-center justify-center font-serif font-bold text-xs rounded-[6px] bg-[var(--color-primary)] text-white hover:bg-[var(--color-primary-hover)] transition">
                            Select Marriage Pass
                        </a>
                    </div>
                </div>

                <!-- Tier 3: Kalyāṇa-Mitta Family Mentor -->
                <div class="rounded-[12px] bg-[var(--color-surface-alt)] border border-[var(--color-border)] p-6 space-y-5 flex flex-col justify-between">
                    <div class="space-y-3">
                        <h3 class="font-heading font-bold text-lg text-[var(--text-primary)]">Family Representative</h3>
                        <p class="text-xs text-[var(--text-secondary)]">Dedicated mentor console for parents and guardians to guide and bless suitors.</p>
                        <div class="text-2xl font-bold font-serif text-[var(--text-primary)]">Free <span class="text-xs font-normal text-[var(--text-muted)] font-sans">100% Complimentary</span></div>
                        <ul class="text-xs text-[var(--text-secondary)] space-y-2 pt-2">
                            <li class="flex items-center gap-2">✓ Link candidate son/daughter/ward</li>
                            <li class="flex items-center gap-2">✓ Collaborative proposal reviews</li>
                            <li class="flex items-center gap-2">✓ Family representative badge</li>
                            <li class="flex items-center gap-2">✓ Elder consultation guidance</li>
                        </ul>
                    </div>
                    <div>
                        <a href="{{ route('register') }}?role=wali" class="w-full min-h-[42px] inline-flex items-center justify-center font-serif font-bold text-xs rounded-[6px] bg-[var(--color-surface)] text-[var(--text-primary)] border border-[var(--color-border)] hover:bg-[var(--color-border)] transition">
                            Register as Family Mentor
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </section>

</div>
@endsection
