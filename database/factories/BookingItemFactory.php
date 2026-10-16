<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\BookingItem;
use App\Models\TicketType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BookingItem>
 */
class BookingItemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'booking_id' => Booking::factory(),
            'ticket_type_id' => TicketType::factory(),
            'quantity' => fake()->numberBetween(1, 4),
            'unit_price_cents' => fn (array $attributes) =>
                TicketType::find($attributes['ticket_type_id'])->price_cents,
        ];
    }
}