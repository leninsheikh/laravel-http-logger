<?php

namespace Leninsheikh\LaravelHttpLogger\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Leninsheikh\LaravelHttpLogger\Services\HttpLoggerService;

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
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->bootHttpMacro();
    }

    /**
     * Bootstrap the http macro
     *
     * @return void
     */
    private function bootHttpMacro()
    {
        Http::macro('withLogging', function ($name) {
            $key = Str::uuid()->toString();

            return Http::withHeaders([
                HttpLoggerService::LOGGER_ID => $key,
                HttpLoggerService::LOGGER_NAME => $name,
            ]);
        });
    }
}
