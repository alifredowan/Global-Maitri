@extends('layouts.app')

@section('title', 'About Us - Global Maitri | Mindful Buddhist Matrimonial Platform')
@section('meta_description', 'Learn how Global Maitri supports mindful Buddhist matchmaking through verified identities, family involvement, Lotus privacy, Dhamma compatibility, and a lifelong Mangala Vivaha commitment.')
@section('canonical_url', route('about'))
@section('robots', 'index, follow')

@section('content')
<div class="min-h-screen bg-[var(--bg-canvas)] text-[var(--text-primary)] py-10 sm:py-16 transition-colors">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">

        <!-- Header Hero -->
        <div class="text-center space-y-4">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-[4px] bg-[var(--accent-primary)]/10 border border-[var(--accent-primary)]/20 text-[var(--accent-primary)] text-xs font-bold uppercase tracking-wider">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="9"/>
                    <circle cx="12" cy="12" r="3"/>
                    <path d="M12 3v6m0 6v6M3 12h6m6 0h6"/>
                </svg>
                <span>Our Mindful Mission</span>
            </div>
            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold text-[var(--text-primary)] font-heading tracking-tight leading-[1.15]">
                Built for <span class="text-[var(--accent-primary)]">Mangala Vivaha</span>. Grounded in <span class="text-[#b58900] dark:text-[#e0b84c]">Dhamma &amp; Metta</span>.
            </h1>
            <p class="text-sm sm:text-base text-[var(--text-secondary)] max-w-2xl mx-auto leading-relaxed">
                Global Maitri was founded to heal modern matchmaking by eliminating commercial dating toxicity, superficial swiping culture, caste bias, and dowry demands—nurturing lifelong companionship founded on loving-kindness.
            </p>
        </div>

        <!-- Buddhist Blessing Callout Card -->
        <div class="relative overflow-hidden p-8 sm:p-12 rounded-[4px] bg-[#141412] text-[#f4f2ee] border border-[#2d2b27] shadow-lg text-center space-y-4">
            <div class="text-[#e0b84c] text-xl sm:text-2xl font-serif">Namo Tassa Bhagavato Arahato Samma Sambuddhassa</div>
            <blockquote class="text-base sm:text-xl font-light italic text-[#d6d2c8] max-w-3xl mx-auto leading-relaxed">
                &ldquo;Live in harmony, with mutual respect, free from wrath and arrogance; cherish one another as a mother guards her only child with her life.&rdquo;
            </blockquote>
            <p class="text-xs font-bold text-[#e0b84c] tracking-wider uppercase">— Karaniya Metta Sutta &amp; Mangala Sutta</p>
        </div>

        <!-- The Problem vs Our Solution -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Modern Dating Problem -->
            <div class="card-ledger p-8 space-y-4">
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-[4px] bg-[var(--bg-subtle)] text-[var(--color-danger)] text-xs font-bold border border-[var(--border-default)]">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    The Modern Dating Trap
                </div>
                <h3 class="text-xl font-bold text-[var(--text-primary)] font-heading">
                    Perpetual Subscriptions &amp; Surface Swipes
                </h3>
                <p class="text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed">
                    Mainstream dating apps thrive on keeping seekers single. They charge monthly renewal fees, encourage superficial swiping, exclude families, foster ghosting, and encourage unverified interactions without accountability.
                </p>
                <ul class="space-y-2 text-xs text-[var(--text-secondary)] font-medium pt-2">
                    <li class="flex items-center gap-2 text-[var(--color-danger)]">
                        <span>✕</span>
                        <span>Endless monthly subscription loops designed to keep you searching</span>
                    </li>
                    <li class="flex items-center gap-2 text-[var(--color-danger)]">
                        <span>✕</span>
                        <span>Caste classifications, dowry discussions, and commercialized vanity</span>
                    </li>
                    <li class="flex items-center gap-2 text-[var(--color-danger)]">
                        <span>✕</span>
                        <span>Zero family or spiritual elder involvement in decision-making</span>
                    </li>
                </ul>
            </div>

            <!-- Global Maitri Solution -->
            <div class="card-ledger p-8 space-y-4">
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-[4px] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] text-xs font-bold border border-[var(--accent-primary)]/20">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    The Global Maitri Difference
                </div>
                <h3 class="text-xl font-bold text-[var(--text-primary)] font-heading">
                    Single Marriage Pass &amp; Dhamma Integrity
                </h3>
                <p class="text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed">
                    Every feature is built around the noble pursuit of Mangala Vivaha. You pay once until your confirmed marriage, photos are protected with Lotus Modesty, caste bias is strictly rejected, and families are warmly welcomed.
                </p>
                <ul class="space-y-2 text-xs text-[var(--text-primary)] font-medium pt-2">
                    <li class="flex items-center gap-2 text-[var(--accent-primary)]">
                        <span>✓</span>
                        <span>Pay 1-Time until confirmed Mangala Vivaha; no monthly renewal traps</span>
                    </li>
                    <li class="flex items-center gap-2 text-[var(--accent-primary)]">
                        <span>✓</span>
                        <span>Lotus Modesty Shield: photos blurred until mutual interest or consent</span>
                    </li>
                    <li class="flex items-center gap-2 text-[var(--accent-primary)]">
                        <span>✓</span>
                        <span>Transparent Family Representative guidance for both grooms and brides</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- 4 Founding Pillars -->
        <div class="space-y-8">
            <div class="text-center max-w-xl mx-auto space-y-2">
                <span class="text-xs font-bold uppercase tracking-wider text-[var(--accent-primary)]">Our Four Pillars</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-[var(--text-primary)] font-heading">
                    Grounded in the Buddha's Noble Teaching
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="card-ledger p-6 transition space-y-3">
                    <div class="w-12 h-12 rounded-[4px] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] flex items-center justify-center">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="9"/>
                            <circle cx="12" cy="12" r="3"/>
                            <path d="M12 3v6m0 6v6M3 12h6m6 0h6"/>
                        </svg>
                    </div>
                    <h4 class="font-bold text-base text-[var(--text-primary)]">Lotus Modesty</h4>
                    <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                        Photos are sheltered by default with an artistic lotus blur. Seekers evaluate inner qualities, Dhamma practice, and character first.
                    </p>
                </div>

                <div class="card-ledger p-6 transition space-y-3">
                    <div class="w-12 h-12 rounded-[4px] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h4 class="font-bold text-base text-[var(--text-primary)]">Family Representatives</h4>
                    <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                        Parents, siblings, trusted elders, or Sangha advisors can be linked with granular permissions for both men and women.
                    </p>
                </div>

                <div class="card-ledger p-6 transition space-y-3">
                    <div class="w-12 h-12 rounded-[4px] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                    </div>
                    <h4 class="font-bold text-base text-[var(--text-primary)]">Dhamma Alignment</h4>
                    <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                        Compatibility scoring based on Buddhist tradition, meditation practice, Five Precepts (Panca Sila) observance, and mindful living.
                    </p>
                </div>

                <div class="card-ledger p-6 transition space-y-3">
                    <div class="w-12 h-12 rounded-[4px] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h4 class="font-bold text-base text-[var(--text-primary)]">KYC Verified Profiles</h4>
                    <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                        Every serious seeker is verified against government ID credentials and photo liveness checks to maintain a trusted community.
                    </p>
                </div>
            </div>
        </div>

        <!-- Trust Stats Banner -->
        <div class="card-ledger p-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center divide-y md:divide-y-0 md:divide-x divide-[var(--border-default)]">
                <div class="p-4">
                    <div class="text-3xl font-extrabold text-[var(--accent-primary)] font-heading">Casteless</div>
                    <div class="text-xs text-[var(--text-secondary)] mt-1">Equal Dignity for All</div>
                </div>
                <div class="p-4">
                    <div class="text-3xl font-extrabold text-[#b58900] dark:text-[#e0b84c] font-heading">Pay 1-Time</div>
                    <div class="text-xs text-[var(--text-secondary)] mt-1">Valid Until Mangala Vivaha</div>
                </div>
                <div class="p-4">
                    <div class="text-3xl font-extrabold text-[var(--text-primary)] font-heading">Zero Dowry</div>
                    <div class="text-xs text-[var(--text-secondary)] mt-1">Strict Anti-Dowry Shield</div>
                </div>
                <div class="p-4">
                    <div class="text-3xl font-extrabold text-[var(--color-success)] font-heading">Mindful</div>
                    <div class="text-xs text-[var(--text-secondary)] mt-1">Metta-First Community</div>
                </div>
            </div>
        </div>

        <!-- Bottom Action -->
        <div class="p-8 sm:p-12 rounded-[4px] bg-[#141412] text-[#f4f2ee] border border-[#2d2b27] text-center space-y-6 shadow-xl">
            <div class="max-w-2xl mx-auto space-y-2">
                <h3 class="text-2xl sm:text-3xl font-extrabold font-heading text-white">
                    Begin Your Auspicious Journey Today
                </h3>
                <p class="text-xs sm:text-sm text-[#d6d2c8] leading-relaxed">
                    Join Buddhist seekers across Theravada, Mahayana, Vajrayana, Navayana, and mindful traditions taking the noble path toward marriage with peace, respect, and family blessings.
                </p>
            </div>
            <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('register') }}" class="btn-primary text-sm px-8 py-3.5">
                    Create Mindful Profile
                </a>
                <a href="{{ route('discovery.index') }}" class="btn-secondary text-sm px-8 py-3.5">
                    Browse Candidates
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
