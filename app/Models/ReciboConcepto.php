<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReciboConcepto extends Model
{
  protected $table = 'recibo_conceptos';

  protected $fillable = [
    'id_recibo',
    'concepto',
    'fecha_concepto',
    'monto',
    'orden'
  ];

  public function recibo()
  {
    return $this->belongsTo(FacturacionRecibo::class, 'id_recibo', 'id');
  }
}
