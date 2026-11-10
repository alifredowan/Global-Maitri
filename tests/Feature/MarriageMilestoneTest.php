<?php

namespace Tests\Feature;

use App\Models\Conversation;
use App\Models\Interest;
use App\Models\Marriage;
use App\Models\Profile;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Models\User;
use App\Models\WaliLink;
use App\Notifications\NikahMilestoneNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Tests\TestCase;

class MarriageMilestoneTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        SubscriptionPlan::updateOrCreate(
            ['slug' => 'free'],
            [
                'name' => 'Free Seeker',
                'monthly_price' => 0.00,
                'annual_price' => 0.00,
                'daily_profile_views' => 10,
                'daily_interests' => 5,
                'is_active' => true,
            ]
        );

        SubscriptionPlan::updateOrCreate(
            ['slug' => 'premium'],
            [
                'name' => 'Seeker Premium',
                'monthly_price' => 19.99,
                'annual_price' => 159.99,
                'daily_profile_views' => -1,
                'daily_interests' => -1,
                'see_who_viewed' => true,
                'advanced_filters' => true,
                'is_active' => true,
            ]
        );
    }

    private function createSeeker(string $gender = 'male', string $maritalStatus = 'never_married'): User
    {
        $user = User::factory()->create([
            'name' => fake()->name(),
            'email' => 'seeker.'.Str::random(8).'@example.com',
            'role' => 'seeker',
            'gender' => $gender,
            'marital_status' => $maritalStatus,
            'is_verified' => true,
            'is_active' => true,
        ]);

        Profile::create([
            'user_id' => $user->id,
            'city' => 'Dhaka',
            'country' => 'Bangladesh',
            'sect_madhhab' => 'Sunni - Hanafi',
            'prayer_frequency' => '5x_daily',
            'completeness_percentage' => 85,
        ]);

        return $user;
    }

    public function test_seeker_can_initiate_nikah_milestone(): void
    {
        Notification::fake();

        $groom = $this->createSeeker('male');
        $bride = $this->createSeeker('female');

        $response = $this->actingAs($groom)->post(route('marriages.initiate'), [
            'spouse_id' => $bride->id,
            'marriage_date' => now()->toDateString(),
            'confirmation_notes' => 'Alhamdulillah, our families agreed and Nikah was held.',
        ]);

        $response->assertRedirect(route('marriages.celebration'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('marriages', [
            'groom_id' => $groom->id,
            'bride_id' => $bride->id,
            'initiated_by_user_id' => $groom->id,
            'status' => 'pending_confirmation',
        ]);

        Notification::assertSentTo($bride, NikahMilestoneNotification::class);
    }

    public function test_cannot_initiate_marriage_with_same_gender_or_self(): void
    {
        $man1 = $this->createSeeker('male');
        $man2 = $this->createSeeker('male');

        // Cannot initiate with self
        $response = $this->actingAs($man1)->post(route('marriages.initiate'), [
            'spouse_id' => $man1->id,
        ]);
        $response->assertSessionHas('error');

        // Cannot initiate with same gender
        $response = $this->actingAs($man1)->post(route('marriages.initiate'), [
            'spouse_id' => $man2->id,
        ]);
        $response->assertSessionHas('error');
    }

    public function test_spouse_can_confirm_marriage_triggering_account_transitions(): void
    {
        Notification::fake();

        $groom = $this->createSeeker('male');
        $bride = $this->createSeeker('female');
        $thirdParty = $this->createSeeker('male');

        // Active subscription for groom
        $plan = SubscriptionPlan::where('slug', 'premium')->first();
        $subscription = Subscription::create([
            'user_id' => $groom->id,
            'plan_id' => $plan->id,
            'plan_name' => 'Seeker Premium',
            'billing_cycle' => 'monthly',
            'amount' => 19.99,
            'currency' => 'USD',
            'status' => 'active',
            'starts_at' => now(),
            'renews_at' => now()->addMonth(),
        ]);

        // Third party interest with bride
        $thirdPartyInterest = Interest::create([
            'sender_id' => $thirdParty->id,
            'recipient_id' => $bride->id,
            'status' => 'pending',
        ]);

        // Couple interest
        $coupleInterest = Interest::create([
            'sender_id' => $groom->id,
            'recipient_id' => $bride->id,
            'status' => 'accepted',
        ]);

        $coupleConversation = Conversation::create([
            'interest_id' => $coupleInterest->id,
            'status' => 'active',
        ]);

        // Third party conversation
        $thirdPartyConversation = Conversation::create([
            'interest_id' => $thirdPartyInterest->id,
            'status' => 'active',
        ]);
        $thirdPartyConversation->participants()->attach([$thirdParty->id, $bride->id]);

        // Initiate marriage
        $marriage = Marriage::create([
            'groom_id' => $groom->id,
            'bride_id' => $bride->id,
            'initiated_by_user_id' => $groom->id,
            'status' => 'pending_confirmation',
            'marriage_date' => now()->toDateString(),
        ]);

        // Bride confirms
        $response = $this->actingAs($bride)->post(route('marriages.confirm', $marriage->id));

        $response->assertRedirect(route('marriages.celebration'));
        $response->assertSessionHas('success');

        // Marriage is confirmed
        $this->assertEquals('confirmed', $marriage->fresh()->status);
        $this->assertNotNull($marriage->fresh()->confirmed_at);

        // Both accounts marked as married
        $this->assertEquals('married', $groom->fresh()->marital_status);
        $this->assertEquals('married', $bride->fresh()->marital_status);
        $this->assertTrue($groom->fresh()->isMarried());
        $this->assertTrue($bride->fresh()->isMarried());

        // Subscription transitioned to completed_marriage
        $this->assertEquals('completed_marriage', $subscription->fresh()->status);

        // Third party interest closed
        $this->assertEquals('closed_married', $thirdPartyInterest->fresh()->status);

        // Third party conversation locked
        $this->assertEquals('locked', $thirdPartyConversation->fresh()->status);
        $this->assertEquals('candidate_married', $thirdPartyConversation->fresh()->locked_reason);

        // Notifications sent to both
        Notification::assertSentTo([$groom, $bride], NikahMilestoneNotification::class);
    }

    public function test_married_users_are_excluded_from_discovery(): void
    {
        $viewer = $this->createSeeker('male');
        $availableFemale = $this->createSeeker('female', 'never_married');
        $marriedFemale = $this->createSeeker('female', 'married');

        $response = $this->actingAs($viewer)->get(route('discovery.index'));

        $response->assertOk()
            ->assertSee($availableFemale->name)
            ->assertDontSee($marriedFemale->name);
    }

    public function test_couple_can_submit_and_save_metta_story(): void
    {
        $groom = $this->createSeeker('male', 'married');
        $bride = $this->createSeeker('female', 'married');

        $marriage = Marriage::create([
            'groom_id' => $groom->id,
            'bride_id' => $bride->id,
            'initiated_by_user_id' => $groom->id,
            'status' => 'confirmed',
            'confirmed_at' => now(),
            'marriage_date' => now()->toDateString(),
        ]);

        $response = $this->actingAs($groom)->post(route('marriages.story', $marriage->id), [
            'story_title' => 'Our Blessed Journey of Loving-Kindness',
            'story_body' => 'Sadhu, through Dhamma compatibility and family guidance, we found mutual harmony and lifelong companionship.',
            'story_is_public' => '1',
        ]);

        $response->assertSessionHas('success');

        $this->assertDatabaseHas('marriages', [
            'id' => $marriage->id,
            'story_title' => 'Our Blessed Journey of Loving-Kindness',
            'story_is_public' => true,
        ]);
    }

    public function test_seeker_can_decline_pending_nikah_milestone(): void
    {
        Notification::fake();

        $groom = $this->createSeeker('male');
        $bride = $this->createSeeker('female');

        $marriage = Marriage::create([
            'groom_id' => $groom->id,
            'bride_id' => $bride->id,
            'initiated_by_user_id' => $groom->id,
            'status' => 'pending_confirmation',
        ]);

        $response = $this->actingAs($bride)->post(route('marriages.decline', $marriage->id));

        $response->assertRedirect(route('chat.index'));
        $this->assertEquals('declined', $marriage->fresh()->status);
        $this->assertEquals('never_married', $groom->fresh()->marital_status);
        $this->assertEquals('never_married', $bride->fresh()->marital_status);

        Notification::assertSentTo($groom, NikahMilestoneNotification::class);
    }

    public function test_certificate_access_is_restricted_to_couple_and_authorized_family(): void
    {
        $groom = $this->createSeeker('male', 'married');
        $bride = $this->createSeeker('female', 'married');
        $stranger = $this->createSeeker('male');

        $familyRep = User::factory()->create([
            'role' => 'family_rep',
            'email' => 'family.guardian@example.com',
            'is_verified' => true,
        ]);

        WaliLink::create([
            'seeker_user_id' => $bride->id,
            'wali_user_id' => $familyRep->id,
            'relationship_type' => 'mother',
            'permission_level' => 'full_involvement',
            'status' => 'active',
            'invite_token' => 'cert-auth-token',
        ]);

        $marriage = Marriage::create([
            'groom_id' => $groom->id,
            'bride_id' => $bride->id,
            'initiated_by_user_id' => $groom->id,
            'status' => 'confirmed',
            'confirmed_at' => now(),
            'marriage_date' => now()->toDateString(),
        ]);

        // Groom can view
        $this->actingAs($groom)->get(route('marriages.certificate', $marriage->id))
            ->assertOk()
            ->assertSee('Mangala Vivaha Blessing Certificate');

        // Bride can view
        $this->actingAs($bride)->get(route('marriages.certificate', $marriage->id))
            ->assertOk()
            ->assertSee('Mangala Vivaha Blessing Certificate');

        // Family Rep can view
        $this->actingAs($familyRep)->get(route('marriages.certificate', $marriage->id))
            ->assertOk()
            ->assertSee('Mangala Vivaha Blessing Certificate');

        // Unauthorized stranger is rejected
        $this->actingAs($stranger)->get(route('marriages.certificate', $marriage->id))
            ->assertRedirect(route('dashboard'))
            ->assertSessionHas('error', 'Unauthorized access to marriage certificate.');
    }
}
