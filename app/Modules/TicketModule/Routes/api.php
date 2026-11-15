<?php

use App\Modules\TicketModule\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->middleware('api')->group(function () {
    // Public
    Route::get('/events/{event:slug}/tickets', [TicketController::class, 'index']);

    // Admin only
    Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
        Route::post('/events/{event:slug}/tickets', [TicketController::class, 'store']);
        Route::put('/tickets/{ticket}', [TicketController::class, 'update']);
        Route::delete('/tickets/{ticket}', [TicketController::class, 'destroy']);
    });
});
