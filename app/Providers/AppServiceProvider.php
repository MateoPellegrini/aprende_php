<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Política de contraseñas fuerte (afecta Rules\Password::defaults())
        Password::defaults(function () {
            return Password::min(12)->mixedCase()->numbers()->symbols();
        });
    }
}
