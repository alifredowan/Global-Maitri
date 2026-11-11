<?php

namespace Tests\Feature;

use Database\Seeders\SubscriptionPlanSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubscriptionPricingTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(SubscriptionPlanSeeder::class);
    }

    public function test_guests_can_view_pricing_and_register_without_an_active_plan(): void
    {
        $response = $this->get(route('subscription.pricing'));

        $response->assertSee('Membership Plans & Tiers', false)
            ->assertSee('Free Explorer')
            ->assertSee('Pro Single Marriage Pass')
            ->assertSee('VIP Maitri Blessing Pass')
            ->assertSee('Our Single Marriage Guarantee (One-Time Pass Guarantee)')
            ->assertDontSee("\u{09B8}\u{09BE}\u{09AC}\u{09B8}\u{0995}\u{09CD}\u{09B0}\u{09BF}\u{09AA}\u{09B6}\u{09A8} \u{0997}\u{09CD}\u{09AF}\u{09BE}\u{09B0}\u{09BE}\u{09A8}\u{09CD}\u{099F}\u{09BF}")
            ->assertSee('href="'.route('register').'"', false)
            ->assertDontSee('Current Active Plan')
            ->assertDontSee('Your Current Plan')
            ->assertDontSee('Downgrade to Free');
    }
}
