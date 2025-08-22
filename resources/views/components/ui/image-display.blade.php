@props(['src', 'alt', 'negotiable' => false])

@once
    <style>
        @keyframes ribbon-slide {
            0% {
                transform: translateX(-100%);
            }
            100% {
                transform: translateX(100%);
            }
        }
    </style>
@endonce

<x-ui.zoom-modal>
    <x-slot:trigger>
        <div class="relative bg-gray-200 h-[50vh] flex items-center justify-center rounded mb-8 overflow-hidden cursor-pointer">

            {{-- Full Width Moving Ribbon --}}
            @if($negotiable)
                <div class="absolute top-0 left-0 w-full overflow-hidden z-10">
                    <div class="whitespace-nowrap animate-[ribbon-slide_15s_linear_infinite]">
                        <div class="bg-blue-700 text-white text-sm font-semibold py-1 px-4 inline-block w-max">
                            @php
                                $space = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                                $term = $space . $space .$space . $space . __('Terms are Negotiable') . $space . $space . $space . $space;
                                echo str_repeat($term, 4);
                            @endphp
                        </div>
                    </div>
                </div>
            @endif

            {{-- Image --}}
            <img class="w-full h-full object-cover" src="{{ $src }}" alt="{{ $alt }}" />
        </div>
    </x-slot:trigger>

    <img class="rounded-lg max-w-full max-h-screen" src="{{ $src }}" alt="{{ $alt }}" />
</x-ui.zoom-modal>
