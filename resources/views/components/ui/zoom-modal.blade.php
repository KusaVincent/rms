@props(['open' => false])

<div x-data="{ open: @json($open) }" x-cloak>
    <div @click="open = true">
        {{ $trigger }}
    </div>

    <div x-show="open" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50"
         @click="open = false">
        <div class="relative w-full max-w-3xl" @click.stop>
            {{ $slot }}
        </div>
    </div>
</div>
