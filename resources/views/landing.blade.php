@extends('layouts.app')

@section('title', 'Global Maitri - Buddhist Matrimonial Platform | Kindness first. Companionship for life.')
@section('meta_description', 'Find a mindful Buddhist life partner through Global Maitri, with verified profiles, family representative support, privacy-first photo controls, and Dhamma-centric compatibility.')
@section('canonical_url', route('landing'))
@section('robots', 'index, follow')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6 space-y-12 sm:space-y-16">

    <!-- ================================================================= -->
    <!-- 1. HERO SECTION: SERENE CURVED BANNER WITH LOTUS ACCENTS         -->
    <!-- ================================================================= -->
    <div class="relative overflow-hidden rounded-3xl sm:rounded-[2.5rem] bg-gradient-to-br from-rose-950 via-[#260b14] to-slate-950 text-white p-8 sm:p-12 lg:p-16 shadow-2xl border border-rose-800/40">
        <!-- Subtle Ambient Glow & Dot Matrix Texture -->
        <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px] pointer-events-none"></div>
        <div class="absolute -right-20 -top-20 w-80 h-80 bg-rose-500/15 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -left-20 -bottom-20 w-80 h-80 bg-amber-500/15 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 max-w-4xl mx-auto text-center space-y-6">
            <!-- Heritage Pill -->
            <div class="inline-flex items-center space-x-2 px-4 py-1.5 rounded-full bg-rose-500/20 border border-rose-400/40 text-rose-200 text-xs font-bold uppercase tracking-widest shadow-sm">
                <span>🌸</span>
                <span>Mindful Intentions • Mangala Vivaha • Global Buddhist Community</span>
            </div>

            <!-- Heading -->
            <h1 class="font-heading font-extrabold text-3xl sm:text-5xl lg:text-6xl text-white tracking-wide leading-tight">
                Find Your Life Partner with <span class="text-amber-400">Loving-Kindness (Metta)</span> &amp; <span class="text-rose-400">Family Harmony</span>
            </h1>

            <!-- Subheading -->
            <p class="text-sm sm:text-base lg:text-lg text-rose-100/90 max-w-3xl mx-auto leading-relaxed">
                <strong>Global Maitri</strong> is a mindful Buddhist matrimonial platform built for serious marriage and spiritual companionship. Featuring <strong>verified identities</strong>, <strong>family representative support</strong>, <strong>photo privacy controls</strong>, and <strong>Dhamma-weighted compatibility</strong>.
            </p>

            <!-- Hero Action Buttons -->
            <div class="flex flex-wrap items-center justify-center gap-3 pt-4">
                <a href="{{ route('register') }}" class="px-8 py-4 rounded-xl font-bold text-sm sm:text-base text-slate-950 bg-amber-400 hover:bg-amber-300 shadow-xl shadow-amber-950/30 transition transform hover:-translate-y-0.5 flex items-center space-x-2">
                    <span>🌸</span>
                    <span>Create Free Profile</span>
                </a>
                <a href="{{ route('discovery.index') }}" class="px-7 py-4 rounded-xl bg-white/10 hover:bg-white/15 text-white border border-white/20 font-bold text-sm transition">
                    Browse Verified Candidates &rarr;
                </a>
                <a href="{{ route('login') }}" class="px-6 py-4 rounded-xl text-rose-200/80 hover:text-white font-semibold text-xs transition">
                    Sign In to Portal &rarr;
                </a>
            </div>

            <!-- Trust Highlights Strip -->
            <div class="pt-8 border-t border-rose-800/40 grid grid-cols-2 sm:grid-cols-5 gap-3 text-[11px] text-rose-100/90 font-medium">
                <div class="p-3 rounded-2xl bg-rose-950/60 border border-rose-800/40 text-center">
                    <span class="block text-lg mb-1">🪪</span>
                    <strong class="text-white block">100% ID KYC</strong>
                    <span class="block text-[10px] text-rose-300/80 mt-0.5">Government ID Verification</span>
                </div>
                <div class="p-3 rounded-2xl bg-rose-950/60 border border-rose-800/40 text-center">
                    <span class="block text-lg mb-1">👨‍👩‍👦</span>
                    <strong class="text-white block">Family Support</strong>
                    <span class="block text-[10px] text-rose-300/80 mt-0.5">Representative for Both Genders</span>
                </div>
                <div class="p-3 rounded-2xl bg-rose-950/60 border border-rose-800/40 text-center">
                    <span class="block text-lg mb-1">🔒</span>
                    <strong class="text-white block">Photo Privacy</strong>
                    <span class="block text-[10px] text-rose-300/80 mt-0.5">Customizable Blur Controls</span>
                </div>
                <div class="p-3 rounded-2xl bg-rose-950/60 border border-rose-800/40 text-center">
                    <span class="block text-lg mb-1">☸️</span>
                    <strong class="text-white block">Dhamma Matched</strong>
                    <span class="block text-[10px] text-rose-300/80 mt-0.5">Precepts &amp; Meditation Weighted</span>
                </div>
                <div class="p-3 rounded-2xl bg-rose-950/60 border border-rose-800/40 text-center col-span-2 sm:col-span-1">
                    <span class="block text-lg mb-1">💎</span>
                    <strong class="text-white block">Single Marriage Pass</strong>
                    <span class="block text-[10px] text-rose-300/80 mt-0.5">Active Until Confirmed Wedding</span>
                </div>
            </div>
        </div>
    </div>

    <!-- ================================================================= -->
    <!-- 2. CORE PILLARS OF BUDDHIST MATRIMONY                             -->
    <!-- ================================================================= -->
    <div class="bg-white dark:bg-slate-900 rounded-3xl p-8 sm:p-12 border border-slate-200/80 dark:border-slate-800 shadow-sm space-y-10">
        <div class="text-center max-w-3xl mx-auto space-y-3">
            <span class="text-xs font-bold uppercase tracking-wider text-rose-700 dark:text-rose-400">Buddhist Matrimonial Values</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight font-heading">
                Mindful Companionship Built on Metta &amp; Respect
            </h2>
            <p class="text-sm sm:text-base text-slate-600 dark:text-slate-400 leading-relaxed">
                Global Maitri is founded on the Buddhist understanding of marriage as a social union of loving-kindness, harmony, and mutual spiritual support.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Pillar 1 -->
            <div class="bg-slate-50 dark:bg-slate-800/60 rounded-2xl p-6 border border-slate-100 dark:border-slate-800 shadow-xs hover:border-rose-500/50 smooth-card transition">
                <div class="w-12 h-12 rounded-xl bg-rose-100 dark:bg-rose-950 text-rose-800 dark:text-rose-300 flex items-center justify-center text-2xl mb-4">
                    👨‍👩‍👦
                </div>
                <h3 class="text-base font-bold text-slate-900 dark:text-white mb-2 font-heading">Family Representative System</h3>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                    Available for both grooms and brides. Link a parent, sibling, or trusted elder to review suitors, approve proposals, and assist with family oversight.
                </p>
            </div>

            <!-- Pillar 2 -->
            <div class="bg-slate-50 dark:bg-slate-800/60 rounded-2xl p-6 border border-slate-100 dark:border-slate-800 shadow-xs hover:border-rose-500/50 smooth-card transition">
                <div class="w-12 h-12 rounded-xl bg-amber-100 dark:bg-amber-950 text-amber-800 dark:text-amber-300 flex items-center justify-center text-2xl mb-4">
                    🔒
                </div>
                <h3 class="text-base font-bold text-slate-900 dark:text-white mb-2 font-heading">Photo &amp; Data Privacy</h3>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                    Full privacy controls: public, blurred until interest accepted, or visible on request. Sensitive income and horoscopes can be shielded from non-matches.
                </p>
            </div>

            <!-- Pillar 3 -->
            <div class="bg-slate-50 dark:bg-slate-800/60 rounded-2xl p-6 border border-slate-100 dark:border-slate-800 shadow-xs hover:border-rose-500/50 smooth-card transition">
                <div class="w-12 h-12 rounded-xl bg-emerald-100 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-300 flex items-center justify-center text-2xl mb-4">
                    ☸️
                </div>
                <h3 class="text-base font-bold text-slate-900 dark:text-white mb-2 font-heading">Dhamma-Weighted Match Score</h3>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                    Match candidates based on tradition (Theravada, Mahayana, Vajrayana, Navayana), meditation depth, Panca Sila observance, and dietary lifestyle.
                </p>
            </div>

            <!-- Pillar 4 -->
            <div class="bg-slate-50 dark:bg-slate-800/60 rounded-2xl p-6 border border-slate-100 dark:border-slate-800 shadow-xs hover:border-rose-500/50 smooth-card transition">
                <div class="w-12 h-12 rounded-xl bg-purple-100 dark:bg-purple-950 text-purple-800 dark:text-purple-300 flex items-center justify-center text-2xl mb-4">
                    🛡️
                </div>
                <h3 class="text-base font-bold text-slate-900 dark:text-white mb-2 font-heading">No Caste &amp; Anti-Dowry Shield</h3>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                    Strict adherence to Buddhist equality: caste is completely eliminated. Dowry demands and commercial transactions are strictly blocked and prohibited.
                </p>
            </div>
        </div>
    </div>

    <!-- ================================================================= -->
    <!-- 3. HOW IT WORKS (4 MINDFUL STEPS TO MANGALA VIVAHA)              -->
    <!-- ================================================================= -->
    <div class="bg-white dark:bg-slate-900 rounded-3xl p-8 sm:p-12 border border-slate-200/80 dark:border-slate-800 shadow-sm space-y-8">
        <div class="text-center max-w-2xl mx-auto space-y-2">
            <span class="text-xs font-bold uppercase tracking-wider text-amber-700 dark:text-amber-400">Streamlined Process</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white font-heading">
                Four Mindful Steps to Your Wedding Blessing
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 relative">
            <!-- Step 1 -->
            <div class="p-6 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-100 dark:border-slate-800 space-y-3 relative text-center sm:text-left smooth-card">
                <span class="text-3xl font-black text-rose-600/30 dark:text-rose-400/20 font-mono">01</span>
                <h3 class="text-base font-bold text-slate-900 dark:text-white font-heading">Create Mindful Biodata</h3>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                    Detail your tradition, meditation practice, Panca Sila adherence, and lifestyle preferences. Photos remain blurred by default.
                </p>
            </div>

            <!-- Step 2 -->
            <div class="p-6 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-100 dark:border-slate-800 space-y-3 relative text-center sm:text-left smooth-card">
                <span class="text-3xl font-black text-amber-600/30 dark:text-amber-400/20 font-mono">02</span>
                <h3 class="text-base font-bold text-slate-900 dark:text-white font-heading">Involve Family Representative</h3>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                    Optionally link a parent, elder, or relative. Every suitor proposal can be reviewed respectfully with family wisdom.
                </p>
            </div>

            <!-- Step 3 -->
            <div class="p-6 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-100 dark:border-slate-800 space-y-3 relative text-center sm:text-left smooth-card">
                <span class="text-3xl font-black text-emerald-600/30 dark:text-emerald-400/20 font-mono">03</span>
                <h3 class="text-base font-bold text-slate-900 dark:text-white font-heading">Mindful Chat &amp; Meeting</h3>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                    Communicate only after mutual acceptance. Protected by privacy filters, contact shielding, and polite communication guidelines.
                </p>
            </div>

            <!-- Step 4 -->
            <div class="p-6 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-100 dark:border-slate-800 space-y-3 relative text-center sm:text-left smooth-card">
                <span class="text-3xl font-black text-purple-600/30 dark:text-purple-400/20 font-mono">04</span>
                <h3 class="text-base font-bold text-slate-900 dark:text-white font-heading">Mangala Vivaha Celebration</h3>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                    Confirm your marriage milestone! Receive your digital Metta Blessing certificate ("May you be happy and well") and retire your active profile.
                </p>
            </div>
        </div>
    </div>

    <!-- ================================================================= -->
    <!-- 4. RECENT CANDIDATE PROFILES SHOWCASE                             -->
    <!-- ================================================================= -->
    @if($recentProfiles->isNotEmpty())
        <div class="bg-white dark:bg-slate-900 rounded-3xl p-8 sm:p-12 border border-slate-200/80 dark:border-slate-800 shadow-sm space-y-8">
            <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between gap-4">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-rose-700 dark:text-rose-400">Verified Community</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white font-heading">Recent Buddhist Candidates</h2>
                </div>
                <a href="{{ route('discovery.index') }}" class="text-xs sm:text-sm font-bold text-rose-700 dark:text-rose-400 hover:text-rose-800 dark:hover:text-rose-300 flex items-center gap-1.5 transition">
                    View all candidates &rarr;
                </a>
            </div>

            <!-- Responsive Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 justify-center">
                @foreach($recentProfiles as $profile)
                    @php
                        $loc = collect([$profile->city, $profile->country])->filter()->implode(', ');
                    @endphp
                    <div class="bg-slate-50 dark:bg-slate-800/60 rounded-2xl border border-slate-100 dark:border-slate-800 overflow-hidden shadow-xs hover:border-rose-500/50 smooth-card transition group flex flex-col justify-between">
                        <!-- Photo / Avatar Area with Modesty Scrim -->
                        <div class="relative h-52 bg-slate-900 overflow-hidden">
                            @if($profile->primaryPhoto)
                                <img src="{{ $profile->primaryPhoto->displayUrl() }}" alt="{{ $profile->user->name }}" class="w-full h-full object-cover photo-blur group-hover:scale-105 transition transform duration-500 ease-out" loading="lazy" decoding="async">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-rose-950 to-slate-900 text-white font-bold text-3xl group-hover:scale-105 transition duration-500 ease-out">
                                    {{ substr($profile->user->name, 0, 1) }}
                                </div>
                            @endif

                            <!-- Ambient Gradient Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent"></div>

                            <!-- Top Badges -->
                            <div class="absolute top-2.5 inset-x-2.5 flex items-center justify-between">
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-black/60 text-rose-200 border border-rose-400/30 backdrop-blur-xs flex items-center gap-1 shadow-xs">
                                    🔒 Photo Privacy
                                </span>
                                @if($profile->user->is_verified)
                                    <span class="bg-rose-900/90 backdrop-blur-xs text-rose-200 text-[10px] font-bold px-2 py-0.5 rounded-full border border-rose-400/40 flex items-center gap-1 shadow-xs">
                                        ✓ Verified
                                    </span>
                                @endif
                            </div>

                            <!-- Bottom Info Overlay -->
                            <div class="absolute bottom-2.5 inset-x-3 text-white space-y-0.5">
                                <p class="text-[10px] font-semibold text-amber-300">
                                    {{ ucfirst(str_replace('_', ' ', $profile->tradition ?? 'Buddhist')) }}
                                    @if($profile->ethnic_community && $profile->ethnic_community !== 'no_preference')
                                        • {{ ucfirst($profile->ethnic_community) }}
                                    @endif
                                </p>
                                <h4 class="font-bold text-base truncate font-heading">{{ $profile->user->name }}</h4>
                                <p class="text-[11px] text-slate-200">
                                    {{ $profile->user->age }} yrs{{ $loc ? ' • ' . $loc : '' }}
                                </p>
                            </div>
                        </div>

                        <!-- Card Details & Action -->
                        <div class="p-3.5 space-y-3">
                            <div class="flex items-center justify-between text-xs text-slate-600 dark:text-slate-400">
                                <span>🧘 {{ str_replace('_', ' ', $profile->meditation_frequency ?? 'Practicing') }}</span>
                                <span>🥗 {{ ucfirst($profile->dietary_preference ?? 'Vegetarian') }}</span>
                            </div>
                            <a href="{{ route('discovery.show', $profile->user_id) }}" class="block text-center w-full py-2.5 rounded-xl bg-slate-900 dark:bg-slate-700 hover:bg-rose-600 dark:hover:bg-rose-600 text-white text-xs font-bold transition shadow-xs">
                                View Profile &rarr;
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- ================================================================= -->
    <!-- 5. PRICING SECTION: SINGLE MARRIAGE PASS (FR-10.1, FR-10.2)       -->
    <!-- ================================================================= -->
    <div class="bg-white dark:bg-slate-900 rounded-3xl p-8 sm:p-12 border border-slate-200/80 dark:border-slate-800 shadow-sm space-y-10">
        <div class="text-center max-w-3xl mx-auto space-y-3">
            <span class="text-xs font-bold uppercase tracking-wider text-amber-700 dark:text-amber-400">Fair &amp; Transparent Membership</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight font-heading">
                Pro Single Marriage Pass — Never Monthly Subscriptions
            </h2>
            <p class="text-sm sm:text-base text-slate-600 dark:text-slate-400 leading-relaxed">
                Core matching and family representative support are always free. Upgrade once for unlimited daily views, advanced Dhamma filters, and candidate insights until your confirmed wedding.
            </p>
        </div>

        <!-- 3 Pricing Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto items-stretch">
            @foreach($plans as $plan)
                @php
                    $isFree = $plan->isFree();
                    $isPopular = (bool) $plan->is_popular;
                @endphp
                <div class="bg-slate-50 dark:bg-slate-800/60 rounded-3xl p-6 sm:p-8 {{ $isPopular ? 'border-2 border-rose-600 dark:border-rose-500 shadow-xl relative' : 'border border-slate-200 dark:border-slate-800 shadow-xs' }} flex flex-col justify-between h-full smooth-card">

                    <div>
                        <!-- Top Badge Pill -->
                        <div class="flex items-center justify-between mb-4">
                            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $isFree ? 'bg-slate-200/80 dark:bg-slate-800 text-slate-700 dark:text-slate-300' : ($isPopular ? 'bg-rose-100 dark:bg-rose-950/80 text-rose-800 dark:text-rose-300' : 'bg-amber-100 dark:bg-amber-950/80 text-amber-800 dark:text-amber-300') }}">
                                {{ $isFree ? 'Free Forever' : ($isPopular ? '★ Most Popular' : 'VIP Tier') }}
                            </span>
                            @if($plan->badge_text && !$isPopular)
                                <span class="text-[10px] font-extrabold uppercase tracking-wider px-2 py-0.5 rounded-full bg-slate-200 dark:bg-slate-800 text-slate-600 dark:text-slate-400">
                                    {{ $plan->badge_text }}
                                </span>
                            @endif
                        </div>

                        <h3 class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-white font-heading">{{ $plan->name }}</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 leading-relaxed">{{ $plan->description }}</p>

                        <!-- Pricing Value -->
                        <div class="my-6">
                            @if($isFree)
                                <div class="flex items-baseline gap-1.5">
                                    <span class="text-4xl font-extrabold text-slate-900 dark:text-white font-heading">$0</span>
                                    <span class="text-xs text-slate-500 dark:text-slate-400 font-semibold">/ forever free</span>
                                </div>
                                <span class="text-[11px] text-slate-400 dark:text-slate-500 block mt-1">Always available for seekers on basic matching.</span>
                            @else
                                <div class="flex items-baseline gap-2">
                                    <span class="text-4xl font-extrabold text-slate-900 dark:text-white font-heading">${{ number_format($plan->monthly_price, 2) }}</span>
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-rose-100 dark:bg-rose-950 text-rose-800 dark:text-rose-300">
                                        Pay Once
                                    </span>
                                </div>
                                <div class="flex items-center gap-1.5 text-xs font-bold text-rose-700 dark:text-rose-400 mt-1.5">
                                    <span>🌸</span>
                                    <span>Active Until Confirmed Wedding</span>
                                </div>
                                <p class="text-[10px] text-slate-400 dark:text-slate-500 mt-0.5">
                                    No recurring monthly charges. Valid until your Mangala Vivaha.
                                </p>
                            @endif
                        </div>

                        <!-- Features List -->
                        <ul class="space-y-2.5 text-xs sm:text-sm text-slate-600 dark:text-slate-300 border-t border-slate-200/80 dark:border-slate-800 pt-5">
                            @if(!empty($plan->features) && count($plan->features) > 0)
                                @foreach($plan->features as $featureItem)
                                    <li class="flex items-center gap-2">
                                        <span class="text-rose-600 dark:text-rose-400 font-bold">✓</span>
                                        <span>{{ preg_replace('/\s*\(FR-[^\)]+\)/', '', $featureItem) }}</span>
                                    </li>
                                @endforeach
                            @else
                                <li class="flex items-center gap-2">
                                    <span class="text-rose-600 font-bold">✓</span>
                                    <span>{{ $plan->isUnlimitedViews() ? 'Unlimited daily profile views' : $plan->daily_profile_views . ' daily profile views' }}</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="text-rose-600 font-bold">✓</span>
                                    <span>{{ $plan->isUnlimitedInterests() ? 'Unlimited interest requests' : $plan->daily_interests . ' daily interest requests' }}</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="text-rose-600 font-bold">✓</span>
                                    <span>Family representative support for both genders</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="text-rose-600 font-bold">✓</span>
                                    <span>Default photo privacy protection</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="text-rose-600 font-bold">✓</span>
                                    <span>Advanced Dhamma &amp; meditation filters</span>
                                </li>
                            @endif
                        </ul>
                    </div>

                    <!-- CTA Button -->
                    <div class="mt-8 pt-4">
                        @if($isFree)
                            <a href="{{ route('register') }}" class="block text-center w-full py-3.5 rounded-xl bg-slate-200 dark:bg-slate-800 hover:bg-slate-300 dark:hover:bg-slate-700 text-slate-800 dark:text-white text-xs font-bold transition">
                                Get Started Free
                            </a>
                        @else
                            <a href="{{ route('subscription.checkout', $plan->slug) }}" class="block text-center w-full py-3.5 rounded-xl {{ $isPopular ? 'bg-rose-600 hover:bg-rose-700 text-white shadow-md shadow-rose-900/20' : 'bg-slate-900 dark:bg-slate-700 hover:bg-black dark:hover:bg-slate-600 text-white' }} text-xs font-bold transition">
                                Choose {{ trim(Str::before($plan->name, '(')) ?: $plan->name }} &rarr;
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- ================================================================= -->
    <!-- 6. FREQUENTLY ASKED QUESTIONS (FAQ ACCORDION)                    -->
    <!-- ================================================================= -->
    <div class="bg-white dark:bg-slate-900 rounded-3xl p-8 sm:p-12 border border-slate-200/80 dark:border-slate-800 shadow-sm space-y-8"
         x-data="{ activeFaq: null }">
        <div class="text-center space-y-2 max-w-3xl mx-auto">
            <span class="text-xs font-bold uppercase tracking-wider text-rose-700 dark:text-rose-400">Common Questions</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white font-heading">
                Frequently Asked Questions
            </h2>
        </div>

        <div class="space-y-3 max-w-4xl mx-auto">
            <!-- FAQ 1 -->
            <div class="rounded-2xl bg-slate-50 dark:bg-slate-800/80 border border-slate-200/80 dark:border-slate-700/60 overflow-hidden shadow-xs">
                <button type="button"
                        @click="activeFaq = (activeFaq === 1 ? null : 1)"
                        class="w-full p-5 text-left font-bold text-sm text-slate-900 dark:text-white flex items-center justify-between gap-4 cursor-pointer">
                    <span>How does the Single Marriage Pass work?</span>
                    <span class="text-rose-600 dark:text-rose-400 text-lg transition transform" :class="activeFaq === 1 ? 'rotate-180' : ''">&darr;</span>
                </button>
                <div x-show="activeFaq === 1" x-collapse class="px-5 pb-5 text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed border-t border-slate-100 dark:border-slate-700/60 pt-3">
                    You pay once for your single marriage pass. There are zero recurring monthly charges or hidden renewal fees. Your pass remains active until you successfully find your partner and confirm your marriage milestone on the platform.
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="rounded-2xl bg-slate-50 dark:bg-slate-800/80 border border-slate-200/80 dark:border-slate-700/60 overflow-hidden shadow-xs">
                <button type="button"
                        @click="activeFaq = (activeFaq === 2 ? null : 2)"
                        class="w-full p-5 text-left font-bold text-sm text-slate-900 dark:text-white flex items-center justify-between gap-4 cursor-pointer">
                    <span>Is there any caste filter on Global Maitri?</span>
                    <span class="text-rose-600 dark:text-rose-400 text-lg transition transform" :class="activeFaq === 2 ? 'rotate-180' : ''">&darr;</span>
                </button>
                <div x-show="activeFaq === 2" x-collapse class="px-5 pb-5 text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed border-t border-slate-100 dark:border-slate-700/60 pt-3">
                    No. In accordance with the teachings of the Buddha, caste is entirely rejected. There are no caste fields. We provide only an optional cultural/ethnic community field (e.g., Barua, Chakma, Sinhalese, Thai, Burmese, Ambedkarite, Tibetan, Newar) with a "No preference" option.
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="rounded-2xl bg-slate-50 dark:bg-slate-800/80 border border-slate-200/80 dark:border-slate-700/60 overflow-hidden shadow-xs">
                <button type="button"
                        @click="activeFaq = (activeFaq === 3 ? null : 3)"
                        class="w-full p-5 text-left font-bold text-sm text-slate-900 dark:text-white flex items-center justify-between gap-4 cursor-pointer">
                    <span>How does the Family Representative system work?</span>
                    <span class="text-rose-600 dark:text-rose-400 text-lg transition transform" :class="activeFaq === 3 ? 'rotate-180' : ''">&darr;</span>
                </button>
                <div x-show="activeFaq === 3" x-collapse class="px-5 pb-5 text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed border-t border-slate-100 dark:border-slate-700/60 pt-3">
                    Candidates of either gender can optionally link a parent, sibling, or trusted elder relative. Representatives get their own free dashboard where they can review proposals, assist with respectful introductions, or chaperone chat conversations according to your preference.
                </div>
            </div>

            <!-- FAQ 4 -->
            <div class="rounded-2xl bg-slate-50 dark:bg-slate-800/80 border border-slate-200/80 dark:border-slate-700/60 overflow-hidden shadow-xs">
                <button type="button"
                        @click="activeFaq = (activeFaq === 4 ? null : 4)"
                        class="w-full p-5 text-left font-bold text-sm text-slate-900 dark:text-white flex items-center justify-between gap-4 cursor-pointer">
                    <span>What is the platform's policy on dowry and married users?</span>
                    <span class="text-rose-600 dark:text-rose-400 text-lg transition transform" :class="activeFaq === 4 ? 'rotate-180' : ''">&darr;</span>
                </button>
                <div x-show="activeFaq === 4" x-collapse class="px-5 pb-5 text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed border-t border-slate-100 dark:border-slate-700/60 pt-3">
                    Global Maitri strictly upholds monogamy; currently married individuals are completely barred from registering. Furthermore, dowry demands are illegal under Bangladesh and India laws and are strictly blocked and flagged across all communication. Divorced and widowed candidates are welcomed with equal dignity and compassion.
                </div>
            </div>
        </div>
    </div>

    <!-- ================================================================= -->
    <!-- 7. BOTTOM CALL TO ACTION BANNER                                  -->
    <!-- ================================================================= -->
    <div class="rounded-3xl sm:rounded-[2.5rem] bg-gradient-to-r from-rose-950 via-rose-900 to-slate-950 text-white p-8 sm:p-12 lg:p-14 shadow-xl border border-rose-800/40 relative overflow-hidden text-center space-y-6">
        <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px] pointer-events-none"></div>
        <div class="relative z-10 max-w-3xl mx-auto space-y-4">
            <h2 class="text-2xl sm:text-4xl font-extrabold font-heading tracking-tight">
                Begin Your Journey to a Blessed Mangala Vivaha
            </h2>
            <p class="text-sm sm:text-base text-rose-200/80 max-w-xl mx-auto leading-relaxed">
                "May you be happy and well." Experience dignified matchmaking designed with loving-kindness, family harmony, and ethical mindful living.
            </p>
            <div class="flex flex-wrap items-center justify-center gap-4 pt-2">
                <a href="{{ route('register') }}" class="px-8 py-3.5 rounded-xl font-bold text-sm text-slate-950 bg-amber-400 hover:bg-amber-300 shadow-xl transition transform hover:-translate-y-0.5">
                    Create Free Profile &rarr;
                </a>
                <a href="{{ route('about') }}" class="px-8 py-3.5 rounded-xl font-semibold text-sm text-white bg-rose-900/80 hover:bg-rose-800 border border-rose-700/60 transition">
                    Learn More About Global Maitri
                </a>
            </div>
        </div>
    </div>

</div>
@endsection
