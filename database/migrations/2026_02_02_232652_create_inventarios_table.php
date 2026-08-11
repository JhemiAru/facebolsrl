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
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_facturacion');
            $table->foreign('id_facturacion')->references('id')->on('facturaciones')->onDelete('cascade')->onUpdate('cascade');
            $table->char('n_inventario', 6);
            $table->date('fecha_inve');
            $table->integer('cantidad');
            $table->text('concepto');
            $table->double('precio_uni', 10, 2);
            $table->double('sub_total', 10, 2);
            $table->double('total', 10, 2);
            $table->enum('tipo', ['compra', 'venta', 'bono']);
            $table->boolean('anulado')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventarios');
    }
};
