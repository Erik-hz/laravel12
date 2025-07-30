<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PublicacionController;

// Página de inicio
Route::get('/', function () {
    return view('welcome');
});

// Panel de usuario autenticado
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Perfil del usuario
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas de autenticación
require __DIR__.'/auth.php';

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {
    // CRUD para usuarios
    Route::resource('usuarios', UsuarioController::class);

    // CRUD para publicaciones
    Route::resource('publicaciones', PublicacionController::class);

    // Ruta adicional para cambiar estado de publicación
    Route::post('/publicaciones/{id}/estado', [PublicacionController::class, 'cambiarEstado'])->name('publicaciones.estado');
});
Route::get('/publicaciones/papelera', [PublicacionController::class, 'papelera'])->middleware('auth');
Route::post('/publicaciones/{id}/restaurar', [PublicacionController::class, 'restaurar'])->middleware('auth');
