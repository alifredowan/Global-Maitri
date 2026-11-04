<?php

namespace App\Services;

class MessageModerationService
{
    /**
     * Common contact sharing patterns and prohibited external channels (FR-8.2).
     */
    protected array $socialPatterns = [
        '/(?:whatsapp|what\'?s\s*app|wa\.me|watsapp)/i',
        '/(?:insta(?:gram)?|ig|insta\s*id)[\s:]*[@]?[a-zA-Z0-9._]+/i',
        '/(?:snap(?:chat)?|sc)[\s:]*[@]?[a-zA-Z0-9._]+/i',
        '/(?:telegram|tg)[\s:]*[@]?[a-zA-Z0-9._]+/i',
        '/(?:facebook|fb\.com|fb)[\s:]*[@]?[a-zA-Z0-9._]+/i',
        '/(?:imo|viber|wechat|line\s*id)[\s:]*[@]?[a-zA-Z0-9._]+/i',
    ];

    /**
     * Dowry & monetary demand patterns (FR-8.4 - Dowry laws in Bangladesh/India & ethical rules).
     */
    protected array $dowryPatterns = [
        '/\b(?:dowry|dahej|joutuk|demand\s*cash|cash\s*demand|gold\s*bhori|gold\s*sovereign|car\s*demand|flat\s*demand|money\s*upfront|marriage\s*broker\s*fee)\b/i',
        '/\b(?:koto\s*taka\s*diben|joutuk\s*chai|dahej\s*chahiye|shadi\s*kharch\s*dijiye)\b/i',
    ];

    /**
     * Scan message text for contact details, dowry demands, or inappropriate content.
     *
     * @return array{is_safe: bool, is_flagged: bool, flag_reason: ?string, sanitized_body: string}
     */
    public function scan(string $body): array
    {
        $flagReason = null;
        $isFlagged = false;
        $sanitized = $body;

        // 1. Scan for email addresses (FR-8.2)
        if (preg_match('/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/', $body)) {
            $isFlagged = true;
            $flagReason = 'Email address sharing detected';
            $sanitized = preg_replace('/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/', '[Contact Info Hidden]', $sanitized);
        }

        // 2. Scan for phone numbers (FR-8.2)
        $cleanDigits = preg_replace('/[^\d]/', '', $body);
        if (strlen($cleanDigits) >= 9) {
            $phoneRegex = '/(?:\+?\d{1,4}[-.\s]?)?\(?\d{2,4}\)?[-.\s]?\d{3,4}[-.\s]?\d{3,4}/';
            if (preg_match($phoneRegex, $body)) {
                $isFlagged = true;
                $flagReason = $flagReason ? $flagReason.' & Phone number detected' : 'Phone number sharing detected';
                $sanitized = preg_replace($phoneRegex, '[Phone Number Hidden]', $sanitized);
            }
        }

        // 3. Scan for social handles & direct platforms (FR-8.2)
        foreach ($this->socialPatterns as $pattern) {
            if (preg_match($pattern, $body)) {
                $isFlagged = true;
                $flagReason = $flagReason ? $flagReason.' & Social handle detected' : 'Social media / external handle sharing detected';
                $sanitized = preg_replace($pattern, '[External Handle Hidden]', $sanitized);
            }
        }

        // 4. Dowry and commercial financial demands (FR-8.4)
        foreach ($this->dowryPatterns as $pattern) {
            if (preg_match($pattern, $body)) {
                $isFlagged = true;
                $flagReason = $flagReason ? $flagReason.' & Dowry demand prohibited' : 'Dowry/gift demands are strictly prohibited by law and platform guidelines.';
                $sanitized = preg_replace($pattern, '[Prohibited Dowry Request Flagged]', $sanitized);
            }
        }

        // 5. Inappropriate / explicit language checks (FR-8.3)
        $explicitPatterns = [
            '/\b(hookup|casual\s*sex|dating\s*app|meet\s*alone|hotel\s*room|private\s*place)\b/i',
        ];

        foreach ($explicitPatterns as $pattern) {
            if (preg_match($pattern, $body)) {
                $isFlagged = true;
                $flagReason = $flagReason ? $flagReason.' & Inappropriate content' : 'Inappropriate content policy violation';
                $sanitized = preg_replace($pattern, '[Content Blocked]', $sanitized);
            }
        }

        return [
            'is_safe' => ! $isFlagged,
            'is_flagged' => $isFlagged,
            'flag_reason' => $flagReason,
            'sanitized_body' => $sanitized,
        ];
    }
}
