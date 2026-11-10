<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginCaptchaTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_page_renders_captcha_challenge(): void
    {
        $response = $this->get(route('login'));

        $response->assertOk();
        $response->assertSee('Security Challenge (CAPTCHA)');
        $response->assertSee('refreshCaptcha');
        $this->assertNotNull(session('login_captcha_answer'));
    }

    public function test_captcha_refresh_endpoint_returns_json_with_new_question(): void
    {
        $response = $this->get(route('captcha.refresh'));

        $response->assertOk();
        $response->assertJsonStructure(['question']);
        $this->assertNotNull(session('login_captcha_answer'));
    }

    public function test_login_fails_with_incorrect_captcha(): void
    {
        $user = User::create([
            'name' => 'Captcha Test User',
            'email' => 'captcha.test@example.com',
            'password' => bcrypt('Secret123!'),
            'role' => 'seeker',
            'gender' => 'male',
            'dob' => now()->subYears(26)->toDateString(),
            'marital_status' => 'never_married',
            'is_active' => true,
            'is_verified' => true,
            'email_verified_at' => now(),
        ]);

        $this->withSession(['login_captcha_answer' => 17]);

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'Secret123!',
            'captcha' => '99',
        ]);

        $response->assertSessionHasErrors('captcha');
        $this->assertGuest();
    }

    public function test_login_succeeds_with_correct_captcha(): void
    {
        $user = User::create([
            'name' => 'Captcha Success User',
            'email' => 'captcha.success@example.com',
            'password' => bcrypt('Secret123!'),
            'role' => 'seeker',
            'gender' => 'female',
            'dob' => now()->subYears(25)->toDateString(),
            'marital_status' => 'never_married',
            'is_active' => true,
            'is_verified' => true,
            'email_verified_at' => now(),
        ]);

        $this->withSession(['login_captcha_answer' => 14]);

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'Secret123!',
            'captcha' => '14',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($user);
    }
}
