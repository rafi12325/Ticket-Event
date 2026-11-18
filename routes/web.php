<?php

use App\Http\Controllers\Admin\EventAdminController;
use App\Http\Controllers\Admin\RegistrationAdminController;
use App\Http\Controllers\Admin\TicketAdminController;
use App\Http\Controllers\Web\AuthWebController;
use App\Http\Controllers\Web\EventWebController;
use App\Http\Controllers\Web\MyTicketsController;
use App\Http\Controllers\Web\PurchaseWebController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('events.index'));

// Auth (session utk halaman Blade)
Route::get('/login', [AuthWebController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthWebController::class, 'login']);
Route::get('/register', [AuthWebController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthWebController::class, 'register']);
Route::post('/logout', [AuthWebController::class, 'logout'])->middleware('auth')->name('logout');

// Public
Route::get('/events', [EventWebController::class, 'index'])->name('events.index');
Route::get('/events/{event:slug}', [EventWebController::class, 'show'])->name('events.show');

// Participant (session auth via auth:sanctum + RBAC)
Route::middleware(['auth:sanctum', 'role:participant'])->group(function () {
    Route::post('/events/{event:slug}/purchase', [PurchaseWebController::class, 'store'])->name('purchase.store');
    Route::get('/my-tickets', [MyTicketsController::class, 'index'])->name('tickets.my');
});

// Admin (CRUD event & tiket, daftar registrasi)
Route::prefix('admin')->name('admin.')->middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::resource('events', EventAdminController::class);

    Route::get('events/{event:slug}/tickets', [TicketAdminController::class, 'index'])->name('events.tickets.index');
    Route::get('events/{event:slug}/tickets/create', [TicketAdminController::class, 'create'])->name('events.tickets.create');
    Route::post('events/{event:slug}/tickets', [TicketAdminController::class, 'store'])->name('events.tickets.store');
    Route::get('tickets/{ticket}/edit', [TicketAdminController::class, 'edit'])->name('tickets.edit');
    Route::put('tickets/{ticket}', [TicketAdminController::class, 'update'])->name('tickets.update');
    Route::delete('tickets/{ticket}', [TicketAdminController::class, 'destroy'])->name('tickets.destroy');

    Route::get('registrations', [RegistrationAdminController::class, 'index'])->name('registrations.index');
});
