<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriBot - Mi Historial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet">
    <style>
        :root { 
            --brand-green: #2d7a4d; 
            --soft-bg: #fdfdfd;
        }

        body { 
            background-color: var(--soft-bg); 
            font-family: 'Poppins', sans-serif; 
            background-color: #c5ccbb;
        }
      /* BARRA DE NAVEGACIÓN (Header) */
        .navbar {
            background-color: #cee0b2; /* Verde pastel del fondo */
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
        .container { margin-top: 50px; 
        max-width: 1000px; 
        }
        
        .glass-table-card { 
            background: white; 
            border-radius: 25px; 
            padding: 30px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
             border: 1px solid rgba(0,0,0,0.05);
        }

        .table thead { 
            background: linear-gradient(145deg, #afd889, #9dc420);
             color: white; 
        }
        
        .table thead th { 
            border: none; 
            padding: 15px;
        }
        
        .table tbody tr:hover {
             background-color: #f9fff0;
        }
        
        .badge-cal { 
            background-color: #f1e9c9; 
            color: #555; 
            padding: 8px 15px; 
            border-radius: 10px; 
            font-weight: 600; 
        }
       
        .btn-volver { 
            background: var(--brand-green); 
            color: white; 
            border-radius: 50px; 
            padding: 10px 30px; 
            text-decoration: none; 
            font-weight: 600; 
            transition: 0.3s; 
        }
        
        .btn-volver:hover { 
            filter: brightness(1.1); 
            transform: scale(1.05); 
            color: white; }
    </style>
</head>
<body>

    <!-- NAVBAR IGUAL A LA PRINCIPAL -->
    <nav class="navbar d-flex justify-content-between">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <img class="img-fluid" src="https://img.icons8.com/color/96/apple.png" alt="Logo" width="40">
            NutriBot
        </a>
        <a href="{{ route('dashboard') }}" class="btn-volver">← volver a solicitar dieta</a>
    </nav>

    <div class="container">
        <h2 class="fw-bold mb-4">Mi Historial de Dietas 📋</h2>
        
        <div class="glass-table-card">
            @if($dietas->isEmpty())
                <div class="text-center py-5">
                    <h4>Aún no has generado ninguna dieta.</h4>
                    <p class="text-muted">¡Empieza a usar NutriBot para ver tu progreso!</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Peso / Altura</th>
                                <th>Objetivo</th>
                                <th>Calorías</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dietas as $dieta)
                            <tr>
                                <td class="text-muted">{{ $dieta->created_at->format('d/m/Y H:i') }}</td>
                                <td><b>{{ $dieta->peso }}kg</b> / {{ $dieta->altura }}cm</td>
                                <td><span class="text-capitalize">{{ $dieta->nivel_actividad }}</span></td>
                                <td><span class="badge-cal">{{ $dieta->calorias_objetivo }} kcal</span></td>
                                <td>
                                    <!-- Aquí pondremos el botón del PDF en el siguiente paso -->
                                    <a href="{{ route('nutri.detalle', $dieta->id) }}" class="btn btn-sm btn-outline-success">ver detalle</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

</body>
</html>