@extends('layouts.app')

@section('title', 'Discover Buddhist Matches - Global Maitri')

@section('content')
<div class="py-6 min-h-screen bg-[var(--bg-canvas)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6" x-data="{ mobileFilterOpen: false }">

        <!-- Top Header & Usage Quota Indicator -->
        <div class="card-ledger p-5 sm:p-6 bg-[var(--bg-surface)] border border-[var(--border-default)] flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-wider text-[var(--accent-primary)] mb-1">
                    <x-application-logo class="w-3.5 h-3.5 text-[var(--accent-primary)] shrink-0" />
                    <span>Metta Matchmaking</span>
                </div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-[var(--text-primary)] font-heading">Buddhist Match Discovery</h1>
                <p class="text-xs text-[var(--text-secondary)] mt-0.5">Discover practicing Buddhist candidates based on Dhamma values, meditation, precepts, and mindful life goals.</p>
            </div>

            <!-- Quick Pro Shortcuts & Quota Badge -->
            <div class="flex flex-wrap items-center gap-2 sm:gap-3">
                <a href="{{ route('profile.visitors') }}" class="btn-secondary text-xs !py-1.5 !px-3 flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-[var(--text-muted)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                    <span>Visitors</span>
                </a>
                <a href="{{ route('bookmarks.index') }}" class="btn-secondary text-xs !py-1.5 !px-3 flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-[var(--accent-primary)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    <span>Shortlist</span>
                </a>
                <div class="flex items-center gap-2.5 bg-[var(--bg-subtle)] border border-[var(--border-default)] px-3.5 py-1.5 rounded-[var(--radius-sm)] text-xs">
                    <div>
                        <span class="font-bold text-[var(--text-primary)]">Pass:</span>
                        @if($quotaStats['views_limit'] === 'Unlimited')
                            <span class="text-[var(--accent-primary)] font-semibold ml-1">Single Marriage Pass (Unlimited)</span>
                        @else
                            <span class="text-[var(--text-secondary)] font-medium ml-1">
                                {{ $quotaStats['views_remaining'] }} / {{ $quotaStats['views_limit'] }} daily views
                            </span>
                        @endif
                    </div>
                    @if($quotaStats['plan'] === 'free')
                        <a href="{{ route('subscription.pricing') }}" class="btn-primary text-[10px] !py-1 !px-2.5">
                            Upgrade
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Algorithmic Daily Matches Carousel/Row (FR-3.2, 6.4) -->
        @if($dailyRecommendations->isNotEmpty())
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[var(--accent-primary)]"></span>
                        <h2 class="text-base font-bold text-[var(--text-primary)] font-heading">Ranked Daily Suggestions (Dhamma Compatibility)</h2>
                    </div>
                    <span class="text-xs text-[var(--text-muted)] font-medium hidden sm:inline">Dhamma-weighted compatibility matching (FR-6.4)</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($dailyRecommendations as $match)
                        <article class="card-ledger p-4 bg-[var(--bg-surface)] border border-[var(--border-default)] flex flex-col justify-between hover:border-[var(--accent-primary)] transition">
                            <div>
                                <!-- Top Card Header with Avatar, Info & Badges -->
                                <div class="flex items-start justify-between gap-2.5 mb-3">
                                    <div class="flex items-center gap-3 min-w-0">
                                        <div class="relative w-12 h-12 rounded-[var(--radius-sm)] overflow-hidden bg-[var(--neutral-900)] shrink-0 border border-[var(--border-default)]">
                                            @if($match->primaryPhoto)
                                                <img src="{{ $match->primaryPhoto->displayUrl() }}" alt="{{ $match->user->name }}" class="w-full h-full object-cover photo-shield" loading="lazy" decoding="async">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center bg-[var(--bg-subtle)] text-[var(--accent-primary)] font-bold text-lg">
                                                    {{ substr($match->user->name, 0, 1) }}
                                                </div>
                                            @endif
                                            <span class="absolute inset-0 flex items-center justify-center bg-black/40 text-[9px] text-white font-bold">🔒 Shield</span>
                                        </div>
                                        <div class="min-w-0">
                                            <div class="flex items-center gap-1.5 min-w-0">
                                                <h3 class="font-bold text-sm text-[var(--text-primary)] truncate">{{ $match->user->name }}</h3>
                                                @if($match->user->is_verified)
                                                    <span class="badge-verified text-[10px] !py-0 !px-1.5">Verified</span>
                                                @endif
                                            </div>
                                            <p class="text-xs text-[var(--text-muted)] truncate">{{ $match->user->age }} yrs &bull; {{ $match->city }}, {{ $match->country }}</p>
                                            <p class="text-[11px] text-[var(--accent-primary)] font-semibold truncate">{{ $match->tradition_label }}</p>
                                        </div>
                                    </div>
                                    <div class="shrink-0 flex flex-col items-end gap-1">
                                        <span class="badge-status text-[11px] font-bold bg-[var(--accent-subtle)] text-[var(--accent-primary)] border border-[var(--accent-primary)]/30 whitespace-nowrap">
                                            {{ $match->compatibility_score }}% Match
                                        </span>
                                        @if($match->user->isPro())
                                            <span class="text-[9px] font-extrabold uppercase px-1.5 py-0.5 rounded-[var(--radius-sm)] bg-[var(--accent-primary)] text-white" title="Single Marriage Pass">
                                                PRO
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="bg-[var(--bg-subtle)] p-2.5 rounded-[var(--radius-sm)] text-xs text-[var(--text-secondary)] line-clamp-2 overflow-hidden mb-3">
                                    {{ $match->bio ?? 'Committed to Dhamma practice, mindfulness, and building a peaceful family.' }}
                                </div>
                                @if(!empty($match->compatibility_highlights))
                                    <div class="flex flex-wrap gap-1.5 mb-3">
                                        @foreach(array_slice($match->compatibility_highlights, 0, 2) as $highlight)
                                            <span class="inline-flex items-center gap-1 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-subtle)] px-2 py-0.5 text-[10px] font-semibold text-[var(--text-secondary)]" title="{{ $highlight['detail'] }}">
                                                {{ $highlight['label'] }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div class="flex items-center gap-2 pt-2 border-t border-[var(--border-subtle)]">
                                <a href="{{ route('discovery.show', $match->user_id) }}" class="btn-primary flex-1 text-xs !py-1.5 text-center">
                                    View Full Profile
                                </a>
                                @php $isBookmarkedMatch = in_array($match->user_id, $bookmarkedUserIds ?? [], true); @endphp
                                <form action="{{ route('bookmarks.toggle', $match->user_id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" title="{{ $isBookmarkedMatch ? 'Remove from shortlist' : 'Shortlist candidate for family review' }}"
                                            class="btn-secondary !py-1.5 !px-2.5 text-xs {{ $isBookmarkedMatch ? 'text-[var(--accent-primary)] border-[var(--accent-primary)]' : '' }}">
                                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="{{ $isBookmarkedMatch ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                    </button>
                                </form>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Active Filter Chips & Reset Bar (Visible if filters applied) -->
        @php
            $activeFilters = collect([
                'age_min' => request('age_min') ? 'Min Age: ' . request('age_min') : null,
                'age_max' => request('age_max') ? 'Max Age: ' . request('age_max') : null,
                'country' => request('country') ? 'Country: ' . request('country') : null,
                'tradition' => request('tradition') ? 'Tradition: ' . ucfirst(request('tradition')) : null,
                'meditation_frequency' => request('meditation_frequency') ? 'Meditation: ' . ucfirst(str_replace('_', ' ', request('meditation_frequency'))) : null,
                'panca_sila_adherence' => request('panca_sila_adherence') ? 'Precepts: ' . ucfirst(str_replace('_', ' ', request('panca_sila_adherence'))) : null,
                'dietary_preference' => request('dietary_preference') ? 'Diet: ' . ucfirst(request('dietary_preference')) : null,
                'ethnic_community' => request('ethnic_community') ? 'Community: ' . ucfirst(request('ethnic_community')) : null,
                'family_rep_required' => request('family_rep_required') ? 'Family Rep Linked' : null,
            ])->filter();
        @endphp

        @if($activeFilters->isNotEmpty())
            <div class="card-ledger p-3 bg-[var(--bg-surface)] border border-[var(--border-default)] flex flex-wrap items-center justify-between gap-3">
                <div class="flex items-center gap-2 flex-wrap">
                    <span class="text-xs font-bold text-[var(--text-secondary)]">Active Filters:</span>
                    @foreach($activeFilters as $key => $filterLabel)
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-[var(--radius-sm)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] border border-[var(--accent-primary)]/30 text-xs font-medium">
                            <span>{{ $filterLabel }}</span>
                            @php
                                $removeParams = request()->except($key);
                            @endphp
                            <a href="{{ route('discovery.index', $removeParams) }}" class="hover:text-[var(--text-primary)] cursor-pointer" aria-label="Remove filter">&times;</a>
                        </span>
                    @endforeach
                </div>
                <a href="{{ route('discovery.index') }}" class="text-xs font-semibold text-[var(--color-danger)] hover:underline">
                    Reset all filters
                </a>
            </div>
        @endif

        <!-- Mobile Filter Drawer Toggle Button (Visible on mobile/tablet) -->
        <div class="lg:hidden">
            <button type="button"
                    @click="mobileFilterOpen = !mobileFilterOpen"
                    class="btn-secondary w-full justify-between text-xs font-bold !py-2.5">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-[var(--accent-primary)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="21" x2="14" y1="4" y2="4"/><line x1="10" x2="3" y1="4" y2="4"/><line x1="21" x2="12" y1="12" y2="12"/><line x1="8" x2="3" y1="12" y2="12"/><line x1="21" x2="16" y1="20" y2="20"/><line x1="12" x2="3" y1="20" y2="20"/><line x1="14" x2="14" y1="2" y2="6"/><line x1="8" x2="8" y1="10" y2="14"/><line x1="16" x2="16" y1="18" y2="22"/></svg>
                    <span>Filter Directory @if($activeFilters->isNotEmpty()) ({{ $activeFilters->count() }} Active) @endif</span>
                </span>
                <span x-text="mobileFilterOpen ? '▲' : '▼'"></span>
            </button>
        </div>

        <!-- Main Discovery Workspace: Filter Sidebar (Left) + Candidate Grid (Right) -->
        <div class="flex flex-col lg:flex-row gap-6 items-start">

            <!-- Filter Sidebar (Desktop Sticky + Mobile Drawer) -->
            <aside :class="mobileFilterOpen ? 'block' : 'hidden lg:block'" class="w-full lg:w-72 shrink-0">
                <div class="card-ledger p-5 bg-[var(--bg-surface)] border border-[var(--border-default)] lg:sticky lg:top-20 space-y-4">
                    <div class="flex items-center justify-between border-b border-[var(--border-subtle)] pb-3">
                        <h2 class="text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider flex items-center gap-2">
                            <svg class="w-4 h-4 text-[var(--accent-primary)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                            <span>Filter Candidates</span>
                        </h2>
                        @if($activeFilters->isNotEmpty())
                            <a href="{{ route('discovery.index') }}" class="text-[11px] font-semibold text-[var(--text-muted)] hover:text-[var(--color-danger)]">Reset</a>
                        @endif
                    </div>

                    <form action="{{ route('discovery.index') }}" method="GET" class="space-y-4">
                        <!-- Keep Sort Order -->
                        <input type="hidden" name="sort" value="{{ $sort }}">

                        <!-- Age Range -->
                        <div class="space-y-1.5">
                            <label class="block text-[10px] text-[var(--text-muted)] uppercase font-bold tracking-wider">Age Range</label>
                            <div class="grid grid-cols-2 gap-2">
                                <input type="number" name="age_min" value="{{ request('age_min') }}" placeholder="Min (18)" min="18" max="80"
                                       class="input-field text-xs !h-8 !py-1">
                                <input type="number" name="age_max" value="{{ request('age_max') }}" placeholder="Max (80)" min="18" max="80"
                                       class="input-field text-xs !h-8 !py-1">
                            </div>
                        </div>

                        <!-- Country -->
                        <div class="space-y-1.5">
                            <label class="block text-[10px] text-[var(--text-muted)] uppercase font-bold tracking-wider">Country</label>
                            <input type="text" name="country" value="{{ request('country') }}" placeholder="e.g. Sri Lanka, Thailand"
                                   class="input-field text-xs !h-8 !py-1 w-full">
                        </div>

                        <!-- Tradition -->
                        <div class="space-y-1.5">
                            <label class="block text-[10px] text-[var(--text-muted)] uppercase font-bold tracking-wider">Buddhist Tradition</label>
                            <select name="tradition" class="input-field text-xs !h-8 !py-1 w-full">
                                <option value="">Any Tradition</option>
                                @foreach(config('buddhist.traditions') as $code => $label)
                                    <option value="{{ $code }}" {{ request('tradition') === $code ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Meditation Frequency -->
                        <div class="space-y-1.5">
                            <label class="block text-[10px] text-[var(--text-muted)] uppercase font-bold tracking-wider">Meditation Practice</label>
                            <select name="meditation_frequency" class="input-field text-xs !h-8 !py-1 w-full">
                                <option value="">Any Practice Level</option>
                                @foreach(config('buddhist.meditation_frequencies') as $code => $label)
                                    <option value="{{ $code }}" {{ request('meditation_frequency') === $code ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Five Precepts (Panca Sila) -->
                        <div class="space-y-1.5">
                            <label class="block text-[10px] text-[var(--text-muted)] uppercase font-bold tracking-wider">Five Precepts (Panca Sila)</label>
                            <select name="panca_sila_adherence" class="input-field text-xs !h-8 !py-1 w-full">
                                <option value="">Any Observance</option>
                                @foreach(config('buddhist.panca_sila_adherence') as $code => $label)
                                    <option value="{{ $code }}" {{ request('panca_sila_adherence') === $code ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Dietary Preference -->
                        <div class="space-y-1.5">
                            <label class="block text-[10px] text-[var(--text-muted)] uppercase font-bold tracking-wider">Dietary Lifestyle</label>
                            <select name="dietary_preference" class="input-field text-xs !h-8 !py-1 w-full">
                                <option value="">Any Diet</option>
                                @foreach(config('buddhist.dietary_preferences') as $code => $label)
                                    <option value="{{ $code }}" {{ request('dietary_preference') === $code ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Ethnic Community -->
                        <div class="space-y-1.5">
                            <label class="block text-[10px] text-[var(--text-muted)] uppercase font-bold tracking-wider">Ethnic Community</label>
                            <select name="ethnic_community" class="input-field text-xs !h-8 !py-1 w-full">
                                <option value="">Any Community (No preference)</option>
                                @foreach(config('buddhist.ethnic_communities') as $code => $label)
                                    <option value="{{ $code }}" {{ request('ethnic_community') === $code ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Family Rep Checkbox -->
                        <div class="pt-1">
                            <label class="flex items-center gap-2 text-xs font-semibold text-[var(--text-secondary)] cursor-pointer">
                                <input type="checkbox" name="family_rep_required" value="1" {{ request('family_rep_required') ? 'checked' : '' }} class="rounded-[2px] text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                                <span>Family Representative Linked</span>
                            </label>
                        </div>

                        <button type="submit" class="btn-primary w-full text-xs !py-2.5 mt-2 flex items-center justify-center gap-2">
                            <span>Apply Filters</span>
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Candidates Results Area (Right) -->
            <main class="flex-1 min-w-0 space-y-4">
                
                <!-- Sort Bar & Save Search Trigger -->
                <div class="card-ledger p-3.5 bg-[var(--bg-surface)] border border-[var(--border-default)] flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div class="flex items-center gap-3">
                        <span class="text-xs font-bold text-[var(--text-primary)]">Found {{ $profiles->total() }} Profiles</span>
                        <span class="text-[var(--border-default)] hidden sm:inline">|</span>
                        <button type="button" onclick="document.getElementById('saveSearchModal').classList.remove('hidden')" class="text-xs font-semibold text-[var(--accent-primary)] hover:underline flex items-center gap-1 cursor-pointer">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                            <span>Save this Search</span>
                        </button>
                    </div>

                    <form action="{{ route('discovery.index') }}" method="GET" class="flex items-center gap-2">
                        @foreach(request()->except('sort') as $k => $v)
                            @if(is_array($v))
                                @foreach($v as $sub)
                                    <input type="hidden" name="{{ $k }}[]" value="{{ $sub }}">
                                @endforeach
                            @elseif(filled($v))
                                <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                            @endif
                        @endforeach
                        <label for="sort-select" class="text-xs text-[var(--text-muted)] font-medium">Sort:</label>
                        <select id="sort-select" name="sort" aria-label="Sort candidate profiles" onchange="this.form.submit()" class="input-field text-xs !h-8 !py-1 sm:w-52">
                            <option value="newest" {{ $sort === 'newest' ? 'selected' : '' }}>Newest profiles</option>
                            <option value="compatibility" {{ $sort === 'compatibility' ? 'selected' : '' }}>Highest Dhamma compatibility</option>
                            <option value="verified" {{ $sort === 'verified' ? 'selected' : '' }}>Verified first</option>
                            <option value="complete" {{ $sort === 'complete' ? 'selected' : '' }}>Most complete profiles</option>
                        </select>
                    </form>
                </div>

                <!-- Saved Searches Quick Strip -->
                @if($savedSearches->isNotEmpty())
                    <div class="card-ledger p-3 bg-[var(--bg-subtle)] border border-[var(--border-default)]">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-muted)]">Saved Search Shortcuts ({{ $savedSearches->count() }})</span>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            @foreach($savedSearches as $savedSearch)
                                @php
                                    $searchFilters = collect($savedSearch->filters ?? [])->filter(fn ($value) => filled($value));
                                    $searchUrl = route('discovery.index', $searchFilters->all());
                                @endphp
                                <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-[var(--radius-sm)] bg-[var(--bg-surface)] border border-[var(--border-default)] text-xs">
                                    <a href="{{ $searchUrl }}" class="font-semibold text-[var(--text-primary)] hover:text-[var(--accent-primary)]">
                                        {{ $savedSearch->title }}
                                    </a>
                                    <form action="{{ route('discovery.saved-searches.destroy', $savedSearch->id) }}" method="POST" onsubmit="return confirm('Remove this saved search?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" aria-label="Remove {{ $savedSearch->title }}" class="text-[var(--text-muted)] hover:text-[var(--color-danger)] leading-none">&times;</button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Candidate Profiles Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">
                    @forelse($profiles as $p)
                        <article class="card-ledger flex flex-col justify-between overflow-hidden group bg-[var(--bg-surface)] border border-[var(--border-default)] hover:border-[var(--accent-primary)] transition">
                            <div>
                                <!-- Photo Area with Modesty Photo Shield -->
                                <div class="relative h-56 bg-[var(--neutral-900)] overflow-hidden">
                                    @if($p->primaryPhoto)
                                        <img src="{{ $p->primaryPhoto->displayUrl() }}" alt="{{ $p->user->name }}" class="w-full h-full object-cover photo-shield group-hover:scale-102 transition duration-300" loading="lazy" decoding="async">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-[var(--bg-subtle)] text-[var(--accent-primary)] font-bold text-3xl">
                                            {{ substr($p->user->name, 0, 1) }}
                                        </div>
                                    @endif

                                    <!-- Top Badges -->
                                    <div class="absolute top-2.5 inset-x-2.5 flex items-center justify-between pointer-events-none">
                                        <div class="flex items-center gap-1.5">
                                            <span class="badge-status bg-black/70 text-white border border-white/15 text-[10px] backdrop-blur-xs flex items-center gap-1">
                                                <svg class="w-3 h-3 text-[var(--accent-primary)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                                <span>Shielded</span>
                                            </span>
                                            @if($p->user->is_verified)
                                                <span class="badge-verified bg-black/70 text-white border border-white/20 text-[10px] backdrop-blur-xs">
                                                    <span>✓</span> Verified
                                                </span>
                                            @endif
                                            @if($p->user->isPro())
                                                <span class="text-[9px] font-extrabold uppercase px-1.5 py-0.5 rounded-[var(--radius-sm)] bg-[var(--accent-primary)] text-white">
                                                    PRO
                                                </span>
                                            @endif
                                        </div>
                                        @if(isset($p->compatibility_score))
                                            <span class="badge-status bg-black/70 text-white border border-white/15 text-[10px] backdrop-blur-xs font-bold">
                                                {{ $p->compatibility_score }}% Match
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Bottom Scrim Info -->
                                    <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent p-3.5 text-white">
                                        <div class="flex items-center justify-between gap-1.5">
                                            <h3 class="font-heading font-bold text-sm text-white truncate">
                                                {{ $p->user->name }}
                                            </h3>
                                            <span class="text-[9px] px-1.5 py-0.5 rounded-[var(--radius-sm)] bg-white/20 backdrop-blur-xs text-white font-medium border border-white/20 shrink-0">
                                                {{ ucfirst(str_replace('_', ' ', $p->marital_status ?? $p->user->marital_status ?? 'Single')) }}
                                            </span>
                                        </div>
                                        <p class="text-[11px] text-[var(--neutral-300)] mt-0.5 truncate">
                                            {{ $p->user->age }} yrs &bull; {{ $p->height_cm ? round($p->height_cm / 30.48, 1) . ' ft &bull; ' : '' }}{{ $p->city ?? 'Location flexible' }}, {{ $p->country ?? '' }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Biodata Ledger Matrix -->
                                <div class="p-3.5 space-y-2 border-b border-[var(--border-subtle)]">
                                    <div class="grid grid-cols-2 gap-2 text-xs">
                                        <div>
                                            <span class="text-[10px] uppercase font-bold text-[var(--text-muted)] tracking-wider block">Tradition</span>
                                            <span class="font-semibold text-[var(--text-primary)] truncate block">{{ $p->tradition_label }}</span>
                                        </div>
                                        <div>
                                            <span class="text-[10px] uppercase font-bold text-[var(--text-muted)] tracking-wider block">Meditation</span>
                                            <span class="font-semibold text-[var(--text-primary)] truncate block">{{ $p->meditation_frequency_label }}</span>
                                        </div>
                                        <div>
                                            <span class="text-[10px] uppercase font-bold text-[var(--text-muted)] tracking-wider block">Diet</span>
                                            <span class="font-semibold text-[var(--text-primary)] truncate block">{{ $p->dietary_label }}</span>
                                        </div>
                                        <div>
                                            <span class="text-[10px] uppercase font-bold text-[var(--text-muted)] tracking-wider block">Family Rep</span>
                                            <span class="font-semibold truncate block {{ $p->family_rep_required ? 'text-[var(--accent-primary)]' : 'text-[var(--text-secondary)]' }}">
                                                {{ $p->family_rep_required ? 'Linked' : 'Independent' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Primary & Secondary CTA Footer -->
                            <div class="p-3.5 flex items-center gap-2">
                                <a href="{{ route('discovery.show', $p->user_id) }}" class="btn-primary flex-1 text-center text-xs !py-2 block">
                                    <span>View Profile</span>
                                    <span class="text-[10px] ml-1">&rarr;</span>
                                </a>
                                @php $isBookmarkedGrid = in_array($p->user_id, $bookmarkedUserIds ?? [], true); @endphp
                                <form action="{{ route('bookmarks.toggle', $p->user_id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" title="{{ $isBookmarkedGrid ? 'Remove from shortlist' : 'Shortlist candidate for family review' }}"
                                            class="btn-secondary !py-2 !px-2.5 text-xs {{ $isBookmarkedGrid ? 'text-[var(--accent-primary)] border-[var(--accent-primary)]' : '' }}">
                                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="{{ $isBookmarkedGrid ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                    </button>
                                </form>
                            </div>
                        </article>
                    @empty
                        <div class="col-span-full py-12 text-center card-ledger bg-[var(--bg-surface)] border border-[var(--border-default)]">
                            <p class="text-sm text-[var(--text-primary)] font-semibold">No candidates matched your filter criteria.</p>
                            <p class="text-xs text-[var(--text-muted)] mt-1">Try widening your age range, tradition, or location filters.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="pt-4">
                    {{ $profiles->links() }}
                </div>
            </main>

        </div>

    </div>
</div>

<!-- Save Search Modal -->
<div id="saveSearchModal" class="hidden fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
    <div class="card-ledger bg-[var(--bg-surface)] border border-[var(--border-default)] max-w-md w-full p-6 shadow-2xl">
        <h3 class="text-base font-bold text-[var(--text-primary)] mb-1 font-heading">Save Search Criteria</h3>
        <p class="text-xs text-[var(--text-secondary)] mb-4">You will receive notifications whenever new candidates matching your current filters join Global Maitri (FR-3.3).</p>
        <form action="{{ route('discovery.save-search') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="country" value="{{ request('country') }}">
            <input type="hidden" name="age_min" value="{{ request('age_min') }}">
            <input type="hidden" name="age_max" value="{{ request('age_max') }}">
            <input type="hidden" name="city" value="{{ request('city') }}">
            <input type="hidden" name="tradition" value="{{ request('tradition') }}">
            <input type="hidden" name="meditation_frequency" value="{{ request('meditation_frequency') }}">
            <input type="hidden" name="dietary_preference" value="{{ request('dietary_preference') }}">
            <input type="hidden" name="ethnic_community" value="{{ request('ethnic_community') }}">
            <input type="hidden" name="marital_status" value="{{ request('marital_status') }}">
            <input type="hidden" name="family_rep_required" value="{{ request('family_rep_required') }}">

            <div>
                <label class="block text-xs font-bold text-[var(--text-primary)] mb-1">Search Title</label>
                <input type="text" name="title" required placeholder="e.g. Practicing Theravada in Sri Lanka"
                       class="input-field text-xs w-full">
            </div>

            <div class="flex items-center justify-end gap-2 pt-2">
                <button type="button" onclick="document.getElementById('saveSearchModal').classList.add('hidden')" class="btn-secondary text-xs !py-1.5 !px-3.5">Cancel</button>
                <button type="submit" class="btn-primary text-xs !py-1.5 !px-4">Save Search</button>
            </div>
        </form>
    </div>
</div>
@endsection
