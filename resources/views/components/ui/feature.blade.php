@props(['features'])

<div class="mb-8">
    <h3 class="text-xl font-bold text-gray-800">Features</h3>
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-4">
        @foreach ($features as $feature => $details)
            <div class="bg-gray-100 px-4 py-2 rounded flex flex-col items-start gap-1">
                <div class="flex items-center gap-2">
                    <i class="fa-solid {{ $details['icon'] }} {{ $details['icon_color'] }}"></i>
                    <span class="font-medium text-gray-800">{{ $feature }}</span>
                </div>
                <span class="text-sm text-gray-600">{{ $details['description'] }}</span>
            </div>
        @endforeach
    </div>
</div>
