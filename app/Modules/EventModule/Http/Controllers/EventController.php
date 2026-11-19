<?php

namespace App\Modules\EventModule\Http\Controllers;

use App\Shared\Contracts\EventServiceInterface;
use App\Modules\EventModule\Http\Requests\StoreEventRequest;
use App\Modules\EventModule\Http\Requests\UpdateEventRequest;
use App\Modules\EventModule\Models\Event;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class EventController extends Controller
{
    public function __construct(private readonly EventServiceInterface $service) {}

    // Public
    public function index(): JsonResponse
    {
        return response()->json(['data' => $this->service->listPublic()]);
    }

    public function show(string $slug): JsonResponse
    {
        return response()->json(['data' => $this->service->findPublic($slug)]);
    }

    // Admin only
    public function store(StoreEventRequest $request): JsonResponse
    {
        return response()->json(['data' => $this->service->create($request->validated())], 201);
    }

    public function update(UpdateEventRequest $request, Event $event): JsonResponse
    {
        return response()->json(['data' => $this->service->update($event, $request->validated())]);
    }

    public function destroy(Event $event): JsonResponse
    {
        $this->service->delete($event);

        return response()->json(['message' => 'Event berhasil dihapus.'], 200);
    }
}
