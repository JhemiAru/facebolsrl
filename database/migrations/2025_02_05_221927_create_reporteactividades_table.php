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
        Schema::create('reporteactividades', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_asistencia');
            $table->foreign('id_asistencia')->references('id')->on('asistencias')->onDelete('cascade')->onUpdate('cascade');
            
            /* $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade'); */
            
            /* $table->string('email')->unique(); */
            $table->string('mesLiteral',30);
            $table->char('semana',20);
            
            $table->date('f1');
            $table->string('actividade1');
            $table->date('f2');
            $table->string('actividade2');
            $table->date('f3');
            $table->string('actividade3');
            $table->date('f4');
            $table->string('actividade4');
            $table->date('f5');
            $table->string('actividade5');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reporteactividades');
    }
};
