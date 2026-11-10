<?php

namespace Tests\Feature;

use App\Models\Marriage;
use App\Models\User;
use App\Notifications\NikahMilestoneNotification;
use App\Services\MarriageCompletionService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class NotificationActionUrlAndVivahaTest extends TestCase
{
    use RefreshDatabase;

    public function test_declaring_mangala_vivaha_notifies_both_spouses_with_clickable_action_url(): void
    {
        $groom = $this->createSeeker('male', 'groom.vivaha@example.com');
        $bride = $this->createSeeker('female', 'bride.vivaha@example.com');

        $service = app(MarriageCompletionService::class);
        $marriage = $service->initiate(
            initiator: $bride,
            spouseId: $groom->id,
            marriageDate: now()->format('d/m/Y'),
            notes: 'Auspicious union under loving-kindness',
            blessingTheme: 'metta_blessing',
            monkBlessingRequested: true
        );

        // Groom (recipient) should have received notification
        $groomNotif = $groom->notifications()->first();
        $this->assertNotNull($groomNotif);
        $this->assertSame('nikah_milestone_initiated', $groomNotif->data['type']);
        $this->assertSame(route('marriages.celebration'), $groomNotif->data['action_url']);
        $this->assertSame(route('marriages.celebration'), $groomNotif->data['url']);

        // Bride (initiator) should also have received a confirmation notification
        $brideNotif = $bride->notifications()->first();
        $this->assertNotNull($brideNotif);
        $this->assertSame('nikah_milestone_submitted', $brideNotif->data['type']);
        $this->assertSame(route('marriages.celebration'), $brideNotif->data['action_url']);

        // Groom visits notifications JSON endpoint (used by real-time navbar bell dropdown)
        $dropdownResponse = $this->actingAs($groom)->getJson(route('notifications.index'));
        $dropdownResponse->assertOk();
        $jsonNotifications = $dropdownResponse->json('notifications');
        $this->assertNotEmpty($jsonNotifications);
        $this->assertSame(route('marriages.celebration'), $jsonNotifications[0]['data']['action_url']);

        // Groom visits full notifications page
        $pageResponse = $this->actingAs($groom)->get(route('notifications.index'));
        $pageResponse->assertOk();
        $pageResponse->assertSee('Open Mangala Vivaha Details');
        $pageResponse->assertSee(route('marriages.celebration'));

        // Groom opens celebration screen directly from the notification link
        $celebrationResponse = $this->actingAs($groom)->get(route('marriages.celebration'));
        $celebrationResponse->assertOk();
        $celebrationResponse->assertSee('Mangala Vivaha in Mutual Confirmation');
        $celebrationResponse->assertSee('Yes, Confirm Mangala Vivaha!');
    }

    public function test_notification_with_legacy_data_is_normalized_with_action_url(): void
    {
        $groom = $this->createSeeker('male', 'legacy.groom@example.com');
        $bride = $this->createSeeker('female', 'legacy.bride@example.com');

        $marriage = Marriage::create([
            'groom_id' => $groom->id,
            'bride_id' => $bride->id,
            'initiated_by_user_id' => $bride->id,
            'status' => 'pending_confirmation',
            'marriage_date' => now()->toDateString(),
        ]);

        // Simulate legacy notification stored with only 'url' and no 'action_url'
        $groom->notifications()->create([
            'id' => Str::uuid()->toString(),
            'type' => NikahMilestoneNotification::class,
            'data' => [
                'type' => 'nikah_milestone_initiated',
                'title' => '💍 Mangala Vivaha Declared',
                'message' => 'Your spouse has declared your Mangala Vivaha!',
                'marriage_id' => $marriage->id,
                'url' => route('marriages.celebration'),
            ],
            'read_at' => null,
        ]);

        // JSON response should automatically normalize action_url
        $jsonResponse = $this->actingAs($groom)->getJson(route('notifications.index'));
        $jsonResponse->assertOk();
        $this->assertSame(route('marriages.celebration'), $jsonResponse->json('notifications.0.data.action_url'));

        // Full page view should display action button
        $pageResponse = $this->actingAs($groom)->get(route('notifications.index'));
        $pageResponse->assertOk();
        $pageResponse->assertSee(route('marriages.celebration'));
        $pageResponse->assertSee('Open Mangala Vivaha Details');
    }

    private function createSeeker(string $gender, string $email): User
    {
        return User::create([
            'name' => 'Vivaha Seeker '.ucfirst($gender),
            'email' => $email,
            'password' => bcrypt('Password123!'),
            'role' => 'seeker',
            'gender' => $gender,
            'dob' => now()->subYears(28)->toDateString(),
            'marital_status' => 'never_married',
            'is_active' => true,
            'is_verified' => true,
            'email_verified_at' => now(),
        ]);
    }
}
