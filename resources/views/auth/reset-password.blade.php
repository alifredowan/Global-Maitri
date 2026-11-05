@extends('layouts.app')

@section('title', 'Reset Password - Global Maitri')

@section('content')
<div class="py-16 bg-[var(--bg-canvas)] min-h-screen">
    <div class="max-w-md mx-auto px-4">
        <div class="card-ledger p-8 transition-colors">
            
            <div class="text-center mb-6">
                <div class="w-12 h-12 rounded-xl bg-[var(--bg-subtle)] border border-[var(--border-default)] text-[var(--accent-primary)] flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                </div>
                <h1 class="text-2xl font-extrabold text-[var(--text-primary)] font-heading">Reset Password</h1>
                <p class="text-xs text-[var(--text-muted)] mt-1">
                    Enter your new secure password below to regain access to your account.
                </p>
            </div>

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="mb-4 p-4 rounded-xl bg-rose-50 dark:bg-rose-950/50 border border-rose-200 dark:border-rose-800 text-xs font-semibold text-rose-800 dark:text-rose-200">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">
                        Email Address
                    </label>
                    <input type="email" name="email" value="{{ old('email', $email) }}" required autofocus
                           class="w-full px-4 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-sm focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none transition"
                           placeholder="your.email@domain.com">
                </div>

                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">
                        New Password
                    </label>
                    <div class="relative" x-data="{ showPass: false }">
                        <input :type="showPass ? 'text' : 'password'" name="password" required
                               class="w-full px-4 py-2.5 pr-11 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-sm focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none transition"
                               placeholder="••••••••">
                        <button type="button" @click="showPass = !showPass"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-[var(--text-muted)] hover:text-[var(--text-primary)] focus:outline-none cursor-pointer p-1"
                                :title="showPass ? 'Hide password' : 'View password'"
                                tabindex="-1">
                            <svg x-show="!showPass" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg x-show="showPass" style="display: none;" class="w-4 h-4 text-[var(--accent-primary)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">
                        Confirm New Password
                    </label>
                    <div class="relative" x-data="{ showConfirm: false }">
                        <input :type="showConfirm ? 'text' : 'password'" name="password_confirmation" required
                               class="w-full px-4 py-2.5 pr-11 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-sm focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none transition"
                               placeholder="••••••••">
                        <button type="button" @click="showConfirm = !showConfirm"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-[var(--text-muted)] hover:text-[var(--text-primary)] focus:outline-none cursor-pointer p-1"
                                :title="showConfirm ? 'Hide password' : 'View password'"
                                tabindex="-1">
                            <svg x-show="!showConfirm" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg x-show="showConfirm" style="display: none;" class="w-4 h-4 text-[var(--accent-primary)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <button type="submit" class="w-full btn-primary text-sm py-3 justify-center mt-2">
                    Reset Password & Sign In
                </button>
            </form>

            <div class="text-center mt-6 pt-4 text-xs text-[var(--text-muted)] border-t border-[var(--border-subtle)]">
                Back to <a href="{{ route('login') }}" class="font-bold text-[var(--accent-primary)] hover:underline">Sign in</a>
            </div>

        </div>
    </div>
</div>
@endsection
