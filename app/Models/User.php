<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasRoles, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'estado',
        'foto', // Agregado para manejar la foto de perfil
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function inscripciones()
    {
        return $this->belongsTo('App\Models\Inscripcion', 'codigo_credencial', 'codigo_credencial');
    }

    public function reporteactividades()
    {
        return $this->hasMany('App\Models\Reporteactividad', 'id_user', 'id');
    }
/*     public function informacion()
{
    return $this->belongsTo(Informacion::class, 'id_informacion');
} */
public function informacion()
{
    return $this->hasOne(Informacion::class, 'id_user', 'id'); // Ajusta 'id_user' si es el nombre correcto
}

}
