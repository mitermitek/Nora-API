<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Photo>
 */
class PhotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'path' => $this->faker->imageUrl(),
            'caption' => $this->faker->optional(0.7)->sentence(),
            'street_address' => $this->faker->optional(0.7)->streetAddress(),
            'postal_code' => $this->faker->optional(0.7)->postcode(),
            'city' => $this->faker->optional(0.7)->city(),
            'country' => $this->faker->optional(0.7)->country(),
        ];
    }
}
