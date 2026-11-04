<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $targetUser->name }} - Buddhist Matrimonial Biodata | Global Maitri</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700;800&family=Outfit:wght@400;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-heading { font-family: 'Outfit', sans-serif; }
        .font-pali { font-family: 'Cinzel', serif; letter-spacing: 0.05em; }

        @media print {
            .no-print { display: none !important; }
            body { background: white !important; color: #0f172a !important; padding: 0 !important; }
            .biodata-container { box-shadow: none !important; border: 1px solid #e2e8f0 !important; margin: 0 !important; width: 100% !important; max-width: 100% !important; padding: 24px !important; }
            .page-break { page-break-after: always; }
        }
    </style>
</head>
<body class="bg-slate-100 text-slate-800 antialiased min-h-screen py-8">

    <!-- Action Toolbar (hidden when printed) -->
    <div class="no-print max-w-4xl mx-auto mb-6 px-4 flex items-center justify-between">
        <a href="{{ url()->previous() }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-white text-slate-700 text-xs font-bold border border-slate-200 shadow-xs hover:bg-slate-50 transition">
            &larr; Back
        </a>

        <div class="flex items-center gap-2">
            <span class="text-xs text-slate-500 font-medium">Ready for Family & Elder Consultation</span>
            <button onclick="window.print()" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-primary-700 hover:bg-primary-800 text-white font-bold text-xs shadow-md transition cursor-pointer">
                <span>🖨️</span> Print / Save as PDF
            </button>
        </div>
    </div>

    <!-- Main Printable Biodata Document Sheet -->
    <div class="biodata-container max-w-4xl mx-auto bg-white rounded-3xl border border-slate-200 shadow-xl p-8 sm:p-12 space-y-8">

        <!-- Top Header & Metta Blessing -->
        <div class="text-center border-b border-rose-900/10 pb-6 space-y-2">
            <div class="font-pali text-lg sm:text-xl font-bold text-primary-900 tracking-wider">
                Namo Tassa Bhagavato Arahato Samma Sambuddhassa
            </div>
            <p class="text-[11px] text-amber-800 font-bold uppercase tracking-widest">
                Homage to the Exalted One, the Worthy One, the Fully Enlightened One
            </p>
            <div class="pt-2 flex items-center justify-center gap-2">
                <span class="px-3 py-0.5 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-rose-50 text-primary-800 border border-rose-200">
                    Dhamma Matrimonial Biodata
                </span>
                <span class="text-xs text-slate-400">•</span>
                <span class="text-xs font-semibold text-primary-900">Global Maitri Platform</span>
            </div>
        </div>

        <!-- Candidate Overview Box -->
        <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6 bg-slate-50 p-6 rounded-2xl border border-slate-200/80">
            <div class="w-28 h-28 sm:w-32 sm:h-32 rounded-2xl overflow-hidden bg-slate-900 border-2 border-primary-700 shadow-md shrink-0 relative">
                @if($profile->primaryPhoto)
                    <img src="{{ $profile->primaryPhoto->displayUrl() }}" alt="{{ $targetUser->name }}"
                         class="w-full h-full object-cover {{ $isPhotoVisible ? '' : 'filter blur-[10px]' }}">
                @else
                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-rose-950 to-slate-900 text-amber-200 font-bold text-3xl">
                        {{ substr($targetUser->name, 0, 1) }}
                    </div>
                @endif
                @if(!$isPhotoVisible)
                    <span class="absolute inset-0 flex items-center justify-center bg-black/40 text-[9px] text-white font-bold text-center px-1">
                        🔒 Lotus Modesty Blurred
                    </span>
                @endif
            </div>

            <div class="flex-1 text-center sm:text-left space-y-2">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                    <h1 class="text-2xl font-extrabold text-slate-900 font-heading">
                        {{ $targetUser->name }}
                    </h1>
                    @if($targetUser->is_verified)
                        <span class="inline-flex items-center gap-1 text-[11px] font-bold text-blue-700 bg-blue-50 px-2.5 py-0.5 rounded-full border border-blue-200 self-center sm:self-auto">
                            ✓ Verified Candidate
                        </span>
                    @endif
                </div>

                <p class="text-xs text-slate-600 font-medium">
                    {{ $targetUser->age }} Years Old • {{ ucfirst($targetUser->gender) }} •
                    <span class="capitalize">{{ str_replace('_', ' ', $targetUser->marital_status ?? 'Single') }}</span>
                    @if($profile->height_cm)
                        • {{ $profile->height_cm }} cm ({{ floor($profile->height_cm / 30.48) }}'{{ round(($profile->height_cm / 2.54) % 12) }}")
                    @endif
                </p>

                <p class="text-xs text-slate-600">
                    📍 <strong>Location:</strong> {{ $profile->city ? $profile->city . ', ' : '' }}{{ $profile->country ?? 'Not specified' }}
                    @if($profile->mother_tongue)
                        • <strong>Mother Tongue:</strong> {{ $profile->mother_tongue }}
                    @endif
                </p>

                @if($profile->bio)
                    <div class="mt-2 text-xs text-slate-700 italic bg-white p-3 rounded-xl border border-slate-200 leading-relaxed">
                        &ldquo;{{ $profile->bio }}&rdquo;
                    </div>
                @endif
            </div>
        </div>

        <!-- Section 1: Buddhist Tradition & Dhamma Practice -->
        <div class="space-y-3">
            <h2 class="text-sm font-extrabold text-primary-950 font-heading uppercase tracking-wider flex items-center gap-2 border-b border-slate-200 pb-2">
                <span>🪷</span> 1. Buddhist Tradition & Dhamma Practice
            </h2>

            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 text-xs">
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <span class="text-slate-500 block text-[10px] uppercase font-bold">Tradition</span>
                    <span class="font-bold text-slate-900">{{ $profile->tradition_label }}</span>
                </div>
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <span class="text-slate-500 block text-[10px] uppercase font-bold">Lineage / School</span>
                    <span class="font-bold text-slate-900">{{ $profile->lineage_school ?? 'General' }}</span>
                </div>
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <span class="text-slate-500 block text-[10px] uppercase font-bold">Community (Casteless)</span>
                    <span class="font-bold text-slate-900">{{ $profile->ethnic_community_label }}</span>
                </div>
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <span class="text-slate-500 block text-[10px] uppercase font-bold">Meditation Frequency</span>
                    <span class="font-bold text-primary-800">{{ $profile->meditation_frequency_label }}</span>
                </div>
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <span class="text-slate-500 block text-[10px] uppercase font-bold">Five Precepts (Panca Sila)</span>
                    <span class="font-bold text-slate-900">{{ $profile->panca_sila_label }}</span>
                </div>
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <span class="text-slate-500 block text-[10px] uppercase font-bold">Temple / Vihara Attendance</span>
                    <span class="font-bold text-slate-900">{{ $profile->temple_label }}</span>
                </div>
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <span class="text-slate-500 block text-[10px] uppercase font-bold">Uposatha Observance</span>
                    <span class="font-bold text-slate-900">{{ $profile->uposatha_label }}</span>
                </div>
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <span class="text-slate-500 block text-[10px] uppercase font-bold">Dhamma Study & Chanting</span>
                    <span class="font-bold text-slate-900">{{ $profile->dhamma_study_label }}</span>
                </div>
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <span class="text-slate-500 block text-[10px] uppercase font-bold">Retreat Experience</span>
                    <span class="font-bold text-slate-900">{{ $profile->retreat_label }}</span>
                </div>
            </div>
        </div>

        <!-- Section 2: Mindful Lifestyle & Precepts -->
        <div class="space-y-3">
            <h2 class="text-sm font-extrabold text-primary-950 font-heading uppercase tracking-wider flex items-center gap-2 border-b border-slate-200 pb-2">
                <span>☸️</span> 2. Mindful Lifestyle & Precepts
            </h2>

            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 text-xs">
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <span class="text-slate-500 block text-[10px] uppercase font-bold">Dietary Practice</span>
                    <span class="font-bold text-slate-900">{{ $profile->dietary_label }}</span>
                </div>
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <span class="text-slate-500 block text-[10px] uppercase font-bold">5th Precept (Alcohol/Intoxicants)</span>
                    <span class="font-bold text-slate-900">{{ $profile->alcohol_label }}</span>
                </div>
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <span class="text-slate-500 block text-[10px] uppercase font-bold">Smoking</span>
                    <span class="font-bold text-slate-900">{{ $profile->smoking_label }}</span>
                </div>
            </div>
        </div>

        <!-- Section 3: Education & Profession -->
        <div class="space-y-3">
            <h2 class="text-sm font-extrabold text-primary-950 font-heading uppercase tracking-wider flex items-center gap-2 border-b border-slate-200 pb-2">
                <span>🎓</span> 3. Education & Profession
            </h2>

            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 text-xs">
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <span class="text-slate-500 block text-[10px] uppercase font-bold">Education Level</span>
                    <span class="font-bold text-slate-900">{{ $profile->education_level ?? 'Graduate' }}</span>
                </div>
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <span class="text-slate-500 block text-[10px] uppercase font-bold">Profession</span>
                    <span class="font-bold text-slate-900">{{ $profile->profession ?? 'Professional' }}</span>
                </div>
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <span class="text-slate-500 block text-[10px] uppercase font-bold">Employment Type</span>
                    <span class="font-bold text-slate-900">{{ str_replace('_', ' ', $profile->employment_type ?? 'Employed') }}</span>
                </div>
            </div>
        </div>

        <!-- Section 4: Family Background & Raising Children in Dhamma -->
        <div class="space-y-3">
            <h2 class="text-sm font-extrabold text-primary-950 font-heading uppercase tracking-wider flex items-center gap-2 border-b border-slate-200 pb-2">
                <span>🏡</span> 4. Family Background & Raising Children
            </h2>

            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 text-xs">
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <span class="text-slate-500 block text-[10px] uppercase font-bold">Parents' Status</span>
                    <span class="font-bold text-slate-900">{{ $profile->parents_status ?? 'Living together' }}</span>
                </div>
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <span class="text-slate-500 block text-[10px] uppercase font-bold">Parents' Occupation</span>
                    <span class="font-bold text-slate-900">{{ $profile->parents_occupation ?? 'Respected family' }}</span>
                </div>
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <span class="text-slate-500 block text-[10px] uppercase font-bold">Siblings Count</span>
                    <span class="font-bold text-slate-900">{{ $profile->siblings_count ?? 'Not specified' }}</span>
                </div>
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <span class="text-slate-500 block text-[10px] uppercase font-bold">Desired Living Arrangement</span>
                    <span class="font-bold text-slate-900">{{ ucfirst(str_replace('_', ' ', $profile->preferred_living_arrangement ?? 'Flexible')) }}</span>
                </div>
            </div>

            @if($profile->views_on_raising_children_in_dhamma)
                <div class="bg-slate-50 p-3.5 rounded-xl border border-slate-100 text-xs">
                    <span class="text-slate-500 block text-[10px] uppercase font-bold mb-1">Perspective on Raising Children in Dhamma</span>
                    <p class="text-slate-800 italic leading-relaxed">&ldquo;{{ $profile->views_on_raising_children_in_dhamma }}&rdquo;</p>
                </div>
            @endif
        </div>

        <!-- Section 5: Partner Preferences -->
        @php
            $prefs = $profile->partner_preferences ?? [];
        @endphp
        <div class="space-y-3">
            <h2 class="text-sm font-extrabold text-primary-950 font-heading uppercase tracking-wider flex items-center gap-2 border-b border-slate-200 pb-2">
                <span>💍</span> 5. Desired Partner Preferences
            </h2>

            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 text-xs">
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <span class="text-slate-500 block text-[10px] uppercase font-bold">Preferred Age Range</span>
                    <span class="font-bold text-slate-900">
                        {{ ($prefs['age_min'] ?? null) && ($prefs['age_max'] ?? null) ? $prefs['age_min'] . ' - ' . $prefs['age_max'] . ' Years' : 'Compatible age' }}
                    </span>
                </div>
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <span class="text-slate-500 block text-[10px] uppercase font-bold">Preferred Location</span>
                    <span class="font-bold text-slate-900">{{ $prefs['preferred_location'] ?? 'Open' }}</span>
                </div>
            </div>
        </div>

        <!-- Section 6: Family Representative / Elder Guidance -->
        <div class="space-y-3">
            <h2 class="text-sm font-extrabold text-primary-950 font-heading uppercase tracking-wider flex items-center gap-2 border-b border-slate-200 pb-2">
                <span>🛡️</span> 6. Family Representative & Elder Guidance
            </h2>

            @if($activeWaliLink)
                <div class="bg-rose-50/60 p-4 rounded-xl border border-rose-200/80 text-xs space-y-1">
                    <div class="font-bold text-primary-950">
                        Family Representative: {{ $activeWaliLink->wali_name }} ({{ ucfirst(str_replace('_', ' ', $activeWaliLink->relationship_type)) }})
                    </div>
                    <p class="text-primary-800">
                        Contact: {{ $activeWaliLink->wali_phone ?? $activeWaliLink->wali_email }}
                    </p>
                    <p class="text-[11px] text-primary-700">
                        * Matrimonial inquiries are respectfully shared with family representative for mindful guidance and blessing.
                    </p>
                </div>
            @else
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100 text-xs text-slate-600">
                    Candidate manages proposal communications directly with family consultation.
                </div>
            @endif
        </div>

        <!-- Bottom Footer & Pali Blessing -->
        <div class="pt-6 border-t border-slate-200 text-center space-y-2">
            <p class="font-pali text-primary-950 text-base font-bold">
                Arogya-paramā lābhā, santi-paramaṁ sukhaṁ
            </p>
            <p class="text-[11px] text-slate-600 italic max-w-xl mx-auto">
                &ldquo;Health is the supreme gain, contentment the greatest wealth, trust the best of kinsmen, and peace the supreme bliss.&rdquo; (Dhammapada: 204)
            </p>
            <p class="text-[10px] text-slate-400 pt-2 font-mono">
                Generated via Global Maitri • Buddhist Matrimonial Platform • May you be happy and well • {{ now()->format('d/m/Y') }}
            </p>
        </div>

    </div>

</body>
</html>
