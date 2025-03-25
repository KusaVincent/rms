<?php

namespace Database\Seeders;

use App\Models\PropertyType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $propertyTypes = [
            ['type_name' => 'Studio'],
            ['type_name' => 'Apartment'],
            ['type_name' => 'Bungalow'],
            ['type_name' => 'Mansion'],
            ['type_name' => 'Townhouse'],
        ];

        foreach ($propertyTypes as $type) {
            PropertyType::firstOrCreate(['type_name' => $type['type_name']]);
        }
    }
}
