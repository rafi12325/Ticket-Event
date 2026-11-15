<?php

namespace App\Modules\EventModule\Services;

use App\Modules\EventModule\Contracts\EventServiceInterface;
use App\Modules\EventModule\Models\Event;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class EventService implements EventServiceInterface
{
    public function listPublic(): Collection
    {
        return Event::query()->with('category')->orderBy('event_date')->get();
    }

    public function findPublic(string $slug): Event
    {
        return Event::query()->with('category')->where('slug', $slug)->firstOrFail();
    }

    public function create(array $data): Event
    {
        $data['slug'] = Str::slug($data['title']).'-'.Str::lower(Str::random(4));

        return Event::create($data);
    }

    public function update(Event $event, array $data): Event
    {
        $event->update($data);

        return $event->refresh();
    }

    public function delete(Event $event): void
    {
        $event->delete();
    }
}
