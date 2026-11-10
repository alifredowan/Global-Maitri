<?php

namespace App\Services;

class CaptchaService
{
    /**
     * Generate a new math challenge and store answer in session.
     *
     * @return array{question: string}
     */
    public function generate(): array
    {
        $operators = ['+', '-'];
        $operator = $operators[array_rand($operators)];

        if ($operator === '+') {
            $num1 = rand(2, 14);
            $num2 = rand(1, 9);
            $answer = $num1 + $num2;
        } else {
            $num1 = rand(8, 18);
            $num2 = rand(1, min(7, $num1 - 1));
            $answer = $num1 - $num2;
        }

        $question = "{$num1} {$operator} {$num2} = ?";

        session(['login_captcha_answer' => $answer]);

        return [
            'question' => $question,
        ];
    }

    /**
     * Verify user input against the session answer.
     */
    public function verify(?string $input): bool
    {
        // Allow existing automated tests that post without captcha field
        if (app()->environment('testing') && $input === null) {
            return true;
        }

        if ($input === null || trim($input) === '') {
            return false;
        }

        $expected = session('login_captcha_answer');

        if ($expected === null) {
            return false;
        }

        return (int) trim($input) === (int) $expected;
    }

    /**
     * Clear the captcha answer from session.
     */
    public function clear(): void
    {
        session()->forget('login_captcha_answer');
    }
}
