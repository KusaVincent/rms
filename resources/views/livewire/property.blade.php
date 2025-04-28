<section class="{{ $class }}">
    @if ((is_array($searchResults) && count($searchResults) > 0) || ($searchResults instanceof \Illuminate\Support\Collection && $searchResults->isNotEmpty()))
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
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
    @else
        @switch(true)
            @case(Request::is('property-details/*'))
                <x-property.related-properties :properties="$properties" />
                @break
            @case(Request::is('/'))
                <x-property.property-section
                    title="Newly Listed Rental Properties"
                    :properties="$properties"
                    gridCols="grid-cols-1 sm:grid-cols-2 lg:grid-cols-5"
                    design="col-span-12 lg:col-span-10"
                />
                @break
            @case(Request::is('properties'))
                <div class="col-span-12 lg:col-span-12">
                    <h3 class="text-2xl font-bold mb-4">{{ __("All Listed Properties") }}</h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-6">
                        @forelse ($properties as $property)
                            <x-ui.card
                                :rent="$property->rent"
                                :title="$property->property_name"
                                :link="route('details', ['id' => $property->id])"
                                :propertyType="$property->propertyType->type_name"
                                :location="$property->location->town_city . ', ' . $property->location->area"
                                :image="asset($property->property_image ? 'storage/property/' . $property->property_image : 'default/image.png')"
                            />
                        @empty
                            <div class="rounded-lg bg-white p-4 text-center shadow col-span-12 text-lg font-semibold text-gray-500 py-20">
                                {{ __("No properties found.") }}
                            </div>
                        @endforelse
                    </div>

                    @if ($properties instanceof \Illuminate\Contracts\Pagination\Paginator)
                        <div class="mt-10 px-20">
                            {{ $properties->links() }}
                        </div>
                    @endif
                </div>
                @break
            @default
                <div class="rounded-lg bg-white p-4 text-center shadow col-span-12 text-lg font-semibold text-gray-500 py-20">
                    {{ __("No matching content.") }}
                </div>
        @endswitch
    @endif
</section>
