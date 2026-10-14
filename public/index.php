<?php

use think\App;

define('APP_START', microtime(true));

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap framework and handle the request...
/** @var App $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$response = $app->http->run();

$response->send();

$app->http->end($response);
