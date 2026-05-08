<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dieta; // Importamos el modelo que creamos

class NutriController extends Controller
{

    public function index() {
        return view('inicio');

    }

    public function calcular(Request $request) {
    // 1. Recibir datos del formulario
    $peso = $request->peso; 
    $altura = $request->altura;
    $edad = $request->edad;
    $genero = $request->genero;
    $actividad = $request->nivel_actividad;
    $objetivo = $request->objetivo; // El nuevo campo

    // Asumimos kg para la fórmula (Si el usuario ingresa libras, habría que dividir $peso / 2.204)
    $peso_kg = $peso; 

    // 2. Cálculo de la Tasa Metabólica Basal (Fórmula de Mifflin-St Jeor)
    if ($genero == 'm') {
        $tmb = (10 * $peso_kg) + (6.25 * $altura) - (5 * $edad) + 5;
    } else {
        $tmb = (10 * $peso_kg) + (6.25 * $altura) - (5 * $edad) - 161;
    }

    // Calcular Calorías de Mantenimiento (TDEE)
    $calorias_mantenimiento = round($tmb * $actividad);

    // 3. Ajuste según el Objetivo (Déficit o Superávit)
    $calorias_finales = $calorias_mantenimiento;

    if ($objetivo == 'perder') {
        $calorias_finales = $calorias_mantenimiento - 500;
    } elseif ($objetivo == 'ganar') {
        $calorias_finales = $calorias_mantenimiento + 500;
    }

    // 4. Guardar en la base de datos
    $dieta = new Dieta();
    $dieta->peso = $peso;
    $dieta->altura = $altura;
    $dieta->edad = $edad;
    $dieta->genero = $genero;
    $dieta->nivel_actividad = $actividad;
    $dieta->calorias_objetivo = $calorias_finales;
    $dieta->save();

    // 5. Respuesta JSON para AJAX
    return response()->json([
        'status' => 'success',
        'calorias' => $calorias_finales,
        'objetivo' => $objetivo,
        'mensaje' => '¡Plan listo! Tu objetivo son ' . $calorias_finales . ' kcal diarias para ' . $objetivo . ' peso.'
    ]);
}
}