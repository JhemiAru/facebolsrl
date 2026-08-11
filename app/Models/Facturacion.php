<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facturacion extends Model
{
    use HasFactory;

    protected $table = 'facturaciones';
    protected $fillable = [
        'id_informacion',
        'ci_nit',
        'tipo',
        'estado',
        'anulado'
    ];

    public function informacion()
    {
        return $this->belongsTo(Informacion::class, 'id_informacion', 'id');
    }

    public function registro()
    {
        return $this->hasOne(FacturacionRegistro::class, 'id_facturacion', 'id');
    }

    public function recibo()
    {
        return $this->hasOne(FacturacionRecibo::class, 'id_facturacion', 'id');
    }
}