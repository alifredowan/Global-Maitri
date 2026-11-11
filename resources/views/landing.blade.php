@extends('layouts.app')

@section('title', 'Global Maitri — Buddhist Matrimonial Platform | Kindness first. Companionship for life.')
@section('meta_description', 'A calm Buddhist matrimonial space for serious marriage, with verified identities, family representative support, photo privacy controls, and shared Dhamma values.')
@section('canonical_url', route('landing'))
@section('robots', 'index, follow')

@section('content')
<div class="space-y-12 sm:space-y-16 pt-4 pb-0">

    <!-- ================================================================= -->
    <!-- 1. HERO SECTION: BOLD HEADLINE, SCANNABLE ACTIONS, PROFILE CARDS  -->
    <!-- ================================================================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative rounded-[var(--radius-lg)] bg-[var(--bg-surface)] border border-[var(--border-default)] p-6 sm:p-10 lg:p-12 shadow-xs overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">

                <!-- Left Column: Core Headline, Microcopy, Primary CTA -->
                <div class="lg:col-span-7 space-y-5 text-left">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-[var(--radius-xs)] bg-[var(--accent-subtle)] border border-[var(--border-default)] text-[var(--accent-text)] text-xs font-semibold">
                        <span class="inline-block w-1.5 h-1.5 rounded-full bg-[var(--accent-primary)]"></span>
                        <span>For Buddhist families &amp; seekers</span>
                    </div>

                    <h1 class="font-heading text-2xl sm:text-3xl lg:text-[2.5rem] font-bold text-[var(--text-primary)] tracking-tight leading-[1.2]">
                        A quiet place to find your Buddhist partner.
                    </h1>

                    <p class="text-sm sm:text-base text-[var(--text-secondary)] leading-relaxed max-w-xl">
                        Thoughtful matchmaking with verified profiles, family blessings, and mutual photo privacy.
                    </p>

                    <!-- Hero Actions (48px high, clear hierarchy) -->
                    <div class="pt-2 flex flex-wrap items-center gap-3">
                        <a href="{{ route('register') }}"
                           class="btn-primary min-h-[48px] px-7 inline-flex items-center justify-center font-semibold text-sm rounded-[var(--radius-sm)] shadow-xs transition active:scale-[0.98]">
                            Create free profile
                        </a>
                        <a href="#how-it-works"
                           class="btn-secondary min-h-[48px] px-6 inline-flex items-center justify-center font-semibold text-sm rounded-[var(--radius-sm)] transition active:scale-[0.98]">
                            How it works
                        </a>
                    </div>

                    <!-- Trust Chips & Real Community Numbers -->
                    <div class="pt-3 border-t border-[var(--border-subtle)] flex flex-wrap items-center gap-4 text-xs text-[var(--text-secondary)]">
                        <div class="flex items-center gap-1.5 font-medium">
                            <svg class="w-4 h-4 text-[var(--color-accent)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                            <span>Verified profiles</span>
                        </div>
                        <div class="flex items-center gap-1.5 font-medium">
                            <svg class="w-4 h-4 text-[var(--color-accent)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path stroke-linecap="round" stroke-linejoin="round" d="M22 21v-2a4 4 0 00-3-3.87"/><path stroke-linecap="round" stroke-linejoin="round" d="M16 3.13a4 4 0 010 7.75"/></svg>
                            <span>Family approval</span>
                        </div>
                        <div class="flex items-center gap-1.5 font-medium">
                            <svg class="w-4 h-4 text-[var(--color-accent)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path stroke-linecap="round" stroke-linejoin="round" d="M7 11V7a5 5 0 0110 0v4"/></svg>
                            <span>Photos stay private</span>
                        </div>
                    </div>

                    <p class="text-[11px] text-[var(--text-muted)] italic">
                        {{ $stats['verified_profiles'] }} verified candidates &bull; Family members can join free.
                    </p>
                </div>

                <!-- Right Column: Visual Composition of Sample Profile Cards -->
                <div class="lg:col-span-5 relative">
                    <div class="relative space-y-3">

                        <!-- Main Sample Card -->
                        <div class="rounded-[var(--radius-md)] bg-[var(--color-surface)] border border-[var(--color-border)] p-4 shadow-sm hover:-translate-y-0.5 transition duration-200">
                            <div class="flex items-center gap-3">
                                <div class="relative w-14 h-14 rounded-full bg-[var(--color-primary-soft)] border border-[var(--color-border)] flex items-center justify-center overflow-hidden shrink-0">
                                    <span class="font-heading font-bold text-sm text-[var(--color-primary)]">DP</span>
                                    <div class="absolute inset-0 backdrop-blur-[2px] bg-black/10 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path stroke-linecap="round" stroke-linejoin="round" d="M7 11V7a5 5 0 0110 0v4"/></svg>
                                    </div>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div class="flex items-center gap-2">
                                        <h3 class="font-heading font-bold text-sm text-[var(--text-primary)]">Dilini, 28</h3>
                                        <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-semibold bg-[var(--color-primary-soft)] text-[var(--color-primary)] border border-[var(--color-primary)]/20">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                            Verified
                                        </span>
                                    </div>
                                    <p class="text-xs text-[var(--text-secondary)] truncate">Theravada &bull; Colombo &bull; Architect</p>
                                    <div class="flex items-center gap-1.5 mt-1 text-[11px] text-[var(--color-primary)] font-medium">
                                        <span class="inline-block w-2.5 h-2.5 rounded-full bg-gradient-to-r from-[var(--color-primary)] to-[var(--color-accent)]"></span>
                                        <span>94% Dhamma compatibility</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Secondary Sample Card -->
                        <div class="rounded-[var(--radius-md)] bg-[var(--color-surface)] border border-[var(--color-border)] p-4 shadow-sm hover:-translate-y-0.5 transition duration-200 ml-4 sm:ml-6">
                            <div class="flex items-center gap-3">
                                <div class="relative w-14 h-14 rounded-full bg-[var(--color-primary-soft)] border border-[var(--color-border)] flex items-center justify-center overflow-hidden shrink-0">
                                    <span class="font-heading font-bold text-sm text-[var(--color-primary)]">AK</span>
                                    <div class="absolute inset-0 backdrop-blur-[2px] bg-black/10 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path stroke-linecap="round" stroke-linejoin="round" d="M7 11V7a5 5 0 0110 0v4"/></svg>
                                    </div>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div class="flex items-center gap-2">
                                        <h3 class="font-heading font-bold text-sm text-[var(--text-primary)]">Aung, 31</h3>
                                        <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-semibold bg-[var(--color-primary-soft)] text-[var(--color-primary)] border border-[var(--color-primary)]/20">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                            Verified
                                        </span>
                                    </div>
                                    <p class="text-xs text-[var(--text-secondary)] truncate">Theravada &bull; Yangon &bull; Software Engineer</p>
                                    <div class="flex items-center gap-1.5 mt-1 text-[11px] text-[var(--color-primary)] font-medium">
                                        <span class="inline-block w-2.5 h-2.5 rounded-full bg-gradient-to-r from-[var(--color-primary)] to-[var(--color-accent)]"></span>
                                        <span>91% Dhamma compatibility</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ================================================================= -->
    <!-- 2. VALUES & ETHOS: EDITORIAL TILES (NO WALL OF TEXT)              -->
    <!-- ================================================================= -->
    <section class="border-y border-[var(--border-default)] bg-[var(--bg-subtle)] py-10 sm:py-14">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <div class="max-w-2xl text-left space-y-1">
                <p class="text-xs font-semibold uppercase tracking-wider text-[var(--accent-primary)]">Metta &bull; Loving-kindness</p>
                <h2 class="font-heading text-2xl sm:text-3xl font-bold text-[var(--text-primary)]">
                    Companionship rooted in kindness.
                </h2>
                <p class="text-xs sm:text-sm text-[var(--text-secondary)]">
                    A householder union guided by patience, mutual respect, and family blessings.
                </p>
            </div>

            <!-- 4 Tactile Feature Tiles (Monoline Icons + 3-4 Word Labels) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="rounded-[var(--radius-md)] bg-[var(--bg-surface)] border border-[var(--border-default)] p-5 space-y-2 hover:-translate-y-0.5 transition duration-200">
                    <div class="w-8 h-8 rounded-[var(--radius-xs)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                    </div>
                    <h3 class="font-heading font-semibold text-sm text-[var(--text-primary)]">Verified seekers only</h3>
                    <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                        Every profile requires genuine identity verification.
                    </p>
                </div>

                <div class="rounded-[var(--radius-md)] bg-[var(--bg-surface)] border border-[var(--border-default)] p-5 space-y-2 hover:-translate-y-0.5 transition duration-200">
                    <div class="w-8 h-8 rounded-[var(--radius-xs)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path stroke-linecap="round" stroke-linejoin="round" d="M7 11V7a5 5 0 0110 0v4"/></svg>
                    </div>
                    <h3 class="font-heading font-semibold text-sm text-[var(--text-primary)]">Protected photos</h3>
                    <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                        Photos stay private until you both agree to connect.
                    </p>
                </div>

                <div class="rounded-[var(--radius-md)] bg-[var(--bg-surface)] border border-[var(--border-default)] p-5 space-y-2 hover:-translate-y-0.5 transition duration-200">
                    <div class="w-8 h-8 rounded-[var(--radius-xs)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path stroke-linecap="round" stroke-linejoin="round" d="M22 21v-2a4 4 0 00-3-3.87"/><path stroke-linecap="round" stroke-linejoin="round" d="M16 3.13a4 4 0 010 7.75"/></svg>
                    </div>
                    <h3 class="font-heading font-semibold text-sm text-[var(--text-primary)]">Family representative support</h3>
                    <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                        Parents and trusted elders join free to advise.
                    </p>
                </div>

                <div class="rounded-[var(--radius-md)] bg-[var(--bg-surface)] border border-[var(--border-default)] p-5 space-y-2 hover:-translate-y-0.5 transition duration-200">
                    <div class="w-8 h-8 rounded-[var(--radius-xs)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <h3 class="font-heading font-semibold text-sm text-[var(--text-primary)]">Anti-dowry commitment</h3>
                    <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                        Strict policy upholding mutual dignity and equality.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ================================================================= -->
    <!-- 3. HOW IT WORKS: A GENTLY FLOWING HORIZONTAL PATH (7 STEPS)       -->
    <!-- ================================================================= -->
    <section id="how-it-works" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6 sm:space-y-8">
        <div class="max-w-2xl text-left space-y-1">
            <p class="text-xs font-semibold uppercase tracking-wider text-[var(--accent-primary)]">The steps</p>
            <h2 class="font-heading text-2xl sm:text-3xl font-bold text-[var(--text-primary)]">
                A calm path to marriage.
            </h2>
            <p class="text-xs sm:text-sm text-[var(--text-secondary)]">
                Every step gives you and your family clarity without pressure.
            </p>
        </div>

        <!-- Horizontal Flowing Path: 7 Columns Across Desktop, Responsive Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-3 sm:gap-3.5">

            <!-- Step 1: Profile -->
            <div class="rounded-[var(--radius-md)] bg-[var(--bg-surface)] border border-[var(--border-default)] p-4 flex flex-col justify-between hover:-translate-y-1 hover:border-[var(--accent-primary)] hover:shadow-xs transition duration-200 group">
                <div>
                    <div class="flex items-center justify-between mb-2.5">
                        <span class="flex h-7 w-7 items-center justify-center rounded-full bg-[var(--accent-subtle)] border border-[var(--border-default)] text-xs font-bold text-[var(--accent-primary)] group-hover:scale-105 transition">
                            1
                        </span>
                        <span class="text-[10px] font-semibold text-[var(--text-muted)] uppercase tracking-wider">01</span>
                    </div>
                    <h3 class="font-heading font-bold text-sm text-[var(--text-primary)] leading-tight">Profile</h3>
                    <p class="text-[11px] text-[var(--text-secondary)] mt-1.5 leading-relaxed">Complete biodata and private photos.</p>
                </div>
            </div>

            <!-- Step 2: Practice -->
            <div class="rounded-[var(--radius-md)] bg-[var(--bg-surface)] border border-[var(--border-default)] p-4 flex flex-col justify-between hover:-translate-y-1 hover:border-[var(--accent-primary)] hover:shadow-xs transition duration-200 group">
                <div>
                    <div class="flex items-center justify-between mb-2.5">
                        <span class="flex h-7 w-7 items-center justify-center rounded-full bg-[var(--accent-subtle)] border border-[var(--border-default)] text-xs font-bold text-[var(--accent-primary)] group-hover:scale-105 transition">
                            2
                        </span>
                        <span class="text-[10px] font-semibold text-[var(--text-muted)] uppercase tracking-wider">02</span>
                    </div>
                    <h3 class="font-heading font-bold text-sm text-[var(--text-primary)] leading-tight">Practice</h3>
                    <p class="text-[11px] text-[var(--text-secondary)] mt-1.5 leading-relaxed">Share tradition and meditation rhythm.</p>
                </div>
            </div>

            <!-- Step 3: Discover -->
            <div class="rounded-[var(--radius-md)] bg-[var(--bg-surface)] border border-[var(--border-default)] p-4 flex flex-col justify-between hover:-translate-y-1 hover:border-[var(--accent-primary)] hover:shadow-xs transition duration-200 group">
                <div>
                    <div class="flex items-center justify-between mb-2.5">
                        <span class="flex h-7 w-7 items-center justify-center rounded-full bg-[var(--accent-subtle)] border border-[var(--border-default)] text-xs font-bold text-[var(--accent-primary)] group-hover:scale-105 transition">
                            3
                        </span>
                        <span class="text-[10px] font-semibold text-[var(--text-muted)] uppercase tracking-wider">03</span>
                    </div>
                    <h3 class="font-heading font-bold text-sm text-[var(--text-primary)] leading-tight">Discover</h3>
                    <p class="text-[11px] text-[var(--text-secondary)] mt-1.5 leading-relaxed">Filter verified candidates worldwide.</p>
                </div>
            </div>

            <!-- Step 4: Interest -->
            <div class="rounded-[var(--radius-md)] bg-[var(--bg-surface)] border border-[var(--border-default)] p-4 flex flex-col justify-between hover:-translate-y-1 hover:border-[var(--accent-primary)] hover:shadow-xs transition duration-200 group">
                <div>
                    <div class="flex items-center justify-between mb-2.5">
                        <span class="flex h-7 w-7 items-center justify-center rounded-full bg-[var(--accent-subtle)] border border-[var(--border-default)] text-xs font-bold text-[var(--accent-primary)] group-hover:scale-105 transition">
                            4
                        </span>
                        <span class="text-[10px] font-semibold text-[var(--text-muted)] uppercase tracking-wider">04</span>
                    </div>
                    <h3 class="font-heading font-bold text-sm text-[var(--text-primary)] leading-tight">Interest</h3>
                    <p class="text-[11px] text-[var(--text-secondary)] mt-1.5 leading-relaxed">Send quiet connection requests.</p>
                </div>
            </div>

            <!-- Step 5: Family approval -->
            <div class="rounded-[var(--radius-md)] bg-[var(--bg-surface)] border border-[var(--border-default)] p-4 flex flex-col justify-between hover:-translate-y-1 hover:border-[var(--accent-primary)] hover:shadow-xs transition duration-200 group">
                <div>
                    <div class="flex items-center justify-between mb-2.5">
                        <span class="flex h-7 w-7 items-center justify-center rounded-full bg-[var(--accent-subtle)] border border-[var(--border-default)] text-xs font-bold text-[var(--accent-primary)] group-hover:scale-105 transition">
                            5
                        </span>
                        <span class="text-[10px] font-semibold text-[var(--text-muted)] uppercase tracking-wider">05</span>
                    </div>
                    <h3 class="font-heading font-bold text-sm text-[var(--text-primary)] leading-tight">Family approval</h3>
                    <p class="text-[11px] text-[var(--text-secondary)] mt-1.5 leading-relaxed">Parents review suitors first.</p>
                </div>
            </div>

            <!-- Step 6: Chat -->
            <div class="rounded-[var(--radius-md)] bg-[var(--bg-surface)] border border-[var(--border-default)] p-4 flex flex-col justify-between hover:-translate-y-1 hover:border-[var(--accent-primary)] hover:shadow-xs transition duration-200 group">
                <div>
                    <div class="flex items-center justify-between mb-2.5">
                        <span class="flex h-7 w-7 items-center justify-center rounded-full bg-[var(--accent-subtle)] border border-[var(--border-default)] text-xs font-bold text-[var(--accent-primary)] group-hover:scale-105 transition">
                            6
                        </span>
                        <span class="text-[10px] font-semibold text-[var(--text-muted)] uppercase tracking-wider">06</span>
                    </div>
                    <h3 class="font-heading font-bold text-sm text-[var(--text-primary)] leading-tight">Chat</h3>
                    <p class="text-[11px] text-[var(--text-secondary)] mt-1.5 leading-relaxed">Chaperoned or direct messages.</p>
                </div>
            </div>

            <!-- Step 7: Wedding -->
            <div class="rounded-[var(--radius-md)] bg-[var(--color-surface)] border-2 border-[var(--color-accent)] p-4 flex flex-col justify-between hover:-translate-y-1 hover:border-[var(--color-accent)] hover:shadow-xs transition duration-200 group bg-[var(--color-accent-soft)]">
                <div>
                    <div class="flex items-center justify-between mb-2.5">
                        <span class="flex h-7 w-7 items-center justify-center rounded-full bg-[var(--color-accent)] text-[var(--color-ink-dark)] text-xs font-bold shadow-2xs group-hover:scale-105 transition">
                            7
                        </span>
                        <span class="text-[10px] font-bold text-[var(--color-accent)] uppercase tracking-wider">Milestone</span>
                    </div>
                    <h3 class="font-heading font-bold text-sm text-[var(--text-primary)] leading-tight flex items-center gap-1.5">
                        <span>Wedding</span>
                    </h3>
                    <p class="text-[11px] text-[var(--text-secondary)] mt-1.5 leading-relaxed">Mangala Vivaha milestone blessing.</p>
                </div>
            </div>

        </div>
    </section>

    <!-- ================================================================= -->
    <!-- 4. FEATURES AS VISUALS: MOCK PRODUCT SCREENS (1 LINE EACH)        -->
    <!-- ================================================================= -->
    <section class="border-y border-[var(--color-border)] bg-[var(--color-lotus-soft)] py-10 sm:py-14"
             x-data="{ activeFeature: 'profile' }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <div class="max-w-2xl text-left space-y-1">
                <p class="text-xs font-semibold uppercase tracking-wider text-[var(--color-primary)]">Core features</p>
                <h2 class="font-heading text-2xl sm:text-3xl font-bold text-[var(--text-primary)]">
                    Designed with your family in mind.
                </h2>
                <p class="text-xs sm:text-sm text-[var(--text-secondary)]">
                    Thoughtful tools built for privacy, family respect, and genuine conversations.
                </p>
            </div>

            <!-- Tab Buttons -->
            <div class="flex flex-wrap gap-2 border-b border-[var(--border-default)] pb-3">
                <button type="button"
                        @click="activeFeature = 'profile'"
                        :class="activeFeature === 'profile' ? 'bg-[var(--color-primary)] text-white shadow-2xs' : 'bg-[var(--color-surface)] text-[var(--text-secondary)] border border-[var(--border-default)] hover:bg-[var(--color-surface-alt)]'"
                        class="px-4 py-2 rounded-[var(--radius-xs)] text-xs font-semibold transition cursor-pointer">
                    Profile privacy
                </button>
                <button type="button"
                        @click="activeFeature = 'family'"
                        :class="activeFeature === 'family' ? 'bg-[var(--color-primary)] text-white shadow-2xs' : 'bg-[var(--color-surface)] text-[var(--text-secondary)] border border-[var(--border-default)] hover:bg-[var(--color-surface-alt)]'"
                        class="px-4 py-2 rounded-[var(--radius-xs)] text-xs font-semibold transition cursor-pointer">
                    Family dashboard
                </button>
                <button type="button"
                        @click="activeFeature = 'chat'"
                        :class="activeFeature === 'chat' ? 'bg-[var(--color-primary)] text-white shadow-2xs' : 'bg-[var(--color-surface)] text-[var(--text-secondary)] border border-[var(--border-default)] hover:bg-[var(--color-surface-alt)]'"
                        class="px-4 py-2 rounded-[var(--radius-xs)] text-xs font-semibold transition cursor-pointer">
                    Chaperoned chat
                </button>
            </div>

            <!-- Feature Card 1: Profile Privacy -->
            <div x-show="activeFeature === 'profile'"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-1"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="rounded-[var(--radius-md)] bg-[var(--bg-surface)] border border-[var(--border-default)] p-6 space-y-4">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="space-y-1">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--accent-primary)]">Mock profile screen</span>
                        <h3 class="font-heading text-lg font-bold text-[var(--text-primary)]">Soft Photo Veil</h3>
                        <p class="text-xs text-[var(--text-secondary)]">Photos stay private until both sides agree.</p>
                    </div>
                    <span class="px-2.5 py-1 rounded-[var(--radius-xs)] text-xs font-semibold bg-[var(--accent-subtle)] text-[var(--accent-primary)] border border-[var(--border-default)]">
                        Mutual Consent Only
                    </span>
                </div>
                <div class="rounded border border-[var(--border-subtle)] bg-[var(--bg-subtle)] p-4 flex items-center justify-between text-xs text-[var(--text-secondary)]">
                    <span>Photo visibility: <strong>Protected</strong></span>
                    <span>Tradition: <strong>Theravada</strong></span>
                    <span>Match: <strong>94% Dhamma score</strong></span>
                </div>
            </div>

            <!-- Feature Card 2: Family Dashboard -->
            <div x-show="activeFeature === 'family'"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-1"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="rounded-[var(--radius-md)] bg-[var(--bg-surface)] border border-[var(--border-default)] p-6 space-y-4">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="space-y-1">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--accent-primary)]">Family representative view</span>
                        <h3 class="font-heading text-lg font-bold text-[var(--text-primary)]">Parental Review Space</h3>
                        <p class="text-xs text-[var(--text-secondary)]">Parents and elders review suitors on their own free dashboard.</p>
                    </div>
                    <span class="px-2.5 py-1 rounded-[var(--radius-xs)] text-xs font-semibold bg-[var(--color-primary-soft)] text-[var(--color-primary)] border border-[var(--color-primary)]/20">
                        Free Family Account
                    </span>
                </div>
                <div class="rounded border border-[var(--border-subtle)] bg-[var(--bg-subtle)] p-4 flex items-center justify-between text-xs text-[var(--text-secondary)]">
                    <span>Linked seeker: <strong>Dilini</strong></span>
                    <span>Proposals awaiting review: <strong>1 suitor</strong></span>
                    <span>Action: <strong>Review &amp; Bless</strong></span>
                </div>
            </div>

            <!-- Feature Card 3: Chaperoned Chat -->
            <div x-show="activeFeature === 'chat'"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-1"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="rounded-[var(--radius-md)] bg-[var(--bg-surface)] border border-[var(--border-default)] p-6 space-y-4">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="space-y-1">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--accent-primary)]">Respectful messaging</span>
                        <h3 class="font-heading text-lg font-bold text-[var(--text-primary)]">Contact Info Shield</h3>
                        <p class="text-xs text-[var(--text-secondary)]">Direct conversations open only after mutual consent and family blessing.</p>
                    </div>
                    <span class="px-2.5 py-1 rounded-[var(--radius-xs)] text-xs font-semibold bg-[var(--color-accent-soft)] text-[var(--color-accent)] border border-[var(--color-accent)]/30">
                        Shield Active
                    </span>
                </div>
                <div class="rounded border border-[var(--border-subtle)] bg-[var(--bg-subtle)] p-4 flex items-center justify-between text-xs text-[var(--text-secondary)]">
                    <span>Safety: <strong>Verified phone/email hidden</strong></span>
                    <span>Mode: <strong>Chaperone optional</strong></span>
                    <span>Status: <strong>Active conversation</strong></span>
                </div>
            </div>

        </div>
    </section>

    <!-- ================================================================= -->
    <!-- 5. RECENT CANDIDATES: SCANNABLE PROFILE CARDS                     -->
    <!-- ================================================================= -->
    @if($recentProfiles->isNotEmpty())
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="flex items-center justify-between border-b border-[var(--border-default)] pb-3">
                <div class="space-y-0.5">
                    <h2 class="font-heading text-xl sm:text-2xl font-bold text-[var(--text-primary)]">Verified candidates</h2>
                    <p class="text-xs text-[var(--text-secondary)]">Serious seekers ready for lifelong companionship.</p>
                </div>
                <a href="{{ route('discovery.index') }}" class="text-xs font-semibold text-[var(--accent-primary)] hover:underline">
                    Browse all &rarr;
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach($recentProfiles as $profile)
                    @php
                        $loc = collect([$profile->city, $profile->country])->filter()->implode(', ');
                    @endphp
                    <article class="rounded-[var(--radius-md)] bg-[var(--bg-surface)] border border-[var(--border-default)] overflow-hidden shadow-xs hover:-translate-y-0.5 transition duration-200 flex flex-col justify-between">
                        <div>
                            <!-- Photo with Privacy Veil -->
                            <div class="relative h-48 bg-[var(--bg-subtle)] flex items-center justify-center overflow-hidden border-b border-[var(--border-subtle)]">
                                @if($profile->primaryPhoto)
                                    <img src="{{ $profile->primaryPhoto->displayUrl() }}" alt="{{ $profile->user->name }}" class="w-full h-full object-cover filter blur-[6px] scale-105" loading="lazy">
                                @else
                                    <div class="w-12 h-12 rounded-full bg-[var(--bg-surface)] border border-[var(--border-default)] flex items-center justify-center font-heading text-base font-bold text-[var(--accent-primary)]">
                                        {{ strtoupper(substr($profile->user->name, 0, 1)) }}
                                    </div>
                                @endif
                                <div class="absolute bottom-2 inset-x-2 px-2 py-1 rounded bg-black/60 backdrop-blur-xs text-white text-[10px] flex items-center justify-between">
                                    <span>Private photo</span>
                                    @if($profile->user->is_verified)
                                        <span class="inline-flex items-center gap-0.5 text-[var(--color-primary)] font-semibold"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>Verified</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Details -->
                            <div class="p-4 space-y-1.5">
                                <p class="text-[10px] font-semibold uppercase tracking-wider text-[var(--accent-primary)]">
                                    {{ ucfirst(str_replace('_', ' ', $profile->tradition ?? 'Buddhist')) }}
                                </p>
                                <h3 class="font-heading text-base font-bold text-[var(--text-primary)] truncate">
                                    {{ $profile->user->name }}, {{ $profile->user->age }}
                                </h3>
                                <p class="text-xs text-[var(--text-secondary)] truncate">
                                    {{ $profile->occupation ?: 'Professional' }}{{ $loc ? ' &bull; ' . $loc : '' }}
                                </p>
                                @if($profile->about_me)
                                    <p class="text-xs text-[var(--text-muted)] line-clamp-2 italic pt-1">
                                        &ldquo;{{ Str::limit($profile->about_me, 70) }}&rdquo;
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="p-4 pt-0">
                            <a href="{{ route('discovery.show', $profile->user_id) }}" class="btn-secondary w-full text-center text-xs !py-2 block">
                                View profile &rarr;
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    @endif

    <!-- ================================================================= -->
    <!-- 6. SUCCESS STORIES: REAL VISUAL COUPLE CARDS                      -->
    <!-- ================================================================= -->
    <section id="stories" class="border-y border-[var(--color-border)] bg-[var(--color-accent-soft)] py-10 sm:py-14">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <div class="max-w-2xl text-left space-y-1">
                <p class="text-xs font-semibold uppercase tracking-wider text-[var(--accent-primary)]">Real stories</p>
                <h2 class="font-heading text-2xl sm:text-3xl font-bold text-[var(--text-primary)]">
                    Couples who met with patience.
                </h2>
                <p class="text-xs sm:text-sm text-[var(--text-secondary)]">
                    Real marriages blessed by families across the global Buddhist diaspora.
                </p>
            </div>

            <!-- Couple Cards Grid (Horizontal scroll on mobile) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                <!-- Story 1 -->
                <article class="rounded-[var(--radius-md)] bg-[var(--bg-surface)] border border-[var(--border-default)] p-5 space-y-3 flex flex-col justify-between hover:-translate-y-0.5 transition duration-200">
                    <div class="space-y-2">
                        <div class="flex items-center justify-between border-b border-[var(--border-subtle)] pb-2">
                            <div>
                                <h3 class="font-heading font-bold text-sm text-[var(--text-primary)]">Anoma &amp; Dipankar</h3>
                                <p class="text-[11px] text-[var(--text-muted)]">Chittagong, Bangladesh</p>
                            </div>
                            <span class="text-[10px] font-semibold px-2 py-0.5 rounded bg-[var(--bg-subtle)] text-[var(--text-secondary)] border border-[var(--border-default)]">
                                Married Nov 2024
                            </span>
                        </div>
                        <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                            &ldquo;Our parents spoke first through the family representative dashboard. Global Maitri made our introduction feel unhurried and dignified.&rdquo;
                        </p>
                    </div>
                    <p class="text-[11px] text-[var(--accent-primary)] font-serif-accent italic">
                        Theravada &bull; Barua Buddhist tradition
                    </p>
                </article>

                <!-- Story 2 -->
                <article class="rounded-[var(--radius-md)] bg-[var(--bg-surface)] border border-[var(--border-default)] p-5 space-y-3 flex flex-col justify-between hover:-translate-y-0.5 transition duration-200">
                    <div class="space-y-2">
                        <div class="flex items-center justify-between border-b border-[var(--border-subtle)] pb-2">
                            <div>
                                <h3 class="font-heading font-bold text-sm text-[var(--text-primary)]">Sujata &amp; Piyadasa</h3>
                                <p class="text-[11px] text-[var(--text-muted)]">Colombo &amp; Sydney</p>
                            </div>
                            <span class="text-[10px] font-semibold px-2 py-0.5 rounded bg-[var(--bg-subtle)] text-[var(--text-secondary)] border border-[var(--border-default)]">
                                Married Feb 2025
                            </span>
                        </div>
                        <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                            &ldquo;The family dashboard let Sujata's mother in Kandy stay involved without any awkwardness. We are deeply grateful for this kind space.&rdquo;
                        </p>
                    </div>
                    <p class="text-[11px] text-[var(--accent-primary)] font-serif-accent italic">
                        Theravada &bull; Sinhalese diaspora
                    </p>
                </article>

                <!-- Story 3 -->
                <article class="rounded-[var(--radius-md)] bg-[var(--bg-surface)] border border-[var(--border-default)] p-5 space-y-3 flex flex-col justify-between hover:-translate-y-0.5 transition duration-200">
                    <div class="space-y-2">
                        <div class="flex items-center justify-between border-b border-[var(--border-subtle)] pb-2">
                            <div>
                                <h3 class="font-heading font-bold text-sm text-[var(--text-primary)]">Thida &amp; Kyaw</h3>
                                <p class="text-[11px] text-[var(--text-muted)]">Yangon &amp; Bangkok</p>
                            </div>
                            <span class="text-[10px] font-semibold px-2 py-0.5 rounded bg-[var(--bg-subtle)] text-[var(--text-secondary)] border border-[var(--border-default)]">
                                Married Oct 2024
                            </span>
                        </div>
                        <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                            &ldquo;Our photos remained private until we had spoken for several weeks. May all seekers find such companionship.&rdquo;
                        </p>
                    </div>
                    <p class="text-[11px] text-[var(--accent-primary)] font-serif-accent italic">
                        Theravada &bull; Myanmar &amp; Thai community
                    </p>
                </article>

            </div>
        </div>
    </section>

    <!-- ================================================================= -->
    <!-- 7. FAIR PRICING: SINGLE MARRIAGE PASS (NEVER MONTHLY BILLING)     -->
    <!-- ================================================================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        <div class="max-w-2xl text-left space-y-1">
            <p class="text-xs font-semibold uppercase tracking-wider text-[var(--accent-primary)]">Fair pricing</p>
            <h2 class="font-heading text-2xl sm:text-3xl font-bold text-[var(--text-primary)]">
                Single Marriage Pass.
            </h2>
            <p class="text-xs sm:text-sm text-[var(--text-secondary)]">
                Pay once, active until your wedding blessing. Never monthly subscriptions.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 items-stretch">
            @foreach($plans as $plan)
                @php
                    $isFree = $plan->isFree();
                    $isPopular = (bool) $plan->is_popular;
                @endphp
                <div class="rounded-[var(--radius-md)] p-6 {{ $isPopular ? 'border-2 border-[var(--accent-primary)] bg-[var(--bg-surface)] shadow-sm' : 'border border-[var(--border-default)] bg-[var(--bg-subtle)]' }} flex flex-col justify-between">
                    <div>
                        <span class="text-[10px] font-semibold uppercase tracking-wider {{ $isFree ? 'text-[var(--text-muted)]' : 'text-[var(--accent-primary)]' }}">
                            {{ $isFree ? 'Free Forever' : ($isPopular ? 'Most Chosen' : 'Extended Support') }}
                        </span>

                        <h3 class="font-heading text-base font-bold text-[var(--text-primary)] mt-1">{{ $plan->name }}</h3>
                        <p class="text-xs text-[var(--text-secondary)] mt-0.5">{{ $plan->description }}</p>

                        <div class="my-4 border-y border-[var(--border-subtle)] py-3">
                            @if($isFree)
                                <div class="flex items-baseline gap-1">
                                    <span class="font-heading text-2xl font-bold text-[var(--text-primary)]">$0</span>
                                    <span class="text-xs text-[var(--text-muted)]">forever free</span>
                                </div>
                            @else
                                <div class="flex items-baseline gap-2">
                                    <span class="font-heading text-2xl font-bold text-[var(--text-primary)]">${{ number_format($plan->monthly_price, 2) }}</span>
                                    <span class="text-[10px] font-semibold px-2 py-0.5 rounded bg-[var(--accent-subtle)] text-[var(--accent-primary)] border border-[var(--border-default)]">
                                        Pay 1-Time
                                    </span>
                                </div>
                                <p class="text-[11px] text-[var(--text-muted)] mt-1">
                                    Active Until Confirmed Mangala Vivaha. No recurring deductions.
                                </p>
                            @endif
                        </div>

                        <ul class="space-y-1.5 text-xs text-[var(--text-secondary)]">
                            <li class="flex items-center gap-2">
                                <svg class="w-3.5 h-3.5 text-[var(--accent-primary)] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                <span>{{ $plan->isUnlimitedViews() ? 'Unlimited profile views' : $plan->daily_profile_views . ' daily views' }}</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <svg class="w-3.5 h-3.5 text-[var(--accent-primary)] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                <span>Family representative support</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <svg class="w-3.5 h-3.5 text-[var(--accent-primary)] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                <span>Default photo privacy</span>
                            </li>
                        </ul>
                    </div>

                    <div class="mt-5 pt-3 border-t border-[var(--border-subtle)]">
                        @if($isFree)
                            <a href="{{ route('register') }}" class="btn-secondary w-full text-center text-xs !py-2 block">
                                Create free profile
                            </a>
                        @else
                            <a href="{{ route('subscription.checkout', $plan->slug) }}" class="btn-primary w-full text-center text-xs !py-2 block">
                                Choose {{ trim(Str::before($plan->name, '(')) ?: $plan->name }} &rarr;
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- ================================================================= -->
    <!-- 8. COMMON QUESTIONS (FAQ)                                         -->
    <!-- ================================================================= -->
    <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6" x-data="{ activeFaq: null }">
        <div class="text-left space-y-1">
            <p class="text-xs font-semibold uppercase tracking-wider text-[var(--accent-primary)]">Questions</p>
            <h2 class="font-heading text-2xl sm:text-3xl font-bold text-[var(--text-primary)]">
                Clear answers to common questions.
            </h2>
        </div>

        <div class="space-y-2.5">
            <div class="rounded-[var(--radius-md)] bg-[var(--bg-surface)] border border-[var(--border-default)] overflow-hidden">
                <button type="button"
                        @click="activeFaq = (activeFaq === 1 ? null : 1)"
                        class="w-full p-4 text-left font-semibold text-xs sm:text-sm text-[var(--text-primary)] flex items-center justify-between gap-4 cursor-pointer">
                    <span>How does the Family Representative system work?</span>
                    <span class="text-[var(--text-muted)] text-sm transition transform" :class="activeFaq === 1 ? 'rotate-180' : ''">&darr;</span>
                </button>
                <div x-show="activeFaq === 1" x-collapse class="px-4 pb-4 text-xs text-[var(--text-secondary)] leading-relaxed border-t border-[var(--border-subtle)] pt-3">
                    Candidates can link a parent or elder. Representatives get their own free dashboard to review proposals and give blessings.
                </div>
            </div>

            <div class="rounded-[var(--radius-md)] bg-[var(--bg-surface)] border border-[var(--border-default)] overflow-hidden">
                <button type="button"
                        @click="activeFaq = (activeFaq === 2 ? null : 2)"
                        class="w-full p-4 text-left font-semibold text-xs sm:text-sm text-[var(--text-primary)] flex items-center justify-between gap-4 cursor-pointer">
                    <span>Are photos visible to the public or searchable?</span>
                    <span class="text-[var(--text-muted)] text-sm transition transform" :class="activeFaq === 2 ? 'rotate-180' : ''">&darr;</span>
                </button>
                <div x-show="activeFaq === 2" x-collapse class="px-4 pb-4 text-xs text-[var(--text-secondary)] leading-relaxed border-t border-[var(--border-subtle)] pt-3">
                    No. Photos are blurred by default and only become visible after mutual agreement. They are never indexed by search engines.
                </div>
            </div>

            <div class="rounded-[var(--radius-md)] bg-[var(--bg-surface)] border border-[var(--border-default)] overflow-hidden">
                <button type="button"
                        @click="activeFaq = (activeFaq === 3 ? null : 3)"
                        class="w-full p-4 text-left font-semibold text-xs sm:text-sm text-[var(--text-primary)] flex items-center justify-between gap-4 cursor-pointer">
                    <span>Is there any caste filter on Global Maitri?</span>
                    <span class="text-[var(--text-muted)] text-sm transition transform" :class="activeFaq === 3 ? 'rotate-180' : ''">&darr;</span>
                </button>
                <div x-show="activeFaq === 3" x-collapse class="px-4 pb-4 text-xs text-[var(--text-secondary)] leading-relaxed border-t border-[var(--border-subtle)] pt-3">
                    No. Caste is completely eliminated in accordance with the Buddha's teachings on universal equality.
                </div>
            </div>

            <div class="rounded-[var(--radius-md)] bg-[var(--bg-surface)] border border-[var(--border-default)] overflow-hidden">
                <button type="button"
                        @click="activeFaq = (activeFaq === 4 ? null : 4)"
                        class="w-full p-4 text-left font-semibold text-xs sm:text-sm text-[var(--text-primary)] flex items-center justify-between gap-4 cursor-pointer">
                    <span>What is the Single Marriage Pass?</span>
                    <span class="text-[var(--text-muted)] text-sm transition transform" :class="activeFaq === 4 ? 'rotate-180' : ''">&darr;</span>
                </button>
                <div x-show="activeFaq === 4" x-collapse class="px-4 pb-4 text-xs text-[var(--text-secondary)] leading-relaxed border-t border-[var(--border-subtle)] pt-3">
                    A one-time pass that stays active until your wedding blessing. Zero monthly fees or automatic renewals.
                </div>
            </div>
        </div>
    </section>

    <!-- ================================================================= -->
    <!-- 9. CLOSING CTA BAND (SEAMLESS WITH FOOTER, NO GAP)                -->
    <!-- ================================================================= -->
    <section class="section--dark relative overflow-hidden text-center border-t border-[var(--color-border)]/30 py-10 sm:py-14"
             style="background: linear-gradient(135deg, var(--color-ink-dark) 0%, var(--color-ink-darker) 100%); margin-bottom: 0;">

        <!-- Low-opacity (6-8%) Lotus Line-Art in Corner (White Strokes on Dark) -->
        <div class="absolute right-0 bottom-0 pointer-events-none opacity-[0.07] text-white translate-x-4 translate-y-4" aria-hidden="true">
            <svg class="w-48 h-48 sm:w-64 sm:h-64" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="1.2">
                <path d="M50 20 C46 36 44 48 50 68 C56 48 54 36 50 20 Z"/>
                <path d="M50 34 C36 42 32 54 44 67 C48 55 49 44 50 34 Z"/>
                <path d="M50 34 C64 42 68 54 56 67 C52 55 51 44 50 34 Z"/>
                <path d="M46 48 C28 50 22 64 36 72 C42 64 45 56 46 48 Z"/>
                <path d="M54 48 C72 50 78 64 64 72 C58 64 55 56 54 48 Z"/>
                <path d="M26 72 C36 78 64 78 74 72 C68 82 32 82 26 72 Z"/>
            </svg>
        </div>

        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-5">
            <h2 class="font-heading text-2xl sm:text-4xl font-bold text-white tracking-tight">
                Kindness first. Companionship for life.
            </h2>

            <!-- 3 Trust Chips -->
            <div class="flex flex-wrap items-center justify-center gap-2.5 pt-1">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-[var(--radius-xs)] bg-white/10 text-xs font-medium text-[var(--text-secondary)] border border-white/15">
                    <svg class="w-3.5 h-3.5 text-[var(--color-accent)]" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                    Verified profiles
                </span>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-[var(--radius-xs)] bg-white/10 text-xs font-medium text-[var(--text-secondary)] border border-white/15">
                    <svg class="w-3.5 h-3.5 text-[var(--color-accent)]" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path stroke-linecap="round" stroke-linejoin="round" d="M22 21v-2a4 4 0 00-3-3.87"/><path stroke-linecap="round" stroke-linejoin="round" d="M16 3.13a4 4 0 010 7.75"/></svg>
                    Family approval
                </span>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-[var(--radius-xs)] bg-white/10 text-xs font-medium text-[var(--text-secondary)] border border-white/15">
                    <svg class="w-3.5 h-3.5 text-[var(--color-accent)]" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path stroke-linecap="round" stroke-linejoin="round" d="M7 11V7a5 5 0 0110 0v4"/></svg>
                    Photos stay private
                </span>
            </div>

            <p class="text-xs sm:text-sm text-[var(--text-secondary)] max-w-lg mx-auto">
                No rush. Take your time to discover someone whose presence brings peace to your home.
            </p>

            <!-- Saffron-Gold Primary Button (48px) & Transparent Secondary Button (48px) -->
            <div class="pt-2 flex flex-wrap items-center justify-center gap-3">
                <a href="{{ route('register') }}"
                   class="btn-primary min-h-[48px] px-8 inline-flex items-center justify-center font-semibold text-sm rounded-[var(--radius-sm)] shadow-xs transition active:scale-[0.98]">
                    Create free profile
                </a>
                <a href="{{ route('how-it-works') }}"
                   class="btn-secondary min-h-[48px] px-7 inline-flex items-center justify-center font-semibold text-sm rounded-[var(--radius-sm)] transition active:scale-[0.98]">
                    How it works
                </a>
            </div>

            <p class="text-[11px] text-[var(--text-muted)] italic pt-2">
                &ldquo;Sabbe satta bhavantu sukhitatta &bull; May you be happy and well.&rdquo;
            </p>
        </div>
    </section>

</div>
@endsection

