<?php

namespace Database\Seeders;

use App\Models\Photo;
use App\Models\Profile;
use App\Models\Subscription;
use App\Models\User;
use App\Models\WaliLink;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(PlatformSettingSeeder::class);
        $this->call(SuperAdminSeeder::class);
        $this->call(SubscriptionPlanSeeder::class);

        $defaultPassword = Hash::make('password');

        // 1. Moderator Account (FR-9.1, FR-9.3)
        $moderator = User::create([
            'name' => 'Maya Barua (Moderator)',
            'email' => 'moderator@globalmaitri.com',
            'phone' => '+8801700000001',
            'password' => $defaultPassword,
            'role' => 'moderator',
            'permissions' => ['manage_verifications', 'manage_reports', 'view_audit_logs', 'manage_settings'],
            'gender' => 'female',
            'dob' => '1992-05-15',
            'marital_status' => 'never_married',
            'is_verified' => true,
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Also create fallback moderator for test suite compatibility
        User::firstOrCreate(
            ['email' => 'moderator@nikahconnect.test'],
            [
                'name' => 'Amina Siddiqui (Moderator)',
                'phone' => '+15550002222',
                'password' => $defaultPassword,
                'role' => 'moderator',
                'permissions' => ['manage_verifications', 'manage_reports', 'view_audit_logs'],
                'gender' => 'female',
                'dob' => '1993-08-20',
                'marital_status' => 'never_married',
                'is_verified' => true,
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );

        // 2. Family Representative Account (FR-5.1 to FR-5.5)
        $familyFather = User::create([
            'name' => 'Dr. Ananda Barua (Father / Family Rep)',
            'email' => 'family.father@globalmaitri.com',
            'phone' => '+8801700000002',
            'password' => $defaultPassword,
            'role' => 'family_rep',
            'gender' => 'male',
            'dob' => '1966-03-10',
            'marital_status' => 'never_married',
            'is_verified' => true,
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Fallback Wali account for existing test suites
        $wali = User::firstOrCreate(
            ['email' => 'wali.father@nikahconnect.test'],
            [
                'name' => 'Dr. Tariq Al-Mansoor (Wali)',
                'phone' => '+15550003333',
                'password' => $defaultPassword,
                'role' => 'wali',
                'gender' => 'male',
                'dob' => '1965-03-10',
                'marital_status' => 'never_married',
                'is_verified' => true,
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );

        // 3. Monk / Elder Advisor Account (URS 3 - Phase 2 / Advisor)
        User::create([
            'name' => 'Ven. Bhante Bodhirakkhita (Monk Advisor)',
            'email' => 'bhante.bodhi@globalmaitri.com',
            'phone' => '+8801700000003',
            'password' => $defaultPassword,
            'role' => 'monk_advisor',
            'gender' => 'male',
            'dob' => '1960-08-12',
            'marital_status' => 'never_married',
            'is_verified' => true,
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // 4. Primary Seeker Groom (Male) - Pro Single Marriage Pass
        $groom = User::create([
            'name' => 'Rahul Barua',
            'email' => 'seeker.groom@globalmaitri.com',
            'phone' => '+8801700000004',
            'password' => $defaultPassword,
            'role' => 'seeker',
            'gender' => 'male',
            'dob' => '1996-04-12',
            'marital_status' => 'never_married',
            'country_code' => 'BD',
            'is_verified' => true,
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        Subscription::create([
            'user_id' => $groom->id,
            'plan' => 'premium',
            'status' => 'active',
            'starts_at' => now(),
            'ends_at' => now()->addYear(),
        ]);

        $groomProfile = Profile::create([
            'user_id' => $groom->id,
            'height_cm' => 178,
            'education_level' => 'Master of Science in Software Engineering',
            'profession' => 'Senior Cloud Architect',
            'employment_type' => 'Full-time',
            'annual_income_range' => '$90,000 - $120,000',
            'city' => 'Chittagong',
            'state' => 'Chittagong Division',
            'country' => 'Bangladesh',
            'mother_tongue' => 'Bengali',
            'citizenship' => 'Bangladeshi',
            'bio' => 'Practicing Buddhist committed to the Dhamma, Vipassana meditation, and continuous inner cultivation. Seeking a compassionate, mindful partner with whom to build a harmonious family rooted in Metta and the Five Precepts.',
            'tradition' => 'theravada',
            'lineage_school' => 'vipassana_tradition',
            'ethnic_community' => 'barua',
            'practice_depth' => 'daily_meditator',
            'meditation_frequency' => 'daily',
            'panca_sila_adherence' => 'very_strict',
            'temple_visits' => 'weekly_uposatha',
            'uposatha_observance' => 'regularly',
            'dhamma_study_chanting' => 'daily_chanting_study',
            'retreat_experience' => 'ten_day_vipassana_plus',
            'dietary_preference' => 'vegetarian',
            'alcohol_intoxicants' => 'strictly_never',
            'smoking' => 'never',
            'parents_status' => 'Both parents retired',
            'parents_occupation' => 'College Professor & Teacher',
            'siblings_count' => 1,
            'family_type' => 'nuclear',
            'preferred_living_arrangement' => 'independent',
            'views_on_raising_children_in_dhamma' => 'very_important',
            'horoscope_required' => false,
            'photo_privacy_mode' => 'public',
            'family_rep_required' => false,
            'completeness_percentage' => 95,
        ]);

        Photo::create([
            'profile_id' => $groomProfile->id,
            'file_path' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&auto=format&fit=crop&q=80',
            'is_primary' => true,
            'is_blurred' => false,
            'moderation_status' => 'approved',
        ]);

        // Fallback seeker.groom@nikahconnect.test for tests
        $legacyGroom = User::firstOrCreate(
            ['email' => 'seeker.groom@nikahconnect.test'],
            [
                'name' => 'Zayd Al-Hassan',
                'phone' => '+15550004444',
                'password' => $defaultPassword,
                'role' => 'seeker',
                'gender' => 'male',
                'dob' => '1997-04-12',
                'marital_status' => 'never_married',
                'is_verified' => true,
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
        Subscription::firstOrCreate(
            ['user_id' => $legacyGroom->id],
            ['plan' => 'premium', 'status' => 'active', 'starts_at' => now(), 'ends_at' => now()->addMonth()]
        );
        $legacyGroomProfile = Profile::firstOrCreate(
            ['user_id' => $legacyGroom->id],
            [
                'height_cm' => 180,
                'education_level' => 'Master of Science in Computer Science',
                'profession' => 'Senior Cloud Architect',
                'city' => 'London',
                'country' => 'United Kingdom',
                'bio' => 'Practicing Buddhist committed to mindfulness and family values.',
                'tradition' => 'theravada',
                'meditation_frequency' => 'daily',
                'panca_sila_adherence' => 'very_strict',
                'dietary_preference' => 'vegetarian',
                'sect_madhhab' => 'Sunni - Hanafi',
                'prayer_frequency' => '5x_daily',
                'halal_dietary_adherence' => 'strictly_halal',
                'completeness_percentage' => 95,
            ]
        );
        Photo::firstOrCreate(
            ['profile_id' => $legacyGroomProfile->id],
            [
                'file_path' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&auto=format&fit=crop&q=80',
                'is_primary' => true,
                'is_blurred' => false,
                'moderation_status' => 'approved',
            ]
        );

        // 5. Primary Seeker Bride (Female) - Free Explorer with Family Representative Linked
        $bride = User::create([
            'name' => 'Priya Chakma',
            'email' => 'seeker.bride@globalmaitri.com',
            'phone' => '+8801700000005',
            'password' => $defaultPassword,
            'role' => 'seeker',
            'gender' => 'female',
            'dob' => '1999-09-18',
            'marital_status' => 'never_married',
            'country_code' => 'BD',
            'is_verified' => true,
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        Subscription::create([
            'user_id' => $bride->id,
            'plan' => 'free',
            'status' => 'active',
            'starts_at' => now(),
        ]);

        $brideProfile = Profile::create([
            'user_id' => $bride->id,
            'height_cm' => 165,
            'education_level' => 'Doctor of Pharmacy (PharmD)',
            'profession' => 'Clinical Pharmacist',
            'employment_type' => 'Full-time',
            'annual_income_range' => '$65,000 - $85,000',
            'city' => 'Dhaka',
            'state' => 'Dhaka Division',
            'country' => 'Bangladesh',
            'mother_tongue' => 'Bengali',
            'citizenship' => 'Bangladeshi',
            'bio' => 'Family-oriented, grounded in meditation practice, kindness (Metta), and ethical living. Looking for a gentle, practicing Buddhist who values respectful communication and spiritual harmony. My father is linked as my family representative.',
            'tradition' => 'theravada',
            'lineage_school' => 'vipassana_tradition',
            'ethnic_community' => 'chakma',
            'practice_depth' => 'daily_meditator',
            'meditation_frequency' => 'daily',
            'panca_sila_adherence' => 'very_strict',
            'temple_visits' => 'weekly_uposatha',
            'uposatha_observance' => 'regularly',
            'dhamma_study_chanting' => 'daily_chanting_study',
            'retreat_experience' => 'ten_day_vipassana_plus',
            'dietary_preference' => 'vegan',
            'alcohol_intoxicants' => 'strictly_never',
            'smoking' => 'never',
            'parents_status' => 'Father Physician, Mother Educator',
            'parents_occupation' => 'Physician',
            'siblings_count' => 1,
            'family_type' => 'nuclear',
            'preferred_living_arrangement' => 'flexible',
            'views_on_raising_children_in_dhamma' => 'very_important',
            'horoscope_required' => false,
            'photo_privacy_mode' => 'blurred_until_accepted',
            'family_rep_required' => true,
            'completeness_percentage' => 100,
        ]);

        Photo::create([
            'profile_id' => $brideProfile->id,
            'file_path' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=400&auto=format&fit=crop&q=80',
            'is_primary' => true,
            'is_blurred' => true,
            'moderation_status' => 'approved',
        ]);

        WaliLink::create([
            'seeker_user_id' => $bride->id,
            'wali_user_id' => $familyFather->id,
            'wali_name' => $familyFather->name,
            'wali_email' => $familyFather->email,
            'wali_phone' => $familyFather->phone,
            'relationship_type' => 'father',
            'permission_level' => 'approve_required',
            'status' => 'active',
        ]);

        // Fallback seeker.bride@nikahconnect.test for tests
        $legacyBride = User::firstOrCreate(
            ['email' => 'seeker.bride@nikahconnect.test'],
            [
                'name' => 'Maryam Al-Mansoor',
                'phone' => '+15550005555',
                'password' => $defaultPassword,
                'role' => 'seeker',
                'gender' => 'female',
                'dob' => '2000-09-18',
                'marital_status' => 'never_married',
                'is_verified' => true,
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
        Subscription::firstOrCreate(
            ['user_id' => $legacyBride->id],
            ['plan' => 'free', 'status' => 'active', 'starts_at' => now()]
        );
        $legacyBrideProfile = Profile::firstOrCreate(
            ['user_id' => $legacyBride->id],
            [
                'height_cm' => 165,
                'education_level' => 'Doctor of Pharmacy (PharmD)',
                'profession' => 'Clinical Pharmacist',
                'city' => 'London',
                'country' => 'United Kingdom',
                'bio' => 'Family-oriented, grounded in Buddhist practice and values.',
                'tradition' => 'theravada',
                'meditation_frequency' => 'daily',
                'panca_sila_adherence' => 'very_strict',
                'dietary_preference' => 'vegan',
                'sect_madhhab' => 'Sunni - Hanafi',
                'prayer_frequency' => '5x_daily',
                'halal_dietary_adherence' => 'strictly_halal',
                'wali_required' => true,
                'completeness_percentage' => 100,
            ]
        );
        Photo::firstOrCreate(
            ['profile_id' => $legacyBrideProfile->id],
            [
                'file_path' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=400&auto=format&fit=crop&q=80',
                'is_primary' => true,
                'is_blurred' => true,
                'moderation_status' => 'approved',
            ]
        );
        WaliLink::firstOrCreate(
            ['seeker_user_id' => $legacyBride->id, 'wali_user_id' => $wali->id],
            [
                'wali_name' => $wali->name,
                'wali_email' => $wali->email,
                'wali_phone' => $wali->phone,
                'relationship_type' => 'father',
                'permission_level' => 'approve_required',
                'status' => 'active',
            ]
        );

        // 6. Sri Lankan Seeker Groom with Sinhalese Porondam Horoscope Enabled
        $sriLankanGroom = User::create([
            'name' => 'Tharindu Jayasinghe',
            'email' => 'tharindu.jayasinghe@globalmaitri.com',
            'phone' => '+94770000001',
            'password' => $defaultPassword,
            'role' => 'seeker',
            'gender' => 'male',
            'dob' => '1995-11-20',
            'marital_status' => 'never_married',
            'country_code' => 'LK',
            'is_verified' => true,
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
        $sriLankanProfile = Profile::create([
            'user_id' => $sriLankanGroom->id,
            'height_cm' => 175,
            'education_level' => 'MBBS (Medical Doctor)',
            'profession' => 'Resident Physician',
            'city' => 'Colombo',
            'country' => 'Sri Lanka',
            'mother_tongue' => 'Sinhala',
            'citizenship' => 'Sri Lankan',
            'bio' => 'Dedicated doctor and mindfulness practitioner. Valuing Pirith chanting, Metta meditation, and compassionate care.',
            'tradition' => 'theravada',
            'lineage_school' => 'sri_lankan_mahavihara',
            'ethnic_community' => 'sinhalese',
            'practice_depth' => 'regular_meditator',
            'meditation_frequency' => 'daily',
            'panca_sila_adherence' => 'very_strict',
            'temple_visits' => 'weekly_uposatha',
            'uposatha_observance' => 'regularly',
            'dhamma_study_chanting' => 'daily_chanting_study',
            'dietary_preference' => 'vegetarian',
            'alcohol_intoxicants' => 'strictly_never',
            'horoscope_required' => true,
            'birth_date' => '1995-11-20',
            'birth_time' => '06:45 AM',
            'birth_place' => 'Kandy, Sri Lanka',
            'porondam_score' => 88,
            'horoscope_visibility' => 'matched_only',
            'photo_privacy_mode' => 'public',
            'completeness_percentage' => 100,
        ]);
        Photo::create([
            'profile_id' => $sriLankanProfile->id,
            'file_path' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=400&auto=format&fit=crop&q=80',
            'is_primary' => true,
            'is_blurred' => false,
            'moderation_status' => 'approved',
        ]);

        // 7. Tibetan Vajrayana Bride
        $tibetanBride = User::create([
            'name' => 'Tenzin Dolkar',
            'email' => 'tenzin.dolkar@globalmaitri.com',
            'phone' => '+14165550199',
            'password' => $defaultPassword,
            'role' => 'seeker',
            'gender' => 'female',
            'dob' => '1998-02-14',
            'marital_status' => 'never_married',
            'country_code' => 'CA',
            'is_verified' => true,
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
        $tibetanProfile = Profile::create([
            'user_id' => $tibetanBride->id,
            'height_cm' => 163,
            'education_level' => 'Bachelor of Fine Arts',
            'profession' => 'UI/UX Designer & Thangka Artist',
            'city' => 'Toronto',
            'country' => 'Canada',
            'mother_tongue' => 'Tibetan',
            'citizenship' => 'Canadian',
            'bio' => 'Practicing Tibetan Buddhist, practicing Chenrezig meditation and loving-kindness. Creative, cheerful, and looking for a spiritual life partner.',
            'tradition' => 'vajrayana',
            'lineage_school' => 'tibetan_gelug',
            'ethnic_community' => 'tibetan',
            'practice_depth' => 'daily_meditator',
            'meditation_frequency' => 'daily',
            'panca_sila_adherence' => 'very_strict',
            'dhamma_study_chanting' => 'daily_chanting_study',
            'dietary_preference' => 'vegetarian',
            'alcohol_intoxicants' => 'strictly_never',
            'photo_privacy_mode' => 'blurred_until_accepted',
            'completeness_percentage' => 95,
        ]);
        Photo::create([
            'profile_id' => $tibetanProfile->id,
            'file_path' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=400&auto=format&fit=crop&q=80',
            'is_primary' => true,
            'is_blurred' => true,
            'moderation_status' => 'approved',
        ]);

        // 8. Navayana / Ambedkarite Bride
        $navayanaBride = User::create([
            'name' => 'Pritha Ambedkar',
            'email' => 'pritha.ambedkar@globalmaitri.com',
            'phone' => '+919800000001',
            'password' => $defaultPassword,
            'role' => 'seeker',
            'gender' => 'female',
            'dob' => '1997-07-22',
            'marital_status' => 'never_married',
            'country_code' => 'IN',
            'is_verified' => true,
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
        $navayanaProfile = Profile::create([
            'user_id' => $navayanaBride->id,
            'height_cm' => 162,
            'education_level' => 'Master of Laws (LL.M.)',
            'profession' => 'Human Rights Advocate & Legal Counsel',
            'city' => 'Mumbai',
            'country' => 'India',
            'mother_tongue' => 'Marathi',
            'citizenship' => 'Indian',
            'bio' => 'Navayana Buddhist inspired by Babasaheb Ambedkar, equality, and compassion. Seeking an educated, progressive, and ethical life partner.',
            'tradition' => 'navayana',
            'lineage_school' => 'other',
            'ethnic_community' => 'ambedkarite',
            'practice_depth' => 'regular_meditator',
            'meditation_frequency' => 'several_times_week',
            'panca_sila_adherence' => 'very_strict',
            'dietary_preference' => 'vegetarian',
            'alcohol_intoxicants' => 'strictly_never',
            'photo_privacy_mode' => 'public',
            'completeness_percentage' => 95,
        ]);
        Photo::create([
            'profile_id' => $navayanaProfile->id,
            'file_path' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=400&auto=format&fit=crop&q=80',
            'is_primary' => true,
            'is_blurred' => false,
            'moderation_status' => 'approved',
        ]);
    }
}
