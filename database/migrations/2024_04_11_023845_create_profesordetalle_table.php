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
        Schema::create('profesordetalle', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profesor_id');
            $table->unsignedBigInteger('area_id');
            $table->unsignedBigInteger('cargo_id');
            $table->unsignedBigInteger('horario_id');

            $table->foreign('horario_id')->references('id')->on('horarios');
            $table->foreign('profesor_id')->references('id')->on('profesor');
            $table->foreign('area_id')->references('id')->on('area');
            $table->foreign('cargo_id')->references('id')->on('cargo');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesordetalle');
    }
};
