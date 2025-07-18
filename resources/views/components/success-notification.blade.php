@props(['message'])

@if ($message)
    <div
        x-data="{ show: true }"
        x-show="show"
        x-transition:opacity.duration.500ms
        class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg font-medium shadow-sm relative pr-10"
        role="alert"
    >
        {{ $message }}
        <button
            type="button"
            @click="show = false"
            class="absolute top-1/2 -translate-y-1/2 right-3 text-green-700 hover:text-green-900 focus:outline-none"
            aria-label="Close"
        >
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
@endif