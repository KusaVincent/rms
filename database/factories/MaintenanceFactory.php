<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Maintenance;
use App\Models\Property;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Maintenance>
 */
final class MaintenanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'property_id' => Property::factory(),
            'tenant_id' => Tenant::factory(),
            'description' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['Pending', 'In Progress', 'Completed']),
            'request_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'completion_date' => $this->faker->boolean(50) ? $this->faker->dateTimeBetween('now', '+1 month') : null,
        ];
    }
}
