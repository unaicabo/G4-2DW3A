<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
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



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //admin panel
    Route::get('/admin', [ProfileController::class, 'admin'])->name('admin');
    Route::get('/admin/usuarios', [AdminController::class, 'usuarios'])->name('admin.users');
    Route::post('/admin/usuarios/rol', [AdminController::class, 'changeRol'])->name('admin.user.rol');
    Route::post('/admin/usuarios/delete', [AdminController::class, 'deleteUser'])->name('admin.user.delete');
    Route::get('/admin/partidas', [AdminController::class, 'partidas'])->name('admin.partidas');
    Route::post('/admin/partidas/delete', [AdminController::class, 'deletePartida'])->name('admin.partida.delete');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/webViejo.php';
