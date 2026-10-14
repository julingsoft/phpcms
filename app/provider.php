<?php

use app\exception\Handler;
use app\support\Request;

return [
    'think\Request' => Request::class,
    'think\exception\Handle' => Handler::class,
];
