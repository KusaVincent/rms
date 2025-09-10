@props(['title', 'results', 'gridCols', 'design'])

<div class="col-span-12 {{ $design }}">
    <h3 class="text-lg font-italic mb-4">{{ __($title) }}</h3>

    <div class="grid grid-cols-1 sm:grid-cols-2 {{ $gridCols }} gap-6">
        @foreach ($results as $result)
            <x-ui.card
                :rent="$result['rent']"
                :title="$result['name']"
                :negotiable="$result['negotiable']"
                :link="route('details', ['slug' => $result['slug']])"
                :propertyType="$result['property_type']['type_name'] ?? ''"
                :location="$result['location']['town_city'] . ', ' . ($result['location']['area'] ?? '')"
                :image="$result['property_image'] ? config('app.media') . '/storage/' . $result['property_image'] : asset('storage/property/default.png')"
            />
        @endforeach
    </div>
</div>
