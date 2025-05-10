<section class="about-us content-area-8 bg-white py-16">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 items-center">

        <div class="flex justify-center">
            <img src="{{ asset('storage/about.png') }}" alt="admin" class="w-full max-w-md rounded-lg shadow-lg">
        </div>
        
        <div class="flex flex-col justify-center">
            <h3 class="text-2xl font-bold mb-4">Why Choose Us?</h3>
            <div class="faq-accordion space-y-4">
                @foreach($abouts as $about)
                    <x-ui.accordion
                        title="{{ $about->title }}"
                        content="{{ $about->content }}"
                    />
                @endforeach
            </div>
        </div>
    </div>
</section>
