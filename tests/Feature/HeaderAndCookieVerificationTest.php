<?php

namespace Tests\Feature;

use App\Models\PlatformSetting;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HeaderAndCookieVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_icon_badge_renders_correctly_for_zero_one_nine_and_twenty_five(): void
    {
        // 0 unread: badge hidden
        $viewZero = $this->blade('<x-icon-badge :count="0" />');
        $viewZero->assertSee('x-show="count > 0"', false);
        $viewZero->assertDontSee('>0<', false);

        // 1 unread: renders 1
        $viewOne = $this->blade('<x-icon-badge :count="1" />');
        $viewOne->assertSee('1');

        // 9 unread: renders 9
        $viewNine = $this->blade('<x-icon-badge :count="9" />');
        $viewNine->assertSee('9');

        // 25 unread: renders 9+
        $viewTwentyFive = $this->blade('<x-icon-badge :count="25" />');
        $viewTwentyFive->assertSee('9+');
    }

    public function test_header_renders_gracefully_with_very_long_display_name_and_initials_fallback(): void
    {
        $longName = 'Venerable Maha Upasaka Jayasundara Mudiyanselage Anuruddha Bandara';
        $user = User::factory()->create([
            'name' => $longName,
            'role' => 'seeker',
            'is_active' => true,
            'is_verified' => true,
        ]);

        Profile::create([
            'user_id' => $user->id,
            'city' => 'Kandy',
            'country' => 'Sri Lanka',
        ]);

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertStatus(200);
        $response->assertSee($longName);
        // Initials fallback should render "V"
        $response->assertSee('V');
        // Messages and notification icons are present
        $response->assertSee('title="Messages"', false);
        $response->assertSee('title="Notifications"', false);
        $response->assertSee('title="Account"', false);
    }

    public function test_cookie_consent_banner_is_present_with_required_buttons_and_dialog_role(): void
    {
        $response = $this->get(route('landing'));

        $response->assertStatus(200);
        $response->assertSee('id="cookie-consent-banner"', false);
        $response->assertSee('role="dialog"', false);
        $response->assertSee('We use a few cookies to keep you signed in');
        $response->assertSee('Accept all');
        $response->assertSee('Essential only');
        $response->assertSee('Customize');
    }

    public function test_cookie_policy_and_privacy_policy_pages_are_functional(): void
    {
        $cookieResponse = $this->get(route('cookies'));
        $cookieResponse->assertStatus(200);
        $cookieResponse->assertSee('Cookie Policy');
        $cookieResponse->assertSee('Strictly Necessary');
        $cookieResponse->assertSee('Analytics &amp; Performance', false);

        $privacyResponse = $this->get(route('privacy'));
        $privacyResponse->assertStatus(200);
        $privacyResponse->assertSee('Privacy Policy');
        $privacyResponse->assertSee('Cookies &amp; Local Storage', false);
    }

    public function test_footer_cookie_settings_button_visible_to_all_visitors_in_public_footer(): void
    {
        $response = $this->get(route('landing'));

        $response->assertStatus(200);
        $response->assertSee('Cookie settings');
        $response->assertSee('$dispatch(\'open-cookie-settings\')', false);
    }

    public function test_settings_privacy_tab_contains_cookie_settings_for_logged_in_users(): void
    {
        $user = User::factory()->create([
            'name' => 'Tenzin Norbu',
            'role' => 'seeker',
            'is_active' => true,
        ]);

        Profile::create([
            'user_id' => $user->id,
            'city' => 'Kathmandu',
            'country' => 'Nepal',
        ]);

        $response = $this->actingAs($user)->get(route('settings.index'));

        $response->assertStatus(200);
        $response->assertSee('Cookie settings');
        $response->assertSee('$dispatch(\'open-cookie-settings\')', false);
    }

    public function test_admin_compliance_route_is_strictly_protected_by_role_checks(): void
    {
        // 1. Guest -> redirect to login
        $guestResponse = $this->get(route('admin.compliance'));
        $guestResponse->assertRedirect(route('login'));

        // 2. Regular seeker -> 403 Forbidden
        $seeker = User::factory()->create(['role' => 'seeker', 'is_active' => true]);
        $seekerResponse = $this->actingAs($seeker)->get(route('admin.compliance'));
        $seekerResponse->assertStatus(403);

        // 3. Super Admin -> 200 OK
        $superAdmin = User::factory()->create([
            'role' => 'super_admin',
            'is_active' => true,
            'is_verified' => true,
        ]);

        $adminResponse = $this->actingAs($superAdmin)->get(route('admin.compliance'));
        $adminResponse->assertStatus(200);
        $adminResponse->assertSee('Cookie Consent &amp; Privacy Compliance', false);
        $adminResponse->assertSee('cookie_banner_heading');

        // 4. Super Admin can update compliance settings
        $postResponse = $this->actingAs($superAdmin)->post(route('admin.compliance.update'), [
            'cookie_banner_heading' => 'Updated Privacy Heading',
            'cookie_banner_text' => 'Updated cookie disclosure text for testing.',
            'cookie_policy_url' => '/cookies',
            'privacy_policy_url' => '/privacy',
        ]);

        $postResponse->assertRedirect(route('admin.compliance'));
        $this->assertEquals('Updated Privacy Heading', PlatformSetting::get('cookie_banner_heading'));
    }
}
