@extends('layouts.app')

@section('title', 'Verify Your Email Address - Global Maitri')

@section('content')
<div class="py-16 bg-[var(--bg-canvas)] min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-6">

        <!-- Top Buddhist Blessing & Badge -->
        <div class="text-center space-y-2">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-[var(--bg-subtle)] text-[var(--accent-primary)] border border-[var(--border-default)]">
                <x-application-logo class="w-3.5 h-3.5 text-[var(--accent-primary)]" />
                <span>Mandatory Email Verification</span>
            </span>
            <p class="text-base sm:text-lg text-[var(--accent-primary)] font-medium">May You Be Happy and Well</p>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[var(--text-primary)] font-heading">
                Check Your Email to Activate
            </h1>
            <p class="text-xs sm:text-sm text-[var(--text-muted)] max-w-sm mx-auto">
                Your account will remain locked until you confirm and approve the verification link sent to your email.
            </p>
        </div>

        <!-- Verification Notice Card -->
        <div class="card-ledger p-6 sm:p-8 space-y-6">

            <!-- Envelope Icon with Pulsing Effect -->
            <div class="text-center">
                <div class="relative inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-[var(--bg-subtle)] text-[var(--accent-primary)] border border-[var(--border-default)]">
                    <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    <span class="absolute -top-1 -right-1 flex h-4 w-4">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[var(--accent-primary)] opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-4 w-4 bg-[var(--accent-primary)]"></span>
                    </span>
                </div>

                @php
                    $targetEmail = session('registered_email') ?? session('unverified_email') ?? (Auth::check() ? Auth::user()->email : null);
                    $devUser = Auth::user() ?? ($targetEmail ? \App\Models\User::where('email', $targetEmail)->first() : null);
                    $devVerifyUrl = ($devUser && app()->environment('local')) ? URL::temporarySignedRoute(
                        'verification.verify',
                        now()->addMinutes(2880),
                        ['id' => $devUser->getKey(), 'hash' => sha1($devUser->getEmailForVerification())]
                    ) : null;
                @endphp

                <div class="mt-4">
                    <p class="text-xs font-bold text-[var(--text-muted)] uppercase tracking-wider">Verification Sent To</p>
                    <p class="text-sm font-extrabold text-[var(--text-primary)] mt-0.5 break-all">
                        {{ $targetEmail ?: 'your registered email address' }}
                    </p>
                </div>
            </div>

            <!-- Steps & Explanation -->
            <div class="space-y-3 p-4 rounded-xl bg-[var(--bg-subtle)] border border-[var(--border-default)] text-xs text-[var(--text-secondary)]">
                <div class="flex items-start gap-2.5">
                    <span class="w-5 h-5 rounded-full bg-[var(--accent-primary)] text-white font-bold flex items-center justify-center text-[10px] shrink-0 mt-0.5">1</span>
                    <p>Open your email inbox (and check spam or junk if needed) for a message from <strong>info@globalmaitri.com</strong>.</p>
                </div>
                <div class="flex items-start gap-2.5">
                    <span class="w-5 h-5 rounded-full bg-[var(--accent-primary)] text-white font-bold flex items-center justify-center text-[10px] shrink-0 mt-0.5">2</span>
                    <p>Click the <strong>"Verify Email & Activate Profile"</strong> button.</p>
                </div>
                <div class="flex items-start gap-2.5">
                    <span class="w-5 h-5 rounded-full bg-[var(--accent-primary)] text-white font-bold flex items-center justify-center text-[10px] shrink-0 mt-0.5">3</span>
                    <p>Your profile will be approved and you can proceed with your matrimonial profile and preferences.</p>
                </div>
            </div>

            <!-- Resend Section -->
            <div class="pt-2 border-t border-[var(--border-subtle)]">
                <p class="text-xs text-center text-[var(--text-muted)] mb-3">
                    Didn't receive the email? We can dispatch a new link.
                </p>

                <form action="{{ route('verification.send') }}" method="POST" class="space-y-3" x-data="{ submitting: false }" @submit="submitting = true">
                    @csrf
                    @if(! $targetEmail)
                        <div>
                            <input type="email" name="email" required placeholder="Enter your registered email address"
                                   class="w-full px-4 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs outline-none focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)]">
                        </div>
                    @else
                        <input type="hidden" name="email" value="{{ $targetEmail }}">
                    @endif

                    <button type="submit"
                            :disabled="submitting"
                            class="w-full btn-secondary text-xs py-3 justify-center">
                        <span x-show="!submitting">Resend Verification Email</span>
                        <span x-show="submitting" x-cloak>Sending fresh link...</span>
                    </button>
                </form>

                @if($devVerifyUrl)
                    <div class="mt-4 p-3.5 rounded-xl bg-[var(--bg-subtle)] border border-[var(--border-default)] text-center space-y-2">
                        <div class="flex items-center justify-center gap-1.5 text-xs font-bold text-[var(--accent-primary)]">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                            <span>Local Development Shortcut</span>
                        </div>
                        <p class="text-[11px] text-[var(--text-muted)]">
                            Local SMTP/Brevo delivery may be delayed or blocked by email providers. Click below to verify instantly:
                        </p>
                        <a href="{{ $devVerifyUrl }}"
                           class="w-full btn-primary text-xs py-2.5 justify-center">
                            Verify Account Instantly (Local Dev)
                        </a>
                    </div>
                @endif
            </div>

            <!-- Back to Sign in link -->
            <div class="text-center pt-2">
                <a href="{{ route('login') }}" class="text-xs font-semibold text-[var(--accent-primary)] hover:underline">
                    &larr; Return to Sign In
                </a>
            </div>

        </div>

        <p class="text-center text-[11px] text-[var(--text-muted)]">
            Need assistance? Reach out to our support team at <a href="mailto:info@globalmaitri.com" class="text-[var(--accent-primary)] hover:underline">info@globalmaitri.com</a>
        </p>

    </div>
</div>
@endsection
