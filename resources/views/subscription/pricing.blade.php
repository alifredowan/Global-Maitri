@extends('layouts.app')

@section('title', 'Single Marriage Pass • One-Time Payment Until Vivaha — Global Maitri')
@section('meta_description', 'Compare Global Maitri membership plans and choose a one-time single marriage pass with matrimonial privileges until confirmed Mangala Vivaha.')
@section('canonical_url', route('subscription.pricing'))
@section('robots', 'index, follow')

@section('content')
<div class="py-8 sm:py-12 bg-[var(--bg-canvas)] min-h-[calc(100vh-160px)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

        <!-- Header / Ethical Philosophy -->
        <div class="text-left max-w-3xl space-y-3">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-[var(--radius-xs)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] border border-[var(--border-default)] text-xs font-semibold uppercase tracking-wider">
                <span class="w-1.5 h-1.5 rounded-full bg-[var(--accent-primary)]"></span>
                <span>Membership Plans & Tiers &bull; Single Marriage Pass</span>
            </div>
            <h1 class="font-heading text-2xl sm:text-3xl lg:text-4xl font-bold text-[var(--text-primary)] tracking-tight">
                Single Marriage Pass: Pay Once Until Mangala Vivaha
            </h1>
            <p class="text-sm sm:text-base text-[var(--text-secondary)] leading-relaxed">
                Conventional dating apps profit from keeping people single with endless monthly subscriptions. Global Maitri aligns with your union: pay a single one-time pass fee, and your access remains active until your wedding blessing is celebrated.
            </p>

            <!-- Three Core Pillars -->
            <div class="pt-2 flex flex-wrap items-center gap-2.5 text-xs text-[var(--text-secondary)]">
                <span class="flex items-center gap-1.5 px-3 py-1 rounded-[var(--radius-xs)] bg-[var(--bg-surface)] border border-[var(--border-default)]">
                    <span class="text-[var(--accent-primary)] font-bold">✓</span> No Monthly Renewals
                </span>
                <span class="flex items-center gap-1.5 px-3 py-1 rounded-[var(--radius-xs)] bg-[var(--bg-surface)] border border-[var(--border-default)]">
                    <span class="text-[var(--accent-primary)] font-bold">✓</span> Valid Until Confirmed Mangala Vivaha
                </span>
                <span class="flex items-center gap-1.5 px-3 py-1 rounded-[var(--radius-xs)] bg-[var(--bg-surface)] border border-[var(--border-default)]">
                    <span class="text-[var(--accent-primary)] font-bold">✓</span> Free Family Representative Support
                </span>
            </div>
        </div>

        @if(session('success'))
            <div class="max-w-2xl p-3.5 rounded-[var(--radius-sm)] bg-[var(--bg-surface)] border border-[var(--color-success)] text-[var(--color-success)] text-xs font-medium flex items-center gap-2">
                <span>✓</span> {{ session('success') }}
            </div>
        @endif

        @if(session('info'))
            <div class="max-w-2xl p-3.5 rounded-[var(--radius-sm)] bg-[var(--bg-surface)] border border-[var(--border-default)] text-[var(--accent-primary)] text-xs font-medium flex items-center gap-2">
                <span>ℹ</span> {{ session('info') }}
            </div>
        @endif

        @if(session('warning'))
            <div class="max-w-2xl p-3.5 rounded-[var(--radius-sm)] bg-[var(--bg-surface)] border border-[var(--border-default)] text-[var(--text-primary)] text-xs font-medium flex items-center gap-2">
                <span>⚠️</span> {{ session('warning') }}
            </div>
        @endif

        <!-- Pricing Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-{{ min(4, max(3, count($plans))) }} gap-6 items-stretch">
            @foreach($plans as $plan)
                @php
                    $isCurrent = ($currentPlan === $plan->slug);
                    $isFree = $plan->isFree();
                    $isPopular = (bool) $plan->is_popular;
                @endphp

                <div class="card-monograph p-6 sm:p-7 {{ $isCurrent ? 'border-2 border-[var(--accent-primary)] bg-[var(--bg-surface)]' : ($isPopular ? 'border-2 border-[var(--accent-primary)] bg-[var(--bg-surface)] shadow-xs' : 'border border-[var(--border-default)] bg-[var(--bg-subtle)]') }} relative flex flex-col justify-between">
                    @if($plan->badge_text)
                        <div class="absolute -top-3 left-6 px-2.5 py-0.5 rounded-[var(--radius-xs)] text-[10px] font-semibold uppercase tracking-wider {{ $isPopular ? 'bg-[var(--accent-primary)] text-white' : 'bg-[var(--bg-surface)] text-[var(--text-secondary)] border border-[var(--border-default)]' }}">
                            {{ $plan->badge_text }}
                        </div>
                    @endif

                    <div>
                        <!-- Header badge -->
                        <div class="mb-2">
                            @if($isCurrent)
                                <span class="badge-status text-[10px] bg-[var(--accent-subtle)] text-[var(--accent-primary)] border border-[var(--border-default)]">Your Active Pass</span>
                            @elseif($isFree)
                                <span class="badge-status text-[10px] bg-[var(--bg-surface)] text-[var(--text-secondary)] border border-[var(--border-default)]">Free Forever</span>
                            @else
                                <span class="badge-status text-[10px] bg-[var(--accent-subtle)] text-[var(--accent-primary)] border border-[var(--border-default)]">Single Marriage Pass</span>
                            @endif
                        </div>

                        <h3 class="font-heading text-xl font-bold text-[var(--text-primary)] mt-1">{{ $plan->name }}</h3>
                        <p class="text-xs text-[var(--text-secondary)] mt-1 min-h-[32px] leading-relaxed">{{ $plan->description }}</p>

                        <!-- Price Section -->
                        <div class="my-4 pb-4 border-b border-[var(--border-subtle)]">
                            @if($isFree)
                                <div class="flex items-baseline gap-1.5">
                                    <span class="font-heading text-3xl font-bold text-[var(--text-primary)]">$0</span>
                                    <span class="text-xs text-[var(--text-muted)] font-medium">/ forever free</span>
                                </div>
                                <span class="text-[11px] text-[var(--text-muted)] block mt-1">Available to all verified seekers on basic discovery.</span>
                            @else
                                <div class="space-y-1">
                                    <div class="flex items-baseline gap-2">
                                        <span class="font-heading text-3xl font-bold text-[var(--text-primary)]">${{ number_format($plan->monthly_price, 2) }}</span>
                                        <span class="px-2 py-0.5 rounded-[var(--radius-xs)] text-[10px] font-bold bg-[var(--accent-subtle)] text-[var(--accent-primary)] border border-[var(--accent-primary)]/30">
                                            Pay 1-Time
                                        </span>
                                    </div>
                                    <div class="flex items-center gap-1.5 text-xs font-semibold text-[var(--accent-primary)]">
                                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                                        <span>Active Until Confirmed Mangala Vivaha</span>
                                    </div>
                                    <p class="text-[11px] text-[var(--text-muted)]">
                                        No recurring monthly fees. Valid until your confirmed wedding celebration.
                                    </p>
                                </div>
                            @endif
                        </div>

                        <!-- Feature list -->
                        <ul class="space-y-2 text-xs text-[var(--text-secondary)] pt-1">
                            @if(!empty($plan->features) && count($plan->features) > 0)
                                @foreach($plan->features as $featureItem)
                                    <li class="flex items-start gap-2">
                                        <span class="text-[var(--accent-primary)] font-bold mt-0.5">✓</span>
                                        <span>{{ $featureItem }}</span>
                                    </li>
                                @endforeach
                            @else
                                <li class="flex items-center gap-2">
                                    <span class="text-[var(--accent-primary)] font-bold">✓</span>
                                    <span>{{ $plan->isUnlimitedViews() ? 'Unlimited daily profile views' : $plan->daily_profile_views . ' daily profile views' }}</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="text-[var(--accent-primary)] font-bold">✓</span>
                                    <span>{{ $plan->isUnlimitedInterests() ? 'Unlimited proposal requests' : $plan->daily_interests . ' daily proposal requests' }}</span>
                                </li>
                                @if($plan->advanced_filters)
                                    <li class="flex items-center gap-2">
                                        <span class="text-[var(--accent-primary)] font-bold">✓</span>
                                        <span>Advanced practice filters (tradition, meditation, precepts, diet)</span>
                                    </li>
                                @endif
                                @if($plan->profile_boost)
                                    <li class="flex items-center gap-2 text-[var(--accent-primary)] font-semibold">
                                        <span>✓ Top profile visibility in candidate search</span>
                                    </li>
                                @endif
                                @if($plan->see_who_viewed)
                                    <li class="flex items-center gap-2">
                                        <span class="text-[var(--accent-primary)] font-bold">✓</span>
                                        <span>See who visited your profile</span>
                                    </li>
                                @endif
                                @if($plan->dedicated_advisor)
                                    <li class="flex items-center gap-2 font-semibold text-[var(--text-primary)]">
                                        <span>✓ Dedicated family matrimonial advisor contact</span>
                                    </li>
                                @endif
                            @endif
                        </ul>
                    </div>

                    <!-- CTA Button -->
                    <div class="mt-6 pt-3 border-t border-[var(--border-subtle)]">
                        @if($isCurrent)
                            <button disabled class="btn-secondary w-full text-xs opacity-60 cursor-not-allowed">
                                Current Active Pass
                            </button>
                        @elseif($isFree)
                            @if(Auth::guest())
                                <a href="{{ route('register') }}" class="btn-secondary w-full text-center text-xs !py-2.5 block">
                                    Create profile
                                </a>
                            @else
                                <form action="{{ route('subscription.cancel') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-secondary w-full text-xs !py-2.5 cursor-pointer">
                                        Switch to Free Explorer
                                    </button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('subscription.checkout', $plan->slug) }}" class="btn-primary w-full text-center text-xs !py-2.5 block">
                                Get {{ $plan->name }} (One-Time)
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Ethical Single-Payment Guarantee -->
        <div class="max-w-4xl card-monograph p-6 space-y-3">
            <div class="flex items-start gap-3">
                <div class="w-9 h-9 rounded-[var(--radius-xs)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] flex items-center justify-center font-bold shrink-0">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <div>
                    <h3 class="text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider">Our Single Marriage Guarantee (One-Time Pass Guarantee)</h3>
                    <p class="text-xs text-[var(--text-muted)] mt-1 leading-relaxed">
                        When you purchase a pass, you will never be subjected to unexpected recurring charges. Your account maintains all privileges until you and your spouse confirm your Mangala Vivaha milestone on Global Maitri.
                    </p>
                </div>
            </div>

            <div class="pt-3 border-t border-[var(--border-subtle)] flex flex-wrap items-center justify-between gap-3 text-xs text-[var(--text-secondary)]">
                <div class="flex items-center gap-2">
                    <span class="px-2.5 py-1 rounded-[var(--radius-xs)] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-xs font-medium">
                        Stripe Checkout
                    </span>
                    <span class="px-2.5 py-1 rounded-[var(--radius-xs)] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-xs font-medium">
                        PayPal Express
                    </span>
                </div>
                <div class="text-[11px] text-[var(--text-muted)]">
                    Protected with 256-bit encryption. Zero automatic recurring card deductions.
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
