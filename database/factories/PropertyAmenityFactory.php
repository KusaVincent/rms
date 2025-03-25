<?php

namespace Database\Factories;

use App\Models\Amenity;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PropertyAmenityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'property_id' => Property::factory(), // Replace with existing IDs if necessary
            'amenity_id' => Amenity::factory(),  // Replace with existing IDs if necessary
        ];
    }
}
