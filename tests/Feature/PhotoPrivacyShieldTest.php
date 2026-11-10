<?php

namespace Tests\Feature;

use App\Models\Interest;
use App\Models\Photo;
use App\Models\Profile;
use App\Models\User;
use App\Models\WaliLink;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PhotoPrivacyShieldTest extends TestCase
{
    use RefreshDatabase;

    public function test_photo_deletion_automatically_cleans_up_private_disk_and_blurred_cache(): void
    {
        Storage::fake('private');

        $user = User::factory()->create(['role' => 'seeker']);
        $profile = Profile::create(['user_id' => $user->id]);

        $filePath = 'profile-photos/test-image.webp';
        Storage::disk('private')->put($filePath, 'fake-image-bytes');

        $photo = Photo::create([
            'profile_id' => $profile->id,
            'file_path' => $filePath,
            'is_primary' => true,
            'is_private' => false,
            'is_blurred' => false,
            'moderation_status' => 'approved',
        ]);

        // Create a simulated blurred cache file
        $cacheDir = storage_path('app/blurred-photos');
        if (! is_dir($cacheDir)) {
            mkdir($cacheDir, 0755, true);
        }
        $cacheFile = $cacheDir.'/blurred_'.$photo->id.'.jpg';
        file_put_contents($cacheFile, 'blurred-cache-content');

        $this->assertTrue(Storage::disk('private')->exists($filePath));
        $this->assertFileExists($cacheFile);

        // Delete photo
        $photo->delete();

        // Ensure storage and cache were cleaned up
        $this->assertFalse(Storage::disk('private')->exists($filePath));
        $this->assertFileDoesNotExist($cacheFile);
    }

    public function test_guardian_only_photo_privacy_mode_enforces_guardian_and_advisor_access(): void
    {
        $candidate = User::factory()->create(['role' => 'seeker']);
        $profile = Profile::create([
            'user_id' => $candidate->id,
            'photo_privacy_mode' => 'guardian_only',
        ]);

        $guardian = User::factory()->create(['role' => 'family_rep']);
        WaliLink::create([
            'seeker_user_id' => $candidate->id,
            'wali_user_id' => $guardian->id,
            'relationship_type' => 'father',
            'permission_level' => 'full_involvement',
            'status' => 'active',
            'invite_token' => 'active-token-1',
        ]);

        $otherSeeker = User::factory()->create(['role' => 'seeker']);

        // Guardian can view
        $this->assertTrue($profile->isPhotoVisibleTo($guardian));

        // Third-party seeker cannot view
        $this->assertFalse($profile->isPhotoVisibleTo($otherSeeker));
    }

    public function test_individual_private_photo_requires_explicit_grant(): void
    {
        $candidate = User::factory()->create(['role' => 'seeker']);
        $suitor = User::factory()->create(['role' => 'seeker']);

        $profile = Profile::create([
            'user_id' => $candidate->id,
            'photo_privacy_mode' => 'blurred_until_accepted',
        ]);

        // Mutual proposal accepted
        Interest::create([
            'sender_id' => $suitor->id,
            'recipient_id' => $candidate->id,
            'status' => 'accepted',
            'wali_approval_status' => 'approved',
        ]);

        $normalPhoto = Photo::create([
            'profile_id' => $profile->id,
            'file_path' => 'profile-photos/normal.webp',
            'is_primary' => true,
            'is_private' => false,
            'is_blurred' => true,
            'moderation_status' => 'approved',
        ]);

        $privatePhoto = Photo::create([
            'profile_id' => $profile->id,
            'file_path' => 'profile-photos/extra-private.webp',
            'is_primary' => false,
            'is_private' => true,
            'is_blurred' => true,
            'moderation_status' => 'approved',
        ]);

        // Normal photo is visible because mutual proposal is accepted
        $this->assertTrue($profile->isPhotoVisibleTo($suitor));

        // Acting as suitor, accessing normal photo vs private photo
        $this->actingAs($suitor);

        $resNormal = $this->get(route('photos.view', $normalPhoto->id));
        // Should not be silhouette
        $resNormal->assertOk();

        // Accessing private photo without explicit grant returns silhouette/blurred
        $resPrivate = $this->get(route('photos.view', $privatePhoto->id));
        $resPrivate->assertOk();
        $this->assertStringContainsString('Lotus Privacy Shield Active', $resPrivate->getContent());
    }

    public function test_kyc_verification_upload_stores_documents_on_private_disk(): void
    {
        Storage::fake('private');

        $user = User::factory()->create(['role' => 'seeker']);
        $this->actingAs($user);

        $document = UploadedFile::fake()->create('passport.pdf', 1024, 'application/pdf');
        $selfie = UploadedFile::fake()->image('selfie.jpg');

        $response = $this->post(route('profile.verification.submit'), [
            'document_type' => 'passport',
            'document' => $document,
            'selfie' => $selfie,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $verification = $user->verificationRequests()->latest()->first();
        $this->assertNotNull($verification);
        $this->assertEquals('passport', $verification->document_type);
        $this->assertEquals('pending', $verification->status);

        // Document must exist on private storage disk
        $this->assertTrue(Storage::disk('private')->exists($verification->document_path));
        $this->assertTrue(Storage::disk('private')->exists($verification->selfie_path));
    }
}
