<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Tabla para almacenar múltiples conceptos de un recibo
     */
    public function up(): void
    {
        Schema::create('recibo_conceptos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_recibo');
            $table->foreign('id_recibo')->references('id')->on('facturaciones_recibos')->onDelete('cascade')->onUpdate('cascade');
            $table->text('concepto');
            $table->date('fecha_concepto');
            $table->double('monto', 10, 2);
            $table->integer('orden')->default(1);
            $table->timestamps();
            
            // Índices para mejorar rendimiento
            $table->index('id_recibo');
            $table->index('fecha_concepto');
            $table->index('orden');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recibo_conceptos');
    }
};
