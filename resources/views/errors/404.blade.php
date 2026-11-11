@extends('layouts.app')

@section('title', 'Page Not Found — Global Maitri')

@section('content')
<div class="py-20 sm:py-28 bg-[var(--bg-canvas)] min-h-[75vh] flex items-center justify-center transition-colors">
    <div class="max-w-xl mx-auto px-4 sm:px-6 text-center space-y-6">

        <!-- Serene Monoline Illustration: Stepping Stone & Quiet Path -->
        <div class="flex justify-center">
            <div class="w-24 h-24 rounded-full bg-[var(--bg-card)] border border-[var(--border-default)] flex items-center justify-center text-[var(--saffron-gold)] shadow-xs">
                <svg class="w-12 h-12" viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <!-- Distant soft moon/sun -->
                    <circle cx="32" cy="20" r="10" stroke-dasharray="2 3" opacity="0.6" />
                    <!-- Gentle temple roof ridge line -->
                    <path d="M12 36 C22 33, 42 33, 52 36" />
                    <path d="M20 35 L20 46" stroke-dasharray="1 2" />
                    <path d="M44 35 L44 46" stroke-dasharray="1 2" />
                    <!-- Stepping stones path -->
                    <ellipse cx="32" cy="42" rx="7" ry="2.5" />
                    <ellipse cx="28" cy="48" rx="8" ry="3" />
                    <ellipse cx="34" cy="55" rx="10" ry="3.5" />
                    <!-- Single blooming lotus by the path -->
                    <path d="M46 48 C46 48, 43 42, 45 38 C47 42, 50 44, 46 48 Z" fill="currentColor" fill-opacity="0.15" />
                </svg>
            </div>
        </div>

        <div class="space-y-2">
            <span class="text-xs font-mono tracking-widest uppercase text-[var(--saffron-gold)]">404 &bull; Path Not Found</span>
            <h1 class="text-2xl sm:text-3xl font-serif font-bold text-[var(--text-primary)]">
                The path has led to a quiet place.
            </h1>
            <p class="text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed max-w-md mx-auto">
                The page you are looking for may have moved, rested, or does not exist. No rush — take a breath and find your way back.
            </p>
        </div>

        <div class="pt-2 flex flex-col sm:flex-row items-center justify-center gap-3">
            <a href="{{ route('landing') }}" class="btn-primary text-xs px-6 py-2.5 font-medium w-full sm:w-auto">
                &larr; Return to Home
            </a>
            <a href="{{ route('discovery.index') }}" class="btn-secondary text-xs px-5 py-2.5 font-medium w-full sm:w-auto">
                Explore Candidate Profiles
            </a>
            <a href="{{ route('contact') }}" class="btn-secondary text-xs px-4 py-2.5 font-medium text-[var(--text-muted)] w-full sm:w-auto">
                Need Help? Contact Us
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
