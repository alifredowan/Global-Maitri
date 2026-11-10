@extends('layouts.app')

@section('title', $targetUser->name . ' - Buddhist Matrimonial Profile | Global Maitri')

@section('content')
<div class="py-6 min-h-screen bg-[var(--bg-canvas)]">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <!-- Back Button & Breadcrumbs -->
        <div>
            <a href="{{ route('discovery.index') }}" class="text-xs font-semibold text-[var(--text-secondary)] hover:text-[var(--accent-primary)] inline-flex items-center gap-1.5 transition">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m15 18-6-6 6-6"/></svg>
                <span>Back to match search</span>
            </a>
        </div>

        <!-- Top Profile Banner Card -->
        <div class="card-ledger bg-[var(--bg-surface)] border border-[var(--border-default)] overflow-hidden shadow-xs">
            <div class="h-32 sm:h-36 bg-[var(--bg-subtle)] border-b border-[var(--border-default)] relative p-4 flex items-start justify-end">
                @if($compatibilityScore)
                    <div class="badge-status bg-[var(--bg-surface)] border border-[var(--border-default)] px-3 py-1 shadow-xs flex items-center gap-2 text-xs font-bold text-[var(--text-primary)]">
                        <span class="w-2 h-2 rounded-full bg-[var(--accent-primary)] animate-pulse"></span>
                        <span>{{ $compatibilityScore }}% Dhamma Compatibility (FR-6.4)</span>
                    </div>
                @endif
            </div>

            <div class="px-6 pb-6 pt-0 relative">
                <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between gap-4 -mt-14 sm:-mt-16 mb-5">
                    <div class="flex items-end gap-4">
                        <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-[var(--radius-md)] overflow-hidden border-4 border-[var(--bg-surface)] bg-[var(--neutral-900)] shadow-md relative shrink-0">
                            @if($profile->primaryPhoto)
                                <img src="{{ $profile->primaryPhoto->displayUrl() }}" alt="{{ $targetUser->name }}"
                                     class="w-full h-full object-cover {{ $isPhotoVisible ? '' : 'photo-shield' }}">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-[var(--bg-subtle)] text-[var(--accent-primary)] font-bold text-3xl">
                                    {{ substr($targetUser->name, 0, 1) }}
                                </div>
                            @endif
                            @if(!$isPhotoVisible)
                                <div class="absolute inset-0 flex items-center justify-center bg-black/50 text-[10px] text-white font-bold text-center px-1">
                                    <span>🔒 Shield (FR-5.1)</span>
                                </div>
                            @endif
                        </div>
                        <div class="space-y-1">
                            <div class="flex items-center gap-2 flex-wrap">
                                <h1 class="text-xl sm:text-2xl font-extrabold text-[var(--text-primary)] font-heading">{{ $targetUser->name }}</h1>
                                @if($targetUser->isPro())
                                    <span class="text-[9px] font-extrabold uppercase px-2 py-0.5 rounded-[var(--radius-sm)] bg-[var(--accent-primary)] text-white shadow-xs" title="Single Marriage Pass Member">
                                        PRO MEMBER
                                    </span>
                                @endif
                                @if($targetUser->is_verified)
                                    <span class="badge-verified text-[10px]" title="Government ID Verified (FR-1.4)">
                                        ✓ Verified Candidate
                                    </span>
                                @endif
                            </div>
                            <p class="text-xs text-[var(--text-secondary)] font-medium">
                                {{ $targetUser->age }} years &bull; {{ $profile->city }}, {{ $profile->country }} &bull;
                                <span class="capitalize">{{ str_replace('_', ' ', $targetUser->marital_status) }}</span>
                            </p>
                            <div class="flex flex-wrap items-center gap-1.5 pt-1">
                                <span class="badge-status text-[11px] bg-[var(--accent-subtle)] text-[var(--accent-primary)] border border-[var(--accent-primary)]/30">
                                    {{ $profile->tradition_label }}
                                </span>
                                <span class="badge-status text-[11px] bg-[var(--bg-subtle)] text-[var(--text-secondary)] border border-[var(--border-default)]">
                                    {{ $profile->meditation_frequency_label }}
                                </span>
                                <span class="badge-status text-[11px] bg-[var(--bg-subtle)] text-[var(--text-secondary)] border border-[var(--border-default)]">
                                    {{ $profile->dietary_label }}
                                </span>
                                @if($profile->family_rep_required || ($activeWaliLink ?? null))
                                    <span class="badge-status text-[11px] bg-[var(--bg-subtle)] text-[var(--text-secondary)] border border-[var(--border-default)]">
                                        Family Rep (Kalyāṇa-Mitta): {{ ($activeWaliLink ?? null) ? ($activeWaliLink->wali_name . ' (' . ucfirst(str_replace('_', ' ', $activeWaliLink->relationship_type)) . ')') : 'Family Consultation' }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Actions: Interest, Shortlist & Print Biodata -->
                    <div class="w-full sm:w-auto flex flex-col sm:items-end gap-2.5">
                        <div class="flex items-center gap-2 flex-wrap">
                            <form action="{{ route('blocked-users.store', $targetUser->id) }}" method="POST" onsubmit="return confirm('Block this profile? You will no longer see or contact this person.')" class="inline">
                                @csrf
                                <button type="submit" class="btn-secondary !py-1.5 !px-3 text-xs text-[var(--color-danger)]" title="Block User">
                                    <span>Block</span>
                                </button>
                            </form>
                            <form action="{{ route('bookmarks.toggle', $targetUser->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="btn-secondary !py-1.5 !px-3 text-xs {{ ($isBookmarked ?? false) ? 'text-[var(--accent-primary)] border-[var(--accent-primary)]' : '' }}">
                                    <span>{{ ($isBookmarked ?? false) ? '★ Shortlisted' : '☆ Shortlist' }}</span>
                                </button>
                            </form>

                            <a href="{{ route('profile.biodata.show', $targetUser->id) }}" target="_blank"
                               class="btn-secondary !py-1.5 !px-3 text-xs" title="Printable Dhamma Biodata">
                                <span>Biodata</span>
                            </a>
                        </div>

                        <div class="w-full sm:w-auto">
                            @if($conversation || ($existingInterest && $existingInterest->status === 'accepted'))
                                <div class="flex items-center gap-2 flex-wrap justify-start sm:justify-end">
                                    <span class="badge-status bg-[var(--color-success-subtle)] text-[var(--color-success)] border border-[var(--color-success)]/30 text-xs font-bold !py-1.5 !px-3">
                                        <span>✓ Proposal Accepted</span>
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
                                                <span>✓ Accept Proposal</span>
                                            </button>
                                        </form>
                                        <form action="{{ route('interests.respond', $existingInterest->id) }}" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="action" value="decline">
                                            <button type="submit" class="btn-secondary text-xs !py-1.5 !px-3.5">
                                                <span>✕ Decline</span>
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <div class="badge-status bg-[var(--accent-subtle)] text-[var(--accent-primary)] border border-[var(--accent-primary)]/30 text-xs !py-1.5 !px-3">
                                        <span>Proposal Sent (Pending)</span>
                                    </div>
                                @endif
                            @elseif($existingInterest && $existingInterest->status === 'pending_wali')
                                <div class="badge-status bg-[var(--bg-subtle)] text-[var(--text-secondary)] border border-[var(--border-default)] text-xs !py-1.5 !px-3">
                                    <span>Awaiting Family Representative (Kalyāṇa-Mitta) Approval</span>
                                </div>
                            @elseif($existingInterest)
                                <div class="badge-status bg-[var(--bg-subtle)] text-[var(--text-secondary)] border border-[var(--border-default)] text-xs !py-1.5 !px-3 capitalize">
                                    Status: {{ ucfirst(str_replace('_', ' ', $existingInterest->status)) }}
                                </div>
                            @else
                                <button type="button" onclick="document.getElementById('sendInterestModal').classList.remove('hidden')" class="btn-primary w-full sm:w-auto text-xs !py-2 !px-5 flex items-center justify-center gap-2">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
                                    <span>Express Matrimonial Proposal</span>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Photo Privacy Notice -->
                @if(!$isPhotoVisible)
                    <div class="card-ledger bg-[var(--bg-subtle)] border border-[var(--border-default)] p-3.5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 text-xs">
                        <div class="flex items-center gap-2.5 text-[var(--text-secondary)]">
                            <svg class="w-4 h-4 text-[var(--accent-primary)] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            <div>
                                <strong class="block text-[var(--text-primary)] font-bold">Lotus Photo Privacy Active (FR-5.1)</strong>
                                <span class="text-[var(--text-muted)]">Photos are blurred by default until mutual proposal is accepted or explicit permission is granted.</span>
                            </div>
                        </div>
                        @if(Auth::user()->profile && ! $hasGrantedPhotoAccess)
                            <form action="{{ route('profile.photos.grant', $targetUser->id) }}" method="POST" class="shrink-0">
                                @csrf
                                <button type="submit" class="btn-primary text-xs !py-1.5 !px-3.5">
                                    Grant them photo access
                                </button>
                            </form>
                        @elseif($hasGrantedPhotoAccess)
                            <span class="badge-status bg-[var(--color-success-subtle)] text-[var(--color-success)] border border-[var(--color-success)]/30 text-xs font-semibold !py-1.5 !px-3">
                                ✓ Photo access granted
                            </span>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        @if(!empty($compatibilityHighlights))
            <section class="card-ledger p-5 bg-[var(--bg-surface)] border border-[var(--border-default)]">
                <div class="flex items-start gap-3 mb-4">
                    <div class="w-8 h-8 rounded-[var(--radius-sm)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="3"/><path d="M12 3v18M3 12h18"/></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-wider text-[var(--accent-primary)]">Shared Dhamma Signals</p>
                        <h2 class="font-heading text-base font-bold text-[var(--text-primary)]">Why this may be a good fit ({{ $compatibilityScore }}% match)</h2>
                        <p class="text-xs text-[var(--text-muted)] mt-0.5">These alignment points are conversation starters. Take time to read their complete biodata and consult your family elders.</p>
                    </div>
                </div>
                <div class="grid gap-3 sm:grid-cols-2">
                    @foreach($compatibilityHighlights as $highlight)
                        <div class="flex items-start gap-3 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-subtle)] p-3">
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

        <!-- Incoming Pending Proposal Callout Banner -->
        @if($existingInterest && $existingInterest->status === 'pending' && $existingInterest->recipient_id === Auth::id())
            <div class="card-ledger p-5 bg-[var(--bg-surface)] border-2 border-[var(--accent-primary)] flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div class="flex items-start gap-3.5">
                    <div class="w-10 h-10 rounded-[var(--radius-sm)] bg-[var(--accent-primary)] text-white flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
                    </div>
                    <div>
                        <span class="badge-status text-[10px] bg-[var(--accent-subtle)] text-[var(--accent-primary)] border border-[var(--accent-primary)]/30 mb-1">
                            Pending Matrimonial Proposal Received
                        </span>
                        <h2 class="text-base font-bold text-[var(--text-primary)] font-heading">
                            {{ $targetUser->name }} has expressed sincere matrimonial interest in you!
                        </h2>
                        <p class="text-xs text-[var(--text-secondary)] mt-0.5 leading-relaxed">
                            Carefully review their Dhamma practice, meditation lifestyle, education, and values below. You may accept or decline this introduction request here.
                        </p>
                        @if($existingInterest->message_note)
                            <div class="mt-2.5 text-xs bg-[var(--bg-subtle)] p-2.5 rounded-[var(--radius-sm)] border border-[var(--border-subtle)] text-[var(--text-secondary)] italic">
                                &ldquo;{{ $existingInterest->message_note }}&rdquo;
                            </div>
                        @endif
                    </div>
                </div>

                <div class="flex items-center gap-2 w-full md:w-auto shrink-0 justify-end">
                    <form action="{{ route('interests.respond', $existingInterest->id) }}" method="POST" class="inline flex-1 md:flex-initial">
                        @csrf
                        <input type="hidden" name="action" value="accept">
                        <button type="submit" class="btn-primary w-full md:w-auto text-xs !py-2 !px-4">
                            <span>✓ Accept Proposal</span>
                        </button>
                    </form>
                    <form action="{{ route('interests.respond', $existingInterest->id) }}" method="POST" class="inline flex-1 md:flex-initial">
                        @csrf
                        <input type="hidden" name="action" value="decline">
                        <button type="submit" class="btn-secondary w-full md:w-auto text-xs !py-2 !px-3.5">
                            <span>✕ Decline</span>
                        </button>
                    </form>
                </div>
            </div>
        @endif

        @if($conversation || ($existingInterest && $existingInterest->status === 'accepted'))
            <!-- Mutual Match & Messaging Active Card (ProfileMessagingTest expects these exact strings) -->
            <div class="card-ledger p-5 bg-[var(--bg-surface)] border border-[var(--border-default)] flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div class="flex items-center gap-3.5">
                    <div class="w-10 h-10 rounded-[var(--radius-sm)] bg-[var(--accent-primary)] text-white flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <h2 class="text-base font-bold text-[var(--text-primary)] font-heading">Mutual Matrimonial Proposal Confirmed!</h2>
                            <span class="badge-status bg-[var(--color-success-subtle)] text-[var(--color-success)] border border-[var(--color-success)]/30 text-[10px]">Messaging Unlocked</span>
                        </div>
                        <p class="text-xs text-[var(--text-secondary)] mt-0.5">You and {{ $targetUser->name }} have mutually accepted interest. You can converse directly in your protected mindful chat.</p>
                    </div>
                </div>
                <a href="{{ $conversation ? route('chat.show', $conversation->id) : route('chat.user', $targetUser->id) }}" class="btn-primary w-full md:w-auto text-xs !py-2.5 !px-5 flex items-center justify-center gap-2 shrink-0">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    <span>Send Message</span> &rarr;
                </a>
            </div>
        @endif

        <!-- Main Biodata Details Ledger Sections (Using definition-list rows from design kit) -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
            
            <!-- Left 2 Columns: Bio, Dhamma, Education & Career -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Bio Section -->
                <div class="card-ledger p-5 sm:p-6 bg-[var(--bg-surface)] border border-[var(--border-default)] space-y-3">
                    <div class="border-b border-[var(--border-subtle)] pb-2">
                        <h2 class="text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-[var(--accent-primary)]"></span>
                            <span>About Me &amp; Matrimonial Intentions</span>
                        </h2>
                    </div>
                    <p class="text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed whitespace-pre-line">
                        {{ $profile->bio ?? 'No biography provided yet.' }}
                    </p>
                </div>

                <!-- Buddhist Practice & Dhamma Alignment (FR-2.3, 2.4, 6.4) -->
                <div class="card-ledger p-5 sm:p-6 bg-[var(--bg-surface)] border border-[var(--border-default)] space-y-4">
                    <div class="border-b border-[var(--border-subtle)] pb-2">
                        <h2 class="text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-[var(--accent-primary)]"></span>
                            <span>Buddhist Practice &amp; Dhamma Values</span>
                        </h2>
                    </div>

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
                            <dt class="def-term">Cultural Community (Casteless)</dt>
                            <dd class="def-desc">{{ $profile->ethnic_community_label }}</dd>
                        </div>
                        <div class="def-row">
                            <dt class="def-term">Meditation Frequency</dt>
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
                            <dt class="def-term">Dhamma Study &amp; Chanting</dt>
                            <dd class="def-desc">{{ $profile->dhamma_study_label }}</dd>
                        </div>
                        <div class="def-row">
                            <dt class="def-term">Dietary Practice</dt>
                            <dd class="def-desc">{{ $profile->dietary_label }}</dd>
                        </div>
                        <div class="def-row">
                            <dt class="def-term">5th Precept (Alcohol/Intoxicants)</dt>
                            <dd class="def-desc">{{ $profile->alcohol_label }}</dd>
                        </div>
                    </dl>
                </div>

                <!-- Horoscope Module (if enabled and permitted) -->
                @if($profile->horoscope_required)
                    <div class="card-ledger p-5 sm:p-6 bg-[var(--bg-surface)] border border-[var(--border-default)] space-y-4">
                        <div class="border-b border-[var(--border-subtle)] pb-2">
                            <h2 class="text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-[var(--accent-primary)]"></span>
                                <span>Astrological &amp; Horoscope Matching</span>
                            </h2>
                        </div>
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
                                <div class="flex items-center justify-between p-3 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-xs mt-3">
                                    <span class="font-bold text-[var(--text-primary)]">Porondam Birth Chart Attached</span>
                                    <a href="{{ route('profile.horoscope.download', $profile->user_id) }}" class="btn-primary text-xs !py-1 !px-3">
                                        Download Chart
                                    </a>
                                </div>
                            @endif
                        @else
                            <div class="p-3 bg-[var(--bg-subtle)] border border-[var(--border-default)] rounded-[var(--radius-sm)] text-xs text-[var(--text-muted)]">
                                <span>Astrological details are visible once mutual proposal interest is accepted.</span>
                            </div>
                        @endif
                    </div>
                @endif

                <!-- Education & Professional Background -->
                <div class="card-ledger p-5 sm:p-6 bg-[var(--bg-surface)] border border-[var(--border-default)] space-y-4">
                    <div class="border-b border-[var(--border-subtle)] pb-2">
                        <h2 class="text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-[var(--accent-primary)]"></span>
                            <span>Education &amp; Professional Career</span>
                        </h2>
                    </div>
                    <dl class="divide-y divide-[var(--border-subtle)]">
                        <div class="def-row">
                            <dt class="def-term">Highest Education</dt>
                            <dd class="def-desc">{{ $profile->education_level ?? 'Graduate' }}</dd>
                        </div>
                        <div class="def-row">
                            <dt class="def-term">Profession / Job Title</dt>
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

            <!-- Right Column: Family, Preferences & Anti-Dowry Notice -->
            <div class="space-y-6">
                <!-- Family Background -->
                <div class="card-ledger p-5 bg-[var(--bg-surface)] border border-[var(--border-default)] space-y-4">
                    <div class="border-b border-[var(--border-subtle)] pb-2">
                        <h2 class="text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-[var(--accent-primary)]"></span>
                            <span>Family Background</span>
                        </h2>
                    </div>
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
                            <div class="def-row bg-[var(--accent-subtle)] -mx-2 px-2 rounded-[var(--radius-sm)]">
                                <dt class="def-term font-semibold text-[var(--accent-primary)]">Family Representative (Kalyāṇa-Mitta)</dt>
                                <dd class="def-desc font-bold text-[var(--text-primary)]">
                                    {{ $activeWaliLink->wali_name }} ({{ ucfirst(str_replace('_', ' ', $activeWaliLink->relationship_type)) }})
                                </dd>
                            </div>
                        @endif
                    </dl>

                    @if($profile->views_on_raising_children_in_dhamma)
                        <div class="pt-2 border-t border-[var(--border-subtle)]">
                            <span class="text-[10px] font-bold text-[var(--text-muted)] uppercase block mb-1">Views on Raising Children</span>
                            <p class="text-xs text-[var(--text-secondary)] italic leading-relaxed">
                                &ldquo;{{ $profile->views_on_raising_children_in_dhamma }}&rdquo;
                            </p>
                        </div>
                    @endif
                </div>

                <!-- Partner Preferences -->
                <div class="card-ledger p-5 bg-[var(--bg-surface)] border border-[var(--border-default)] space-y-4">
                    <div class="border-b border-[var(--border-subtle)] pb-2">
                        <h2 class="text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-[var(--accent-primary)]"></span>
                            <span>Looking For</span>
                        </h2>
                    </div>
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

                <!-- Anti-Dowry Stance Banner (FR-7.4) -->
                <div class="card-ledger p-4 bg-[var(--bg-subtle)] border border-[var(--border-default)] space-y-1.5 text-xs">
                    <div class="flex items-center gap-2 font-bold text-[var(--text-primary)]">
                        <svg class="w-4 h-4 text-[var(--accent-primary)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        <span>Zero Dowry Platform Policy (FR-7.4)</span>
                    </div>
                    <p class="text-[11px] text-[var(--text-muted)] leading-relaxed">
                        Global Maitri strictly prohibits dowry demands (cash, jewelry, property) in alignment with Buddhist principles of non-greed and respect. Violations will result in an immediate permanent ban.
                    </p>
                </div>

                <!-- Report User (FR-4.6) -->
                <div class="text-center pt-1">
                    <button type="button" onclick="document.getElementById('reportModal').classList.remove('hidden')" class="text-xs text-[var(--color-danger)] hover:underline font-semibold cursor-pointer">
                        Report inappropriate profile or behavior (FR-4.6)
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Send Interest Modal -->
<div id="sendInterestModal" class="hidden fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
    <div class="card-ledger bg-[var(--bg-surface)] border border-[var(--border-default)] max-w-md w-full p-6 shadow-2xl space-y-4">
        <div>
            <h3 class="text-base font-bold text-[var(--text-primary)] font-heading">Express Matrimonial Proposal</h3>
            <p class="text-xs text-[var(--text-secondary)] mt-1">
                @if($profile->family_rep_required)
                    Notice: This candidate has a linked Family Representative. If accepted, your proposal will be reviewed with mindful family consultation.
                @else
                    Express your interest respectfully with loving-kindness (Metta). If the candidate accepts, mindful private messaging will unlock (FR-4.2).
                @endif
            </p>
        </div>
        <form action="{{ route('interests.send', $targetUser->id) }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-[var(--text-primary)] mb-1">Optional Introductory Note (Metta Greeting)</label>
                <textarea name="note" rows="3" class="input-field text-xs w-full" placeholder="May you be happy and well. I appreciate your commitment to Dhamma practice and values..."></textarea>
            </div>
            <div class="flex items-center justify-end gap-2 pt-1">
                <button type="button" onclick="document.getElementById('sendInterestModal').classList.add('hidden')" class="btn-secondary text-xs !py-1.5 !px-3.5">Cancel</button>
                <button type="submit" class="btn-primary text-xs !py-1.5 !px-4">Send Proposal</button>
            </div>
        </form>
    </div>
</div>

<!-- Report User Modal (FR-4.6) -->
<div id="reportModal" class="hidden fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
    <div class="card-ledger bg-[var(--bg-surface)] border border-[var(--border-default)] max-w-md w-full p-6 shadow-2xl space-y-4">
        <div>
            <h3 class="text-base font-bold text-[var(--text-primary)] font-heading">Report Candidate</h3>
            <p class="text-xs text-[var(--text-muted)] mt-1">Our moderation team reviews every report within 24 hours.</p>
        </div>
        <form action="{{ route('reports.store') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="reported_id" value="{{ $targetUser->id }}">
            <div>
                <label class="block text-xs font-bold text-[var(--text-primary)] mb-1">Reason for Report</label>
                <select name="reason" required class="input-field text-xs w-full">
                    <option value="dowry_demand">Dowry demand / financial pressure (Strict Zero Tolerance)</option>
                    <option value="inappropriate_language">Inappropriate or vulgar language</option>
                    <option value="harassment">Harassment / pressure</option>
                    <option value="fake_profile">Suspicious / fake profile claims</option>
                    <option value="external_solicitation">Commercial solicitation / scam</option>
                    <option value="caste_discrimination">Caste-based discrimination / remarks</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold text-[var(--text-primary)] mb-1">Details for Moderation Staff (FR-7.2)</label>
                <textarea name="details" rows="3" class="input-field text-xs w-full" placeholder="Provide any context..."></textarea>
            </div>
            <div class="flex items-center justify-end gap-2 pt-1">
                <button type="button" onclick="document.getElementById('reportModal').classList.add('hidden')" class="btn-secondary text-xs !py-1.5 !px-3.5">Cancel</button>
                <button type="submit" class="btn-primary text-xs !py-1.5 !px-4 !bg-[var(--color-danger)] !text-white">Submit Report</button>
            </div>
        </form>
    </div>
</div>
@endsection
