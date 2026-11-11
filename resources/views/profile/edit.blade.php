@extends('layouts.app')

@section('title', 'Your profile details — Global Maitri')

@section('content')
<div class="py-8 sm:py-12 bg-[var(--bg-canvas)] min-h-[calc(100vh-160px)]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <div class="rounded-[var(--radius-lg)] bg-[var(--bg-surface)] border border-[var(--border-default)] p-6 sm:p-8 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 shadow-xs">
            <div class="space-y-1">
                <p class="text-xs font-semibold uppercase tracking-wider text-[var(--accent-primary)]">Profile builder</p>
                <h1 class="font-heading text-2xl font-bold text-[var(--text-primary)]">Your biodata and preferences</h1>
                <p class="text-xs sm:text-sm text-[var(--text-secondary)]">
                    Share your background, practice, and values. Practice fields are descriptive, never judgmental &mdash; we do not rank anyone.
                </p>
            </div>
            <a href="{{ route('profile.show') }}" class="btn-secondary text-xs shrink-0">
                &larr; View profile
            </a>
        </div>

        @if(session('success'))
            <div class="p-4 rounded-[var(--radius-sm)] bg-[var(--bg-surface)] border border-[var(--color-success)] text-[var(--text-primary)] text-xs font-medium flex items-center gap-2.5 shadow-2xs">
                <svg class="w-4 h-4 text-[var(--color-success)] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="p-4 rounded-[var(--radius-sm)] bg-[var(--bg-surface)] border border-[var(--color-danger)] text-xs text-[var(--text-primary)] shadow-2xs">
                <p class="font-bold text-[var(--color-danger)] mb-1">Please check the following fields:</p>
                <ul class="list-disc list-inside space-y-0.5 text-[var(--text-secondary)]">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
            @csrf

            <!-- 1. Buddhist Tradition, Lineage & Community -->
            <div class="rounded-[var(--radius-md)] bg-[var(--bg-surface)] border border-[var(--border-default)] p-6 space-y-4">
                <div class="flex items-center gap-2.5 pb-3 border-b border-[var(--border-subtle)]">
                    <div class="w-8 h-8 rounded-[var(--radius-xs)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18M3 12h18"/></svg>
                    </div>
                    <div>
                        <h2 class="font-heading text-base font-bold text-[var(--text-primary)]">Tradition &amp; background</h2>
                        <p class="text-[11px] text-[var(--text-muted)]">Global Maitri is strictly casteless. Ethnic and cultural community is optional with no hierarchy.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Buddhist tradition <span class="text-[var(--color-danger)]">*</span></label>
                        <select name="tradition" class="input-field text-xs w-full">
                            <option value="">Select tradition</option>
                            @foreach($traditions ?? config('buddhist.traditions') as $code => $label)
                                <option value="{{ $code }}" {{ old('tradition', $profile->tradition) === $code ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Lineage or school</label>
                        <input type="text" name="lineage_school" value="{{ old('lineage_school', $profile->lineage_school) }}" placeholder="e.g. Thai Forest, Zen, Gelug, Vipassana / Mahasi"
                               class="input-field text-xs w-full">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Community (optional)</label>
                        <select name="ethnic_community" class="input-field text-xs w-full">
                            <option value="">Select community</option>
                            @foreach($ethnicCommunities ?? config('buddhist.ethnic_communities') as $code => $label)
                                <option value="{{ $code }}" {{ old('ethnic_community', $profile->ethnic_community) === $code ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-1">
                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Practice depth</label>
                        <select name="practice_depth" class="input-field text-xs w-full">
                            <option value="">Select practice depth</option>
                            @foreach($practiceDepths ?? config('buddhist.practice_depths') as $code => $label)
                                <option value="{{ $code }}" {{ old('practice_depth', $profile->practice_depth) === $code ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Meditation rhythm</label>
                        <select name="meditation_frequency" class="input-field text-xs w-full">
                            <option value="">Select frequency</option>
                            @foreach($meditationFrequencies ?? config('buddhist.meditation_frequencies') as $code => $label)
                                <option value="{{ $code }}" {{ old('meditation_frequency', $profile->meditation_frequency) === $code ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- 2. Precepts, Observances & Lifestyle -->
            <div class="rounded-[var(--radius-md)] bg-[var(--bg-surface)] border border-[var(--border-default)] p-6 space-y-4">
                <div class="flex items-center gap-2.5 pb-3 border-b border-[var(--border-subtle)]">
                    <div class="w-8 h-8 rounded-[var(--radius-xs)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <h2 class="font-heading text-base font-bold text-[var(--text-primary)]">Precepts and everyday practice</h2>
                        <p class="text-[11px] text-[var(--text-muted)]">Share how you live your practice in everyday household life.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Panca Sila (Five Precepts)</label>
                        <select name="panca_sila_adherence" class="input-field text-xs w-full">
                            <option value="">Select adherence</option>
                            @foreach($pancaSilaOptions ?? config('buddhist.panca_sila_adherence') as $code => $label)
                                <option value="{{ $code }}" {{ old('panca_sila_adherence', $profile->panca_sila_adherence) === $code ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Temple / Vihara visits</label>
                        <select name="temple_visits" class="input-field text-xs w-full">
                            <option value="">Select frequency</option>
                            @foreach($templeVisitOptions ?? config('buddhist.temple_visits') as $code => $label)
                                <option value="{{ $code }}" {{ old('temple_visits', $profile->temple_visits) === $code ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Uposatha observance</label>
                        <select name="uposatha_observance" class="input-field text-xs w-full">
                            <option value="">Select observance</option>
                            @foreach($uposathaOptions ?? config('buddhist.uposatha_observance') as $code => $label)
                                <option value="{{ $code }}" {{ old('uposatha_observance', $profile->uposatha_observance) === $code ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Dhamma study &amp; chanting</label>
                        <select name="dhamma_study_chanting" class="input-field text-xs w-full">
                            <option value="">Select level</option>
                            @foreach($dhammaStudyOptions ?? config('buddhist.dhamma_study_chanting') as $code => $label)
                                <option value="{{ $code }}" {{ old('dhamma_study_chanting', $profile->dhamma_study_chanting) === $code ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Retreat experience (Vipassana)</label>
                        <select name="retreat_experience" class="input-field text-xs w-full">
                            <option value="">Select retreat history</option>
                            @foreach($retreatOptions ?? config('buddhist.retreat_experience') as $code => $label)
                                <option value="{{ $code }}" {{ old('retreat_experience', $profile->retreat_experience) === $code ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Diet, 5th Precept Alcohol, Smoking -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-3 border-t border-[var(--border-subtle)]">
                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Dietary preference</label>
                        <select name="dietary_preference" class="input-field text-xs w-full">
                            <option value="">Select diet</option>
                            @foreach($dietaryOptions ?? config('buddhist.dietary_preferences') as $code => $label)
                                <option value="{{ $code }}" {{ old('dietary_preference', $profile->dietary_preference) === $code ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Alcohol (5th Precept)</label>
                        <select name="alcohol_intoxicants" class="input-field text-xs w-full">
                            <option value="">Select stance</option>
                            @foreach($alcoholOptions ?? config('buddhist.alcohol_intoxicants') as $code => $label)
                                <option value="{{ $code }}" {{ old('alcohol_intoxicants', $profile->alcohol_intoxicants) === $code ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Smoking habit</label>
                        <select name="smoking" class="input-field text-xs w-full">
                            <option value="">Select smoking habit</option>
                            @foreach($smokingOptions ?? config('buddhist.smoking_options') as $code => $label)
                                <option value="{{ $code }}" {{ old('smoking', $profile->smoking) === $code ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Family Representative Requirement -->
                <div class="pt-3 border-t border-[var(--border-subtle)]">
                    <label class="flex items-start gap-3 text-xs text-[var(--text-secondary)] cursor-pointer">
                        <input type="checkbox" name="family_rep_required" value="1" {{ old('family_rep_required', $profile->family_rep_required) ? 'checked' : '' }} class="mt-0.5 rounded-[2px] text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                        <div>
                            <strong class="text-[var(--text-primary)] block font-semibold">Involve family representative (Parent / Elder / Relative)</strong>
                            <span class="text-[var(--text-muted)]">When enabled, suitor proposals are routed through your linked family representative for guidance and approval before chat opens.</span>
                        </div>
                    </label>
                </div>
            </div>

            <!-- 3. Photo Privacy -->
            <div class="rounded-[var(--radius-md)] bg-[var(--bg-surface)] border border-[var(--border-default)] p-6 space-y-4">
                <div class="flex items-center gap-2.5 pb-3 border-b border-[var(--border-subtle)]">
                    <div class="w-8 h-8 rounded-[var(--radius-xs)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path stroke-linecap="round" stroke-linejoin="round" d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    </div>
                    <div>
                        <h2 class="font-heading text-base font-bold text-[var(--text-primary)]">Photo privacy</h2>
                        <p class="text-[11px] text-[var(--text-muted)]">Photos stay private until you both agree. You can grant or revoke access at any time.</p>
                    </div>
                </div>

                <div class="max-w-md">
                    <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Photo privacy mode</label>
                    <select name="photo_privacy_mode" class="input-field text-xs w-full">
                        <option value="public" {{ old('photo_privacy_mode', $profile->photo_privacy_mode) === 'public' ? 'selected' : '' }}>Visible to all verified members</option>
                        <option value="blurred_until_accepted" {{ old('photo_privacy_mode', $profile->photo_privacy_mode ?? 'blurred_until_accepted') === 'blurred_until_accepted' ? 'selected' : '' }}>Blurred until interest is mutually accepted (Recommended)</option>
                        <option value="request_only" {{ old('photo_privacy_mode', $profile->photo_privacy_mode) === 'request_only' ? 'selected' : '' }}>Explicit request only</option>
                        <option value="guardian_only" {{ old('photo_privacy_mode', $profile->photo_privacy_mode) === 'guardian_only' ? 'selected' : '' }}>Family representative &amp; mentors only</option>
                    </select>
                </div>
            </div>

            <!-- 4. Optional Horoscope / Porondam Module -->
            <div class="rounded-[var(--radius-md)] bg-[var(--bg-surface)] border border-[var(--border-default)] p-6 space-y-4" x-data="{ horoscopeOn: {{ old('horoscope_required', $profile->horoscope_required) ? 'true' : 'false' }} }">
                <div class="flex items-center justify-between pb-3 border-b border-[var(--border-subtle)]">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-[var(--radius-xs)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        </div>
                        <div>
                            <h2 class="font-heading text-base font-bold text-[var(--text-primary)]">Horoscope details (optional)</h2>
                            <p class="text-[11px] text-[var(--text-muted)]">Horoscope matching is optional. Sinhala Porondam, Thai, or Tibetan birth chart data.</p>
                        </div>
                    </div>
                    <label class="flex items-center gap-2 text-xs font-semibold text-[var(--text-secondary)] cursor-pointer">
                        <input type="checkbox" name="horoscope_required" value="1" x-model="horoscopeOn" class="rounded-[2px] text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                        <span>Include horoscope</span>
                    </label>
                </div>

                <div x-show="horoscopeOn" class="space-y-4 pt-1">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Birth date</label>
                            <input type="date" name="birth_date" value="{{ old('birth_date', $profile->birth_date?->format('Y-m-d')) }}"
                                   class="input-field text-xs w-full">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Birth time</label>
                            <input type="text" name="birth_time" value="{{ old('birth_time', $profile->birth_time) }}" placeholder="e.g. 06:45 AM or 14:30"
                                   class="input-field text-xs w-full">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Birth place</label>
                            <input type="text" name="birth_place" value="{{ old('birth_place', $profile->birth_place) }}" placeholder="e.g. Kandy, Chittagong, Bangkok"
                                   class="input-field text-xs w-full">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Horoscope privacy</label>
                            <select name="horoscope_visibility" class="input-field text-xs w-full">
                                <option value="matched_only" {{ old('horoscope_visibility', $profile->horoscope_visibility ?? 'matched_only') === 'matched_only' ? 'selected' : '' }}>Mutual interest accepted only</option>
                                <option value="granted_only" {{ old('horoscope_visibility', $profile->horoscope_visibility) === 'granted_only' ? 'selected' : '' }}>On explicit permission request</option>
                                <option value="hidden" {{ old('horoscope_visibility', $profile->horoscope_visibility) === 'hidden' ? 'selected' : '' }}>Hidden from all suitors</option>
                            </select>
                        </div>

                        @if($profile->horoscope_file_path)
                            <div class="flex items-center gap-2 pt-6 text-xs text-[var(--color-success)]">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                <span>Chart uploaded</span>
                                <a href="{{ route('profile.horoscope.download', $profile->user_id) }}" class="underline font-semibold ml-1">Download</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- 5. Personal, Education & Career -->
            <div class="rounded-[var(--radius-md)] bg-[var(--bg-surface)] border border-[var(--border-default)] p-6 space-y-4">
                <div class="flex items-center gap-2.5 pb-3 border-b border-[var(--border-subtle)]">
                    <div class="w-8 h-8 rounded-[var(--radius-xs)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/></svg>
                    </div>
                    <h2 class="font-heading text-base font-bold text-[var(--text-primary)]">Education, profession &amp; bio</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Height (cm)</label>
                        <input type="number" name="height_cm" value="{{ old('height_cm', $profile->height_cm) }}" min="120" max="230" placeholder="e.g. 175"
                               class="input-field text-xs w-full">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">City</label>
                        <input type="text" name="city" value="{{ old('city', $profile->city) }}" placeholder="e.g. Chittagong, Colombo, Bangkok, London"
                               class="input-field text-xs w-full">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Country</label>
                        <input type="text" name="country" value="{{ old('country', $profile->country) }}" placeholder="e.g. Bangladesh, Sri Lanka, Thailand"
                               class="input-field text-xs w-full">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Education</label>
                        <input type="text" name="education_level" value="{{ old('education_level', $profile->education_level) }}" placeholder="e.g. Master of Science, BA"
                               class="input-field text-xs w-full">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Profession</label>
                        <input type="text" name="profession" value="{{ old('profession', $profile->profession) }}" placeholder="e.g. Software Engineer, Educator, Doctor"
                               class="input-field text-xs w-full">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Mother tongue</label>
                        <input type="text" name="mother_tongue" value="{{ old('mother_tongue', $profile->mother_tongue) }}" placeholder="e.g. Bengali, Sinhala, Thai, Burmese"
                               class="input-field text-xs w-full">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">About yourself and your aspirations</label>
                    <textarea name="bio" rows="4" class="input-field text-xs w-full leading-relaxed" placeholder="Tell candidates about your daily rhythm, personal values, and what kind of partnership brings peace to your heart...">{{ old('bio', $profile->bio) }}</textarea>
                </div>
            </div>

            <!-- 6. Family Background -->
            <div class="rounded-[var(--radius-md)] bg-[var(--bg-surface)] border border-[var(--border-default)] p-6 space-y-4">
                <div class="flex items-center gap-2.5 pb-3 border-b border-[var(--border-subtle)]">
                    <div class="w-8 h-8 rounded-[var(--radius-xs)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    </div>
                    <h2 class="font-heading text-base font-bold text-[var(--text-primary)]">Family background &amp; future home</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Living arrangement preference</label>
                        <select name="preferred_living_arrangement" class="input-field text-xs w-full">
                            <option value="independent" {{ old('preferred_living_arrangement', $profile->preferred_living_arrangement) === 'independent' ? 'selected' : '' }}>Independent household</option>
                            <option value="living_with_parents" {{ old('preferred_living_arrangement', $profile->preferred_living_arrangement) === 'living_with_parents' ? 'selected' : '' }}>Joint family / with parents</option>
                            <option value="flexible" {{ old('preferred_living_arrangement', $profile->preferred_living_arrangement) === 'flexible' ? 'selected' : '' }}>Open to discussion</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Number of siblings</label>
                        <input type="number" name="siblings_count" value="{{ old('siblings_count', $profile->siblings_count ?? 0) }}" min="0" max="20"
                               class="input-field text-xs w-full">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Parents' background</label>
                        <input type="text" name="parents_occupation" value="{{ old('parents_occupation', $profile->parents_occupation) }}" placeholder="e.g. Retired teacher, business"
                               class="input-field text-xs w-full">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Views on family ethics and raising children</label>
                    <textarea name="views_on_raising_children_in_dhamma" rows="3" class="input-field text-xs w-full leading-relaxed" placeholder="Share your perspective on Buddhist values at home, teaching generosity and mindfulness, and family life...">{{ old('views_on_raising_children_in_dhamma', $profile->views_on_raising_children_in_dhamma) }}</textarea>
                </div>
            </div>

            <!-- 7. Partner Preferences -->
            @php $prefs = $profile->partner_preferences ?? []; @endphp
            <div class="rounded-[var(--radius-md)] bg-[var(--bg-surface)] border border-[var(--border-default)] p-6 space-y-4">
                <div class="flex items-center gap-2.5 pb-3 border-b border-[var(--border-subtle)]">
                    <div class="w-8 h-8 rounded-[var(--radius-xs)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
                    </div>
                    <h2 class="font-heading text-base font-bold text-[var(--text-primary)]">What you are looking for</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Preferred age range</label>
                        <div class="flex items-center gap-2">
                            <input type="number" name="partner_preferences[age_min]" value="{{ old('partner_preferences.age_min', $prefs['age_min'] ?? 20) }}" min="18" max="80" placeholder="Min"
                                   class="input-field text-xs w-full">
                            <span class="text-[var(--text-muted)] text-xs">to</span>
                            <input type="number" name="partner_preferences[age_max]" value="{{ old('partner_preferences.age_max', $prefs['age_max'] ?? 38) }}" min="18" max="80" placeholder="Max"
                                   class="input-field text-xs w-full">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Preferred location</label>
                        <input type="text" name="partner_preferences[preferred_location]" value="{{ old('partner_preferences.preferred_location', $prefs['preferred_location'] ?? '') }}" placeholder="e.g. Bangladesh, Sri Lanka, UK, Open"
                               class="input-field text-xs w-full">
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end gap-3 pt-2">
                <button type="submit" class="btn-primary text-xs sm:text-sm !py-2.5 !px-6">
                    Save changes
                </button>
            </div>
        </form>

        <!-- Separate Horoscope Chart Upload Card -->
        <div class="rounded-[var(--radius-md)] bg-[var(--bg-surface)] border border-[var(--border-default)] p-6 space-y-4">
            <div class="flex items-center gap-2.5 pb-3 border-b border-[var(--border-subtle)]">
                <div class="w-8 h-8 rounded-[var(--radius-xs)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                </div>
                <div>
                    <h2 class="font-heading text-base font-bold text-[var(--text-primary)]">Upload birth chart document (Porondam chart)</h2>
                    <p class="text-xs text-[var(--text-muted)]">PDF or image. Only shared with candidates who have your explicit permission.</p>
                </div>
            </div>

            <form action="{{ route('profile.horoscope.upload') }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                @csrf
                <input type="file" name="horoscope_document" required accept=".pdf,.jpg,.jpeg,.png"
                       class="text-xs file:mr-4 file:py-2 file:px-4 file:rounded-[var(--radius-xs)] file:border-0 file:text-xs file:font-semibold file:bg-[var(--bg-subtle)] file:text-[var(--text-primary)] hover:file:bg-[var(--bg-canvas)] cursor-pointer">
                <button type="submit" class="btn-secondary text-xs !py-2 !px-4">
                    Upload chart
                </button>
            </form>
        </div>

    </div>
</div>
@endsection
