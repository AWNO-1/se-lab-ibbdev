@props(['type' => 'success', 'message' => ''])

@php
    $icons = [
        'success' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
        'error' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
        'info' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
    ];
    $colors = [
        'success' => 'bg-emerald-600 text-white shadow-emerald-500/30',
        'error' => 'bg-red-600 text-white shadow-red-500/30',
        'info' => 'bg-slate-900 text-white shadow-slate-900/30',
    ];
@endphp

<div x-data="{ show: true }" 
     x-init="setTimeout(() => show = false, 5000)" 
     x-show="show" 
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 translate-y-2 sm:translate-y-0 sm:translate-x-2"
     x-transition:enter-end="opacity-100 translate-y-0 sm:translate-x-0"
     x-transition:leave="transition ease-in duration-300"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0 translate-y-2"
     class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-2xl {{ $colors[$type] ?? $colors['success'] }} shadow-xl ring-1 ring-black/5"
     role="alert">
    <div class="p-4">
        <div class="flex items-start gap-3">
            <div class="flex-shrink-0 rounded-xl bg-white/20 p-1.5">
                <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    {!! $icons[$type] ?? $icons['success'] !!}
                </svg>
            </div>
            <div class="flex-1 pt-0.5">
                <p class="text-sm font-bold leading-6">{{ $message }}</p>
            </div>
            <button @click="show = false" class="flex-shrink-0 rounded-lg bg-white/10 p-1 hover:bg-white/20 transition">
                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    </div>
    <div class="h-1 bg-white/20">
        <div class="h-full bg-white/60 animate-[shrink_5s_linear_forwards]" style="animation: shrink 5s linear forwards;"></div>
    </div>
</div>

<style>
@keyframes shrink {
    from { width: 100%; }
    to { width: 0%; }
}
</style>
