@extends('layouts.app')

@section('title', 'Restricted Access — Global Maitri')

@section('content')
<div class="py-20 sm:py-28 bg-[var(--bg-canvas)] min-h-[75vh] flex items-center justify-center transition-colors">
    <div class="max-w-xl mx-auto px-4 sm:px-6 text-center space-y-6">

        <div class="flex justify-center">
            <div class="w-24 h-24 rounded-full bg-[var(--bg-card)] border border-[var(--border-default)] flex items-center justify-center text-[var(--saffron-gold)] shadow-xs">
                <svg class="w-12 h-12" viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <!-- Modest gate / boundary line -->
                    <rect x="18" y="24" width="28" height="28" rx="3" stroke-width="1.5" />
                    <path d="M26 24 V18 C26 14.5, 38 14.5, 38 18 V24" />
                    <circle cx="32" cy="36" r="3" />
                    <path d="M32 39 V43" />
                </svg>
            </div>
        </div>

        <div class="space-y-2">
            <span class="text-xs font-mono tracking-widest uppercase text-[var(--saffron-gold)]">403 &bull; Privacy Protected</span>
            <h1 class="text-2xl sm:text-3xl font-serif font-bold text-[var(--text-primary)]">
                This space is protected.
            </h1>
            <p class="text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed max-w-md mx-auto">
                You do not currently have permission to view this page or biodata. This may require mutual interest confirmation or family chaperone clearance.
            </p>
        </div>

        <div class="pt-2 flex flex-col sm:flex-row items-center justify-center gap-3">
            <a href="{{ route('landing') }}" class="btn-primary text-xs px-6 py-2.5 font-medium w-full sm:w-auto">
                &larr; Return to Home
            </a>
            <a href="{{ route('discovery.index') }}" class="btn-secondary text-xs px-5 py-2.5 font-medium w-full sm:w-auto">
                Browse Candidates
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
