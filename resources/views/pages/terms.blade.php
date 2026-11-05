@extends('layouts.app')

@section('title', 'Terms of Service & Metta Matrimonial Code - Global Maitri')
@section('meta_description', 'Review the Global Maitri terms of service and matrimonial code covering sincere intentions, respectful conduct, Family Representative involvement, anti-dowry policy, and Mangala Vivaha commitments.')
@section('canonical_url', route('terms'))
@section('robots', 'index, follow')

@section('content')
<div class="min-h-screen bg-[var(--bg-canvas)] text-[var(--text-primary)] py-10 sm:py-16 transition-colors">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

        <!-- Header Hero -->
        <div class="text-center space-y-4">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-[4px] bg-[var(--accent-primary)]/10 border border-[var(--accent-primary)]/20 text-[var(--accent-primary)] text-xs font-bold uppercase tracking-wider">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span>Metta Matrimonial Code</span>
            </div>
            <h1 class="text-3xl sm:text-5xl font-extrabold text-[var(--text-primary)] font-heading tracking-tight">
                Terms of Service &amp; Code of Conduct
            </h1>
            <p class="text-sm sm:text-base text-[var(--text-secondary)] max-w-2xl mx-auto leading-relaxed">
                By entering Global Maitri, you commit to a matrimonial covenant grounded in sincere intention, loving-kindness (Metta), casteless equality, family involvement, and the pursuit of an auspicious lifelong union (Mangala Vivaha).
            </p>
            <div class="flex items-center justify-center gap-4 text-xs text-[var(--text-secondary)] pt-2 font-medium">
                <span>Last Updated: November 2026</span>
                <span>•</span>
                <span>Applicable Worldwide</span>
                <span>•</span>
                <span class="text-[var(--accent-primary)] font-semibold">Strictly for Mangala Vivaha</span>
            </div>
        </div>

        <!-- 4 Core Pillars of Agreement -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="card-ledger p-5 transition">
                <div class="w-10 h-10 rounded-[4px] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] flex items-center justify-center mb-3">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-sm text-[var(--text-primary)]">Mangala Vivaha Only</h3>
                <p class="text-xs text-[var(--text-secondary)] mt-1 leading-relaxed">
                    Zero tolerance for dating, casual chatting, or commercial non-matrimonial motives.
                </p>
            </div>

            <div class="card-ledger p-5 transition">
                <div class="w-10 h-10 rounded-[4px] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] flex items-center justify-center mb-3">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-sm text-[var(--text-primary)]">Family Rep Guidance</h3>
                <p class="text-xs text-[var(--text-secondary)] mt-1 leading-relaxed">
                    Parents and trusted elders supported for both grooms and brides throughout courtship.
                </p>
            </div>

            <div class="card-ledger p-5 transition">
                <div class="w-10 h-10 rounded-[4px] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] flex items-center justify-center mb-3">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-sm text-[var(--text-primary)]">Single Pass Model</h3>
                <p class="text-xs text-[var(--text-secondary)] mt-1 leading-relaxed">
                    Pay 1-time with no recurring monthly billing traps. Valid until confirmed marriage.
                </p>
            </div>

            <div class="card-ledger p-5 transition">
                <div class="w-10 h-10 rounded-[4px] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] flex items-center justify-center mb-3">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                    </svg>
                </div>
                <h3 class="font-bold text-sm text-[var(--text-primary)]">Anti-Dowry &amp; Casteless</h3>
                <p class="text-xs text-[var(--text-secondary)] mt-1 leading-relaxed">
                    Strict rejection of caste discrimination and dowry demands, honoring the Buddha's teachings.
                </p>
            </div>
        </div>

        <!-- Detailed Terms Content -->
        <div class="card-ledger p-6 sm:p-10 space-y-10">

            <!-- Section 1 -->
            <section class="space-y-3">
                <div class="flex items-center gap-3">
                    <span class="w-7 h-7 rounded-[4px] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] flex items-center justify-center text-xs font-bold font-mono">01</span>
                    <h2 class="text-lg sm:text-xl font-bold text-[var(--text-primary)] font-heading">
                        Sincere Intention &amp; Permissible Usage
                    </h2>
                </div>
                <p class="text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed pl-10">
                    Global Maitri is solely intended for adult Buddhist candidates and respectful seekers who possess the earnest intention to seek an auspicious, lifelong marriage (Mangala Vivaha). You agree never to use this platform for casual dating, superficial amusement, commercial promotion, financial solicitation, or caste-based networking.
                </p>
            </section>

            <hr class="border-[var(--border-default)]" />

            <!-- Section 2 -->
            <section class="space-y-3">
                <div class="flex items-center gap-3">
                    <span class="w-7 h-7 rounded-[4px] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] flex items-center justify-center text-xs font-bold font-mono">02</span>
                    <h2 class="text-lg sm:text-xl font-bold text-[var(--text-primary)] font-heading">
                        Eligibility, Monogamy &amp; Truthful Representation
                    </h2>
                </div>
                <p class="text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed pl-10">
                    Seekers must be at least 18 years of age and legally eligible for marriage under the laws of their jurisdiction. All biodata, educational background, marital history, and Dhamma practice details provided must be truthful and accurate to the best of your knowledge.
                </p>
            </section>

            <hr class="border-[var(--border-default)]" />

            <!-- Section 3 -->
            <section class="space-y-3">
                <div class="flex items-center gap-3">
                    <span class="w-7 h-7 rounded-[4px] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] flex items-center justify-center text-xs font-bold font-mono">03</span>
                    <h2 class="text-lg sm:text-xl font-bold text-[var(--text-primary)] font-heading">
                        Family Representative Involvement &amp; Chaperoned Communication
                    </h2>
                </div>
                <p class="text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed pl-10">
                    To maintain an auspicious and safe environment, seekers may connect trusted family representatives. Depending on configured permission levels, representatives may oversee proposals, observe chat rooms, or grant required approvals before communication proceeds.
                </p>
            </section>

            <hr class="border-[var(--border-default)]" />

            <!-- Section 4 -->
            <section class="space-y-3">
                <div class="flex items-center gap-3">
                    <span class="w-7 h-7 rounded-[4px] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] flex items-center justify-center text-xs font-bold font-mono">04</span>
                    <h2 class="text-lg sm:text-xl font-bold text-[var(--text-primary)] font-heading">
                        Strict Anti-Dowry &amp; Caste Equality Policy
                    </h2>
                </div>
                <p class="text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed pl-10">
                    Global Maitri strictly prohibits any solicitation, demand, or discussion of dowry payments. In accordance with the Buddha's timeless teachings in the Vasala Sutta (&ldquo;Not by birth is one an outcast, not by birth is one a Brahmin; by deeds is one an outcast, by deeds is one a Brahmin&rdquo;), all seekers are welcomed with equal honor regardless of ancestry or traditional caste heritage.
                </p>
            </section>
        </div>

    </div>
</div>
@endsection
