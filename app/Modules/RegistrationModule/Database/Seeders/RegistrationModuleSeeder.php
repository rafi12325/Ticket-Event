<?php

namespace App\Modules\RegistrationModule\Database\Seeders;

use App\Modules\RegistrationModule\Database\Factories\ParticipantFactory;
use App\Modules\RegistrationModule\Database\Factories\RegistrationFactory;
use App\Modules\TicketModule\Models\Ticket;
use Illuminate\Database\Seeder;

class RegistrationModuleSeeder extends Seeder
{
    public function run(): void
    {
        $participants = ParticipantFactory::new()->count(5)->create();

        Ticket::query()->inRandomOrder()->take(6)->get()->each(function (Ticket $ticket) use ($participants) {
            RegistrationFactory::new()->create([
                'participant_id' => $participants->random()->id,
                'ticket_id' => $ticket->id,
            ]);
        });

        // Sinkronkan kolom sold dengan data dummy
        Ticket::query()->with('registrations')->get()->each(function (Ticket $ticket) {
            $ticket->update(['sold' => $ticket->registrations->where('status', 'confirmed')->sum('quantity')]);
        });
    }
}
