<?php

namespace App\Modules\TicketModule\Database\Seeders;

use App\Modules\EventModule\Models\Event;
use App\Modules\TicketModule\Models\Ticket;
use Illuminate\Database\Seeder;

class TicketModuleSeeder extends Seeder
{
    public function run(): void
    {
        Event::query()->get()->each(function (Event $event) {
            Ticket::factory()->count(2)->create(['event_id' => $event->id]);
        });
    }
}
