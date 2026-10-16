<?php

namespace Database\Factories;

use App\Enums\TicketStatus;
use App\Models\BookingItem;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Ticket>
 */
class TicketFactory extends Factory
{
    public function definition(): array
    {
        return [
            'booking_item_id' => BookingItem::factory(),
            'code' => strtoupper(Str::random(12)),
            'status' => TicketStatus::Valid,
            'checked_in_at' => null,
            'pdf_path' => null,
        ];
    }

    public function used(): static
    {
        return $this->state(fn () => [
            'status' => TicketStatus::Used,
            'checked_in_at' => now(),
        ]);
    }
}