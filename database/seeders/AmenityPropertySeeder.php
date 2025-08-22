<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Amenity;
use App\Models\AmenityProperty;
use App\Models\Property;
use Illuminate\Database\Seeder;

final class AmenityPropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Property::all()->each(function ($property) {
            Amenity::inRandomOrder()
                ->take(fake()->numberBetween(1, 5))
                ->pluck('id')
                ->each(function ($amenityId) use ($property) {
                    AmenityProperty::create([
                        'property_id' => $property->id,
                        'amenity_id' => $amenityId,
                    ]);
                });
        });
    }
}
