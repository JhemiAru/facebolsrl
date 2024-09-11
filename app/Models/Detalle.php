<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    use HasFactory;

    public function programa(){

        return $this->belongsTo('App\Models\Programa', 'id_programa', 'id');
    }

    public function area(){

        return $this->belongsTo('App\Models\Area', 'id_area', 'id');
    }
}
