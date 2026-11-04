<?php

namespace App\Services;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Collection;

class MatchingEngineService
{
    /**
     * Compute Dhamma & Lifestyle compatibility percentage between two seeker profiles.
     * Weights Buddhist tradition, meditation practice, and Five Precepts adherence (FR-6.4).
     */
    public function computeCompatibility(Profile $p1, Profile $p2): int
    {
        $u1 = $p1->user;
        $u2 = $p2->user;

        // Non-seekers (e.g. super_admin, moderator, family_rep) cannot be matched
        if (($u1->role && $u1->role !== 'seeker') || ($u2->role && $u2->role !== 'seeker')) {
            return 0;
        }

        if ($u1->gender && $u2->gender && $u1->gender === $u2->gender) {
            return 0;
        }

        $score = 0;

        // 1. Buddhist Tradition & School Alignment (Weight: 20 points)
        if ($p1->tradition && $p2->tradition) {
            if (strtolower($p1->tradition) === strtolower($p2->tradition)) {
                $score += 20;
            } elseif ($p1->tradition === 'non_denominational' || $p2->tradition === 'non_denominational') {
                $score += 15;
            } else {
                $score += 10;
            }
        } elseif ($p1->sect_madhhab && $p2->sect_madhhab) {
            // Backward compatibility
            $score += (strtolower($p1->sect_madhhab) === strtolower($p2->sect_madhhab)) ? 20 : 10;
        } else {
            $score += 10;
        }

        // 2. Meditation Practice & Dhamma Study (Weight: 20 points)
        if ($p1->meditation_frequency && $p2->meditation_frequency) {
            if ($p1->meditation_frequency === $p2->meditation_frequency) {
                $score += 10;
            } elseif (in_array($p1->meditation_frequency, ['daily', 'several_times_week'], true) &&
                      in_array($p2->meditation_frequency, ['daily', 'several_times_week'], true)) {
                $score += 8;
            } else {
                $score += 5;
            }
        } else {
            $score += 5;
        }

        if ($p1->retreat_experience && $p2->retreat_experience) {
            if ($p1->retreat_experience === $p2->retreat_experience) {
                $score += 10;
            } else {
                $score += 6;
            }
        } else {
            $score += 5;
        }

        // 3. Panca Sila (Five Precepts) Adherence (Weight: 15 points)
        if ($p1->panca_sila_adherence && $p2->panca_sila_adherence) {
            if ($p1->panca_sila_adherence === $p2->panca_sila_adherence) {
                $score += 15;
            } elseif (in_array($p1->panca_sila_adherence, ['very_strict', 'mindful_adherence'], true) &&
                      in_array($p2->panca_sila_adherence, ['very_strict', 'mindful_adherence'], true)) {
                $score += 12;
            } else {
                $score += 8;
            }
        } else {
            $score += 8;
        }

        // 4. Dietary Preference & Fifth Precept (Alcohol/Intoxicants) (Weight: 15 points)
        if ($p1->dietary_preference && $p2->dietary_preference) {
            if ($p1->dietary_preference === $p2->dietary_preference) {
                $score += 10;
            } elseif (in_array($p1->dietary_preference, ['vegetarian', 'vegan'], true) &&
                      in_array($p2->dietary_preference, ['vegetarian', 'vegan'], true)) {
                $score += 8;
            } else {
                $score += 5;
            }
        } else {
            $score += 5;
        }

        if ($p1->alcohol_intoxicants && $p2->alcohol_intoxicants) {
            if ($p1->alcohol_intoxicants === $p2->alcohol_intoxicants) {
                $score += 5;
            } elseif ($p1->alcohol_intoxicants === 'strictly_never' || $p2->alcohol_intoxicants === 'strictly_never') {
                $score += 3;
            }
        } else {
            $score += 3;
        }

        // 5. Family & Raising Children in the Dhamma (Weight: 10 points)
        if ($p1->views_on_raising_children_in_dhamma && $p2->views_on_raising_children_in_dhamma) {
            if ($p1->views_on_raising_children_in_dhamma === $p2->views_on_raising_children_in_dhamma) {
                $score += 10;
            } else {
                $score += 6;
            }
        } else {
            $score += 5;
        }

        // 6. Geographic / Location Alignment (Weight: 10 points)
        if ($p1->country && $p2->country) {
            if (strtolower($p1->country) === strtolower($p2->country)) {
                $score += 7;
                if ($p1->city && $p2->city && strtolower($p1->city) === strtolower($p2->city)) {
                    $score += 3;
                }
            }
        } else {
            $score += 4;
        }

        // 7. Education Alignment (Weight: 5 points)
        if ($p1->education_level && $p2->education_level) {
            if ($p1->education_level === $p2->education_level) {
                $score += 5;
            } else {
                $score += 3;
            }
        } else {
            $score += 2;
        }

        // 8. Age Preference Alignment (Weight: 5 points)
        $prefs1 = $p1->partner_preferences ?? [];
        $age2 = $u2->age;
        if ($age2 && ! empty($prefs1['age_min']) && ! empty($prefs1['age_max'])) {
            if ($age2 >= $prefs1['age_min'] && $age2 <= $prefs1['age_max']) {
                $score += 5;
            } elseif (abs($age2 - $prefs1['age_min']) <= 2 || abs($age2 - $prefs1['age_max']) <= 2) {
                $score += 3;
            }
        } else {
            $score += 3;
        }

        return min(100, max(20, $score));
    }

