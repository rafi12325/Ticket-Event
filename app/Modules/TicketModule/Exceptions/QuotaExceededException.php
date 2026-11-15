<?php

namespace App\Modules\TicketModule\Exceptions;

use App\Modules\TicketModule\Models\Ticket;
use Exception;

// Custom Exception #2: dipakai saat jumlah beli melebihi sisa kuota
class QuotaExceededException extends Exception
{
    public function __construct(
        public readonly Ticket $ticket,
        public readonly int $remaining,
    ) {
        parent::__construct("Sisa kuota tiket '{$ticket->name}' hanya {$remaining} tiket.");
    }

    public function render($request)
    {
        return response()->json([
            'message' => $this->getMessage(),
            'error' => 'QUOTA_EXCEEDED',
            'remaining' => $this->remaining,
        ], 422);
    }
}
