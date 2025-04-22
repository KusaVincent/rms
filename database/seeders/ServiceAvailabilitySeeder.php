<?php

namespace Database\Seeders;

use App\Models\ServiceAvailability;
use Illuminate\Database\Seeder;

class ServiceAvailabilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ServiceAvailability::create([
            'service_key' => 'meet_the_team',
            'is_active' => false,
            'service_name' => 'Founder Module',
        ]);

        ServiceAvailability::create([
            'service_key' => 'starts',
            'is_active' => false,
            'service_name' => 'company starts',
        ]);
    }
}
