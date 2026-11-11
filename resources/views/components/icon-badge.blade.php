@props(['count' => 0, 'label' => 'Unread items'])

<span x-data="{ count: {{ (int) $count }} }"
      x-show="count > 0"
      x-text="count > 9 ? '9+' : count"
      x-cloak
      aria-label="{{ $label }}: {{ $count }}"
      role="status"
      class="absolute top-1.5 right-1.5 w-[18px] h-[18px] rounded-full bg-[var(--color-blessing)] text-white text-[10px] font-bold flex items-center justify-center ring-2 ring-[var(--bg-surface)] pointer-events-none select-none transition-transform duration-200">
</span>

