@props(['media' => []])

@if (!empty($media) && !is_null($media->propertyMedia))
    <div class="grid grid-cols-6 gap-2">
        @foreach (['image_one', 'image_two', 'image_three', 'image_four', 'image_five', 'video'] as $mediaField)
            @if ($media->propertyMedia->$mediaField)
                @if ($mediaField === 'video')
                    <x-ui.property-video-display
                        video="{{ $media->propertyMedia->$mediaField }}"
                    />
                @else
                    <x-ui.property-image-display
                        alt="{{ $mediaField }}"
                        image="{{ $media->propertyMedia->$mediaField }}"/>
                @endif
            @endif
        @endforeach
    </div>
@endif
