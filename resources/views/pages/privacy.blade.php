@extends('layouts.app')

@section('title', 'Privacy Policy & Data Governance - Global Maitri')
@section('meta_description', 'Read Global Maitri’s privacy policy covering personal biodata, Lotus photo shield, Family Representative governance, horoscope privacy, and GDPR-aligned data protection.')
@section('canonical_url', route('privacy'))
@section('robots', 'index, follow')

@section('content')
<div class="min-h-screen bg-[var(--bg-canvas)] text-[var(--text-primary)] py-10 sm:py-16 transition-colors">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

        <!-- Header Hero -->
        <div class="text-center space-y-4">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-[4px] bg-[var(--accent-primary)]/10 border border-[var(--accent-primary)]/20 text-[var(--accent-primary)] text-xs font-bold uppercase tracking-wider">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                <span>GDPR &amp; Mindful Data Protection</span>
            </div>
            <h1 class="text-3xl sm:text-5xl font-extrabold text-[var(--text-primary)] font-heading tracking-tight">
                Privacy Policy &amp; Data Governance
            </h1>
            <p class="text-sm sm:text-base text-[var(--text-secondary)] max-w-2xl mx-auto leading-relaxed">
                At Global Maitri, safeguarding your personal biodata, Lotus Modesty privacy, horoscope records, and family honor is our highest ethical priority.
            </p>
            <div class="flex items-center justify-center gap-4 text-xs text-[var(--text-secondary)] pt-2 font-medium">
                <span>Effective: November 2026</span>
                <span>•</span>
                <span>Version 2.0</span>
                <span>•</span>
                <span class="text-[var(--accent-primary)] font-semibold">Mindful Matrimony Standard</span>
            </div>
        </div>

        <!-- 4 Core Privacy Guarantees Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="card-ledger p-5 transition">
                <x-application-logo variant="badge" badge-class="w-10 h-10 mb-3" />
                <h3 class="font-bold text-sm text-[var(--text-primary)]">Lotus Modesty Shield</h3>
                <p class="text-xs text-[var(--text-secondary)] mt-1 leading-relaxed">
                    Photos remain sheltered across search and discovery until mutual consent is granted.
                </p>
            </div>

            <div class="card-ledger p-5 transition">
                <div class="w-10 h-10 rounded-[4px] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] flex items-center justify-center mb-3">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-sm text-[var(--text-primary)]">Family Rep Clarity</h3>
                <p class="text-xs text-[var(--text-secondary)] mt-1 leading-relaxed">
                    Elders and representatives are kept informed according to seeker-defined permissions.
                </p>
            </div>

            <div class="card-ledger p-5 transition">
                <div class="w-10 h-10 rounded-[4px] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] flex items-center justify-center mb-3">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-sm text-[var(--text-primary)]">Horoscope Privacy</h3>
                <p class="text-xs text-[var(--text-secondary)] mt-1 leading-relaxed">
                    Porondam &amp; birth chart documents are protected and revealed only upon mutual agreement.
                </p>
            </div>

            <div class="card-ledger p-5 transition">
                <div class="w-10 h-10 rounded-[4px] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] flex items-center justify-center mb-3">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-sm text-[var(--text-primary)]">PCI-DSS Encrypted</h3>
                <p class="text-xs text-[var(--text-secondary)] mt-1 leading-relaxed">
                    Single Marriage Pass payments are tokenized via Stripe &amp; PayPal. Zero card data stored.
                </p>
            </div>
        </div>

        <!-- Privacy Sections Content -->
        <div class="card-ledger p-6 sm:p-10 space-y-10">

            <!-- Section 1 -->
            <section class="space-y-3">
                <div class="flex items-center gap-3">
                    <span class="w-7 h-7 rounded-[4px] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] flex items-center justify-center text-xs font-bold font-mono">01</span>
                    <h2 class="text-lg sm:text-xl font-bold text-[var(--text-primary)] font-heading">
                        Our Ethical Commitment to Privacy
                    </h2>
                </div>
                <p class="text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed pl-10">
                    Global Maitri operates under the core Buddhist value of right mindfulness and ethical conduct. Every candidate's matrimonial search must remain discreet, dignified, and secure from voyeurism, commercial exploitation, or public disclosure. We do not sell your personal data, nor do we run third-party advertising trackers.
                </p>
            </section>

            <hr class="border-[var(--border-default)]" />

            <!-- Section 2 -->
            <section class="space-y-3">
                <div class="flex items-center gap-3">
                    <span class="w-7 h-7 rounded-[4px] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] flex items-center justify-center text-xs font-bold font-mono">02</span>
                    <h2 class="text-lg sm:text-xl font-bold text-[var(--text-primary)] font-heading">
                        Lotus Modesty Shield &amp; Photo Privacy
                    </h2>
                </div>
                <div class="text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed pl-10 space-y-2.5">
                    <p>
                        To ensure candidates evaluate inner character and Dhamma practice before appearance, all profile photos are blurred by default across public search, discovery, and listings.
                    </p>
                    <ul class="list-disc pl-5 space-y-1 text-[var(--text-secondary)]">
                        <li><strong>Unblurring requires mutual authorization:</strong> Photos are only unblurred when both candidates mutually accept a proposal, or when explicit photo access is granted by the account owner.</li>
                        <li><strong>Family Representative inspection:</strong> Linked Family Representatives hold authorized oversight according to granted permissions.</li>
                        <li><strong>Revocation:</strong> You can revoke photo access for any user at any moment with a single click.</li>
                    </ul>
                </div>
            </section>

            <hr class="border-[var(--border-default)]" />

            <!-- Section 3 -->
            <section class="space-y-3">
                <div class="flex items-center gap-3">
                    <span class="w-7 h-7 rounded-[4px] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] flex items-center justify-center text-xs font-bold font-mono">03</span>
                    <h2 class="text-lg sm:text-xl font-bold text-[var(--text-primary)] font-heading">
                        Biodata We Collect &amp; Why
                    </h2>
                </div>
                <div class="text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed pl-10 space-y-2.5">
                    <p>We only collect information strictly necessary to facilitate an auspicious Mangala Vivaha match:</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 pt-1">
                        <div class="p-3.5 rounded-[4px] bg-[var(--bg-subtle)] border border-[var(--border-default)]">
                            <h4 class="font-bold text-[var(--text-primary)] text-xs mb-1">Account &amp; Dhamma Practice</h4>
                            <p class="text-[11px] text-[var(--text-secondary)]">Name, email, tradition, meditation frequency, Five Precepts adherence, vegetarian/dietary choices, and age.</p>
                        </div>
                        <div class="p-3.5 rounded-[4px] bg-[var(--bg-subtle)] border border-[var(--border-default)]">
                            <h4 class="font-bold text-[var(--text-primary)] text-xs mb-1">Family Representative Details</h4>
                            <p class="text-[11px] text-[var(--text-secondary)]">Representative's name, relationship (e.g., Parent, Sibling, Sangha advisor), email, and permission levels.</p>
                        </div>
                    </div>
                </div>
            </section>

            <hr class="border-[var(--border-default)]" />

            <!-- Section 4 -->
            <section class="space-y-3">
                <div class="flex items-center gap-3">
                    <span class="w-7 h-7 rounded-[4px] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] flex items-center justify-center text-xs font-bold font-mono">04</span>
                    <h2 class="text-lg sm:text-xl font-bold text-[var(--text-primary)] font-heading">
                        Identity Verification &amp; KYC Security
                    </h2>
                </div>
                <p class="text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed pl-10">
                    To eliminate fake accounts and bots, our trained compliance moderators review government-issued ID documents. Identity documents are stored with AES-256 encryption in secure non-public storage and are never revealed to other seekers.
                </p>
            </section>

            <hr class="border-[var(--border-default)]" />

            <!-- Section 5 -->
            <section class="space-y-3">
                <div class="flex items-center gap-3">
                    <span class="w-7 h-7 rounded-[4px] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] flex items-center justify-center text-xs font-bold font-mono">05</span>
                    <h2 class="text-lg sm:text-xl font-bold text-[var(--text-primary)] font-heading">
                        GDPR Compliance &amp; Right to Permanent Erasure
                    </h2>
                </div>
                <p class="text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed pl-10">
                    Under the European Union General Data Protection Regulation (GDPR Article 17) and international privacy laws, you possess the unabridged right to request complete data erasure. When you delete your account, all photos, horoscope charts, biodata, matches, and chat histories are permanently wiped from active databases.
                </p>
            </section>

            <hr class="border-[var(--border-default)]" />

            <!-- Section 6: Cookies & Local Storage (Required exact string) -->
            <section id="cookies" class="scroll-mt-24 space-y-3">
                <div class="flex items-center gap-3">
                    <span class="flex h-7 w-7 items-center justify-center rounded-[4px] bg-[var(--accent-primary)]/10 font-mono text-xs font-bold text-[var(--accent-primary)]">06</span>
                    <h2 class="font-heading text-lg font-bold text-[var(--text-primary)] sm:text-xl">Cookies &amp; Local Storage</h2>
                </div>
                <p class="pl-10 text-xs leading-relaxed text-[var(--text-secondary)] sm:text-sm">
                    Global Maitri uses strictly necessary session and security cookies to authenticate users, protect requests, and maintain a secure experience. The website also uses browser local storage for preferences such as theme selection and cookie-consent status. We do not use advertising cookies or sell browsing activity.
                </p>
            </section>

            <hr class="border-[var(--border-default)]" />

            <!-- Section 7 -->
            <section class="space-y-3">
                <div class="flex items-center gap-3">
                    <span class="w-7 h-7 rounded-[4px] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] flex items-center justify-center text-xs font-bold font-mono">07</span>
                    <h2 class="text-lg sm:text-xl font-bold text-[var(--text-primary)] font-heading">
                        Payment Gateways &amp; Transaction Security
                    </h2>
                </div>
                <p class="text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed pl-10">
                    Payments for our Single Marriage Pass are processed strictly through Level 1 PCI-DSS certified payment processors—<strong>Stripe</strong> and <strong>PayPal</strong>. Global Maitri never captures, processes, or stores your credit card numbers, CVV codes, or banking login credentials on our servers.
                </p>
            </section>
        </div>

        <!-- Contact Support Footer Callout -->
        <div class="card-monograph p-8 flex flex-col sm:flex-row items-center justify-between gap-6 bg-gradient-to-b from-[var(--bg-card)] to-[var(--bg-subtle)]">
            <div class="space-y-1 text-center sm:text-left">
                <h3 class="text-lg font-serif font-bold text-[var(--text-primary)]">Questions Regarding Your Privacy?</h3>
                <p class="text-xs text-[var(--text-secondary)]">
                    Our Data Protection Officer and Community Care team are here to assist you at any time.
                </p>
            </div>
            <a href="mailto:privacy@globalmaitri.com" class="btn-primary text-xs px-6 py-2.5 font-medium shrink-0">
                Contact Privacy Team &rarr;
            </a>
        </div>

    </div>
</div>
@endsection
