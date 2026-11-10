@extends('layouts.app')

@section('title', 'Sign In - Global Maitri')

@section('content')
<div class="py-14 bg-[var(--bg-canvas)] min-h-screen">
    <div class="max-w-md mx-auto px-4">
        <div class="card-ledger bg-[var(--bg-surface)] border border-[var(--border-default)] shadow-xs p-6 sm:p-8 space-y-5">
            <div class="text-center space-y-2">
                <x-application-logo variant="badge" badge-class="w-12 h-12 mx-auto" />
                <h1 class="text-xl sm:text-2xl font-extrabold text-[var(--text-primary)] font-heading">Welcome Back</h1>
                <p class="text-xs text-[var(--text-secondary)]">Sign in to review matches, proposals, and mindful messages.</p>
            </div>

            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Email Address <span class="text-[var(--color-danger)]">*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="input-field text-xs w-full"
                           placeholder="your.email@domain.com">
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label class="block text-xs font-semibold text-[var(--text-secondary)]">Password <span class="text-[var(--color-danger)]">*</span></label>
                        <a href="{{ route('password.request') }}" class="text-xs font-medium text-[var(--accent-primary)] hover:underline">
                            Forgot password?
                        </a>
                    </div>
                    <div class="relative" x-data="{ showPassword: false }">
                        <input :type="showPassword ? 'text' : 'password'" name="password" required
                               class="input-field text-xs w-full pr-10"
                               placeholder="••••••••">
                        <button type="button" @click="showPassword = !showPassword"
                                aria-label="Toggle password visibility"
                                class="absolute right-2.5 top-1/2 -translate-y-1/2 text-[var(--text-muted)] hover:text-[var(--text-primary)] focus:outline-none cursor-pointer p-1"
                                :title="showPassword ? 'Hide password' : 'View password'"
                                tabindex="-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between text-xs pt-1">
                    <label class="flex items-center gap-2 text-[var(--text-secondary)] cursor-pointer select-none">
                        <input type="checkbox" name="remember" class="rounded-[2px] text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                        <span>Remember me</span>
                    </label>
                </div>

                @if($turnstileEnabled)
                    <div class="flex justify-center pt-1">
                        <div class="cf-turnstile" data-sitekey="{{ $turnstileSiteKey }}"></div>
                    </div>
                @endif

                <button type="submit" class="btn-primary w-full text-xs sm:text-sm !py-2.5 mt-2">
                    Sign In
                </button>
            </form>

            <div class="text-center pt-3 text-xs text-[var(--text-muted)] border-t border-[var(--border-subtle)]">
                Looking for a lifelong companion? <a href="{{ route('register') }}" class="font-bold text-[var(--accent-primary)] hover:underline">Create a new profile</a>
            </div>
        </div>
    </div>
</div>

@if($turnstileEnabled)
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
@endif
@endsection
