<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Shared\Contracts\EventServiceInterface;
use App\Shared\Contracts\TicketServiceInterface;

// Controller untuk halaman Blade (public).
// Masih memakai Contract modul — konsisten dengan API, bukan akses model langsung.
class EventWebController extends Controller
{
    public function __construct(
        private readonly EventServiceInterface $eventService,
        private readonly TicketServiceInterface $ticketService,
    ) {}

    public function index()
    {
        return view('events.index', [
            'events' => $this->eventService->listPublic(),
        ]);
    }

    public function show(string $slug)
    {
        $event = $this->eventService->findPublic($slug);

        return view('events.show', [
            'event' => $event,
            'tickets' => $this->ticketService->forEvent($event),
        ]);
    }
}
