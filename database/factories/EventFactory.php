<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Support\Str;

/**
 * @extends Factory<Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(3);
        $startsAt = fake()->dateTimeBetween('+1 week', '+3 months');

        return [
            'organizer_id' => User::factory(),
            'venue_id' => Venue::factory(),
            'title' => $title,
            'slug' => Str::slug($title).'-'.Str::random(6),
            'description' => fake()->paragraph(),
            'starts_at' => $startsAt,
            'ends_at' => (clone $startsAt)->modify('+3 hours'),
            'status' => 'published',
        ];
    }
}
