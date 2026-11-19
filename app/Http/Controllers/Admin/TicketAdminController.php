<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Modules\EventModule\Models\Event;
use App\Shared\Contracts\TicketServiceInterface;
use App\Modules\TicketModule\Http\Requests\StoreTicketRequest;
use App\Modules\TicketModule\Models\Ticket;

class TicketAdminController extends Controller
{
    public function __construct(private readonly TicketServiceInterface $service) {}

    // Daftar tiket milik 1 event
    public function index(Event $event)
    {
        return view('admin.tickets.index', [
            'event' => $event,
            'tickets' => $this->service->forEvent($event),
        ]);
    }

    public function create(Event $event)
    {
        return view('admin.tickets.create', ['event' => $event]);
    }

    public function store(Event $event, StoreTicketRequest $request)
    {
        $data = $request->validated();
        $data['event_id'] = $event->id;

        $this->service->create($data);

        return redirect()
            ->route('admin.events.tickets.index', $event->slug)
            ->with('success', 'Tiket berhasil dibuat.');
    }

    public function edit(Ticket $ticket)
    {
        return view('admin.tickets.edit', [
            'ticket' => $ticket->load('event'),
        ]);
    }

    public function update(Ticket $ticket, StoreTicketRequest $request)
    {
        $this->service->update($ticket, $request->validated());

        return redirect()
            ->route('admin.events.tickets.index', $ticket->event->slug)
            ->with('success', 'Tiket berhasil diperbarui.');
    }

    public function destroy(Ticket $ticket)
    {
        $eventSlug = $ticket->event->slug;
        $this->service->delete($ticket);

        return redirect()
            ->route('admin.events.tickets.index', $eventSlug)
            ->with('success', 'Tiket berhasil dihapus.');
    }
}
