<?php

namespace App\Modules\TicketModule\Contracts;

use App\Modules\EventModule\Models\Event;
use App\Modules\TicketModule\Models\Ticket;
use Illuminate\Support\Collection;

interface TicketServiceInterface
{
    public function forEvent(Event $event): Collection;

    public function decreaseQuota(int $ticketId, int $quantity): Ticket;

    public function create(array $data): Ticket;

    public function update(Ticket $ticket, array $data): Ticket;

    public function delete(Ticket $ticket): void;
}
