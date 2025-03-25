<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\PropertyType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'property_type_id' => PropertyType::inRandomOrder()->first()->id,
            'location_id' => Location::inRandomOrder()->first()->id ?? Location::factory(),
            'property_name' => $this->faker->words(3, true),
            'description' => $this->faker->paragraph(),
            'property_image' => 'prop.jpg',
            'rent' => $this->faker->numberBetween(15000, 500000),
            'deposit' => $this->faker->numberBetween(15000, 500000),
            'availability' => $this->faker->boolean(),
        ];
    }
}
