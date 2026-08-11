<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AjusteHora extends Model
{
    use HasFactory;

    protected $table = 'ajuste_horas';

    protected $fillable = [
        'inscripcion_id',
        'asistencias_extras',
        'descuento_horas',
    ];

    public function inscripcion()
    {
        return $this->belongsTo(Inscripcion::class);
    }
}
