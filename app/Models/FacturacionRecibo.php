<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacturacionRecibo extends Model
{
    protected $table = 'facturaciones_recibos';
    protected $fillable = [
        'id_facturacion',
        'n_recibo',
        'fecha_recibo', 
        'monto_total',
        'monto_literal'
    ];

    public function facturacion()
    {
        return $this->belongsTo(Facturacion::class, 'id_facturacion', 'id');
    }

    public function conceptos()
    {
        return $this->hasMany(ReciboConcepto::class, 'id_recibo', 'id')->orderBy('orden');
    }
}