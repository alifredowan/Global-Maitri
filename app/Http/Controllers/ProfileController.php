<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Interest;
use App\Models\PhotoAccessGrant;
use App\Models\Profile;
use App\Models\User;
use App\Models\VerificationRequest;
use App\Services\ImageOptimizationService;
use App\Services\SavedSearchAlertService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function __construct(
        protected ImageOptimizationService $imageOptimizationService
    ) {}

    public function show(): View|RedirectResponse
    {
        $user = Auth::user();

        if ($user->isSuperAdmin() || $user->isModerator()) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->isFamilyRep()) {
            return redirect()->route('wali.dashboard');
        }

        $profile = $user->profile ?? Profile::create(['user_id' => $user->id]);
        $profile->load(['photos', 'photoAccessGrants.grantedToUser']);
        $profile->updateCompleteness();

        return view('profile.show', compact('user', 'profile'));
    }

    public function edit(): View|RedirectResponse
    {
        $user = Auth::user();

        if ($user->isSuperAdmin() || $user->isModerator()) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->isFamilyRep()) {
            return redirect()->route('wali.dashboard');
        }

        $profile = $user->profile ?? Profile::create(['user_id' => $user->id]);

        return view('profile.edit', [
            'user' => $user,
            'profile' => $profile,
            'traditions' => config('buddhist.traditions'),
            'lineages' => config('buddhist.lineages'),
            'ethnicCommunities' => config('buddhist.ethnic_communities'),
            'practiceDepths' => config('buddhist.practice_depths'),
            'meditationFrequencies' => config('buddhist.meditation_frequencies'),
            'pancaSilaOptions' => config('buddhist.panca_sila_adherence'),
            'templeVisitOptions' => config('buddhist.temple_visits'),
            'uposathaOptions' => config('buddhist.uposatha_observance'),
            'dhammaStudyOptions' => config('buddhist.dhamma_study_chanting'),
            'retreatOptions' => config('buddhist.retreat_experience'),
            'dietaryOptions' => config('buddhist.dietary_preferences'),
            'alcoholOptions' => config('buddhist.alcohol_intoxicants'),
            'smokingOptions' => config('buddhist.smoking_options'),
            'countries' => config('countries'),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();

        if ($user->isSuperAdmin() || $user->isModerator()) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->isFamilyRep()) {
            return redirect()->route('wali.dashboard');
        }

        $profile = $user->profile ?? Profile::create(['user_id' => $user->id]);

        $validated = $request->validate([
            'height_cm' => ['nullable', 'integer', 'min:120', 'max:230'],
            'education_level' => ['nullable', 'string', 'max:100'],
            'profession' => ['nullable', 'string', 'max:100'],
            'employment_type' => ['nullable', 'string', 'max:50'],
            'annual_income_range' => ['nullable', 'string', 'max:50'],
            'city' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'country' => ['nullable', 'string', 'max:100'],
            'mother_tongue' => ['nullable', 'string', 'max:50'],
            'citizenship' => ['nullable', 'string', 'max:100'],
            'bio' => ['nullable', 'string', 'max:2000'],
            'children' => ['nullable', 'string', 'max:50'],

            // Buddhist Tradition & Practice (FR-2.3, FR-2.4)
            'tradition' => ['nullable', 'string', 'max:50'],
            'lineage_school' => ['nullable', 'string', 'max:100'],
            'ethnic_community' => ['nullable', 'string', 'max:100'],
            'practice_depth' => ['nullable', 'string', 'max:50'],
            'meditation_frequency' => ['nullable', 'string', 'max:50'],
            'panca_sila_adherence' => ['nullable', 'string', 'max:50'],
            'temple_visits' => ['nullable', 'string', 'max:50'],
            'uposatha_observance' => ['nullable', 'string', 'max:50'],
            'dhamma_study_chanting' => ['nullable', 'string', 'max:50'],
            'retreat_experience' => ['nullable', 'string', 'max:50'],

            // Lifestyle & Precepts (FR-2.5)
            'dietary_preference' => ['nullable', 'string', 'max:50'],
            'alcohol_intoxicants' => ['nullable', 'string', 'max:50'],
            'smoking' => ['nullable', 'string', 'max:50'],

            // Family & Living (FR-2.6)
            'parents_status' => ['nullable', 'string', 'max:100'],
            'parents_occupation' => ['nullable', 'string', 'max:100'],
            'siblings_count' => ['nullable', 'integer', 'min:0', 'max:20'],
            'family_type' => ['nullable', 'string', 'max:50'],
            'preferred_living_arrangement' => ['nullable', 'string', 'max:50'],
            'views_on_raising_children_in_dhamma' => ['nullable', 'string', 'max:500'],

            // Horoscope Module (FR-3.1 to FR-3.4)
            'horoscope_required' => ['nullable', 'boolean'],
            'birth_date' => ['nullable', 'date'],
            'birth_time' => ['nullable', 'string', 'max:50'],
            'birth_place' => ['nullable', 'string', 'max:100'],
            'porondam_score' => ['nullable', 'integer', 'min:0', 'max:100'],
            'horoscope_visibility' => ['nullable', 'string', 'in:matched_only,granted_only,hidden'],

            // Privacy & Preferences
            'photo_privacy_mode' => ['nullable', 'string', 'in:public,blurred_until_accepted,request_only,guardian_only'],
            'family_rep_required' => ['nullable', 'boolean'],
            'partner_preferences' => ['nullable', 'array'],
            'field_visibility' => ['nullable', 'array'],

            // Backward compatibility
            'sect_madhhab' => ['nullable', 'string'],
            'prayer_frequency' => ['nullable', 'string'],
            'halal_dietary_adherence' => ['nullable', 'string'],
            'wali_required' => ['nullable', 'boolean'],
        ]);

        $validated['family_rep_required'] = $request->boolean('family_rep_required', false);
        $validated['wali_required'] = $validated['family_rep_required'];
        $validated['horoscope_required'] = $request->boolean('horoscope_required', false);

        $profile->fill($validated);
        $profile->save();
        $profile->updateCompleteness();

        AuditLog::record($user->id, 'profile_updated', 'Profile', $profile->id);

        try {
            app(SavedSearchAlertService::class)->checkNewProfile($profile);
        } catch (\Throwable) {
            // ignore alert failure
        }

        return redirect()->route('profile.show')->with('success', 'Your biodata profile has been successfully updated with mindful care.');
    }

    public function uploadPhoto(Request $request): RedirectResponse
    {
        $request->validate([
            'photo' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'], // max 5MB
            'is_private' => ['nullable', 'boolean'],
        ]);

        $user = Auth::user();
        $profile = $user->profile ?? Profile::create(['user_id' => $user->id]);

        if ($profile->photos()->count() >= 6) {
            return back()->withErrors(['photo' => 'You can upload a maximum of 6 photos (FR-4.1).']);
        }

        $path = $this->imageOptimizationService->store($request->file('photo'), 'profile-photos');

        $isFirstPhoto = ! $profile->photos()->exists();

        $profile->photos()->create([
            'file_path' => $path,
            'is_primary' => $isFirstPhoto,
            'is_private' => $request->boolean('is_private'),
            'is_blurred' => ($profile->photo_privacy_mode !== 'public'),
            'moderation_status' => 'approved',
        ]);

        $profile->updateCompleteness();

        return back()->with('success', 'Photo uploaded successfully! Photo visibility is managed per your privacy settings (FR-4.1).');
    }

    public function setPrimaryPhoto(int $photoId): RedirectResponse
    {
        $profile = Auth::user()->profile;
        $photo = $profile->photos()->findOrFail($photoId);

        $profile->photos()->update(['is_primary' => false]);
        $photo->update(['is_primary' => true]);

        return back()->with('success', 'Primary profile photo updated.');
    }

    public function deletePhoto(int $photoId): RedirectResponse
    {
        $profile = Auth::user()->profile;
        $photo = $profile->photos()->findOrFail($photoId);

        if (Storage::disk('private')->exists($photo->file_path)) {
            Storage::disk('private')->delete($photo->file_path);
        }

        $wasPrimary = $photo->is_primary;
        $photo->delete();

        if ($wasPrimary) {
            $nextPhoto = $profile->photos()->first();
            $nextPhoto?->update(['is_primary' => true]);
        }

        $profile->updateCompleteness();

        return back()->with('success', 'Photo removed.');
    }

    public function uploadHoroscope(Request $request): RedirectResponse
    {
        $request->validate([
            'horoscope_doc' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'birth_date' => ['nullable', 'date'],
            'birth_time' => ['nullable', 'string', 'max:50'],
            'birth_place' => ['nullable', 'string', 'max:100'],
        ]);

        $user = Auth::user();
        $profile = $user->profile ?? Profile::create(['user_id' => $user->id]);

        $path = $request->file('horoscope_doc')->store('horoscopes', 'local');

        $profile->update([
            'horoscope_doc_path' => $path,
            'horoscope_required' => true,
            'birth_date' => $request->input('birth_date', $profile->birth_date),
            'birth_time' => $request->input('birth_time', $profile->birth_time),
            'birth_place' => $request->input('birth_place', $profile->birth_place),
        ]);

        AuditLog::record($user->id, 'horoscope_uploaded', 'Profile', $profile->id);

        return back()->with('success', 'Your horoscope document has been securely stored. It will only be visible according to your privacy settings.');
    }

    public function submitVerification(Request $request): RedirectResponse
    {
        $request->validate([
            'document_type' => ['required', 'in:national_id,passport,driving_license'],
            'document' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
            'selfie' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        $user = Auth::user();

        if (VerificationRequest::where('user_id', $user->id)->where('status', 'pending')->exists()) {
            return back()->withErrors([
                'document' => 'You already have a verification request awaiting review.',
            ]);
        }

        $docPath = $request->file('document')->store('verifications', 'private');
        $selfiePath = $request->hasFile('selfie') ? $request->file('selfie')->store('verifications', 'private') : null;

        VerificationRequest::create([
            'user_id' => $user->id,
            'document_type' => $request->document_type,
            'document_path' => $docPath,
            'selfie_path' => $selfiePath,
            'status' => 'pending',
        ]);

        AuditLog::record($user->id, 'verification_submitted', 'User', $user->id);

        return back()->with('success', 'Verification documents submitted! Our moderation team will review them within 24–48 hours to grant your Verified badge (FR-9.1).');
    }

    public function grantPhotoAccess(int $userId): RedirectResponse
    {
        $user = Auth::user();
        $profile = $user->profile;
        $recipient = User::query()
            ->whereKey($userId)
            ->where('role', 'seeker')
            ->where('is_active', true)
            ->first();

        if (! $profile || ! $recipient || $recipient->id === $user->id) {
            return back()->withErrors(['photo' => 'Photo access can only be granted to an active candidate.']);
        }

        if ($user->hasBlocked($recipient) || $user->isBlockedBy($recipient)) {
            return back()->withErrors(['photo' => 'Photo access cannot be granted because this profile is blocked.']);
        }

        PhotoAccessGrant::updateOrCreate([
            'profile_id' => $profile->id,
            'granted_to_user_id' => $userId,
        ], [
            'status' => 'active',
        ]);
        AuditLog::record($user->id, 'photo_access_granted', 'User', $recipient->id);

        return back()->with('success', 'Photo access granted! The recipient can now view your unblurred photos.');
    }

    public function revokePhotoAccess(int $userId): RedirectResponse
    {
        $user = Auth::user();
        $profile = $user->profile;
        $grant = $profile?->photoAccessGrants()
            ->where('granted_to_user_id', $userId)
            ->where('status', 'active')
            ->first();

        if (! $grant) {
            return back()->withErrors(['photo' => 'No active photo access grant was found for this user.']);
        }

        $grant->update(['status' => 'revoked']);
        AuditLog::record($user->id, 'photo_access_revoked', 'User', $userId);

        return back()->with('success', 'Photo access revoked.');
    }

    public function biodata(?int $userId = null): View|RedirectResponse
    {
        $currentUser = Auth::user();

        if ($userId === null || $userId === $currentUser->id) {
            $targetUser = $currentUser;
            $profile = $currentUser->profile ?? Profile::create(['user_id' => $currentUser->id]);
            $isOwner = true;
            $isPhotoVisible = true;
        } else {
            $targetUser = User::with(['profile.photos', 'profile.primaryPhoto'])->findOrFail($userId);
            $profile = $targetUser->profile;

            if (! $profile || ! $targetUser->is_active || $targetUser->role !== 'seeker') {
                return redirect()->route('discovery.index')->with('error', 'Profile not available.');
            }

            // Gating: If not owner, user must be Pro OR have mutual accepted interest
            $hasAcceptedInterest = Interest::where(function ($q) use ($currentUser, $targetUser) {
                $q->where('sender_id', $currentUser->id)->where('recipient_id', $targetUser->id);
            })->orWhere(function ($q) use ($currentUser, $targetUser) {
                $q->where('sender_id', $targetUser->id)->where('recipient_id', $currentUser->id);
            })->where('status', 'accepted')->exists();

            if (! $currentUser->isPro() && ! $hasAcceptedInterest) {
                return redirect()->route('subscription.pricing')
                    ->with('warning', 'Printing printable Buddhist matrimonial biodatas for candidate suitors is an exclusive Pro feature. Upgrade to print candidate biodatas for your family consultation.');
            }

            $isOwner = false;
            $isPhotoVisible = $profile->isPhotoVisibleTo($currentUser);
        }

        $activeWaliLink = $activeFamilyLink = $targetUser->waliLinksAsSeeker()
            ->where('status', 'active')
            ->first();

        return view('profile.biodata', compact('targetUser', 'profile', 'isOwner', 'isPhotoVisible', 'activeWaliLink', 'activeFamilyLink', 'currentUser'));
    }
}
