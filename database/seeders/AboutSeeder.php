<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::create([
            'title' => 'Impeccable Customer Service',
            'content' => 'At Rentals Konekt, we have 24-hour customer service agents ready to answer any questions you might have. Feel free to contact us for assistance.',
        ]);

        About::create([
            'title' => 'Wide Coverage',
            'content' => 'Rentals Konekt ensures everyone finds suitable housing and that all landlords/agents can connect with tenants nationwide.',
        ]);

        About::create([
            'title'  =>"Honesty and Integrity",
            'content' => "We are devoted to being trustworthy and reliable, always delivering the best services in an honest manner."
        ]);

        About::create([
            'title' => "Client-Oriented Commitment",
            'content' => "At Rentals Konekt, our clients' needs come first. We strive to keep their interests above all else."
        ]);
    }
}
