<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Amenity;
use App\Models\Property;
use App\Models\PropertyAmenity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PropertyAmenity>
 */
final class PropertyAmenityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amenity_id' => Amenity::inRandomOrder()->first()->id ?? Amenity::factory(),
            'property_id' => Property::inRandomOrder()->first()->id ?? Property::factory(),
        ];
    }
}
