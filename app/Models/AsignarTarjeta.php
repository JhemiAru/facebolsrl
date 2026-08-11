<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignarTarjeta extends Model
{
    use HasFactory;

    protected $table = 'inscrip_tarjetas';
    public function inscripcion(){

        return $this->belongsTo('App\Models\Inscripcion', 'id_inscripcion', 'id');
    }
    public function tarjeta(){
        return $this->belongsTo('App\Models\Tarjeta', 'id_tarjeta', 'id');
    }
}
