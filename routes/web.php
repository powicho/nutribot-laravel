<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NutriController; // Importamos tu controlador

// Ruta principal que llama al controlador
Route::get('/', [NutriController::class, 'index']);