<div class="ml-4 mt-4">
    <label for="filterSelect" class="text-blue-600 font-semibold mt-2">Terms</label>
    <select
        id="filterSelect"
        wire:model.live.debounce.250ms="negotiable"
        class="block w-full rounded border border-gray-300 px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
    >
        <option value="">Negotiable / not negotiable...</option>
        <option value="Yes">Negotiable</option>
    </select>
</div>
