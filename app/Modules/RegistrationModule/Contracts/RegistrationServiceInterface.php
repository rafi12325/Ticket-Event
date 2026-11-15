<?php

namespace App\Modules\RegistrationModule\Contracts;

use App\Models\User;
use App\Modules\RegistrationModule\Models\Registration;

interface RegistrationServiceInterface
{
    public function purchase(User $user, int $ticketId, int $quantity): Registration;
}
