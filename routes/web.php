<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NutriController; //se importa controlador 
use Illuminate\Http\Request; //para la traduccion de datos http a php


// Ruta principal que llama al controlador
Route::get('/', [NutriController::class, 'index']);

// Esta ruta recibirá los datos del formulario por POST
Route::post('/calcular-calorias', [NutriController::class, 'calcular'])->name('nutri.calcular');