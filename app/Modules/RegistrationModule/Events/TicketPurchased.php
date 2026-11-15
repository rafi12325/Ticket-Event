<?php

namespace App\Modules\RegistrationModule\Events;

use App\Modules\RegistrationModule\Models\Registration;

// Domain Event: dipancarkan setelah pembelian tiket sukses
class TicketPurchased
{
    public function __construct(public readonly Registration $registration) {}
}
