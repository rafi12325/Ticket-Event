<?php

namespace App\Modules\RegistrationModule\Database\Factories;

use App\Modules\RegistrationModule\Models\Registration;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RegistrationFactory extends Factory
{
    protected $model = Registration::class;

    public function definition(): array
    {
        return [
            'participant_id' => \App\Modules\RegistrationModule\Models\Participant::factory(),
            'ticket_id' => \App\Modules\TicketModule\Models\Ticket::factory(),
            'quantity' => fake()->numberBetween(1, 3),
            'unique_code' => 'EVT'.date('y').'-'.strtoupper(Str::random(4)).'-'.strtoupper(Str::random(4)),
            'status' => 'confirmed',
        ];
    }
}
