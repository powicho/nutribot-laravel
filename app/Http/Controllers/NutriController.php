<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NutriController extends Controller
{
    // Esta función se encarga de mostrar la página de inicio
    public function index()
    {
        return view('inicio');
    }
}