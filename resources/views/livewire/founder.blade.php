<section class="agent content-area-2 py-16 bg-gray-50">
    <div class="container mx-auto">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold">Meet The Team</h1>
            <p class="text-gray-600">The Founding Members of {{ config('app.name', 'Rentals Konekt') }}</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <x-ui.founder
                name="Libby Ngina"
                image="/assets/img/avatar/libby.jpg"
                :socials="[
                    ['icon' => 'fa-facebook', 'url' => '#', 'hoverClass' => 'hover:text-blue-500'],
                    ['icon' => 'fa-twitter', 'url' => '#', 'hoverClass' => 'hover:text-blue-400'],
                    ['icon' => 'fa-linkedin', 'url' => '#', 'hoverClass' => 'hover:text-blue-700']
                ]"
            />
            <x-ui.founder
                name="Vincent Kusa"
                image="/assets/img/avatar/kusa.jpg"
                :socials="[
                    ['icon' => 'fa-facebook', 'url' => '#', 'hoverClass' => 'hover:text-blue-500'],
                    ['icon' => 'fa-twitter', 'url' => '#', 'hoverClass' => 'hover:text-blue-400'],
                    ['icon' => 'fa-linkedin', 'url' => '#', 'hoverClass' => 'hover:text-blue-700']
                ]"
            />
            <x-ui.founder
                name="Dominic Mputa"
                image="/assets/img/avatar/dom.jpg"
                :socials="[
                    ['icon' => 'fa-facebook', 'url' => '#', 'hoverClass' => 'hover:text-blue-500'],
                    ['icon' => 'fa-twitter', 'url' => '#', 'hoverClass' => 'hover:text-blue-400'],
                    ['icon' => 'fa-linkedin', 'url' => '#', 'hoverClass' => 'hover:text-blue-700']
                ]"
            />
            <x-ui.founder
                name="Patrick Ayub"
                image="/assets/img/avatar/pat.jpg"
                :socials="[
                    ['icon' => 'fa-facebook', 'url' => '#', 'hoverClass' => 'hover:text-blue-500'],
                    ['icon' => 'fa-twitter', 'url' => '#', 'hoverClass' => 'hover:text-blue-400'],
                    ['icon' => 'fa-linkedin', 'url' => '#', 'hoverClass' => 'hover:text-blue-700']
                ]"
            />
        </div>
    </div>
</section>
