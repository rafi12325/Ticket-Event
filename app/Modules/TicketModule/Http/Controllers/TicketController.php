<?php

namespace App\Modules\TicketModule\Http\Controllers;

use App\Modules\EventModule\Models\Event;
use App\Shared\Contracts\TicketServiceInterface;
use App\Modules\TicketModule\Http\Requests\StoreTicketRequest;
use App\Modules\TicketModule\Models\Ticket;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class TicketController extends Controller
{
    public function __construct(private readonly TicketServiceInterface $service) {}

    // Public: daftar tiket untuk 1 event
    public function index(Event $event): JsonResponse
    {
        return response()->json(['data' => $this->service->forEvent($event)]);
    }

    // Admin only
    public function store(Event $event, StoreTicketRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['event_id'] = $event->id;

        return response()->json(['data' => $this->service->create($data)], 201);
    }

    public function update(Ticket $ticket, StoreTicketRequest $request): JsonResponse
    {
        return response()->json(['data' => $this->service->update($ticket, $request->validated())]);
    }

    public function destroy(Ticket $ticket): JsonResponse
    {
        $this->service->delete($ticket);

        return response()->json(['message' => 'Tiket berhasil dihapus.'], 200);
    }
}
