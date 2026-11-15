<?php

namespace App\Modules\TicketModule\Database\Factories;

use App\Modules\TicketModule\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition(): array
    {
        return [
            'event_id' => \App\Modules\EventModule\Models\Event::factory(),
            'name' => fake()->randomElement(['VIP', 'Reguler', 'Early Bird']),
            'price' => fake()->randomElement([50000, 75000, 150000, 250000]),
            'quota' => fake()->randomElement([50, 100, 150]),
            'sold' => 0,
        ];
    }
}
