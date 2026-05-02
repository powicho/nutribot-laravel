<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    Schema::create('dietas', function (Blueprint $table) {
        $table->id();
        $table->integer('edad');
        $table->float('peso');
        $table->float('altura');
        $table->string('genero');
        $table->string('nivel_actividad');
        $table->integer('calorias_objetivo')->nullable();
        $table->text('resultado_ia')->nullable(); // Aquí guardaremos la dieta que genere la IA
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dietas');
    }
};
