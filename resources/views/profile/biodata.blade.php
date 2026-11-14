<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $targetUser->name }} - Buddhist Matrimonial Biodata | Global Vivaha</title>

    <!-- Google Fonts: Marcellus & Source Sans 3 -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&family=Source+Sans+3:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css'])

    <style>
        body { font-family: 'Source Sans 3', system-ui, -apple-system, sans-serif; font-size: 17px; line-height: 1.6; color: var(--color-text); }
        @media (max-width: 640px) { body { font-size: 16px; } }
        .font-heading { font-family: 'Marcellus', Georgia, serif; font-weight: 700; }
        .font-pali { font-family: 'Marcellus', Georgia, serif; letter-spacing: 0.04em; }

        @media print {
            .no-print { display: none !important; }
            body { background: white !important; color: var(--color-text) !important; padding: 0 !important; }
            .biodata-container { box-shadow: none !important; border: 1px solid var(--color-border) !important; margin: 0 !important; width: 100% !important; max-width: 100% !important; padding: 24px !important; }
            .page-break { page-break-after: always; }
        }
    </style>
</head>
<body class="bg-[var(--bg-canvas)] text-[var(--text-primary)] antialiased min-h-screen py-8">

    <!-- Action Toolbar (hidden when printed) -->
    <div class="no-print max-w-4xl mx-auto mb-6 px-4 flex items-center justify-between">
        <a href="{{ url()->previous() }}" class="btn-secondary inline-flex items-center gap-1.5 text-xs py-2 px-4 cursor-pointer">
            &larr; Back
        </a>

        <div class="flex items-center gap-3">
            <span class="text-xs text-[var(--text-secondary)] font-medium">Ready for Family &amp; Elder Consultation</span>
            <button onclick="window.print()" class="btn-primary inline-flex items-center gap-2 text-xs py-2.5 px-5 cursor-pointer">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                <span>Print / Save as PDF</span>
            </button>
        </div>
    </div>

    <!-- Main Printable Biodata Document Sheet -->
    <div class="biodata-container max-w-4xl mx-auto bg-white rounded-[4px] border border-[var(--border-default)] shadow-sm p-8 sm:p-12 space-y-8">

        <!-- Top Header & Metta Blessing -->
        <div class="text-center border-b border-[var(--border-default)] pb-6 space-y-2">
            <div class="font-pali text-lg sm:text-xl font-bold text-[var(--text-primary)] tracking-wider">
                Namo Tassa Bhagavato Arahato Samma Sambuddhassa
            </div>
            <p class="text-[11px] text-[var(--accent-primary)] font-bold uppercase tracking-widest">
                Homage to the Exalted One, the Worthy One, the Fully Enlightened One
            </p>
            <div class="pt-2 flex items-center justify-center gap-2">
                <span class="px-3 py-0.5 rounded-[4px] text-[10px] font-extrabold uppercase tracking-wider bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] border border-[var(--accent-primary)]/20">
                    Dhamma Matrimonial Biodata
                </span>
                <span class="text-xs text-[var(--text-muted)]">•</span>
                <span class="text-xs font-semibold text-[var(--text-primary)]">Global Maitri Platform</span>
            </div>
        </div>

        <!-- Candidate Overview Box -->
        <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6 bg-[var(--bg-subtle)] p-6 rounded-[4px] border border-[var(--border-default)]">
            <div class="w-28 h-28 sm:w-32 sm:h-32 rounded-[3px] overflow-hidden bg-[var(--bg-canvas)] border border-[var(--saffron-gold)]/50 shadow-xs shrink-0 relative">
                @if($profile->primaryPhoto)
                    <img src="{{ $profile->primaryPhoto->displayUrl() }}" alt="{{ $targetUser->name }}"
                         class="w-full h-full object-cover {{ $isPhotoVisible ? '' : 'filter blur-[10px]' }}">
                @else
                    <div class="w-full h-full flex items-center justify-center bg-[var(--bg-subtle)] text-[var(--saffron-gold)] font-serif font-bold text-3xl">
                        {{ substr($targetUser->name, 0, 1) }}
                    </div>
                @endif
                @if(!$isPhotoVisible)
                    <span class="absolute inset-0 flex items-center justify-center bg-black/50 text-[9px] text-white font-bold text-center px-1">
                        Lotus Modesty Blurred
                    </span>
                @endif
            </div>

            <div class="flex-1 text-center sm:text-left space-y-2">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                    <h1 class="text-2xl font-extrabold text-[var(--text-primary)] font-heading">
                        {{ $targetUser->name }}
                    </h1>
                    @if($targetUser->is_verified)
                        <span class="inline-flex items-center gap-1 text-[11px] font-bold text-[var(--accent-primary)] bg-[var(--accent-primary)]/10 px-2.5 py-0.5 rounded-[4px] border border-[var(--accent-primary)]/20 self-center sm:self-auto">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Verified Candidate
                        </span>
                    @endif
                </div>

                <p class="text-xs text-[var(--text-secondary)] font-medium">
                    {{ $targetUser->age }} Years Old • {{ ucfirst($targetUser->gender) }} •
                    <span class="capitalize">{{ str_replace('_', ' ', $targetUser->marital_status ?? 'Single') }}</span>
                    @if($profile->height_cm)
                        • {{ $profile->height_cm }} cm ({{ floor($profile->height_cm / 30.48) }}'{{ round(($profile->height_cm / 2.54) % 12) }}")
                    @endif
                </p>

                <p class="text-xs text-[var(--text-secondary)] flex items-center justify-center sm:justify-start gap-1">
                    <svg class="w-3.5 h-3.5 text-[var(--text-muted)] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span><strong>Location:</strong> {{ $profile->city ? $profile->city . ', ' : '' }}{{ $profile->country ?? 'Not specified' }}</span>
                    @if($profile->mother_tongue)
                        <span class="ml-2">• <strong>Mother Tongue:</strong> {{ $profile->mother_tongue }}</span>
                    @endif
                </p>

                @if($profile->bio)
                    <div class="mt-2 text-xs text-[var(--text-primary)] italic bg-white p-3 rounded-[4px] border border-[var(--border-default)] leading-relaxed">
                        &ldquo;{{ $profile->bio }}&rdquo;
                    </div>
                @endif
            </div>
        </div>

        <!-- Section 1: Buddhist Tradition & Dhamma Practice -->
        <div class="space-y-3">
            <h2 class="text-sm font-extrabold text-[var(--text-primary)] font-heading uppercase tracking-wider flex items-center gap-2 border-b border-[var(--border-default)] pb-2">
                <x-application-logo class="w-4 h-4 text-[var(--accent-primary)] shrink-0" />
                1. Buddhist Tradition &amp; Dhamma Practice
            </h2>

            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 text-xs">
                <div class="bg-[var(--bg-subtle)] p-3 rounded-[4px] border border-[var(--border-subtle)]">
                    <span class="text-[var(--text-muted)] block text-[10px] uppercase font-bold">Tradition</span>
                    <span class="font-bold text-[var(--text-primary)]">{{ $profile->tradition_label }}</span>
                </div>
                <div class="bg-[var(--bg-subtle)] p-3 rounded-[4px] border border-[var(--border-subtle)]">
                    <span class="text-[var(--text-muted)] block text-[10px] uppercase font-bold">Lineage / School</span>
                    <span class="font-bold text-[var(--text-primary)]">{{ $profile->lineage_school ?? 'General' }}</span>
                </div>
                <div class="bg-[var(--bg-subtle)] p-3 rounded-[4px] border border-[var(--border-subtle)]">
                    <span class="text-[var(--text-muted)] block text-[10px] uppercase font-bold">Community (Casteless)</span>
                    <span class="font-bold text-[var(--text-primary)]">{{ $profile->ethnic_community_label }}</span>
                </div>
                <div class="bg-[var(--bg-subtle)] p-3 rounded-[4px] border border-[var(--border-subtle)]">
                    <span class="text-[var(--text-muted)] block text-[10px] uppercase font-bold">Meditation Frequency</span>
                    <span class="font-bold text-[var(--accent-primary)]">{{ $profile->meditation_frequency_label }}</span>
                </div>
                <div class="bg-[var(--bg-subtle)] p-3 rounded-[4px] border border-[var(--border-subtle)]">
                    <span class="text-[var(--text-muted)] block text-[10px] uppercase font-bold">Five Precepts (Panca Sila)</span>
                    <span class="font-bold text-[var(--text-primary)]">{{ $profile->panca_sila_label }}</span>
                </div>
                <div class="bg-[var(--bg-subtle)] p-3 rounded-[4px] border border-[var(--border-subtle)]">
                    <span class="text-[var(--text-muted)] block text-[10px] uppercase font-bold">Temple / Vihara Attendance</span>
                    <span class="font-bold text-[var(--text-primary)]">{{ $profile->temple_label }}</span>
                </div>
                <div class="bg-[var(--bg-subtle)] p-3 rounded-[4px] border border-[var(--border-subtle)]">
                    <span class="text-[var(--text-muted)] block text-[10px] uppercase font-bold">Uposatha Observance</span>
                    <span class="font-bold text-[var(--text-primary)]">{{ $profile->uposatha_label }}</span>
                </div>
                <div class="bg-[var(--bg-subtle)] p-3 rounded-[4px] border border-[var(--border-subtle)]">
                    <span class="text-[var(--text-muted)] block text-[10px] uppercase font-bold">Dhamma Study &amp; Chanting</span>
                    <span class="font-bold text-[var(--text-primary)]">{{ $profile->dhamma_study_label }}</span>
                </div>
                <div class="bg-[var(--bg-subtle)] p-3 rounded-[4px] border border-[var(--border-subtle)]">
                    <span class="text-[var(--text-muted)] block text-[10px] uppercase font-bold">Retreat Experience</span>
                    <span class="font-bold text-[var(--text-primary)]">{{ $profile->retreat_label }}</span>
                </div>
            </div>
        </div>

        <!-- Section 2: Mindful Lifestyle & Precepts -->
        <div class="space-y-3">
            <h2 class="text-sm font-extrabold text-[var(--text-primary)] font-heading uppercase tracking-wider flex items-center gap-2 border-b border-[var(--border-default)] pb-2">
                <x-application-logo class="w-4 h-4 text-[var(--accent-primary)] shrink-0" />
                2. Mindful Lifestyle &amp; Precepts
            </h2>

            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 text-xs">
                <div class="bg-[var(--bg-subtle)] p-3 rounded-[4px] border border-[var(--border-subtle)]">
                    <span class="text-[var(--text-muted)] block text-[10px] uppercase font-bold">Dietary Practice</span>
                    <span class="font-bold text-[var(--text-primary)]">{{ $profile->dietary_label }}</span>
                </div>
                <div class="bg-[var(--bg-subtle)] p-3 rounded-[4px] border border-[var(--border-subtle)]">
                    <span class="text-[var(--text-muted)] block text-[10px] uppercase font-bold">5th Precept (Alcohol/Intoxicants)</span>
                    <span class="font-bold text-[var(--text-primary)]">{{ $profile->alcohol_label }}</span>
                </div>
                <div class="bg-[var(--bg-subtle)] p-3 rounded-[4px] border border-[var(--border-subtle)]">
                    <span class="text-[var(--text-muted)] block text-[10px] uppercase font-bold">Smoking</span>
                    <span class="font-bold text-[var(--text-primary)]">{{ $profile->smoking_label }}</span>
                </div>
            </div>
        </div>

        <!-- Section 3: Education & Profession -->
        <div class="space-y-3">
            <h2 class="text-sm font-extrabold text-[var(--text-primary)] font-heading uppercase tracking-wider flex items-center gap-2 border-b border-[var(--border-default)] pb-2">
                <svg class="w-4 h-4 text-[var(--accent-primary)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M12 14l9-5-9-5-9 5 9 5z"/>
                    <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
                </svg>
                3. Education &amp; Profession
            </h2>

            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 text-xs">
                <div class="bg-[var(--bg-subtle)] p-3 rounded-[4px] border border-[var(--border-subtle)]">
                    <span class="text-[var(--text-muted)] block text-[10px] uppercase font-bold">Education Level</span>
                    <span class="font-bold text-[var(--text-primary)]">{{ $profile->education_level ?? 'Graduate' }}</span>
                </div>
                <div class="bg-[var(--bg-subtle)] p-3 rounded-[4px] border border-[var(--border-subtle)]">
                    <span class="text-[var(--text-muted)] block text-[10px] uppercase font-bold">Profession</span>
                    <span class="font-bold text-[var(--text-primary)]">{{ $profile->profession ?? 'Professional' }}</span>
                </div>
                <div class="bg-[var(--bg-subtle)] p-3 rounded-[4px] border border-[var(--border-subtle)]">
                    <span class="text-[var(--text-muted)] block text-[10px] uppercase font-bold">Employment Type</span>
                    <span class="font-bold text-[var(--text-primary)]">{{ str_replace('_', ' ', $profile->employment_type ?? 'Employed') }}</span>
                </div>
            </div>
        </div>

        <!-- Section 4: Family Background & Raising Children in Dhamma -->
        <div class="space-y-3">
            <h2 class="text-sm font-extrabold text-[var(--text-primary)] font-heading uppercase tracking-wider flex items-center gap-2 border-b border-[var(--border-default)] pb-2">
                <svg class="w-4 h-4 text-[var(--accent-primary)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                4. Family Background &amp; Raising Children
            </h2>

            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 text-xs">
                <div class="bg-[var(--bg-subtle)] p-3 rounded-[4px] border border-[var(--border-subtle)]">
                    <span class="text-[var(--text-muted)] block text-[10px] uppercase font-bold">Parents' Status</span>
                    <span class="font-bold text-[var(--text-primary)]">{{ $profile->parents_status ?? 'Living together' }}</span>
                </div>
                <div class="bg-[var(--bg-subtle)] p-3 rounded-[4px] border border-[var(--border-subtle)]">
                    <span class="text-[var(--text-muted)] block text-[10px] uppercase font-bold">Parents' Occupation</span>
                    <span class="font-bold text-[var(--text-primary)]">{{ $profile->parents_occupation ?? 'Respected family' }}</span>
                </div>
                <div class="bg-[var(--bg-subtle)] p-3 rounded-[4px] border border-[var(--border-subtle)]">
                    <span class="text-[var(--text-muted)] block text-[10px] uppercase font-bold">Siblings Count</span>
                    <span class="font-bold text-[var(--text-primary)]">{{ $profile->siblings_count ?? 'Not specified' }}</span>
                </div>
                <div class="bg-[var(--bg-subtle)] p-3 rounded-[4px] border border-[var(--border-subtle)]">
                    <span class="text-[var(--text-muted)] block text-[10px] uppercase font-bold">Desired Living Arrangement</span>
                    <span class="font-bold text-[var(--text-primary)]">{{ ucfirst(str_replace('_', ' ', $profile->preferred_living_arrangement ?? 'Flexible')) }}</span>
                </div>
            </div>

            @if($profile->views_on_raising_children_in_dhamma)
                <div class="bg-[var(--bg-subtle)] p-3.5 rounded-[4px] border border-[var(--border-subtle)] text-xs">
                    <span class="text-[var(--text-muted)] block text-[10px] uppercase font-bold mb-1">Perspective on Raising Children in Dhamma</span>
                    <p class="text-[var(--text-primary)] italic leading-relaxed">&ldquo;{{ $profile->views_on_raising_children_in_dhamma }}&rdquo;</p>
                </div>
            @endif
        </div>

        <!-- Section 5: Partner Preferences -->
        @php
            $prefs = $profile->partner_preferences ?? [];
        @endphp
        <div class="space-y-3">
            <h2 class="text-sm font-extrabold text-[var(--text-primary)] font-heading uppercase tracking-wider flex items-center gap-2 border-b border-[var(--border-default)] pb-2">
                <svg class="w-4 h-4 text-[var(--accent-primary)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
                5. Desired Partner Preferences
            </h2>

            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 text-xs">
                <div class="bg-[var(--bg-subtle)] p-3 rounded-[4px] border border-[var(--border-subtle)]">
                    <span class="text-[var(--text-muted)] block text-[10px] uppercase font-bold">Preferred Age Range</span>
                    <span class="font-bold text-[var(--text-primary)]">
                        {{ ($prefs['age_min'] ?? null) && ($prefs['age_max'] ?? null) ? $prefs['age_min'] . ' - ' . $prefs['age_max'] . ' Years' : 'Compatible age' }}
                    </span>
                </div>
                <div class="bg-[var(--bg-subtle)] p-3 rounded-[4px] border border-[var(--border-subtle)]">
                    <span class="text-[var(--text-muted)] block text-[10px] uppercase font-bold">Preferred Location</span>
                    <span class="font-bold text-[var(--text-primary)]">{{ $prefs['preferred_location'] ?? 'Open' }}</span>
                </div>
            </div>
        </div>

        <!-- Section 6: Family Representative / Elder Guidance -->
        <div class="space-y-3">
            <h2 class="text-sm font-extrabold text-[var(--text-primary)] font-heading uppercase tracking-wider flex items-center gap-2 border-b border-[var(--border-default)] pb-2">
                <svg class="w-4 h-4 text-[var(--accent-primary)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                6. Family Representative &amp; Kalyāṇa-Mitta Guidance
            </h2>

            @if($activeWaliLink)
                <div class="bg-[var(--accent-primary)]/5 p-4 rounded-[4px] border border-[var(--accent-primary)]/20 text-xs space-y-1">
                    <div class="font-bold text-[var(--text-primary)]">
                        Family Representative (Kalyāṇa-Mitta): {{ $activeWaliLink->wali_name }} ({{ ucfirst(str_replace('_', ' ', $activeWaliLink->relationship_type)) }})
                    </div>
                    <p class="text-[var(--text-secondary)]">
                        Contact: {{ $activeWaliLink->wali_phone ?? $activeWaliLink->wali_email }}
                    </p>
                    <p class="text-[11px] text-[var(--accent-primary)] font-medium">
                        * Matrimonial inquiries are respectfully shared with family representative for mindful guidance and blessing.
                    </p>
                </div>
            @else
                <div class="bg-[var(--bg-subtle)] p-3 rounded-[4px] border border-[var(--border-subtle)] text-xs text-[var(--text-secondary)]">
                    Candidate manages proposal communications directly with family consultation.
                </div>
            @endif
        </div>

        <!-- Bottom Footer & Pali Blessing -->
        <div class="pt-6 border-t border-[var(--border-default)] text-center space-y-2">
            <p class="font-pali text-[var(--text-primary)] text-base font-bold">
                Arogya-paramā lābhā, santi-paramaṁ sukhaṁ
            </p>
            <p class="text-[11px] text-[var(--text-secondary)] italic max-w-xl mx-auto">
                &ldquo;Health is the supreme gain, contentment the greatest wealth, trust the best of kinsmen, and peace the supreme bliss.&rdquo; (Dhammapada: 204)
            </p>
            <p class="text-[10px] text-[var(--text-muted)] pt-2 font-mono">
                Generated via Global Maitri • Buddhist Matrimonial Platform • May you be happy and well • {{ now()->format('d/m/Y') }}
            </p>
        </div>

    </div>

</body>
</html>

