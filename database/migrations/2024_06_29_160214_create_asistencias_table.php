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
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->time('h_llegada');
            $table->time('h_salida')->nullable();
            $table->time('horas')->nullable();
            $table->string('turno');
            $table->string('asistencia');

            $table->unsignedBigInteger('id_inscripcion');
            $table->foreign('id_inscripcion')->references('id')->on('inscripcions')->onDelete('cascade')->onUpdate('cascade');
            
            $table->unsignedBigInteger('id_actividad');
            $table->foreign('id_actividad')->references('id')->on('actividads')->onDelete('cascade')->onUpdate('cascade');
            
            $table->unsignedBigInteger('id_multa');
            $table->foreign('id_multa')->references('id')->on('multas')->onDelete('cascade')->onUpdate('cascade');
            
            $table->boolean('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};
