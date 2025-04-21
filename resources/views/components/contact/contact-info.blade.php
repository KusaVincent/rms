@props(['contacts'])

<div class="w-full lg:w-5/12 mt-8 lg:mt-0 lg:pl-8">
    <div class="bg-white p-8 rounded-lg shadow-md">
        <h3 class="text-2xl font-semibold mb-4">Contact Info</h3>

        <ul class="space-y-4">
            @foreach($contacts as $contact)
                <x-contact.contact-item
                    icon="{{ $contact->icon }}"
                    label="{{ $contact->label }}"
                    link="{{ $contact->link }}"
                    linkText="{{ $contact->link_text }}"
                />
            @endforeach
        </ul>
    </div>
</div>
