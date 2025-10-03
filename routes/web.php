<?php

use App\Http\Controllers\AvaliacaoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/login');
})->name('raiz');

Route::get('registerUser', function () {
    return view('auth/registerUser');
})->name('registerUser');

Route::middleware(['auth'])->group(function() {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::get('musicas', function () {
        return view('usuario/musicas');
    })->name('musicas');

    Route::get('suasAvaliacoes', function () {
        return view('usuario/suasAvaliacoes');
    })->name('suasAvaliacoes');

    // Administrador 
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::resource('generos', App\Http\Controllers\GeneroController::class);
    Route::resource('musicas', App\Http\Controllers\MusicaController::class);
    Route::resource('artistas', App\Http\Controllers\ArtistaController::class);
    Route::resource('avaliacoes', App\Http\Controllers\AvaliacaoController::class);
    Route::get('/suasAvaliacoes', [AvaliacaoController::class, 'suasAvaliacoes'])->name('avaliacoes.suasAvaliacoes');

});
