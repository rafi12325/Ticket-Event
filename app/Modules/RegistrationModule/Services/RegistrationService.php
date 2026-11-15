<?php

namespace App\Modules\RegistrationModule\Services;

use App\Models\User;
use App\Modules\RegistrationModule\Contracts\RegistrationServiceInterface;
use App\Modules\RegistrationModule\Events\TicketPurchased;
use App\Modules\RegistrationModule\Models\Participant;
use App\Modules\RegistrationModule\Models\Registration;
use App\Modules\TicketModule\Contracts\TicketServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RegistrationService implements RegistrationServiceInterface
{
    public function __construct(private readonly TicketServiceInterface $ticketService) {}

    public function purchase(User $user, int $ticketId, int $quantity): Registration
    {
        return DB::transaction(function () use ($user, $ticketId, $quantity) {
            $participant = Participant::query()->firstOrCreate(['user_id' => $user->id]);

            // Komunikasi antar modul via Contract — BUKAN akses model Ticket langsung
            $ticket = $this->ticketService->decreaseQuota($ticketId, $quantity);

            $registration = Registration::create([
                'participant_id' => $participant->id,
                'ticket_id' => $ticket->id,
                'quantity' => $quantity,
                'unique_code' => $this->generateUniqueCode(),
                'status' => 'confirmed',
            ]);

            // Domain Event
            event(new TicketPurchased($registration));

            return $registration;
        });
        // Kalau TicketSoldOutException / QuotaExceededException terjadi
        // di tengah transaksi, DB::transaction otomatis rollback.
    }

    private function generateUniqueCode(): string
    {
        do {
            $code = 'EVT'.date('y').'-'.strtoupper(Str::random(4)).'-'.strtoupper(Str::random(4));
        } while (Registration::query()->where('unique_code', $code)->exists());

        return $code;
    }
}
