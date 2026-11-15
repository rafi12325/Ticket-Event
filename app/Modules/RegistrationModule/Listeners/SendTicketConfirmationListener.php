<?php

namespace App\Modules\RegistrationModule\Listeners;

use App\Modules\RegistrationModule\Events\TicketPurchased;
use Illuminate\Support\Facades\Log;

class SendTicketConfirmationListener
{
    // Untuk UTS: cukup log. Bisa dikembangkan jadi kirim email/notifikasi.
    public function handle(TicketPurchased $event): void
    {
        Log::info('Tiket berhasil dibeli', [
            'unique_code' => $event->registration->unique_code,
            'quantity' => $event->registration->quantity,
        ]);
    }
}
