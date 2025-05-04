@props(['properties' => collect()])

@if ($properties->isNotEmpty())
    <div>
        <h5 class="text-lg font-bold text-gray-800 mb-4">{{ __('Related Properties') }}</h5>
        @foreach ($properties as $property)
            <div class="space-y-4 m-2">
                <a href="{{ route('details', ['id' => $property->id]) }}" wire:navigate class="block">
                    <div class="flex items-center space-x-4">
                        <img src="{{ asset('storage/property/' . ($property->property_image ?? 'default.jpg')) }}"
                             alt="Property Image" class="w-20 h-20 object-cover rounded">
                        <div>
                            <h6 class="text-blue-600 font-semibold">{{ $property->name }}</h6>
                            <p class="text-sm text-gray-600">
                                {{ __('Posted') }}: {{ $property->created_at->diffForHumans() }}
                            </p>
                            <p class="text-sm text-gray-600">{{ __('Rental Type') }}: {{ $property->propertyType->type_name ?? 'N/A' }}</p>
                            <p class="text-sm text-gray-600">{{ __('Rent') }}: Ksh {{ number_format($property->rent, 2) }}</p>
                            <p class="text-sm text-gray-600">{{ __('Location') }}: {{ $property->location->town_city ?? 'N/A' }}</p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endif
