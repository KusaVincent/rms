@props(['open' => false])

<div x-data="{ open: @json($open) }" x-cloak>
    <div @click="open = true">
        {{ $trigger }}
    </div>

    <div x-show="open"
         class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50"
         @click="open = false">
        <div class="relative max-w-3xl w-full px-4"
             @click.stop>
            <div class="flex justify-center items-center">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
