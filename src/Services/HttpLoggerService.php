<?php

namespace Leninsheikh\LaravelHttpLogger\Services;

use Illuminate\Http\Client\Events\ResponseReceived;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

/**
 *
 */
class HttpLoggerService
{
    /**
     *
     */
    public const LOGGER_NAME = 'lnn_http_logger_name';
    /**
     *
     */
    public const LOGGER_ID = 'lnn_http_logger_id';

    /**
     * saving log
     *
     * @param Request $request
     */
    public function create(Request $request)
    {
        $key = $request->header(self::LOGGER_ID)[0] ?? null;
        $name = $request->header(self::LOGGER_NAME)[0] ?? $request->url();

        if ($key) {
            $data =  [
                'created_at' => Carbon::now()->toDateTimeString(),
                'name' => $name,
                'key' => $key,
                'url' => $request->url(),
                'method' => $request->method(),
                'request_header' => json_encode($request->headers()),
                'request_body' => empty($request->body()) ? null : $request->body(),
            ];
            DB::table('lnn_http_logs')->insert($data);
        }
    }

    /**
     * updating log
     *
     * @param ResponseReceived $received
     */
    public function update(ResponseReceived $received)
    {
        $key = $received->request->header(self::LOGGER_ID)[0] ?? null;

        if ($key) {
            $body = json_decode($received->response->body(), true);
            $data =  [
                'response_header' => json_encode($received->response->headers()),
                'response_body' => $body ? $received->response->body() : json_encode($received->response->body()),
                'response_status' => $received->response->status(),
            ];

            DB::table('lnn_http_logs')->where('key', $key)->update($data);
        }
    }

    /**
     * getting query from url string
     *
     * @param string $url
     * @param string $key
     *
     * @return string|null
     */
    private function getQuery(string $url, string $key): ?string
    {
        $parts = parse_url($url);
        parse_str(optional($parts)['query'], $query);
        return optional($query)[$key];
    }
}
