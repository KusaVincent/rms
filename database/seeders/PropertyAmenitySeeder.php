<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Property;
use App\Models\PropertyAmenity;
use Illuminate\Database\Seeder;

final class PropertyAmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Property::all()->each(function ($property) {
            \App\Models\Amenity::inRandomOrder()
                ->take(fake()->numberBetween(1, 5)) // Randomly select 1-5 amenities
                ->pluck('id')
                ->each(function ($amenityId) use ($property) {
                    PropertyAmenity::create([
                        'property_id' => $property->id,
                        'amenity_id' => $amenityId,
                    ]);
                });
        });
    }
}
