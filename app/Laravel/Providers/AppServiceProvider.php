<?php

namespace App\Laravel\Providers;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register() : void
    {
        if ($this->app->runningInConsole()) {
            Sanctum::ignoreMigrations();

            Factory::guessFactoryNamesUsing(function ($name) {
                return str_replace('Models', 'Database\\Factories', $name) . 'Factory';
            });
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot() : void
    {
        //
    }
}
