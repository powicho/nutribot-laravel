<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriBot - Transformación Inteligente</title>

    <!-- ESTILOS EXTERNOS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        /* VARIABLES GLOBALES PARA CAMBIAR COLORES RÁPIDO */
        :root {
            --brand-green: #2d7a4d;   /* Verde oscuro del texto */
            --glass-white: rgba(255, 255, 255, 0.95); /* Blanco traslúcido */
            --bg-color: #fdfdfd;      /* Color de fondo limpio */
        }

        body {
            background-color: var(--bg-color);
            font-family: 'Poppins', sans-serif;
            color: #333;
        }

        /* BARRA DE NAVEGACIÓN (Header) */
        .navbar {
            background-color: #cee0b2; /* Verde pastel del fondo */
            padding: 10px 40px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        .navbar-brand {
            font-size: 28px;
            font-weight: 600;
            color: var(--brand-green) !important;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        /* CONTENEDOR PRINCIPAL DEL CHATBOT */
        .main-card-container {
            background: linear-gradient(145deg, #afd889, #9dc420);
            border-radius: 40px;
            padding: 50px 20px;
            max-width: 800px;
            margin: 0 auto;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }

        /* CAJA BLANCA INTERNA */
        .glass-input-card {
            background: var(--glass-white);
            border-radius: 25px;
            padding: 35px;
            max-width: 550px;
            margin: 0 auto;
        }

        /* ESTILO DE LOS CAMPOS DE TEXTO */
        .form-control {
            border: none;
            border-bottom: 2px solid #ddd;
            border-radius: 0;
            text-align: center;
            margin-bottom: 25px;
            font-size: 16px;
            background: transparent !important;
        }

        .form-control:focus {
            box-shadow: none;
            border-bottom-color: var(--brand-green);
        }

        /* SELECTORES (Drop-downs) */
        .form-select {
            border-radius: 12px;
            margin-bottom: 15px;
            padding: 10px;
            border-color: #ddd;
        }

        /* BOTÓN DE ACCIÓN */
        .btn-submit {
            background-color: #f1e9c9;
            color: #555;
            font-weight: 600;
            border-radius: 50px;
            padding: 15px 40px;
            border: none;
            transition: 0.4s;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 20px;
        }

        .btn-submit:hover {
            transform: scale(1.05);
            background-color: white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        /* ÁREA DE RESULTADOS (DIETA DE LA IA) */
        #resultado-dieta {
            background: white;
            border-radius: 20px;
            padding: 30px;
            margin-top: 30px;
            text-align: left;
            animation: slideIn 0.5s ease;
        }

        @keyframes slideIn { from {opacity: 0; transform: translateY(20px);} to {opacity: 1; transform: translateY(0);} }
    </style>
</head>
<body>

    <!-- NAVBAR CENTRADA -->
    <nav class="navbar d-flex justify-content-center">
        <a class="navbar-brand" href="#">
            <img src="https://img.icons8.com/color/96/apple.png" alt="Logo" width="45">
            NutriBot
        </a>
    </nav>

    <div class="container text-center mt-5 mb-5">
        <!-- TEXTO BIENVENIDA -->
        <div class="mb-4">
            <h4 class="fw-bold">Hola 👋 Soy NutriBot</h4>
            <p class="text-muted">Dame tus datos y crearé una dieta basada en Inteligencia Artificial para ti.</p>
        </div>

        <div class="main-card-container">
            <div class="glass-input-card">
                <!-- FORMULARIO SIN RECARGA -->
                <form id="formNutri">
                    @csrf
                    <input type="text" class="form-control" name="nombre" placeholder="¿Cómo te llamas?" required>
                    <input type="number" class="form-control" name="peso" placeholder="Peso (kg)" required>
                    <input type="number" class="form-control" name="altura" placeholder="Altura (cm)" required>
                    <input type="number" class="form-control" name="edad" placeholder="Edad" required>
                    
                    <!-- GÉNERO -->
                    <div class="mb-4 d-flex justify-content-around">
                        <div>
                            <input class="form-check-input" type="radio" name="genero" id="m" value="m" checked>
                            <label class="form-check-label" for="m">Hombre</label>
                        </div>
                        <div>
                            <input class="form-check-input" type="radio" name="genero" id="f" value="f">
                            <label class="form-check-label" for="f">Mujer</label>
                        </div>
                    </div>

                    <!-- SELECTORES -->
                    <select class="form-select" name="nivel_actividad" required>
                        <option value="" disabled selected>Nivel de Actividad</option>
                        <option value="1.2">Poco ejercicio (Sedentario)</option>
                        <option value="1.55">Deporte regular</option>
                        <option value="1.9">Atleta (Muy activo)</option>
                    </select>

                    <select class="form-select" name="objetivo" required>
                        <option value="" disabled selected>Tu Meta</option>
                        <option value="perder">Perder grasa</option>
                        <option value="mantener">Mantenimiento</option>
                        <option value="ganar">Subir músculo</option>
                    </select>
                    
                    <button type="submit" class="btn-submit w-100 shadow-sm">🚀 Generar mi dieta</button>
                </form>
            </div>

            <!-- RESULTADO DINÁMICO (Oculto al inicio) -->
            <div id="resultado-dieta" class="d-none mt-4">
                <h3 class="fw-bold text-success text-center">🍏 Tu Plan Personalizado</h3>
                <p id="calorias-info" class="text-center badge bg-success w-100 fs-6 py-2"></p>
                <hr>
                <div id="contenido-dieta" class="lh-lg"></div>
            </div>
        </div>
    </div>

    <!-- SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#formNutri').on('submit', function(e) {
                e.preventDefault(); // BLOQUEA el parpadeo de la página
                
                let btn = $('.btn-submit');
                btn.prop('disabled', true).text('Conectando con el bot...');

                // LLAMADA AJAX AL CONTROLADOR LARAVEL
                $.ajax({
                    url: "{{ route('nutri.calcular') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(res) {
                        if(res.status == 'success') {
                            // MOSTRAR LA CAJA DE RESULTADO
                            $('#resultado-dieta').removeClass('d-none');
                            
                            // Pintamos las calorías y el nombre
                            $('#calorias-info').text(`${res.nombre}, tu meta son ${res.calorias} calorías al día.`);

                            // Construimos la lista de comida con iconos
                            let html = `
                                <div class='mb-3'><b>🍳 DESAYUNO:</b><br>${res.dieta.desayuno}</div>
                                <div class='mb-3'><b>🥗 ALMUERZO:</b><br>${res.dieta.almuerzo}</div>
                                <div class='mb-3'><b>🍎 MERIENDA:</b><br>${res.dieta.merienda}</div>
                                <div class='mb-3'><b>🌙 CENA:</b><br>${res.dieta.cena}</div>
                            `;
                            $('#contenido-dieta').html(html);

                            // Alerta final
                            Swal.fire('¡Éxito!', 'Tu dieta ha sido creada.', 'success');
                        } else {
                            Swal.fire('Atención', res.message, 'warning');
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'Hubo una falla de red', 'error');
                    },
                    complete: function() {
                        // REHABILITA el botón para una nueva consulta
                        btn.prop('disabled', false).text('🚀 Generar mi dieta');
                    }
                });
            });
        });
    </script>
</body>
</html>