@props(['title', 'properties', 'gridCols', 'design'])

<div class="{{ $design }}">
    <h3 class="text-2xl font-bold mb-4">{{ __($title) }}</h3>

    <div class="grid {{ $gridCols }} gap-6">
        @if (is_iterable($properties->items) && count($properties) > 0)
            @foreach ($properties as $property)
                <x-ui.card
                    image="{{ $property->property_image ? asset('storage/property/' . $property->property_image) : asset('default/image.png') }}"
                    title="{{ $property->property_name }}"
                    description="{{ \Illuminate\Support\Str::words($property->description, 20, '...') }}"
                    link="{{ route('details', ['id' => $property->id]) }}"
                />
            @endforeach
        @else
            <p>No properties found.</p>
        @endif
    </div>
</div>
