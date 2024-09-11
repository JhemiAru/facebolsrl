<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informacion extends Model
{
    use HasFactory;

    public function inscripciones(){
        
        return $this->hasMany('App\Models\Inscripcion', 'id_informacion', 'id');
    }
}
