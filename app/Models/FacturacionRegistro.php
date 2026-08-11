<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacturacionRegistro extends Model
{
    protected $table = 'facturaciones_registros';
    protected $fillable = [
        'id_facturacion',
        'n_registro',
        'fecha',
        'concepto',
        'monto',
        'monto_literal'
    ];

    public function facturacion()
    {
        return $this->belongsTo(Facturacion::class, 'id_facturacion', 'id');
    }
}