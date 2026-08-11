<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lugar extends Model
{
  use HasFactory;

    protected $table = 'lugar';

    protected $fillable = [
        'estado',
        'ciudad',
        'departamento',
        'provincia',
    ];
}
