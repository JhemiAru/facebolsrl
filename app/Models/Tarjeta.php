<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarjeta extends Model
{
    use HasFactory;

    public function asignartarjeta(){

        return $this->hasMany('App\Models\Asignartarjeta', 'id_tarjeta', 'id');
    }
}
