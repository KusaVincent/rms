@props(['properties'])
<div>
    @switch(true)
        @case(Request::is('property-details/*'))
            <x-property.related-properties :properties="$properties" />
            @break
        @case(Request::is('/'))
            <x-property.property-section
                :properties="$properties"
                design="col-span-12 lg:col-span-10"
                title="Newly Listed Rental Properties"
                gridCols="grid-cols-1 sm:grid-cols-2 lg:grid-cols-5"
            />
            @break
        @case(Request::is('properties'))
            <x-property.paginated-property :properties="$properties" />
            @break
        @default
            <div class="rounded-lg bg-white p-4 text-center shadow col-span-12 text-lg font-semibold text-gray-500 py-20">
                {{ __("No matching content.") }}
            </div>
    @endswitch
</div>
