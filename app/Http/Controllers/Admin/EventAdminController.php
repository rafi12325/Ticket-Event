<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Shared\Contracts\EventServiceInterface;
use App\Modules\EventModule\Http\Requests\StoreEventRequest;
use App\Modules\EventModule\Http\Requests\UpdateEventRequest;
use App\Modules\EventModule\Models\Event;
use App\Modules\EventModule\Models\EventCategory;

class EventAdminController extends Controller
{
    public function __construct(private readonly EventServiceInterface $service) {}

    public function index()
    {
        return view('admin.events.index', [
            'events' => Event::query()->with('category')->latest()->get(),
        ]);
    }

    public function create()
    {
        return view('admin.events.create', [
            'categories' => EventCategory::query()->orderBy('name')->get(),
        ]);
    }

    public function store(StoreEventRequest $request)
    {
        $this->service->create($request->validated());

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Acara berhasil dibuat.');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', [
            'event' => $event,
            'categories' => EventCategory::query()->orderBy('name')->get(),
        ]);
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $this->service->update($event, $request->validated());

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Acara berhasil diperbarui.');
    }

    public function destroy(Event $event)
    {
        $this->service->delete($event);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Acara berhasil dihapus.');
    }
}
