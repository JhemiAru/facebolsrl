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
        Schema::create('inscripcions', function (Blueprint $table) {
            $table->id();
            $table->string('estado');
            $table->date('f_inscripcion');
            $table->string('recibos', 20);
            /* $table->string('email')->unique(); */
            $table->decimal('porcentaje_requisitos', 5, 2)->default(0);
            $table->string('direccion', 100);
            $table->integer('ci')->unique()->nullable();
            $table->char('genero', 15)->nullable();
            $table->char('codigo_credencial', 20)->unique();

            $table->unsignedBigInteger('id_informacion')->unique();
            $table->foreign('id_informacion')->references('id')->on('informacions')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_generacion');
            $table->foreign('id_generacion')->references('id')->on('generacions')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_area');
            $table->foreign('id_area')->references('id')->on('areas')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_extension')->nullable();
            $table->foreign('id_extension')->references('id')->on('extensions')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscripcions');
    }
};
