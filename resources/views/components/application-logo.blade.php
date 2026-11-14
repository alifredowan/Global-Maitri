@props([
    'variant' => 'icon', // 'icon', 'emblem', 'full', 'badge'
    'class' => 'w-8 h-8',
    'badgeClass' => 'w-10 h-10',
    'mode' => 'auto', // 'auto', 'light', 'dark'
    'alt' => 'Global Vivaha',
    'showTagline' => true,
])

@if($variant === 'full')
    <div {{ $attributes->merge(['class' => 'inline-flex items-center gap-3 select-none group']) }}>
        {{-- Vector Emblem Mark --}}
        <div class="relative w-9 h-9 sm:w-10 sm:h-10 shrink-0 transition-transform duration-300 group-hover:scale-105">
            <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full drop-shadow-xs" aria-hidden="true">
                {{-- Outer Auspicious Ring --}}
                <circle cx="24" cy="24" r="22" stroke="currentColor" stroke-width="1.2" class="text-[var(--color-accent)] opacity-50 stroke-dasharray-[2_2]" />
                <circle cx="24" cy="24" r="20" stroke="currentColor" stroke-width="0.8" class="text-[var(--color-primary)] opacity-40" />

                {{-- Sacred Lotus Petals Top --}}
                <path d="M24 7C22 12 17 15 17 19C17 23 20 25 24 25C28 25 31 23 31 19C31 15 26 12 24 7Z" fill="url(#vivaha-lotus-grad)" opacity="0.85" />
                <path d="M24 10C24 10 20 14 20 18C20 20.5 21.8 22 24 22C26.2 22 28 20.5 28 18C28 14 24 10 24 10Z" fill="url(#vivaha-gold-grad)" />

                {{-- Side Blooming Petals --}}
                <path d="M16 15C12 18 10 22 12 25C13.5 27 16.5 27 19 25C19 22 18 18 16 15Z" fill="currentColor" class="text-[var(--color-lotus)]" opacity="0.5" />
                <path d="M32 15C36 18 38 22 36 25C34.5 27 31.5 27 29 25C29 22 30 18 32 15Z" fill="currentColor" class="text-[var(--color-lotus)]" opacity="0.5" />

                {{-- Sacred Eternal Knot (Srivatsa / Mangala Knot) Base --}}
                <path d="M19 26L24 31L29 26L33 30L24 39L15 30L19 26Z" stroke="url(#vivaha-gold-grad)" stroke-width="1.8" stroke-linejoin="round" />
                <path d="M24 23L16 31L24 39L32 31L24 23Z" stroke="currentColor" stroke-width="1.4" class="text-[var(--color-primary)] dark:text-[var(--color-accent)]" stroke-linejoin="round" />
                
                {{-- Auspicious Center Bindu --}}
                <circle cx="24" cy="31" r="2" fill="url(#vivaha-gold-grad)" />

                <defs>
                    <linearGradient id="vivaha-gold-grad" x1="15" y1="10" x2="33" y2="39" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#EAB85A" />
                        <stop offset="0.5" stop-color="#D49B35" />
                        <stop offset="1" stop-color="#A87520" />
                    </linearGradient>
                    <linearGradient id="vivaha-lotus-grad" x1="17" y1="7" x2="31" y2="25" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#233B5C" />
                        <stop offset="0.6" stop-color="#17263C" />
                        <stop offset="1" stop-color="#0D1622" />
                    </linearGradient>
                </defs>
            </svg>
        </div>

        {{-- Bespoke Typographic Brandmark --}}
        <div class="flex flex-col justify-center leading-none">
            <div class="flex items-center gap-1.5">
                <span class="font-serif font-bold text-lg sm:text-xl tracking-[0.03em] text-[var(--color-primary)] dark:text-[var(--text-primary)]">
                    Global Vivaha
                </span>
                <span class="inline-block w-1 h-1 rounded-full bg-[var(--color-accent)]"></span>
            </div>
            @if($showTagline)
                <span class="text-[9.5px] sm:text-[10.5px] tracking-[0.14em] uppercase font-sans font-medium text-[var(--color-accent-hover)] dark:text-[var(--color-accent)] mt-0.5 opacity-90">
                    Sacred Buddhist Matrimony
                </span>
            @endif
        </div>
    </div>
@elseif($variant === 'badge')
    <div {{ $attributes->merge(['class' => 'relative shrink-0 ' . $badgeClass . ' rounded-[8px] bg-[var(--color-surface)] border border-[var(--color-border)] shadow-xs flex items-center justify-center p-1.5 overflow-hidden transition-all duration-300 hover:border-[var(--color-accent)] group']) }}>
        <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full" aria-hidden="true">
            <circle cx="24" cy="24" r="21" stroke="currentColor" stroke-width="1" class="text-[var(--color-accent)] opacity-40" />
            <path d="M24 7C22 12 17 15 17 19C17 23 20 25 24 25C28 25 31 23 31 19C31 15 26 12 24 7Z" fill="#17263C" />
            <path d="M24 10C24 10 20 14 20 18C20 20.5 21.8 22 24 22C26.2 22 28 20.5 28 18C28 14 24 10 24 10Z" fill="#D49B35" />
            <path d="M19 26L24 31L29 26L33 30L24 39L15 30L19 26Z" stroke="#D49B35" stroke-width="1.8" stroke-linejoin="round" />
            <circle cx="24" cy="31" r="2" fill="#D49B35" />
        </svg>
    </div>
@else
    {{-- Standalone Icon Mark --}}
    <div {{ $attributes->merge(['class' => 'relative ' . $class . ' shrink-0 inline-flex items-center justify-center']) }}>
        <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full" aria-label="{{ $alt }}" role="img">
            <title>{{ $alt }}</title>
            <circle cx="24" cy="24" r="21" stroke="currentColor" stroke-width="1" class="text-[var(--color-accent)] opacity-40" />
            <path d="M24 7C22 12 17 15 17 19C17 23 20 25 24 25C28 25 31 23 31 19C31 15 26 12 24 7Z" fill="currentColor" class="text-[var(--color-primary)]" />
            <path d="M24 10C24 10 20 14 20 18C20 20.5 21.8 22 24 22C26.2 22 28 20.5 28 18C28 14 24 10 24 10Z" fill="currentColor" class="text-[var(--color-accent)]" />
            <path d="M19 26L24 31L29 26L33 30L24 39L15 30L19 26Z" stroke="currentColor" stroke-width="1.8" class="text-[var(--color-accent)]" stroke-linejoin="round" />
            <circle cx="24" cy="31" r="2" fill="currentColor" class="text-[var(--color-accent)]" />
        </svg>
    </div>
@endif
