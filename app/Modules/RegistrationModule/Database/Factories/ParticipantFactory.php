<?php

namespace App\Modules\RegistrationModule\Database\Factories;

use App\Modules\RegistrationModule\Models\Participant;
use Illuminate\Database\Eloquent\Factories\Factory;

class ParticipantFactory extends Factory
{
    protected $model = Participant::class;

    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'phone' => fake('id_ID')->phoneNumber(),
            'address' => fake('id_ID')->address(),
        ];
    }
}
