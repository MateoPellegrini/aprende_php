<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TemaController;
use App\Http\Controllers\Admin\TemaController as AdminTemaController;
use App\Http\Controllers\Admin\LeccionController as AdminLeccionController;
use App\Http\Controllers\Admin\EjercicioController as AdminEjercicioController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// User
Route::middleware('auth', 'verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/temas', [TemaController::class,'index'])->name('temas.index');
});

// Admin
Route::middleware(['auth','verified','can:admin'])
    ->prefix('admin')->name('admin.')
    ->group(function () {
        Route::resource('temas', AdminTemaController::class)->only(['index']);      // por ahora solo index
        Route::resource('lecciones', AdminLeccionController::class)->only(['index']);
        Route::resource('ejercicios', AdminEjercicioController::class)->only(['index']);
    });

require __DIR__.'/auth.php';
