@props(['name', 'image', 'socials'])

<div class="agent-2 bg-white rounded-lg shadow-lg p-4 text-center">
    <img src="{{ $image }}" class="w-full h-64 object-cover rounded-lg mb-4" alt="{{ $name }}">
    <h5 class="text-lg font-bold">{{ $name }}</h5>
    <ul class="flex justify-center space-x-4 mt-4 text-gray-500">
        @foreach ($socials as $social)
            <li>
                <a href="{{ $social['url'] }}" class="{{ $social['hoverClass'] }}">
                    <i class="fa {{ $social['icon'] }}"></i>
                </a>
            </li>
        @endforeach
    </ul>
</div>
