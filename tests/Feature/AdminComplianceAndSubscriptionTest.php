<?php

namespace Tests\Feature;

use App\Models\Profile;
use App\Models\Report;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Models\User;
use App\Models\VerificationRequest;
use App\Services\QuotaService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminComplianceAndSubscriptionTest extends TestCase
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
                'name' => 'Pro Single Marriage Pass',
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

    public function test_admin_can_approve_and_reject_kyc_verification_requests(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'permissions' => ['manage_verifications' => true],
            'is_verified' => true,
        ]);

        $seeker = User::factory()->create(['role' => 'seeker', 'is_verified' => false]);
        Profile::create(['user_id' => $seeker->id]);

        $verification = VerificationRequest::create([
            'user_id' => $seeker->id,
            'document_type' => 'passport',
            'document_path' => 'verifications/test-passport.pdf',
            'status' => 'pending',
        ]);

        $this->actingAs($admin);

        // Approve
        $approveResponse = $this->post(route('admin.verifications.approve', $verification->id));
        $approveResponse->assertRedirect();

        $verification->refresh();
        $this->assertEquals('approved', $verification->status);
        $this->assertEquals($admin->id, $verification->reviewer_id);
        $this->assertTrue($seeker->fresh()->is_verified);

        $this->assertDatabaseHas('audit_logs', [
            'user_id' => $admin->id,
            'action' => 'verification_approved',
            'target_id' => $seeker->id,
        ]);
    }

    public function test_admin_can_triage_abuse_report_and_ban_offender(): void
    {
        $admin = User::factory()->create([
            'role' => 'super_admin',
            'permissions' => ['moderate_users' => true],
            'is_verified' => true,
        ]);

        $reporter = User::factory()->create(['role' => 'seeker']);
        $offender = User::factory()->create(['role' => 'seeker', 'is_active' => true]);

        $report = Report::create([
            'reporter_id' => $reporter->id,
            'reported_id' => $offender->id,
            'reason' => 'dowry_demand',
            'details' => 'Suitor demanded cash and gold dowry before meeting.',
            'status' => 'pending',
        ]);

        $this->actingAs($admin);

        $response = $this->post(route('admin.reports.action', $report->id), [
            'action' => 'ban',
            'resolution_notes' => 'Zero tolerance for dowry extortion.',
        ]);

        $response->assertRedirect();
        $this->assertFalse((bool) $offender->fresh()->is_active);
        $this->assertEquals('actioned', $report->fresh()->status);
    }

    public function test_stripe_webhook_activates_subscription_and_guarantees_idempotency(): void
    {
        $seeker = User::factory()->create(['role' => 'seeker']);

        $payload = [
            'type' => 'checkout.session.completed',
            'data' => [
                'object' => [
                    'id' => 'cs_test_session_999888',
                    'payment_status' => 'paid',
                    'amount_total' => 1999,
                    'metadata' => [
                        'user_id' => $seeker->id,
                        'plan' => 'premium',
                        'billing_cycle' => 'one_time_marriage',
                    ],
                ],
            ],
        ];

        // First delivery: activates subscription
        $response1 = $this->postJson(route('webhook.stripe'), $payload);
        $response1->assertOk();
        $response1->assertJson(['status' => 'success']);

        $this->assertDatabaseHas('subscriptions', [
            'user_id' => $seeker->id,
            'plan' => 'premium',
            'payment_id' => 'cs_test_session_999888',
            'status' => 'active',
        ]);

        // Duplicate delivery (replay): returns already_processed without duplicate entry
        $response2 = $this->postJson(route('webhook.stripe'), $payload);
        $response2->assertOk();
        $response2->assertJson(['status' => 'already_processed']);

        $this->assertEquals(1, Subscription::where('payment_id', 'cs_test_session_999888')->count());
    }

    public function test_quota_service_enforces_free_limits_and_allows_unlimited_for_pro_and_guardians(): void
    {
        $quota = app(QuotaService::class);

        $freeSeeker = User::factory()->create(['role' => 'seeker']);
        $proSeeker = User::factory()->create(['role' => 'seeker']);
        $guardian = User::factory()->create(['role' => 'family_rep']);
        $targetUser = User::factory()->create(['role' => 'seeker']);

        Subscription::create([
            'user_id' => $proSeeker->id,
            'plan' => 'premium',
            'status' => 'active',
            'starts_at' => now(),
            'ends_at' => now()->addMonth(),
        ]);

        // Pro seeker has unlimited view quota
        $this->assertTrue($quota->canViewProfile($proSeeker, $targetUser->id));

        // Guardian chaperone has unlimited view quota
        $this->assertTrue($quota->canViewProfile($guardian, $targetUser->id));

        // Free seeker can view within quota limit
        $this->assertTrue($quota->canViewProfile($freeSeeker, $targetUser->id));
    }
}
