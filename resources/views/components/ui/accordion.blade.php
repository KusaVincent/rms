@props(['title', 'content'])

<div class="bg-gray-100 p-4 rounded-lg shadow">
    <h4 class="font-semibold text-lg cursor-pointer" x-data="{ open: false }" @click="open = !open">
        {{ $title }}
    </h4>
    <p class="mt-2 text-gray-600" x-show="open">
        {{ $content }}
    </p>
</div>
