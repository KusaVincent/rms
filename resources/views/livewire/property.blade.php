<section class="{{ $class }}">
    @if ((is_array($searchResults) && count($searchResults) > 0) || ($searchResults instanceof \Illuminate\Support\Collection && $searchResults->isNotEmpty()))
        <x-property.search-results
            gridCols="lg:grid-cols-5"
            design="lg:col-span-12"
            :searchResults="$searchResults"
            title="{{ count($searchResults) }} search results found"
        />
    @else
        <x-property.property-list :properties="$properties" />
    @endif
</section>
