@props(['image', 'alt'])

<x-ui.zoom-modal>
    <x-slot:trigger>
        <div class="bg-gray-200 w-full aspect-square flex items-center justify-center rounded mb-1 overflow-hidden cursor-pointer">
            <img class="w-full h-full object-cover"
                 src="{{ asset('storage/property/' . $image) }}"
                 alt="Thumbnail of {{ $alt }}" />
        </div>
    </x-slot:trigger>

    <img class="rounded-lg max-w-full max-h-screen"
         src="{{ asset('storage/property/' . $image) }}"
         alt="Zoomed view of {{ $alt }}" />
</x-ui.zoom-modal>
