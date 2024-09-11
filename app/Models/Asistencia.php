<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'h_llegada',
        'h_salida', // Campo que puede ser nulo
        'horas', // Campo que puede ser nulo
        'turno',
        'asistencia',
        'id_inscripcion',
        'id_actividad',
        'id_multa',
        'estado',
    ];

    protected $casts = [
        'fecha' => 'datetime',
    ];

    public function inscripciones(){

        return $this->belongsTo('App\Models\Inscripcion', 'id_inscripcion', 'id');
    }
    public function multa(){

        return $this->belongsTo('App\Models\Multa', 'id_multa', 'id');
    }
    public function actividad(){

        return $this->belongsTo('App\Models\Actividad', 'id_actividad', 'id');
    }
}
