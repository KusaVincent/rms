@php use Illuminate\Contracts\Pagination\Paginator; @endphp

@props(['properties'])

<div class="col-span-12 lg:col-span-12">
    <h3 class="text-2xl font-bold mb-4">{{ __("All Listed Properties") }}</h3>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-6">
        @forelse ($properties as $property)
            <x-ui.card
                :rent="$property->rent"
                :title="$property->name"
                :negotiable="$property->negotiable"
                :link="route('details', ['slug' => $property->slug])"
                :propertyType="$property->propertyType->type_name"
                :location="$property->location->town_city . ', ' . $property->location->area"
                :image="$property->property_image ? config('app.media') . '/storage/' . $property->property_image : asset('storage/property/default.png')"
            />
        @empty
            <div
                class="rounded-lg bg-white p-4 text-center shadow col-span-12 text-lg font-semibold text-gray-500 py-20">
                {{ __("No properties found.") }}
            </div>
        @endforelse
    </div>

    @if ($properties instanceof Paginator)
        <div class="mt-10 px-20">
            {{ $properties->links() }}
        </div>
    @endif
</div>
