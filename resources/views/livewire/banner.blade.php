@php
    $bannerHeight = '';
    $backgroundImage = '';

    if (Request::is('/')) {
        $bannerHeight = 'h-[75vh]';
        $backgroundImage = asset('storage/banner-2.jpg');
    } elseif (Request::is('properties')) {
        $bannerHeight = 'h-[50vh]';
        $backgroundImage = asset('storage/banner.jpg');
    } else {
        $bannerHeight = 'h-[25vh]';
        $backgroundImage = asset('storage/breadcrumb.jpg');
    }
@endphp

<x-layouts.banner :bannerHeight="$bannerHeight" :backgroundImage="$backgroundImage">
    @if (Request::is('/'))
        <x-layouts.header-section title="Best Place To Find Rental Houses" :breadcrumbs="[]">
            <p class="text-sm sm:text-base md:text-lg lg:text-xl mb-6">
                {{ __('Search through our extensive catalog and find the perfect house for you.') }}
            </p>
            <a href="{{ route('properties') }}" class="px-6 py-3 bg-red-500 hover:bg-red-600 text-white rounded-lg text-sm sm:text-base" wire:navigate>
                {{ __('Get Started Now') }}
            </a>
        </x-layouts.header-section>
    @elseif(Request::is('properties'))
        <x-layouts.header-section title="Properties to Suit Your Needs"
            :breadcrumbs="[
                ['label' => 'Home', 'route' => route('home')],
                ['label' => 'Properties']
            ]"
        />
    @elseif(Request::is('property-details/*'))
        <x-layouts.header-section title="Discover Your Next Home"
            :breadcrumbs="[
                ['label' => 'Home', 'route' => route('home')],
                ['label' => 'Property Details']
            ]"
        />
    @elseif(Request::is('contact'))
        <x-layouts.header-section title="Contact Us"
            :breadcrumbs="[
                ['label' => 'Home', 'route' => route('home')],
                ['label' => 'Contact Us']
            ]"
        />
    @elseif(Request::is('about'))
        <x-layouts.header-section title="About Us"
            :breadcrumbs="[
                ['label' => 'Home', 'route' => route('home')],
                ['label' => 'About Us']
            ]"
        />
    @else
        <x-layouts.header-section title="Discover More"
            :breadcrumbs="[
                ['label' => 'Home', 'route' => route('home')]
            ]"
        />
    @endif
</x-layouts.banner>
