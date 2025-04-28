<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
final class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'icon' => $this->faker->sentence,
            'label' => $this->faker->sentence,
            'link' => $this->faker->sentence,
            'link_text' => $this->faker->sentence,
            'section' => $this->faker->randomElement(['footer', 'contact', 'all']),
        ];
    }
}
