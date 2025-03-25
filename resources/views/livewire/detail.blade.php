<section class="container mx-auto py-8">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">{{ $property->property_name }}</h1>
        <x-property.property-details-breadcrumb :breadcrumbs="[
            ['label' => 'Home', 'route' => route('home')],
            ['label' => 'Properties', 'route' => route('properties')],
            ['label' => $property->property_name],
        ]" />
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <div class="lg:col-span-3">
            <x-ui.image-display src="{{ asset('storage/property/' . $property->property_image) }}" alt="Property Image" />

            <x-property.property-details
                price="{{ $property->rent }}"
                location="{{ $property->location->address }}, {{ $property->location->city }}"
                size="{{ $property->propertyType->type_name }}"
                description="{{ $property->description }}"
            />

            <x-ui.feature :features="collect($property->amenities)->mapWithKeys(function($amenity) {
                 return [
                    $amenity->amenity_name => [
                        'icon' => $amenity->amenity_icon,
                        'icon_color' => $amenity->amenity_icon_color,
                        'description' => $amenity->amenity_description,
                    ],
                 ];
            })->toArray()" />

            <x-ui.map mapUrl="{{ $property->location->map ?? '' }}" />
            <x-buttons.contact-button />
        </div>

        <x-property.property-details-sidebar />
    </div>
</section>
