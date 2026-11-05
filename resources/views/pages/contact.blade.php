@extends('layouts.app')

@section('title', 'Contact & Safety - Global Maitri')
@section('meta_description', 'Contact Global Maitri for account support, privacy requests, safety concerns, verification questions, and mindful matrimonial platform assistance.')
@section('canonical_url', route('contact'))
@section('robots', 'index, follow')

@section('content')
<div class="min-h-screen bg-[var(--bg-canvas)] py-10 text-[var(--text-primary)] transition-colors sm:py-16">
    <div class="mx-auto max-w-6xl space-y-10 px-4 sm:px-6 lg:px-8">
        <section class="relative overflow-hidden rounded-[4px] bg-[#141412] px-6 py-12 text-[#f4f2ee] shadow-xl border border-[#2d2b27] sm:px-12 sm:py-16">
            <div class="absolute -right-20 -top-24 h-72 w-72 rounded-full bg-[var(--accent-primary)]/10 blur-3xl"></div>
            <div class="absolute -bottom-32 -left-20 h-72 w-72 rounded-full bg-[var(--accent-primary)]/10 blur-3xl"></div>
            <div class="relative max-w-3xl space-y-5">
                <span class="inline-flex items-center gap-2 rounded-[4px] border border-[var(--accent-primary)]/30 bg-[var(--accent-primary)]/10 px-3.5 py-1.5 text-xs font-bold uppercase tracking-wider text-[#e0b84c]">
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="9"/>
                        <circle cx="12" cy="12" r="3"/>
                        <path d="M12 3v6m0 6v6M3 12h6m6 0h6"/>
                    </svg>
                    Contact &amp; Safety Center
                </span>
                <h1 class="font-heading text-3xl font-extrabold tracking-tight sm:text-5xl text-white">We are here to support your mindful matrimonial journey.</h1>
                <p class="max-w-2xl text-sm leading-7 text-[#d6d2c8] sm:text-base">
                    Whether you need help with your biodata, have a privacy or Porondam question, or want to report dowry demands or safety concerns, our team is ready to respond with promptness and care.
                </p>
            </div>
        </section>

        <section class="grid gap-5 md:grid-cols-3" aria-label="Contact options">
            <a href="mailto:support@globalmaitri.com" class="group card-ledger p-6 transition hover:-translate-y-0.5">
                <span class="flex h-12 w-12 items-center justify-center rounded-[4px] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)]">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </span>
                <h2 class="mt-5 font-heading text-lg font-extrabold text-[var(--text-primary)]">General Support</h2>
                <p class="mt-2 text-sm leading-6 text-[var(--text-secondary)]">Questions about registration, biodata completion, subscriptions, or platform features.</p>
                <span class="mt-5 inline-block text-xs font-bold text-[var(--accent-primary)] group-hover:underline">support@globalmaitri.com</span>
            </a>

            <a href="mailto:privacy@globalmaitri.com" class="group card-ledger p-6 transition hover:-translate-y-0.5">
                <span class="flex h-12 w-12 items-center justify-center rounded-[4px] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)]">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v4a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </span>
                <h2 class="mt-5 font-heading text-lg font-extrabold text-[var(--text-primary)]">Privacy Requests</h2>
                <p class="mt-2 text-sm leading-6 text-[var(--text-secondary)]">Request data access, correction, deletion, or assistance with Lotus photo shield settings.</p>
                <span class="mt-5 inline-block text-xs font-bold text-[var(--accent-primary)] group-hover:underline">privacy@globalmaitri.com</span>
            </a>

            <a href="mailto:safety@globalmaitri.com" class="group card-ledger p-6 transition hover:-translate-y-0.5">
                <span class="flex h-12 w-12 items-center justify-center rounded-[4px] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)]">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </span>
                <h2 class="mt-5 font-heading text-lg font-extrabold text-[var(--text-primary)]">Safety &amp; Dowry Reports</h2>
                <p class="mt-2 text-sm leading-6 text-[var(--text-secondary)]">Report dowry demands, caste discrimination, impersonation, or harassment.</p>
                <span class="mt-5 inline-block text-xs font-bold text-[var(--accent-primary)] group-hover:underline">safety@globalmaitri.com</span>
            </a>
        </section>

        <section class="grid gap-6 lg:grid-cols-[1.15fr_.85fr]">
            <div class="card-ledger p-7 sm:p-9">
                <p class="text-xs font-bold uppercase tracking-[0.18em] text-[var(--accent-primary)]">Before you contact us</p>
                <h2 class="mt-3 font-heading text-2xl font-extrabold text-[var(--text-primary)]">Use your direct safety controls</h2>
                <div class="mt-6 space-y-4 text-sm leading-6 text-[var(--text-secondary)]">
                    <div class="flex gap-3"><span class="mt-0.5 text-[var(--accent-primary)] font-bold">&check;</span><p><strong class="text-[var(--text-primary)]">Block</strong> a profile immediately to stop any further interaction.</p></div>
                    <div class="flex gap-3"><span class="mt-0.5 text-[var(--accent-primary)] font-bold">&check;</span><p><strong class="text-[var(--text-primary)]">Report</strong> harassment, dowry demands, caste bias, or off-platform contact leaks.</p></div>
                    <div class="flex gap-3"><span class="mt-0.5 text-[var(--accent-primary)] font-bold">&check;</span><p><strong class="text-[var(--text-primary)]">Lotus Modesty Shield</strong> can be toggled to blur photos at any time from your settings.</p></div>
                </div>
                <p class="mt-7 border-t border-[var(--border-default)] pt-5 text-xs leading-5 text-[var(--text-muted)]">For emergency safety concerns, please contact your local law enforcement immediately.</p>
            </div>

            <div class="card-ledger p-7 bg-[var(--bg-subtle)] sm:p-9">
                <div class="w-10 h-10 rounded-[4px] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] flex items-center justify-center">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="9"/>
                        <circle cx="12" cy="12" r="3"/>
                        <path d="M12 3v6m0 6v6M3 12h6m6 0h6"/>
                    </svg>
                </div>
                <h2 class="mt-4 font-heading text-2xl font-extrabold text-[var(--text-primary)]">Prompt Mindful Response</h2>
                <p class="mt-3 text-sm leading-6 text-[var(--text-secondary)]">Please provide your account email, a clear description, and any relevant profile or conversation identifiers. Never send passwords or payment information via email.</p>
                <div class="mt-6 rounded-[4px] border border-[var(--border-default)] bg-[var(--bg-surface)] p-4 text-xs font-semibold leading-5 text-[var(--text-primary)]">We aim to review and respond to all support and safety tickets within one business day.</div>
            </div>
        </section>
    </div>
</div>
@endsection
