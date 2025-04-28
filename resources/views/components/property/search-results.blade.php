@props(['title', 'searchResults', 'gridCols', 'design'])

<div class="col-span-12 {{ $design }}">
    <h3 class="text-lg font-italic mb-4">{{ __($title) }}</h3>

    <div class="grid grid-cols-1 sm:grid-cols-2 {{ $gridCols }} gap-6">
        @foreach ($searchResults as $searchResult)
            <x-ui.card
                :rent="$searchResult['rent']"
                :title="$searchResult['property_name']"
                :link="route('details', ['id' => $searchResult['id']])"
                :propertyType="$searchResult['property_type']['type_name'] ?? ''"
                :location="$searchResult['location']['town_city'] . ', ' . ($searchResult['location']['area'] ?? '')"
                :image="asset($searchResult['property_image'] ? 'storage/property/' . $searchResult['property_image'] : 'default/image.png')"
            />
        @endforeach
    </div>
</div>
