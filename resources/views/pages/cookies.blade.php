@extends('layouts.app')

@section('title', 'Cookie Policy — Global Vivaha')
@section('meta_description', 'Learn how Global Vivaha uses cookies and local storage responsibly to authenticate sessions, maintain security, and respect your privacy choices.')
@section('canonical_url', route('cookies'))
@section('robots', 'index, follow')

@section('content')
<div class="min-h-screen bg-[var(--bg-canvas)] text-[var(--text-primary)] py-10 sm:py-16 transition-colors">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

        <!-- Header -->
        <div class="text-left space-y-3 border-b border-[var(--border-default)] pb-8">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-[var(--radius-xs)] bg-[var(--accent-subtle)] border border-[var(--border-default)] text-[var(--accent-text)] text-xs font-semibold">
                <span>Privacy &amp; Data Governance</span>
            </div>
            <h1 class="font-heading text-3xl sm:text-4xl font-bold tracking-tight text-[var(--text-primary)]">
                Cookie Policy
            </h1>
            <p class="text-base text-[var(--text-secondary)] max-w-2xl leading-relaxed">
                We believe in transparency and kindness. We use only a few essential cookies to keep you safely signed in, and we let you choose whether optional analytics are enabled.
            </p>
            <div class="flex flex-wrap items-center gap-3 pt-2">
                <button type="button"
                        @click="$dispatch('open-cookie-settings')"
                        class="btn-primary text-xs !py-2 !px-4">
                    Change cookie preferences
                </button>
                <a href="{{ route('privacy') }}" class="btn-secondary text-xs !py-2 !px-4">
                    Read Privacy Policy &rarr;
                </a>
            </div>
        </div>

        <!-- Cookie Categories -->
        <div class="space-y-6">

            <!-- 1. Strictly Necessary -->
            <div class="rounded-[var(--radius-md)] bg-[var(--bg-surface)] border border-[var(--border-default)] p-6 space-y-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <span class="flex h-6 w-6 items-center justify-center rounded-full bg-[var(--accent-subtle)] text-[11px] font-bold text-[var(--accent-primary)]">1</span>
                        <h2 class="font-heading text-base font-bold text-[var(--text-primary)]">Strictly Necessary Cookies</h2>
                    </div>
                    <span class="text-[10px] font-semibold px-2 py-0.5 rounded bg-[var(--color-success-bg)] text-[var(--color-success)] border border-[var(--color-success-border)]">
                        Always active
                    </span>
                </div>
                <p class="text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed">
                    These cookies are essential for our website to operate securely. They enable you to log in, keep your session active, protect forms from CSRF tampering, and remember your visual theme preference. Because the platform cannot function safely without them, they cannot be turned off.
                </p>
                <div class="text-[11px] text-[var(--text-muted)] pt-1 flex flex-wrap gap-4">
                    <span><strong>Session:</strong> Encrypted user auth</span>
                    <span><strong>XSRF-TOKEN:</strong> Request protection</span>
                    <span><strong>Duration:</strong> 120 minutes or session length</span>
                </div>
            </div>

            <!-- 2. Analytics & Performance -->
            <div class="rounded-[var(--radius-md)] bg-[var(--bg-surface)] border border-[var(--border-default)] p-6 space-y-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <span class="flex h-6 w-6 items-center justify-center rounded-full bg-[var(--bg-subtle)] text-[11px] font-bold text-[var(--text-secondary)]">2</span>
                        <h2 class="font-heading text-base font-bold text-[var(--text-primary)]">Analytics &amp; Performance Cookies</h2>
                    </div>
                    <span class="text-[10px] font-semibold px-2 py-0.5 rounded bg-[var(--bg-subtle)] text-[var(--text-muted)] border border-[var(--border-default)]">
                        Optional (Off by default)
                    </span>
                </div>
                <p class="text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed">
                    These cookies help us understand how visitors move through pages and find areas where the site feels slow or confusing. All data is aggregated and anonymized. These scripts are blocked until you choose to opt in.
                </p>
                <div class="text-[11px] text-[var(--text-muted)] pt-1 flex flex-wrap gap-4">
                    <span><strong>Storage:</strong> Aggregated page views</span>
                    <span><strong>Consent:</strong> Opt-in only</span>
                    <span><strong>Duration:</strong> 12 months</span>
                </div>
            </div>

            <!-- 3. Marketing & Attribution -->
            <div class="rounded-[var(--radius-md)] bg-[var(--bg-surface)] border border-[var(--border-default)] p-6 space-y-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <span class="flex h-6 w-6 items-center justify-center rounded-full bg-[var(--bg-subtle)] text-[11px] font-bold text-[var(--text-secondary)]">3</span>
                        <h2 class="font-heading text-base font-bold text-[var(--text-primary)]">Marketing &amp; Attribution Cookies</h2>
                    </div>
                    <span class="text-[10px] font-semibold px-2 py-0.5 rounded bg-[var(--bg-subtle)] text-[var(--text-muted)] border border-[var(--border-default)]">
                        Optional (Off by default)
                    </span>
                </div>
                <p class="text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed">
                    We never sell personal data or track you across the web. These cookies measure community partner links and direct inquiries. They remain disabled unless explicitly permitted.
                </p>
                <div class="text-[11px] text-[var(--text-muted)] pt-1 flex flex-wrap gap-4">
                    <span><strong>Ad networks:</strong> None</span>
                    <span><strong>Data sharing:</strong> None</span>
                    <span><strong>Duration:</strong> 12 months</span>
                </div>
            </div>

        </div>

        <!-- Managing Choices & GDPR Rights -->
        <div class="rounded-[var(--radius-md)] bg-[var(--bg-subtle)] border border-[var(--border-default)] p-6 space-y-3">
            <h2 class="font-heading text-base font-bold text-[var(--text-primary)]">
                Managing your preferences
            </h2>
            <p class="text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed">
                You can change or withdraw your consent at any time. When browsing as a visitor, click the <strong>Cookie settings</strong> button in the footer. When logged into your account, access your privacy toggles under <strong>Settings &rarr; Privacy</strong>. Choices are stored locally for 12 months.
            </p>
        </div>

    </div>
</div>
@endsection


