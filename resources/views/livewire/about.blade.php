<section class="about-us content-area-8 bg-white py-16">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
        <!-- Image Section -->
        <div class="flex justify-center">
            <img src="{{ asset('storage/about.png') }}" alt="admin" class="w-full max-w-md rounded-lg shadow-lg">
        </div>

        <!-- Accordion Section -->
        <div class="flex flex-col justify-center">
            <h3 class="text-2xl font-bold mb-4">Why Choose Us?</h3>
            <div class="faq-accordion space-y-4">
                <x-ui.accordion
                    title="Impeccable Customer Service"
                    content="At Rentals Konekt, we have 24-hour customer service agents ready to answer any questions you might have. Feel free to contact us for assistance."
                />
                <x-ui.accordion
                    title="Wide Coverage"
                    content="Rentals Konekt ensures everyone finds suitable housing and that all landlords/agents can connect with tenants nationwide."
                />
                <x-ui.accordion
                    title="Honesty and Integrity"
                    content="We are devoted to being trustworthy and reliable, always delivering the best services in an honest manner."
                />
                <x-ui.accordion
                    title="Client-Oriented Commitment"
                    content="At Rentals Konekt, our clients' needs come first. We strive to keep their interests above all else."
                />
            </div>
        </div>
    </div>
</section>
