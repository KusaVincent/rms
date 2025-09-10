@props(['video'])

<x-ui.zoom-modal>
    <x-slot:trigger>
        <div class="bg-gray-200 w-full aspect-square flex items-center justify-center rounded mb-1 overflow-hidden cursor-pointer">
            <video class="w-full h-full object-cover" muted>
                <source src="{{ config('app.media') . '/storage/' . $video }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </x-slot:trigger>

    <video class="rounded-lg max-w-full max-h-screen" controls autoplay>
        <source src="{{ config('app.media') . '/storage/' . $video }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</x-ui.zoom-modal>
