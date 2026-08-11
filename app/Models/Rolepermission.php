<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rolepermission extends Model
{
    use HasFactory;

    protected $table = 'role_has_permissions'; // Nombre de la tabla pivote

    protected $fillable = ['role_id', 'permission_id'];
}
