@props(['properties' => collect()])

@if ($properties->isNotEmpty())
    <div>
        <h5 class="text-lg font-bold text-gray-800 mb-4">{{ __('Related Properties') }}</h5>
        @foreach ($properties as $property)
            <div class="space-y-4 m-2">
                <a href="{{ route('details', ['slug' => $property->slug]) }}" wire:navigate class="block">
                    <div class="flex items-center space-x-4">
                        <img src="{{ $property->property_image ? config('app.media') . '/storage/' . $property->property_image : asset('storage/property/default.png') }}"
                             alt="Property Image" class="w-20 h-20 object-cover rounded">
                        <div>
                            <h6 class="text-blue-600 font-semibold">{{ $property->name }}</h6>
                            <p class="text-sm text-gray-600">
                                {{ __('Posted') }}: {{ $property->created_at->diffForHumans() }}
                            </p>
                            <p class="text-sm text-gray-600">{{ __('Rental Type') }}: {{ $property->propertyType->type_name ?? 'N/A' }}</p>
                            <p class="text-sm text-gray-600">{{ __('Rent') }}:
                                {{ $property->rent }}
                                <x-negotiable :negotiable="$property->negotiable" />
                            </p>
                            <p class="text-sm text-gray-600">{{ __('Location') }}: {{ $property->location->town_city ?? 'N/A' }}</p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endif

