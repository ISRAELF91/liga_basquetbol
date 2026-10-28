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
    Schema::create('partidos', function (Blueprint $table) {
            $table->id();
        
            // Relaciones con la tabla equipos para el local y visitante
            $table->foreignId('equipo_local_id')->constrained('equipos')->onDelete('cascade');
            $table->foreignId('equipo_visitante_id')->constrained('equipos')->onDelete('cascade');
        
            // Información del partido
            $table->dateTime('fecha_partido');
        
            // Puntos (permitimos que estén vacíos al inicio usando nullable)
            $table->integer('puntos_local')->nullable();
            $table->integer('puntos_visitante')->nullable();
        
            // Estado del partido (Ej: Programado, Jugado)
            $table->string('estado')->default('Programado');
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partidos');
    }
};
