<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Models\User;
use App\Policies\UserPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */

    /* protected $policies = [
        \App\Models\User::class => \App\Policies\UserPolicy::class,
    ]; */


    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        /* $this->registerPolicies();

        Gate::define('usuarios', function ($user) {
            return in_array($user->role, ['Gerente', 'Super Administrador']);
        });

        Gate::define('usuarios.create', function ($user) {
            return in_array($user->role, ['Pasante', 'SubDirector', 'Director', 'Gerente', 'Super Administrador']);
        }); */
    }
}
