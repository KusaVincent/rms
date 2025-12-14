<div x-data="{ open: false }" @click.outside="open = false">
    <nav class="relative bg-gray-100 p-4 rounded-lg shadow-md">
        <div class="flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center z-10" wire:navigate>
                <img src="{{ config('app.media') .'storage/logo/logo.png' }}" alt="Logo" class="w-16 h-16 object-contain">
            </a>

            <button @click="open = true" class="md:hidden z-10 focus:outline-none">
                <svg class="w-8 h-8 text-gray-800" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            <div class="hidden md:flex absolute left-1/2 transform -translate-x-1/2 space-x-4 mt-4 md:mt-0">
                <x-navigation.nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">Home</x-navigation.nav-link>
                <x-navigation.nav-link href="{{ route('properties') }}" :active="request()->routeIs('properties')">All Properties</x-navigation.nav-link>
                <x-navigation.nav-link href="{{ url('about') }}" :active="request()->is('about')">About Us</x-navigation.nav-link>
                <x-navigation.nav-link href="{{ url('contact') }}" :active="request()->is('contact')">Contact Us</x-navigation.nav-link>
            </div>

            <div class="hidden md:flex space-x-4 z-10">
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

                <x-navigation.nav-link target="_blank" :navigation="false" href="{{ config('app.leasePanelUrl') }}">
                    Find Tenants
                </x-navigation.nav-link>
                <x-navigation.nav-link target="_blank" :navigation="false" href="{{ config('app.managePanelUrl') }}">
                    Post Properties
                </x-navigation.nav-link>
            </div>
        </div>

        <div
            x-show="open"
            x-cloak
            x-transition:enter="transition transform duration-300 ease-out"
            x-transition:enter-start="translate-y-4 opacity-0"
            x-transition:enter-end="translate-y-0 opacity-100"
            x-transition:leave="transition transform duration-200 ease-in"
            x-transition:leave-start="translate-y-0 opacity-100"
            x-transition:leave-end="translate-y-4 opacity-0"
            class="absolute top-full left-0 w-full bg-white z-50 flex flex-col p-6 space-y-4 md:hidden shadow-lg rounded-b-lg"
        >
            <div class="flex justify-between items-center mb-4">
                <a href="{{ route('home') }}" wire:navigate>
                    <img src="{{ config('app.media') .'storage/logo/logo.png' }}" alt="Logo" class="w-12 h-12 object-contain">
                </a>
                <button @click="open = false" class="text-gray-800">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <x-navigation.nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">Home</x-navigation.nav-link>
            <x-navigation.nav-link href="{{ route('properties') }}" :active="request()->routeIs('properties')">All Properties</x-navigation.nav-link>
            <x-navigation.nav-link href="{{ url('about') }}" :active="request()->is('about')">About Us</x-navigation.nav-link>
            <x-navigation.nav-link href="{{ url('contact') }}" :active="request()->is('contact')">Contact Us</x-navigation.nav-link>

            @auth
                <x-navigation.nav-link href="{{ url('/dashboard') }}" :active="request()->is('dashboard')">Dashboard</x-navigation.nav-link>
            @else
                <x-navigation.nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">Log in</x-navigation.nav-link>
                @if (Route::has('register'))
                    <x-navigation.nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">Register</x-navigation.nav-link>
                @endif
            @endauth

            <x-navigation.nav-link target="_blank" :navigation="false" href="{{ config('app.leasePanelUrl') }}">Find Tenants</x-navigation.nav-link>
            <x-navigation.nav-link target="_blank" :navigation="false" href="{{ config('app.managePanelUrl') }}">Post Properties</x-navigation.nav-link>
        </div>
    </nav>
</div>
