<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use HasFactory;

    public function permission()
    {
        return $this->belongsToMany(Permission::class, 'role_has_permissions', 'role_id', 'permission_id');
    }

    /* public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'name');
    } */

    public function inscripciones(){
        
        return $this->hasMany('App\Models\Inscripcion', 'codigo_credencial', 'codigo_credencial');
    }
}