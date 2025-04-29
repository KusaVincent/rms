@props(['title', 'results', 'gridCols', 'design'])

<div class="col-span-12 {{ $design }}">
    <h3 class="text-lg font-italic mb-4">{{ __($title) }}</h3>

    <div class="grid grid-cols-1 sm:grid-cols-2 {{ $gridCols }} gap-6">
        @foreach ($results as $result)
            <x-ui.card
                :rent="$result['rent']"
                :title="$result['property_name']"
                :link="route('details', ['id' => $result['id']])"
                :propertyType="$result['property_type']['type_name'] ?? ''"
                :location="$result['location']['town_city'] . ', ' . ($result['location']['area'] ?? '')"
                :image="asset($result['property_image'] ? 'storage/property/' . $result['property_image'] : 'default/image.png')"
            />
        @endforeach
    </div>
</div>
