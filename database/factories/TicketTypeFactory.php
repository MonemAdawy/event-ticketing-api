<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\TicketType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TicketType>
 */
class TicketTypeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'event_id' => Event::factory(),
            'name' => fake()->randomElement(['Regular', 'VIP', 'Early Bird', 'Student']),
            'price_cents' => fake()->numberBetween(100, 2000) * 100,
            'currency' => 'EGP',
            'quantity_total' => fake()->numberBetween(50, 500),
            'quantity_sold' => 0,
            'quantity_held' => 0,
            'max_per_order' => 10,
            'sales_start_at' => now()->subDay(),
            'sales_end_at' => now()->addMonth(),
        ];
    }

    public function soldOut(): static
    {
        return $this->state(fn (array $attributes) => [
            'quantity_sold' => $attributes['quantity_total'],
        ]);
    }
}
