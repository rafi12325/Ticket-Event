<?php

namespace App\Modules\EventModule\Contracts;

use App\Modules\EventModule\Models\Event;
use Illuminate\Support\Collection;

interface EventServiceInterface
{
    public function listPublic(): Collection;

    public function findPublic(string $slug): Event;

    public function create(array $data): Event;

    public function update(Event $event, array $data): Event;

    public function delete(Event $event): void;
}
