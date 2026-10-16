<?php

namespace Database\Factories;

use App\Models\Venue;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Venue>
 */
class VenueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company().' Hall',
            'address' => fake()->streetAddress(),
            'city' => fake()->randomElement(['Cairo', 'Giza', 'Alexandria', 'Mansoura']),
            'capacity' => fake()->numberBetween(100, 5000),
        ];
    }
}
