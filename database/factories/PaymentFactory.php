<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\LeaseAgreement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
final class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'lease_id' => LeaseAgreement::factory(),
            'payment_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'payment_amount' => $this->faker->numberBetween(500, 5000),
            'payment_method' => $this->faker->randomElement(['Cash', 'Card', 'Bank Transfer']),
        ];
    }
}
