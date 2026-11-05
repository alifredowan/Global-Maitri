@extends('layouts.app')

@section('title', 'Forgot Password - Global Maitri')

@section('content')
<div class="py-16 bg-[var(--bg-canvas)] min-h-screen">
    <div class="max-w-md mx-auto px-4">
        <div class="card-ledger p-8 transition-colors">
            
            <div class="text-center mb-6">
                <div class="w-12 h-12 rounded-xl bg-[var(--bg-subtle)] border border-[var(--border-default)] text-[var(--accent-primary)] flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                </div>
                <h1 class="text-2xl font-extrabold text-[var(--text-primary)] font-heading">Forgot Password?</h1>
                <p class="text-xs text-[var(--text-muted)] mt-1">
                    No worries. Enter your registered email address and we'll send you a secure link to reset your password.
                </p>
            </div>

            <!-- Session Status Alert -->
            @if (session('status'))
                <div class="mb-4 p-4 rounded-xl bg-emerald-50 dark:bg-emerald-950/50 border border-emerald-200 dark:border-emerald-800 text-xs font-semibold text-emerald-800 dark:text-emerald-200 flex items-center gap-2">
                    <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <!-- Developer Local Testing Quick Link when in log mode -->
            @if (session('dev_reset_url'))
                <div class="mb-4 p-3.5 rounded-xl bg-[var(--bg-subtle)] border border-[var(--border-default)] text-xs text-[var(--text-secondary)]">
                    <strong class="font-bold flex items-center gap-1.5 mb-1 text-[var(--text-primary)]">
                        <svg class="w-4 h-4 text-[var(--accent-primary)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                        <span>Local Dev Shortcut:</span>
                    </strong>
                    <p class="text-[11px] text-[var(--text-muted)] mb-2 leading-relaxed">
                        @if(config('mail.default') === 'log')
                            Your app is currently running in <strong>MAIL_MAILER=log</strong> mode (emails are written to <code class="px-1 py-0.5 bg-[var(--bg-canvas)] border border-[var(--border-default)] rounded font-mono text-[10px]">storage/logs/laravel.log</code>). You can test the reset link directly below, or configure SMTP in <code class="px-1 py-0.5 bg-[var(--bg-canvas)] border border-[var(--border-default)] rounded font-mono text-[10px]">.env</code> to deliver to your real inbox:
                        @else
                            You can also use this direct test shortcut:
                        @endif
                    </p>
                    <a href="{{ session('dev_reset_url') }}" class="inline-flex items-center gap-1 font-bold text-[var(--accent-primary)] hover:underline">
                        <span>Proceed to Reset Password</span> &rarr;
                    </a>
                </div>
            @endif

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

            <form action="{{ route('password.email') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">
                        Email Address
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full px-4 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-sm focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none transition"
                           placeholder="your.email@domain.com">
                </div>

                <button type="submit" class="w-full btn-primary text-sm py-3 justify-center mt-2">
                    <span>Email Password Reset Link</span>
                </button>
            </form>

            <div class="text-center mt-6 pt-4 text-xs text-[var(--text-muted)] border-t border-[var(--border-subtle)]">
                Remember your password? <a href="{{ route('login') }}" class="font-bold text-[var(--accent-primary)] hover:underline">Sign in</a>
            </div>

        </div>
    </div>
</div>
@endsection
