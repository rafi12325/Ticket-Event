<?php

namespace App\Shared\Contracts;

use App\Models\User;
use App\Modules\RegistrationModule\Models\Registration;
use Illuminate\Support\Collection;

interface RegistrationServiceInterface
{
    public function purchase(User $user, int $ticketId, int $quantity): Registration;

    public function allForAdmin(): Collection;
}
