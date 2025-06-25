<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;

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
        Schema::defaultStringLength(191);

        Blade::component('app-layout', \App\View\Components\AppLayout::class);
        Blade::component('auth-layout', \App\View\Components\AuthLayout::class);
        Blade::component('auth-layout-fixed', \App\View\Components\AuthLayoutFixed::class);
    }
}
