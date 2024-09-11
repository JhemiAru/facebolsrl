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
        Schema::create('certificados', function (Blueprint $table) {
            $table->id();
            $table->integer('meses');
            $table->time('horas');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->date('fecha_entrega');

            $table->unsignedBigInteger('id_detalle');
            $table->foreign('id_detalle')->references('id')->on('detalles')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('id_inscripcion');
            $table->foreign('id_inscripcion')->references('id')->on('inscripcions')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificados');
    }
};
