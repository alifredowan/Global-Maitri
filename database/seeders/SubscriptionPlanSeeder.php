<?php

namespace Database\Seeders;

use App\Models\SubscriptionPlan;
use Illuminate\Database\Seeder;

class SubscriptionPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Free Explorer',
                'slug' => 'free',
                'description' => 'Core Buddhist matching features, optional family representative support, and respectful messaging.',
                'monthly_price' => 0.00,
                'annual_price' => 0.00,
                'daily_profile_views' => 10,
                'daily_interests' => 5,
                'advanced_filters' => false,
                'profile_boost' => false,
                'see_who_viewed' => false,
                'dedicated_advisor' => false,
                'badge_text' => 'Free Forever',
                'is_popular' => false,
                'sort_order' => 1,
                'features' => [
                    '10 daily profile views (FR-7.4)',
                    '5 daily interest requests (FR-7.4)',
                    'Family Representative support for both genders (FR-5.3)',
                    'Customizable photo privacy controls (FR-4.2)',
                    'Real-time chat after mutual acceptance (FR-8.1)',
                    'Zero expiration, always free',
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Pro Single Marriage Pass',
                'slug' => 'premium',
                'description' => 'Pay once and enjoy unlimited discovery, advanced Dhamma filters, and visitor analytics until your confirmed wedding.',
                'monthly_price' => 49.00,
                'annual_price' => 49.00,
                'daily_profile_views' => -1,
                'daily_interests' => -1,
                'advanced_filters' => true,
                'profile_boost' => false,
                'see_who_viewed' => true,
                'dedicated_advisor' => false,
                'badge_text' => 'Most Popular',
                'is_popular' => true,
                'sort_order' => 2,
                'features' => [
                    'Single Marriage Guarantee: Active until confirmed wedding (FR-10.1)',
                    'No monthly or annual recurring fees',
                    'Unlimited daily profile views & interest requests (FR-10.2)',
                    'Advanced Dhamma & practice filters (meditation, precepts, diet)',
                    'See who viewed your profile (Visitor Analytics)',
                    'Shortlist candidates with private family notes (FR-6.7)',
                    'Discreet Incognito browsing mode',
                    'Priority ID verification review (FR-9.1)',
                    'Digital Mangala Vivaha wedding blessing certificate (FR-11.2)',
                ],
                'is_active' => true,
            ],
            [
                'name' => 'VIP Maitri Blessing Pass',
                'slug' => 'premium_plus',
                'description' => 'Maximum visibility with profile boost and personalized matrimonial advisor assistance until your Mangala Vivaha.',
                'monthly_price' => 99.00,
                'annual_price' => 99.00,
                'daily_profile_views' => -1,
                'daily_interests' => -1,
                'advanced_filters' => true,
                'profile_boost' => true,
                'see_who_viewed' => true,
                'dedicated_advisor' => true,
                'badge_text' => 'VIP Tier',
                'is_popular' => false,
                'sort_order' => 3,
                'features' => [
                    'Single Marriage Guarantee: Active until confirmed wedding',
                    'Top profile boost in search discovery ranking',
                    'Lotus VIP badge & Spotlight ranking',
                    'Priority proposal highlight on suitors',
                    'All Pro Single Marriage Pass features included',
                    'Dedicated matrimonial advisor consultation',
                    'Monk/Elder blessing coordination guidance (FR-11.2)',
                ],
                'is_active' => true,
            ],
        ];

        foreach ($plans as $planData) {
            SubscriptionPlan::updateOrCreate(
                ['slug' => $planData['slug']],
                $planData
            );
        }
    }
}
