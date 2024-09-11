<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multa extends Model
{
    use HasFactory;

    public function asistencias(){
        
        return $this->hasMany('App\Models\Asistencia', 'id_multa', 'id');
    }
}
