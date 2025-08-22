<section class="container mx-auto py-8">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">{{ $property->name }}</h1>
        <x-property.property-details-breadcrumb :breadcrumbs="[
            ['label' => 'Home', 'route' => route('home')],
            ['label' => 'Properties', 'route' => route('properties')],
            ['label' => $property->name],
        ]" />
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <div class="lg:col-span-3">
            <x-ui.image-display src="{{ asset('storage/property/' . $property->property_image) }}" alt="Property Image" :negotiable="$property->negotiable"/>
            <x-ui.property-media :media="$property"/>
            <x-property.property-details
                rent="{{ $property->rent }}"
                description="{{ $property->description }}"
                size="{{ $property->propertyType->type_name }}"
                location="{{ $property->location->address }}, {{ $property->location->town_city }},  {{ $property->location->area }}."
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
            <x-ui.map mapUrl="{{ $property->location->map }}" />
            @auth
                <x-buttons.contact-button />
            @endauth
        </div>
        <x-property.property-details-sidebar />
    </div>
</section>
