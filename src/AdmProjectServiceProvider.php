<?php

namespace AndreaOrtu\AdmProject;

use AndreaOrtu\AdmProject\Commands\StorePeopleAndPlanet;
use AndreaOrtu\AdmProject\Controllers\PeopleController;
use AndreaOrtu\AdmProject\Exceptions\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Support\ServiceProvider;

class AdmProjectServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make(PeopleController::class);
        $this->app->singleton(ExceptionHandler::class, Handler::class);
        $this->app->router->aliasMiddleware('bindings', SubstituteBindings::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/Database/migrationgs');
        if ($this->app->runningInConsole()) {
            $this->commands([
                StorePeopleAndPlanet::class,
            ]);
        }
    }
}
