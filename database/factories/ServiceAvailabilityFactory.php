<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceAvailability>
 */
class ServiceAvailabilityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'service_key' => $this->faker->unique()->slug,
            'service_name' => $this->faker->words(3, true),
            'is_active' => $this->faker->boolean(80),
        ];
    }
}
