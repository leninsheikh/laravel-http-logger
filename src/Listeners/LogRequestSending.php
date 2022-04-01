<?php
namespace Leninsheikh\LaravelHttpLogger\Listeners;

use LeninSheikh\LaravelHttpLogger\Services\HttpLoggerService;
use Illuminate\Http\Client\Events\RequestSending;

class LogRequestSending
{
    /**
     * Handle the event.
     *
     * @param RequestSending $event
     * @return void
     */
    public function handle(RequestSending $event)
    {
        (new HttpLoggerService())->create($event->request);
    }
}
