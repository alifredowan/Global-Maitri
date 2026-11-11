@extends('layouts.app')

@section('title', 'Sign In — Global Maitri')
@section('meta_description', 'Sign in to your Global Maitri account to view candidates, proposals, and mindful messages.')

@section('content')
<div class="py-12 sm:py-16 bg-[var(--bg-canvas)] min-h-[calc(100vh-160px)]">
    <div class="max-w-md mx-auto px-4">
        <div class="rounded-[var(--radius-lg)] bg-[var(--bg-surface)] border border-[var(--border-default)] shadow-xs p-6 sm:p-9 space-y-5">
            <div class="text-left space-y-1.5 border-b border-[var(--border-subtle)] pb-4">
                <p class="text-xs font-semibold uppercase tracking-wider text-[var(--accent-primary)]">Welcome back</p>
                <h1 class="font-heading text-2xl font-bold text-[var(--text-primary)]">Sign in to Global Maitri</h1>
                <p class="text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed">
                    Check your messages, review family-approved proposals, or continue your search.
                </p>
            </div>

            @if ($errors->any())
                <div class="p-3.5 rounded-[var(--radius-sm)] bg-[var(--bg-surface)] border border-[var(--color-danger)] text-xs text-[var(--text-primary)]">
                    <p class="font-bold text-[var(--color-danger)] mb-1">Sign-in error:</p>
                    <ul class="list-disc list-inside space-y-0.5 text-[var(--text-secondary)]">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-4"
                  x-data="{
                      captchaQuestion: '{{ $captchaQuestion ?? '' }}',
                      isRefreshing: false,
                      refreshCaptcha() {
                          this.isRefreshing = true;
                          fetch('{{ route('captcha.refresh') }}')
                              .then(r => r.json())
                              .then(d => {
                                  this.captchaQuestion = d.question;
                                  this.isRefreshing = false;
                              })
                              .catch(() => {
                                  this.isRefreshing = false;
                              });
                      }
                  }">
                @csrf

                <div>
                    <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Email address <span class="text-[var(--color-danger)]">*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="input-field text-xs w-full"
                           placeholder="your.email@domain.com">
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label class="block text-xs font-semibold text-[var(--text-secondary)]">Password <span class="text-[var(--color-danger)]">*</span></label>
                        <a href="{{ route('password.request') }}" class="text-xs text-[var(--accent-primary)] hover:underline">
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

                <div class="flex items-center justify-between text-xs pt-0.5">
                    <label class="flex items-center gap-2 text-[var(--text-secondary)] cursor-pointer select-none">
                        <input type="checkbox" name="remember" class="rounded-[2px] text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                        <span>Remember me on this browser</span>
                    </label>
                </div>

                @if($turnstileEnabled)
                    <div class="flex flex-col items-center justify-center pt-1 space-y-1">
                        <div class="cf-turnstile" data-sitekey="{{ $turnstileSiteKey }}"></div>
                        @error('cf-turnstile-response')
                            <p class="text-[var(--color-danger)] text-xs font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                @else
                    <div class="space-y-1.5 pt-1">
                        <div class="flex items-center justify-between">
                            <label class="block text-xs font-semibold text-[var(--text-secondary)]">
                                Security Challenge (CAPTCHA) <span class="text-[var(--color-danger)]">*</span>
                            </label>
                            <span class="text-[10px] text-[var(--text-muted)]">Human check</span>
                        </div>
                        <div class="flex items-center gap-2.5 p-2 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-default)]">
                            <div class="flex items-center gap-1.5 shrink-0">
                                <span class="px-2.5 py-1 rounded-[var(--radius-xs)] bg-[var(--bg-surface)] border border-[var(--border-default)] font-mono font-bold text-xs text-[var(--text-primary)] select-none shadow-2xs"
                                      x-text="captchaQuestion">
                                    {{ $captchaQuestion ?? 'Security Check' }}
                                </span>
                                <button type="button" @click="refreshCaptcha()"
                                        :class="{ 'opacity-50 pointer-events-none': isRefreshing }"
                                        class="text-[var(--text-muted)] hover:text-[var(--accent-primary)] transition p-1 cursor-pointer rounded"
                                        title="Get another challenge">
                                    <svg class="w-3.5 h-3.5" :class="{ 'animate-spin': isRefreshing }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                </button>
                            </div>
                            <input type="number" name="captcha" required placeholder="Answer"
                                   class="input-field text-xs w-full text-center font-bold tracking-wider"
                                   autocomplete="off" inputmode="numeric">
                        </div>
                        @error('captcha')
                            <p class="text-[var(--color-danger)] text-xs font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                @endif

                <button type="submit" class="btn-primary w-full text-xs sm:text-sm !py-2.5 mt-2">
                    Sign in &rarr;
                </button>
            </form>

            <div class="text-left pt-3 text-xs text-[var(--text-muted)] border-t border-[var(--border-subtle)]">
                Looking to get started? <a href="{{ route('register') }}" class="font-semibold text-[var(--accent-primary)] hover:underline">Create a profile &rarr;</a>
            </div>
        </div>
    </div>
</div>

@if($turnstileEnabled)
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
@endif
@endsection
