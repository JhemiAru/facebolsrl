<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TotalHora extends Model
{
    use HasFactory;

    protected $table = 'totales_horas'; // nombre correcto de la tabla
    protected $fillable = [
        'id_inscripcion',
        'total_horas',
        'horas_academicas',
        'asistencias_extras',
        'horas_descuento'
    ];

    public function inscripcion()
    {
        return $this->belongsTo(Inscripcion::class, 'id_inscripcion');
    }
}
