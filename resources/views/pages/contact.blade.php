@extends('layouts.app')

@section('title', 'Contact & Safety — Global Maitri')
@section('meta_description', 'Contact Global Maitri for account support, privacy requests, safety concerns, verification questions, and mindful matrimonial platform assistance.')
@section('canonical_url', route('contact'))
@section('robots', 'index, follow')

@section('content')
<div class="min-h-screen bg-[var(--bg-canvas)] py-12 text-[var(--text-primary)] transition-colors sm:py-16">
    <div class="mx-auto max-w-5xl space-y-12 px-4 sm:px-6 lg:px-8">

        <!-- Editorial Asymmetric Hero -->
        <div class="card-monograph p-8 sm:p-12 space-y-4">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-[3px] text-xs font-mono uppercase tracking-wider text-[var(--saffron-gold)] bg-[var(--saffron-gold)]/10 border border-[var(--saffron-gold)]/25">
                <span class="w-1.5 h-1.5 rounded-full bg-[var(--saffron-gold)]"></span>
                Contact &amp; Community Care
            </span>
            <h1 class="font-serif text-2xl sm:text-4xl font-bold tracking-tight text-[var(--text-primary)] max-w-3xl leading-snug">
                We are here to support your matrimonial journey with care and quiet attention.
            </h1>
            <p class="max-w-2xl text-xs sm:text-sm leading-relaxed text-[var(--text-secondary)]">
                Whether you need help with your biodata, have a question about photo privacy or horoscope matching, or want to report a concern about dowry or harassment, our team responds directly and with respect.
            </p>
        </div>

        <!-- 3 Contact Channels -->
        <section class="grid gap-6 md:grid-cols-3" aria-label="Contact options">
            <a href="mailto:support@globalmaitri.com" class="card-monograph p-6 space-y-3 block group">
                <div class="w-10 h-10 rounded-[3px] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-[var(--saffron-gold)] flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h2 class="font-serif text-base font-bold text-[var(--text-primary)]">General Support</h2>
                <p class="text-xs leading-relaxed text-[var(--text-secondary)]">Questions about account creation, biodata completion, one-time passes, or platform guidance.</p>
                <span class="inline-block text-xs font-mono text-[var(--saffron-gold)] group-hover:underline pt-2">support@globalmaitri.com &rarr;</span>
            </a>

            <a href="mailto:privacy@globalmaitri.com" class="card-monograph p-6 space-y-3 block group">
                <div class="w-10 h-10 rounded-[3px] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-[var(--lotus-pink)] flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v4a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <h2 class="font-serif text-base font-bold text-[var(--text-primary)]">Privacy Requests</h2>
                <p class="text-xs leading-relaxed text-[var(--text-secondary)]">Inquiries regarding photo shielding, data export, or updating family representative visibility.</p>
                <span class="inline-block text-xs font-mono text-[var(--lotus-pink)] group-hover:underline pt-2">privacy@globalmaitri.com &rarr;</span>
            </a>

            <a href="mailto:safety@globalmaitri.com" class="card-monograph p-6 space-y-3 block group">
                <div class="w-10 h-10 rounded-[3px] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-[var(--color-danger)] flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h2 class="font-serif text-base font-bold text-[var(--text-primary)]">Safety &amp; Dowry Reports</h2>
                <p class="text-xs leading-relaxed text-[var(--text-secondary)]">Strictly report dowry demands, caste discrimination, misrepresentation, or unwanted pressure.</p>
                <span class="inline-block text-xs font-mono text-[var(--color-danger)] group-hover:underline pt-2">safety@globalmaitri.com &rarr;</span>
            </a>
        </section>

        <!-- Direct Safety Controls & Response Guarantee -->
        <section class="grid gap-6 lg:grid-cols-[1.2fr_.8fr]">
            <div class="card-monograph p-6 sm:p-8 space-y-4">
                <span class="text-[11px] font-mono uppercase tracking-wider text-[var(--saffron-gold)]">Immediate Controls</span>
                <h2 class="font-serif text-lg sm:text-xl font-bold text-[var(--text-primary)]">You are always in control of your space</h2>
                <div class="space-y-3 text-xs leading-relaxed text-[var(--text-secondary)]">
                    <div class="flex items-start gap-2.5">
                        <span class="text-[var(--saffron-gold)] font-bold shrink-0 mt-0.5">&bull;</span>
                        <p><strong class="text-[var(--text-primary)]">Block a profile:</strong> Immediately prevents a candidate from viewing your biodata or messaging you.</p>
                    </div>
                    <div class="flex items-start gap-2.5">
                        <span class="text-[var(--saffron-gold)] font-bold shrink-0 mt-0.5">&bull;</span>
                        <p><strong class="text-[var(--text-primary)]">Strict Anti-Dowry Policy:</strong> We uphold the Buddhist principle of equal dignity. Demands for dowry lead to immediate account suspension.</p>
                    </div>
                    <div class="flex items-start gap-2.5">
                        <span class="text-[var(--saffron-gold)] font-bold shrink-0 mt-0.5">&bull;</span>
                        <p><strong class="text-[var(--text-primary)]">Lotus Photo Privacy:</strong> You decide who sees your photos and when. Toggle it anytime from settings.</p>
                    </div>
                </div>
                <p class="border-t border-[var(--border-default)] pt-4 text-[11px] text-[var(--text-muted)]">For acute or emergency safety concerns, please contact local emergency authorities in your jurisdiction immediately.</p>
            </div>

            <div class="card-monograph p-6 sm:p-8 space-y-4 bg-gradient-to-b from-[var(--bg-card)] to-[var(--bg-subtle)] flex flex-col justify-between">
                <div>
                    <span class="text-[11px] font-mono uppercase tracking-wider text-[var(--text-muted)]">Response Standard</span>
                    <h2 class="font-serif text-lg font-bold text-[var(--text-primary)] mt-1">Thoughtful, Human Replies</h2>
                    <p class="text-xs leading-relaxed text-[var(--text-secondary)] mt-2">
                        We do not use automated bots to resolve support requests. A member of our community care team reads every message and responds within one business day.
                    </p>
                </div>
                <div class="p-3.5 rounded-[3px] bg-[var(--bg-canvas)] border border-[var(--border-default)] text-xs text-[var(--text-secondary)]">
                    Please mention your registered account email and avoid sharing passwords or payment numbers over email.
                </div>
            </div>
        </section>

    </div>
</div>
@endsection
