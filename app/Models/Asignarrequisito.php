<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignarrequisito extends Model
{
    use HasFactory;

    protected $table = 'inscrip_requisitos';
/*     public function inscripcion(){

        return $this->belongsTo('App\Models\Inscripcion', 'id_inscripcion', 'id');
    }
    public function requisito(){
        return $this->belongsTo('App\Models\requisito', 'id_requisito', 'id');
    }
 */
}
