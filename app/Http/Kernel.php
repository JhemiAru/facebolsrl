<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        // Aquí van tus middleware globales
        
    ];

    protected $routeMiddleware = [
        // Aquí van tus middleware de ruta
    ];

    protected $middlewareGroups = [
        'web' => [
            // Middleware para el grupo web
            \App\Http\Middleware\CheckSessionActivity::class,
        ],

        'api' => [
            // Middleware para el grupo API
        ],
    ];

    
}
