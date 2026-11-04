<?php

namespace App\Http\Controllers;

use App\Models\Marriage;
use App\Services\MarriageCompletionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MarriageController extends Controller
{
    public function __construct(
        protected MarriageCompletionService $marriageService
    ) {}

    public function celebration(): View|RedirectResponse
    {
        $user = Auth::user();
        $marriage = $user->activeMarriage() ?? $user->pendingMarriage();

        if (! $marriage) {
            return redirect()->route('profile.show')
                ->with('info', 'You do not have an active or pending Mangala Vivaha marriage milestone yet.');
        }

        $spouse = $marriage->spouseOf($user);
        $isGroom = ($user->id === $marriage->groom_id);
        $isBride = ($user->id === $marriage->bride_id);

        return view('marriages.celebration', compact('marriage', 'user', 'spouse', 'isGroom', 'isBride'));
    }

    public function certificate(int $id): View|RedirectResponse
    {
        $user = Auth::user();
        $marriage = Marriage::with(['groom.profile', 'bride.profile'])->findOrFail($id);

        $isCouple = ($user->id === $marriage->groom_id || $user->id === $marriage->bride_id);
        $isFamily = $marriage->groom?->waliLinksAsSeeker()->where('wali_user_id', $user->id)->exists()
            || $marriage->bride?->waliLinksAsSeeker()->where('wali_user_id', $user->id)->exists();

        if (! $isCouple && ! $isFamily && ! $user->isAdmin()) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access to marriage certificate.');
        }

        return view('marriages.certificate', compact('marriage', 'user'));
    }

    public function initiate(Request $request): RedirectResponse
    {
        $request->validate([
            'spouse_id' => ['required', 'exists:users,id'],
            'marriage_date' => ['nullable', function (string $attribute, mixed $value, \Closure $fail): void {
                if (! $value) {
                    return;
                }
                try {
                    if (str_contains((string) $value, '/')) {
                        Carbon::createFromFormat('d/m/Y', (string) $value);
                    } else {
                        Carbon::parse((string) $value);
                    }
                } catch (\Throwable) {
                    $fail('The marriage date must be a valid date in dd/mm/yyyy format.');
                }
            }],
            'blessing_theme' => ['nullable', 'string', 'in:metta_blessing,traditional,simple'],
            'monk_blessing_requested' => ['nullable', 'boolean'],
            'confirmation_notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $user = Auth::user();

        try {
            $marriage = $this->marriageService->initiate(
                initiator: $user,
                spouseId: (int) $request->spouse_id,
                marriageDate: $request->marriage_date,
                notes: $request->confirmation_notes,
                blessingTheme: $request->input('blessing_theme', 'metta_blessing'),
                monkBlessingRequested: $request->boolean('monk_blessing_requested', false)
            );

            return redirect()->route('marriages.celebration')
                ->with('success', 'Sadhu! Mangala Vivaha completion request submitted. Your spouse and family representative can now confirm the milestone.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function confirm(Request $request, int $id): RedirectResponse
    {
        $user = Auth::user();
        $marriage = Marriage::with(['groom', 'bride'])->findOrFail($id);

        try {
            $this->marriageService->confirm($marriage, $user);

            return redirect()->route('marriages.celebration')
                ->with('success', '🌸 Sadhu Sadhu Sadhu! Mangala Vivaha Confirmed! "May you be happy and well." Peace, loving-kindness, and harmony to your lifelong marriage!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function decline(Request $request, int $id): RedirectResponse
    {
        $user = Auth::user();
        $marriage = Marriage::findOrFail($id);

        try {
            $this->marriageService->decline($marriage, $user);

            return redirect()->route('chat.index')
                ->with('info', 'Marriage confirmation request was declined.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function submitStory(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'story_title' => ['required', 'string', 'max:255'],
            'story_body' => ['required', 'string', 'max:5000'],
            'story_is_public' => ['nullable', 'boolean'],
        ]);

        $user = Auth::user();
        $marriage = Marriage::findOrFail($id);

        try {
            $this->marriageService->submitStory(
                marriage: $marriage,
                user: $user,
                title: $request->story_title,
                body: $request->story_body,
                isPublic: $request->boolean('story_is_public', true)
            );

            return back()->with('success', 'Thank you! Your Maitri Success Story has been submitted for inclusion in our community showcase.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
