<?php

namespace Tests\Unit;

use App\Models\Profile;
use App\Models\User;
use App\Services\MatchingEngineService;
use Tests\TestCase;

class MatchingEngineTest extends TestCase
{
    private MatchingEngineService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new MatchingEngineService;
    }

    public function test_it_returns_zero_for_same_gender_matrimonial(): void
    {
        $u1 = new User(['gender' => 'male', 'role' => 'seeker']);
        $p1 = new Profile(['tradition' => 'theravada']);
        $p1->setRelation('user', $u1);

        $u2 = new User(['gender' => 'male', 'role' => 'seeker']);
        $p2 = new Profile(['tradition' => 'theravada']);
        $p2->setRelation('user', $u2);

        $score = $this->service->computeCompatibility($p1, $p2);
        $this->assertSame(0, $score);
    }

    public function test_it_gives_high_score_for_matching_dhamma_practice(): void
    {
        $groom = new User(['gender' => 'male', 'dob' => '1995-01-01', 'role' => 'seeker']);
        $groomProfile = new Profile([
            'tradition' => 'theravada',
            'meditation_frequency' => 'daily',
            'retreat_experience' => 'several_retreats',
            'panca_sila_adherence' => 'very_strict',
            'dietary_preference' => 'vegetarian',
            'alcohol_intoxicants' => 'strictly_never',
            'views_on_raising_children_in_dhamma' => 'integral',
            'country' => 'Sri Lanka',
            'city' => 'Colombo',
            'education_level' => 'Master',
            'partner_preferences' => ['age_min' => 22, 'age_max' => 30],
        ]);
        $groomProfile->setRelation('user', $groom);

        $bride = new User(['gender' => 'female', 'dob' => '1998-01-01', 'role' => 'seeker']);
        $brideProfile = new Profile([
            'tradition' => 'theravada',
            'meditation_frequency' => 'daily',
            'retreat_experience' => 'several_retreats',
            'panca_sila_adherence' => 'very_strict',
            'dietary_preference' => 'vegetarian',
            'alcohol_intoxicants' => 'strictly_never',
            'views_on_raising_children_in_dhamma' => 'integral',
            'country' => 'Sri Lanka',
            'city' => 'Colombo',
            'education_level' => 'Master',
            'partner_preferences' => ['age_min' => 28, 'age_max' => 35],
        ]);
        $brideProfile->setRelation('user', $bride);

        $score = $this->service->computeCompatibility($groomProfile, $brideProfile);

        $this->assertGreaterThanOrEqual(90, $score);
    }

    public function test_it_explains_shared_compatibility_signals(): void
    {
        $groom = new User(['gender' => 'male', 'dob' => '1995-01-01', 'role' => 'seeker']);
        $groomProfile = new Profile([
            'tradition' => 'theravada',
            'meditation_frequency' => 'daily',
            'panca_sila_adherence' => 'very_strict',
            'dietary_preference' => 'vegetarian',
            'country' => 'Sri Lanka',
            'education_level' => 'Master',
            'partner_preferences' => ['age_min' => 22, 'age_max' => 30],
        ]);
        $groomProfile->setRelation('user', $groom);

        $bride = new User(['gender' => 'female', 'dob' => '1998-01-01', 'role' => 'seeker']);
        $brideProfile = new Profile([
            'tradition' => 'theravada',
            'meditation_frequency' => 'daily',
            'panca_sila_adherence' => 'very_strict',
            'dietary_preference' => 'vegetarian',
            'country' => 'Sri Lanka',
            'education_level' => 'Master',
        ]);
        $brideProfile->setRelation('user', $bride);

        $highlights = $this->service->getCompatibilityHighlights($groomProfile, $brideProfile);

        $this->assertNotEmpty($highlights);
        $labels = array_column($highlights, 'label');
        $this->assertContains('Shared Tradition', $labels);
        $this->assertContains('Meditation Practice', $labels);
        $this->assertContains('Panca Sila (Five Precepts)', $labels);
        $this->assertContains('Dietary Harmony', $labels);
    }
}
