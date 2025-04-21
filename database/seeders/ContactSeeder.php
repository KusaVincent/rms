<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contact::create([
            'icon' => 'phone',
            'label' => 'Phone Number',
            'link' => 'tel:+254798749323',
            'link_text' => '+2547 98 749 323',
        ]);

        Contact::create([
            'icon' => 'envelope',
            'label' => 'Email Address',
            'link' => 'mailto:info@rentalskonekt.com',
            'link_text' => 'info@rentalskonekt.com',
        ]);


        Contact::create([
            'icon' => 'envelope',
            'label' => 'Support Email Address',
            'link' => 'mailto:support@rentalskonekt.com',
            'link_text' => 'support@rentalskonekt.com',
        ]);

        Contact::create([
            'icon' => 'whatsapp',
            'label' => 'WhatsApp Contacts',
            'link' => 'https://wa.me/+254798749323',
            'link_text' => '+2547 98 749 323',
        ]);
    }
}
