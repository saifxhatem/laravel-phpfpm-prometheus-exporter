<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Metrics Endpoint
    |--------------------------------------------------------------------------
    |
    | This value determines the endpoint where Prometheus will scrape metrics
    | from your application. By default, it is set to "/metrics".
    |
    */

    'metrics_endpoint' => env('PROMETHEUS_METRICS_ENDPOINT', '/metrics'),

    /*
    |--------------------------------------------------------------------------
    | Memory Store
    |--------------------------------------------------------------------------
    |
    | Here you may specify the memory store to be used for storing metrics data.
    | Supported options are "in_memory" and "redis". The default is "in_memory".
    |
    */

    'memory_store' => env('PROMETHEUS_MEMORY_STORE', 'in_memory'),

    /*
    |--------------------------------------------------------------------------
    | Redis Configuration
    |--------------------------------------------------------------------------
    |
    | When using Redis as your memory store, you can configure its connection
    | settings below. Ensure these environment variables are set accordingly.
    |
    */

    'redis_configuration' => [
        'host'      => env('PROMETHEUS_REDIS_HOST', '127.0.0.1'),
        'port'      => env('PROMETHEUS_REDIS_PORT', 6379),
        'username'  => env('PROMETHEUS_REDIS_USERNAME', null),
        'password'  => env('PROMETHEUS_REDIS_PASSWORD', null),
        'database'  => env('PROMETHEUS_REDIS_DATABASE', 0),
    ],

];