<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedSmallInteger('height_cm')->nullable();
            $table->string('education_level')->nullable();
            $table->string('profession')->nullable();
            $table->string('employment_type')->nullable();
            $table->string('annual_income_range')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('mother_tongue')->nullable();
            $table->string('citizenship')->nullable();
            $table->text('bio')->nullable();
            $table->string('children')->nullable(); // none, yes_living_together, yes_living_apart

            // Buddhist Tradition & Lineage (FR-2.3)
            $table->string('tradition')->nullable(); // theravada, mahayana, vajrayana, navayana, non_denominational
            $table->string('lineage_school')->nullable(); // thai_forest, zen, vipassana, tibetan_gelug, tibetan_kagyu, etc.
            $table->string('ethnic_community')->nullable(); // barua, chakma, marma, sinhalese, tibetan, etc. (NO CASTE)

            // Buddhist Practice & Dhamma Observance (FR-2.4)
            $table->string('practice_depth')->nullable(); // lay_practitioner, daily_meditator, regular_meditator, etc.
            $table->string('meditation_frequency')->nullable(); // daily, several_times_week, weekly, occasionally, learning_interested
            $table->string('panca_sila_adherence')->nullable(); // very_strict, mindful_adherence, general_observance, flexible
            $table->string('temple_visits')->nullable(); // weekly_uposatha, monthly, festivals_only, rarely_home_practice
            $table->string('uposatha_observance')->nullable(); // regularly, occasionally, rarely, not_observed
            $table->string('dhamma_study_chanting')->nullable(); // daily_chanting_study, regular_talks_reading, occasional, none
            $table->string('retreat_experience')->nullable(); // ten_day_vipassana_plus, weekend_retreats, interested_attending, none

            // Lifestyle & Five Precepts (FR-2.5)
            $table->string('dietary_preference')->nullable(); // vegetarian, vegan, pescatarian, flexible_mindful, non_vegetarian
            $table->string('alcohol_intoxicants')->nullable(); // strictly_never, rarely_social, moderate, none
            $table->string('smoking')->nullable(); // never, quitting, smoker

            // Family & Living (FR-2.6)
            $table->string('parents_status')->nullable();
            $table->string('parents_occupation')->nullable();
            $table->unsignedSmallInteger('siblings_count')->default(0);
            $table->string('family_type')->nullable(); // nuclear, joint, extended
            $table->string('preferred_living_arrangement')->nullable(); // independent, with_parents, flexible
            $table->string('views_on_raising_children_in_dhamma')->nullable(); // very_important, important, open_discussion

            // Horoscope Module (FR-3.1 to FR-3.4)
            $table->boolean('horoscope_required')->default(false);
            $table->date('birth_date')->nullable();
            $table->string('birth_time')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('horoscope_doc_path')->nullable();
            $table->unsignedTinyInteger('porondam_score')->nullable();
            $table->string('horoscope_visibility')->default('matched_only'); // matched_only, granted_only, hidden

            // Photo Privacy & Settings (FR-4.2)
            $table->string('photo_privacy_mode')->default('blurred_until_accepted'); // public, blurred_until_accepted, request_only

            // Preferences & Privacy settings (FR-2.7, FR-12.3)
            $table->json('partner_preferences')->nullable();
            $table->json('field_visibility')->nullable();
            $table->boolean('family_rep_required')->default(false); // replaces wali_required
            $table->unsignedTinyInteger('completeness_percentage')->default(0);

            // Legacy backward-compatibility aliases
            $table->string('sect_madhhab')->nullable();
            $table->string('prayer_frequency')->nullable();
            $table->string('halal_dietary_adherence')->nullable();
            $table->string('hijab_niqab_practice')->nullable();
            $table->string('beard_practice')->nullable();
            $table->string('quran_knowledge')->nullable();
            $table->string('mosque_attendance')->nullable();
            $table->string('polygamy_opinion')->nullable();
            $table->string('desired_family_structure')->nullable();
            $table->string('family_religiosity')->nullable();
            $table->boolean('wali_required')->default(false);

            $table->timestamps();

            $table->index(['city', 'country']);
            $table->index('tradition');
            $table->index('meditation_frequency');
            $table->index('panca_sila_adherence');
            $table->index('dietary_preference');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
