<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriBot - Transformación Inteligente</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts para un look moderno -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --brand-green: #2d7a4d; /* El verde del logo que enviaste */
            --light-green: #9dc420;
            --soft-bg: #fdfdfd;
        }

        body {
            background-color: var(--soft-bg);
            font-family: 'Poppins', sans-serif;
            color: #333;
        }

        /* HEADER INNOVADOR */
        .navbar {
            background-color: #cee0b2;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            padding: 5px 40px;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            font-size: 28px;
            font-weight: 400;
            color: var(--brand-green);
            gap: 10px;
          
        }

        .navbar-brand img {
            height: 45px; /* Ajuste para que se vea igual a tu logo */
        }

        .btn-data {
            background-color: #7a8048;
            color: white;
            border-radius: 12px;
            padding: 12px 45px;
            border: none;
            transition: 0.3s;
            text-transform: lowercase;

        }

        /* SECCIÓN BIENVENIDA */
        .welcome-text {
            max-width: 1000px;
            margin: 40px auto;
            font-weight: 1000;
            line-height: 1.6;
            font-size: 20px;
        }

        /* CONTENEDOR VERDE INNOVADOR (Con degradado y sombra) */
        .main-card-container {
            background: linear-gradient(145deg, #afd889);
            border-radius: 50px;
            padding: 60px 20px;
            box-shadow: 0 20px 40px rgba(157, 196, 32, 0.3);
            max-width: 750px;
            margin: 0 auto;
        }

        /* LA TARJETA BLANCA (Inputs) */
        .glass-input-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 40px;
            box-shadow: inset 0 2px 10px rgba(0,0,0,0.05);
            max-width: 500px;
            margin: 0 auto;
        }

        .form-control {
            border: none;
            border-bottom: 2px solid #eee;
            border-radius: 0;
            margin-bottom: 30px;
            padding: 10px 0;
            font-size: 16px;
            text-align: center;
            transition: 0.3s;
            background: transparent;
        }

        .form-control:focus {
            box-shadow: none;
            border-bottom: 2px solid var(--brand-green);
            background-color: #fafafa;
        }

        .form-select {
            border: 2px solid #eee;
            border-radius: 12px;
            padding: 12px;
            text-align: center;
            cursor: pointer;
            color: #666;
        }

        /* BOTÓN PRINCIPAL (Llamativo) */
        .btn-submit {
            background-color: #f1e9c9;
            color: #555;
            font-weight: 600;
            border-radius: 12px;
            padding: 15px 50px;
            border: none;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            margin-top: 30px;
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            background-color: #fff;
        }
    </style>
</head>
<body>

    <!-- HEADER LIMPIO -->
    <nav class="navbar d-flex justify-content-between">
        <a class="navbar-brand" href="#">
            <!-- He puesto un emoji de manzana por ahora, aquí iría tu archivo de imagen real -->
            <img src="https://img.icons8.com/color/96/apple.png" alt="Apple Logo">
            NutriBot
        </a>
        <button class="btn-data">tus datos</button>
    </nav>

    <!-- CUERPO PRINCIPAL -->
    <div class="container text-center mt-5">
        <div class="welcome-text">
            <p>Bienvenido a tu bot de confianza para lograr un gran cambio físico, es sencillo y dinos tus datos biométricos y te daremos una solución para empezar con tu gran cambio.</p>
        </div>

        <div class="main-card-container">
            <div class="glass-input-card">
                <form id="formNutri">
                    @csrf
                    <!-- Inputs de Texto más elegantes -->
                    <input type="number" class="form-control" name="peso" placeholder="peso (kg)" required>
                    <input type="number" class="form-control" name="altura" placeholder="altura (cm)" required>
                    <input type="number" class="form-control" name="edad" placeholder="edad" required>
                    
                    <!-- Campo Género (Agregado porque es necesario para el cálculo real) -->
                    <div class="mb-4">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="genero" id="masc" value="m" checked>
                            <label class="form-check-label text-muted" for="masc">Hombre</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="genero" id="fem" value="f">
                            <label class="form-check-label text-muted" for="fem">Mujer</label>
                        </div>
                    </div>

                    <!-- Menú Desplegable con mejor estilo -->
                    <select class="form-select" name="nivel_actividad" required>
                        <option value="" disabled selected>nivel de actividad</option>
                        <option value="1.2">sedentarismo</option>
                        <option value="1.55">algún deporte</option>
                        <option value="1.9">deportista</option>
                    </select>
                    <select class="form-select mt-3" name="objetivo" required>
                        <option value="" disabled selected>¿cuál es tu objetivo?</option>
                        <option value="perder">perder peso (-500 kcal)</option>
                        <option value="mantener">mantener peso (balance)</option>
                        <option value="ganar">ganar masa muscular (+500 kcal)</option>
                    </select>
                </form>
            </div>

            <!-- Botón Final -->
            <button type="submit" form="formNutri" class="btn-submit">Obten tu dieta</button>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Para alertas bonitas -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 

<script>
    $(document).ready(function() {
        $('#formNutri').on('submit', function(e) {
            e.preventDefault(); // Evita que la página se recargue

            // Recopilamos los datos del formulario
            let datos = $(this).serialize();

            // Petición AJAX (Requisito Obligatorio)
            $.ajax({
                url: "{{ route('nutri.calcular') }}",
                method: "POST",
                data: datos,
                success: function(response) {
                    if(response.status == 'success') {
                        // Mostramos el resultado con una alerta elegante
                        // es una alerta 
                        Swal.fire({
                            title: 'Resultado de NutriBot',
                            text: response.mensaje,
                            icon: 'success',
                            confirmButtonText: '¡Entendido!',
                            confirmButtonColor: '#9dc420'
                        });
                        
                        // Aquí en la Fase 3 inyectaremos la respuesta de la IA
                        console.log("Calorías calculadas:", response.calorias);
                    }
                },
                error: function(error) {
                    Swal.fire('Error', 'Hubo un problema al procesar los datos', 'error');
                }
            });
        });
    });
</script>

</body>
</html>