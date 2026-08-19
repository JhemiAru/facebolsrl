<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('puntos', function (Blueprint $table) {
            $table->id(); // Crea la columna 'id' autoincrementable y llave primaria
            
            // Relación con la inscripción del pasante
            $table->unsignedBigInteger('id_inscripcion'); 
            
            // Cantidad de puntos (permite números positivos y negativos)
            $table->integer('puntos_ganados'); 
            
            // El motivo por el cual se dieron o quitaron los puntos
            $table->string('descripcion', 255); 
            
            // Crea automáticamente 'created_at' y 'updated_at'
            $table->timestamps(); 

            // (Opcional pero recomendado) Restricción de llave foránea
            $table->foreign('id_inscripcion')->references('id')->on('inscripcions')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('puntos');
    }
};
