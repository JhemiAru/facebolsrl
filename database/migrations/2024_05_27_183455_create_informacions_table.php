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
        Schema::create('informacions', function (Blueprint $table) {
            $table->id();
            $table->string('apellido_paterno', 50);
            $table->string('apellido_materno', 50);
            $table->string('nombre', 50);
            $table->string('celular',10);
            $table->string('insti_univer', 200);
            $table->string('carrera', 100);
            $table->char('año', 20);
            $table->string('invitado_visita');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informacions');
    }
};
