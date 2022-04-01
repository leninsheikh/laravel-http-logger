<?php

namespace Leninsheikh\LaravelHttpLogger\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class LaravelHttpLoggerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function register()
    {

    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
        $this->bootHttpMacro();
    }

    private function bootHttpMacro()
    {
        Http::macro('withLogging', function ($name) {
            $key = Str::uuid()->toString();

            return Http::withOptions(['query' => [
                'lnn_http_logger_key' => $key,
                'lnn_http_logger_name' => $name,
            ]]);
        });
    }
}
