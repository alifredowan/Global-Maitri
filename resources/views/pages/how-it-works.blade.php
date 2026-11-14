@extends('layouts.app')

@section('title', 'How It Works - Global Vivaha | Sacred Buddhist Matrimonial Journey')
@section('meta_description', 'See how Global Vivaha guides serious Buddhist seekers from verified profiles and Dhamma-compatible matches to Family Representative guidance and a respectful path toward Mangala Vivaha.')
@section('canonical_url', route('how-it-works'))
@section('robots', 'index, follow')

@section('content')
<div class="min-h-screen overflow-hidden bg-[var(--bg-canvas)] text-[var(--text-primary)] transition-colors">
    <style>
        @keyframes how-it-works-pulse {
            0%, 100% { opacity: .45; transform: scale(.92); }
            50% { opacity: 1; transform: scale(1.08); }
        }

        @keyframes how-it-works-travel {
            0% { stroke-dashoffset: 72; opacity: 0; }
            15% { opacity: 1; }
            72% { opacity: 1; }
            100% { stroke-dashoffset: 0; opacity: 0; }
        }

        @keyframes how-it-works-float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-6px); }
        }

        @keyframes how-it-works-beacon {
            0%, 100% { box-shadow: 0 0 0 0 rgba(166, 124, 0, .28); }
            50% { box-shadow: 0 0 0 12px rgba(166, 124, 0, 0); }
        }

        @keyframes how-it-works-draw-line {
            from { stroke-dashoffset: 420; }
            to { stroke-dashoffset: 0; }
        }

        .how-it-works-orbit { animation: how-it-works-pulse 3.6s ease-in-out infinite; transform-origin: center; }
        .how-it-works-packet { stroke-dasharray: 8 64; animation: how-it-works-travel 3.4s linear infinite; }
        .how-it-works-packet.delay-1 { animation-delay: 1.1s; }
        .how-it-works-packet.delay-2 { animation-delay: 2.2s; }
        .how-it-works-float { animation: how-it-works-float 5s ease-in-out infinite; }
        .how-it-works-float.delay-1 { animation-delay: 1.2s; }
        .how-it-works-float.delay-2 { animation-delay: 2.4s; }
        .how-it-works-beacon { animation: how-it-works-beacon 2.8s ease-out infinite; }
        .how-it-works-draw-line { stroke-dasharray: 420; animation: how-it-works-draw-line 2.8s ease-out both; }

        .how-it-works-map-card {
            box-shadow: 0 16px 36px rgba(20, 20, 18, .24), inset 0 1px 0 rgba(255, 255, 255, .08);
            transition: transform .3s ease, border-color .3s ease, box-shadow .3s ease;
        }

        .how-it-works-map-card:hover {
            border-color: rgba(166, 124, 0, .5);
            box-shadow: 0 20px 45px rgba(20, 20, 18, .34), inset 0 1px 0 rgba(255, 255, 255, .12);
            transform: translateY(-4px);
        }

        .how-it-works-map-node {
            box-shadow: 0 0 0 1px rgba(166, 124, 0, .25), 0 0 0 12px rgba(166, 124, 0, .08), 0 20px 45px rgba(20, 20, 18, .38);
        }

        @media (prefers-reduced-motion: reduce) {
            .how-it-works-orbit,
            .how-it-works-packet,
            .how-it-works-float,
            .how-it-works-beacon,
            .how-it-works-draw-line { animation: none; }
        }
    </style>

    @php
        $hiwIconPaths = [
            'identification' => 'M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z',
            'shield-check' => 'M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z',
            'sparkles' => 'M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z',
            'heart' => 'M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z',
            'user-group' => 'M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z',
            'users' => 'M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z',
            'user' => 'M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z',
            'scale' => 'M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0 0 12 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52 2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 0 1-2.031.352 5.988 5.988 0 0 1-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971Zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0 2.62 10.726c.122.499-.106 1.028-.589 1.202a5.989 5.989 0 0 1-2.031.352 5.989 5.989 0 0 1-2.031-.352c-.483-.174-.711-.703-.59-1.202L5.25 4.971Z',
            'home' => 'm2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25',
            'magnifying-glass' => 'm21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z',
            'chat-bubble-left-right' => 'M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155',
            'hand-raised' => 'M10.05 4.575a1.575 1.575 0 1 0-3.15 0v3m3.15-3v-1.5a1.575 1.575 0 0 1 3.15 0v1.5m-3.15 0 .075 5.925m3.075.75V4.575m0 0a1.575 1.575 0 0 1 3.15 0V15M6.9 7.575a1.575 1.575 0 1 0-3.15 0v8.175a6.75 6.75 0 0 0 6.75 6.75h2.018a5.25 5.25 0 0 0 3.712-1.538l1.732-1.732a5.25 5.25 0 0 0 1.538-3.712l.003-2.024a.668.668 0 0 1 .198-.471 1.575 1.575 0 1 0-2.228-2.228 3.818 3.818 0 0 0-1.12 2.687M6.9 7.575V12m6.27 4.318A4.49 4.49 0 0 1 16.35 15m.002 0h-.002',
            'dharmachakra' => 'M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm0 18a8 8 0 1 1 8-8 8 8 0 0 1-8 8zm0-14a6 6 0 1 0 6 6 6 6 0 0 0-6-6zm0 2a4 4 0 1 1-4 4 4 4 0 0 1 4-4z',
        ];
        $hiwIcon = function (string $name, string $class = 'h-6 w-6') use ($hiwIconPaths): string {
            $d = $hiwIconPaths[$name] ?? '';
            return '<svg class="'.$class.'" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="'.$d.'" /></svg>';
        };
    @endphp

    <!-- Hero Section -->
    <section class="relative isolate overflow-hidden bg-[var(--bg-canvas)] py-16 text-[var(--text-primary)] sm:py-24 border-b border-[var(--border-default)]">
        <div class="mx-auto grid max-w-7xl items-center gap-14 px-4 sm:px-6 lg:grid-cols-12 lg:px-8">
            <div class="lg:col-span-5">
                <div class="mb-5 inline-flex items-center gap-2 rounded-[3px] border border-[var(--saffron-gold)]/25 bg-[var(--saffron-gold)]/10 px-3 py-1 text-xs font-mono uppercase tracking-wider text-[var(--saffron-gold)]">
                    <span class="w-1.5 h-1.5 rounded-full bg-[var(--saffron-gold)]"></span>
                    A Clear Path to Mangala Vivaha
                </div>
                <h1 class="font-serif text-3xl font-bold leading-[1.12] tracking-tight sm:text-5xl text-[var(--text-primary)]">
                    Two hearts.<br>
                    <span class="text-[var(--saffron-gold)]">One mindful circle.</span>
                </h1>
                <p class="mt-5 max-w-xl text-xs sm:text-sm leading-relaxed text-[var(--text-secondary)]">
                    Global Maitri connects earnest Buddhist individuals through a respectful, family-aware process — so an auspicious introduction can unfold with clarity, Dhamma compatibility, and loving-kindness.
                </p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('register') }}" class="btn-primary inline-flex items-center gap-2 text-xs py-2.5 px-5 font-medium">
                        <span>Start your profile</span>
                        <span aria-hidden="true">&rarr;</span>
                    </a>
                    <a href="#journey" class="btn-secondary inline-flex items-center gap-2 text-xs py-2.5 px-5 font-medium">
                        <span>Explore the journey</span>
                    </a>
                </div>
            </div>

            <!-- Animated relationship map -->
            <div class="relative lg:col-span-7" aria-label="Animated diagram showing two seekers and a Family Representative connected through Global Maitri">
                <div class="relative mx-auto aspect-[1.08] max-w-2xl overflow-hidden rounded-[4px] border border-[var(--color-border)] bg-[var(--color-surface)] dark:border-[var(--color-border)] dark:bg-[var(--color-surface)]/90 p-4 shadow-2xl backdrop-blur sm:aspect-[1.25] sm:p-8">
                    <div class="absolute inset-0 opacity-40 [background-image:linear-gradient(rgba(31,78,121,.08)_1px,transparent_1px),linear-gradient(90deg,rgba(31,78,121,.08)_1px,transparent_1px)] [background-size:32px_32px]"></div>
                    <div class="absolute -left-24 top-1/3 h-72 w-72 rounded-full bg-[var(--color-primary)]/10 blur-3xl"></div>
                    <div class="absolute -right-24 bottom-0 h-72 w-72 rounded-full bg-[var(--color-primary)]/10 blur-3xl"></div>
                    <div class="absolute left-1/2 top-1/2 h-52 w-52 -translate-x-1/2 -translate-y-1/2 rounded-full bg-[var(--color-primary)]/10 blur-3xl"></div>
                    <svg class="pointer-events-none absolute inset-0 z-0 h-full w-full" viewBox="0 0 700 560" fill="none" role="img" aria-labelledby="relationship-map-title">
                        <title id="relationship-map-title">Two seekers and their Family Representative connected through a trusted matrimonial process</title>
                        <path d="M153 166 C235 210 270 238 325 274" stroke="rgba(31,78,121,.36)" stroke-width="2" stroke-linecap="round" />
                        <path d="M547 166 C465 210 430 238 375 274" stroke="rgba(31,78,121,.36)" stroke-width="2" stroke-linecap="round" />
                        <path d="M350 450 C350 393 350 362 350 318" stroke="rgba(31,78,121,.42)" stroke-width="2" stroke-linecap="round" />
                        <path class="how-it-works-packet" d="M153 166 C235 210 270 238 325 274" stroke="var(--color-primary)" stroke-width="4" stroke-linecap="round" />
                        <path class="how-it-works-packet delay-1" d="M547 166 C465 210 430 238 375 274" stroke="var(--color-primary)" stroke-width="4" stroke-linecap="round" />
                        <path class="how-it-works-packet delay-2" d="M350 450 C350 393 350 362 350 318" stroke="var(--color-primary)" stroke-width="4" stroke-linecap="round" />
                        <circle class="how-it-works-orbit" cx="350" cy="295" r="76" stroke="rgba(31,78,121,.26)" stroke-width="1" stroke-dasharray="3 9" />
                    </svg>

                    <!-- Candidate A -->
                    <div class="how-it-works-float how-it-works-map-card absolute left-[3%] top-[10%] z-10 w-[43%] max-w-52 rounded-[4px] border border-[var(--color-border)] bg-[var(--color-surface)]/95 dark:border-[var(--color-border)] dark:bg-[var(--color-surface-alt)]/95 p-3 backdrop-blur-xl sm:left-[8%] sm:top-[8%] sm:w-48 sm:p-4">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-[4px] bg-[var(--color-primary-soft)] text-[var(--color-accent)]">{!! $hiwIcon('user', 'h-5 w-5') !!}</div>
                            <div>
                                <p class="text-xs font-bold text-[var(--text-primary)]">Candidate A</p>
                                <p class="mt-0.5 text-[10px] text-[var(--text-muted)]">Verified intention</p>
                            </div>
                        </div>
                        <div class="mt-3 flex items-center gap-1.5 text-[10px] font-semibold text-[var(--color-accent)]">
                            <span class="h-1.5 w-1.5 rounded-full bg-[var(--color-primary)]"></span> Profile ready
                        </div>
                    </div>

                    <!-- Candidate B -->
                    <div class="how-it-works-float delay-1 how-it-works-map-card absolute right-[3%] top-[10%] z-10 w-[43%] max-w-52 rounded-[4px] border border-[var(--color-border)] bg-[var(--color-surface)]/95 dark:border-[var(--color-border)] dark:bg-[var(--color-surface-alt)]/95 p-3 backdrop-blur-xl sm:right-[8%] sm:top-[8%] sm:w-48 sm:p-4">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-[4px] bg-[var(--color-primary-soft)] text-[var(--color-accent)]">{!! $hiwIcon('user', 'h-5 w-5') !!}</div>
                            <div>
                                <p class="text-xs font-bold text-[var(--text-primary)]">Candidate B</p>
                                <p class="mt-0.5 text-[10px] text-[var(--text-muted)]">Dhamma aligned</p>
                            </div>
                        </div>
                        <div class="mt-3 flex items-center gap-1.5 text-[10px] font-semibold text-[var(--color-accent)]">
                            <span class="h-1.5 w-1.5 rounded-full bg-[var(--color-primary)]"></span> Mutual interest
                        </div>
                    </div>

                    <!-- Center Hub -->
                    <div class="absolute left-1/2 top-[49%] z-10 flex w-40 -translate-x-1/2 -translate-y-1/2 flex-col items-center text-center sm:w-48">
                        <div class="how-it-works-map-node relative flex h-20 w-20 items-center justify-center rounded-full border border-[var(--color-accent)]/40 bg-[var(--color-bg)] sm:h-24 sm:w-24 p-3 shadow-xs">
                            <div class="absolute inset-1.5 rounded-full border border-dashed border-[var(--color-accent)]/30"></div>
                            <x-application-logo class="relative h-8 w-8 text-[var(--color-accent)]" />
                        </div>
                        <p class="mt-3 text-[9px] font-mono uppercase tracking-[.22em] text-[var(--text-muted)]">Global Maitri</p>
                        <p class="mt-0.5 text-xs sm:text-sm font-bold text-[var(--text-primary)]">Auspicious Union</p>
                        <span class="mt-1.5 rounded-full border border-[var(--color-accent)]/25 bg-[var(--color-accent-soft)] px-2.5 py-0.5 text-[9px] font-mono text-[var(--color-accent)]">Respect first</span>
                    </div>

                    <!-- Family Rep -->
                    <div class="how-it-works-float delay-2 how-it-works-map-card absolute bottom-[4%] left-1/2 z-10 w-[58%] max-w-56 -translate-x-1/2 rounded-[4px] border border-[var(--color-border)] bg-[var(--color-surface)]/95 dark:border-[var(--color-border)] dark:bg-[var(--color-surface-alt)]/95 p-3 sm:bottom-[7%] sm:w-56 sm:p-4 backdrop-blur-xl shadow-xs">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-[3px] bg-[var(--color-primary-soft)] text-[var(--color-accent)]">{!! $hiwIcon('shield-check', 'h-5 w-5') !!}</div>
                            <div>
                                <p class="text-xs font-bold text-[var(--text-primary)]">Family Rep / Elder</p>
                                <p class="mt-0.5 text-[10px] text-[var(--text-muted)]">Visible when chosen</p>
                            </div>
                        </div>
                        <div class="mt-3 flex items-center gap-1.5 text-[10px] font-semibold text-[var(--color-accent)]">
                            <span class="h-1.5 w-1.5 rounded-full bg-[var(--color-primary)]"></span> Family guidance
                        </div>
                    </div>

                    <div class="absolute left-1/2 top-3 z-10 -translate-x-1/2 rounded-full border border-[var(--border-default)] bg-[var(--bg-card)] px-3 py-1 text-[9px] font-mono uppercase tracking-[.18em] text-[var(--text-secondary)] shadow-xs sm:top-5">Intent &amp; Metta layer</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Interactive system walkthrough -->
    <section class="relative overflow-hidden border-b border-[var(--border-default)] bg-[var(--bg-canvas)] py-16 sm:py-24"
             x-data="{ activeStage: 1 }">
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center space-y-2">
                <span class="text-xs font-mono uppercase tracking-wider text-[var(--saffron-gold)]">System Walkthrough</span>
                <h2 class="font-serif text-2xl sm:text-4xl font-bold tracking-tight text-[var(--text-primary)]">A mindful path, never a guessing game.</h2>
                <p class="mx-auto mt-2 max-w-2xl text-xs sm:text-sm leading-relaxed text-[var(--text-secondary)]">Follow each step as it moves through the platform. Select a stage to explore candidate actions, privacy states, and family representative guidance.</p>
            </div>

            <div class="mt-12 overflow-hidden card-ledger">
                <div class="grid lg:grid-cols-[1.25fr_.75fr]">
                    <!-- Visual flow canvas -->
                    <div class="relative min-h-[520px] overflow-hidden border-b border-[var(--border-default)] p-5 sm:p-8 lg:border-b-0 lg:border-r">
                        <div class="absolute inset-0 opacity-40 [background-image:linear-gradient(rgba(166,124,0,.08)_1px,transparent_1px),linear-gradient(90deg,rgba(166,124,0,.08)_1px,transparent_1px)] [background-size:28px_28px]"></div>
                        <div class="relative flex items-center justify-between">
                            <div>
                                <p class="text-[10px] font-bold uppercase tracking-[.18em] text-[var(--text-muted)]">Live journey map</p>
                                <p class="mt-1 text-sm font-bold text-[var(--text-primary)]">Trust builds one mindful signal at a time</p>
                            </div>
                            <div class="flex items-center gap-1.5 rounded-[4px] border border-[var(--border-default)] bg-[var(--bg-subtle)] px-2.5 py-1 text-[10px] font-bold text-[var(--accent-primary)]">
                                <span class="h-1.5 w-1.5 rounded-full bg-[var(--accent-primary)]"></span> Process active
                            </div>
                        </div>

                        <div class="relative mx-auto mt-10 max-w-2xl">
                            <svg class="absolute inset-x-0 top-11 h-32 w-full" viewBox="0 0 720 140" fill="none" preserveAspectRatio="none" aria-hidden="true">
                                <path d="M70 70 C190 70 200 70 320 70 S520 70 650 70" stroke="var(--border-default)" stroke-width="3" stroke-linecap="round" />
                                <path class="how-it-works-draw-line" d="M70 70 C190 70 200 70 320 70 S520 70 650 70" stroke="var(--accent-primary)" stroke-width="4" stroke-linecap="round" />
                                <circle cx="70" cy="70" r="7" fill="var(--accent-primary)" />
                                <circle cx="200" cy="70" r="7" fill="var(--accent-primary)" />
                                <circle cx="330" cy="70" r="7" fill="var(--accent-primary)" />
                                <circle cx="460" cy="70" r="7" fill="var(--accent-primary)" />
                                <circle cx="650" cy="70" r="7" fill="var(--accent-primary)" />
                            </svg>

                            <div class="relative grid grid-cols-3 gap-3 sm:grid-cols-6 sm:gap-2">
                                @foreach([
                                    1 => ['icon' => 'identification', 'label' => 'Biodata'],
                                    2 => ['icon' => 'shield-check', 'label' => 'Verify'],
                                    3 => ['icon' => 'sparkles', 'label' => 'Dhamma'],
                                    4 => ['icon' => 'heart', 'label' => 'Interest'],
                                    5 => ['icon' => 'user-group', 'label' => 'Family Rep'],
                                    6 => ['icon' => 'users', 'label' => 'Vivaha'],
                                ] as $stage => $item)
                                    <button type="button"
                                            @click="activeStage = {{ $stage }}"
                                            :aria-current="activeStage === {{ $stage }} ? 'step' : false"
                                            class="group flex flex-col items-center gap-2 text-center focus:outline-none cursor-pointer">
                                        <span class="how-it-works-beacon relative flex h-14 w-14 items-center justify-center rounded-[4px] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--accent-primary)] shadow-sm transition duration-200 group-hover:-translate-y-0.5 sm:h-16 sm:w-16"
                                              :class="activeStage === {{ $stage }} ? 'ring-2 ring-[var(--accent-primary)] bg-[var(--accent-primary)]/10' : 'opacity-70'">{!! $hiwIcon($item['icon'], 'h-6 w-6 sm:h-7 sm:w-7') !!}</span>
                                        <span class="text-[10px] font-bold uppercase tracking-wider transition sm:text-xs"
                                              :class="activeStage === {{ $stage }} ? 'text-[var(--accent-primary)]' : 'text-[var(--text-secondary)]'">{{ $item['label'] }}</span>
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <div class="relative mx-auto mt-10 grid max-w-2xl gap-3 sm:grid-cols-3">
                            <div class="rounded-[4px] border border-[var(--border-default)] bg-[var(--bg-subtle)] p-4">
                                <p class="text-[10px] font-bold uppercase tracking-wider text-[var(--accent-primary)]">Always protected</p>
                                <p class="mt-2 text-xs font-bold text-[var(--text-primary)]">Lotus Modesty Shield</p>
                                <p class="mt-1 text-[11px] leading-5 text-[var(--text-secondary)]">Photos sheltered by default until mutual acceptance.</p>
                            </div>
                            <div class="rounded-[4px] border border-[var(--border-default)] bg-[var(--bg-subtle)] p-4">
                                <p class="text-[10px] font-bold uppercase tracking-wider text-[var(--accent-primary)]">Only when mutual</p>
                                <p class="mt-2 text-xs font-bold text-[var(--text-primary)]">Mindful Interest &amp; Chat</p>
                                <p class="mt-1 text-[11px] leading-5 text-[var(--text-secondary)]">No unsolicited calls, cold messages, or pressure.</p>
                            </div>
                            <div class="rounded-[4px] border border-[var(--border-default)] bg-[var(--bg-subtle)] p-4">
                                <p class="text-[10px] font-bold uppercase tracking-wider text-[var(--accent-primary)]">When it matters</p>
                                <p class="mt-2 text-xs font-bold text-[var(--text-primary)]">Family Representative Clarity</p>
                                <p class="mt-1 text-[11px] leading-5 text-[var(--text-secondary)]">Parents and trusted elders guide with peace.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Dynamic stage explanation -->
                    <div class="relative bg-[var(--bg-surface)] p-6 sm:p-8">
                        <div class="flex items-center justify-between">
                            <p class="text-[10px] font-bold uppercase tracking-[.18em] text-[var(--text-muted)]">What happens now</p>
                            <span class="rounded-[4px] bg-[var(--bg-subtle)] border border-[var(--border-default)] px-2.5 py-1 text-[10px] font-bold text-[var(--text-secondary)]"><span x-text="activeStage"></span> / 6</span>
                        </div>

                        <div class="mt-8 min-h-[235px]">
                            <div x-show="activeStage === 1" x-transition.opacity>
                                <span class="inline-flex h-11 w-11 items-center justify-center rounded-[4px] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)]">{!! $hiwIcon('identification') !!}</span>
                                <h3 class="mt-5 font-heading text-2xl font-extrabold text-[var(--text-primary)]">Start with your biodata</h3>
                                <p class="mt-3 text-sm leading-6 text-[var(--text-secondary)]">A candidate shares their Buddhist tradition, meditation practice, Five Precepts adherence, lifestyle, and marriage aspirations.</p>
                                <div class="mt-5 space-y-2 text-xs font-semibold text-[var(--text-primary)]">
                                    <p>✓ Buddhist tradition &amp; lineage details</p>
                                    <p>✓ Five Precepts &amp; meditation rhythm</p>
                                    <p>✓ Casteless community &amp; partner preferences</p>
                                </div>
                            </div>

                            <div x-show="activeStage === 2" x-transition.opacity>
                                <span class="inline-flex h-11 w-11 items-center justify-center rounded-[4px] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)]">{!! $hiwIcon('shield-check') !!}</span>
                                <h3 class="mt-5 font-heading text-2xl font-extrabold text-[var(--text-primary)]">Build a trusted identity</h3>
                                <p class="mt-3 text-sm leading-6 text-[var(--text-secondary)]">Document verification and moderation ensure real seekers connect in an authentic environment designed for accountability.</p>
                                <div class="mt-5 space-y-2 text-xs font-semibold text-[var(--text-primary)]">
                                    <p>✓ Government ID review</p>
                                    <p>✓ Human moderator verification</p>
                                    <p>✓ Zero fake accounts or bots</p>
                                </div>
                            </div>

                            <div x-show="activeStage === 3" x-transition.opacity>
                                <span class="inline-flex h-11 w-11 items-center justify-center rounded-[4px] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)]">{!! $hiwIcon('sparkles') !!}</span>
                                <h3 class="mt-5 font-heading text-2xl font-extrabold text-[var(--text-primary)]">Discover with Dhamma compatibility</h3>
                                <p class="mt-3 text-sm leading-6 text-[var(--text-secondary)]">Our matching algorithm weights Buddhist tradition, meditation, diet, and lifestyle values over superficial metrics.</p>
                                <div class="mt-5 space-y-2 text-xs font-semibold text-[var(--text-primary)]">
                                    <p>✓ Dhamma practice compatibility score</p>
                                    <p>✓ Optional Sinhalese Porondam / Horoscope charts</p>
                                    <p>✓ Filters for real-life values</p>
                                </div>
                            </div>

                            <div x-show="activeStage === 4" x-transition.opacity>
                                <span class="inline-flex h-11 w-11 items-center justify-center rounded-[4px] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)]">{!! $hiwIcon('heart') !!}</span>
                                <h3 class="mt-5 font-heading text-2xl font-extrabold text-[var(--text-primary)]">Send a mindful proposal</h3>
                                <p class="mt-3 text-sm leading-6 text-[var(--text-secondary)]">A proposal signal indicates earnest intent. The recipient can accept or politely decline without any uncomfortable pressure.</p>
                                <div class="mt-5 space-y-2 text-xs font-semibold text-[var(--text-primary)]">
                                    <p>✓ Consent before messaging begins</p>
                                    <p>✓ Mutual acceptance opens conversation</p>
                                    <p>✓ Lotus blur reveals gracefully upon agreement</p>
                                </div>
                            </div>

                            <div x-show="activeStage === 5" x-transition.opacity>
                                <span class="inline-flex h-11 w-11 items-center justify-center rounded-[4px] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)]">{!! $hiwIcon('user-group') !!}</span>
                                <h3 class="mt-5 font-heading text-2xl font-extrabold text-[var(--text-primary)]">Engage Family Representatives</h3>
                                <p class="mt-3 text-sm leading-6 text-[var(--text-secondary)]">Parents, elder siblings, or trusted mentors can oversee discovery, review proposals, or chaperone conversations.</p>
                                <div class="mt-5 space-y-2 text-xs font-semibold text-[var(--text-primary)]">
                                    <p>✓ Granular permissions (view-only to approval)</p>
                                    <p>✓ Open to both grooms and brides</p>
                                    <p>✓ Harmonious family involvement</p>
                                </div>
                            </div>

                            <div x-show="activeStage === 6" x-transition.opacity>
                                <span class="inline-flex h-11 w-11 items-center justify-center rounded-[4px] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)]">{!! $hiwIcon('users') !!}</span>
                                <h3 class="mt-5 font-heading text-2xl font-extrabold text-[var(--text-primary)]">Solemnize Mangala Vivaha</h3>
                                <p class="mt-3 text-sm leading-6 text-[var(--text-secondary)]">When mutual alignment is found, take the joyful step toward marriage with family blessings and a printable digital certificate.</p>
                                <div class="mt-5 space-y-2 text-xs font-semibold text-[var(--text-primary)]">
                                    <p>✓ Mindful and anti-dowry protected chat</p>
                                    <p>✓ Mangala Vivaha celebration &amp; Pali blessings</p>
                                    <p>✓ Digital Blessing Certificate with Sangha homage</p>
                                </div>
                            </div>
                        </div>

                        <div class="border-t border-[var(--border-default)] pt-5">
                            <div class="flex items-center justify-between gap-3">
                                <button type="button" @click="activeStage = activeStage === 1 ? 6 : activeStage - 1" class="btn-secondary text-xs px-3 py-2 cursor-pointer">&larr; Previous</button>
                                <div class="flex gap-1.5" aria-label="Journey stage selector">
                                    @for($stage = 1; $stage <= 6; $stage++)
                                        <button type="button" @click="activeStage = {{ $stage }}" class="h-2 rounded-[2px] transition-all cursor-pointer" :class="activeStage === {{ $stage }} ? 'w-7 bg-[var(--accent-primary)]' : 'w-2 bg-[var(--border-default)]'" aria-label="Go to stage {{ $stage }}"></button>
                                    @endfor
                                </div>
                                <button type="button" @click="activeStage = activeStage === 6 ? 1 : activeStage + 1" class="btn-secondary text-xs px-3 py-2 cursor-pointer">Next &rarr;</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Role clarity -->
    <section class="border-b border-[var(--border-default)] bg-[var(--bg-canvas)] py-16 sm:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <span class="text-xs font-bold uppercase tracking-[.2em] text-[var(--accent-primary)]">Every role has a place</span>
                <h2 class="mt-3 font-heading text-3xl font-extrabold tracking-tight text-[var(--text-primary)] sm:text-4xl">A shared journey, clear responsibilities</h2>
                <p class="mt-4 text-sm leading-6 text-[var(--text-secondary)]">The process stays respectful and calm because everyone knows when to step forward—and when to protect personal space.</p>
            </div>

            <div class="mt-12 grid gap-5 md:grid-cols-3">
                <div class="card-ledger p-6 transition hover:-translate-y-0.5">
                    <div class="flex items-start justify-between">
                        <div class="flex h-12 w-12 items-center justify-center rounded-[4px] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)]">{!! $hiwIcon('user', 'h-6 w-6') !!}</div>
                        <span class="rounded-[4px] border border-[var(--border-default)] bg-[var(--bg-subtle)] px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-[var(--accent-primary)]">Candidate</span>
                    </div>
                    <h3 class="mt-6 font-heading text-xl font-extrabold text-[var(--text-primary)]">Bring honest intention</h3>
                    <p class="mt-3 text-sm leading-6 text-[var(--text-secondary)]">Create a thoughtful profile, share your Dhamma practice, and approach every candidate with kindness and Metta.</p>
                    <div class="mt-5 border-t border-[var(--border-subtle)] pt-4 text-xs font-semibold text-[var(--accent-primary)]">Biodata · Dhamma values · Mutual consent</div>
                </div>

                <div class="card-ledger p-6 transition hover:-translate-y-0.5">
                    <div class="flex items-start justify-between">
                        <div class="flex h-12 w-12 items-center justify-center rounded-[4px] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)]">{!! $hiwIcon('shield-check', 'h-6 w-6') !!}</div>
                        <span class="rounded-[4px] border border-[var(--border-default)] bg-[var(--bg-subtle)] px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-[var(--accent-primary)]">Family Rep</span>
                    </div>
                    <h3 class="mt-6 font-heading text-xl font-extrabold text-[var(--text-primary)]">Bring elder wisdom</h3>
                    <p class="mt-3 text-sm leading-6 text-[var(--text-secondary)]">A parent, sibling, or trusted mentor can oversee and advise candidates with custom permissions.</p>
                    <div class="mt-5 border-t border-[var(--border-subtle)] pt-4 text-xs font-semibold text-[var(--accent-primary)]">Support · Guidance · Auspicious blessings</div>
                </div>

                <div class="card-ledger p-6 transition hover:-translate-y-0.5">
                    <div class="flex items-start justify-between">
                        <div class="flex h-12 w-12 items-center justify-center rounded-[4px] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)]">{!! $hiwIcon('scale', 'h-6 w-6') !!}</div>
                        <span class="rounded-[4px] border border-[var(--border-default)] bg-[var(--bg-subtle)] px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-[var(--accent-primary)]">Maitri Platform</span>
                    </div>
                    <h3 class="mt-6 font-heading text-xl font-extrabold text-[var(--text-primary)]">Maintain mindful safety</h3>
                    <p class="mt-3 text-sm leading-6 text-[var(--text-secondary)]">Verification, anti-dowry filters, Lotus modesty shields, and moderation keep the environment sacred.</p>
                    <div class="mt-5 border-t border-[var(--border-subtle)] pt-4 text-xs font-semibold text-[var(--accent-primary)]">Trust · Anti-Dowry · Non-Caste Equality</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Role-based walkthrough -->
    <section class="bg-[var(--bg-subtle)] py-16 sm:py-24" x-data="{ role: 'seeker' }">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <span class="text-xs font-bold uppercase tracking-[.2em] text-[var(--accent-primary)]">Choose your perspective</span>
                <h2 class="mt-3 font-heading text-3xl font-extrabold tracking-tight text-[var(--text-primary)] sm:text-4xl">See where you fit in.</h2>
                <p class="mt-4 text-sm leading-6 text-[var(--text-secondary)]">Select a perspective to see the actions, visibility, and milestones tailored to your matrimonial role.</p>
            </div>

            <div class="mx-auto mt-10 flex max-w-xl rounded-[4px] border border-[var(--border-default)] bg-[var(--bg-surface)] p-1.5 shadow-xs" role="tablist" aria-label="Choose your role">
                <button type="button" @click="role = 'seeker'" :aria-selected="role === 'seeker'" class="flex flex-1 items-center justify-center gap-1.5 rounded-[3px] px-3 py-2.5 text-xs font-bold transition cursor-pointer" :class="role === 'seeker' ? 'bg-[var(--accent-primary)] text-white shadow-xs' : 'text-[var(--text-secondary)] hover:bg-[var(--bg-subtle)]'" role="tab">{!! $hiwIcon('user', 'h-4 w-4') !!} Candidate</button>
                <button type="button" @click="role = 'wali'" :aria-selected="role === 'wali'" class="flex flex-1 items-center justify-center gap-1.5 rounded-[3px] px-3 py-2.5 text-xs font-bold transition cursor-pointer" :class="role === 'wali' ? 'bg-[var(--accent-primary)] text-white shadow-xs' : 'text-[var(--text-secondary)] hover:bg-[var(--bg-subtle)]'" role="tab">{!! $hiwIcon('shield-check', 'h-4 w-4') !!} Family Rep</button>
                <button type="button" @click="role = 'family'" :aria-selected="role === 'family'" class="flex flex-1 items-center justify-center gap-1.5 rounded-[3px] px-3 py-2.5 text-xs font-bold transition cursor-pointer" :class="role === 'family' ? 'bg-[var(--accent-primary)] text-white shadow-xs' : 'text-[var(--text-secondary)] hover:bg-[var(--bg-subtle)]'" role="tab">{!! $hiwIcon('home', 'h-4 w-4') !!} Family Elders</button>
            </div>

            <div class="mx-auto mt-8 max-w-5xl overflow-hidden card-ledger">
                <!-- Seeker / Candidate -->
                <div x-show="role === 'seeker'" x-transition.opacity class="grid lg:grid-cols-[.8fr_1.2fr]">
                    <div class="bg-[var(--bg-canvas)] p-7 text-[var(--text-primary)] sm:p-10 border-b lg:border-b-0 lg:border-r border-[var(--border-default)]">
                        <span class="inline-flex h-12 w-12 items-center justify-center rounded-[3px] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-[var(--saffron-gold)]">{!! $hiwIcon('user', 'h-6 w-6') !!}</span>
                        <p class="mt-6 text-[10px] font-mono uppercase tracking-[.2em] text-[var(--saffron-gold)]">For the Candidate</p>
                        <h3 class="mt-2 font-serif text-2xl font-bold text-[var(--text-primary)]">You bring the intention.</h3>
                        <p class="mt-3 text-xs sm:text-sm leading-relaxed text-[var(--text-secondary)]">Your profile is your respectful introduction. You decide what to share, who to approach, and when a conversation moves toward marriage.</p>
                        <a href="{{ route('register') }}" class="btn-primary mt-6 inline-flex items-center gap-2 text-xs py-2 px-4 font-medium">Build my biodata &rarr;</a>
                    </div>
                    <div class="p-7 sm:p-10 bg-[var(--bg-card)]">
                        <p class="text-xs font-mono uppercase tracking-wider text-[var(--saffron-gold)]">Your four moments</p>
                        <div class="mt-6 space-y-5">
                            <div class="flex gap-4">
                                <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-[3px] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-xs font-mono text-[var(--saffron-gold)]">01</span>
                                <div>
                                    <h4 class="text-xs sm:text-sm font-serif font-bold text-[var(--text-primary)]">Complete your biodata</h4>
                                    <p class="mt-1 text-xs leading-relaxed text-[var(--text-secondary)]">Add your tradition, meditation rhythm, Five Precepts, and partner preferences.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-[3px] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-xs font-mono text-[var(--saffron-gold)]">02</span>
                                <div>
                                    <h4 class="text-xs sm:text-sm font-serif font-bold text-[var(--text-primary)]">Explore compatible candidates</h4>
                                    <p class="mt-1 text-xs leading-relaxed text-[var(--text-secondary)]">Review Dhamma compatibility indicators before photos or chatting.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-[3px] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-xs font-mono text-[var(--saffron-gold)]">03</span>
                                <div>
                                    <h4 class="text-xs sm:text-sm font-serif font-bold text-[var(--text-primary)]">Send one respectful proposal</h4>
                                    <p class="mt-1 text-xs leading-relaxed text-[var(--text-secondary)]">The recipient chooses whether the door opens gracefully.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-[3px] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-xs font-mono text-[var(--saffron-gold)]">04</span>
                                <div>
                                    <h4 class="text-xs sm:text-sm font-serif font-bold text-[var(--text-primary)]">Move toward Mangala Vivaha</h4>
                                    <p class="mt-1 text-xs leading-relaxed text-[var(--text-secondary)]">Mindful chat and family involvement facilitate lifelong companionship.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Family Rep -->
                <div x-show="role === 'wali'" x-transition.opacity class="grid lg:grid-cols-[.8fr_1.2fr]">
                    <div class="bg-[var(--bg-canvas)] p-7 text-[var(--text-primary)] sm:p-10 border-b lg:border-b-0 lg:border-r border-[var(--border-default)]">
                        <span class="inline-flex h-12 w-12 items-center justify-center rounded-[3px] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-[var(--saffron-gold)]">{!! $hiwIcon('shield-check', 'h-6 w-6') !!}</span>
                        <p class="mt-6 text-[10px] font-mono uppercase tracking-[.2em] text-[var(--saffron-gold)]">For the Family Representative</p>
                        <h3 class="mt-2 font-serif text-2xl font-bold text-[var(--text-primary)]">You bring family confidence.</h3>
                        <p class="mt-3 text-xs sm:text-sm leading-relaxed text-[var(--text-secondary)]">Parents and trusted relatives participate actively with full clarity and permission controls for both male and female candidates.</p>
                        <a href="{{ route('register') }}" class="btn-primary mt-6 inline-flex items-center gap-2 text-xs py-2 px-4 font-medium">Representative Access &rarr;</a>
                    </div>
                    <div class="p-7 sm:p-10 bg-[var(--bg-card)]">
                        <p class="text-xs font-mono uppercase tracking-wider text-[var(--saffron-gold)]">Your four moments</p>
                        <div class="mt-6 space-y-5">
                            <div class="flex gap-4">
                                <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-[3px] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-xs font-mono text-[var(--saffron-gold)]">01</span>
                                <div>
                                    <h4 class="text-xs sm:text-sm font-serif font-bold text-[var(--text-primary)]">Receive candidate link</h4>
                                    <p class="mt-1 text-xs leading-relaxed text-[var(--text-secondary)]">The seeker connects your profile with custom relation roles.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-[3px] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-xs font-mono text-[var(--saffron-gold)]">02</span>
                                <div>
                                    <h4 class="text-xs sm:text-sm font-serif font-bold text-[var(--text-primary)]">Choose permission level</h4>
                                    <p class="mt-1 text-xs leading-relaxed text-[var(--text-secondary)]">View-only, proposal approval, or active chaperone support.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-[3px] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-xs font-mono text-[var(--saffron-gold)]">03</span>
                                <div>
                                    <h4 class="text-xs sm:text-sm font-serif font-bold text-[var(--text-primary)]">Review candidate background</h4>
                                    <p class="mt-1 text-xs leading-relaxed text-[var(--text-secondary)]">Examine Dhamma practice, lifestyle, and family compatibility.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-[3px] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-xs font-mono text-[var(--saffron-gold)]">04</span>
                                <div>
                                    <h4 class="text-xs sm:text-sm font-serif font-bold text-[var(--text-primary)]">Bless the union</h4>
                                    <p class="mt-1 text-xs leading-relaxed text-[var(--text-secondary)]">Guide the families toward an auspicious Mangala Vivaha celebration.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Family Elders -->
                <div x-show="role === 'family'" x-transition.opacity class="grid lg:grid-cols-[.8fr_1.2fr]">
                    <div class="bg-[var(--bg-canvas)] p-7 text-[var(--text-primary)] sm:p-10 border-b lg:border-b-0 lg:border-r border-[var(--border-default)]">
                        <span class="inline-flex h-12 w-12 items-center justify-center rounded-[3px] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-[var(--saffron-gold)]">{!! $hiwIcon('home', 'h-6 w-6') !!}</span>
                        <p class="mt-6 text-[10px] font-mono uppercase tracking-[.2em] text-[var(--saffron-gold)]">For the Family</p>
                        <h3 class="mt-2 font-serif text-2xl font-bold text-[var(--text-primary)]">You nurture the new chapter.</h3>
                        <p class="mt-3 text-xs sm:text-sm leading-relaxed text-[var(--text-secondary)]">The platform assists families in seeing a respectful path from first introduction to real-world celebration and temple blessings.</p>
                        <a href="{{ route('about') }}" class="btn-primary mt-6 inline-flex items-center gap-2 text-xs py-2 px-4 font-medium">Learn our principles &rarr;</a>
                    </div>
                    <div class="p-7 sm:p-10 bg-[var(--bg-card)]">
                        <p class="text-xs font-mono uppercase tracking-wider text-[var(--saffron-gold)]">Your four moments</p>
                        <div class="mt-6 space-y-5">
                            <div class="flex gap-4">
                                <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-[3px] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-xs font-mono text-[var(--saffron-gold)]">01</span>
                                <div>
                                    <h4 class="text-xs sm:text-sm font-serif font-bold text-[var(--text-primary)]">Start with context</h4>
                                    <p class="mt-1 text-xs leading-relaxed text-[var(--text-secondary)]">Understand the candidate's Dhamma practice and family background.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-[3px] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-xs font-mono text-[var(--saffron-gold)]">02</span>
                                <div>
                                    <h4 class="text-xs sm:text-sm font-serif font-bold text-[var(--text-primary)]">Respect mutual signals</h4>
                                    <p class="mt-1 text-xs leading-relaxed text-[var(--text-secondary)]">Communication begins only after both seekers agree.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-[3px] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-xs font-mono text-[var(--saffron-gold)]">03</span>
                                <div>
                                    <h4 class="text-xs sm:text-sm font-serif font-bold text-[var(--text-primary)]">Meet with dignity</h4>
                                    <p class="mt-1 text-xs leading-relaxed text-[var(--text-secondary)]">Representative supervision creates a serene first step.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-[3px] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-xs font-mono text-[var(--saffron-gold)]">04</span>
                                <div>
                                    <h4 class="text-xs sm:text-sm font-serif font-bold text-[var(--text-primary)]">Celebrate the union</h4>
                                    <p class="mt-1 text-xs leading-relaxed text-[var(--text-secondary)]">Solemnize with family blessings, Metta, and Mangala Vivaha.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                                    <p class="mt-1 text-xs leading-5 text-[var(--text-secondary)]">Communication begins only after both seekers agree.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-[4px] bg-[var(--accent-primary)]/10 text-xs font-extrabold text-[var(--accent-primary)]">03</span>
                                <div>
                                    <h4 class="text-sm font-bold text-[var(--text-primary)]">Meet with dignity</h4>
                                    <p class="mt-1 text-xs leading-5 text-[var(--text-secondary)]">Representative supervision creates a serene first step.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-[4px] bg-[var(--accent-primary)]/10 text-xs font-extrabold text-[var(--accent-primary)]">04</span>
                                <div>
                                    <h4 class="text-sm font-bold text-[var(--text-primary)]">Celebrate Mangala Vivaha</h4>
                                    <p class="mt-1 text-xs leading-5 text-[var(--text-secondary)]">Transition from platform introduction to joyous matrimony and Sangha blessings.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Journey Steps -->
    <section id="journey" class="bg-[var(--bg-canvas)] py-16 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col justify-between gap-5 sm:flex-row sm:items-end">
                <div class="max-w-2xl">
                    <span class="text-xs font-bold uppercase tracking-[.2em] text-[var(--accent-primary)]">The journey</span>
                    <h2 class="mt-3 font-heading text-3xl font-extrabold tracking-tight text-[var(--text-primary)] sm:text-4xl">From first biodata to Mangala Vivaha</h2>
                </div>
                <p class="max-w-sm text-sm leading-6 text-[var(--text-secondary)]">A measured process ensures sincere intentions stay clear from the first signal to the sacred marriage ceremony.</p>
            </div>

            <div class="relative mt-12 grid gap-5 md:grid-cols-4">
                <div class="absolute left-[10%] right-[10%] top-8 hidden h-px bg-[var(--border-default)] md:block"></div>
                
                <div class="card-ledger relative p-5">
                    <div class="relative z-10 flex h-14 w-14 items-center justify-center rounded-[4px] border border-[var(--border-default)] bg-[var(--bg-subtle)] text-[var(--accent-primary)]">
                        {!! $hiwIcon('identification', 'h-6 w-6') !!}
                    </div>
                    <span class="mt-5 block text-[10px] font-bold uppercase tracking-wider text-[var(--accent-primary)]">Step 01</span>
                    <h3 class="mt-2 font-heading text-lg font-extrabold text-[var(--text-primary)]">Build your biodata</h3>
                    <p class="mt-2 text-xs leading-5 text-[var(--text-secondary)]">Share tradition, meditation practice, lifestyle, and marriage hopes with clarity.</p>
                </div>

                <div class="card-ledger relative p-5">
                    <div class="relative z-10 flex h-14 w-14 items-center justify-center rounded-[4px] border border-[var(--border-default)] bg-[var(--bg-subtle)] text-[var(--accent-primary)]">
                        {!! $hiwIcon('magnifying-glass', 'h-6 w-6') !!}
                    </div>
                    <span class="mt-5 block text-[10px] font-bold uppercase tracking-wider text-[var(--accent-primary)]">Step 02</span>
                    <h3 class="mt-2 font-heading text-lg font-extrabold text-[var(--text-primary)]">Discover mindfully</h3>
                    <p class="mt-2 text-xs leading-5 text-[var(--text-secondary)]">Use Dhamma compatibility scoring to explore candidates beyond superficial appearance.</p>
                </div>

                <div class="card-ledger relative p-5">
                    <div class="relative z-10 flex h-14 w-14 items-center justify-center rounded-[4px] border border-[var(--border-default)] bg-[var(--bg-subtle)] text-[var(--accent-primary)]">
                        {!! $hiwIcon('chat-bubble-left-right', 'h-6 w-6') !!}
                    </div>
                    <span class="mt-5 block text-[10px] font-bold uppercase tracking-wider text-[var(--accent-primary)]">Step 03</span>
                    <h3 class="mt-2 font-heading text-lg font-extrabold text-[var(--text-primary)]">Signal mutual interest</h3>
                    <p class="mt-2 text-xs leading-5 text-[var(--text-secondary)]">No unsolicited messaging. Conversation opens upon mutual interest and representative approvals.</p>
                </div>

                <div class="card-ledger relative p-5">
                    <div class="relative z-10 flex h-14 w-14 items-center justify-center rounded-[4px] border border-[var(--border-default)] bg-[var(--bg-subtle)] text-[var(--accent-primary)]">
                        {!! $hiwIcon('hand-raised', 'h-6 w-6') !!}
                    </div>
                    <span class="mt-5 block text-[10px] font-bold uppercase tracking-wider text-[var(--accent-primary)]">Step 04</span>
                    <h3 class="mt-2 font-heading text-lg font-extrabold text-[var(--text-primary)]">Move with Metta</h3>
                    <p class="mt-2 text-xs leading-5 text-[var(--text-secondary)]">Involve families with joy and take the next step toward a lifelong Mangala Vivaha.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Closing CTA Band -->
    <section class="section--dark py-16 sm:py-20 border-t border-[var(--color-border)]/30">
        <div class="mx-auto flex max-w-5xl flex-col items-center justify-between gap-8 px-4 text-center sm:px-6 lg:flex-row lg:text-left lg:px-8">
            <div class="space-y-2">
                <span class="text-xs font-mono uppercase tracking-[.2em] text-[var(--color-accent)]">Ready When You Are</span>
                <h2 class="font-heading text-2xl sm:text-3xl font-bold tracking-tight text-white">Start with a sincere intention.</h2>
                <p class="max-w-xl text-sm leading-relaxed text-[var(--text-secondary)]">Your matrimonial journey begins with a biodata that reflects who you are, your Dhamma values, and the peaceful partnership you wish to build.</p>
            </div>
            <a href="{{ route('register') }}" class="btn-primary shrink-0 text-xs sm:text-sm px-6 py-3 font-semibold !bg-[var(--color-accent)] !text-[var(--color-ink-dark)] hover:!bg-[var(--color-accent-hover)]">Create your biodata &rarr;</a>
        </div>
    </section>
</div>
@endsection

