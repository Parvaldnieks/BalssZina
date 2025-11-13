@props([
    'href' => null,
    'type' => 'submit',
    'spinner' => false,
])

@php
    $isLink = filled($href) || $attributes->has('href') || $attributes->has(':href');

    $outer = '
        relative inline-flex items-center justify-center
        p-0.5 overflow-hidden text-sm font-medium rounded-lg
        group bg-gradient-to-br from-red-600 via-orange-500 to-red-600
        group-hover:from-orange-500 group-hover:to-red-500
        text-white dark:text-white focus:ring-0 transition ease-in-out duration-150
    ';

    $inner = '
        relative py-3 transition-all ease-in duration-75
        bg-white text-black hover:text-white dark:text-white hover:dark:text-black dark:bg-black rounded-md group-hover:bg-transparent flex items-center justify-center min-w-[100px]
    ';
@endphp

@if ($isLink)
    <a 
        {{ $attributes->merge(['class' => $outer]) }}
        @if ($href) href="{{ $href }}" @endif
    >
        <span class="{{ $inner }}">
            {{ $slot }}
        </span>
    </a>
@else
    <button 
        {{ $attributes->merge(['type' => $type, 'class' => $outer]) }}
        @if($spinner)
            x-bind:disabled="submitting"
            x-bind:class="{ 'opacity-50 cursor-not-allowed': submitting }"
        @endif
    >
        <span class="{{ $inner }} relative">
            <span
                @if($spinner)
                    x-bind:class="{ 'invisible': submitting }"
                @endif
                class="flex items-center justify-center"
            >
                {{ $slot }}
            </span>

            @if ($spinner)
                <span
                    x-show="submitting"
                    x-transition.opacity.duration.150ms
                    class="absolute inset-0 flex items-center justify-center"
                >
                    <svg 
                        class="animate-spin h-5 w-5 text-black dark:text-white"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <circle 
                            class="opacity-25" 
                            cx="12" cy="12" r="10" 
                            stroke="currentColor" 
                            stroke-width="4"
                        ></circle>
                        <path 
                            class="opacity-75" 
                            fill="currentColor" 
                            d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"
                        ></path>
                    </svg>
                </span>
            @endif
        </span>
    </button>
@endif
