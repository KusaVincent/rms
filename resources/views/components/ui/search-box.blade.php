@props(['search' => '', 'results' => []])

<div class="relative mb-4 group  mt-5 text-gray-700">
    <input
        type="search"
        wire:model.live.debounce.500ms="search"
        class="w-full rounded-lg border border-gray-300 py-2 px-4 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
        placeholder="{{ $placeholder ?? 'Search...' }}"
        aria-label="Search"
    />

    <div wire:loading class="absolute top-2 right-2">
        <x-ui.spinner size="8" color="blue-700" />
    </div>
</div>
