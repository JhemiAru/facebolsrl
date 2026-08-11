<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    /* public function viewAny(User $user)
    {
        return in_array($user->role, ['Super Administrador', 'Gerente']);
    }

    public function view(User $user, User $model)
    {
        return in_array($user->role, ['Super Administrador', 'Gerente']);
    }

    public function create(User $user)
    {
        return in_array($user->role, [
            'Pasante',
            'SubDirector',
            'Director',
            'Super Administrador',
            'Gerente',
        ]);
    }

    public function update(User $user, User $model)
    {
        return in_array($user->role, ['Super Administrador', 'Gerente']);
    }

    public function delete(User $user, User $model)
    {
        return in_array($user->role, ['Super Administrador', 'Gerente']);
    } */
    /* public function update(User $authUser, User $usuario)
    {
        return $authUser->id === $usuario->id;
    }
    public function show(User $authUser, User $usuario)
    {
        return $authUser->id === $usuario->id || $authUser->is_admin;
    } */
/*     public function view(User $authUser, User $usuario)
{
    return $authUser->id === $usuario->id || $authUser->hasRole('admin');
}
public function update(User $authUser, User $usuario)
{
    // Permitir que un usuario actualice su propia cuenta
    // o permitirlo si tiene un rol tipo 'admin'
    return $authUser->id === $usuario->id || $authUser->hasRole('admin');
} */

}
