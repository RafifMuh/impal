<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\KomentarController;
use Illuminate\Support\Facades\Route;



// Halaman utama langsung ke feed resep
Route::get('/', [ResepController::class, 'index'])->name('home');

// Dashboard diarahkan ke halaman utama
Route::get('/dashboard', [ResepController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Feed resep dapat diakses semua pengunjung
Route::get('/feed', [ResepController::class, 'index'])->name('feed');

// Grup route yang memerlukan login
Route::middleware('auth')->group(function () {
    // CRUD Resep
    Route::get('/resep/create', [ResepController::class, 'create'])->name('resep.create');
    Route::post('/resep', [ResepController::class, 'store'])->name('resep.store');
    Route::get('/resep/{id}', [ResepController::class, 'show'])->name('resep.show');
    Route::get('/resep/{id}/edit', [ResepController::class, 'edit'])->name('resep.edit');
    Route::put('/resep/{id}', [ResepController::class, 'update'])->name('resep.update');
    Route::delete('/resep/{id}', [ResepController::class, 'destroy'])->name('resep.destroy');

    // FITUR LIKE & KOMENTAR
    Route::post('/resep/{id}/like', [LikeController::class, 'store'])->name('resep.like');
    Route::post('/resep/{id}/komentar', [KomentarController::class, 'store'])->name('resep.komentar');

    // Profil pengguna (bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
