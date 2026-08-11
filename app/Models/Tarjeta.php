<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarjeta extends Model
{
    use HasFactory;

    public function asignartarjeta()
    {

        return $this->hasMany('App\Models\AsignarTarjeta', 'id_tarjeta', 'id');
    }

    public function inscripciones(){

        return $this->belongsToMany('App\Models\Inscripcion', 'inscrip_tarjetas', 'id_inscripcion', 'id_tarjeta');
        
    }
}
