@props(['price', 'location', 'size', 'description'])

<div class="mb-8">
    <h2 class="text-xl font-bold text-gray-800 mb-4">{{ __('Property Details') }}</h2>
    <p class="text-gray-700">{{ $description }}</p>
    <ul class="mt-4 space-y-2">
        <li><strong>{{ __('Price') }}:</strong> Ksh {{ number_format($price) }}</li>
        <li><strong>{{ __('Location') }}:</strong> {{ $location }}</li>
        <li><strong>{{ __('Rental Type') }}:</strong> {{ $size }}</li>
    </ul>
</div>
