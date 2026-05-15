<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a NutriBot</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet">

    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: #fdfdfd;
         }

        .hero-section { 
            height: 80vh; 
            display: flex; 
            flex-direction: column; 
            justify-content: center; 
            align-items: center; 
            text-align: center;
         }

        .btn-custom { 
            padding: 15px 40px; 
            font-weight: 600; 
            border-radius: 10px; 
            border: none; 
            width: 250px; 
            transition: 0.3s; 
        }

        .btn-login { 
            background-color: #7ef17e; 
            color: #333;
             margin-right: 10px;
         }

        .btn-register { 
            background-color: #7ef17e; 
            color: #333; 
        }

        .btn-custom:hover { 
            transform: scale(1.05); 
            filter: brightness(0.9); 
        }

    </style>



</head>
<body>
    <div class="container hero-section">
        <img src="https://img.icons8.com/color/96/apple.png" alt="NutriBot" class="mb-3">
        <h1 class="fw-bold text-success mb-4">NutriBot</h1>
        <p class="lead mb-5 px-4" style="max-width: 800px;">
            Bienvenido a nutri bot, esta página especializada en apoyarte en tu orden alimenticio el cual será útil para tu gran cambio físico. Esta página utiliza una inteligencia artificial especializada en apoyar al usuario dándole las herramientas necesarias para que pueda comprender lo necesario.
        </p>

        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="{{ route('login') }}" class="btn-custom btn-login">Inicia sesión</a>
            <a href="{{ route('register') }}" class="btn-custom btn-register">Crea un usuario</a>
        </div>
    </div>
</body>
</html>