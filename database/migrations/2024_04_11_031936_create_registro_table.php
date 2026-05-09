<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('registro', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profesor_id');
            $table->unsignedBigInteger('horario_id');
            $table->date('fecha_registro')->default(now());
            $table->time('hora_registro')->default(now());
            $table->enum('estado', ['Entrada', 'Salida']);
            $table->enum('asistencia', ['Puntual', 'Tardanza', 'Falta', 'Adelanto']);

            $table->foreign('profesor_id')->references('id')->on('profesor');
            $table->foreign('horario_id')->references('id')->on('horarios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro');
    }
};
