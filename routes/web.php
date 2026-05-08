<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NutriController; //se importa controlador 
use Illuminate\Http\Request; //para la traduccion de datos http a php
use App\Models\Dieta;

// Ruta principal que llama al controlador
Route::get('/', [NutriController::class, 'index']);

// Esta ruta recibirá los datos del formulario por POST
Route::post('/calcular-calorias', [NutriController::class, 'calcular'])->name('nutri.calcular');

// Verifica que esta línea esté en routes/web.php y guardada:
Route::post('/chat-seguimiento', [NutriController::class, 'chatear'])->name('nutri.chat');