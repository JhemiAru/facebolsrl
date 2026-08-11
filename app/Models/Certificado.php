<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificado extends Model
{
    use HasFactory;
    public function detalle(){

        return $this->belongsTo('App\Models\Detalle', 'id_detalle', 'id');
    }

    public function inscripcion(){

        return $this->belongsTo('App\Models\Inscripcion', 'id_inscripcion', 'id');
    }


    public function programa()
{
    return $this->belongsTo('App\Models\Programa', 'id_programa', 'id');
}
}
