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
        Schema::create('facturaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_informacion');
            $table->foreign('id_informacion')->references('id')->on('informacions')->onDelete('cascade')->onUpdate('cascade');
            $table->string('ci_nit', 20)->nullable();
            $table->enum('tipo', ['registro', 'recibo']);
            $table->enum('estado', ['no_cancelado', 'pago_efectivo', 'pago_deposito', 'pago_horas']);
            $table->timestamps();
            
            // Índices para mejorar rendimiento
            $table->index(['tipo', 'id_informacion']);
            $table->index('estado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturaciones');
    }
};
