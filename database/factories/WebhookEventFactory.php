<?php

namespace Database\Factories;

use App\Models\WebhookEvent;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<WebhookEvent>
 */
class WebhookEventFactory extends Factory
{
    public function definition(): array
    {
        return [
            'provider' => 'stripe',
            'provider_event_id' => 'evt_'.Str::random(24),
            'payload' => ['type' => 'payment_intent.succeeded'],
            'processed_at' => null,
        ];
    }

    public function processed(): static
    {
        return $this->state(fn () => ['processed_at' => now()]);
    }
}