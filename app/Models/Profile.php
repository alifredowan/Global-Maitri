<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'height_cm',
        'education_level',
        'profession',
        'employment_type',
        'annual_income_range',
        'city',
        'state',
        'country',
        'mother_tongue',
        'citizenship',
        'bio',
        'children',

        // Buddhist Tradition & Lineage (FR-2.3)
        'tradition',
        'lineage_school',
        'ethnic_community',

        // Practice & Dhamma Observance (FR-2.4)
        'practice_depth',
        'meditation_frequency',
        'panca_sila_adherence',
        'temple_visits',
        'uposatha_observance',
        'dhamma_study_chanting',
        'retreat_experience',

        // Lifestyle & Five Precepts (FR-2.5)
        'dietary_preference',
        'alcohol_intoxicants',
        'smoking',

        // Family Background (FR-2.6)
        'parents_status',
        'parents_occupation',
        'siblings_count',
        'family_type',
        'preferred_living_arrangement',
        'views_on_raising_children_in_dhamma',

        // Horoscope Module (FR-3.1 to FR-3.4)
        'horoscope_required',
        'birth_date',
        'birth_time',
        'birth_place',
        'horoscope_doc_path',
        'porondam_score',
        'horoscope_visibility',

        // Photo Privacy & General Settings
        'photo_privacy_mode',
        'partner_preferences',
        'field_visibility',
        'family_rep_required',
        'completeness_percentage',

        // Legacy backward compatibility
        'sect_madhhab',
        'prayer_frequency',
        'halal_dietary_adherence',
        'hijab_niqab_practice',
        'beard_practice',
        'quran_knowledge',
        'mosque_attendance',
        'polygamy_opinion',
        'desired_family_structure',
        'family_religiosity',
        'wali_required',
    ];

    protected function casts(): array
    {
        return [
            'height_cm' => 'integer',
            'siblings_count' => 'integer',
            'horoscope_required' => 'boolean',
            'birth_date' => 'date',
            'porondam_score' => 'integer',
            'family_rep_required' => 'boolean',
            'wali_required' => 'boolean',
            'completeness_percentage' => 'integer',
            'partner_preferences' => 'array',
            'field_visibility' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class);
    }

    public function primaryPhoto(): HasOne
    {
        return $this->hasOne(Photo::class)->where('is_primary', true);
    }

    public function approvedPhotos(): HasMany
    {
        return $this->hasMany(Photo::class)->where('moderation_status', 'approved');
    }

    public function photoAccessGrants(): HasMany
    {
        return $this->hasMany(PhotoAccessGrant::class);
    }

    /**
     * Dynamically calculate and save profile completeness percentage (FR-2.8).
     */
    public function updateCompleteness(): int
    {
        $fields = [
            'height_cm' => 5,
            'education_level' => 5,
            'profession' => 5,
            'city' => 5,
            'country' => 5,
            'bio' => 10,
            'tradition' => 15,
            'meditation_frequency' => 15,
            'panca_sila_adherence' => 10,
            'dietary_preference' => 5,
            'temple_visits' => 5,
            'views_on_raising_children_in_dhamma' => 5,
            'partner_preferences' => 5,
        ];

        $score = 0;
        foreach ($fields as $field => $points) {
            if (! empty($this->{$field})) {
                $score += $points;
            }
        }

        if ($this->photos()->where('moderation_status', 'approved')->exists()) {
            $score += 5;
        }

        $percentage = min(100, $score);
        $this->updateQuietly(['completeness_percentage' => $percentage]);

        return $percentage;
    }

    /**
     * Determine if photos are visible to the given viewer (FR-4.2, FR-4.3).
     */
    public function isPhotoVisibleTo(?User $viewer): bool
    {
        if (! $viewer) {
            return false;
        }

        if ($viewer->id === $this->user_id || $viewer->isAdmin() || $viewer->isModerator()) {
            return true;
        }

        // If user set photo privacy mode to public
        if ($this->photo_privacy_mode === 'public') {
            return true;
        }

        // Linked Family Representative has access to ward's photos
        if ($viewer->isFamilyRep()) {
            $isWardsPhoto = WaliLink::where('wali_user_id', $viewer->id)
                ->where('seeker_user_id', $this->user_id)
                ->where('status', 'active')
                ->exists();

            if ($isWardsPhoto) {
                return true;
            }
        }

        // Check if mutual acceptance exists between users
        $mutualInterest = Interest::where('status', 'accepted')
            ->where(function ($q) use ($viewer) {
                $q->where(function ($sub) use ($viewer) {
                    $sub->where('sender_id', $this->user_id)->where('recipient_id', $viewer->id);
                })->orWhere(function ($sub) use ($viewer) {
                    $sub->where('sender_id', $viewer->id)->where('recipient_id', $this->user_id);
                });
            })->exists();

        if ($mutualInterest && $this->photo_privacy_mode !== 'request_only') {
            return true;
        }

        // Check explicit photo access grant
        return $this->photoAccessGrants()
            ->where('granted_to_user_id', $viewer->id)
            ->where('status', 'active')
            ->exists();
    }

    /**
     * Check if horoscope is visible to the given viewer (FR-3.4).
     */
    public function isHoroscopeVisibleTo(?User $viewer): bool
    {
        if (! $viewer) {
            return false;
        }

        if ($viewer->id === $this->user_id || $viewer->isAdmin() || $viewer->isModerator()) {
            return true;
        }

        if ($this->horoscope_visibility === 'hidden' || ! $this->horoscope_required) {
            return false;
        }

        // Check mutual interest
        $isMatched = Interest::where('status', 'accepted')
            ->where(function ($q) use ($viewer) {
                $q->where(function ($sub) use ($viewer) {
                    $sub->where('sender_id', $this->user_id)->where('recipient_id', $viewer->id);
                })->orWhere(function ($sub) use ($viewer) {
                    $sub->where('sender_id', $viewer->id)->where('recipient_id', $this->user_id);
                });
            })->exists();

        if ($isMatched && $this->horoscope_visibility === 'matched_only') {
            return true;
        }

        return false;
    }

    /**
     * Check if a field is hidden from non-matched users (FR-12.3).
     */
    public function isFieldHidden(string $field, ?User $viewer): bool
    {
        if (! $viewer || $viewer->id === $this->user_id || $viewer->isAdmin() || $viewer->isModerator()) {
            return false;
        }

        $hiddenFields = $this->field_visibility['hidden_from_public'] ?? [];
        if (! in_array($field, $hiddenFields, true)) {
            return false;
        }

        // Check if matched
        $isMatched = Interest::where('status', 'accepted')
            ->where(function ($q) use ($viewer) {
                $q->where(function ($sub) use ($viewer) {
                    $sub->where('sender_id', $this->user_id)->where('recipient_id', $viewer->id);
                })->orWhere(function ($sub) use ($viewer) {
                    $sub->where('sender_id', $viewer->id)->where('recipient_id', $this->user_id);
                });
            })->exists();

        return ! $isMatched;
    }
}
