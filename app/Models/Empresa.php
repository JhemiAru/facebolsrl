<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $table = 'empresas';

     protected $fillable = [
        'nombre_empresa',
        'propietario',
        'celular',
        'correo',
        'descripcion',
        'longitud',
        'latitud',
        'ubicacion',
        'nit',
        'icono',
        'icono_url',
        'estado',
        'id_categoria'

    ];
  public function convenios()
    {
    return $this->hasMany(Convenio::class, 'empresa_id')->where('estado', 1);
    }

  public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }
}