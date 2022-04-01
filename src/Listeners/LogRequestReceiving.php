<?php
namespace Leninsheikh\LaravelHttpLogger\Listeners;

use Illuminate\Http\Client\Events\ResponseReceived;
use LeninSheikh\LaravelHttpLogger\Services\HTTPLoggerService;

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
        (new HTTPLoggerService())->update($event);
    }
}
