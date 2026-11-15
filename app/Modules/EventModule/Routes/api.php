<?php

use App\Modules\EventModule\Http\Controllers\EventCategoryController;
use App\Modules\EventModule\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->middleware('api')->group(function () {
    // Public
    Route::get('/events', [EventController::class, 'index']);
    Route::get('/events/{event:slug}', [EventController::class, 'show']);
    Route::get('/event-categories', [EventCategoryController::class, 'index']);

    // Admin only (Sanctum + RBAC)
    Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
        Route::apiResource('/events', EventController::class)->except(['index', 'show']);
        Route::apiResource('/event-categories', EventCategoryController::class)->except(['index', 'show']);
    });
});
