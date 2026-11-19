<?php

namespace App\Modules\TicketModule\Services;

use App\Modules\EventModule\Models\Event;
use App\Shared\Contracts\TicketServiceInterface;
use App\Shared\Exceptions\QuotaExceededException;
use App\Shared\Exceptions\TicketSoldOutException;
use App\Modules\TicketModule\Models\Ticket;
use Illuminate\Support\Collection;

class TicketService implements TicketServiceInterface
{
    public function forEvent(Event $event): Collection
    {
        return Ticket::query()->where('event_id', $event->id)->orderBy('price')->get();
    }

    // Dipanggil dari RegistrationModule di dalam DB::transaction()
    // lockForUpdate() mencegah overselling saat 2 orang beli bersamaan
    public function decreaseQuota(int $ticketId, int $quantity): Ticket
    {
        $ticket = Ticket::query()->whereKey($ticketId)->lockForUpdate()->firstOrFail();

        $remaining = $ticket->remainingQuota();

        if ($remaining <= 0) {
            throw new TicketSoldOutException($ticket);
        }

        if ($quantity > $remaining) {
            throw new QuotaExceededException($ticket, $remaining);
        }

        $ticket->increment('sold', $quantity);

        return $ticket->refresh();
    }

    public function create(array $data): Ticket
    {
        return Ticket::create($data);
    }

    public function update(Ticket $ticket, array $data): Ticket
    {
        $ticket->update($data);

        return $ticket->refresh();
    }

    public function delete(Ticket $ticket): void
    {
        $ticket->delete();
    }
}
