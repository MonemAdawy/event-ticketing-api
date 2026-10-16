<?php

namespace Database\Factories;

use App\Enums\BookingStatus;
use App\Models\Booking;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'event_id' => Event::factory(),
            'status' => BookingStatus::Pending,
            'total_cents' => fake()->numberBetween(1000, 50000),
            'expires_at' => now()->addMinutes(15),
            'payment_intent_id' => null,
            'idempotency_key' => (string) Str::uuid(),
            'confirmed_at' => null,
        ];
    }

    public function confirmed(): static
    {
        return $this->state(fn () => [
            'status' => BookingStatus::Confirmed,
            'payment_intent_id' => 'pi_'.Str::random(24),
            'expires_at' => null,
            'confirmed_at' => now(),
        ]);
    }
}
