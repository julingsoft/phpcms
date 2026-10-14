<?php

use think\facade\Route;

Route::get('think', function () {
    return 'hello';
});

Route::get('hello/:name', 'index/hello');
