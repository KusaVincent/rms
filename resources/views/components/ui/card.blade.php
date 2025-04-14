@props(['link', 'image', 'title', 'description', 'propertyType', 'rent' => 1, 'location'])

<div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 flex flex-col">
    <a href="{{ $link }}" wire:navigate>
        <img class="rounded-t-lg" src="{{ $image }}" alt="Property Image" />
    </a>

    <div class="p-5 flex-grow">
        <a href="{{ $link }}" wire:navigate>
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $title }}</h5>
        </a>
        <p class="text-sm text-gray-600 "><span class="font-bold">{{ __('Rental Type') }}</span>: {{ $propertyType ?? 'N/A' }}</p>
        <p class="text-sm text-gray-600"><span class="font-bold">{{ __('Rent') }}</span> : Ksh {{ number_format($rent, 2) }}</p>
        <p class="text-sm text-gray-600"><span class="font-bold">{{ __('Location') }}</span>: {{ $location ?? 'N/A' }}</p>

        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 mt-2">{{ $description }}</p>
    </div>

    <div class="p-5 mt-auto flex justify-end">
        <a href="{{ $link }}"
           class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
           wire:navigate>
            {{ __('View Details') }}
            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
            </svg>
        </a>
    </div>
</div>

