@extends('layouts.app')

@section('title', 'Terms of Service & Metta Matrimonial Code - Global Maitri')
@section('meta_description', 'Review the Global Maitri terms of service and matrimonial code covering sincere intentions, respectful conduct, Family Representative involvement, anti-dowry policy, and Mangala Vivaha commitments.')
@section('canonical_url', route('terms'))
@section('robots', 'index, follow')

@section('content')
<div class="min-h-screen bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-200 py-10 sm:py-16">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

        <!-- Header Hero -->
        <div class="text-center space-y-4">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-rose-100 dark:bg-rose-950/80 border border-rose-300 dark:border-rose-800 text-rose-800 dark:text-rose-300 text-xs font-bold uppercase tracking-wider">
                <span>📜</span>
                <span>Metta Matrimonial Code</span>
            </div>
            <h1 class="text-3xl sm:text-5xl font-extrabold text-slate-900 dark:text-white font-heading tracking-tight">
                Terms of Service &amp; Code of Conduct
            </h1>
            <p class="text-sm sm:text-base text-slate-600 dark:text-slate-400 max-w-2xl mx-auto leading-relaxed">
                By entering Global Maitri, you commit to a matrimonial covenant grounded in sincere intention, loving-kindness (Metta), casteless equality, family involvement, and the pursuit of an auspicious lifelong union (Mangala Vivaha).
            </p>
            <div class="flex items-center justify-center gap-4 text-xs text-slate-500 dark:text-slate-400 pt-2 font-medium">
                <span>Last Updated: November 2026</span>
                <span>•</span>
                <span>Applicable Worldwide</span>
                <span>•</span>
                <span class="text-rose-700 dark:text-rose-400 font-semibold">Strictly for Mangala Vivaha</span>
            </div>
        </div>

        <!-- 4 Core Pillars of Agreement -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-xs hover:border-rose-500/50 transition">
                <div class="w-10 h-10 rounded-xl bg-rose-100 dark:bg-rose-950/80 text-rose-700 dark:text-rose-400 flex items-center justify-center text-xl mb-3">
                    💍
                </div>
                <h3 class="font-bold text-sm text-slate-900 dark:text-white">Mangala Vivaha Only</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 leading-relaxed">
                    Zero tolerance for dating, casual chatting, or commercial non-matrimonial motives.
                </p>
            </div>

            <div class="p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-xs hover:border-rose-500/50 transition">
                <div class="w-10 h-10 rounded-xl bg-amber-100 dark:bg-amber-950/80 text-amber-700 dark:text-amber-400 flex items-center justify-center text-xl mb-3">
                    👨‍👩‍👧
                </div>
                <h3 class="font-bold text-sm text-slate-900 dark:text-white">Family Rep Guidance</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 leading-relaxed">
                    Parents and trusted elders supported for both grooms and brides throughout courtship.
                </p>
            </div>

            <div class="p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-xs hover:border-rose-500/50 transition">
                <div class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-950/80 text-blue-700 dark:text-blue-400 flex items-center justify-center text-xl mb-3">
                    🏷️
                </div>
                <h3 class="font-bold text-sm text-slate-900 dark:text-white">Single Pass Model</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 leading-relaxed">
                    Pay 1-time with no recurring monthly billing traps. Valid until confirmed marriage.
                </p>
            </div>

            <div class="p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-xs hover:border-rose-500/50 transition">
                <div class="w-10 h-10 rounded-xl bg-purple-100 dark:bg-purple-950/80 text-purple-700 dark:text-purple-400 flex items-center justify-center text-xl mb-3">
                    ⚖️
                </div>
                <h3 class="font-bold text-sm text-slate-900 dark:text-white">Anti-Dowry &amp; Casteless</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 leading-relaxed">
                    Strict rejection of caste discrimination and dowry demands, honoring the Buddha's teachings.
                </p>
            </div>
        </div>

        <!-- Detailed Terms Content -->
        <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 sm:p-10 border border-slate-200/80 dark:border-slate-800 shadow-sm space-y-10">

            <!-- Section 1 -->
            <section class="space-y-3">
                <div class="flex items-center gap-3">
                    <span class="w-7 h-7 rounded-lg bg-rose-100 dark:bg-rose-950/80 text-rose-700 dark:text-rose-400 flex items-center justify-center text-xs font-bold font-mono">01</span>
                    <h2 class="text-lg sm:text-xl font-bold text-slate-900 dark:text-white font-heading">
                        Sincere Intention &amp; Permissible Usage
                    </h2>
                </div>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed pl-10">
                    Global Maitri is solely intended for adult Buddhist candidates and respectful seekers who possess the earnest intention to seek an auspicious, lifelong marriage (Mangala Vivaha). You agree never to use this platform for casual dating, superficial amusement, commercial promotion, financial solicitation, or caste-based networking.
                </p>
            </section>

            <hr class="border-slate-100 dark:border-slate-800" />

            <!-- Section 2 -->
            <section class="space-y-3">
                <div class="flex items-center gap-3">
                    <span class="w-7 h-7 rounded-lg bg-rose-100 dark:bg-rose-950/80 text-rose-700 dark:text-rose-400 flex items-center justify-center text-xs font-bold font-mono">02</span>
                    <h2 class="text-lg sm:text-xl font-bold text-slate-900 dark:text-white font-heading">
                        Eligibility, Monogamy &amp; Truthful Representation
                    </h2>
                </div>
                <div class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed pl-10 space-y-2">
                    <p>To register as an active matrimonial candidate, you warrant and represent that:</p>
                    <ul class="list-disc pl-5 space-y-1 text-slate-500 dark:text-slate-400">
                        <li>You are at least 18 years of age (or the legal marriage age in your jurisdiction).</li>
                        <li>You are strictly unmarried (never married, legally divorced, or widowed). In accordance with Buddhist matrimonial ethics, <strong>currently married persons are strictly prohibited</strong> from joining or maintaining active profiles.</li>
                        <li>All biodata information, Buddhist tradition, Five Precepts practice, education, and marital history provided are strictly truthful and verifiable.</li>
                    </ul>
                </div>
            </section>

            <hr class="border-slate-100 dark:border-slate-800" />

            <!-- Section 3 -->
            <section class="space-y-3">
                <div class="flex items-center gap-3">
                    <span class="w-7 h-7 rounded-lg bg-rose-100 dark:bg-rose-950/80 text-rose-700 dark:text-rose-400 flex items-center justify-center text-xs font-bold font-mono">03</span>
                    <h2 class="text-lg sm:text-xl font-bold text-slate-900 dark:text-white font-heading">
                        Universal Family Representative Governance
                    </h2>
                </div>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed pl-10">
                    Both female and male candidates have the built-in option to link a Family Representative (Father, Mother, Brother, Sister, Elder Relative, or Sangha advisor) to review profiles, assist in proposal evaluation, and chaperone conversations. Candidates agree to interact with family representatives with the highest degree of respect and courtesy.
                </p>
            </section>

            <hr class="border-slate-100 dark:border-slate-800" />

            <!-- Section 4 -->
            <section class="space-y-3">
                <div class="flex items-center gap-3">
                    <span class="w-7 h-7 rounded-lg bg-rose-100 dark:bg-rose-950/80 text-rose-700 dark:text-rose-400 flex items-center justify-center text-xs font-bold font-mono">04</span>
                    <h2 class="text-lg sm:text-xl font-bold text-slate-900 dark:text-white font-heading">
                        Single Marriage Pass &amp; Fair Billing
                    </h2>
                </div>
                <div class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed pl-10 space-y-2">
                    <p>
                        Unlike commercial dating platforms that profit by keeping members perpetually single on recurring monthly subscriptions, Global Maitri operates on an ethical <strong>Single Marriage Pass</strong> model:
                    </p>
                    <ul class="list-disc pl-5 space-y-1 text-slate-500 dark:text-slate-400">
                        <li><strong>One-time payment:</strong> You pay once for your chosen pass. There are zero surprise monthly charges or automatic renewals.</li>
                        <li><strong>Active until Mangala Vivaha:</strong> Your pass remains fully active and valid until you successfully find your partner and confirm your marriage celebration.</li>
                        <li><strong>Core features free:</strong> Profile creation, Dhamma matching, family rep linking, and proposal exchanges remain free.</li>
                    </ul>
                </div>
            </section>

            <hr class="border-slate-100 dark:border-slate-800" />

            <!-- Section 5 -->
            <section class="space-y-3">
                <div class="flex items-center gap-3">
                    <span class="w-7 h-7 rounded-lg bg-rose-100 dark:bg-rose-950/80 text-rose-700 dark:text-rose-400 flex items-center justify-center text-xs font-bold font-mono">05</span>
                    <h2 class="text-lg sm:text-xl font-bold text-slate-900 dark:text-white font-heading">
                        Zero Tolerance for Dowry, Caste Discrimination &amp; Harassment
                    </h2>
                </div>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed pl-10">
                    Buddhism upholds the fundamental equality of all human beings. We strictly prohibit caste-based discrimination and dowry demands of any kind. Automated scans monitor conversations for dowry terminology, contact leakage, inappropriate advances, and abusive language. Any candidate or representative found demanding dowry, harassing members, or falsifying identity will face immediate account termination without refund.
                </p>
            </section>

            <hr class="border-slate-100 dark:border-slate-800" />

            <!-- Section 6 -->
            <section class="space-y-3">
                <div class="flex items-center gap-3">
                    <span class="w-7 h-7 rounded-lg bg-rose-100 dark:bg-rose-950/80 text-rose-700 dark:text-rose-400 flex items-center justify-center text-xs font-bold font-mono">06</span>
                    <h2 class="text-lg sm:text-xl font-bold text-slate-900 dark:text-white font-heading">
                        Platform Role &amp; Limitation of Liability
                    </h2>
                </div>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed pl-10">
                    Global Maitri provides matrimonial matchmaking discovery, compatibility evaluation, and secure chaperoned communication infrastructure. We are not a civil court, temple authority, or legal registrar, and do not execute legal civil marriages. The final due diligence, character verification, background verification, and formal legal registration remain the responsibility of the candidates and their families.
                </p>
            </section>
        </div>

        <!-- Bottom CTA -->
        <div class="p-8 rounded-3xl bg-slate-900 text-white border border-rose-900/80 flex flex-col sm:flex-row items-center justify-between gap-6 shadow-xl">
            <div class="space-y-1 text-center sm:text-left">
                <h3 class="text-lg font-bold font-heading">Ready to Begin with Mindful Intentions?</h3>
                <p class="text-xs text-rose-200/90">
                    Create your biodata today and find your compatible life companion with peace of mind.
                </p>
            </div>
            <a href="{{ route('register') }}" class="px-6 py-3 rounded-xl bg-amber-400 hover:bg-amber-300 text-slate-950 text-xs font-bold transition shrink-0 shadow-md">
                Register Mindful Profile &rarr;
            </a>
        </div>

    </div>
</div>
@endsection
