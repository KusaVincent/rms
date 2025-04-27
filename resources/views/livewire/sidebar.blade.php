<aside class="col-span-12 lg:col-span-2">
    <x-filter-list
        title="Select Rental Type"
        :items="$propertyTypes"
        idPrefix="type"
    />

    <x-filter-list
        title="Select Location"
        :items="$locations"
        idPrefix="location"
    />
</aside>
