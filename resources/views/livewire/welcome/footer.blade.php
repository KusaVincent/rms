<footer class="bg-gray-800 text-white {{ $margin }}">
    <div class="container mx-auto py-10">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <x-footer.about-section />

            <x-footer.quick-links />

            <x-footer.resources-links />

            <x-footer.contact-section :contacts="$contacts"/>
        </div>
    </div>
    <div class="bg-gray-900 text-center py-4">
        <p class="text-sm">
            &copy; {{ now()->year }} {{ config('app.name', 'Rentals Konekt') }}. {{ __('All Rights Reserved.') }}
        </p>
    </div>
</footer>
