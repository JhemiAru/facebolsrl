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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();

            $table->string("nombre_empresa");
            $table->string("propietario");
            $table->char("celular",15);
            $table->string('correo')->unique();
            $table->string('descripcion');
            $table->float('longitud');
            $table->float('latitud');
            $table->text('ubicacion');
            $table->string('nit');
            $table->string('icono');
            $table->string ('icono_url');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
