<?php
namespace Leninsheikh\LaravelHttpLogger\Providers;

use Illuminate\Http\Client\Events\RequestSending;
use Illuminate\Http\Client\Events\ResponseReceived;
use Illuminate\Support\ServiceProvider;
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
    }
}
