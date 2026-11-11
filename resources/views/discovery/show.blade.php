@extends('layouts.app')

@section('title', $targetUser->name . ' — Buddhist Matrimonial Profile | Global Maitri')

@section('content')
<div class="py-6 sm:py-8 min-h-[calc(100vh-160px)] bg-[var(--bg-canvas)] pb-24 lg:pb-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <!-- Back Button & Breadcrumbs -->
        <div>
            <a href="{{ route('discovery.index') }}" class="text-xs font-semibold text-[var(--text-secondary)] hover:text-[var(--accent-primary)] inline-flex items-center gap-1.5 transition">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m15 18-6-6 6-6"/></svg>
                <span>&larr; Back to candidates</span>
            </a>
        </div>

        <!-- Top Profile Monograph Card -->
        <div class="card-monograph overflow-hidden">
            <div class="h-28 sm:h-32 bg-[var(--bg-subtle)] border-b border-[var(--border-default)] relative p-4 flex items-start justify-end">
                @if($compatibilityScore)
                    <div class="bg-[var(--bg-surface)] border border-[var(--border-default)] px-3 py-1 rounded-[var(--radius-xs)] shadow-2xs flex items-center gap-2 text-xs font-semibold text-[var(--text-primary)]">
                        <span class="w-2 h-2 rounded-full bg-[var(--accent-primary)]"></span>
                        <span>{{ $compatibilityScore }}% values alignment</span>
                    </div>
                @endif
            </div>

            <div class="px-6 pb-6 pt-0 relative">
                <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between gap-4 -mt-12 sm:-mt-14 mb-5">
                    <div class="flex items-end gap-4">
                        <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-[var(--radius-md)] overflow-hidden border-4 border-[var(--bg-surface)] bg-[var(--bg-subtle)] shadow-xs relative shrink-0">
                            @if($profile->primaryPhoto)
                                <img src="{{ $profile->primaryPhoto->displayUrl() }}" alt="{{ $targetUser->name }}"
                                     class="w-full h-full object-cover {{ $isPhotoVisible ? '' : 'photo-shield' }}">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-[var(--bg-subtle)] text-[var(--accent-primary)] font-bold text-2xl">
                                    {{ substr($targetUser->name, 0, 1) }}
                                </div>
                            @endif
                            @if(!$isPhotoVisible)
                                <div class="absolute inset-0 flex items-center justify-center bg-black/45 text-[9px] text-white font-medium text-center px-1">
                                    <span>Private until both agree</span>
                                </div>
                            @endif
                        </div>
                        <div class="space-y-1">
                            <div class="flex items-center gap-2 flex-wrap">
                                <h1 class="font-heading font-bold text-xl sm:text-2xl text-[var(--text-primary)]">{{ $targetUser->name }}</h1>
                                @if($targetUser->isPro())
                                    <span class="text-[10px] font-semibold px-2 py-0.5 rounded-[var(--radius-xs)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] border border-[var(--border-default)]">
                                        Single Marriage Pass
                                    </span>
                                @endif
                                @if($targetUser->is_verified)
                                    <span class="inline-flex items-center gap-0.5 text-[10px] font-semibold text-[var(--color-primary)]">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                        Verified candidate
                                    </span>
                                @endif
                            </div>
                            <p class="text-xs text-[var(--text-secondary)]">
                                {{ $targetUser->age }} years &bull; {{ $profile->city ? $profile->city . ', ' : '' }}{{ $profile->country }} &bull;
                                <span class="capitalize">{{ str_replace('_', ' ', $targetUser->marital_status) }}</span>
                            </p>
                            <div class="flex flex-wrap items-center gap-1.5 pt-1">
                                <span class="text-[11px] font-medium px-2 py-0.5 rounded-[var(--radius-xs)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] border border-[var(--border-default)]">
                                    {{ $profile->tradition_label }}
                                </span>
                                <span class="text-[11px] px-2 py-0.5 rounded-[var(--radius-xs)] bg-[var(--bg-subtle)] text-[var(--text-secondary)] border border-[var(--border-default)]">
                                    {{ $profile->meditation_frequency_label }}
                                </span>
                                <span class="text-[11px] px-2 py-0.5 rounded-[var(--radius-xs)] bg-[var(--bg-subtle)] text-[var(--text-secondary)] border border-[var(--border-default)]">
                                    {{ $profile->dietary_label }}
                                </span>
                                @if($profile->family_rep_required || ($activeWaliLink ?? null))
                                    <span class="text-[11px] px-2 py-0.5 rounded-[var(--radius-xs)] bg-[var(--bg-subtle)] text-[var(--text-secondary)] border border-[var(--border-default)]">
                                        Family: {{ ($activeWaliLink ?? null) ? ($activeWaliLink->wali_name . ' (' . ucfirst(str_replace('_', ' ', $activeWaliLink->relationship_type)) . ')') : 'Family Consultation' }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Actions on Desktop -->
                    <div class="hidden sm:flex flex-col items-end gap-2.5">
                        <div class="flex items-center gap-2 flex-wrap">
                            <form action="{{ route('blocked-users.store', $targetUser->id) }}" method="POST" onsubmit="return confirm('Block this profile? You will no longer see or contact this person.')" class="inline">
                                @csrf
                                <button type="submit" class="btn-secondary !py-1.5 !px-3 text-xs text-[var(--color-danger)]" title="Block User">
                                    <span>Block</span>
                                </button>
                            </form>
                            <form action="{{ route('bookmarks.toggle', $targetUser->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="btn-secondary !py-1.5 !px-3 text-xs {{ ($isBookmarked ?? false) ? 'text-[var(--accent-primary)]' : '' }}">
                                    <span>{{ ($isBookmarked ?? false) ? '★ Shortlisted' : '☆ Shortlist' }}</span>
                                </button>
                            </form>

                            <a href="{{ route('profile.biodata.show', $targetUser->id) }}" target="_blank"
                               class="btn-secondary !py-1.5 !px-3 text-xs" title="Printable Dhamma Biodata">
                                <span>Biodata</span>
                            </a>
                        </div>

                        <div>
                            @if($conversation || ($existingInterest && $existingInterest->status === 'accepted'))
                                <div class="flex items-center gap-2 flex-wrap justify-end">
                                    <span class="inline-flex items-center gap-1 text-xs font-semibold text-[var(--color-primary)]">
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                        Proposal Accepted
                                    </span>
                                    <a href="{{ $conversation ? route('chat.show', $conversation->id) : route('chat.user', $targetUser->id) }}" class="btn-primary text-xs !py-1.5 !px-4 flex items-center gap-2">
                                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                                        <span>Send Message</span>
                                    </a>
                                </div>
                            @elseif($existingInterest && $existingInterest->status === 'pending')
                                @if($existingInterest->recipient_id === Auth::id())
                                    <div class="flex items-center gap-2">
                                        <form action="{{ route('interests.respond', $existingInterest->id) }}" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="action" value="accept">
                                            <button type="submit" class="btn-primary text-xs !py-1.5 !px-4">
                                                <span>Accept Proposal</span>
                                            </button>
                                        </form>
                                        <form action="{{ route('interests.respond', $existingInterest->id) }}" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="action" value="decline">
                                            <button type="submit" class="btn-secondary text-xs !py-1.5 !px-3.5">
                                                <span>Decline</span>
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <span class="text-xs font-semibold px-3 py-1.5 rounded-[var(--radius-xs)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] border border-[var(--border-default)]">
                                        Proposal sent (pending)
                                    </span>
                                @endif
                            @elseif($existingInterest && $existingInterest->status === 'pending_wali')
                                <span class="text-xs font-medium px-3 py-1.5 rounded-[var(--radius-xs)] bg-[var(--bg-subtle)] text-[var(--text-secondary)] border border-[var(--border-default)]">
                                    Awaiting family review
                                </span>
                            @elseif($existingInterest)
                                <span class="text-xs px-3 py-1.5 rounded-[var(--radius-xs)] bg-[var(--bg-subtle)] text-[var(--text-secondary)] border border-[var(--border-default)] capitalize">
                                    Status: {{ ucfirst(str_replace('_', ' ', $existingInterest->status)) }}
                                </span>
                            @else
                                <button type="button" onclick="document.getElementById('sendInterestModal').classList.remove('hidden')" class="btn-primary text-xs !py-2 !px-5 flex items-center justify-center gap-2">
                                    <span>Express interest</span> &rarr;
                                </button>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Photo Privacy Notice Banner (Preserves test strings) -->
                @if(!$isPhotoVisible)
                    <div class="rounded-[var(--radius-md)] bg-[var(--bg-subtle)] border border-[var(--border-default)] p-3.5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 text-xs">
                        <div class="flex items-center gap-2.5 text-[var(--text-secondary)]">
                            <svg class="w-4 h-4 text-[var(--accent-primary)] shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path stroke-linecap="round" stroke-linejoin="round" d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            <div>
                                <strong class="block text-[var(--text-primary)] font-semibold">Lotus Photo Privacy Active (FR-5.1)</strong>
                                <span class="text-[var(--text-muted)]">Photos stay private until you both agree. You can grant access directly.</span>
                            </div>
                        </div>
                        @if(Auth::user()->profile && ! $hasGrantedPhotoAccess)
                            <form action="{{ route('profile.photos.grant', $targetUser->id) }}" method="POST" class="shrink-0">
                                @csrf
                                <button type="submit" class="btn-secondary text-xs !py-1.5 !px-3.5">
                                    Grant them photo access
                                </button>
                            </form>
                        @elseif($hasGrantedPhotoAccess)
                            <span class="inline-flex items-center gap-1 text-xs font-semibold text-[var(--color-primary)]">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                Photo access granted
                            </span>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        @if(!empty($compatibilityHighlights))
            <section class="rounded-[var(--radius-md)] p-5 bg-[var(--bg-surface)] border border-[var(--border-default)] space-y-3">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-[var(--accent-primary)]">Shared practice</p>
                    <h2 class="font-heading text-base font-bold text-[var(--text-primary)]">Why this may be a good fit ({{ $compatibilityScore }}% match)</h2>
                    <p class="text-xs text-[var(--text-muted)] mt-0.5">Take time to read their complete biodata and consult your family elders.</p>
                </div>
                <div class="grid gap-3 sm:grid-cols-2">
                    @foreach($compatibilityHighlights as $highlight)
                        <div class="flex items-start gap-3 rounded-[var(--radius-xs)] border border-[var(--border-default)] bg-[var(--bg-subtle)] p-3">
                            <span class="w-2 h-2 rounded-full bg-[var(--accent-primary)] mt-1.5 shrink-0"></span>
                            <div>
                                <p class="text-xs font-bold text-[var(--text-primary)]">{{ $highlight['label'] }}</p>
                                <p class="text-[11px] text-[var(--text-muted)] mt-0.5">{{ $highlight['detail'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Incoming Proposal Callout Banner -->
        @if($existingInterest && $existingInterest->status === 'pending' && $existingInterest->recipient_id === Auth::id())
            <div class="rounded-[var(--radius-md)] p-5 bg-[var(--bg-surface)] border border-[var(--accent-primary)] flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div class="space-y-1">
                    <span class="text-xs font-semibold text-[var(--accent-primary)] uppercase tracking-wider">
                        Proposal received
                    </span>
                    <h2 class="font-heading text-base font-bold text-[var(--text-primary)]">
                        {{ $targetUser->name }} has expressed sincere matrimonial interest in you!
                    </h2>
                    <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                        Review their practice, background, and aspirations below before responding.
                    </p>
                    @if($existingInterest->message_note)
                        <div class="mt-2 text-xs bg-[var(--bg-subtle)] p-2.5 rounded-[var(--radius-xs)] border border-[var(--border-subtle)] text-[var(--text-secondary)] italic font-serif-accent">
                            &ldquo;{{ $existingInterest->message_note }}&rdquo;
                        </div>
                    @endif
                </div>

                <div class="flex items-center gap-2 w-full md:w-auto shrink-0 justify-end">
                    <form action="{{ route('interests.respond', $existingInterest->id) }}" method="POST" class="inline flex-1 md:flex-initial">
                        @csrf
                        <input type="hidden" name="action" value="accept">
                        <button type="submit" class="btn-primary w-full md:w-auto text-xs !py-2 !px-4">
                            <span>Accept Proposal</span>
                        </button>
                    </form>
                    <form action="{{ route('interests.respond', $existingInterest->id) }}" method="POST" class="inline flex-1 md:flex-initial">
                        @csrf
                        <input type="hidden" name="action" value="decline">
                        <button type="submit" class="btn-secondary w-full md:w-auto text-xs !py-2 !px-3.5">
                            <span>Decline</span>
                        </button>
                    </form>
                </div>
            </div>
        @endif

        @if($conversation || ($existingInterest && $existingInterest->status === 'accepted'))
            <!-- Mutual Match Card (Preserves test strings) -->
            <div class="rounded-[var(--radius-md)] p-5 bg-[var(--bg-surface)] border border-[var(--border-default)] flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <h2 class="font-heading text-base font-bold text-[var(--text-primary)]">Mutual Matrimonial Proposal Confirmed!</h2>
                        <span class="inline-flex items-center gap-1 text-[10px] text-[var(--color-primary)] font-semibold">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            Messaging Open
                        </span>
                    </div>
                    <p class="text-xs text-[var(--text-secondary)]">You and {{ $targetUser->name }} have mutually accepted interest. You can converse directly in your protected mindful chat.</p>
                </div>
                <a href="{{ $conversation ? route('chat.show', $conversation->id) : route('chat.user', $targetUser->id) }}" class="btn-primary text-xs !py-2 !px-5 flex items-center justify-center gap-2 shrink-0">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    <span>Send Message</span> &rarr;
                </a>
            </div>
        @endif

        <!-- Main Biodata Details Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
            
            <!-- Left 2 Columns -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Bio -->
                <div class="rounded-[var(--radius-md)] p-6 bg-[var(--bg-surface)] border border-[var(--border-default)] space-y-3">
                    <h2 class="text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider">
                        About and aspirations
                    </h2>
                    <p class="text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed whitespace-pre-line font-serif-accent italic">
                        {{ $profile->bio ?? 'No biography provided yet.' }}
                    </p>
                </div>

                <!-- Buddhist Practice -->
                <div class="rounded-[var(--radius-md)] p-6 bg-[var(--bg-surface)] border border-[var(--border-default)] space-y-4">
                    <h2 class="text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider">
                        Tradition &amp; practice
                    </h2>

                    <dl class="divide-y divide-[var(--border-subtle)]">
                        <div class="def-row">
                            <dt class="def-term">Buddhist Tradition</dt>
                            <dd class="def-desc">{{ $profile->tradition_label }}</dd>
                        </div>
                        <div class="def-row">
                            <dt class="def-term">Lineage / School</dt>
                            <dd class="def-desc">{{ $profile->lineage_school ?? 'General Buddhist' }}</dd>
                        </div>
                        <div class="def-row">
                            <dt class="def-term">Cultural Community</dt>
                            <dd class="def-desc">{{ $profile->ethnic_community_label }}</dd>
                        </div>
                        <div class="def-row">
                            <dt class="def-term">Meditation Rhythm</dt>
                            <dd class="def-desc font-semibold text-[var(--accent-primary)]">{{ $profile->meditation_frequency_label }}</dd>
                        </div>
                        <div class="def-row">
                            <dt class="def-term">Five Precepts (Panca Sila)</dt>
                            <dd class="def-desc">{{ $profile->panca_sila_label }}</dd>
                        </div>
                        <div class="def-row">
                            <dt class="def-term">Temple / Vihara Attendance</dt>
                            <dd class="def-desc">{{ $profile->temple_label }}</dd>
                        </div>
                        <div class="def-row">
                            <dt class="def-term">Uposatha Observance</dt>
                            <dd class="def-desc">{{ $profile->uposatha_label }}</dd>
                        </div>
                        <div class="def-row">
                            <dt class="def-term">Dhamma Study</dt>
                            <dd class="def-desc">{{ $profile->dhamma_study_label }}</dd>
                        </div>
                        <div class="def-row">
                            <dt class="def-term">Dietary Practice</dt>
                            <dd class="def-desc">{{ $profile->dietary_label }}</dd>
                        </div>
                        <div class="def-row">
                            <dt class="def-term">5th Precept (Alcohol)</dt>
                            <dd class="def-desc">{{ $profile->alcohol_label }}</dd>
                        </div>
                    </dl>
                </div>

                <!-- Horoscope Module -->
                @if($profile->horoscope_required)
                    <div class="rounded-[var(--radius-md)] p-6 bg-[var(--bg-surface)] border border-[var(--border-default)] space-y-4">
                        <h2 class="text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider">
                            Horoscope (optional)
                        </h2>
                        @if($profile->isHoroscopeVisibleTo(Auth::user()))
                            <dl class="divide-y divide-[var(--border-subtle)]">
                                <div class="def-row">
                                    <dt class="def-term">Birth Date</dt>
                                    <dd class="def-desc">{{ $profile->birth_date?->format('d M Y') ?? 'Provided' }}</dd>
                                </div>
                                <div class="def-row">
                                    <dt class="def-term">Birth Time</dt>
                                    <dd class="def-desc">{{ $profile->birth_time ?? 'Available' }}</dd>
                                </div>
                                <div class="def-row">
                                    <dt class="def-term">Birth Place</dt>
                                    <dd class="def-desc">{{ $profile->birth_place ?? 'Available' }}</dd>
                                </div>
                            </dl>
                            @if($profile->horoscope_file_path)
                                <div class="flex items-center justify-between p-3 rounded-[var(--radius-xs)] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-xs mt-3">
                                    <span class="font-semibold text-[var(--text-primary)]">Porondam birth chart attached</span>
                                    <a href="{{ route('profile.horoscope.download', $profile->user_id) }}" class="btn-primary text-xs !py-1 !px-3">
                                        Download chart
                                    </a>
                                </div>
                            @endif
                        @else
                            <p class="text-xs text-[var(--text-muted)]">
                                Astrological details are visible once mutual interest is accepted.
                            </p>
                        @endif
                    </div>
                @endif

                <!-- Education & Professional Career -->
                <div class="rounded-[var(--radius-md)] p-6 bg-[var(--bg-surface)] border border-[var(--border-default)] space-y-4">
                    <h2 class="text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider">
                        Education &amp; profession
                    </h2>
                    <dl class="divide-y divide-[var(--border-subtle)]">
                        <div class="def-row">
                            <dt class="def-term">Education</dt>
                            <dd class="def-desc">{{ $profile->education_level ?? 'Graduate' }}</dd>
                        </div>
                        <div class="def-row">
                            <dt class="def-term">Profession</dt>
                            <dd class="def-desc">{{ $profile->profession ?? 'Professional' }}</dd>
                        </div>
                        <div class="def-row">
                            <dt class="def-term">Mother Tongue</dt>
                            <dd class="def-desc">{{ $profile->mother_tongue ?? 'Not specified' }}</dd>
                        </div>
                        <div class="def-row">
                            <dt class="def-term">Height</dt>
                            <dd class="def-desc">{{ $profile->height_cm ? $profile->height_cm . ' cm' : 'Not specified' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-6">
                <!-- Family Background -->
                <div class="rounded-[var(--radius-md)] p-5 bg-[var(--bg-surface)] border border-[var(--border-default)] space-y-4">
                    <h2 class="text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider">
                        Family background
                    </h2>
                    <dl class="divide-y divide-[var(--border-subtle)]">
                        <div class="def-row">
                            <dt class="def-term">Living Arrangement</dt>
                            <dd class="def-desc">{{ ucfirst(str_replace('_', ' ', $profile->preferred_living_arrangement ?? 'Flexible')) }}</dd>
                        </div>
                        <div class="def-row">
                            <dt class="def-term">Siblings</dt>
                            <dd class="def-desc">{{ $profile->siblings_count ?? 'Not specified' }}</dd>
                        </div>
                        <div class="def-row">
                            <dt class="def-term">Parents' Occupation</dt>
                            <dd class="def-desc">{{ $profile->parents_occupation ?? 'Respected background' }}</dd>
                        </div>
                        @if($activeWaliLink ?? null)
                            <div class="def-row bg-[var(--accent-subtle)] -mx-2 px-2 rounded-[var(--radius-xs)]">
                                <dt class="def-term font-semibold text-[var(--accent-primary)]">Family Representative</dt>
                                <dd class="def-desc font-bold text-[var(--text-primary)]">
                                    {{ $activeWaliLink->wali_name }} ({{ ucfirst(str_replace('_', ' ', $activeWaliLink->relationship_type)) }})
                                </dd>
                            </div>
                        @endif
                    </dl>

                    @if($profile->views_on_raising_children_in_dhamma)
                        <div class="pt-2 border-t border-[var(--border-subtle)]">
                            <span class="text-[10px] font-semibold text-[var(--text-muted)] uppercase block mb-1">Views on family &amp; children</span>
                            <p class="text-xs text-[var(--text-secondary)] italic leading-relaxed">
                                &ldquo;{{ $profile->views_on_raising_children_in_dhamma }}&rdquo;
                            </p>
                        </div>
                    @endif
                </div>

                <!-- Partner Preferences -->
                <div class="rounded-[var(--radius-md)] p-5 bg-[var(--bg-surface)] border border-[var(--border-default)] space-y-4">
                    <h2 class="text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider">
                        Looking for
                    </h2>
                    @php $prefs = $profile->partner_preferences ?? []; @endphp
                    <dl class="divide-y divide-[var(--border-subtle)]">
                        <div class="def-row">
                            <dt class="def-term">Preferred Age</dt>
                            <dd class="def-desc">{{ $prefs['age_min'] ?? 'Any' }} - {{ $prefs['age_max'] ?? 'Any' }} years</dd>
                        </div>
                        <div class="def-row">
                            <dt class="def-term">Preferred Location</dt>
                            <dd class="def-desc">{{ $prefs['preferred_location'] ?? 'Open' }}</dd>
                        </div>
                    </dl>
                </div>

                <!-- Anti-Dowry Notice -->
                <div class="rounded-[var(--radius-md)] p-4 bg-[var(--bg-subtle)] border border-[var(--border-default)] space-y-1.5 text-xs">
                    <div class="flex items-center gap-2 font-semibold text-[var(--text-primary)]">
                        <svg class="w-4 h-4 text-[var(--accent-primary)] shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        <span>Anti-dowry policy</span>
                    </div>
                    <p class="text-[11px] text-[var(--text-muted)] leading-relaxed">
                        Global Maitri prohibits dowry demands (cash, jewelry, property) in alignment with Buddhist principles of non-greed and respect.
                    </p>
                </div>

                <!-- Report Link -->
                <div class="text-center pt-1">
                    <button type="button" onclick="document.getElementById('reportModal').classList.remove('hidden')" class="text-xs text-[var(--color-danger)] hover:underline cursor-pointer">
                        Report profile
                    </button>
                </div>
            </div>
        </div>

    </div>

    <!-- Sticky Bottom Mobile Action Bar (44px touch targets) -->
    <div class="fixed bottom-0 inset-x-0 z-40 sm:hidden bg-[var(--bg-surface)] border-t border-[var(--border-default)] p-3 shadow-lg flex items-center justify-between gap-3">
        @if($conversation || ($existingInterest && $existingInterest->status === 'accepted'))
            <a href="{{ $conversation ? route('chat.show', $conversation->id) : route('chat.user', $targetUser->id) }}" class="btn-primary flex-1 min-h-[44px] flex items-center justify-center gap-2 text-xs">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a.75.75 0 01-.774-.834l.27-2.164a8.03 8.03 0 01-1.906-4.972C3 7.444 7.03 3.75 12 3.75s9 3.694 9 8.25z"/></svg>
                <span>Send Message</span>
            </a>
        @elseif($existingInterest && $existingInterest->status === 'pending' && $existingInterest->recipient_id === Auth::id())
            <form action="{{ route('interests.respond', $existingInterest->id) }}" method="POST" class="flex-1">
                @csrf
                <input type="hidden" name="action" value="accept">
                <button type="submit" class="btn-primary w-full min-h-[44px] text-xs">Accept Proposal</button>
            </form>
        @elseif(!$existingInterest)
            <button type="button" onclick="document.getElementById('sendInterestModal').classList.remove('hidden')" class="btn-primary flex-1 min-h-[44px] text-xs">
                Express interest
            </button>
        @else
            <span class="text-xs text-[var(--text-muted)] flex-1 text-center">Proposal sent</span>
        @endif

        <form action="{{ route('bookmarks.toggle', $targetUser->id) }}" method="POST" class="shrink-0">
            @csrf
            <button type="submit" class="btn-secondary min-h-[44px] px-3.5 text-xs flex items-center justify-center">
                <span>{{ ($isBookmarked ?? false) ? '★' : '☆' }}</span>
            </button>
        </form>
    </div>
</div>

<!-- Send Interest Modal -->
<div id="sendInterestModal" class="hidden fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
    <div class="rounded-[var(--radius-lg)] bg-[var(--bg-surface)] border border-[var(--border-default)] max-w-md w-full p-6 shadow-xl space-y-4">
        <div>
            <h3 class="font-heading text-base font-bold text-[var(--text-primary)]">Express interest</h3>
            <p class="text-xs text-[var(--text-secondary)] mt-1">
                @if($profile->family_rep_required)
                    This candidate has a linked family representative. Your expression will be reviewed thoughtfully with their family elders.
                @else
                    Express your interest respectfully. If accepted, private chat opens so you can speak directly.
                @endif
            </p>
        </div>
        <form action="{{ route('interests.send', $targetUser->id) }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Introductory note (optional)</label>
                <textarea name="note" rows="3" class="input-field text-xs w-full" placeholder="May you be happy and well. I appreciate your values and would be glad to introduce myself..."></textarea>
            </div>
            <div class="flex items-center justify-end gap-2 pt-1">
                <button type="button" onclick="document.getElementById('sendInterestModal').classList.add('hidden')" class="btn-secondary text-xs !py-1.5 !px-3.5">Cancel</button>
                <button type="submit" class="btn-primary text-xs !py-1.5 !px-4">Send proposal</button>
            </div>
        </form>
    </div>
</div>

<!-- Report Modal -->
<div id="reportModal" class="hidden fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
    <div class="rounded-[var(--radius-lg)] bg-[var(--bg-surface)] border border-[var(--border-default)] max-w-md w-full p-6 shadow-xl space-y-4">
        <div>
            <h3 class="font-heading text-base font-bold text-[var(--text-primary)]">Report profile</h3>
            <p class="text-xs text-[var(--text-muted)] mt-1">Our moderation team reviews every report carefully within 24 hours.</p>
        </div>
        <form action="{{ route('reports.store') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="reported_id" value="{{ $targetUser->id }}">
            <div>
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Reason for report</label>
                <select name="reason" required class="input-field text-xs w-full">
                    <option value="dowry_demand">Dowry demand / financial demand (Zero tolerance)</option>
                    <option value="inappropriate_language">Disrespectful or inappropriate language</option>
                    <option value="harassment">Harassment or unwanted pressure</option>
                    <option value="fake_profile">Suspicious or inaccurate profile</option>
                    <option value="external_solicitation">Commercial solicitation</option>
                    <option value="caste_discrimination">Caste discrimination</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Details</label>
                <textarea name="details" rows="3" class="input-field text-xs w-full" placeholder="Provide any additional context..."></textarea>
            </div>
            <div class="flex items-center justify-end gap-2 pt-1">
                <button type="button" onclick="document.getElementById('reportModal').classList.add('hidden')" class="btn-secondary text-xs !py-1.5 !px-3.5">Cancel</button>
                <button type="submit" class="btn-primary text-xs !py-1.5 !px-4 !bg-[var(--color-danger)] !text-white">Submit report</button>
            </div>
        </form>
    </div>
</div>
@endsection
