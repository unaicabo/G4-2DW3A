<?php

use App\Http\Controllers\PartidaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JuegoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Index
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rankings
Route::get('/rankings', [PartidaController::class, 'rankings'])->name('partidas.rankings');
Route::get('/rankings/{pagina}', [PartidaController::class, 'rankings_pagina'])->name('partidas.paginate');
Route::get('/rankings/filtro/{dificultad}/{pagina}', [PartidaController::class, 'rankings_dificultad'])->name('partidas.dificultad');

// Index Juego
Route::post('/juego', [JuegoController::class, 'index'])->name('juegos.index');

Route::get('/finalJuego', [JuegoController::class, 'finalJuego'])->name('juegos.finalJuego');
Route::get('/JuegoPerdido', [JuegoController::class, 'juegoPerdido'])->name('juegos.juegoPerdido');

// Juego Motor
// Route::get('/juego/aerogenerador', [JuegoController::class, 'juego4'])->name('juegos.aerogenerador');
// Route::get('/juego/motor', [JuegoController::class, 'juego4_2'])->name('juegos.motor');

// Juego Sala de control
// Route::get('/juego/SalaControl', [JuegoController::class, 'juego3'])->name('juegos.salaControl');

// Juego Almacén
// Route::get('/juego/almacen', [JuegoController::class, 'juego2'])->name('juegos.almacen');

// Juego Roca
// Route::get('/juego/roca', [JuegoController::class, 'juego1'])->name('juegos.roca');

//Guardar Resultado
Route::post('/juego/store', [PartidaController::class, 'store'])->name('partidas.store');

// Change Language
Route::post('/change_language', [HomeController::class, 'change_language'])->name('change_language');
