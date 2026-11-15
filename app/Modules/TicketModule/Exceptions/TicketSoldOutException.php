<?php

namespace App\Modules\TicketModule\Exceptions;

use App\Modules\TicketModule\Models\Ticket;
use Exception;

// Custom Exception #1: dipakai saat kuota tiket sudah habis
class TicketSoldOutException extends Exception
{
    public function __construct(public readonly Ticket $ticket)
    {
        parent::__construct("Maaf, kuota tiket '{$ticket->name}' untuk event ini sudah habis.");
    }

    public function render($request)
    {
        return response()->json([
            'message' => $this->getMessage(),
            'error' => 'TICKET_SOLD_OUT',
        ], 422);
    }
}
