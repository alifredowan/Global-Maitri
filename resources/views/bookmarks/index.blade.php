@extends('layouts.app')

@section('title', 'Shortlisted Profiles for Family Review - Global Maitri')

@section('content')
<div class="py-10 bg-[var(--bg-canvas)] min-h-screen transition-colors">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <!-- Top Header -->
        <div class="card-ledger p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="text-xs font-bold uppercase tracking-wider text-[var(--accent-primary)]">Pro Feature</span>
                    <span class="w-1.5 h-1.5 rounded-full bg-[var(--border-default)]"></span>
                    <span class="text-xs text-[var(--text-secondary)]">Family &amp; Representative Consultation</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-[var(--text-primary)] font-heading">Shortlisted Candidates</h1>
                <p class="text-xs text-[var(--text-secondary)] mt-1">
                    Save prospective suitors to review together with your parents, guardians, and Family Representative before reaching out.
                </p>
            </div>

            <a href="{{ route('discovery.index') }}" class="btn-secondary text-xs px-4 py-2.5 flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <span>Find More Matches</span>
            </a>
        </div>

        @if(session('success'))
            <div class="p-4 rounded-[4px] bg-[var(--bg-subtle)] border border-[var(--color-success)] text-[var(--color-success)] text-xs font-semibold flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="p-4 rounded-[4px] bg-[var(--bg-subtle)] border border-[var(--color-danger)] text-[var(--color-danger)] text-xs font-semibold flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @if($isPro)
            @if($bookmarks->isEmpty())
                <div class="card-ledger p-12 text-center space-y-4">
                    <div class="w-16 h-16 mx-auto rounded-[4px] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] flex items-center justify-center">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-[var(--text-primary)]">Your Shortlist is Empty</h3>
                    <p class="text-xs text-[var(--text-secondary)] max-w-md mx-auto">
                        When browsing candidates in match discovery, click the bookmark icon on any card to save them here for consultation with your family.
                    </p>
                    <a href="{{ route('discovery.index') }}" class="btn-primary text-xs px-5 py-2.5 inline-block">
                        Explore Candidate Profiles &rarr;
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($bookmarks as $b)
                        @php
                            $candidate = $b->bookmarkedUser;
                            $profile = $candidate->profile;
                        @endphp
                        <div class="card-ledger p-5 flex flex-col justify-between"
                             x-data="{ editingNotes: false, notesVal: '{{ addslashes($b->notes ?? '') }}' }">
                            <div>
                                <!-- Top Card Header -->
                                <div class="flex items-start justify-between gap-2.5 mb-3">
                                    <div class="flex items-center gap-3 min-w-0">
                                        <div class="relative w-14 h-14 rounded-[4px] overflow-hidden bg-[#141412] shrink-0 border border-[var(--border-default)]">
                                            @if($profile && $profile->primaryPhoto)
                                                <img src="{{ $profile->primaryPhoto->displayUrl() }}" alt="{{ $candidate->name }}" loading="lazy" decoding="async"
                                                     class="w-full h-full object-cover {{ $b->is_photo_visible ? '' : 'photo-shield' }}">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center bg-[#22211c] text-[#e0b84c] font-bold text-xl">
                                                    {{ substr($candidate->name, 0, 1) }}
                                                </div>
                                            @endif
                                            @if(!$b->is_photo_visible)
                                                <span class="absolute inset-0 flex items-center justify-center bg-black/50 text-[9px] text-white font-bold">Shielded</span>
                                            @endif
                                        </div>
                                        <div class="min-w-0">
                                            <div class="flex items-center gap-1.5 min-w-0">
                                                <h3 class="font-bold text-sm text-[var(--text-primary)] truncate">{{ $candidate->name }}</h3>
                                                @if($candidate->is_verified)
                                                    <svg class="w-3.5 h-3.5 text-[var(--accent-primary)] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                @endif
                                            </div>
                                            <p class="text-xs text-[var(--text-secondary)] truncate">
                                                {{ $candidate->age }} yrs • {{ $profile?->city ?? 'Location not specified' }}
                                            </p>
                                            <p class="text-[11px] text-[var(--accent-primary)] font-semibold truncate">
                                                {{ $profile?->tradition_label ?? ($profile?->buddhist_tradition ?? 'Buddhist') }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="shrink-0 flex flex-col items-end gap-1.5">
                                        @if($b->compatibility_score)
                                            <span class="px-2 py-0.5 rounded-[4px] text-[10px] font-bold bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] border border-[var(--accent-primary)]/20 whitespace-nowrap">
                                                {{ $b->compatibility_score }}% Match
                                            </span>
                                        @endif
                                        @if($candidate->isPro())
                                            <span class="px-2 py-0.5 rounded-[4px] text-[10px] font-bold bg-[var(--accent-primary)] text-white flex items-center gap-1 whitespace-nowrap" title="Pro Matrimonial Member">
                                                PRO
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Private Family Consultation Notes -->
                                <div class="bg-[var(--bg-subtle)] border border-[var(--border-default)] rounded-[4px] p-3 my-3">
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--accent-primary)] flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            Family Review Note
                                        </span>
                                        <button type="button" @click="editingNotes = !editingNotes" class="text-[10px] font-bold text-[var(--accent-primary)] hover:underline cursor-pointer">
                                            <span x-text="editingNotes ? 'Close' : (notesVal ? 'Edit Note' : '+ Add Note')"></span>
                                        </button>
                                    </div>

                                    <!-- Read note -->
                                    <div x-show="!editingNotes" class="text-xs text-[var(--text-secondary)] italic min-h-[20px]">
                                        <span x-text="notesVal || 'No family notes added yet. Click edit to add Family Rep/family thoughts.'"></span>
                                    </div>

                                    <!-- Edit note form -->
                                    <div x-show="editingNotes" x-cloak class="mt-2">
                                        <form action="{{ route('bookmarks.notes', $b->id) }}" method="POST" class="space-y-2">
                                            @csrf
                                            <textarea name="notes" rows="2" x-model="notesVal" placeholder="e.g. Consult with elders about meditation background..."
                                                      class="input-field text-xs"></textarea>
                                            <div class="flex justify-end gap-1.5">
                                                <button type="button" @click="editingNotes = false" class="btn-secondary text-[10px] px-2.5 py-1">Cancel</button>
                                                <button type="submit" class="btn-primary text-[10px] px-2.5 py-1">Save Note</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Bottom Actions -->
                            <div class="pt-3 border-t border-[var(--border-subtle)] flex items-center gap-2">
                                <a href="{{ route('discovery.show', $candidate->id) }}" class="btn-secondary flex-1 py-2 text-center text-xs font-bold">
                                    View Full Profile
                                </a>

                                <a href="{{ route('profile.biodata.show', $candidate->id) }}" target="_blank" title="Print Matrimonial Biodata" class="btn-secondary p-2 text-xs">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                    </svg>
                                </a>

                                <form action="{{ route('bookmarks.toggle', $candidate->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" title="Remove from shortlist" class="btn-secondary p-2 text-xs text-[var(--color-danger)] hover:bg-[var(--bg-subtle)]">
                                        ✕
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        @else
            <!-- Free User Upgrade Banner -->
            <div class="bg-[#141412] rounded-[4px] p-8 sm:p-12 text-[#f4f2ee] shadow-xl border border-[#2d2b27]">
                <div class="max-w-2xl space-y-4">
                    <span class="px-3 py-1 rounded-[4px] text-xs font-bold uppercase tracking-wider bg-[var(--accent-primary)]/20 text-[#e0b84c] border border-[var(--accent-primary)]/30 inline-block">
                        Single Marriage Pass Exclusive
                    </span>
                    <h2 class="text-3xl font-extrabold font-heading text-white">
                        Shortlist Candidates for Family Review
                    </h2>
                    <p class="text-xs sm:text-sm text-[#d6d2c8] leading-relaxed">
                        In a Buddhist matrimonial journey, family consultation is key. Upgrade to Single Marriage Pass to shortlist candidates, write private family consultation notes, and download printable Dhamma biodatas for your family elders!
                    </p>
                    <div class="pt-4 flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('subscription.pricing') }}" class="btn-primary text-xs px-7 py-3 text-center">
                            Upgrade to Single Marriage Pass &rarr;
                        </a>
                        <a href="{{ route('discovery.index') }}" class="btn-secondary text-xs px-6 py-3 text-center text-[#d6d2c8]">
                            Browse Candidates
                        </a>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>
@endsection
