<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;

// Página principal redirige al index de préstamos
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Dashboard protegido por autenticación y verificación
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {
    Route::resource('loans', LoanController::class);
    Route::resource('books', BookController::class);
    // Puedes agregar aquí rutas de perfil si las necesitas
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/loans/{loan}/return', [App\Http\Controllers\LoanController::class, 'return'])->name('loans.return');
});

require __DIR__.'/auth.php';
