<?php
namespace Leninsheikh\LaravelHttpLogger\Listeners;

use Illuminate\Http\Client\Events\ResponseReceived;
use Leninsheikh\LaravelHttpLogger\Services\HttpLoggerService;

class LogRequestReceiving
{
    /**
     * Handle the event.
     *
     * @param ResponseReceived $event
     * @return void
     */
    public function handle(ResponseReceived $event)
    {
        (new HttpLoggerService())->update($event);
    }
}
