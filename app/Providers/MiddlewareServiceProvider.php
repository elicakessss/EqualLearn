<?php

namespace App\Providers;

use App\Http\Middleware\CheckRole;
use Illuminate\Support\ServiceProvider;

class MiddlewareServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('role', function ($app) {
            return new CheckRole();
        });
    }

    public function boot()
    {
        //
    }
}
