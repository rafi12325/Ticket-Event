<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Halaman "Tiket Saya" untuk participant
class MyTicketsController extends Controller
{
    public function index(Request $request)
    {
        $participant = $request->user()->participant;

        $registrations = $participant
            ? $participant->registrations()->with('ticket.event')->latest()->get()
            : collect();

        return view('registrations.index', [
            'registrations' => $registrations,
        ]);
    }
}
