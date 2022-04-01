<?php
namespace Leninsheikh\LaravelHttpLogger\Providers;

use Illuminate\Http\Client\Events\RequestSending;
use Illuminate\Http\Client\Events\ResponseReceived;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Leninsheikh\LaravelHttpLogger\Listeners\LogRequestReceiving;
use Leninsheikh\LaravelHttpLogger\Listeners\LogRequestSending;

class LaravelHttpLoggerServiceProvider extends ServiceProvider
{
    protected $listen = [
        RequestSending::class => [
            LogRequestSending::class
        ],
        ResponseReceived::class => [
            LogRequestReceiving::class
        ],
    ];

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
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

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
