@extends('layouts.app')

@section('title', 'About Us — Global Vivaha | Sacred Buddhist Matrimonial Sanctuary')
@section('meta_description', 'Learn how Global Vivaha supports mindful Buddhist matchmaking through verified identities, family involvement, Lotus privacy, Dhamma compatibility, and a lifelong Mangala Vivaha commitment.')
@section('canonical_url', route('about'))
@section('robots', 'index, follow')

@section('content')
<div class="min-h-screen bg-[var(--bg-canvas)] text-[var(--text-primary)] py-12 sm:py-16 transition-colors">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-14">

        <!-- Editorial Asymmetric Hero -->
        <div class="card-monograph p-8 sm:p-12 space-y-5">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-[3px] bg-[var(--saffron-gold)]/10 border border-[var(--saffron-gold)]/25 text-[var(--saffron-gold)] text-xs font-mono uppercase tracking-wider">
                <span class="w-1.5 h-1.5 rounded-full bg-[var(--saffron-gold)]"></span>
                <span>Our Mindful Mission</span>
            </span>
            <h1 class="text-2xl sm:text-4xl lg:text-5xl font-serif font-bold text-[var(--text-primary)] tracking-tight leading-[1.2]">
                Built for Mangala Vivaha. Grounded in Dhamma &amp; Metta.
            </h1>
            <p class="text-xs sm:text-sm text-[var(--text-secondary)] max-w-2xl leading-relaxed">
                Global Vivaha (formerly Global Maitri) was founded to offer an authentic alternative to commercial matchmaking and superficial swiping apps. We provide a calm, respectful sanctuary for Buddhist seekers and their families to seek genuine lifelong companionship rooted in shared Dhamma values.
            </p>
        </div>

        <!-- Sacred Blessing Verse -->
        <div class="card-monograph p-8 sm:p-10 text-center space-y-3 bg-gradient-to-b from-[var(--bg-card)] to-[var(--bg-subtle)]">
            <p class="font-serif italic text-base sm:text-lg text-[var(--saffron-gold)]">
                Namo Tassa Bhagavato Arahato Samma Sambuddhassa
            </p>
            <blockquote class="font-serif text-sm sm:text-base italic text-[var(--text-primary)] max-w-2xl mx-auto leading-relaxed">
                &ldquo;Live in harmony, with mutual respect, free from wrath and arrogance; cherish one another as a mother guards her only child with her life.&rdquo;
            </blockquote>
            <p class="text-[11px] font-mono uppercase tracking-wider text-[var(--text-muted)] pt-1">— Karaniya Metta Sutta &bull; Mangala Sutta</p>
        </div>

        <!-- The Contrast: Commercial Swiping vs Grounded Matrimony -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Modern Dating Trap -->
            <div class="card-monograph p-6 sm:p-8 space-y-4">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-[3px] bg-[var(--bg-subtle)] text-[var(--color-danger)] text-xs font-mono border border-[var(--border-default)]">
                    The Modern Dating Trap
                </span>
                <h3 class="text-lg font-serif font-bold text-[var(--text-primary)]">
                    Perpetual Subscriptions &amp; Surface Swipes
                </h3>
                <p class="text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed">
                    Mainstream dating platforms profit from keeping seekers single. They charge monthly recurring renewals, foster ghosting, exclude families, and reduce living human beings to split-second thumbnail evaluations.
                </p>
                <ul class="space-y-2.5 text-xs text-[var(--text-secondary)] pt-2">
                    <li class="flex items-start gap-2 text-[var(--color-danger)]">
                        <span class="font-bold">&times;</span>
                        <span>Endless monthly renewals that reward platforms for delayed matches</span>
                    </li>
                    <li class="flex items-start gap-2 text-[var(--color-danger)]">
                        <span class="font-bold">&times;</span>
                        <span>Caste categorizations, dowry pressures, and commercialized vanity</span>
                    </li>
                    <li class="flex items-start gap-2 text-[var(--color-danger)]">
                        <span class="font-bold">&times;</span>
                        <span>Isolation of seekers from family elders and mindful mentors</span>
                    </li>
                </ul>
            </div>

            <!-- Global Maitri Difference -->
            <div class="card-monograph p-6 sm:p-8 space-y-4">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-[3px] bg-[var(--saffron-gold)]/10 text-[var(--saffron-gold)] text-xs font-mono border border-[var(--saffron-gold)]/25">
                    The Global Maitri Approach
                </span>
                <h3 class="text-lg font-serif font-bold text-[var(--text-primary)]">
                    Single Marriage Pass &amp; Dhamma Harmony
                </h3>
                <p class="text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed">
                    Every element is designed around the sacred milestone of Mangala Vivaha. You pay once until your marriage is solemnized, photos remain protected by default, caste discrimination is strictly prohibited, and parents are warmly invited.
                </p>
                <ul class="space-y-2.5 text-xs text-[var(--text-primary)] pt-2">
                    <li class="flex items-start gap-2 text-[var(--color-success)]">
                        <span class="font-bold">&check;</span>
                        <span>Pay 1-Time until confirmed Mangala Vivaha — zero monthly fees</span>
                    </li>
                    <li class="flex items-start gap-2 text-[var(--color-success)]">
                        <span class="font-bold">&check;</span>
                        <span>Lotus Photo Privacy: portraits stay blurred until mutual consent</span>
                    </li>
                    <li class="flex items-start gap-2 text-[var(--color-success)]">
                        <span class="font-bold">&check;</span>
                        <span>Family Representative involvement welcomes parents and elders free</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- 4 Founding Pillars -->
        <div class="space-y-8">
            <div class="text-left space-y-1">
                <span class="text-xs font-mono uppercase tracking-wider text-[var(--saffron-gold)]">Foundational Principles</span>
                <h2 class="text-xl sm:text-2xl font-serif font-bold text-[var(--text-primary)]">
                    Guided by Buddhist Values
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="card-monograph p-6 space-y-3">
                    <div class="w-10 h-10 rounded-[3px] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-[var(--lotus-pink)] flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v4a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <h4 class="font-serif font-bold text-sm text-[var(--text-primary)]">Lotus Modesty</h4>
                    <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                        Photos are sheltered by default with an artistic lotus blur. Seekers evaluate inner values, practice, and character first.
                    </p>
                </div>

                <div class="card-monograph p-6 space-y-3">
                    <div class="w-10 h-10 rounded-[3px] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-[var(--saffron-gold)] flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h4 class="font-serif font-bold text-sm text-[var(--text-primary)]">Family Representatives</h4>
                    <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                        Parents, siblings, and trusted elders join free and collaborate on proposal reviews with clear, transparent permissions.
                    </p>
                </div>

                <div class="card-monograph p-6 space-y-3">
                    <div class="w-10 h-10 rounded-[3px] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-[var(--saffron-gold)] flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                    </div>
                    <h4 class="font-serif font-bold text-sm text-[var(--text-primary)]">Dhamma Alignment</h4>
                    <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                        Descriptive practice indicators covering tradition, meditation frequency, and ethical observance — never judgmental or ranking.
                    </p>
                </div>

                <div class="card-monograph p-6 space-y-3">
                    <div class="w-10 h-10 rounded-[3px] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-[var(--color-success)] flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h4 class="font-serif font-bold text-sm text-[var(--text-primary)]">Verified Identities</h4>
                    <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                        Every serious seeker is verified against official documents to maintain a sincere, trustworthy community.
                    </p>
                </div>
            </div>
        </div>

        <!-- Trust Metric Strip -->
        <div class="card-monograph p-6 sm:p-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center divide-y md:divide-y-0 md:divide-x divide-[var(--border-default)]">
                <div class="p-2">
                    <div class="text-2xl font-serif font-bold text-[var(--text-primary)]">Casteless</div>
                    <div class="text-[11px] text-[var(--text-secondary)] mt-1 font-mono">Equal Dignity for All</div>
                </div>
                <div class="p-2">
                    <div class="text-2xl font-serif font-bold text-[var(--saffron-gold)]">Pay 1-Time</div>
                    <div class="text-[11px] text-[var(--text-secondary)] mt-1 font-mono">Valid Until Mangala Vivaha</div>
                </div>
                <div class="p-2">
                    <div class="text-2xl font-serif font-bold text-[var(--color-danger)]">Zero Dowry</div>
                    <div class="text-[11px] text-[var(--text-secondary)] mt-1 font-mono">Strict Anti-Dowry Policy</div>
                </div>
                <div class="p-2">
                    <div class="text-2xl font-serif font-bold text-[var(--color-success)]">Family First</div>
                    <div class="text-[11px] text-[var(--text-secondary)] mt-1 font-mono">Parents Join Free</div>
                </div>
            </div>
        </div>

        <!-- Gentle Invitation Monograph -->
        <div class="card-monograph p-8 sm:p-12 text-center space-y-5 bg-gradient-to-b from-[var(--bg-card)] to-[var(--bg-subtle)]">
            <div class="max-w-xl mx-auto space-y-2">
                <h3 class="text-xl sm:text-2xl font-serif font-bold text-[var(--text-primary)]">
                    Begin with patience and intention
                </h3>
                <p class="text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed">
                    Join Buddhist individuals and families across Bangladesh, Sri Lanka, Myanmar, Thailand, Nepal, and the global diaspora taking the noble path toward marriage.
                </p>
            </div>
            <div class="flex flex-wrap items-center justify-center gap-3 pt-2">
                <a href="{{ route('register') }}" class="btn-primary text-xs px-6 py-2.5 font-medium">
                    Create Profile
                </a>
                <a href="{{ route('discovery.index') }}" class="btn-secondary text-xs px-6 py-2.5 font-medium">
                    Explore Candidates
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
