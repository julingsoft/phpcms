<?php

declare(strict_types=1);

use think\facade\Route;

Route::group('api', function () {
    $modules = glob(app_path() . 'api/*', GLOB_ONLYDIR);
    foreach ($modules as $modulePath) {
        $moduleName = basename($modulePath);
        $modulePath = str_replace(root_path(), '', $modulePath);
        $namespace = str_replace('/', '\\', $modulePath) . '\\controller';
        Route::group($moduleName, route_rules())->namespace($namespace);
    }
});
