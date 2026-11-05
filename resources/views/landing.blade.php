@extends('layouts.app')

@section('title', 'Global Maitri - Buddhist Matrimonial Platform | Kindness first. Companionship for life.')
@section('meta_description', 'Find a mindful Buddhist life partner through Global Maitri, with verified profiles, family representative support, privacy-first photo controls, and Dhamma-centric compatibility.')
@section('canonical_url', route('landing'))
@section('robots', 'index, follow')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6 space-y-12 sm:space-y-16">

    <!-- ================================================================= -->
    <!-- 1. HERO SECTION: FRAMED CURVED CONTAINER WITH STONE TINT CANVAS   -->
    <!-- ================================================================= -->
    <div class="card-hero relative overflow-hidden rounded-[var(--radius-xl)] bg-[var(--bg-surface)] border border-[var(--border-default)] p-6 sm:p-10 lg:p-14 shadow-sm">
        <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
            
            <!-- Left Side: Sincere left-aligned headline & trust points -->
            <div class="lg:col-span-7 space-y-6 text-left">
                <!-- Heritage Pill -->
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-[var(--radius-sm)] bg-[var(--accent-subtle)] border border-[var(--accent-primary)]/30 text-[var(--accent-primary)] text-xs font-bold uppercase tracking-wider">
                    <svg class="w-4 h-4 text-[var(--accent-primary)] shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="9"/>
                        <circle cx="12" cy="12" r="3"/>
                        <path d="M12 3v6m0 6v6M3 12h6m6 0h6M5.636 5.636l4.243 4.243m4.242 4.242l4.243 4.243M5.636 18.364l4.243-4.243m4.242-4.242l4.243-4.243"/>
                    </svg>
                    <span>Mindful Intentions &bull; Mangala Vivaha &bull; Global Buddhist Community</span>
                </div>

                <!-- Headline -->
                <h1 class="font-heading font-extrabold text-3xl sm:text-4xl lg:text-5xl text-[var(--text-primary)] tracking-tight leading-tight">
                    Find Your Life Partner with <span class="text-[var(--accent-primary)]">Loving-Kindness (Metta)</span> &amp; Family Harmony
                </h1>

                <!-- Subheading -->
                <p class="text-sm sm:text-base text-[var(--text-secondary)] leading-relaxed max-w-2xl">
                    <strong class="text-[var(--text-primary)]">Global Maitri</strong> is a mindful Buddhist matrimonial platform built for serious marriage and spiritual companionship. Featuring <strong class="text-[var(--text-primary)]">verified identities</strong>, <strong class="text-[var(--text-primary)]">family representative support</strong>, <strong class="text-[var(--text-primary)]">photo privacy controls</strong>, and <strong class="text-[var(--text-primary)]">Dhamma-weighted compatibility</strong>.
                </p>

                <!-- Monoline SVG Checkmark Trust List -->
                <div class="space-y-2.5 pt-1 text-xs sm:text-sm text-[var(--text-secondary)]">
                    <div class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-[var(--accent-primary)] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        <span><strong>100% ID KYC:</strong> Genuine seekers with verified government credentials</span>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-[var(--accent-primary)] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        <span><strong>Lotus Photo Shield:</strong> Strict modesty blur until mutual interest approval</span>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-[var(--accent-primary)] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        <span><strong>Single Marriage Pass:</strong> Pay once until your confirmed Mangala Vivaha</span>
                    </div>
                </div>

                <!-- Hero Action Buttons -->
                <div class="flex flex-wrap items-center gap-3 pt-3">
                    <a href="{{ route('register') }}" class="btn-primary text-sm !py-3 !px-6">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="9"/>
                            <path d="M12 3v18M3 12h18"/>
                        </svg>
                        <span>Create Free Profile</span>
                    </a>
                    <a href="{{ route('discovery.index') }}" class="btn-secondary text-sm !py-3 !px-5">
                        Browse Candidates &rarr;
                    </a>
                    <a href="{{ route('login') }}" class="text-xs font-semibold text-[var(--text-secondary)] hover:text-[var(--accent-primary)] px-2 py-2 transition">
                        Sign In &rarr;
                    </a>
                </div>
            </div>

            <!-- Right Side: Instant Filter / Search Ledger Box -->
            <div class="lg:col-span-5">
                <div class="card-ledger p-6 bg-[var(--bg-subtle)] border border-[var(--border-default)] space-y-4">
                    <div class="border-b border-[var(--border-default)] pb-3">
                        <h2 class="font-heading text-base font-bold text-[var(--text-primary)]">Quick Candidate Search</h2>
                        <p class="text-xs text-[var(--text-muted)]">Find practicing Buddhists seeking marriage</p>
                    </div>

                    <form action="{{ route('discovery.index') }}" method="GET" class="space-y-3.5">
                        <div>
                            <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--text-muted)] mb-1">Looking for</label>
                            <select name="gender" class="input-field w-full text-xs">
                                <option value="">Any Gender</option>
                                <option value="female">Bride (Female Candidate)</option>
                                <option value="male">Groom (Male Candidate)</option>
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--text-muted)] mb-1">Age from</label>
                                <input type="number" name="min_age" min="18" max="75" placeholder="21" class="input-field w-full text-xs">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--text-muted)] mb-1">Age to</label>
                                <input type="number" name="max_age" min="18" max="75" placeholder="38" class="input-field w-full text-xs">
                            </div>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--text-muted)] mb-1">Buddhist Tradition</label>
                            <select name="tradition" class="input-field w-full text-xs">
                                <option value="">All Traditions</option>
                                <option value="theravada">Theravada</option>
                                <option value="mahayana">Mahayana</option>
                                <option value="vajrayana">Vajrayana</option>
                                <option value="navayana">Navayana / Ambedkarite</option>
                                <option value="zen">Zen / Chan</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--text-muted)] mb-1">Country</label>
                            <select name="country" class="input-field w-full text-xs">
                                <option value="">Worldwide</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Sri Lanka">Sri Lanka</option>
                                <option value="India">India</option>
                                <option value="Thailand">Thailand</option>
                                <option value="Myanmar">Myanmar</option>
                                <option value="United States">United States</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="Australia">Australia</option>
                            </select>
                        </div>

                        <button type="submit" class="btn-primary w-full text-xs !py-2.5 mt-2 flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                            <span>Search Candidates</span>
                        </button>
                    </form>
                </div>
            </div>

        </div>

        <!-- Trust Highlights Ledger Strip -->
        <div class="mt-10 pt-6 border-t border-[var(--border-default)] grid grid-cols-2 sm:grid-cols-5 gap-3 text-xs">
            <div class="p-3 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-center">
                <svg class="w-5 h-5 mx-auto text-[var(--accent-primary)] mb-1.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
                <strong class="text-[var(--text-primary)] block">100% ID KYC</strong>
                <span class="block text-[10px] text-[var(--text-muted)] mt-0.5">Government ID Verification</span>
            </div>
            <div class="p-3 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-center">
                <svg class="w-5 h-5 mx-auto text-[var(--accent-primary)] mb-1.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                <strong class="text-[var(--text-primary)] block">Family Support</strong>
                <span class="block text-[10px] text-[var(--text-muted)] mt-0.5">Representative for Both Genders</span>
            </div>
            <div class="p-3 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-center">
                <svg class="w-5 h-5 mx-auto text-[var(--accent-primary)] mb-1.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                <strong class="text-[var(--text-primary)] block">Photo Privacy</strong>
                <span class="block text-[10px] text-[var(--text-muted)] mt-0.5">Customizable Blur Controls</span>
            </div>
            <div class="p-3 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-center">
                <svg class="w-5 h-5 mx-auto text-[var(--accent-primary)] mb-1.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="m4.93 4.93 4.24 4.24M14.83 14.83l4.24 4.24M14.83 9.17l4.24-4.24M4.93 19.07l4.24-4.24"/><circle cx="12" cy="12" r="3"/></svg>
                <strong class="text-[var(--text-primary)] block">Dhamma Matched</strong>
                <span class="block text-[10px] text-[var(--text-muted)] mt-0.5">Precepts &amp; Meditation Weighted</span>
            </div>
            <div class="p-3 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-center col-span-2 sm:col-span-1">
                <svg class="w-5 h-5 mx-auto text-[var(--accent-primary)] mb-1.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m12 3-1.9 5.8a2 2 0 0 1-1.3 1.3L3 12l5.8 1.9a2 2 0 0 1 1.3 1.3L12 21l1.9-5.8a2 2 0 0 1 1.3-1.3L21 12l-5.8-1.9a2 2 0 0 1-1.3-1.3Z"/></svg>
                <strong class="text-[var(--text-primary)] block">Single Marriage Pass</strong>
                <span class="block text-[10px] text-[var(--text-muted)] mt-0.5">Active Until Confirmed Mangala Vivaha</span>
            </div>
        </div>
    </div>

    <!-- ================================================================= -->
    <!-- 2. CORE PILLARS OF BUDDHIST MATRIMONY                             -->
    <!-- ================================================================= -->
    <div class="card-ledger p-6 sm:p-10 border border-[var(--border-default)] bg-[var(--bg-surface)] space-y-8">
        <div class="text-center max-w-3xl mx-auto space-y-2">
            <span class="text-xs font-bold uppercase tracking-wider text-[var(--accent-primary)]">Buddhist Matrimonial Values</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-[var(--text-primary)] tracking-tight font-heading">
                Mindful Companionship Built on Metta &amp; Respect
            </h2>
            <p class="text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed">
                Global Maitri is founded on the Buddhist understanding of marriage as a social union of loving-kindness, harmony, and mutual spiritual support.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Pillar 1 -->
            <div class="p-5 rounded-[var(--radius-md)] bg-[var(--bg-subtle)] border border-[var(--border-default)] space-y-3">
                <div class="w-10 h-10 rounded-[var(--radius-sm)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] flex items-center justify-center">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <h3 class="text-sm font-bold text-[var(--text-primary)] font-heading">Family Representative System</h3>
                <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                    Available for both grooms and brides. Link a parent, sibling, or trusted elder to review suitors, approve proposals, and assist with family oversight.
                </p>
            </div>

            <!-- Pillar 2 -->
            <div class="p-5 rounded-[var(--radius-md)] bg-[var(--bg-subtle)] border border-[var(--border-default)] space-y-3">
                <div class="w-10 h-10 rounded-[var(--radius-sm)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] flex items-center justify-center">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                </div>
                <h3 class="text-sm font-bold text-[var(--text-primary)] font-heading">Photo &amp; Data Privacy</h3>
                <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                    Full privacy controls: public, blurred until interest accepted, or visible on request. Sensitive income and horoscopes can be shielded from non-matches.
                </p>
            </div>

            <!-- Pillar 3 -->
            <div class="p-5 rounded-[var(--radius-md)] bg-[var(--bg-subtle)] border border-[var(--border-default)] space-y-3">
                <div class="w-10 h-10 rounded-[var(--radius-sm)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] flex items-center justify-center">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="3"/><path d="M12 3v6m0 6v6M3 12h6m6 0h6M5.636 5.636l4.243 4.243m4.242 4.242l4.243 4.243M5.636 18.364l4.243-4.243m4.242-4.242l4.243-4.243"/></svg>
                </div>
                <h3 class="text-sm font-bold text-[var(--text-primary)] font-heading">Dhamma-Weighted Match Score</h3>
                <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                    Match candidates based on tradition (Theravada, Mahayana, Vajrayana, Navayana), meditation depth, Panca Sila observance, and dietary lifestyle.
                </p>
            </div>

            <!-- Pillar 4 -->
            <div class="p-5 rounded-[var(--radius-md)] bg-[var(--bg-subtle)] border border-[var(--border-default)] space-y-3">
                <div class="w-10 h-10 rounded-[var(--radius-sm)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] flex items-center justify-center">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <h3 class="text-sm font-bold text-[var(--text-primary)] font-heading">No Caste &amp; Anti-Dowry Shield</h3>
                <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                    Strict adherence to Buddhist equality: caste is completely eliminated. Dowry demands and commercial transactions are strictly blocked and prohibited.
                </p>
            </div>
        </div>
    </div>

    <!-- ================================================================= -->
    <!-- 3. HOW IT WORKS (4 MINDFUL STEPS TO MANGALA VIVAHA)              -->
    <!-- ================================================================= -->
    <div class="card-ledger p-6 sm:p-10 border border-[var(--border-default)] bg-[var(--bg-surface)] space-y-8">
        <div class="text-center max-w-2xl mx-auto space-y-2">
            <span class="text-xs font-bold uppercase tracking-wider text-[var(--accent-primary)]">Streamlined Process</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-[var(--text-primary)] font-heading">
                Four Mindful Steps to Your Wedding Blessing
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Step 1 -->
            <div class="p-5 rounded-[var(--radius-md)] bg-[var(--bg-subtle)] border border-[var(--border-default)] space-y-2">
                <span class="text-2xl font-black text-[var(--accent-primary)]/40 font-mono">01</span>
                <h3 class="text-sm font-bold text-[var(--text-primary)] font-heading">Create Mindful Biodata</h3>
                <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                    Detail your tradition, meditation practice, Panca Sila adherence, and lifestyle preferences. Photos remain blurred by default.
                </p>
            </div>

            <!-- Step 2 -->
            <div class="p-5 rounded-[var(--radius-md)] bg-[var(--bg-subtle)] border border-[var(--border-default)] space-y-2">
                <span class="text-2xl font-black text-[var(--accent-primary)]/40 font-mono">02</span>
                <h3 class="text-sm font-bold text-[var(--text-primary)] font-heading">Involve Family Representative</h3>
                <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                    Optionally link a parent, elder, or relative. Every suitor proposal can be reviewed respectfully with family wisdom.
                </p>
            </div>

            <!-- Step 3 -->
            <div class="p-5 rounded-[var(--radius-md)] bg-[var(--bg-subtle)] border border-[var(--border-default)] space-y-2">
                <span class="text-2xl font-black text-[var(--accent-primary)]/40 font-mono">03</span>
                <h3 class="text-sm font-bold text-[var(--text-primary)] font-heading">Mindful Chat &amp; Meeting</h3>
                <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                    Communicate only after mutual acceptance. Protected by privacy filters, contact shielding, and polite communication guidelines.
                </p>
            </div>

            <!-- Step 4 -->
            <div class="p-5 rounded-[var(--radius-md)] bg-[var(--bg-subtle)] border border-[var(--border-default)] space-y-2">
                <span class="text-2xl font-black text-[var(--accent-primary)]/40 font-mono">04</span>
                <h3 class="text-sm font-bold text-[var(--text-primary)] font-heading">Mangala Vivaha Celebration</h3>
                <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                    Confirm your marriage milestone! Receive your digital Metta Blessing certificate ("May you be happy and well") and retire your active profile.
                </p>
            </div>
        </div>
    </div>

    <!-- ================================================================= -->
    <!-- 4. RECENT CANDIDATE PROFILES SHOWCASE                             -->
    <!-- ================================================================= -->
    @if($recentProfiles->isNotEmpty())
        <div class="card-ledger p-6 sm:p-10 border border-[var(--border-default)] bg-[var(--bg-surface)] space-y-8">
            <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between gap-4">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-[var(--accent-primary)]">Verified Community</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-[var(--text-primary)] font-heading">Recent Buddhist Candidates</h2>
                </div>
                <a href="{{ route('discovery.index') }}" class="text-xs sm:text-sm font-semibold text-[var(--accent-primary)] hover:text-[var(--accent-hover)] flex items-center gap-1.5 transition">
                    View all candidates &rarr;
                </a>
            </div>

            <!-- Responsive Candidate Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 justify-center">
                @foreach($recentProfiles as $profile)
                    @php
                        $loc = collect([$profile->city, $profile->country])->filter()->implode(', ');
                    @endphp
                    <article class="card-ledger flex flex-col justify-between overflow-hidden group">
                        <div>
                            <!-- Photo Area with Modesty Photo Shield -->
                            <div class="relative h-56 bg-[var(--neutral-900)] overflow-hidden">
                                @if($profile->primaryPhoto)
                                    <img src="{{ $profile->primaryPhoto->displayUrl() }}" alt="{{ $profile->user->name }}" class="w-full h-full object-cover photo-shield group-hover:scale-102 transition duration-300" loading="lazy" decoding="async">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-[var(--bg-subtle)] text-[var(--accent-primary)] font-bold text-3xl">
                                        {{ substr($profile->user->name, 0, 1) }}
                                    </div>
                                @endif

                                <!-- Top Badges -->
                                <div class="absolute top-2.5 inset-x-2.5 flex items-center justify-between pointer-events-none">
                                    <span class="badge-status bg-black/70 text-white border border-white/15 text-[10px] backdrop-blur-xs flex items-center gap-1">
                                        <svg class="w-3 h-3 text-[var(--accent-primary)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                        <span>Photo Privacy</span>
                                    </span>
                                    @if($profile->user->is_verified)
                                        <span class="badge-verified bg-black/70 text-white border-white/20 backdrop-blur-xs text-[10px]">
                                            <svg class="w-3 h-3 text-[var(--accent-primary)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                                            <span>Verified</span>
                                        </span>
                                    @endif
                                </div>

                                <!-- Bottom Info Scrim -->
                                <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent p-3.5 text-white">
                                    <p class="text-[10px] font-semibold text-[var(--accent-subtle)]">
                                        {{ ucfirst(str_replace('_', ' ', $profile->tradition ?? 'Buddhist')) }}
                                        @if($profile->ethnic_community && $profile->ethnic_community !== 'no_preference')
                                            &bull; {{ ucfirst($profile->ethnic_community) }}
                                        @endif
                                    </p>
                                    <h4 class="font-bold text-sm truncate font-heading">{{ $profile->user->name }}</h4>
                                    <p class="text-[11px] text-[var(--neutral-300)] mt-0.5 truncate">
                                        {{ $profile->user->age }} yrs{{ $loc ? ' &bull; ' . $loc : '' }}
                                    </p>
                                </div>
                            </div>

                            <!-- Biodata Summary Matrix -->
                            <div class="p-3.5 space-y-2 border-b border-[var(--border-subtle)]">
                                <div class="grid grid-cols-2 gap-2 text-xs">
                                    <div>
                                        <span class="text-[10px] uppercase font-bold text-[var(--text-muted)] tracking-wider block">Meditation</span>
                                        <span class="font-semibold text-[var(--text-primary)] truncate block capitalize">{{ str_replace('_', ' ', $profile->meditation_frequency ?? 'Practicing') }}</span>
                                    </div>
                                    <div>
                                        <span class="text-[10px] uppercase font-bold text-[var(--text-muted)] tracking-wider block">Diet</span>
                                        <span class="font-semibold text-[var(--text-primary)] truncate block capitalize">{{ ucfirst($profile->dietary_preference ?? 'Vegetarian') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card Action CTA -->
                        <div class="p-3.5">
                            <a href="{{ route('discovery.show', $profile->user_id) }}" class="btn-primary w-full text-center text-xs !py-2 block">
                                View Profile &rarr;
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    @endif

    <!-- ================================================================= -->
    <!-- 5. PRICING SECTION: SINGLE MARRIAGE PASS (FR-10.1, FR-10.2)       -->
    <!-- ================================================================= -->
    <div class="card-ledger p-6 sm:p-10 border border-[var(--border-default)] bg-[var(--bg-surface)] space-y-8">
        <div class="text-center max-w-3xl mx-auto space-y-2">
            <span class="text-xs font-bold uppercase tracking-wider text-[var(--accent-primary)]">Fair &amp; Transparent Membership</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-[var(--text-primary)] tracking-tight font-heading">
                Pro Single Marriage Pass — Never Monthly Subscriptions
            </h2>
            <p class="text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed">
                Core matching and family representative support are always free. Upgrade once for unlimited daily views, advanced Dhamma filters, and candidate insights until your confirmed wedding.
            </p>
        </div>

        <!-- 3 Pricing Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-6xl mx-auto items-stretch">
            @foreach($plans as $plan)
                @php
                    $isFree = $plan->isFree();
                    $isPopular = (bool) $plan->is_popular;
                @endphp
                <div class="card-ledger p-6 {{ $isPopular ? 'border-2 border-[var(--accent-primary)] bg-[var(--bg-surface)] shadow-md relative' : 'border border-[var(--border-default)] bg-[var(--bg-subtle)]' }} flex flex-col justify-between h-full">

                    <div>
                        <!-- Top Badge Pill -->
                        <div class="flex items-center justify-between mb-3">
                            <span class="px-2.5 py-0.5 rounded-[var(--radius-sm)] text-[11px] font-bold {{ $isFree ? 'bg-[var(--bg-subtle)] text-[var(--text-secondary)] border border-[var(--border-default)]' : ($isPopular ? 'bg-[var(--accent-primary)] text-white' : 'bg-[var(--accent-subtle)] text-[var(--accent-primary)] border border-[var(--accent-primary)]/30') }}">
                                {{ $isFree ? 'Free Forever' : ($isPopular ? '★ Most Popular' : 'VIP Tier') }}
                            </span>
                            @if($plan->badge_text && !$isPopular)
                                <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] text-[var(--text-muted)] border border-[var(--border-default)]">
                                    {{ $plan->badge_text }}
                                </span>
                            @endif
                        </div>

                        <h3 class="text-lg font-bold text-[var(--text-primary)] font-heading">{{ $plan->name }}</h3>
                        <p class="text-xs text-[var(--text-secondary)] mt-1 leading-relaxed">{{ $plan->description }}</p>

                        <!-- Pricing Value -->
                        <div class="my-5 border-y border-[var(--border-subtle)] py-4">
                            @if($isFree)
                                <div class="flex items-baseline gap-1.5">
                                    <span class="text-3xl font-extrabold text-[var(--text-primary)] font-heading">$0</span>
                                    <span class="text-xs text-[var(--text-muted)] font-semibold">/ forever free</span>
                                </div>
                                <span class="text-[11px] text-[var(--text-muted)] block mt-1">Always available for seekers on basic matching.</span>
                            @else
                                <div class="flex items-baseline gap-2">
                                    <span class="text-3xl font-extrabold text-[var(--text-primary)] font-heading">${{ number_format($plan->monthly_price, 2) }}</span>
                                    <span class="px-2 py-0.5 rounded-[var(--radius-sm)] text-[10px] font-bold bg-[var(--accent-subtle)] text-[var(--accent-primary)] border border-[var(--accent-primary)]/30">
                                        Pay 1-Time
                                    </span>
                                </div>
                                <div class="flex items-center gap-1.5 text-xs font-bold text-[var(--accent-primary)] mt-1.5">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                                    <span>Active Until Confirmed Mangala Vivaha</span>
                                </div>
                                <p class="text-[10px] text-[var(--text-muted)] mt-0.5">
                                    No recurring monthly charges. Valid until your Mangala Vivaha.
                                </p>
                            @endif
                        </div>

                        <!-- Features List -->
                        <ul class="space-y-2 text-xs text-[var(--text-secondary)]">
                            @if(!empty($plan->features) && count($plan->features) > 0)
                                @foreach($plan->features as $featureItem)
                                    <li class="flex items-center gap-2">
                                        <svg class="w-3.5 h-3.5 text-[var(--accent-primary)] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                        <span>{{ preg_replace('/\s*\(FR-[^\)]+\)/', '', $featureItem) }}</span>
                                    </li>
                                @endforeach
                            @else
                                <li class="flex items-center gap-2">
                                    <svg class="w-3.5 h-3.5 text-[var(--accent-primary)] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                    <span>{{ $plan->isUnlimitedViews() ? 'Unlimited daily profile views' : $plan->daily_profile_views . ' daily profile views' }}</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-3.5 h-3.5 text-[var(--accent-primary)] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                    <span>{{ $plan->isUnlimitedInterests() ? 'Unlimited interest requests' : $plan->daily_interests . ' daily interest requests' }}</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-3.5 h-3.5 text-[var(--accent-primary)] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                    <span>Family representative support for both genders</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-3.5 h-3.5 text-[var(--accent-primary)] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                    <span>Default photo privacy protection</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-3.5 h-3.5 text-[var(--accent-primary)] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                    <span>Advanced Dhamma &amp; meditation filters</span>
                                </li>
                            @endif
                        </ul>
                    </div>

                    <!-- CTA Button -->
                    <div class="mt-6 pt-4 border-t border-[var(--border-subtle)]">
                        @if($isFree)
                            <a href="{{ route('register') }}" class="btn-secondary w-full text-center text-xs !py-2.5 block">
                                Get Started Free
                            </a>
                        @else
                            <a href="{{ route('subscription.checkout', $plan->slug) }}" class="btn-primary w-full text-center text-xs !py-2.5 block">
                                Choose {{ trim(Str::before($plan->name, '(')) ?: $plan->name }} &rarr;
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- ================================================================= -->
    <!-- 6. FREQUENTLY ASKED QUESTIONS (FAQ ACCORDION)                    -->
    <!-- ================================================================= -->
    <div class="card-ledger p-6 sm:p-10 border border-[var(--border-default)] bg-[var(--bg-surface)] space-y-6"
         x-data="{ activeFaq: null }">
        <div class="text-center space-y-2 max-w-3xl mx-auto">
            <span class="text-xs font-bold uppercase tracking-wider text-[var(--accent-primary)]">Common Questions</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-[var(--text-primary)] font-heading">
                Frequently Asked Questions
            </h2>
        </div>

        <div class="space-y-2.5 max-w-4xl mx-auto">
            <!-- FAQ 1 -->
            <div class="rounded-[var(--radius-md)] bg-[var(--bg-subtle)] border border-[var(--border-default)] overflow-hidden">
                <button type="button"
                        @click="activeFaq = (activeFaq === 1 ? null : 1)"
                        class="w-full p-4 text-left font-bold text-xs sm:text-sm text-[var(--text-primary)] flex items-center justify-between gap-4 cursor-pointer">
                    <span>How does the Single Marriage Pass work?</span>
                    <span class="text-[var(--accent-primary)] text-sm transition transform" :class="activeFaq === 1 ? 'rotate-180' : ''">&darr;</span>
                </button>
                <div x-show="activeFaq === 1" x-collapse class="px-4 pb-4 text-xs text-[var(--text-secondary)] leading-relaxed border-t border-[var(--border-subtle)] pt-2.5">
                    You pay once for your single marriage pass. There are zero recurring monthly charges or hidden renewal fees. Your pass remains active until you successfully find your partner and confirm your marriage milestone on the platform.
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="rounded-[var(--radius-md)] bg-[var(--bg-subtle)] border border-[var(--border-default)] overflow-hidden">
                <button type="button"
                        @click="activeFaq = (activeFaq === 2 ? null : 2)"
                        class="w-full p-4 text-left font-bold text-xs sm:text-sm text-[var(--text-primary)] flex items-center justify-between gap-4 cursor-pointer">
                    <span>Is there any caste filter on Global Maitri?</span>
                    <span class="text-[var(--accent-primary)] text-sm transition transform" :class="activeFaq === 2 ? 'rotate-180' : ''">&darr;</span>
                </button>
                <div x-show="activeFaq === 2" x-collapse class="px-4 pb-4 text-xs text-[var(--text-secondary)] leading-relaxed border-t border-[var(--border-subtle)] pt-2.5">
                    No. In accordance with the teachings of the Buddha, caste is entirely rejected. There are no caste fields. We provide only an optional cultural/ethnic community field (e.g., Barua, Chakma, Sinhalese, Thai, Burmese, Ambedkarite, Tibetan, Newar) with a "No preference" option.
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="rounded-[var(--radius-md)] bg-[var(--bg-subtle)] border border-[var(--border-default)] overflow-hidden">
                <button type="button"
                        @click="activeFaq = (activeFaq === 3 ? null : 3)"
                        class="w-full p-4 text-left font-bold text-xs sm:text-sm text-[var(--text-primary)] flex items-center justify-between gap-4 cursor-pointer">
                    <span>How does the Family Representative system work?</span>
                    <span class="text-[var(--accent-primary)] text-sm transition transform" :class="activeFaq === 3 ? 'rotate-180' : ''">&darr;</span>
                </button>
                <div x-show="activeFaq === 3" x-collapse class="px-4 pb-4 text-xs text-[var(--text-secondary)] leading-relaxed border-t border-[var(--border-subtle)] pt-2.5">
                    Candidates of either gender can optionally link a parent, sibling, or trusted elder relative. Representatives get their own free dashboard where they can review proposals, assist with respectful introductions, or chaperone chat conversations according to your preference.
                </div>
            </div>

            <!-- FAQ 4 -->
            <div class="rounded-[var(--radius-md)] bg-[var(--bg-subtle)] border border-[var(--border-default)] overflow-hidden">
                <button type="button"
                        @click="activeFaq = (activeFaq === 4 ? null : 4)"
                        class="w-full p-4 text-left font-bold text-xs sm:text-sm text-[var(--text-primary)] flex items-center justify-between gap-4 cursor-pointer">
                    <span>What is the platform's policy on dowry and married users?</span>
                    <span class="text-[var(--accent-primary)] text-sm transition transform" :class="activeFaq === 4 ? 'rotate-180' : ''">&darr;</span>
                </button>
                <div x-show="activeFaq === 4" x-collapse class="px-4 pb-4 text-xs text-[var(--text-secondary)] leading-relaxed border-t border-[var(--border-subtle)] pt-2.5">
                    Global Maitri strictly upholds monogamy; currently married individuals are completely barred from registering. Furthermore, dowry demands are illegal under Bangladesh and India laws and are strictly blocked and flagged across all communication. Divorced and widowed candidates are welcomed with equal dignity and compassion.
                </div>
            </div>
        </div>
    </div>

    <!-- ================================================================= -->
    <!-- 7. BOTTOM CALL TO ACTION BANNER                                  -->
    <!-- ================================================================= -->
    <div class="card-hero rounded-[var(--radius-xl)] bg-[var(--bg-surface)] border border-[var(--border-default)] p-8 sm:p-12 text-center space-y-4">
        <h2 class="text-2xl sm:text-3xl font-extrabold font-heading text-[var(--text-primary)] tracking-tight">
            Begin Your Journey to a Blessed Mangala Vivaha
        </h2>
        <p class="text-xs sm:text-sm text-[var(--text-secondary)] max-w-xl mx-auto leading-relaxed">
            "May you be happy and well." Experience dignified matchmaking designed with loving-kindness, family harmony, and ethical mindful living.
        </p>
        <div class="flex flex-wrap items-center justify-center gap-3 pt-2">
            <a href="{{ route('register') }}" class="btn-primary text-xs sm:text-sm !py-2.5 !px-6">
                Create Free Profile &rarr;
            </a>
            <a href="{{ route('about') }}" class="btn-secondary text-xs sm:text-sm !py-2.5 !px-5">
                Learn More About Global Maitri
            </a>
        </div>
    </div>

</div>
@endsection
