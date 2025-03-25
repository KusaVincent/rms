<section class="{{ $class }}">
    @if (Request::is('/'))
        <x-property.property-section
            title="Newly Listed Rental Properties"
            :properties="$properties"
            gridCols="grid-cols-1 sm:grid-cols-2 lg:grid-cols-5"
            design="col-span-12 lg:col-span-10"
        />
    @elseif(Request::is('properties'))
        <x-property.property-pagination
            title="All Listed Properties"
            :properties="$properties"
            gridCols="grid-cols-1 sm:grid-cols-2 lg:grid-cols-6"
            design="col-span-12 lg:col-span-12"
        />
    @elseif(Request::is('property-details/*'))
        <x-property.related-properties :properties="$properties" />
    @endif
</section>
