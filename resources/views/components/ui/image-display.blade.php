@props(['src', 'alt'])

<x-ui.zoom-modal>
    <x-slot:trigger>
        <div class="bg-gray-200 h-[50vh] flex items-center justify-center rounded mb-8 overflow-hidden cursor-pointer">
            <img class="w-full h-full object-cover" src="{{ $src }}" alt="{{ $alt }}" />
        </div>
    </x-slot:trigger>

    <img class="rounded-lg max-w-full max-h-screen" src="{{ $src }}" alt="{{ $alt }}" />
</x-ui.zoom-modal>
