<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;
    protected $table = 'inventarios';

    /*protected $casts = [
    'concepto' => 'array',
    ];*/
    protected $fillable = [
        'id_facturacion',
        'n_inventario',
        'fecha_inve',
        'cantidad',
        'concepto',
        'precio_uni',
        'sub_total',
        'total',
        'tipo',
        'anulado'
    ];

    public function facturacion()
    {
        return $this->belongsTo(Facturacion::class, 'id_facturacion');
    }

}
