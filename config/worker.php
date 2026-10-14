<?php

use think\worker\websocket\Handler;

return [
    'http' => [
        'enable' => true,
        'host' => '0.0.0.0',
        'port' => 8080,
        'worker_num' => 4,
        'options' => [],
    ],
    'websocket' => [
        'enable' => false,
        'handler' => Handler::class,
        'ping_interval' => 25000,
        'ping_timeout' => 60000,
    ],
    // 队列
    'queue' => [
        'enable' => false,
        'workers' => [],
    ],
    'hot_update' => [
        'enable' => env('APP_DEBUG', false),
        'name' => ['*.php'],
        'include' => [app_path(), config_path(), root_path('route')],
        'exclude' => [],
    ],
];
