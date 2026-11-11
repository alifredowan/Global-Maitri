@extends('layouts.app')

@section('title', 'Discover candidates — Global Maitri')
@section('meta_description', 'Browse practicing Buddhist candidates based on shared traditions, meditation rhythm, and family values.')

@section('content')
<div class="py-6 sm:py-8 min-h-[calc(100vh-160px)] bg-[var(--bg-canvas)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6" x-data="{ mobileFilterOpen: false }">

        <!-- Top Header & Usage Bar -->
        <div class="rounded-[var(--radius-lg)] p-5 sm:p-7 bg-[var(--bg-surface)] border border-[var(--border-default)] flex flex-col md:flex-row items-start md:items-center justify-between gap-4 shadow-xs">
            <div class="space-y-1">
                <p class="text-xs font-semibold uppercase tracking-wider text-[var(--accent-primary)]">Candidate directory</p>
                <h1 class="font-heading text-2xl sm:text-3xl font-bold text-[var(--text-primary)]">Explore verified profiles</h1>
                <p class="text-xs sm:text-sm text-[var(--text-secondary)]">
                    Take your time. Every profile is reviewed, and photos stay private until you both agree.
                </p>
            </div>

            <!-- Shortcuts & Pass Status -->
            <div class="flex flex-wrap items-center gap-2 sm:gap-3">
                <a href="{{ route('profile.visitors') }}" class="btn-secondary text-xs !py-1.5 !px-3 flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-[var(--text-muted)]" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><circle cx="12" cy="12" r="3"/></svg>
                    <span>Visitors</span>
                </a>
                <a href="{{ route('bookmarks.index') }}" class="btn-secondary text-xs !py-1.5 !px-3 flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-[var(--accent-primary)]" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    <span>Shortlist</span>
                </a>
                <div class="flex items-center gap-2.5 bg-[var(--bg-subtle)] border border-[var(--border-default)] px-3 py-1.5 rounded-[var(--radius-sm)] text-xs text-[var(--text-secondary)]">
                    <div>
                        <span class="font-semibold text-[var(--text-primary)]">Pass:</span>
                        @if($quotaStats['views_limit'] === 'Unlimited')
                            <span class="text-[var(--accent-primary)] font-semibold ml-1">Single Marriage Pass</span>
                        @else
                            <span class="ml-1">{{ $quotaStats['views_remaining'] }} / {{ $quotaStats['views_limit'] }} daily views</span>
                        @endif
                    </div>
                    @if($quotaStats['plan'] === 'free')
                        <a href="{{ route('subscription.pricing') }}" class="btn-primary text-[10px] !py-0.5 !px-2">
                            Pass details
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Daily Suggestions Row (Aligned with your values) -->
        @if($dailyRecommendations->isNotEmpty())
            <div class="space-y-3">
                <div class="flex items-center justify-between border-b border-[var(--border-subtle)] pb-2">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[var(--accent-primary)]"></span>
                        <h2 class="font-heading text-base font-bold text-[var(--text-primary)]">Suggestions aligned with your practice</h2>
                    </div>
                    <span class="text-xs text-[var(--text-muted)] hidden sm:inline">Shared tradition, meditation &amp; precepts</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($dailyRecommendations as $match)
                        <article class="card-monograph p-4 flex flex-col justify-between">
                            <div>
                                <!-- Top Info -->
                                <div class="flex items-start justify-between gap-3 mb-3">
                                    <div class="flex items-center gap-3 min-w-0">
                                        <div class="relative w-12 h-12 rounded-[var(--radius-xs)] overflow-hidden bg-[var(--bg-subtle)] shrink-0 border border-[var(--border-default)]">
                                            @if($match->primaryPhoto)
                                                <img src="{{ $match->primaryPhoto->displayUrl() }}" alt="{{ $match->user->name }}" class="w-full h-full object-cover photo-blur" loading="lazy">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center bg-[var(--bg-subtle)] text-[var(--accent-primary)] font-bold text-sm">
                                                    {{ substr($match->user->name, 0, 1) }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="min-w-0">
                                            <div class="flex items-center gap-1.5 min-w-0">
                                                <h3 class="font-heading font-bold text-sm text-[var(--text-primary)] truncate">{{ $match->user->name }}</h3>
                                                @if($match->user->is_verified)
                                                    <span class="inline-flex items-center gap-0.5 text-[10px] text-[var(--color-primary)] font-semibold">
                                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                                        Verified
                                                    </span>
                                                @endif
                                            </div>
                                            <p class="text-xs text-[var(--text-muted)] truncate">{{ $match->user->age }} yrs &bull; {{ $match->city }}, {{ $match->country }}</p>
                                            <p class="text-[11px] text-[var(--accent-primary)] font-medium truncate">{{ $match->tradition_label }}</p>
                                        </div>
                                    </div>
                                    <div class="shrink-0 text-right">
                                        <span class="text-[11px] font-semibold text-[var(--accent-primary)] bg-[var(--accent-subtle)] px-2 py-0.5 rounded-[var(--radius-xs)] border border-[var(--border-default)]">
                                            {{ $match->compatibility_score }}% alignment
                                        </span>
                                    </div>
                                </div>

                                <div class="bg-[var(--bg-subtle)] p-2.5 rounded-[var(--radius-xs)] text-xs text-[var(--text-secondary)] line-clamp-2 leading-relaxed mb-3 italic font-serif-accent">
                                    &ldquo;{{ $match->bio ?? 'Committed to Dhamma practice, mindfulness, and building a peaceful family.' }}&rdquo;
                                </div>

                                @if(!empty($match->compatibility_highlights))
                                    <div class="flex flex-wrap gap-1.5 mb-3">
                                        @foreach(array_slice($match->compatibility_highlights, 0, 2) as $highlight)
                                            <span class="inline-flex items-center gap-1 rounded-[var(--radius-xs)] bg-[var(--bg-subtle)] border border-[var(--border-subtle)] px-2 py-0.5 text-[10px] text-[var(--text-muted)]">
                                                {{ $highlight['label'] }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="flex items-center gap-2 pt-2 border-t border-[var(--border-subtle)]">
                                <a href="{{ route('discovery.show', $match->user_id) }}" class="btn-primary flex-1 text-xs !py-1.5 text-center">
                                    View profile
                                </a>
                                @php $isBookmarkedMatch = in_array($match->user_id, $bookmarkedUserIds ?? [], true); @endphp
                                <form action="{{ route('bookmarks.toggle', $match->user_id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" title="{{ $isBookmarkedMatch ? 'Remove from shortlist' : 'Shortlist candidate' }}"
                                            class="btn-secondary !py-1.5 !px-2.5 text-xs {{ $isBookmarkedMatch ? 'text-[var(--accent-primary)]' : '' }}">
                                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="{{ $isBookmarkedMatch ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="1.75"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                    </button>
                                </form>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Active Filter Chips -->
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
            <div class="rounded-[var(--radius-md)] p-3 bg-[var(--bg-surface)] border border-[var(--border-default)] flex flex-wrap items-center justify-between gap-3">
                <div class="flex items-center gap-2 flex-wrap">
                    <span class="text-xs font-semibold text-[var(--text-secondary)]">Active filters:</span>
                    @foreach($activeFilters as $key => $filterLabel)
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-[var(--radius-xs)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] border border-[var(--border-default)] text-xs font-medium">
                            <span>{{ $filterLabel }}</span>
                            @php $removeParams = request()->except($key); @endphp
                            <a href="{{ route('discovery.index', $removeParams) }}" class="hover:text-[var(--text-primary)] cursor-pointer" aria-label="Remove filter">&times;</a>
                        </span>
                    @endforeach
                </div>
                <a href="{{ route('discovery.index') }}" class="text-xs font-medium text-[var(--color-danger)] hover:underline">
                    Reset filters
                </a>
            </div>
        @endif

        <!-- Mobile Filter Drawer Toggle Button -->
        <div class="lg:hidden">
            <button type="button"
                    @click="mobileFilterOpen = !mobileFilterOpen"
                    class="btn-secondary w-full justify-between text-xs font-semibold !py-2.5">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-[var(--accent-primary)]" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z"/></svg>
                    <span>Filters @if($activeFilters->isNotEmpty()) ({{ $activeFilters->count() }} active) @endif</span>
                </span>
                <span x-text="mobileFilterOpen ? '▲ Close' : '▼ Expand'"></span>
            </button>
        </div>

        <!-- Main Discovery Workspace: Filter Sidebar (Left) + Candidate Grid (Right) -->
        <div class="flex flex-col lg:flex-row gap-6 items-start">

            <!-- Filter Sidebar -->
            <aside :class="mobileFilterOpen ? 'block' : 'hidden lg:block'" class="w-full lg:w-72 shrink-0">
                <div class="rounded-[var(--radius-md)] p-5 bg-[var(--bg-surface)] border border-[var(--border-default)] lg:sticky lg:top-20 space-y-4">
                    <div class="flex items-center justify-between border-b border-[var(--border-subtle)] pb-3">
                        <h2 class="text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider flex items-center gap-2">
                            <span>Filter candidates</span>
                        </h2>
                        @if($activeFilters->isNotEmpty())
                            <a href="{{ route('discovery.index') }}" class="text-[11px] font-medium text-[var(--text-muted)] hover:text-[var(--color-danger)]">Reset</a>
                        @endif
                    </div>

                    <form action="{{ route('discovery.index') }}" method="GET" class="space-y-3.5">
                        <input type="hidden" name="sort" value="{{ $sort }}">

                        <!-- Age Range -->
                        <div class="space-y-1">
                            <label class="block text-[11px] text-[var(--text-muted)] uppercase font-semibold tracking-wider">Age range</label>
                            <div class="grid grid-cols-2 gap-2">
                                <input type="number" name="age_min" value="{{ request('age_min') }}" placeholder="Min (18)" min="18" max="80"
                                       class="input-field text-xs !py-1">
                                <input type="number" name="age_max" value="{{ request('age_max') }}" placeholder="Max (80)" min="18" max="80"
                                       class="input-field text-xs !py-1">
                            </div>
                        </div>

                        <!-- Country -->
                        <div class="space-y-1">
                            <label class="block text-[11px] text-[var(--text-muted)] uppercase font-semibold tracking-wider">Location / Country</label>
                            <input type="text" name="country" value="{{ request('country') }}" placeholder="e.g. Sri Lanka, Bangladesh"
                                   class="input-field text-xs !py-1 w-full">
                        </div>

                        <!-- Tradition -->
                        <div class="space-y-1">
                            <label class="block text-[11px] text-[var(--text-muted)] uppercase font-semibold tracking-wider">Tradition</label>
                            <select name="tradition" class="input-field text-xs !py-1 w-full">
                                <option value="">Any tradition</option>
                                @foreach(config('buddhist.traditions') as $code => $label)
                                    <option value="{{ $code }}" {{ request('tradition') === $code ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Meditation Practice -->
                        <div class="space-y-1">
                            <label class="block text-[11px] text-[var(--text-muted)] uppercase font-semibold tracking-wider">Meditation practice</label>
                            <select name="meditation_frequency" class="input-field text-xs !py-1 w-full">
                                <option value="">Any practice level</option>
                                @foreach(config('buddhist.meditation_frequencies') as $code => $label)
                                    <option value="{{ $code }}" {{ request('meditation_frequency') === $code ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Five Precepts -->
                        <div class="space-y-1">
                            <label class="block text-[11px] text-[var(--text-muted)] uppercase font-semibold tracking-wider">Five Precepts (Panca Sila)</label>
                            <select name="panca_sila_adherence" class="input-field text-xs !py-1 w-full">
                                <option value="">Any observance</option>
                                @foreach(config('buddhist.panca_sila_adherence') as $code => $label)
                                    <option value="{{ $code }}" {{ request('panca_sila_adherence') === $code ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Dietary Preference -->
                        <div class="space-y-1">
                            <label class="block text-[11px] text-[var(--text-muted)] uppercase font-semibold tracking-wider">Dietary lifestyle</label>
                            <select name="dietary_preference" class="input-field text-xs !py-1 w-full">
                                <option value="">Any diet</option>
                                @foreach(config('buddhist.dietary_preferences') as $code => $label)
                                    <option value="{{ $code }}" {{ request('dietary_preference') === $code ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Ethnic Community -->
                        <div class="space-y-1">
                            <label class="block text-[11px] text-[var(--text-muted)] uppercase font-semibold tracking-wider">Community (optional)</label>
                            <select name="ethnic_community" class="input-field text-xs !py-1 w-full">
                                <option value="">Any community (No preference)</option>
                                @foreach(config('buddhist.ethnic_communities') as $code => $label)
                                    <option value="{{ $code }}" {{ request('ethnic_community') === $code ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Family Rep Checkbox -->
                        <div class="pt-1">
                            <label class="flex items-center gap-2 text-xs font-medium text-[var(--text-secondary)] cursor-pointer">
                                <input type="checkbox" name="family_rep_required" value="1" {{ request('family_rep_required') ? 'checked' : '' }} class="rounded-[2px] text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                                <span>Family representative linked</span>
                            </label>
                        </div>

                        <button type="submit" class="btn-primary w-full text-xs !py-2 mt-2">
                            Apply filters
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Candidates Results Area (Right) -->
            <main class="flex-1 min-w-0 space-y-4">
                
                <!-- Sort Bar & Save Search Trigger -->
                <div class="rounded-[var(--radius-md)] p-3.5 bg-[var(--bg-surface)] border border-[var(--border-default)] flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div class="flex items-center gap-3">
                        <span class="text-xs font-semibold text-[var(--text-primary)]">{{ $profiles->total() }} candidates found</span>
                        <span class="text-[var(--border-default)] hidden sm:inline">|</span>
                        <button type="button" onclick="document.getElementById('saveSearchModal').classList.remove('hidden')" class="text-xs text-[var(--accent-primary)] hover:underline flex items-center gap-1 cursor-pointer">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z"/></svg>
                            <span>Save this search</span>
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
                        <label for="sort-select" class="text-xs text-[var(--text-muted)]">Sort:</label>
                        <select id="sort-select" name="sort" aria-label="Sort candidate profiles" onchange="this.form.submit()" class="input-field text-xs !py-1 sm:w-52">
                            <option value="newest" {{ $sort === 'newest' ? 'selected' : '' }}>Newest candidates</option>
                            <option value="compatibility" {{ $sort === 'compatibility' ? 'selected' : '' }}>Highest practice alignment</option>
                            <option value="verified" {{ $sort === 'verified' ? 'selected' : '' }}>Verified first</option>
                            <option value="complete" {{ $sort === 'complete' ? 'selected' : '' }}>Detailed profiles</option>
                        </select>
                    </form>
                </div>

                <!-- Saved Searches Strip -->
                @if($savedSearches->isNotEmpty())
                    <div class="rounded-[var(--radius-md)] p-3 bg-[var(--bg-subtle)] border border-[var(--border-default)]">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-[10px] font-semibold uppercase tracking-wider text-[var(--text-muted)]">Saved searches</span>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            @foreach($savedSearches as $savedSearch)
                                @php
                                    $searchFilters = collect($savedSearch->filters ?? [])->filter(fn ($value) => filled($value));
                                    $searchUrl = route('discovery.index', $searchFilters->all());
                                @endphp
                                <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-[var(--radius-xs)] bg-[var(--bg-surface)] border border-[var(--border-default)] text-xs">
                                    <a href="{{ $searchUrl }}" class="font-medium text-[var(--text-primary)] hover:text-[var(--accent-primary)]">
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
                        <article class="card-monograph flex flex-col justify-between group">
                            <div>
                                <!-- Photo Area with Modesty Photo Blur -->
                                <div class="relative h-60 bg-[var(--bg-subtle)] overflow-hidden border-b border-[var(--border-subtle)]">
                                    @if($p->primaryPhoto)
                                        <img src="{{ $p->primaryPhoto->displayUrl() }}" alt="{{ $p->user->name }}" class="w-full h-full object-cover photo-blur group-hover:scale-102 transition duration-300" loading="lazy">
                                    @else
                                        <div class="w-full h-full flex flex-col items-center justify-center text-[var(--text-muted)] gap-1.5">
                                            <div class="w-12 h-12 rounded-full bg-[var(--bg-surface)] border border-[var(--border-default)] flex items-center justify-center font-heading text-base font-semibold text-[var(--accent-primary)]">
                                                {{ strtoupper(substr($p->user->name, 0, 1)) }}
                                            </div>
                                            <span class="text-[10px]">Photo on request</span>
                                        </div>
                                    @endif

                                    <!-- Bottom Privacy Scrim -->
                                    <div class="absolute bottom-2 inset-x-2 px-2.5 py-1.5 rounded-[var(--radius-xs)] bg-black/60 backdrop-blur-xs text-white text-[10px] flex items-center justify-between">
                                        <span class="truncate">Photos stay private until you both agree</span>
                                        @if($p->user->is_verified)
                                            <span class="inline-flex items-center gap-0.5 font-semibold text-[var(--color-primary)] shrink-0 ml-1.5">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                                Verified
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Biodata Details -->
                                <div class="p-4 space-y-2.5">
                                    <div class="flex items-start justify-between gap-2">
                                        <div class="min-w-0">
                                            <p class="text-[10px] font-semibold uppercase tracking-wider text-[var(--accent-primary)] truncate">
                                                {{ $p->tradition_label }}
                                                @if($p->ethnic_community && $p->ethnic_community !== 'no_preference')
                                                    &bull; {{ ucfirst($p->ethnic_community) }}
                                                @endif
                                            </p>
                                            <h3 class="font-heading font-bold text-base text-[var(--text-primary)] truncate">
                                                {{ $p->user->name }}, {{ $p->user->age }}
                                            </h3>
                                            <p class="text-xs text-[var(--text-secondary)] truncate">
                                                {{ $p->profession ?: 'Professional' }}{{ $p->city ? ' &bull; ' . $p->city : '' }}{{ $p->country ? ', ' . $p->country : '' }}
                                            </p>
                                        </div>
                                        @if(isset($p->compatibility_score))
                                            <span class="text-[10px] font-semibold text-[var(--accent-primary)] bg-[var(--accent-subtle)] px-2 py-0.5 rounded-[var(--radius-xs)] border border-[var(--border-default)] shrink-0">
                                                {{ $p->compatibility_score }}% match
                                            </span>
                                        @endif
                                    </div>

                                    <div class="pt-2 border-t border-[var(--border-subtle)] grid grid-cols-2 gap-2 text-[11px] text-[var(--text-muted)]">
                                        <div>Diet: <strong class="text-[var(--text-secondary)] capitalize">{{ $p->dietary_label }}</strong></div>
                                        <div>Practice: <strong class="text-[var(--text-secondary)] capitalize">{{ $p->meditation_frequency_label }}</strong></div>
                                    </div>
                                </div>
                            </div>

                            <!-- CTA Footer -->
                            <div class="p-4 pt-0 flex items-center gap-2">
                                <a href="{{ route('discovery.show', $p->user_id) }}" class="btn-primary flex-1 text-center text-xs !py-2 block">
                                    View profile &rarr;
                                </a>
                                @php $isBookmarkedGrid = in_array($p->user_id, $bookmarkedUserIds ?? [], true); @endphp
                                <form action="{{ route('bookmarks.toggle', $p->user_id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" title="{{ $isBookmarkedGrid ? 'Remove from shortlist' : 'Shortlist candidate' }}"
                                            class="btn-secondary !py-2 !px-2.5 text-xs {{ $isBookmarkedGrid ? 'text-[var(--accent-primary)]' : '' }}">
                                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="{{ $isBookmarkedGrid ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="1.75"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                    </button>
                                </form>
                            </div>
                        </article>
                    @empty
                        <div class="col-span-full py-12 text-center rounded-[var(--radius-md)] bg-[var(--bg-surface)] border border-[var(--border-default)] p-8">
                            <p class="text-sm font-semibold text-[var(--text-primary)]">No candidates matched your filter criteria.</p>
                            <p class="text-xs text-[var(--text-muted)] mt-1">Try widening your location, tradition, or age range.</p>
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
    <div class="rounded-[var(--radius-lg)] bg-[var(--bg-surface)] border border-[var(--border-default)] max-w-md w-full p-6 shadow-xl space-y-4">
        <div>
            <h3 class="font-heading text-base font-bold text-[var(--text-primary)] mb-1">Save search criteria</h3>
            <p class="text-xs text-[var(--text-secondary)]">We will notify you gently when new candidates matching these preferences register.</p>
        </div>
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
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Search title</label>
                <input type="text" name="title" required placeholder="e.g. Practicing Theravada candidates"
                       class="input-field text-xs w-full">
            </div>

            <div class="flex items-center justify-end gap-2 pt-1">
                <button type="button" onclick="document.getElementById('saveSearchModal').classList.add('hidden')" class="btn-secondary text-xs !py-1.5 !px-3.5">Cancel</button>
                <button type="submit" class="btn-primary text-xs !py-1.5 !px-4">Save search</button>
            </div>
        </form>
    </div>
</div>
@endsection