    /**
     * Explain the strongest compatibility signals shared by two profiles.
     *
     * @return array<int, array{icon: string, label: string, detail: string}>
     */
    public function getCompatibilityHighlights(Profile $p1, Profile $p2): array
    {
        if ($this->computeCompatibility($p1, $p2) === 0) {
            return [];
        }

        $highlights = [];

        if ($p1->tradition && $p2->tradition && strtolower($p1->tradition) === strtolower($p2->tradition)) {
            $highlights[] = [
                'icon' => '☸️',
                'label' => 'Shared Tradition',
                'detail' => 'Both practice within the '.ucfirst(str_replace('_', ' ', $p1->tradition)).' tradition.',
            ];
        }

        if ($p1->meditation_frequency && $p2->meditation_frequency && $p1->meditation_frequency === $p2->meditation_frequency) {
            $highlights[] = [
                'icon' => '🧘',
                'label' => 'Meditation Practice',
                'detail' => 'Both maintain a '.str_replace('_', ' ', $p1->meditation_frequency).' meditation schedule.',
            ];
        }

        if ($p1->panca_sila_adherence && $p2->panca_sila_adherence && $p1->panca_sila_adherence === $p2->panca_sila_adherence) {
            $highlights[] = [
                'icon' => '🌿',
                'label' => 'Panca Sila (Five Precepts)',
                'detail' => 'Both align on '.str_replace('_', ' ', $p1->panca_sila_adherence).' precept observance.',
            ];
        }

        if ($p1->dietary_preference && $p2->dietary_preference && $p1->dietary_preference === $p2->dietary_preference) {
            $highlights[] = [
                'icon' => '🥗',
                'label' => 'Dietary Harmony',
                'detail' => 'Both observe a '.ucfirst(str_replace('_', ' ', $p1->dietary_preference)).' lifestyle.',
            ];
        }

        if ($p1->views_on_raising_children_in_dhamma && $p2->views_on_raising_children_in_dhamma &&
            $p1->views_on_raising_children_in_dhamma === $p2->views_on_raising_children_in_dhamma) {
            $highlights[] = [
                'icon' => '🌸',
                'label' => 'Raising Children in Dhamma',
                'detail' => 'Shared family vision for nurturing children with Buddhist values.',
            ];
        }

        if ($p1->country && $p2->country && strtolower($p1->country) === strtolower($p2->country)) {
            $highlights[] = [
                'icon' => '🌏',
                'label' => 'Shared Country',
                'detail' => "Both candidates reside in {$p1->country}.",
            ];
        }

        return array_slice($highlights, 0, 4);
    }

    /**
     * Get ranked match suggestions for a given user.
     */
    public function getDailyMatches(User $user, int $limit = 12): Collection
    {
        $profile = $user->profile;
        if (! $profile) {
            return collect();
        }

        $targetGender = $user->gender === 'male' ? 'female' : ($user->gender === 'female' ? 'male' : null);
        if (! $targetGender) {
            return collect();
        }

        $excludedUserIds = $user->blockedUsers()
            ->pluck('users.id')
            ->merge($user->blockedByUsers()->pluck('users.id'))
            ->unique()
            ->values();

        $query = Profile::with(['user.activeSubscription', 'primaryPhoto'])
            ->where('user_id', '!=', $user->id)
            ->whereNotIn('user_id', $excludedUserIds)
            ->whereHas('user', function ($q) use ($targetGender) {
                $q->where('is_active', true)
                    ->where('role', 'seeker')
                    ->where('marital_status', '!=', 'married')
                    ->where('gender', $targetGender);
            });

        $candidates = $query->get();

        return $candidates->map(function (Profile $candidate) use ($profile) {
            $candidate->compatibility_score = $this->computeCompatibility($profile, $candidate);
            $candidate->compatibility_highlights = $this->getCompatibilityHighlights($profile, $candidate);

            return $candidate;
        })->sortByDesc(function (Profile $candidate) {
            $boostScore = $candidate->user->isPremium() ? 1000 : 0;

            return $boostScore + $candidate->compatibility_score;
        })->take($limit)->values();
    }
}
