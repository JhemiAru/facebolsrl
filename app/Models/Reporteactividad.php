<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporteactividad extends Model
{
    use HasFactory;

    protected $table = 'reporteactividades'; // Asegúrate de que el nombre de la tabla sea correcto

    protected $fillable = [
        'id_asistencia',
        'mesLiteral',
        'admin',
        'conclusion',
        'turno',
        'semana',
        'f1',
        'actividade1',
        'f2',
        'actividade2',
        'f3',
        'actividade3',
        'f4',
        'actividade4',
        'f5',
        'actividade5'
    ];
    

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user'); // Asegúrate de que 'user_id' sea el campo correcto
    }

    /* public function user()
    {
        return $this->belongsTo('App\Models\User', 'id_user');
    } */

    public function asistencia(){

        return $this->belongsTo('App\Models\Asistencia', 'id_asistencia', 'id');
    }
    
}