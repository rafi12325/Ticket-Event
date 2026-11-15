<?php

use App\Modules\RegistrationModule\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->middleware('api')->group(function () {
    // Participant only
    Route::middleware(['auth:sanctum', 'role:participant'])->group(function () {
        Route::post('/registrations', [RegistrationController::class, 'purchase']);
        Route::get('/registrations', [RegistrationController::class, 'index']);
        Route::post('/profile', [RegistrationController::class, 'updateProfile']);
    });

    // Admin only
    Route::get('/admin/registrations', [RegistrationController::class, 'all'])
        ->middleware(['auth:sanctum', 'role:admin']);
});
