<section class="agent content-area-2 py-16 bg-gray-50">
    <div class="container mx-auto">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold">Meet The Team</h1>
            <p class="text-gray-600">The Founding Members of {{ config('app.name', 'Rentals Konekt') }}</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($founders as $founder)
                <x-ui.founder
                    name="{{ $founder->name }}"
                    image="{{ $founder->image }}"
                    :socials='$founder->social_media'
                />
            @endforeach
        </div>
    </div>
</section>
