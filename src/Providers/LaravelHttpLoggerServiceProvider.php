<?php
namespace Leninsheikh\LaravelHttpLogger;

use Illuminate\Support\ServiceProvider;

class LaravelHttpLoggerServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }
}
