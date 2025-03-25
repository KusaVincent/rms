@props(['mapUrl'])

<div class="mb-8">
    <h3 class="text-xl font-bold text-gray-800 mb-4">Location</h3>
    <div class="bg-gray-200 h-64 flex items-center justify-center rounded overflow-hidden border-0">
        <iframe
            src="{{ $mapUrl }}"
            width="100%"
            height="100%"
            allowfullscreen=""
            aria-hidden="false"
            tabindex="0">
        </iframe>
    </div>
</div>
