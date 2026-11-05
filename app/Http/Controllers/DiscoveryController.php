<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Interest;
use App\Models\Profile;
use App\Models\SavedSearch;
use App\Models\User;
use App\Services\MatchingEngineService;
use App\Services\QuotaService;
use App\Services\WaliWorkflowService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DiscoveryController extends Controller
{
    public function __construct(
        protected MatchingEngineService $matchingEngine,
        protected QuotaService $quotaService,
        protected WaliWorkflowService $waliWorkflowService
    ) {}

    public function index(Request $request): View
    {
        $request->validate([
            'gender' => ['nullable', 'in:male,female'],
            'country' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'marital_status' => ['nullable', 'in:never_married,divorced,widowed,annulled'],
            'age_min' => ['nullable', 'integer', 'min:17', 'max:100', 'lte:age_max'],
            'age_max' => ['nullable', 'integer', 'min:17', 'max:100'],
            'mother_tongue' => ['nullable', 'string', 'max:255'],
            'tradition' => ['nullable', 'string', 'max:50'],
            'meditation_frequency' => ['nullable', 'string', 'max:50'],
            'panca_sila_adherence' => ['nullable', 'string', 'max:50'],
            'dietary_preference' => ['nullable', 'string', 'max:50'],
            'ethnic_community' => ['nullable', 'string', 'max:100'],
            'education_level' => ['nullable', 'string', 'max:255'],
            'family_rep_required' => ['nullable', 'boolean'],
            // Backward compatibility
            'sect' => ['nullable', 'string'],
            'prayer_frequency' => ['nullable', 'string'],
            'wali_required' => ['nullable', 'boolean'],
            'sort' => ['nullable', 'in:newest,verified,complete,compatibility'],
        ]);

        $currentUser = Auth::user();
        $userProfile = $currentUser->profile;

        // Strict opposite gender discovery (FR-6.1)
        if ($currentUser->gender === 'male') {
            $targetGender = 'female';
        } elseif ($currentUser->gender === 'female') {
            $targetGender = 'male';
        } else {
            $targetGender = $request->input('gender', 'female');
        }

        $query = Profile::with(['user.activeSubscription', 'primaryPhoto'])
            ->where('user_id', '!=', $currentUser->id)
            ->whereNotIn('user_id', $currentUser->blockedUsers()->pluck('users.id'))
            ->whereNotIn('user_id', $currentUser->blockedByUsers()->pluck('users.id'))
            ->whereHas('user', function ($q) use ($targetGender) {
                $q->where('is_active', true)
                    ->where('role', 'seeker')
                    ->where('marital_status', '!=', 'married')
                    ->where('gender', $targetGender);
            });

        // Basic Filters (FR-6.2)
        if ($request->filled('country')) {
            $query->where('country', 'like', '%'.$request->country.'%');
        }
        if ($request->filled('city')) {
            $query->where('city', 'like', '%'.$request->city.'%');
        }
        if ($request->filled('mother_tongue')) {
            $query->where('mother_tongue', 'like', '%'.$request->mother_tongue.'%');
        }
        if ($request->filled('marital_status')) {
            $query->whereHas('user', fn ($q) => $q->where('marital_status', $request->marital_status));
        }

        // Age filter
        if ($request->filled('age_min')) {
            $maxDob = Carbon::now()->subYears((int) $request->age_min)->toDateString();
            $query->whereHas('user', fn ($q) => $q->where('dob', '<=', $maxDob));
        }
        if ($request->filled('age_max')) {
            $minDob = Carbon::now()->subYears((int) $request->age_max + 1)->toDateString();
            $query->whereHas('user', fn ($q) => $q->where('dob', '>=', $minDob));
        }

        // Advanced Filters (Pro) (FR-6.3)
        if ($request->filled('tradition')) {
            $query->where('tradition', $request->tradition);
        }
        if ($request->filled('meditation_frequency')) {
            $query->where('meditation_frequency', $request->meditation_frequency);
        }
        if ($request->filled('panca_sila_adherence')) {
            $query->where('panca_sila_adherence', $request->panca_sila_adherence);
        }
        if ($request->filled('dietary_preference')) {
            $query->where('dietary_preference', $request->dietary_preference);
        }
        if ($request->filled('ethnic_community')) {
            $query->where('ethnic_community', $request->ethnic_community);
        }
        if ($request->filled('education_level')) {
            $query->where('education_level', $request->education_level);
        }
        if ($request->boolean('family_rep_required') || $request->boolean('wali_required')) {
            $query->where(function ($q) {
                $q->where('family_rep_required', true)->orWhere('wali_required', true);
            });
        }

        // Backward compatibility
        if ($request->filled('sect')) {
            $query->where(function ($q) use ($request) {
                $q->where('tradition', $request->sect)->orWhere('sect_madhhab', $request->sect);
            });
        }
        if ($request->filled('prayer_frequency')) {
            $query->where('prayer_frequency', $request->prayer_frequency);
        }

        $sort = in_array($request->input('sort'), ['newest', 'verified', 'complete', 'compatibility'], true)
            ? $request->input('sort')
            : 'newest';

        if ($sort === 'verified') {
            $query->join('users as sort_users', 'sort_users.id', '=', 'profiles.user_id')
                ->select('profiles.*')
                ->orderByDesc('sort_users.is_verified')
                ->orderByDesc('profiles.created_at');
        } elseif ($sort === 'complete') {
            $query->orderByDesc('profiles.completeness_percentage')
                ->orderByDesc('profiles.created_at');
        } else {
            $query->latest();
        }

        $profiles = $query->paginate(12)->withQueryString();

        // Calculate compatibility score and highlights for each card (FR-6.4)
        if ($userProfile) {
            $profiles->getCollection()->transform(function (Profile $p) use ($userProfile) {
                $p->compatibility_score = $this->matchingEngine->computeCompatibility($userProfile, $p);
                $p->compatibility_highlights = $this->matchingEngine->getCompatibilityHighlights($userProfile, $p);

                return $p;
            });

            if ($sort === 'compatibility') {
                $sorted = $profiles->getCollection()->sortByDesc('compatibility_score')->values();
                $profiles->setCollection($sorted);
            }
        }

        $savedSearches = $currentUser->savedSearches()->latest()->get();
        $quotaStats = $this->quotaService->getUsageStats($currentUser);
        $bookmarkedUserIds = $currentUser->bookmarks()->pluck('bookmarked_user_id')->all();
        $dailyRecommendations = $this->matchingEngine->getDailyMatches($currentUser, 6);

        return view('discovery.index', [
            'profiles' => $profiles,
            'currentUser' => $currentUser,
            'quotaStats' => $quotaStats,
            'bookmarkedUserIds' => $bookmarkedUserIds,
            'dailyRecommendations' => $dailyRecommendations,
            'savedSearches' => $savedSearches,
            'sort' => $sort,
            'traditions' => config('buddhist.traditions'),
            'meditationFrequencies' => config('buddhist.meditation_frequencies'),
            'pancaSilaOptions' => config('buddhist.panca_sila_adherence'),
            'dietaryOptions' => config('buddhist.dietary_preferences'),
            'ethnicCommunities' => config('buddhist.ethnic_communities'),
            'countries' => config('countries'),
        ]);
    }

    public function show(int $userId): View|RedirectResponse
    {
        $currentUser = Auth::user();
        $targetUser = User::with([
            'profile.photos',
            'profile.primaryPhoto',
            'profile.approvedPhotos',
            'waliLinksAsSeeker.wali',
        ])->findOrFail($userId);

        $profile = $targetUser->profile;

        if ($currentUser->hasBlockedRelationshipWith($targetUser)) {
            return redirect()->route('discovery.index')->with('error', 'This profile is blocked from your discovery experience.');
        }

        if (! $profile || ! $targetUser->is_active || $targetUser->role !== 'seeker') {
            return redirect()->route('discovery.index')->with('error', 'Candidate profile is unavailable or inactive.');
        }

        if ($targetUser->isMarried()) {
            return redirect()->route('discovery.index')->with('info', 'This profile is already married (Mangala Vivaha completed) and is no longer available in discovery.');
        }

        if ($currentUser->role === 'seeker' && $currentUser->gender && $targetUser->gender && $currentUser->gender === $targetUser->gender) {
            return redirect()->route('discovery.index')->with('error', 'You can only view candidate profiles of the opposite gender.');
        }

        // Enforce daily profile view limit (FR-7.4)
        if (! $this->quotaService->canViewProfile($currentUser, $targetUser->id)) {
            return redirect()->route('subscription.pricing')->with('warning', 'You have reached your daily limit of 10 profile views. Upgrade to Pro Single Marriage Pass for unlimited views!');
        }

        $this->quotaService->recordView($currentUser, $targetUser->id);

        $compatibilityScore = null;
        if ($currentUser->profile) {
            $compatibilityScore = $this->matchingEngine->computeCompatibility($currentUser->profile, $profile);
        }
        $compatibilityHighlights = $currentUser->profile
            ? $this->matchingEngine->getCompatibilityHighlights($currentUser->profile, $profile)
            : [];

        // Check photo visibility permission (FR-4.2)
        $isPhotoVisible = $profile->isPhotoVisibleTo($currentUser);
        $hasGrantedPhotoAccess = $currentUser->profile?->photoAccessGrants()
            ->where('granted_to_user_id', $targetUser->id)
            ->where('status', 'active')
            ->exists() ?? false;

        // Check horoscope visibility permission (FR-3.4)
        $isHoroscopeVisible = $profile->isHoroscopeVisibleTo($currentUser);

        // Check existing interest relationship
        $existingInterest = Interest::where(function ($q) use ($currentUser, $targetUser) {
            $q->where('sender_id', $currentUser->id)->where('recipient_id', $targetUser->id);
        })->orWhere(function ($q) use ($currentUser, $targetUser) {
            $q->where('sender_id', $targetUser->id)->where('recipient_id', $currentUser->id);
        })->first();

        // Resolve conversation if interest was accepted
        $conversation = null;
        if ($existingInterest && $existingInterest->status === 'accepted') {
            $conversation = $existingInterest->conversation;
        }

        if (! $conversation) {
            $conversation = Conversation::whereHas('participants', function ($q) use ($currentUser) {
                $q->where('conversation_participants.user_id', $currentUser->id);
            })->whereHas('participants', function ($q) use ($targetUser) {
                $q->where('conversation_participants.user_id', $targetUser->id);
            })->first();
        }

        // Active Family Representative
        $activeFamilyLink = $targetUser->waliLinksAsSeeker()->where('status', 'active')->first();

        // Shortlisted by current user (FR-6.7)
        $isBookmarked = $currentUser->hasBookmarked($targetUser->id);

        return view('discovery.show', compact(
            'targetUser',
            'profile',
            'compatibilityScore',
            'compatibilityHighlights',
            'isPhotoVisible',
            'isHoroscopeVisible',
            'hasGrantedPhotoAccess',
            'existingInterest',
            'activeFamilyLink',
            'isBookmarked',
            'conversation'
        ));
    }

    public function saveSearch(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => ['required', 'string', 'max:100'],
        ]);

        $filters = array_filter(
            $request->only([
                'age_min',
                'age_max',
                'country',
                'city',
                'marital_status',
                'tradition',
                'sect',
                'meditation_frequency',
                'prayer_frequency',
                'panca_sila_adherence',
                'dietary_preference',
                'ethnic_community',
                'education_level',
                'family_rep_required',
                'wali_required',
            ]),
            fn ($value): bool => filled($value)
        );

        SavedSearch::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'filters' => $filters,
            'alerts_enabled' => true,
        ]);

        return back()->with('success', 'Search criteria saved! You will receive mindful alerts when matching candidates join (FR-6.6).');
    }

    public function toggleSavedSearchAlerts(int $savedSearchId): RedirectResponse
    {
        $savedSearch = Auth::user()->savedSearches()->findOrFail($savedSearchId);
        $savedSearch->update(['alerts_enabled' => ! $savedSearch->alerts_enabled]);

        return back()->with('success', $savedSearch->alerts_enabled
            ? 'Alerts enabled for this saved search.'
            : 'Alerts paused for this saved search.');
    }

    public function destroySavedSearch(int $savedSearchId): RedirectResponse
    {
        Auth::user()->savedSearches()->findOrFail($savedSearchId)->delete();

        return back()->with('success', 'Saved search removed.');
    }
}
