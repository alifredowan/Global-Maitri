@extends('layouts.app')

@section('title', 'Edit Dhamma Profile - Global Maitri')

@section('content')
<div class="py-10 bg-[var(--bg-canvas)] min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <div class="card-ledger p-6 flex items-center justify-between">
            <div>
                <div class="inline-flex items-center gap-1.5 text-[10px] font-extrabold uppercase tracking-widest text-[var(--accent-primary)] mb-1">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="3"/><line x1="12" y1="3" x2="12" y2="9"/><line x1="12" y1="15" x2="12" y2="21"/><line x1="3" y1="12" x2="9" y2="12"/><line x1="15" y1="12" x2="21" y2="12"/></svg>
                    <span>Dhamma Biodata & Preferences</span>
                </div>
                <h1 class="text-2xl font-extrabold text-[var(--text-primary)] font-heading">Edit Buddhist & Personal Profile</h1>
                <p class="text-xs text-[var(--text-muted)] mt-1">Detailed Dhamma practice, lifestyle, and values help our algorithm connect you with compatible lifelong partners.</p>
            </div>
            <a href="{{ route('profile.show') }}" class="btn-secondary text-xs">
                Cancel & Return
            </a>
        </div>

        @if(session('success'))
            <div class="p-4 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-200 text-xs font-semibold flex items-center gap-2 shadow-xs">
                <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="p-4 rounded-xl bg-rose-50 dark:bg-rose-950/60 border border-rose-200 dark:border-rose-800 text-rose-800 dark:text-rose-200 text-xs shadow-xs">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
            @csrf

            <!-- 1. Buddhist Tradition, Lineage & Community (Core Alignment) -->
            <div class="card-ledger p-6 space-y-4">
                <div class="flex items-center gap-2.5 pb-3 border-b border-[var(--border-subtle)]">
                    <div class="w-8 h-8 rounded-lg bg-[var(--bg-subtle)] border border-[var(--border-default)] text-[var(--accent-primary)] flex items-center justify-center">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="3"/><line x1="12" y1="3" x2="12" y2="9"/><line x1="12" y1="15" x2="12" y2="21"/><line x1="3" y1="12" x2="9" y2="12"/><line x1="15" y1="12" x2="21" y2="12"/></svg>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-[var(--text-primary)] font-heading">Buddhist Tradition & Lineage (Core Alignment)</h2>
                        <p class="text-[11px] text-[var(--text-muted)]">Global Maitri is strictly casteless. Ethnic / cultural heritage is optional with no hierarchy.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Buddhist Tradition <span class="text-rose-500">*</span></label>
                        <select name="tradition" class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none">
                            <option value="">Select Tradition</option>
                            @foreach($traditions ?? config('buddhist.traditions') as $code => $label)
                                <option value="{{ $code }}" {{ old('tradition', $profile->tradition) === $code ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Lineage / School</label>
                        <input type="text" name="lineage_school" value="{{ old('lineage_school', $profile->lineage_school) }}" placeholder="e.g. Thai Forest, Zen, Gelug, Vipassana / Mahasi"
                               class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Ethnic / Cultural Community</label>
                        <select name="ethnic_community" class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none">
                            <option value="">Select Community</option>
                            @foreach($ethnicCommunities ?? config('buddhist.ethnic_communities') as $code => $label)
                                <option value="{{ $code }}" {{ old('ethnic_community', $profile->ethnic_community) === $code ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Practice Depth / Commitment</label>
                        <select name="practice_depth" class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none">
                            <option value="">Select Practice Depth</option>
                            @foreach($practiceDepths ?? config('buddhist.practice_depths') as $code => $label)
                                <option value="{{ $code }}" {{ old('practice_depth', $profile->practice_depth) === $code ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Meditation Frequency</label>
                        <select name="meditation_frequency" class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none">
                            <option value="">Select Frequency</option>
                            @foreach($meditationFrequencies ?? config('buddhist.meditation_frequencies') as $code => $label)
                                <option value="{{ $code }}" {{ old('meditation_frequency', $profile->meditation_frequency) === $code ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- 2. Dhamma Observances, Precepts & Lifestyle -->
            <div class="card-ledger p-6 space-y-4">
                <div class="flex items-center gap-2.5 pb-3 border-b border-[var(--border-subtle)]">
                    <div class="w-8 h-8 rounded-lg bg-[var(--bg-subtle)] border border-[var(--border-default)] text-[var(--accent-primary)] flex items-center justify-center">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 3v18"/><path d="M3 12h18"/></svg>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-[var(--text-primary)] font-heading">Precepts, Temple Visits & Dhamma Observances</h2>
                        <p class="text-[11px] text-[var(--text-muted)]">Panca Sila adherence and mindful living habits (Five Precepts).</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Panca Sila (Five Precepts)</label>
                        <select name="panca_sila_adherence" class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none">
                            <option value="">Select Adherence</option>
                            @foreach($pancaSilaOptions ?? config('buddhist.panca_sila_adherence') as $code => $label)
                                <option value="{{ $code }}" {{ old('panca_sila_adherence', $profile->panca_sila_adherence) === $code ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Temple / Vihara Attendance</label>
                        <select name="temple_visits" class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none">
                            <option value="">Select Attendance</option>
                            @foreach($templeVisitOptions ?? config('buddhist.temple_visits') as $code => $label)
                                <option value="{{ $code }}" {{ old('temple_visits', $profile->temple_visits) === $code ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Uposatha Observance</label>
                        <select name="uposatha_observance" class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none">
                            <option value="">Select Observance</option>
                            @foreach($uposathaOptions ?? config('buddhist.uposatha_observance') as $code => $label)
                                <option value="{{ $code }}" {{ old('uposatha_observance', $profile->uposatha_observance) === $code ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Dhamma Study & Chanting</label>
                        <select name="dhamma_study_chanting" class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none">
                            <option value="">Select Dhamma Study Level</option>
                            @foreach($dhammaStudyOptions ?? config('buddhist.dhamma_study_chanting') as $code => $label)
                                <option value="{{ $code }}" {{ old('dhamma_study_chanting', $profile->dhamma_study_chanting) === $code ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Retreat Experience (Vipassana)</label>
                        <select name="retreat_experience" class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none">
                            <option value="">Select Retreat History</option>
                            @foreach($retreatOptions ?? config('buddhist.retreat_experience') as $code => $label)
                                <option value="{{ $code }}" {{ old('retreat_experience', $profile->retreat_experience) === $code ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Mindful Lifestyle: Diet, 5th Precept Alcohol, Smoking -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-3 border-t border-[var(--border-subtle)]">
                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Dietary Preference</label>
                        <select name="dietary_preference" class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none">
                            <option value="">Select Diet</option>
                            @foreach($dietaryOptions ?? config('buddhist.dietary_preferences') as $code => $label)
                                <option value="{{ $code }}" {{ old('dietary_preference', $profile->dietary_preference) === $code ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Alcohol & Intoxicants (5th Precept)</label>
                        <select name="alcohol_intoxicants" class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none">
                            <option value="">Select Stance</option>
                            @foreach($alcoholOptions ?? config('buddhist.alcohol_intoxicants') as $code => $label)
                                <option value="{{ $code }}" {{ old('alcohol_intoxicants', $profile->alcohol_intoxicants) === $code ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Smoking Habit</label>
                        <select name="smoking" class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none">
                            <option value="">Select Smoking Habit</option>
                            @foreach($smokingOptions ?? config('buddhist.smoking_options') as $code => $label)
                                <option value="{{ $code }}" {{ old('smoking', $profile->smoking) === $code ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Family Representative Requirement -->
                <div class="pt-4 border-t border-[var(--border-subtle)]">
                    <label class="flex items-start gap-3 text-xs text-[var(--text-secondary)] cursor-pointer">
                        <input type="checkbox" name="family_rep_required" value="1" {{ old('family_rep_required', $profile->family_rep_required) ? 'checked' : '' }} class="mt-0.5 rounded text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                        <div>
                            <strong class="text-[var(--text-primary)] block font-bold">Involve Family Representative (Parent / Elder / Relative)</strong>
                            <span class="text-[var(--text-muted)]">When enabled, suitor proposals are routed through your linked family representative for guidance and approval before private messaging unlocks (applicable to both grooms and brides).</span>
                        </div>
                    </label>
                </div>
            </div>

            <!-- 3. Photo Privacy & Modesty Controls -->
            <div class="card-ledger p-6 space-y-4">
                <div class="flex items-center gap-2.5 pb-3 border-b border-[var(--border-subtle)]">
                    <div class="w-8 h-8 rounded-lg bg-[var(--bg-subtle)] border border-[var(--border-default)] text-[var(--accent-primary)] flex items-center justify-center">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-[var(--text-primary)] font-heading">Photo Privacy & Visibility Settings</h2>
                        <p class="text-[11px] text-[var(--text-muted)]">Control who can see your photos without blur. You can grant or revoke access per person at any time.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Photo Privacy Mode</label>
                        <select name="photo_privacy_mode" class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none">
                            <option value="public" {{ old('photo_privacy_mode', $profile->photo_privacy_mode) === 'public' ? 'selected' : '' }}>Public (Visible to all verified members)</option>
                            <option value="blurred_until_accepted" {{ old('photo_privacy_mode', $profile->photo_privacy_mode ?? 'blurred_until_accepted') === 'blurred_until_accepted' ? 'selected' : '' }}>Lotus Blur (Blurred until interest/proposal is mutually accepted)</option>
                            <option value="request_only" {{ old('photo_privacy_mode', $profile->photo_privacy_mode) === 'request_only' ? 'selected' : '' }}>Request Only (Visible strictly upon explicit permission grant)</option>
                            <option value="guardian_only" {{ old('photo_privacy_mode', $profile->photo_privacy_mode) === 'guardian_only' ? 'selected' : '' }}>Guardian &amp; Sangha Advisor Only (Visible solely to verified Family Reps &amp; Monastic Mentors)</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- 4. Optional Horoscope / Sinhalese Porondam Module -->
            <div class="card-ledger p-6 space-y-4" x-data="{ horoscopeOn: {{ old('horoscope_required', $profile->horoscope_required) ? 'true' : 'false' }} }">
                <div class="flex items-center justify-between pb-3 border-b border-[var(--border-subtle)]">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-[var(--bg-subtle)] border border-[var(--border-default)] text-[var(--accent-primary)] flex items-center justify-center">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        </div>
                        <div>
                            <h2 class="text-base font-bold text-[var(--text-primary)] font-heading">Astrological / Horoscope Matching (Optional)</h2>
                            <p class="text-[11px] text-[var(--text-muted)]">Sinhalese 20-Porondam, Thai or Tibetan astrological birth data. Hidden by default for privacy.</p>
                        </div>
                    </div>
                    <label class="flex items-center gap-2 text-xs font-bold text-[var(--text-secondary)] cursor-pointer">
                        <input type="checkbox" name="horoscope_required" value="1" x-model="horoscopeOn" class="rounded text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                        <span>Enable Horoscope Module</span>
                    </label>
                </div>

                <div x-show="horoscopeOn" class="space-y-4 pt-2">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Birth Date</label>
                            <input type="date" name="birth_date" value="{{ old('birth_date', $profile->birth_date?->format('Y-m-d')) }}"
                                   class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Exact Birth Time</label>
                            <input type="text" name="birth_time" value="{{ old('birth_time', $profile->birth_time) }}" placeholder="e.g. 06:45 AM / 14:30"
                                   class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Birth Place / City</label>
                            <input type="text" name="birth_place" value="{{ old('birth_place', $profile->birth_place) }}" placeholder="e.g. Kandy, Colombo, Chittagong"
                                   class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Horoscope Privacy / Visibility</label>
                            <select name="horoscope_visibility" class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none">
                                <option value="matched_only" {{ old('horoscope_visibility', $profile->horoscope_visibility ?? 'matched_only') === 'matched_only' ? 'selected' : '' }}>Matched Only (Mutual interest accepted)</option>
                                <option value="granted_only" {{ old('horoscope_visibility', $profile->horoscope_visibility) === 'granted_only' ? 'selected' : '' }}>Granted Only (Explicit permission request)</option>
                                <option value="hidden" {{ old('horoscope_visibility', $profile->horoscope_visibility) === 'hidden' ? 'selected' : '' }}>Hidden from all suitors</option>
                            </select>
                        </div>

                        @if($profile->horoscope_file_path)
                            <div class="flex items-center gap-3 pt-5 text-xs text-emerald-700 dark:text-emerald-400">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                                <span>Horoscope Document Uploaded</span>
                                <a href="{{ route('profile.horoscope.download', $profile->user_id) }}" class="underline font-bold">Download / View</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- 5. Personal, Education & Career Details -->
            <div class="card-ledger p-6 space-y-4">
                <div class="flex items-center gap-2.5 pb-3 border-b border-[var(--border-subtle)]">
                    <div class="w-8 h-8 rounded-lg bg-[var(--bg-subtle)] border border-[var(--border-default)] text-[var(--accent-primary)] flex items-center justify-center">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                    </div>
                    <h2 class="text-base font-bold text-[var(--text-primary)] font-heading">Personal, Education & Profession</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Height (cm)</label>
                        <input type="number" name="height_cm" value="{{ old('height_cm', $profile->height_cm) }}" min="120" max="230" placeholder="e.g. 175"
                               class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">City</label>
                        <input type="text" name="city" value="{{ old('city', $profile->city) }}" placeholder="e.g. Colombo, Bangkok, Chittagong, London"
                               class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Country</label>
                        <input type="text" name="country" value="{{ old('country', $profile->country) }}" placeholder="e.g. Sri Lanka, Bangladesh, Thailand, United Kingdom"
                               class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Education Level</label>
                        <input type="text" name="education_level" value="{{ old('education_level', $profile->education_level) }}" placeholder="e.g. Master of Computer Science, BA Buddhist Studies"
                               class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Profession</label>
                        <input type="text" name="profession" value="{{ old('profession', $profile->profession) }}" placeholder="e.g. Software Engineer, Doctor, Educator"
                               class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Mother Tongue</label>
                        <input type="text" name="mother_tongue" value="{{ old('mother_tongue', $profile->mother_tongue) }}" placeholder="e.g. Sinhala, Bengali, Thai, Tibetan, English"
                               class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Bio / Sincere Matrimonial Intentions</label>
                    <textarea name="bio" rows="4" class="w-full p-3 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none" placeholder="Describe your Dhamma practice, lifestyle, values, and what you seek in a lifelong partner with loving-kindness (Metta)...">{{ old('bio', $profile->bio) }}</textarea>
                </div>
            </div>

            <!-- 6. Family Background, Living Arrangements & Raising Children -->
            <div class="card-ledger p-6 space-y-4">
                <div class="flex items-center gap-2.5 pb-3 border-b border-[var(--border-subtle)]">
                    <div class="w-8 h-8 rounded-lg bg-[var(--bg-subtle)] border border-[var(--border-default)] text-[var(--accent-primary)] flex items-center justify-center">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    </div>
                    <h2 class="text-base font-bold text-[var(--text-primary)] font-heading">Family Background & Raising Children in Dhamma</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Family Structure Desired</label>
                        <select name="preferred_living_arrangement" class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none">
                            <option value="independent" {{ old('preferred_living_arrangement', $profile->preferred_living_arrangement) === 'independent' ? 'selected' : '' }}>Independent Household</option>
                            <option value="living_with_parents" {{ old('preferred_living_arrangement', $profile->preferred_living_arrangement) === 'living_with_parents' ? 'selected' : '' }}>Living with Parents / Joint</option>
                            <option value="flexible" {{ old('preferred_living_arrangement', $profile->preferred_living_arrangement) === 'flexible' ? 'selected' : '' }}>Flexible / Open to Discussion</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Number of Siblings</label>
                        <input type="number" name="siblings_count" value="{{ old('siblings_count', $profile->siblings_count ?? 0) }}" min="0" max="20"
                               class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Parents' Occupation</label>
                        <input type="text" name="parents_occupation" value="{{ old('parents_occupation', $profile->parents_occupation) }}" placeholder="e.g. Teacher, Civil Service, Retired"
                               class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Views on Raising Children in Dhamma</label>
                    <textarea name="views_on_raising_children_in_dhamma" rows="3" class="w-full p-3 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none" placeholder="Share your perspective on Buddhist moral upbringing, Dhamma school attendance, learning meditation, and family ethics...">{{ old('views_on_raising_children_in_dhamma', $profile->views_on_raising_children_in_dhamma) }}</textarea>
                </div>
            </div>

            <!-- 7. Partner Preferences (Looking For) -->
            @php $prefs = $profile->partner_preferences ?? []; @endphp
            <div class="card-ledger p-6 space-y-4">
                <div class="flex items-center gap-2.5 pb-3 border-b border-[var(--border-subtle)]">
                    <div class="w-8 h-8 rounded-lg bg-[var(--bg-subtle)] border border-[var(--border-default)] text-[var(--accent-primary)] flex items-center justify-center">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
                    </div>
                    <h2 class="text-base font-bold text-[var(--text-primary)] font-heading">Partner Preferences (Algorithmic Targeting)</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Preferred Age Range</label>
                        <div class="flex items-center gap-2">
                            <input type="number" name="partner_preferences[age_min]" value="{{ old('partner_preferences.age_min', $prefs['age_min'] ?? 20) }}" min="18" max="80" placeholder="Min"
                                   class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none">
                            <span class="text-[var(--text-muted)] text-xs">to</span>
                            <input type="number" name="partner_preferences[age_max]" value="{{ old('partner_preferences.age_max', $prefs['age_max'] ?? 38) }}" min="18" max="80" placeholder="Max"
                                   class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Preferred Location</label>
                        <input type="text" name="partner_preferences[preferred_location]" value="{{ old('partner_preferences.preferred_location', $prefs['preferred_location'] ?? '') }}" placeholder="e.g. Sri Lanka, Thailand, United Kingdom, Open"
                               class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none">
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end gap-3 pt-2">
                <button type="submit" class="btn-primary text-sm px-8 py-3.5 justify-center">
                    Save Profile Changes
                </button>
            </div>
        </form>

        <!-- Separate Horoscope Document Upload Card (if enabled) -->
        <div class="card-ledger p-6 space-y-4">
            <div class="flex items-center gap-2.5 pb-3 border-b border-[var(--border-subtle)]">
                <div class="w-8 h-8 rounded-lg bg-[var(--bg-subtle)] border border-[var(--border-default)] text-[var(--accent-primary)] flex items-center justify-center">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                </div>
                <div>
                    <h2 class="text-base font-bold text-[var(--text-primary)] font-heading">Upload Horoscope Document (Porondam Chart)</h2>
                    <p class="text-xs text-[var(--text-muted)]">PDF or image of birth chart. Only visible to verified suitors according to your privacy settings.</p>
                </div>
            </div>

            <form action="{{ route('profile.horoscope.upload') }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                @csrf
                <input type="file" name="horoscope_document" required accept=".pdf,.jpg,.jpeg,.png"
                       class="text-xs file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-bold file:bg-[var(--bg-subtle)] file:text-[var(--accent-primary)] file:border file:border-[var(--border-default)] hover:file:bg-[var(--bg-canvas)] cursor-pointer">
                <button type="submit" class="btn-primary text-xs px-5 py-2.5">
                    Upload Chart
                </button>
            </form>
        </div>

    </div>
</div>
@endsection
