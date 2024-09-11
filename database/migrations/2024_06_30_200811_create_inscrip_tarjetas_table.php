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
        Schema::create('inscrip_tarjetas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_inscripcion');
            $table->foreign('id_inscripcion')->references('id')->on('inscripcions')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('id_tarjeta');
            $table->foreign('id_tarjeta')->references('id')->on('tarjetas')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscrip_tarjetas');
    }
};
