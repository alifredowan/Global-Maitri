@extends('layouts.app')

@section('title', 'Manage Subscription Packages - Admin')
@section('page_title', 'Dynamic Packages')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-8" x-data="{
    displayFilter: 'all',
    showCreateModal: false,
    showEditModal: false,
    editPackage: {
        id: null,
        name: '',
        slug: '',
        description: '',
        monthly_price: 0,
        annual_price: 0,
        daily_profile_views: 10,
        daily_interests: 5,
        advanced_filters: false,
        profile_boost: false,
        see_who_viewed: false,
        dedicated_advisor: false,
        badge_text: '',
        features_text: '',
        is_active: true,
        is_popular: false,
        sort_order: 0
    },
    openEdit(pkg) {
        this.editPackage = {
            id: pkg.id,
            name: pkg.name,
            slug: pkg.slug,
            description: pkg.description || '',
            monthly_price: pkg.monthly_price,
            annual_price: pkg.annual_price,
            daily_profile_views: pkg.daily_profile_views,
            daily_interests: pkg.daily_interests,
            advanced_filters: !!pkg.advanced_filters,
            profile_boost: !!pkg.profile_boost,
            see_who_viewed: !!pkg.see_who_viewed,
            dedicated_advisor: !!pkg.dedicated_advisor,
            badge_text: pkg.badge_text || '',
            features_text: Array.isArray(pkg.features) ? pkg.features.join('\n') : '',
            is_active: !!pkg.is_active,
            is_popular: !!pkg.is_popular,
            sort_order: pkg.sort_order || 0
        };
        this.showEditModal = true;
    }
}">
    <div class="max-w-7xl mx-auto space-y-8">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[var(--bg-subtle)] border border-[var(--border-default)] text-[var(--accent-primary)] text-xs font-bold uppercase tracking-wider mb-2">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>
                    <span>Membership & Quota Management</span>
                </div>
                <h1 class="text-2xl font-extrabold text-[var(--text-primary)] font-heading">Dynamic Subscription Packages</h1>
                <p class="text-xs text-[var(--text-muted)] mt-0.5">Setup, configure, and price subscription tiers with granular quotas and feature flags.</p>
            </div>
            <div class="flex items-center gap-2">
                <button @click="showCreateModal = true" class="btn-primary text-xs flex items-center gap-1.5 cursor-pointer">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    <span>Create New Package</span>
                </button>
            </div>
        </div>

        @if(session('success'))
            <div class="p-4 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-200 text-xs font-semibold flex items-center gap-2 shadow-xs">
                <svg class="w-4 h-4 shrink-0 text-emerald-600 dark:text-emerald-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="p-4 rounded-xl bg-rose-50 dark:bg-rose-950/60 border border-rose-200 dark:border-rose-800 text-rose-800 dark:text-rose-200 text-xs font-semibold flex items-center gap-2 shadow-xs">
                <svg class="w-4 h-4 shrink-0 text-rose-600 dark:text-rose-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="p-4 rounded-xl bg-rose-50 dark:bg-rose-950/60 border border-rose-200 dark:border-rose-800 text-rose-800 dark:text-rose-200 text-xs space-y-1 shadow-xs">
                <div class="font-bold flex items-center gap-1.5">
                    <svg class="w-4 h-4 shrink-0 text-rose-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    <span>Please correct the following errors:</span>
                </div>
                <ul class="list-disc pl-5 text-[11px] space-y-0.5">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Package Display Selector Bar -->
        <div class="card-ledger p-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-[var(--bg-subtle)] text-[var(--accent-primary)] flex items-center justify-center shrink-0 border border-[var(--border-default)]">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                </div>
                <div>
                    <h3 class="text-xs font-extrabold text-[var(--text-primary)] uppercase tracking-wider">User Display Status</h3>
                    <p class="text-xs text-[var(--text-muted)] mt-0.5">
                        Select which packages are displayed to seekers on the public pricing page. Currently <span class="font-bold text-[var(--accent-primary)]">{{ $packages->where('is_active', true)->count() }} visible</span> to users.
                    </p>
                </div>
            </div>

            <!-- Filter Buttons -->
            <div class="flex items-center gap-1.5 p-1 bg-[var(--bg-canvas)] border border-[var(--border-default)] rounded-xl text-xs font-bold shrink-0">
                <button type="button" @click="displayFilter = 'all'"
                        :class="displayFilter === 'all' ? 'bg-[var(--bg-surface)] text-[var(--text-primary)] shadow-xs border border-[var(--border-subtle)]' : 'text-[var(--text-muted)] hover:text-[var(--text-primary)]'"
                        class="px-3.5 py-1.5 rounded-lg transition cursor-pointer">
                    All ({{ $packages->count() }})
                </button>
                <button type="button" @click="displayFilter = 'active'"
                        :class="displayFilter === 'active' ? 'bg-[var(--accent-primary)] text-white shadow-xs' : 'text-[var(--text-muted)] hover:text-[var(--text-primary)]'"
                        class="px-3.5 py-1.5 rounded-lg transition cursor-pointer flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    <span>Displayed ({{ $packages->where('is_active', true)->count() }})</span>
                </button>
                <button type="button" @click="displayFilter = 'inactive'"
                        :class="displayFilter === 'inactive' ? 'bg-[var(--text-secondary)] text-white shadow-xs' : 'text-[var(--text-muted)] hover:text-[var(--text-primary)]'"
                        class="px-3.5 py-1.5 rounded-lg transition cursor-pointer flex items-center gap-1.5">
                    <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/></svg>
                    <span>Hidden ({{ $packages->where('is_active', false)->count() }})</span>
                </button>
            </div>
        </div>

        <!-- Packages Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($packages as $pkg)
                <div x-show="displayFilter === 'all' || (displayFilter === 'active' && {{ $pkg->is_active ? 'true' : 'false' }}) || (displayFilter === 'inactive' && {{ ! $pkg->is_active ? 'true' : 'false' }})"
                     class="card-ledger {{ $pkg->is_popular ? 'border-2 border-[var(--accent-primary)] ring-2 ring-[var(--accent-primary)]/15' : '' }} p-6 flex flex-col justify-between relative transition">
                    <div>
                        <!-- Header Badges -->
                        <div class="flex items-center justify-between gap-2 mb-3">
                            <div class="flex items-center gap-2">
                                @if($pkg->is_active)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-extrabold bg-emerald-100 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-300 uppercase tracking-wider">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                        Displayed to Users
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-extrabold bg-[var(--bg-subtle)] text-[var(--text-muted)] uppercase tracking-wider border border-[var(--border-default)]">
                                        <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/></svg>
                                        Hidden (Draft)
                                    </span>
                                @endif

                                @if($pkg->badge_text)
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold bg-[var(--accent-primary)]/15 text-[var(--accent-primary)] uppercase tracking-wider">{{ $pkg->badge_text }}</span>
                                @endif
                            </div>
                            <span class="text-[10px] font-mono text-[var(--text-muted)]">Slug: {{ $pkg->slug }}</span>
                        </div>

                        <!-- Title and Pricing -->
                        <h3 class="text-xl font-bold text-[var(--text-primary)] font-heading">{{ $pkg->name }}</h3>
                        <p class="text-xs text-[var(--text-muted)] mt-1 min-h-[32px] line-clamp-2">{{ $pkg->description ?? 'No description provided.' }}</p>

                        <div class="my-4 pb-4 border-b border-[var(--border-subtle)]">
                            @if($pkg->isFree())
                                <div class="text-3xl font-extrabold text-[var(--text-primary)] font-heading">$0.00</div>
                                <span class="text-[11px] text-[var(--text-muted)] font-medium">Free forever tier</span>
                            @else
                                <div class="flex items-baseline gap-2">
                                    <span class="text-3xl font-extrabold text-[var(--text-primary)] font-heading">${{ number_format($pkg->monthly_price, 2) }}</span>
                                    <span class="text-xs text-[var(--text-muted)]">/ 1-time pass</span>
                                </div>
                                <div class="text-[11px] text-[var(--accent-primary)] font-bold mt-1 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="3"/><line x1="12" y1="3" x2="12" y2="9"/><line x1="12" y1="15" x2="12" y2="21"/><line x1="3" y1="12" x2="9" y2="12"/><line x1="15" y1="12" x2="21" y2="12"/></svg>
                                    <span>Active until confirmed Mangala Vivaha</span>
                                </div>
                            @endif
                        </div>

                        <!-- Quotas & Feature Matrix -->
                        <div class="space-y-2.5 text-xs text-[var(--text-secondary)]">
                            <div class="flex items-center justify-between">
                                <span class="text-[var(--text-muted)]">Daily Profile Views:</span>
                                <span class="font-bold text-[var(--text-primary)]">
                                    {{ $pkg->isUnlimitedViews() ? 'Unlimited (∞)' : $pkg->daily_profile_views . ' views' }}
                                </span>
                            </div>

                            <div class="flex items-center justify-between">
                                <span class="text-[var(--text-muted)]">Daily Interests:</span>
                                <span class="font-bold text-[var(--text-primary)]">
                                    {{ $pkg->isUnlimitedInterests() ? 'Unlimited (∞)' : $pkg->daily_interests . ' requests' }}
                                </span>
                            </div>

                            <div class="flex items-center justify-between">
                                <span class="text-[var(--text-muted)]">Advanced Filters:</span>
                                <span>{!! $pkg->advanced_filters ? '<span class="text-emerald-600 font-bold">✓ Enabled</span>' : '<span class="text-[var(--text-muted)]">✕ None</span>' !!}</span>
                            </div>

                            <div class="flex items-center justify-between">
                                <span class="text-[var(--text-muted)]">Profile Boost in Search:</span>
                                <span>{!! $pkg->profile_boost ? '<span class="text-[var(--accent-primary)] font-bold">⚡ Boosted</span>' : '<span class="text-[var(--text-muted)]">✕ Standard</span>' !!}</span>
                            </div>

                            <div class="flex items-center justify-between">
                                <span class="text-[var(--text-muted)]">See Who Viewed You:</span>
                                <span>{!! $pkg->see_who_viewed ? '<span class="text-emerald-600 font-bold">✓ Enabled</span>' : '<span class="text-[var(--text-muted)]">✕ None</span>' !!}</span>
                            </div>

                            <div class="flex items-center justify-between">
                                <span class="text-[var(--text-muted)]">Dedicated Advisor:</span>
                                <span>{!! $pkg->dedicated_advisor ? '<span class="text-[var(--accent-primary)] font-bold">✓ VIP Advisor</span>' : '<span class="text-[var(--text-muted)]">✕ None</span>' !!}</span>
                            </div>
                        </div>

                        <!-- Custom Features Bullet List -->
                        @if(!empty($pkg->features) && count($pkg->features) > 0)
                            <div class="mt-4 pt-3 border-t border-[var(--border-subtle)]">
                                <span class="text-[10px] font-bold text-[var(--text-muted)] uppercase tracking-wider block mb-1.5">Displayed Highlights</span>
                                <ul class="space-y-1 text-[11px] text-[var(--text-muted)]">
                                    @foreach($pkg->features as $feat)
                                        <li class="flex items-start gap-1.5">
                                            <svg class="w-3.5 h-3.5 shrink-0 text-emerald-600 dark:text-emerald-400 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                                            <span>{{ $feat }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>

                    <!-- Actions Bar -->
                    <div class="mt-6 pt-4 border-t border-[var(--border-subtle)] flex items-center justify-between gap-2">
                        <button @click="openEdit({{ $pkg->toJson() }})" class="btn-secondary text-xs flex items-center gap-1.5 cursor-pointer">
                            <svg class="w-3.5 h-3.5 text-[var(--text-muted)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                            <span>Edit</span>
                        </button>

                        <div class="flex items-center gap-1.5">
                            <form action="{{ route('admin.packages.toggle-status', $pkg->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-3 py-1.5 rounded-md text-xs font-bold transition cursor-pointer flex items-center gap-1.5 {{ $pkg->is_active ? 'bg-[var(--bg-subtle)] hover:bg-[var(--border-default)] text-[var(--text-secondary)] border border-[var(--border-default)]' : 'btn-primary' }}" title="{{ $pkg->is_active ? 'Click to hide this package from users on pricing page' : 'Click to display this package to users on pricing page' }}">
                                    @if($pkg->is_active)
                                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/></svg>
                                        <span>Hide from Users</span>
                                    @else
                                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                        <span>Display to Users</span>
                                    @endif
                                </button>
                            </form>

                            @if($pkg->slug !== 'free')
                                <form action="{{ route('admin.packages.destroy', $pkg->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete package {{ $pkg->name }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 rounded-md hover:bg-rose-50 dark:hover:bg-rose-950/60 text-rose-600 dark:text-rose-400 transition cursor-pointer" title="Delete Package">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

    <!-- Create Package Modal -->
    <div x-show="showCreateModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-xs">
        <div @click.outside="showCreateModal = false" class="card-ledger max-w-2xl w-full max-h-[90vh] overflow-y-auto p-6 sm:p-8 space-y-6 shadow-2xl">
            <div class="flex items-center justify-between border-b border-[var(--border-subtle)] pb-4">
                <div>
                    <h2 class="text-xl font-bold text-[var(--text-primary)] font-heading">Create Dynamic Subscription Package</h2>
                    <p class="text-xs text-[var(--text-muted)]">Configure package parameters, prices, quotas, and customer highlights.</p>
                </div>
                <button @click="showCreateModal = false" class="text-[var(--text-muted)] hover:text-[var(--text-primary)] text-xl font-bold cursor-pointer">&times;</button>
            </div>

            <form action="{{ route('admin.packages.store') }}" method="POST" class="space-y-4">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Package Name *</label>
                        <input type="text" name="name" required placeholder="e.g. Pro Seeker" class="w-full px-3 py-2 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs outline-none focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)]">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Slug (Identifier)</label>
                        <input type="text" name="slug" placeholder="e.g. pro (leave empty to auto-slug)" class="w-full px-3 py-2 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs font-mono outline-none focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)]">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Short Description</label>
                    <textarea name="description" rows="2" placeholder="Brief summary of this package tier..." class="w-full px-3 py-2 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs outline-none focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)]"></textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">One-Time Pass Price ($) *</label>
                        <input type="number" step="0.01" min="0" name="monthly_price" required value="49.00" class="w-full px-3 py-2 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs font-bold outline-none focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)]">
                        <span class="text-[10px] text-[var(--text-muted)] block mt-0.5">Single charge until confirmed marriage</span>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Reference / Annual Price ($)</label>
                        <input type="number" step="0.01" min="0" name="annual_price" placeholder="Same as pass price" class="w-full px-3 py-2 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs font-bold outline-none focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)]">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Daily Profile Views Limit *</label>
                        <input type="number" name="daily_profile_views" required value="-1" class="w-full px-3 py-2 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs outline-none focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)]">
                        <span class="text-[10px] text-[var(--text-muted)] block mt-0.5">Use -1 for Unlimited views</span>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Daily Interest Requests Limit *</label>
                        <input type="number" name="daily_interests" required value="-1" class="w-full px-3 py-2 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs outline-none focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)]">
                        <span class="text-[10px] text-[var(--text-muted)] block mt-0.5">Use -1 for Unlimited interests</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Badge Text (Optional)</label>
                        <input type="text" name="badge_text" placeholder="e.g. Recommended, Popular" class="w-full px-3 py-2 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs outline-none focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)]">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Sort Order</label>
                        <input type="number" name="sort_order" value="10" class="w-full px-3 py-2 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs outline-none focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)]">
                    </div>
                </div>

                <!-- Feature Toggles -->
                <div class="p-4 rounded-xl bg-[var(--bg-subtle)] border border-[var(--border-default)] space-y-3">
                    <span class="block text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider">Feature Flags</span>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="advanced_filters" value="1" checked class="rounded border-[var(--border-default)] text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                            <span class="text-[var(--text-secondary)]">Advanced Religious Filters</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="profile_boost" value="1" class="rounded border-[var(--border-default)] text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                            <span class="text-[var(--text-secondary)]">Profile Boost in Search (VIP)</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="see_who_viewed" value="1" checked class="rounded border-[var(--border-default)] text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                            <span class="text-[var(--text-secondary)]">See Who Viewed Profile</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="dedicated_advisor" value="1" class="rounded border-[var(--border-default)] text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                            <span class="text-[var(--text-secondary)]">Dedicated Marriage Advisor</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_popular" value="1" class="rounded border-[var(--border-default)] text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                            <span class="text-[var(--text-secondary)]">Highlight as Most Popular</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer col-span-1 sm:col-span-2 p-2.5 rounded-lg bg-[var(--bg-surface)] border border-[var(--border-default)]">
                            <input type="checkbox" name="is_active" value="1" checked class="rounded border-[var(--border-default)] text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                            <span class="text-[var(--text-primary)] font-bold text-xs">Display to Users on Public Pricing & Landing Page</span>
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Custom Bullet Points (1 feature per line)</label>
                    <textarea name="features" rows="4" placeholder="Unlimited daily biodata views&#10;Unlimited proposal requests&#10;Priority ID verification queue&#10;Mindful Chaperoned Chat Support" class="w-full px-3 py-2 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs font-mono outline-none focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)]"></textarea>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-[var(--border-subtle)]">
                    <button type="button" @click="showCreateModal = false" class="btn-secondary text-xs">
                        Cancel
                    </button>
                    <button type="submit" class="btn-primary text-xs">
                        Create Package
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Package Modal -->
    <div x-show="showEditModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-xs">
        <div @click.outside="showEditModal = false" class="card-ledger max-w-2xl w-full max-h-[90vh] overflow-y-auto p-6 sm:p-8 space-y-6 shadow-2xl">
            <div class="flex items-center justify-between border-b border-[var(--border-subtle)] pb-4">
                <div>
                    <h2 class="text-xl font-bold text-[var(--text-primary)] font-heading">Edit Subscription Package</h2>
                    <p class="text-xs text-[var(--text-muted)]">Modify package pricing, limits, and feature toggles.</p>
                </div>
                <button @click="showEditModal = false" class="text-[var(--text-muted)] hover:text-[var(--text-primary)] text-xl font-bold cursor-pointer">&times;</button>
            </div>

            <form :action="'{{ url('/admin/packages') }}/' + editPackage.id" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Package Name *</label>
                        <input type="text" name="name" x-model="editPackage.name" required class="w-full px-3 py-2 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs outline-none focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)]">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Slug (Identifier) *</label>
                        <input type="text" name="slug" x-model="editPackage.slug" required class="w-full px-3 py-2 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs font-mono outline-none focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)]">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Short Description</label>
                    <textarea name="description" x-model="editPackage.description" rows="2" class="w-full px-3 py-2 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs outline-none focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)]"></textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">One-Time Pass Price ($) *</label>
                        <input type="number" step="0.01" min="0" name="monthly_price" x-model="editPackage.monthly_price" required class="w-full px-3 py-2 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs font-bold outline-none focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)]">
                        <span class="text-[10px] text-[var(--text-muted)] block mt-0.5">Single charge until confirmed marriage</span>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Reference / Annual Price ($)</label>
                        <input type="number" step="0.01" min="0" name="annual_price" x-model="editPackage.annual_price" placeholder="Same as pass price" class="w-full px-3 py-2 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs font-bold outline-none focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)]">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Daily Profile Views Limit *</label>
                        <input type="number" name="daily_profile_views" x-model="editPackage.daily_profile_views" required class="w-full px-3 py-2 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs outline-none focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)]">
                        <span class="text-[10px] text-[var(--text-muted)] block mt-0.5">Use -1 for Unlimited views</span>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Daily Interest Requests Limit *</label>
                        <input type="number" name="daily_interests" x-model="editPackage.daily_interests" required class="w-full px-3 py-2 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs outline-none focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)]">
                        <span class="text-[10px] text-[var(--text-muted)] block mt-0.5">Use -1 for Unlimited interests</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Badge Text</label>
                        <input type="text" name="badge_text" x-model="editPackage.badge_text" class="w-full px-3 py-2 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs outline-none focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)]">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Sort Order</label>
                        <input type="number" name="sort_order" x-model="editPackage.sort_order" class="w-full px-3 py-2 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs outline-none focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)]">
                    </div>
                </div>

                <!-- Feature Toggles -->
                <div class="p-4 rounded-xl bg-[var(--bg-subtle)] border border-[var(--border-default)] space-y-3">
                    <span class="block text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider">Feature Flags</span>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="advanced_filters" value="1" x-model="editPackage.advanced_filters" class="rounded border-[var(--border-default)] text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                            <span class="text-[var(--text-secondary)]">Advanced Religious Filters</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="profile_boost" value="1" x-model="editPackage.profile_boost" class="rounded border-[var(--border-default)] text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                            <span class="text-[var(--text-secondary)]">Profile Boost in Search (VIP)</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="see_who_viewed" value="1" x-model="editPackage.see_who_viewed" class="rounded border-[var(--border-default)] text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                            <span class="text-[var(--text-secondary)]">See Who Viewed Profile</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="dedicated_advisor" value="1" x-model="editPackage.dedicated_advisor" class="rounded border-[var(--border-default)] text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                            <span class="text-[var(--text-secondary)]">Dedicated Marriage Advisor</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_popular" value="1" x-model="editPackage.is_popular" class="rounded border-[var(--border-default)] text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                            <span class="text-[var(--text-secondary)]">Highlight as Most Popular</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer col-span-1 sm:col-span-2 p-2.5 rounded-lg bg-[var(--bg-surface)] border border-[var(--border-default)]">
                            <input type="checkbox" name="is_active" value="1" x-model="editPackage.is_active" class="rounded border-[var(--border-default)] text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                            <span class="text-[var(--text-primary)] font-bold text-xs">Display to Users on Public Pricing & Landing Page</span>
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Custom Bullet Points (1 feature per line)</label>
                    <textarea name="features" x-model="editPackage.features_text" rows="4" class="w-full px-3 py-2 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs font-mono outline-none focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)]"></textarea>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-[var(--border-subtle)]">
                    <button type="button" @click="showEditModal = false" class="btn-secondary text-xs">
                        Cancel
                    </button>
                    <button type="submit" class="btn-primary text-xs">
                        Update Package
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
