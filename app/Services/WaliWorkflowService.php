<?php

namespace App\Services;

use App\Models\Conversation;
use App\Models\ConversationParticipant;
use App\Models\Interest;
use App\Models\User;
use App\Models\WaliLink;
use App\Notifications\InterestRespondedNotification;
use App\Notifications\WaliConnectionApprovedNotification;
use App\Notifications\WaliConnectionRequestNotification;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;

class WaliWorkflowService
{
    /**
     * Invite or link a Family Representative to a seeker profile (FR-5.1 to FR-5.3).
     */
    public function linkWali(
        User $seeker,
        string $relationshipType,
        string $permissionLevel = 'approve_required',
        ?string $waliName = null,
        ?string $waliEmail = null,
        ?string $waliPhone = null
    ): WaliLink {
        $normalizedEmail = $waliEmail ? strtolower(trim($waliEmail)) : null;

        if (! $normalizedEmail) {
            throw new InvalidArgumentException('Family Representative email address is required.');
        }

        $waliUser = User::whereRaw('LOWER(email) = ?', [$normalizedEmail])->first();
        if (! $waliUser) {
            throw new InvalidArgumentException('No account found with this email in the system. The family representative must be registered before being linked.');
        }

        if ($waliUser->id === $seeker->id) {
            throw new InvalidArgumentException('You cannot link yourself as your own Family Representative.');
        }

        $link = WaliLink::create([
            'seeker_user_id' => $seeker->id,
            'wali_user_id' => $waliUser->id,
            'wali_name' => $waliName ?: $waliUser->name,
            'wali_email' => $normalizedEmail,
            'wali_phone' => $waliPhone ?: $waliUser->phone,
            'relationship_type' => $relationshipType,
            'permission_level' => $permissionLevel,
            'status' => 'pending',
            'invite_token' => bin2hex(random_bytes(24)),
        ]);

        try {
            $waliUser->notify(new WaliConnectionRequestNotification($link, $seeker));
        } catch (\Throwable $e) {
            Log::warning('Failed to dispatch Family Representative connection request notification: '.$e->getMessage());
        }

        return $link;
    }

    /**
     * Approve a Family Representative link invitation.
     */
    public function approveWaliLink(WaliLink $link, ?User $waliUser = null): bool
    {
        $link->status = 'active';
        if ($waliUser) {
            $link->wali_user_id = $waliUser->id;
        }
        $saved = $link->save();

        if ($saved) {
            try {
                $link->seeker->notify(new WaliConnectionApprovedNotification($link));
            } catch (\Throwable $e) {
                Log::warning('Failed to dispatch Family Representative link approval notification: '.$e->getMessage());
            }
        }

        return $saved;
    }

    /**
     * Reject or revoke a Family Representative link.
     */
    public function revokeWaliLink(WaliLink $link): bool
    {
        $link->status = 'revoked';

        return $link->save();
    }

    /**
     * Determine if an interest request requires Family Representative approval.
     */
    public function requiresWaliApproval(User $recipient): bool
    {
        $activeLink = $recipient->waliLinksAsSeeker()
            ->where('status', 'active')
            ->first();

        if (! $activeLink) {
            return false;
        }

        return $activeLink->isApproveRequired() || $activeLink->isFullProxy();
    }

    /**
     * Check if a given user is the authorized Family Representative for a seeker.
     */
    public function isAuthorizedWali(User $guardian, User $seeker): bool
    {
        return WaliLink::where('wali_user_id', $guardian->id)
            ->where('seeker_user_id', $seeker->id)
            ->where('status', 'active')
            ->exists();
    }

    public function approveByWali(Interest $interest, User $guardian, ?string $politeNote = null): bool
    {
        return $this->handleWaliInterestDecision($interest, $guardian, 'approve', $politeNote);
    }

    public function rejectByWali(Interest $interest, User $guardian, ?string $politeNote = null): bool
    {
        return $this->handleWaliInterestDecision($interest, $guardian, 'decline', $politeNote);
    }

    /**
     * Process Family Representative approval or decline for an interest request (FR-5.4, FR-7.2).
     */
    public function handleWaliInterestDecision(Interest $interest, User $guardian, string $decision, ?string $politeNote = null): bool
    {
        $recipient = $interest->recipient;

        if (! $this->isAuthorizedWali($guardian, $recipient)) {
            throw new InvalidArgumentException('You are not authorized as the Family Representative for this candidate.');
        }

        if ($decision === 'approve') {
            $interest->wali_approval_status = 'approved';
            $interest->wali_id = $guardian->id;
            $interest->status = 'accepted';
            $interest->responded_at = now();
            if ($politeNote) {
                $interest->message_note = $politeNote;
            }
            $interest->save();

            // Unlock chat conversation
            $conversation = Conversation::firstOrCreate(
                ['interest_id' => $interest->id],
                ['status' => 'active']
            );

            ConversationParticipant::firstOrCreate([
                'conversation_id' => $conversation->id,
                'user_id' => $interest->sender_id,
            ], ['role' => 'seeker']);

            ConversationParticipant::firstOrCreate([
                'conversation_id' => $conversation->id,
                'user_id' => $interest->recipient_id,
            ], ['role' => 'seeker']);

            // Add Family Representative as chaperone participant
            ConversationParticipant::firstOrCreate([
                'conversation_id' => $conversation->id,
                'user_id' => $guardian->id,
            ], ['role' => 'wali_chaperone']);

            try {
                $interest->sender->notify(new InterestRespondedNotification($interest, 'approved'));
            } catch (\Throwable $e) {
                Log::warning('Failed to dispatch notification: '.$e->getMessage());
            }

            return true;
        }

        if ($decision === 'decline') {
            $interest->wali_approval_status = 'rejected';
            $interest->wali_id = $guardian->id;
            $interest->status = 'declined';
            $interest->responded_at = now();
            if ($politeNote) {
                $interest->message_note = $politeNote;
            }
            $interest->save();

            try {
                $interest->sender->notify(new InterestRespondedNotification($interest, 'declined'));
            } catch (\Throwable $e) {
                Log::warning('Failed to dispatch notification: '.$e->getMessage());
            }

            return true;
        }

        return false;
    }
}
