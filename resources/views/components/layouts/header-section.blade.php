@props(['title', 'breadcrumbs'])

<div>
    <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold mb-4">
        {{ $title }}
    </h2>
    <ul class="flex justify-center space-x-4 mt-4">
        @foreach ($breadcrumbs as $breadcrumb)
            @if (isset($breadcrumb['route']))
                <li>
                    <a href="{{ $breadcrumb['route'] }}" class="text-gray-300 hover:text-white" wire:navigate>
                        {{ $breadcrumb['label'] }}
                    </a>
                </li>
            @else
                <li class="text-white">/ {{ $breadcrumb['label'] }}</li>
            @endif
        @endforeach
    </ul>

    <div class="content">
        {{ $slot }}
    </div>
</div>
