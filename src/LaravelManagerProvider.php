<?php

namespace PhapNguyenDuc\LaravelManager;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\ViewErrorBag;
use PhapNguyenDuc\LaravelManager\Http\Middleware\Authenticate;
use PhapNguyenDuc\LaravelManager\Http\Middleware\EncryptCookies;
use PhapNguyenDuc\LaravelManager\Http\Middleware\RedirectIfAuthenticated;
use PhapNguyenDuc\LaravelManager\Http\Middleware\VerifyCsrfToken;
use PhapNguyenDuc\LaravelManager\Services\RedisManager;

class LaravelManagerProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('redis-manager', function () {
            return  new RedisManager();
        });

        $this->mergeConfigFrom(__DIR__.'/config/redis_manager.php', 'redis_manager');
    }

    public function boot()
    {
        Blade::componentNamespace('PhapNguyenDuc\\LaravelManager\\View\\Components', 'phapnguyenduc');

        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'laravel-manager');
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');

        $this->publishes([
            __DIR__.'/resources/assets' => public_path('phapnguyenduc/laravel-manager'),
        ], 'public');
        $this->publishes([
            __DIR__.'/resources/material' => public_path('phapnguyenduc/laravel-manager/material'),
        ], 'public');
        $this->publishes([
            __DIR__ . '/Database/Seeders/DatabaseSeeder.php' => database_path('seeders/DatabaseSeeder.php'),
        ], 'laravel-manager-seeders');
        $this->publishes([
            __DIR__.'/config/redis_manager.php' => config_path('redis_manager.php'),
        ], 'config');

        View::composer('*', function ($view) {
            $errors = session()->get('errors', new ViewErrorBag());
            $view->with('errors', $errors);
        });

        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('guest', RedirectIfAuthenticated::class);
        $router->aliasMiddleware('auth', Authenticate::class);
        $router->middlewareGroup('web', [
            EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);
    }
}
