<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\ResepController; // ⬅️ tambahkan ini


Route::get('/', [ResepController::class, 'index'])->name('home');


Route::middleware('auth')->group(function () {

    Route::post('/resep/{id}/like', [LikeController::class, 'toggle'])->name('resep.like');


    Route::post('/resep/{id}/komentar', [KomentarController::class, 'store'])->name('resep.komentar.store');


    Route::delete('/komentar/{id}', [KomentarController::class, 'destroy'])->name('komentar.destroy');
});
