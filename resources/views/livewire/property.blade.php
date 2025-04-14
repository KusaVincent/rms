<section class="{{ $class }}">
    @if (Request::is('/'))
        <x-property.property-section
            title="Newly Listed Rental Properties"
            :properties="$properties"
            gridCols="grid-cols-1 sm:grid-cols-2 lg:grid-cols-5"
            design="col-span-12 lg:col-span-10"
        />
    @elseif(Request::is('property-details/*'))
        <x-property.related-properties :properties="$properties" />
    @elseif(Request::is('properties'))
        <div class="col-span-12 lg:col-span-12">
            <h3 class="text-2xl font-bold mb-4">{{ __("All Listed Properties") }}</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-6">
                @forelse ($properties as $property)
                    <x-ui.card
                        :image="asset($property->property_image ? 'storage/property/' . $property->property_image : 'default/image.png')"
                        :title="$property->property_name"
                        :description="\Illuminate\Support\Str::words($property->description, 20, '...')"
                        :link="route('details', ['id' => $property->id])"
                    />
                @empty
                    <p class="col-span-12 text-center text-lg font-semibold text-gray-500 bg-gray-100 py-6 rounded-lg">
                        {{ __("No properties found.") }}
                    </p>
                @endforelse
            </div>

            @if ($properties instanceof \Illuminate\Contracts\Pagination\Paginator)
                <div class="mt-4 flex justify-center">
                    {{ $properties->links() }}
                </div>
            @endif
        </div>
    @endif
</section>
