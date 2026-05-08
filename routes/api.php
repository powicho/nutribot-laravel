<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NutriController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Ruta que entrega todas las dietas en formato JSON puro
Route::get('/resultados', [NutriController::class, 'getApiResultados']);