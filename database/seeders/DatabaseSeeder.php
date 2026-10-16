<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\TicketType;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        // fixed demo accounts, so you (and reviewers) can log in
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ])->assignRole('admin');

        $organizer = User::factory()->create([
            'name' => 'Demo Organizer',
            'email' => 'organizer@example.com',
        ])->assignRole('organizer');

        User::factory()->create([
            'name' => 'Demo Attendee',
            'email' => 'attendee@example.com',
        ])->assignRole('attendee');

        // extra random users
        $organizers = User::factory(2)->create()
            ->each(fn ($u) => $u->assignRole('organizer'))
            ->push($organizer);

        User::factory(10)->create()->each(fn ($u) => $u->assignRole('attendee'));

        // venues, events and ticket types
        $venues = Venue::factory(3)->create();

        foreach ($organizers as $org) {
            Event::factory(2)
                ->for($org, 'organizer')
                ->state(fn () => ['venue_id' => $venues->random()->id])
                ->create()
                ->each(function (Event $event) {
                    TicketType::factory()->for($event)->create([
                        'name' => 'Regular', 'price_cents' => 30000, 'quantity_total' => 200,
                    ]);
                    TicketType::factory()->for($event)->create([
                        'name' => 'VIP', 'price_cents' => 80000, 'quantity_total' => 50,
                    ]);
                });
        }
    }
}