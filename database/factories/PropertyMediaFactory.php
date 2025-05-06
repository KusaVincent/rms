<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Property;
use App\Models\PropertyMedia;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PropertyMedia>
 */
final class PropertyMediaFactory extends Factory
{
    protected array $images = ['prop.jpg', 'property.jpg'];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'video' => 'test-video.mp4',
            'property_id' => Property::factory(),
            'image_one' => fake()->randomElement($this->images),
            'image_two' => fake()->randomElement($this->images),
            'image_three' => fake()->randomElement($this->images),
            'image_four' => fake()->randomElement($this->images),
            'image_five' => fake()->randomElement($this->images),
        ];
    }
}
