<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Gate::define('admin', fn (User $u) => $u->rol === 'admin');

        RateLimiter::for('login', function (Request $request) {
            $key = ($request->input('email') ?? 'guest').'|'.$request->ip();
            return Limit::perMinute(5)->by($key);
        });
    }
}
