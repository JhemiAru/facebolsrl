<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;

    protected $table = 'sucursal';

    protected $fillable = [
        'direccion',
        'telefono',
        'id_lugar',
        'id_empresa',
        'id_tiposede',
    ];

    public function lugar()
    {
        return $this->belongsTo(Lugar::class, 'id_lugar');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'id_empresa');
    }

    public function tipoSede()
    {
       return $this->belongsTo(Tipo_sedes::class, 'id_tiposede');
    }
}