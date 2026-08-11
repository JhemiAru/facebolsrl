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
        Schema::create('facturaciones_recibos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_facturacion');
            $table->foreign('id_facturacion')->references('id')->on('facturaciones')->onDelete('cascade')->onUpdate('cascade');
            $table->char('n_recibo', 6);
            $table->date('fecha_recibo');
            $table->double('monto_total', 10, 2);
            $table->string('monto_literal')->nullable();
            $table->timestamps();
            
            // Índice para mejorar consultas
            $table->index('id_facturacion');
            $table->index('fecha_recibo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturaciones_recibos');
    }
};
