<section class="bg-gray-100 py-16">
    <div class="container mx-auto">
        <div class="text-center mb-10">
            <h3 class="text-3xl font-semibold">Contact Us</h3>
            <p class="text-gray-600">Feel Free To Drop Us A Line Via Your Preferred Choice</p>
        </div>

        <div class="flex flex-wrap">
            <x-contact.contact-form />
            <x-contact.contact-info :contacts="$contacts"/>
        </div>
    </div>
</section>
