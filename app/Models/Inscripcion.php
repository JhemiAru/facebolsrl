<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{

    static $rules = [
            //'estado' => 'required',
            'f_inscripcion' => 'required',
            'recibos' => 'required',
            'direccion' => 'required',
            'ci' => 'required',
            'genero' => 'required',
            'codigo_credencial' => 'required',
            'id_informacion' => 'required',
            'id_generacion' => 'required',
            'id_area' => 'required',
            'id_extension' => 'required',
    ];


    protected $fillable = ['f_inscripcion','recibos','direccion','codigo_credencial','id_informacion','id_generacion','id_area','ci','extension','genero'];

    public function informacion(){

        return $this->belongsTo('App\Models\Informacion', 'id_informacion', 'id');
    }
    public function generacion(){

        return $this->belongsTo('App\Models\Generacion', 'id_generacion', 'id');
    }
    public function area(){

        return $this->belongsTo('App\Models\Area', 'id_area', 'id');
    }
    public function tarjetas()
    {
        return $this->belongsToMany('App\Models\Tarjeta', 'inscrip_tarjetas', 'id_inscripcion', 'id_tarjeta');
    }
    public function asistencias(){

        return $this->hasMany('App\Models\Asistencia', 'id_inscripcion', 'id');
    }
    public function extension(){

        return $this->belongsTo('App\Models\Extension', 'id_extension', 'id');
    }
    public function users(){

        return $this->belongsTo('App\Models\User', 'codigo_credencial', 'codigo_credencial');
    }
    public function reporte(){

        return $this->belongsTo('App\Models\Reportes', 'id_reporte', 'id');
    }

    public function inscripReportes()
    {
        return $this->hasMany('App\Models\Inscrip_reporte', 'id_inscripcion');
    }

    public function puntos()
    {
        return $this->hasMany('App\Models\Punto', 'id_inscripcion', 'id');
    }

    // En App\Models\Inscripcion
public function programa()
{
    return $this->belongsTo(Programa::class, 'id_programa', 'id');
}
}