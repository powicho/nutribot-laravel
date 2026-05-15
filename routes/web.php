<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NutriController; 
Route::get('/', function () {
    return view('welcome');
})->name('inicio');


// 2. NutriBot App (Solo para logueados)
Route::middleware(['auth', 'verified'])->group(function () {
    // Vista Principal
    Route::get('/dashboard', [NutriController::class, 'index'])->name('dashboard');
    
    // Cálculo de Calorías e IA
    Route::post('/calcular-calorias', [NutriController::class, 'calcular'])->name('nutri.calcular');

    // RUTA QUE DABA EL ERROR (El Chat)
    Route::post('/chat-seguimiento', [NutriController::class, 'chatear'])->name('nutri.chat');

    // PUNTO 3: Ruta del Historial (Nueva)
    Route::get('/historial', [NutriController::class, 'historial'])->name('nutri.historial');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
