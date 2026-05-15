<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dieta; // Conexión con la Base de Datos
use Illuminate\Support\Facades\Http; // Motor para peticiones API externa

class NutriController extends Controller
{
    // Carga la página principal
    public function index() { 
        return view('inicio'); 
    }

    public function calcular(Request $request)
    {
 
        // --- 1. RECOGER DATOS (AQUI ESTÁ EL CAMBIO MAESTRO) ---
        // Si hay un usuario logueado, tomamos sus datos del sistema. Si no, es invitado.
        if (auth()->check()) {
            $nombre = auth()->user()->name;  // Su nombre real de la cuenta
            $user_id = auth()->id();        // Su ID para el historial
        } else {
            $nombre = $request->input('nombre', 'Amigo');
            $user_id = null;                // Los invitados no tienen historial personal
        }

        $peso = $request->input('peso');
        $altura = $request->input('altura');
        $edad = $request->input('edad');
        $genero = $request->input('genero');
        $actividad = $request->input('nivel_actividad');
        $objetivo = $request->input('objetivo');
        
        // --- 2. CÁLCULO DE CALORÍAS (Fórmula Mifflin-St Jeor) ---
        // Si es masculino: (10*kg) + (6.25*cm) - (5*años) + 5
        // Si es femenino: (10*kg) + (6.25*cm) - (5*años) - 161
        $tmb = ($genero == 'm') ? 
            (10 * $peso) + (6.25 * $altura) - (5 * $edad) + 5 : 
            (10 * $peso) + (6.25 * $altura) - (5 * $edad) - 161;
        
        // Multiplicar por nivel de actividad y ajustar según meta
        $calorias = round($tmb * $actividad);
        if ($objetivo == 'perder') $calorias -= 500;
        if ($objetivo == 'ganar') $calorias += 500;


        // --- 3. GUARDAR EN BASE DE DATOS (NUEVO CAMPO DE USUARIO) ---
        $dieta = new Dieta();
        $dieta->user_id = $user_id; // <-- VINCULAMOS LA DIETA AL USUARIO
        $dieta->nombre = $nombre;
        $dieta->peso = $peso;
        $dieta->altura = $altura;
        $dieta->edad = $edad;
        $dieta->genero = $genero;
        $dieta->nivel_actividad = $actividad;

        // LÍNEA NUEVA (Faltaba esta asignación):
        $dieta->objetivo = $request->input('objetivo'); // Guardamos el objetivo también
        $dieta->calorias_objetivo = $calorias;
        $dieta->save(); 

        // --- 4. CONECTAR CON IA (GOOGLE GEMINI) ---
        $apiKey = env('GEMINI_API_KEY'); // Lee la clave del archivo .env
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-flash-latest:generateContent?key=" . $apiKey;

        // ESTRUCTURAMOS EL PEDIDO PARA LA IA
        $prompt = "Hola. Soy un experto en nutrición. Actúa como tal. 
                   El paciente se llama $nombre, pesa $peso kg, mide $altura cm y su meta es $objetivo peso con $calorias kcal diarias.
                   Escribe una propuesta de comida (desayuno, almuerzo, merienda, cena) muy variada.
                   IMPORTANTE: Responde ÚNICAMENTE un objeto JSON así: 
                   {\"desayuno\":\"texto\",\"almuerzo\":\"texto\",\"merienda\":\"texto\",\"cena\":\"texto\"}";

        try {
            $response = Http::post($url, [
                'contents' => [['parts' => [['text' => $prompt]]]] 
            ]);

            if ($response->status() == 429) {
                return response()->json([
                    'status' => 'error', 
                    'message' => '¡NutriBot está procesando muchas dietas! Por favor, espera 60 segundos y reintenta.'
            ]);
        }
            if ($response->successful()) {
                $resData = $response->json();
                
                // Extraemos el texto crudo de la IA
                $textoIA = $resData['candidates'][0]['content']['parts'][0]['text'];

                // Limpiamos la respuesta (A veces la IA manda ```json o espacios)
                $jsonLimpio = trim(str_replace(['```json', '```', 'json'], '', $textoIA));
                
                // Convertimos el JSON de la IA a un ARRAY de PHP
                $arrayDieta = json_decode($jsonLimpio, true);

                // ACTUALIZAMOS EL REGISTRO EN LA BASE DE DATOS
                $dieta->resultado_ia = $jsonLimpio;
                $dieta->save();

                // DEVOLVEMOS LA RESPUESTA FINAL AL FRONTEND (AJAX)
                return response()->json([
                    'status' => 'success',
                      'id_registro' => $dieta->id, // ESTO ES CLAVE PARA FUTURAS CONSULTAS
                    'nombre' => $nombre,
                    'calorias' => $calorias,
                    'dieta' => $arrayDieta
                ]);
            }
            return response()->json(['status' => 'error', 'message' => 'Falla en el servicio de IA']);
           } catch (\Exception $e) {
        return response()->json(['status' => 'error', 'message' => 'Falla de red. Verifica tu internet.']);
    }
    }
            /**
         * MÉTODO DE LA FASE 4: API REST
         * Este método es consumido por aplicaciones móviles o externas.
         * Devuelve el historial de todas las dietas generadas.
         */
        public function getApiResultados()
        {
            // 1. Obtenemos todos los registros de la tabla 'dietas'
            // Los ordenamos por los más recientes primero
            $dietas = Dieta::orderBy('created_at', 'desc')->get();

            // 2. Respondemos con el paquete JSON completo
            // No usamos 'return view', porque las apps móviles no entienden HTML, solo JSON.
            return response()->json([
                'status' => 'success',
                'cantidad' => $dietas->count(),
                'datos' => $dietas
            ], 200); // El código 200 significa "Todo está OK"
    }
        public function chatear(Request $request) {
            // 1. Buscamos la dieta
            $dieta = Dieta::find($request->dieta_id);
            
            // Si no existe (porque refrescaste la DB), avisamos al usuario
            if (!$dieta) {
                return response()->json(['respuesta' => 'Lo siento, no encuentro el registro de tu dieta. Por favor, genera una nueva.']);
            }

            $apiKey = env('GEMINI_API_KEY');
            $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-flash-latest:generateContent?key=" . $apiKey;

            $prompt = "Contexto: La dieta generada fue: " . $dieta->resultado_ia . ". 
                    Duda del usuario: '$request->pregunta'. 
                    Responde breve y profesional en 2 frases.";

            try {
                $response = Http::post($url, [
                    'contents' => [['parts' => [['text' => $prompt]]]]
                ]);

                $data = $response->json();
                
                // Verificamos si Google bloqueó por "groserías" o seguridad
                if (isset($data['candidates'][0]['finishReason']) && $data['candidates'][0]['finishReason'] == 'SAFETY') {
                    return response()->json(['respuesta' => 'Lo siento, no puedo responder a eso por mis políticas de seguridad. Mantengamos la duda sobre nutrición.']);
                }

                $respuestaIA = $data['candidates'][0]['content']['parts'][0]['text'] ?? "Lo siento, mi conexión falló.";
                return response()->json(['respuesta' => $respuestaIA]);

            } catch (\Exception $e) {
                return response()->json(['respuesta' => 'Hubo un problema de conexión con la IA.']);
            }

                    }
             /*El Historial de Dietas del Usuario*/
            public function historial()
            {
                // Buscamos solo las dietas que pertenecen al usuario que tiene la sesión abierta
                $dietas = Dieta::where('user_id', auth()->id())
                            ->orderBy('created_at', 'desc')
                            ->get();

                return view('historial', compact('dietas'));
            }
}