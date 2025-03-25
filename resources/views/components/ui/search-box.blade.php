@props(['search' => '', 'results' => []])

<div class="relative mb-4 group">
    <input
        type="search"
        wire:model.live.debounce.500ms="search"
        class="w-full rounded-lg border border-gray-300 py-2 px-4 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
        placeholder="{{ $placeholder ?? 'Search specific location' }}"
        aria-label="Search"
    />

    @if(!empty($search))
        <div class="absolute z-50 mt-2 left-0 w-full max-w-sm rounded-lg bg-white shadow-lg border border-gray-200 opacity-0 invisible transition-all duration-200 group-focus-within:opacity-100 group-focus-within:visible group-hover:opacity-100 group-hover:visible">
            @if($results->count() > 0)
                <ul class="divide-y divide-gray-100">
                    @foreach($results as $result)
                        <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">
                            <div class="font-medium">{{ $result->property_name }}</div>
                            <div class="text-sm text-gray-500">
                                {{ $result->location->area }} : {{ $result->location->town_city }}
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="px-4 py-2 text-gray-500">{{ __('No results found.') }}</p>
            @endif
        </div>
    @endif
</div>
