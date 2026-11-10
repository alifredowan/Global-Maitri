<?php

namespace Tests\Feature;

use App\Models\Profile;
use App\Models\User;
use App\Models\WaliLink;
use App\Notifications\NikahMilestoneNotification;
use App\Services\MarriageCompletionService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class MonkAdvisorAndRoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_monk_advisor_has_expected_role_helpers_and_redirects_to_wali_dashboard(): void
    {
        $monk = User::factory()->create([
            'role' => 'monk_advisor',
            'email_verified_at' => now(),
        ]);

        $this->assertTrue($monk->isMonkAdvisor());
        $this->assertTrue($monk->isFamilyRep());
        $this->assertTrue($monk->isKalyanaMitta());
        $this->assertFalse($monk->isSeeker());

        $this->actingAs($monk);

        // Visiting /dashboard should redirect advisor to wali.dashboard / family console
        $response = $this->get(route('dashboard'));
        $response->assertRedirect(route('wali.dashboard'));

        // Visiting /family/dashboard directly should render advisor console
        $advisorResponse = $this->get(route('family.dashboard'));
        $advisorResponse->assertOk();
        $advisorResponse->assertSee('Monk &amp; Dhamma Advisor Console', false);
        $advisorResponse->assertSee('Sangha &amp; Elder Advisor Guidance Center', false);
    }

    public function test_family_rep_registration_autolinks_pending_seekers(): void
    {
        $seeker = User::factory()->create(['role' => 'seeker']);
        Profile::create(['user_id' => $seeker->id]);

        $pendingLink = WaliLink::create([
            'seeker_user_id' => $seeker->id,
            'wali_email' => 'kalyanamitta@test.com',
            'relationship_type' => 'monk_advisor',
            'permission_level' => 'full_involvement',
            'status' => 'pending',
            'invite_token' => 'test-token-12345',
        ]);

        $response = $this->post(route('register'), [
            'role' => 'family_rep',
            'name' => 'Ven. Anandamitra',
            'email' => 'kalyanamitta@test.com',
            'gender' => 'male',
            'dob' => '01/01/1980',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
            'terms' => '1',
            'relationship_type' => 'monk_advisor',
        ]);

        $response->assertRedirect(route('verification.notice'));
        $response->assertSessionHas('success');

        $pendingLink->refresh();
        $this->assertEquals('active', $pendingLink->status);
        $this->assertNotNull($pendingLink->wali_user_id);
    }

    public function test_mangala_vivaha_milestone_notification_dispatches_cleanly(): void
    {
        Notification::fake();

        $groom = User::factory()->create(['role' => 'seeker', 'gender' => 'male']);
        $bride = User::factory()->create(['role' => 'seeker', 'gender' => 'female']);
        Profile::create(['user_id' => $groom->id]);
        Profile::create(['user_id' => $bride->id]);

        $service = app(MarriageCompletionService::class);
        $marriage = $service->initiate($groom, $bride->id);

        Notification::assertSentTo(
            $bride,
            NikahMilestoneNotification::class,
            function ($notification) {
                return $notification->event === 'initiated';
            }
        );

        Notification::assertSentTo(
            $groom,
            NikahMilestoneNotification::class,
            function ($notification) {
                return $notification->event === 'declaration_submitted';
            }
        );
    }
}
