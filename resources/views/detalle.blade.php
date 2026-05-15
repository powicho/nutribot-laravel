<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>NutriBot - Detalle de Dieta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet">
    <style>

        :root { --brand-green: #2d7a4d; }

        body { 
            font-family: 'Poppins', 
            sans-serif; 
            background-color: #c5ccbb; 
        }

        .navbar {
            background-color: #cee0b2; 
            padding: 10px 40px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        .img-fluid{
            width: 50px;
        }
        
        .navbar-brand {
            font-size: 28px;
            font-weight: 600;
            color: var(--brand-green) !important;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        
        .glass-card { 
            background: white; 
            border-radius: 25px;
            padding: 30px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.05); 
        }

        .msg-bot { 
            background: #f9fff0; 
            border-radius: 15px; 
            padding: 15px; 
            border-left: 5px solid var(--brand-green); }

            .btn-outline-success {
            background: var(--brand-green); 
            color: white; 
            border-radius: 50px; 
            padding: 10px 30px; 
            text-decoration: none; 
            font-weight: 600; 
            transition: 0.3s; 
        }

         .btn-outline-success:hover { 
            filter: brightness(1.1); 
            transform: scale(1.05); 
            color: white; }
        

    </style>
</head>
<body>

    <nav class="navbar d-flex justify-content-between">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
            <img class="img-fluid" src="https://img.icons8.com/color/96/apple.png" alt="Logo" width="40">
            NutriBot
        </a>
        <a href="{{ route('nutri.historial') }}" class="btn btn-outline-success">← volver al historial</a>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <!-- Lateral: Resumen de mis datos ese día -->
            <div class="col-md-4 mb-4">
                <div class="glass-card">
                    <h5 class="fw-bold mb-3">Datos del {{ $dieta->created_at->format('d/m/Y') }}</h5>
                    <ul class="list-unstyled">
                        <li>📏 Altura: <b>{{ $dieta->altura }} cm</b></li>
                        <li>⚖️ Peso: <b>{{ $dieta->peso }} kg</b></li>
                        <li>🔥 Meta: <b>{{ $dieta->calorias_objetivo }} kcal</b></li>
                    </ul>
                        <!-- BOTÓN ROJO DE PDF -->
    <a href="{{ route('nutri.pdf', $dieta->id) }}" class="btn w-100 py-3" style="background-color: #e74c3c; color: white; border-radius: 12px; font-weight: 600; font-size: 14px; text-decoration: none; display: block; text-align: center; transition: 0.3s;">
        📥 Descargar en PDF
    </a>
                </div>
                
            </div>
            

            <!-- Principal: La Dieta y el Chat Continuo -->
            <div class="col-md-8">
                <div class="glass-card">
                    <h3 class="fw-bold text-success mb-4">Tu Dieta Generada</h3>
                    <div class="msg-bot mb-4">
                        <p><b>🍳 Desayuno:</b> {{ $datosDieta['desayuno'] ?? 'No disponible' }}</p>
                        <p><b>🥗 Almuerzo:</b> {{ $datosDieta['almuerzo'] ?? 'No disponible' }}</p>
                        <p><b>🍎 Merienda:</b> {{ $datosDieta['merienda'] ?? 'No disponible' }}</p>
                        <p><b>🌙 Cena:</b> {{ $datosDieta['cena'] ?? 'No disponible' }}</p>
                    </div>

                    <hr>
                    <!-- EL MISMO CHAT QUE HICIMOS ANTES -->
                    <div id="historial-chat" class="mb-3" style="max-height: 300px; overflow-y: auto;">
                        <p class="text-muted small">Puedes seguir preguntando sobre esta dieta específica...</p>
                    </div>
                    
                    <div class="input-group">
                        <input type="text" id="pregunta-chat" class="form-control" placeholder="Dime NutriBot, ¿puedo cambiar la cena?">
                        <button class="btn btn-success" id="btn-preguntar">Enviar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Incluye jQuery y SweetAlert como en las otras páginas -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Aquí usas el MISMO código de AJAX del chat que ya tienes
        window.ultimoDietaId = "{{ $dieta->id }}";
        
        $(document).on('click', '#btn-preguntar', function() {
            let pregunta = $('#pregunta-chat').val();
            if(!pregunta) return;
            
            $('#historial-chat').append(`<p class='text-end'><b>Tú:</b> ${pregunta}</p>`);
            $('#pregunta-chat').val('');

            $.ajax({
                url: "{{ route('nutri.chat') }}", // Reusamos la misma ruta del chat
                method: "POST",
                data: { _token: "{{ csrf_token() }}", pregunta: pregunta, dieta_id: window.ultimoDietaId },
                success: function(res) {
                    $('#historial-chat').append(`<p class='text-start text-success'><b>NutriBot:</b> ${res.respuesta}</p>`);
                }
            });
        });
    </script>
</body>
</html>