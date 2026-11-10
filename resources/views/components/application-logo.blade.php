@props([
    'variant' => 'icon', // 'icon', 'emblem', 'full', 'badge'
    'class' => 'w-8 h-8',
    'badgeClass' => 'w-10 h-10',
    'mode' => 'auto', // 'auto', 'light', 'dark'
    'alt' => 'Global Maitri',
])

@if($variant === 'full')
    <div {{ $attributes->merge(['class' => 'inline-flex items-center select-none']) }}>
        @if($mode === 'dark')
            <img src="{{ asset('images/logo-dark.png') }}" alt="{{ $alt }}" class="h-8 sm:h-9 w-auto object-contain" loading="eager" decoding="async">
        @elseif($mode === 'light')
            <img src="{{ asset('images/logo.png') }}" alt="{{ $alt }}" class="h-8 sm:h-9 w-auto object-contain" loading="eager" decoding="async">
        @else
            <img src="{{ asset('images/logo.png') }}" alt="{{ $alt }}" class="h-8 sm:h-9 w-auto object-contain dark:hidden" loading="eager" decoding="async">
            <img src="{{ asset('images/logo-dark.png') }}" alt="{{ $alt }}" class="h-8 sm:h-9 w-auto object-contain hidden dark:block" loading="eager" decoding="async">
        @endif
    </div>
@elseif($variant === 'badge')
    <div {{ $attributes->merge(['class' => 'relative shrink-0 ' . $badgeClass . ' rounded-[6px] bg-white dark:bg-[#181714] border border-[var(--border-default)] dark:border-[#eab308]/30 shadow-xs flex items-center justify-center p-1 overflow-hidden transition-transform duration-200']) }}>
        <img src="{{ asset('images/logo-emblem.png') }}" alt="{{ $alt }}" class="w-full h-full object-contain" loading="eager" decoding="async">
    </div>
@else
    <img {{ $attributes->merge(['class' => $class . ' object-contain inline-block shrink-0']) }} 
         src="{{ asset('images/logo-emblem.png') }}" 
         alt="{{ $alt }}" 
         loading="eager" 
         decoding="async">
@endif
