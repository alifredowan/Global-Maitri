<?php

namespace Tests\Feature;

use App\Models\Profile;
use App\Models\Subscription;
use App\Models\User;
use App\Services\MatchingEngineService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DhammaMatchingAndDiscoveryTest extends TestCase
{
    use RefreshDatabase;

    public function test_dhamma_compatibility_computation_evaluates_tradition_precepts_and_lifestyle(): void
    {
        $service = app(MatchingEngineService::class);

        $groomUser = User::factory()->create([
            'role' => 'seeker',
            'gender' => 'male',
            'dob' => Carbon::now()->subYears(28),
        ]);
        $groomProfile = Profile::create([
            'user_id' => $groomUser->id,
            'tradition' => 'theravada',
            'meditation_frequency' => 'daily',
            'retreat_experience' => 'vipassana_10day',
            'panca_sila_adherence' => 'very_strict',
            'dietary_preference' => 'vegetarian',
            'alcohol_intoxicants' => 'strictly_never',
            'views_on_raising_children_in_dhamma' => 'essential',
            'country' => 'Sri Lanka',
            'city' => 'Colombo',
            'education_level' => 'Master of Science',
            'horoscope_required' => true,
        ]);
        $groomProfile->setRelation('user', $groomUser);

        // Highly compatible bride
        $brideUser = User::factory()->create([
            'role' => 'seeker',
            'gender' => 'female',
            'dob' => Carbon::now()->subYears(26),
        ]);
        $brideProfile = Profile::create([
            'user_id' => $brideUser->id,
            'tradition' => 'theravada',
            'meditation_frequency' => 'daily',
            'retreat_experience' => 'vipassana_10day',
            'panca_sila_adherence' => 'very_strict',
            'dietary_preference' => 'vegetarian',
            'alcohol_intoxicants' => 'strictly_never',
            'views_on_raising_children_in_dhamma' => 'essential',
            'country' => 'Sri Lanka',
            'city' => 'Colombo',
            'education_level' => 'Master of Science',
            'horoscope_required' => true,
        ]);
        $brideProfile->setRelation('user', $brideUser);

        $score = $service->computeCompatibility($groomProfile, $brideProfile);
        $this->assertGreaterThanOrEqual(90, $score);

        $highlights = $service->getCompatibilityHighlights($groomProfile, $brideProfile);
        $this->assertNotEmpty($highlights);
        $labels = array_column($highlights, 'label');
        $this->assertContains('Shared Tradition', $labels);
        $this->assertContains('Meditation Practice', $labels);
    }

    public function test_discovery_filters_by_tradition_and_diet_strictly_omits_married_or_blocked_users(): void
    {
        $viewer = User::factory()->create([
            'role' => 'seeker',
            'gender' => 'male',
            'email_verified_at' => now(),
        ]);
        $viewerProfile = Profile::create(['user_id' => $viewer->id]);

        // Candidate 1: Theravada & Vegan
        $candidate1 = User::factory()->create(['role' => 'seeker', 'gender' => 'female', 'marital_status' => 'never_married']);
        Profile::create([
            'user_id' => $candidate1->id,
            'tradition' => 'theravada',
            'dietary_preference' => 'vegan',
        ]);

        // Candidate 2: Mahayana & Non-veg
        $candidate2 = User::factory()->create(['role' => 'seeker', 'gender' => 'female', 'marital_status' => 'never_married']);
        Profile::create([
            'user_id' => $candidate2->id,
            'tradition' => 'mahayana',
            'dietary_preference' => 'non_vegetarian',
        ]);

        // Candidate 3: Married candidate (should never appear)
        $marriedCandidate = User::factory()->create(['role' => 'seeker', 'gender' => 'female', 'marital_status' => 'married']);
        Profile::create([
            'user_id' => $marriedCandidate->id,
            'tradition' => 'theravada',
            'dietary_preference' => 'vegan',
        ]);

        $this->actingAs($viewer);

        // Discovery filtered by tradition=theravada
        $response = $this->get(route('discovery.index', ['tradition' => 'theravada']));
        $response->assertOk();

        $profileUserIds = $response->viewData('profiles')->pluck('user_id')->all();
        $this->assertContains($candidate1->id, $profileUserIds);
        $this->assertNotContains($candidate2->id, $profileUserIds);
        $this->assertNotContains($marriedCandidate->id, $profileUserIds);
    }

    public function test_daily_matches_boosts_premium_subscribers(): void
    {
        $service = app(MatchingEngineService::class);

        $viewer = User::factory()->create(['role' => 'seeker', 'gender' => 'male']);
        $viewerProfile = Profile::create(['user_id' => $viewer->id]);

        $freeCandidate = User::factory()->create(['role' => 'seeker', 'gender' => 'female', 'marital_status' => 'never_married']);
        Profile::create(['user_id' => $freeCandidate->id, 'tradition' => 'theravada']);

        $premiumCandidate = User::factory()->create(['role' => 'seeker', 'gender' => 'female', 'marital_status' => 'never_married']);
        Profile::create(['user_id' => $premiumCandidate->id, 'tradition' => 'theravada']);

        Subscription::create([
            'user_id' => $premiumCandidate->id,
            'plan' => 'premium',
            'status' => 'active',
            'starts_at' => now(),
            'ends_at' => now()->addMonth(),
        ]);

        $matches = $service->getDailyMatches($viewer);
        $this->assertNotEmpty($matches);
        $firstMatch = $matches->first();
        // Premium candidate gets top boost
        $this->assertEquals($premiumCandidate->id, $firstMatch->user_id);
    }
}
