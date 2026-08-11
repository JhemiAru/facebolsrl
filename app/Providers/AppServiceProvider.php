<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        
        /* // ===== 1. Forzar HTTPS en producción (Ferozo Host) =====
        if ($this->app->environment('production')) {
            URL::forceScheme('https'); // Obliga a usar HTTPS
        } */
        // SOLO EN DESARROLLO Para que ese cargue la pagina mas rapido
        if (app()->environment('local')) {
            DB::listen(function ($query) {
                if ($query->time > 100) {
                    Log::info("SQL lenta: " . $query->sql);
                    Log::info("Tiempo: " . $query->time . "ms");
                }
            });
        }
        
    }
}
