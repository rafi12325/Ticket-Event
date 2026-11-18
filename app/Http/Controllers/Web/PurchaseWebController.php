<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Modules\RegistrationModule\Contracts\RegistrationServiceInterface;
use App\Modules\RegistrationModule\Http\Requests\PurchaseTicketRequest;
use App\Modules\TicketModule\Exceptions\QuotaExceededException;
use App\Modules\TicketModule\Exceptions\TicketSoldOutException;

// Membeli tiket dari halaman web.
// Custom Exception ditangkap di sini dan ditampilkan sebagai pesan
// informatif di View (syarat soal: pesan error informatif di View).
class PurchaseWebController extends Controller
{
    public function __construct(private readonly RegistrationServiceInterface $service) {}

    public function store(PurchaseTicketRequest $request, string $slug)
    {
        try {
            $registration = $this->service->purchase(
                $request->user(),
                (int) $request->ticket_id,
                (int) $request->quantity,
            );
        } catch (TicketSoldOutException | QuotaExceededException $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }

        return redirect()
            ->route('tickets.my')
            ->with('success', 'Pembelian berhasil! Kode tiketmu: '.$registration->unique_code);
    }
}
