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
        Schema::create('sucursal', function (Blueprint $table) {
            $table->id();

            $table->string('direccion');
            $table->char('telefono', 15);
            
            $table->unsignedBigInteger('id_empresa');
            $table->foreign('id_empresa')->references('id')->on('empresas')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('id_lugar');
            $table->foreign('id_lugar')->references('id')->on('lugar')->onDelete('cascade')->onUpdate('cascade');
            
            $table->unsignedBigInteger('id_tiposede');
            $table->foreign('id_tiposede')->references('id')->on('tipo_sedes')->onDelete('cascade')->onUpdate('cascade');
            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sucursal');
    }
};
