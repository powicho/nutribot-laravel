<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>

        body { 
            font-family: sans-serif; 
            color: #333; 
    }

        .header { 
            text-align: center; 
            border-bottom: 2px solid #2d7a4d; padding-bottom: 10px; margin-bottom: 30px; 
    }


        .title { 
            color: #2d7a4d; 
            font-size: 24px; margin-bottom: 5px; 
    }

        .section { 
            margin-bottom: 20px; 
            padding: 15px; 
            background: #f9fff0; 
            border-left: 4px solid #2d7a4d; 
    }

        .footer {
            position: fixed;
            bottom: 0; 
            font-size: 10px; text-align: center; width: 100%; color: #888; 
    }

        h4 { 
            margin: 0 0 10px 0; 
            color: #444; 
            text-transform: uppercase; 
    }

        p { 
            margin: 5px 0; 
    }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">NutriBot - Plan Nutricional</div>
        <p>Preparado especialmente para: <strong>{{ auth()->user()->name }}</strong></p>
        <p>Fecha de emisión: {{ now()->format('d/m/Y') }}</p>
    </div>

    <h3>Resumen de tus datos:</h3>
    <p>Altura: {{ $dieta->altura }} cm | Peso: {{ $dieta->peso }} kg | Meta: {{ $dieta->calorias_objetivo }} kcal</p>
    <hr>

    <div class="section">
        <h4>DESAYUNO</h4>
        <p>{{ $datosDieta['desayuno'] }}</p>
    </div>

    <div class="section">
        <h4>ALMUERZO</h4>
        <p>{{ $datosDieta['almuerzo'] }}</p>
    </div>

    <div class="section">
        <h4>MERIENDA</h4>
        <p>{{ $datosDieta['merienda'] }}</p>
    </div>

    <div class="section">
        <h4>CENA</h4>
        <p>{{ $datosDieta['cena'] }}</p>
    </div>

    <div class="footer">
        Este documento fue generado automáticamente por NutriBot AI. Consulta a un especialista antes de iniciar cualquier cambio drástico en tu dieta.
    </div>
</body>
</html>