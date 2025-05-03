<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\PropertyMedia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertyMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Property::all()->each(function ($property) {
            PropertyMedia::factory()->create([
                'property_id' => $property->id,
            ]);
        });
    }
}
