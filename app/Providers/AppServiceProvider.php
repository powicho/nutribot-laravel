<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // <-- Asegúrate de agregar esta línea

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // ESTA ES LA CLAVE: Forzamos HTTPS si estamos en Railway (Producción)
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}