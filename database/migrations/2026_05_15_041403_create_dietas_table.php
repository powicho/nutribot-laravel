<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dietas', function (Blueprint $table) {
            $table->id();
            
            // RELACIÓN CON USUARIO (La base del historial)
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            
            // DATOS DEL CHATBOT
            $table->string('nombre')->nullable();
            $table->float('peso');
            $table->float('altura');
            $table->integer('edad');
            $table->string('genero');
            $table->string('nivel_actividad');
            $table->string('objetivo');
            $table->integer('calorias_objetivo')->nullable();
            
            // RESULTADO DE LA IA
            $table->text('resultado_ia')->nullable();
            
            $table->timestamps(); // create_at y update_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dietas');
    }
};