@props(['src', 'alt'])

<div class="bg-gray-200 h-[50vh] flex items-center justify-center rounded mb-8 overflow-hidden">
    <img class="w-full h-full object-cover" src="{{ $src }}" alt="{{ $alt }}" />
</div>
