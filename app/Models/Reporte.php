<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    use HasFactory;

    public function inscripciones(){

        return $this->belongsTo('App\Models\Inscripcion', 'id_inscripcion', 'id');
    }
}
