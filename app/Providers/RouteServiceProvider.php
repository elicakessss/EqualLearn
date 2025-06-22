<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{    public const HOME = '/dashboard';

    /**
     * Get the redirect path based on user role.
     *
     * @param \App\Models\User $user
     * @return string
     */
    public static function redirectPath()
    {
        $user = auth()->user();
        if ($user) {
            if ($user->hasRole('admin')) {
                return '/admin/dashboard';
            }
            // All other roles go to home
            return '/home';
        }
        return static::HOME;
    }

    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
