<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Buddhist Traditions & Lineages (URS 1.3, FR-2.3)
    |--------------------------------------------------------------------------
    */
    'traditions' => [
        'theravada' => 'Theravada (Way of the Elders)',
        'mahayana' => 'Mahayana (Great Vehicle)',
        'vajrayana' => 'Vajrayana / Tibetan Buddhism',
        'navayana' => 'Navayana (Ambedkarite Buddhist)',
        'non_denominational' => 'Non-denominational / Eclectic Buddhist',
    ],

    'lineages' => [
        'thai_forest' => 'Thai Forest Tradition',
        'sri_lankan_mahavihara' => 'Sri Lankan Mahavihara',
        'vipassana_tradition' => 'Vipassana (S.N. Goenka / Mahasi Sayadaw)',
        'zen_chan' => 'Zen / Chan / Seon',
        'tibetan_gelug' => 'Tibetan - Gelug',
        'tibetan_kagyu' => 'Tibetan - Kagyu',
        'tibetan_nyingma' => 'Tibetan - Nyingma',
        'tibetan_sakya' => 'Tibetan - Sakya',
        'pure_land' => 'Pure Land',
        'nichiren' => 'Nichiren',
        'triratna' => 'Triratna Buddhist Community',
        'other' => 'Other Buddhist Lineage / School',
    ],

    /*
    |--------------------------------------------------------------------------
    | Cultural / Ethnic Communities (Optional, strictly NO CASTE system)
    | (URS 2.2, FR-2.3)
    |--------------------------------------------------------------------------
    */
    'ethnic_communities' => [
        'no_preference' => 'No Preference / Open to All',
        'barua' => 'Barua (Bangladesh / India)',
        'chakma' => 'Chakma (Bangladesh / India)',
        'marma' => 'Marma (Bangladesh / Myanmar)',
        'rakhine' => 'Rakhine (Myanmar / Bangladesh)',
        'sinhalese' => 'Sinhalese (Sri Lanka)',
        'tibetan' => 'Tibetan',
        'thai' => 'Thai',
        'burmese' => 'Burmese / Bamar',
        'newar' => 'Newar (Nepal)',
        'ambedkarite' => 'Ambedkarite / Dalit Buddhist',
        'ladakhi' => 'Ladakhi / Himalayan',
        'vietnamese' => 'Vietnamese',
        'chinese' => 'Chinese Buddhist',
        'convert_western' => 'Convert / Western Buddhist',
        'other' => 'Other Community',
    ],

    /*
    |--------------------------------------------------------------------------
    | Practice Depth & Observance (URS FR-2.4)
    |--------------------------------------------------------------------------
    */
    'practice_depths' => [
        'lay_practitioner' => 'Dedicated Lay Practitioner (Upasaka / Upasika)',
        'daily_meditator' => 'Daily Meditator & Mindful Living',
        'regular_meditator' => 'Regular Practice & Study',
        'occasional_practitioner' => 'Occasional / Cultural Observance',
        'philosophy_interest' => 'Dharma Philosophy / Seeking Mindful Partner',
    ],

    'meditation_frequencies' => [
        'daily' => 'Daily (Morning / Evening)',
        'several_times_week' => 'Several times a week',
        'weekly' => 'Weekly',
        'occasionally' => 'Occasionally / When possible',
        'learning_interested' => 'Learning / Interested in starting',
    ],

    'panca_sila_adherence' => [
        'very_strict' => 'Very Strict (Diligently uphold all Five Precepts)',
        'mindful_adherence' => 'Mindful Adherence (Cultivating them daily)',
        'general_observance' => 'General Observance in daily life',
        'flexible' => 'Flexible / Developing understanding',
    ],

    'temple_visits' => [
        'weekly_uposatha' => 'Weekly / On Uposatha Observance Days',
        'monthly' => 'Monthly',
        'festivals_only' => 'During Buddhist Festivals & Auspicious Days',
        'home_practice' => 'Personal practice at home',
    ],

    'uposatha_observance' => [
        'regularly' => 'Regularly (Full Moon & New Moon Days)',
        'occasionally' => 'Occasionally',
        'rarely' => 'Rarely',
        'not_observed' => 'Not part of my personal routine',
    ],

    'dhamma_study_chanting' => [
        'daily_chanting_study' => 'Daily Chanting (Paritta) & Sutta Study',
        'regular_talks_reading' => 'Regular Dhamma Talks & Reading',
        'occasional' => 'Occasional study',
        'none' => 'None currently',
    ],

    'retreat_experience' => [
        'ten_day_vipassana_plus' => '10-day Vipassana / Meditation retreat completed',
        'weekend_retreats' => 'Weekend retreats / Meditation workshops',
        'interested_attending' => 'Interested in attending retreats in future',
        'none' => 'None yet',
    ],

    /*
    |--------------------------------------------------------------------------
    | Lifestyle & Precepts (URS FR-2.5)
    |--------------------------------------------------------------------------
    */
    'dietary_preferences' => [
        'vegetarian' => 'Vegetarian',
        'vegan' => 'Vegan',
        'pescatarian' => 'Pescatarian',
        'flexible_mindful' => 'Flexible / Mindful Eater',
        'non_vegetarian' => 'Non-vegetarian',
    ],

    'alcohol_intoxicants' => [
        'strictly_never' => 'Strictly Never / Teetotaler (5th Precept)',
        'rarely_social' => 'Very rarely (occasional social toasts only)',
        'moderate' => 'Moderate social drinker',
        'none' => 'Prefer not to say',
    ],

    'smoking_options' => [
        'never' => 'Non-smoker',
        'quitting' => 'In process of quitting',
        'smoker' => 'Smoker',
    ],

    /*
    |--------------------------------------------------------------------------
    | Family Relationships (URS FR-5.1)
    |--------------------------------------------------------------------------
    */
    'family_relationships' => [
        'father' => 'Father',
        'mother' => 'Mother',
        'brother' => 'Brother',
        'sister' => 'Sister',
        'uncle' => 'Uncle',
        'aunt' => 'Aunt',
        'guardian' => 'Legal Guardian',
        'elder_relative' => 'Elder Relative',
        'monk_advisor' => 'Venerable Monk / Spiritual Advisor',
        'other' => 'Other Trusted Relative',
    ],

    /*
    |--------------------------------------------------------------------------
    | Country-specific Minimum Legal Marriage Ages (URS FR-1.2, Sec 6.1)
    |--------------------------------------------------------------------------
    */
    'minimum_legal_ages' => [
        'BD' => ['male' => 21, 'female' => 18, 'name' => 'Bangladesh'],
        'IN' => ['male' => 21, 'female' => 18, 'name' => 'India'],
        'LK' => ['male' => 18, 'female' => 18, 'name' => 'Sri Lanka'],
        'TH' => ['male' => 17, 'female' => 17, 'name' => 'Thailand'],
        'MM' => ['male' => 18, 'female' => 18, 'name' => 'Myanmar'],
        'NP' => ['male' => 20, 'female' => 20, 'name' => 'Nepal'],
        'default' => ['male' => 18, 'female' => 18, 'name' => 'International'],
    ],
];
