@props(['title', 'properties', 'gridCols', 'design'])

<div class="{{ $design }}">
    <h3 class="text-2xl font-bold mb-4">{{ __($title) }}</h3>

    <div class="grid {{ $gridCols }} gap-6">
        @foreach ($properties as $property)
            <x-ui.card
                :rent="$property->rent"
                :title="$property->name"
                :negotiable="$property->negotiable"
                :link="route('details', ['slug' => $property->slug])"
                :propertyType="$property->propertyType->type_name"
                :location="$property->location->town_city . ', ' . $property->location->area"
                :image="$property->property_image ? config('app.media') . '/storage/' . $property->property_image : asset('storage/property/default.png')"
            />
        @endforeach
    </div>
</div>
