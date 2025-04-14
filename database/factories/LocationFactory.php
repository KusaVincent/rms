<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
final class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'address' => $this->faker->streetAddress(),
            'town_city' => $this->faker->city(),
            'area' => $this->faker->state(),
            'map' => 'https://maps.google.com/maps?q=YSwWEGPsnrsZZ3pi6&z=15&output=embed',
        ];
    }
}
