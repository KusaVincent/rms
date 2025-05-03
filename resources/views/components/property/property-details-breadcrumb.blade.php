@props(['breadcrumbs'])

@if(!empty($breadcrumbs))
    <p class="text-sm text-gray-600">
        @foreach ($breadcrumbs as $breadcrumb)
            @if (!$loop->last)
                <a href="{{ $breadcrumb['route'] }}" class="text-blue-500 hover:underline" wire:navigate>{{ $breadcrumb['label'] }}</a> &gt;
            @else
                <span>{{ $breadcrumb['label'] }}</span>
            @endif
        @endforeach
    </p>
@endif
