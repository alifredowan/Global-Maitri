@extends('layouts.app')

@section('title', 'Something Interrupted the Path — Global Maitri')

@section('content')
<div class="py-20 sm:py-28 bg-[var(--bg-canvas)] min-h-[75vh] flex items-center justify-center transition-colors">
    <div class="max-w-xl mx-auto px-4 sm:px-6 text-center space-y-6">

        <div class="flex justify-center">
            <div class="w-24 h-24 rounded-full bg-[var(--bg-card)] border border-[var(--border-default)] flex items-center justify-center text-[var(--lotus-pink)] shadow-xs">
                <svg class="w-12 h-12" viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <!-- Gentle pond waters with ripple -->
                    <circle cx="32" cy="32" r="22" stroke-dasharray="2 4" opacity="0.4" />
                    <circle cx="32" cy="32" r="14" stroke-dasharray="2 3" opacity="0.6" />
                    <!-- Centered lotus petal resting -->
                    <path d="M32 20 C32 20, 26 28, 26 36 C26 42, 32 44, 32 44 C32 44, 38 42, 38 36 C38 28, 32 20, 32 20 Z" fill="currentColor" fill-opacity="0.15" />
                    <circle cx="32" cy="34" r="2" fill="currentColor" />
                </svg>
            </div>
        </div>

        <div class="space-y-2">
            <span class="text-xs font-mono tracking-widest uppercase text-[var(--saffron-gold)]">500 &bull; Temporary Interruption</span>
            <h1 class="text-2xl sm:text-3xl font-serif font-bold text-[var(--text-primary)]">
                Something interrupted our systems.
            </h1>
            <p class="text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed max-w-md mx-auto">
                We encountered an unexpected pause on our side. Our technical team has been notified. Please try refreshing in a moment.
            </p>
        </div>

        <div class="pt-2 flex flex-col sm:flex-row items-center justify-center gap-3">
            <a href="{{ url()->previous() ?: route('landing') }}" class="btn-primary text-xs px-6 py-2.5 font-medium w-full sm:w-auto">
                &larr; Try Again
            </a>
            <a href="{{ route('landing') }}" class="btn-secondary text-xs px-5 py-2.5 font-medium w-full sm:w-auto">
                Return to Home
            </a>
            <a href="{{ route('contact') }}" class="btn-secondary text-xs px-4 py-2.5 font-medium text-[var(--text-muted)] w-full sm:w-auto">
                Contact Support
            </a>
        </div>

        <div class="pt-6">
            <p class="text-xs font-serif italic text-[var(--text-muted)]">
                &ldquo;Sabbe satta bhavantu sukhitatta &bull; May you be happy and well.&rdquo;
            </p>
        </div>

    </div>
</div>
@endsection
