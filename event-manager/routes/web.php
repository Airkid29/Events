<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('events.index');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Public Event Routes
Route::get('/events', [\App\Http\Controllers\EventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [\App\Http\Controllers\EventController::class, 'show'])->name('events.show');

Route::middleware('auth')->group(function () {
    Route::post('/events/{event}/reserve', [\App\Http\Controllers\ReservationController::class, 'store'])->name('events.reserve');
    
    // Protected Event Routes (Create, Store, Edit, Update, Destroy)
    Route::get('/events/create', [\App\Http\Controllers\EventController::class, 'create'])->name('events.create');
    Route::post('/events', [\App\Http\Controllers\EventController::class, 'store'])->name('events.store');
    Route::get('/events/{event}/edit', [\App\Http\Controllers\EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [\App\Http\Controllers\EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{event}', [\App\Http\Controllers\EventController::class, 'destroy'])->name('events.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
