<?php

declare(strict_types=1);

use think\facade\Route;

$modules = glob(app_path() . 'modules/*', GLOB_ONLYDIR);
foreach ($modules as $modulePath) {
    $moduleName = basename($modulePath);
    $modulePath = str_replace(root_path(), '', $modulePath);
    $namespace = str_replace('/', '\\', $modulePath) . '\\controller';
    Route::group($moduleName, route_rules())->namespace($namespace);
}

Route::group(route_rules());
