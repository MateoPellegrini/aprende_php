<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * A dónde redirigir si no está autenticado.
     */
    protected function redirectTo($request): ?string
    {
        // Breeze define la ruta 'login'
        return $request->expectsJson() ? null : route('login');
    }
}
