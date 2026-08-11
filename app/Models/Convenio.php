<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Convenio extends Model
{
    use HasFactory;

    protected $table = 'convenios';

    protected $fillable = [
        'estado',
        'folio',
        'fecha_inicio',
        'fecha_fin',
        'modalidad',
        'promo_descuentos',
        'empresa_id',
        'facebook',
        'instagram',
        'tik_tok',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }
}
