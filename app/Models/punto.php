<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Punto extends Model
{
    use HasFactory;

    // Nombre de la tabla (opcional si Laravel la deduce, pero buena práctica)
    protected $table = 'puntos';

    protected $fillable = [
        'id_inscripcion',
        'puntos_ganados',
        'descripcion'
    ];

    public function inscripcion()
    {
        return $this->belongsTo(Inscripcion::class, 'id_inscripcion');
    }
}