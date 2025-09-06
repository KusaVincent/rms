<nav class="relative flex items-center justify-between bg-gray-100 p-4 rounded-lg shadow-md">

    <a href="{{ route('home') }}" class="flex items-center z-10" wire:navigate>
        <img src="{{ asset('storage/logo/logo.png') }}" alt="Logo" class="w-16 h-16 object-contain">
    </a>

    <div class="absolute left-1/2 transform -translate-x-1/2 flex space-x-4">
        <x-navigation.nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
            Home
        </x-navigation.nav-link>
        <x-navigation.nav-link href="{{ route('properties') }}" :active="request()->routeIs('properties')">
            All Properties
        </x-navigation.nav-link>
        <x-navigation.nav-link href="{{ url('about') }}" :active="request()->is('about')">
            About Us
        </x-navigation.nav-link>
        <x-navigation.nav-link href="{{ url('contact') }}" :active="request()->is('contact')">
            Contact Us
        </x-navigation.nav-link>
    </div>

    <div class="flex space-x-4 z-10">
        @auth
            <x-navigation.nav-link href="{{ url('/dashboard') }}" :active="request()->is('dashboard')">
                Dashboard
            </x-navigation.nav-link>
        @else
            <x-navigation.nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                Log in
            </x-navigation.nav-link>

            @if (Route::has('register'))
                <x-navigation.nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                    Register
                </x-navigation.nav-link>
            @endif
        @endauth
        <x-navigation.nav-link
            target="_blank"
            :navigation="false"
            href="{{ config('app.admin') }}"
        >
            Find Tenants
        </x-navigation.nav-link>
        <x-navigation.nav-link
            target="_blank"
            :navigation="false"
            href="{{ config('app.admin') }}"
        >
            Post Properties
        </x-navigation.nav-link>
    </div>
</nav>
