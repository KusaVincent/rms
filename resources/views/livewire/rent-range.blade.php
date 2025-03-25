<section class="p-4 border rounded-lg shadow-sm">
    <div class="flex justify-between items-center">
        <h6 class="text-gray-700 font-semibold">PRICE (KSH)</h6>
        <button class="text-orange-500 text-sm font-semibold focus:outline-none" wire:click="$refresh">
            Apply
        </button>
    </div>

    <div class="relative mt-4">
        <div class="relative w-full h-2 bg-gray-300 rounded-full">
            <div
                class="absolute h-2 bg-orange-500 rounded-full"
                :class="{
                    'left-[calc(((selectedMinPrice - minPrice) / (maxPrice - minPrice)) * 100%)]': true,
                    'right-[calc(100% - ((selectedMaxPrice - minPrice) / (maxPrice - minPrice)) * 100%)]': true
                }"
            ></div>
        </div>

        <input
            type="range"
            wire:model="selectedMinPrice"
            min="{{ $minPrice }}"
            max="{{ $selectedMaxPrice - 100 }}"
            step="100"
            class="absolute w-full -top-1.5 appearance-none pointer-events-auto bg-transparent z-30"
        />

        <input
            type="range"
            wire:model="selectedMaxPrice"
            min="{{ $selectedMinPrice + 100 }}"
            max="{{ $maxPrice }}"
            step="100"
            class="absolute w-full -top-1.5 appearance-none pointer-events-auto bg-transparent z-20"
        />
    </div>

    <div class="mt-4 flex items-center justify-between">
        <input
            type="number"
            wire:model.lazy="selectedMinPrice"
            min="{{ $minPrice }}"
            max="{{ $selectedMaxPrice }}"
            step="100"
            class="w-20 border border-gray-300 rounded px-2 py-1 text-center focus:outline-none focus:ring focus:ring-orange-300"
        />
        <span class="text-gray-500">-</span>
        <input
            type="number"
            wire:model.lazy="selectedMaxPrice"
            min="{{ $selectedMinPrice }}"
            max="{{ $maxPrice }}"
            step="100"
            class="w-20 border border-gray-300 rounded px-2 py-1 text-center focus:outline-none focus:ring focus:ring-orange-300"
        />
    </div>
</section>
