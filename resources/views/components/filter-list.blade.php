<div class="ml-4 mt-4">
    <hr class="border-gray-300">
    <h6 class="text-blue-600 font-semibold mt-2">{{ $title ?? 'Search Section' }}</h6>
    <ul class="max-h-[50vh] overflow-auto rounded-lg shadow-sm">
        @foreach ($items as $item)
            <li class="flex items-center mb-2">
                <input
                    type="checkbox"
                    wire:model="selectedTypes"
                    value="{{ $item->id }}"
                    id="{{ $idPrefix . $item->id }}"
                    class="mr-2"
                />
                <label for="{{ $idPrefix . $item->id }}">
                    @if($idPrefix == 'location')
                        {{ $item->town_city }}
                    @elseif($idPrefix == 'type')
                        {{ $item->type_name }}
                    @endif
                </label>
            </li>
        @endforeach
    </ul>
</div>
