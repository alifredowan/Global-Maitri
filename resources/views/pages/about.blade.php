@extends('layouts.app')

@section('title', 'About Us - Global Maitri | Mindful Buddhist Matrimonial Platform')
@section('meta_description', 'Learn how Global Maitri supports mindful Buddhist matchmaking through verified identities, family involvement, Lotus privacy, Dhamma compatibility, and a lifelong Mangala Vivaha commitment.')
@section('canonical_url', route('about'))
@section('robots', 'index, follow')

@section('content')
<div class="min-h-screen bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-200 py-10 sm:py-16">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">

        <!-- Header Hero -->
        <div class="text-center space-y-4">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-rose-100 dark:bg-rose-950/80 border border-rose-300 dark:border-rose-800 text-rose-800 dark:text-rose-300 text-xs font-bold uppercase tracking-wider">
                <span>🪷</span>
                <span>Our Mindful Mission</span>
            </div>
            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold text-slate-900 dark:text-white font-heading tracking-tight leading-[1.15]">
                Built for <span class="text-rose-600 dark:text-rose-400">Mangala Vivaha</span>. Grounded in <span class="text-amber-500">Dhamma &amp; Metta</span>.
            </h1>
            <p class="text-sm sm:text-base text-slate-600 dark:text-slate-400 max-w-2xl mx-auto leading-relaxed">
                Global Maitri was founded to heal modern matchmaking by eliminating commercial dating toxicity, superficial swiping culture, caste bias, and dowry demands—nurturing lifelong companionship founded on loving-kindness.
            </p>
        </div>

        <!-- Buddhist Blessing Callout Card -->
        <div class="relative overflow-hidden p-8 sm:p-12 rounded-3xl bg-slate-900 text-white border border-rose-900/60 shadow-2xl text-center space-y-4">
            <div class="text-amber-400 text-2xl font-serif">☸️ नमो तस्स भगवतो अरहतो सम्मासम्बुद्धस्स</div>
            <blockquote class="text-base sm:text-xl font-light italic text-rose-100/90 max-w-3xl mx-auto leading-relaxed">
                &ldquo;Live in harmony, with mutual respect, free from wrath and arrogance; cherish one another as a mother guards her only child with her life.&rdquo;
            </blockquote>
            <p class="text-xs font-bold text-amber-300 tracking-wider uppercase">— Karaniya Metta Sutta &amp; Mangala Sutta</p>
        </div>

        <!-- The Problem vs Our Solution -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Modern Dating Problem -->
            <div class="p-8 rounded-3xl bg-white dark:bg-slate-900 border border-rose-200/60 dark:border-rose-950 shadow-sm space-y-4">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-rose-50 dark:bg-rose-950 text-rose-700 dark:text-rose-400 text-xs font-bold">
                    <span>❌</span> The Modern Dating Trap
                </div>
                <h3 class="text-xl font-bold text-slate-900 dark:text-white font-heading">
                    Perpetual Subscriptions &amp; Surface Swipes
                </h3>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                    Mainstream dating apps thrive on keeping seekers single. They charge monthly renewal fees, encourage superficial swiping, exclude families, foster ghosting, and encourage unverified interactions without accountability.
                </p>
                <ul class="space-y-2 text-xs text-rose-700 dark:text-rose-400/90 font-medium pt-2">
                    <li class="flex items-center gap-2"><span>✕</span> Endless monthly subscription loops designed to keep you searching</li>
                    <li class="flex items-center gap-2"><span>✕</span> Caste classifications, dowry discussions, and commercialized vanity</li>
                    <li class="flex items-center gap-2"><span>✕</span> Zero family or spiritual elder involvement in decision-making</li>
                </ul>
            </div>

            <!-- Global Maitri Solution -->
            <div class="p-8 rounded-3xl bg-white dark:bg-slate-900 border border-rose-300/60 dark:border-rose-800 shadow-sm space-y-4">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-rose-50 dark:bg-rose-950 text-rose-700 dark:text-rose-400 text-xs font-bold">
                    <span>✓</span> The Global Maitri Difference
                </div>
                <h3 class="text-xl font-bold text-slate-900 dark:text-white font-heading">
                    Single Marriage Pass &amp; Dhamma Integrity
                </h3>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                    Every feature is built around the noble pursuit of Mangala Vivaha. You pay once until your confirmed marriage, photos are protected with Lotus Modesty, caste bias is strictly rejected, and families are warmly welcomed.
                </p>
                <ul class="space-y-2 text-xs text-rose-700 dark:text-rose-400 font-medium pt-2">
                    <li class="flex items-center gap-2"><span>✓</span> Pay 1-Time until confirmed Mangala Vivaha; no monthly renewal traps</li>
                    <li class="flex items-center gap-2"><span>✓</span> Lotus Modesty Shield: photos blurred until mutual interest or consent</li>
                    <li class="flex items-center gap-2"><span>✓</span> Transparent Family Representative guidance for both grooms and brides</li>
                </ul>
            </div>
        </div>

        <!-- 4 Founding Pillars -->
        <div class="space-y-8">
            <div class="text-center max-w-xl mx-auto space-y-2">
                <span class="text-xs font-bold uppercase tracking-wider text-rose-700 dark:text-rose-400">Our Four Pillars</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white font-heading">
                    Grounded in the Buddha's Noble Teaching
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-xs hover:border-rose-500/50 transition space-y-3">
                    <div class="w-12 h-12 rounded-xl bg-rose-100 dark:bg-rose-950/80 text-rose-700 dark:text-rose-400 flex items-center justify-center text-2xl">
                        🪷
                    </div>
                    <h4 class="font-bold text-base text-slate-900 dark:text-white">Lotus Modesty</h4>
                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                        Photos are sheltered by default with an artistic lotus blur. Seekers evaluate inner qualities, Dhamma practice, and character first.
                    </p>
                </div>

                <div class="p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-xs hover:border-rose-500/50 transition space-y-3">
                    <div class="w-12 h-12 rounded-xl bg-amber-100 dark:bg-amber-950/80 text-amber-700 dark:text-amber-400 flex items-center justify-center text-2xl">
                        👨‍👩‍👧
                    </div>
                    <h4 class="font-bold text-base text-slate-900 dark:text-white">Family Representatives</h4>
                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                        Parents, siblings, trusted elders, or Sangha advisors can be linked with granular permissions for both men and women.
                    </p>
                </div>

                <div class="p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-xs hover:border-rose-500/50 transition space-y-3">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 dark:bg-emerald-950/80 text-emerald-700 dark:text-emerald-400 flex items-center justify-center text-2xl">
                        ☸️
                    </div>
                    <h4 class="font-bold text-base text-slate-900 dark:text-white">Dhamma Alignment</h4>
                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                        Compatibility scoring based on Buddhist tradition, meditation practice, Five Precepts (Panca Sila) observance, and mindful living.
                    </p>
                </div>

                <div class="p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-xs hover:border-rose-500/50 transition space-y-3">
                    <div class="w-12 h-12 rounded-xl bg-purple-100 dark:bg-purple-950/80 text-purple-700 dark:text-purple-400 flex items-center justify-center text-2xl">
                        🪪
                    </div>
                    <h4 class="font-bold text-base text-slate-900 dark:text-white">KYC Verified Profiles</h4>
                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                        Every serious seeker is verified against government ID credentials and photo liveness checks to maintain a trusted community.
                    </p>
                </div>
            </div>
        </div>

        <!-- Trust Stats Banner -->
        <div class="bg-white dark:bg-slate-900 rounded-3xl p-8 border border-slate-200/80 dark:border-slate-800 shadow-sm">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center divide-y md:divide-y-0 md:divide-x divide-slate-100 dark:divide-slate-800">
                <div class="p-4">
                    <div class="text-3xl font-extrabold text-rose-600 dark:text-rose-400 font-heading">Casteless</div>
                    <div class="text-xs text-slate-500 dark:text-slate-400 mt-1">Equal Dignity for All</div>
                </div>
                <div class="p-4">
                    <div class="text-3xl font-extrabold text-amber-500 font-heading">Pay 1-Time</div>
                    <div class="text-xs text-slate-500 dark:text-slate-400 mt-1">Valid Until Mangala Vivaha</div>
                </div>
                <div class="p-4">
                    <div class="text-3xl font-extrabold text-slate-900 dark:text-white font-heading">Zero Dowry</div>
                    <div class="text-xs text-slate-500 dark:text-slate-400 mt-1">Strict Anti-Dowry Shield</div>
                </div>
                <div class="p-4">
                    <div class="text-3xl font-extrabold text-emerald-600 dark:text-emerald-400 font-heading">Mindful</div>
                    <div class="text-xs text-slate-500 dark:text-slate-400 mt-1">Metta-First Community</div>
                </div>
            </div>
        </div>

        <!-- Bottom Action -->
        <div class="p-8 sm:p-12 rounded-3xl bg-slate-900 text-white border border-rose-900/80 text-center space-y-6 shadow-2xl">
            <div class="max-w-2xl mx-auto space-y-2">
                <h3 class="text-2xl sm:text-3xl font-extrabold font-heading">
                    Begin Your Auspicious Journey Today
                </h3>
                <p class="text-xs sm:text-sm text-rose-100/90 leading-relaxed">
                    Join Buddhist seekers across Theravada, Mahayana, Vajrayana, Navayana, and mindful traditions taking the noble path toward marriage with peace, respect, and family blessings.
                </p>
            </div>
            <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('register') }}" class="px-8 py-3.5 rounded-xl bg-amber-400 hover:bg-amber-300 text-slate-950 text-sm font-bold transition shadow-lg shadow-amber-950/20">
                    Create Mindful Profile
                </a>
                <a href="{{ route('discovery.index') }}" class="px-8 py-3.5 rounded-xl bg-rose-900/80 hover:bg-rose-800 text-white text-sm font-semibold border border-rose-700/60 transition">
                    Browse Candidates
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
