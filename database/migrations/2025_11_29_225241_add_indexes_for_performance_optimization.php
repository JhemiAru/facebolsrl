<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Añadir índices para optimizar consultas en tablas de facturación
     * Esto mejorará significativamente el rendimiento con grandes volúmenes de datos (1000+ registros)
     */
    public function up(): void
    {
        Schema::table('facturaciones', function (Blueprint $table) {});

        Schema::table('facturaciones_registros', function (Blueprint $table) {
            $table->index('anulado', 'idx_anulado');
        });

        Schema::table('informacions', function (Blueprint $table) {
            $table->index('nombre', 'idx_nombre');
        });

        Schema::table('recibo_conceptos', function (Blueprint $table) {});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('facturaciones', function (Blueprint $table) {});

        Schema::table('facturaciones_registros', function (Blueprint $table) {
            $table->dropIndex('idx_anulado');
        });

        Schema::table('informacions', function (Blueprint $table) {
            $table->dropIndex('idx_nombre');
        });
    }
};
