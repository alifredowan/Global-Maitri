<?php

namespace Tests\Feature;

use App\Models\Interest;
use App\Models\Photo;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class PhotoPrivacyProposalTest extends TestCase
{
    use RefreshDatabase;

    public function test_sending_proposal_does_not_unblur_sender_photo_to_recipient_without_grant(): void
    {
        Http::fake();

        $sender = $this->createSeeker('male', 'sender.groom@example.com');
        $recipient = $this->createSeeker('female', 'recipient.bride@example.com');

        $senderProfile = Profile::create([
            'user_id' => $sender->id,
            'photo_privacy_mode' => 'blurred_until_accepted',
            'city' => 'Colombo',
            'country' => 'Sri Lanka',
        ]);
        $senderPhoto = Photo::create([
            'profile_id' => $senderProfile->id,
            'file_path' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400',
            'is_primary' => true,
            'is_blurred' => true,
            'moderation_status' => 'approved',
        ]);

        $recipientProfile = Profile::create([
            'user_id' => $recipient->id,
            'photo_privacy_mode' => 'blurred_until_accepted',
            'city' => 'Kandy',
            'country' => 'Sri Lanka',
        ]);
        $recipientPhoto = Photo::create([
            'profile_id' => $recipientProfile->id,
            'file_path' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=400',
            'is_primary' => true,
            'is_blurred' => true,
            'moderation_status' => 'approved',
        ]);

        // Sender sends proposal to Recipient
        $sendResponse = $this->actingAs($sender)->post(route('interests.send', $recipient->id), [
            'note' => 'Metta greetings. I would like to express matrimonial proposal.',
        ]);
        $sendResponse->assertSessionHas('success');

        $this->assertDatabaseHas('interests', [
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'status' => 'pending',
        ]);

        // Privacy assertion: Photos must remain shielded/blurred to each other
        $this->assertFalse($senderProfile->fresh()->isPhotoVisibleTo($recipient));
        $this->assertFalse($recipientProfile->fresh()->isPhotoVisibleTo($sender));

        // When recipient checks /photos/{photo}/view, they should not be served raw original image
        $photoResponse = $this->actingAs($recipient)->get(route('photos.view', $senderPhoto->id));
        $photoResponse->assertOk();
        $this->assertFalse($photoResponse->isRedirection());

        // When recipient visits proposals page, sender photo is marked shielded
        $interestIndexResponse = $this->actingAs($recipient)->get(route('interests.index'));
        $interestIndexResponse->assertOk();
        $interestIndexResponse->assertSee('photo-shield');
        $interestIndexResponse->assertSee('🔒');

        // When recipient visits sender's profile, photo is marked with Lotus Photo Privacy Shield
        $discoveryResponse = $this->actingAs($recipient)->get(route('discovery.show', $sender->id));
        $discoveryResponse->assertOk();
        $discoveryResponse->assertSee('photo-shield');
        $discoveryResponse->assertSee('Lotus Photo Privacy Active (FR-5.1)');
    }

    public function test_granting_photo_access_unblurs_photo_for_specific_candidate(): void
    {
        $sender = $this->createSeeker('male', 'grant.sender@example.com');
        $recipient = $this->createSeeker('female', 'grant.recipient@example.com');

        $senderProfile = Profile::create([
            'user_id' => $sender->id,
            'photo_privacy_mode' => 'blurred_until_accepted',
            'city' => 'Dhaka',
            'country' => 'Bangladesh',
        ]);
        Photo::create([
            'profile_id' => $senderProfile->id,
            'file_path' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400',
            'is_primary' => true,
            'is_blurred' => true,
            'moderation_status' => 'approved',
        ]);

        $recipientProfile = Profile::create([
            'user_id' => $recipient->id,
            'photo_privacy_mode' => 'blurred_until_accepted',
            'city' => 'Chittagong',
            'country' => 'Bangladesh',
        ]);

        // Before grant, photo is not visible to recipient
        $this->assertFalse($senderProfile->fresh()->isPhotoVisibleTo($recipient));

        // Sender explicitly grants photo access to recipient
        $grantResponse = $this->actingAs($sender)->post(route('profile.photos.grant', $recipient->id));
        $grantResponse->assertSessionHas('success');

        $this->assertDatabaseHas('photo_access_grants', [
            'profile_id' => $senderProfile->id,
            'granted_to_user_id' => $recipient->id,
            'status' => 'active',
        ]);

        // After grant, photo IS visible to recipient
        $this->assertTrue($senderProfile->fresh()->isPhotoVisibleTo($recipient));
    }

    public function test_mutual_interest_with_pending_wali_does_not_unblur_photos_prematurely(): void
    {
        $sender = $this->createSeeker('male', 'wali.sender@example.com');
        $recipient = $this->createSeeker('female', 'wali.recipient@example.com');

        $senderProfile = Profile::create([
            'user_id' => $sender->id,
            'photo_privacy_mode' => 'blurred_until_accepted',
        ]);
        $recipientProfile = Profile::create([
            'user_id' => $recipient->id,
            'photo_privacy_mode' => 'blurred_until_accepted',
            'wali_required' => true,
            'family_rep_required' => true,
        ]);

        // Create interest accepted by recipient but pending wali approval
        $interest = Interest::create([
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'status' => 'accepted',
            'wali_approval_status' => 'pending',
        ]);

        // Photos must NOT be visible because Wali approval is pending
        $this->assertFalse($senderProfile->fresh()->isPhotoVisibleTo($recipient));
        $this->assertFalse($recipientProfile->fresh()->isPhotoVisibleTo($sender));

        // When Wali approves
        $interest->update(['wali_approval_status' => 'approved']);

        // Photos become mutually visible
        $this->assertTrue($senderProfile->fresh()->isPhotoVisibleTo($recipient));
        $this->assertTrue($recipientProfile->fresh()->isPhotoVisibleTo($sender));
    }

    private function createSeeker(string $gender, string $email): User
    {
        return User::create([
            'name' => 'Buddhist Seeker '.ucfirst($gender),
            'email' => $email,
            'password' => bcrypt('Password123!'),
            'role' => 'seeker',
            'gender' => $gender,
            'dob' => now()->subYears(27)->toDateString(),
            'marital_status' => 'never_married',
            'is_active' => true,
            'is_verified' => true,
            'email_verified_at' => now(),
        ]);
    }
}
