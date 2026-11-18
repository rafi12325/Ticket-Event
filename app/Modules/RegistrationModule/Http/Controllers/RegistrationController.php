<?php

namespace App\Modules\RegistrationModule\Http\Controllers;

use App\Modules\RegistrationModule\Contracts\RegistrationServiceInterface;
use App\Modules\RegistrationModule\Http\Requests\PurchaseTicketRequest;
use App\Modules\RegistrationModule\Http\Requests\RegisterParticipantRequest;
use App\Modules\RegistrationModule\Models\Participant;
use App\Modules\RegistrationModule\Models\Registration;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function __construct(private readonly RegistrationServiceInterface $service) {}

    // Participant: beli tiket (DB::transaction + validasi kuota di sini)
    public function purchase(PurchaseTicketRequest $request): JsonResponse
    {
        $registration = $this->service->purchase(
            $request->user(),
            (int) $request->ticket_id,
            (int) $request->quantity,
        );

        return response()->json([
            'message' => 'Pembelian tiket berhasil!',
            'data' => $registration->load('ticket.event', 'participant'),
        ], 201);
    }

    // Participant: daftar tiket miliknya
    public function index(Request $request): JsonResponse
    {
        $participant = $request->user()->participant;

        $registrations = $participant
            ? $participant->registrations()->with('ticket.event')->latest()->get()
            : collect();

        return response()->json(['data' => $registrations]);
    }

    // Admin: semua registrasi
    public function all(): JsonResponse
    {
        return response()->json(['data' => $this->service->allForAdmin()]);
    }

    // Participant: lengkapi profil
    public function updateProfile(RegisterParticipantRequest $request): JsonResponse
    {
        $participant = Participant::query()->updateOrCreate(
            ['user_id' => $request->user()->id],
            $request->validated(),
        );

        return response()->json(['data' => $participant]);
    }
}
