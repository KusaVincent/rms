@if(!empty($items))
    <div class="ml-4 mt-4">
        <h6 class="text-blue-600 font-semibold mt-2">{{ $title ?? 'Search Section' }}</h6>
        <ul class="max-h-[50vh] overflow-auto rounded-lg shadow-sm">
            @foreach ($items as $item)
                <li class="flex items-center mb-2">
                    <input
                        class="mr-2"
                        type="checkbox"
                        value="{{ $item->id }}"
                        wire:change="{{ $idPrefix }}"
                        id="{{ $idPrefix . $item->id }}"
                        wire:model.debounce.300ms="{{ $idPrefix === 'updateSelectedLocations' ? 'selectedLocations' : 'selectedTypes' }}"
                    />
                    <label for="{{ $idPrefix . $item->id }}">
                        @if($idPrefix == 'updateSelectedLocations')
                            {{ $item->town_city }}
                        @elseif($idPrefix == 'updateSelectedTypes')
                            {{ $item->type_name }}
                        @endif
                    </label>
                </li>
            @endforeach
        </ul>
    </div>
@endif
