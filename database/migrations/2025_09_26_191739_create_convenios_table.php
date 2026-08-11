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
        Schema::create('convenios', function (Blueprint $table) {
    $table->id();
    $table->boolean('estado')->default(true);
    $table->string('folio');
    $table->date('fecha_inicio');
    $table->date('fecha_fin');
    $table->string('modalidad');
    $table->string('promo_descuentos');
    $table->foreignId('empresa_id')->constrained('empresas');

    $table->string('facebook')->nullable();
    $table->string('instagram')->nullable();
    $table->string('tik_tok')->nullable();

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('convenios');
    }
};
