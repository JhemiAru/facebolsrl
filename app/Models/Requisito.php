<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisito extends Model
{
    use HasFactory;

    public function inscripciones(){

        return $this->hasMany('App\Models\Inscripcion', 'id_area', 'id');
    }
}
