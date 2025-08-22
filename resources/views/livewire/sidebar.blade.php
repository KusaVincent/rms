<aside class="col-span-12 lg:col-span-2">
    <x-filter-select />

    <x-filter-list
        title="Select Rental Type"
        :items="$propertyTypes"
        idPrefix="updateSelectedTypes"
    />

    <x-filter-list
        title="Select Location"
        :items="$locations"
        idPrefix="updateSelectedLocations"
    />
</aside>
