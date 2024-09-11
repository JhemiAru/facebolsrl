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
        Schema::create('inscrip_requisitos', function (Blueprint $table) {
            $table->id();
            $table->string('estado');

            $table->unsignedBigInteger('id_inscripcion');
            $table->foreign('id_inscripcion')->references('id')->on('inscripcions')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('id_requisito');
            $table->foreign('id_requisito')->references('id')->on('requisitos')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscrip_requisitos');
    }
};
